{{-- ================================================================
     AMAL USAHA SECTION — PCM Cileungsi
     Minimalis · Clean · Modern (Awwwards-style)
     ================================================================ --}}

<style>
    /* ── Font ── */
    @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap');

    /* ── Tokens ── */
    #amal-usaha-section {
        --au-black: #0e0e0e;
        --au-white: #fafaf8;
        --au-cream: #f5f2ec;
        --au-line: #e4e1da;
        --au-muted: #9a9690;
        --au-dark: #3a3830;

        /* Bidang colours */
        --au-green: #1b5e40;
        --au-green-mid: #2e7d52;
        --au-green-bg: #e8f3ec;
        --au-green-grd: linear-gradient(135deg, #1b5e40 0%, #2e9e68 100%);

        --au-blue: #1a3a6c;
        --au-blue-mid: #2558a8;
        --au-blue-bg: #e8eef8;
        --au-blue-grd: linear-gradient(135deg, #1a3a6c 0%, #2e6ab8 100%);

        --au-amber: #7a3e00;
        --au-amber-mid: #c47a15;
        --au-amber-bg: #fdf4e4;
        --au-amber-grd: linear-gradient(135deg, #7a3e00 0%, #d4860e 100%);

        --au-indigo: #2d1e6b;
        --au-indigo-mid: #5040b0;
        --au-indigo-bg: #eeeaf8;
        --au-indigo-grd: linear-gradient(135deg, #2d1e6b 0%, #6050c8 100%);

        --au-gold: #c9a84c;
        --au-radius: 18px;
        --au-radius-sm: 10px;
    }

    /* ── Section wrapper ── */
    #amal-usaha-section {
        background: var(--au-white);
        font-family: 'DM Sans', sans-serif;
        padding: 100px 0 120px;
        overflow: hidden;
    }

    .au-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 5vw;
    }

    /* ── Header ── */
    .au-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 56px;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .au-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.72rem;
        font-weight: 500;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: var(--au-green-mid);
        margin-bottom: 10px;
    }

    .au-eyebrow::before {
        content: '';
        width: 22px;
        height: 1.5px;
        background: var(--au-green-mid);
        display: block;
    }

    .au-title {
        font-family: 'DM Serif Display', serif;
        font-size: clamp(1.9rem, 3vw, 2.8rem);
        letter-spacing: -0.025em;
        line-height: 1.08;
        color: var(--au-black);
    }

    .au-title em {
        font-style: italic;
        color: var(--au-green-mid);
    }

    .au-header-right {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 14px;
    }

    .au-header-desc {
        font-size: 0.88rem;
        color: var(--au-muted);
        line-height: 1.7;
        text-align: right;
        max-width: 300px;
    }

    /* ── Progress bar ── */
    .au-progress-track {
        width: 240px;
        height: 2px;
        background: var(--au-line);
        border-radius: 2px;
        overflow: hidden;
    }

    .au-progress-fill {
        height: 100%;
        background: var(--au-black);
        border-radius: 2px;
        width: 25%;
        transition: width 0.15s linear;
    }

    /* ── Slider outer ── */
    .au-slider-outer {
        position: relative;
    }

    .au-slider-viewport {
        overflow: hidden;
        border-radius: var(--au-radius);
    }

    .au-slider-track {
        display: flex;
        transition: transform 0.85s cubic-bezier(0.77, 0, 0.18, 1);
    }

    /* ── Slide card ── */
    .au-slide {
        min-width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 420px;
    }

    .au-slide-content {
        padding: 52px 52px 52px 56px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: var(--au-white);
        border: 1px solid var(--au-line);
        border-right: none;
        border-radius: var(--au-radius) 0 0 var(--au-radius);
    }

    .au-slide-visual {
        border-radius: 0 var(--au-radius) var(--au-radius) 0;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    /* Visual decoration */
    .au-slide-visual::before {
        content: '';
        position: absolute;
        inset: 0;
        opacity: 0.08;
        background-image: radial-gradient(circle at 30% 70%, white 1px, transparent 1px),
            radial-gradient(circle at 70% 30%, white 1px, transparent 1px);
        background-size: 32px 32px;
    }

    .au-visual-icon {
        font-size: 100px;
        opacity: 0.25;
        z-index: 1;
        filter: drop-shadow(0 8px 24px rgba(0, 0, 0, 0.3));
        transition: transform 0.5s ease, opacity 0.5s ease;
    }

    .au-slide.au-slide-active .au-visual-icon {
        opacity: 0.35;
        transform: scale(1.05);
    }

    .au-visual-label {
        position: absolute;
        bottom: 24px;
        left: 24px;
        font-size: 0.68rem;
        font-weight: 500;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.5);
        z-index: 2;
    }

    /* Colour themes per slide */
    .au-slide-green .au-slide-visual {
        background: var(--au-green-grd);
    }

    .au-slide-blue .au-slide-visual {
        background: var(--au-blue-grd);
    }

    .au-slide-amber .au-slide-visual {
        background: var(--au-amber-grd);
    }

    .au-slide-indigo .au-slide-visual {
        background: var(--au-indigo-grd);
    }

    /* ── Slide content elements ── */
    .au-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        border-radius: 100px;
        font-size: 0.72rem;
        font-weight: 500;
        letter-spacing: 0.06em;
        width: fit-content;
        margin-bottom: 20px;
    }

    .au-badge-green {
        background: var(--au-green-bg);
        color: var(--au-green);
    }

    .au-badge-blue {
        background: var(--au-blue-bg);
        color: var(--au-blue);
    }

    .au-badge-amber {
        background: var(--au-amber-bg);
        color: var(--au-amber);
    }

    .au-badge-indigo {
        background: var(--au-indigo-bg);
        color: var(--au-indigo);
    }

    .au-slide-name {
        font-family: 'DM Serif Display', serif;
        font-size: clamp(2.2rem, 4vw, 3.2rem);
        letter-spacing: -0.025em;
        line-height: 1;
        color: var(--au-black);
        margin-bottom: 8px;
        /* Animate on slide in */
        animation: au-fade-up 0.7s ease both;
    }

    .au-slide-subtitle {
        font-size: 0.85rem;
        color: var(--au-muted);
        margin-bottom: 18px;
        animation: au-fade-up 0.7s 0.08s ease both;
    }

    .au-divider-line {
        width: 36px;
        height: 1.5px;
        background: var(--au-line);
        margin-bottom: 18px;
    }

    .au-slide-desc {
        font-size: 0.9rem;
        line-height: 1.75;
        color: var(--au-dark);
        margin-bottom: 32px;
        max-width: 440px;
        animation: au-fade-up 0.7s 0.14s ease both;
    }

    .au-list {
        list-style: none;
        margin-bottom: 32px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        animation: au-fade-up 0.7s 0.18s ease both;
    }

    .au-list li {
        display: flex;
        align-items: baseline;
        gap: 10px;
        font-size: 0.85rem;
        color: var(--au-dark);
        line-height: 1.5;
    }

    .au-list li::before {
        content: '—';
        font-size: 0.7rem;
        color: var(--au-muted);
        flex-shrink: 0;
    }

    .au-cta-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 13px 22px;
        border-radius: var(--au-radius-sm);
        font-size: 0.82rem;
        font-weight: 500;
        letter-spacing: 0.04em;
        cursor: pointer;
        border: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s;
        width: fit-content;
        text-decoration: none;
        animation: au-fade-up 0.7s 0.22s ease both;
    }

    .au-cta-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(0, 0, 0, 0.15);
    }

    .au-cta-btn svg {
        transition: transform 0.2s ease;
    }

    .au-cta-btn:hover svg {
        transform: translateX(3px);
    }

    .au-btn-green {
        background: var(--au-green-mid);
        color: #fff;
    }

    .au-btn-blue {
        background: var(--au-blue-mid);
        color: #fff;
    }

    .au-btn-amber {
        background: var(--au-amber-mid);
        color: #fff;
    }

    .au-btn-indigo {
        background: var(--au-indigo-mid);
        color: #fff;
    }

    /* ── Nav buttons ── */
    .au-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 44px;
        height: 44px;
        background: var(--au-white);
        border: 1px solid var(--au-line);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: background 0.2s, border-color 0.2s, transform 0.2s;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
    }

    .au-nav-btn:hover {
        background: var(--au-black);
        border-color: var(--au-black);
        transform: translateY(-50%) scale(1.08);
    }

    .au-nav-btn:hover svg {
        stroke: white;
    }

    .au-nav-prev {
        left: -22px;
    }

    .au-nav-next {
        right: -22px;
    }

    .au-nav-btn svg {
        stroke: var(--au-dark);
        transition: stroke 0.2s;
    }

    /* ── Dot indicators ── */
    .au-dots {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 28px;
    }

    .au-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--au-line);
        cursor: pointer;
        transition: background 0.3s, width 0.3s, border-radius 0.3s;
        border: none;
        padding: 0;
    }

    .au-dot.active {
        background: var(--au-black);
        width: 20px;
        border-radius: 3px;
    }

    /* ── Slide counter ── */
    .au-counter {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 18px;
    }

    .au-counter-text {
        font-size: 0.72rem;
        color: var(--au-muted);
        letter-spacing: 0.08em;
    }

    .au-counter-text strong {
        color: var(--au-black);
    }

    /* ── Animation keyframes ── */
    @keyframes au-fade-up {
        from {
            opacity: 0;
            transform: translateY(16px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ── Responsive ── */
    @media (max-width: 768px) {
        #amal-usaha-section {
            padding: 70px 0 80px;
        }

        .au-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .au-header-right {
            align-items: flex-start;
        }

        .au-header-desc {
            text-align: left;
            max-width: 100%;
        }

        .au-progress-track {
            width: 160px;
        }

        .au-slide {
            grid-template-columns: 1fr;
            min-height: auto;
        }

        .au-slide-content {
            padding: 36px 28px;
            border-right: 1px solid var(--au-line);
            border-bottom: none;
            border-radius: var(--au-radius) var(--au-radius) 0 0;
        }

        .au-slide-visual {
            min-height: 180px;
            border-radius: 0 0 var(--au-radius) var(--au-radius);
        }

        .au-nav-prev {
            left: -8px;
        }

        .au-nav-next {
            right: -8px;
        }
    }
</style>

{{-- ================================================================ --}}
<section id="amal-usaha-section">
    <div class="au-container">

        {{-- Header --}}
        <div class="au-header">
            <div>
                <div class="au-eyebrow">Amal Usaha Muhammadiyah</div>
                <h2 class="au-title">
                    Platform <em>Digital</em><br>Manajemen Cabang
                </h2>
            </div>
            <div class="au-header-right">
                <p class="au-header-desc">
                    Empat bidang utama yang menggerakkan<br>
                    kehidupan bermasyarakat PCM Cileungsi.
                </p>
                <div class="au-progress-track">
                    <div class="au-progress-fill" id="auProgressFill"></div>
                </div>
            </div>
        </div>

        {{-- Slider --}}
        <div class="au-slider-outer">

            {{-- Prev btn --}}
            <button class="au-nav-btn au-nav-prev" onclick="auSlide(-1)" aria-label="Sebelumnya">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke-width="1.8"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 12L6 8l4-4" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

            <div class="au-slider-viewport">
                <div class="au-slider-track" id="auSliderTrack">

                    {{-- ── SLIDE 1: Bidang Ekonomi ── --}}
                    <div class="au-slide au-slide-green au-slide-active">
                        <div class="au-slide-content">
                            <span class="au-badge au-badge-green">
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="5" cy="5" r="3" fill="currentColor" />
                                </svg>
                                Bidang Ekonomi
                            </span>
                            <h3 class="au-slide-name">Amal Usaha<br>Ekonomi</h3>
                            <p class="au-slide-subtitle">Penggerak Kemandirian Ekonomi Umat</p>
                            <div class="au-divider-line"></div>
                            <ul class="au-list">
                                <li>PT. Sunci Sinar Semesta</li>
                                <li>BMT An-nisa</li>
                                <li>Dos-Qua Air Mineral</li>
                                <li>Konveksi Al-kahfi</li>
                                <li>Sun Martmu</li>
                                <li>Guest House (Progres)</li>
                                <li>Sentralisasi Buku</li>
                                <li>Pengadaan Beras untuk guru dan karyawan</li>
                                <li>Unit Produksi</li>
                                <li>TravelMu · Biro Perjalanan Umroh dan Haji</li>
                            </ul>
                            {{-- <a href="#" class="au-cta-btn au-btn-green">
                                Selengkapnya
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 7h8M7 3l4 4-4 4" stroke="white" stroke-width="1.6"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a> --}}
                        </div>
                        <div class="au-slide-visual">
                            <span class="au-visual-icon">💼</span>
                            <span class="au-visual-label">Bidang Ekonomi</span>
                        </div>
                    </div>

                    {{-- ── SLIDE 2: Bidang Kesehatan ── --}}
                    <div class="au-slide au-slide-blue">
                        <div class="au-slide-content">
                            <span class="au-badge au-badge-blue">
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="5" cy="5" r="3" fill="currentColor" />
                                </svg>
                                Bidang Kesehatan
                            </span>
                            <h3 class="au-slide-name">Amal Usaha<br>Kesehatan</h3>
                            <p class="au-slide-subtitle">Layanan Kesehatan Umat yang Amanah</p>
                            <div class="au-divider-line"></div>
                            <ul class="au-list">
                                <li>Klinik Pratama Muhammadiyah</li>
                                <li>Apotek Muhammadiyah</li>
                                <li>Posyandu Binaan PCM</li>
                                <li>Program Kesehatan Gratis</li>
                                <li>Ambulans Umat</li>
                            </ul>
                            <a href="#" class="au-cta-btn au-btn-blue">
                                Selengkapnya
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 7h8M7 3l4 4-4 4" stroke="white" stroke-width="1.6"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                        <div class="au-slide-visual">
                            <span class="au-visual-icon">🏥</span>
                            <span class="au-visual-label">Bidang Kesehatan</span>
                        </div>
                    </div>

                    {{-- ── SLIDE 3: Bidang Pendidikan ── --}}
                    <div class="au-slide au-slide-amber">
                        <div class="au-slide-content">
                            <span class="au-badge au-badge-amber">
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="5" cy="5" r="3" fill="currentColor" />
                                </svg>
                                Bidang Pendidikan
                            </span>
                            <h3 class="au-slide-name">Amal Usaha<br>Pendidikan</h3>
                            <p class="au-slide-subtitle">Mencerdaskan Generasi Penerus Bangsa</p>
                            <div class="au-divider-line"></div>
                            <ul class="au-list">
                                <li>TK / PAUD Muhammadiyah</li>
                                <li>SD Muhammadiyah</li>
                                <li>SMP Muhammadiyah</li>
                                <li>SMA / SMK Muhammadiyah</li>
                                <li>Pondok Pesantren Binaan</li>
                                <li>TPQ & Madrasah Diniyah</li>
                            </ul>
                            <a href="#" class="au-cta-btn au-btn-amber">
                                Selengkapnya
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 7h8M7 3l4 4-4 4" stroke="white" stroke-width="1.6"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                        <div class="au-slide-visual">
                            <span class="au-visual-icon">🎓</span>
                            <span class="au-visual-label">Bidang Pendidikan</span>
                        </div>
                    </div>

                    {{-- ── SLIDE 4: Bidang Sosial ── --}}
                    <div class="au-slide au-slide-indigo">
                        <div class="au-slide-content">
                            <span class="au-badge au-badge-indigo">
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="5" cy="5" r="3" fill="currentColor" />
                                </svg>
                                Bidang Sosial
                            </span>
                            <h3 class="au-slide-name">Amal Usaha<br>Sosial</h3>
                            <p class="au-slide-subtitle">Kepedulian Sosial untuk Kemaslahatan Umat</p>
                            <div class="au-divider-line"></div>
                            <ul class="au-list">
                                <li>Panti Asuhan Muhammadiyah</li>
                                <li>Program Beasiswa Dhuafa</li>
                                <li>Rumah Singgah</li>
                                <li>Lembaga Zakat & Infaq (LAZISMU)</li>
                                <li>Tanggap Bencana PCM</li>
                                <li>Program Pemberdayaan Masyarakat</li>
                            </ul>
                            <a href="#" class="au-cta-btn au-btn-indigo">
                                Selengkapnya
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 7h8M7 3l4 4-4 4" stroke="white" stroke-width="1.6"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                        <div class="au-slide-visual">
                            <span class="au-visual-icon">🤝</span>
                            <span class="au-visual-label">Bidang Sosial</span>
                        </div>
                    </div>

                </div>{{-- /au-slider-track --}}
            </div>{{-- /au-slider-viewport --}}

            {{-- Next btn --}}
            <button class="au-nav-btn au-nav-next" onclick="auSlide(1)" aria-label="Berikutnya">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke-width="1.8"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 4l4 4-4 4" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

        </div>{{-- /au-slider-outer --}}

        {{-- Footer: dots + counter --}}
        <div class="au-counter">
            <div class="au-dots" id="auDots"></div>
            <span class="au-counter-text">
                <strong id="auCurrent">01</strong> / <span id="auTotal">04</span>
            </span>
        </div>

    </div>{{-- /au-container --}}
</section>

<script>
    (function() {
        const TOTAL = 4;
        const INTERVAL = 5500; // ms auto-advance
        const track = document.getElementById('auSliderTrack');
        const dotsWrap = document.getElementById('auDots');
        const currentEl = document.getElementById('auCurrent');
        const progressEl = document.getElementById('auProgressFill');

        let current = 0;
        let timer = null;
        let progress = 0;
        let progTimer = null;

        /* Build dots */
        for (let i = 0; i < TOTAL; i++) {
            const d = document.createElement('button');
            d.className = 'au-dot' + (i === 0 ? ' active' : '');
            d.setAttribute('aria-label', 'Slide ' + (i + 1));
            d.addEventListener('click', () => goTo(i));
            dotsWrap.appendChild(d);
        }

        function goTo(idx) {
            current = (idx + TOTAL) % TOTAL;
            track.style.transform = `translateX(-${current * 100}%)`;

            /* Update dots */
            dotsWrap.querySelectorAll('.au-dot').forEach((d, i) => {
                d.classList.toggle('active', i === current);
            });

            /* Update counter */
            currentEl.textContent = String(current + 1).padStart(2, '0');

            /* Re-trigger animations on slide content */
            const slides = track.querySelectorAll('.au-slide');
            slides.forEach((s, i) => s.classList.toggle('au-slide-active', i === current));

            /* Restart progress */
            resetProgress();
        }

        /* Public nav function (called by buttons) */
        window.auSlide = function(dir) {
            clearInterval(timer);
            goTo(current + dir);
            startAuto();
        };

        /* Progress bar animation */
        function resetProgress() {
            clearInterval(progTimer);
            progress = 0;
            progressEl.style.transition = 'none';
            progressEl.style.width = '0%';
            requestAnimationFrame(() => {
                progressEl.style.transition = `width ${INTERVAL}ms linear`;
                progressEl.style.width = '100%';
            });
        }

        /* Auto-advance */
        function startAuto() {
            clearInterval(timer);
            resetProgress();
            timer = setInterval(() => goTo(current + 1), INTERVAL);
        }

        /* Pause on hover */
        const section = document.getElementById('amal-usaha-section');
        section.addEventListener('mouseenter', () => {
            clearInterval(timer);
            clearInterval(progTimer);
        });
        section.addEventListener('mouseleave', () => startAuto());

        /* Touch swipe */
        let touchStartX = 0;
        track.addEventListener('touchstart', e => {
            touchStartX = e.touches[0].clientX;
        }, {
            passive: true
        });
        track.addEventListener('touchend', e => {
            const diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 40) window.auSlide(diff > 0 ? 1 : -1);
        }, {
            passive: true
        });

        /* Init */
        startAuto();
    })();
</script>
