<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Berita — PCM Duren Sawit 1</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }

        /* Simple hover lift */
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        /* Skeleton */
        .skeleton {
            background: #f3f4f6;
            position: relative;
            overflow: hidden;
        }
        .skeleton::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            animation: shimmer 1.2s infinite;
        }
        @keyframes shimmer {
            100% { left: 100%; }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

    {{-- NAV --}}
   @include('layouts.navigation')

    {{-- HEADER --}}
    <section class="pt-24 pb-16">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-full mb-8">
                <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-700">Berita Terkini</span>
            </div>

            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Semua Berita</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Update terbaru dari aktivitas kami.</p>
        </div>
    </section>

    {{-- FILTERS --}}
    <section class="max-w-6xl mx-auto px-4 mb-12">
        <div class="flex flex-wrap gap-2 justify-center" x-data="{ active: 'all' }">
            <button @click="filter('all'); active='all'"
                    :class="active === 'all' ? 'bg-gray-900 text-white' : 'bg-white border border-gray-200 hover:bg-gray-50'"
                    class="px-6 py-3 rounded-xl font-medium text-sm transition-all duration-200">
                Semua
            </button>
            <button @click="filter('dakwah'); active='dakwah'"
                    :class="active === 'dakwah' ? 'bg-emerald-500 text-white' : 'bg-white border border-gray-200 hover:bg-gray-50'"
                    class="px-6 py-3 rounded-xl font-medium text-sm transition-all duration-200">
                Dakwah
            </button>
            <button @click="filter('pendidikan'); active='pendidikan'"
                    :class="active === 'pendidikan' ? 'bg-blue-500 text-white' : 'bg-white border border-gray-200 hover:bg-gray-50'"
                    class="px-6 py-3 rounded-xl font-medium text-sm transition-all duration-200">
                Pendidikan
            </button>
            <button @click="filter('sosial'); active='sosial'"
                    :class="active === 'sosial' ? 'bg-orange-500 text-white' : 'bg-white border border-gray-200 hover:bg-gray-50'"
                    class="px-6 py-3 rounded-xl font-medium text-sm transition-all duration-200">
                Sosial
            </button>
            <button @click="filter('organisasi'); active='organisasi'"
                    :class="active === 'organisasi' ? 'bg-purple-500 text-white' : 'bg-white border border-gray-200 hover:bg-gray-50'"
                    class="px-6 py-3 rounded-xl font-medium text-sm transition-all duration-200">
                Organisasi
            </button>
        </div>
    </section>

    {{-- GRID --}}
    <section class="max-w-6xl mx-auto px-4 pb-24">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
             x-data="newsGrid({{ $berita->where('status', 'published')->values()->toJson() }})"
             x-init="init()">

            <!-- Loading -->
            <template x-for="i in 8" x-show="loading">
                <div class="bg-white border border-gray-200 rounded-2xl p-6 skeleton h-80"></div>
            </template>

            <!-- Cards -->
            <template x-for="item in filteredItems" :key="item.id" x-show="!loading">
                <a :href="`/berita/${item.slug}`" class="card-hover bg-white border border-gray-200 rounded-2xl p-8 hover:border-gray-300 shadow-sm transition-all duration-300 group">

                    <!-- Image -->
                    <div class="mb-6 rounded-xl overflow-hidden h-48">
                        <img :src="item.gambar"
                             :alt="item.judul"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                             loading="lazy">
                    </div>

                    <!-- Category -->
                    <span x-text="item.kategori"
                          :class="getCategoryClass(item.kategori)"
                          class="inline-block px-3 py-1 text-xs font-semibold rounded-full mb-4">
                    </span>

                    <!-- Content -->
                    <div class="space-y-3">
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <span x-text="formatDate(item.created_at)"></span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 leading-tight line-clamp-2 group-hover:text-gray-800"
                            x-text="item.judul"></h3>
                        <p class="text-gray-600 leading-relaxed line-clamp-2 text-sm" x-text="item.excerpt"></p>
                    </div>

                    <!-- Arrow -->
                    <div class="flex items-center gap-2 mt-6 pt-4 border-t border-gray-100">
                        <span class="text-sm font-medium text-gray-900 group-hover:translate-x-1 transition-transform">Baca</span>
                        <svg class="w-4 h-4 text-gray-500 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
            </template>

            <!-- Empty -->
            <div x-show="filteredItems.length === 0 && !loading" class="col-span-full py-24 text-center">
                <div class="w-20 h-20 mx-auto mb-6 bg-gray-100 rounded-2xl flex items-center justify-center">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">Tidak Ada Berita</h3>
                <p class="text-gray-600">Belum ada berita untuk kategori ini.</p>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-white border-t border-gray-200 py-12">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <p class="text-gray-600 mb-4">© {{ date('Y') }} PCM Duren Sawit 1</p>
            <div class="flex gap-6 justify-center text-sm text-gray-500">
                <a href="/" class="hover:text-gray-900">Beranda</a>
                <a href="/profil" class="hover:text-gray-900">Profil</a>
                <a href="/berita" class="hover:text-gray-900 font-semibold">Berita</a>
                <a href="/kontak" class="hover:text-gray-900">Kontak</a>
            </div>
        </div>
    </footer>

    <script>
    function newsGrid(items) {
        return {
            items: items,
            filteredItems: [],
            loading: true,
            activeFilter: 'all',

            init() {
                this.filteredItems = this.items;
                setTimeout(() => this.loading = false, 800);
            },

            filter(filter) {
                this.loading = true;
                this.activeFilter = filter;

                setTimeout(() => {
                    if (filter === 'all') {
                        this.filteredItems = this.items;
                    } else {
                        this.filteredItems = this.items.filter(item => item.kategori === filter);
                    }
                    this.loading = false;
                }, 300);
            },

            getCategoryClass(kategori) {
                const classes = {
                    dakwah: 'bg-emerald-100 text-emerald-800',
                    pendidikan: 'bg-blue-100 text-blue-800',
                    sosial: 'bg-orange-100 text-orange-800',
                    organisasi: 'bg-purple-100 text-purple-800'
                };
                return classes[kategori] || 'bg-gray-100 text-gray-800';
            },

            formatDate(dateStr) {
                const date = new Date(dateStr);
                return date.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'short'
                });
            }
        }
    }
    </script>
</body>
</html>
