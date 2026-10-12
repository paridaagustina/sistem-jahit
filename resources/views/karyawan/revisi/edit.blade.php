<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Revisi - Jaitin</title>

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

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: #b8898d;
            color: white;
            padding: 25px 18px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
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

        .role {
            margin-top: 5px;
            font-size: 13px;
            opacity: 0.85;
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

        /* LOGOUT */
        .logout {
            margin-top: auto;
            padding-top: 30px;
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
            background: #7e595e;
        }

        /* MAIN */
        .main {
            flex: 1;
            padding: 30px 35px;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .topbar h1 {
            font-size: 28px;
            color: #4b3832;
        }

        .topbar p {
            margin-top: 7px;
            color: #806e69;
        }

        .user-info {
            background: #fffaf5;
            padding: 11px 18px;
            border-radius: 20px;
            color: #8e6268;
            border: 1px solid #ead6ca;
        }

        /* FORM CARD */
        .form-card {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 28px;
            max-width: 900px;
        }

        .form-card h2 {
            font-size: 20px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 11px 13px;
            border: 1px solid #dbc5bc;
            border-radius: 9px;
            background: white;
            color: #4b3832;
            font-size: 14px;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #b8898d;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .error {
            color: #a94442;
            font-size: 13px;
            margin-top: 6px;
        }

        /* INFO PESANAN */
        .order-info {
            background: #f8f1eb;
            border: 1px solid #ead6ca;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 22px;
        }

        .order-info p {
            margin-bottom: 6px;
            font-size: 14px;
        }

        .order-info p:last-child {
            margin-bottom: 0;
        }

        .order-info strong {
            color: #79555a;
        }

        /* BUTTON */
        .actions {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            padding: 11px 20px;
            border-radius: 9px;
            border: none;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
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

        @media (max-width: 800px) {

            .layout {
                display: block;
            }

            .sidebar {
                width: 100%;
                min-height: auto;
            }

            .main {
                padding: 20px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div class="logo-area">

            <div class="logo-circle">

                <img
                    src="{{ asset('images/logo-jaitin.png') }}"
                    alt="Logo Jaitin"
                >

            </div>

            <div class="brand">
                Jaitin
            </div>

            <div class="role">
                Karyawan
            </div>

        </div>


        <ul class="menu">

            <li>
                <a href="{{ route('karyawan.dashboard') }}">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('karyawan.ukuran.index') }}">
                    Ukuran Pelanggan
                </a>
            </li>

            <li>
                <a
                    href="{{ route('karyawan.revisi.index') }}"
                    class="active"
                >
                    Riwayat Revisi
                </a>
            </li>

            <li>
                <a
    href="{{ route('karyawan.pengerjaan.index') }}"
    class="{{ request()->routeIs('karyawan.pengerjaan.*') ? 'active' : '' }}"
>
    Status Pengerjaan
</a>
            </li>

        </ul>


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


    <!-- MAIN -->

    <main class="main">

        <!-- TOPBAR -->

        <div class="topbar">

            <div>

                <h1>
                    Edit Revisi
                </h1>

                <p>
                    Perbarui data revisi pesanan pelanggan.
                </p>

            </div>

            <div class="user-info">
                {{ Auth::user()->nama ?? 'Karyawan' }}
            </div>

        </div>


        <!-- FORM -->

        <div class="form-card">

            <h2>
                Data Revisi
            </h2>


            <!-- INFORMASI PESANAN -->

            <div class="order-info">

                <p>
                    <strong>Pelanggan:</strong>
                    {{ $revisi->pesanan->user->nama ?? '-' }}
                </p>

                <p>
                    <strong>Jenis Pakaian:</strong>
                    {{ $revisi->pesanan->jenis_pakaian ?? '-' }}
                </p>

                <p>
                    <strong>Nomor Pesanan:</strong>
                    #{{ $revisi->id_pesanan }}
                </p>

            </div>


            <form
                action="{{ route('karyawan.revisi.update', $revisi->id_revisi) }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                <!-- PESANAN -->

                <div class="form-group">

                    <label for="id_pesanan">
                        Pesanan
                    </label>

                    <select
                        name="id_pesanan"
                        id="id_pesanan"
                        required
                    >

                        @foreach($pesanan as $item)

                            <option
                                value="{{ $item->id_pesanan }}"
                                {{ old('id_pesanan', $revisi->id_pesanan) == $item->id_pesanan ? 'selected' : '' }}
                            >
                                #{{ $item->id_pesanan }}
                                -
                                {{ $item->user->nama ?? 'Pelanggan' }}
                                -
                                {{ $item->jenis_pakaian ?? 'Pesanan' }}
                            </option>

                        @endforeach

                    </select>

                    @error('id_pesanan')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- KETERANGAN -->

                <div class="form-group">

                    <label for="keterangan">
                        Keterangan Revisi
                    </label>

                    <textarea
                        name="keterangan"
                        id="keterangan"
                        required
                    >{{ old('keterangan', $revisi->keterangan) }}</textarea>

                    @error('keterangan')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- TANGGAL DAN BATAS -->

                <div class="grid">

                    <div class="form-group">

                        <label for="tanggal_revisi">
                            Tanggal Revisi
                        </label>

                        <input
                            type="datetime-local"
                            name="tanggal_revisi"
                            id="tanggal_revisi"
                            value="{{ old('tanggal_revisi', $revisi->tanggal_revisi ? \Carbon\Carbon::parse($revisi->tanggal_revisi)->format('Y-m-d\TH:i') : '') }}"
                            required
                        >

                        @error('tanggal_revisi')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="batas_waktu_revisi">
                            Batas Waktu Revisi
                        </label>

                        <input
                            type="date"
                            name="batas_waktu_revisi"
                            id="batas_waktu_revisi"
                            value="{{ old('batas_waktu_revisi', $revisi->batas_waktu_revisi ? \Carbon\Carbon::parse($revisi->batas_waktu_revisi)->format('Y-m-d') : '') }}"
                            required
                        >

                        @error('batas_waktu_revisi')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                <!-- BIAYA REVISI -->

                <div class="form-group">

                    <label for="biaya_revisi">
                        Biaya Tambahan Revisi (Rp)
                    </label>

                    <input
                        type="number"
                        name="biaya_revisi"
                        id="biaya_revisi"
                        min="0"
                        step="0.01"
                        value="{{ old('biaya_revisi', $revisi->biaya_revisi ?? 0) }}"
                        placeholder="0"
                    >

                    @error('biaya_revisi')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- BUTTON -->

                <div class="actions">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Simpan Perubahan
                    </button>

                    <a
                        href="{{ route('karyawan.revisi.index') }}"
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