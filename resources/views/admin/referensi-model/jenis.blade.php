
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $namaJenis }} - Referensi Model Jaitin</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f8f1eb;
            color: #4b3832;
        }

        input, select, textarea, button {
            font: inherit;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            flex-shrink: 0;
            background: #b8898d;
            color: white;
            padding: 25px 18px;
        }

        .logo-area {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo-circle {
            width: 75px;
            height: 75px;
            margin: auto;
            border-radius: 50%;
            background: #fffaf5;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .logo-circle img {
            width: 65px;
            height: 65px;
            object-fit: contain;
        }

        .brand {
            margin-top: 10px;
            font-size: 22px;
            font-weight: bold;
        }

        .menu {
            list-style: none;
        }

        .menu li {
            margin-bottom: 8px;
        }

        .menu a {
            display: block;
            padding: 13px 15px;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            transition: 0.2s;
        }

        .menu a:hover,
        .menu a.active {
            background: #9f7378;
        }

        .logout {
            margin-top: 30px;
        }

        .logout button {
            width: 100%;
            border: none;
            background: #8f666b;
            color: white;
            padding: 12px;
            border-radius: 10px;
            cursor: pointer;
        }

        .main {
            flex: 1;
            min-width: 0;
            padding: 30px 35px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .topbar h1 {
            font-size: 28px;
        }

        .topbar p {
            margin-top: 8px;
            color: #806e69;
            line-height: 1.6;
        }

        .admin-info {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            padding: 10px 18px;
            border-radius: 20px;
            color: #8e6268;
            white-space: nowrap;
        }

        .breadcrumb {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
            margin-bottom: 22px;
            font-size: 14px;
            color: #806e69;
        }

        .breadcrumb a {
            color: #9f7378;
            text-decoration: none;
        }

        .intro {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 24px;
            margin-bottom: 25px;
        }

        .intro h2 {
            font-size: 21px;
            margin-bottom: 10px;
        }

        .intro p {
            color: #806e69;
            line-height: 1.7;
        }

        .gallery-heading {
            margin-bottom: 18px;
        }

        .gallery-heading h2 {
            font-size: 21px;
            margin-bottom: 8px;
        }

        .gallery-heading p {
            color: #806e69;
            font-size: 14px;
            line-height: 1.6;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .model-card {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(120, 90, 80, 0.06);
        }

        .model-image {
            width: 100%;
            height: 280px;
            display: block;
            object-fit: cover;
            background: #f1dfe0;
        }

        .image-placeholder {
            height: 280px;
            background: #f1dfe0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            color: #8e6268;
        }

        .image-placeholder span {
            font-size: 42px;
        }

        .model-content {
            padding: 18px;
        }

        .model-content h3 {
            font-size: 17px;
            margin-bottom: 10px;
            overflow-wrap: anywhere;
        }

        .model-description {
            color: #806e69;
            font-size: 14px;
            line-height: 1.7;
            min-height: 24px;
            margin-bottom: 14px;
            overflow-wrap: anywhere;
        }

        .model-tag {
            display: inline-block;
            background: #f1dfe0;
            color: #9f7378;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 12px;
        }

        .card-actions {
            display: flex;
            gap: 9px;
            margin-top: 18px;
        }

        .btn {
            border: none;
            border-radius: 8px;
            padding: 10px 14px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            font-size: 13px;
            transition: 0.2s;
        }

        .btn-edit {
            flex: 1;
            background: #b8898d;
            color: white;
        }

        .btn-edit:hover {
            background: #9f7378;
        }

        .btn-delete {
            flex: 1;
            background: #fff0ed;
            color: #a44343;
            border: 1px solid #e7c1bb;
        }

        .btn-delete:hover {
            background: #f8deda;
        }

        .edit-panel {
            display: none;
            padding: 18px;
            border-top: 1px solid #ead6ca;
            background: #fffdf9;
        }

        .edit-panel.open {
            display: block;
        }

        .edit-panel h3 {
            margin-bottom: 16px;
            font-size: 17px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px 11px;
            border: 1px solid #dfc9c0;
            border-radius: 8px;
            background: white;
            color: #4b3832;
        }

        .form-control:focus {
            outline: 2px solid #e8c8ca;
            border-color: #b8898d;
        }

        textarea.form-control {
            min-height: 90px;
            resize: vertical;
        }

        .current-photo {
            width: 100%;
            max-height: 180px;
            object-fit: contain;
            background: #f8f1eb;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .help-text {
            color: #806e69;
            font-size: 12px;
            line-height: 1.5;
            margin-top: 6px;
        }

        .form-actions {
            display: flex;
            gap: 8px;
            margin-top: 18px;
        }

        .btn-save {
            flex: 1;
            background: #b8898d;
            color: white;
        }

        .btn-save:hover {
            background: #9f7378;
        }

        .btn-cancel {
            background: #eee3dc;
            color: #66504a;
        }

        .empty-state {
            background: #fffaf5;
            border: 1px dashed #d9b9b5;
            border-radius: 15px;
            padding: 45px 20px;
            text-align: center;
            color: #806e69;
            line-height: 1.8;
        }

        .empty-state .empty-icon {
            font-size: 42px;
            margin-bottom: 12px;
        }

        .back-button {
            display: inline-block;
            margin-top: 25px;
            background: #b8898d;
            color: white;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 9px;
        }

        .back-button:hover {
            background: #9f7378;
        }

        .note {
            margin-top: 25px;
            color: #806e69;
            font-size: 13px;
            line-height: 1.7;
        }

        .alert {
            padding: 14px 17px;
            border-radius: 10px;
            margin-bottom: 18px;
            line-height: 1.6;
        }

        .alert-success {
            background: #e8f4e8;
            border: 1px solid #b9d9b9;
            color: #356635;
        }

        .alert-error {
            background: #fff0ed;
            border: 1px solid #e7c1bb;
            color: #a44343;
        }

        .validation-errors {
            margin: 8px 0 14px;
            padding-left: 20px;
        }

        @media (max-width: 1100px) {
            .gallery-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {
            .layout {
                display: block;
            }

            .sidebar {
                width: 100%;
            }

            .main {
                padding: 20px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .model-image,
            .image-placeholder {
                height: 300px;
            }
        }
    </style>
</head>

<body>
<div class="layout">

    <aside class="sidebar">
        <div class="logo-area">
            <div class="logo-circle">
                <img
                    src="{{ asset('images/logo-jaitin.png') }}"
                    alt="Logo Jaitin"
                    onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=&quot;color:#b8898d;font-size:25px;font-weight:bold&quot;>J</span>';"
                >
            </div>
            <div class="brand">Jaitin</div>
        </div>

        <ul class="menu">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.pelanggan.index') }}">Data Pelanggan</a></li>
            <li><a href="{{ route('admin.pesanan.index') }}">Data Pesanan</a></li>
            <li><a href="{{ route('admin.ukuran.index') }}">Data Ukuran</a></li>
            <li>
                <a href="{{ route('admin.referensi-model.index') }}" class="active">
                    Referensi Model
                </a>
            </li>
            <li><a href="{{ route('admin.pembayaran.index') }}">Pembayaran</a></li>
        </ul>

        <div class="logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </aside>

    <main class="main">

        <div class="topbar">
            <div>
                <h1>{{ $namaJenis }}</h1>
                <p>Galeri referensi model Jaitin.</p>
            </div>

            <div class="admin-info">
                {{ Auth::user()->nama ?? 'Admin' }}
            </div>
        </div>

        <nav class="breadcrumb">
            <a href="{{ route('admin.referensi-model.index') }}">Referensi Model</a>
            <span>›</span>
            <a href="{{ route('admin.referensi-model.kategori', ['kategori' => $kategori]) }}">
                {{ ucfirst($kategori) }}
            </a>
            <span>›</span>
            <span>{{ $namaJenis }}</span>
        </nav>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <strong>Periksa kembali data yang kamu masukkan:</strong>
                <ul class="validation-errors">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="intro">
            <h2>Galeri {{ $namaJenis }}</h2>
            <p>
                Berikut kumpulan foto referensi untuk jenis model
                {{ $namaJenis }}. Kamu dapat mengedit data, mengganti foto,
                atau menghapus referensi yang tidak diperlukan.
            </p>
        </section>

        <section>
            <div class="gallery-heading">
                <h2>Foto Referensi</h2>
                <p>
                    Jumlah referensi:
                    <strong>{{ $referensiModels->count() }} foto</strong>
                </p>
            </div>

            @if ($referensiModels->isNotEmpty())
                <div class="gallery-grid">

                    @foreach ($referensiModels as $model)
                        <article class="model-card">

                            @if ($model->foto)
                                <img
                                    class="model-image"
                                    src="{{ asset('storage/' . $model->foto) }}"
                                    alt="{{ $model->nama_model }}"
                                    loading="lazy"
                                >
                            @else
                                <div class="image-placeholder">
                                    <span>🧵</span>
                                    <p>Foto belum tersedia</p>
                                </div>
                            @endif

                            <div class="model-content">
                                <h3>{{ $model->nama_model }}</h3>

                                <p class="model-description">
                                    {{ $model->deskripsi ?: 'Referensi model jahitan Jaitin.' }}
                                </p>

                                <span class="model-tag">
                                    {{ $namaJenis }}
                                </span>

                                <div class="card-actions">
                                    <button
                                        type="button"
                                        class="btn btn-edit"
                                        onclick="toggleEdit({{ $model->id }})"
                                    >
                                        ✏️ Edit
                                    </button>

                                    <form
                                        action="{{ route('admin.referensi-model.destroy', $model->id) }}"
                                        method="POST"
                                        style="flex: 1;"
                                        onsubmit="return confirm('Yakin ingin menghapus referensi {{ addslashes($model->nama_model) }}? Foto dan data referensi ini akan dihapus.')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-delete"
                                            style="width: 100%;"
                                        >
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div
                                class="edit-panel"
                                id="edit-panel-{{ $model->id }}"
                            >
                                <h3>Edit Referensi Model</h3>

                                <form
                                    action="{{ route('admin.referensi-model.update', $model->id) }}"
                                    method="POST"
                                    enctype="multipart/form-data"
                                >
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="nama-{{ $model->id }}">
                                            Nama Model
                                        </label>
                                        <input
                                            class="form-control"
                                            id="nama-{{ $model->id }}"
                                            type="text"
                                            name="nama_model"
                                            value="{{ $model->nama_model }}"
                                            required
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label for="kategori-{{ $model->id }}">
                                            Kategori
                                        </label>
                                        <select
                                            class="form-control"
                                            id="kategori-{{ $model->id }}"
                                            name="kategori"
                                            required
                                        >
                                            <option value="kebaya"
                                                @selected($model->kategori === 'kebaya')>
                                                Kebaya
                                            </option>
                                            <option value="dress"
                                                @selected($model->kategori === 'dress')>
                                                Dress
                                            </option>
                                            <option value="perbaikan"
                                                @selected($model->kategori === 'perbaikan')>
                                                Perbaikan
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="jenis-{{ $model->id }}">
                                            Jenis Model
                                        </label>
                                        <select
                                            class="form-control"
                                            id="jenis-{{ $model->id }}"
                                            name="jenis_model"
                                            required
                                        >
                                            @php
                                                $pilihanJenis = [
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
                                                        'Memperbaiki Jahitan',
                                                        'Mengganti Resleting',
                                                        'Mengecilkan Ukuran',
                                                        'Memperbesar Ukuran',
                                                    ],
                                                ];
                                            @endphp

                                            @foreach ($pilihanJenis[$model->kategori] ?? [] as $jenisPilihan)
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
                                        <label for="foto-{{ $model->id }}">
                                            Foto Saat Ini
                                        </label>

                                        @if ($model->foto)
                                            <img
                                                class="current-photo"
                                                src="{{ asset('storage/' . $model->foto) }}"
                                                alt="Foto saat ini"
                                            >
                                        @else
                                            <p class="help-text">
                                                Belum ada foto tersimpan.
                                            </p>
                                        @endif

                                        <label for="foto-{{ $model->id }}">
                                            Pilih Foto Pengganti (opsional)
                                        </label>
                                        <input
                                            class="form-control"
                                            id="foto-{{ $model->id }}"
                                            type="file"
                                            name="foto"
                                            accept="image/jpeg,image/png,image/jpg,image/webp"
                                        >
                                        <p class="help-text">
                                            Kosongkan jika tidak ingin mengganti foto.
                                            Format JPG, PNG, atau WEBP.
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        <label for="deskripsi-{{ $model->id }}">
                                            Deskripsi
                                        </label>
                                        <textarea
                                            class="form-control"
                                            id="deskripsi-{{ $model->id }}"
                                            name="deskripsi"
                                        >{{ $model->deskripsi }}</textarea>
                                    </div>

                                    <div class="form-actions">
                                        <button
                                            type="submit"
                                            class="btn btn-save"
                                        >
                                            💾 Simpan Perubahan
                                        </button>

                                        <button
                                            type="button"
                                            class="btn btn-cancel"
                                            onclick="toggleEdit({{ $model->id }})"
                                        >
                                            Batal
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </article>
                    @endforeach

                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">🪡</div>

                    <h3>Belum Ada Foto Referensi</h3>

                    <p>
                        Belum ada foto untuk jenis {{ $namaJenis }}.
                        Tambahkan referensi melalui halaman pengelolaan
                        katalog agar foto tampil di sini.
                    </p>

                    <a
                        class="back-button"
                        href="{{ route('admin.referensi-model.index') }}"
                    >
                        Kembali ke Pengelolaan Referensi
                    </a>
                </div>
            @endif
        </section>

        <a
            class="back-button"
            href="{{ route('admin.referensi-model.kategori', ['kategori' => $kategori]) }}"
        >
            ← Kembali ke Pilihan Jenis Model
        </a>

        <p class="note">
            Foto yang ditampilkan berasal dari database berdasarkan kategori
            dan jenis model yang dipilih.
        </p>

    </main>
</div>

<script>
    function toggleEdit(id) {
        const panel = document.getElementById('edit-panel-' + id);

        if (!panel) {
            return;
        }

        panel.classList.toggle('open');

        if (panel.classList.contains('open')) {
            panel.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });
        }
    }

    document.querySelectorAll('[id^="kategori-"]').forEach(function (kategoriSelect) {
        kategoriSelect.addEventListener('change', function () {
            const id = this.id.replace('kategori-', '');
            const jenisSelect = document.getElementById('jenis-' + id);

            const pilihanJenis = {
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
                    'Memperbaiki Jahitan',
                    'Mengganti Resleting',
                    'Mengecilkan Ukuran',
                    'Memperbesar Ukuran'
                ]
            };

            const daftar = pilihanJenis[this.value] || [];

            jenisSelect.innerHTML = '';

            daftar.forEach(function (namaJenis) {
                const option = document.createElement('option');
                option.value = namaJenis;
                option.textContent = namaJenis;
                jenisSelect.appendChild(option);
            });
        });
    });
</script>

</body>
</html>
