<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Pelanggan - Jaitin</title>

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
            background: #b8898d;
            color: white;
            padding: 25px 18px;
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
            padding: 30px 35px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .topbar h1 {
            font-size: 28px;
        }

        .topbar p {
            margin-top: 6px;
            color: #806e69;
        }

        .admin-info {
            background: #fffaf5;
            padding: 10px 18px;
            border-radius: 20px;
            color: #8e6268;
        }

        .form-box {
            max-width: 700px;
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(120, 90, 80, 0.06);
        }

        .form-box h2 {
            margin-bottom: 25px;
            font-size: 21px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: bold;
            color: #5d4843;
        }

        input,
        select {
            padding: 12px 13px;
            border: 1px solid #d9c1b7;
            border-radius: 9px;
            background: white;
            color: #4b3832;
            outline: none;
        }

        input:focus,
        select:focus {
            border-color: #b8898d;
        }

        .button-area {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            padding: 11px 20px;
            border-radius: 9px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-kembali {
            background: #ead6ca;
            color: #5d4843;
        }

        .btn-simpan {
            background: #b8898d;
            color: white;
        }

        .btn-simpan:hover {
            background: #9f7378;
        }

        .error {
            margin-bottom: 20px;
            padding: 12px 15px;
            background: #f5dede;
            color: #8f4f55;
            border-radius: 9px;
        }

        @media (max-width: 800px) {
            .sidebar {
                width: 210px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
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
                <img src="{{ asset('images/logo-jaitin.png') }}"
                     alt="Logo Jaitin">
            </div>

            <div class="brand">
                Jaitin
            </div>

        </div>

        <ul class="menu">

            <li>
                <a href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('admin.pelanggan.index') }}"
                   class="active">
                    Data Pelanggan
                </a>
            </li>

            <li>
                <a href="{{ route('admin.pesanan.index') }}">
                    Data Pesanan
                </a>
            </li>

            <li>
                <a href="#">
                    Data Ukuran
                </a>
            </li>

            <li>
                <a href="#">
                    Referensi Model
                </a>
            </li>

            <li>
                <a href="#">
                    Pembayaran
                </a>
            </li>

            <li>
                <a href="#">
                    Status Pengerjaan
                </a>
            </li>

            <li>
                <a href="#">
                    Revisi
                </a>
            </li>

        </ul>

        <div class="logout">

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit">
                    Logout
                </button>

            </form>

        </div>

    </aside>


    <!-- MAIN -->
    <main class="main">

        <div class="topbar">

            <div>

                <h1>
                    Tambah Pelanggan
                </h1>

                <p>
                    Tambahkan data pelanggan baru ke dalam sistem Jaitin.
                </p>

            </div>

            <div class="admin-info">
                {{ Auth::user()->nama ?? 'Admin' }}
            </div>

        </div>


        <div class="form-box">

            <h2>
                Informasi Pelanggan
            </h2>


            @if ($errors->any())

                <div class="error">

                    <strong>
                        Periksa kembali data berikut:
                    </strong>

                    <ul style="margin-top: 8px; padding-left: 20px;">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                action="{{ route('admin.pelanggan.store') }}"
                method="POST"
            >

                @csrf


                <div class="form-grid">


                    <!-- NAMA -->

                    <div class="form-group full">

                        <label for="nama">
                            Nama Pelanggan
                        </label>

                        <input
                            type="text"
                            name="nama"
                            id="nama"
                            value="{{ old('nama') }}"
                            placeholder="Masukkan nama pelanggan"
                            required
                        >

                    </div>


                    <!-- EMAIL -->

                    <div class="form-group">

                        <label for="email">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            placeholder="contoh@email.com"
                            required
                        >

                    </div>


                    <!-- NO HP -->

                    <div class="form-group">

                        <label for="no_hp">
                            No. HP
                        </label>

                        <input
                            type="text"
                            name="no_hp"
                            id="no_hp"
                            value="{{ old('no_hp') }}"
                            placeholder="08xxxxxxxxxx"
                        >

                    </div>


                    <!-- PASSWORD -->

                    <div class="form-group">

                        <label for="password">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Masukkan password"
                            required
                        >

                    </div>


                    <!-- KONFIRMASI PASSWORD -->

                    <div class="form-group">

                        <label for="password_confirmation">
                            Konfirmasi Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            placeholder="Ulangi password"
                            required
                        >

                    </div>


                </div>


                <div class="button-area">

                    <a
                        href="{{ route('admin.pelanggan.index') }}"
                        class="btn btn-kembali"
                    >
                        Kembali
                    </a>

                    <button
                        type="submit"
                        class="btn btn-simpan"
                    >
                        Simpan Pelanggan
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

</body>
</html>