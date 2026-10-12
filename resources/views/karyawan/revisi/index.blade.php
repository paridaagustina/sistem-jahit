<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Riwayat Revisi - Jaitin</title>

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

        .section {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 25px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-header h2 {
            font-size: 20px;
        }

        .btn-add {
            background: #b8898d;
            color: white;
            text-decoration: none;
            padding: 11px 17px;
            border-radius: 9px;
            font-size: 14px;
        }

        .btn-add:hover {
            background: #9f7378;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 9px;
            background: #e7f3e7;
            color: #496349;
            margin-bottom: 20px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1050px;
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

        .status.overdue {
            background: #f0d1d1;
            color: #8b4f4f;
        }

        .status.safe {
            background: #dfeadf;
            color: #557055;
        }

        .btn-edit {
            display: inline-block;
            background: #ead6ca;
            color: #79555a;
            text-decoration: none;
            padding: 7px 12px;
            border-radius: 8px;
            font-size: 12px;
        }

        .btn-edit:hover {
            background: #dfc5b8;
        }

        .btn-delete {
            border: none;
            background: #e8caca;
            color: #8b4f4f;
            padding: 7px 12px;
            border-radius: 8px;
            font-size: 12px;
            cursor: pointer;
        }

        .actions {
            display: flex;
            gap: 7px;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #927477;
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

            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->

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
                <a
                    href="{{ route('karyawan.revisi.index') }}"
                    class="{{ request()->routeIs('karyawan.revisi.*') ? 'active' : '' }}"
                >
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

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button type="submit">
                    Logout
                </button>

            </form>

        </div>

    </aside>


    <!-- MAIN -->

    <main class="main">

        <div class="topbar">

            <div>

                <h1>
                    Riwayat Revisi
                </h1>

                <p>
                    Kelola riwayat revisi dan batas waktu revisi pesanan pelanggan.
                </p>

            </div>

            <div class="user-info">
                {{ Auth::user()->nama ?? 'Karyawan' }}
            </div>

        </div>


        @if(session('success'))

            <div class="alert">
                {{ session('success') }}
            </div>

        @endif


        <div class="section">

            <div class="section-header">

                <h2>
                    Data Riwayat Revisi
                </h2>

                <a
                    href="{{ route('karyawan.revisi.create') }}"
                    class="btn-add"
                >
                    + Tambah Revisi
                </a>

            </div>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>
                            <th>No</th>
                            <th>Pelanggan</th>
                            <th>Pesanan</th>
                            <th>Keterangan</th>
                            <th>Tanggal Revisi</th>
                            <th>Batas Waktu</th>
                            <th>Biaya Revisi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($revisi as $item)

                            @php
    $terlambat = $item->batas_waktu_revisi
        && \Carbon\Carbon::parse($item->batas_waktu_revisi)
            ->startOfDay()
            ->lt(\Carbon\Carbon::today());
@endphp

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $item->pesanan->user->nama ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->pesanan->jenis_pakaian ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->keterangan ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->tanggal_revisi
                                        ? \Carbon\Carbon::parse($item->tanggal_revisi)->format('d/m/Y H:i')
                                        : '-' }}
                                </td>

                                <td>
                                    {{ $item->batas_waktu_revisi
                                        ? \Carbon\Carbon::parse($item->batas_waktu_revisi)->format('d/m/Y')
                                        : '-' }}
                                </td>

                                <td>
                                    Rp
                                    {{ number_format($item->biaya_revisi ?? 0, 0, ',', '.') }}
                                </td>

                                <td>

                                    @if($terlambat)

                                        <span class="status overdue">
                                            Melewati Batas
                                        </span>

                                    @else

                                        <span class="status safe">
                                            Dalam Batas
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="actions">

                                        <a
                                            href="{{ route('karyawan.revisi.edit', $item->id_revisi) }}"
                                            class="btn-edit"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('karyawan.revisi.destroy', $item->id_revisi) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data revisi ini?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn-delete"
                                            >
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="9"
                                    class="empty"
                                >
                                    Belum ada riwayat revisi.
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