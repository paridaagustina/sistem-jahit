<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pesanan Saya - Jaitin</title>

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
            flex-shrink: 0;
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
            cursor: pointer;
            transition: 0.2s;
        }

        .menu a:hover {
            background: #9f7378;
        }

        .menu a.active {
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
            margin-bottom: 25px;
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
           TABLE BOX
        ========================= */

        .table-box {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(120, 90, 80, 0.06);
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
            color: #5d4843;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 950px;
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
            border-bottom: 1px solid #eee0d8;
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
            border-radius: 15px;
            background: #ead6ca;
            color: #79555a;
            font-size: 12px;
            white-space: nowrap;
        }

        .status-lunas {
            background: #dcebdc;
            color: #527052;
        }

        .status-pending {
            background: #f7e4bd;
            color: #8a6b35;
        }

        /* =========================
           BUTTON BAYAR
        ========================= */

        .btn-bayar {
            display: inline-block;
            background: #b8898d;
            color: white;
            padding: 8px 13px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn-bayar:hover {
            background: #9f7378;
        }

        /* =========================
           ALERT
        ========================= */

        .alert-success {
            background: #e7f3e7;
            color: #527052;
            border: 1px solid #c8dfc8;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-error {
            background: #fde4e4;
            color: #9b4d4d;
            border: 1px solid #e8aaaa;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #927477;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 768px) {

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

        </div>

        <ul class="menu">

            <!-- DASHBOARD -->
            <li>
                <a
                    href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"
                >
                    Dashboard
                </a>
            </li>

            <!-- PESAN JASA JAHIT -->
            <li>
                <a
                    href="{{ route('pelanggan.pesanan.create') }}"
                    class="{{ request()->routeIs('pelanggan.pesanan.create') ? 'active' : '' }}"
                >
                    Pesan Jasa Jahit
                </a>
            </li>

            <!-- PESANAN SAYA -->
            <li>
                <a
                    href="{{ route('pelanggan.pesanan.index') }}"
                    class="{{ request()->routeIs('pelanggan.pesanan.index') ? 'active' : '' }}"
                >
                    Pesanan Saya
                </a>
            </li>

            <!-- UKURAN SAYA -->
            <li>
                <a href="{{ route('dashboard') }}">
                    Ukuran Saya
                </a>
            </li>

            <!-- PEMBAYARAN -->
            <li>
                <a href="{{ route('dashboard') }}">
                    Pembayaran
                </a>
            </li>

            <!-- RIWAYAT REVISI -->
            <li>
                <a href="{{ route('dashboard') }}">
                    Riwayat Revisi
                </a>
            </li>

            <!-- PENGAMBILAN -->
            <li>
                <a href="{{ route('dashboard') }}">
                    Pengambilan
                </a>
            </li>

        </ul>

        <!-- LOGOUT -->
        <div class="logout">

            <form action="{{ route('logout') }}" method="POST">

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
                    Pesanan Saya
                </h1>

                <p>
                    Lihat pesanan, status pengerjaan, estimasi selesai, dan pembayaran Anda.
                </p>

            </div>

            <div class="user-info">
                {{ Auth::user()->nama ?? 'Pelanggan' }}
            </div>

        </div>


        <!-- ALERT SUCCESS -->

        @if(session('success'))

            <div class="alert-success">
                {{ session('success') }}
            </div>

        @endif


        <!-- ALERT ERROR -->

        @if(session('error'))

            <div class="alert-error">
                {{ session('error') }}
            </div>

        @endif


        <!-- TABLE -->

        <div class="table-box">

            <div class="table-header">

                <h2>
                    Daftar Pesanan
                </h2>

            </div>


            <table>

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Jenis Pakaian</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pesan</th>
                        <th>Tanggal Harapan</th>
                        <th>Estimasi Selesai</th>
                        <th>Status</th>
                        <th>Total Harga</th>
                        <th>Pembayaran</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($pesanan as $item)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $item->jenis_pakaian ?? '-' }}
                            </td>

                            <td>
                                {{ $item->jumlah ?? 0 }}
                            </td>

                            <td>
                                {{ $item->tanggal_pesan ?? '-' }}
                            </td>

                            <td>
                                {{ $item->tanggal_harapan ?? '-' }}
                            </td>

                            <td>
                                {{ $item->estimasi_selesai ?? '-' }}
                            </td>

                            <td>

                                <span class="status">
                                    {{ $item->status ?? '-' }}
                                </span>

                            </td>

                            <td>
                                Rp {{ number_format($item->total_harga ?? 0, 0, ',', '.') }}
                            </td>

                            <td>

                                @if(($item->status_pembayaran ?? '') === 'Lunas')

                                    <span class="status status-lunas">
                                        Lunas
                                    </span>

                                @else

                                    <a
                                        href="{{ route('pelanggan.pembayaran.pay', $item->id_pesanan) }}"
                                        class="btn-bayar"
                                    >
                                        Bayar
                                    </a>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9" class="empty">
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