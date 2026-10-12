<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Karyawan - Jaitin</title>

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

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 250px;
            background: #b8898d;
            color: white;
            padding: 25px 18px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: relative;
            z-index: 1000;
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

        /* =========================
           MENU SIDEBAR
        ========================= */

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
        }

        .menu li {
            list-style: none;
            margin-bottom: 8px;
            width: 100%;
        }

        .menu li a {
            display: block;
            width: 100%;
            padding: 13px 15px;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            transition: background 0.2s ease;
            cursor: pointer;
            position: relative;
            z-index: 1001;
        }

        .menu li a:hover {
            background: #9f7378;
        }

        .menu li a.active {
            background: #9f7378;
        }

        /* =========================
           LOGOUT
        ========================= */

        .logout {
            margin-top: auto;
            padding-top: 30px;
            width: 100%;
        }

        .logout form {
            width: 100%;
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

        /* =========================
           MAIN
        ========================= */

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

        /* =========================
           WELCOME
        ========================= */

        .welcome {
            background: #ead6ca;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            border: 1px solid #e1c6b8;
        }

        .welcome h2 {
            font-size: 22px;
            margin-bottom: 8px;
        }

        .welcome p {
            color: #705b55;
            line-height: 1.6;
        }

        /* =========================
           CARDS
        ========================= */

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .card {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 4px 12px rgba(120, 90, 80, 0.06);
        }

        .card-number {
            font-size: 28px;
            font-weight: bold;
            color: #a46f76;
            margin-bottom: 8px;
        }

        .card h3 {
            font-size: 15px;
            margin-bottom: 8px;
        }

        .card p {
            color: #806e69;
            font-size: 13px;
            line-height: 1.5;
        }

        /* =========================
           SECTION
        ========================= */

        .section {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .section h2 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        /* =========================
           QUICK MENU
        ========================= */

        .quick-menu {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .quick-menu a {
            display: block;
            text-decoration: none;
            color: #4b3832;
            background: #f8f1eb;
            border: 1px solid #ead6ca;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: 0.2s;
            cursor: pointer;
        }

        .quick-menu a:hover {
            background: #ead6ca;
            transform: translateY(-2px);
        }

        .icon {
            font-size: 27px;
            margin-bottom: 10px;
        }

        .quick-menu span {
            display: block;
            font-size: 14px;
            font-weight: bold;
        }

        /* =========================
           TABLE
        ========================= */

        .table-box {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 25px;
            overflow-x: auto;
        }

        .table-box h2 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        th {
            background: #ead6ca;
            color: #5d4843;
            padding: 13px;
            text-align: left;
            font-size: 14px;
        }

        td {
            padding: 13px;
            border-bottom: 1px solid #eee0d8;
            font-size: 14px;
        }

        tr:hover {
            background: #fcf5f0;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 15px;
            background: #ead6ca;
            color: #79555a;
            font-size: 12px;
            white-space: nowrap;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #927477;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1100px) {

            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

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

            .quick-menu {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 600px) {

            .cards {
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


        <!-- MENU -->

        <ul class="menu">

            {{-- DASHBOARD --}}
            <li>

                <a
                    href="{{ route('karyawan.dashboard') }}"
                    class="{{ request()->routeIs('karyawan.dashboard') ? 'active' : '' }}"
                >
                    Dashboard
                </a>

            </li>


            {{-- UKURAN PELANGGAN --}}
            <li>

                <a
                    href="{{ route('karyawan.ukuran.index') }}"
                    class="{{ request()->routeIs('karyawan.ukuran.*') ? 'active' : '' }}"
                >
                    Ukuran Pelanggan
                </a>

            </li>


            {{-- RIWAYAT REVISI --}}
            <li>

                <a
                    href="{{ route('karyawan.revisi.index') }}"
                    class="{{ request()->routeIs('karyawan.revisi.*') ? 'active' : '' }}"
                >
                    Riwayat Revisi
                </a>

            </li>


            {{-- STATUS PENGERJAAN --}}
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


    <!-- =========================
         MAIN CONTENT
    ========================= -->

    <main class="main">


        <!-- TOPBAR -->

        <div class="topbar">

            <div>

                <h1>
                    Dashboard Karyawan
                </h1>

                <p>
                    Kelola ukuran, revisi, dan proses pengerjaan pesanan.
                </p>

            </div>


            <div class="user-info">

                {{ Auth::user()->nama ?? 'Karyawan' }}

            </div>

        </div>


        <!-- =========================
             WELCOME
        ========================= -->

        <div class="welcome">

            <h2>
                Selamat datang, {{ Auth::user()->nama ?? 'Karyawan' }} 👋
            </h2>

            <p>
                Gunakan dashboard ini untuk mengelola ukuran pelanggan,
                riwayat revisi, status pengerjaan, serta estimasi
                penyelesaian pesanan.
            </p>

        </div>


        <!-- =========================
             SUMMARY CARDS
        ========================= -->

        <div class="cards">


            {{-- TOTAL PESANAN --}}

            <div class="card">

                <div class="card-number">
                    {{ $totalPesanan }}
                </div>

                <h3>
                    Total Pesanan
                </h3>

                <p>
                    Jumlah seluruh pesanan yang tercatat.
                </p>

            </div>


            {{-- DIPROSES --}}

            <div class="card">

                <div class="card-number">
                    {{ $pesananDiproses }}
                </div>

                <h3>
                    Sedang Dikerjakan
                </h3>

                <p>
                    Pesanan yang sedang dalam proses pengerjaan.
                </p>

            </div>


            {{-- SELESAI --}}

            <div class="card">

                <div class="card-number">
                    {{ $pesananSelesai }}
                </div>

                <h3>
                    Pesanan Selesai
                </h3>

                <p>
                    Pesanan yang telah selesai dikerjakan.
                </p>

            </div>


            {{-- REVISI --}}

            <div class="card">

                <div class="card-number">
                    {{ $totalRevisi }}
                </div>

                <h3>
                    Riwayat Revisi
                </h3>

                <p>
                    Jumlah data revisi yang tercatat.
                </p>

            </div>

        </div>


        <!-- =========================
             MENU KARYAWAN
        ========================= -->

        <div class="section">

            <h2>
                Menu Karyawan
            </h2>


            <div class="quick-menu">


                {{-- UKURAN PELANGGAN --}}

                <a href="{{ route('karyawan.ukuran.index') }}">

                    <div class="icon">
                        📏
                    </div>

                    <span>
                        Ukuran Pelanggan
                    </span>

                </a>


                {{-- RIWAYAT REVISI --}}

                <a href="{{ route('karyawan.revisi.index') }}">

                    <div class="icon">
                        🔄
                    </div>

                    <span>
                        Riwayat Revisi
                    </span>

                </a>


                {{-- STATUS PENGERJAAN --}}

                <a href="{{ route('karyawan.pengerjaan.index') }}">

                    <div class="icon">
                        🧵
                    </div>

                    <span>
                        Status Pengerjaan
                    </span>

                </a>

            </div>

        </div>


        <!-- =========================
             PESANAN TERBARU
        ========================= -->

        <div class="table-box">

            <h2>
                Pesanan Terbaru
            </h2>


            <table>

                <thead>

                    <tr>

                        <th>
                            No
                        </th>

                        <th>
                            Pelanggan
                        </th>

                        <th>
                            Jenis Pakaian
                        </th>

                        <th>
                            Jumlah
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Estimasi Selesai
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($pesananTerbaru as $item)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $item->user->nama ?? '-' }}
                            </td>

                            <td>
                                {{ $item->jenis_pakaian ?? '-' }}
                            </td>

                            <td>
                                {{ $item->jumlah ?? 0 }}
                            </td>

                            <td>

                                <span class="status">
                                    {{ $item->status_pengerjaan ?? $item->status ?? '-' }}
                                </span>

                            </td>

                            <td>
                                {{ $item->estimasi_selesai ?? '-' }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="empty"
                            >
                                Belum ada pesanan.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </main>

</div>

</body>

</html>