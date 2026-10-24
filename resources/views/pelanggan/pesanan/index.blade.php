@extends('layouts.pelanggan')

@section('title', 'Pesanan Saya - JAITIN')
@section('page-title', 'Pesanan Saya')
@section('page-description', 'Pantau pesanan, progres jahitan, estimasi selesai, dan pembayaran Anda.')

@section('styles')
<style>
    .orders-page {
        --rose: #b8898d;
        --rose-dark: #9f7378;
        --rose-light: #f2e3e0;
        --ink: #4b3832;
        --muted: #88736d;
        --border: #eadbd2;
        --surface: #fffaf6;
        --white: #ffffff;
        color: var(--ink);
        min-width: 0;
        width: 100%;
    }

    .orders-page *,
    .orders-page *::before,
    .orders-page *::after {
        box-sizing: border-box;
    }

    .orders-page a {
        -webkit-tap-highlight-color: transparent;
    }

    .orders-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 18px;
        flex-wrap: wrap;
        margin-bottom: 22px;
    }

    .orders-intro {
        min-width: 0;
    }

    .orders-intro h2 {
        margin: 0;
        color: var(--ink);
        font-size: clamp(1.3rem, 2vw, 1.7rem);
        font-weight: 800;
        letter-spacing: -.04em;
    }

    .orders-intro p {
        margin: 7px 0 0;
        color: var(--muted);
        font-size: .9rem;
        line-height: 1.7;
    }

    .orders-count {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 10px 15px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        color: var(--rose-dark);
        font-size: .85rem;
        font-weight: 750;
        white-space: nowrap;
    }

    .count-icon {
        display: grid;
        place-items: center;
        width: 30px;
        height: 30px;
        border-radius: 9px;
        background: var(--rose-light);
        font-size: 1rem;
    }

    .orders-alert {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 14px 16px;
        margin-bottom: 18px;
        border: 1px solid;
        border-radius: 13px;
        font-size: .9rem;
        line-height: 1.6;
    }

    .orders-alert-icon {
        display: grid;
        place-items: center;
        flex: 0 0 25px;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        font-weight: 800;
    }

    .orders-alert-success {
        color: #386a42;
        background: #edf7ed;
        border-color: #d3e9d2;
    }

    .orders-alert-success .orders-alert-icon {
        background: #d8edd7;
    }

    .orders-alert-error {
        color: #984b48;
        background: #fff0ef;
        border-color: #f0d2ce;
    }

    .orders-alert-error .orders-alert-icon {
        background: #f9dedd;
    }

    .orders-summary {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .summary-card {
        position: relative;
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
        padding: 19px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        box-shadow: 0 5px 16px rgba(92, 61, 54, .035);
    }

    .summary-icon {
        display: grid;
        place-items: center;
        flex: 0 0 47px;
        width: 47px;
        height: 47px;
        border-radius: 14px;
        background: var(--rose-light);
        font-size: 1.35rem;
    }

    .summary-icon.green {
        background: #e4f1e2;
    }

    .summary-icon.gold {
        background: #fff0d0;
    }

    .summary-info {
        min-width: 0;
    }

    .summary-info span {
        display: block;
        margin-bottom: 5px;
        color: var(--muted);
        font-size: .79rem;
        line-height: 1.5;
    }

    .summary-info strong {
        display: block;
        color: var(--ink);
        font-size: 1.45rem;
        font-weight: 850;
        line-height: 1.2;
    }

    .orders-panel {
        overflow: hidden;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 18px;
        box-shadow: 0 8px 28px rgba(92, 61, 54, .045);
    }

    .orders-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 22px 24px;
        background: var(--surface);
        border-bottom: 1px solid #f0e4dd;
    }

    .orders-panel-heading {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
    }

    .panel-icon {
        display: grid;
        place-items: center;
        flex: 0 0 42px;
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: var(--rose-light);
        font-size: 1.2rem;
    }

    .orders-panel-header h3 {
        margin: 0;
        color: #5d4843;
        font-size: 1rem;
        font-weight: 800;
    }

    .orders-panel-header p {
        margin: 5px 0 0;
        color: var(--muted);
        font-size: .82rem;
        line-height: 1.6;
    }

    .orders-table-wrap {
        width: 100%;
        overflow-x: auto;
        overscroll-behavior-x: contain;
        scrollbar-width: thin;
        scrollbar-color: #d6b7b3 #fbf2ed;
    }

    .orders-table {
        width: 100%;
        min-width: 1060px;
        border-collapse: separate;
        border-spacing: 0;
        text-align: left;
    }

    .orders-table th {
        padding: 15px 16px;
        background: #f8eee8;
        color: #775e56;
        font-size: .72rem;
        font-weight: 850;
        text-transform: uppercase;
        letter-spacing: .045em;
        white-space: nowrap;
    }

    .orders-table td {
        padding: 17px 16px;
        border-bottom: 1px solid #f3e9e3;
        color: #604e48;
        font-size: .84rem;
        vertical-align: middle;
        white-space: nowrap;
    }

    .orders-table tbody tr {
        transition: background .18s ease;
    }

    .orders-table tbody tr:hover {
        background: #fffaf7;
    }

    .orders-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .order-number {
        display: inline-grid;
        place-items: center;
        min-width: 32px;
        height: 32px;
        padding: 0 7px;
        background: #f4e7e1;
        border-radius: 10px;
        color: var(--rose-dark);
        font-size: .82rem;
        font-weight: 850;
    }

    .order-item-name {
        color: var(--ink);
        font-weight: 800;
    }

    .order-price {
        color: #5b403b !important;
        font-weight: 850;
    }

    .order-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        max-width: 190px;
        padding: 7px 10px;
        border-radius: 8px;
        background: #f1e9e4;
        color: #765c53;
        font-size: .74rem;
        font-weight: 750;
        line-height: 1.4;
        white-space: normal;
    }

    .order-status::before {
        content: '';
        flex: 0 0 6px;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-lunas {
        background: #e4f2e2;
        color: #427448;
    }

    .status-pending {
        background: #fff1d0;
        color: #896927;
    }

    .status-progress {
        background: #e9eafe;
        color: #575ca0;
    }

    .status-rejected {
        background: #fce8e5;
        color: #a34e49;
    }

    .status-neutral {
        background: #eee9e6;
        color: #786761;
    }

    .order-payment-cell {
        min-width: 130px;
    }

    .btn-order-pay {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        min-height: 38px;
        padding: 9px 14px;
        background: var(--rose);
        border: 1px solid var(--rose);
        border-radius: 10px;
        color: #fff !important;
        font-size: .8rem;
        font-weight: 800;
        text-decoration: none !important;
        transition: background .18s ease, transform .18s ease, box-shadow .18s ease;
    }

    .btn-order-pay:hover {
        background: var(--rose-dark);
        border-color: var(--rose-dark);
        box-shadow: 0 5px 13px rgba(159, 115, 120, .2);
        transform: translateY(-1px);
    }

    .btn-order-pay:focus-visible,
    .orders-table-wrap:focus-visible {
        outline: 3px solid #d6a9ae;
        outline-offset: 3px;
    }

    .payment-complete {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 10px;
        border-radius: 9px;
        background: #e4f2e2;
        color: #427448;
        font-size: .78rem;
        font-weight: 800;
    }

    .payment-disabled {
        display: inline-block;
        padding: 8px 10px;
        border-radius: 9px;
        background: #fce8e5;
        color: #a34e49;
        font-size: .76rem;
        font-weight: 750;
    }

    .orders-empty {
        padding: 54px 20px !important;
        text-align: center;
        white-space: normal !important;
    }

    .empty-icon {
        display: grid;
        place-items: center;
        width: 65px;
        height: 65px;
        margin: 0 auto 16px;
        background: #f7e9e3;
        border-radius: 20px;
        font-size: 1.8rem;
    }

    .orders-empty strong {
        display: block;
        margin-bottom: 8px;
        color: #5d4843;
        font-size: 1.05rem;
    }

    .orders-empty span {
        display: block;
        max-width: 380px;
        margin: 0 auto;
        color: var(--muted);
        font-size: .87rem;
        line-height: 1.7;
    }

    .orders-empty a {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-top: 18px;
        padding: 10px 15px;
        background: var(--rose);
        border-radius: 10px;
        color: #fff;
        font-size: .84rem;
        font-weight: 800;
        text-decoration: none;
    }

    .orders-table-hint {
        display: none;
        padding: 11px 16px;
        background: #fff8f3;
        border-top: 1px solid #f0e4dd;
        color: var(--muted);
        font-size: .77rem;
        line-height: 1.6;
    }

/* INFORMASI PENGAMBILAN */
.pickup-panel {
    margin-top: 24px;
    padding: 25px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 18px;
    box-shadow: 0 8px 28px rgba(92, 61, 54, .045);
}

.pickup-header {
    margin-bottom: 20px;
}

.pickup-header h3 {
    margin: 0;
    color: var(--ink);
    font-size: 1.15rem;
    font-weight: 850;
}

.pickup-header p {
    margin: 7px 0 0;
    color: var(--muted);
    font-size: .84rem;
    line-height: 1.8;
}

.pickup-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 15px;
}

.pickup-card {
    min-width: 0;
    padding: 19px;
    background: #fffdfb;
    border: 1px solid var(--border);
    border-radius: 14px;
}

.pickup-card h4 {
    margin: 0 0 9px;
    color: #5d4843;
    font-size: .95rem;
    font-weight: 800;
}

.pickup-card p {
    margin: 0;
    color: var(--muted);
    font-size: .83rem;
    line-height: 1.8;
}

.pickup-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 7px;
    margin-top: 12px;
}

.pickup-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: .73rem;
    font-weight: 750;
}

.pickup-badge-progress {
    background: #ecd9ca;
    color: #795d50;
}

.pickup-badge-ready {
    background: #dceaf8;
    color: #41688e;
}

.pickup-badge-done {
    background: #dcebd9;
    color: #477149;
}

@media (max-width: 640px) {
    .pickup-panel {
        padding: 18px;
        border-radius: 14px;
    }

    .pickup-grid {
        grid-template-columns: 1fr;
    }

    .pickup-card {
        padding: 16px;
    }

    .pickup-header h3 {
        font-size: 1.05rem;
    }
}


    @media (max-width: 1024px) {
        .orders-summary {
            gap: 12px;
        }

        .summary-card {
            padding: 16px;
            gap: 11px;
        }

        .summary-icon {
            flex-basis: 42px;
            width: 42px;
            height: 42px;
        }
    }

    @media (max-width: 768px) {
        .orders-toolbar {
            align-items: flex-start;
        }

        .orders-summary {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .summary-card:last-child {
            grid-column: 1 / -1;
        }

        .orders-panel {
            border-radius: 14px;
        }

        .orders-panel-header {
            padding: 17px;
        }

        .orders-table-hint {
            display: block;
        }
    }

    @media (max-width: 480px) {
        .orders-toolbar {
            gap: 12px;
        }

        .orders-count {
            padding: 8px 11px;
            font-size: .78rem;
        }

        .orders-intro p {
            font-size: .84rem;
        }

        .orders-summary {
            gap: 10px;
        }

        .summary-card {
            padding: 13px;
            align-items: flex-start;
            flex-direction: column;
            gap: 10px;
            border-radius: 13px;
        }

        .summary-icon {
            flex-basis: 38px;
            width: 38px;
            height: 38px;
            border-radius: 11px;
            font-size: 1.1rem;
        }

        .summary-info span {
            font-size: .75rem;
        }

        .summary-info strong {
            font-size: 1.25rem;
        }

        .orders-panel-heading {
            align-items: flex-start;
            gap: 10px;
        }

        .panel-icon {
            flex-basis: 36px;
            width: 36px;
            height: 36px;
            font-size: 1rem;
        }

        .orders-panel-header p {
            font-size: .78rem;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .orders-table tbody tr,
        .btn-order-pay {
            transition: none;
        }

        .btn-order-pay:hover {
            transform: none;
        }
    }
</style>
@endsection

@section('content')
@php
    $daftarPesanan = collect($pesanan);

    $jumlahPesanan = $daftarPesanan->count();

    $jumlahSelesai = $daftarPesanan->filter(function ($item) {
        return in_array(
            strtolower(trim((string) ($item->status ?? ''))),
            ['selesai', 'diambil', 'selesai dijahit'],
            true
        );
    })->count();

    $jumlahLunas = $daftarPesanan->filter(function ($item) {
        return strtolower(trim((string) ($item->status_pembayaran ?? ''))) === 'lunas';
    })->count();
@endphp

<div class="orders-page">
    <div class="orders-toolbar">
        <div class="orders-intro">
            <h2>Daftar Pesanan</h2>
            <p>Pantau perkembangan jahitan dan periksa status pembayaran Anda.</p>
        </div>

        <div class="orders-count">
            <span class="count-icon" aria-hidden="true">📋</span>
            <span>{{ $jumlahPesanan }} pesanan</span>
        </div>
    </div>

    @if (session('success'))
        <div class="orders-alert orders-alert-success" role="status">
            <span class="orders-alert-icon" aria-hidden="true">✓</span>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if (session('error'))
        <div class="orders-alert orders-alert-error" role="alert">
            <span class="orders-alert-icon" aria-hidden="true">!</span>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    <div class="orders-summary">
        <div class="summary-card">
            <div class="summary-icon" aria-hidden="true">🧵</div>
            <div class="summary-info">
                <span>Total pesanan</span>
                <strong>{{ $jumlahPesanan }}</strong>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon green" aria-hidden="true">✓</div>
            <div class="summary-info">
                <span>Pesanan selesai</span>
                <strong>{{ $jumlahSelesai }}</strong>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon gold" aria-hidden="true">💳</div>
            <div class="summary-info">
                <span>Pembayaran lunas</span>
                <strong>{{ $jumlahLunas }}</strong>
            </div>
        </div>
    </div>

    <section class="orders-panel" aria-labelledby="orders-heading">
        <div class="orders-panel-header">
            <div class="orders-panel-heading">
                <div class="panel-icon" aria-hidden="true">🪡</div>
                <div>
                    <h3 id="orders-heading">Riwayat Pesanan Anda</h3>
                    <p>Informasi pesanan yang Anda ajukan melalui JAITIN.</p>
                </div>
            </div>
        </div>


<div
    class="orders-table-wrap"
    tabindex="0"
    role="region"
    aria-label="Tabel pesanan. Geser secara horizontal untuk melihat semua kolom."
>
    <table class="orders-table">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Jenis Pakaian</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Tanggal Pesan</th>
                <th scope="col">Tanggal Harapan</th>
                <th scope="col">Estimasi Selesai</th>
                <th scope="col">Status Pengerjaan</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Pembayaran</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($daftarPesanan as $item)
                @php
                    /*
                    |--------------------------------------------------------------------------
                    | STATUS PENGERJAAN DARI UPDATE KARYAWAN
                    |--------------------------------------------------------------------------
                    */
                    $statusPengerjaan = trim(
                        (string) ($item->status_pengerjaan ?? '')
                    );

                    $statusLower = strtolower($statusPengerjaan);

                    $statusTampil = $statusPengerjaan !== ''
                        ? $statusPengerjaan
                        : 'Menunggu Produksi';

                    $statusClass = 'status-progress';

                    if (in_array($statusLower, [
                        'sudah diambil',
                        'diambil',
                    ], true)) {
                        $statusClass = 'status-lunas';
                        $statusTampil = 'Sudah Diambil';

                    } elseif (in_array($statusLower, [
                        'siap diambil',
                        'selesai',
                        'selesai dijahit',
                    ], true)) {
                        $statusClass = 'status-lunas';

                    } elseif (in_array($statusLower, [
                        'menunggu',
                        'menunggu produksi',
                        'menunggu diproses',
                        'pending',
                        'baru',
                    ], true)) {
                        $statusClass = 'status-pending';

                    } elseif (in_array($statusLower, [
                        'dibatalkan',
                        'ditolak',
                        'cancelled',
                        'canceled',
                    ], true)) {
                        $statusClass = 'status-rejected';

                    } elseif ($statusLower === '') {
                        $statusClass = 'status-neutral';
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | STATUS PEMBAYARAN
                    |--------------------------------------------------------------------------
                    */
                    $statusPembayaran = strtolower(trim(
                        (string) ($item->status_pembayaran ?? '')
                    ));

                    $isLunas = in_array($statusPembayaran, [
                        'lunas',
                        'paid',
                        'success',
                        'berhasil',
                        'sukses',
                    ], true);

                    $pesananDibatalkan = in_array($statusLower, [
                        'ditolak',
                        'dibatalkan',
                        'cancelled',
                        'canceled',
                    ], true);

                    /*
                    |--------------------------------------------------------------------------
                    | FORMAT TANGGAL
                    |--------------------------------------------------------------------------
                    */
                    $formatTanggal = function ($tanggal) {
                        if (empty($tanggal)) {
                            return '-';
                        }

                        try {
                            return \Illuminate\Support\Carbon::parse($tanggal)
                                ->format('d M Y');
                        } catch (\Throwable $e) {
                            return '-';
                        }
                    };
                @endphp

                <tr>
                    <td>
                        <span class="order-number">
                            {{ $loop->iteration }}
                        </span>
                    </td>

                    <td>
                        <span class="order-item-name">
                            {{ $item->jenis_pakaian ?? '-' }}
                        </span>
                    </td>

                    <td>{{ $item->jumlah ?? 0 }} pcs</td>

                    <td>
                        {{ $formatTanggal($item->tanggal_pesan ?? null) }}
                    </td>

                    <td>
                        {{ $formatTanggal($item->tanggal_harapan ?? null) }}
                    </td>

                    <td>
                        {{ $formatTanggal($item->estimasi_selesai ?? null) }}
                    </td>

                    <td>
                        <span class="order-status {{ $statusClass }}">
                            {{ $statusTampil }}
                        </span>
                    </td>

                    <td class="order-price">
                        Rp {{ number_format(
                            (float) ($item->total_harga ?? 0),
                            0,
                            ',',
                            '.'
                        ) }}
                    </td>

                    <td class="order-payment-cell">
                        @if ($isLunas)
                            <span class="payment-complete">
                                ✓ Lunas
                            </span>
                        @elseif ($pesananDibatalkan)
                            <span class="payment-disabled">
                                Tidak tersedia
                            </span>
                        @else
                            <a
                                href="{{ route('pelanggan.pembayaran.pay', ['id' => $item->id_pesanan]) }}"
                                class="btn-order-pay"
                                aria-label="Bayar pesanan {{ $item->jenis_pakaian ?? $item->id_pesanan }}"
                            >
                                Bayar <span aria-hidden="true">→</span>
                            </a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="orders-empty">
                        <div class="empty-icon" aria-hidden="true">✂️</div>

                        <strong>Belum ada pesanan</strong>

                        <span>
                            Pesanan jasa jahit yang Anda buat akan tampil di sini.
                            Mulai buat pesanan untuk menggunakan layanan JAITIN.
                        </span>

                        <a href="{{ route('pelanggan.pesanan.create') }}">
                            + Buat Pesanan
                        </a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="orders-table-hint">
    Tip: geser tabel ke samping untuk melihat seluruh informasi pesanan.
</div>
</section>

{{-- INFORMASI PENGAMBILAN BERDASARKAN STATUS PESANAN --}}
<section class="pickup-panel" aria-labelledby="pickup-heading">

    <div class="pickup-header">
        <h3 id="pickup-heading">Informasi Pengambilan</h3>

        <p>
            Informasi berikut mengikuti status pengerjaan pesanan yang
            diperbarui oleh karyawan.
        </p>
    </div>

    <div class="pickup-grid">

        {{-- MENUNGGU JAHITAN SELESAI --}}
        <div class="pickup-card">
            <h4>Menunggu Jahitan Selesai</h4>

            <p>
                Pesanan yang masih dalam proses belum dapat diambil.
                Periksa status pengerjaan pada tabel pesanan secara berkala.
            </p>

            <div class="pickup-badges">
                <span class="pickup-badge pickup-badge-progress">
                    Dalam Pengerjaan
                </span>
            </div>
        </div>

        {{-- PENGAMBILAN PAKAIAN --}}
        <div class="pickup-card">
            <h4>Pengambilan Pakaian</h4>

            <p>
                Status pengambilan akan mengikuti pembaruan karyawan.
                Silakan mengambil pakaian ketika status pesanan sudah
                Siap Diambil.
            </p>

            <div class="pickup-badges">
                @php
                    $pesananSiapDiambil = $daftarPesanan->contains(function ($pesanan) {
                        return in_array(
                            strtolower(trim((string) ($pesanan->status_pengerjaan ?? ''))),
                            ['siap diambil', 'selesai'],
                            true
                        );
                    });

                    $pesananSudahDiambil = $daftarPesanan->contains(function ($pesanan) {
                        return in_array(
                            strtolower(trim((string) ($pesanan->status_pengerjaan ?? ''))),
                            ['sudah diambil', 'diambil'],
                            true
                        );
                    });
                @endphp

                <span class="pickup-badge {{ $pesananSiapDiambil ? 'pickup-badge-ready' : 'pickup-badge-progress' }}">
                    {{ $pesananSiapDiambil ? '✓ Ada Pesanan Siap Diambil' : 'Belum Siap Diambil' }}
                </span>

                <span class="pickup-badge {{ $pesananSudahDiambil ? 'pickup-badge-done' : 'pickup-badge-progress' }}">
                    {{ $pesananSudahDiambil ? '✓ Sudah Diambil' : 'Belum Diambil' }}
                </span>
            </div>
        </div>

    </div>
</section>


</div>
@endsection
