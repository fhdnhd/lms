<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi E-learning KPPS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: url("bg.jpg");
            background-attachment: fixed;
            min-height: 100vh;
            background-size: cover;
        }
        .menu-card {
            transition: all 0.3s ease;
        }
        .menu-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        .number-badge {
            transition: all 0.3s ease;
        }
        .menu-card:hover .number-badge {
            transform: scale(1.1);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .bounce { animation: bounce 0.6s; }
        .fade-in { animation: fadeIn 0.5s ease-out; }
        .home-button {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1000;
        }
    </style>
</head>
<body class="min-h-screen">

    {{-- KONDISI UNTUK MENAMPILKAN SPLASH-SCREEN ATAU LOGIN-PAGE --}}
    {{-- Tampil jika tidak ada error dari login atau register, dan tidak ada data input lama --}}
    <div id="splash-screen" class="@unless($errors->any() || old('nik')) min-h-screen flex @else hidden @endunless items-center justify-center p-4">
        <div class="w-full max-w-4xl flex flex-col md:flex-row items-center justify-center space-y-8 md:space-y-0 md:space-x-8 gap-4">
            <div class="md:w-1/2 flex items-center justify-center">
                <img src="hero.png" alt="Hero Image" class="w-3/4 h-auto">
            </div>
            <div class="bg-white rounded-2xl p-8 w-full max-w-md shadow-2xl">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang</h1>
                    <p class="text-gray-600">Silakan pilih untuk melanjutkan</p>
                </div>
                <div class="space-y-4">
                    <button id="loginBtn" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        <span>Masuk</span>
                    </button>
                    <button id="registerBtn" class="w-full bg-transparent border-2 border-yellow-500 hover:border-yellow-600 hover:bg-yellow-50 text-yellow-500 hover:text-yellow-600 font-semibold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        <span>Daftar</span>
                    </button>
                </div>
                <div class="text-center mt-8">
                    <p class="text-gray-500 text-sm">Dengan melanjutkan, Anda menyetujui syarat dan ketentuan kami</p>
                </div>
            </div>
        </div>
    </div>

    {{-- KONDISI UNTUK MENAMPILKAN HALAMAN LOGIN --}}
    {{-- Tampil jika ada error dari login atau ada data input lama --}}
    <div id="login-page" class="@unless($errors->has('nik') || old('nik') || $errors->has('password')) hidden @else min-h-screen flex @endunless items-center justify-center p-4 fade-in">
        <div class="absolute top-8 left-8">
            <button onclick="showView('splash-screen')" class="bg-white text-gray-800 rounded-full p-3 shadow-lg hover:bg-gray-200 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </button>
        </div>
        <div class="w-full max-w-md mx-auto bg-white rounded-2xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Masuk</h1>
                <p class="text-gray-600">Masuk ke akun Anda</p>
            </div>
            <form  method="POST" class="space-y-6" action="{{ route('login') }}">
                @csrf
                <div>
                    <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                    <input type="tel" id="nik" name="nik" placeholder="Nomor Induk Kependudukan" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition duration-200" required>
                    <x-input-error :messages="$errors->get('nik')" class="mt-2" />
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition duration-200" required>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div>
                    <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
                </div>
                {{-- @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif --}}
                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 transform hover:scale-105">Masuk</button>
            </form>
        </div>
    </div>

    {{-- KONDISI UNTUK MENAMPILKAN HALAMAN REGISTER --}}
    {{-- Tampil jika ada error dari register --}}
    <div id="register-page" class="@unless($errors->has('name') || $errors->has('email') || $errors->has('password_confirmation')) hidden @else min-h-screen flex @endunless items-center justify-center p-4 fade-in">
        <div class="absolute top-8 left-8">
            <button onclick="showView('splash-screen')" class="bg-white text-gray-800 rounded-full p-3 shadow-lg hover:bg-gray-200 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </button>
        </div>
        <div class="w-full max-w-7xl">
            <div class="flex justify-center">
                <div class="bg-white rounded-2xl p-8 shadow-2xl border-2 border-red-800 w-full">
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">Daftar</h1>
                    </div>
                    <form  method="POST" action="{{ route('register') }}">
                        @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                        <div>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                    <input id="name" type="text" name="name" class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" placeholder="Masukkan nama lengkap" required>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                                    <input id="nik" type="text" name="nik" maxlength="16" class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" placeholder="Nomor Induk Kependudukan" maxlength="16" required>
                                    <x-input-error :messages="$errors->get('nik')" class="mt-2" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                                    <textarea id="alamat" name="alamat" class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-border-transparent transition-all duration-200" placeholder="Alamat lengkap" rows="2" required></textarea>
                                    <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">No. TPS</label>
                                        <input id="tps" type="text" name="tps" class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" placeholder="Nomor TPS" required>
                                        <x-input-error :messages="$errors->get('tps')" class="mt-2" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Desa/Kel</label>
                                        <input id="desa" type="text" name="desa" class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" placeholder="Desa/Kelurahan" required>
                                        <x-input-error :messages="$errors->get('desa')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                                        <input id="kecamatan" type="text" name="kecamatan" class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" placeholder="Kecamatan" required>
                                        <x-input-error :messages="$errors->get('kecamatan')" class="mt-2" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kab/Kota</label>
                                        <input id="kabupaten" type="text" name="kabupaten" class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" placeholder="Kabupaten/Kota" required>
                                        <x-input-error :messages="$errors->get('kabupaten')" class="mt-2" />
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                                    <input id="provinsi" type="text" name="provinsi" class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" placeholder="Provinsi" required>
                                    <x-input-error :messages="$errors->get('provinsi')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input id="email" type="email" name="email" class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" placeholder="Alamat email" required>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">No WA</label>
                                    <input id="no_wa" type="text" name="no_wa" class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" placeholder="Nomor WhatsApp" required>
                                    <x-input-error :messages="$errors->get('no_wa')" class="mt-2" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                    <input id="password" type="password" name="password" class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" placeholder="Buat password" required>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                                    <input id="password_confirmation" id="password_confirmation" type="password" name="password_confirmation" class="input-focus w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200" placeholder="Konfirmasi password" required>
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 text-yellow-600 focus:ring-yellow-500" required>
                                    <span class="ml-2 text-sm text-gray-600">Saya setuju dengan <a href="#" class="text-yellow-600 hover:text-yellow-800">Syarat dan Ketentuan</a></span>
                                </div>
                                <button type="submit" class="btn-hover w-full text-white py-3 px-4 rounded-lg font-medium transition-all duration-200 bg-yellow-500 hover:bg-yellow-600">Buat Akun</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const views = ['splash-screen', 'login-page', 'register-page'];

        function showView(viewId) {
            views.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.classList.add('hidden');
                    element.classList.remove('min-h-screen', 'flex');
                }
            });
            
            const targetElement = document.getElementById(viewId);
            if (targetElement) {
                targetElement.classList.remove('hidden');
                targetElement.classList.add('min-h-screen', 'flex');
            }
        }

        // Tampilkan halaman yang sesuai saat halaman dimuat
        document.addEventListener('DOMContentLoaded', (event) => {
            const hasLoginError = {{ $errors->has('nik') || $errors->has('password') ? 'true' : 'false' }};
            const hasRegisterError = {{ $errors->has('name') || $errors->has('email') || $errors->has('password_confirmation') ? 'true' : 'false' }};

            if (hasLoginError) {
                showView('login-page');
            } else if (hasRegisterError) {
                showView('register-page');
            }
        });
        
        document.getElementById('loginBtn').addEventListener('click', () => showView('login-page'));
        document.getElementById('registerBtn').addEventListener('click', () => showView('register-page'));

        function handleLogin(event) {
            event.preventDefault();
            alert('Masuk berhasil! Mengarahkan ke menu utama.');
            showView('main-menu');
        }

        function handleRegister(event) {
            event.preventDefault();
            alert('Pendaftaran berhasil! Selamat datang di platform kami.');
            showView('main-menu');
        }
    </script>
</body>
</html>