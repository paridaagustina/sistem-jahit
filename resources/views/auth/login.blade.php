<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Toko Jahit Lina</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            width: 400px;
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo h1 {
            color: #8b5e3c;
            margin-bottom: 8px;
        }

        .logo p {
            color: #777;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #444;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 7px;
            font-size: 14px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #8b5e3c;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 7px;
            background: #8b5e3c;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-login:hover {
            background: #70492f;
        }

        .error {
            background: #f8d7da;
            color: #842029;
            padding: 10px;
            border-radius: 7px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .validation-error {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="logo">
        <h1>Jaitin</h1>
        <p>Sistem Informasi Pemesanan dan Pengambilan Hasil Jahit</p>
    </div>

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('login.process') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Masukkan email"
                required
            >

            @error('email')
                <div class="validation-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                required
            >

            @error('password')
                <div class="validation-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-login">
            Login
        </button>
    </form>

</div>

</body>
</html>