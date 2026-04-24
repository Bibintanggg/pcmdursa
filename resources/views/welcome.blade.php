<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <style>
        /* smooth carousel transition */
        #sliderSistemV2 .carousel-item {
            transition: transform 0.9s ease-in-out, opacity 0.9s ease-in-out;
        }

        /* kasih efek fade + scale biar modern */
        #sliderSistemV2 .carousel-item {
            opacity: 0.4;
            transform: scale(0.98);
        }

        #sliderSistemV2 .carousel-item.active {
            opacity: 1;
            transform: scale(1);
        }

        /* hover effect tombol */
        #sliderSistemV2 .carousel-control-prev-icon,
        #sliderSistemV2 .carousel-control-next-icon {
            transition: all 0.3s ease;
            background-color: rgba(0, 0, 0, 0.6) !important;
        }

        #sliderSistemV2 .carousel-control-prev-icon:hover,
        #sliderSistemV2 .carousel-control-next-icon:hover {
            transform: scale(1.1);
            background-color: rgba(0, 0, 0, 0.8) !important;
        }

        /* smooth text masuk */
        #sliderSistemV2 h2,
        #sliderSistemV2 h5,
        #sliderSistemV2 p,
        #sliderSistemV2 .badge {
            animation: fadeUp 0.8s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen">

    {{-- NAVBAR COMPONENT --}}
    @include('layouts.navigation')

    {{-- CONTENT --}}
    <header
        class="relative bg-gradient-to-b from-emerald-700 via-emerald-600 to-emerald-800 text-white overflow-hidden pt-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                <!-- LEFT CONTENT -->
                <div class="text-center lg:text-left">

                    <!-- Badge -->
                    <span
                        class="inline-block bg-yellow-400 text-black text-sm font-semibold px-4 py-1 rounded-full mb-5">
                        Muhammadiyah Berkemajuan
                    </span>

                    <!-- Title -->
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
                        Mencerahkan Semesta,<br>
                        Memajukan Duren Sawit.
                    </h1>

                    <!-- Description -->
                    <p class="text-white/80 text-lg mb-8 max-w-xl mx-auto lg:mx-0">
                        Menjadi pilar dakwah yang inovatif, modern, dan membawa manfaat nyata bagi umat dan bangsa di
                        lingkungan Duren Sawit 1.
                    </p>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#layanan"
                            class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-full transition shadow-md">
                            Kenali Program Kami
                        </a>

                        <a href="#kontak"
                            class="border-2 border-white text-white hover:bg-white hover:text-emerald-700 font-semibold px-6 py-3 rounded-full transition">
                            Hubungi Pengurus
                        </a>
                    </div>
                </div>

                <!-- RIGHT IMAGE -->
                <div class="flex justify-center lg:justify-end">
                    <div class="rounded-3xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1584551246679-0daf3d275d0f?auto=format&fit=crop&w=900&q=80"
                            alt="Masjid" class="w-full h-[420px] object-cover">
                    </div>
                </div>

            </div>
        </div>
    </header>

    <section id="profil" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                <!-- LEFT IMAGE -->
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1585036156171-384164a8c675?auto=format&fit=crop&w=900&q=80"
                        alt="Profil Masjid" class="w-full h-[520px] object-cover rounded-3xl shadow-xl">

                    <!-- floating card -->
                    <div
                        class="absolute bottom-6 right-6 bg-white px-5 py-4 rounded-2xl shadow-lg border-l-4 border-emerald-600">
                        <h4 class="text-emerald-600 font-bold text-lg">Dakwah</h4>
                        <p class="text-gray-500 text-sm">Berkemajuan</p>
                    </div>
                </div>

                <!-- RIGHT CONTENT -->
                <div>

                    <!-- label -->
                    <div class="flex items-center gap-2 text-emerald-600 font-semibold uppercase text-sm mb-3">
                        <span class="w-2 h-2 bg-emerald-600 rounded-full"></span>
                        Profil Organisasi
                    </div>

                    <!-- title -->
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-5">
                        Mengenal Lebih Dekat <br>
                        PCM Duren Sawit 1
                    </h2>

                    <!-- description -->
                    <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                        Pimpinan Cabang Muhammadiyah (PCM) Duren Sawit 1 hadir sebagai pilar gerakan Islam
                        <span class="italic">Amar Ma’ruf Nahi Munkar</span> yang berlandaskan Al-Qur'an dan As-Sunnah.
                        Kami berkomitmen untuk terus mencerahkan dan memajukan masyarakat melalui Amal Usaha di bidang
                        pendidikan, kesehatan, ekonomi, dan sosial.
                    </p>

                    <!-- ACCORDION (simple JS version) -->
                    <!-- ACCORDION -->
                    <div class="space-y-4">

                        <!-- item 1 -->
                        <div class="border rounded-2xl overflow-hidden bg-white shadow-sm">
                            <button onclick="toggleAcc('visi')"
                                class="w-full flex items-center justify-between px-5 py-4 font-semibold text-gray-800">

                                <span class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                    Visi Persyarikatan
                                </span>

                                <span id="icon-visi" class="transition-transform duration-300">+</span>
                            </button>

                            <div id="visi"
                                class="max-h-0 opacity-0 overflow-hidden px-5 text-gray-600 transition-all duration-500 ease-in-out">
                                <div class="pb-5">
                                    Mewujudkan masyarakat Islam yang sebenar-benarnya di wilayah Duren Sawit melalui
                                    gerakan dakwah dan
                                    tajdid yang inklusif, modern, dan membawa rahmat bagi semesta alam.
                                </div>
                            </div>
                        </div>

                        <!-- item 2 -->
                        <div class="border rounded-2xl overflow-hidden bg-white shadow-sm">
                            <button onclick="toggleAcc('misi')"
                                class="w-full flex items-center justify-between px-5 py-4 font-semibold text-gray-800">

                                <span class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-rainbow" viewBox="0 0 16 16">
                                        <path
                                            d="M8 4.5a7 7 0 0 0-7 7 .5.5 0 0 1-1 0 8 8 0 1 1 16 0 .5.5 0 0 1-1 0 7 7 0 0 0-7-7m0 2a5 5 0 0 0-5 5 .5.5 0 0 1-1 0 6 6 0 1 1 12 0 .5.5 0 0 1-1 0 5 5 0 0 0-5-5m0 2a3 3 0 0 0-3 3 .5.5 0 0 1-1 0 4 4 0 1 1 8 0 .5.5 0 0 1-1 0 3 3 0 0 0-3-3m0 2a1 1 0 0 0-1 1 .5.5 0 0 1-1 0 2 2 0 1 1 4 0 .5.5 0 0 1-1 0 1 1 0 0 0-1-1" />
                                    </svg>
                                    Misi Utama Kami
                                </span>

                                <span id="icon-misi" class="transition-transform duration-300">+</span>
                            </button>

                            <div id="misi"
                                class="max-h-0 opacity-0 overflow-hidden px-5 text-gray-600 transition-all duration-500 ease-in-out">
                                <div class="pb-5 space-y-2">
                                    <p>• Meningkatkan kualitas keimanan dan akhlak warga</p>
                                    <p>• Mengembangkan Amal Usaha Muhammadiyah</p>
                                    <p>• Memberdayakan ekonomi umat</p>
                                </div>
                            </div>
                        </div>

                        <!-- item 3 -->
                        <div class="border rounded-2xl overflow-hidden bg-white shadow-sm">
                            <button onclick="toggleAcc('pengurus')"
                                class="w-full flex items-center justify-between px-5 py-4 font-semibold text-gray-800">

                                <span class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                                        <path
                                            d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                                    </svg>
                                    Pimpinan & Majelis
                                </span>

                                <span id="icon-pengurus" class="transition-transform duration-300">+</span>
                            </button>

                            <div id="pengurus"
                                class="max-h-0 opacity-0 overflow-hidden px-5 text-gray-600 transition-all duration-500 ease-in-out">
                                <div class="pb-5">
                                    Roda pergerakan PCM Duren Sawit 1 digerakkan secara kolektif oleh Pimpinan Cabang
                                    Muhammadiyah beserta
                                    Majelis dan Lembaga.
                                    <a href="#" class="block mt-3 text-emerald-600 font-semibold hover:underline">
                                        Lihat Struktur Organisasi →
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <section id="program-digital-v2" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6">

                <!-- HEADER -->
                <div class="flex justify-between items-end mb-10">
                    <div>
                        <h6 class="text-emerald-600 font-bold uppercase tracking-widest flex items-center gap-2">
                            <span>⚙️</span> Inovasi Digital
                        </h6>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                            Platform Manajemen Cabang
                        </h2>
                    </div>

                    <div class="hidden md:block w-24 h-1 bg-yellow-400 rounded-full"></div>
                </div>

                <!-- SLIDER WRAPPER -->
                <div class="relative overflow-hidden rounded-3xl shadow-xl bg-white">

                    <!-- SLIDES -->
                    <div id="sliderTrack" class="flex transition-transform duration-700 ease-in-out">

                        <!-- SLIDE 1 -->
                        <div class="min-w-full grid md:grid-cols-2">
                            <div class="p-10 flex flex-col justify-center">
                                <span class="bg-emerald-50 text-emerald-600 px-4 py-1 rounded-full text-sm w-fit mb-4">
                                    Manajemen SDM
                                </span>

                                <h2 class="text-4xl font-bold text-gray-900 mb-2">SAKTI</h2>
                                <h5 class="text-gray-500 mb-4">Sistem Administrasi Kepegawaian Terintegrasi</h5>

                                <p class="text-gray-600 mb-6 leading-relaxed">
                                    Solusi modern untuk memantau kinerja, presensi digital, dan pendataan seluruh
                                    pengurus
                                    serta pendidik secara real-time.
                                </p>

                                <button
                                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-3 rounded-xl w-fit transition">
                                    Login SAKTI →
                                </button>
                            </div>

                            <div
                                class="bg-gradient-to-br from-emerald-700 to-green-600 flex items-center justify-center p-10">
                                <div class="text-white text-8xl opacity-60">👆</div>
                            </div>
                        </div>

                        <!-- SLIDE 2 -->
                        <div class="min-w-full grid md:grid-cols-2">
                            <div class="p-10 flex flex-col justify-center">
                                <span class="bg-sky-50 text-sky-600 px-4 py-1 rounded-full text-sm w-fit mb-4">
                                    Tata Kelola Aset
                                </span>

                                <h2 class="text-4xl font-bold text-gray-900 mb-2">PINTAR</h2>
                                <h5 class="text-gray-500 mb-4">Pusat Inventaris & Tata Arsip</h5>

                                <p class="text-gray-600 mb-6 leading-relaxed">
                                    Digitalisasi dokumen penting dan pencatatan aset secara komprehensif dalam satu
                                    sistem.
                                </p>

                                <button
                                    class="bg-sky-600 hover:bg-sky-700 text-white px-5 py-3 rounded-xl w-fit transition">
                                    Login PINTAR →
                                </button>
                            </div>

                            <div
                                class="bg-gradient-to-br from-sky-700 to-blue-900 flex items-center justify-center p-10">
                                <div class="text-white text-8xl opacity-60">📦</div>
                            </div>
                        </div>

                        <!-- SLIDE 3 -->
                        <div class="min-w-full grid md:grid-cols-2">
                            <div class="p-10 flex flex-col justify-center">
                                <span class="bg-amber-50 text-amber-600 px-4 py-1 rounded-full text-sm w-fit mb-4">
                                    Keuangan
                                </span>

                                <h2 class="text-4xl font-bold text-gray-900 mb-2">AMANAH</h2>
                                <h5 class="text-gray-500 mb-4">Manajemen Anggaran Handal</h5>

                                <p class="text-gray-600 mb-6 leading-relaxed">
                                    Transparansi keuangan dan pelaporan digital yang akuntabel.
                                </p>

                                <button
                                    class="bg-amber-600 hover:bg-amber-700 text-white px-5 py-3 rounded-xl w-fit transition">
                                    Login AMANAH →
                                </button>
                            </div>

                            <div
                                class="bg-gradient-to-br from-amber-700 to-orange-900 flex items-center justify-center p-10">
                                <div class="text-white text-8xl opacity-60">💰</div>
                            </div>
                        </div>

                        <!-- SLIDE 4 -->
                        <div class="min-w-full grid md:grid-cols-2">
                            <div class="p-10 flex flex-col justify-center">
                                <span class="bg-indigo-50 text-indigo-600 px-4 py-1 rounded-full text-sm w-fit mb-4">
                                    Demokrasi Digital
                                </span>

                                <h2 class="text-4xl font-bold text-gray-900 mb-2">SUARA-MU</h2>
                                <h5 class="text-gray-500 mb-4">E-Voting & Musyawarah Digital</h5>

                                <p class="text-gray-600 mb-6 leading-relaxed">
                                    Sistem voting terenkripsi untuk musyawarah modern dan transparan.
                                </p>

                                <button
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl w-fit transition">
                                    Login SUARA-MU →
                                </button>
                            </div>

                            <div
                                class="bg-gradient-to-br from-indigo-700 to-purple-900 flex items-center justify-center p-10">
                                <div class="text-white text-8xl opacity-60">🗳️</div>
                            </div>
                        </div>

                    </div>

                    <!-- NAV -->
                    <button onclick="prevSlide()"
                        class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white shadow p-3 rounded-full">
                        ◀
                    </button>

                    <button onclick="nextSlide()"
                        class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white shadow p-3 rounded-full">
                        ▶
                    </button>

                </div>
            </div>
        </section>



        <!-- simple accordion script -->
        <script>
            function toggleAcc(id) {
                const el = document.getElementById(id);
                const icon = document.getElementById('icon-' + id);

                const isOpen = el.classList.contains('max-h-[500px]');

                // close semua dulu (biar accordion rapi)
                document.querySelectorAll('[id]').forEach(item => {
                    if (item.id === 'visi' || item.id === 'misi' || item.id === 'pengurus') {
                        item.classList.remove('max-h-[500px]', 'opacity-100');
                        item.classList.add('max-h-0', 'opacity-0');
                    }
                });

                document.querySelectorAll('[id^="icon-"]').forEach(ic => {
                    ic.classList.remove('rotate-45');
                    ic.innerText = '+';
                });

                if (!isOpen) {
                    el.classList.remove('max-h-0', 'opacity-0');
                    el.classList.add('max-h-[500px]', 'opacity-100');

                    icon.classList.add('rotate-45');
                    icon.innerText = '×';
                }
            }

            document.addEventListener("DOMContentLoaded", () => {
    let currentIndex = 0;
    const track = document.getElementById("sliderTrack");
    const totalSlides = track.children.length;

    function updateSlider() {
        track.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    window.nextSlide = function () {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlider();
    }

    window.prevSlide = function () {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateSlider();
    }

    setInterval(() => {
        nextSlide();
    }, 6000);
});
        </script>
    </section>

</body>

</html>
