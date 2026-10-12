```php
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Jaitin')</title>

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
            flex-shrink: 0;
            background: #b8898d;
            color: white;
            padding: 25px 18px;
            min-height: 100vh;
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

        /* =========================
           LOGOUT
        ========================= */

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
            background: #7e595e;
        }

        /* =========================
           MAIN
        ========================= */

        .main {
            flex: 1;
            min-width: 0;
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

        .topbar p {
            margin-top: 7px;
            color: #806e69;
        }

        .user-info {
            background: #fffaf5;
            padding: 11px 18px;
            border-radius: 20px;
            color: #8e6268;
        }

        /* =========================
           CONTENT
        ========================= */

        .content-box {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 30px;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 800px) {

            .sidebar {
                width: 210px;
                padding: 20px 12px;
            }

            .main {
                padding: 20px;
            }

            .topbar {
                align-items: flex-start;
                gap: 15px;
            }
        }

        @media (max-width: 600px) {

            .sidebar {
                width: 190px;
            }

            .main {
                padding: 15px;
            }

            .topbar {
                flex-direction: column;
            }
        }
    </style>

    @yield('styles')
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
                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('pelanggan.pesanan.create') }}"
                   class="{{ request()->routeIs('pelanggan.pesanan.*') ? 'active' : '' }}">
                    Pesan Jasa Jahit
                </a>
            </li>

            <li>
                <a href="{{ route('dashboard') }}">
                    Pesanan Saya
                </a>
            </li>

            <li>
                <a href="{{ route('dashboard') }}">
                    Ukuran Saya
                </a>
            </li>

            <li>
                <a href="{{ route('dashboard') }}">
                    Referensi Model
                </a>
            </li>

            <li>
                <a href="{{ route('dashboard') }}">
                    Pembayaran
                </a>
            </li>

            <li>
                <a href="{{ route('dashboard') }}">
                    Riwayat Revisi
                </a>
            </li>

            <li>
                <a href="{{ route('dashboard') }}">
                    Notifikasi
                </a>
            </li>

            <li>
                <a href="{{ route('dashboard') }}">
                    Pengambilan
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


    <!-- =========================
         MAIN
    ========================= -->

    <main class="main">

        <div class="topbar">

            <div>
                <h1>
                    @yield('page-title', 'Jaitin')
                </h1>

                <p>
                    @yield('page-description', 'Layanan jahit Jaitin.')
                </p>
            </div>

            @auth
                <div class="user-info">
                    {{ Auth::user()->nama }}
                </div>
            @endauth

        </div>


        @yield('content')

    </main>

</div>

@yield('scripts')

</body>
</html>
```