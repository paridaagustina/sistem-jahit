
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pembayaran - Jaitin</title>

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
            flex-shrink: 0;
            background: #b8898d;
            color: white;
            padding: 25px 18px;
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

        .main {
            flex: 1;
            min-width: 0;
            padding: 30px 35px;
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
            margin-top: 7px;
            color: #806e69;
            line-height: 1.6;
        }

        .admin-info {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            padding: 10px 18px;
            border-radius: 20px;
            color: #8e6268;
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
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 4px 12px rgba(120, 90, 80, 0.05);
        }

        .summary-card p {
            font-size: 14px;
            color: #806e69;
            margin-bottom: 12px;
            line-height: 1.5;
        }

        .summary-card h2 {
            font-size: 25px;
            overflow-wrap: anywhere;
        }

        .summary-card:nth-child(2) h2 {
            color: #5e805e;
        }

        .summary-card:nth-child(3) h2 {
            color: #a17a42;
        }

        .summary-card:nth-child(4) h2 {
            color: #9f7378;
        }

        .table-box {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(120, 90, 80, 0.06);
        }

        .table-header {
            margin-bottom: 20px;
        }

        .table-header h2 {
            font-size: 21px;
            margin-bottom: 7px;
        }

        .table-header p {
            font-size: 14px;
            color: #806e69;
        }

        .filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 22px;
        }

        .filter-form input,
        .filter-form select {
            min-height: 42px;
            padding: 10px 12px;
            border: 1px solid #dec8bf;
            border-radius: 8px;
            background: white;
            color: #4b3832;
            font-size: 14px;
        }

        .filter-form input {
            flex: 1;
            min-width: 200px;
        }

        .btn {
            display: inline-block;
            padding: 11px 16px;
            border: none;
            border-radius: 8px;
            background: #b8898d;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn:hover {
            background: #9f7378;
        }

        .btn-reset {
            background: #eee0da;
            color: #6c514b;
        }

        .alert {
            padding: 13px 15px;
            border-radius: 9px;
            margin-bottom: 18px;
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

        .table-responsive {
            width: 100%;
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

        tbody tr:hover {
            background: #fcf5f0;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            white-space: nowrap;
        }

        .status-success {
            background: #e5f1e5;
            color: #557558;
        }

        .status-pending {
            background: #f5e8d8;
            color: #8a6845;
        }

        .status-failed {
            background: #f8dddd;
            color: #8f4f55;
        }

        .status-other {
            background: #eee0e2;
            color: #8f5d64;
        }

        .empty {
            text-align: center;
            padding: 35px 20px;
            color: #927477;
            line-height: 1.7;
        }

        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 20px;
            color: #806e69;
            font-size: 14px;
        }

        .pagination-links {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .pagination-links a,
        .pagination-links span {
            display: inline-block;
            padding: 8px 12px;
            border: 1px solid #ead6ca;
            border-radius: 7px;
            background: white;
            color: #8f6268;
            text-decoration: none;
        }

        .pagination-links .current {
            background: #b8898d;
            color: white;
            border-color: #b8898d;
        }

        .note {
            margin-top: 18px;
            font-size: 13px;
            color: #806e69;
            line-height: 1.7;
        }

        @media (max-width: 1100px) {
            .summary {
                grid-template-columns: repeat(2, minmax(0, 1fr));
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
                align-items: flex-start;
                flex-direction: column;
            }

            .summary {
                grid-template-columns: 1fr;
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
                <img
                    src="{{ asset('images/logo-jaitin.png') }}"
                    alt="Logo Jaitin"
                    onerror="this.style.display='none';"
                >
            </div>
            <div class="brand">Jaitin</div>
        </div>

        <ul class="menu">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('admin.pelanggan.index') }}">Data Pelanggan</a>
            </li>
            <li>
                <a href="{{ route('admin.pesanan.index') }}">Data Pesanan</a>
            </li>
            <li>
                <a href="{{ route('admin.ukuran.index') }}">Data Ukuran</a>
            </li>
            <li>
                <a href="{{ route('admin.referensi-model.index') }}">Referensi Model</a>
            </li>
            <li>
                <a href="{{ route('admin.pembayaran.index') }}" class="active">Pembayaran</a>
            </li>
            <li>
                <a href="{{ route('admin.status-pengerjaan.index') }}">Status Pengerjaan</a>
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
                <h1>Manajemen Pembayaran</h1>
                <p>Pantau transaksi pembayaran pelanggan Jaitin.</p>
            </div>

            <div class="admin-info">
                {{ Auth::user()->nama ?? 'Admin' }}
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <section class="summary">
            <div class="summary-card">
                <p>Total Transaksi</p>
                <h2>{{ number_format($totalTransaksi ?? 0, 0, ',', '.') }}</h2>
            </div>

            <div class="summary-card">
                <p>Pembayaran Berhasil</p>
                <h2>{{ number_format($totalBerhasil ?? 0, 0, ',', '.') }}</h2>
            </div>

            <div class="summary-card">
                <p>Menunggu Pembayaran</p>
                <h2>{{ number_format($totalMenunggu ?? 0, 0, ',', '.') }}</h2>
            </div>

            <div class="summary-card">
                <p>Total Dana Pembayaran Berhasil</p>
                <h2 style="font-size: 21px;">
                    Rp {{ number_format($totalDanaDiterima ?? 0, 0, ',', '.') }}
                </h2>
            </div>
        </section>

        <section class="table-box">
            <div class="table-header">
                <h2>Daftar Transaksi</h2>
                <p>Data transaksi pembayaran yang tersimpan di database.</p>
            </div>

            <form
                action="{{ route('admin.pembayaran.index') }}"
                method="GET"
                class="filter-form"
            >
                <input
                    type="text"
                    name="cari"
                    placeholder="Cari ID pesanan atau ID transaksi..."
                    value="{{ request('cari') }}"
                >

                <select name="status">
                    <option value="">Semua Status</option>
                    <option value="berhasil" @selected(request('status') === 'berhasil')>
                        Berhasil
                    </option>
                    <option value="settlement" @selected(request('status') === 'settlement')>
                        Settlement
                    </option>
                    <option value="capture" @selected(request('status') === 'capture')>
                        Capture
                    </option>
                    <option value="pending" @selected(request('status') === 'pending')>
                        Pending
                    </option>
                    <option value="gagal" @selected(request('status') === 'gagal')>
                        Gagal
                    </option>
                    <option value="expire" @selected(request('status') === 'expire')>
                        Kedaluwarsa
                    </option>
                    <option value="cancel" @selected(request('status') === 'cancel')>
                        Dibatalkan
                    </option>
                </select>

                <select name="jenis">
                    <option value="">Semua Jenis</option>
                    <option value="DP" @selected(request('jenis') === 'DP')>DP</option>
                    <option value="Pelunasan" @selected(request('jenis') === 'Pelunasan')>
                        Pelunasan
                    </option>
                </select>

                <button type="submit" class="btn">Cari / Filter</button>

                <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-reset">
                    Reset
                </a>
            </form>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID Pembayaran</th>
                            <th>ID Pesanan</th>
                            <th>Nama Pelanggan</th>
                            <th>Nominal</th>
                            <th>Jenis Pembayaran</th>
                            <th>Tanggal</th>
                            <th>Metode</th>
                            <th>ID Transaksi</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($pembayaran as $item)
                            @php
                                $status = strtolower(trim((string) $item->status_pembayaran));

                                $statusBerhasil = in_array($status, [
                                    'lunas',
                                    'berhasil',
                                    'success',
                                    'settlement',
                                    'capture',
                                ], true);

                                $statusGagal = in_array($status, [
                                    'gagal',
                                    'failed',
                                    'deny',
                                    'expire',
                                    'expired',
                                    'cancel',
                                ], true);

                                $statusPending = in_array($status, [
                                    'pending',
                                    'menunggu',
                                ], true);
                            @endphp

                            <tr>
                                <td>
                                    {{ ($pembayaran->firstItem() ?? 1) + $loop->index }}
                                </td>

                                <td>#{{ $item->id_pembayaran }}</td>

                                <td>#{{ $item->id_pesanan }}</td>

                                <td>
                                    {{ $item->pesanan?->user?->nama ?? '-' }}
                                </td>

                                <td>
                                    Rp {{ number_format((float) $item->jumlah, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ $item->jenis_pembayaran ?: '-' }}
                                </td>

                                <td>
                                    {{ $item->tanggal_pembayaran
                                        ? $item->tanggal_pembayaran->format('d-m-Y H:i')
                                        : '-' }}
                                </td>

                                <td>{{ $item->metode_pembayaran ?: '-' }}</td>

                                <td>
                                    {{ $item->transaksi_id ?: '-' }}
                                </td>

                                <td>
                                    @if ($statusBerhasil)
                                        <span class="status status-success">
                                            {{ ucfirst($item->status_pembayaran) }}
                                        </span>
                                    @elseif ($statusGagal)
                                        <span class="status status-failed">
                                            {{ ucfirst($item->status_pembayaran) }}
                                        </span>
                                    @elseif ($statusPending)
                                        <span class="status status-pending">
                                            {{ ucfirst($item->status_pembayaran) }}
                                        </span>
                                    @else
                                        <span class="status status-other">
                                            {{ $item->status_pembayaran ?: 'Belum diketahui' }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="empty">
                                    Belum ada data pembayaran yang sesuai dengan pencarian atau filter.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($pembayaran->hasPages())
                <div class="pagination">
                    <div>
                        Menampilkan {{ $pembayaran->firstItem() ?? 0 }}
                        sampai {{ $pembayaran->lastItem() ?? 0 }}
                        dari {{ $pembayaran->total() }} transaksi
                    </div>

                    <div class="pagination-links">
                        @if ($pembayaran->onFirstPage())
                            <span>‹ Sebelumnya</span>
                        @else
                            <a href="{{ $pembayaran->previousPageUrl() }}">‹ Sebelumnya</a>
                        @endif

                        <span class="current">
                            {{ $pembayaran->currentPage() }}
                            / {{ $pembayaran->lastPage() }}
                        </span>

                        @if ($pembayaran->hasMorePages())
                            <a href="{{ $pembayaran->nextPageUrl() }}">Berikutnya ›</a>
                        @else
                            <span>Berikutnya ›</span>
                        @endif
                    </div>
                </div>
            @endif

            <p class="note">
                Status transaksi ditampilkan berdasarkan data yang tersimpan di database.
                Pastikan status dari payment gateway telah diverifikasi oleh backend.
            </p>
        </section>
    </main>
</div>
</body>
</html>
