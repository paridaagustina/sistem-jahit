<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Referensi Model - Jaitin</title>

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
            font-size: 14px;
        }

        .logout button:hover {
            background: #79545a;
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
            margin-bottom: 30px;
        }

        .topbar h1 {
            font-size: 28px;
        }

        .topbar p {
            margin-top: 8px;
            color: #806e69;
        }

        .admin-info {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            padding: 10px 18px;
            border-radius: 20px;
            color: #8e6268;
            white-space: nowrap;
        }

        .intro,
        .upload-card {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 24px;
            margin-bottom: 25px;
        }

        .intro h2,
        .upload-card h2 {
            font-size: 20px;
            margin-bottom: 12px;
        }

        .intro p {
            color: #806e69;
            line-height: 1.7;
        }

        .upload-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .upload-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 0;
        }

        .upload-group label {
            font-size: 14px;
            font-weight: bold;
        }

        .upload-group input,
        .upload-group select,
        .upload-group textarea {
            width: 100%;
            padding: 11px;
            border: 1px solid #e3cfc5;
            border-radius: 8px;
            background: white;
            color: #4b3832;
        }

        .upload-group textarea {
            min-height: 90px;
            resize: vertical;
        }

        .upload-button,
        .category-button {
            display: inline-block;
            border: none;
            border-radius: 9px;
            background: #b8898d;
            color: white;
            padding: 12px 18px;
            text-decoration: none;
            text-align: center;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }

        .upload-button {
            margin-top: 18px;
        }

        .upload-button:hover,
        .category-button:hover {
            background: #9f7378;
        }

        .form-message {
            margin-bottom: 15px;
            padding: 12px;
            border-radius: 8px;
            background: #f1dfe0;
            color: #704b50;
            line-height: 1.7;
        }

        .form-error {
            color: #b42318;
            font-size: 13px;
            margin-left: 20px;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .category-card {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(120, 90, 80, 0.06);
            display: flex;
            flex-direction: column;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .category-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 18px rgba(120, 90, 80, 0.1);
        }

        .category-icon {
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f1dfe0;
            border-radius: 15px;
            font-size: 30px;
            margin-bottom: 20px;
        }

        .category-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .category-card p {
            color: #806e69;
            font-size: 14px;
            line-height: 1.7;
            flex: 1;
            margin-bottom: 22px;
        }

        .note {
            margin-top: 25px;
            color: #806e69;
            font-size: 13px;
            line-height: 1.7;
        }

        @media (max-width: 1100px) {
            .category-grid {
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

            .category-grid,
            .upload-grid {
                grid-template-columns: 1fr;
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
                <h1>Referensi Model</h1>
                <p>Kelola katalog model dan layanan jahit Jaitin.</p>
            </div>

            <div class="admin-info">
                {{ Auth::user()->nama ?? 'Admin' }}
            </div>
        </div>

        <section class="intro">
            <h2>Katalog Jaitin</h2>
            <p>
                Tambahkan foto referensi, pilih kategori dan jenis model.
                Setiap jenis model dapat memiliki banyak foto referensi.
            </p>
        </section>

        <section class="upload-card">
            <h2>Tambah Referensi Model</h2>

            @if (session('success'))
                <div class="form-message">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="form-message">
                    <strong>Data belum berhasil disimpan:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="form-error">{{ $error }}</li>
                        @endforeach
                    </ul>
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
                        <label for="nama_model">Nama Referensi Foto</label>
                        <input
                            type="text"
                            id="nama_model"
                            name="nama_model"
                            value="{{ old('nama_model') }}"
                            placeholder="Contoh: Kebaya Modern Model 1"
                            required
                        >
                    </div>

                    <div class="upload-group">
                        <label for="kategori">Kategori Utama</label>
                        <select id="kategori" name="kategori" required>
                            <option value="">Pilih kategori</option>

                            <option value="kebaya"
                                {{ old('kategori') === 'kebaya' ? 'selected' : '' }}>
                                Kebaya
                            </option>

                            <option value="dress"
                                {{ old('kategori') === 'dress' ? 'selected' : '' }}>
                                Dress
                            </option>

                            <option value="perbaikan"
                                {{ old('kategori') === 'perbaikan' ? 'selected' : '' }}>
                                Perbaikan Pakaian
                            </option>
                        </select>
                    </div>

                    <div class="upload-group">
                        <label for="jenis_model">Jenis Model / Layanan</label>
                        <select id="jenis_model" name="jenis_model" required>
                            <option value="">Pilih jenis model</option>
                        </select>
                    </div>

                    <div class="upload-group">
                        <label for="foto">Foto Referensi</label>
                        <input
                            type="file"
                            id="foto"
                            name="foto"
                            accept=".jpg,.jpeg,.png,.webp"
                            required
                        >
                        <small>JPG, PNG, atau WEBP. Maksimal 2 MB.</small>
                    </div>

                    <div class="upload-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            placeholder="Tuliskan deskripsi model..."
                        >{{ old('deskripsi') }}</textarea>
                    </div>

                </div>

                <input type="hidden" name="aktif" value="1">

                <button type="submit" class="upload-button">
                    + Simpan Referensi Model
                </button>
            </form>
        </section>

        <section class="category-grid">

            <article class="category-card">
                <div class="category-icon">🪡</div>
                <h3>Kebaya</h3>
                <p>
                    Jelajahi Kebaya Klasik, Kebaya Modern, Kebaya Minimalis,
                    dan kumpulan foto referensi di dalam setiap jenis.
                </p>
                <a class="category-button"
                   href="{{ route('admin.referensi-model.kategori', ['kategori' => 'kebaya']) }}">
                    Kelola Kebaya
                </a>
            </article>

            <article class="category-card">
                <div class="category-icon">👗</div>
                <h3>Dress</h3>
                <p>
                    Jelajahi referensi dress pesta, formal, dan casual
                    beserta foto modelnya.
                </p>
                <a class="category-button"
                   href="{{ route('admin.referensi-model.kategori', ['kategori' => 'dress']) }}">
                    Kelola Dress
                </a>
            </article>

            <article class="category-card">
                <div class="category-icon">🧵</div>
                <h3>Perbaikan Pakaian</h3>
                <p>
                    Jelajahi dua kelompok layanan, yaitu perbaikan kerusakan
                    dan robekan (mending), serta penyesuaian ukuran dan model
                    (alteration atau vermak).
                </p>
                <a class="category-button"
                   href="{{ route('admin.referensi-model.kategori', ['kategori' => 'perbaikan']) }}">
                    Kelola Layanan
                </a>
            </article>

        </section>

        <p class="note">
            Kamu dapat mengunggah banyak foto dengan kategori dan jenis model
            yang sama. Foto-foto tersebut akan dikelompokkan dalam galeri jenis
            model yang sesuai.
        </p>

    </main>
</div>

<script>
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
            {
                value: 'Perbaikan Kerusakan & Robekan (Mending)',
                label: 'Perbaikan Kerusakan & Robekan (Mending)'
            },
            {
                value: 'Penyesuaian Ukuran & Model (Alteration / Vermak)',
                label: 'Penyesuaian Ukuran & Model (Alteration / Vermak)'
            }
        ]
    };

    const kategoriSelect = document.getElementById('kategori');
    const jenisSelect = document.getElementById('jenis_model');

    const jenisLama = @json(old('jenis_model'));

    function perbaruiJenisModel() {
        const kategori = kategoriSelect.value;
        const daftarJenis = jenisPerKategori[kategori] || [];

        jenisSelect.innerHTML = '';

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

            if (jenis.value === jenisLama) {
                option.selected = true;
            }

            jenisSelect.appendChild(option);
        });
    }

    kategoriSelect.addEventListener('change', perbaruiJenisModel);

    perbaruiJenisModel();
</script>

</body>
</html>