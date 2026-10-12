```blade
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Revisi - Jaitin</title>

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

        /* LOGOUT */

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
           INFO PESANAN
        ========================= */

        .order-info {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .order-info h2 {
            font-size: 19px;
            margin-bottom: 15px;
            color: #5b4440;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .info-item {
            background: #f8f1eb;
            padding: 13px;
            border-radius: 10px;
        }

        .info-label {
            font-size: 12px;
            color: #927477;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 14px;
            font-weight: bold;
            color: #4b3832;
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
            gap: 15px;
        }

        .table-header h2 {
            font-size: 20px;
        }

        /* BUTTON TAMBAH */

        .btn-tambah {
            background: #b8898d;
            color: white;
            padding: 10px 18px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
        }

        .btn-tambah:hover {
            background: #9f7378;
        }

        /* BUTTON KEMBALI */

        .btn-kembali {
            background: #ead6ca;
            color: #5d4843;
            padding: 10px 18px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
        }

        .btn-kembali:hover {
            background: #dfc5b7;
        }

        /* ALERT */

        .alert-success {
            background: #e8f3e8;
            color: #4c7250;
            border: 1px solid #c9dfca;
            padding: 12px 15px;
            border-radius: 9px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error {
            background: #f8dddd;
            color: #8f4f55;
            border: 1px solid #e5bfc2;
            padding: 12px 15px;
            border-radius: 9px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* TABLE */

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
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

        /* STATUS */

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            white-space: nowrap;
        }

        .status-proses {
            background: #eee0e2;
            color: #8f5d64;
        }

        .status-selesai {
            background: #e5f1e5;
            color: #557558;
        }

        /* ACTION */

        .btn-edit {
            display: inline-block;
            background: #c9a6a0;
            color: white;
            padding: 7px 11px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 12px;
            margin-right: 4px;
        }

        .btn-edit:hover {
            background: #ad8580;
        }

        .btn-hapus {
            border: none;
            background: #8f666b;
            color: white;
            padding: 7px 11px;
            border-radius: 7px;
            font-size: 12px;
            cursor: pointer;
        }

        .btn-hapus:hover {
            background: #79545a;
        }

        /* EMPTY */

        .empty {
            text-align: center;
            padding: 30px;
            color: #927477;
        }

        /* RESPONSIVE */

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

            .info-grid {
                grid-template-columns: 1fr;
            }

            .table-header {
                flex-direction: column;
                align-items: flex-start;
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
                <a href="#"
                   class="active">
                    Revisi
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
                    Data Revisi
                </h1>

                <p>
                    Kelola revisi untuk pesanan jahit.
                </p>

            </div>

            <div class="admin-info">

                {{ Auth::user()->nama ?? 'Admin' }}

            </div>

        </div>


        <!-- INFO PESANAN -->

        <div class="order-info">

            <h2>
                Informasi Pesanan
            </h2>

            <div class="info-grid">

                <div class="info-item">

                    <div class="info-label">
                        Pelanggan
                    </div>

                    <div class="info-value">
                        {{ $pesanan->user->nama ?? '-' }}
                    </div>

                </div>


                <div class="info-item">

                    <div class="info-label">
                        Jenis Pakaian
                    </div>

                    <div class="info-value">
                        {{ $pesanan->jenis_pakaian ?? '-' }}
                    </div>

                </div>


                <div class="info-item">

                    <div class="info-label">
                        Status Pesanan
                    </div>

                    <div class="info-value">
                        {{ $pesanan->status ?? '-' }}
                    </div>

                </div>

            </div>

        </div>


        <!-- TABLE -->

        <div class="table-box">

            @if(session('success'))

                <div class="alert-success">
                    {{ session('success') }}
                </div>

            @endif


            @if(session('error'))

                <div class="alert-error">
                    {{ session('error') }}
                </div>

            @endif


            <div class="table-header">

                <h2>
                    Riwayat Revisi
                </h2>


                <div>

                    <a
                        href="{{ route('admin.pesanan.index') }}"
                        class="btn-kembali"
                    >
                        Kembali
                    </a>

                    <a
                        href="{{ route('admin.revisi.create', $pesanan->id_pesanan) }}"
                        class="btn-tambah"
                    >
                        + Tambah Revisi
                    </a>

                </div>

            </div>


            <table>

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Tanggal Revisi</th>

                        <th>Keterangan</th>

                        <th>Biaya Revisi</th>

                        <th>Batas Waktu</th>

                        <th>Pengguna</th>

                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($revisi as $item)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>


                            <td>
                                {{ $item->tanggal_revisi
                                    ? \Carbon\Carbon::parse($item->tanggal_revisi)->format('d-m-Y H:i')
                                    : '-'
                                }}
                            </td>


                            <td>
                                {{ $item->keterangan ?? '-' }}
                            </td>


                            <td>
                                Rp {{ number_format(
                                    $item->biaya_revisi ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </td>


                            <td>
                                {{ $item->batas_waktu_revisi
                                    ? \Carbon\Carbon::parse($item->batas_waktu_revisi)->format('d-m-Y')
                                    : '-'
                                }}
                            </td>


                            <td>
                                {{ $item->user->nama ?? '-' }}
                            </td>


                            <td>

                                <a
                                    href="{{ route('admin.revisi.edit', $item->id_revisi) }}"
                                    class="btn-edit"
                                >
                                    Edit
                                </a>


                                <form
                                    action="{{ route('admin.revisi.destroy', $item->id_revisi) }}"
                                    method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Yakin ingin menghapus revisi ini?');"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn-hapus"
                                    >
                                        Hapus
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
                                Belum ada data revisi untuk pesanan ini.
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