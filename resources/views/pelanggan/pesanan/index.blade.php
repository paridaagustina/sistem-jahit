
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - Jaitin</title>

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

        .sidebar {
            width: 250px;
            background: #b8898d;
            color: white;
            padding: 25px 18px;
            min-height: 100vh;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
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
            color: #b8898d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Georgia, serif;
            font-size: 36px;
            font-weight: bold;
        }

        .brand {
            margin-top: 10px;
            font-size: 22px;
            font-weight: bold;
        }

        .tagline {
            margin-top: 6px;
            font-size: 12px;
            color: #fff4f1;
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

        .logout {
            margin-top: auto;
            padding-top: 30px;
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
            background: #7e595e;
        }

        .main {
            flex: 1;
            padding: 30px 35px;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .topbar h1 {
            font-size: 28px;
            color: #4b3832;
        }

        .topbar p {
            margin-top: 7px;
            color: #806e69;
            line-height: 1.5;
        }

        .user-info {
            background: #fffaf5;
            padding: 11px 18px;
            border-radius: 20px;
            color: #8e6268;
            border: 1px solid #ead6ca;
            white-space: nowrap;
        }

        .table-box,
        .pickup-box {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(120, 90, 80, 0.06);
            margin-bottom: 25px;
        }

        .table-box {
            overflow-x: auto;
        }

        .table-header {
            margin-bottom: 20px;
        }

        .table-header h2,
        .pickup-box h2 {
            font-size: 20px;
            color: #5d4843;
        }

        .table-header p {
            margin-top: 6px;
            color: #927477;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1200px;
        }

        th {
            background: #ead6ca;
            color: #5d4843;
            padding: 13px;
            text-align: left;
            font-size: 13px;
            white-space: nowrap;
        }

        td {
            padding: 13px;
            border-bottom: 1px solid #eee0d8;
            font-size: 13px;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #fcf5f0;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 15px;
            background: #ead6ca;
            color: #79555a;
            font-size: 12px;
            white-space: nowrap;
        }

        .status-lunas,
        .status-diambil {
            background: #dcebdc;
            color: #527052;
        }

        .status-pending {
            background: #f7e4bd;
            color: #8a6b35;
        }

        .status-siap {
            background: #dce9f8;
            color: #3e628d;
        }

        .btn-bayar,
        .btn-rating {
            display: inline-block;
            background: #b8898d;
            color: white;
            padding: 9px 13px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-bayar:hover,
        .btn-rating:hover {
            background: #9f7378;
        }

        .rating-panel {
            min-width: 240px;
            max-width: 320px;
        }

        .rating-panel form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .rating-stars {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            gap: 3px;
        }

        .rating-stars input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .rating-stars label {
            font-size: 29px;
            line-height: 1.2;
            color: #d9c9c0;
            cursor: pointer;
        }

        .rating-stars label:hover,
        .rating-stars label:hover ~ label,
        .rating-stars input:checked ~ label {
            color: #d6a33e;
        }

        .rating-panel textarea {
            width: 100%;
            min-height: 75px;
            resize: vertical;
            border: 1px solid #e3cfc5;
            border-radius: 8px;
            padding: 10px;
            font-size: 12px;
            background: #fffdfb;
            color: #4b3832;
        }

        .rating-panel textarea:focus {
            outline: 2px solid #d7b3b5;
        }

        .rating-result {
            background: #fff4e2;
            border: 1px solid #ead6ca;
            border-radius: 10px;
            padding: 12px;
            min-width: 200px;
        }

        .rating-result .stars {
            color: #d6a33e;
            font-size: 21px;
            letter-spacing: 2px;
        }

        .rating-result p {
            margin-top: 6px;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .rating-hint {
            color: #806e69;
            font-size: 12px;
            line-height: 1.5;
        }

        .pickup-intro {
            color: #806e69;
            font-size: 13px;
            line-height: 1.6;
            margin: 8px 0 20px;
        }

        .pickup-list {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 15px;
        }

        .pickup-item {
            padding: 18px;
            border: 1px solid #ead6ca;
            border-radius: 12px;
            background: #fffdfb;
        }

        .pickup-item h3 {
            font-size: 15px;
            margin-bottom: 10px;
            color: #5d4843;
        }

        .pickup-item p {
            font-size: 13px;
            color: #806e69;
            line-height: 1.7;
        }

        .pickup-item .status {
            margin-top: 10px;
        }

        .alert-success {
            background: #e7f3e7;
            color: #527052;
            border: 1px solid #c8dfc8;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-error {
            background: #fde4e4;
            color: #9b4d4d;
            border: 1px solid #e8aaaa;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-error ul {
            padding-left: 20px;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #927477;
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 220px;
            }

            .main {
                padding: 25px 20px;
            }

            .pickup-list {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .layout {
                display: block;
            }

            .sidebar {
                width: 100%;
                min-height: auto;
            }

            .main {
                padding: 20px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
<div class="layout">

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="logo-area">
            <div class="logo-circle">J</div>
            <div class="brand">Jaitin</div>
            <p class="tagline">Jahitan dengan sepenuh hati</p>
        </div>

        <ul class="menu">
            <li>
                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('pelanggan.pesanan.create') }}"
                   class="{{ request()->routeIs('pelanggan.pesanan.create') ? 'active' : '' }}">
                    Pesan Jasa Jahit
                </a>
            </li>
            <li>
                <a href="{{ route('pelanggan.pesanan.index') }}"
                   class="{{ request()->routeIs('pelanggan.pesanan.index') ? 'active' : '' }}">
                    Pesanan Saya
                </a>
            </li>
            <li>
                <a href="{{ route('pelanggan.ukuran.index') }}"
                   class="{{ request()->routeIs('pelanggan.ukuran.*') ? 'active' : '' }}">
                    Ukuran Saya
                </a>
            </li>
            <li>
                <a href="{{ route('pelanggan.pembayaran.index') }}"
                   class="{{ request()->routeIs('pelanggan.pembayaran.*') ? 'active' : '' }}">
                    Pembayaran
                </a>
            </li>
            <li>
                <a href="{{ route('pelanggan.revisi.index') }}"
                   class="{{ request()->routeIs('pelanggan.revisi.*') ? 'active' : '' }}">
                    Riwayat Revisi
                </a>
            </li>
        </ul>

        <div class="logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Keluar dari akun</button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <main class="main">
        <div class="topbar">
            <div>
                <h1>Pesanan Saya</h1>
                <p>
                    Lihat pesanan, status pengerjaan, estimasi selesai,
                    pembayaran, pengambilan, dan beri penilaian pada jahitanmu.
                </p>
            </div>
            <div class="user-info">
                {{ Auth::user()->nama ?? 'Pelanggan' }}
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                <strong>Rating belum berhasil dikirim:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- DAFTAR PESANAN --}}
        <div class="table-box">
            <div class="table-header">
                <h2>Daftar Pesanan</h2>
                <p>Rating dapat diberikan setelah pakaian berstatus Sudah Diambil.</p>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Pakaian</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pesan</th>
                        <th>Tanggal Harapan</th>
                        <th>Estimasi Selesai</th>
                        <th>Status Pengerjaan</th>
                        <th>Total Harga</th>
                        <th>Pembayaran</th>
                        <th>Pengambilan</th>
                        <th>Rating & Ulasan</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($pesanan as $item)
                    @php
                        $statusPengerjaan = strtolower(
                            trim($item->status_pengerjaan ?? $item->status ?? '')
                        );

                        $statusBayar = strtolower(
                            trim($item->status_pembayaran ?? '')
                        );

                        $sudahDiambil = in_array($statusPengerjaan, [
                            'sudah diambil',
                            'sudah_diambil',
                            'sudah-diambil'
                        ]);

                        if (in_array($statusPengerjaan, [
                            'siap diambil',
                            'siap_diambil',
                            'siap-diambil'
                        ])) {
                            $statusPengambilan = 'Siap Diambil';
                            $kelasPengambilan = 'status-siap';
                        } elseif ($sudahDiambil) {
                            $statusPengambilan = 'Sudah Diambil';
                            $kelasPengambilan = 'status-diambil';
                        } elseif (in_array($statusPengerjaan, [
                            'selesai',
                            'selesai dikerjakan'
                        ])) {
                            $statusPengambilan = 'Menunggu Pengambilan';
                            $kelasPengambilan = 'status-siap';
                        } else {
                            $statusPengambilan = 'Belum Siap';
                            $kelasPengambilan = '';
                        }

                        if (in_array($statusBayar, [
                            'lunas', 'berhasil', 'sukses', 'success', 'paid'
                        ])) {
                            $kelasBayar = 'status-lunas';
                        } elseif (in_array($statusBayar, [
                            'pending', 'menunggu', 'menunggu verifikasi'
                        ])) {
                            $kelasBayar = 'status-pending';
                        } else {
                            $kelasBayar = '';
                        }

                        $ratingItem = $item->rating;
                    @endphp

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->jenis_pakaian ?? '-' }}</td>
                        <td>{{ $item->jumlah ?? 0 }}</td>
                        <td>{{ $item->tanggal_pesan ?? '-' }}</td>
                        <td>{{ $item->tanggal_harapan ?? '-' }}</td>
                        <td>{{ $item->estimasi_selesai ?? '-' }}</td>
                        <td>
                            <span class="status">
                                {{ $item->status_pengerjaan ?? $item->status ?? '-' }}
                            </span>
                        </td>
                        <td>
                            Rp {{ number_format(
                                (float) ($item->total_harga ?? 0),
                                0, ',', '.'
                            ) }}
                        </td>
                        <td>
                            @if($kelasBayar === 'status-lunas')
                                <span class="status status-lunas">
                                    {{ $item->status_pembayaran }}
                                </span>
                            @else
                                <a href="{{ route('pelanggan.pembayaran.pay', $item->id_pesanan) }}"
                                   class="btn-bayar">
                                    Bayar
                                </a>
                            @endif
                        </td>
                        <td>
                            <span class="status {{ $kelasPengambilan }}">
                                {{ $statusPengambilan }}
                            </span>
                        </td>

                        {{-- RATING --}}
                        <td>
                            <div class="rating-panel">
                                @if($ratingItem)
                                    <div class="rating-result">
                                        <div class="stars" aria-label="Rating {{ $ratingItem->rating }} dari 5">
                                            @for($bintang = 1; $bintang <= 5; $bintang++)
                                                {{ $bintang <= $ratingItem->rating ? '★' : '☆' }}
                                            @endfor
                                        </div>
                                        <strong>{{ $ratingItem->rating }}/5</strong>

                                        @if($ratingItem->ulasan)
                                            <p>{{ $ratingItem->ulasan }}</p>
                                        @else
                                            <p class="rating-hint">Tidak ada ulasan tertulis.</p>
                                        @endif

                                        <p class="rating-hint">Rating sudah dikirim.</p>
                                    </div>
                                @elseif($sudahDiambil)
                                    <form action="{{ route('pelanggan.rating.store', $item->id_pesanan) }}"
                                          method="POST">
                                        @csrf

                                        <strong>Beri penilaian</strong>

                                        <div class="rating-stars">
                                            @for($bintang = 5; $bintang >= 1; $bintang--)
                                                <input
                                                    type="radio"
                                                    id="rating-{{ $item->id_pesanan }}-{{ $bintang }}"
                                                    name="rating"
                                                    value="{{ $bintang }}"
                                                    required
                                                >
                                                <label
                                                    for="rating-{{ $item->id_pesanan }}-{{ $bintang }}"
                                                    title="{{ $bintang }} bintang">★</label>
                                            @endfor
                                        </div>

                                        <textarea
                                            name="ulasan"
                                            maxlength="2000"
                                            placeholder="Tulis ulasan (opsional)"
                                        >{{ old('id_pesanan') == $item->id_pesanan ? old('ulasan') : '' }}</textarea>

                                        <button type="submit" class="btn-rating">
                                            Kirim Rating
                                        </button>
                                    </form>
                                @else
                                    <p class="rating-hint">
                                        Rating tersedia setelah pesanan berstatus Sudah Diambil.
                                    </p>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="empty">
                            Belum ada pesanan.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- INFORMASI PENGAMBILAN --}}
        <section class="pickup-box">
            <h2>Informasi Pengambilan</h2>
            <p class="pickup-intro">
                Pantau kesiapan pakaian melalui status pesanan.
                Jika jahitan siap diambil, pemberitahuan dapat dikirim melalui
                WhatsApp setelah integrasi notifikasi diaktifkan.
            </p>

            <div class="pickup-list">
                <div class="pickup-item">
                    <h3>Menunggu Jahitan Selesai</h3>
                    <p>
                        Selama pesanan masih diproses, kamu belum perlu
                        mengambil pakaian. Periksa status pesanan secara berkala.
                    </p>
                    <span class="status">Dalam Pengerjaan</span>
                </div>

                <div class="pickup-item">
                    <h3>Pengambilan Pakaian</h3>
                    <p>
                        Jika status menjadi Siap Diambil, ikuti informasi
                        dari karyawan. Setelah pakaian diserahkan, status
                        dapat diperbarui menjadi Sudah Diambil.
                    </p>
                    <span class="status status-siap">Siap Diambil</span>
                    <span class="status status-diambil">Sudah Diambil</span>
                </div>
            </div>
        </section>
    </main>
</div>
</body>
</html>
