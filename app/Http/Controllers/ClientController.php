<?php

namespace App\Http\Controllers;

use App\Models\Client; // Wajib ada agar controller bisa panggil database
use App\Models\Project;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
{
    $clients = Client::all();
    
    // Ambil project yang statusnya BUKAN pending_review
    // Di ClientController atau tempat kamu ambil data projects
$projects = Project::whereIn('status', ['ongoing', 'pending'])->get();
    
    // Ambil project yang khusus statusnya pending_review untuk Approval section
    $pendingOrders = Project::where('status', 'pending_review')->with('client')->get();

    // Hitung stats
    $totalRevenue = Project::where('status', 'completed')->sum('budget');
    $activeProjectsCount = Project::where('status', 'ongoing')->count();

    return view('welcome', compact('clients', 'projects', 'pendingOrders', 'totalRevenue', 'activeProjectsCount'));
}
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients',
        ]);

        Client::create($request->all());

        return redirect('/')->with('success', 'Client added successfully!');
    }
    public function destroy($id)
{
    $client = \App\Models\Client::findOrFail($id);
    $client->delete();

    return redirect('/')->with('success', 'Client deleted!');
}


}
