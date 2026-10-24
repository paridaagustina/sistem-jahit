<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Akun | JAITIN</title>

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

        a {
            color: inherit;
            text-decoration: none;
        }

        input, button {
            font: inherit;
        }

        .page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(420px, .95fr);
        }

        /* PANEL BRANDING DESKTOP */

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

        .brand-content {
            max-width: 540px;
            width: 100%;
            margin: 50px auto;
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

        .eyebrow .material-symbols-rounded {
            font-size: 17px;
        }

        .brand-content h1 {
            margin-top: 28px;
            font-family: 'Playfair Display', serif;
            font-size: clamp(36px, 4vw, 55px);
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
            margin-top: 32px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 13px;
            color: rgba(255,255,255,.94);
            font-size: 13px;
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
        }

        /* PANEL REGISTER */

        .register-panel {
            min-height: 100vh;
            padding: 35px 8%;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                radial-gradient(ellipse at 100% 0%, rgba(247,232,231,.48), transparent 40%),
                var(--cream);
        }

        .register-container {
            width: 100%;
            max-width: 430px;
            padding: 10px 0;
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

        .register-heading {
            margin-top: 12px;
            font-family: 'Playfair Display', serif;
            font-size: 34px;
            line-height: 1.3;
            font-weight: 600;
            letter-spacing: -.7px;
        }

        .register-subtitle {
            margin-top: 8px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.8;
        }

        .register-form {
            margin-top: 25px;
        }

        .form-group {
            margin-bottom: 17px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
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
            left: 14px;
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
            height: 48px;
            padding: 0 44px;
            outline: none;
            border: 1px solid var(--border);
            border-radius: 11px;
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
            right: 10px;
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
            font-size: 19px;
        }

        .btn-register {
            width: 100%;
            min-height: 49px;
            margin-top: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 1px solid var(--pink);
            border-radius: 11px;
            background: linear-gradient(135deg, #c38b90, #ad747b);
            color: white;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(183,124,130,.19);
            transition: background .2s, box-shadow .2s, transform .2s;
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #b77c82, #986168);
            box-shadow: 0 10px 23px rgba(183,124,130,.26);
        }

        .btn-register:active {
            transform: scale(.99);
        }

        .btn-register .material-symbols-rounded {
            font-size: 19px;
        }

        /* ALERT */

        .error-box,
        .success-box {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 13px 14px;
            margin-top: 20px;
            border-radius: 11px;
            font-size: 12px;
            line-height: 1.7;
        }

        .error-box {
            color: #9b454b;
            background: #fff0f0;
            border: 1px solid #f2d2d3;
        }

        .success-box {
            color: #426e4b;
            background: #edf7ed;
            border: 1px solid #d2e8d2;
        }

        .alert-icon {
            flex-shrink: 0;
            font-size: 19px;
        }

        .error-box ul {
            padding-left: 16px;
        }

        .login-link {
            margin-top: 23px;
            text-align: center;
            color: var(--muted);
            font-size: 12px;
        }

        .login-link a {
            margin-left: 4px;
            color: var(--pink-dark);
            font-weight: 700;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .security-note {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            margin-top: 22px;
            color: #ad9c95;
            font-size: 10px;
        }

        .security-note .material-symbols-rounded {
            font-size: 15px;
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

            .register-panel {
                padding: 30px 7%;
            }
        }

        @media (max-width: 720px) {
            .page {
                display: block;
            }

            .brand-panel {
                display: none;
            }

            .register-panel {
                min-height: 100vh;
                padding: 28px 23px;
                align-items: center;
            }

            .register-container {
                max-width: 430px;
            }

            .mobile-brand {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 175px;
                min-height: 68px;
                padding: 7px 14px;
                margin-bottom: 34px;
                border-radius: 13px;
                background: transparent;
                
            }

            .mobile-brand .brand-logo {
                width: 100%;
                height: 52px;
                object-position: center;
            }

            .register-heading {
                font-size: 31px;
            }

            .register-form {
                margin-top: 23px;
            }
        }

        @media (max-width: 380px) {
            .register-panel {
                padding: 23px 17px;
            }

            .mobile-brand {
                margin-bottom: 27px;
            }

            .register-heading {
                font-size: 28px;
            }

            .form-group {
                margin-bottom: 15px;
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

    <!-- PANEL BRANDING DESKTOP -->
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
                Bergabung Bersama JAITIN
            </div>

            <h1>
                Mulai perjalanan<br>
                <span>kreatif Anda.</span>
            </h1>

            <p class="brand-description">
                Buat akun JAITIN dan nikmati kemudahan dalam
                mengelola pesanan jahitan, menyimpan ukuran,
                serta memantau proses pengerjaan.
            </p>

            <div class="feature-list">

                <div class="feature-item">
                    <div class="feature-icon">
                        <span class="material-symbols-rounded">person_add</span>
                    </div>
                    <span>Daftar akun dengan mudah dan praktis</span>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <span class="material-symbols-rounded">straighten</span>
                    </div>
                    <span>Simpan data ukuran pelanggan secara teratur</span>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <span class="material-symbols-rounded">checkroom</span>
                    </div>
                    <span>Pantau pesanan jahitan dalam satu tempat</span>
                </div>

            </div>
        </div>

        <div class="brand-footer">
            © {{ date('Y') }} JAITIN · Sistem Informasi Pemesanan Jahitan
        </div>

    </aside>


    <!-- PANEL REGISTER -->
    <main class="register-panel">

        <div class="register-container">

            <!-- LOGO MOBILE -->
            <a href="{{ url('/') }}" class="mobile-brand">
                <img
                    src="{{ asset('storage/logo2.png') }}"
                    alt="Logo JAITIN"
                    class="brand-logo"
                >
            </a>

            <div class="welcome-label">
                <span class="material-symbols-rounded">person_add</span>
                Registrasi pelanggan
            </div>

            <h2 class="register-heading">
                Buat akun baru
            </h2>

            <p class="register-subtitle">
                Lengkapi informasi berikut untuk mulai menggunakan JAITIN.
            </p>


            <!-- ERROR VALIDASI -->
            @if ($errors->any())
                <div class="error-box" role="alert">
                    <span class="material-symbols-rounded alert-icon">error</span>

                    <div>
                        <strong>Periksa kembali data Anda.</strong>

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif


            <!-- PESAN SUKSES -->
            @if (session('success'))
                <div class="success-box" role="status">
                    <span class="material-symbols-rounded alert-icon">check_circle</span>
                    <div>{{ session('success') }}</div>
                </div>
            @endif


            <!-- FORM REGISTER -->
            <form
                action="{{ route('register.process') }}"
                method="POST"
                class="register-form"
            >
                @csrf

                <!-- NAMA -->
                <div class="form-group">
                    <label for="nama" class="form-label">
                        Nama Lengkap
                    </label>

                    <div class="input-wrapper">
                        <span class="input-icon">
                            <span class="material-symbols-rounded">person</span>
                        </span>

                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            class="form-control"
                            value="{{ old('nama') }}"
                            placeholder="Masukkan nama lengkap"
                            autocomplete="name"
                            maxlength="255"
                            required
                        >
                    </div>
                </div>


                <!-- EMAIL -->
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
                            value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            autocomplete="email"
                            maxlength="255"
                            required
                        >
                    </div>
                </div>


                <!-- NOMOR WHATSAPP -->
                <div class="form-group">
                    <label for="no_hp" class="form-label">
                        Nomor WhatsApp
                    </label>

                    <div class="input-wrapper">
                        <span class="input-icon">
                            <span class="material-symbols-rounded">call</span>
                        </span>

                        <input
                            type="tel"
                            id="no_hp"
                            name="no_hp"
                            class="form-control"
                            value="{{ old('no_hp') }}"
                            placeholder="Contoh: 081234567890"
                            autocomplete="tel"
                            maxlength="20"
                            required
                        >
                    </div>
                </div>


                <!-- PASSWORD -->
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
                            placeholder="Minimal 6 karakter"
                            autocomplete="new-password"
                            minlength="6"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            data-target="password"
                            aria-label="Tampilkan password"
                            aria-pressed="false"
                        >
                            <span class="material-symbols-rounded">visibility</span>
                        </button>
                    </div>
                </div>


                <!-- KONFIRMASI PASSWORD -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        Konfirmasi Password
                    </label>

                    <div class="input-wrapper">
                        <span class="input-icon">
                            <span class="material-symbols-rounded">lock_reset</span>
                        </span>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Masukkan ulang password"
                            autocomplete="new-password"
                            minlength="6"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            data-target="password_confirmation"
                            aria-label="Tampilkan konfirmasi password"
                            aria-pressed="false"
                        >
                            <span class="material-symbols-rounded">visibility</span>
                        </button>
                    </div>
                </div>


                <button type="submit" class="btn-register">
                    <span>Buat Akun JAITIN</span>
                    <span class="material-symbols-rounded">arrow_forward</span>
                </button>

            </form>


            <!-- LOGIN -->
            <div class="login-link">
                Sudah memiliki akun?
                <a href="{{ route('login') }}">Masuk sekarang</a>
            </div>

            <div class="security-note">
                <span class="material-symbols-rounded">verified_user</span>
                <span>Informasi akun Anda digunakan untuk layanan JAITIN</span>
            </div>

        </div>
    </main>

</div>


<script>
    // Tampilkan atau sembunyikan password dan konfirmasi password.
    document.querySelectorAll('.password-toggle').forEach(function (button) {
        button.addEventListener('click', function () {
            const input = document.getElementById(this.dataset.target);
            const icon = this.querySelector('.material-symbols-rounded');

            const isHidden = input.type === 'password';

            input.type = isHidden ? 'text' : 'password';
            icon.textContent = isHidden ? 'visibility_off' : 'visibility';

            this.setAttribute(
                'aria-label',
                isHidden ? 'Sembunyikan password' : 'Tampilkan password'
            );

            this.setAttribute('aria-pressed', String(isHidden));
        });
    });

    // Pemeriksaan konfirmasi password sebelum form dikirim.
    const registerForm = document.querySelector('.register-form');
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');

    registerForm.addEventListener('submit', function (event) {
        if (password.value !== passwordConfirmation.value) {
            event.preventDefault();

            passwordConfirmation.setCustomValidity(
                'Konfirmasi password tidak sama.'
            );

            passwordConfirmation.reportValidity();
            passwordConfirmation.focus();
        }
    });

    passwordConfirmation.addEventListener('input', function () {
        this.setCustomValidity('');
    });
</script>

</body>
</html>