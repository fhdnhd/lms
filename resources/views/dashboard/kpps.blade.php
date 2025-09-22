@extends('layouts.app')

@push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: url("{{ asset('bg.jpg') }}");
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
            top: 2rem;       /* tetap di atas */
            left: 50%;       /* posisikan di tengah */
            transform: translateX(-50%);
            z-index: 1000;
        }
    </style>
@endpush

@section('content')
    
   
    <div id="main-menu" class="min-h-screen">
        <div class="container mx-auto px-6 py-8 fade-in">
            <div id="main-menu-content" class="max-w-6xl mx-auto">
                <div class="bg-white shadow rounded-lg p-6 mb-9 ">
                    Selamat datang di LMS KPU, {{ Auth::user()->name }} 👋
                </div>    
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-white mb-4">E-learning KPPS</h1>
                    <p class="text-lg text-white/80">Pelajari tentang Kelompok Penyelenggara Pemungutan Suara</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="menu-card bg-gradient-to-br from-red-400 to-pink-500 rounded-2xl p-6 text-white cursor-pointer relative overflow-hidden" onclick="showPretest('Pre Test')">
                        <div class="number-badge absolute -top-2 -right-2 bg-white text-red-500 w-12 h-12 rounded-full flex items-center justify-center font-bold text-xl shadow-lg">1</div>
                        <div class="mb-4">
                            <div class="text-6xl mb-4">👥</div>
                            <h3 class="text-2xl font-semibold mb-2">Pre-test</h3>
                            <p class="text-red-100 mb-4">Uji pengetahuan awal tentang KPPS</p>
                        </div>
                    </div>
                    <div class="menu-card bg-gradient-to-br from-orange-400 to-yellow-500 rounded-2xl p-6 text-white cursor-pointer relative overflow-hidden" onclick="showModuleMenu()">
                        <div class="number-badge absolute -top-2 -right-2 bg-white text-orange-500 w-12 h-12 rounded-full flex items-center justify-center font-bold text-xl shadow-lg">2</div>
                        <div class="mb-4">
                            <div class="text-6xl mb-4">📚</div>
                            <h3 class="text-2xl font-semibold mb-2">Modul Pembelajaran</h3>
                            <p class="text-orange-100 mb-4">Pelajari berbagai aspek tugas dan tanggung jawab KPPS</p>
                        </div>
                    </div>
                    <div class="menu-card bg-gradient-to-br from-green-400 to-emerald-500 rounded-2xl p-6 text-white cursor-pointer relative overflow-hidden" onclick="showPretest('Post Test')">
                        <div class="number-badge absolute -top-2 -right-2 bg-white text-green-500 w-12 h-12 rounded-full flex items-center justify-center font-bold text-xl shadow-lg">3</div>
                        <div class="mb-4">
                            <div class="text-6xl mb-4">❓</div>
                            <h3 class="text-2xl font-semibold mb-2">Post-test</h3>
                            <p class="text-green-100 mb-4">Uji pemahaman setelah belajar materi</p>
                        </div>
                    </div>
                    <div class="menu-card bg-gradient-to-br from-blue-400 to-indigo-500 rounded-2xl p-6 text-white cursor-pointer relative overflow-hidden" onclick="showCertificateMenu()">
                        <div class="number-badge absolute -top-2 -right-2 bg-white text-blue-500 w-12 h-12 rounded-full flex items-center justify-center font-bold text-xl shadow-lg">4</div>
                        <div class="mb-4">
                            <div class="text-6xl mb-4">🏅</div>
                            <h3 class="text-2xl font-semibold mb-2">Unduh Sertifikat</h3>
                            <p class="text-blue-100 mb-4">Dapatkan sertifikat setelah menyelesaikan Post-test</p>
                        </div>
                    </div>
                    <div></div>
                    <div class="menu-card bg-gradient-to-br from-purple-400 to-violet-500 rounded-2xl p-6 text-white cursor-pointer relative overflow-hidden" onclick="showStaticDisplay('kodeetik')">
                        <div class="number-badge absolute -top-2 -right-2 bg-white text-purple-500 w-12 h-12 rounded-full flex items-center justify-center font-bold text-xl shadow-lg">i</div>
                        <div class="mb-4">
                            <div class="text-6xl mb-4">📜</div>
                            <h3 class="text-2xl font-semibold mb-2">Kode Etik Penyelenggara</h3>
                            <p class="text-purple-100 mb-4">Pelajari prinsip-prinsip etika penyelenggara</p>
                        </div>
                    </div>
                    <div class="menu-card bg-gradient-to-br from-teal-400 to-cyan-500 rounded-2xl p-6 text-white cursor-pointer relative overflow-hidden" onclick="showStaticDisplay('faq')">
                        <div class="number-badge absolute -top-2 -right-2 bg-white text-teal-500 w-12 h-12 rounded-full flex items-center justify-center font-bold text-xl shadow-lg">i</div>
                        <div class="mb-4">
                            <div class="text-6xl mb-4">❓</div>
                            <h3 class="text-2xl font-semibold mb-2">FAQ</h3>
                            <p class="text-teal-100 mb-4">Temukan jawaban untuk pertanyaan umum</p>
                        </div>
                    </div>
                    <div></div>
                </div>
            </div>

            <div id="module-menu-new" class="hidden max-w-4xl mx-auto">
                <button onclick="showMainMenu()" 
    class="home-button rounded-full p-3 shadow-lg transition-colors
           bg-gradient-to-r from-yellow-400 to-yellow-600 
           hover:from-yellow-500 hover:to-yellow-700
           text-white border-2 border-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </button>
                <div class="flex items-center mb-8 fade-in">
                    <button onclick="showMainMenu()" class="bg-white hover:bg-gray-200 p-2 rounded-lg mr-4 transition-colors">
                        <span class="text-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="currentColor" d="M19 7v6c0 1.103-.896 2-2 2H3v-3h13V8H5v2L1 6.5L5 3v2h12a2 2 0 0 1 2 2z"/></svg>
                        </span>
                    </button>
                    <h1 class="text-3xl font-bold text-white">📚 Modul Pembelajaran</h1>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 fade-in">
                    <div class="menu-card bg-gradient-to-br from-red-400 to-pink-500 rounded-2xl p-6 text-white cursor-pointer relative overflow-hidden " onclick="showSubModules('pendahuluan')">
                        <div class="number-badge absolute -top-2 -right-2 bg-white text-red-500 w-12 h-12 rounded-full flex items-center justify-center font-bold text-xl shadow-lg">1</div>
                        <div class="mb-4">
                            <div class="text-6xl mb-4">📝</div>
                            <h3 class="text-2xl font-semibold mb-2">Modul 1</h3>
                            <p class="text-red-100 mb-4">Pendahuluan</p>
                        </div>
                    </div>
                    <div class="menu-card bg-gradient-to-br from-orange-400 to-yellow-500 rounded-2xl p-6 text-white cursor-pointer relative overflow-hidden" onclick="showSubModules('teknis')">
                        <div class="number-badge absolute -top-2 -right-2 bg-white text-orange-500 w-12 h-12 rounded-full flex items-center justify-center font-bold text-xl shadow-lg">2</div>
                        <div class="mb-4">
                            <div class="text-6xl mb-4">⚙️</div>
                            <h3 class="text-2xl font-semibold mb-2">Modul 2</h3>
                            <p class="text-orange-100 mb-4">Teknis Pemungutan dan Penghitungan Suara</p>
                        </div>
                    </div>
                    <div class="menu-card bg-gradient-to-br from-green-400 to-emerald-500 rounded-2xl p-6 text-white cursor-pointer relative overflow-hidden" onclick="showSubModules('konflik')">
                        <div class="number-badge absolute -top-2 -right-2 bg-white text-green-500 w-12 h-12 rounded-full flex items-center justify-center font-bold text-xl shadow-lg">3</div>
                        <div class="mb-4">
                            <div class="text-6xl mb-4">💥</div>
                            <h3 class="text-2xl font-semibold mb-2">Modul 3</h3>
                            <p class="text-green-100 mb-4">Gangguan Lapangan dan Penanganan Konflik</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="sub-modules-menu" class="hidden max-w-4xl mx-auto ">
                <button onclick="showMainMenu()" 
    class="home-button rounded-full p-3 shadow-lg transition-colors
           bg-gradient-to-r from-yellow-400 to-yellow-600 
           hover:from-yellow-500 hover:to-yellow-700
           text-white border-2 border-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </button>
                <div class="flex items-center mb-8 fade-in">
                    <button onclick="showModuleMenu()" class="bg-white hover:bg-gray-200 p-2 rounded-lg mr-4 transition-colors">
                        <span class="text-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="currentColor" d="M19 7v6c0 1.103-.896 2-2 2H3v-3h13V8H5v2L1 6.5L5 3v2h12a2 2 0 0 1 2 2z"/></svg>
                        </span>
                    </button>
                    <h1 id="sub-module-title" class="text-3xl font-bold text-white"></h1>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 fade-in" id="module-content">
                </div>
            </div>

            <div id="materi-display" class="hidden max-w-4xl mx-auto">
                <button onclick="showMainMenu()" 
    class="home-button rounded-full p-3 shadow-lg transition-colors
           bg-gradient-to-r from-yellow-400 to-yellow-600 
           hover:from-yellow-500 hover:to-yellow-700
           text-white border-2 border-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </button>
                <div class="flex items-center mb-8 fade-in">
                    <button id="back-to-materi-list-from-materi" onclick="showMateriListMenu(currentModuleKey, currentSubModuleKey)" class="bg-white hover:bg-gray-200 p-2 rounded-lg mr-4 transition-colors">
                        <span class="text-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="currentColor" d="M19 7v6c0 1.103-.896 2-2 2H3v-3h13V8H5v2L1 6.5L5 3v2h12a2 2 0 0 1 2 2z"/></svg>
                        </span>
                    </button>
                    <h1 id="materi-display-title" class="text-3xl font-bold text-white"></h1>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-8 fade-in">
                    <div id="materi-body" class="prose max-w-none"></div>
                    <div class="mt-8 flex justify-between space-x-4">
                        <button id="prev-materi" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-xl transition-all duration-300 transform hover:scale-105">Kembali</button>
                        <button id="next-materi" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-xl transition-all duration-300 transform hover:scale-105">Selanjutnya</button>
                    </div>
                </div>
            </div>

            <div id="materi-list-menu" class="hidden max-w-4xl mx-auto">
                <button onclick="showMainMenu()" 
    class="home-button rounded-full p-3 shadow-lg transition-colors
           bg-gradient-to-r from-yellow-400 to-yellow-600 
           hover:from-yellow-500 hover:to-yellow-700
           text-white border-2 border-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </button>
                <div class="flex items-center mb-8 fade-in">
                    <button id="back-to-sub" onclick="showSubModules(currentModuleKey)" class="bg-white hover:bg-gray-200 p-2 rounded-lg mr-4 transition-colors">
                        <span class="text-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="currentColor" d="M19 7v6c0 1.103-.896 2-2 2H3v-3h13V8H5v2L1 6.5L5 3v2h12a2 2 0 0 1 2 2z"/></svg>
                        </span>
                    </button>
                    <h1 id="materi-list-title" class="text-3xl font-bold text-white"></h1>
                </div>
                <div id="materi-list-container" class="space-y-4 fade-in">
                    </div>
            </div>
        </div>
    </div>
    
    <div id="static-display" class="hidden min-h-screen fade-in">
        <button onclick="showMainMenu()" 
    class="home-button rounded-full p-3 shadow-lg transition-colors
           bg-gradient-to-r from-yellow-400 to-yellow-600 
           hover:from-yellow-500 hover:to-yellow-700
           text-white border-2 border-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
        </button>
        <div class="container mx-auto px-6 py-8">
            <div class="flex items-center mb-8">
                <button onclick="showMainMenu()" class="bg-white hover:bg-gray-200 p-2 rounded-lg mr-4 transition-colors">
                    <span class="text-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="currentColor" d="M19 7v6c0 1.103-.896 2-2 2H3v-3h13V8H5v2L1 6.5L5 3v2h12a2 2 0 0 1 2 2z"/></svg>
                    </span>
                </button>
                <h1 id="static-title" class="text-3xl font-bold text-white"></h1>
            </div>
            <div id="static-content-body" class="bg-white rounded-xl shadow-lg p-8 space-y-4">
                </div>
        </div>
    </div>
    
    <div id="pretest-game" class="hidden min-h-screen">
        <button onclick="showMainMenu()" 
    class="home-button rounded-full p-3 shadow-lg transition-colors
           bg-gradient-to-r from-yellow-400 to-yellow-600 
           hover:from-yellow-500 hover:to-yellow-700
           text-white border-2 border-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
        </button>
        <div class="container mx-auto px-4 py-8">
            <div class="text-center mb-8">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" id="testTitle">Pre Test</h1>
                <div class="bg-white rounded-xl p-4 inline-block shadow-lg">
                    <div class="flex items-center justify-center text-gray-800">
                        <div class="text-center">
                            <div class="text-2xl font-bold" id="questionNumber">1/50</div>
                            <div class="text-sm opacity-80">Pertanyaan</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-4xl mx-auto fade-in">
                <div id="startScreen" class="text-center bg-white rounded-2xl p-8 mb-6 shadow-lg">
                    <img src="assets/icon/test-logo.png" alt="Pretest Banner" class="mx-auto mb-6 w-40 h-40 object-contain" />
                    <h2 class="text-3xl font-bold text-gray-800 mb-4" id="startTitle">Siap untuk Pre-test?</h2>
                    <p class="text-gray-600 mb-6 text-lg">Uji pengetahuan Anda dengan 10 pertanyaan menarik!</p>
                    <button onclick="startGame()" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-4 px-8 rounded-xl text-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Mulai Test
                    </button>
                </div>
                <div id="gameScreen" class="hidden">
                    <div class="bg-white rounded-2xl p-8 mb-6 fade-in shadow-lg">
                        <div class="mb-6">
                            <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                                <div id="progressBar" class="bg-yellow-500 h-3 rounded-full transition-all duration-500" style="width: 10%"></div>
                            </div>
                        </div>
                        <div class="text-center mb-8">
                            <h2 id="questionText" class="text-2xl md:text-3xl font-bold text-gray-800 mb-2"></h2>
                            <p class="text-gray-600">Pilih jawaban yang benar!</p>
                        </div>
                        <div id="optionsContainer" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6"></div>
                    </div>
                </div>
                <div id="resultScreen" class="hidden text-center bg-white rounded-2xl p-8 shadow-lg">
                    <div id="resultEmoji" class="mb-2 text-gray-800 flex justify-center items-center" style="height:180px;">
                        <!-- Gambar hasil akan diisi lewat JS -->
                    </div>
                    <h2 id="resultTitle" class="text-4xl font-bold text-gray-800 mb-4"></h2>
                    <div class="bg-gray-100 rounded-xl p-6 mb-6">
                        <div class="grid grid-cols-2 gap-4 text-gray-800">
                            <div class="text-center">
                                <div id="correctAnswers" class="text-3xl font-bold"></div>
                                <div class="text-sm opacity-80">Benar</div>
                            </div>
                            <div class="text-center">
                                <div id="accuracy" class="text-3xl font-bold"></div>
                                <div class="text-sm opacity-80">Presentasi</div>
                            </div>
                        </div>
                    </div>
                    <div class="space-x-4">
                        <button onclick="showMainMenu()" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105">
                            Kembali ke Menu Utama
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="certificate-menu" class="hidden min-h-screen flex items-center justify-center p-4">
    <button onclick="showMainMenu()" 
    class="home-button rounded-full p-3 shadow-lg transition-colors
           bg-gradient-to-r from-yellow-400 to-yellow-600 
           hover:from-yellow-500 hover:to-yellow-700
           text-white border-2 border-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </button>
    <div class="w-full max-w-2xl text-center bg-white rounded-2xl p-8 mb-6 fade-in shadow-lg">
        <div id="certificate-content" class="flex flex-col items-center space-y-4">
            </div>

        <button onclick="showMainMenu()" class="w-full max-w-xs bg-gray-700 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-300 hover:bg-gray-800 mt-4">
            Kembali ke Menu Utama
        </button>
    </div>
</div>

    {{-- <div id="certificate-menu" class="hidden min-h-screen flex items-center justify-center p-4">
        <button onclick="showMainMenu()" 
    class="home-button rounded-full p-3 shadow-lg transition-colors
           bg-gradient-to-r from-yellow-400 to-yellow-600 
           hover:from-yellow-500 hover:to-yellow-700
           text-white border-2 border-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
        </button>
        <div class="w-full max-w-2xl text-center bg-white rounded-2xl p-8 mb-6 fade-in shadow-lg">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Selamat!</h1>
            <p class="text-gray-600 text-lg mb-8">Anda telah menyelesaikan tes. Sertifikat Anda sudah siap!</p>
            <div class="flex flex-col items-center space-y-4">
                <button onclick="generateCertificate()" class="w-full max-w-xs bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    Unduh Sertifikat
                </button>
                <button onclick="showMainMenu()" class="w-full max-w-xs bg-gray-700 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-300 hover:bg-gray-800">
                    Kembali ke Menu Utama
                </button>
            </div>
        </div>
    </div> --}}
    
@endsection
@push('scripts')
<script src="{{ asset('materi-kuis.js') }}"></script>
<script>
        window.assetPath = "{{ asset('') }}";
        const views = ['main-menu', 'pretest-game', 'certificate-menu', 'module-menu-new', 'sub-modules-menu', 'materi-display', 'static-display', 'materi-list-menu'];
        let currentTestType = '';
        let currentMateriIndex = 0;
        let materiList = [];
        let currentSubModuleKey = '';
        let currentModuleKey = '';

        function showView(viewId) {
            views.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.classList.add('hidden');
                }
            });
            
            const targetElement = document.getElementById(viewId);
            if (targetElement) {
                targetElement.classList.remove('hidden');
            }
        }

        function showMainMenu() {
            document.getElementById('main-menu').classList.remove('hidden');
            document.getElementById('main-menu-content').classList.remove('hidden');
            document.getElementById('module-menu-new').classList.add('hidden');
            document.getElementById('sub-modules-menu').classList.add('hidden');
            document.getElementById('materi-display').classList.add('hidden');
            document.getElementById('pretest-game').classList.add('hidden');
            document.getElementById('certificate-menu').classList.add('hidden');
            document.getElementById('static-display').classList.add('hidden');
        }

        function showModuleMenu() {
            document.getElementById('main-menu-content').classList.add('hidden');
            document.getElementById('module-menu-new').classList.remove('hidden');
            document.getElementById('sub-modules-menu').classList.add('hidden');
            document.getElementById('materi-display').classList.add('hidden');
            document.getElementById('pretest-game').classList.add('hidden');
        }

        function showSubModules(moduleCategory) {
            currentModuleKey = moduleCategory;
            document.getElementById('module-menu-new').classList.add('hidden');
            document.getElementById('sub-modules-menu').classList.remove('hidden');
            document.getElementById('materi-display').classList.add('hidden');
            document.getElementById('materi-list-menu').classList.add('hidden');
            
            const data = moduleData[moduleCategory];
            document.getElementById('sub-module-title').textContent = data.title;
            const container = document.getElementById('module-content');
            container.innerHTML = '';
            
            Object.keys(data.subModules).forEach(subKey => {
                const sub = data.subModules[subKey];
                const div = document.createElement('div');
                let cardColor, numberColor, icon;
                if (moduleCategory === 'pendahuluan') {
                    cardColor = 'from-red-400 to-pink-500';
                    numberColor = 'text-red-500';
                    icon = '';
                } else if (moduleCategory === 'teknis') {
                    cardColor = 'from-orange-400 to-yellow-500';
                    numberColor = 'text-orange-500';
                    icon = '';
                } else if (moduleCategory === 'konflik') {
                    cardColor = 'from-green-400 to-emerald-500';
                    numberColor = 'text-green-500';
                    icon = '';
                }
                
                div.className = `menu-card bg-gradient-to-br ${cardColor} rounded-2xl p-6 text-white cursor-pointer relative overflow-hidden`;
                div.onclick = () => showMateriListMenu(moduleCategory, subKey);
                
                div.innerHTML = `
                    <div class="number-badge absolute -top-2 -right-2 bg-white ${numberColor} w-12 h-12 rounded-full flex items-center justify-center font-bold text-xl shadow-lg">
                        ${Object.keys(data.subModules).indexOf(subKey) + 1}
                    </div>
                    <div class="mb-4">
                        <div class="text-6xl mb-4">${icon}</div>
                        <h3 class="text-2xl font-semibold mb-2">${sub.title}</h3>
                        <p class="text-sm opacity-80 mb-4">${sub.materi.length} materi tersedia</p>
                    </div>
                `;
                container.appendChild(div);
            });
        }
        
        function showMateriListMenu(moduleCategory, subModule) {
            currentModuleKey = moduleCategory;
            currentSubModuleKey = subModule;
            materiList = moduleData[currentModuleKey].subModules[currentSubModuleKey].materi;
            
            document.getElementById('sub-modules-menu').classList.add('hidden');
            document.getElementById('materi-list-menu').classList.remove('hidden');
            document.getElementById('materi-display').classList.add('hidden');

            document.getElementById('materi-list-title').textContent = moduleData[currentModuleKey].subModules[currentSubModuleKey].title;
            document.getElementById('back-to-sub').onclick = () => showSubModules(currentModuleKey);
            
            const container = document.getElementById('materi-list-container');
            container.innerHTML = '';
            
            materiList.forEach((materi, index) => {
                const div = document.createElement('div');
                let cardColor, numberColor, icon;
                
                if (currentModuleKey === 'pendahuluan') {
                    cardColor = 'from-red-400 to-pink-500';
                    numberColor = 'text-red-500';
                    icon = '📝';
                } else if (currentModuleKey === 'teknis') {
                    cardColor = 'from-orange-400 to-yellow-500';
                    numberColor = 'text-orange-500';
                    icon = '⚙️';
                } else if (currentModuleKey === 'konflik') {
                    cardColor = 'from-green-400 to-emerald-500';
                    numberColor = 'text-green-500';
                    icon = '💥';
                }

                div.className = `menu-card bg-gradient-to-br ${cardColor} rounded-2xl p-6 text-white cursor-pointer relative overflow-hidden`;
                div.onclick = () => showSingleMateri(index);

                div.innerHTML = `
                    <div class="number-badge absolute -top-2 -right-2 bg-white ${numberColor} w-12 h-12 rounded-full flex items-center justify-center font-bold text-xl shadow-lg">
                        ${index + 1}
                    </div>
                    <div class="mb-4">
                        <h3 class="text-2xl font-semibold mb-2">${materi.title}</h3>
                        <p class="text-white opacity-80">${materi.content.substring(0, 50)}...</p>
                    </div>
                `;
                container.appendChild(div);
            });
        }

        function showSingleMateri(materiIndex) {
            currentMateriIndex = materiIndex;
            const materi = materiList[currentMateriIndex];
            const subTitle = moduleData[currentModuleKey].subModules[currentSubModuleKey].title;

            document.getElementById('materi-list-menu').classList.add('hidden');
            document.getElementById('materi-display').classList.remove('hidden');

            document.getElementById('materi-display-title').textContent = subTitle;
            
            const container = document.getElementById('materi-body');
            let contentHtml = '';
            if (materi.video) {
                contentHtml = `
                    <div class="mb-6">
                        <video id="materi-video" class="w-full rounded-xl shadow-lg" controls>
                            <source src="${materi.video.localVideo}" type="video/mp4">
                            Browser Anda tidak mendukung tag video.
                        </video>
                    </div>
                `;
            } else if (materi.pdf) {
                contentHtml = `
                    <div class="mb-6">
                        <iframe src="${materi.pdf}" class="w-full h-[80vh] rounded-xl shadow-lg" frameborder="0"></iframe>
                    </div>
                `;
            } else if (materi.image) {
                contentHtml = `
                    <div class="mb-6">
                        <img src="${materi.image}" alt="${materi.title}" class="w-full rounded-xl shadow-lg">
                    </div>
                `;
            }
            contentHtml += `
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">${materi.title}</h2>
                    <p class="text-gray-700 leading-relaxed">${materi.content}</p>
                </div>
            `;
            container.innerHTML = contentHtml;
            
            const prevButton = document.getElementById('prev-materi');
            const nextButton = document.getElementById('next-materi');
            const backToMateriListButton = document.getElementById('back-to-materi-list-from-materi');

            if (currentMateriIndex === 0) {
                prevButton.disabled = true;
                prevButton.classList.add('bg-gray-400', 'cursor-not-allowed');
                prevButton.classList.remove('bg-yellow-500', 'hover:bg-yellow-600');
            } else {
                prevButton.disabled = false;
                prevButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
                prevButton.classList.add('bg-yellow-500', 'hover:bg-yellow-600');
            }

            prevButton.onclick = () => {
                if (currentMateriIndex > 0) {
                    currentMateriIndex--;
                    showSingleMateri(currentMateriIndex);
                }
            };
            
            if (currentMateriIndex === materiList.length - 1) {
                nextButton.textContent = 'Selesai';
                nextButton.classList.remove('bg-yellow-500', 'hover:bg-yellow-600');
                nextButton.classList.add('bg-green-500', 'hover:bg-green-600');
                nextButton.onclick = () => showMateriListMenu(currentModuleKey, currentSubModuleKey);
            } else {
                nextButton.textContent = 'Selanjutnya';
                nextButton.classList.remove('bg-green-500', 'hover:bg-green-600');
                nextButton.classList.add('bg-yellow-500', 'hover:bg-yellow-600');
                nextButton.onclick = () => {
                    currentMateriIndex++;
                    showSingleMateri(currentMateriIndex);
                };
            }
            backToMateriListButton.onclick = () => showMateriListMenu(currentModuleKey, currentSubModuleKey);
        }

        function showStaticDisplay(pageId) {
            const pageData = staticPages[pageId];
            document.getElementById('main-menu').classList.add('hidden');
            document.getElementById('static-display').classList.remove('hidden');
            
            document.getElementById('static-title').textContent = pageData.title;

            const container = document.getElementById('static-content-body');
            container.innerHTML = pageData.content;
        }

        function generateCertificate() {
            window.open("{{ route('sertifikat.download') }}", '_blank');
        }

        function showCertificateMenu() {
            document.getElementById('main-menu').classList.add('hidden');
            document.getElementById('certificate-menu').classList.remove('hidden');

            const certificateContent = document.getElementById('certificate-content');
            
            // Tampilkan pesan loading sementara
            certificateContent.innerHTML = `<p class="text-gray-500">Memuat status sertifikat...</p>`;

            fetch("{{ route('sertifikat.cek') }}") // Ganti dengan rute API Anda
                .then(response => response.json())
                .then(data => {
                    if (data.can_download) {
                        // Jika bisa diunduh, tampilkan tombol
                        certificateContent.innerHTML = `
                            <h1 class="text-4xl font-bold text-gray-800 mb-4">Selamat!</h1>
                            <p class="text-gray-600 text-lg mb-8">Anda telah menyelesaikan tes. Sertifikat Anda sudah siap!</p>
                            <button onclick="generateCertificate()" class="w-full max-w-xs bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                                Unduh Sertifikat
                            </button>
                        `;
                    } else {
                        // Jika tidak bisa, tampilkan pesan
                        certificateContent.innerHTML = `
                            <div class="text-center">
                                <h1 class="text-2xl font-bold text-red-500 mb-2">Sertifikat Tidak Tersedia</h1>
                                <p class="text-gray-600">Anda belum memenuhi syarat untuk mengunduh sertifikat.</p>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    certificateContent.innerHTML = `
                        <div class="text-center">
                            <h1 class="text-2xl font-bold text-red-500 mb-2">Terjadi Kesalahan</h1>
                            <p class="text-gray-600">Gagal memuat status sertifikat. Silakan coba lagi.</p>
                        </div>
                    `;
                });
        }

        // function showCertificateMenu() {
        //     document.getElementById('main-menu').classList.add('hidden');
        //     document.getElementById('certificate-menu').classList.remove('hidden');

        //     // Lakukan panggilan AJAX untuk memeriksa status sertifikat
        //     fetch('/api/cek-sertifikat') // Ganti dengan rute API Anda
        //         .then(response => response.json())
        //         .then(data => {
        //             const downloadButton = document.getElementById('download-certificate-btn');
        //             const messageElement = document.getElementById('certificate-status-message');

        //             if (data.can_download) {
        //                 // Jika bisa diunduh, tampilkan tombol dan sembunyikan pesan
        //                 downloadButton.classList.remove('hidden');
        //                 messageElement.classList.add('hidden');
        //             } else {
        //                 // Jika belum lulus, sembunyikan tombol dan tampilkan pesan
        //                 downloadButton.classList.add('hidden');
        //                 messageElement.classList.remove('hidden');
        //                 messageElement.innerText = "Anda belum memenuhi syarat untuk mengunduh sertifikat.";
        //             }
        //         })
        //         .catch(error => {
        //             console.error('Error:', error);
        //             // Tangani kesalahan jika API gagal diakses
        //             const messageElement = document.getElementById('certificate-status-message');
        //             messageElement.innerText = "Gagal memuat status sertifikat. Silakan coba lagi.";
        //             messageElement.classList.remove('hidden');
        //         });
        // }

        function generateCertificate() {
            // const link = document.createElement('a');
            // link.href = 'sertifikat.pdf';
            // link.download = 'sertifikat.pdf';
            // link.target = '_blank';
            // document.body.appendChild(link);
            // link.click();
            // document.body.removeChild(link);
            // window.location.href = "{{ route('sertifikat.download') }}";
            window.open("{{ route('sertifikat.download') }}", '_blank');
        }

        let currentQuestion = 0;
        let correctAnswers = 0;
        let gameQuestions = [];

        function showPretest(testType) {
            currentTestType = testType;
            document.getElementById('testTitle').textContent = testType;
            document.getElementById('startTitle').textContent = `Siap untuk ${testType}?`;
            document.getElementById('startScreen').classList.remove('hidden');
            document.getElementById('gameScreen').classList.add('hidden');
            document.getElementById('resultScreen').classList.add('hidden');
            document.getElementById('pretest-game').classList.remove('hidden');
            document.getElementById('main-menu').classList.add('hidden');
        }
        
        function startGame() {
            gameQuestions = [...questions].sort(() => Math.random() - 0.5);
            currentQuestion = 0;
            correctAnswers = 0;
            document.getElementById('startScreen').classList.add('hidden');
            document.getElementById('gameScreen').classList.remove('hidden');
            document.getElementById('resultScreen').classList.add('hidden');
            showQuestion();
        }

        function showQuestion() {
            const question = gameQuestions[currentQuestion];
            document.getElementById('questionNumber').textContent = `${currentQuestion + 1}/${gameQuestions.length}`;
            document.getElementById('questionText').textContent = question.question;
            const container = document.getElementById('optionsContainer');
            container.innerHTML = '';
            question.options.forEach((option, index) => {
                const button = document.createElement('button');
                button.className = 'bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 text-left';
                button.innerHTML = `<span class="text-lg">${String.fromCharCode(65 + index)}.</span> ${option}`;
                button.onclick = () => selectAnswer(index);
                container.appendChild(button);
            });
            updateProgressBar();
        }

        function selectAnswer(selectedIndex) {
            const question = gameQuestions[currentQuestion];
            const isCorrect = selectedIndex === question.correct;
            if (isCorrect) {
                correctAnswers++;
            }
            nextQuestion();
        }

        function nextQuestion() {
            currentQuestion++;
            if (currentQuestion >= gameQuestions.length) {
                showResults();
            } else {
                showQuestion();
            }
        }

        function showResults() {
            document.getElementById('gameScreen').classList.add('hidden');
            document.getElementById('resultScreen').classList.remove('hidden');
            const accuracy = Math.round((correctAnswers / gameQuestions.length) * 100);
            let resultImg, resultTitle;
            if (accuracy >= 90) {
                resultImg = `<img src="${window.assetPath}assets/result/3.png" alt="Luar Biasa" class="mx-auto" style="width:180px;">`;
                resultTitle = 'Skor Anda';
            } else if (accuracy >= 70) {
                resultImg = `<img src="${window.assetPath}assets/result/2.png" alt="Bagus Sekali" class="mx-auto" style="width:180px;" />`;
                resultTitle = 'Skor Anda';
            } else if (accuracy >= 50) {
                resultImg = `<img src="${window.assetPath}assets/result/1.png" alt="Tidak Buruk" class="mx-auto" style="width:180px;" />`;
                resultTitle = 'Skor Anda';
            } else {
                resultImg = `<img src="${window.assetPath}assets/result/0.png" alt="Skor Anda" class="mx-auto" style="width:180px;" />`;
                resultTitle = 'Skor Anda';
            }
            document.getElementById('resultEmoji').innerHTML = resultImg;
            document.getElementById('resultTitle').textContent = resultTitle;
            document.getElementById('correctAnswers').textContent = `${correctAnswers}/${gameQuestions.length}`;
            document.getElementById('accuracy').textContent = `${accuracy}%`;

            // === Simpan ke database via AJAX ===
            fetch("{{ route('kpps.saveResult') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    // Mengambil token CSRF lebih aman.
                    "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    category: currentTestType,
                    correct_answers: correctAnswers,
                    total_questions: gameQuestions.length,
                    accuracy: accuracy
                })
            })
            .then(response => {
                // Memeriksa apakah respons sukses (status 200-299)
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                // Mengembalikan data JSON
                return response.json();
            })
            .then(data => {
                // Memeriksa properti `success` di respons JSON
                if (data.success) {
                    console.log("Hasil berhasil disimpan.", data);
                    // Tambahkan logika lain di sini, seperti menampilkan pesan ke pengguna
                } else {
                    console.warn("Penyimpanan hasil gagal.", data);
                    // Tangani kasus di mana `success` adalah false, misalnya menampilkan pesan error dari server
                }
            })
            .catch(error => {
                // Menangani kesalahan jaringan atau kesalahan dari throw di atas
                console.error("Gagal menyimpan hasil:", error);
                // Tampilkan pesan error ke pengguna
            });
            
        }
        
        function updateProgressBar() {
            const progress = ((currentQuestion) / gameQuestions.length) * 100;
            document.getElementById('progressBar').style.width = progress + '%';
        }
    </script>
@endpush