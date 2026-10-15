```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Saya - Jaitin</title>

    <style>
        :root {
            --pink: #b98d91;
            --pink-dark: #9f7378;
            --cream: #f8f0e9;
            --brown: #60454a;
            --muted: #8e7779;
            --border: #ecd5c9;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: var(--cream);
            color: var(--brown);
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            flex-shrink: 0;
            background: var(--pink);
            padding: 28px 18px;
        }

        .brand {
            text-align: center;
            margin-bottom: 35px;
        }

        .brand-logo {
            width: 76px;
            height: 76px;
            margin: 0 auto 12px;
            border-radius: 50%;
            background: #fffaf6;
            color: var(--pink);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Georgia, serif;
            font-size: 36px;
            font-weight: bold;
        }

        .brand h2 {
            margin: 0;
            font-size: 24px;
            color: #ffffff;
        }

        .brand p {
            margin: 8px 0 0;
            color: #fff1ef;
            font-size: 12px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .menu a,
        .logout button {
            display: block;
            padding: 13px 14px;
            border-radius: 10px;
            text-decoration: none;
            color: #ffffff;
            font-size: 14px;
            transition: .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: var(--pink-dark);
            color: #ffffff;
        }

        .logout {
            margin-top: 30px;
        }

        .logout button {
            width: 100%;
            text-align: left;
            border: 0;
            background: transparent;
            cursor: pointer;
            font-size: 14px;
        }

        .logout button:hover {
            background: var(--pink-dark);
        }

        /* KONTEN */
        .main {
            flex: 1;
            min-width: 0;
            padding: 35px;
            background: var(--cream);
        }

        .page-heading {
            margin-bottom: 25px;
        }

        .page-heading h1 {
            margin: 0 0 9px;
            font-size: 28px;
            color: var(--brown);
        }

        .page-heading p {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
        }

        /* RINGKASAN PEMBAYARAN */
        .summary {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }

        .summary-card {
            background: #fffaf6;
            padding: 22px;
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 4px 14px rgba(99, 70, 75, .04);
        }

        .summary-card p {
            color: var(--muted);
            margin: 0 0 12px;
            font-size: 13px;
        }

        .summary-card h2 {
            margin: 0;
            font-size: 22px;
            color: var(--brown);
            overflow-wrap: anywhere;
        }

        /* RIWAYAT TRANSAKSI */
        .section {
            background: #fffaf6;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 14px rgba(99, 70, 75, .04);
        }

        .section-heading {
            margin-bottom: 20px;
        }

        .section-heading h2 {
            margin: 0 0 6px;
            font-size: 20px;
            color: var(--brown);
        }

        .section-heading p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }

        th,
        td {
            text-align: left;
            padding: 15px 12px;
            border-bottom: 1px solid var(--border);
            font-size: 13px;
        }

        th {
            color: var(--muted);
            background: #f8eeea;
            font-weight: 600;
        }

        tbody tr:hover {
            background: #fff5f0;
        }

        .amount {
            font-weight: bold;
            color: var(--brown);
        }

        /* STATUS */
        .badge {
            display: inline-block;
            padding: 7px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .badge.success {
            color: #276749;
            background: #e0f4e8;
        }

        .badge.pending {
            color: #946200;
            background: #fff1c9;
        }

        .badge.failed {
            color: #a33a48;
            background: #ffe3e6;
        }

        .badge.neutral {
            color: #705d64;
            background: #f0e9ec;
        }

        /* DATA KOSONG */
        .empty {
            text-align: center;
            padding: 45px 15px;
            color: var(--muted);
        }

        .empty h3 {
            color: var(--brown);
            margin-bottom: 8px;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: var(--pink-dark);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .message-success {
            padding: 12px 15px;
            margin-bottom: 18px;
            background: #e0f4e8;
            color: #276749;
            border-radius: 10px;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .sidebar {
                width: 220px;
            }

            .main {
                padding: 24px;
            }

            .summary {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .layout {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 18px;
            }

            .brand {
                margin-bottom: 18px;
            }

            .menu {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .logout {
                margin-top: 12px;
            }

            .main {
                padding: 20px 14px;
            }

            .page-heading h1 {
                font-size: 24px;
            }

            .section {
                padding: 15px;
            }

            .summary-card {
                padding: 18px;
            }
        }
    </style>
</head>

<body>
<div class="layout">

    {{-- SIDEBAR PELANGGAN --}}
    <aside class="sidebar">

        <div class="brand">
            <div class="brand-logo">J</div>
            <h2>Jaitin</h2>
            <p>Jahitan dengan sepenuh hati</p>
        </div>

        <nav class="menu">
            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('pelanggan.pesanan.create') }}"
               class="{{ request()->routeIs('pelanggan.pesanan.create') ? 'active' : '' }}">
                Pesan Jasa Jahit
            </a>

            <a href="{{ route('pelanggan.pesanan.index') }}"
               class="{{ request()->routeIs('pelanggan.pesanan.index') ? 'active' : '' }}">
                Pesanan Saya
            </a>

            <a href="{{ route('pelanggan.ukuran.index') }}"
               class="{{ request()->routeIs('pelanggan.ukuran.index') ? 'active' : '' }}">
                Ukuran Saya
            </a>

            <a href="{{ route('pelanggan.pembayaran.index') }}"
               class="{{ request()->routeIs('pelanggan.pembayaran.index') ? 'active' : '' }}">
                Pembayaran
            </a>

            <a href="{{ route('pelanggan.revisi.index') }}"
               class="{{ request()->routeIs('pelanggan.revisi.index') ? 'active' : '' }}">
                Riwayat Revisi
            </a>
        </nav>

        <form action="{{ route('logout') }}" method="POST" class="logout">
            @csrf
            <button type="submit">Keluar dari akun</button>
        </form>

    </aside>

    {{-- KONTEN PEMBAYARAN --}}
    <main class="main">

        <div class="page-heading">
            <h1>Pembayaran Saya</h1>
            <p>
                Pantau riwayat transaksi, pembayaran DP, dan pelunasan
                pesanan jahitanmu di Jaitin.
            </p>
        </div>

        @php
            $totalDibayar = $pembayaran
                ->filter(function ($item) {
                    return in_array(
                        strtolower(trim($item->status_pembayaran ?? '')),
                        ['berhasil', 'sukses', 'lunas', 'success', 'paid']
                    );
                })
                ->sum('jumlah');

            $menunggu = $pembayaran
                ->filter(function ($item) {
                    return in_array(
                        strtolower(trim($item->status_pembayaran ?? '')),
                        ['menunggu verifikasi', 'menunggu', 'pending']
                    );
                })
                ->count();
        @endphp

        {{-- RINGKASAN --}}
        <div class="summary">

            <div class="summary-card">
                <p>Total pembayaran berhasil</p>
                <h2>
                    Rp {{ number_format($totalDibayar, 0, ',', '.') }}
                </h2>
            </div>

            <div class="summary-card">
                <p>Total transaksi</p>
                <h2>{{ $pembayaran->count() }} transaksi</h2>
            </div>

            <div class="summary-card">
                <p>Menunggu verifikasi</p>
                <h2>{{ $menunggu }} transaksi</h2>
            </div>

        </div>

        {{-- RIWAYAT TRANSAKSI --}}
        <section class="section">

            <div class="section-heading">
                <h2>Riwayat Transaksi</h2>
                <p>Daftar pembayaran yang terkait dengan pesananmu.</p>
            </div>

            @if(session('success'))
                <div class="message-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($pembayaran->isEmpty())

                <div class="empty">
                    <h3>Belum Ada Riwayat Pembayaran</h3>
                    <p>
                        Transaksi pembayaran untuk pesananmu akan muncul
                        di halaman ini setelah tercatat dalam sistem.
                    </p>

                    <a href="{{ route('pelanggan.pesanan.index') }}"
                       class="back-link">
                        Lihat Pesanan Saya
                    </a>
                </div>

            @else

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID Transaksi</th>
                                <th>Pesanan</th>
                                <th>Jenis Pembayaran</th>
                                <th>Tanggal</th>
                                <th>Metode</th>
                                <th>Nominal</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($pembayaran as $item)

                            @php
                                $status = strtolower(
                                    trim($item->status_pembayaran ?? '')
                                );

                                if (in_array($status, [
                                    'berhasil',
                                    'sukses',
                                    'lunas',
                                    'success',
                                    'paid'
                                ])) {
                                    $statusClass = 'success';
                                } elseif (in_array($status, [
                                    'menunggu',
                                    'pending',
                                    'menunggu verifikasi'
                                ])) {
                                    $statusClass = 'pending';
                                } elseif (in_array($status, [
                                    'ditolak',
                                    'gagal',
                                    'failed',
                                    'cancelled',
                                    'dibatalkan'
                                ])) {
                                    $statusClass = 'failed';
                                } else {
                                    $statusClass = 'neutral';
                                }
                            @endphp

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $item->transaksi_id ?: '-' }}
                                </td>

                                <td>
                                    #{{ $item->id_pesanan }}

                                    @if($item->pesanan)
                                        <br>
                                        <small>
                                            {{ $item->pesanan->jenis_pakaian }}
                                        </small>
                                    @endif
                                </td>

                                <td>
                                    {{ $item->jenis_pembayaran ?: '-' }}
                                </td>

                                <td>
                                    {{ $item->tanggal_pembayaran
                                        ? \Carbon\Carbon::parse(
                                            $item->tanggal_pembayaran
                                        )->format('d-m-Y H:i')
                                        : '-' }}
                                </td>

                                <td>
                                    {{ $item->metode_pembayaran ?: '-' }}
                                </td>

                                <td class="amount">
                                    Rp {{ number_format(
                                        (float) $item->jumlah,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </td>

                                <td>
                                    <span class="badge {{ $statusClass }}">
                                        {{ $item->status_pembayaran ?: 'Belum ada status' }}
                                    </span>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>

            @endif
        </section>

    </main>
</div>
</body>
</html>
```