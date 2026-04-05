<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage: {{ $project->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-[#F0F0F0] p-10">

    <div class="max-w-4xl mx-auto">
        <a href="/" class="inline-flex items-center gap-2 font-black uppercase mb-6 hover:underline">
            <i data-lucide="arrow-left" class="w-5 h-5"></i> Back to Dashboard
        </a>

        <div class="bg-white border-8 border-black p-10 shadow-[16px_16px_0px_0px_rgba(0,0,0,1)]">
            <div class="flex justify-between items-start border-b-4 border-black pb-6 mb-6">
                <div>
                    <h1 class="text-5xl font-black uppercase italic tracking-tighter">{{ $project->title }}</h1>
                    <p class="text-xl font-bold text-blue-600 uppercase mt-2 italic">Client: {{ $project->client->name }}</p>
                </div>
                <div class="bg-yellow-300 border-4 border-black px-4 py-2 font-black uppercase shadow-neo">
                    {{ $project->status }}
                </div>
            </div>

            <div class="grid grid-cols-2 gap-10">
                <div class="space-y-6">
                    <div>
                        <label class="block font-black uppercase text-sm text-gray-400">Total Budget</label>
                        <p class="text-3xl font-black tabular-nums">IDR {{ number_format($project->budget, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <label class="block font-black uppercase text-sm text-gray-400">Deadline Date</label>
                        <p class="text-3xl font-black uppercase italic">{{ \Carbon\Carbon::parse($project->deadline)->format('d F Y') }}</p>
                    </div>
                    <div class="mt-10 border-t-4 border-black pt-6">
                        <h3 class="font-black uppercase mb-4 flex items-center gap-2 text-xl">
                            <i data-lucide="sticky-note" class="w-6 h-6"></i> Project Notes
                        </h3>
                        <div class="bg-white border-4 border-black p-6 shadow-neo min-h-[150px] whitespace-pre-line">
                            @if($project->notes)
                                <div class="font-bold text-gray-700">
                                    {!! nl2br(e($project->notes)) !!}
                                </div>
                            @else
                                <p class="italic text-gray-400">Belum ada catatan untuk project ini.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 border-4 border-black p-6">
                    <h3 class="font-black uppercase mb-4 flex items-center gap-2">
                        <i data-lucide="check-square" class="w-5 h-5"></i> Quick Actions
                    </h3>
                    <div class="grid gap-3">
                    @if($project->status !== 'completed')
                        <form action="/projects/{{ $project->id }}/complete" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full bg-green-400 border-4 border-black p-2 font-black uppercase text-sm shadow-neo hover:shadow-none transition-all">
                                Mark as Completed ✅
                            </button>
                        </form>
                    @else
                        <div class="bg-gray-200 border-4 border-black p-2 font-black uppercase text-sm text-center italic text-gray-500">
                            Project Finished 🏆
                        </div>
                    @endif

                    <a href="/projects/{{ $project->id }}/edit" class="block w-full bg-white border-4 border-black p-2 font-black uppercase text-sm text-center shadow-neo hover:shadow-none transition-all">
                        EDIT DETAILS
                    </a>
                    <form action="/projects/{{ $project->id }}" method="POST" onsubmit="return confirm('Hapus project ini secara permanen?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-400 border-4 border-black p-2 font-black uppercase text-sm shadow-neo hover:shadow-none transition-all">
                            Delete Project
                        </button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
@if(session('success'))
    <div class="max-w-4xl mx-auto mt-4 bg-green-400 border-4 border-black p-4 font-black uppercase shadow-neo animate-bounce">
        {{ session('success') }}
    </div>
@endif
</html>