<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Ukuran - Jaitin</title>

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

        /* =========================
           SIDEBAR
        ========================= */

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
            font-size: 23px;
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
            display: block;
            font-size: 15px;
        }

        .menu a:hover,
        .menu a.active {
            background: #9f7378;
        }

        /* =========================
           LOGOUT
        ========================= */

        .logout {
            margin-top: 25px;
        }

        .logout button {
            width: 100%;
            border: none;
            background: #8f666b;
            color: white;
            text-align: left;
            padding: 13px 15px;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }

        .logout button:hover {
            background: #7e595e;
        }

        /* =========================
           CONTENT
        ========================= */

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
            color: #4b3832;
        }

        .top p {
            color: #806e69;
            margin-top: 7px;
        }

        /* =========================
           FORM CARD
        ========================= */

        .card {
            background: #fffaf6;
            border: 1px solid #ead3c8;
            border-radius: 16px;
            padding: 28px;
            max-width: 900px;
            box-shadow: 0 5px 15px rgba(120, 80, 80, 0.06);
        }

        .card-title {
            font-size: 21px;
            margin-bottom: 25px;
            color: #4b3832;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            font-size: 14px;
            color: #5d4843;
        }

        input,
        select {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #dbc5bc;
            border-radius: 9px;
            background: white;
            color: #4a3435;
            font-size: 14px;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #b8898d;
            box-shadow: 0 0 0 2px rgba(184, 137, 141, 0.12);
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

        /* =========================
           BUTTON
        ========================= */

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
            display: inline-block;
        }

        .btn-primary {
            background: #b8898d;
            color: white;
        }

        .btn-primary:hover {
            background: #9f7378;
        }

        .btn-secondary {
            background: #eadbd4;
            color: #65494b;
        }

        .btn-secondary:hover {
            background: #dfc9c0;
        }

        /* =========================
           RESPONSIVE
        ========================= */

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

    <!-- =========================
         SIDEBAR
    ========================= -->

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

            <!-- DASHBOARD -->

            <a
                href="{{ route('karyawan.dashboard') }}"
                class="{{ request()->routeIs('karyawan.dashboard') ? 'active' : '' }}"
            >
                Dashboard
            </a>


            <!-- UKURAN PELANGGAN -->

            <a
                href="{{ route('karyawan.ukuran.index') }}"
                class="{{ request()->routeIs('karyawan.ukuran.*') ? 'active' : '' }}"
            >
                Ukuran Pelanggan
            </a>


            <!-- RIWAYAT REVISI -->

            <a href="#">
                Riwayat Revisi
            </a>


            <!-- STATUS PENGERJAAN -->

            <a href="#">
                Status Pengerjaan
            </a>

        </nav>


        <!-- LOGOUT -->

        <div class="logout">

            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button type="submit">
                    Logout
                </button>

            </form>

        </div>

    </aside>


    <!-- =========================
         MAIN CONTENT
    ========================= -->

    <main class="content">

        <!-- HEADER -->

        <div class="top">

            <h1>
                Edit Ukuran Pelanggan
            </h1>

            <p>
                Perbarui data ukuran pelanggan sesuai hasil pengukuran terbaru.
            </p>

        </div>


        <!-- FORM CARD -->

        <div class="card">

            <div class="card-title">
                Data Ukuran Pelanggan
            </div>


            <form
                action="{{ route('karyawan.ukuran.update', $ukuran->id_ukuran) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                <!-- NAMA PELANGGAN -->

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
                                {{ old('id_user', $ukuran->id_user) == $item->id_user ? 'selected' : '' }}
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


                <!-- UKURAN -->

                <div class="grid">


                    <!-- PANJANG BAJU -->

                    <div class="form-group">

                        <label for="panjang_baju">
                            Panjang Baju (cm)
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="panjang_baju"
                            id="panjang_baju"
                            value="{{ old('panjang_baju', $ukuran->panjang_baju) }}"
                        >

                        @error('panjang_baju')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- LEBAR BAHU -->

                    <div class="form-group">

                        <label for="lebar_bahu">
                            Lebar Bahu (cm)
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="lebar_bahu"
                            id="lebar_bahu"
                            value="{{ old('lebar_bahu', $ukuran->lebar_bahu) }}"
                        >

                        @error('lebar_bahu')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- LINGKAR DADA -->

                    <div class="form-group">

                        <label for="lingkar_dada">
                            Lingkar Dada (cm)
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="lingkar_dada"
                            id="lingkar_dada"
                            value="{{ old('lingkar_dada', $ukuran->lingkar_dada) }}"
                        >

                        @error('lingkar_dada')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- LINGKAR PINGGANG -->

                    <div class="form-group">

                        <label for="lingkar_pinggang">
                            Lingkar Pinggang (cm)
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="lingkar_pinggang"
                            id="lingkar_pinggang"
                            value="{{ old('lingkar_pinggang', $ukuran->lingkar_pinggang) }}"
                        >

                        @error('lingkar_pinggang')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- LINGKAR LENGAN -->

                    <div class="form-group">

                        <label for="lingkar_lengan">
                            Lingkar Lengan (cm)
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="lingkar_lengan"
                            id="lingkar_lengan"
                            value="{{ old('lingkar_lengan', $ukuran->lingkar_lengan) }}"
                        >

                        @error('lingkar_lengan')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- TANGGAL -->

                    <div class="form-group">

                        <label for="tanggal">
                            Tanggal Pengukuran
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            id="tanggal"
                            value="{{ old('tanggal', $ukuran->tanggal?->format('Y-m-d')) }}"
                            required
                        >

                        @error('tanggal')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                <!-- BUTTON -->

                <div class="actions">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Update Ukuran
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