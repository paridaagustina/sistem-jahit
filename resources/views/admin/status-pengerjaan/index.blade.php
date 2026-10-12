
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            line-height: 1.6;
        }

        .admin-info {
            background: #fffaf5;
            padding: 10px 18px;
            border-radius: 20px;
            color: #8e6268;
            border: 1px solid #ead6ca;
            white-space: nowrap;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .summary-card {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(120, 90, 80, .06);
        }

        .summary-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
        }

        .summary-title {
            font-size: 13px;
            color: #806e69;
        }

        .summary-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1dfdc;
            font-size: 18px;
            flex-shrink: 0;
        }

        .summary-number {
            margin-top: 16px;
            font-size: 29px;
            font-weight: bold;
            color: #4b3832;
        }

        .summary-note {
            margin-top: 7px;
            color: #806e69;
            font-size: 12px;
            line-height: 1.5;
        }

        .table-box {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(120, 90, 80, .06);
            overflow: hidden;
        }

        .table-header {
            margin-bottom: 20px;
        }

        .table-header h2 {
            font-size: 20px;
        }

        .table-header p {
            margin-top: 7px;
            color: #806e69;
            font-size: 14px;
            line-height: 1.6;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 1000px;
            border-collapse: collapse;
        }

        th {
            background: #ead6ca;
            color: #5d4843;
            padding: 13px;
            text-align: left;
            font-size: 12px;
            white-space: nowrap;
        }

        td {
            padding: 15px 13px;
            border-bottom: 1px solid #eee0d8;
            font-size: 13px;
            vertical-align: top;
            line-height: 1.5;
        }

        tbody tr:hover {
            background: #fcf5f0;
        }

        .order-number {
            font-weight: bold;
            color: #98686d;
        }

        .customer-name {
            font-weight: bold;
            margin-bottom: 4px;
        }

        .secondary {
            font-size: 12px;
            color: #8c7c7b;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 15px;
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

        .status-lain {
            background: #f0e5e5;
            color: #775b60;
        }

        .empty {
            text-align: center;
            padding: 35px 20px;
            color: #927477;
        }

        .empty-icon {
            font-size: 32px;
            margin-bottom: 12px;
        }

        .pagination {
            padding-top: 20px;
            overflow-x: auto;
        }

        .pagination nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .pagination nav div p {
            color: #806e69;
            font-size: 12px;
        }

        .pagination nav a,
        .pagination nav span[aria-current="page"] span {
            display: inline-block;
            padding: 8px 12px;
            margin: 2px;
            border-radius: 8px;
            border: 1px solid #ead6ca;
            color: #98686d;
            text-decoration: none;
            font-size: 12px;
        }

        .pagination nav span[aria-current="page"] span {
            background: #b8898d;
            color: white;
        }

        @media (max-width: 1100px) {
            .summary {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .main {
                padding: 25px 20px;
            }
        }

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
            }

            .logout {
                margin-top: 20px;
            }
        }

        @media (max-width: 480px) {
            .summary {
                grid-template-columns: 1fr;
            }

            .main {
                padding: 16px;
            }

            .table-box {
                padding: 16px;
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
                <a href="{{ url('/admin/ukuran') }}">
                    Data Ukuran
                </a>
            </li>

            <li>
                <a href="{{ url('/admin/referensi-model') }}">
                    Referensi Model
                </a>
            </li>

            <li>
                <a href="{{ route('admin.pembayaran.index') }}">
                    Pembayaran
                </a>
            </li>

            <li>
                <a href="{{ url('/admin/status-pengerjaan') }}"
                   class="active">
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

    <main class="main">

        <div class="topbar">
            <div>
                <h1>Status Pengerjaan</h1>
                <p>
                    Pantau perkembangan pesanan pelanggan dan status
                    pengerjaan pakaian Jaitin.
                </p>
            </div>

            <div class="admin-info">
                {{ Auth::user()->nama ?? 'Admin' }}
            </div>
        </div>

        <section class="summary">

            <div class="summary-card">
                <div class="summary-top">
                    <div class="summary-title">Total Pesanan Tercatat</div>
                    <div class="summary-icon">📋</div>
                </div>
                <div class="summary-number">
                    {{ number_format($totalPesanan, 0, ',', '.') }}
                </div>
                <div class="summary-note">
                    Jumlah pesanan dengan riwayat status
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-top">
                    <div class="summary-title">Menunggu</div>
                    <div class="summary-icon">⏳</div>
                </div>
                <div class="summary-number">
                    {{ number_format($totalMenunggu, 0, ',', '.') }}
                </div>
                <div class="summary-note">
                    Menunggu proses pengerjaan
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-top">
                    <div class="summary-title">Dalam Proses</div>
                    <div class="summary-icon">🧵</div>
                </div>
                <div class="summary-number">
                    {{ number_format($totalProses, 0, ',', '.') }}
                </div>
                <div class="summary-note">
                    Pesanan yang sedang dikerjakan
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-top">
                    <div class="summary-title">Selesai</div>
                    <div class="summary-icon">✓</div>
                </div>
                <div class="summary-number">
                    {{ number_format($totalSelesai, 0, ',', '.') }}
                </div>
                <div class="summary-note">
                    Selesai atau siap diambil
                </div>
            </div>

        </section>

        <section class="table-box">

            <div class="table-header">
                <h2>Riwayat Status Pengerjaan</h2>
                <p>
                    Daftar pembaruan status pesanan yang tercatat di sistem.
                </p>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Jenis Pakaian</th>
                            <th>Karyawan</th>
                            <th>Status Pengerjaan</th>
                            <th>Keterangan</th>
                            <th>Tanggal Pembaruan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($statusPengerjaan as $item)
                            @php
                                $pesanan = $item->pesanan;
                                $status = strtolower(trim($item->status ?? ''));

                                if (
                                    str_contains($status, 'siap diambil') ||
                                    str_contains($status, 'sudah diambil') ||
                                    $status === 'diambil'
                                ) {
                                    $statusClass = 'status-diambil';
                                } elseif (str_contains($status, 'selesai')) {
                                    $statusClass = 'status-selesai';
                                } elseif (
                                    str_contains($status, 'proses') ||
                                    str_contains($status, 'dikerjakan')
                                ) {
                                    $statusClass = 'status-proses';
                                } elseif (str_contains($status, 'menunggu')) {
                                    $statusClass = 'status-menunggu';
                                } else {
                                    $statusClass = 'status-lain';
                                }
                            @endphp

                            <tr>
                                <td>
                                    {{ $statusPengerjaan->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <span class="order-number">
                                        #{{ $item->id_pesanan }}
                                    </span>
                                </td>

                                <td>
                                    <div class="customer-name">
                                        {{ $pesanan?->user?->nama
                                            ?? $pesanan?->user?->name
                                            ?? 'Pelanggan tidak ditemukan' }}
                                    </div>
                                </td>

                                <td>
                                    {{ $pesanan?->jenis_pakaian ?? '-' }}

                                    @if ($pesanan?->model_pakaian)
                                        <div class="secondary">
                                            {{ $pesanan->model_pakaian }}
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    {{ $pesanan?->karyawan?->nama
                                        ?? $pesanan?->karyawan?->name
                                        ?? 'Belum ditentukan' }}
                                </td>

                                <td>
                                    <span class="status {{ $statusClass }}">
                                        {{ $item->status ?? 'Belum ada status' }}
                                    </span>
                                </td>

                                <td>
                                    {{ $item->keterangan ?: '-' }}
                                </td>

                                <td>
                                    @if ($item->tanggal_status)
                                        {{ \Illuminate\Support\Carbon::parse($item->tanggal_status)->translatedFormat('d M Y') }}
                                        <div class="secondary">
                                            {{ \Illuminate\Support\Carbon::parse($item->tanggal_status)->format('H:i') }}
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="8" class="empty">
                                    <div class="empty-icon">🧵</div>
                                    <strong>
                                        Belum ada riwayat status pengerjaan
                                    </strong>
                                    <p style="margin-top: 8px;">
                                        Data akan tampil setelah status
                                        pengerjaan pesanan tercatat.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($statusPengerjaan, 'links'))
                <div class="pagination">
                    {{ $statusPengerjaan->links() }}
                </div>
            @endif

        </section>

    </main>
</div>
</body>
</html>
