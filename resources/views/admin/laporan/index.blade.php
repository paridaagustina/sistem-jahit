<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Laporan - Jaitin</title>

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

            transition: 0.2s;
        }

        .menu a:hover,
        .menu a.active {
            background: #9f7378;
        }

        /* =========================
           LOGOUT
        ========================= */

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

            margin-bottom: 25px;
        }

        .topbar h1 {
            font-size: 28px;

            color: #4b3832;
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

            border: 1px solid #ead6ca;
        }

        /* =========================
           STATISTIK
        ========================= */

        .stats {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 18px;

            margin-bottom: 25px;
        }

        .stat-card {
            background: #fffaf5;

            border: 1px solid #ead6ca;

            border-radius: 15px;

            padding: 20px;

            box-shadow:
                0 4px 12px
                rgba(120, 90, 80, 0.06);
        }

        .stat-card p {
            color: #806e69;

            font-size: 14px;

            margin-bottom: 8px;
        }

        .stat-card h2 {
            color: #4b3832;

            font-size: 24px;
        }

        /* =========================
           FILTER
        ========================= */

        .filter-box {
            background: #fffaf5;

            border: 1px solid #ead6ca;

            border-radius: 15px;

            padding: 22px;

            margin-bottom: 25px;

            box-shadow:
                0 4px 12px
                rgba(120, 90, 80, 0.06);
        }

        .filter-box h2 {
            font-size: 19px;

            margin-bottom: 18px;
        }

        .filter-form {
            display: grid;

            grid-template-columns:
                1fr 1fr 1fr auto auto;

            gap: 12px;

            align-items: end;
        }

        .form-group label {
            display: block;

            font-size: 13px;

            margin-bottom: 7px;

            color: #806e69;
        }

        .form-group input,
        .form-group select {
            width: 100%;

            padding: 10px 12px;

            border: 1px solid #decac0;

            border-radius: 8px;

            background: white;

            color: #4b3832;

            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #b8898d;
        }

        .btn-filter {
            border: none;

            background: #b8898d;

            color: white;

            padding: 10px 18px;

            border-radius: 8px;

            cursor: pointer;
        }

        .btn-filter:hover {
            background: #9f7378;
        }

        .btn-reset {
            background: #ead6ca;

            color: #5d4843;

            padding: 10px 18px;

            border-radius: 8px;

            text-decoration: none;

            display: inline-block;
        }

        .btn-reset:hover {
            background: #dfc8ba;
        }

        /* =========================
           TABLE
        ========================= */

        .table-box {
            background: #fffaf5;

            border: 1px solid #ead6ca;

            border-radius: 15px;

            padding: 25px;

            box-shadow:
                0 4px 12px
                rgba(120, 90, 80, 0.06);

            overflow-x: auto;
        }

        .table-header {
            display: flex;

            justify-content: space-between;
            align-items: center;

            margin-bottom: 20px;
        }

        .table-header h2 {
            font-size: 20px;
        }

        table {
            width: 100%;

            border-collapse: collapse;

            min-width: 1000px;
        }

        th {
            background: #ead6ca;

            color: #5d4843;

            padding: 13px;

            text-align: left;

            font-size: 14px;

            white-space: nowrap;
        }

        td {
            padding: 13px;

            border-bottom:
                1px solid #eee0d8;

            font-size: 14px;

            vertical-align: middle;
        }

        tr:hover {
            background: #fcf5f0;
        }

        /* =========================
           STATUS
        ========================= */

        .status {
            display: inline-block;

            padding: 6px 10px;

            border-radius: 20px;

            font-size: 12px;

            white-space: nowrap;
        }

        .status-menunggu {
            background: #f5e8d8;

            color: #8a6845;
        }

        .status-proses {
            background: #eee0e2;

            color: #8f5d64;
        }

        .status-selesai {
            background: #e5f1e5;

            color: #557558;
        }

        .status-diambil {
            background: #e1e9f1;

            color: #536b80;
        }

        .empty {
            text-align: center;

            padding: 30px;

            color: #927477;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1000px) {

            .filter-form {
                grid-template-columns: 1fr 1fr;
            }

            .stats {
                grid-template-columns: 1fr;
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
                flex-direction: column;

                align-items: flex-start;

                gap: 15px;
            }

            .filter-form {
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

        </div>


        <ul class="menu">

            <li>
                <a href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('admin.pelanggan.index') }}">
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
                <a
                    href="{{ route('admin.laporan.index') }}"
                    class="active"
                >
                    Laporan
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
         MAIN
    ========================= -->

    <main class="main">

        <!-- TOPBAR -->

        <div class="topbar">

            <div>

                <h1>
                    Laporan
                </h1>

                <p>
                    Melihat dan memfilter laporan pesanan Jaitin.
                </p>

            </div>


            <div class="admin-info">

                {{ Auth::user()->nama ?? 'Admin' }}

            </div>

        </div>


        <!-- =========================
             STATISTIK
        ========================= -->

        <div class="stats">

            <div class="stat-card">

                <p>
                    Jumlah Pesanan
                </p>

                <h2>
                    {{ $jumlahPesanan }}
                </h2>

            </div>


            <div class="stat-card">

                <p>
                    Total Harga
                </p>

                <h2>
                    Rp {{ number_format(
                        $totalHarga ?? 0,
                        0,
                        ',',
                        '.'
                    ) }}
                </h2>

            </div>


            <div class="stat-card">

                <p>
                    Total DP
                </p>

                <h2>
                    Rp {{ number_format(
                        $totalDp ?? 0,
                        0,
                        ',',
                        '.'
                    ) }}
                </h2>

            </div>

        </div>


        <!-- =========================
             FILTER
        ========================= -->

        <div class="filter-box">

            <h2>
                Filter Laporan
            </h2>


            <form
                action="{{ route('admin.laporan.index') }}"
                method="GET"
                class="filter-form"
            >

                <!-- TANGGAL MULAI -->

                <div class="form-group">

                    <label>
                        Tanggal Mulai
                    </label>

                    <input
                        type="date"
                        name="tanggal_mulai"
                        value="{{ $tanggalMulai }}"
                    >

                </div>


                <!-- TANGGAL SELESAI -->

                <div class="form-group">

                    <label>
                        Tanggal Selesai
                    </label>

                    <input
                        type="date"
                        name="tanggal_selesai"
                        value="{{ $tanggalSelesai }}"
                    >

                </div>


                <!-- STATUS -->

                <div class="form-group">

                    <label>
                        Status Pesanan
                    </label>

                    <select name="status">

                        <option value="">
                            Semua Status
                        </option>

                        <option
                            value="Menunggu"
                            {{ $status == 'Menunggu' ? 'selected' : '' }}
                        >
                            Menunggu
                        </option>

                        <option
                            value="Diproses"
                            {{ $status == 'Diproses' ? 'selected' : '' }}
                        >
                            Diproses
                        </option>

                        <option
                            value="Selesai"
                            {{ $status == 'Selesai' ? 'selected' : '' }}
                        >
                            Selesai
                        </option>

                        <option
                            value="Diambil"
                            {{ $status == 'Diambil' ? 'selected' : '' }}
                        >
                            Diambil
                        </option>

                    </select>

                </div>


                <!-- FILTER -->

                <button
                    type="submit"
                    class="btn-filter"
                >
                    Filter
                </button>


                <!-- RESET -->

                <a
                    href="{{ route('admin.laporan.index') }}"
                    class="btn-reset"
                >
                    Reset
                </a>

            </form>

        </div>


        <!-- =========================
             DATA LAPORAN
        ========================= -->

        <div class="table-box">

            <div class="table-header">

                <h2>
                    Laporan Pesanan
                </h2>

            </div>


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
                            Tanggal Pesan
                        </th>

                        <th>
                            Estimasi Selesai
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Total Harga
                        </th>

                        <th>
                            DP
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

                                {{ $item->tanggal_pesan
                                    ? \Carbon\Carbon::parse(
                                        $item->tanggal_pesan
                                    )->format('d-m-Y H:i')
                                    : '-'
                                }}

                            </td>


                            <td>

                                {{ $item->estimasi_selesai
                                    ? \Carbon\Carbon::parse(
                                        $item->estimasi_selesai
                                    )->format('d-m-Y')
                                    : '-'
                                }}

                            </td>


                            <td>

                                @php

                                    $statusItem =
                                        strtolower(
                                            trim(
                                                $item->status ?? ''
                                            )
                                        );

                                @endphp


                                @if($statusItem == 'selesai')

                                    <span
                                        class="status status-selesai"
                                    >
                                        Selesai
                                    </span>

                                @elseif($statusItem == 'diambil')

                                    <span
                                        class="status status-diambil"
                                    >
                                        Diambil
                                    </span>

                                @elseif(
                                    $statusItem == 'diproses' ||
                                    $statusItem == 'sedang dikerjakan' ||
                                    $statusItem == 'menunggu diproses'
                                )

                                    <span
                                        class="status status-proses"
                                    >
                                        {{ $item->status }}
                                    </span>

                                @else

                                    <span
                                        class="status status-menunggu"
                                    >
                                        {{ $item->status ?? 'Menunggu' }}
                                    </span>

                                @endif

                            </td>


                            <td>

                                Rp {{ number_format(
                                    $item->total_harga ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </td>


                            <td>

                                Rp {{ number_format(
                                    $item->besaran_dp ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="9"
                                class="empty"
                            >
                                Belum ada data laporan
                                pesanan.
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