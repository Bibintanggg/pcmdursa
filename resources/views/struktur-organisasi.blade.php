<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Struktur Organisasi</title>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
@vite(['resources/css/app.css','resources/js/app.js'])

<style>
:root {
    --bg: #fafcff; /* Background sedikit kebiruan/dingin untuk kesan clean */
    --text: #0f172a;
    --muted: #64748b;
    --line: rgba(15, 23, 42, 0.08); /* Garis yang lebih subtle */
    --card-bg: #ffffff;
}

* { box-sizing: border-box; margin: 0; padding: 0; }

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--bg);
    color: var(--text);
    /* Menambahkan subtle mesh gradient di background atas */
    background-image: radial-gradient(at 50% 0%, rgba(238, 242, 255, 1) 0%, transparent 50%);
    background-repeat: no-repeat;
}

/* ===== HERO ===== */
.hero {
    padding: 120px 24px 60px;
    text-align: center;
}

.hero h1 {
    font-size: 52px;
    font-weight: 800;
    letter-spacing: -0.04em;
    line-height: 1.1;
    /* Efek teks gradient halus */
    background: linear-gradient(135deg, #0f172a 0%, #475569 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 12px;
}

.hero p {
    font-size: 16px;
    color: var(--muted);
    font-weight: 500;
    max-width: 400px;
    margin: 0 auto;
}

/* ===== SECTION ===== */
.section {
    padding: 20px 24px 120px;
}

.inner {
    max-width: 1100px;
    margin: 0 auto;
}

.level {
    margin-bottom: 40px;
}

.level-label {
    text-align: center;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
}

/* Garis dekoratif di samping label */
.level-label::before,
.level-label::after {
    content: '';
    height: 1px;
    width: 30px;
    background: var(--line);
}

/* ===== GRID ===== */
.row {
    display: flex;
    justify-content: center;
    gap: 32px;
    flex-wrap: wrap;
}

/* ===== CARD ===== */
.card {
    width: 220px;
    padding: 35px 25px;
    border-radius: 24px;
    background: var(--card-bg);
    text-align: center;
    /* Soft shadow khas UI modern */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03), inset 0 0 0 1px var(--line);
    transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1); /* Animasi lebih fluid */

    /* Setup untuk animasi scroll */
    opacity: 0;
    transform: translateY(30px) scale(0.95);
}

.card.reveal {
    opacity: 1;
    transform: translateY(0) scale(1);
}

.card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08), inset 0 0 0 1px rgba(15, 23, 42, 0.1);
}

.avatar {
    width: 84px;
    height: 84px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 20px;
    background: #f1f5f9;
    /* Tambahan ring halus di luar avatar */
    box-shadow: 0 0 0 4px #ffffff, 0 0 0 5px var(--line);
    transition: all 0.5s ease;
}

.avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: grayscale(100%) contrast(1.1);
    transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.card:hover .avatar {
    box-shadow: 0 0 0 4px #ffffff, 0 0 0 6px #cbd5e1;
}

.card:hover .avatar img {
    filter: grayscale(0%) contrast(1);
    transform: scale(1.1); /* Efek zoom in halus pada gambar */
}

.name {
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 6px;
    color: var(--text);
}

.role {
    font-size: 12px;
    font-weight: 500;
    color: var(--muted);
    padding: 4px 10px;
    background: #f8fafc;
    border-radius: 20px;
    display: inline-block;
}

/* ===== CONNECTOR ===== */
.connector {
    width: 2px;
    height: 60px;
    margin: 0 auto 40px;
    /* Gradient fade-out agar tidak kaku */
    background: linear-gradient(to bottom, rgba(15,23,42,0) 0%, rgba(15,23,42,0.1) 50%, rgba(15,23,42,0) 100%);
}

@media(max-width: 640px) {
    .hero h1 { font-size: 38px; }
    .card { width: 100%; max-width: 260px; }
    .row { gap: 20px; }
}
</style>
</head>

<body>

@include('layouts.navigation')

<section class="hero">
    <h1>Struktur<br>Organisasi</h1>
    <p>Susunan kepengurusan periode aktif yang siap membawa perubahan.</p>
</section>

<section class="section">
<div class="inner">

@php
$lv1 = $strukturs->where('peran_level', 1);
$lv2 = $strukturs->where('peran_level', 2);
$lv3 = $strukturs->where('peran_level', 3);
@endphp

<!-- LEVEL 1 -->
@if($lv1->count())
<div class="level">
    <div class="level-label">Pimpinan</div>
    <div class="row">
        @foreach($lv1 as $item)
        <div class="card">
            <div class="avatar">
                @if($item->image)
                    <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->nama }}">
                @endif
            </div>
            <div class="name">{{ $item->nama }}</div>
            <div class="role">{{ $item->peran }}</div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- LEVEL 2 -->
@if($lv2->count())
<div class="connector"></div>
<div class="level">
    <div class="level-label">Sekretariat & Bendahara</div>
    <div class="row">
        @foreach($lv2 as $item)
        <div class="card">
            <div class="avatar">
                @if($item->image)
                    <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->nama }}">
                @endif
            </div>
            <div class="name">{{ $item->nama }}</div>
            <div class="role">{{ $item->peran }}</div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- LEVEL 3 -->
@if($lv3->count())
<div class="connector"></div>
<div class="level">
    <div class="level-label">Bidang & Divisi</div>
    <div class="row">
        @foreach($lv3 as $item)
        <div class="card">
            <div class="avatar">
                @if($item->image)
                    <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->nama }}">
                @endif
            </div>
            <div class="name">{{ $item->nama }}</div>
            <div class="role">{{ $item->peran }}</div>
        </div>
        @endforeach
    </div>
</div>
@endif

</div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. Setup Staggering Delay untuk setiap baris
    const rows = document.querySelectorAll('.row');
    rows.forEach(row => {
        const cards = row.querySelectorAll('.card');
        cards.forEach((card, index) => {
            // Memberikan delay dinamis, jadi kartu muncul bergantian dari kiri ke kanan
            card.style.transitionDelay = `${index * 0.15}s`;
        });
    });

    // 2. Intersection Observer untuk memicu animasi
    const cards = document.querySelectorAll('.card');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if(entry.isIntersecting) {
                entry.target.classList.add('reveal');
                // Hentikan observasi setelah muncul agar animasi tidak terulang-ulang terus
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1, // Trigger lebih awal agar terasa lebih responsif
        rootMargin: "0px 0px -50px 0px"
    });

    cards.forEach(card => observer.observe(card));
});
</script>

</body>
</html>
