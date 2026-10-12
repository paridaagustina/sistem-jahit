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
            cursor: pointer;
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
            white-space: nowrap;
        }

        /* =========================
           WELCOME
        ========================= */

        .welcome {
            background: #ead6ca;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            border: 1px solid #e1c6b8;
        }

        .welcome h2 {
            font-size: 22px;
            margin-bottom: 8px;
        }

        .welcome p {
            color: #705b55;
            line-height: 1.6;
        }

        /* =========================
           CARDS
        ========================= */

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .card {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 4px 12px rgba(120, 90, 80, 0.06);
        }

        .card h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .card p {
            color: #806e69;
            font-size: 14px;
            line-height: 1.5;
        }

        .card-number {
            font-size: 26px;
            font-weight: bold;
            color: #a46f76;
            margin-bottom: 5px;
        }

        /* =========================
           MENU CEPAT
        ========================= */

        .section {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .section h2 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .quick-menu {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        .quick-menu a {
            text-decoration: none;
            color: #4b3832;
            background: #f8f1eb;
            border: 1px solid #ead6ca;
            border-radius: 12px;
            padding: 18px;
            text-align: center;
            transition: 0.2s;
            cursor: pointer;
        }

        .quick-menu a:hover {
            background: #ead6ca;
            transform: translateY(-2px);
        }

        .icon {
            font-size: 25px;
            margin-bottom: 9px;
        }

        .quick-menu span {
            display: block;
            font-size: 14px;
            font-weight: bold;
        }

        /* =========================
           INFO
        ========================= */

        .info {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 25px;
        }

        .info h2 {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .info p {
            color: #806e69;
            line-height: 1.7;
        }

        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 1000px) {

            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .quick-menu {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 700px) {

            .layout {
                display: block;
            }

            .sidebar {
                width: 100%;
                min-height: auto;
            }

            .menu {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 5px;
            }

            .menu li {
                margin-bottom: 0;
            }

            .logout {
                margin-top: 20px;
            }

            .main {
                padding: 20px;
            }

            .topbar {
                align-items: flex-start;
                gap: 15px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .quick-menu {
                grid-template-columns: 1fr;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="layout">

    {{-- =========================
         SIDEBAR
    ========================== --}}

    <aside class="sidebar">

        <div class="logo-area">

            <div class="logo-circle">
                <img
                    src="{{ asset('images/logo-jaitin.png') }}"
                    alt="Logo Jaitin"
                    onerror="this.style.display='none'"
                >
            </div>

            <div class="brand">
                Jaitin
            </div>

        </div>


        <ul class="menu">

            <li>
                <a
                    href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"
                >
                    Dashboard
                </a>
            </li>


            <li>
                <a
                    href="{{ route('pelanggan.pesanan.create') }}"
                    class="{{ request()->routeIs('pelanggan.pesanan.create') ? 'active' : '' }}"
                >
                    Pesan Jasa Jahit
                </a>
            </li>


            {{-- Untuk sementara kembali ke dashboard --}}

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


        {{-- LOGOUT --}}

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


    {{-- =========================
         CONTENT
    ========================== --}}

    <main class="main">

        @yield('content')

    </main>

</div>

@stack('scripts')

</body>
</html>
```