<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\AuthController;
use App\Models\Project;
use App\Models\Client;

/*
|--------------------------------------------------------------------------
| 1. RUTE PUBLIK (Bisa diakses tanpa login)
|--------------------------------------------------------------------------
*/

// Halaman Order untuk Client
Route::get('/order', [LandingPageController::class, 'index'])->name('order.form');
Route::post('/order/submit', [LandingPageController::class, 'storeOrder'])->name('order.submit');

// Auth System (Halaman Login)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| 2. RUTE ADMIN (Wajib Login / Middleware Auth)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // DASHBOARD UTAMA
    Route::get('/', function () {
        $pendingOrders = Project::where('status', 'pending')->latest()->get();
        $totalRevenue = Project::whereIn('status', ['ongoing', 'completed'])->sum('budget');
        $activeProjectsCount = Project::where('status', 'ongoing')->count();
        $finishedProjectsCount = Project::where('status', 'completed')->count();
        $clients = Client::all(); 
        $projects = Project::where('status', 'ongoing')->with('client')->latest()->get();

        return view('welcome', compact(
            'pendingOrders', 'totalRevenue', 'activeProjectsCount', 
            'finishedProjectsCount', 'clients', 'projects'
        ));
    })->name('dashboard');

    // PROJECT MANAGEMENT
    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'allProjects'])->name('projects.index');
        Route::get('/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/{id}', [ProjectController::class, 'show'])->name('projects.show');
        Route::get('/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('/{id}', [ProjectController::class, 'update'])->name('projects.update');
        Route::patch('/{id}/complete', [ProjectController::class, 'complete'])->name('projects.complete');
        Route::delete('/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
        
        // Approve & Reject
        Route::post('/{id}/approve', [ProjectController::class, 'approve'])->name('projects.approve');
        Route::post('/{id}/reject', [ProjectController::class, 'reject'])->name('projects.reject');
    });

    // INVOICE MANAGEMENT
    Route::prefix('invoices')->group(function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('invoices.index');
        Route::get('/{id}/download', [InvoiceController::class, 'downloadPDF'])->name('invoices.download');
        Route::post('/{id}/send', [InvoiceController::class, 'sendEmail'])->name('invoices.send');
        Route::post('/invoices/{id}/done', [InvoiceController::class, 'markAsDone'])->name('invoices.done');
        Route::delete('/invoices/{id}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
    });

    // CLIENT MANAGEMENT
    Route::post('/clients', [ClientController::class, 'store']);
    Route::delete('/clients/{id}', [ClientController::class, 'destroy']);
});