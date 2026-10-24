<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Pelanggan - JAITIN')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,400,0,0" rel="stylesheet">

    <style>
        :root {
            --primary: #b8898d;
            --primary-dark: #96696e;
            --primary-light: #f3e3e3;
            --cream: #faf6f2;
            --white: #fffdfb;
            --text: #493936;
            --muted: #927f7b;
            --border: #eee4df;
            --sidebar-width: 265px;
            --sidebar-shadow: 18px 0 50px rgba(65, 42, 39, .15);
        }

        * { box-sizing: border-box; }
        html { min-height: 100%; scroll-behavior: smooth; }
        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--text);
        }
        body.sidebar-open { overflow: hidden; }
        a { color: inherit; text-decoration: none; }
        button, input, select, textarea { font: inherit; }
        button { -webkit-tap-highlight-color: transparent; }
        button:focus-visible, a:focus-visible {
            outline: 3px solid rgba(184, 137, 141, .55);
            outline-offset: 3px;
        }

        .layout { min-height: 100vh; }
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 1100;
            display: flex;
            flex-direction: column;
            width: var(--sidebar-width);
            padding: 24px 16px 18px;
            overflow-x: hidden;
            overflow-y: auto;
            overscroll-behavior: contain;
            background: var(--white);
            border-right: 1px solid var(--border);
            box-shadow: 5px 0 24px rgba(73, 57, 54, .025);
            transform: translateX(0);
            transition: transform .28s cubic-bezier(.2,.75,.25,1), box-shadow .28s ease;
            scrollbar-width: thin;
            scrollbar-color: #e6d3d1 transparent;
        }
        .logo-area {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 66px;
            padding: 2px 8px 22px;
            margin-bottom: 24px;
            border-bottom: 1px solid var(--border);
        }
        .logo-circle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-width: 0;
        }
        .logo-circle img {
            display: block;
            width: min(100%, 190px);
            height: 48px;
            object-fit: contain;
            object-position: left center;
        }
        .menu-heading {
            padding: 0 12px;
            margin: 0 0 10px;
            color: #b4a09a;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }
        .menu { padding: 0; margin: 0; list-style: none; }
        .menu li { margin: 0 0 5px; }
        .menu a {
            position: relative;
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 47px;
            padding: 11px 13px;
            border: 1px solid transparent;
            border-radius: 12px;
            color: #806c67;
            font-size: 13px;
            font-weight: 500;
            transition: background .18s ease, color .18s ease, transform .18s ease, border-color .18s ease;
        }
        .menu a:hover {
            background: #fcf4f1;
            color: var(--primary-dark);
            transform: translateX(2px);
        }
        .menu a.active {
            background: linear-gradient(110deg, #f5e5e4, #fbf3ef);
            border-color: #f0dfdc;
            color: var(--primary-dark);
            font-weight: 700;
        }
        .menu a.active::before {
            position: absolute;
            top: 11px;
            bottom: 11px;
            left: -1px;
            width: 3px;
            border-radius: 0 4px 4px 0;
            background: var(--primary);
            content: "";
        }
        .menu-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 22px;
            width: 22px;
            height: 22px;
        }
        .menu-icon .material-symbols-rounded { font-size: 21px; font-weight: 400; }
        .menu-divider { height: 1px; margin: 20px 8px; background: var(--border); }

        .sidebar-promo {
            padding: 15px;
            margin-top: 20px;
            border: 1px solid #f0e1dc;
            border-radius: 15px;
            background: linear-gradient(145deg, #f8eae8, #fcf5ef);
        }
        .sidebar-promo .promo-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            margin-bottom: 10px;
            border-radius: 11px;
            background: rgba(184, 137, 141, .18);
            color: var(--primary-dark);
        }
        .sidebar-promo h4 { margin: 0 0 6px; color: #76575a; font-size: 12px; }
        .sidebar-promo p { margin: 0; color: #927876; font-size: 11px; line-height: 1.7; }

        .sidebar-bottom { padding-top: 22px; margin-top: auto; }
        .profile-card {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 11px 10px;
            margin-bottom: 11px;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: #fffaf7;
        }
        .profile-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 40px;
            width: 40px;
            height: 40px;
            overflow: hidden;
            border-radius: 12px;
            background: var(--primary-light);
            color: var(--primary-dark);
        }
        .profile-avatar .material-symbols-rounded { font-size: 23px; }
        .profile-details { flex: 1; min-width: 0; }
        .profile-name {
            overflow: hidden;
            color: var(--text);
            font-size: 12px;
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .profile-role { margin-top: 4px; color: var(--muted); font-size: 10px; }
        .logout button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            width: 100%;
            min-height: 44px;
            padding: 10px 12px;
            border: 1px solid #f0dede;
            border-radius: 11px;
            background: #fff8f6;
            color: #a26469;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s ease, color .2s ease, border-color .2s ease;
        }
        .logout button:hover { background: #a26469; color: #fff; border-color: #a26469; }

        .main {
            min-width: 0;
            min-height: 100vh;
            margin-left: var(--sidebar-width);
            padding: 28px 34px;
            transition: margin .25s ease;
        }
        .topbar {
            display: flex;
            align-items: center;
            gap: 16px;
            min-width: 0;
            margin-bottom: 28px;
        }
        .heading { flex: 1; min-width: 0; }
        .topbar h1 {
            margin: 0;
            color: var(--text);
            font-family: 'Playfair Display', serif;
            font-size: 27px;
            font-weight: 700;
            line-height: 1.25;
            overflow-wrap: anywhere;
        }
        .topbar p { margin: 7px 0 0; color: var(--muted); font-size: 13px; line-height: 1.6; }
        .user-info {
            display: flex;
            align-items: center;
            gap: 9px;
            flex: 0 1 auto;
            max-width: 240px;
            min-width: 0;
            padding: 10px 13px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: var(--white);
            color: var(--primary-dark);
            font-size: 12px;
            font-weight: 600;
        }
        .user-info .material-symbols-rounded { flex: 0 0 auto; font-size: 20px; }
        .user-info .user-name {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .sidebar-toggle, .sidebar-overlay { display: none; }
        .page-content { width: 100%; min-width: 0; }

        @media (max-width: 1100px) {
            :root { --sidebar-width: 245px; }
            .main { padding: 25px 22px; }
            .topbar h1 { font-size: 25px; }
            .user-info { max-width: 200px; }
        }

        @media (max-width: 800px) {
            .sidebar {
                width: min(290px, calc(100vw - 52px));
                padding: 20px 15px 16px;
                transform: translateX(-105%);
                box-shadow: none;
                visibility: hidden;
                transition: transform .28s cubic-bezier(.2,.75,.25,1), box-shadow .28s ease, visibility .28s;
            }
            .sidebar.open {
                transform: translateX(0);
                visibility: visible;
                box-shadow: var(--sidebar-shadow);
            }
            .sidebar-overlay {
                position: fixed;
                inset: 0;
                z-index: 1090;
                display: block;
                background: rgba(39, 27, 26, .48);
                -webkit-backdrop-filter: blur(3px);
                backdrop-filter: blur(3px);
                opacity: 0;
                visibility: hidden;
                pointer-events: none;
                transition: opacity .25s ease, visibility .25s ease;
            }
            .sidebar-overlay.show {
                opacity: 1;
                visibility: visible;
                pointer-events: auto;
            }
            .main { margin-left: 0; padding: 22px; }
            .sidebar-toggle {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                flex: 0 0 44px;
                width: 44px;
                height: 44px;
                border: 1px solid var(--border);
                border-radius: 13px;
                background: var(--white);
                color: var(--primary-dark);
                box-shadow: 0 3px 10px rgba(73, 57, 54, .04);
                cursor: pointer;
                transition: background .2s ease, transform .2s ease;
            }
            .sidebar-toggle:hover { background: #fbefed; }
            .sidebar-toggle:active { transform: scale(.96); }
            .sidebar-toggle .material-symbols-rounded { font-size: 24px; }
            .topbar { align-items: flex-start; gap: 12px; }
            .topbar h1 { font-size: 24px; }
            .user-info { max-width: 190px; }
        }

        @media (max-width: 520px) {
            .main { padding: 17px 14px 24px; }
            .topbar { gap: 10px; margin-bottom: 22px; }
            .sidebar-toggle { flex-basis: 41px; width: 41px; height: 41px; border-radius: 12px; }
            .topbar h1 { font-size: 21px; }
            .topbar p { margin-top: 5px; font-size: 11px; line-height: 1.5; }
            .user-info {
                flex: 0 0 100%;
                max-width: none;
                margin-left: 51px;
                margin-top: -2px;
                padding: 9px 11px;
            }
            .topbar { flex-wrap: wrap; }
            .heading { padding-top: 2px; }
        }

        @media (max-height: 700px) and (min-width: 801px) {
            .sidebar { padding-top: 17px; padding-bottom: 14px; }
            .logo-area { padding-bottom: 15px; margin-bottom: 17px; }
            .sidebar-promo { margin-top: 12px; padding: 12px; }
            .sidebar-bottom { padding-top: 14px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
            }
        }

        @yield('styles')
    </style>
</head>
<body>
<div class="layout">
    {{-- SIDEBAR PELANGGAN --}}
    <aside class="sidebar" id="sidebar" aria-label="Navigasi pelanggan" aria-hidden="true">
        <div class="logo-area">
            <div class="logo-circle">
                <img src="{{ asset('storage/logo2.png') }}" alt="Logo JAITIN"
                     onerror="this.style.display='none'">
            </div>
        </div>

        <div class="menu-heading">Menu Utama</div>
        <ul class="menu">
            <li>
                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"
                   @if(request()->routeIs('dashboard')) aria-current="page" @endif>
                    <span class="menu-icon"><span class="material-symbols-rounded">space_dashboard</span></span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pelanggan.pesanan.create') }}"
                   class="{{ request()->routeIs('pelanggan.pesanan.create') ? 'active' : '' }}"
                   @if(request()->routeIs('pelanggan.pesanan.create')) aria-current="page" @endif>
                    <span class="menu-icon"><span class="material-symbols-rounded">content_cut</span></span>
                    <span>Pesan Jasa Jahit</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pelanggan.pesanan.index') }}"
                   class="{{ request()->routeIs('pelanggan.pesanan.index', 'pelanggan.pesanan.show') ? 'active' : '' }}"
                   @if(request()->routeIs('pelanggan.pesanan.index', 'pelanggan.pesanan.show')) aria-current="page" @endif>
                    <span class="menu-icon"><span class="material-symbols-rounded">receipt_long</span></span>
                    <span>Pesanan Saya</span>
                </a>
            </li>
        </ul>

        <div class="menu-divider"></div>
        <div class="menu-heading">Layanan Saya</div>
        <ul class="menu">
            <li>
                <a href="{{ route('pelanggan.ukuran.index') }}"
                   class="{{ request()->routeIs('pelanggan.pesanan.index') ? 'active' : '' }}"
                    <span class="menu-icon"><span class="material-symbols-rounded">straighten</span></span>
                    <span>Ukuran Saya</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pelanggan.pembayaran.index') }}"
                   class="{{ request()->routeIs('pelanggan.pembayaran.index') ? 'active' : '' }}"
                    <span class="menu-icon"><span class="material-symbols-rounded">payments</span></span>
                    <span>Pembayaran</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('dashboard') }}">
                    <span class="menu-icon"><span class="material-symbols-rounded">inventory_2</span></span>
                    <span>Pengambilan</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-promo">
            <div class="promo-icon"><span class="material-symbols-rounded">styler</span></div>
            <h4>Jahitan sesuai keinginan</h4>
            <p>Pesan jahitan Anda dengan mudah dan pantau prosesnya melalui JAITIN.</p>
        </div>

        <div class="sidebar-bottom">
            <div class="profile-card">
                <div class="profile-avatar"><span class="material-symbols-rounded">person</span></div>
                <div class="profile-details">
                    <div class="profile-name">{{ Auth::user()->nama ?? 'Pelanggan' }}</div>
                    <div class="profile-role">Pelanggan JAITIN</div>
                </div>
            </div>
            <div class="logout">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">
                        <span class="material-symbols-rounded">logout</span>
                        <span>Keluar dari Akun</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <button type="button" class="sidebar-overlay" id="sidebarOverlay"
            aria-label="Tutup menu navigasi" tabindex="-1"></button>

    <main class="main">
        <header class="topbar">
            <button type="button" class="sidebar-toggle" id="sidebarToggle"
                    aria-label="Buka menu navigasi" aria-controls="sidebar"
                    aria-expanded="false">
                <span class="material-symbols-rounded" aria-hidden="true">menu</span>
            </button>

            <div class="heading">
                <h1>@yield('page-title', 'Dashboard Pelanggan')</h1>
                <p>@yield('page-description', 'Kelola pesanan dan layanan jahit Anda di JAITIN.')</p>
            </div>

            <div class="user-info">
                <span class="material-symbols-rounded" aria-hidden="true">account_circle</span>
                <span class="user-name">{{ Auth::user()->nama ?? 'Pelanggan' }}</span>
            </div>
        </header>

        <div class="page-content">
            @yield('content')
        </div>
    </main>
</div>

<script>
(function () {
    'use strict';

    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('sidebarOverlay');
    const mobileQuery = window.matchMedia('(max-width: 800px)');

    // Jangan jalankan handler jika elemen navigasi tidak ada di halaman.
    if (!sidebar || !toggle || !overlay) return;

    function openSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('show');
        document.body.classList.add('sidebar-open');
        toggle.setAttribute('aria-expanded', 'true');
        toggle.setAttribute('aria-label', 'Tutup menu navigasi');
        sidebar.setAttribute('aria-hidden', 'false');
        const icon = toggle.querySelector('.material-symbols-rounded');
        if (icon) icon.textContent = 'close';
    }

    function closeSidebar(restoreFocus) {
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
        document.body.classList.remove('sidebar-open');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.setAttribute('aria-label', 'Buka menu navigasi');
        sidebar.setAttribute('aria-hidden', mobileQuery.matches ? 'true' : 'false');
        const icon = toggle.querySelector('.material-symbols-rounded');
        if (icon) icon.textContent = 'menu';
        if (restoreFocus && mobileQuery.matches) toggle.focus();
    }

    toggle.addEventListener('click', function () {
        if (sidebar.classList.contains('open')) {
            closeSidebar(false);
        } else {
            openSidebar();
        }
    });

    overlay.addEventListener('click', function () {
        closeSidebar(true);
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && sidebar.classList.contains('open')) {
            closeSidebar(true);
        }
    });

    sidebar.querySelectorAll('.menu a').forEach(function (link) {
        link.addEventListener('click', function () {
            if (mobileQuery.matches) closeSidebar(false);
        });
    });

    function handleViewportChange() {
        if (mobileQuery.matches) {
            if (!sidebar.classList.contains('open')) {
                sidebar.setAttribute('aria-hidden', 'true');
            }
        } else {
            closeSidebar(false);
            sidebar.setAttribute('aria-hidden', 'false');
        }
    }

    if (typeof mobileQuery.addEventListener === 'function') {
        mobileQuery.addEventListener('change', handleViewportChange);
    } else {
        // Fallback untuk browser lama.
        mobileQuery.addListener(handleViewportChange);
    }
    handleViewportChange();
})();
</script>

@yield('scripts')
</body>
</html>
