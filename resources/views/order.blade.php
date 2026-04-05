<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Services - FREELANCE OS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
    /* CSS Standard agar tidak butuh Vite */
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    .animate-marquee {
        display: flex;
        animation: marquee 3s linear infinite !important;
        width: max-content;
    }

    .absolute { position: absolute; }
    .inset-0 { top: 0; right: 0; bottom: 0; left: 0; }
    .overflow-hidden { overflow: hidden; }
    .group:hover .group-hover\:opacity-0 { opacity: 0; }
    .group:hover .group-hover\:opacity-100 { opacity: 1; }
    .transition-opacity { transition: opacity 0.3s ease; }
    .whitespace-nowrap { white-space: nowrap; }
    .flex { display: flex; }
    .items-center { align-items: center; }
</style>
</head>
<body class="bg-white text-black antialiased">
    <nav class="p-6 flex justify-between items-center border-b-4 border-black bg-white">
    <h1 class="text-2xl font-black italic tracking-tighter text-black">FREELANCE OS.</h1>
    
    @auth
        <a href="{{ route('dashboard') }}" 
           class="px-8 py-3 bg-[#22C55E] text-black border-4 border-black font-black uppercase tracking-tighter text-sm 
                  shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[6px] hover:translate-y-[6px] transition-all duration-150">
            DASHBOARD
        </a>
    @else
    <a href="{{ route('login') }}" 
       style="width: 260px; height: 56px; background-color: #000; border: 4px solid #000; display: inline-flex; position: relative; overflow: hidden; align-items: center; justify-content: center; text-decoration: none; transition: all 0.15s ease-in-out; cursor: pointer; box-shadow: 6px 6px 0px 0px #22C55E;"
       onmouseover="this.style.boxShadow='none'; this.style.transform='translate(6px, 6px)';"
       onmouseout="this.style.boxShadow='6px 6px 0px 0px #22C55E'; this.style.transform='translate(0, 0)';"
       class="group flex-shrink-0">
        
        <span style="color: #22C55E; font-family: sans-serif; font-weight: 900; text-transform: uppercase; font-size: 10px; letter-spacing: 0.2em; z-index: 10;"
              class="group-hover:opacity-0 transition-opacity duration-300">
            ADMIN ACCESS 🔑
        </span>
        
        <div class="absolute inset-0 flex items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 overflow-hidden" style="background-color: #000;">
            <div class="animate-marquee whitespace-nowrap flex" style="color: #22C55E;">
                <span style="font-weight: 900; text-transform: uppercase; font-size: 10px; margin: 0 16px;">● LOGIN NOW ● ADMIN ONLY ● SYSTEM ACTIVE</span>
                <span style="font-weight: 900; text-transform: uppercase; font-size: 10px; margin: 0 16px;">● LOGIN NOW ● ADMIN ONLY ● SYSTEM ACTIVE</span>
            </div>
        </div>
    </a>
@endauth
</nav>

<style>
@keyframes marquee {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.animate-marquee {
    display: flex;
    animation: marquee 3s linear infinite;
}
</style>

    <div class="max-w-4xl mx-auto py-20 px-6">
        <div class="text-center mb-16">
            <h2 class="text-6xl font-black uppercase italic leading-none mb-4">Scale Your Business <br><span class="text-pink-500 underline">With Digital Art.</span></h2>
            <p class="text-xl font-medium text-gray-600">Kirimkan brief project kamu, dan biarkan kami mengerjakannya.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-400 border-4 border-black p-4 mb-10 font-black uppercase shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                {{ session('success') }}
            </div>
        @endif

        <form action="/order/submit" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-[#F0F0F0] border-8 border-black p-10 shadow-[20px_20px_0px_0px_rgba(0,0,0,1)]">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label class="block font-black uppercase text-xs">Your Name</label>
                    <input type="text" name="client_name" class="w-full border-4 border-black p-4 font-bold outline-none focus:bg-white" placeholder="John Doe" required>
                </div>
                <div>
                    <label class="block font-black uppercase text-xs">Email Address</label>
                    <input type="email" name="email" class="w-full border-4 border-black p-4 font-bold outline-none focus:bg-white" placeholder="john@example.com" required>
                </div>
                <div>
                    <label class="block font-black uppercase text-xs">Estimated Budget (IDR)</label>
                    <input type="number" name="budget" class="w-full border-4 border-black p-4 font-bold outline-none focus:bg-white" placeholder="5000000" required>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block font-black uppercase text-xs">Project Interest</label>
                    <input type="text" name="project_title" class="w-full border-4 border-black p-4 font-bold outline-none focus:bg-white" placeholder="e.g. UI/UX Design" required>
                </div>
                <div>
                    <label class="block font-black uppercase text-xs">Company Name</label>
                    <input type="text" name="company" class="w-full border-4 border-black p-4 font-bold focus:bg-white outline-none" placeholder="Optional">
                </div>
                <div>
                    <label class="block font-black uppercase text-xs">Desired Deadline</label>
                    <input type="date" name="deadline" class="w-full border-4 border-black p-4 font-bold outline-none focus:bg-white" required>
                </div>
            </div>

            <div class="md:col-span-2">
                <label class="block font-black uppercase text-xs">Brief / Requirements</label>
                <textarea name="brief" rows="4" class="w-full border-4 border-black p-4 font-bold outline-none focus:bg-white" placeholder="Tell us about your project..." required></textarea>
            </div>

            <button type="submit" class="md:col-span-2 bg-black text-white p-6 font-black uppercase text-2xl hover:bg-pink-500 hover:shadow-none shadow-[8px_8px_0px_0px_rgba(236,72,153,1)] transition-all">
                Submit Order 🚀
            </button>
        </form>
    </div>
</body>
</html>