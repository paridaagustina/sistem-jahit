```blade
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Revisi - Jaitin</title>

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

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: #b8898d;
            color: white;
            padding: 25px 18px;
            flex-shrink: 0;
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
        }

        .menu a:hover,
        .menu a.active {
            background: #9f7378;
        }

        /* LOGOUT */
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

        /* MAIN */
        .main {
            flex: 1;
            padding: 30px 35px;
        }

        .topbar {
            margin-bottom: 25px;
        }

        .topbar h1 {
            font-size: 28px;
            color: #4b3832;
        }

        .topbar p {
            margin-top: 6px;
            color: #806e69;
        }

        /* FORM BOX */
        .form-box {
            max-width: 800px;
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(120, 90, 80, 0.06);
        }

        .order-info {
            background: #f5e8e2;
            border-radius: 10px;
            padding: 18px;
            margin-bottom: 25px;
        }

        .order-info h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .order-info p {
            margin-bottom: 5px;
            color: #6d5954;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 11px 13px;
            border: 1px solid #d9c4ba;
            border-radius: 8px;
            background: white;
            color: #4b3832;
            font-size: 14px;
            outline: none;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #b8898d;
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .error {
            margin-top: 6px;
            color: #a64f58;
            font-size: 13px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn-simpan {
            border: none;
            background: #b8898d;
            color: white;
            padding: 11px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-simpan:hover {
            background: #9f7378;
        }

        .btn-kembali {
            background: #ead6ca;
            color: #5d4843;
            padding: 11px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-kembali:hover {
            background: #dcc4b8;
        }

        @media (max-width: 768px) {
            .layout {
                display: block;
            }

            .sidebar {
                width: 100%;
            }

            .main {
                padding: 20px;
            }

            .form-box {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="logo-area">

            <div class="logo-circle">
                <img
                    src="{{ asset('images/logo-jaitin.png') }}"
                    alt="Logo Jaitin"
                >
            </div>

            <div class="brand">
                Jaitin
            </div>

        </div>

        <ul class="menu">

            <li>
                <a href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('admin.pelanggan.index') }}">
                    Data Pelanggan
                </a>
            </li>

            <li>
                <a
                    href="{{ route('admin.pesanan.index') }}"
                    class="active"
                >
                    Data Pesanan
                </a>
            </li>

            <li>
                <a href="#">
                    Data Ukuran
                </a>
            </li>

            <li>
                <a href="#">
                    Referensi Model
                </a>
            </li>

            <li>
                <a href="#">
                    Pembayaran
                </a>
            </li>

            <li>
                <a href="#">
                    Status Pengerjaan
                </a>
            </li>

        </ul>

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


    <!-- MAIN -->
    <main class="main">

        <div class="topbar">

            <h1>
                Tambah Revisi
            </h1>

            <p>
                Tambahkan data revisi untuk pesanan pelanggan.
            </p>

        </div>


        <div class="form-box">

            <!-- INFORMASI PESANAN -->
            <div class="order-info">

                <h2>
                    Informasi Pesanan
                </h2>

                <p>
                    <strong>Pelanggan:</strong>
                    {{ $pesanan->user->nama ?? '-' }}
                </p>

                <p>
                    <strong>Jenis Pakaian:</strong>
                    {{ $pesanan->jenis_pakaian ?? '-' }}
                </p>

                <p>
                    <strong>Jumlah:</strong>
                    {{ $pesanan->jumlah ?? 0 }}
                </p>

            </div>


            <!-- FORM -->
            <form
                action="{{ route('admin.revisi.store', $pesanan->id_pesanan) }}"
                method="POST"
            >

                @csrf


                <!-- KETERANGAN -->
                <div class="form-group">

                    <label for="keterangan">
                        Keterangan Revisi
                    </label>

                    <textarea
                        id="keterangan"
                        name="keterangan"
                        placeholder="Contoh: Ukuran bagian lengan perlu diperkecil..."
                        required
                    >{{ old('keterangan') }}</textarea>

                    @error('keterangan')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- TANGGAL REVISI -->
                <div class="form-group">

                    <label for="tanggal_revisi">
                        Tanggal Revisi
                    </label>

                    <input
                        type="datetime-local"
                        id="tanggal_revisi"
                        name="tanggal_revisi"
                        value="{{ old('tanggal_revisi', now()->format('Y-m-d\TH:i')) }}"
                        required
                    >

                    @error('tanggal_revisi')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- BIAYA REVISI -->
                <div class="form-group">

                    <label for="biaya_revisi">
                        Biaya Revisi
                    </label>

                    <input
                        type="number"
                        id="biaya_revisi"
                        name="biaya_revisi"
                        min="0"
                        step="0.01"
                        value="{{ old('biaya_revisi', 0) }}"
                        placeholder="Contoh: 50000"
                        required
                    >

                    @error('biaya_revisi')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- BATAS WAKTU -->
                <div class="form-group">

                    <label for="batas_waktu_revisi">
                        Batas Waktu Revisi
                    </label>

                    <input
                        type="date"
                        id="batas_waktu_revisi"
                        name="batas_waktu_revisi"
                        value="{{ old('batas_waktu_revisi') }}"
                    >

                    @error('batas_waktu_revisi')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- BUTTON -->
                <div class="buttons">

                    <button
                        type="submit"
                        class="btn-simpan"
                    >
                        Simpan Revisi
                    </button>

                    <a
                        href="{{ route('admin.pesanan.edit', $pesanan->id_pesanan) }}"
                        class="btn-kembali"
                    >
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </main>

</div>

</body>

</html>
```