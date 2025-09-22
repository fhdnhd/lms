<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS KPU untuk KPPS - Siap Sukseskan Pemilu!</title>
    
    @vite('resources/css/app.css')
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        /* CSS tambahan untuk background image */
        .hero-background {
            background-image: url("{{ asset('hero-bg.webp') }}"); /* Ganti dengan URL gambar Anda */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="bg-gray-50 font-poppins text-gray-800">

    <section class="relative min-h-screen flex items-center justify-center overflow-hidden text-white hero-background">
        <div class="absolute inset-0 bg-gradient-to-br from-red-700 to-red-900 opacity-80 z-0"></div>
        
        <div class="relative z-10 text-center max-w-4xl mx-auto px-6 py-12 md:px-12">
            <img src="{{asset('hero.png')}}" alt="Logo KPU" class="mx-auto h-32 md:h-48 mb-6 transition-all duration-300 transform hover:scale-110">

            <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold mb-4 leading-tight">
                Selamat Datang, Pejuang Demokrasi!
            </h1>
            <p class="text-lg md:text-xl lg:text-2xl font-light mb-8 opacity-90">
                LMS KPU hadir untuk membekali Anda, para **Anggota KPPS**, dengan pengetahuan dan keterampilan terbaik demi suksesnya Pemilihan Umum.
            </p>

           <a href="{{route('login')}}" class="inline-flex items-center space-x-2 bg-white text-red-600 font-bold text-lg py-3 px-8 rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 hover:bg-gray-100">
    <span>Mulai Belajar Sekarang</span>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
      <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
    </svg>
</a>
        </div>
    </section>

    

    <footer class="py-8 text-center text-gray-500 text-sm">
        <p>&copy; 2025 KPU Republik Indonesia - Hanif Purwanto . Hak Cipta Dilindungi.</p>
    </footer>

</body>
</html>