
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard Karyawan - JAITIN')</title>

    <meta name="theme-color" content="#b8898d">
    <meta name="description" content="Panel karyawan JAITIN untuk mengelola ukuran pelanggan, revisi, dan pengerjaan jahitan.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,400,0,0" rel="stylesheet">

    <style>
        :root {
            --pink: #b8898d;
            --pink-dark: #9f7378;
            --pink-deep: #80575d;
            --pink-light: #f5e5e5;
            --pink-pale: #fff6f5;
            --cream: #fcf8f4;
            --white: #ffffff;
            --text: #493b3b;
            --muted: #8c7b7b;
            --border: #eee1dc;
            --shadow: 0 8px 24px rgba(99, 65, 65, .06);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            font-family: 'Inter', Arial, sans-serif;
            background: var(--cream);
            color: var(--text);
            font-size: 14px;
            line-height: 1.6;
        }

        body.sidebar-open {
            overflow: hidden;
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }

        button,
        a {
            -webkit-tap-highlight-color: transparent;
        }

        a {
            color: inherit;
        }

        button:focus-visible,
        a:focus-visible {
            outline: 3px solid #d9aeb3;
            outline-offset: 3px;
        }

        .material-symbols-rounded {
            font-weight: normal;
            font-style: normal;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            white-space: nowrap;
            direction: ltr;
            display: inline-block;
            font-feature-settings: 'liga';
            -webkit-font-feature-settings: 'liga';
            -webkit-font-smoothing: antialiased;
            user-select: none;
        }

        /* =========================
           MAIN LAYOUT
        ========================= */

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* =========================
           MOBILE MENU BUTTON
        ========================= */

        .mobile-menu-toggle {
            display: none;
        }

        .sidebar-overlay {
            display: none;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;

            width: 260px;
            min-width: 260px;
            height: 100vh;
            min-height: 100vh;

            padding: 25px 17px 20px;
            overflow-y: auto;

            background: linear-gradient(
                180deg,
                #b8898d 0%,
                #a8797e 100%
            );

            color: var(--white);
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,.3) transparent;
        }

        .logo-area {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;

            padding: 3px 0 25px;
            margin-bottom: 23px;

            border-bottom: 1px solid rgba(255,255,255,.22);
        }

        .logo-circle {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 76px;
            height: 76px;
            margin-bottom: 11px;

            overflow: hidden;
            border-radius: 23px;

            background: #fffaf6;
            box-shadow: 0 5px 16px rgba(77,43,47,.12);
        }

        .logo-circle img {
            display: block;
            width: 88%;
            height: 88%;
            object-fit: contain;
        }

        .brand {
            color: white;
            font-size: 24px;
            line-height: 1.3;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .role {
            display: inline-flex;
            align-items: center;
            gap: 5px;

            margin-top: 8px;
            padding: 5px 12px;

            border: 1px solid rgba(255,255,255,.28);
            border-radius: 20px;

            background: rgba(255,255,255,.13);
            color: #fff9f7;

            font-size: 11px;
            font-weight: 600;
            letter-spacing: .4px;
        }

        .role .material-symbols-rounded {
            font-size: 15px;
        }

        .menu-label {
            padding: 0 12px;
            margin-bottom: 10px;

            color: rgba(255,255,255,.68);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 6px;

            width: 100%;
            list-style: none;
        }

        .menu li {
            width: 100%;
            list-style: none;
        }

        .menu li a {
            position: relative;

            display: flex;
            align-items: center;
            gap: 12px;

            width: 100%;
            min-height: 46px;
            padding: 12px 13px;

            border-radius: 11px;

            color: rgba(255,255,255,.9);
            text-decoration: none;

            font-size: 13px;
            font-weight: 500;

            transition:
                background .2s ease,
                color .2s ease,
                transform .2s ease;
        }

        .menu li a .material-symbols-rounded {
            flex-shrink: 0;
            font-size: 21px;
        }

        .menu li a:hover {
            color: white;
            background: rgba(255,255,255,.13);
            transform: translateX(2px);
        }

        .menu li a.active {
            color: var(--pink-deep);
            background: #fffaf7;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(70,40,43,.08);
        }

        .menu li a.active::before {
            content: '';

            position: absolute;
            top: 25%;
            left: -17px;

            width: 4px;
            height: 50%;

            border-radius: 0 5px 5px 0;
            background: #fffaf7;
        }

        /* =========================
           SIDEBAR FOOTER
        ========================= */

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 25px;
        }

        .sidebar-note {
            padding: 13px;
            margin-bottom: 16px;

            border: 1px solid rgba(255,255,255,.16);
            border-radius: 12px;

            background: rgba(255,255,255,.08);
            color: rgba(255,255,255,.85);

            font-size: 11px;
            line-height: 1.7;
        }

        .sidebar-note strong {
            display: flex;
            align-items: center;
            gap: 7px;

            margin-bottom: 5px;
            color: white;
            font-size: 12px;
        }

        .sidebar-note strong .material-symbols-rounded {
            font-size: 17px;
        }

        .logout,
        .logout form {
            width: 100%;
        }

        .logout button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;

            width: 100%;
            padding: 12px;

            border: 1px solid rgba(255,255,255,.23);
            border-radius: 11px;

            background: rgba(92,47,53,.22);
            color: white;

            cursor: pointer;
            font-size: 13px;
            font-weight: 600;

            transition: background .2s ease;
        }

        .logout button:hover {
            background: rgba(92,47,53,.4);
        }

        .logout button .material-symbols-rounded {
            font-size: 20px;
        }

        /* =========================
           MAIN CONTENT
        ========================= */

        .main {
            flex: 1;
            min-width: 0;
            padding: 30px 34px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;

            margin-bottom: 27px;
        }

        .topbar-heading {
            min-width: 0;
        }

        .topbar h1 {
            color: var(--text);
            font-size: 25px;
            font-weight: 800;
            line-height: 1.4;
            letter-spacing: -.7px;
            overflow-wrap: anywhere;
        }

        .topbar p {
            margin-top: 5px;
            color: var(--muted);
            font-size: 13px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 11px;
            flex-shrink: 0;

            max-width: 260px;
            padding: 9px 14px 9px 9px;

            border: 1px solid var(--border);
            border-radius: 14px;

            background: var(--white);
            box-shadow: 0 3px 12px rgba(99,65,65,.03);
        }

        .user-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;

            width: 39px;
            height: 39px;

            border-radius: 12px;
            background: var(--pink-light);
            color: var(--pink-deep);
        }

        .user-avatar .material-symbols-rounded {
            font-size: 23px;
        }

        .user-text {
            min-width: 0;
        }

        .user-text strong {
            display: block;
            max-width: 180px;

            overflow: hidden;
            color: var(--text);

            font-size: 12px;
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .user-text span {
            display: block;
            color: var(--muted);
            font-size: 11px;
        }

        /* =========================
           CONTENT AREA
        ========================= */

        .content-area {
            width: 100%;
            min-width: 0;
        }

        /* =========================
           WELCOME BANNER
        ========================= */

        .welcome {
            position: relative;
            overflow: hidden;

            padding: 28px 29px;
            margin-bottom: 25px;

            border: 1px solid #ead1d1;
            border-radius: 18px;

            background: linear-gradient(
                115deg,
                #f5e4e3 0%,
                #fff6f0 100%
            );
        }

        .welcome::after {
            content: '✂';

            position: absolute;
            top: 50%;
            right: 32px;

            transform: translateY(-50%) rotate(-15deg);

            color: rgba(159,115,120,.16);
            font-size: 90px;
            line-height: 1;

            pointer-events: none;
        }

        .welcome-content {
            position: relative;
            z-index: 1;
            max-width: 80%;
        }

        .welcome-label {
            display: inline-block;
            margin-bottom: 8px;

            color: var(--pink-deep);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .welcome h2 {
            margin-bottom: 7px;
            color: #563e42;
            font-size: 22px;
            font-weight: 800;
        }

        .welcome p {
            max-width: 650px;
            color: #806b6b;
            font-size: 13px;
            line-height: 1.8;
        }

        /* =========================
           SUMMARY CARDS
        ========================= */

        .cards {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 17px;

            margin-bottom: 26px;
        }

        .card {
            position: relative;
            overflow: hidden;

            min-width: 0;
            padding: 21px;

            border: 1px solid var(--border);
            border-radius: 15px;

            background: var(--white);
            box-shadow: var(--shadow);

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(99,65,65,.09);
        }

        .card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;

            margin-bottom: 15px;
        }

        .card-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;

            width: 42px;
            height: 42px;

            border-radius: 12px;
            background: var(--pink-light);
            color: var(--pink-deep);
        }

        .card-icon .material-symbols-rounded {
            font-size: 23px;
        }

        .card-number {
            color: var(--pink-deep);
            font-size: 29px;
            font-weight: 800;
            line-height: 1.2;
            overflow-wrap: anywhere;
        }

        .card h3 {
            margin-bottom: 5px;
            color: var(--text);
            font-size: 13px;
            font-weight: 700;
        }

        .card p {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
        }

        /* =========================
           SECTION & PANELS
        ========================= */

        .section,
        .table-box {
            min-width: 0;
            padding: 24px;
            margin-bottom: 25px;

            border: 1px solid var(--border);
            border-radius: 16px;

            background: var(--white);
            box-shadow: var(--shadow);
        }

        .section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;

            margin-bottom: 19px;
        }

        .section-heading h2,
        .table-box h2 {
            color: var(--text);
            font-size: 17px;
            font-weight: 800;
        }

        .section-heading p {
            margin-top: 4px;
            color: var(--muted);
            font-size: 12px;
        }

        .section-tag {
            flex-shrink: 0;
            padding: 6px 10px;

            border-radius: 8px;
            background: var(--pink-light);
            color: var(--pink-deep);

            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        /* =========================
           QUICK MENU
        ========================= */

        .quick-menu {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 15px;
        }

        .quick-menu a {
            display: flex;
            align-items: center;
            gap: 13px;

            min-width: 0;
            padding: 17px;

            border: 1px solid var(--border);
            border-radius: 13px;

            background: #fffdfb;
            color: var(--text);
            text-decoration: none;

            transition:
                border-color .2s ease,
                background .2s ease,
                transform .2s ease;
        }

        .quick-menu a:hover {
            transform: translateY(-2px);
            border-color: #d9b5b8;
            background: #fff7f5;
        }

        .quick-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;

            width: 45px;
            height: 45px;

            border-radius: 12px;
            background: var(--pink-light);
            color: var(--pink-deep);
        }

        .quick-icon .material-symbols-rounded {
            font-size: 24px;
        }

        .quick-text {
            flex: 1;
            min-width: 0;
        }

        .quick-text strong {
            display: block;
            margin-bottom: 3px;
            font-size: 12px;
            font-weight: 700;
        }

        .quick-text span {
            display: block;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.6;
        }

        .quick-arrow {
            flex-shrink: 0;
            color: #b89a9a;
            font-size: 19px;
        }

        /* =========================
           TABLE
        ========================= */

        .table-box {
            overflow: hidden;
        }

        .table-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;

            margin-bottom: 18px;
        }

        .table-heading p {
            margin-top: 4px;
            color: var(--muted);
            font-size: 12px;
        }

        .table-count {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            flex-shrink: 0;

            padding: 6px 10px;

            border: 1px solid var(--border);
            border-radius: 9px;

            color: var(--pink-deep);
            background: #fffaf8;

            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;

            border: 1px solid var(--border);
            border-radius: 12px;

            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            min-width: 700px;
            border-collapse: collapse;
        }

        thead th {
            padding: 13px 15px;
            background: #fbf0ed;
            color: #72585a;

            text-align: left;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        tbody td {
            padding: 14px 15px;

            border-bottom: 1px solid #f2e8e3;
            color: #675656;

            font-size: 12px;
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #fffaf8;
        }

        .table-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            width: 27px;
            height: 27px;

            border-radius: 8px;
            background: #f8eeee;
            color: var(--pink-deep);

            font-size: 11px;
            font-weight: 700;
        }

        .customer-name {
            color: var(--text);
            font-weight: 700;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 5px 10px;

            border: 1px solid #ead5d5;
            border-radius: 20px;

            background: #fbefef;
            color: #8b5d63;

            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status::before {
            content: '';
            width: 6px;
            height: 6px;
            flex-shrink: 0;
            border-radius: 50%;
            background: currentColor;
        }

        .empty {
            padding: 35px 20px !important;
            color: var(--muted);
            text-align: center;
        }

        .empty .material-symbols-rounded {
            display: block;
            margin-bottom: 8px;
            color: #c6a3a5;
            font-size: 30px;
        }

        /* =========================
           ALERT / FLASH MESSAGE
        ========================= */

        .alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;

            padding: 14px 16px;
            margin-bottom: 20px;

            border: 1px solid var(--border);
            border-radius: 12px;

            background: var(--white);
            color: var(--text);
            font-size: 13px;
        }

        .alert .material-symbols-rounded {
            flex-shrink: 0;
            font-size: 20px;
        }

        .alert-success {
            border-color: #cfe5d8;
            background: #f0faf3;
            color: #326c4d;
        }

        .alert-error {
            border-color: #f0cccc;
            background: #fff3f3;
            color: #9a4545;
        }

        /* =========================
           RESPONSIVE TABLET
        ========================= */

        @media (max-width: 1200px) {
            .main {
                padding: 26px 24px;
            }

            .cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .quick-menu {
                grid-template-columns: 1fr;
            }
        }

        /* =========================
           RESPONSIVE MOBILE NAVIGATION
        ========================= */

        @media (max-width: 850px) {
            .layout {
                display: block;
                min-height: 100vh;
            }

            .mobile-menu-toggle {
                position: sticky;
                top: 10px;
                z-index: 90;

                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;

                min-height: 42px;
                margin: 10px 14px 0;
                padding: 9px 14px;

                border: 1px solid #ead1d1;
                border-radius: 12px;

                background: white;
                color: var(--pink-deep);
                box-shadow: 0 4px 15px rgba(99,65,65,.08);

                font-size: 12px;
                font-weight: 700;
                cursor: pointer;
            }

            .mobile-menu-toggle .material-symbols-rounded {
                font-size: 21px;
            }

            .sidebar-overlay {
                position: fixed;
                inset: 0;
                z-index: 110;

                display: block;

                background: rgba(45,29,32,.45);
                opacity: 0;
                visibility: hidden;

                transition:
                    opacity .25s ease,
                    visibility .25s ease;
            }

            .sidebar-overlay.is-visible {
                opacity: 1;
                visibility: visible;
            }

            .sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                z-index: 120;

                width: min(290px, 85vw);
                min-width: 0;
                height: 100vh;
                height: 100dvh;
                min-height: 0;

                padding: 23px 17px;
                overflow-y: auto;

                transform: translateX(-105%);
                visibility: hidden;

                box-shadow: none;

                transition:
                    transform .25s ease,
                    visibility .25s ease;
            }

            .sidebar.is-open {
                transform: translateX(0);
                visibility: visible;
                box-shadow: 15px 0 45px rgba(60,35,38,.15);
            }

            .logo-area {
                flex-direction: row;
                align-items: center;
                gap: 12px;

                padding: 0 0 19px;
                margin-bottom: 19px;

                text-align: left;
            }

            .logo-circle {
                width: 52px;
                height: 52px;
                flex-shrink: 0;

                margin: 0;
                border-radius: 15px;
            }

            .brand {
                font-size: 20px;
            }

            .role {
                margin-top: 4px;
                padding: 4px 9px;
                font-size: 10px;
            }

            .menu-label {
                padding-left: 3px;
                margin-bottom: 9px;
            }

            .menu {
                display: flex;
                flex-direction: column;
                gap: 5px;
            }

            .menu li {
                margin: 0;
            }

            .menu li a {
                min-height: 45px;
                padding: 12px;
                font-size: 12px;
            }

            .menu li a.active::before {
                display: block;
                left: -17px;
            }

            .sidebar-bottom {
                margin-top: auto;
                padding-top: 24px;
            }

            .sidebar-note {
                display: block;
            }

            .logout {
                max-width: none;
                margin-left: 0;
            }

            .main {
                padding: 21px 20px 28px;
            }
        }

        /* =========================
           SMALL MOBILE
        ========================= */

        @media (max-width: 560px) {
            .mobile-menu-toggle {
                top: 7px;
                min-height: 40px;
                margin: 8px 12px 0;
                padding: 8px 12px;
            }

            .main {
                padding: 19px 13px 25px;
            }

            .topbar {
                align-items: stretch;
                flex-direction: column;
                gap: 13px;
                margin-bottom: 20px;
            }

            .topbar h1 {
                font-size: 22px;
                letter-spacing: -.5px;
            }

            .topbar p {
                font-size: 12px;
            }

            .user-info {
                width: 100%;
                max-width: none;
            }

            .user-text strong {
                max-width: 230px;
            }

            .welcome {
                padding: 21px 18px;
                margin-bottom: 18px;
                border-radius: 16px;
            }

            .welcome-content {
                max-width: 100%;
            }

            .welcome::after {
                top: 15px;
                right: 12px;
                transform: rotate(-15deg);
                font-size: 55px;
            }

            .welcome-label {
                font-size: 9px;
            }

            .welcome h2 {
                max-width: 85%;
                font-size: 19px;
            }

            .welcome p {
                font-size: 12px;
                line-height: 1.75;
            }

            .cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px;
                margin-bottom: 18px;
            }

            .card {
                padding: 15px;
                border-radius: 13px;
            }

            .card-top {
                margin-bottom: 11px;
            }

            .card-icon {
                width: 35px;
                height: 35px;
                border-radius: 10px;
            }

            .card-icon .material-symbols-rounded {
                font-size: 20px;
            }

            .card-number {
                font-size: 25px;
            }

            .card h3 {
                font-size: 12px;
            }

            .card p {
                font-size: 10px;
                line-height: 1.6;
            }

            .section,
            .table-box {
                padding: 16px 13px;
                margin-bottom: 18px;
                border-radius: 14px;
            }

            .section-heading h2,
            .table-box h2 {
                font-size: 15px;
            }

            .section-heading p,
            .table-heading p {
                font-size: 11px;
            }

            .section-tag {
                padding: 5px 8px;
                font-size: 9px;
            }

            .quick-menu {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .quick-menu a {
                gap: 11px;
                padding: 13px;
            }

            .quick-icon {
                width: 41px;
                height: 41px;
                border-radius: 11px;
            }

            .quick-text strong {
                font-size: 12px;
            }

            .quick-text span {
                font-size: 10px;
            }

            .table-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .table-count {
                font-size: 10px;
            }

            table {
                min-width: 650px;
            }

            thead th,
            tbody td {
                padding: 12px;
            }
        }

        @media (max-width: 350px) {
            .cards {
                grid-template-columns: 1fr;
            }

            .welcome h2 {
                max-width: 100%;
                font-size: 18px;
            }

            .card {
                padding: 17px;
            }
        }

        /* =========================
           ACCESSIBILITY
        ========================= */

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="layout">

    {{-- MOBILE MENU BUTTON --}}
    <button
        type="button"
        class="mobile-menu-toggle"
        id="mobileMenuToggle"
        aria-label="Buka menu navigasi"
        aria-controls="karyawanSidebar"
        aria-expanded="false"
    >
        <span class="material-symbols-rounded">menu</span>
        <span>Menu Navigasi</span>
    </button>

    {{-- MOBILE OVERLAY --}}
    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
        aria-hidden="true"
    ></div>

    {{-- SIDEBAR --}}
    <aside class="sidebar" id="karyawanSidebar">

        <div class="logo-area">
            <div class="logo-circle">
                <img
                    src="{{ asset('storage/logo2.png') }}"
                    alt="Logo JAITIN"
                >
            </div>

            <div>
                <div class="brand">JAITIN</div>

                <div class="role">
                    <span class="material-symbols-rounded">badge</span>
                    Panel Karyawan
                </div>
            </div>
        </div>

        <div class="menu-label">Menu Utama</div>

        <ul class="menu">

            {{-- DASHBOARD --}}
            <li>
                <a
                    href="{{ route('karyawan.dashboard') }}"
                    class="{{ request()->routeIs('karyawan.dashboard') ? 'active' : '' }}"
                    @if(request()->routeIs('karyawan.dashboard')) aria-current="page" @endif
                >
                    <span class="material-symbols-rounded">dashboard</span>
                    <span>Dashboard</span>
                </a>
            </li>

            {{-- UKURAN PELANGGAN --}}
            <li>
                <a
                    href="{{ route('karyawan.ukuran.index') }}"
                    class="{{ request()->routeIs('karyawan.ukuran.*') ? 'active' : '' }}"
                    @if(request()->routeIs('karyawan.ukuran.*')) aria-current="page" @endif
                >
                    <span class="material-symbols-rounded">straighten</span>
                    <span>Ukuran Pelanggan</span>
                </a>
            </li>

            {{-- RIWAYAT REVISI --}}
            <li>
                <a
                    href="{{ route('karyawan.revisi.index') }}"
                    class="{{ request()->routeIs('karyawan.revisi.*') ? 'active' : '' }}"
                    @if(request()->routeIs('karyawan.revisi.*')) aria-current="page" @endif
                >
                    <span class="material-symbols-rounded">history</span>
                    <span>Riwayat Revisi</span>
                </a>
            </li>

            {{-- STATUS PENGERJAAN --}}
            <li>
                <a
                    href="{{ route('karyawan.pengerjaan.index') }}"
                    class="{{ request()->routeIs('karyawan.pengerjaan.*') ? 'active' : '' }}"
                    @if(request()->routeIs('karyawan.pengerjaan.*')) aria-current="page" @endif
                >
                    <span class="material-symbols-rounded">content_cut</span>
                    <span>Status Pengerjaan</span>
                </a>
            </li>

        </ul>

        {{-- SIDEBAR FOOTER --}}
        <div class="sidebar-bottom">

            <div class="sidebar-note">
                <strong>
                    <span class="material-symbols-rounded">checkroom</span>
                    Ruang Kerja JAITIN
                </strong>

                Kelola ukuran pelanggan, catat revisi, dan pantau proses pengerjaan jahitan dengan lebih mudah.
            </div>

            <div class="logout">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit">
                        <span class="material-symbols-rounded">logout</span>
                        Keluar dari Akun
                    </button>
                </form>
            </div>

        </div>

    </aside>

    {{-- MAIN CONTENT --}}
    <main class="main">

        {{-- TOPBAR --}}
        <header class="topbar">

            <div class="topbar-heading">
                <h1>@yield('page-title', 'Dashboard Karyawan')</h1>

                <p>
                    @yield(
                        'page-description',
                        'Kelola ukuran, revisi, dan proses pengerjaan pesanan.'
                    )
                </p>
            </div>

            <div class="user-info">

                <div class="user-avatar">
                    <span class="material-symbols-rounded">person</span>
                </div>

                <div class="user-text">
                    <strong>{{ Auth::user()->nama ?? 'Karyawan' }}</strong>
                    <span>Area Karyawan</span>
                </div>

            </div>

        </header>

        {{-- FLASH MESSAGES --}}
        @if(session('success'))
            <div class="alert alert-success" role="status">
                <span class="material-symbols-rounded">check_circle</span>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error" role="alert">
                <span class="material-symbols-rounded">error</span>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        {{-- PAGE CONTENT --}}
        <div class="content-area">
            @yield('content')
        </div>

    </main>

</div>

{{-- MOBILE SIDEBAR SCRIPT --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('karyawanSidebar');
        const toggle = document.getElementById('mobileMenuToggle');
        const overlay = document.getElementById('sidebarOverlay');

        if (!sidebar || !toggle || !overlay) {
            return;
        }

        function openMenu() {
            sidebar.classList.add('is-open');
            overlay.classList.add('is-visible');
            document.body.classList.add('sidebar-open');

            toggle.setAttribute('aria-expanded', 'true');
            toggle.setAttribute('aria-label', 'Tutup menu navigasi');
        }

        function closeMenu() {
            sidebar.classList.remove('is-open');
            overlay.classList.remove('is-visible');
            document.body.classList.remove('sidebar-open');

            toggle.setAttribute('aria-expanded', 'false');
            toggle.setAttribute('aria-label', 'Buka menu navigasi');
        }

        toggle.addEventListener('click', function () {
            if (sidebar.classList.contains('is-open')) {
                closeMenu();
            } else {
                openMenu();
            }
        });

        overlay.addEventListener('click', closeMenu);

        sidebar.querySelectorAll('.menu a').forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.innerWidth <= 850) {
                    closeMenu();
                }
            });
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeMenu();
            }
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth > 850) {
                closeMenu();
            }
        });
    });
</script>

@stack('scripts')

</body>
</html>
