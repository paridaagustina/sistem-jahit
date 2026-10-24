<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'JAITIN - Layanan Jahit')</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #d19f94;
            --primary-dark: #98676d;
            --primary-hover: #79555a;
            --primary-light: #f5e7e2;
            --cream: #faf6f2;
            --white: #fffdfb;
            --text: #493936;
            --muted: #927f7b;
            --border: #eee1da;
            --navbar-height: 82px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 100px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--text);
            line-height: 1.6;
        }

        body.menu-open {
            overflow: hidden;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font: inherit;
        }

        img {
            max-width: 100%;
        }

        /* =========================
           NAVBAR
        ========================= */
        .user-navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
            background: rgba(255, 253, 251, .97);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 3px 18px rgba(120, 90, 80, .04);
            backdrop-filter: blur(14px);
        }

        .navbar-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 28px;
            width: 100%;
            max-width: 1400px;
            min-height: var(--navbar-height);
            padding: 10px 5%;
            margin: 0 auto;
        }

        /* LOGO */
        .navbar-brand {
            display: inline-flex;
            align-items: center;
            flex-shrink: 0;
        }

        .navbar-brand img {
            display: block;
            width: 150px;
            height: 58px;
            object-fit: contain;
        }

        /* MENU DESKTOP */
        .navbar-menu {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            list-style: none;
        }

        .navbar-menu li {
            list-style: none;
        }

        .navbar-menu a {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 10px 12px;
            border-radius: 10px;
            color: #806c67;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
            transition: background .2s ease, color .2s ease;
        }

        .navbar-menu a:hover {
            color: var(--primary-dark);
            background: #faf1ef;
        }

        .navbar-menu a.active {
            color: var(--primary-dark);
            background: linear-gradient(110deg, #f3e2e2, #fbf1ed);
            font-weight: 700;
        }

        /* TOMBOL LOGIN DAN DAFTAR */
        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .btn-login,
        .btn-register {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 10px 17px;
            border-radius: 11px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
            transition: all .2s ease;
        }

        .btn-login {
            border: 1px solid var(--border);
            background: var(--white);
            color: var(--primary-dark);
        }

        .btn-login:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .btn-register {
            border: 1px solid var(--primary-dark);
            background: var(--primary-dark);
            color: #fff;
            box-shadow: 0 4px 10px rgba(152, 103, 109, .13);
        }

        .btn-register:hover {
            border-color: var(--primary-hover);
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        /* HAMBURGER */
        .navbar-toggle {
            display: none;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 43px;
            height: 43px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--white);
            color: var(--primary-dark);
            font-size: 19px;
            cursor: pointer;
            transition: .2s ease;
        }

        .navbar-toggle:hover {
            background: var(--primary-light);
        }

        /* =========================
           KONTEN HALAMAN
        ========================= */
        .user-main {
            min-height: calc(100vh - var(--navbar-height));
        }

        .user-content {
            width: 100%;
            max-width: 1400px;
            padding: 30px 5%;
            margin: 0 auto;
        }

        /* =========================
           FOOTER
        ========================= */
        .user-footer {
            padding: 30px 5%;
            border-top: 1px solid var(--border);
            background: var(--white);
        }

        .footer-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .footer-brand {
            color: var(--primary-dark);
            font-family: 'Playfair Display', serif;
            font-size: 19px;
            font-weight: 700;
        }

        .footer-description {
            margin-top: 4px;
            color: var(--muted);
            font-size: 12px;
        }

        .footer-copy {
            color: var(--muted);
            font-size: 12px;
            text-align: right;
        }

        /* =========================
           RESPONSIVE TABLET
        ========================= */
        @media (max-width: 1150px) {
            .navbar-container {
                gap: 15px;
                padding-right: 3%;
                padding-left: 3%;
            }

            .navbar-brand img {
                width: 125px;
            }

            .navbar-menu {
                gap: 2px;
            }

            .navbar-menu a {
                padding: 9px 8px;
                font-size: 11px;
            }

            .btn-login,
            .btn-register {
                padding: 10px 12px;
                font-size: 11px;
            }
        }

        /* =========================
           RESPONSIVE MOBILE
        ========================= */
        @media (max-width: 900px) {
            :root {
                --navbar-height: 72px;
            }

            .navbar-container {
                min-height: var(--navbar-height);
                padding: 8px 5%;
            }

            .navbar-brand img {
                width: 130px;
                height: 52px;
            }

            .navbar-toggle {
                display: inline-flex;
                order: 3;
            }

            .navbar-actions {
                margin-left: auto;
            }

            .navbar-menu {
                position: absolute;
                top: calc(100% + 1px);
                right: 0;
                left: 0;
                display: none;
                flex-direction: column;
                align-items: stretch;
                gap: 5px;
                max-height: calc(100vh - var(--navbar-height));
                padding: 15px 5% 20px;
                overflow-y: auto;
                border-bottom: 1px solid var(--border);
                background: var(--white);
                box-shadow: 0 15px 25px rgba(65, 42, 39, .08);
            }

            .navbar-menu.open {
                display: flex;
            }

            .navbar-menu li {
                width: 100%;
            }

            .navbar-menu a {
                display: flex;
                justify-content: flex-start;
                width: 100%;
                min-height: 45px;
                padding: 12px 15px;
                border-radius: 10px;
                font-size: 13px;
            }

            .navbar-menu a.active::before {
                position: absolute;
                top: 10px;
                bottom: 10px;
                left: 0;
                width: 3px;
                border-radius: 0 4px 4px 0;
                background: var(--primary);
                content: "";
            }

            .user-content {
                padding: 25px 5%;
            }
        }

        @media (max-width: 520px) {
            .navbar-container {
                gap: 8px;
                padding-right: 4%;
                padding-left: 4%;
            }

            .navbar-brand img {
                width: 105px;
                height: 47px;
            }

            .navbar-actions {
                gap: 6px;
            }

            .btn-login,
            .btn-register {
                min-height: 38px;
                gap: 5px;
                padding: 8px 10px;
                border-radius: 9px;
                font-size: 11px;
            }

            .btn-login i,
            .btn-register i {
                font-size: 11px;
            }

            .navbar-toggle {
                width: 38px;
                height: 38px;
                border-radius: 10px;
                font-size: 17px;
            }

            .user-content {
                padding: 20px 4%;
            }

            .footer-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .footer-copy {
                text-align: left;
            }
        }

        @media (max-width: 370px) {
            .navbar-brand img {
                width: 82px;
            }

            .btn-login,
            .btn-register {
                padding: 8px;
                font-size: 10px;
            }

            .navbar-container {
                gap: 5px;
            }
        }

        /* CSS khusus halaman turunan */
        @yield('styles')
    </style>
</head>

<body>

    {{-- NAVBAR FREE USER --}}
    <header class="user-navbar">
        <nav class="navbar-container" aria-label="Navigasi utama">

            <a href="{{ url('/') }}" class="navbar-brand" aria-label="JAITIN Beranda">
                <img
                    src="{{ asset('storage/logo2.png') }}"
                    alt="Logo JAITIN"
                    onerror="this.style.display='none'"
                >
            </a>

            <ul class="navbar-menu" id="userNavbarMenu">
                <li>
                    <a href="{{ url('/') }}"
                       class="{{ request()->is('/') ? 'active' : '' }}">
                        Beranda
                    </a>
                </li>

                <li>
                    <a href="{{ url('/katalog-model') }}"
                       class="{{ request()->is('katalog-model*') ? 'active' : '' }}">
                        Katalog Model
                    </a>
                </li>

                <li>
                    <a href="{{ url('/layanan-jahit') }}"
                       class="{{ request()->is('layanan-jahit*') ? 'active' : '' }}">
                        Layanan Jahit
                    </a>
                </li>

                <li>
                    <a href="{{ url('/cara-pemesanan') }}"
                       class="{{ request()->is('cara-pemesanan*') ? 'active' : '' }}">
                        Cara Pemesanan
                    </a>
                </li>

                <li>
                    <a href="{{ url('/tentang-kami') }}"
                       class="{{ request()->is('tentang-kami*') ? 'active' : '' }}">
                        Tentang Kami
                    </a>
                </li>

                <li>
                    <a href="{{ url('/kontak') }}"
                       class="{{ request()->is('kontak*') ? 'active' : '' }}">
                        Kontak
                    </a>
                </li>
            </ul>

            <div class="navbar-actions">
                @guest
                    <a href="{{ route('login') }}" class="btn-login">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        <span>Masuk</span>
                    </a>

                    <a href="{{ route('register') }}" class="btn-register">
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Daftar</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-login">
                        <i class="fa-solid fa-user"></i>
                        <span>Akun Saya</span>
                    </a>
                @endguest
            </div>

            <button
                type="button"
                class="navbar-toggle"
                id="userNavbarToggle"
                aria-label="Buka menu navigasi"
                aria-controls="userNavbarMenu"
                aria-expanded="false"
            >
                <i class="fa-solid fa-bars"></i>
            </button>

        </nav>
    </header>

    {{-- KONTEN HALAMAN --}}
    <main class="user-main">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="user-footer">
        <div class="footer-container">
            <div>
                <a href="{{ url('/') }}" class="footer-brand">JAITIN</a>
                <p class="footer-description">
                    Solusi pemesanan jahitan yang mudah dan praktis.
                </p>
            </div>

            <p class="footer-copy">
                &copy; {{ date('Y') }} JAITIN. Hak cipta dilindungi.
            </p>
        </div>
    </footer>

    <script>
        const userNavbarToggle = document.getElementById('userNavbarToggle');
        const userNavbarMenu = document.getElementById('userNavbarMenu');

        function closeUserNavbar() {
            userNavbarMenu.classList.remove('open');
            userNavbarToggle.setAttribute('aria-expanded', 'false');

            const icon = userNavbarToggle.querySelector('i');
            icon.classList.remove('fa-xmark');
            icon.classList.add('fa-bars');
        }

        userNavbarToggle.addEventListener('click', function () {
            const isOpen = userNavbarMenu.classList.toggle('open');

            userNavbarToggle.setAttribute('aria-expanded', String(isOpen));

            const icon = userNavbarToggle.querySelector('i');
            icon.classList.toggle('fa-xmark', isOpen);
            icon.classList.toggle('fa-bars', !isOpen);
        });

        userNavbarMenu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', closeUserNavbar);
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth > 900) {
                closeUserNavbar();
            }
        });

        @yield('scripts')
    </script>

</body>
</html>
