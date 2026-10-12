```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Ukuran - Jaitin</title>

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
            min-height: 100vh;
            padding: 25px 18px;
            background: #b8898d;
            color: white;
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

        .role {
            margin-top: 5px;
            font-size: 13px;
            opacity: .85;
        }

        .menu {
            list-style: none;
            width: 100%;
            padding: 0;
        }

        .menu li {
            list-style: none;
            margin-bottom: 8px;
        }

        .menu a {
            display: block;
            padding: 13px 15px;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            transition: .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: #9f7378;
        }

        .logout {
            margin-top: auto;
            padding-top: 30px;
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
            background: #79545a;
        }

        /* KONTEN UTAMA */
        .main {
            flex: 1;
            padding: 30px 35px;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
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
            border: 1px solid #ead6ca;
            white-space: nowrap;
        }

        /* TABEL */
        .table-box {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(120, 90, 80, .06);
            overflow-x: auto;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .table-header h2 {
            font-size: 20px;
        }

        /* NOTIFIKASI */
        .alert {
            padding: 12px 15px;
            border-radius: 9px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #e8f3e8;
            color: #4c7250;
            border: 1px solid #c9dfca;
        }

        .alert-error {
            background: #f8dddd;
            color: #8f4f55;
            border: 1px solid #e5bfc2;
        }

        /* ISI TABEL */
        table {
            width: 100%;
            min-width: 950px;
            border-collapse: collapse;
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
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #fcf5f0;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #927477;
        }

        /* RESPONSIF */
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

            .topbar,
            .table-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .logout {
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>
<div class="layout">

    <!-- SIDEBAR ADMIN -->
    <aside class="sidebar">
        <div class="logo-area">
            <div class="logo-circle">
                <img src="{{ asset('images/logo-jaitin.png') }}"
                     alt="Logo Jaitin">
            </div>

            <div class="brand">Jaitin</div>
            <div class="role">Admin</div>
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
                <a href="{{ route('admin.ukuran.index') }}"
                   class="active">
                    Data Ukuran
                </a>
            </li>

            <li>
                <a href="{{ route('admin.referensi-model.index') }}">
                    Referensi Model
                </a>
            </li>

            <li>
                <a href="{{ route('admin.pembayaran.index') }}">
                    Pembayaran
                </a>
            </li>

            <li>
                <a href="{{ route('admin.status-pengerjaan.index') }}">
                    Status Pengerjaan
                </a>
            </li>
        </ul>

        <div class="logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="main">
        <div class="topbar">
            <div>
                <h1>Data Ukuran Pelanggan</h1>
                <p>
                    Lihat data ukuran pelanggan untuk mendukung
                    pengelolaan pesanan jahit.
                </p>
            </div>

            <div class="admin-info">
                {{ Auth::user()->nama ?? 'Admin' }}
            </div>
        </div>

        <div class="table-box">

            <!-- NOTIFIKASI BERHASIL -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- NOTIFIKASI ERROR -->
            @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <!-- NOTIFIKASI VALIDASI -->
            @if ($errors->any())
                <div class="alert alert-error">
                    <strong>Terjadi kesalahan:</strong>
                    <ul style="margin: 8px 0 0 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- HEADER TABEL -->
            <div class="table-header">
                <h2>Daftar Ukuran Pelanggan</h2>
            </div>

            <!-- TABEL DATA UKURAN -->
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Panjang Baju (cm)</th>
                        <th>Lebar Bahu (cm)</th>
                        <th>Lingkar Dada (cm)</th>
                        <th>Lingkar Pinggang (cm)</th>
                        <th>Lingkar Lengan (cm)</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($ukuran as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $item->user->nama ?? '-' }}
                            </td>

                            <td>
                                {{ $item->panjang_baju !== null
                                    ? number_format((float) $item->panjang_baju, 2, ',', '.')
                                    : '-' }}
                            </td>

                            <td>
                                {{ $item->lebar_bahu !== null
                                    ? number_format((float) $item->lebar_bahu, 2, ',', '.')
                                    : '-' }}
                            </td>

                            <td>
                                {{ $item->lingkar_dada !== null
                                    ? number_format((float) $item->lingkar_dada, 2, ',', '.')
                                    : '-' }}
                            </td>

                            <td>
                                {{ $item->lingkar_pinggang !== null
                                    ? number_format((float) $item->lingkar_pinggang, 2, ',', '.')
                                    : '-' }}
                            </td>

                            <td>
                                {{ $item->lingkar_lengan !== null
                                    ? number_format((float) $item->lingkar_lengan, 2, ',', '.')
                                    : '-' }}
                            </td>

                            <td>
                                {{ $item->tanggal
                                    ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y')
                                    : '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty">
                                Belum ada data ukuran pelanggan.
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
```