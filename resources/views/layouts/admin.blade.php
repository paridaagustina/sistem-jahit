<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin JAITIN')</title>

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
            --sidebar-width: 265px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--text);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font: inherit;
        }

        .layout {
            min-height: 100vh;
        }

        /* =========================
           SIDEBAR
        ========================= */
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 1001;
            display: flex;
            flex-direction: column;
            width: var(--sidebar-width);
            padding: 26px 18px 20px;
            overflow-y: auto;
            background: var(--white);
            border-right: 1px solid var(--border);
            transition: transform .3s ease;
        }

        /* LOGO */
        .logo-area {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px 8px 25px;
            margin-bottom: 25px;
            border-bottom: 1px solid var(--border);
        }

        .logo-circle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 85px;
            overflow: hidden;
            border-radius: 15px;
            background: #fffaf5;
        }

        .logo-circle img {
            display: block;
            width: 180px;
            max-width: 100%;
            height: 75px;
            object-fit: contain;
        }

        /* JUDUL MENU */
        .menu-heading {
            padding: 0 12px;
            margin-bottom: 12px;
            color: #b4a09a;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.6px;
            text-transform: uppercase;
        }

        /* DAFTAR MENU */
        .menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
            list-style: none;
        }

        .menu li {
            width: 100%;
        }

        .menu a {
            position: relative;
            display: flex;
            align-items: center;
            gap: 13px;
            min-height: 47px;
            padding: 12px 14px;
            border-radius: 12px;
            color: #806c67;
            font-size: 13px;
            font-weight: 500;
            transition:
                background .2s ease,
                color .2s ease,
                transform .2s ease;
        }

        .menu a i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            min-width: 22px;
            font-size: 17px;
            text-align: center;
        }

        .menu a:hover {
            background: #faf1ef;
            color: var(--primary-dark);
            transform: translateX(2px);
        }

        .menu a.active {
            background: linear-gradient(110deg, #f3e2e2, #fbf1ed);
            color: var(--primary-dark);
            font-weight: 700;
        }

        .menu a.active::before {
            position: absolute;
            top: 12px;
            bottom: 12px;
            left: 0;
            width: 3px;
            border-radius: 0 4px 4px 0;
            background: var(--primary);
            content: "";
        }

        .menu-divider {
            height: 1px;
            margin: 22px 8px;
            background: var(--border);
        }

        /* INFORMASI ADMIN */
        .sidebar-info {
            margin-top: 25px;
            padding: 16px;
            border-radius: 14px;
            background: linear-gradient(145deg, #f7e9e7, #fcf4ef);
        }

        .sidebar-info-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            margin-bottom: 10px;
            border-radius: 10px;
            background: rgba(209, 159, 148, .2);
            color: var(--primary-dark);
        }

        .sidebar-info h4 {
            margin-bottom: 6px;
            color: #76575a;
            font-size: 12px;
        }

        .sidebar-info p {
            color: #927876;
            font-size: 11px;
            line-height: 1.7;
        }

        /* LOGOUT */
        .logout {
            margin-top: auto;
            padding-top: 24px;
        }

        .logout button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            min-height: 45px;
            padding: 12px;
            border: 1px solid #f0dede;
            border-radius: 11px;
            background: #fff8f6;
            color: #a26469;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s ease;
        }

        .logout button:hover {
            border-color: var(--primary-dark);
            background: var(--primary-dark);
            color: white;
        }

        /* =========================
           KONTEN UTAMA
        ========================= */
        .main {
            min-width: 0;
            min-height: 100vh;
            margin-left: var(--sidebar-width);
            padding: 30px 35px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 30px;
        }

        .topbar .heading {
            min-width: 0;
        }

        .topbar h1 {
            color: var(--text);
            font-family: 'Playfair Display', serif;
            font-size: 27px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .topbar p {
            margin-top: 7px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
            padding: 10px 15px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: var(--white);
            color: var(--primary-dark);
            font-size: 12px;
            font-weight: 600;
        }

        .admin-info i {
            font-size: 20px;
        }

        /* KONTEN HALAMAN */
        .content-box {
            padding: 25px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--white);
            box-shadow: 0 4px 12px rgba(120, 90, 80, .04);
        }

        /* TOMBOL HAMBURGER DAN OVERLAY */
        .sidebar-toggle,
        .sidebar-overlay {
            display: none;
        }

        /* =========================
           RESPONSIVE TABLET
        ========================= */
        @media (max-width: 1000px) {
            :root {
                --sidebar-width: 245px;
            }

            .main {
                padding: 25px 22px;
            }

            .topbar h1 {
                font-size: 25px;
            }
        }

        /* =========================
           RESPONSIVE MOBILE
        ========================= */
        @media (max-width: 800px) {
            .sidebar {
                width: 265px;
                max-width: 85vw;
                transform: translateX(-100%);
                box-shadow: none;
            }

            .sidebar.open {
                transform: translateX(0);
                box-shadow: 12px 0 35px rgba(65, 42, 39, .12);
            }

            .sidebar-overlay.show {
                position: fixed;
                inset: 0;
                z-index: 1000;
                display: block;
                background: rgba(48, 33, 31, .42);
                backdrop-filter: blur(2px);
            }

            .main {
                margin-left: 0;
                padding: 22px;
            }

            .sidebar-toggle {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                width: 42px;
                height: 42px;
                border: 1px solid var(--border);
                border-radius: 12px;
                background: var(--white);
                color: var(--primary-dark);
                font-size: 19px;
                cursor: pointer;
                transition: .2s ease;
            }

            .sidebar-toggle:hover {
                background: var(--primary-light);
            }

            .topbar {
                justify-content: flex-start;
                flex-wrap: wrap;
                gap: 12px;
            }

            .topbar .heading {
                flex: 1;
                min-width: 150px;
            }

            .admin-info {
                margin-left: auto;
            }
        }

        @media (max-width: 520px) {
            .main {
                padding: 17px 14px;
            }

            .topbar {
                margin-bottom: 22px;
            }

            .topbar h1 {
                font-size: 22px;
            }

            .topbar p {
                font-size: 12px;
            }

            .admin-info {
                width: 100%;
                margin-left: 0;
                padding: 10px 12px;
            }

            .content-box {
                padding: 16px;
                border-radius: 13px;
            }
        }

        /* Tempatkan CSS halaman turunan setelah CSS layout */
        @yield('styles')
    </style>
</head>

<body>
<div class="layout">

    {{-- SIDEBAR ADMIN --}}
    <aside class="sidebar" id="adminSidebar">

        <div class="logo-area">
            <div class="logo-circle">
                <img
                    src="{{ asset('storage/logo2.png') }}"
                    alt="Logo JAITIN"
                    onerror="this.style.display='none'"
                >
            </div>
        </div>

        <div class="menu-heading">Menu Utama</div>

        <ul class="menu">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.pelanggan.index') }}"
                   class="{{ request()->routeIs('admin.pelanggan.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Data Pelanggan</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.pesanan.index') }}"
                   class="{{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-clipboard-list"></i>
                    <span>Data Pesanan</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/admin/ukuran') }}"
                   class="{{ request()->is('admin/ukuran*') ? 'active' : '' }}">
                    <i class="fa-solid fa-ruler-combined"></i>
                    <span>Data Ukuran</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/admin/referensi-model') }}"
                   class="{{ request()->is('admin/referensi-model*') ? 'active' : '' }}">
                    <i class="fa-solid fa-shirt"></i>
                    <span>Referensi Model</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.pembayaran.index') }}"
                   class="{{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-credit-card"></i>
                    <span>Pembayaran</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/admin/status-pengerjaan') }}"
                   class="{{ request()->is('admin/status-pengerjaan*') ? 'active' : '' }}">
                    <i class="fa-solid fa-list-check"></i>
                    <span>Status Pengerjaan</span>
                </a>
            </li>
        </ul>

        <div class="menu-divider"></div>

        <div class="sidebar-info">
            <div class="sidebar-info-icon">
                <i class="fa-solid fa-scissors"></i>
            </div>
            <h4>Kelola JAITIN</h4>
            <p>Kelola data pelanggan, pesanan, ukuran, pembayaran, dan proses pengerjaan jahitan.</p>
        </div>

        <div class="logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar dari Akun</span>
                </button>
            </form>
        </div>

    </aside>

    {{-- OVERLAY MOBILE --}}
    <div class="sidebar-overlay" id="adminSidebarOverlay"></div>

    {{-- KONTEN UTAMA --}}
    <main class="main">

        <header class="topbar">
            <button
                type="button"
                class="sidebar-toggle"
                id="adminSidebarToggle"
                aria-label="Buka menu navigasi"
                aria-controls="adminSidebar"
                aria-expanded="false"
            >
                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="heading">
                <h1>@yield('page-title', 'Dashboard')</h1>
                <p>@yield('page-description', 'Selamat datang di sistem JAITIN.')</p>
            </div>

            @auth
                <div class="admin-info">
                    <i class="fa-solid fa-circle-user"></i>
                    <span>{{ Auth::user()->nama }}</span>
                </div>
            @endauth
        </header>

        @yield('content')
        {{-- Script dari masing-masing halaman --}}
    @yield('scripts')

    </main>
</div>

<script>
    const adminSidebar = document.getElementById('adminSidebar');
    const adminSidebarToggle = document.getElementById('adminSidebarToggle');
    const adminSidebarOverlay = document.getElementById('adminSidebarOverlay');

    function closeAdminSidebar() {
        adminSidebar.classList.remove('open');
        adminSidebarOverlay.classList.remove('show');
        adminSidebarToggle.setAttribute('aria-expanded', 'false');
    }

    adminSidebarToggle.addEventListener('click', function () {
        const isOpen = adminSidebar.classList.toggle('open');

        adminSidebarOverlay.classList.toggle('show', isOpen);
        adminSidebarToggle.setAttribute('aria-expanded', String(isOpen));
    });

    adminSidebarOverlay.addEventListener('click', closeAdminSidebar);

    // Tutup sidebar setelah memilih menu pada perangkat mobile.
    adminSidebar.querySelectorAll('.menu a').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 800) {
                closeAdminSidebar();
            }
        });
    });

    // Pastikan sidebar kembali normal ketika layar diperbesar.
    window.addEventListener('resize', function () {
        if (window.innerWidth > 800) {
            closeAdminSidebar();
        }
    });

    @yield('scripts')
</script>
</body>
</html>