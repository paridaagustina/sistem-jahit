```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Ukuran Pelanggan - Jaitin</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f8f1eb;
            color: #4b3832;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #b8898d;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            padding: 25px 18px;
            overflow-y: auto;
            z-index: 100;
        }

        .brand {
            text-align: center;
            margin-bottom: 35px;
        }

        .brand-logo {
            width: 75px;
            height: 75px;
            background: #fffaf5;
            border-radius: 50%;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #b8898d;
            font-size: 30px;
        }

        .brand h2 {
            color: white;
            font-size: 23px;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .sidebar a {
            display: block;
            padding: 13px 15px;
            border-radius: 10px;
            color: white;
            text-decoration: none;
            font-size: 15px;
            transition: background 0.2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #9f7479;
        }

        .sidebar .logout {
            margin-top: auto;
            background: #9f7479;
            text-align: center;
        }

        /* KONTEN UTAMA */
        .main-content {
            margin-left: 250px;
            padding: 30px;
            min-height: 100vh;
        }

        .container {
            max-width: 1600px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }

        h1 {
            font-size: 28px;
        }

        .subtitle {
            margin-top: 8px;
            color: #806e69;
            line-height: 1.6;
        }

        .card {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 24px;
            box-shadow: 0 4px 12px #785a5010;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            align-items: center;
        }

        .btn {
            display: inline-block;
            padding: 10px 14px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            cursor: pointer;
        }

        .primary {
            background: #b8898d;
            color: white;
        }

        .secondary {
            background: #eee0d8;
            color: #654b4c;
        }

        .danger {
            background: #f5e2df;
            color: #914d51;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 9px;
            margin-bottom: 18px;
        }

        .success {
            background: #e8f3e8;
            color: #426b47;
        }

        .error {
            background: #f8dddd;
            color: #8f4f55;
        }

        .table-wrapper {
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }

        th, td {
            padding: 14px 12px;
            border-bottom: 1px solid #ead6ca;
            text-align: left;
            font-size: 13px;
        }

        th {
            background: #f2e4dc;
            color: #654b4c;
        }

        tbody tr:hover {
            background: #fff4ed;
        }

        .empty {
            padding: 30px;
            text-align: center;
            color: #806e69;
        }

        .inline-form {
            display: inline;
        }

        @media (max-width: 800px) {
            .sidebar {
                width: 200px;
                padding: 20px 12px;
            }

            .main-content {
                margin-left: 200px;
                padding: 20px 15px;
            }

            .header {
                align-items: flex-start;
            }
        }

        @media (max-width: 520px) {
            .sidebar {
                width: 145px;
                padding: 18px 9px;
            }

            .sidebar a {
                padding: 11px 8px;
                font-size: 12px;
            }

            .brand-logo {
                width: 55px;
                height: 55px;
            }

            .brand h2 {
                font-size: 19px;
            }

            .main-content {
                margin-left: 145px;
                padding: 15px 10px;
            }

            h1 {
                font-size: 21px;
            }

            .card {
                padding: 14px;
            }
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-logo">✂</div>
            <h2>Jaitin</h2>
        </div>

        <nav class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}">
                Dashboard
            </a>

            <a href="{{ url('/admin/pelanggan') }}">
                Data Pelanggan
            </a>

            <a href="{{ route('admin.pesanan.index') }}">
                Data Pesanan
            </a>

            <a href="{{ route('admin.ukuran.index') }}" class="active">
                Data Ukuran
            </a>

            <a href="{{ url('/admin/referensi') }}">
                Referensi Model
            </a>

            <a href="{{ url('/admin/pembayaran') }}">
                Pembayaran
            </a>

            <a href="{{ url('/admin/status-pengerjaan') }}">
                Status Pengerjaan
            </a>
        </nav>

        <form action="{{ route('logout') }}" method="POST"
              style="margin-top: auto;">
            @csrf
            <button type="submit" class="btn logout"
                    style="width: 100%; color: white; border: none;">
                Logout
            </button>
        </form>
    </aside>

    {{-- KONTEN HALAMAN --}}
    <main class="main-content">
        <div class="container">

            <div class="header">
                <div>
                    <h1>Data Ukuran Pelanggan</h1>
                    <p class="subtitle">
                        Kelola data ukuran tubuh pelanggan yang tersimpan di Jaitin.
                    </p>
                </div>

                <div class="actions">
                    <a href="{{ route('admin.dashboard') }}"
                       class="btn secondary">
                        Kembali ke Dashboard
                    </a>

                    <a href="{{ route('admin.ukuran.create') }}"
                       class="btn primary">
                        + Tambah Ukuran
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert error">
                    <strong>Terjadi kesalahan:</strong>
                    <ul style="margin: 8px 0 0 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <h2>Daftar Ukuran</h2>

                <p class="subtitle">
                    Jumlah data: {{ $ukuran->count() }} ukuran
                </p>

                @if ($ukuran->isEmpty())
                    <div class="empty">
                        Belum ada data ukuran pelanggan.
                    </div>
                @else
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Panjang Baju</th>
                                    <th>Lebar Bahu</th>
                                    <th>Lingkar Dada</th>
                                    <th>Lingkar Pinggang</th>
                                    <th>Lingkar Lengan</th>
                                    <th>Tanggal Pengukuran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($ukuran as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            {{ $item->user->nama ?? 'Pelanggan tidak ditemukan' }}
                                        </td>

                                        <td>
                                            {{ $item->panjang_baju !== null ? $item->panjang_baju . ' cm' : '-' }}
                                        </td>

                                        <td>
                                            {{ $item->lebar_bahu !== null ? $item->lebar_bahu . ' cm' : '-' }}
                                        </td>

                                        <td>
                                            {{ $item->lingkar_dada !== null ? $item->lingkar_dada . ' cm' : '-' }}
                                        </td>

                                        <td>
                                            {{ $item->lingkar_pinggang !== null ? $item->lingkar_pinggang . ' cm' : '-' }}
                                        </td>

                                        <td>
                                            {{ $item->lingkar_lengan !== null ? $item->lingkar_lengan . ' cm' : '-' }}
                                        </td>

                                        <td>
                                            {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') : '-' }}
                                        </td>

                                        <td>
                                            <div class="actions">
                                                <a href="{{ route('admin.ukuran.edit', $item->id_ukuran) }}"
                                                   class="btn secondary">
                                                    Edit
                                                </a>

                                                <form class="inline-form"
                                                      action="{{ route('admin.ukuran.destroy', $item->id_ukuran) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Yakin ingin menghapus data ukuran ini?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="btn danger">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </main>

</body>
</html>
```