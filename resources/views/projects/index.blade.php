<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Projects - Freelance OS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#F0F0F0] text-black">

    <div class="flex min-h-screen">
        <aside class="w-64 border-r-4 border-black bg-white p-6 flex flex-col">
            <h1 class="text-2xl font-black italic tracking-tighter mb-10 text-center">FREELANCE OS</h1>
            <nav class="space-y-4 flex-1">
                <a href="/" class="flex items-center gap-3 p-3 border-4 border-transparent hover:border-black hover:bg-white hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all font-black group">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    <span>DASHBOARD</span>
                </a>
                <a href="/projects" class="flex items-center gap-3 p-3 border-4 border-black bg-pink-400 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] font-black group">
                    <i data-lucide="folder-kanban" class="w-5 h-5"></i>
                    <span>PROJECTS</span>
                </a>
                <a href="/invoices" class="flex items-center gap-3 p-3 border-4 border-transparent hover:border-black hover:bg-white hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all font-black group">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                    <span>INVOICES</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 p-10">
            <header class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-4xl font-black uppercase italic tracking-tighter underline decoration-pink-500 decoration-8">All Projects</h2>
                    <p class="font-bold text-gray-500 mt-2 italic text-sm">Manajemen seluruh portfolio dan pekerjaan kamu.</p>
                </div>

                <form action="/projects" method="GET" class="flex items-center gap-3">
                    <select name="client_id" onchange="this.form.submit()" class="border-4 border-black p-3 font-black uppercase text-xs shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] focus:bg-pink-50 outline-none cursor-pointer">
                        <option value="">-- All Clients --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects as $project)
                    <div class="bg-white border-4 border-black p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] relative group">
                        <div class="absolute -top-4 -right-2 px-3 py-1 border-4 border-black font-black uppercase text-[10px] 
                            {{ $project->status == 'completed' ? 'bg-green-400' : 'bg-yellow-300' }}">
                            {{ $project->status }}
                        </div>

                        <h3 class="text-2xl font-black uppercase mb-1">{{ $project->title }}</h3>
                        <p class="font-bold text-gray-400 mb-6 flex items-center gap-2 text-sm italic">
                            <i data-lucide="building" class="w-4 h-4 text-pink-500"></i> {{ $project->client->name }}
                        </p>

                        <div class="border-t-4 border-black pt-4 flex justify-between items-center">
                            <div>
                                <p class="text-[10px] font-black uppercase text-gray-400">Budget</p>
                                <p class="font-black text-lg">IDR {{ number_format($project->budget/1000000, 1) }}M</p>
                            </div>
                            <a href="/projects/{{ $project->id }}" class="bg-black text-white px-4 py-2 font-black text-[10px] shadow-[4px_4px_0px_0px_rgba(236,72,153,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all">
                                VIEW DETAILS
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 p-20 border-4 border-dashed border-black text-center font-black uppercase text-gray-400 italic">
                        No projects found.
                    </div>
                @endforelse
            </div>
        </main>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>