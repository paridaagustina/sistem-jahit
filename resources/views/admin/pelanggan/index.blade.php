```blade
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Pelanggan - Jaitin</title>

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


        /* MENU */

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


        /* TOPBAR */

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
           TABLE BOX
        ========================= */

        .table-box {
            background: #fffaf5;

            border: 1px solid #ead6ca;

            border-radius: 15px;

            padding: 25px;

            box-shadow:
                0 4px 12px rgba(120, 90, 80, 0.06);

            overflow-x: auto;
        }


        /* HEADER */

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


        /* TAMBAH */

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


        /* =========================
           ALERT
        ========================= */

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


        /* =========================
           VALIDATION
        ========================= */

        .validation-error {
            background: #f8dddd;

            color: #8f4f55;

            border: 1px solid #e5bfc2;

            padding: 12px 15px;

            border-radius: 9px;

            margin-bottom: 20px;

            font-size: 14px;
        }


        /* =========================
           TABLE
        ========================= */

        table {
            width: 100%;

            border-collapse: collapse;

            min-width: 850px;
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
           ROLE
        ========================= */

        .role {
            display: inline-block;

            padding: 6px 10px;

            border-radius: 20px;

            background: #eee0e2;

            color: #8f5d64;

            font-size: 12px;
        }


        /* =========================
           ACTION
        ========================= */

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


        /* =========================
           RESPONSIVE
        ========================= */

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


            <!-- DASHBOARD -->

            <li>

                <a href="{{ route('admin.dashboard') }}">

                    Dashboard

                </a>

            </li>


            <!-- PELANGGAN -->

            <li>

                <a
                    href="{{ route('admin.pelanggan.index') }}"
                    class="active"
                >

                    Data Pelanggan

                </a>

            </li>


            <!-- PESANAN -->

            <li>

                <a href="{{ route('admin.pesanan.index') }}">

                    Data Pesanan

                </a>

            </li>


            <!-- DATA UKURAN -->

            <li>

                <a href="#">

                    Data Ukuran

                </a>

            </li>


            <!-- REFERENSI MODEL -->

            <li>

                <a href="#">

                    Referensi Model

                </a>

            </li>


            <!-- PEMBAYARAN -->

            <li>

                <a href="#">

                    Pembayaran

                </a>

            </li>


            <!-- LAPORAN -->

            <li>

                <a href="#">

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
                    Data Pelanggan
                </h1>

                <p>
                    Kelola data pelanggan Jaitin.
                </p>

            </div>


            <div class="admin-info">

                {{ Auth::user()->nama ?? 'Admin' }}

            </div>

        </div>


        <!-- =========================
             TABLE BOX
        ========================= -->

        <div class="table-box">


            <!-- SUCCESS -->

            @if(session('success'))

                <div class="alert-success">

                    {{ session('success') }}

                </div>

            @endif


            <!-- ERROR -->

            @if(session('error'))

                <div class="alert-error">

                    {{ session('error') }}

                </div>

            @endif


            <!-- VALIDATION -->

            @if($errors->any())

                <div class="validation-error">

                    <strong>
                        Terjadi kesalahan:
                    </strong>

                    <ul style="margin-top: 8px; margin-left: 20px;">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- HEADER -->

            <div class="table-header">

                <h2>
                    Daftar Pelanggan
                </h2>


                <a
                    href="{{ route('admin.pelanggan.create') }}"
                    class="btn-tambah"
                >

                    + Tambah Pelanggan

                </a>

            </div>


            <!-- =========================
                 TABLE
            ========================= -->

            <table>

                <thead>

                    <tr>

                        <th>
                            No
                        </th>

                        <th>
                            Nama
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            No. HP
                        </th>

                        <th>
                            Alamat
                        </th>

                        <th>
                            Role
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>


                    @forelse($pelanggan as $item)

                        <tr>


                            <!-- NO -->

                            <td>

                                {{ $loop->iteration }}

                            </td>


                            <!-- NAMA -->

                            <td>

                                {{ $item->nama ?? '-' }}

                            </td>


                            <!-- EMAIL -->

                            <td>

                                {{ $item->email ?? '-' }}

                            </td>


                            <!-- NO HP -->

                            <td>

                                {{ $item->no_hp ?? '-' }}

                            </td>


                            <!-- ALAMAT -->

                            <td>

                                {{ $item->alamat ?? '-' }}

                            </td>


                            <!-- ROLE -->

                            <td>

                                <span class="role">

                                    {{ ucfirst($item->role ?? 'pelanggan') }}

                                </span>

                            </td>


                            <!-- AKSI -->

                            <td>


                                <!-- EDIT -->

                                <a
                                    href="{{ route(
                                        'admin.pelanggan.edit',
                                        $item->id_user
                                    ) }}"
                                    class="btn-edit"
                                >

                                    Edit

                                </a>


                                <!-- HAPUS -->

                                <form
                                    action="{{ route(
                                        'admin.pelanggan.destroy',
                                        $item->id_user
                                    ) }}"
                                    method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm(
                                        'Yakin ingin menghapus pelanggan ini?'
                                    );"
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

                                Belum ada data pelanggan.

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