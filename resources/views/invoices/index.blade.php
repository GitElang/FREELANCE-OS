<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoices - Freelance OS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .shadow-neo { shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]; }
        @keyframes bounce-short {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}
.animate-bounce-short {
    animation: bounce-short 0.5s ease-in-out;
}
    </style>
</head>
<body class="bg-[#F0F0F0] text-black">

    <div class="flex min-h-screen">
        <aside class="w-64 border-r-4 border-black bg-white p-6 flex flex-col">
            <h1 class="text-2xl font-black italic tracking-tighter mb-10">FREELANCE OS</h1>
            <nav class="space-y-4 flex-1">
                <a href="/" class="flex items-center gap-3 p-3 border-4 border-transparent hover:border-black hover:bg-white hover:shadow-neo transition-all font-black group">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    <span>DASHBOARD</span>
                </a>
                <a href="/invoices" class="flex items-center gap-3 p-3 border-4 border-black bg-green-400 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] font-black group">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                    <span>INVOICES</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 p-10">
            <header class="mb-10">
                <h2 class="text-4xl font-black uppercase italic tracking-tighter underline decoration-green-400 decoration-8">Ready to Bill</h2>
                <p class="font-bold text-gray-500 mt-2">Daftar project yang sudah selesai dan siap ditagihkan ke client.</p>
            </header>
@if(session('success'))
    <div class="mb-6 bg-green-400 border-4 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex justify-between items-center animate-bounce-short">
        <div class="flex items-center gap-3">
            <i data-lucide="check-circle" class="w-6 h-6"></i>
            <span class="font-black uppercase tracking-tight">{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="font-black hover:scale-125 transition-transform">✕</button>
    </div>
@endif

@if(session('error'))
    <div class="mb-6 bg-red-400 border-4 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex justify-between items-center">
        <div class="flex items-center gap-3">
            <i data-lucide="alert-triangle" class="w-6 h-6"></i>
            <span class="font-black uppercase tracking-tight">{{ session('error') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="font-black hover:scale-125 transition-transform">✕</button>
    </div>
@endif
            <div class="grid gap-6">
                @forelse($completedProjects as $project)
    <div class="bg-white border-4 border-black p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex justify-between items-center hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">
        <div>
            <span class="text-[10px] font-black {{ $project->status == 'done' ? 'bg-green-400 text-black' : 'bg-black text-white' }} px-2 py-0.5 uppercase tracking-widest border-2 border-black">
                {{ $project->status == 'done' ? 'Mission Accomplished' : 'Awaiting Finalization' }}
            </span>
            <h3 class="text-2xl font-black uppercase mt-1 {{ $project->status == 'done' ? 'line-through decoration-4' : '' }}">
                {{ $project->title }}
            </h3>
            <div class="flex items-center gap-2 text-sm font-bold text-gray-500">
                <i data-lucide="user" class="w-4 h-4"></i>
                {{ $project->client->name }} ({{ $project->client->company }})
            </div>
        </div>

        <div class="text-right">
            <p class="text-xs font-black text-gray-400 uppercase">Total Amount</p>
            <p class="text-2xl font-black text-green-600">IDR {{ number_format($project->budget, 0, ',', '.') }}</p>
            
            <div style="display: flex; gap: 8px; align-items: center; margin-top: 12px; justify-content: flex-end;">
                {{-- 1. Tombol Status / DELETE --}}
                @if($project->status !== 'done')
                    <form action="{{ route('invoices.done', $project->id) }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" 
                                style="background-color: #fde047; border: 4px solid #000; padding: 8px 16px; font-weight: 900; font-size: 12px; cursor: pointer; box-shadow: 4px 4px 0px 0px #000; transition: all 0.1s;"
                                onmouseover="this.style.boxShadow='none'; this.style.transform='translate(4px, 4px)';"
                                onmouseout="this.style.boxShadow='4px 4px 0px 0px #000'; this.style.transform='translate(0, 0)';"
                                class="flex items-center gap-2">
                            DONE?
                        </button>
                    </form>
                @else
                    <button onclick="confirmDelete('{{ $project->id }}', '{{ $project->title }}')" 
                            style="background-color: #ef4444; color: #fff; border: 4px solid #000; padding: 8px 16px; font-weight: 900; font-size: 12px; cursor: pointer; box-shadow: 4px 4px 0px 0px #000; transition: all 0.1s;"
                            onmouseover="this.style.boxShadow='none'; this.style.transform='translate(4px, 4px)';"
                            onmouseout="this.style.boxShadow='4px 4px 0px 0px #000'; this.style.transform='translate(0, 0)';"
                            class="flex items-center gap-2">
                        DELETE
                    </button>
                    <form id="delete-form-{{ $project->id }}" action="{{ route('invoices.destroy', $project->id) }}" method="POST" style="display: none;">
                        @csrf @method('DELETE')
                    </form>
                @endif

                {{-- 2. Tombol Send Email --}}
                <form action="/invoices/{{ $project->id }}/send" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" 
                            style="background-color: #60a5fa; border: 4px solid #000; padding: 8px 16px; font-weight: 900; font-size: 12px; cursor: pointer; box-shadow: 4px 4px 0px 0px #000; text-transform: uppercase;">
                        SEND EMAIL ✉️
                    </button>
                </form>

                {{-- 3. Tombol PDF --}}
                <a href="/invoices/{{ $project->id }}/download" 
                style="background-color: #000; color: #fff; border: 4px solid #000; padding: 8px 16px; font-weight: 900; font-size: 12px; text-decoration: none; box-shadow: 4px 4px 0px 0px #22c55e; display: inline-block;">
                    PDF
                </a>
            </div>
        </div>
    </div>
@empty
    @endforelse
            </div>
        </main>
    </div>

    <script>lucide.createIcons();</script>
</body>
<script>
    function confirmDelete(id, title) {
        Swal.fire({
            title: 'Pilih project yang ingin dihapus?',
            text: "Project '" + title + "' akan dihapus permanen dari sistem!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#000',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'YES, DELETE IT! 🗑️',
            cancelButtonText: 'CANCEL',
            // Styling Neo-Brutalism buat Alert
            customClass: {
                popup: 'border-8 border-black rounded-none shadow-[15px_15px_0px_0px_rgba(0,0,0,1)]',
                title: 'font-black uppercase italic',
                confirmButton: 'border-4 border-black font-black uppercase rounded-none',
                cancelButton: 'border-4 border-black font-black uppercase rounded-none'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
</html>