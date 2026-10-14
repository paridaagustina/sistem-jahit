<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ukuran Saya - Jaitin</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
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
            padding: 25px 18px;
            background: #b8898d;
            color: white;
            display: flex;
            flex-direction: column;
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
            justify-content: center;
            align-items: center;
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
        }

        .menu a:hover,
        .menu a.active {
            background: #9f7378;
        }

        .logout {
            margin-top: auto;
            padding-top: 30px;
        }

        .logout button {
            width: 100%;
            border: none;
            border-radius: 10px;
            padding: 12px;
            color: white;
            background: #8f666b;
            cursor: pointer;
        }

        .main {
            flex: 1;
            min-width: 0;
            padding: 32px;
        }

        .topbar {
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

        .card {
            padding: 25px;
            margin-bottom: 25px;
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            box-shadow: 0 4px 12px #785a5010;
        }

        .card h2 {
            margin-bottom: 8px;
            font-size: 20px;
        }

        .description {
            margin-bottom: 22px;
            color: #806e69;
            font-size: 14px;
            line-height: 1.6;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 17px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        .field input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddc7be;
            border-radius: 9px;
            background: white;
            color: #4b3832;
        }

        .field input:focus {
            outline: 2px solid #c99da0;
            border-color: #b8898d;
        }

        .hint {
            display: block;
            margin-top: 6px;
            font-size: 12px;
            color: #927477;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 22px;
        }

        .btn {
            display: inline-block;
            padding: 11px 16px;
            border: none;
            border-radius: 9px;
            text-decoration: none;
            text-align: center;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-primary {
            background: #b8898d;
            color: white;
        }

        .btn-primary:hover {
            background: #9f7378;
        }

        .btn-secondary {
            background: #eee0d8;
            color: #654b4c;
        }

        .btn-danger {
            background: #f5e2df;
            color: #914d51;
        }

        .alert {
            padding: 13px 16px;
            margin-bottom: 20px;
            border-radius: 9px;
            line-height: 1.6;
        }

        .alert-success {
            background: #e8f3e8;
            color: #4c7250;
        }

        .alert-error {
            background: #f8dddd;
            color: #8f4f55;
        }

        .size-list {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .size-card {
            padding: 20px;
            border: 1px solid #ead6ca;
            border-radius: 12px;
            background: white;
        }

        .size-card h3 {
            margin-bottom: 6px;
            font-size: 17px;
        }

        .size-date {
            margin-bottom: 16px;
            color: #927477;
            font-size: 13px;
        }

        .measurements {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 15px 10px;
        }

        .measurement-label {
            display: block;
            margin-bottom: 5px;
            color: #806e69;
            font-size: 12px;
        }

        .measurement-value {
            font-size: 15px;
            font-weight: bold;
        }

        .empty {
            padding: 28px 15px;
            text-align: center;
            color: #927477;
            line-height: 1.8;
            background: white;
            border: 1px dashed #ddc7be;
            border-radius: 12px;
        }

        @media (max-width: 900px) {
            .layout {
                display: block;
            }

            .sidebar {
                width: 100%;
                min-height: auto;
            }

            .logout {
                margin-top: 20px;
            }

            .main {
                padding: 22px;
            }

            .size-list {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 520px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .main {
                padding: 16px;
            }

            .card {
                padding: 18px;
            }

            .topbar h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
<div class="layout">

    <aside class="sidebar">
        <div class="logo-area">
            <div class="logo-circle">
                <img src="{{ asset('images/logo-jaitin.png') }}"
                     alt="Logo Jaitin">
            </div>
            <div class="brand">Jaitin</div>
        </div>

        <ul class="menu">
            <li>
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('pelanggan.pesanan.create') }}">
                    Pesan Jasa Jahit
                </a>
            </li>
            <li>
                <a href="{{ route('pelanggan.pesanan.index') }}">
                    Pesanan Saya
                </a>
            </li>
            <li>
                <a href="{{ route('pelanggan.ukuran.index') }}"
                   class="active">
                    Ukuran Saya
                </a>
            </li>
            <li>
                <a href="{{ url('/pembayaran') }}">Pembayaran</a>
            </li>
            <li>
                <a href="{{ url('/riwayat-revisi') }}">Riwayat Revisi</a>
            </li>
            <li>
                <a href="{{ url('/pengambilan') }}">Pengambilan</a>
            </li>
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
            <h1>Ukuran Saya</h1>
            <p>
                Simpan ukuran tubuh yang kamu ukur sendiri di rumah
                atau yang sudah kamu miliki dari catatan sebelumnya.
                Ukuran menggunakan satuan sentimeter (cm).
            </p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <strong>Periksa kembali data berikut:</strong>
                <ul style="margin: 8px 0 0 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="card">
            <h2 id="form-title">Tambah Ukuran</h2>
            <p class="description">
                Isi ukuran yang sudah kamu ketahui. Tidak harus mengisi
                semuanya, tetapi minimal satu ukuran perlu diisi.
            </p>

            <form id="form-ukuran"
                  action="{{ route('pelanggan.ukuran.store') }}"
                  method="POST">
                @csrf

                <div class="form-grid">
                    <div class="field">
                        <label for="panjang_baju">Panjang Baju (cm)</label>
                        <input type="number" step="0.01" min="0.01"
                               max="500" id="panjang_baju"
                               name="panjang_baju"
                               value="{{ old('panjang_baju') }}"
                               placeholder="Contoh: 60">
                    </div>

                    <div class="field">
                        <label for="lebar_bahu">Lebar Bahu (cm)</label>
                        <input type="number" step="0.01" min="0.01"
                               max="200" id="lebar_bahu"
                               name="lebar_bahu"
                               value="{{ old('lebar_bahu') }}"
                               placeholder="Contoh: 38">
                    </div>

                    <div class="field">
                        <label for="lingkar_dada">Lingkar Dada (cm)</label>
                        <input type="number" step="0.01" min="0.01"
                               max="300" id="lingkar_dada"
                               name="lingkar_dada"
                               value="{{ old('lingkar_dada') }}"
                               placeholder="Contoh: 88">
                    </div>

                    <div class="field">
                        <label for="lingkar_pinggang">
                            Lingkar Pinggang (cm)
                        </label>
                        <input type="number" step="0.01" min="0.01"
                               max="300" id="lingkar_pinggang"
                               name="lingkar_pinggang"
                               value="{{ old('lingkar_pinggang') }}"
                               placeholder="Contoh: 72">
                    </div>

                    <div class="field">
                        <label for="lingkar_lengan">
                            Lingkar Lengan (cm)
                        </label>
                        <input type="number" step="0.01" min="0.01"
                               max="200" id="lingkar_lengan"
                               name="lingkar_lengan"
                               value="{{ old('lingkar_lengan') }}"
                               placeholder="Contoh: 28">
                    </div>

                    <div class="field">
                        <label for="tanggal">Tanggal Pengukuran</label>
                        <input type="date" id="tanggal" name="tanggal"
                               value="{{ old('tanggal', date('Y-m-d')) }}"
                               required>
                    </div>
                </div>

                <div class="actions">
                    <button class="btn btn-primary" type="submit"
                            id="submit-button">
                        Simpan Ukuran
                    </button>

                    <button class="btn btn-secondary" type="button"
                            id="cancel-edit" hidden
                            onclick="resetForm()">
                        Batal Edit
                    </button>
                </div>
            </form>
        </section>

        <section class="card">
            <h2>Ukuran Tersimpan</h2>
            <p class="description">
                Berikut ukuran yang sudah kamu simpan di akun Jaitin.
            </p>

            @if ($ukuran->isEmpty())
                <div class="empty">
                    <strong>Belum ada ukuran tersimpan.</strong>
                    <br>
                    Tambahkan ukuran tubuhmu melalui formulir di atas.
                </div>
            @else
                <div class="size-list">
                    @foreach ($ukuran as $item)
                        <article class="size-card">
                            <h3>Data Ukuran #{{ $loop->iteration }}</h3>

                            <div class="size-date">
                                Tanggal:
                                {{ $item->tanggal
                                    ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y')
                                    : '-' }}
                            </div>

                            <div class="measurements">
                                <div>
                                    <span class="measurement-label">
                                        Panjang Baju
                                    </span>
                                    <span class="measurement-value">
                                        {{ $item->panjang_baju !== null
                                            ? number_format((float) $item->panjang_baju, 2, ',', '.').' cm'
                                            : '-' }}
                                    </span>
                                </div>

                                <div>
                                    <span class="measurement-label">
                                        Lebar Bahu
                                    </span>
                                    <span class="measurement-value">
                                        {{ $item->lebar_bahu !== null
                                            ? number_format((float) $item->lebar_bahu, 2, ',', '.').' cm'
                                            : '-' }}
                                    </span>
                                </div>

                                <div>
                                    <span class="measurement-label">
                                        Lingkar Dada
                                    </span>
                                    <span class="measurement-value">
                                        {{ $item->lingkar_dada !== null
                                            ? number_format((float) $item->lingkar_dada, 2, ',', '.').' cm'
                                            : '-' }}
                                    </span>
                                </div>

                                <div>
                                    <span class="measurement-label">
                                        Lingkar Pinggang
                                    </span>
                                    <span class="measurement-value">
                                        {{ $item->lingkar_pinggang !== null
                                            ? number_format((float) $item->lingkar_pinggang, 2, ',', '.').' cm'
                                            : '-' }}
                                    </span>
                                </div>

                                <div>
                                    <span class="measurement-label">
                                        Lingkar Lengan
                                    </span>
                                    <span class="measurement-value">
                                        {{ $item->lingkar_lengan !== null
                                            ? number_format((float) $item->lingkar_lengan, 2, ',', '.').' cm'
                                            : '-' }}
                                    </span>
                                </div>
                            </div>

                            <div class="actions">
                                <button type="button"
                                        class="btn btn-secondary"
                                        onclick="editUkuran({{ Illuminate\Support\Js::from([
                                            'id' => $item->id_ukuran,
                                            'panjang_baju' => $item->panjang_baju,
                                            'lebar_bahu' => $item->lebar_bahu,
                                            'lingkar_dada' => $item->lingkar_dada,
                                            'lingkar_pinggang' => $item->lingkar_pinggang,
                                            'lingkar_lengan' => $item->lingkar_lengan,
                                            'tanggal' => $item->tanggal
                                                ? \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d')
                                                : '',
                                        ]) }})">
                                    Edit
                                </button>

                                <form action="{{ route('pelanggan.ukuran.destroy', $item->id_ukuran) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus ukuran ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger"
                                            type="submit">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>
    </main>
</div>

<script>
    const formUkuran = document.getElementById('form-ukuran');
    const formTitle = document.getElementById('form-title');
    const submitButton = document.getElementById('submit-button');
    const cancelButton = document.getElementById('cancel-edit');

    function editUkuran(data) {
        formUkuran.action = `/ukuran-saya/${data.id}`;

        let methodInput = formUkuran.querySelector(
            'input[name="_method"]'
        );

        if (!methodInput) {
            methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            formUkuran.appendChild(methodInput);
        }

        methodInput.value = 'PUT';

        ['panjang_baju', 'lebar_bahu', 'lingkar_dada',
         'lingkar_pinggang', 'lingkar_lengan', 'tanggal'
        ].forEach(function(field) {
            document.getElementById(field).value = data[field] ?? '';
        });

        formTitle.textContent = 'Edit Ukuran';
        submitButton.textContent = 'Simpan Perubahan';
        cancelButton.hidden = false;

        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    function resetForm() {
        formUkuran.action = @json(route('pelanggan.ukuran.store'));

        const methodInput = formUkuran.querySelector(
            'input[name="_method"]'
        );

        if (methodInput) {
            methodInput.remove();
        }

        formUkuran.reset();

        document.getElementById('tanggal').value =
            new Date().toISOString().slice(0, 10);

        formTitle.textContent = 'Tambah Ukuran';
        submitButton.textContent = 'Simpan Ukuran';
        cancelButton.hidden = true;
    }
</script>
</body>
</html>