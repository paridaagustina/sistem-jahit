@extends('layouts.admin')

@section('title', 'Referensi Model - JAITIN')
@section('page-title', 'Referensi Model')
@section('page-description', 'Kelola katalog model dan layanan jahit JAITIN.')

@section('styles')
<style>
    /* ===== REFERENSI MODEL JAITIN ===== */
    .reference-page {
        --ref-primary: #ad7b82;
        --ref-primary-dark: #91646b;
        --ref-primary-light: #f5e7e8;
        --ref-cream: #fffaf7;
        --ref-border: #ecddd6;
        --ref-text: #493936;
        --ref-muted: #927e78;
        --ref-shadow: 0 8px 26px rgba(103, 75, 66, .055);

        display: flex;
        flex-direction: column;
        gap: 26px;
        min-width: 0;
        color: var(--ref-text);
    }

    .reference-page *,
    .reference-page *::before,
    .reference-page *::after {
        box-sizing: border-box;
    }

    .reference-page h2,
    .reference-page h3,
    .reference-page p {
        margin-top: 0;
    }

    /* ===== PAGE INTRO ===== */
    .reference-intro {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 22px;
        padding: 28px 30px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,.4);
        border-radius: 22px;
        background: linear-gradient(120deg, #95666f 0%, #b78389 56%, #d5a69a 100%);
        color: #fffaf6;
        box-shadow: 0 12px 30px rgba(145, 100, 107, .13);
    }

    .reference-intro::before,
    .reference-intro::after {
        position: absolute;
        content: "";
        pointer-events: none;
        border: 1px solid rgba(255,255,255,.14);
        border-radius: 50%;
    }

    .reference-intro::before {
        width: 230px;
        height: 230px;
        top: -135px;
        right: 90px;
        box-shadow:
            0 0 0 22px rgba(255,255,255,.035),
            0 0 0 48px rgba(255,255,255,.025);
    }

    .reference-intro::after {
        width: 170px;
        height: 170px;
        right: -60px;
        bottom: -115px;
        background: rgba(255,255,255,.07);
    }

    .reference-intro-content {
        position: relative;
        z-index: 1;
        max-width: 700px;
    }

    .reference-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 13px;
        padding: 7px 11px;
        border: 1px solid rgba(255,255,255,.25);
        border-radius: 30px;
        background: rgba(255,255,255,.12);
        color: #fffaf6;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1.1px;
    }

    .reference-intro h2 {
        margin-bottom: 9px;
        color: #fffaf6;
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(23px, 2.5vw, 31px);
        line-height: 1.35;
        font-weight: 700;
    }

    .reference-intro p {
        max-width: 610px;
        margin-bottom: 0;
        color: rgba(255,250,246,.9);
        font-size: 13px;
        line-height: 1.85;
    }

    .reference-intro-icon {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 88px;
        height: 88px;
        flex-shrink: 0;
        margin-right: 12px;
        border: 1px solid rgba(255,255,255,.3);
        border-radius: 25px;
        background: rgba(255,255,255,.13);
        color: #fffaf6;
        font-size: 37px;
        transform: rotate(-5deg);
    }

    /* ===== SHARED CARD ===== */
    .reference-card {
        min-width: 0;
        padding: 26px;
        border: 1px solid var(--ref-border);
        border-radius: 20px;
        background: #fffdfb;
        box-shadow: var(--ref-shadow);
    }

    .reference-card-header {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        margin-bottom: 24px;
    }

    .reference-card-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        flex-shrink: 0;
        border: 1px solid #eedcdd;
        border-radius: 14px;
        background: var(--ref-primary-light);
        color: var(--ref-primary-dark);
        font-size: 18px;
    }

    .reference-card-header h2 {
        margin-bottom: 5px;
        color: var(--ref-text);
        font-size: 17px;
        font-weight: 750;
        line-height: 1.45;
    }

    .reference-card-header p {
        margin-bottom: 0;
        color: var(--ref-muted);
        font-size: 12px;
        line-height: 1.7;
    }

    .reference-divider {
        height: 1px;
        margin: 0 0 24px;
        background: #f0e6e0;
    }

    /* ===== FLASH MESSAGES ===== */
    .form-message {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 18px;
        padding: 14px 16px;
        border: 1px solid;
        border-radius: 12px;
        font-size: 13px;
        line-height: 1.7;
    }

    .form-message > i {
        margin-top: 3px;
        flex-shrink: 0;
    }

    .form-success {
        border-color: #c9e7d1;
        background: #f0faf2;
        color: #286640;
    }

    .form-error-box {
        border-color: #f0caca;
        background: #fff4f3;
        color: #a53030;
    }

    .form-error-box ul {
        margin: 7px 0 0;
        padding-left: 19px;
    }

    /* ===== FORM ===== */
    .upload-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 21px 20px;
    }

    .upload-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
        min-width: 0;
    }

    .upload-group-full {
        grid-column: 1 / -1;
    }

    .upload-group label {
        color: #604b46;
        font-size: 12px;
        font-weight: 700;
    }

    .required-mark {
        color: #c46e78;
    }

    .upload-group input:not([type="file"]),
    .upload-group select,
    .upload-group textarea {
        display: block;
        width: 100%;
        min-width: 0;
        padding: 12px 14px;
        border: 1px solid #e8d9d2;
        border-radius: 11px;
        outline: none;
        background: #fff;
        color: var(--ref-text);
        font-family: inherit;
        font-size: 13px;
        line-height: 1.5;
        transition: border-color .2s, box-shadow .2s, background .2s;
    }

    .upload-group input::placeholder,
    .upload-group textarea::placeholder {
        color: #b3a29b;
    }

    .upload-group input:not([type="file"]):hover,
    .upload-group select:hover,
    .upload-group textarea:hover {
        border-color: #d6b9b6;
    }

    .upload-group input:not([type="file"]):focus,
    .upload-group select:focus,
    .upload-group textarea:focus {
        border-color: var(--ref-primary);
        background: #fffdfd;
        box-shadow: 0 0 0 4px rgba(173,123,130,.12);
    }

    .upload-group textarea {
        min-height: 115px;
        resize: vertical;
    }

    .upload-group small {
        color: var(--ref-muted);
        font-size: 11px;
        line-height: 1.6;
    }

    /* ===== FILE UPLOAD ===== */
    .file-upload-box {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 150px;
        padding: 18px;
        overflow: hidden;
        border: 1px dashed #d8b9b8;
        border-radius: 13px;
        background: #fff9f7;
        text-align: center;
        transition: border-color .2s, background .2s;
    }

    .file-upload-box:hover,
    .file-upload-box.is-dragging {
        border-color: var(--ref-primary);
        background: #fff0f0;
    }

    .file-upload-box > i {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 13px;
        background: #f4e3e5;
        color: var(--ref-primary-dark);
        font-size: 19px;
    }

    .file-upload-title {
        color: #604b46;
        font-size: 12px;
        font-weight: 700;
    }

    .file-upload-caption {
        color: var(--ref-muted);
        font-size: 11px;
        line-height: 1.6;
    }

    .file-upload-box input[type="file"] {
        width: 100%;
        max-width: 100%;
        color: var(--ref-muted);
        font-family: inherit;
        font-size: 11px;
    }

    .file-preview {
        display: none;
        width: 100%;
        margin-top: 8px;
    }

    .file-preview.is-visible {
        display: block;
    }

    .file-preview img {
        display: block;
        width: 100%;
        max-height: 230px;
        border: 1px solid var(--ref-border);
        border-radius: 12px;
        background: #fff;
        object-fit: contain;
    }

    .file-preview-name {
        display: block;
        margin-top: 8px;
        overflow-wrap: anywhere;
        color: var(--ref-muted);
        font-size: 11px;
    }

    /* ===== BUTTONS ===== */
    .reference-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 24px;
        padding-top: 22px;
        border-top: 1px solid #f0e6e0;
    }

    .upload-button,
    .category-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        min-height: 43px;
        padding: 12px 18px;
        border: 1px solid transparent;
        border-radius: 11px;
        background: linear-gradient(135deg, #b8898d, #a7737a);
        color: #fff;
        font-family: inherit;
        font-size: 12px;
        font-weight: 700;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        transition: transform .2s, box-shadow .2s, background .2s;
    }

    .upload-button:hover,
    .category-button:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, #a8757c, #91636b);
        color: #fff;
        box-shadow: 0 7px 17px rgba(145,100,107,.2);
    }

    .upload-button:focus-visible,
    .category-button:focus-visible {
        outline: 3px solid rgba(173,123,130,.3);
        outline-offset: 3px;
    }

    /* ===== CATEGORY SECTION ===== */
    .category-section-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 17px;
    }

    .category-section-heading h2 {
        margin-bottom: 5px;
        color: var(--ref-text);
        font-size: 18px;
        font-weight: 750;
    }

    .category-section-heading p {
        margin-bottom: 0;
        color: var(--ref-muted);
        font-size: 12px;
        line-height: 1.7;
    }

    .category-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .category-card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        padding: 23px;
        overflow: hidden;
        border: 1px solid var(--ref-border);
        border-radius: 19px;
        background: #fffdfb;
        box-shadow: 0 5px 18px rgba(103,75,66,.035);
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }

    .category-card::after {
        position: absolute;
        right: -34px;
        bottom: -45px;
        width: 115px;
        height: 115px;
        border-radius: 50%;
        background: var(--category-soft);
        content: "";
        opacity: .65;
        pointer-events: none;
    }

    .category-card:hover {
        transform: translateY(-4px);
        border-color: #d9b9b6;
        box-shadow: 0 13px 28px rgba(103,75,66,.09);
    }

    .category-card-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 18px;
    }

    .category-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 54px;
        height: 54px;
        flex-shrink: 0;
        border-radius: 16px;
        background: var(--category-soft);
        color: var(--category-color);
        font-size: 22px;
    }

    .category-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 31px;
        height: 27px;
        padding: 0 8px;
        border: 1px solid var(--category-soft);
        border-radius: 8px;
        background: var(--category-soft);
        color: var(--category-color);
        font-size: 10px;
        font-weight: 800;
    }

    .category-card h3 {
        position: relative;
        z-index: 1;
        margin-bottom: 9px;
        color: var(--ref-text);
        font-size: 16px;
        font-weight: 750;
    }

    .category-card p {
        position: relative;
        z-index: 1;
        flex: 1;
        margin-bottom: 22px;
        color: var(--ref-muted);
        font-size: 12px;
        line-height: 1.8;
    }

    .category-card .category-button {
        position: relative;
        z-index: 1;
        width: 100%;
    }

    .category-kebaya {
        --category-color: #a56d79;
        --category-soft: #f5e5e8;
    }

    .category-dress {
        --category-color: #ad8050;
        --category-soft: #f7ecdd;
    }

    .category-perbaikan {
        --category-color: #7e72a5;
        --category-soft: #eee9f7;
    }

    /* ===== BOTTOM NOTE ===== */
    .reference-note {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin: 0;
        padding: 17px 19px;
        border: 1px solid #eaded3;
        border-radius: 14px;
        background: #fbf4ee;
        color: #806e69;
        font-size: 12px;
        line-height: 1.8;
    }

    .reference-note i {
        margin-top: 3px;
        color: var(--ref-primary-dark);
        font-size: 16px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1100px) {
        .category-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 768px) {
        .reference-page {
            gap: 20px;
        }

        .reference-intro {
            padding: 23px;
            border-radius: 18px;
        }

        .reference-intro-icon {
            width: 70px;
            height: 70px;
            margin-right: 0;
            border-radius: 20px;
            font-size: 29px;
        }

        .reference-card {
            padding: 21px;
            border-radius: 17px;
        }

        .category-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 13px;
        }

        .category-card {
            padding: 18px;
        }
    }

    @media (max-width: 560px) {
        .reference-intro {
            padding: 21px 19px;
        }

        .reference-intro-icon {
            display: none;
        }

        .reference-intro h2 {
            font-size: 24px;
        }

        .reference-intro p {
            font-size: 12px;
        }

        .reference-card {
            padding: 17px;
        }

        .reference-card-header {
            gap: 10px;
            margin-bottom: 19px;
        }

        .reference-card-icon {
            width: 41px;
            height: 41px;
            border-radius: 12px;
        }

        .upload-grid,
        .category-grid {
            grid-template-columns: minmax(0, 1fr);
        }

        .upload-group-full {
            grid-column: auto;
        }

        .reference-actions {
            flex-direction: column;
        }

        .upload-button {
            width: 100%;
        }

        .category-card {
            padding: 20px;
        }

        .category-section-heading h2 {
            font-size: 16px;
        }

        .reference-note {
            padding: 15px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .category-card,
        .upload-button,
        .category-button,
        .upload-group input,
        .upload-group select,
        .upload-group textarea {
            transition: none;
        }
    }
</style>
@endsection

@section('content')
<div class="reference-page">

    {{-- HEADER --}}
    <section class="reference-intro">
        <div class="reference-intro-content">
            <div class="reference-eyebrow">
                <i class="fa-solid fa-sparkles"></i>
                JAITIN ADMINISTRATION
            </div>

            <h2>Katalog Referensi Model</h2>

            <p>
                Kelola inspirasi model pakaian dan layanan jahit dalam satu tempat.
                Tambahkan foto referensi agar pelanggan lebih mudah menentukan
                model yang sesuai dengan keinginannya.
            </p>
        </div>

        <div class="reference-intro-icon" aria-hidden="true">
            <i class="fa-solid fa-shirt"></i>
        </div>
    </section>

    {{-- FORM TAMBAH REFERENSI --}}
    <section class="reference-card">
        <div class="reference-card-header">
            <div class="reference-card-icon">
                <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>

            <div>
                <h2>Tambah Referensi Model</h2>
                <p>Lengkapi informasi model dan unggah foto sebagai inspirasi jahitan.</p>
            </div>
        </div>

        <div class="reference-divider"></div>

        @if (session('success'))
            <div class="form-message form-success" role="status">
                <i class="fa-solid fa-circle-check"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if (session('error'))
            <div class="form-message form-error-box" role="alert">
                <i class="fa-solid fa-circle-exclamation"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        @if ($errors->any())
            <div class="form-message form-error-box" role="alert">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <div>
                    <strong>Referensi belum berhasil disimpan.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form
            action="{{ route('admin.referensi-model.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="upload-grid">
                <div class="upload-group">
                    <label for="nama_model">
                        Nama Referensi <span class="required-mark">*</span>
                    </label>

                    <input
                        type="text"
                        id="nama_model"
                        name="nama_model"
                        value="{{ old('nama_model') }}"
                        placeholder="Contoh: Kebaya Modern Model 1"
                        maxlength="255"
                        autocomplete="off"
                        required
                    >
                </div>

                <div class="upload-group">
                    <label for="kategori">
                        Kategori Utama <span class="required-mark">*</span>
                    </label>

                    <select id="kategori" name="kategori" required>
                        <option value="">Pilih kategori</option>
                        <option value="kebaya" @selected(old('kategori') === 'kebaya')>
                            Kebaya
                        </option>
                        <option value="dress" @selected(old('kategori') === 'dress')>
                            Dress
                        </option>
                        <option value="perbaikan" @selected(old('kategori') === 'perbaikan')>
                            Perbaikan Pakaian
                        </option>
                    </select>
                </div>

                <div class="upload-group">
                    <label for="jenis_model">
                        Jenis Model <span class="required-mark">*</span>
                    </label>

                    <select id="jenis_model" name="jenis_model" required>
                        <option value="">Pilih kategori terlebih dahulu</option>
                    </select>

                    <small>Pilihan jenis model menyesuaikan kategori utama.</small>
                </div>

                <div class="upload-group">
                    <label for="foto">
                        Foto Referensi <span class="required-mark">*</span>
                    </label>

                    <div class="file-upload-box" id="fileUploadBox">
                        <i class="fa-regular fa-image"></i>

                        <div class="file-upload-title">Pilih foto referensi</div>

                        <div class="file-upload-caption">
                            JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                        </div>

                        <input
                            type="file"
                            id="foto"
                            name="foto"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            required
                        >

                        <div class="file-preview" id="filePreview">
                            <img src="" alt="Pratinjau foto referensi" id="previewImage">
                            <span class="file-preview-name" id="filePreviewName"></span>
                        </div>
                    </div>
                </div>

                <div class="upload-group upload-group-full">
                    <label for="deskripsi">Deskripsi Model</label>

                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        maxlength="1000"
                        placeholder="Jelaskan detail model, potongan pakaian, bahan, atau inspirasi desain..."
                    >{{ old('deskripsi') }}</textarea>

                    <small>Opsional. Maksimal 1.000 karakter.</small>
                </div>
            </div>

            <input type="hidden" name="aktif" value="1">

            <div class="reference-actions">
                <button type="submit" class="upload-button">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Simpan Referensi Model
                </button>
            </div>
        </form>
    </section>

    {{-- KATEGORI REFERENSI --}}
    <section>
        <div class="category-section-heading">
            <div>
                <h2>Kategori Referensi</h2>
                <p>Pilih kategori untuk mengelola koleksi foto model.</p>
            </div>
        </div>

        <div class="category-grid">
            <article class="category-card category-kebaya">
                <div class="category-card-top">
                    <div class="category-icon">
                        <i class="fa-solid fa-spool"></i>
                    </div>
                    <span class="category-number">01</span>
                </div>

                <h3>Kebaya</h3>

                <p>
                    Kelola koleksi kebaya klasik, kebaya modern, dan kebaya
                    minimalis sebagai inspirasi model jahitan pelanggan.
                </p>

                <a
                    class="category-button"
                    href="{{ route('admin.referensi-model.kategori', ['kategori' => 'kebaya']) }}"
                >
                    <i class="fa-solid fa-images"></i>
                    Kelola Kebaya
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </article>

            <article class="category-card category-dress">
                <div class="category-card-top">
                    <div class="category-icon">
                        <i class="fa-solid fa-person-dress"></i>
                    </div>
                    <span class="category-number">02</span>
                </div>

                <h3>Dress</h3>

                <p>
                    Kelola referensi dress pesta, formal, dan kasual beserta
                    koleksi model yang dapat dijadikan inspirasi.
                </p>

                <a
                    class="category-button"
                    href="{{ route('admin.referensi-model.kategori', ['kategori' => 'dress']) }}"
                >
                    <i class="fa-solid fa-images"></i>
                    Kelola Dress
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </article>

            <article class="category-card category-perbaikan">
                <div class="category-card-top">
                    <div class="category-icon">
                        <i class="fa-solid fa-scissors"></i>
                    </div>
                    <span class="category-number">03</span>
                </div>

                <h3>Perbaikan Pakaian</h3>

                <p>
                    Kelola referensi layanan mengecilkan atau memendekkan
                    pakaian serta mengganti resleting.
                </p>

                <a
                    class="category-button"
                    href="{{ route('admin.referensi-model.kategori', ['kategori' => 'perbaikan']) }}"
                >
                    <i class="fa-solid fa-images"></i>
                    Kelola Layanan
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </article>
        </div>
    </section>

    {{-- INFORMASI TAMBAHAN --}}
    <div class="reference-note">
        <i class="fa-solid fa-lightbulb"></i>

        <div>
            <strong>Tips pengelolaan katalog</strong><br>
            Kamu dapat menambahkan beberapa foto dengan kategori dan jenis model
            yang sama. Setiap foto disimpan sebagai data referensi tersendiri
            sesuai dukungan controller dan database.
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const jenisPerKategori = {
        kebaya: [
            { value: 'Kebaya Klasik', label: 'Kebaya Klasik' },
            { value: 'Kebaya Modern', label: 'Kebaya Modern' },
            { value: 'Kebaya Minimalis', label: 'Kebaya Minimalis' }
        ],
        dress: [
            { value: 'Dress Pesta', label: 'Dress Pesta' },
            { value: 'Dress Formal', label: 'Dress Formal' },
            { value: 'Dress Casual', label: 'Dress Casual' }
        ],
        perbaikan: [
            { value: 'Mengecilkan Pakaian', label: 'Mengecilkan Pakaian' },
            { value: 'Memendekkan Pakaian', label: 'Memendekkan Pakaian' },
            { value: 'Mengganti Resleting', label: 'Mengganti Resleting' }
        ]
    };

    const kategoriSelect = document.getElementById('kategori');
    const jenisSelect = document.getElementById('jenis_model');
    const jenisLama = @json(old('jenis_model'));

    function perbaruiJenisModel() {
        const kategori = kategoriSelect.value;
        const daftarJenis = jenisPerKategori[kategori] || [];

        jenisSelect.replaceChildren();

        const pilihanAwal = document.createElement('option');
        pilihanAwal.value = '';
        pilihanAwal.textContent = daftarJenis.length
            ? 'Pilih jenis model'
            : 'Pilih kategori terlebih dahulu';

        jenisSelect.appendChild(pilihanAwal);

        daftarJenis.forEach(function (jenis) {
            const option = document.createElement('option');
            option.value = jenis.value;
            option.textContent = jenis.label;
            option.selected = jenis.value === jenisLama;
            jenisSelect.appendChild(option);
        });
    }

    kategoriSelect.addEventListener('change', function () {
        perbaruiJenisModel();
    });

    perbaruiJenisModel();

    /* Pratinjau foto sebelum dikirim ke server */
    const fotoInput = document.getElementById('foto');
    const previewBox = document.getElementById('filePreview');
    const previewImage = document.getElementById('previewImage');
    const previewName = document.getElementById('filePreviewName');
    const uploadBox = document.getElementById('fileUploadBox');

    let previewUrl = null;

    fotoInput.addEventListener('change', function () {
        const file = this.files && this.files[0];

        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }

        if (!file) {
            previewBox.classList.remove('is-visible');
            previewImage.removeAttribute('src');
            previewName.textContent = '';
            return;
        }

        const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        const maxSize = 2 * 1024 * 1024;

        if (!allowedTypes.includes(file.type)) {
            alert('Format foto harus JPG, JPEG, PNG, atau WEBP.');
            this.value = '';
            previewBox.classList.remove('is-visible');
            return;
        }

        if (file.size > maxSize) {
            alert('Ukuran foto maksimal 2 MB.');
            this.value = '';
            previewBox.classList.remove('is-visible');
            return;
        }

        previewUrl = URL.createObjectURL(file);
        previewImage.src = previewUrl;
        previewName.textContent = file.name;
        previewBox.classList.add('is-visible');
    });

    /* Efek visual saat file diseret ke area unggah.
       Pengunggahan tetap melalui input file standar. */
    ['dragenter', 'dragover'].forEach(function (eventName) {
        uploadBox.addEventListener(eventName, function (event) {
            event.preventDefault();
            uploadBox.classList.add('is-dragging');
        });
    });

    ['dragleave', 'drop'].forEach(function (eventName) {
        uploadBox.addEventListener(eventName, function (event) {
            event.preventDefault();
            uploadBox.classList.remove('is-dragging');
        });
    });
});
</script>
@endsection
