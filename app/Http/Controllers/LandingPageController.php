<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;

class LandingPageController extends Controller
{
    // Menampilkan halaman Landing Page / Form Order
    public function index()
    {
        return view('order'); 
    }

    // Memproses data order dari Client
    public function storeOrder(Request $request) {
    $request->validate([
        'client_name' => 'required',
        'email' => 'required|email',
        'project_title' => 'required',
        'budget' => 'required|numeric',
        'deadline' => 'required|date',
        'brief' => 'required',
    ]);

    $client = Client::firstOrCreate(
        ['email' => $request->email],
        ['name' => $request->client_name]
    );

    Project::create([
        'title' => $request->project_title,
        'client_id' => $client->id,
        'budget' => $request->budget,
        'deadline' => $request->deadline,
        'status' => 'pending', // <--- PASTIIN INI 'pending', jangan 'pending_review'
        'notes' => $request->brief,
    ]);

    return redirect()->back()->with('success', 'Request Terkirim! Kami akan meninjau dan mengirim email konfirmasi segera.');
}
}