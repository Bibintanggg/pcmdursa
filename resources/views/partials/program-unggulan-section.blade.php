  <section id="program-unggulan" class="py-20 bg-gray-50">
            <div class="max-w-6xl mx-auto px-6">

                <div class="bg-white rounded-3xl shadow-md p-8 md:p-12">

                    <!-- HEADER -->
                    <div class="text-center mb-10">
                        <h6 class="text-amber-500 font-bold uppercase tracking-widest">
                            ⭐ Fokus Gerakan
                        </h6>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">
                            Detail Program Unggulan
                        </h2>
                        <div class="w-16 h-1 bg-emerald-600 mx-auto mt-3 rounded-full"></div>
                    </div>

                    <!-- TABS -->
                    <div class="flex flex-wrap justify-center gap-3 mb-8">
                        <button onclick="openTab('kajian')"
                            class="tab-btn bg-emerald-600 text-white px-5 py-2 rounded-full font-semibold">
                            Kajian & Tabligh
                        </button>
                        <button onclick="openTab('pendidikan')"
                            class="tab-btn bg-gray-100 px-5 py-2 rounded-full font-semibold">
                            Pendidikan Kader
                        </button>
                        <button onclick="openTab('ekonomi')"
                            class="tab-btn bg-gray-100 px-5 py-2 rounded-full font-semibold">
                            Pemberdayaan Ekonomi
                        </button>
                    </div>

                    <!-- CONTENT -->
                    <div id="tabContent">

                        <!-- KAJIAN -->
                        <div class="tab-panel" id="kajian">
                            <div class="grid md:grid-cols-2 gap-6 items-center bg-gray-50 p-6 rounded-2xl">
                                <div>
                                    <h4 class="text-xl font-bold text-emerald-600 mb-3">
                                        Mencerahkan Umat Melalui Kajian
                                    </h4>

                                    <p class="text-gray-600 mb-4">
                                        Program pembinaan aqidah, ibadah, dan akhlak masyarakat melalui kajian rutin.
                                    </p>

                                    <ul class="text-gray-600 space-y-1 mb-4">
                                        <li>• Kajian Ahad Pagi</li>
                                        <li>• Kajian Tarjih</li>
                                        <li>• Pelatihan Mubaligh</li>
                                    </ul>

                                    <button onclick="openModal('modalJadwal')"
                                        class="bg-emerald-600 text-white px-5 py-2 rounded-full">
                                        Jadwal Kajian
                                    </button>
                                </div>

                                <div class="text-center text-7xl opacity-40">🎤</div>
                            </div>
                        </div>

                        <!-- PENDIDIKAN -->
                        <div class="tab-panel hidden" id="pendidikan">
                            <div class="grid md:grid-cols-2 gap-6 items-center bg-gray-50 p-6 rounded-2xl">
                                <div>
                                    <h4 class="text-xl font-bold text-sky-600 mb-3">
                                        Mencetak Generasi Tangguh
                                    </h4>

                                    <p class="text-gray-600 mb-4">
                                        Fokus pada peningkatan kualitas pendidikan dan kaderisasi.
                                    </p>

                                    <ul class="text-gray-600 space-y-1 mb-4">
                                        <li>• Beasiswa Mentari</li>
                                        <li>• Digitalisasi Guru</li>
                                        <li>• Baitul Arqam</li>
                                    </ul>

                                    <button onclick="openModal('modalSekolah')"
                                        class="bg-sky-600 text-white px-5 py-2 rounded-full">
                                        Info Sekolah
                                    </button>
                                </div>

                                <div class="text-center text-7xl opacity-40">📚</div>
                            </div>
                        </div>

                        <!-- EKONOMI -->
                        <div class="tab-panel hidden" id="ekonomi">
                            <div class="grid md:grid-cols-2 gap-6 items-center bg-gray-50 p-6 rounded-2xl">
                                <div>
                                    <h4 class="text-xl font-bold text-amber-600 mb-3">
                                        Kemandirian Ekonomi Umat
                                    </h4>

                                    <p class="text-gray-600 mb-4">
                                        Penguatan ekonomi melalui jaringan saudagar Muhammadiyah.
                                    </p>

                                    <ul class="text-gray-600 space-y-1 mb-4">
                                        <li>• Sertifikasi Halal</li>
                                        <li>• Koperasi Syariah</li>
                                        <li>• Bazar UMKM</li>
                                    </ul>

                                    <button onclick="openModal('modalJSM')"
                                        class="bg-amber-500 text-white px-5 py-2 rounded-full">
                                        Gabung JSM
                                    </button>
                                </div>

                                <div class="text-center text-7xl opacity-40">🏪</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
