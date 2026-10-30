<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Masuk | JAITIN</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,400,0,0">

    <style>
        :root {
            --pink: #b77c82;
            --pink-dark: #986168;
            --pink-light: #f7e8e7;
            --pink-soft: #fbf1ef;
            --cream: #fcf8f4;
            --white: #ffffff;
            --brown: #49332f;
            --text: #5f4b47;
            --muted: #98837c;
            --border: #eee0da;
            --green: #648568;
            --shadow: 0 24px 70px rgba(91, 57, 51, .09);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: 'DM Sans', sans-serif;
            color: var(--brown);
            background: var(--cream);
        }

        button, input {
            font: inherit;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(420px, .95fr);
        }

        /* PANEL KIRI */

        .brand-panel {
            position: relative;
            min-height: 100vh;
            padding: 42px 8%;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: white;
            background:
                radial-gradient(circle at 8% 12%, rgba(255,255,255,.18), transparent 25%),
                linear-gradient(145deg, #c58f93 0%, #b67d83 48%, #98666e 100%);
        }

        .brand-panel::before,
        .brand-panel::after {
            content: "";
            position: absolute;
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 50%;
            pointer-events: none;
        }

        .brand-panel::before {
            width: 420px;
            height: 420px;
            top: -190px;
            right: -160px;
        }

        .brand-panel::after {
            width: 300px;
            height: 300px;
            bottom: -160px;
            left: -120px;
        }

        .brand-header,
        .brand-content,
        .brand-footer {
            position: relative;
            z-index: 1;
        }

        .brand-header {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .brand-symbol {
            width: 48px;
            height: 48px;
            display: grid;
            place-items: center;
            border-radius: 15px;
            color: var(--pink-dark);
            background: white;
            box-shadow: 0 5px 20px rgba(83, 46, 49, .10);
        }

        .brand-symbol .material-symbols-rounded {
            font-size: 29px;
        }

        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 29px;
            font-weight: 700;
            letter-spacing: -.8px;
        }

        .brand-tagline {
            margin-top: 2px;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            opacity: .85;
        }

        .brand-content {
            max-width: 540px;
            margin: 60px auto;
            width: 100%;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 14px;
            border: 1px solid rgba(255,255,255,.3);
            border-radius: 30px;
            background: rgba(255,255,255,.10);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .brand-content h1 {
            margin-top: 28px;
            font-family: 'Playfair Display', serif;
            font-size: clamp(36px, 4vw, 57px);
            line-height: 1.2;
            letter-spacing: -1.5px;
            font-weight: 600;
        }

        .brand-content h1 span {
            color: #f8e5d9;
        }

        .brand-description {
            max-width: 420px;
            margin-top: 22px;
            color: rgba(255,255,255,.88);
            font-size: 14px;
            line-height: 1.9;
        }

        .feature-list {
            display: grid;
            gap: 17px;
            margin-top: 35px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 13px;
            font-size: 13px;
            color: rgba(255,255,255,.94);
        }

        .feature-icon {
            width: 39px;
            height: 39px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            border-radius: 12px;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.12);
        }

        .feature-icon .material-symbols-rounded {
            font-size: 21px;
        }

        .brand-footer {
            padding-top: 22px;
            border-top: 1px solid rgba(255,255,255,.22);
            color: rgba(255,255,255,.8);
            font-size: 11px;
            letter-spacing: .2px;
        }

        /* PANEL LOGIN */

        .login-panel {
            min-height: 100vh;
            padding: 40px 8%;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                radial-gradient(ellipse at 100% 0%, rgba(247,232,231,.48), transparent 40%),
                var(--cream);
        }

        .login-container {
            width: 100%;
            max-width: 420px;
        }

        .mobile-brand {
            display: none;
        }

        .welcome-label {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: var(--pink-dark);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .welcome-label .material-symbols-rounded {
            font-size: 17px;
        }

        .login-heading {
            margin-top: 13px;
            font-family: 'Playfair Display', serif;
            font-size: 35px;
            line-height: 1.3;
            font-weight: 600;
            letter-spacing: -.7px;
        }

        .login-subtitle {
            margin-top: 9px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.8;
        }

        .login-form {
            margin-top: 32px;
        }

        .form-group {
            margin-bottom: 21px;
        }

        .form-label {
            display: block;
            margin-bottom: 9px;
            color: var(--brown);
            font-size: 12px;
            font-weight: 700;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            display: flex;
            color: #a58e87;
            pointer-events: none;
        }

        .input-icon .material-symbols-rounded {
            font-size: 20px;
        }

        .form-control {
            width: 100%;
            height: 51px;
            padding: 0 45px;
            outline: none;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: rgba(255,255,255,.86);
            color: var(--brown);
            font-size: 13px;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }

        .form-control::placeholder {
            color: #b4a39d;
        }

        .form-control:hover {
            border-color: #d9b9b6;
        }

        .form-control:focus {
            background: white;
            border-color: var(--pink);
            box-shadow: 0 0 0 4px rgba(183,124,130,.11);
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            width: 30px;
            height: 30px;
            display: grid;
            place-items: center;
            border: none;
            border-radius: 8px;
            background: transparent;
            color: #a58e87;
            cursor: pointer;
        }

        .password-toggle:hover {
            background: var(--pink-soft);
            color: var(--pink-dark);
        }

        .password-toggle .material-symbols-rounded {
            font-size: 20px;
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin: 2px 0 25px;
            font-size: 12px;
        }

        .remember {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text);
            cursor: pointer;
        }

        .remember input {
            width: 15px;
            height: 15px;
            accent-color: var(--pink);
            cursor: pointer;
        }

        .forgot-link {
            color: var(--pink-dark);
            font-weight: 700;
        }

        .forgot-link:hover,
        .register-link:hover {
            text-decoration: underline;
        }

        .btn {
            width: 100%;
            min-height: 51px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: transform .2s, background .2s, box-shadow .2s;
        }

        .btn:active {
            transform: scale(.99);
        }

        .btn-primary {
            border: 1px solid var(--pink);
            background: linear-gradient(135deg, #c38b90, #ad747b);
            color: white;
            box-shadow: 0 8px 18px rgba(183,124,130,.19);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #b77c82, #986168);
            box-shadow: 0 10px 23px rgba(183,124,130,.26);
        }

        .btn-primary .material-symbols-rounded {
            font-size: 19px;
        }

        /* ALERT LARAVEL */

        .alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 13px 14px;
            margin-top: 22px;
            border-radius: 11px;
            font-size: 12px;
            line-height: 1.6;
        }

        .alert .material-symbols-rounded {
            font-size: 19px;
            flex-shrink: 0;
        }

        .alert-error {
            color: #9b454b;
            background: #fff0f0;
            border: 1px solid #f2d2d3;
        }

        .alert-success {
            color: #426e4b;
            background: #edf7ed;
            border: 1px solid #d2e8d2;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 25px 0;
            color: #aa9891;
            font-size: 11px;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .btn-google {
            border: 1px solid #e6d9d3;
            background: rgba(255,255,255,.8);
            color: var(--text);
        }

        .btn-google:hover {
            background: white;
            border-color: #cdb2ad;
            box-shadow: 0 5px 16px rgba(91,57,51,.05);
        }

        .google-icon {
            width: 19px;
            height: 19px;
            object-fit: contain;
        }

        .register-text {
            margin-top: 27px;
            text-align: center;
            color: var(--muted);
            font-size: 12px;
        }

        .register-link {
            margin-left: 4px;
            color: var(--pink-dark);
            font-weight: 700;
        }

        .security-note {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            margin-top: 29px;
            color: #ad9c95;
            font-size: 10px;
        }

        .security-note .material-symbols-rounded {
            font-size: 15px;
        }

   .brand-header {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 160px;
    min-height: 90px;
    padding: 10px 18px;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(73, 51, 47, 0.10);
    position: relative;
    z-index: 1;
}

.brand-logo {
    display: block;
    width: 100%;
    max-width: 180px;
    height: 70px;
    object-fit: contain;
    object-position: center;
}

/* Logo pada tampilan HP */
.mobile-brand .brand-logo {
    width: 160px;
    height: 60px;
}

@media (max-width: 720px) {
    .mobile-brand {
        display: flex;
        align-items: center;
        margin-bottom: 46px;
    }
}

        /* RESPONSIVE */

        @media (max-width: 960px) {
            .page {
                grid-template-columns: minmax(0, .85fr) minmax(390px, 1.15fr);
            }

            .brand-panel {
                padding: 35px 7%;
            }

            .brand-content h1 {
                font-size: 39px;
            }

            .login-panel {
                padding: 35px 7%;
            }
        }

        @media (max-width: 720px) {
            .page {
                display: block;
            }

            .brand-panel {
                display: none;
            }

            .login-panel {
                min-height: 100vh;
                padding: 32px 23px;
                align-items: center;
            }

            .login-container {
                max-width: 430px;
            }

            .mobile-brand {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 46px;
            }

            .mobile-brand .brand-symbol {
                width: 45px;
                height: 45px;
                background: var(--pink-light);
            }

            .mobile-brand .brand-name {
                color: var(--brown);
                font-size: 27px;
            }

            .mobile-brand .brand-tagline {
                color: var(--muted);
                font-size: 9px;
            }

            .login-heading {
                font-size: 32px;
            }

            .login-form {
                margin-top: 27px;
            }
        }

        @media (max-width: 380px) {
            .login-panel {
                padding: 25px 17px;
            }

            .mobile-brand {
                margin-bottom: 35px;
            }

            .login-heading {
                font-size: 29px;
            }

            .form-options {
                font-size: 11px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                transition: none !important;
            }
        }
    </style>
</head>

<body>
<div class="page">

    <!-- PANEL BRANDING -->
    <aside class="brand-panel">

        <a href="{{ url('/') }}" class="brand-header">
    <img
        src="{{ asset('storage/logo2.png') }}"
        alt="Logo JAITIN"
        class="brand-logo"
    >
</a>

        <div class="brand-content">

            <div class="eyebrow">
                <span class="material-symbols-rounded">auto_awesome</span>
                Selamat Datang di JAITIN
            </div>

            <h1>
                Setiap jahitan,<br>
                punya <span>ceritanya.</span>
            </h1>

            <p class="brand-description">
                Kelola pesanan jahitan dengan lebih mudah, pantau
                proses pengerjaan, dan wujudkan hasil terbaik
                bersama JAITIN.
            </p>

            <div class="feature-list">

                <div class="feature-item">
                    <div class="feature-icon">
                        <span class="material-symbols-rounded">content_cut</span>
                    </div>
                    <span>Pengelolaan pesanan jahitan lebih praktis</span>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <span class="material-symbols-rounded">straighten</span>
                    </div>
                    <span>Pencatatan ukuran pelanggan lebih terorganisir</span>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <span class="material-symbols-rounded">task_alt</span>
                    </div>
                    <span>Pantau status pengerjaan secara terstruktur</span>
                </div>

            </div>
        </div>

        <div class="brand-footer">
            © {{ date('Y') }} JAITIN · Sistem Informasi Pemesanan Jahitan
        </div>
    </aside>


    <!-- PANEL LOGIN -->
    <main class="login-panel">
        <div class="login-container">

            <!-- Branding khusus tampilan HP -->
            <a href="{{ url('/') }}" class="mobile-brand">
    <img
        src="{{ asset('storage/logo2.png') }}"
        alt="Logo JAITIN"
        class="brand-logo"
    >
</a>

            <div class="welcome-label">
                <span class="material-symbols-rounded">waving_hand</span>
                Selamat datang kembali
            </div>

            <h2 class="login-heading">Masuk ke akun Anda</h2>

            <p class="login-subtitle">
                Silakan masukkan email dan password untuk
                melanjutkan ke dashboard JAITIN.
            </p>

            <!-- Pesan error -->
            @if ($errors->any())
                <div class="alert alert-error" role="alert">
                    <span class="material-symbols-rounded">error</span>
                    <div>{{ $errors->first() }}</div>
                </div>
            @endif

            <!-- Pesan sukses -->
            @if (session('success'))
                <div class="alert alert-success" role="status">
                    <span class="material-symbols-rounded">check_circle</span>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <form
                method="POST"
                action="{{ route('login.process') }}"
                class="login-form"
            >
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">
                        Alamat Email
                    </label>

                    <div class="input-wrapper">
                        <span class="input-icon">
                            <span class="material-symbols-rounded">mail</span>
                        </span>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            placeholder="nama@email.com"
                            value="{{ old('email') }}"
                            autocomplete="username"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        Password
                    </label>

                    <div class="input-wrapper">
                        <span class="input-icon">
                            <span class="material-symbols-rounded">lock</span>
                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="Masukkan password Anda"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            id="togglePassword"
                            aria-label="Tampilkan password"
                            aria-pressed="false"
                        >
                            <span
                                class="material-symbols-rounded"
                                id="passwordIcon"
                            >visibility</span>
                        </button>
                    </div>
                </div>

                <div class="form-options">

                    <label class="remember">
                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <span>Ingat saya</span>
                    </label>

                    {{-- Ganti # dengan route reset password jika tersedia --}}
                    <a href="#" class="forgot-link">
                        Lupa password?
                    </a>

                </div>

                <button type="submit" class="btn btn-primary">
    <span>Masuk ke JAITIN</span>
    <span class="material-symbols-rounded">arrow_forward</span>
</button>
</form>

</a>
            <div class="divider">
                <span>atau masuk dengan</span>
            </div>

            {{-- Hubungkan URL ini dengan route Google OAuth Anda --}}
            <button
                type="button"
                class="btn btn-google"
                id="googleLogin"
            >
                <svg
                    class="google-icon"
                    viewBox="0 0 48 48"
                    aria-hidden="true"
                >
                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z" transform="translate(0 4)"/>
                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.76 7.18l7.73 6C44.42 37.92 46.98 31.85 46.98 24.55z"/>
                    <path fill="#FBBC05" d="M10.53 28.59A14.4 14.4 0 0 1 9.75 24c0-1.59.27-3.13.76-4.59l-7.98-6.19A23.9 23.9 0 0 0 0 24c0 3.87.93 7.53 2.56 10.78l7.97-6.19z" transform="translate(1 0)"/>
                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.91-5.8l-7.73-6c-2.14 1.44-4.89 2.3-8.18 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z" transform="translate(0 0)"/>
                </svg>

                <span>Lanjutkan dengan Google</span>
            </button>

            <p class="register-text">
                Belum memiliki akun?
                {{-- Ganti # dengan route register jika tersedia --}}
                <a href="{{ route('register') }}" class="register-link">Daftar sekarang</a>
            </p>

            <div class="security-note">
                <span class="material-symbols-rounded">verified_user</span>
                <span>Akses akun Anda dengan aman dan nyaman</span>
            </div>

        </div>
    </main>

</div>

<script>
    // Tampilkan atau sembunyikan password
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const passwordIcon = document.getElementById('passwordIcon');

    togglePassword.addEventListener('click', function () {
        const isHidden = passwordInput.type === 'password';

        passwordInput.type = isHidden ? 'text' : 'password';
        passwordIcon.textContent = isHidden ? 'visibility_off' : 'visibility';

        togglePassword.setAttribute(
            'aria-label',
            isHidden ? 'Sembunyikan password' : 'Tampilkan password'
        );

        togglePassword.setAttribute('aria-pressed', String(isHidden));
    });

   // Arahkan pengguna ke route Google OAuth Laravel
document.getElementById('googleLogin').addEventListener('click', function () {
    window.location.href = "{{ route('google.redirect') }}";
});

</script>

</body>
</html>
