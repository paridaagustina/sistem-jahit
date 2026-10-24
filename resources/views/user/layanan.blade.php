@extends('layouts.user')

@section('title', 'Layanan Jahit - JAITIN')

@section('styles')
<style>
    .service-page {
        color: var(--text);
    }

    .service-hero {
        position: relative;
        display: grid;
        grid-template-columns: 1.1fr .9fr;
        align-items: center;
        gap: 40px;
        padding: 65px 7%;
        overflow: hidden;
        background: linear-gradient(120deg, #fbf1ed, #f3e2df);
    }

    .service-hero-content {
        position: relative;
        z-index: 1;
        max-width: 580px;
    }

    .service-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 14px;
        margin-bottom: 18px;
        border: 1px solid #e9d4cf;
        border-radius: 30px;
        background: rgba(255,253,251,.75);
        color: var(--primary-dark);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .service-hero h1 {
        margin-bottom: 18px;
        font-family: 'Playfair Display', serif;
        font-size: clamp(34px, 4vw, 51px);
        line-height: 1.2;
    }

    .service-hero h1 span {
        color: var(--primary-dark);
    }

    .service-hero p {
        max-width: 500px;
        margin-bottom: 25px;
        color: #806c67;
        font-size: 13px;
        line-height: 1.9;
    }

    .service-hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 11px;
    }

    .service-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        min-height: 45px;
        padding: 12px 18px;
        border: 1px solid transparent;
        border-radius: 11px;
        font-size: 12px;
        font-weight: 700;
        transition: .2s ease;
    }

    .service-btn-primary {
        background: var(--primary-dark);
        color: #fff;
    }

    .service-btn-primary:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
    }

    .service-btn-secondary {
        border-color: #e5d2cc;
        background: var(--white);
        color: var(--primary-dark);
    }

    .service-btn-secondary:hover {
        background: #fff8f6;
    }

    .service-hero-visual {
        position: relative;
        min-height: 320px;
    }

    .service-hero-visual img {
        width: 100%;
        height: 320px;
        border: 8px solid rgba(255,253,251,.8);
        border-radius: 150px 150px 20px 20px;
        object-fit: cover;
        box-shadow: 0 15px 35px rgba(73,57,54,.10);
    }

    .service-image-note {
        position: absolute;
        right: -10px;
        bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 13px 16px;
        border: 1px solid var(--border);
        border-radius: 13px;
        background: var(--white);
        box-shadow: 0 8px 24px rgba(73,57,54,.10);
    }

    .service-image-note i {
        display: grid;
        width: 38px;
        height: 38px;
        place-items: center;
        border-radius: 11px;
        background: var(--primary-light);
        color: var(--primary-dark);
    }

    .service-image-note strong {
        display: block;
        font-size: 12px;
    }

    .service-image-note span {
        display: block;
        margin-top: 3px;
        color: var(--muted);
        font-size: 10px;
    }

    /* INTRO */
    .service-section {
        padding: 65px 7%;
    }

    .service-section-heading {
        max-width: 650px;
        margin: 0 auto 35px;
        text-align: center;
    }

    .service-section-heading .eyebrow {
        display: block;
        margin-bottom: 10px;
        color: var(--primary-dark);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .service-section-heading h2 {
        margin-bottom: 12px;
        font-family: 'Playfair Display', serif;
        font-size: clamp(27px, 3vw, 35px);
        line-height: 1.3;
    }

    .service-section-heading p {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.9;
    }

    /* SERVICE CARDS */
    .service-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
        max-width: 1150px;
        margin: 0 auto;
    }

    .service-card {
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border: 1px solid var(--border);
        border-radius: 17px;
        background: var(--white);
        box-shadow: 0 5px 20px rgba(120,90,80,.035);
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(120,90,80,.09);
    }

    .service-card-image {
        height: 215px;
        overflow: hidden;
        background: var(--primary-light);
    }

    .service-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .4s ease;
    }

    .service-card:hover .service-card-image img {
        transform: scale(1.05);
    }

    .service-card-body {
        display: flex;
        flex: 1;
        flex-direction: column;
        align-items: flex-start;
        padding: 23px;
    }

    .service-card-icon {
        display: grid;
        width: 43px;
        height: 43px;
        margin-bottom: 15px;
        place-items: center;
        border-radius: 12px;
        background: var(--primary-light);
        color: var(--primary-dark);
        font-size: 18px;
    }

    .service-card h3 {
        margin-bottom: 10px;
        font-family: 'Playfair Display', serif;
        font-size: 20px;
    }

    .service-card p {
        flex: 1;
        margin-bottom: 20px;
        color: var(--muted);
        font-size: 12px;
        line-height: 1.9;
    }

    .service-card-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary-dark);
        font-size: 12px;
        font-weight: 700;
    }

    .service-card-link:hover {
        color: var(--primary-hover);
    }

    /* ALUR */
    .service-process {
        background: #f6eae6;
    }

    .process-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 17px;
        max-width: 1150px;
        margin: 0 auto;
    }

    .process-card {
        padding: 24px 20px;
        border: 1px solid #ead8d1;
        border-radius: 15px;
        background: rgba(255,253,251,.8);
    }

    .process-number {
        display: grid;
        width: 40px;
        height: 40px;
        margin-bottom: 17px;
        place-items: center;
        border-radius: 12px;
        background: var(--primary-dark);
        color: white;
        font-family: 'Playfair Display', serif;
        font-size: 17px;
        font-weight: 700;
    }

    .process-card h3 {
        margin-bottom: 8px;
        font-size: 13px;
    }

    .process-card p {
        color: var(--muted);
        font-size: 12px;
        line-height: 1.8;
    }

    /* INFO */
    .service-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
        max-width: 1050px;
        margin: 0 auto;
    }

    .service-info-card {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 23px;
        border: 1px solid var(--border);
        border-radius: 15px;
        background: var(--white);
    }

    .service-info-card > i {
        display: grid;
        width: 43px;
        height: 43px;
        flex-shrink: 0;
        place-items: center;
        border-radius: 12px;
        background: var(--primary-light);
        color: var(--primary-dark);
        font-size: 17px;
    }

    .service-info-card h3 {
        margin-bottom: 7px;
        font-size: 13px;
    }

    .service-info-card p {
        color: var(--muted);
        font-size: 12px;
        line-height: 1.8;
    }

    /* CTA */
    .service-cta {
        padding: 0 7% 70px;
    }

    .service-cta-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
        max-width: 1150px;
        padding: 35px 40px;
        margin: 0 auto;
        border-radius: 20px;
        background: linear-gradient(115deg, #f4e2df, #fbf1ed);
    }

    .service-cta h2 {
        margin-bottom: 8px;
        font-family: 'Playfair Display', serif;
        font-size: clamp(23px, 3vw, 31px);
    }

    .service-cta p {
        max-width: 600px;
        color: #806c67;
        font-size: 12px;
        line-height: 1.8;
    }

    @media (max-width: 900px) {
        .service-hero {
            gap: 25px;
            padding: 50px 5%;
        }

        .service-hero-visual {
            min-height: 280px;
        }

        .service-hero-visual img {
            height: 280px;
        }

        .service-section {
            padding: 55px 5%;
        }

        .service-grid {
            gap: 15px;
        }

        .service-card-body {
            padding: 18px;
        }

        .process-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 650px) {
        .service-hero {
            grid-template-columns: 1fr;
            gap: 30px;
            padding: 42px 6%;
        }

        .service-hero h1 {
            font-size: 37px;
        }

        .service-hero-visual {
            min-height: 280px;
            padding: 0 8px;
        }

        .service-hero-visual img {
            height: 280px;
        }

        .service-image-note {
            right: -3px;
        }

        .service-grid {
            grid-template-columns: 1fr;
            max-width: 420px;
        }

        .service-card-image {
            height: 230px;
        }

        .service-card-body {
            padding: 22px;
        }

        .process-grid,
        .service-info-grid {
            grid-template-columns: 1fr;
        }

        .service-section {
            padding: 45px 6%;
        }

        .service-section-heading {
            margin-bottom: 28px;
        }

        .service-cta {
            padding: 0 6% 45px;
        }

        .service-cta-inner {
            align-items: flex-start;
            flex-direction: column;
            padding: 27px 23px;
        }
    }
</style>
@endsection

@section('content')
<div class="service-page">

    {{-- HERO --}}
    <section class="service-hero">
        <div class="service-hero-content">
            <div class="service-eyebrow">
                <i class="fa-solid fa-scissors"></i>
                Layanan JAITIN
            </div>

            <h1>
                Jahitan yang<br>
                <span>Pas dengan Gayamu</span>
            </h1>

            <p>
                Temukan layanan jahit untuk membuat pakaian sesuai
                keinginan atau memperbaiki pakaian yang kamu miliki.
                Pilih layanan yang sesuai, lalu lanjutkan pemesanan
                melalui sistem JAITIN.
            </p>

            <div class="service-hero-actions">
                <a href="{{ url('/katalog-model') }}"
                   class="service-btn service-btn-primary">
                    <i class="fa-solid fa-shirt"></i>
                    Jelajahi Model
                </a>

                <a href="{{ route('login') }}"
                   class="service-btn service-btn-secondary">
                    Mulai Pesan
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="service-hero-visual">
            <img
                src="https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=1000&q=85"
                alt="Inspirasi busana untuk layanan jahit"
                loading="eager"
            >

            <div class="service-image-note">
                <i class="fa-solid fa-heart"></i>
                <div>
                    <strong>Gayamu, Pilihanmu</strong>
                    <span>Inspirasi untuk penampilanmu</span>
                </div>
            </div>
        </div>
    </section>

    {{-- DAFTAR LAYANAN --}}
    <section class="service-section" id="daftar-layanan">
        <div class="service-section-heading">
            <span class="eyebrow">Pilihan Layanan</span>
            <h2>Layanan Jahit untuk Berbagai Kebutuhan</h2>
            <p>
                Pilih jenis layanan yang kamu butuhkan.
                Lihat inspirasi model terlebih dahulu sebelum melanjutkan
                proses pemesanan.
            </p>
        </div>

        <div class="service-grid">

            <article class="service-card">
                <div class="service-card-image">
                    <img
                        src="https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&w=850&q=80"
                        alt="Inspirasi jahit kebaya"
                        loading="lazy"
                    >
                </div>

                <div class="service-card-body">
                    <div class="service-card-icon">
                        <i class="fa-solid fa-gem"></i>
                    </div>

                    <h3>Jahit Kebaya</h3>

                    <p>
                        Layanan pembuatan kebaya untuk acara formal,
                        perayaan, atau kebutuhan khusus. Kamu dapat
                        memilih referensi model sebagai inspirasi.
                    </p>

                    <a href="{{ url('/katalog-model?kategori=kebaya') }}"
                       class="service-card-link">
                        Lihat Referensi
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </article>

            <article class="service-card">
                <div class="service-card-image">
                    <img
                        src="https://images.unsplash.com/photo-1566174053879-31528523f8ae?auto=format&fit=crop&w=850&q=80"
                        alt="Inspirasi jahit dress"
                        loading="lazy"
                    >
                </div>

                <div class="service-card-body">
                    <div class="service-card-icon">
                        <i class="fa-solid fa-person-dress"></i>
                    </div>

                    <h3>Jahit Dress</h3>

                    <p>
                        Pilihan pembuatan dress dengan referensi model
                        yang dapat disesuaikan dengan acara, preferensi,
                        dan kebutuhan pemakaian.
                    </p>

                    <a href="{{ url('/katalog-model?kategori=dress') }}"
                       class="service-card-link">
                        Lihat Referensi
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </article>

            <article class="service-card">
                <div class="service-card-image">
                    <img
                        src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=850&q=80"
                        alt="Perbaikan pakaian"
                        loading="lazy"
                    >
                </div>

                <div class="service-card-body">
                    <div class="service-card-icon">
                        <i class="fa-solid fa-scissors"></i>
                    </div>

                    <h3>Perbaikan Pakaian</h3>

                    <p>
                        Untuk kebutuhan seperti penyesuaian ukuran,
                        memperpendek pakaian, atau perbaikan sederhana.
                        Detail pekerjaan dapat dikonfirmasi saat pemesanan.
                    </p>

                    <a href="{{ route('login') }}"
                       class="service-card-link">
                        Pesan Layanan
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </article>

        </div>
    </section>

    {{-- ALUR PEMESANAN --}}
    <section class="service-section service-process" id="alur-layanan">
        <div class="service-section-heading">
            <span class="eyebrow">Langkah Pemesanan</span>
            <h2>Mulai dari Pilihan hingga Konfirmasi</h2>
            <p>
                Ikuti tahapan berikut agar informasi kebutuhan jahitanmu
                dapat dicatat dengan jelas.
            </p>
        </div>

        <div class="process-grid">
            <article class="process-card">
                <div class="process-number">01</div>
                <h3>Pilih Layanan</h3>
                <p>
                    Tentukan jenis jahitan yang sesuai dengan kebutuhanmu.
                </p>
            </article>

            <article class="process-card">
                <div class="process-number">02</div>
                <h3>Masuk ke Akun</h3>
                <p>
                    Login atau daftar agar dapat melanjutkan proses pemesanan.
                </p>
            </article>

            <article class="process-card">
                <div class="process-number">03</div>
                <h3>Isi Detail Pesanan</h3>
                <p>
                    Masukkan pilihan model, ukuran, dan informasi tambahan
                    yang diperlukan.
                </p>
            </article>

            <article class="process-card">
                <div class="process-number">04</div>
                <h3>Konfirmasi</h3>
                <p>
                    Periksa kembali pesanan dan ikuti arahan untuk
                    konfirmasi pengerjaan.
                </p>
            </article>
        </div>
    </section>

    {{-- INFORMASI --}}
    <section class="service-section">
        <div class="service-section-heading">
            <span class="eyebrow">Sebelum Memesan</span>
            <h2>Hal yang Perlu Kamu Siapkan</h2>
            <p>
                Persiapan sederhana dapat membantu proses pemesanan
                menjadi lebih jelas.
            </p>
        </div>

        <div class="service-info-grid">
            <article class="service-info-card">
                <i class="fa-solid fa-image"></i>
                <div>
                    <h3>Referensi Model</h3>
                    <p>
                        Siapkan gambar referensi jika kamu memiliki
                        model pakaian tertentu yang ingin dibuat.
                    </p>
                </div>
            </article>

            <article class="service-info-card">
                <i class="fa-solid fa-ruler-combined"></i>
                <div>
                    <h3>Informasi Ukuran</h3>
                    <p>
                        Siapkan ukuran yang diperlukan. Ikuti petunjuk
                        pengisian ukuran yang tersedia pada proses pemesanan.
                    </p>
                </div>
            </article>

            <article class="service-info-card">
                <i class="fa-solid fa-list-check"></i>
                <div>
                    <h3>Detail Kebutuhan</h3>
                    <p>
                        Tentukan jenis pakaian, kebutuhan perbaikan,
                        dan detail lain yang ingin disampaikan.
                    </p>
                </div>
            </article>

            <article class="service-info-card">
                <i class="fa-solid fa-comments"></i>
                <div>
                    <h3>Konfirmasi dengan Admin</h3>
                    <p>
                        Pastikan detail, biaya, dan perkiraan waktu
                        pengerjaan dikonfirmasi sebelum pesanan diproses.
                    </p>
                </div>
            </article>
        </div>
    </section>

    {{-- CTA --}}
    <section class="service-cta">
        <div class="service-cta-inner">
            <div>
                <h2>Sudah Menemukan Layanan yang Cocok?</h2>
                <p>
                    Masuk atau buat akun JAITIN untuk mengisi detail
                    kebutuhan jahitan dan melanjutkan pemesanan.
                </p>
            </div>

            <a href="{{ route('login') }}"
               class="service-btn service-btn-primary">
                <i class="fa-solid fa-right-to-bracket"></i>
                Masuk untuk Memesan
            </a>
        </div>
    </section>

</div>
@endsection
