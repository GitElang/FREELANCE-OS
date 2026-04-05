<?php
namespace App\Http\Controllers;

use App\Mail\OrderApprovedMail;
use App\Mail\OrderRejectedMail;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{
    public function create()
    {
        $clients = \App\Models\Client::all(); // Untuk dropdown pilih client
        return view('projects.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'client_id' => 'required',
            'budget' => 'required|numeric',
            'deadline' => 'required|date',
            'notes' => 'nullable'
        ]);

        // Set status default sebagai 'pending' untuk project baru
        \App\Models\Project::create(array_merge($request->all(), ['status' => 'pending']));

        return redirect('/')->with('success', 'Project baru berhasil ditambahkan!');
    }
    public function show($id)
    {
        // Ambil data project beserta data client-nya
        $project = \App\Models\Project::with('client')->findOrFail($id);
        
        return view('projects.show', compact('project'));
    }
    public function complete($id)
    {
    $project = \App\Models\Project::findOrFail($id);
    
    // Ubah status jadi completed
    $project->update([
        'status' => 'completed'
    ]);

    return redirect('/')->with('success', 'Project: ' . $project->title . ' has been completed! Ready for invoice.');
    }
    public function destroy($id)
    {
    $project = \App\Models\Project::findOrFail($id);
    $project->delete();

    return redirect('/')->with('success', 'Project deleted successfully.');
    }
    public function allProjects(Request $request)
{
    $clients = \App\Models\Client::all();
    
    // Filter berdasarkan client jika ada request dari dropdown
    $query = \App\Models\Project::with('client');

    if ($request->has('client_id') && $request->client_id != '') {
        $query->where('client_id', $request->client_id);
    }

    $projects = $query->latest()->get();

    return view('projects.index', compact('projects', 'clients'));
    }
    public function edit($id)
{
    $project = \App\Models\Project::findOrFail($id);
    $clients = \App\Models\Client::all();
    return view('projects.edit', compact('project', 'clients'));
}

public function update(Request $request, $id)
{
    $project = \App\Models\Project::findOrFail($id);
    
    $request->validate([
        'title' => 'required',
        'budget' => 'required|numeric',
        'deadline' => 'required|date',
        'status' => 'required',
        'notes' => 'nullable' // Validasi untuk notes
    ]);

    $project->update($request->all());

    // Redirect dengan flash message
    return redirect('/projects/' . $id)->with('success', 'Data berhasil diubah!');
}
public function approve($id)
{
    $project = Project::with('client')->findOrFail($id);
    
    // Ubah status jadi ongoing (agar muncul di daftar Active Projects)
    $project->update(['status' => 'ongoing']);

    // Kirim Email Notifikasi ke Client
    Mail::to($project->client->email)->send(new OrderApprovedMail($project));

    return redirect('/')->with('success', 'Project Approved! Email notifikasi telah dikirim ke client.');
}

// Untuk Reject, kita bisa pakai fungsi destroy yang sudah ada 
// atau buat fungsi khusus jika ingin kirim email dulu sebelum hapus
public function reject($id)
{
    $project = Project::with('client')->findOrFail($id);
    
    // Bungkus pengiriman email biar kalau Mailtrap limit, aplikasi nggak crash
    try {
        if ($project->client && $project->client->email) {
            Mail::to($project->client->email)->send(new OrderRejectedMail($project));
        }
    } catch (\Exception $e) {
        // Biarkan kosong atau log errornya, yang penting aplikasi lanjut ke bawah
        \Illuminate\Support\Facades\Log::error("Gagal kirim email reject: " . $e->getMessage());
    }

    // Status TETAP berubah meskipun email gagal
    $project->update(['status' => 'rejected']);
    
    return redirect('/')->with('success', 'Order ditolak. (Catatan: Email mungkin gagal kirim karena limit Mailtrap).');
}

}