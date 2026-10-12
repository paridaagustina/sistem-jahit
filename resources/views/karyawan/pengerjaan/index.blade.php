<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Status Pengerjaan - Jaitin</title>

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
           MENU
        ========================= */

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu li {
            margin-bottom: 8px;
        }

        .menu li a {
            display: block;
            padding: 13px 15px;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            transition: 0.2s;
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
           SECTION
        ========================= */

        .section {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 25px;
        }

        .section h2 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        /* =========================
           ALERT
        ========================= */

        .alert {
            background: #ead6ca;
            border: 1px solid #d9bdb0;
            color: #79555a;
            padding: 13px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        /* =========================
           TABLE
        ========================= */

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1100px;
        }

        th {
            background: #ead6ca;
            color: #5d4843;
            padding: 13px;
            text-align: left;
            font-size: 13px;
            white-space: nowrap;
        }

        td {
            padding: 13px;
            border-bottom: 1px solid #eee0d8;
            font-size: 14px;
            vertical-align: middle;
        }

        tr:hover {
            background: #fcf5f0;
        }

        /* =========================
           FORM
        ========================= */

        .status-form {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 430px;
        }

        .status-form select,
        .status-form input {
            border: 1px solid #ddc7bb;
            background: #fffaf5;
            color: #4b3832;
            border-radius: 8px;
            padding: 9px 10px;
            font-size: 13px;
        }

        .status-form select {
            min-width: 180px;
        }

        .status-form input {
            width: 145px;
        }

        .btn-save {
            border: none;
            background: #b8898d;
            color: white;
            padding: 9px 13px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
        }

        .btn-save:hover {
            background: #9f7378;
        }

        /* =========================
           STATUS
        ========================= */

        .status-badge {
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
                <a href="{{ route('karyawan.revisi.index') }}">
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
         MAIN
    ========================= -->

    <main class="main">


        <!-- TOPBAR -->

        <div class="topbar">

            <div>

                <h1>
                    Status Pengerjaan
                </h1>

                <p>
                    Kelola proses pengerjaan dan estimasi penyelesaian pesanan pelanggan.
                </p>

            </div>


            <div class="user-info">
                {{ Auth::user()->nama ?? 'Karyawan' }}
            </div>

        </div>


        <!-- =========================
             SECTION
        ========================= -->

        <div class="section">

            <h2>
                Data Pengerjaan Pesanan
            </h2>


            @if(session('success'))

                <div class="alert">
                    {{ session('success') }}
                </div>

            @endif


            <div class="table-wrapper">

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
                                Status Saat Ini
                            </th>

                            <th>
                                Estimasi Selesai
                            </th>

                            <th>
                                Perbarui Pengerjaan
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($pesanan as $item)

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

                                    <span class="status-badge">

                                        {{ $item->status_pengerjaan ?? 'Menunggu Produksi' }}

                                    </span>

                                </td>


                                <td>

                                    {{ $item->estimasi_selesai
                                        ? \Carbon\Carbon::parse($item->estimasi_selesai)->format('d/m/Y')
                                        : '-'
                                    }}

                                </td>


                                <td>

                                    <form
                                        action="{{ route('karyawan.pengerjaan.update', $item->id_pesanan) }}"
                                        method="POST"
                                        class="status-form"
                                    >

                                        @csrf

                                        @method('PUT')


                                        <select
                                            name="status_pengerjaan"
                                            required
                                        >

                                            <option
                                                value="Menunggu Produksi"
                                                {{ ($item->status_pengerjaan ?? '') === 'Menunggu Produksi' ? 'selected' : '' }}
                                            >
                                                Menunggu Produksi
                                            </option>

                                            <option
                                                value="Sedang Dipotong"
                                                {{ $item->status_pengerjaan === 'Sedang Dipotong' ? 'selected' : '' }}
                                            >
                                                Sedang Dipotong
                                            </option>

                                            <option
                                                value="Sedang Menjahit"
                                                {{ $item->status_pengerjaan === 'Sedang Menjahit' ? 'selected' : '' }}
                                            >
                                                Sedang Menjahit
                                            </option>

                                            <option
                                                value="Finishing"
                                                {{ $item->status_pengerjaan === 'Finishing' ? 'selected' : '' }}
                                            >
                                                Finishing
                                            </option>

                                            <option
                                                value="Quality Check"
                                                {{ $item->status_pengerjaan === 'Quality Check' ? 'selected' : '' }}
                                            >
                                                Quality Check
                                            </option>

                                            <option
                                                value="Siap Diambil"
                                                {{ $item->status_pengerjaan === 'Siap Diambil' ? 'selected' : '' }}
                                            >
                                                Siap Diambil
                                            </option>

                                            <option
                                                value="Sudah Diambil"
                                                {{ $item->status_pengerjaan === 'Sudah Diambil' ? 'selected' : '' }}
                                            >
                                                Sudah Diambil
                                            </option>

                                        </select>


                                        <input
                                            type="date"
                                            name="estimasi_selesai"
                                            value="{{ $item->estimasi_selesai }}"
                                        >


                                        <button
                                            type="submit"
                                            class="btn-save"
                                        >
                                            Simpan
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="empty"
                                >
                                    Belum ada pesanan yang dapat dikelola.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>

</body>

</html>