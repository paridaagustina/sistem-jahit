@extends('layouts.user')

@section('title', 'Cara Pemesanan - JAITIN')

@section('styles')
<style>
    .order-guide {
        --pink: #d19f94;
        --pink-dark: #98676d;
        --cream: #faf6f2;
        --text: #493936;
        --muted: #927f7b;
        color: var(--text);
        overflow: hidden;
    }

    .guide-hero {
        background: linear-gradient(120deg, #f8e9e4, #faf6f2 70%);
        padding: 76px 24px 68px;
        text-align: center;
    }

    .guide-label {
        display: inline-block;
        padding: 8px 16px;
        background: #fffdfb;
        color: var(--pink-dark);
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 20px;
    }

    .guide-hero h1 {
        max-width: 780px;
        margin: 0 auto 18px;
        font-family: 'Playfair Display', serif;
        font-size: clamp(34px, 5vw, 54px);
        line-height: 1.2;
        font-weight: 700;
    }

    .guide-hero h1 span {
        color: var(--pink-dark);
    }

    .guide-hero p {
        max-width: 650px;
        margin: 0 auto;
        color: var(--muted);
        font-size: 15px;
        line-height: 1.9;
    }

    .guide-container {
        width: min(1120px, calc(100% - 40px));
        margin: auto;
    }

    .guide-section {
        padding: 76px 0;
    }

    .guide-heading {
        text-align: center;
        margin-bottom: 46px;
    }

    .guide-heading .eyebrow {
        color: var(--pink-dark);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .guide-heading h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(28px, 4vw, 38px);
        margin: 0 0 14px;
        line-height: 1.3;
    }

    .guide-heading p {
        color: var(--muted);
        font-size: 14px;
        line-height: 1.8;
        max-width: 620px;
        margin: auto;
    }

    .steps-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 22px;
    }

    .step-card {
        position: relative;
        background: #fffdfb;
        border: 1px solid #eee1da;
        border-radius: 20px;
        padding: 30px 23px;
        transition: transform .25s, box-shadow .25s;
    }

    .step-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(152, 103, 109, .10);
    }

    .step-number {
        width: 46px;
        height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f5e7e2;
        color: #98676d;
        border-radius: 14px;
        font-size: 17px;
        font-weight: 800;
        margin-bottom: 24px;
    }

    .step-icon {
        font-size: 25px;
        color: var(--pink-dark);
        margin-bottom: 14px;
    }

    .step-card h3 {
        font-size: 16px;
        margin: 0 0 12px;
        font-weight: 700;
    }

    .step-card p {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.85;
        margin: 0;
    }

    .guide-note {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin-top: 28px;
        padding: 22px 24px;
        background: #f5e7e2;
        border-radius: 16px;
    }

    .guide-note i {
        color: var(--pink-dark);
        font-size: 21px;
        margin-top: 3px;
    }

    .guide-note strong {
        display: block;
        margin-bottom: 6px;
        font-size: 14px;
    }

    .guide-note p {
        margin: 0;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.8;
    }

    .preparation-section {
        background: var(--cream);
    }

    .preparation-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .preparation-card {
        display: flex;
        align-items: flex-start;
        gap: 17px;
        background: #fffdfb;
        border: 1px solid #eee1da;
        padding: 24px;
        border-radius: 18px;
    }

    .preparation-icon {
        flex-shrink: 0;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        background: #f5e7e2;
        color: var(--pink-dark);
        font-size: 19px;
    }

    .preparation-card h3 {
        font-size: 15px;
        margin: 2px 0 8px;
    }

    .preparation-card p {
        margin: 0;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.8;
    }

    .faq-list {
        max-width: 820px;
        margin: auto;
        display: grid;
        gap: 14px;
    }

    .faq-item {
        border: 1px solid #eee1da;
        background: #fffdfb;
        border-radius: 16px;
        padding: 22px 24px;
    }

    .faq-item h3 {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        font-size: 15px;
        margin: 0 0 10px;
    }

    .faq-item h3 i {
        color: var(--pink-dark);
        margin-top: 3px;
    }

    .faq-item p {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.85;
        margin: 0 0 0 27px;
    }

    .guide-cta {
        padding: 0 20px 80px;
    }

    .cta-inner {
        width: min(1120px, 100%);
        margin: auto;
        background: linear-gradient(120deg, #98676d, #c18e88);
        border-radius: 26px;
        padding: 52px 30px;
        text-align: center;
        color: white;
    }

    .cta-inner h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(27px, 4vw, 38px);
        margin: 0 0 14px;
    }

    .cta-inner p {
        max-width: 600px;
        margin: 0 auto 26px;
        font-size: 14px;
        line-height: 1.8;
        color: #fff0ed;
    }

    .cta-actions {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 12px;
    }

    .guide-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 13px 22px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s;
    }

    .guide-btn-light {
        background: #fffdfb;
        color: #79555a;
    }

    .guide-btn-light:hover {
        background: #f5e7e2;
        color: #79555a;
    }

    .guide-btn-outline {
        border: 1px solid rgba(255,255,255,.7);
        color: white;
    }

    .guide-btn-outline:hover {
        background: rgba(255,255,255,.12);
        color: white;
    }

    @media (max-width: 900px) {
        .steps-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        .guide-hero {
            padding: 54px 20px;
        }

        .guide-container {
            width: min(100% - 32px, 1120px);
        }

        .guide-section {
            padding: 54px 0;
        }

        .guide-heading {
            margin-bottom: 30px;
        }

        .steps-grid,
        .preparation-grid {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .step-card {
            padding: 24px;
        }

        .guide-note {
            padding: 18px;
        }

        .preparation-card {
            padding: 20px;
        }

        .cta-inner {
            padding: 38px 22px;
        }

        .guide-cta {
            padding-bottom: 54px;
        }

        .guide-btn {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="order-guide">

    {{-- HERO --}}
    <section class="guide-hero">
        <div class="guide-label">
            <i class="fa-solid fa-book-open"></i>
            Panduan Pemesanan
        </div>

        <h1>
            Pesan Jahitan Jadi Lebih <span>Mudah</span>
        </h1>

        <p>
            Belum pernah memesan jahitan secara online? Jangan khawatir.
            Ikuti panduan sederhana berikut untuk memulai pesanan jahitan
            sesuai model dan kebutuhanmu bersama JAITIN.
        </p>
    </section>

    {{-- LANGKAH PEMESANAN --}}
    <section class="guide-section">
        <div class="guide-container">
            <div class="guide-heading">
                <div class="eyebrow">Langkah Pemesanan</div>
                <h2>Bagaimana Cara Memesan?</h2>
                <p>
                    Ikuti empat langkah berikut untuk mengajukan pesanan
                    jahitan melalui sistem JAITIN.
                </p>
            </div>

            <div class="steps-grid">
                <article class="step-card">
                    <div class="step-number">01</div>
                    <div class="step-icon">
                        <i class="fa-solid fa-shirt"></i>
                    </div>
                    <h3>Pilih Model atau Layanan</h3>
                    <p>
                        Jelajahi katalog model dan pilih layanan jahit
                        yang sesuai, seperti kebaya, dress, atau perbaikan
                        pakaian.
                    </p>
                </article>

                <article class="step-card">
                    <div class="step-number">02</div>
                    <div class="step-icon">
                        <i class="fa-solid fa-user-lock"></i>
                    </div>
                    <h3>Masuk ke Akun</h3>
                    <p>
                        Login terlebih dahulu. Jika belum mempunyai akun,
                        lakukan registrasi agar kamu dapat mengajukan
                        pesanan melalui sistem.
                    </p>
                </article>

                <article class="step-card">
                    <div class="step-number">03</div>
                    <div class="step-icon">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                    <h3>Lengkapi Detail Pesanan</h3>
                    <p>
                        Isi informasi pesanan sesuai formulir yang tersedia,
                        termasuk model, ukuran, kebutuhan jahitan, dan
                        keterangan tambahan jika diperlukan.
                    </p>
                </article>

                <article class="step-card">
                    <div class="step-number">04</div>
                    <div class="step-icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <h3>Tunggu Konfirmasi</h3>
                    <p>
                        Periksa kembali detail pesanan. Admin akan
                        memeriksa permintaanmu dan memberikan informasi
                        lanjutan mengenai pesanan.
                    </p>
                </article>
            </div>

            <div class="guide-note">
                <i class="fa-solid fa-lightbulb"></i>
                <div>
                    <strong>Tips sebelum memesan</strong>
                    <p>
                        Siapkan referensi model dan ukuran tubuh yang
                        diperlukan. Pastikan informasi yang dimasukkan
                        sudah benar agar proses konfirmasi lebih mudah.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- PERSIAPAN --}}
    <section class="guide-section preparation-section">
        <div class="guide-container">
            <div class="guide-heading">
                <div class="eyebrow">Sebelum Memesan</div>
                <h2>Persiapkan Hal Berikut</h2>
                <p>
                    Informasi yang jelas akan membantu proses pengajuan
                    pesanan dan komunikasi dengan admin.
                </p>
            </div>

            <div class="preparation-grid">
                <article class="preparation-card">
                    <div class="preparation-icon">
                        <i class="fa-solid fa-image"></i>
                    </div>
                    <div>
                        <h3>Referensi Model</h3>
                        <p>
                            Siapkan foto atau gambaran model pakaian yang
                            diinginkan agar detail desain lebih mudah
                            dipahami.
                        </p>
                    </div>
                </article>

                <article class="preparation-card">
                    <div class="preparation-icon">
                        <i class="fa-solid fa-ruler-combined"></i>
                    </div>
                    <div>
                        <h3>Ukuran Tubuh</h3>
                        <p>
                            Siapkan ukuran tubuh yang diperlukan sesuai
                            jenis pakaian atau arahan dari pihak penjahit.
                        </p>
                    </div>
                </article>

                <article class="preparation-card">
                    <div class="preparation-icon">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                    <div>
                        <h3>Detail dan Catatan</h3>
                        <p>
                            Tuliskan detail tambahan, seperti perubahan
                            model, jenis perbaikan, atau kebutuhan khusus
                            lainnya.
                        </p>
                    </div>
                </article>

                <article class="preparation-card">
                    <div class="preparation-icon">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <div>
                        <h3>Informasi Kontak</h3>
                        <p>
                            Pastikan informasi akun dan kontak yang
                            digunakan benar agar admin dapat menghubungimu
                            jika diperlukan.
                        </p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="guide-section">
        <div class="guide-container">
            <div class="guide-heading">
                <div class="eyebrow">Pertanyaan Umum</div>
                <h2>Masih Ada yang Ingin Ditanyakan?</h2>
                <p>
                    Berikut beberapa informasi yang perlu diketahui
                    sebelum mengajukan pesanan.
                </p>
            </div>

            <div class="faq-list">
                <article class="faq-item">
                    <h3>
                        <i class="fa-solid fa-circle-question"></i>
                        Apakah saya harus mempunyai akun?
                    </h3>
                    <p>
                        Ya, kamu perlu login untuk mengajukan pesanan.
                        Jika belum memiliki akun, pilih menu registrasi
                        terlebih dahulu.
                    </p>
                </article>

                <article class="faq-item">
                    <h3>
                        <i class="fa-solid fa-circle-question"></i>
                        Bagaimana jika model yang saya inginkan tidak ada di katalog?
                    </h3>
                    <p>
                        Periksa pilihan layanan yang tersedia dan siapkan
                        referensi model. Kamu dapat menyampaikan kebutuhan
                        tersebut kepada admin untuk mendapatkan informasi
                        lebih lanjut.
                    </p>
                </article>

                <article class="faq-item">
                    <h3>
                        <i class="fa-solid fa-circle-question"></i>
                        Apakah pesanan langsung dikerjakan setelah dikirim?
                    </h3>
                    <p>
                        Pesanan perlu diperiksa terlebih dahulu. Tunggu
                        konfirmasi admin mengenai detail dan tindak lanjut
                        pesananmu.
                    </p>
                </article>

                <article class="faq-item">
                    <h3>
                        <i class="fa-solid fa-circle-question"></i>
                        Bagaimana mengetahui perkembangan pesanan?
                    </h3>
                    <p>
                        Masuk ke akun JAITIN dan periksa halaman pesanan
                        jika fitur riwayat atau status pesanan tersedia
                        pada akunmu.
                    </p>
                </article>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="guide-cta">
        <div class="cta-inner">
            <h2>Siap Membuat Pakaian Impianmu?</h2>
            <p>
                Mulai dengan menjelajahi berbagai model dan layanan jahit
                yang tersedia di JAITIN.
            </p>

            <div class="cta-actions">
                <a href="{{ route('user.katalog') }}" class="guide-btn guide-btn-light">
                    <i class="fa-solid fa-shirt"></i>
                    Lihat Katalog Model
                </a>

                <a href="{{ route('login') }}" class="guide-btn guide-btn-outline">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    Masuk untuk Memesan
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
