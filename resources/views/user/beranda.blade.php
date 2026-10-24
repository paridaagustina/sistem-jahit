@extends('layouts.user')

@section('title', 'Beranda - JAITIN')

@section('styles')
<style>
    .home-page {
        overflow: hidden;
    }

    .hero {
        position: relative;
        display: grid;
        grid-template-columns: 1.05fr .95fr;
        align-items: center;
        gap: 45px;
        min-height: 500px;
        padding: 65px 7%;
        overflow: hidden;
        background: linear-gradient(120deg, #fbf1ed 0%, #f5e7e2 55%, #f8eee8 100%);
    }

    .hero::before {
        position: absolute;
        top: -130px;
        right: -80px;
        width: 340px;
        height: 340px;
        border: 1px solid rgba(152, 103, 109, .12);
        border-radius: 50%;
        content: "";
    }

    .hero-content {
        position: relative;
        z-index: 1;
        max-width: 570px;
    }

    .hero-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 14px;
        margin-bottom: 22px;
        border: 1px solid #e9d4cf;
        border-radius: 30px;
        background: rgba(255, 253, 251, .8);
        color: var(--primary-dark);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .5px;
    }

    .hero h1 {
        margin-bottom: 20px;
        color: var(--text);
        font-family: 'Playfair Display', serif;
        font-size: clamp(36px, 4.2vw, 57px);
        line-height: 1.18;
        letter-spacing: -.8px;
    }

    .hero h1 span {
        color: var(--primary-dark);
    }

    .hero-description {
        max-width: 470px;
        margin-bottom: 28px;
        color: #806c67;
        font-size: 14px;
        line-height: 1.9;
    }

    .hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .hero-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        min-height: 48px;
        padding: 13px 21px;
        border: 1px solid transparent;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 700;
        transition: .2s ease;
    }

    .hero-btn-primary {
        background: var(--primary-dark);
        color: white;
        box-shadow: 0 7px 18px rgba(152, 103, 109, .16);
    }

    .hero-btn-primary:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
    }

    .hero-btn-secondary {
        border-color: #e5d2cc;
        background: rgba(255, 253, 251, .8);
        color: var(--primary-dark);
    }

    .hero-btn-secondary:hover {
        background: white;
        border-color: var(--primary);
    }

    .hero-visual {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 360px;
    }

    .hero-image-frame {
        position: relative;
        width: 100%;
        max-width: 430px;
        height: 360px;
        padding: 10px;
        border: 1px solid rgba(255, 255, 255, .8);
        border-radius: 48% 48% 22px 22px;
        background: rgba(255, 253, 251, .6);
        box-shadow: 0 18px 45px rgba(120, 90, 80, .12);
        transform: rotate(2deg);
    }

    .hero-image-frame img {
        width: 100%;
        height: 100%;
        border-radius: 48% 48% 17px 17px;
        object-fit: cover;
    }

    .hero-floating-card {
        position: absolute;
        right: -4px;
        bottom: 30px;
        display: flex;
        align-items: center;
        gap: 12px;
        max-width: 235px;
        padding: 15px 18px;
        border: 1px solid var(--border);
        border-radius: 15px;
        background: var(--white);
        box-shadow: 0 12px 30px rgba(73, 57, 54, .1);
        transform: rotate(-2deg);
    }

    .floating-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        border-radius: 12px;
        background: var(--primary-light);
        color: var(--primary-dark);
        font-size: 18px;
    }

    .hero-floating-card strong {
        display: block;
        color: var(--text);
        font-size: 12px;
    }

    .hero-floating-card span {
        display: block;
        margin-top: 3px;
        color: var(--muted);
        font-size: 10px;
    }

    /* KEUNGGULAN */
    .benefits {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        padding: 28px 7%;
        border-bottom: 1px solid var(--border);
        background: var(--white);
    }

    .benefit-item {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 13px;
        padding: 10px;
    }

    .benefit-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        flex-shrink: 0;
        border-radius: 13px;
        background: #f7e9e7;
        color: var(--primary-dark);
        font-size: 18px;
    }

    .benefit-item h3 {
        margin-bottom: 3px;
        color: var(--text);
        font-size: 12px;
    }

    .benefit-item p {
        color: var(--muted);
        font-size: 11px;
    }

    /* SECTION UMUM */
    .home-section {
        padding: 75px 7%;
    }

    .section-heading {
        max-width: 620px;
        margin: 0 auto 38px;
        text-align: center;
    }

    .section-eyebrow {
        display: inline-block;
        margin-bottom: 10px;
        color: var(--primary-dark);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.8px;
        text-transform: uppercase;
    }

    .section-heading h2 {
        margin-bottom: 12px;
        color: var(--text);
        font-family: 'Playfair Display', serif;
        font-size: clamp(27px, 3vw, 36px);
        line-height: 1.3;
    }

    .section-heading p {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.8;
    }

    /* KATEGORI */
    .category-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
        max-width: 1100px;
        margin: 0 auto;
    }

    .category-card {
        overflow: hidden;
        border: 1px solid var(--border);
        border-radius: 18px;
        background: var(--white);
        box-shadow: 0 5px 20px rgba(120, 90, 80, .035);
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 30px rgba(120, 90, 80, .09);
    }

    .category-image {
        height: 235px;
        overflow: hidden;
        background: var(--primary-light);
    }

    .category-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .4s ease;
    }

    .category-card:hover .category-image img {
        transform: scale(1.05);
    }

    .category-body {
        padding: 21px;
    }

    .category-body h3 {
        margin-bottom: 8px;
        color: var(--text);
        font-family: 'Playfair Display', serif;
        font-size: 19px;
    }

    .category-body p {
        min-height: 43px;
        margin-bottom: 18px;
        color: var(--muted);
        font-size: 12px;
        line-height: 1.8;
    }

    .category-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary-dark);
        font-size: 12px;
        font-weight: 700;
    }

    .category-link:hover {
        color: var(--primary-hover);
    }

    /* CARA PEMESANAN */
    .steps-section {
        background: #f6eae6;
    }

    .steps-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
        max-width: 1100px;
        margin: 0 auto;
    }

    .step-card {
        position: relative;
        padding: 27px 24px;
        border: 1px solid #ead8d1;
        border-radius: 16px;
        background: rgba(255, 253, 251, .8);
    }

    .step-number {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        margin-bottom: 19px;
        border-radius: 14px;
        background: var(--primary-dark);
        color: white;
        font-family: 'Playfair Display', serif;
        font-size: 19px;
        font-weight: 700;
    }

    .step-card h3 {
        margin-bottom: 9px;
        color: var(--text);
        font-size: 14px;
    }

    .step-card p {
        color: var(--muted);
        font-size: 12px;
        line-height: 1.9;
    }

    /* CTA */
    .home-cta {
        padding: 65px 7%;
        background: var(--white);
    }

    .cta-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
        max-width: 1100px;
        padding: 38px 42px;
        margin: 0 auto;
        border-radius: 22px;
        background: linear-gradient(115deg, #f4e2df, #fbf1ed);
    }

    .cta-inner h2 {
        margin-bottom: 8px;
        color: var(--text);
        font-family: 'Playfair Display', serif;
        font-size: clamp(23px, 3vw, 32px);
    }

    .cta-inner p {
        max-width: 560px;
        color: #806c67;
        font-size: 12px;
        line-height: 1.8;
    }

    .cta-inner .hero-btn {
        flex-shrink: 0;
    }

    @media (max-width: 900px) {
        .hero {
            gap: 25px;
            padding: 50px 5%;
        }

        .hero-image-frame {
            height: 310px;
        }

        .hero-visual {
            min-height: 320px;
        }

        .home-section,
        .home-cta {
            padding: 60px 5%;
        }

        .category-image {
            height: 195px;
        }

        .category-body {
            padding: 17px;
        }
    }

    @media (max-width: 680px) {
        .hero {
            grid-template-columns: 1fr;
            gap: 32px;
            padding: 48px 6% 38px;
        }

        .hero h1 {
            font-size: 39px;
        }

        .hero-description {
            font-size: 13px;
        }

        .hero-visual {
            min-height: 290px;
            padding: 0 12px;
        }

        .hero-image-frame {
            max-width: 360px;
            height: 285px;
        }

        .hero-floating-card {
            right: 0;
            bottom: 15px;
        }

        .benefits {
            grid-template-columns: 1fr;
            gap: 7px;
            padding: 20px 6%;
        }

        .benefit-item {
            justify-content: flex-start;
            padding: 8px 0;
        }

        .category-grid,
        .steps-grid {
            grid-template-columns: 1fr;
            max-width: 420px;
        }

        .category-image {
            height: 245px;
        }

        .category-body p {
            min-height: 0;
        }

        .section-heading {
            margin-bottom: 28px;
        }

        .home-section {
            padding: 48px 6%;
        }

        .cta-inner {
            align-items: flex-start;
            flex-direction: column;
            padding: 28px 23px;
        }

        .home-cta {
            padding: 45px 6%;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            scroll-behavior: auto !important;
            transition-duration: .01ms !important;
        }
    }
</style>
@endsection

@section('content')
<div class="home-page">

    {{-- HERO --}}
    <section class="hero">
        <div class="hero-content">
            <div class="hero-label">
                <i class="fa-solid fa-scissors"></i>
                JAHITAN SESUAI KEINGINANMU
            </div>

            <h1>
                Wujudkan Gaya<br>
                <span>Istimewa</span> Bersamamu
            </h1>

            <p class="hero-description">
                Temukan inspirasi model pakaian dan pesan jahitan sesuai
                keinginanmu. JAITIN membantu proses pemesanan jahitan
                menjadi lebih mudah, praktis, dan terorganisir.
            </p>

            <div class="hero-actions">
                <a href="{{ url('/katalog-model') }}" class="hero-btn hero-btn-primary">
                    <i class="fa-solid fa-shirt"></i>
                    Jelajahi Model
                </a>

                <a href="{{ route('login') }}" class="hero-btn hero-btn-secondary">
                    Mulai Pesan
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="hero-visual">
            <div class="hero-image-frame">
                <img
                    src="https://i.pinimg.com/originals/98/01/ed/9801ed15a000d92037906b38653818c9.jpg"
                    alt="Inspirasi busana dan jahitan"
                    loading="eager"
                >
            </div>

            <div class="hero-floating-card">
                <div class="floating-icon">
                    <i class="fa-solid fa-heart"></i>
                </div>
                <div>
                    <strong>Gaya Pilihanmu</strong>
                    <span>Jahitan sesuai kebutuhan</span>
                </div>
            </div>
        </div>
    </section>

    {{-- KEUNGGULAN --}}
    <section class="benefits" aria-label="Keunggulan JAITIN">
        <div class="benefit-item">
            <div class="benefit-icon">
                <i class="fa-solid fa-laptop"></i>
            </div>
            <div>
                <h3>Pemesanan Praktis</h3>
                <p>Informasi pesanan lebih terorganisir.</p>
            </div>
        </div>

        <div class="benefit-item">
            <div class="benefit-icon">
                <i class="fa-solid fa-shirt"></i>
            </div>
            <div>
                <h3>Inspirasi Beragam</h3>
                <p>Jelajahi referensi model pakaian.</p>
            </div>
        </div>

        <div class="benefit-item">
            <div class="benefit-icon">
                <i class="fa-solid fa-ruler-combined"></i>
            </div>
            <div>
                <h3>Sesuai Kebutuhan</h3>
                <p>Pesanan jahitan sesuai pilihanmu.</p>
            </div>
        </div>
    </section>

    {{-- KATEGORI MODEL --}}
    <section class="home-section" id="kategori">
        <div class="section-heading">
            <span class="section-eyebrow">Inspirasi Jahitan</span>
            <h2>Temukan Model Favoritmu</h2>
            <p>
                Mulai dari busana untuk acara istimewa hingga kebutuhan
                sehari-hari, temukan inspirasi yang sesuai dengan gayamu.
            </p>
        </div>

        <div class="category-grid">
            <article class="category-card">
                <div class="category-image">
                    <img
                        src="https://cdn-jjmn.jawapos.com/images/19/2025/07/30/kebaya-227429091.jpg"
                        alt="Inspirasi model kebaya"
                        loading="lazy"
                    >
                </div>
                <div class="category-body">
                    <h3>Kebaya</h3>
                    <p>
                        Referensi busana anggun untuk acara formal,
                        perayaan, dan momen istimewa.
                    </p>
                    <a href="{{ url('/katalog-model?kategori=kebaya') }}"
                       class="category-link">
                        Lihat Model
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </article>

            <article class="category-card">
                <div class="category-image">
                    <img
                        src="https://images.unsplash.com/photo-1566174053879-31528523f8ae?auto=format&fit=crop&w=800&q=80"
                        alt="Inspirasi model dress"
                        loading="lazy"
                    >
                </div>
                <div class="category-body">
                    <h3>Dress</h3>
                    <p>
                        Pilihan model dress dengan beragam inspirasi
                        untuk berbagai kesempatan.
                    </p>
                    <a href="{{ url('/katalog-model?kategori=dress') }}"
                       class="category-link">
                        Lihat Model
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </article>

            <article class="category-card">
                <div class="category-image">
                    <img
                        src="https://www.berita2bahasa.com/images/articles/2022822_agustus_jahit_wanita_b.jpg"
                        alt="Perbaikan dan perawatan pakaian"
                        loading="lazy"
                    >
                </div>
                <div class="category-body">
                    <h3>Perbaikan Pakaian</h3>
                    <p>
                        Solusi untuk menyesuaikan ukuran atau memperbaiki
                        pakaian agar nyaman digunakan kembali.
                    </p>
                    <a href="{{ url('/layanan-jahit') }}"
                       class="category-link">
                        Lihat Layanan
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </article>
        </div>
    </section>

    {{-- CARA PEMESANAN --}}
    <section class="home-section steps-section" id="cara-pemesanan">
        <div class="section-heading">
            <span class="section-eyebrow">Mudah dan Praktis</span>
            <h2>Bagaimana Cara Memesan?</h2>
            <p>
                Ikuti langkah sederhana berikut untuk memulai pemesanan
                jahitan melalui JAITIN.
            </p>
        </div>

        <div class="steps-grid">
            <article class="step-card">
                <div class="step-number">01</div>
                <h3>Pilih Model</h3>
                <p>
                    Jelajahi katalog dan temukan model pakaian atau
                    layanan jahit yang sesuai dengan kebutuhanmu.
                </p>
            </article>

            <article class="step-card">
                <div class="step-number">02</div>
                <h3>Masuk dan Isi Pesanan</h3>
                <p>
                    Buat akun atau masuk, kemudian lengkapi detail
                    pesanan dan informasi ukuran yang diperlukan.
                </p>
            </article>

            <article class="step-card">
                <div class="step-number">03</div>
                <h3>Konfirmasi Pesanan</h3>
                <p>
                    Tinjau detail pesanan dan ikuti proses konfirmasi
                    untuk mengetahui tahap pengerjaan jahitanmu.
                </p>
            </article>
        </div>
    </section>

    {{-- CTA --}}
    <section class="home-cta">
        <div class="cta-inner">
            <div>
                <h2>Siap Membuat Jahitan Impianmu?</h2>
                <p>
                    Mulai dengan melihat katalog model atau buat akun
                    JAITIN agar kamu dapat melanjutkan proses pemesanan.
                </p>
            </div>

            <a href="{{ route('register') }}" class="hero-btn hero-btn-primary">
                <i class="fa-solid fa-user-plus"></i>
                Daftar Sekarang
            </a>
        </div>
    </section>

</div>
@endsection
