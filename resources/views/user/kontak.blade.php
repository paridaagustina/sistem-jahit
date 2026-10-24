@extends('layouts.user')

@section('title', 'Kontak Kami - JAITIN')

@section('styles')
<style>
    .contact-page {
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

    .contact-container {
        width: min(1120px, calc(100% - 40px));
        margin: auto;
    }

    .contact-hero {
        background: linear-gradient(120deg, #f5e7e2, #faf6f2 65%, #fffdfb);
        padding: 72px 20px;
        text-align: center;
    }

    .contact-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 16px;
        border-radius: 30px;
        background: var(--white);
        color: var(--pink-dark);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 20px;
    }

    .contact-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(35px, 5vw, 52px);
        line-height: 1.2;
        margin: 0 0 18px;
    }

    .contact-hero h1 span {
        color: var(--pink-dark);
    }

    .contact-hero p {
        max-width: 650px;
        margin: auto;
        color: var(--muted);
        font-size: 14px;
        line-height: 1.9;
    }

    .contact-section {
        padding: 70px 0;
    }

    .contact-layout {
        display: grid;
        grid-template-columns: .85fr 1.15fr;
        gap: 28px;
        align-items: start;
    }

    .contact-info {
        padding: 34px;
        border-radius: 22px;
        background: linear-gradient(145deg, #98676d, #bd8b85);
        color: white;
    }

    .contact-info h2 {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        line-height: 1.35;
        margin: 0 0 14px;
    }

    .contact-info > p {
        color: #fff0ed;
        font-size: 13px;
        line-height: 1.9;
        margin: 0 0 30px;
    }

    .contact-info-list {
        display: grid;
        gap: 24px;
    }

    .contact-info-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .contact-info-icon {
        flex-shrink: 0;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: rgba(255, 255, 255, .15);
        font-size: 17px;
    }

    .contact-info-item h3 {
        font-size: 13px;
        margin: 2px 0 7px;
        font-weight: 700;
    }

    .contact-info-item p,
    .contact-info-item a {
        color: #fff0ed;
        font-size: 12px;
        line-height: 1.8;
        margin: 0;
        text-decoration: none;
        overflow-wrap: anywhere;
    }

    .contact-info-item a:hover {
        color: white;
        text-decoration: underline;
    }

    .contact-social {
        display: flex;
        gap: 10px;
        margin-top: 32px;
        padding-top: 25px;
        border-top: 1px solid rgba(255,255,255,.25);
    }

    .contact-social a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 12px;
        color: white;
        background: rgba(255,255,255,.14);
        text-decoration: none;
        transition: .2s;
    }

    .contact-social a:hover {
        background: rgba(255,255,255,.25);
        transform: translateY(-2px);
    }

    .contact-form-card {
        padding: 36px;
        border: 1px solid var(--border);
        border-radius: 22px;
        background: var(--white);
        box-shadow: 0 12px 40px rgba(73, 57, 54, .04);
    }

    .contact-form-heading {
        margin-bottom: 28px;
    }

    .contact-eyebrow {
        color: var(--pink-dark);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.8px;
        margin-bottom: 10px;
    }

    .contact-form-heading h2 {
        font-family: 'Playfair Display', serif;
        font-size: 29px;
        margin: 0 0 10px;
    }

    .contact-form-heading p {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.8;
        margin: 0;
    }

    .contact-alert {
        padding: 14px 16px;
        margin-bottom: 20px;
        border-radius: 12px;
        font-size: 13px;
        line-height: 1.7;
    }

    .contact-alert-success {
        background: #edf8f0;
        border: 1px solid #cce9d4;
        color: #27643a;
    }

    .contact-alert-error {
        background: #fff0ef;
        border: 1px solid #f2d1ce;
        color: #943d37;
    }

    .contact-alert ul {
        padding-left: 18px;
        margin: 8px 0 0;
    }

    .contact-form {
        display: grid;
        gap: 19px;
    }

    .contact-field {
        display: grid;
        gap: 8px;
    }

    .contact-field label {
        font-size: 12px;
        font-weight: 700;
    }

    .contact-field label span {
        color: #c65d65;
    }

    .contact-field input,
    .contact-field select,
    .contact-field textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid var(--border);
        border-radius: 11px;
        padding: 13px 14px;
        color: var(--text);
        background: #fffdfb;
        font-family: inherit;
        font-size: 13px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .contact-field input:focus,
    .contact-field select:focus,
    .contact-field textarea:focus {
        border-color: var(--pink);
        box-shadow: 0 0 0 3px rgba(209, 159, 148, .15);
    }

    .contact-field textarea {
        min-height: 140px;
        resize: vertical;
        line-height: 1.8;
    }

    .contact-field input::placeholder,
    .contact-field textarea::placeholder {
        color: #b3a19c;
    }

    .contact-field .field-error {
        color: #c0392b;
        font-size: 12px;
    }

    .contact-submit {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        width: 100%;
        border: 0;
        border-radius: 11px;
        padding: 15px 20px;
        background: var(--pink-dark);
        color: white;
        font-family: inherit;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: background .2s, transform .2s;
    }

    .contact-submit:hover {
        background: var(--pink-hover);
        transform: translateY(-1px);
    }

    .contact-form-note {
        color: var(--muted);
        font-size: 11px;
        line-height: 1.8;
        text-align: center;
        margin: -5px 0 0;
    }

    .contact-hours-section {
        background: var(--cream);
        padding: 65px 0;
    }

    .contact-section-heading {
        text-align: center;
        margin-bottom: 35px;
    }

    .contact-section-heading h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(27px, 4vw, 36px);
        margin: 0 0 12px;
    }

    .contact-section-heading p {
        max-width: 600px;
        margin: auto;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.9;
    }

    .contact-hours-card {
        max-width: 650px;
        margin: auto;
        padding: 28px;
        border: 1px solid var(--border);
        border-radius: 18px;
        background: var(--white);
    }

    .contact-hours-title {
        display: flex;
        align-items: center;
        gap: 13px;
        margin-bottom: 22px;
    }

    .contact-hours-title i {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        background: var(--pink-light);
        color: var(--pink-dark);
        border-radius: 13px;
        font-size: 18px;
    }

    .contact-hours-title h3 {
        font-size: 16px;
        margin: 0 0 5px;
    }

    .contact-hours-title p {
        color: var(--muted);
        font-size: 12px;
        margin: 0;
    }

    .contact-hours-row {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        padding: 15px 0;
        border-bottom: 1px solid var(--border);
        font-size: 13px;
    }

    .contact-hours-row:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .contact-hours-row span:first-child {
        color: var(--muted);
    }

    .contact-hours-row span:last-child {
        font-weight: 700;
        text-align: right;
    }

    .contact-faq {
        padding: 70px 0;
    }

    .contact-faq-list {
        max-width: 800px;
        margin: auto;
        display: grid;
        gap: 14px;
    }

    .contact-faq-item {
        padding: 22px 24px;
        border: 1px solid var(--border);
        border-radius: 15px;
        background: var(--white);
    }

    .contact-faq-item h3 {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        font-size: 14px;
        margin: 0 0 10px;
    }

    .contact-faq-item h3 i {
        color: var(--pink-dark);
        margin-top: 3px;
    }

    .contact-faq-item p {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.9;
        margin: 0 0 0 26px;
    }

    .contact-cta {
        padding: 0 20px 75px;
    }

    .contact-cta-inner {
        width: min(1120px, 100%);
        margin: auto;
        padding: 45px 25px;
        border-radius: 24px;
        background: linear-gradient(120deg, #98676d, #c18e88);
        text-align: center;
        color: white;
    }

    .contact-cta-inner h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(27px, 4vw, 36px);
        margin: 0 0 12px;
    }

    .contact-cta-inner p {
        max-width: 580px;
        margin: 0 auto 24px;
        color: #fff0ed;
        font-size: 13px;
        line-height: 1.9;
    }

    .contact-cta-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 9px;
        padding: 13px 22px;
        background: var(--white);
        color: var(--pink-hover);
        text-decoration: none;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        transition: .2s;
    }

    .contact-cta-btn:hover {
        background: var(--pink-light);
        color: var(--pink-hover);
    }

    @media (max-width: 850px) {
        .contact-layout {
            grid-template-columns: 1fr;
        }

        .contact-info-list {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        .contact-container {
            width: min(100% - 32px, 1120px);
        }

        .contact-hero {
            padding: 52px 16px;
        }

        .contact-section,
        .contact-faq {
            padding: 48px 0;
        }

        .contact-info,
        .contact-form-card {
            padding: 24px 20px;
        }

        .contact-info-list {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .contact-form-heading h2 {
            font-size: 25px;
        }

        .contact-hours-section {
            padding: 48px 0;
        }

        .contact-hours-card {
            padding: 20px;
        }

        .contact-hours-row {
            font-size: 12px;
        }

        .contact-cta {
            padding-bottom: 50px;
        }

        .contact-cta-btn {
            width: 100%;
            box-sizing: border-box;
        }
    }
</style>
@endsection

@section('content')
<div class="contact-page">

    {{-- HERO --}}
    <section class="contact-hero">
        <div class="contact-label">
            <i class="fa-solid fa-comments"></i>
            Hubungi Kami
        </div>

        <h1>Ada yang Ingin <span>Ditanyakan?</span></h1>

        <p>
            Kami siap membantu menjawab pertanyaanmu seputar layanan jahit,
            proses pemesanan, dan informasi lainnya. Sampaikan pesanmu
            melalui informasi kontak atau formulir berikut.
        </p>
    </section>

    {{-- INFORMASI KONTAK DAN FORM --}}
    <section class="contact-section">
        <div class="contact-container">
            <div class="contact-layout">

                {{-- INFORMASI KONTAK --}}
                <aside class="contact-info">
                    <h2>Mari Terhubung dengan JAITIN</h2>

                    <p>
                        Punya pertanyaan atau membutuhkan informasi lebih
                        lanjut? Pilih informasi kontak yang tersedia untuk
                        mengetahui cara menghubungi kami.
                    </p>

                    <div class="contact-info-list">
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <h3>Email</h3>
                                <p>Tambahkan alamat email resmi JAITIN</p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <h3>Telepon / WhatsApp</h3>
                                <p>Tambahkan nomor kontak resmi</p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <h3>Alamat</h3>
                                <p>Tambahkan alamat usaha atau lokasi layanan</p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div>
                                <h3>Jam Operasional</h3>
                                <p>Silakan periksa jadwal operasional yang berlaku</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-social">
                        {{-- Ganti # dengan URL media sosial resmi --}}
                        <a href="#"
                           aria-label="Instagram JAITIN"
                           title="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>

                        <a href="#"
                           aria-label="Facebook JAITIN"
                           title="Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>

                        <a href="#"
                           aria-label="WhatsApp JAITIN"
                           title="WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </div>
                </aside>

                {{-- FORM PESAN --}}
                <div class="contact-form-card">
                    <div class="contact-form-heading">
                        <div class="contact-eyebrow">Kirim Pesan</div>
                        <h2>Bagaimana Kami Bisa Membantu?</h2>
                        <p>
                            Isi formulir berikut dengan informasi yang
                            benar agar pesanmu dapat ditindaklanjuti.
                        </p>
                    </div>

                    @if (session('success'))
                        <div class="contact-alert contact-alert-success">
                            <i class="fa-solid fa-circle-check"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="contact-alert contact-alert-error">
                            <strong>Periksa kembali isian berikut:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('kontak.kirim') }}"
                          method="POST"
                          class="contact-form">
                        @csrf

                        <div class="contact-field">
                            <label for="nama">
                                Nama Lengkap <span>*</span>
                            </label>
                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                value="{{ old('nama', auth()->user()->name ?? '') }}"
                                placeholder="Masukkan nama lengkap"
                                maxlength="100"
                                autocomplete="name"
                                required
                            >
                            @error('nama')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="contact-field">
                            <label for="email">
                                Alamat Email <span>*</span>
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', auth()->user()->email ?? '') }}"
                                placeholder="nama@email.com"
                                maxlength="150"
                                autocomplete="email"
                                required
                            >
                            @error('email')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="contact-field">
                            <label for="subjek">
                                Subjek Pesan <span>*</span>
                            </label>
                            <select id="subjek" name="subjek" required>
                                <option value="">Pilih topik pertanyaan</option>
                                <option value="Informasi Layanan"
                                    @selected(old('subjek') === 'Informasi Layanan')>
                                    Informasi Layanan
                                </option>
                                <option value="Pemesanan Jahitan"
                                    @selected(old('subjek') === 'Pemesanan Jahitan')>
                                    Pemesanan Jahitan
                                </option>
                                <option value="Status Pesanan"
                                    @selected(old('subjek') === 'Status Pesanan')>
                                    Status Pesanan
                                </option>
                                <option value="Keluhan atau Saran"
                                    @selected(old('subjek') === 'Keluhan atau Saran')>
                                    Keluhan atau Saran
                                </option>
                                <option value="Lainnya"
                                    @selected(old('subjek') === 'Lainnya')>
                                    Lainnya
                                </option>
                            </select>
                            @error('subjek')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="contact-field">
                            <label for="pesan">
                                Isi Pesan <span>*</span>
                            </label>
                            <textarea
                                id="pesan"
                                name="pesan"
                                placeholder="Tuliskan pertanyaan atau pesanmu di sini..."
                                maxlength="3000"
                                required
                            >{{ old('pesan') }}</textarea>
                            @error('pesan')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="contact-submit">
                            <i class="fa-solid fa-paper-plane"></i>
                            Kirim Pesan
                        </button>

                        <p class="contact-form-note">
                            Pastikan alamat email yang kamu masukkan aktif
                            agar mudah dihubungi jika diperlukan.
                        </p>
                    </form>
                </div>

            </div>
        </div>
    </section>

    {{-- JAM OPERASIONAL --}}
    <section class="contact-hours-section">
        <div class="contact-container">
            <div class="contact-section-heading">
                <div class="contact-eyebrow">Informasi Layanan</div>
                <h2>Jam Operasional</h2>
                <p>
                    Periksa jadwal layanan sebelum menghubungi pengelola
                    JAITIN. Sesuaikan jadwal berikut dengan jam operasional
                    sebenarnya.
                </p>
            </div>

            <div class="contact-hours-card">
                <div class="contact-hours-title">
                    <i class="fa-solid fa-calendar-days"></i>
                    <div>
                        <h3>Jadwal Pelayanan</h3>
                        <p>Waktu layanan pelanggan</p>
                    </div>
                </div>

                <div class="contact-hours-row">
                    <span>Senin – Jumat</span>
                    <span>Sesuaikan jadwal</span>
                </div>

                <div class="contact-hours-row">
                    <span>Sabtu</span>
                    <span>Sesuaikan jadwal</span>
                </div>

                <div class="contact-hours-row">
                    <span>Minggu dan Hari Libur</span>
                    <span>Sesuaikan jadwal</span>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="contact-faq">
        <div class="contact-container">
            <div class="contact-section-heading">
                <div class="contact-eyebrow">Bantuan</div>
                <h2>Pertanyaan yang Sering Diajukan</h2>
                <p>
                    Temukan jawaban singkat sebelum mengirimkan pertanyaan
                    kepada pengelola.
                </p>
            </div>

            <div class="contact-faq-list">
                <article class="contact-faq-item">
                    <h3>
                        <i class="fa-solid fa-circle-question"></i>
                        Bagaimana cara mengajukan pesanan jahitan?
                    </h3>
                    <p>
                        Kamu dapat melihat katalog dan layanan jahit,
                        kemudian login untuk mengajukan pesanan melalui
                        fitur yang tersedia.
                    </p>
                </article>

                <article class="contact-faq-item">
                    <h3>
                        <i class="fa-solid fa-circle-question"></i>
                        Bagaimana jika saya memiliki pertanyaan tentang pesanan?
                    </h3>
                    <p>
                        Sampaikan pertanyaan melalui formulir kontak.
                        Sertakan informasi yang relevan agar pengelola
                        lebih mudah memahami kebutuhanmu.
                    </p>
                </article>

                <article class="contact-faq-item">
                    <h3>
                        <i class="fa-solid fa-circle-question"></i>
                        Apakah formulir kontak langsung mengirim email?
                    </h3>
                    <p>
                        Formulir pada halaman ini perlu dihubungkan dengan
                        route dan proses penyimpanan atau pengiriman pesan
                        di Laravel agar dapat berfungsi.
                    </p>
                </article>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="contact-cta">
        <div class="contact-cta-inner">
            <h2>Mulai Perjalanan Jahitmu</h2>
            <p>
                Jelajahi katalog model dan layanan JAITIN untuk menemukan
                pilihan yang sesuai dengan kebutuhanmu.
            </p>

            <a href="{{ route('user.katalog') }}"
               class="contact-cta-btn">
                <i class="fa-solid fa-shirt"></i>
                Jelajahi Katalog
            </a>
        </div>
    </section>

</div>
@endsection