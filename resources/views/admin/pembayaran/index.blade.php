@extends('layouts.admin')

@section('title', 'Manajemen Pembayaran - JAITIN')
@section('page-title', 'Manajemen Pembayaran')
@section('page-description', 'Pantau dan kelola transaksi pembayaran pelanggan JAITIN.')

@section('styles')
<style>
    .payment-page {
        --pay-primary: #b8898d;
        --pay-primary-dark: #986a70;
        --pay-cream: #fffaf6;
        --pay-bg: #f8f2ed;
        --pay-text: #493936;
        --pay-muted: #8d7974;
        --pay-border: #eee2dc;
        color: var(--pay-text);
    }

    .payment-page * {
        box-sizing: border-box;
    }

    .payment-hero {
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        overflow: hidden;
        padding: 30px;
        margin-bottom: 25px;
        border-radius: 22px;
        background: linear-gradient(120deg, #b8898d, #d5aeb0 65%, #ead0cb);
        color: #fff;
        box-shadow: 0 12px 28px rgba(152, 106, 112, .15);
    }

    .payment-hero::after {
        content: '';
        position: absolute;
        width: 210px;
        height: 210px;
        right: 7%;
        top: -120px;
        border: 35px solid rgba(255,255,255,.12);
        border-radius: 50%;
        pointer-events: none;
    }

    .payment-hero-content {
        position: relative;
        z-index: 1;
    }

    .payment-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 12px;
        padding: 7px 11px;
        border: 1px solid rgba(255,255,255,.28);
        border-radius: 30px;
        background: rgba(255,255,255,.15);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .payment-hero h2 {
        margin: 0 0 9px;
        color: #fff;
        font-size: clamp(23px, 3vw, 31px);
        font-weight: 750;
        letter-spacing: -.7px;
    }

    .payment-hero p {
        max-width: 570px;
        margin: 0;
        color: rgba(255,255,255,.88);
        font-size: 14px;
        line-height: 1.8;
    }

    .payment-hero-icon {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 76px;
        height: 76px;
        border: 1px solid rgba(255,255,255,.35);
        border-radius: 23px;
        background: rgba(255,255,255,.16);
        font-size: 32px;
    }

    .payment-alert {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 15px 17px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 13px;
        font-size: 13px;
        line-height: 1.7;
    }

    .payment-alert i {
        margin-top: 3px;
        font-size: 17px;
    }

    .payment-alert-success {
        color: #416b4a;
        background: #edf7ee;
        border-color: #d4ead6;
    }

    .payment-alert-error {
        color: #944f55;
        background: #fff0f0;
        border-color: #f0d2d3;
    }

    .payment-alert ul {
        padding-left: 18px;
        margin: 6px 0 0;
    }

    .payment-summary {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 17px;
        margin-bottom: 25px;
    }

    .payment-summary-card {
        position: relative;
        min-width: 0;
        overflow: hidden;
        padding: 21px;
        border: 1px solid var(--pay-border);
        border-radius: 18px;
        background: var(--pay-cream);
        box-shadow: 0 5px 18px rgba(91, 65, 56, .035);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .payment-summary-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 24px rgba(91, 65, 56, .07);
    }

    .payment-summary-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 18px;
    }

    .payment-summary-label {
        margin: 0;
        color: var(--pay-muted);
        font-size: 12px;
        font-weight: 600;
        line-height: 1.6;
    }

    .payment-summary-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 43px;
        height: 43px;
        border-radius: 14px;
        background: #f4e6e4;
        color: #a7747b;
        font-size: 18px;
    }

    .payment-summary-card:nth-child(2) .payment-summary-icon {
        background: #e9f3e9;
        color: #5d8863;
    }

    .payment-summary-card:nth-child(3) .payment-summary-icon {
        background: #f8eddb;
        color: #a37c43;
    }

    .payment-summary-card:nth-child(4) .payment-summary-icon {
        background: #eee8fa;
        color: #8066a5;
    }

    .payment-summary-value {
        margin: 0;
        color: var(--pay-text);
        font-size: clamp(23px, 2.2vw, 29px);
        font-weight: 800;
        letter-spacing: -.8px;
        overflow-wrap: anywhere;
    }

    .payment-summary-card:nth-child(2) .payment-summary-value {
        color: #56805d;
    }

    .payment-summary-card:nth-child(3) .payment-summary-value {
        color: #a37a40;
    }

    .payment-summary-card:nth-child(4) .payment-summary-value {
        color: #986a70;
        font-size: clamp(18px, 1.8vw, 23px);
    }

    .payment-summary-foot {
        margin: 8px 0 0;
        color: #a18d87;
        font-size: 11px;
        line-height: 1.5;
    }

    .payment-box {
        overflow: hidden;
        border: 1px solid var(--pay-border);
        border-radius: 20px;
        background: var(--pay-cream);
        box-shadow: 0 6px 22px rgba(91, 65, 56, .04);
    }

    .payment-box-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        padding: 24px 25px;
        border-bottom: 1px solid var(--pay-border);
    }

    .payment-header-title {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .payment-header-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        flex-shrink: 0;
        border-radius: 14px;
        background: #f4e6e4;
        color: var(--pay-primary-dark);
        font-size: 19px;
    }

    .payment-box-header h3 {
        margin: 0 0 5px;
        color: var(--pay-text);
        font-size: 18px;
        font-weight: 750;
    }

    .payment-box-header p {
        margin: 0;
        color: var(--pay-muted);
        font-size: 12px;
        line-height: 1.7;
    }

    .payment-total-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 12px;
        border-radius: 10px;
        background: #f5e8e6;
        color: #94676c;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .payment-filter-wrap {
        padding: 20px 25px;
        border-bottom: 1px solid var(--pay-border);
        background: #fffdfb;
    }

    .payment-filter-label {
        display: block;
        margin-bottom: 11px;
        color: #78635e;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .7px;
        text-transform: uppercase;
    }

    .payment-filter {
        display: grid;
        grid-template-columns: minmax(200px, 1.6fr) repeat(2, minmax(140px, .8fr)) auto auto;
        gap: 10px;
    }

    .payment-input-wrap {
        position: relative;
        min-width: 0;
    }

    .payment-input-wrap > i {
        position: absolute;
        top: 50%;
        left: 13px;
        color: #ad9390;
        font-size: 14px;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .payment-filter input,
    .payment-filter select {
        width: 100%;
        min-width: 0;
        height: 43px;
        padding: 10px 12px;
        border: 1px solid #e8d9d2;
        border-radius: 11px;
        outline: none;
        background: #fff;
        color: var(--pay-text);
        font-family: inherit;
        font-size: 12px;
        transition: border-color .2s, box-shadow .2s;
    }

    .payment-filter input {
        padding-left: 37px;
    }

    .payment-filter input:focus,
    .payment-filter select:focus {
        border-color: var(--pay-primary);
        box-shadow: 0 0 0 3px rgba(184,137,141,.13);
    }

    .payment-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 43px;
        padding: 10px 15px;
        border: 1px solid transparent;
        border-radius: 11px;
        background: var(--pay-primary);
        color: #fff;
        text-decoration: none;
        font-family: inherit;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
        cursor: pointer;
        transition: background .2s, transform .2s;
    }

    .payment-btn:hover {
        background: var(--pay-primary-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .payment-btn-reset {
        border-color: #eadbd4;
        background: #fff;
        color: #7d6660;
    }

    .payment-btn-reset:hover {
        border-color: #dec6c0;
        background: #f8efeb;
        color: #6c514b;
    }

    .payment-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .payment-table {
        width: 100%;
        min-width: 1150px;
        border-collapse: separate;
        border-spacing: 0;
    }

    .payment-table thead th {
        padding: 15px 14px;
        border-bottom: 1px solid #e9dbd5;
        background: #f7ede8;
        color: #816a64;
        text-align: left;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .55px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .payment-table thead th:first-child,
    .payment-table tbody td:first-child {
        padding-left: 25px;
    }

    .payment-table tbody td {
        padding: 16px 14px;
        border-bottom: 1px solid #f0e6e0;
        color: #67534e;
        font-size: 12px;
        vertical-align: middle;
    }

    .payment-table tbody tr {
        transition: background .18s;
    }

    .payment-table tbody tr:hover {
        background: #fff4ef;
    }

    .payment-table tbody tr:last-child td {
        border-bottom: none;
    }

    .payment-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 29px;
        height: 29px;
        padding: 0 7px;
        border-radius: 9px;
        background: #f4e8e3;
        color: #986f71;
        font-size: 11px;
        font-weight: 800;
    }

    .payment-id {
        color: #986a70;
        font-weight: 800;
        white-space: nowrap;
    }

    .payment-customer {
        display: flex;
        align-items: center;
        gap: 9px;
        min-width: 135px;
    }

    .payment-customer-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        border-radius: 11px;
        background: #f1e2df;
        color: #986a70;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .payment-customer-name {
        max-width: 160px;
        overflow: hidden;
        color: #55413d;
        font-size: 12px;
        font-weight: 700;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .payment-amount {
        color: #527b59;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    .payment-date {
        min-width: 105px;
        color: #6d5b55;
        line-height: 1.7;
        white-space: nowrap;
    }

    .payment-date i {
        margin-right: 5px;
        color: #b18c8b;
    }

    .payment-method,
    .payment-type {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 9px;
        border-radius: 8px;
        background: #f7eee9;
        color: #866c64;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .payment-method i,
    .payment-type i {
        font-size: 11px;
    }

    .payment-transaction {
        display: inline-block;
        max-width: 145px;
        overflow: hidden;
        color: #8b7771;
        font-family: monospace;
        font-size: 11px;
        text-overflow: ellipsis;
        white-space: nowrap;
        vertical-align: middle;
    }

    .payment-muted {
        color: #b3a39d;
    }

    .payment-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 10px;
        border: 1px solid transparent;
        border-radius: 30px;
        font-size: 10px;
        font-weight: 800;
        white-space: nowrap;
    }

    .payment-status i {
        font-size: 10px;
    }

    .payment-status-success {
        border-color: #d8e9d9;
        background: #edf6ed;
        color: #4d7954;
    }

    .payment-status-pending {
        border-color: #f0dfc1;
        background: #fff5e3;
        color: #9b753b;
    }

    .payment-status-failed {
        border-color: #f0d5d5;
        background: #fff0f0;
        color: #a05459;
    }

    .payment-status-other {
        border-color: #e8d9e4;
        background: #f8eff6;
        color: #916783;
    }

    .payment-empty {
        padding: 55px 20px !important;
        color: #9a8580 !important;
        text-align: center;
    }

    .payment-empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 62px;
        height: 62px;
        margin: 0 auto 14px;
        border-radius: 20px;
        background: #f6e9e5;
        color: #b8898d;
        font-size: 25px;
    }

    .payment-empty strong {
        display: block;
        margin-bottom: 6px;
        color: #6f5752;
        font-size: 14px;
    }

    .payment-empty p {
        margin: 0;
        font-size: 12px;
        line-height: 1.8;
    }

    .payment-pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        padding: 19px 25px;
        border-top: 1px solid var(--pay-border);
        color: var(--pay-muted);
        font-size: 12px;
    }

    .payment-pagination strong {
        color: #6c514b;
    }

    .payment-pagination-links {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .payment-pagination-links a,
    .payment-pagination-links span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 35px;
        padding: 7px 11px;
        border: 1px solid #eadbd4;
        border-radius: 9px;
        background: #fff;
        color: #8f6268;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
    }

    .payment-pagination-links a:hover {
        border-color: #cba2a4;
        background: #fbf0ed;
    }

    .payment-pagination-links .current {
        border-color: var(--pay-primary);
        background: var(--pay-primary);
        color: #fff;
    }

    .payment-note {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 15px 20px;
        margin: 0;
        border-top: 1px solid var(--pay-border);
        background: #fffdfb;
        color: #8d7974;
        font-size: 11px;
        line-height: 1.8;
    }

    .payment-note i {
        margin-top: 3px;
        color: #b8898d;
    }

    @media (max-width: 1200px) {
        .payment-summary {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .payment-filter {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .payment-filter .payment-input-wrap:first-child {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 768px) {
        .payment-hero {
            padding: 23px 20px;
            border-radius: 17px;
        }

        .payment-hero-icon {
            width: 55px;
            height: 55px;
            border-radius: 16px;
            font-size: 24px;
        }

        .payment-summary {
            gap: 12px;
        }

        .payment-summary-card {
            padding: 17px;
            border-radius: 15px;
        }

        .payment-summary-top {
            margin-bottom: 12px;
        }

        .payment-summary-icon {
            width: 37px;
            height: 37px;
            border-radius: 12px;
        }

        .payment-box {
            border-radius: 16px;
        }

        .payment-box-header {
            align-items: flex-start;
            padding: 19px 16px;
        }

        .payment-header-icon {
            width: 39px;
            height: 39px;
        }

        .payment-box-header h3 {
            font-size: 16px;
        }

        .payment-total-badge {
            display: none;
        }

        .payment-filter-wrap {
            padding: 17px 16px;
        }

        .payment-filter {
            grid-template-columns: 1fr;
        }

        .payment-filter .payment-input-wrap:first-child {
            grid-column: auto;
        }

        .payment-filter .payment-btn {
            width: 100%;
        }

        .payment-table {
            min-width: 1050px;
        }

        .payment-table thead th:first-child,
        .payment-table tbody td:first-child {
            padding-left: 16px;
        }

        .payment-pagination {
            padding: 17px 16px;
        }

        .payment-note {
            padding: 14px 16px;
        }
    }

    @media (max-width: 420px) {
        .payment-hero-icon {
            display: none;
        }

        .payment-summary {
            grid-template-columns: 1fr;
        }

        .payment-summary-card {
            padding: 16px;
        }

        .payment-summary-value {
            font-size: 25px;
        }

        .payment-pagination {
            align-items: flex-start;
            flex-direction: column;
        }

        .payment-pagination-links {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="payment-page">

    {{-- Hero --}}
    <section class="payment-hero">
        <div class="payment-hero-content">
            <div class="payment-eyebrow">
                <i class="fas fa-shield-halved"></i>
                Keuangan JAITIN
            </div>

            <h2>Manajemen Pembayaran</h2>

            <p>
                Pantau transaksi, periksa status pembayaran, dan lihat ringkasan
                dana yang diterima melalui satu halaman pengelolaan.
            </p>
        </div>

        <div class="payment-hero-icon">
            <i class="fas fa-wallet"></i>
        </div>
    </section>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="payment-alert payment-alert-success">
            <i class="fas fa-circle-check"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if (session('error'))
        <div class="payment-alert payment-alert-error">
            <i class="fas fa-circle-exclamation"></i>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="payment-alert payment-alert-error">
            <i class="fas fa-triangle-exclamation"></i>
            <div>
                <strong>Terjadi kesalahan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- Ringkasan transaksi --}}
    <section class="payment-summary">
        <div class="payment-summary-card">
            <div class="payment-summary-top">
                <p class="payment-summary-label">Total Transaksi</p>
                <div class="payment-summary-icon">
                    <i class="fas fa-receipt"></i>
                </div>
            </div>

            <h3 class="payment-summary-value">
                {{ number_format($totalTransaksi ?? 0, 0, ',', '.') }}
            </h3>

            <p class="payment-summary-foot">Seluruh transaksi tercatat</p>
        </div>

        <div class="payment-summary-card">
            <div class="payment-summary-top">
                <p class="payment-summary-label">Pembayaran Berhasil</p>
                <div class="payment-summary-icon">
                    <i class="fas fa-circle-check"></i>
                </div>
            </div>

            <h3 class="payment-summary-value">
                {{ number_format($totalBerhasil ?? 0, 0, ',', '.') }}
            </h3>

            <p class="payment-summary-foot">Transaksi terkonfirmasi</p>
        </div>

        <div class="payment-summary-card">
            <div class="payment-summary-top">
                <p class="payment-summary-label">Menunggu Pembayaran</p>
                <div class="payment-summary-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>

            <h3 class="payment-summary-value">
                {{ number_format($totalMenunggu ?? 0, 0, ',', '.') }}
            </h3>

            <p class="payment-summary-foot">Perlu pemantauan lebih lanjut</p>
        </div>

        <div class="payment-summary-card">
            <div class="payment-summary-top">
                <p class="payment-summary-label">Dana Berhasil Diterima</p>
                <div class="payment-summary-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
            </div>

            <h3 class="payment-summary-value">
                Rp {{ number_format((float) ($totalDanaDiterima ?? 0), 0, ',', '.') }}
            </h3>

            <p class="payment-summary-foot">Total nominal pembayaran berhasil</p>
        </div>
    </section>

    {{-- Daftar pembayaran --}}
    <section class="payment-box">
        <div class="payment-box-header">
            <div class="payment-header-title">
                <div class="payment-header-icon">
                    <i class="fas fa-list-check"></i>
                </div>

                <div>
                    <h3>Daftar Transaksi</h3>
                    <p>Informasi pembayaran pelanggan yang tersimpan di database.</p>
                </div>
            </div>

            <div class="payment-total-badge">
                <i class="fas fa-database"></i>
                {{ number_format($pembayaran->total(), 0, ',', '.') }} data
            </div>
        </div>

        {{-- Pencarian dan filter --}}
        <div class="payment-filter-wrap">
            <label class="payment-filter-label">
                <i class="fas fa-filter"></i>
                Pencarian dan Filter Transaksi
            </label>

            <form
                action="{{ route('admin.pembayaran.index') }}"
                method="GET"
                class="payment-filter"
            >
                <div class="payment-input-wrap">
                    <i class="fas fa-magnifying-glass"></i>
                    <input
                        type="text"
                        name="cari"
                        placeholder="Cari ID pesanan atau ID transaksi..."
                        value="{{ request('cari') }}"
                        aria-label="Cari ID pesanan atau ID transaksi"
                    >
                </div>

                <select name="status" aria-label="Filter status pembayaran">
                    <option value="">Semua Status</option>
                    @foreach ([
                        'berhasil' => 'Berhasil',
                        'lunas' => 'Lunas',
                        'success' => 'Success',
                        'settlement' => 'Settlement',
                        'capture' => 'Capture',
                        'pending' => 'Pending',
                        'menunggu' => 'Menunggu',
                        'gagal' => 'Gagal',
                        'failed' => 'Failed',
                        'expire' => 'Kedaluwarsa',
                        'expired' => 'Expired',
                        'cancel' => 'Dibatalkan',
                        'deny' => 'Ditolak',
                    ] as $value => $label)
                        <option value="{{ $value }}" @selected(request('status') === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>

                <select name="jenis" aria-label="Filter jenis pembayaran">
                    <option value="">Semua Jenis</option>
                    <option value="DP" @selected(request('jenis') === 'DP')>DP</option>
                    <option value="Pelunasan" @selected(request('jenis') === 'Pelunasan')>
                        Pelunasan
                    </option>
                </select>

                <button type="submit" class="payment-btn">
                    <i class="fas fa-magnifying-glass"></i>
                    Terapkan
                </button>

                <a href="{{ route('admin.pembayaran.index') }}" class="payment-btn payment-btn-reset">
                    <i class="fas fa-rotate-left"></i>
                    Reset
                </a>
            </form>
        </div>

        {{-- Tabel pembayaran --}}
        <div class="payment-table-wrapper">
            <table class="payment-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Pembayaran</th>
                        <th>ID Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Nominal</th>
                        <th>Jenis</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Metode</th>
                        <th>ID Transaksi</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pembayaran as $item)
                        @php
                            $status = strtolower(trim((string) $item->status_pembayaran));

                            $statusBerhasil = in_array($status, [
                                'berhasil', 'lunas', 'success', 'settlement', 'capture',
                            ], true);

                            $statusGagal = in_array($status, [
                                'gagal', 'failed', 'deny', 'expire', 'expired', 'cancel',
                            ], true);

                            $statusPending = in_array($status, [
                                'pending', 'menunggu',
                            ], true);

                            $namaPelanggan = $item->pesanan?->user?->nama ?? '-';
                        @endphp

                        <tr>
                            <td>
                                <span class="payment-number">
                                    {{ ($pembayaran->firstItem() ?? 1) + $loop->index }}
                                </span>
                            </td>

                            <td>
                                <span class="payment-id">#{{ $item->id_pembayaran }}</span>
                            </td>

                            <td>
                                <span class="payment-id">#{{ $item->id_pesanan }}</span>
                            </td>

                            <td>
                                <div class="payment-customer">
                                    <div class="payment-customer-avatar">
                                        {{ $namaPelanggan !== '-' ? mb_substr($namaPelanggan, 0, 1) : '?' }}
                                    </div>
                                    <span class="payment-customer-name" title="{{ $namaPelanggan }}">
                                        {{ $namaPelanggan }}
                                    </span>
                                </div>
                            </td>

                            <td>
                                <span class="payment-amount">
                                    Rp {{ number_format((float) $item->jumlah, 0, ',', '.') }}
                                </span>
                            </td>

                            <td>
                                <span class="payment-type">
                                    <i class="fas fa-tag"></i>
                                    {{ $item->jenis_pembayaran ?: '-' }}
                                </span>
                            </td>

                            <td>
                                <div class="payment-date">
                                    @if ($item->tanggal_pembayaran)
                                        <div>
                                            <i class="far fa-calendar"></i>
                                            {{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('d-m-Y') }}
                                        </div>
                                        <div>
                                            <i class="far fa-clock"></i>
                                            {{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('H:i') }}
                                        </div>
                                    @else
                                        <span class="payment-muted">Belum tersedia</span>
                                    @endif
                                </div>
                            </td>

                            <td>
                                <span class="payment-method">
                                    <i class="fas fa-credit-card"></i>
                                    {{ $item->metode_pembayaran ?: '-' }}
                                </span>
                            </td>

                            <td>
                                @if ($item->transaksi_id)
                                    <span class="payment-transaction" title="{{ $item->transaksi_id }}">
                                        {{ $item->transaksi_id }}
                                    </span>
                                @else
                                    <span class="payment-muted">-</span>
                                @endif
                            </td>

                            <td>
                                @if ($statusBerhasil)
                                    <span class="payment-status payment-status-success">
                                        <i class="fas fa-circle-check"></i>
                                        {{ $item->status_pembayaran }}
                                    </span>
                                @elseif ($statusGagal)
                                    <span class="payment-status payment-status-failed">
                                        <i class="fas fa-circle-xmark"></i>
                                        {{ $item->status_pembayaran }}
                                    </span>
                                @elseif ($statusPending)
                                    <span class="payment-status payment-status-pending">
                                        <i class="fas fa-clock"></i>
                                        {{ $item->status_pembayaran }}
                                    </span>
                                @else
                                    <span class="payment-status payment-status-other">
                                        <i class="fas fa-circle-info"></i>
                                        {{ $item->status_pembayaran ?: 'Belum diketahui' }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="payment-empty">
                                <div class="payment-empty-icon">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                <strong>Belum Ada Transaksi</strong>
                                <p>
                                    Tidak ditemukan data pembayaran yang sesuai.<br>
                                    Coba ubah kata kunci atau gunakan filter lainnya.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($pembayaran->hasPages())
            <div class="payment-pagination">
                <div>
                    Menampilkan
                    <strong>{{ $pembayaran->firstItem() ?? 0 }}–{{ $pembayaran->lastItem() ?? 0 }}</strong>
                    dari
                    <strong>{{ number_format($pembayaran->total(), 0, ',', '.') }}</strong>
                    transaksi
                </div>

                <div class="payment-pagination-links">
                    @if ($pembayaran->onFirstPage())
                        <span>
                            <i class="fas fa-chevron-left"></i>
                            Sebelumnya
                        </span>
                    @else
                        <a href="{{ $pembayaran->previousPageUrl() }}">
                            <i class="fas fa-chevron-left"></i>
                            Sebelumnya
                        </a>
                    @endif

                    <span class="current">
                        {{ $pembayaran->currentPage() }} / {{ $pembayaran->lastPage() }}
                    </span>

                    @if ($pembayaran->hasMorePages())
                        <a href="{{ $pembayaran->nextPageUrl() }}">
                            Berikutnya
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span>
                            Berikutnya
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    @endif
                </div>
            </div>
        @endif

        <div class="payment-note">
            <i class="fas fa-circle-info"></i>
            <span>
                Status transaksi ditampilkan berdasarkan data yang tersimpan di database.
                Pastikan pembayaran telah diverifikasi sebelum dinyatakan berhasil.
            </span>
        </div>
    </section>
</div>
@endsection
