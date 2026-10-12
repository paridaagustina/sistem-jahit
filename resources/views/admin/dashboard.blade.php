<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - Jaitin</title>

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

        /* MAIN */
        .main {
            flex: 1;
            padding: 30px 35px;
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

        .admin-info {
            background: #fffaf5;
            padding: 10px 18px;
            border-radius: 20px;
            color: #8e6268;
        }

        /* STATISTICS */
        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 4px 12px rgba(120, 90, 80, 0.06);
        }

        .card-title {
            font-size: 14px;
            color: #927477;
            margin-bottom: 12px;
        }

        .card-number {
            font-size: 30px;
            font-weight: bold;
            color: #a9797e;
        }

        /* CONTENT */
        .content-box {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 25px;
        }

        .content-box h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .content-box p {
            color: #806e69;
            line-height: 1.6;
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

        .logout button:hover {
            background: #79555a;
        }

        @media (max-width: 900px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .sidebar {
                width: 210px;
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
                <img src="{{ asset('images/logo-jaitin.png') }}"
                     alt="Logo Jaitin">
            </div>

            <div class="brand">Jaitin</div>

        </div>

        <ul class="menu">

            <li>
                <a href="{{ route('admin.dashboard') }}" class="active">
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
                <a href="#">
                    Revisi
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


    <!-- MAIN CONTENT -->
    <main class="main">

        <div class="topbar">

            <div>
                <h1>Dashboard</h1>
                <p>Selamat datang di sistem Jaitin.</p>
            </div>

            <div class="admin-info">
                Admin
            </div>

        </div>


        <!-- STATISTIK -->
        <div class="cards">

            <div class="card">
                <div class="card-title">
                    Total Pelanggan
                </div>

                <div class="card-number">
                    {{ $jumlahPelanggan }}
                </div>
            </div>


            <div class="card">
                <div class="card-title">
                    Total Pesanan
                </div>

                <div class="card-number">
                    {{ $jumlahPesanan }}
                </div>
            </div>


            <div class="card">
                <div class="card-title">
                    Sedang Dikerjakan
                </div>

                <div class="card-number">
                    {{ $pesananDiproses }}
                </div>
            </div>


            <div class="card">
                <div class="card-title">
                    Pesanan Selesai
                </div>

                <div class="card-number">
                    {{ $pesananSelesai }}
                </div>
            </div>

        </div>


        <!-- INFORMASI -->
        <div class="content-box">

            <h2>Selamat Datang, Admin 👋</h2>

            <p>
                Kelola pesanan, pelanggan, ukuran, pembayaran,
                dan proses pengerjaan jahitan melalui dashboard
                sistem informasi Jaitin.
            </p>

        </div>

    </main>

</div>

</body>
</html>