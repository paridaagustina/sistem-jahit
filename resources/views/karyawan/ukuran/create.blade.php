<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Ukuran - Jaitin</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f8f1eb;
            color: #4a3435;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #b8898d;
            color: white;
            padding: 28px 18px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
        }

        .logo {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo img {
            width: 76px;
            height: 76px;
            object-fit: contain;
            border-radius: 50%;
            background: white;
        }

        .logo h2 {
            margin-top: 10px;
        }

        .logo p {
            font-size: 13px;
            margin-top: 4px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .menu a {
            color: white;
            text-decoration: none;
            padding: 13px 15px;
            border-radius: 10px;
        }

        .menu a:hover,
        .menu a.active {
            background: rgba(120, 76, 82, 0.45);
        }

        .logout {
            margin-top: 25px;
        }

        .logout button {
            width: 100%;
            border: none;
            background: transparent;
            color: white;
            text-align: left;
            padding: 13px 15px;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }

        .logout button:hover {
            background: rgba(120, 76, 82, 0.45);
        }

        .content {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 32px 35px;
        }

        .top {
            margin-bottom: 25px;
        }

        .top h1 {
            font-size: 30px;
        }

        .top p {
            color: #806567;
            margin-top: 6px;
        }

        .card {
            background: #fffaf6;
            border: 1px solid #ead3c8;
            border-radius: 16px;
            padding: 28px;
            max-width: 900px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            font-size: 14px;
        }

        input,
        select {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #dbc5bc;
            border-radius: 9px;
            background: white;
            font-size: 14px;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #b8898d;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .error {
            color: #a94442;
            font-size: 13px;
            margin-top: 5px;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            border: none;
            text-decoration: none;
            cursor: pointer;
            padding: 11px 20px;
            border-radius: 9px;
            font-size: 14px;
        }

        .btn-primary {
            background: #b8898d;
            color: white;
        }

        .btn-secondary {
            background: #eadbd4;
            color: #65494b;
        }

        @media (max-width: 700px) {
            .sidebar {
                width: 210px;
            }

            .content {
                margin-left: 210px;
                width: calc(100% - 210px);
                padding: 25px 20px;
            }

            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <aside class="sidebar">

        <div class="logo">

            <img
                src="{{ asset('images/logo-jaitin.png') }}"
                alt="Logo Jaitin"
            >

            <h2>Jaitin</h2>
            <p>Karyawan</p>

        </div>

        <nav class="menu">

            <a href="{{ route('karyawan.dashboard') }}">
                Dashboard
            </a>

            <a
                href="{{ route('karyawan.ukuran.index') }}"
                class="active"
            >
                Ukuran Pelanggan
            </a>

            <a href="#">
                Riwayat Revisi
            </a>

            <a href="#">
                Status Pengerjaan
            </a>

        </nav>

        <div class="logout">

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit">
                    Logout
                </button>

            </form>

        </div>

    </aside>


    <main class="content">

        <div class="top">

            <h1>Tambah Ukuran Pelanggan</h1>

            <p>
                Masukkan data ukuran pelanggan.
            </p>

        </div>


        <div class="card">

            <form
                action="{{ route('karyawan.ukuran.store') }}"
                method="POST"
            >

                @csrf


                <div class="form-group">

                    <label for="id_user">
                        Nama Pelanggan
                    </label>

                    <select
                        name="id_user"
                        id="id_user"
                        required
                    >

                        <option value="">
                            -- Pilih Pelanggan --
                        </option>

                        @foreach($pelanggan as $item)

                            <option
                                value="{{ $item->id_user }}"
                                {{ old('id_user') == $item->id_user ? 'selected' : '' }}
                            >
                                {{ $item->nama }}
                            </option>

                        @endforeach

                    </select>

                    @error('id_user')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="grid">

                    <div class="form-group">

                        <label for="panjang_baju">
                            Panjang Baju (cm)
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="panjang_baju"
                            id="panjang_baju"
                            value="{{ old('panjang_baju') }}"
                        >

                        @error('panjang_baju')
                            <div class="error">{{ $message }}</div>
                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="lebar_bahu">
                            Lebar Bahu (cm)
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="lebar_bahu"
                            id="lebar_bahu"
                            value="{{ old('lebar_bahu') }}"
                        >

                        @error('lebar_bahu')
                            <div class="error">{{ $message }}</div>
                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="lingkar_dada">
                            Lingkar Dada (cm)
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="lingkar_dada"
                            id="lingkar_dada"
                            value="{{ old('lingkar_dada') }}"
                        >

                        @error('lingkar_dada')
                            <div class="error">{{ $message }}</div>
                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="lingkar_pinggang">
                            Lingkar Pinggang (cm)
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="lingkar_pinggang"
                            id="lingkar_pinggang"
                            value="{{ old('lingkar_pinggang') }}"
                        >

                        @error('lingkar_pinggang')
                            <div class="error">{{ $message }}</div>
                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="lingkar_lengan">
                            Lingkar Lengan (cm)
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="lingkar_lengan"
                            id="lingkar_lengan"
                            value="{{ old('lingkar_lengan') }}"
                        >

                        @error('lingkar_lengan')
                            <div class="error">{{ $message }}</div>
                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="tanggal">
                            Tanggal Pengukuran
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            id="tanggal"
                            value="{{ old('tanggal', date('Y-m-d')) }}"
                            required
                        >

                        @error('tanggal')
                            <div class="error">{{ $message }}</div>
                        @enderror

                    </div>

                </div>


                <div class="actions">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Simpan Ukuran
                    </button>

                    <a
                        href="{{ route('karyawan.ukuran.index') }}"
                        class="btn btn-secondary"
                    >
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </main>

</div>

</body>
</html>