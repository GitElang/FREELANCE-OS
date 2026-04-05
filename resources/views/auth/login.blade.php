<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - FREELANCE OS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            background-color: #E5E5E5;
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23C0C0C0' fill-opacity='0.4' fill-rule='evenodd'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40H20L40 20'/%3E%3C/g%3E%3C/svg%3E");
            font-family: 'Plus Jakarta Sans', sans-serif;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: ''; position: absolute; top: -10%; left: -10%; width: 120%; height: 120%;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(236, 72, 153, 0.2) 0%, rgba(236, 72, 153, 0) 30%),
                radial-gradient(circle at 90% 80%, rgba(250, 204, 21, 0.2) 0%, rgba(250, 204, 21, 0) 30%),
                radial-gradient(circle at 50% 50%, rgba(96, 165, 250, 0.1) 0%, rgba(96, 165, 250, 0) 40%);
            filter: contrast(120%) brightness(110%); z-index: -1;
        }

        body::after {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 400 400' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
            opacity: 0.05; pointer-events: none; z-index: 0;
        }

        .neo-input {
            border: 4px solid black; padding: 1rem; font-weight: 800; outline: none;
            transition: all 0.2s ease; box-shadow: 2px 2px 0px 0px rgba(0,0,0,1);
        }

        .neo-input:focus {
            background-color: #FAFAFA;
            box-shadow: 6px 6px 0px 0px rgba(236, 72, 153, 1);
            transform: translate(-2px, -2px);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-6" x-data="{ showHint: false }">
    
    <div class="relative flex items-center md:items-start gap-0 md:gap-8">
        
        <div class="w-full max-w-md bg-white border-8 border-black p-10 shadow-[20px_20px_0px_0px_rgba(0,0,0,1)] relative z-20 transition-transform hover:scale-[1.01]">
            <h1 class="text-4xl font-black italic tracking-tighter mb-8 uppercase text-center underline decoration-pink-500 decoration-8">Admin Login</h1>

            @if($errors->any())
                <div class="bg-red-400 border-4 border-black p-3 mb-6 font-bold uppercase text-sm animate-pulse shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <form action="/login" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block font-black uppercase text-xs mb-2 tracking-widest">Admin Email</label>
                    <input type="email" name="email" class="w-full neo-input" required placeholder="admin@test.com">
                </div>
                <div>
                    <label class="block font-black uppercase text-xs mb-2 tracking-widest">Password</label>
                    <input type="password" name="password" class="w-full neo-input" required placeholder="••••••••">
                </div>
                <button type="submit" class="w-full bg-black text-white p-5 font-black uppercase text-2xl hover:bg-green-400 hover:text-black hover:shadow-none shadow-[10px_10px_0px_0px_rgba(34,197,94,1)] transition-all">
                    Enter Dashboard 🚀
                </button>
            </form>

            <button @click="showHint = !showHint" class="mt-6 block mx-auto font-black text-[10px] uppercase underline hover:text-pink-500 transition-colors tracking-widest">
                LUPA AKUN? / FORGET ACCOUNT
            </button>
        </div>

        <div x-show="showHint" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-x-10 scale-90"
             x-transition:enter-end="opacity-100 translate-x-0 scale-100"
             x-cloak
             class="absolute md:relative left-4 md:left-0 top-10 md:top-0 w-64 bg-yellow-300 border-8 border-black p-6 shadow-[15px_15px_0px_0px_rgba(0,0,0,1)] z-10">
            
            <div class="flex justify-between items-center mb-4 border-b-4 border-black pb-2">
                <h3 class="font-black uppercase text-lg italic">The Only Account</h3>
                <button @click="showHint = false" class="font-black text-xl hover:scale-125 transition-transform">✕</button>
            </div>
            
            <div class="space-y-4">
                <div>
                    <p class="text-[10px] font-black uppercase opacity-60">Email Address</p>
                    <p class="font-black text-sm">admin@test.com</p>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase opacity-60">Password</p>
                    <p class="font-black text-sm uppercase">password123</p>
                </div>
            </div>

            <div class="mt-6 bg-black text-white p-2 text-[9px] font-black uppercase text-center italic tracking-tighter">
                Keep it secret, keep it safe! 🤫
            </div>
        </div>

    </div>

    <style>[x-cloak] { display: none !important; }</style>
</body>
</html>