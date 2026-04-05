<?php

namespace App\Http\Controllers;

use App\Mail\ProjectInvoiceMail;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf; 
class InvoiceController extends Controller
{
    public function index() 
{
    $completedProjects = Project::with('client')
        ->whereIn('status', ['completed', 'done']) // Menampilkan keduanya
        ->latest()
        ->get();

    return view('invoices.index', compact('completedProjects'));
}
    public function sendEmail($id)
{
    $project = \App\Models\Project::with('client')->findOrFail($id);
    
    if (!$project->client->email) {
        return redirect()->back()->with('error', 'Client tidak punya email! ❌');
    }

    try {
        \Illuminate\Support\Facades\Mail::to($project->client->email)
            ->send(new \App\Mail\ProjectInvoiceMail($project));
            
        // Kirim pesan success
        return redirect()->back()->with('success', 'Invoice dikirim ke ' . $project->client->email . '! 🚀');
    } catch (\Exception $e) {
        // Kirim pesan error jika Mailtrap/SMTP bermasalah
        return redirect()->back()->with('error', 'Gagal kirim email: ' . $e->getMessage());
    }
}


public function downloadPDF($id)
{
    $project = \App\Models\Project::with('client')->findOrFail($id);

    // Memastikan class dipanggil dengan benar
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('invoices.pdf', compact('project'));

    return $pdf->download('invoice-' . \Illuminate\Support\Str::slug($project->title) . '.pdf');
}
public function markAsDone($id)
{
    $project = Project::findOrFail($id);
    
    // Update status ke 'done'
    $project->update(['status' => 'done']);

    return redirect()->back()->with('success', 'Project ' . $project->title . ' is officially DONE! 🚀');
}
public function destroy($id)
{
    $project = Project::findOrFail($id);

    // Proteksi: Hanya status 'done' yang boleh dihapus
    if ($project->status !== 'done') {
        return redirect()->back()->with('error', 'Hanya project status DONE yang bisa dihapus! ⚠️');
    }

    $project->delete();

    return redirect()->back()->with('success', 'Project berhasil dibersihkan dari archive! 🗑️');
}
}
