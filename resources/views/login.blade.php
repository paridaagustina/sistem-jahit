<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Jaitin</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #F7F0E5;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-card {
            background: #FFFCF7;
            padding: 42px 40px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(74, 58, 54, 0.12);
            border: 1px solid #E8D8C8;
        }

        .logo {
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            color: #4A3A36;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #8A7770;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: bold;
            color: #4A3A36;
        }

        .form-group input {
            width: 100%;
            height: 46px;
            padding: 0 14px;
            border: 1px solid #D8C8BD;
            border-radius: 7px;
            background: #FFFDF9;
            color: #4A3A36;
            outline: none;
            font-size: 14px;
        }

        .form-group input:focus {
            border-color: #B98F91;
            box-shadow: 0 0 0 3px rgba(185, 143, 145, 0.12);
        }

        .remember-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            font-size: 13px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #6F5D57;
        }

        .remember input {
            accent-color: #B98F91;
        }

        .forgot {
            color: #A67578;
            text-decoration: none;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            height: 46px;
            border: none;
            border-radius: 7px;
            background: #B98F91;
            color: white;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-login:hover {
            background: #A97C7F;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 26px 0;
            color: #9A8981;
            font-size: 12px;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #E2D5CC;
        }

        .google-btn {
            width: 100%;
            height: 46px;
            border: 1px solid #D8C8BD;
            border-radius: 7px;
            background: #FFFDF9;
            color: #4A3A36;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .google-btn:hover {
            background: #F7F0E5;
        }

        .register {
            text-align: center;
            margin-top: 25px;
            color: #8A7770;
            font-size: 13px;
        }

        .register a {
            color: #A67578;
            font-weight: bold;
            text-decoration: none;
        }

        .register a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 11px 13px;
            border-radius: 6px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .alert-error {
            background: #F8E5E5;
            color: #9B4C4C;
            border: 1px solid #EBCACA;
        }

        .alert-success {
            background: #E8F1E8;
            color: #557255;
            border: 1px solid #CADCC8;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 32px 25px;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <div class="login-card">

        <div class="logo">
            Jaitin
        </div>

        <div class="subtitle">
            Masuk ke akun Anda
        </div>

        {{-- Pesan error --}}
        @if ($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Pesan sukses --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <div class="form-group">
                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="name@company.com"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <div class="remember-row">

                <label class="remember">
                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                    >

                    <span>Simpan Password</span>
                </label>

                <a href="#" class="forgot">
    Lupa Password?
</a>

            </div>

            <button type="submit" class="btn-login">
                Sign In
            </button>

        </form>

        <div class="divider">
            <span>atau lanjutkan dengan</span>
        </div>

        <button
    type="button"
    class="google-btn"
    onclick="alert('Fitur Google Login akan segera tersedia.')"
>
    Continue with Google
</button>

        <div class="register">
            Belum memiliki akun?
            <a href="#">
    Daftar
</a>
        </div>

    </div>

</div>

</body>
</html>