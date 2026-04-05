<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Freelance OS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        html { scroll-behavior: smooth; } 
        @keyframes pulse-subtle {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.01); }
}
.animate-pulse-subtle {
    animation: pulse-subtle 3s ease-in-out infinite;
}
 /* Styling Scrollbar biar tetep Brutalist */
    .custom-scrollbar::-webkit-scrollbar {
        width: 12px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f0f0f0;
        border-left: 4px solid black;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: black;
        border: 2px solid #f0f0f0;
    }
    </style>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gum-bg text-black">

    <div class="flex min-h-screen">
        <aside class="w-64 border-r-4 border-black bg-white p-6 flex flex-col">
            <div class="mb-10">
                <h1 class="text-2xl font-black italic tracking-tighter">FREELANCE OS</h1>
            </div>

            <nav class="space-y-4 flex-1">
                <a href="/" class="flex items-center gap-3 p-3 border-4 border-black bg-yellow-300 shadow-neo font-black group">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    <span>DASHBOARD</span>
                </a>
                
                <a href="#clients-table" class="flex items-center gap-3 p-3 border-4 border-transparent hover:border-black hover:bg-white hover:shadow-neo transition-all font-black group">
                    <i data-lucide="users" class="w-5 h-5 group-hover:text-blue-500"></i>
                    <span>CLIENTS</span>
                </a>
                            
                <a href="/projects" class="flex items-center gap-3 p-3 border-4 border-transparent hover:border-black hover:bg-white hover:shadow-neo transition-all font-black group">
                    <i data-lucide="folder-kanban" class="w-5 h-5 group-hover:text-pink-500"></i>
                    <span>PROJECTS</span>
                </a>
                
                <a href="/invoices" class="flex items-center gap-3 p-3 border-4 border-transparent hover:border-black hover:bg-white hover:shadow-neo transition-all font-black group">
                    <i data-lucide="file-text" class="w-5 h-5 group-hover:text-green-500"></i>
                    <span>INVOICES</span>
                </a>
            </nav>
            

            <div class="mt-auto pt-6 border-t-2 border-black">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-400 border-2 border-black shadow-neo"></div>
                    <div>
                        <p class="font-bold text-sm leading-none">Admin User</p>
                        <p class="text-xs italic">Agency Owner</p>
                    </div>
                </div>
            </div>
        </aside>

        <main class="flex-1 p-10">
            @if(session('success'))
            <div class="mb-6 p-4 bg-green-400 border-4 border-black font-black uppercase shadow-neo animate-bounce">
                {{ session('success') }}
            </div>
            @endif

            <header class="flex justify-between items-center mb-10">
                <h2 class="text-4xl font-black uppercase italic tracking-tighter">Dashboard</h2>
                <div class="flex gap-4">
                    <button onclick="toggleModal('clientModal')" class="bg-white text-black border-4 border-black px-6 py-2 font-bold shadow-neo hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">
                        + CLIENT
                    </button>
                    <a href="/projects/create" class="bg-black text-white border-4 border-black px-6 py-2 font-black uppercase shadow-[4px_4px_0px_0px_rgba(59,130,246,1)] hover:shadow-none transition-all">
                        + NEW PROJECT
                    </a>
                </div>
                <div class="mt-auto pt-10">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="w-full flex items-center gap-3 p-3 border-4 border-transparent hover:border-black hover:bg-red-400 transition-all font-black group">
            <i data-lucide="log-out" class="w-5 h-5"></i>
            <span>LOGOUT</span>
        </button>
    </form>
</div>
            </header>
@if($pendingOrders->count() > 0)
<div class="mb-12">
    <div class="flex justify-between items-end mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-black flex items-center justify-center shadow-[4px_4px_0px_0px_rgba(255,255,255,1)]">
                <span class="text-white font-black text-xl italic">!</span>
            </div>
            <h3 class="text-2xl font-black uppercase italic tracking-tighter text-black">Incoming Requests ({{ $pendingOrders->count() }})</h3>
        </div>
        
        @if($pendingOrders->count() > 3)
            <span class="text-[10px] font-black bg-black text-white px-2 py-1 uppercase animate-bounce">Scroll to see more ➔</span>
        @endif
    </div>

    <div class="grid grid-cols-1 gap-4 max-h-[600px] overflow-y-auto pr-2 custom-scrollbar">
        @foreach($pendingOrders as $order)
        <div class="bg-[#FFE100] border-4 border-black p-5 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="bg-black text-white text-[8px] font-black px-1.5 py-0.5 uppercase">New</span>
                        <h4 class="text-lg font-black uppercase leading-tight">{{ \Illuminate\Support\Str::limit($order->title, 35) }}</h4>
                    </div>
                    <p class="text-[11px] font-bold uppercase opacity-80">
                        Client: <span class="underline">{{ $order->client->name }}</span> | 
                        Budget: <span class="text-green-800">IDR {{ number_format($order->budget, 0, ',', '.') }}</span>
                    </p>
                </div>

                <div class="flex gap-2">
                    <button onclick="alert('Brief: {{ addslashes($order->notes) }}')" class="bg-white border-2 border-black px-3 py-1.5 font-black text-[10px] uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-none transition-all">
                        Detail
                    </button>
                    
                    <form action="/projects/{{ $order->id }}/approve" method="POST">
                        @csrf
                        <button type="submit" class="bg-[#bef264] border-2 border-black px-3 py-1.5 font-black text-[10px] uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-none transition-all">
                            Approve
                        </button>
                    </form>

                    <form action="/projects/{{ $order->id }}/reject" method="POST">
                        @csrf
                        <button type="submit" class="bg-[#fca5a5] border-2 border-black px-3 py-1.5 font-black text-[10px] uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-none transition-all">
                            Reject
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endif
            <div class="grid grid-cols-3 gap-6 mb-12">
                <div class="bg-white border-4 border-black p-6 shadow-neo-lg">
                    <p class="font-bold uppercase text-gray-400 text-sm">Total Revenue</p>
                    <h3 class="text-3xl font-black mt-2 leading-none">
                        IDR {{ number_format($totalRevenue / 1000000, 1) }}M
                    </h3>
                </div>

                <div class="bg-white border-4 border-black p-6 shadow-neo-lg">
                    <p class="font-bold uppercase text-gray-400 text-sm">Active Projects</p>
                    <h3 class="text-3xl font-black mt-2 leading-none">
                        {{ $activeProjectsCount }}
                    </h3>
                </div>

                <div class="bg-white border-4 border-black p-6 shadow-neo-lg border-b-8">
                    <p class="font-bold uppercase text-gray-400 text-sm">Total Clients</p>
                    <h3 class="text-3xl font-black mt-2 leading-none">
                        {{ count($clients) }}
                    </h3>
                </div>
            </div>
            <div class="mt-12">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-black uppercase italic underline decoration-blue-400 decoration-4">Active Projects</h3>
                </div>
                
                <div class="grid grid-cols-2 gap-6">
                    
            @forelse($projects as $project)
                <div class="bg-white border-4 border-black p-6 shadow-neo hover:-translate-x-1 hover:-translate-y-1 transition-all group relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-2 bg-blue-400 border-b-2 border-black"></div>

                    <div class="flex justify-between items-start mb-4 mt-2">
                        <div class="flex items-center gap-2 px-2 py-1 bg-black text-white text-[10px] font-black uppercase">
                            <i data-lucide="loader" class="w-3 h-3 animate-spin"></i>
                            {{ $project->status }}
                        </div>
                        <p class="font-black text-xl tracking-tighter text-blue-600">
                            IDR {{ number_format($project->budget/1000, 0) }}K
                        </p>
                    </div>
                    
                    <h4 class="text-2xl font-black mb-1 uppercase leading-none">{{ $project->title }}</h4>
                    <div class="flex items-center gap-1 text-sm font-bold text-gray-500 mb-6">
                        <i data-lucide="building-2" class="w-4 h-4"></i>
                        {{ $project->client->name }}
                    </div>
                    
                    <div class="pt-4 border-t-4 border-dotted border-black flex justify-between items-center text-[10px] font-black uppercase tracking-widest">
                        <div class="flex items-center gap-1">
                            <i data-lucide="calendar" class="w-3 h-3"></i>
                            BY {{ \Carbon\Carbon::parse($project->deadline)->format('d M') }}
                        </div>
                        <a href="/projects/{{ $project->id }}" class="bg-yellow-300 border-2 border-black px-4 py-1 font-black text-[10px] uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-none transition-all inline-block">
                            MANAGE
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-2 p-10 border-4 border-dashed border-black text-center font-bold italic text-gray-400">
                    No projects found.
                </div>
            @endforelse
        </div>
            
        </div>
            <div id="clients-table" class="mt-12">
                <h3 class="text-2xl font-black uppercase mb-6 italic underline decoration-yellow-400 decoration-4">Recent Clients</h3>
                <div class="bg-white border-4 border-black shadow-neo-lg overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead class="border-b-4 border-black bg-yellow-300 text-sm uppercase">
                            <tr>
                                <th class="p-4 font-black border-r-2 border-black">Name</th>
                                <th class="p-4 font-black border-r-2 border-black">Company</th>
                                <th class="p-4 font-black">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clients as $client)
                            <tr class="border-b-2 border-black hover:bg-gray-50 transition-colors">
                                <td class="p-4 font-bold border-r-2 border-black">{{ $client->name }}</td>
                                <td class="p-4 border-r-2 border-black">{{ $client->company ?? '-' }}</td>
                                <td class="p-4">
                                    <form action="/clients/{{ $client->id }}" method="POST" onsubmit="return confirm('Hapus client ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-black uppercase text-red-500 hover:underline">
                                            [ REMOVE ]
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="p-10 text-center font-bold italic text-gray-400">
                                    No clients found. Click "+ NEW CLIENT" to start.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="projectModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50">
    <div class="bg-white border-4 border-black p-8 w-full max-w-md shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] relative">
        <button onclick="toggleModal('projectModal')" class="absolute top-4 right-4 font-black text-2xl hover:text-red-500">✕</button>
        
        <h3 class="text-2xl font-black uppercase mb-6">Create New Project</h3>
        
        <form action="/projects" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block font-black uppercase text-sm mb-1">Select Client</label>
                <select name="client_id" required class="w-full border-4 border-black p-2 font-bold focus:bg-blue-50 outline-none appearance-none cursor-pointer">
                    <option value="">-- Choose Client --</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->company }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-black uppercase text-sm mb-1">Project Title</label>
                <input type="text" name="title" required class="w-full border-4 border-black p-2 font-bold focus:bg-blue-50 outline-none">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-black uppercase text-sm mb-1">Budget (Rp)</label>
                    <input type="number" name="budget" required class="w-full border-4 border-black p-2 font-bold focus:bg-blue-50 outline-none">
                </div>
                <div>
                    <label class="block font-black uppercase text-sm mb-1">Deadline</label>
                    <input type="date" name="deadline" required class="w-full border-4 border-black p-2 font-bold focus:bg-blue-50 outline-none">
                </div>
            </div>
            
            <button type="submit" class="w-full bg-blue-400 border-4 border-black py-3 font-black uppercase shadow-neo hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all mt-4">
                LAUNCH PROJECT 🚀
            </button>
        </form>
    </div>
</div>
        </main>
    </div>

<div id="clientModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white border-4 border-black p-8 w-full max-w-md shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] relative">
        <button onclick="toggleModal()" class="absolute top-4 right-4 font-black text-2xl hover:text-red-500">✕</button>
        
        <h3 class="text-2xl font-black uppercase mb-6">Add New Client</h3>
        
        <form action="/clients" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block font-black uppercase text-sm mb-1">Full Name</label>
                <input type="text" name="name" required class="w-full border-4 border-black p-2 font-bold focus:bg-yellow-50 outline-none">
            </div>
            <div>
                <label class="block font-black uppercase text-sm mb-1">Email Address</label>
                <input type="email" name="email" required class="w-full border-4 border-black p-2 font-bold focus:bg-yellow-50 outline-none">
            </div>
            <div>
                <label class="block font-black uppercase text-sm mb-1">Company Name</label>
                <input type="text" name="company" class="w-full border-4 border-black p-2 font-bold focus:bg-yellow-50 outline-none">
            </div>
            
            <button type="submit" class="w-full bg-green-400 border-4 border-black py-3 font-black uppercase shadow-neo hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all mt-4">
                SAVE CLIENT
            </button>
        </form>
    </div>
</div>


<script>
    // Inisialisasi Lucide Icons
    lucide.createIcons();
    
    // Fungsi toggle modal yang tadi
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.toggle('hidden');
    }
</script>

</body>
</html>