
@extends('layouts.admin')

@section('title', $namaJenis . ' - Referensi Model JAITIN')
@section('page-title', $namaJenis)
@section('page-description', 'Kelola koleksi foto referensi model jahit JAITIN.')

@section('styles')
<style>
    .jenis-page {
        --pink: #ad7b82;
        --pink-dark: #91646b;
        --pink-soft: #f7e9e9;
        --cream: #fffaf7;
        --border: #ecded7;
        --text: #493936;
        --muted: #927e78;
        --shadow: 0 8px 28px rgba(103, 75, 66, .06);
        display: flex;
        flex-direction: column;
        gap: 24px;
        min-width: 0;
        color: var(--text);
    }

    .jenis-page *,
    .jenis-page *::before,
    .jenis-page *::after {
        box-sizing: border-box;
    }

    .jenis-page h2,
    .jenis-page h3,
    .jenis-page p {
        margin-top: 0;
    }

    .jenis-hero {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 22px;
        padding: 30px;
        overflow: hidden;
        border-radius: 22px;
        background: linear-gradient(120deg, #91646b, #b78389 60%, #d5a69a);
        color: white;
        box-shadow: 0 12px 30px rgba(145, 100, 107, .14);
    }

    .jenis-hero::after {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        right: -55px;
        top: -120px;
        border: 1px solid rgba(255,255,255,.22);
        border-radius: 50%;
        box-shadow: 0 0 0 25px rgba(255,255,255,.04),
                    0 0 0 52px rgba(255,255,255,.035);
        pointer-events: none;
    }

    .hero-content {
        position: relative;
        z-index: 1;
        min-width: 0;
    }

    .hero-label {
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
        font-weight: 800;
        letter-spacing: 1px;
    }

    .jenis-hero h2 {
        margin-bottom: 10px;
        color: #fffaf6;
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(24px, 3vw, 34px);
        line-height: 1.35;
    }

    .jenis-hero p {
        max-width: 650px;
        margin-bottom: 0;
        color: rgba(255,250,246,.9);
        font-size: 13px;
        line-height: 1.85;
    }

    .hero-icon {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 82px;
        height: 82px;
        flex-shrink: 0;
        border: 1px solid rgba(255,255,255,.3);
        border-radius: 24px;
        background: rgba(255,255,255,.13);
        color: white;
        font-size: 34px;
        transform: rotate(-5deg);
    }

    .jenis-breadcrumb {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 9px;
        color: var(--muted);
        font-size: 12px;
    }

    .jenis-breadcrumb a {
        color: var(--pink-dark);
        text-decoration: none;
        font-weight: 600;
    }

    .jenis-breadcrumb a:hover {
        text-decoration: underline;
    }

    .jenis-breadcrumb .separator {
        color: #c5aaa3;
    }

    .jenis-alert {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 15px 17px;
        border: 1px solid;
        border-radius: 13px;
        font-size: 13px;
        line-height: 1.7;
    }

    .jenis-alert i {
        margin-top: 3px;
        flex-shrink: 0;
    }

    .jenis-alert-success {
        border-color: #c9e7d1;
        background: #f0faf2;
        color: #286640;
    }

    .jenis-alert-error {
        border-color: #f0caca;
        background: #fff4f3;
        color: #a53030;
    }

    .jenis-alert ul {
        margin: 7px 0 0;
        padding-left: 19px;
    }

    .jenis-summary {
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        align-items: center;
        gap: 20px;
        padding: 22px 24px;
        border: 1px solid var(--border);
        border-radius: 18px;
        background: #fffdfb;
        box-shadow: var(--shadow);
    }

    .summary-title {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
    }

    .summary-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 47px;
        height: 47px;
        flex-shrink: 0;
        border-radius: 14px;
        background: var(--pink-soft);
        color: var(--pink-dark);
        font-size: 19px;
    }

    .summary-title h2 {
        margin-bottom: 5px;
        color: var(--text);
        font-size: 17px;
        font-weight: 800;
    }

    .summary-title p {
        margin-bottom: 0;
        color: var(--muted);
        font-size: 12px;
        line-height: 1.6;
    }

    .summary-count {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 11px 15px;
        border: 1px solid #eedcdd;
        border-radius: 12px;
        background: #fcf2f2;
        color: var(--pink-dark);
        white-space: nowrap;
    }

    .summary-count strong {
        font-size: 20px;
    }

    .summary-count span {
        font-size: 11px;
        font-weight: 700;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
    }

    .model-card {
        display: flex;
        flex-direction: column;
        min-width: 0;
        overflow: hidden;
        border: 1px solid var(--border);
        border-radius: 19px;
        background: #fffdfb;
        box-shadow: 0 5px 20px rgba(103,75,66,.045);
        transition: transform .22s ease, box-shadow .22s ease;
    }

    .model-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 30px rgba(103,75,66,.10);
    }

    .model-image-wrap {
        position: relative;
        height: 265px;
        overflow: hidden;
        background: #f4e6e4;
    }

    .model-image {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .35s ease;
    }

    .model-card:hover .model-image {
        transform: scale(1.035);
    }

    .image-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 11px;
        width: 100%;
        height: 100%;
        color: #9a7478;
    }

    .image-placeholder i {
        font-size: 40px;
    }

    .image-placeholder span {
        font-size: 12px;
    }

    .model-image-label {
        position: absolute;
        left: 13px;
        top: 13px;
        padding: 7px 10px;
        border: 1px solid rgba(255,255,255,.65);
        border-radius: 20px;
        background: rgba(255,250,247,.94);
        color: var(--pink-dark);
        font-size: 10px;
        font-weight: 800;
        box-shadow: 0 3px 12px rgba(60,40,35,.07);
    }

    .model-content {
        display: flex;
        flex: 1;
        flex-direction: column;
        padding: 19px;
    }

    .model-content h3 {
        margin-bottom: 9px;
        color: var(--text);
        font-size: 16px;
        font-weight: 800;
        line-height: 1.5;
        overflow-wrap: anywhere;
    }

    .model-description {
        display: -webkit-box;
        min-height: 42px;
        margin-bottom: 15px;
        overflow: hidden;
        color: var(--muted);
        font-size: 12px;
        line-height: 1.8;
        overflow-wrap: anywhere;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
    }

    .model-tag {
        display: inline-flex;
        align-items: center;
        align-self: flex-start;
        gap: 7px;
        max-width: 100%;
        padding: 7px 10px;
        border: 1px solid #eedcdd;
        border-radius: 20px;
        background: var(--pink-soft);
        color: var(--pink-dark);
        font-size: 10px;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .card-actions {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        gap: 9px;
        margin-top: auto;
        padding-top: 19px;
    }

    .jenis-page .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-width: 0;
        min-height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 10px;
        font-family: inherit;
        font-size: 12px;
        font-weight: 700;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s, transform .2s, border-color .2s;
    }

    .jenis-page .btn:hover {
        transform: translateY(-1px);
    }

    .btn-edit,
    .btn-save {
        background: var(--pink);
        color: white;
    }

    .btn-edit:hover,
    .btn-save:hover {
        background: var(--pink-dark);
        color: white;
    }

    .btn-delete {
        width: 100%;
        background: #fff3f1;
        border-color: #efd0ca !important;
        color: #a44343;
    }

    .btn-delete:hover {
        background: #f9e2de;
    }

    .edit-panel {
        display: none;
        padding: 20px;
        border-top: 1px solid var(--border);
        background: #fffaf7;
    }

    .edit-panel.open {
        display: block;
        animation: editReveal .2s ease-out;
    }

    @keyframes editReveal {
        from {
            opacity: 0;
            transform: translateY(-5px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .edit-panel-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .edit-panel-header .edit-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 39px;
        height: 39px;
        flex-shrink: 0;
        border-radius: 12px;
        background: var(--pink-soft);
        color: var(--pink-dark);
    }

    .edit-panel-header h3 {
        margin-bottom: 4px;
        color: var(--text);
        font-size: 15px;
    }

    .edit-panel-header p {
        margin-bottom: 0;
        color: var(--muted);
        font-size: 11px;
        line-height: 1.6;
    }

    .form-group {
        margin-bottom: 15px;
        min-width: 0;
    }

    .form-group label {
        display: block;
        margin-bottom: 7px;
        color: #604b46;
        font-size: 12px;
        font-weight: 750;
    }

    .form-control {
        display: block;
        width: 100%;
        min-width: 0;
        padding: 11px 12px;
        border: 1px solid #e8d9d2;
        border-radius: 10px;
        outline: none;
        background: white;
        color: var(--text);
        font-family: inherit;
        font-size: 12px;
        line-height: 1.6;
        transition: border-color .2s, box-shadow .2s;
    }

    .form-control:focus {
        border-color: var(--pink);
        box-shadow: 0 0 0 4px rgba(173,123,130,.12);
    }

    .form-control:disabled {
        cursor: not-allowed;
        background: #f5efec;
        color: #a89993;
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .current-photo {
        display: block;
        width: 100%;
        max-height: 190px;
        margin-bottom: 12px;
        border: 1px solid var(--border);
        border-radius: 12px;
        background: #f8f1eb;
        object-fit: contain;
    }

    .help-text {
        margin-top: 7px;
        margin-bottom: 0;
        color: var(--muted);
        font-size: 11px;
        line-height: 1.7;
    }

    .form-actions {
        display: flex;
        gap: 9px;
        margin-top: 20px;
    }

    .form-actions .btn-save {
        flex: 1;
    }

    .btn-cancel {
        background: #f0e7e1;
        color: #66504a;
    }

    .btn-cancel:hover {
        background: #e6d8d0;
    }

    .empty-state {
        padding: 50px 25px;
        border: 1px dashed #d9b9b5;
        border-radius: 20px;
        background: #fffdfb;
        text-align: center;
        box-shadow: var(--shadow);
    }

    .empty-state-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 75px;
        height: 75px;
        margin: 0 auto 19px;
        border-radius: 24px;
        background: var(--pink-soft);
        color: var(--pink-dark);
        font-size: 30px;
    }

    .empty-state h3 {
        margin-bottom: 10px;
        color: var(--text);
        font-size: 19px;
    }

    .empty-state p {
        max-width: 500px;
        margin: 0 auto 20px;
        color: var(--muted);
        font-size: 12px;
        line-height: 1.8;
    }

    .jenis-page .back-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        align-self: flex-start;
        min-height: 42px;
        padding: 11px 16px;
        border: 1px solid #ead6d4;
        border-radius: 11px;
        background: #fffdfb;
        color: var(--pink-dark);
        font-size: 12px;
        font-weight: 750;
        text-decoration: none;
        transition: background .2s, border-color .2s;
    }

    .jenis-page .back-button:hover {
        border-color: #d9b9b6;
        background: var(--pink-soft);
    }

    .jenis-note {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 16px 18px;
        border: 1px solid #eaded3;
        border-radius: 14px;
        background: #fbf4ee;
        color: #806e69;
        font-size: 12px;
        line-height: 1.8;
    }

    .jenis-note i {
        margin-top: 3px;
        color: var(--pink-dark);
        font-size: 16px;
    }

    @media (max-width: 1200px) {
        .gallery-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 700px) {
        .jenis-page {
            gap: 18px;
        }

        .jenis-hero {
            padding: 23px;
            border-radius: 18px;
        }

        .hero-icon {
            width: 64px;
            height: 64px;
            border-radius: 19px;
            font-size: 27px;
        }

        .jenis-summary {
            grid-template-columns: minmax(0, 1fr);
            padding: 18px;
        }

        .summary-count {
            justify-self: start;
        }

        .gallery-grid {
            grid-template-columns: minmax(0, 1fr);
            gap: 17px;
        }

        .model-image-wrap {
            height: 290px;
        }
    }

    @media (max-width: 450px) {
        .jenis-hero {
            padding: 21px 18px;
        }

        .hero-icon {
            display: none;
        }

        .jenis-hero h2 {
            font-size: 25px;
        }

        .jenis-page .btn {
            padding: 10px 8px;
            font-size: 11px;
        }

        .edit-panel {
            padding: 16px;
        }

        .model-image-wrap {
            height: 250px;
        }

        .form-actions {
            flex-direction: column;
        }

        .form-actions .btn {
            width: 100%;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .model-card,
        .model-image,
        .jenis-page .btn {
            transition: none;
        }

        .edit-panel.open {
            animation: none;
        }
    }
</style>
@endsection

@section('content')
@php
    $jenisPerKategori = [
        'kebaya' => [
            'Kebaya Klasik',
            'Kebaya Modern',
            'Kebaya Minimalis',
        ],
        'dress' => [
            'Dress Pesta',
            'Dress Formal',
            'Dress Casual',
        ],
        'perbaikan' => [
            'Mengecilkan Pakaian',
            'Memendekkan Pakaian',
            'Mengganti Resleting',
        ],
    ];

    $ikonJenis = [
        'kebaya' => 'fa-solid fa-shirt',
        'dress' => 'fa-solid fa-person-dress',
        'perbaikan' => 'fa-solid fa-scissors',
    ];
@endphp

<div class="jenis-page">

    <section class="jenis-hero">
        <div class="hero-content">
            <div class="hero-label">
                <i class="fa-solid fa-sparkles"></i>
                KATALOG REFERENSI JAITIN
            </div>

            <h2>{{ $namaJenis }}</h2>

            <p>
                Kelola koleksi inspirasi {{ strtolower($namaJenis) }}.
                Kamu dapat memperbarui informasi, mengganti foto, dan menghapus
                referensi yang tidak lagi diperlukan.
            </p>
        </div>

        <div class="hero-icon" aria-hidden="true">
            <i class="{{ $ikonJenis[$kategori] ?? 'fa-solid fa-images' }}"></i>
        </div>
    </section>

    <nav class="jenis-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('admin.referensi-model.index') }}">Referensi Model</a>
        <span class="separator">/</span>
        <a href="{{ route('admin.referensi-model.kategori', ['kategori' => $kategori]) }}">
            {{ ucfirst($kategori) }}
        </a>
        <span class="separator">/</span>
        <span>{{ $namaJenis }}</span>
    </nav>

    @if (session('success'))
        <div class="jenis-alert jenis-alert-success" role="status">
            <i class="fa-solid fa-circle-check"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if (session('error'))
        <div class="jenis-alert jenis-alert-error" role="alert">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="jenis-alert jenis-alert-error" role="alert">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <strong>Periksa kembali data yang kamu masukkan.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <section class="jenis-summary">
        <div class="summary-title">
            <div class="summary-icon">
                <i class="fa-solid fa-images"></i>
            </div>
            <div>
                <h2>Galeri Foto Referensi</h2>
                <p>Koleksi model untuk kategori {{ ucfirst($kategori) }}.</p>
            </div>
        </div>

        <div class="summary-count">
            <strong>{{ $referensiModels->count() }}</strong>
            <span>FOTO REFERENSI</span>
        </div>
    </section>

    @if ($referensiModels->isNotEmpty())
        <section class="gallery-grid" aria-label="Galeri referensi model">
            @foreach ($referensiModels as $model)
                <article class="model-card">

                    <div class="model-image-wrap">
                        @if ($model->foto)
                            <img
                                class="model-image"
                                src="{{ asset('storage/' . $model->foto) }}"
                                alt="Foto {{ $model->nama_model }}"
                                loading="lazy"
                            >
                        @else
                            <div class="image-placeholder">
                                <i class="fa-solid fa-image"></i>
                                <span>Foto belum tersedia</span>
                            </div>
                        @endif

                        <span class="model-image-label">
                            <i class="fa-solid fa-tag"></i>
                            {{ $namaJenis }}
                        </span>
                    </div>

                    <div class="model-content">
                        <h3>{{ $model->nama_model }}</h3>

                        <p class="model-description">
                            {{ $model->deskripsi ?: 'Belum ada deskripsi untuk referensi ini.' }}
                        </p>

                        <span class="model-tag">
                            <i class="fa-solid fa-scissors"></i>
                            {{ $model->jenis_model }}
                        </span>

                        <div class="card-actions">
                            <button
                                type="button"
                                class="btn btn-edit"
                                aria-expanded="false"
                                aria-controls="edit-panel-{{ $model->id }}"
                                onclick="toggleEdit({{ $model->id }}, this)"
                            >
                                <i class="fa-solid fa-pen-to-square"></i>
                                Edit
                            </button>

                            <form
                                action="{{ route('admin.referensi-model.destroy', $model->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus referensi ini? Foto dan datanya akan dihapus.')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-delete">
                                    <i class="fa-solid fa-trash"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="edit-panel" id="edit-panel-{{ $model->id }}">
                        <div class="edit-panel-header">
                            <div class="edit-icon">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                            <div>
                                <h3>Edit Referensi</h3>
                                <p>Perbarui data model di bawah ini.</p>
                            </div>
                        </div>

                        <form
                            action="{{ route('admin.referensi-model.update', $model->id) }}"
                            method="POST"
                            enctype="multipart/form-data"
                        >
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nama-{{ $model->id }}">Nama Model</label>
                                <input
                                    class="form-control"
                                    id="nama-{{ $model->id }}"
                                    type="text"
                                    name="nama_model"
                                    value="{{ $model->nama_model }}"
                                    maxlength="255"
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <label for="kategori-{{ $model->id }}">Kategori</label>
                                <select
                                    class="form-control"
                                    id="kategori-{{ $model->id }}"
                                    name="kategori"
                                    required
                                >
                                    <option value="kebaya" @selected($model->kategori === 'kebaya')>
                                        Kebaya
                                    </option>
                                    <option value="dress" @selected($model->kategori === 'dress')>
                                        Dress
                                    </option>
                                    <option value="perbaikan" @selected($model->kategori === 'perbaikan')>
                                        Perbaikan Pakaian
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jenis-{{ $model->id }}">Jenis Model</label>
                                <select
                                    class="form-control js-jenis-model"
                                    id="jenis-{{ $model->id }}"
                                    name="jenis_model"
                                    data-kategori-id="kategori-{{ $model->id }}"
                                    data-jenis-awal="{{ $model->jenis_model }}"
                                    required
                                >
                                    @foreach ($jenisPerKategori[$model->kategori] ?? [] as $jenisPilihan)
                                        <option
                                            value="{{ $jenisPilihan }}"
                                            @selected($model->jenis_model === $jenisPilihan)
                                        >
                                            {{ $jenisPilihan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="foto-{{ $model->id }}">Foto Saat Ini</label>

                                @if ($model->foto)
                                    <img
                                        class="current-photo"
                                        src="{{ asset('storage/' . $model->foto) }}"
                                        alt="Foto {{ $model->nama_model }}"
                                        loading="lazy"
                                    >
                                @else
                                    <p class="help-text">Belum ada foto tersimpan.</p>
                                @endif

                                <label for="foto-{{ $model->id }}">Pilih Foto Pengganti</label>
                                <input
                                    class="form-control"
                                    id="foto-{{ $model->id }}"
                                    type="file"
                                    name="foto"
                                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                >
                                <p class="help-text">
                                    Opsional. Format JPG, JPEG, PNG, atau WEBP; maksimal 2 MB.
                                </p>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi-{{ $model->id }}">Deskripsi</label>
                                <textarea
                                    class="form-control"
                                    id="deskripsi-{{ $model->id }}"
                                    name="deskripsi"
                                    maxlength="1000"
                                >{{ $model->deskripsi }}</textarea>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-save">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                    Simpan
                                </button>

                                <button
                                    type="button"
                                    class="btn btn-cancel"
                                    onclick="toggleEdit({{ $model->id }}, this)"
                                >
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>

                </article>
            @endforeach
        </section>
    @else
        <section class="empty-state">
            <div class="empty-state-icon">
                <i class="fa-solid fa-images"></i>
            </div>

            <h3>Belum Ada Foto Referensi</h3>

            <p>
                Belum ada foto untuk jenis {{ $namaJenis }}.
                Tambahkan referensi dari halaman pengelolaan katalog agar
                koleksi model muncul di sini.
            </p>

            <a
                class="back-button"
                href="{{ route('admin.referensi-model.index') }}"
            >
                <i class="fa-solid fa-arrow-left"></i>
                Kembali ke Referensi Model
            </a>
        </section>
    @endif

    <a
        class="back-button"
        href="{{ route('admin.referensi-model.kategori', ['kategori' => $kategori]) }}"
    >
        <i class="fa-solid fa-arrow-left"></i>
        Kembali ke Pilihan Jenis Model
    </a>

    <div class="jenis-note">
        <i class="fa-solid fa-lightbulb"></i>
        <div>
            <strong>Informasi katalog</strong><br>
            Setiap foto referensi disimpan sebagai data tersendiri. Pastikan
            kategori dan jenis model sesuai agar koleksi mudah dikelola.
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function toggleEdit(id, button) {
    const panel = document.getElementById('edit-panel-' + id);

    if (!panel) {
        return;
    }

    const isOpen = panel.classList.toggle('open');

    const editButton = document.querySelector(
        '[aria-controls="edit-panel-' + id + '"]'
    );

    if (editButton) {
        editButton.setAttribute('aria-expanded', String(isOpen));
    }

    if (isOpen) {
        panel.scrollIntoView({
            behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches
                ? 'auto'
                : 'smooth',
            block: 'nearest'
        });
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const jenisPerKategori = {
        kebaya: [
            'Kebaya Klasik',
            'Kebaya Modern',
            'Kebaya Minimalis'
        ],
        dress: [
            'Dress Pesta',
            'Dress Formal',
            'Dress Casual'
        ],
        perbaikan: [
            'Mengecilkan Pakaian',
            'Memendekkan Pakaian',
            'Mengganti Resleting'
        ]
    };

    document.querySelectorAll('.js-jenis-model').forEach(function (jenisSelect) {
        const kategoriSelect = document.getElementById(
            jenisSelect.dataset.kategoriId
        );

        if (!kategoriSelect) {
            return;
        }

        const jenisAwal = jenisSelect.dataset.jenisAwal || '';

        function perbaruiJenisModel(nilaiTerpilih = '') {
            const daftarJenis = jenisPerKategori[kategoriSelect.value] || [];

            jenisSelect.replaceChildren();

            const opsiAwal = document.createElement('option');
            opsiAwal.value = '';
            opsiAwal.textContent = '-- Pilih Jenis Model --';
            jenisSelect.appendChild(opsiAwal);

            daftarJenis.forEach(function (namaJenis) {
                const opsi = document.createElement('option');
                opsi.value = namaJenis;
                opsi.textContent = namaJenis;
                opsi.selected = namaJenis === nilaiTerpilih;
                jenisSelect.appendChild(opsi);
            });

            jenisSelect.disabled = daftarJenis.length === 0;

            if (nilaiTerpilih && daftarJenis.includes(nilaiTerpilih)) {
                jenisSelect.value = nilaiTerpilih;
            } else {
                jenisSelect.value = '';
            }
        }

        kategoriSelect.addEventListener('change', function () {
            perbaruiJenisModel('');
        });

        perbaruiJenisModel(jenisAwal);
    });
});
</script>
@endsection
