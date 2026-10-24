@extends('layouts.pelanggan')

@section('title', 'Pembayaran Saya - JAITIN')
@section('page-title', 'Pembayaran Saya')
@section('page-description', 'Pantau riwayat transaksi, pembayaran DP, dan pelunasan pesanan jahitan Anda.')

@section('styles')
<style>
    .payment-page {
        --payment-pink: #b8898d;
        --payment-pink-dark: #9f7378;
        --payment-pink-light: #f5e5e3;
        --payment-cream: #fffaf5;
        --payment-ink: #4b3832;
        --payment-muted: #88736d;
        --payment-border: #eadbd2;

        width: 100%;
        min-width: 0;
        color: var(--payment-ink);
    }

    .payment-page *,
    .payment-page *::before,
    .payment-page *::after {
        box-sizing: border-box;
    }

    .payment-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 23px;
    }

    .payment-intro h2 {
        margin: 0;
        font-size: clamp(1.3rem, 2vw, 1.65rem);
        font-weight: 800;
        letter-spacing: -.035em;
        color: var(--payment-ink);
    }

    .payment-intro p {
        margin: 7px 0 0;
        color: var(--payment-muted);
        font-size: .89rem;
        line-height: 1.7;
    }

    .payment-total-badge {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 10px 14px;
        background: var(--payment-cream);
        border: 1px solid var(--payment-border);
        border-radius: 12px;
        color: var(--payment-pink-dark);
        font-size: .82rem;
        font-weight: 800;
        white-space: nowrap;
    }

    .payment-total-badge span:first-child {
        display: grid;
        place-items: center;
        width: 30px;
        height: 30px;
        border-radius: 9px;
        background: var(--payment-pink-light);
    }

    .payment-alert {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 14px 16px;
        margin-bottom: 18px;
        border: 1px solid;
        border-radius: 12px;
        font-size: .88rem;
        line-height: 1.6;
    }

    .payment-alert.success {
        color: #386a42;
        background: #edf7ed;
        border-color: #d3e9d2;
    }

    .payment-alert.error {
        color: #984b48;
        background: #fff0ef;
        border-color: #f0d2ce;
    }

    .payment-alert.warning {
        color: #87651e;
        background: #fff5dc;
        border-color: #f0dfad;
    }

    .payment-summary {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 25px;
    }

    .payment-summary-card {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
        padding: 21px;
        background: var(--payment-cream);
        border: 1px solid var(--payment-border);
        border-radius: 16px;
        box-shadow: 0 5px 18px rgba(90, 62, 49, .035);
    }

    .payment-summary-icon {
        display: grid;
        place-items: center;
        flex: 0 0 47px;
        width: 47px;
        height: 47px;
        border-radius: 14px;
        background: var(--payment-pink-light);
        font-size: 1.3rem;
    }

    .payment-summary-icon.green {
        background: #e4f1e2;
    }

    .payment-summary-icon.gold {
        background: #fff0d0;
    }

    .payment-summary-info {
        min-width: 0;
    }

    .payment-summary-info p {
        margin: 0 0 7px;
        color: var(--payment-muted);
        font-size: .78rem;
        line-height: 1.5;
    }

    .payment-summary-info h3 {
        margin: 0;
        color: var(--payment-ink);
        font-size: clamp(1.05rem, 1.8vw, 1.4rem);
        font-weight: 850;
        line-height: 1.4;
        overflow-wrap: anywhere;
    }

    .payment-section {
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--payment-border);
        border-radius: 17px;
        box-shadow: 0 8px 25px rgba(92, 61, 54, .04);
    }

    .payment-section-header {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 21px 23px;
        background: var(--payment-cream);
        border-bottom: 1px solid #f0e4dd;
    }

    .payment-section-icon {
        display: grid;
        place-items: center;
        flex: 0 0 42px;
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: var(--payment-pink-light);
        font-size: 1.2rem;
    }

    .payment-section-header h3 {
        margin: 0;
        color: #5d4843;
        font-size: 1rem;
        font-weight: 800;
    }

    .payment-section-header p {
        margin: 5px 0 0;
        color: var(--payment-muted);
        font-size: .82rem;
        line-height: 1.6;
    }

    .payment-table-wrap {
        width: 100%;
        overflow-x: auto;
        overscroll-behavior-x: contain;
        scrollbar-width: thin;
        scrollbar-color: #d6b7b3 #fbf2ed;
    }

    .payment-table {
        width: 100%;
        min-width: 950px;
        border-collapse: separate;
        border-spacing: 0;
        text-align: left;
    }

    .payment-table th {
        padding: 14px 15px;
        background: #f8eee8;
        color: #775e56;
        font-size: .72rem;
        font-weight: 850;
        text-transform: uppercase;
        letter-spacing: .035em;
        white-space: nowrap;
    }

    .payment-table td {
        padding: 16px 15px;
        border-bottom: 1px solid #f2e8e2;
        color: #604e48;
        font-size: .83rem;
        vertical-align: middle;
    }

    .payment-table tbody tr {
        transition: background .18s ease;
    }

    .payment-table tbody tr:hover {
        background: #fffaf7;
    }

    .payment-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .transaction-id {
        color: var(--payment-pink-dark);
        font-weight: 800;
        overflow-wrap: anywhere;
    }

    .transaction-order {
        color: var(--payment-ink);
        font-weight: 800;
    }

    .transaction-name {
        display: block;
        margin-top: 5px;
        color: var(--payment-muted);
        font-size: .76rem;
        white-space: normal;
    }

    .payment-type {
        display: inline-block;
        padding: 6px 9px;
        background: #f4e8e2;
        border-radius: 8px;
        color: #795b53;
        font-size: .73rem;
        font-weight: 750;
    }

    .payment-amount {
        color: #5b403b !important;
        font-weight: 850;
        white-space: nowrap;
    }

    .payment-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 10px;
        border-radius: 8px;
        font-size: .73rem;
        font-weight: 800;
        line-height: 1.4;
        white-space: nowrap;
    }

    .payment-status::before {
        content: '';
        width: 6px;
        height: 6px;
        flex: 0 0 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .payment-status.success {
        color: #427448;
        background: #e4f2e2;
    }

    .payment-status.pending {
        color: #896927;
        background: #fff1d0;
    }

    .payment-status.failed {
        color: #a34e49;
        background: #fce8e5;
    }

    .payment-status.neutral {
        color: #786761;
        background: #eee9e6;
    }

    .payment-empty {
        padding: 48px 20px !important;
        text-align: center;
    }

    .payment-empty-icon {
        display: grid;
        place-items: center;
        width: 62px;
        height: 62px;
        margin: 0 auto 15px;
        background: var(--payment-pink-light);
        border-radius: 19px;
        font-size: 1.7rem;
    }

    .payment-empty strong {
        display: block;
        margin-bottom: 8px;
        color: #5d4843;
        font-size: 1rem;
    }

    .payment-empty p {
        max-width: 390px;
        margin: 0 auto;
        color: var(--payment-muted);
        font-size: .85rem;
        line-height: 1.7;
        white-space: normal;
    }

    .payment-back-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 18px;
        padding: 10px 15px;
        border-radius: 10px;
        background: var(--payment-pink);
        color: #fff !important;
        font-size: .82rem;
        font-weight: 800;
        text-decoration: none !important;
        transition: background .18s ease, transform .18s ease;
    }

    .payment-back-link:hover {
        background: var(--payment-pink-dark);
        transform: translateY(-1px);
    }

    .payment-table-hint {
        display: none;
        padding: 11px 15px;
        background: #fff8f3;
        border-top: 1px solid #f0e4dd;
        color: var(--payment-muted);
        font-size: .77rem;
        line-height: 1.6;
    }

    @media (max-width: 1000px) {
        .payment-summary {
            gap: 12px;
        }

        .payment-summary-card {
            padding: 16px;
            gap: 11px;
        }

        .payment-summary-icon {
            flex-basis: 41px;
            width: 41px;
            height: 41px;
        }
    }

    @media (max-width: 760px) {
        .payment-summary {
            grid-template-columns: 1fr;
        }

        .payment-summary-card {
            padding: 17px;
        }

        .payment-section {
            border-radius: 14px;
        }

        .payment-section-header {
            padding: 17px;
        }

        .payment-table-hint {
            display: block;
        }
    }

    @media (max-width: 480px) {
        .payment-toolbar {
            align-items: flex-start;
            gap: 12px;
        }

        .payment-intro p {
            font-size: .83rem;
        }

        .payment-total-badge {
            padding: 8px 10px;
            font-size: .77rem;
        }

        .payment-section-header {
            gap: 10px;
        }

        .payment-section-icon {
            flex-basis: 36px;
            width: 36px;
            height: 36px;
        }

        .payment-section-header p {
            font-size: .77rem;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .payment-page *,
        .payment-page *::before,
        .payment-page *::after {
            transition: none !important;
        }
    }
</style>
@endsection

@section('content')
@php
    $daftarPembayaran = collect($pembayaran ?? []);

    $statusBerhasil = [
        'berhasil',
        'sukses',
        'lunas',
        'success',
        'paid',
    ];

    $statusMenunggu = [
        'menunggu verifikasi',
        'menunggu',
        'pending',
    ];

    $statusGagal = [
        'ditolak',
        'gagal',
        'failed',
        'cancelled',
        'canceled',
        'dibatalkan',
        'expire',
        'expired',
    ];

    $totalDibayar = $daftarPembayaran
        ->filter(function ($item) use ($statusBerhasil) {
            return in_array(
                strtolower(trim((string) ($item->status_pembayaran ?? ''))),
                $statusBerhasil,
                true
            );
        })
        ->sum('jumlah');

    $jumlahMenunggu = $daftarPembayaran
        ->filter(function ($item) use ($statusMenunggu) {
            return in_array(
                strtolower(trim((string) ($item->status_pembayaran ?? ''))),
                $statusMenunggu,
                true
            );
        })
        ->count();
@endphp

<div class="payment-page">
    <div class="payment-toolbar">
        <div class="payment-intro">
            <h2>Ringkasan Pembayaran</h2>
            <p>Lihat transaksi, pembayaran uang muka (DP), dan pelunasan pesanan Anda.</p>
        </div>

        <div class="payment-total-badge">
            <span aria-hidden="true">💳</span>
            <span>{{ $daftarPembayaran->count() }} transaksi</span>
        </div>
    </div>

    @if (session('success'))
        <div class="payment-alert success" role="status">
            <span aria-hidden="true">✓</span>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if (session('error'))
        <div class="payment-alert error" role="alert">
            <span aria-hidden="true">!</span>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    @if (session('warning'))
        <div class="payment-alert warning" role="status">
            <span aria-hidden="true">!</span>
            <div>{{ session('warning') }}</div>
        </div>
    @endif

    <div class="payment-summary">
        <div class="payment-summary-card">
            <div class="payment-summary-icon green" aria-hidden="true">✓</div>
            <div class="payment-summary-info">
                <p>Total pembayaran berhasil</p>
                <h3>Rp {{ number_format((float) $totalDibayar, 0, ',', '.') }}</h3>
            </div>
        </div>

        <div class="payment-summary-card">
            <div class="payment-summary-icon" aria-hidden="true">🧾</div>
            <div class="payment-summary-info">
                <p>Total transaksi</p>
                <h3>{{ $daftarPembayaran->count() }} transaksi</h3>
            </div>
        </div>

        <div class="payment-summary-card">
            <div class="payment-summary-icon gold" aria-hidden="true">⏳</div>
            <div class="payment-summary-info">
                <p>Menunggu pembayaran/verifikasi</p>
                <h3>{{ $jumlahMenunggu }} transaksi</h3>
            </div>
        </div>
    </div>

    <section class="payment-section" aria-labelledby="payment-history-heading">
        <div class="payment-section-header">
            <div class="payment-section-icon" aria-hidden="true">💳</div>
            <div>
                <h3 id="payment-history-heading">Riwayat Transaksi</h3>
                <p>Daftar pembayaran yang tercatat untuk pesanan Anda.</p>
            </div>
        </div>

        @if ($daftarPembayaran->isEmpty())
            <div class="payment-empty">
                <div class="payment-empty-icon" aria-hidden="true">🧾</div>
                <strong>Belum Ada Riwayat Pembayaran</strong>
                <p>
                    Transaksi pembayaran akan muncul di halaman ini
                    setelah Anda memulai pembayaran pesanan.
                </p>
                <a href="{{ route('pelanggan.pesanan.index') }}" class="payment-back-link">
                    Lihat Pesanan Saya <span aria-hidden="true">→</span>
                </a>
            </div>
        @else
            <div
                class="payment-table-wrap"
                role="region"
                tabindex="0"
                aria-label="Tabel riwayat pembayaran. Geser secara horizontal untuk melihat semua kolom."
            >
                <table class="payment-table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">ID Transaksi</th>
                            <th scope="col">Pesanan</th>
                            <th scope="col">Jenis Pembayaran</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Metode</th>
                            <th scope="col">Nominal</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($daftarPembayaran as $item)
                            @php
                                $status = strtolower(trim((string) ($item->status_pembayaran ?? '')));
                                $statusClass = 'neutral';

                                if (in_array($status, $statusBerhasil, true)) {
                                    $statusClass = 'success';
                                } elseif (in_array($status, $statusMenunggu, true)) {
                                    $statusClass = 'pending';
                                } elseif (in_array($status, $statusGagal, true)) {
                                    $statusClass = 'failed';
                                }

                                $tanggalTampil = '-';

                                if (!empty($item->tanggal_pembayaran)) {
                                    try {
                                        $tanggalTampil = \Illuminate\Support\Carbon::parse(
                                            $item->tanggal_pembayaran
                                        )->format('d M Y, H:i');
                                    } catch (\Throwable $e) {
                                        $tanggalTampil = '-';
                                    }
                                }
                            @endphp

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <span class="transaction-id">
                                        {{ $item->transaksi_id ?: '-' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="transaction-order">
                                        #{{ $item->id_pesanan ?? '-' }}
                                    </span>

                                    @if ($item->pesanan)
                                        <span class="transaction-name">
                                            {{ $item->pesanan->jenis_pakaian ?? 'Pesanan jahit' }}
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <span class="payment-type">
                                        {{ $item->jenis_pembayaran ?: '-' }}
                                    </span>
                                </td>

                                <td>{{ $tanggalTampil }}</td>

                                <td>{{ $item->metode_pembayaran ?: '-' }}</td>

                                <td class="payment-amount">
                                    Rp {{ number_format((float) ($item->jumlah ?? 0), 0, ',', '.') }}
                                </td>

                                <td>
                                    <span class="payment-status {{ $statusClass }}">
                                        {{ $item->status_pembayaran ?: 'Belum ada status' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="payment-table-hint">
                Geser tabel ke samping untuk melihat seluruh detail transaksi.
            </div>
        @endif
    </section>
</div>
@endsection
