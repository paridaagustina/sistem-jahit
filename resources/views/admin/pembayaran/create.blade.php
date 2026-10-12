```blade
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Pembayaran - Jaitin</title>

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
            transition: 0.2s;
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

        .logout button:hover {
            background: #79545a;
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
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(120, 90, 80, 0.06);
            max-width: 900px;
        }

        .form-box h2 {
            font-size: 20px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: bold;
            color: #5d4843;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #dbc7bd;
            border-radius: 9px;
            background: #fff;
            color: #4b3832;
            font-size: 14px;
            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #b8898d;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .info-pesanan {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .info-card {
            background: #f7eee8;
            border: 1px solid #ead6ca;
            border-radius: 10px;
            padding: 15px;
        }

        .info-card span {
            display: block;
            font-size: 12px;
            color: #927477;
            margin-bottom: 6px;
        }

        .info-card strong {
            font-size: 16px;
            color: #4b3832;
        }

        .alert-error {
            background: #f8dddd;
            color: #8f4f55;
            border: 1px solid #e5bfc2;
            padding: 12px 15px;
            border-radius: 9px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .button-area {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }

        .btn-kembali {
            background: #ead6ca;
            color: #5d4843;
            padding: 11px 18px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-simpan {
            border: none;
            background: #b8898d;
            color: white;
            padding: 11px 20px;
            border-radius: 9px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-simpan:hover {
            background: #9f7378;
        }

        .rupiah {
            color: #8e6268 !important;
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

            .info-pesanan {
                grid-template-columns: 1fr;
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
                <a href="{{ route('admin.pesanan.index') }}">
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
                <a
                    href="{{ route('admin.pembayaran.index') }}"
                    class="active"
                >
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
                Tambah Pembayaran
            </h1>

            <p>
                Tambahkan data pembayaran pelanggan.
            </p>

        </div>


        <div class="form-box">

            @if($errors->any())

                <div class="alert-error">

                    <strong>
                        Terdapat kesalahan:
                    </strong>

                    <ul style="margin-top: 8px; padding-left: 20px;">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <h2>
                Informasi Pembayaran
            </h2>


            <form
                action="{{ route('admin.pembayaran.store') }}"
                method="POST"
            >

                @csrf


                <!-- PESANAN -->
                <div class="form-group">

                    <label for="id_pesanan">
                        Pesanan
                    </label>

                    <select
                        name="id_pesanan"
                        id="id_pesanan"
                        required
                        onchange="tampilkanPesanan()"
                    >

                        <option value="">
                            -- Pilih Pesanan --
                        </option>

                        @foreach($pesanan as $item)

                            <option
                                value="{{ $item->id_pesanan }}"
                                data-pelanggan="{{ $item->user->nama ?? '-' }}"
                                data-total="{{ $item->total_harga ?? 0 }}"
                                data-dp="{{ $item->besaran_dp ?? 0 }}"
                            >

                                #{{ $item->id_pesanan }}
                                -
                                {{ $item->user->nama ?? 'Pelanggan' }}
                                -
                                {{ $item->jenis_pakaian ?? '-' }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- INFORMASI PESANAN -->
                <div
                    class="info-pesanan"
                    id="infoPesanan"
                    style="display: none;"
                >

                    <div class="info-card">

                        <span>
                            Pelanggan
                        </span>

                        <strong id="infoPelanggan">
                            -
                        </strong>

                    </div>


                    <div class="info-card">

                        <span>
                            Total Harga
                        </span>

                        <strong
                            id="infoTotal"
                            class="rupiah"
                        >
                            Rp 0
                        </strong>

                    </div>


                    <div class="info-card">

                        <span>
                            DP
                        </span>

                        <strong
                            id="infoDp"
                            class="rupiah"
                        >
                            Rp 0
                        </strong>

                    </div>

                </div>


                <!-- TRANSAKSI ID -->
                <div class="form-group">

                    <label for="transaksi_id">
                        ID Transaksi
                    </label>

                    <input
                        type="text"
                        name="transaksi_id"
                        id="transaksi_id"
                        value="{{ old('transaksi_id') }}"
                        placeholder="Contoh: TRX-001"
                    >

                </div>


                <!-- JUMLAH -->
                <div class="form-group">

                    <label for="jumlah">
                        Jumlah Pembayaran
                    </label>

                    <input
                        type="number"
                        name="jumlah"
                        id="jumlah"
                        value="{{ old('jumlah') }}"
                        min="0"
                        step="0.01"
                        placeholder="Masukkan jumlah pembayaran"
                        required
                    >

                </div>


                <!-- JENIS PEMBAYARAN -->
                <div class="form-group">

                    <label for="jenis_pembayaran">
                        Jenis Pembayaran
                    </label>

                    <select
                        name="jenis_pembayaran"
                        id="jenis_pembayaran"
                        required
                    >

                        <option value="">
                            -- Pilih Jenis Pembayaran --
                        </option>

                        <option value="DP">
                            DP
                        </option>

                        <option value="Lunas">
                            Lunas
                        </option>

                    </select>

                </div>


                <!-- TANGGAL -->
                <div class="form-group">

                    <label for="tanggal_pembayaran">
                        Tanggal Pembayaran
                    </label>

                    <input
                        type="datetime-local"
                        name="tanggal_pembayaran"
                        id="tanggal_pembayaran"
                        value="{{ old('tanggal_pembayaran') }}"
                        required
                    >

                </div>


                <!-- METODE -->
                <div class="form-group">

                    <label for="metode_pembayaran">
                        Metode Pembayaran
                    </label>

                    <select
                        name="metode_pembayaran"
                        id="metode_pembayaran"
                        required
                    >

                        <option value="">
                            -- Pilih Metode Pembayaran --
                        </option>

                        <option value="Tunai">
                            Tunai
                        </option>

                        <option value="Transfer Bank">
                            Transfer Bank
                        </option>

                        <option value="QRIS">
                            QRIS
                        </option>

                    </select>

                </div>


                <!-- STATUS -->
                <div class="form-group">

                    <label for="status_pembayaran">
                        Status Pembayaran
                    </label>

                    <select
                        name="status_pembayaran"
                        id="status_pembayaran"
                        required
                    >

                        <option value="">
                            -- Pilih Status --
                        </option>

                        <option value="Menunggu">
                            Menunggu
                        </option>

                        <option value="Lunas">
                            Lunas
                        </option>

                        <option value="Gagal">
                            Gagal
                        </option>

                    </select>

                </div>


                <!-- BUTTON -->
                <div class="button-area">

                    <a
                        href="{{ route('admin.pembayaran.index') }}"
                        class="btn-kembali"
                    >
                        Kembali
                    </a>

                    <button
                        type="submit"
                        class="btn-simpan"
                    >
                        Simpan Pembayaran
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>


<script>

    function formatRupiah(angka) {

        angka = Number(angka) || 0;

        return 'Rp ' + angka.toLocaleString(
            'id-ID'
        );

    }


    function tampilkanPesanan() {

        const select =
            document.getElementById('id_pesanan');

        const option =
            select.options[select.selectedIndex];

        const info =
            document.getElementById('infoPesanan');

        if (!select.value) {

            info.style.display = 'none';

            return;
        }


        const pelanggan =
            option.getAttribute('data-pelanggan');

        const total =
            option.getAttribute('data-total');

        const dp =
            option.getAttribute('data-dp');


        document.getElementById(
            'infoPelanggan'
        ).textContent = pelanggan;


        document.getElementById(
            'infoTotal'
        ).textContent = formatRupiah(total);


        document.getElementById(
            'infoDp'
        ).textContent = formatRupiah(dp);


        info.style.display = 'grid';
    }

</script>

</body>

</html>
```