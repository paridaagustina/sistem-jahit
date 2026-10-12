<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Jaitin</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #f8f1eb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4b3832;
        }

        .register-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .register-card {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 8px 25px rgba(120, 90, 80, 0.10);
        }

        .logo-area {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo-circle {
            width: 85px;
            height: 85px;
            margin: 0 auto 12px;
            border-radius: 50%;
            background: #f8e8e5;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .logo-circle img {
            width: 75px;
            height: 75px;
            object-fit: contain;
        }

        .brand {
            font-size: 25px;
            font-weight: bold;
            color: #8e6268;
        }

        .subtitle {
            margin-top: 6px;
            color: #806e69;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 17px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-size: 14px;
            font-weight: bold;
            color: #5d4843;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ddc8bd;
            border-radius: 10px;
            background: #fff;
            color: #4b3832;
            outline: none;
            font-size: 14px;
        }

        .form-group input:focus {
            border-color: #b8898d;
            box-shadow: 0 0 0 3px rgba(184, 137, 141, 0.12);
        }

        .btn-register {
            width: 100%;
            border: none;
            background: #b8898d;
            color: white;
            padding: 13px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 5px;
        }

        .btn-register:hover {
            background: #9f7378;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #806e69;
        }

        .login-link a {
            color: #8e6268;
            font-weight: bold;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error-box {
            background: #f8dddd;
            border: 1px solid #e7bcbc;
            color: #8b4f55;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .error-box ul {
            padding-left: 18px;
        }

        .success-box {
            background: #e8f2e5;
            border: 1px solid #c8ddc2;
            color: #587052;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 13px;
        }
    </style>
</head>

<body>

<div class="register-container">

    <div class="register-card">

        <!-- LOGO -->
        <div class="logo-area">

            <div class="logo-circle">
                <img src="{{ asset('images/logo-jaitin.png') }}"
                     alt="Logo Jaitin">
            </div>

            <div class="brand">
                Jaitin
            </div>

            <div class="subtitle">
                Buat akun pelanggan baru
            </div>

        </div>


        <!-- ERROR -->
        @if ($errors->any())

            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif


        <!-- FORM REGISTER -->
        <form action="{{ route('register.process') }}" method="POST">

            @csrf

            <!-- NAMA -->
            <div class="form-group">

                <label for="nama">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    id="nama"
                    name="nama"
                    value="{{ old('nama') }}"
                    placeholder="Masukkan nama lengkap"
                    required
                >

            </div>


            <!-- EMAIL -->
            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email"
                    required
                >

            </div>


            <!-- NO HP -->
            <div class="form-group">

                <label for="no_hp">
                    Nomor WhatsApp
                </label>

                <input
                    type="text"
                    id="no_hp"
                    name="no_hp"
                    value="{{ old('no_hp') }}"
                    placeholder="Contoh: 081234567890"
                    required
                >

            </div>


            <!-- PASSWORD -->
            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimal 6 karakter"
                    required
                >

            </div>


            <!-- KONFIRMASI PASSWORD -->
            <div class="form-group">

                <label for="password_confirmation">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Masukkan ulang password"
                    required
                >

            </div>


            <button type="submit" class="btn-register">
                Daftar
            </button>

        </form>


        <!-- LOGIN -->
        <div class="login-link">

            Sudah memiliki akun?

            <a href="{{ route('login') }}">
                Login
            </a>

        </div>

    </div>

</div>

</body>
</html>