<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit: {{ $project->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F0F0F0] p-10">
    <div class="max-w-2xl mx-auto">
        <a href="/projects/{{ $project->id }}" class="font-black uppercase mb-6 inline-block hover:underline">← Back to Details</a>
        
        <div class="bg-white border-8 border-black p-8 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)]">
            <h2 class="text-3xl font-black uppercase italic mb-8 border-b-4 border-black pb-2">Edit Project</h2>

            <form action="/projects/{{ $project->id }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-black uppercase text-xs mb-2">Project Title</label>
                    <input type="text" name="title" value="{{ $project->title }}" class="w-full border-4 border-black p-3 font-bold focus:bg-yellow-50 outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-black uppercase text-xs mb-2">Budget (IDR)</label>
                        <input type="number" name="budget" value="{{ $project->budget }}" class="w-full border-4 border-black p-3 font-bold focus:bg-yellow-50 outline-none">
                    </div>
                    <div>
                        <label class="block font-black uppercase text-xs mb-2">Deadline</label>
                        <input type="date" name="deadline" value="{{ $project->deadline }}" class="w-full border-4 border-black p-3 font-bold focus:bg-yellow-50 outline-none">
                    </div>
                    <div>
                        <label class="block font-black uppercase text-xs mb-2">Project Notes (Links, Docs, etc.)</label>
                        <textarea name="notes" rows="5" class="w-full border-4 border-black p-3 font-bold focus:bg-yellow-50 outline-none placeholder:text-gray-300" placeholder="Paste link Figma, Brief, atau catatan di sini...">{{ $project->notes }}</textarea>
                    </div>
                </div>

                <div>
                    <label class="block font-black uppercase text-xs mb-2">Status</label>
                    <select name="status" class="w-full border-4 border-black p-3 font-bold focus:bg-yellow-50 outline-none">
                        <option value="pending" {{ $project->status == 'pending' ? 'selected' : '' }}>PENDING</option>
                        <option value="ongoing" {{ $project->status == 'ongoing' ? 'selected' : '' }}>ONGOING</option>
                        <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>COMPLETED</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-black text-white p-4 font-black uppercase text-xl shadow-[8px_8px_0px_0px_rgba(59,130,246,1)] hover:shadow-none transition-all">
                    Save Changes
                </button>
            </form>
        </div>
    </div>
</body>
</html>