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

    @include('layouts.navigation')

    @include('partials.header-section')

    <section id="profil" class="py-20 bg-gray-50">
        @include('partials.profile-section')
        @include('partials.amal-usaha-section')
        @include('partials.article-section')
        @include('partials.program-unggulan-section')


        @include('partials.layanan-section')

        @include('layouts.footer')

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

                window.nextSlide = function() {
                    currentIndex = (currentIndex + 1) % totalSlides;
                    updateSlider();
                }

                window.prevSlide = function() {
                    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                    updateSlider();
                }

                setInterval(() => {
                    nextSlide();
                }, 6000);
            });


            function openTab(tabId) {
                document.querySelectorAll('.tab-panel').forEach(el => el.classList.add('hidden'));
                document.getElementById(tabId).classList.remove('hidden');

                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.classList.remove('bg-emerald-600', 'text-white');
                    btn.classList.add('bg-gray-100');
                });

                event.target.classList.add('bg-emerald-600', 'text-white');
            }

            // MODAL
            function openModal(id) {
                document.getElementById(id).classList.remove('hidden');
            }

            function closeModal(id) {
                document.getElementById(id).classList.add('hidden');
            }
        </script>
    </section>

</body>

</html>
