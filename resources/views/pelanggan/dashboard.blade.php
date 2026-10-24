@extends('layouts.pelanggan')

@section('title', 'Dashboard Pelanggan - JAITIN')
@section('page-title', 'Dashboard Pelanggan')
@section('page-description', 'Selamat datang di ruang personal JAITIN.')

@section('styles')
<style>
    .dashboard {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        color: #4b3832;
    }

    .dashboard,
    .dashboard * {
        box-sizing: border-box;
    }

    .welcome-banner {
        position: relative;
        isolation: isolate;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 26px;
        padding: clamp(24px, 3vw, 36px);
        margin-bottom: 30px;
        border: 1px solid rgba(255, 255, 255, .25);
        border-radius: 24px;
        background: linear-gradient(120deg, #a9747b 0%, #b8898d 48%, #d6a9a4 100%);
        color: #fff;
        box-shadow: 0 12px 30px rgba(184, 137, 141, .18);
    }

    .welcome-banner::before,
    .welcome-banner::after {
        position: absolute;
        z-index: -1;
        border-radius: 50%;
        background: rgba(255, 255, 255, .11);
        content: "";
        pointer-events: none;
    }

    .welcome-banner::before {
        width: 240px;
        height: 240px;
        top: -125px;
        right: -55px;
    }

    .welcome-banner::after {
        width: 150px;
        height: 150px;
        right: 155px;
        bottom: -105px;
        background: rgba(255, 255, 255, .08);
    }

    .welcome-text {
        position: relative;
        z-index: 1;
        flex: 1;
        min-width: 0;
        max-width: 680px;
    }

    .welcome-label {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 12px;
        margin-bottom: 15px;
        border: 1px solid rgba(255, 255, 255, .24);
        border-radius: 30px;
        background: rgba(255, 255, 255, .15);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .7px;
    }

    .welcome-banner h2 {
        margin: 0 0 12px;
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(25px, 3vw, 35px);
        line-height: 1.3;
        overflow-wrap: anywhere;
    }

    .welcome-banner p {
        max-width: 570px;
        margin: 0;
        color: #fff8f6;
        font-size: 14px;
        line-height: 1.85;
    }

    .welcome-action {
        position: relative;
        z-index: 1;
        flex-shrink: 0;
    }

    .btn-order {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-height: 48px;
        padding: 13px 18px;
        border: 1px solid rgba(255, 255, 255, .65);
        border-radius: 13px;
        background: #fffaf5;
        color: #986b71;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        box-shadow: 0 5px 14px rgba(72, 43, 45, .08);
        transition: background .2s ease, transform .2s ease, box-shadow .2s ease;
    }

    .btn-order:hover {
        background: #f8eae5;
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(72, 43, 45, .12);
    }

    .btn-order:focus-visible,
    .service-card:focus-visible {
        outline: 3px solid rgba(164, 111, 118, .45);
        outline-offset: 3px;
    }

    .section-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 17px;
    }

    .section-heading h2 {
        margin: 0;
        color: #59433d;
        font-size: 20px;
        font-weight: 700;
        letter-spacing: -.3px;
    }

    .section-heading p {
        margin: 6px 0 0;
        color: #8c7770;
        font-size: 13px;
        line-height: 1.6;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 17px;
        margin-bottom: 32px;
    }

    .stat-card {
        display: flex;
        align-items: center;
        gap: 15px;
        min-width: 0;
        padding: 22px;
        border: 1px solid #eee0d7;
        border-radius: 19px;
        background: #fffaf5;
        box-shadow: 0 5px 18px rgba(90, 62, 49, .035);
        transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        border-color: #e4c9c7;
        box-shadow: 0 12px 25px rgba(90, 62, 49, .07);
    }

    .stat-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 52px;
        width: 52px;
        height: 52px;
        border-radius: 16px;
        font-size: 23px;
    }

    .stat-icon.pink { background: #f5e2e3; }
    .stat-icon.cream { background: #f5ead8; }
    .stat-icon.green { background: #e1eee2; }

    .stat-info { min-width: 0; }
    .stat-info p {
        margin: 0 0 7px;
        color: #89766f;
        font-size: 12px;
        line-height: 1.5;
    }
    .stat-info h3 {
        margin: 0;
        color: #59433d;
        font-size: clamp(24px, 2.3vw, 29px);
        line-height: 1.2;
        overflow-wrap: anywhere;
    }

    .services-section { margin-bottom: 30px; }
    .services-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 17px;
    }

    .service-card {
        display: flex;
        flex-direction: column;
        min-width: 0;
        min-height: 205px;
        padding: 22px;
        border: 1px solid #eee0d7;
        border-radius: 19px;
        background: #fffaf5;
        color: #4b3832;
        text-decoration: none;
        box-shadow: 0 4px 14px rgba(90, 62, 49, .025);
        transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease;
    }

    .service-card:hover {
        transform: translateY(-4px);
        border-color: #d6a9a4;
        box-shadow: 0 12px 26px rgba(90, 62, 49, .07);
    }

    .service-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 48px;
        width: 48px;
        height: 48px;
        margin-bottom: 17px;
        border-radius: 15px;
        background: #f4e4e1;
        font-size: 22px;
    }

    .service-card h3 {
        margin: 0 0 8px;
        color: #59433d;
        font-size: 15px;
        line-height: 1.45;
    }

    .service-card p {
        margin: 0;
        color: #8c7770;
        font-size: 12px;
        line-height: 1.75;
    }

    .service-arrow {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-top: auto;
        padding-top: 17px;
        color: #a46f76;
        font-size: 12px;
        font-weight: 700;
    }

    .service-arrow span:last-child {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 27px;
        height: 27px;
        border-radius: 9px;
        background: #f7e9e6;
        transition: transform .2s ease;
    }

    .service-card:hover .service-arrow span:last-child {
        transform: translateX(3px);
    }

    .information-card {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 23px;
        border: 1px solid #ead8cc;
        border-radius: 19px;
        background: linear-gradient(120deg, #f3e4d8, #fff7ef);
    }

    .information-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 45px;
        width: 45px;
        height: 45px;
        border: 1px solid rgba(234, 216, 204, .8);
        border-radius: 14px;
        background: #fffaf5;
        font-size: 21px;
    }

    .information-card h3 {
        margin: 1px 0 8px;
        color: #59433d;
        font-size: 15px;
    }

    .information-card p {
        margin: 0;
        color: #806e69;
        font-size: 12px;
        line-height: 1.85;
    }

    @media (max-width: 1100px) {
        .services-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .welcome-banner { align-items: flex-start; flex-direction: column; }
        .welcome-action { width: 100%; }
        .btn-order { max-width: 100%; }
    }

    @media (max-width: 800px) {
        .welcome-banner { margin-bottom: 24px; }
        .stats-grid { gap: 12px; margin-bottom: 27px; }
        .stat-card { padding: 17px; }
        .services-grid { gap: 12px; }
        .service-card { min-height: 195px; padding: 17px; }
    }

    @media (max-width: 560px) {
        .welcome-banner {
            gap: 20px;
            padding: 23px 19px;
            border-radius: 19px;
        }
        .welcome-label { margin-bottom: 12px; font-size: 10px; }
        .welcome-banner h2 { font-size: 25px; }
        .welcome-banner p { font-size: 12px; line-height: 1.8; }
        .welcome-action, .btn-order { width: 100%; }
        .btn-order { padding: 13px 12px; font-size: 12px; }
        .section-heading { margin-bottom: 14px; }
        .section-heading h2 { font-size: 18px; }
        .section-heading p { font-size: 12px; }
        .stats-grid { grid-template-columns: 1fr; gap: 10px; }
        .stat-card { padding: 15px 16px; border-radius: 15px; }
        .stat-icon { flex-basis: 46px; width: 46px; height: 46px; border-radius: 14px; font-size: 21px; }
        .stat-info p { margin-bottom: 4px; }
        .stat-info h3 { font-size: 25px; }
        .services-grid { grid-template-columns: 1fr; gap: 11px; }
        .service-card {
            display: grid;
            grid-template-columns: 46px minmax(0, 1fr);
            column-gap: 13px;
            min-height: 0;
            padding: 16px;
            border-radius: 16px;
        }
        .service-icon {
            grid-column: 1;
            grid-row: 1 / span 2;
            width: 46px;
            height: 46px;
            margin: 0;
            border-radius: 14px;
            font-size: 21px;
        }
        .service-card h3 { grid-column: 2; margin: 1px 0 5px; font-size: 14px; }
        .service-card p { grid-column: 2; font-size: 12px; line-height: 1.65; }
        .service-arrow {
            grid-column: 2;
            padding-top: 12px;
        }
        .information-card { gap: 12px; padding: 17px; border-radius: 16px; }
        .information-icon { flex-basis: 39px; width: 39px; height: 39px; font-size: 19px; }
        .information-card h3 { font-size: 14px; }
        .information-card p { font-size: 12px; line-height: 1.75; }
    }

    @media (prefers-reduced-motion: reduce) {
        .dashboard *,
        .dashboard *::before,
        .dashboard *::after {
            transition-duration: .01ms !important;
            animation-duration: .01ms !important;
            scroll-behavior: auto !important;
        }
    }
</style>
@endsection

@section('content')
<div class="dashboard">
    {{-- BANNER SAMBUTAN --}}
    <section class="welcome-banner">
        <div class="welcome-text">
            <span class="welcome-label">✦ RUANG PERSONAL JAITIN</span>
            <h2>
                Halo, {{ Auth::user()->nama ?? 'Pelanggan' }}! 👋
                <br>Mau jahit apa hari ini?
            </h2>
            <p>
                Wujudkan pakaian impianmu bersama JAITIN.
                Pesan jasa jahit, pantau proses pengerjaan,
                dan kelola kebutuhan jahitanmu dengan mudah
                dalam satu tempat.
            </p>
        </div>

        <div class="welcome-action">
            <a href="{{ route('pelanggan.pesanan.create') }}" class="btn-order">
                <span aria-hidden="true">✂️</span>
                <span>Pesan Jahitan Sekarang</span>
                <span aria-hidden="true">→</span>
            </a>
        </div>
    </section>

    {{-- STATISTIK --}}
    <section aria-labelledby="summary-heading">
        <div class="section-heading">
            <div>
                <h2 id="summary-heading">Ringkasan Pesanan</h2>
                <p>Pantau aktivitas pesanan jahitmu di sini.</p>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon pink" aria-hidden="true">🧵</div>
                <div class="stat-info">
                    <p>Pesanan Aktif</p>
                    <h3>{{ $pesananAktif ?? 0 }}</h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon cream" aria-hidden="true">💳</div>
                <div class="stat-info">
                    <p>Menunggu Pembayaran</p>
                    <h3>{{ $menungguPembayaran ?? 0 }}</h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green" aria-hidden="true">📦</div>
                <div class="stat-info">
                    <p>Siap Diambil</p>
                    <h3>{{ $siapDiambil ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </section>

    {{-- LAYANAN --}}
    <section class="services-section" aria-labelledby="services-heading">
        <div class="section-heading">
            <div>
                <h2 id="services-heading">Layanan untukmu</h2>
                <p>Semua kebutuhan jahitmu, praktis dalam satu klik.</p>
            </div>
        </div>

        <div class="services-grid">
            <a href="{{ route('pelanggan.pesanan.create') }}" class="service-card">
                <div class="service-icon" aria-hidden="true">✂️</div>
                <h3>Pesan Jasa Jahit</h3>
                <p>Mulai pesanan baru dan pilih model pakaian sesuai keinginanmu.</p>
                <div class="service-arrow"><span>Buat pesanan</span><span aria-hidden="true">→</span></div>
            </a>

            <a href="{{ route('pelanggan.pesanan.index') }}" class="service-card">
                <div class="service-icon" aria-hidden="true">📋</div>
                <h3>Pesanan Saya</h3>
                <p>Lihat daftar pesanan dan pantau perkembangan pengerjaannya.</p>
                <div class="service-arrow"><span>Lihat pesanan</span><span aria-hidden="true">→</span></div>
            </a>

            <a href="{{ route('dashboard') }}" class="service-card">
                <div class="service-icon" aria-hidden="true">📏</div>
                <h3>Ukuran Saya</h3>
                <p>Kelola informasi ukuran tubuh untuk kebutuhan jahitan.</p>
                <div class="service-arrow"><span>Kelola ukuran</span><span aria-hidden="true">→</span></div>
            </a>

            <a href="{{ route('dashboard') }}" class="service-card">
                <div class="service-icon" aria-hidden="true">💳</div>
                <h3>Pembayaran</h3>
                <p>Periksa informasi pembayaran dan status transaksi pesanan.</p>
                <div class="service-arrow"><span>Lihat pembayaran</span><span aria-hidden="true">→</span></div>
            </a>

            <a href="{{ route('dashboard') }}" class="service-card">
                <div class="service-icon" aria-hidden="true">🪡</div>
                <h3>Riwayat Revisi</h3>
                <p>Lihat catatan perubahan atau revisi pada pesanan jahitmu.</p>
                <div class="service-arrow"><span>Lihat revisi</span><span aria-hidden="true">→</span></div>
            </a>

            <a href="{{ route('dashboard') }}" class="service-card">
                <div class="service-icon" aria-hidden="true">🎁</div>
                <h3>Pengambilan</h3>
                <p>Periksa informasi penyelesaian dan pengambilan pakaian.</p>
                <div class="service-arrow"><span>Info pengambilan</span><span aria-hidden="true">→</span></div>
            </a>
        </div>
    </section>

    {{-- INFORMASI --}}
    <section class="information-card" aria-labelledby="tips-heading">
        <div class="information-icon" aria-hidden="true">💡</div>
        <div>
            <h3 id="tips-heading">Tips menggunakan JAITIN</h3>
            <p>
                Mulailah dengan memilih <strong>Pesan Jasa Jahit</strong>.
                Kamu dapat memilih referensi model yang tersedia atau
                mengunggah model pilihan sendiri. Setelah pesanan dikirim,
                admin akan memeriksa detail pesanan dan menginformasikan
                harga serta tahapan selanjutnya. Pastikan informasi ukuran
                dan detail pesanan sudah sesuai sebelum dikirim.
            </p>
        </div>
    </section>
</div>
@endsection
