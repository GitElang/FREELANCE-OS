<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Project - Freelance OS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F0F0F0] p-10">
    <div class="max-w-3xl mx-auto">
        <a href="/" class="font-black uppercase mb-6 inline-block hover:underline">← Back to Dashboard</a>
        
        <div class="bg-white border-8 border-black p-10 shadow-[16px_16px_0px_0px_rgba(0,0,0,1)]">
            <h2 class="text-4xl font-black uppercase italic mb-8 border-b-4 border-black pb-4">Start New Project</h2>

            <form action="/projects" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label class="block font-black uppercase text-sm mb-2">Project Name</label>
                        <input type="text" name="title" placeholder="e.g. Redesign Landing Page" class="w-full border-4 border-black p-4 font-bold focus:bg-blue-50 outline-none shadow-neo" required>
                    </div>

                    <div>
                        <label class="block font-black uppercase text-sm mb-2">Select Client</label>
                        <select name="client_id" class="w-full border-4 border-black p-4 font-bold focus:bg-blue-50 outline-none shadow-neo" required>
                            <option value="">-- Choose Client --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-black uppercase text-sm mb-2">Budget (IDR)</label>
                        <input type="number" name="budget" placeholder="5000000" class="w-full border-4 border-black p-4 font-bold focus:bg-blue-50 outline-none shadow-neo" required>
                    </div>

                    <div class="col-span-2">
                        <label class="block font-black uppercase text-sm mb-2">Deadline Date</label>
                        <input type="date" name="deadline" class="w-full border-4 border-black p-4 font-bold focus:bg-blue-50 outline-none shadow-neo" required>
                    </div>
                </div>

                <div>
                    <label class="block font-black uppercase text-sm mb-2">Initial Notes & Resources</label>
                    <textarea name="notes" rows="6" placeholder="Paste Figma links, brief details, or project scope here..." class="w-full border-4 border-black p-4 font-bold focus:bg-blue-50 outline-none shadow-neo"></textarea>
                </div>

                <button type="submit" class="w-full bg-black text-white p-5 font-black uppercase text-2xl shadow-[8px_8px_0px_0px_rgba(59,130,246,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all mt-4">
                    CREATE PROJECT 🚀
                </button>
            </form>
        </div>
    </div>
</body>
</html>