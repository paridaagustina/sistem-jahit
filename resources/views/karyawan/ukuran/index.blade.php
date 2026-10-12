<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ukuran Pelanggan - Jaitin</title>

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
            position: relative;
            z-index: 1000;
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
            width: 100%;
        }

        .menu li {
            list-style: none;
            margin-bottom: 8px;
            width: 100%;
        }

        .menu li a {
            display: block;
            width: 100%;
            padding: 13px 15px;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            transition: background 0.2s ease;
            cursor: pointer;
            position: relative;
            z-index: 1001;
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
            width: 100%;
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
           CONTENT
        ========================= */

        .section {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px;
        }

        .section-header h2 {
            font-size: 20px;
            color: #4b3832;
        }

        /* =========================
           BUTTON TAMBAH
        ========================= */

        .btn-add {
            display: inline-block;
            background: #b8898d;
            color: white;
            text-decoration: none;
            padding: 11px 17px;
            border-radius: 9px;
            font-size: 14px;
            transition: 0.2s;
            white-space: nowrap;
        }

        .btn-add:hover {
            background: #9f7378;
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
            min-width: 950px;
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
            white-space: nowrap;
        }

        tr:hover {
            background: #fcf5f0;
        }

        /* =========================
           BUTTON EDIT
        ========================= */

        .btn-edit {
            display: inline-block;
            background: #ead6ca;
            color: #79555a;
            text-decoration: none;
            padding: 7px 12px;
            border-radius: 8px;
            font-size: 12px;
            transition: 0.2s;
        }

        .btn-edit:hover {
            background: #dfc5b8;
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

            .section-header {
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

            <div class="role">
                Karyawan
            </div>

        </div>


        <!-- MENU SIDEBAR -->

        <ul class="menu">

            <!-- DASHBOARD -->

            <li>

                <a
                    href="{{ route('karyawan.dashboard') }}"
                    class="{{ request()->routeIs('karyawan.dashboard') ? 'active' : '' }}"
                >
                    Dashboard
                </a>

            </li>


            <!-- UKURAN PELANGGAN -->

            <li>

                <a
                    href="{{ route('karyawan.ukuran.index') }}"
                    class="{{ request()->routeIs('karyawan.ukuran.*') ? 'active' : '' }}"
                >
                    Ukuran Pelanggan
                </a>

            </li>


            <!-- RIWAYAT REVISI -->

            <li>

                <a
                    href="{{ route('karyawan.revisi.index') }}"
                    class="{{ request()->routeIs('karyawan.revisi.*') ? 'active' : '' }}"
                >
                    Riwayat Revisi
                </a>

            </li>


            <!-- STATUS PENGERJAAN -->

            <li>

                <a
    href="{{ route('karyawan.pengerjaan.index') }}"
    class="{{ request()->routeIs('karyawan.pengerjaan.*') ? 'active' : '' }}"
>
    Status Pengerjaan
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
         MAIN CONTENT
    ========================= -->

    <main class="main">


        <!-- TOPBAR -->

        <div class="topbar">

            <div>

                <h1>
                    Ukuran Pelanggan
                </h1>

                <p>
                    Kelola data ukuran pelanggan untuk kebutuhan pengerjaan jahit.
                </p>

            </div>


            <div class="user-info">

                {{ Auth::user()->nama ?? 'Karyawan' }}

            </div>

        </div>


        <!-- =========================
             DATA UKURAN
        ========================= -->

        <div class="section">

            <div class="section-header">

                <h2>
                    Data Ukuran Pelanggan
                </h2>


                <a
                    href="{{ route('karyawan.ukuran.create') }}"
                    class="btn-add"
                >
                    + Tambah Ukuran
                </a>

            </div>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                No
                            </th>

                            <th>
                                Nama Pelanggan
                            </th>

                            <th>
                                Panjang Baju
                            </th>

                            <th>
                                Lebar Bahu
                            </th>

                            <th>
                                Lingkar Dada
                            </th>

                            <th>
                                Lingkar Pinggang
                            </th>

                            <th>
                                Lingkar Lengan
                            </th>

                            <th>
                                Tanggal
                            </th>

                            <th>
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($ukuran as $item)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                <td>
                                    {{ $item->user->nama ?? '-' }}
                                </td>


                                <td>
                                    {{ $item->panjang_baju !== null ? number_format($item->panjang_baju, 2) : '-' }}
                                    cm
                                </td>


                                <td>
                                    {{ $item->lebar_bahu !== null ? number_format($item->lebar_bahu, 2) : '-' }}
                                    cm
                                </td>


                                <td>
                                    {{ $item->lingkar_dada !== null ? number_format($item->lingkar_dada, 2) : '-' }}
                                    cm
                                </td>


                                <td>
                                    {{ $item->lingkar_pinggang !== null ? number_format($item->lingkar_pinggang, 2) : '-' }}
                                    cm
                                </td>


                                <td>
                                    {{ $item->lingkar_lengan !== null ? number_format($item->lingkar_lengan, 2) : '-' }}
                                    cm
                                </td>


                                <td>
                                    {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') : '-' }}
                                </td>


                                <td>

                                    <a
                                        href="{{ route('karyawan.ukuran.edit', $item->id_ukuran) }}"
                                        class="btn-edit"
                                    >
                                        Edit
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="9"
                                    class="empty"
                                >
                                    Belum ada data ukuran pelanggan.
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