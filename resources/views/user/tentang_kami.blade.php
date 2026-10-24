@extends('layouts.user')

@section('title', 'Tentang Kami - JAITIN')

@section('styles')
<style>
    .about-page {
        --pink: #d19f94;
        --pink-dark: #98676d;
        --pink-hover: #79555a;
        --pink-light: #f5e7e2;
        --cream: #faf6f2;
        --white: #fffdfb;
        --text: #493936;
        --muted: #927f7b;
        --border: #eee1da;
        color: var(--text);
        overflow: hidden;
    }

    .about-hero {
        background: linear-gradient(120deg, #f5e7e2 0%, #faf6f2 65%, #fffdfb 100%);
        padding: 75px 24px;
    }

    .about-container {
        width: min(1120px, calc(100% - 40px));
        margin: auto;
    }

    .about-hero-grid {
        display: grid;
        grid-template-columns: 1.05fr .95fr;
        align-items: center;
        gap: 65px;
    }

    .about-label {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        background: var(--white);
        color: var(--pink-dark);
        padding: 9px 16px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 22px;
    }

    .about-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(36px, 5vw, 55px);
        line-height: 1.2;
        margin: 0 0 22px;
        font-weight: 700;
    }

    .about-hero h1 span {
        color: var(--pink-dark);
    }

    .about-hero p {
        font-size: 14px;
        line-height: 1.95;
        color: var(--muted);
        margin: 0 0 28px;
    }

    .about-hero-image {
        position: relative;
        min-height: 410px;
    }

    .about-hero-image img {
        width: 100%;
        height: 410px;
        object-fit: cover;
        display: block;
        border-radius: 150px 150px 22px 22px;
        box-shadow: 0 20px 50px rgba(73, 57, 54, .10);
    }

    .about-image-badge {
        position: absolute;
        bottom: 25px;
        left: -30px;
        background: var(--white);
        padding: 19px 22px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(73, 57, 54, .10);
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .about-image-badge i {
        width: 43px;
        height: 43px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--pink-light);
        color: var(--pink-dark);
        border-radius: 12px;
        font-size: 18px;
    }

    .about-image-badge strong {
        display: block;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .about-image-badge small {
        color: var(--muted);
        font-size: 11px;
    }

    .about-section {
        padding: 78px 0;
    }

    .about-heading {
        text-align: center;
        margin-bottom: 44px;
    }

    .about-eyebrow {
        font-size: 11px;
        color: var(--pink-dark);
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .about-heading h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(28px, 4vw, 39px);
        line-height: 1.3;
        margin: 0 0 14px;
    }

    .about-heading p {
        max-width: 660px;
        margin: auto;
        color: var(--muted);
        font-size: 14px;
        line-height: 1.9;
    }

    .story-grid {
        display: grid;
        grid-template-columns: .9fr 1.1fr;
        gap: 55px;
        align-items: center;
    }

    .story-image img {
        width: 100%;
        height: 420px;
        object-fit: cover;
        display: block;
        border-radius: 22px;
    }

    .story-content h3 {
        font-family: 'Playfair Display', serif;
        font-size: 29px;
        line-height: 1.4;
        margin: 0 0 20px;
    }

    .story-content p {
        color: var(--muted);
        font-size: 14px;
        line-height: 1.95;
        margin: 0 0 16px;
    }

    .story-highlight {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        padding: 18px;
        margin-top: 24px;
        background: var(--cream);
        border-radius: 14px;
    }

    .story-highlight i {
        color: var(--pink-dark);
        margin-top: 4px;
        font-size: 18px;
    }

    .story-highlight p {
        margin: 0;
        font-size: 13px;
    }

    .values-section {
        background: var(--cream);
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
    }

    .value-card {
        padding: 32px 26px;
        border: 1px solid var(--border);
        background: var(--white);
        border-radius: 20px;
        transition: transform .25s, box-shadow .25s;
    }

    .value-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(152, 103, 109, .09);
    }

    .value-icon {
        width: 55px;
        height: 55px;
        border-radius: 16px;
        background: var(--pink-light);
        color: var(--pink-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-bottom: 22px;
    }

    .value-card h3 {
        font-size: 17px;
        margin: 0 0 12px;
    }

    .value-card p {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.9;
        margin: 0;
    }

    .about-commitment {
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: center;
        gap: 55px;
    }

    .commitment-content h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(28px, 4vw, 38px);
        line-height: 1.35;
        margin: 0 0 20px;
    }

    .commitment-content > p {
        color: var(--muted);
        font-size: 14px;
        line-height: 1.95;
        margin: 0 0 24px;
    }

    .commitment-list {
        display: grid;
        gap: 17px;
    }

    .commitment-item {
        display: flex;
        gap: 13px;
        align-items: flex-start;
    }

    .commitment-item i {
        flex-shrink: 0;
        color: var(--pink-dark);
        font-size: 17px;
        margin-top: 3px;
    }

    .commitment-item strong {
        display: block;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .commitment-item span {
        color: var(--muted);
        font-size: 12px;
        line-height: 1.8;
    }

    .commitment-image img {
        display: block;
        width: 100%;
        height: 440px;
        object-fit: cover;
        border-radius: 22px;
    }

    .about-cta {
        padding: 0 20px 80px;
    }

    .about-cta-inner {
        width: min(1120px, 100%);
        margin: auto;
        padding: 54px 28px;
        background: linear-gradient(120deg, #98676d, #c18e88);
        border-radius: 26px;
        color: white;
        text-align: center;
    }

    .about-cta-inner h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(28px, 4vw, 39px);
        margin: 0 0 14px;
    }

    .about-cta-inner p {
        max-width: 600px;
        margin: 0 auto 27px;
        color: #fff0ed;
        font-size: 14px;
        line-height: 1.9;
    }

    .about-actions {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .about-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 13px 22px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        transition: .2s;
    }

    .about-btn-light {
        background: var(--white);
        color: var(--pink-hover);
    }

    .about-btn-light:hover {
        background: var(--pink-light);
        color: var(--pink-hover);
    }

    .about-btn-outline {
        color: white;
        border: 1px solid rgba(255,255,255,.75);
    }

    .about-btn-outline:hover {
        color: white;
        background: rgba(255,255,255,.12);
    }

    @media (max-width: 900px) {
        .about-hero-grid {
            gap: 35px;
        }

        .about-hero-image,
        .about-hero-image img {
            min-height: 340px;
            height: 340px;
        }

        .story-grid,
        .about-commitment {
            gap: 32px;
        }

        .values-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 650px) {
        .about-container {
            width: min(100% - 32px, 1120px);
        }

        .about-hero {
            padding: 52px 0 60px;
        }

        .about-hero-grid,
        .story-grid,
        .about-commitment {
            grid-template-columns: 1fr;
        }

        .about-hero-grid {
            gap: 35px;
        }

        .about-hero-image,
        .about-hero-image img {
            height: 320px;
            min-height: 320px;
        }

        .about-hero-image img {
            border-radius: 110px 110px 20px 20px;
        }

        .about-image-badge {
            left: 10px;
            bottom: 15px;
        }

        .about-section {
            padding: 55px 0;
        }

        .about-heading {
            margin-bottom: 30px;
        }

        .story-image img,
        .commitment-image img {
            height: 300px;
        }

        .story-content h3 {
            font-size: 25px;
        }

        .values-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .value-card {
            padding: 25px;
        }

        .about-cta {
            padding-bottom: 55px;
        }

        .about-cta-inner {
            padding: 40px 22px;
        }

        .about-btn {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="about-page">

    {{-- HERO --}}
    <section class="about-hero">
        <div class="about-container">
            <div class="about-hero-grid">
                <div class="about-hero-content">
                    <div class="about-label">
                        <i class="fa-solid fa-heart"></i>
                        Tentang JAITIN
                    </div>

                    <h1>
                        Setiap Jahitan Punya <span>Cerita</span>
                    </h1>

                    <p>
                        JAITIN hadir sebagai sistem informasi pemesanan
                        jahitan yang membantu pelanggan menemukan layanan
                        jahit sesuai kebutuhan. Kami ingin membuat proses
                        pemesanan terasa lebih praktis, teratur, dan mudah
                        dipahami.
                    </p>

                    <p>
                        Dari pilihan model hingga pengajuan detail pesanan,
                        JAITIN dirancang untuk membantu menghubungkan
                        kebutuhan pelanggan dengan layanan jahit.
                    </p>
                </div>

                <div class="about-hero-image">
                    <img
                        src="https://esmodjakarta.com/assets/efn/upload/images/MARCOM/woman.sewing.on.sewing.machine.2023.11.27.05.37.20.utc_optimal.webp"
                        alt="Aktivitas menjahit dan pembuatan pakaian"
                        loading="lazy"
                    >

                    <div class="about-image-badge">
                        <i class="fa-solid fa-scissors"></i>
                        <div>
                            <strong>Detail dalam Setiap Jahitan</strong>
                            <small>Berawal dari kebutuhanmu</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CERITA KAMI --}}
    <section class="about-section">
        <div class="about-container">
            <div class="story-grid">
                <div class="story-image">
                    <img
                        src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=900&q=85"
                        alt="Peralatan dan proses pembuatan pakaian"
                        loading="lazy"
                    >
                </div>

                <div class="story-content">
                    <div class="about-eyebrow">Cerita Kami</div>

                    <h3>Membuat Pemesanan Jahitan Lebih Praktis</h3>

                    <p>
                        Memesan pakaian sesuai keinginan membutuhkan
                        komunikasi yang jelas antara pelanggan dan
                        penyedia layanan jahit. Informasi mengenai model,
                        ukuran, dan detail pakaian menjadi bagian penting
                        dari proses tersebut.
                    </p>

                    <p>
                        Melalui JAITIN, kami menghadirkan sebuah platform
                        berbasis web yang dirancang untuk membantu
                        pelanggan melihat pilihan layanan dan mengajukan
                        pesanan secara lebih terstruktur.
                    </p>

                    <p>
                        Kami percaya bahwa pengalaman pemesanan yang baik
                        dimulai dari informasi yang mudah dipahami dan
                        proses yang jelas.
                    </p>

                    <div class="story-highlight">
                        <i class="fa-solid fa-quote-left"></i>
                        <p>
                            Setiap kebutuhan pakaian itu unik. JAITIN hadir
                            untuk membantu proses pemesanan menjadi lebih
                            mudah dan terorganisasi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- NILAI KAMI --}}
    <section class="about-section values-section">
        <div class="about-container">
            <div class="about-heading">
                <div class="about-eyebrow">Nilai Kami</div>
                <h2>Apa yang Kami Utamakan?</h2>
                <p>
                    JAITIN dikembangkan dengan fokus pada pengalaman
                    pelanggan dan pengelolaan informasi pemesanan yang
                    lebih baik.
                </p>
            </div>

            <div class="values-grid">
                <article class="value-card">
                    <div class="value-icon">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <h3>Berorientasi pada Pelanggan</h3>
                    <p>
                        Membantu pelanggan menemukan layanan yang sesuai
                        dan menyampaikan kebutuhan jahitan dengan lebih
                        jelas.
                    </p>
                </article>

                <article class="value-card">
                    <div class="value-icon">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <h3>Informasi Terstruktur</h3>
                    <p>
                        Membantu proses pengajuan pesanan agar detail yang
                        dibutuhkan dapat dicatat secara lebih teratur.
                    </p>
                </article>

                <article class="value-card">
                    <div class="value-icon">
                        <i class="fa-solid fa-laptop"></i>
                    </div>
                    <h3>Kemudahan Digital</h3>
                    <p>
                        Memanfaatkan platform berbasis web agar informasi
                        layanan dan pemesanan dapat diakses dengan lebih
                        praktis.
                    </p>
                </article>
            </div>
        </div>
    </section>

    {{-- VISI DAN KOMITMEN --}}
    <section class="about-section">
        <div class="about-container">
            <div class="about-commitment">
                <div class="commitment-content">
                    <div class="about-eyebrow">Visi dan Komitmen</div>

                    <h2>Mendukung Pengalaman Pemesanan yang Lebih Baik</h2>

                    <p>
                        JAITIN bertujuan menjadi platform pemesanan jahitan
                        yang praktis dan mudah digunakan, sekaligus
                        mendukung pengelolaan informasi pesanan secara
                        lebih teratur.
                    </p>

                    <div class="commitment-list">
                        <div class="commitment-item">
                            <i class="fa-solid fa-circle-check"></i>
                            <div>
                                <strong>Proses yang Jelas</strong>
                                <span>
                                    Menyediakan panduan agar pelanggan
                                    memahami tahapan pemesanan.
                                </span>
                            </div>
                        </div>

                        <div class="commitment-item">
                            <i class="fa-solid fa-circle-check"></i>
                            <div>
                                <strong>Detail yang Terorganisasi</strong>
                                <span>
                                    Membantu pencatatan kebutuhan dan
                                    keterangan pesanan secara terstruktur.
                                </span>
                            </div>
                        </div>

                        <div class="commitment-item">
                            <i class="fa-solid fa-circle-check"></i>
                            <div>
                                <strong>Pengalaman yang Mudah Digunakan</strong>
                                <span>
                                    Mengutamakan tampilan yang nyaman
                                    digunakan melalui komputer maupun
                                    perangkat seluler.
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="commitment-image">
                    <img
                        src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1000&q=85"
                        alt="Inspirasi gaya dan pakaian"
                        loading="lazy"
                    >
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="about-cta">
        <div class="about-cta-inner">
            <h2>Temukan Layanan Jahit yang Sesuai</h2>

            <p>
                Jelajahi pilihan model dan layanan jahit di JAITIN.
                Mulai perjalananmu untuk mewujudkan pakaian sesuai
                kebutuhan dan keinginanmu.
            </p>

            <div class="about-actions">
                <a href="{{ route('user.katalog') }}"
                   class="about-btn about-btn-light">
                    <i class="fa-solid fa-shirt"></i>
                    Jelajahi Katalog
                </a>

                <a href="{{ route('user.layanan') }}"
                   class="about-btn about-btn-outline">
                    <i class="fa-solid fa-scissors"></i>
                    Lihat Layanan Jahit
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
