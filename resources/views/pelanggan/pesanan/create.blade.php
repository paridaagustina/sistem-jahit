@extends('layouts.pelanggan')

@section('title', 'Pesan Jasa Jahit - JAITIN')

@section('styles')
<style>
    .pesanan-page {
        --pink: #b77d8b;
        --pink-dark: #965e6d;
        --pink-soft: #f8eaf0;
        --cream: #fffaf7;
        --ink: #49343a;
        --muted: #856d73;
        --border: #ecd9df;

        width: 100%;
        max-width: 1180px;
        margin: 0 auto;
        color: var(--ink);
    }

    /* HEADER */
    .pesanan-hero {
        position: relative;
        overflow: hidden;
        padding: clamp(24px, 4vw, 36px);
        margin-bottom: 24px;
        border: 1px solid #edd5dd;
        border-radius: 22px;
        background: linear-gradient(
            120deg,
            #f6e4e9 0%,
            #fff7f3 60%,
            #f3e6e8 100%
        );
    }

    .pesanan-hero::after {
        content: "";
        position: absolute;
        top: -65px;
        right: -45px;
        width: 170px;
        height: 170px;
        border-radius: 50%;
        background: rgba(183, 125, 139, .12);
        pointer-events: none;
    }

    .pesanan-eyebrow {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
        color: var(--pink-dark);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .12em;
        text-transform: uppercase;
    }

    .pesanan-eyebrow::before {
        content: "";
        width: 22px;
        height: 2px;
        border-radius: 2px;
        background: var(--pink);
    }

    .pesanan-title {
        position: relative;
        z-index: 1;
        margin: 0 0 10px;
        color: #3e2930;
        font-size: clamp(25px, 3vw, 34px);
        font-weight: 800;
        line-height: 1.25;
        letter-spacing: -.035em;
    }

    .pesanan-subtitle {
        position: relative;
        z-index: 1;
        max-width: 720px;
        margin: 0;
        color: #785e66;
        font-size: 14px;
        line-height: 1.8;
    }

    /* FORM CARD */
    .pesanan-card {
        padding: clamp(18px, 3vw, 30px);
        border: 1px solid var(--border);
        border-radius: 20px;
        background: var(--cream);
        box-shadow: 0 10px 30px rgba(104, 63, 76, .055);
    }

    .pesanan-section + .pesanan-section {
        margin-top: 32px;
        padding-top: 28px;
        border-top: 1px solid #f0e1e5;
    }

    .section-heading {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        margin-bottom: 22px;
    }

    .section-number {
        display: inline-flex;
        flex: 0 0 38px;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: var(--pink-soft);
        color: var(--pink-dark);
        font-size: 14px;
        font-weight: 800;
    }

    .section-title {
        margin: 0 0 5px;
        color: var(--ink);
        font-size: 18px;
        font-weight: 800;
    }

    .section-description {
        margin: 0;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.6;
    }

    /* FORM INPUT */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 21px 20px;
    }

    .form-group {
        min-width: 0;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .pesanan-page .form-label {
        display: block;
        margin-bottom: 8px;
        color: #533c43;
        font-size: 13px;
        font-weight: 750;
    }

    .required {
        color: #b75d75;
    }

    .pesanan-page .form-control,
    .pesanan-page .form-select,
    .pesanan-page textarea {
        display: block;
        width: 100%;
        min-height: 46px;
        padding: 12px 14px;
        border: 1px solid #e5cbd4;
        border-radius: 11px;
        outline: none;
        background: #fff;
        color: var(--ink);
        font-family: inherit;
        font-size: 14px;
        line-height: 1.5;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .pesanan-page .form-control::placeholder,
    .pesanan-page textarea::placeholder {
        color: #b09ba1;
    }

    .pesanan-page .form-control:focus,
    .pesanan-page .form-select:focus,
    .pesanan-page textarea:focus {
        border-color: var(--pink);
        box-shadow: 0 0 0 4px rgba(183, 125, 139, .13);
    }

    .pesanan-page textarea {
        min-height: 112px;
        resize: vertical;
    }

    .form-help {
        display: block;
        margin-top: 7px;
        color: #947c83;
        font-size: 12px;
        line-height: 1.6;
    }

    /* VALIDATION */
    .error-box {
        margin-bottom: 24px;
        padding: 16px 18px;
        border: 1px solid #efb9c4;
        border-radius: 13px;
        background: #fff0f2;
        color: #963f55;
        font-size: 13px;
    }

    .error-box strong {
        display: block;
        margin-bottom: 8px;
    }

    .error-box ul {
        margin: 0;
        padding-left: 20px;
        line-height: 1.8;
    }

    /* REFERENCE CARDS */
    .referensi-info {
        margin: -5px 0 19px;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.7;
    }

    .referensi-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    .referensi-option {
        position: relative;
        min-width: 0;
    }

    .referensi-option input[type="radio"] {
        position: absolute;
        width: 1px;
        height: 1px;
        overflow: hidden;
        opacity: 0;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
    }

    .referensi-card {
        display: flex;
        height: 100%;
        flex-direction: column;
        overflow: hidden;
        border: 2px solid #efdee3;
        border-radius: 15px;
        background: #fff;
        cursor: pointer;
        transition:
            transform .2s ease,
            border-color .2s ease,
            box-shadow .2s ease;
    }

    .referensi-card:hover {
        transform: translateY(-3px);
        border-color: #d4a5b1;
        box-shadow: 0 9px 22px rgba(104, 63, 76, .09);
    }

    .referensi-option input[type="radio"]:focus-visible
    + .referensi-card {
        outline: 3px solid rgba(183, 125, 139, .4);
        outline-offset: 3px;
    }

    .referensi-option input[type="radio"]:checked
    + .referensi-card {
        border-color: var(--pink);
        box-shadow: 0 0 0 3px rgba(183, 125, 139, .13);
    }

    .referensi-image-wrap {
        position: relative;
        overflow: hidden;
        background: #f7eaee;
    }

    .referensi-image {
        display: block;
        width: 100%;
        height: 180px;
        object-fit: cover;
        transition: transform .25s ease;
    }

    .referensi-card:hover .referensi-image {
        transform: scale(1.035);
    }

    .referensi-check {
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border: 2px solid rgba(255, 255, 255, .9);
        border-radius: 50%;
        background: #fff;
        color: transparent;
        font-size: 15px;
        font-weight: 800;
        box-shadow: 0 2px 8px rgba(55, 30, 38, .12);
    }

    .referensi-option input[type="radio"]:checked
    + .referensi-card .referensi-check {
        background: var(--pink-dark);
        color: #fff;
    }

    .referensi-content {
        padding: 14px;
    }

    .referensi-name {
        margin-bottom: 6px;
        color: #4c343c;
        font-size: 14px;
        font-weight: 800;
    }

    .referensi-desc {
        margin: 0;
        color: #8b737b;
        font-size: 12px;
        line-height: 1.6;
    }

    .selected-reference {
        display: none;
        align-items: center;
        gap: 10px;
        margin-top: 16px;
        padding: 13px 15px;
        border: 1px solid #ead0d8;
        border-radius: 12px;
        background: #fbf0f3;
        color: #76505c;
        font-size: 13px;
        line-height: 1.6;
    }

    .selected-reference.show {
        display: flex;
    }

    .selected-reference-icon {
        display: inline-flex;
        flex: 0 0 28px;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 9px;
        background: #efd7df;
        color: var(--pink-dark);
        font-weight: 800;
    }

    /* BUTTONS */
    .button-area {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 30px;
        padding-top: 24px;
        border-top: 1px solid #f0e1e5;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        min-height: 46px;
        padding: 12px 22px;
        border: 1px solid transparent;
        border-radius: 11px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s ease, transform .2s ease;
    }

    .btn-action:active {
        transform: translateY(1px);
    }

    .btn-submit {
        background: var(--pink);
        color: #fff;
        box-shadow: 0 5px 12px rgba(150, 94, 109, .18);
    }

    .btn-submit:hover {
        background: var(--pink-dark);
        color: #fff;
    }

    .btn-cancel {
        border-color: #e8d2d9;
        background: #fff;
        color: #785b64;
    }

    .btn-cancel:hover {
        background: #fbf0f3;
    }

    /* RESPONSIVE */
    @media (max-width: 1000px) {
        .referensi-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 700px) {
        .form-grid {
            grid-template-columns: minmax(0, 1fr);
            gap: 18px;
        }

        .form-group.full {
            grid-column: auto;
        }

        .pesanan-card {
            border-radius: 16px;
        }

        .pesanan-hero {
            border-radius: 17px;
        }
    }

    @media (max-width: 480px) {
        .referensi-grid {
            grid-template-columns: minmax(0, 1fr);
        }

        .referensi-image {
            height: 215px;
        }

        .button-area {
            flex-direction: column-reverse;
        }

        .btn-action {
            width: 100%;
        }

        .section-heading {
            gap: 10px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .pesanan-page *,
        .pesanan-page *::before,
        .pesanan-page *::after {
            transition-duration: .01ms !important;
            animation-duration: .01ms !important;
        }
    }
</style>
@endsection

@section('content')
<div class="pesanan-page">

    <header class="pesanan-hero">
        <div class="pesanan-eyebrow">Layanan JAITIN</div>
        <h1 class="pesanan-title">Pesan Jasa Jahit</h1>
        <p class="pesanan-subtitle">
            Lengkapi detail pakaian, ukuran, dan tanggal penyelesaian yang
            diharapkan. Anda juga dapat memilih referensi model untuk membantu
            penjahit memahami kebutuhan Anda.
        </p>
    </header>

    <div class="pesanan-card">

        {{-- ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="error-box" role="alert" aria-live="polite">
                <strong>Periksa kembali data pesanan Anda:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM PESANAN --}}
        <form
            action="{{ route('pelanggan.pesanan.store') }}"
            method="POST"
        >
            @csrf

            {{-- INFORMASI PESANAN --}}
            <section class="pesanan-section"
                     aria-labelledby="informasi-pesanan-title">

                <div class="section-heading">
                    <span class="section-number">01</span>
                    <div>
                        <h2 class="section-title"
                            id="informasi-pesanan-title">
                            Informasi Pesanan
                        </h2>
                        <p class="section-description">
                            Lengkapi jenis pakaian dan detail pengerjaan.
                        </p>
                    </div>
                </div>

                <div class="form-grid">

                    {{-- JENIS PAKAIAN --}}
                    <div class="form-group">
                        <label class="form-label" for="jenis_pakaian">
                            Jenis Pakaian <span class="required">*</span>
                        </label>

                        <select
                            id="jenis_pakaian"
                            name="jenis_pakaian"
                            class="form-select"
                            required
                        >
                            <option value="">Pilih jenis pakaian</option>

                            <option value="Kebaya"
                                {{ old('jenis_pakaian') == 'Kebaya' ? 'selected' : '' }}>
                                Kebaya
                            </option>

                            <option value="Pakaian"
                                {{ old('jenis_pakaian') == 'Pakaian' ? 'selected' : '' }}>
                                Pakaian
                            </option>

                            <option value="Dress"
                                {{ old('jenis_pakaian') == 'Dress' ? 'selected' : '' }}>
                                Dress
                            </option>

                            <option value="Perbaikan Pakaian"
                                {{ old('jenis_pakaian') == 'Perbaikan Pakaian' ? 'selected' : '' }}>
                                Perbaikan Pakaian
                            </option>

                            <option value="Permak"
                                {{ old('jenis_pakaian') == 'Permak' ? 'selected' : '' }}>
                                Permak / Penyesuaian Ukuran
                            </option>
                        </select>
                    </div>

                    {{-- MODEL PAKAIAN --}}
                    <div class="form-group">
                        <label class="form-label" for="model_pakaian">
                            Model Pakaian
                        </label>

                        <input
                            id="model_pakaian"
                            type="text"
                            name="model_pakaian"
                            class="form-control"
                            value="{{ old('model_pakaian') }}"
                            placeholder="Contoh: Dress panjang lengan panjang"
                        >
                    </div>

                    {{-- JUMLAH --}}
                    <div class="form-group">
                        <label class="form-label" for="jumlah">
                            Jumlah <span class="required">*</span>
                        </label>

                        <input
                            id="jumlah"
                            type="number"
                            name="jumlah"
                            class="form-control"
                            value="{{ old('jumlah', 1) }}"
                            min="1"
                            step="1"
                            required
                        >

                        <small class="form-help">
                            Masukkan jumlah pakaian yang ingin dijahit
                            atau diperbaiki.
                        </small>
                    </div>

                    {{-- TANGGAL HARAPAN --}}
                    <div class="form-group">
                        <label class="form-label" for="tanggal_harapan">
                            Tanggal yang Diharapkan
                            <span class="required">*</span>
                        </label>

                        <input
                            id="tanggal_harapan"
                            type="date"
                            name="tanggal_harapan"
                            class="form-control"
                            value="{{ old('tanggal_harapan') }}"
                            required
                        >

                        <small class="form-help">
                            Pilih tanggal target penyelesaian pesanan Anda.
                        </small>
                    </div>

                    {{-- UKURAN --}}
                    <div class="form-group full">
                        <label class="form-label" for="ukuran">
                            Ukuran <span class="required">*</span>
                        </label>

                        <textarea
                            id="ukuran"
                            name="ukuran"
                            placeholder="Contoh: Lingkar dada 90 cm, panjang baju 65 cm, panjang lengan 55 cm"
                            required
                        >{{ old('ukuran') }}</textarea>

                        <small class="form-help">
                            Cantumkan ukuran dalam sentimeter bila memungkinkan.
                        </small>
                    </div>

                    {{-- CATATAN --}}
                    <div class="form-group full">
                        <label class="form-label" for="catatan">
                            Catatan Tambahan
                        </label>

                        <textarea
                            id="catatan"
                            name="catatan"
                            placeholder="Tuliskan detail tambahan, pilihan bahan, warna, atau permintaan khusus..."
                        >{{ old('catatan') }}</textarea>
                    </div>

                </div>
            </section>

            {{-- REFERENSI MODEL --}}
            <section class="pesanan-section"
                     aria-labelledby="referensi-title">

                <div class="section-heading">
                    <span class="section-number">02</span>
                    <div>
                        <h2 class="section-title" id="referensi-title">
                            Referensi Model dari Penjahit
                        </h2>
                        <p class="section-description">
                            Pilih contoh model yang paling mendekati keinginan Anda.
                        </p>
                    </div>
                </div>

                <p class="referensi-info">
                    Referensi bersifat opsional. Jika tidak ada model yang sesuai,
                    jelaskan model yang diinginkan pada kolom catatan tambahan.
                </p>

                {{-- NILAI REFERENSI YANG DIKIRIM KE SERVER --}}
                <input
                    type="hidden"
                    name="referensi_model"
                    id="referensi_model"
                    value="{{ old('referensi_model') }}"
                >

                <div class="referensi-grid">

                    {{-- KEBAYA --}}
                    <div class="referensi-option">
                        <input
                            type="radio"
                            name="referensi_pilihan"
                            id="referensi_kebaya"
                            value="Kebaya - Model Kebaya"
                            {{ old('referensi_model') == 'Kebaya - Model Kebaya' ? 'checked' : '' }}
                        >

                        <label for="referensi_kebaya" class="referensi-card">
                            <div class="referensi-image-wrap">
                                <img
    src="https://images.unsplash.com/photo-1610030469983-98e550d6193c?auto=format&fit=crop&w=800&q=85"
    alt="Referensi busana tradisional untuk model kebaya"
    class="referensi-image"
    loading="lazy"
    onerror="this.onerror=null;this.src='https://placehold.co/800x500/f8eaf0/965e6d?text=Model+Kebaya'"
>
                                <span class="referensi-check" aria-hidden="true">✓</span>
                            </div>

                            <div class="referensi-content">
                                <div class="referensi-name">Kebaya</div>
                                <p class="referensi-desc">
                                    Contoh model kebaya hasil jahitan yang
                                    tersedia di JAITIN.
                                </p>
                            </div>
                        </label>
                    </div>

                    {{-- DRESS --}}
                    <div class="referensi-option">
                        <input
                            type="radio"
                            name="referensi_pilihan"
                            id="referensi_dress"
                            value="Dress - Model Dress"
                            {{ old('referensi_model') == 'Dress - Model Dress' ? 'checked' : '' }}
                        >

                        <label for="referensi_dress" class="referensi-card">
                            <div class="referensi-image-wrap">
                                <img
    src="https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&w=800&q=85"
    alt="Referensi model dress wanita"
    class="referensi-image"
    loading="lazy"
    onerror="this.onerror=null;this.src='https://placehold.co/800x500/f8eaf0/965e6d?text=Model+Dress'"
>
                                <span class="referensi-check" aria-hidden="true">✓</span>
                            </div>

                            <div class="referensi-content">
                                <div class="referensi-name">Dress</div>
                                <p class="referensi-desc">
                                    Contoh model dress yang pernah dibuat
                                    oleh penjahit.
                                </p>
                            </div>
                        </label>
                    </div>

                    {{-- PAKAIAN --}}
                    <div class="referensi-option">
                        <input
                            type="radio"
                            name="referensi_pilihan"
                            id="referensi_pakaian"
                            value="Pakaian - Model Pakaian"
                            {{ old('referensi_model') == 'Pakaian - Model Pakaian' ? 'checked' : '' }}
                        >

                        <label for="referensi_pakaian" class="referensi-card">
                            <div class="referensi-image-wrap">
                                <img
    src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=800&q=85"
    alt="Referensi model pakaian"
    class="referensi-image"
    loading="lazy"
    onerror="this.onerror=null;this.src='https://placehold.co/800x500/f8eaf0/965e6d?text=Model+Pakaian'"
>
                                <span class="referensi-check" aria-hidden="true">✓</span>
                            </div>

                            <div class="referensi-content">
                                <div class="referensi-name">Pakaian</div>
                                <p class="referensi-desc">
                                    Contoh pakaian hasil jahitan yang tersedia.
                                </p>
                            </div>
                        </label>
                    </div>

                    {{-- PERBAIKAN PAKAIAN --}}
                    <div class="referensi-option">
                        <input
                            type="radio"
                            name="referensi_pilihan"
                            id="referensi_perbaikan"
                            value="Perbaikan Pakaian"
                            {{ old('referensi_model') == 'Perbaikan Pakaian' ? 'checked' : '' }}
                        >

                        <label for="referensi_perbaikan" class="referensi-card">
                            <div class="referensi-image-wrap">
                                <img
    src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=800&q=85"
    alt="Ilustrasi perawatan dan perbaikan pakaian"
    class="referensi-image"
    loading="lazy"
    onerror="this.onerror=null;this.src='https://placehold.co/800x500/f8eaf0/965e6d?text=Perbaikan+Pakaian'"
>
                                <span class="referensi-check" aria-hidden="true">✓</span>
                            </div>

                            <div class="referensi-content">
                                <div class="referensi-name">Perbaikan Pakaian</div>
                                <p class="referensi-desc">
                                    Contoh hasil perbaikan atau perubahan pakaian.
                                </p>
                            </div>
                        </label>
                    </div>

                    {{-- PERMAK --}}
                    <div class="referensi-option">
                        <input
                            type="radio"
                            name="referensi_pilihan"
                            id="referensi_permak"
                            value="Permak - Penyesuaian Ukuran"
                            {{ old('referensi_model') == 'Permak - Penyesuaian Ukuran' ? 'checked' : '' }}
                        >

                        <label for="referensi_permak" class="referensi-card">
                            <div class="referensi-image-wrap">
                                <img
    src="https://images.unsplash.com/photo-1590736969955-71cc94901144?auto=format&fit=crop&w=800&q=85"
    alt="Ilustrasi penyesuaian ukuran pakaian"
    class="referensi-image"
    loading="lazy"
    onerror="this.onerror=null;this.src='https://placehold.co/800x500/f8eaf0/965e6d?text=Permak+Pakaian'"
>
                                <span class="referensi-check" aria-hidden="true">✓</span>
                            </div>

                            <div class="referensi-content">
                                <div class="referensi-name">Permak</div>
                                <p class="referensi-desc">
                                    Contoh hasil penyesuaian ukuran pakaian.
                                </p>
                            </div>
                        </label>
                    </div>

                    {{-- MODEL LAINNYA --}}
                    <div class="referensi-option">
                        <input
                            type="radio"
                            name="referensi_pilihan"
                            id="referensi_lainnya"
                            value="Model Lainnya"
                            {{ old('referensi_model') == 'Model Lainnya' ? 'checked' : '' }}
                        >

                        <label for="referensi_lainnya" class="referensi-card">
                            <div class="referensi-image-wrap">
                                <img
    src="https://images.unsplash.com/photo-1551232864-3f0890e580d9?auto=format&fit=crop&w=800&q=85"
    alt="Inspirasi model busana lainnya"
    class="referensi-image"
    loading="lazy"
    onerror="this.onerror=null;this.src='https://placehold.co/800x500/f8eaf0/965e6d?text=Inspirasi+Busana'"
>
                                <span class="referensi-check" aria-hidden="true">✓</span>
                            </div>

                            <div class="referensi-content">
                                <div class="referensi-name">Model Lainnya</div>
                                <p class="referensi-desc">
                                    Pilihan model lain yang ingin didiskusikan
                                    dengan penjahit.
                                </p>
                            </div>
                        </label>
                    </div>

                </div>

                <small class="form-help">
                    Klik kartu untuk memilih referensi. Anda hanya dapat memilih satu model.
                </small>

                {{-- INFORMASI MODEL TERPILIH --}}
                <div
                    id="selectedReference"
                    class="selected-reference"
                    aria-live="polite"
                >
                    <span class="selected-reference-icon" aria-hidden="true">✓</span>
                    <span>
                        Referensi dipilih:
                        <strong id="selectedReferenceName"></strong>
                    </span>
                </div>

            </section>

            {{-- TOMBOL --}}
            <div class="button-area">
                <a
                    href="{{ route('dashboard') }}"
                    class="btn-action btn-cancel"
                >
                    Batal
                </a>

                <button type="submit" class="btn-action btn-submit">
                    Kirim Pesanan <span aria-hidden="true">→</span>
                </button>
            </div>

        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const pilihan = document.querySelectorAll(
        'input[name="referensi_pilihan"]'
    );

    const referensiModel = document.getElementById('referensi_model');
    const selectedReference = document.getElementById('selectedReference');
    const selectedReferenceName = document.getElementById('selectedReferenceName');
    const dateInput = document.getElementById('tanggal_harapan');

    /*
     * Sinkronkan pilihan kartu dengan input hidden yang dikirim ke server.
     * Fungsi ini juga memulihkan pilihan setelah validasi gagal.
     */
    function syncReferenceSelection() {
        const selected = document.querySelector(
            'input[name="referensi_pilihan"]:checked'
        );

        if (selected) {
            referensiModel.value = selected.value;
            selectedReferenceName.textContent = selected.value;
            selectedReference.classList.add('show');
        } else {
            referensiModel.value = '';
            selectedReferenceName.textContent = '';
            selectedReference.classList.remove('show');
        }
    }

    pilihan.forEach(function (radio) {
        radio.addEventListener('change', syncReferenceSelection);
    });

    syncReferenceSelection();

    /*
     * Batasi tanggal minimum di sisi browser.
     * Validasi tanggal di controller Laravel tetap diperlukan.
     */
    if (dateInput) {
        const today = new Date();
        const localToday = [
            today.getFullYear(),
            String(today.getMonth() + 1).padStart(2, '0'),
            String(today.getDate()).padStart(2, '0')
        ].join('-');

        dateInput.min = localToday;
    }
});
</script>
@endsection
