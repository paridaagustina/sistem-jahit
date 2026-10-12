```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pesanan - Jaitin</title>

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
        }

        .admin-info {
            background: #fffaf5;
            padding: 10px 18px;
            border-radius: 20px;
            color: #8e6268;
            border: 1px solid #ead6ca;
            white-space: nowrap;
        }

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

        .btn-tambah {
            display: inline-block;
            background: #b8898d;
            color: white;
            padding: 10px 18px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 14px;
            white-space: nowrap;
        }

        .btn-tambah:hover {
            background: #9f7378;
        }

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

        table {
            width: 100%;
            min-width: 1200px;
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
        }

        tbody tr:hover {
            background: #fcf5f0;
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

        .action-group {
            display: flex;
            align-items: center;
            gap: 5px;
            flex-wrap: wrap;
        }

        .btn-edit,
        .btn-revisi,
        .btn-hapus {
            display: inline-block;
            padding: 7px 11px;
            border: none;
            border-radius: 7px;
            color: white;
            text-decoration: none;
            font-size: 12px;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-edit {
            background: #c9a6a0;
        }

        .btn-edit:hover {
            background: #ad8580;
        }

        .btn-revisi {
            background: #b89b7d;
        }

        .btn-revisi:hover {
            background: #9f8265;
        }

        .btn-hapus {
            background: #8f666b;
        }

        .btn-hapus:hover {
            background: #79545a;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #927477;
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
                <a href="{{ route('admin.pesanan.index') }}" class="active">
                    Data Pesanan
                </a>
            </li>

            {{-- Tujuan ini perlu route admin tersendiri --}}
            <li>
                <a href="{{ url('/admin/ukuran') }}">
                    Data Ukuran
                </a>
            </li>

            {{-- Tujuan ini perlu route admin tersendiri --}}
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

            {{-- Tujuan ini perlu route admin tersendiri --}}
            <li>
                <a href="{{ url('/admin/status-pengerjaan') }}">
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
                <h1>Data Pesanan</h1>
                <p>Kelola data pesanan pelanggan Jaitin.</p>
            </div>

            <div class="admin-info">
                {{ Auth::user()->nama ?? 'Admin' }}
            </div>
        </div>

        <div class="table-box">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <strong>Terjadi kesalahan:</strong>
                    <ul style="margin: 8px 0 0 18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="table-header">
                <h2>Daftar Pesanan</h2>

                <a href="{{ route('admin.pesanan.create') }}"
                   class="btn-tambah">
                    + Tambah Pesanan
                </a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>Jenis Pakaian</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pesan</th>
                        <th>Tanggal Harapan</th>
                        <th>Estimasi Selesai</th>
                        <th>Status</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pesanan as $item)
                        @php
                            $status = strtolower(trim($item->status ?? ''));

                            if (in_array($status, ['selesai'])) {
                                $statusClass = 'status-selesai';
                            } elseif (in_array($status, ['diambil', 'sudah diambil'])) {
                                $statusClass = 'status-diambil';
                            } elseif (in_array($status, [
                                'diproses',
                                'sedang dikerjakan',
                                'menunggu diproses',
                                'dalam pengerjaan',
                                'sedang menjahit',
                                'finishing',
                                'quality check'
                            ])) {
                                $statusClass = 'status-proses';
                            } else {
                                $statusClass = 'status-menunggu';
                            }
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->nama ?? '-' }}</td>
                            <td>{{ $item->jenis_pakaian ?? '-' }}</td>
                            <td>{{ $item->jumlah ?? 0 }}</td>

                            <td>
                                @if($item->tanggal_pesan)
                                    {{ \Carbon\Carbon::parse($item->tanggal_pesan)->format('d-m-Y H:i') }}
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                @if($item->tanggal_harapan)
                                    {{ \Carbon\Carbon::parse($item->tanggal_harapan)->format('d-m-Y') }}
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                @if($item->estimasi_selesai)
                                    {{ \Carbon\Carbon::parse($item->estimasi_selesai)->format('d-m-Y') }}
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                <span class="status {{ $statusClass }}">
                                    {{ $item->status ?? 'Menunggu' }}
                                </span>
                            </td>

                            <td>
                                Rp {{ number_format($item->total_harga ?? 0, 0, ',', '.') }}
                            </td>

                            <td>
                                <div class="action-group">
                                    <a href="{{ route('admin.pesanan.edit', $item->id_pesanan) }}"
                                       class="btn-edit">
                                        Edit
                                    </a>

                                    <a href="{{ route('admin.revisi.index', $item->id_pesanan) }}"
                                       class="btn-revisi">
                                        Revisi
                                    </a>

                                    <form
                                        action="{{ route('admin.pesanan.destroy', $item->id_pesanan) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-hapus">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="empty">
                                Belum ada data pesanan.
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