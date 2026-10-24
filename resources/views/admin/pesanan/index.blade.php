@extends('layouts.admin')

@section('title', 'Data Pesanan - JAITIN')
@section('page-title', 'Data Pesanan')
@section('page-description', 'Kelola data pesanan pelanggan JAITIN.')

@section('styles')
<style>
    :root {
        --order-primary: #b8898d;
        --order-dark: #96696e;
        --order-pink: #f5e7e7;
        --order-cream: #fffaf6;
        --order-text: #493936;
        --order-muted: #927f7b;
        --order-border: #eee3de;
        --order-shadow: 0 10px 30px rgba(103, 72, 65, .055);
    }

    .order-page {
        display: flex;
        flex-direction: column;
        gap: 22px;
        color: var(--order-text);
    }

    /* HEADER */
    .order-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        padding: 29px;
        border-radius: 22px;
        background: linear-gradient(120deg, #b8898d 0%, #c99b9d 58%, #dfb9ad 100%);
        color: #fff;
        box-shadow: 0 12px 28px rgba(153, 103, 109, .16);
    }

    .order-hero::before,
    .order-hero::after {
        content: "";
        position: absolute;
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 50%;
        pointer-events: none;
    }

    .order-hero::before {
        width: 260px;
        height: 260px;
        right: 110px;
        top: -175px;
    }

    .order-hero::after {
        width: 190px;
        height: 190px;
        right: -50px;
        bottom: -125px;
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .hero-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        padding: 7px 11px;
        border: 1px solid rgba(255,255,255,.25);
        border-radius: 30px;
        background: rgba(255,255,255,.13);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.3px;
    }

    .hero-content h2 {
        margin: 0 0 9px;
        color: #fff;
        font-size: clamp(22px, 3vw, 29px);
        font-weight: 750;
        letter-spacing: -.6px;
    }

    .hero-content p {
        max-width: 500px;
        color: rgba(255,255,255,.87);
        font-size: 13px;
        line-height: 1.8;
    }

    .hero-decoration {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 94px;
        height: 94px;
        border: 1px solid rgba(255,255,255,.3);
        border-radius: 27px;
        background: rgba(255,255,255,.13);
        transform: rotate(-7deg);
    }

    .hero-decoration i {
        color: #fff;
        font-size: 39px;
        transform: rotate(7deg);
    }

    .btn-add {
        position: relative;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        flex-shrink: 0;
        padding: 12px 17px;
        border-radius: 12px;
        background: #fffaf7;
        color: var(--order-dark);
        font-size: 12px;
        font-weight: 750;
        text-decoration: none;
        white-space: nowrap;
        box-shadow: 0 5px 15px rgba(76, 43, 43, .09);
        transition: .2s ease;
    }

    .btn-add:hover {
        background: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(76, 43, 43, .14);
    }

    /* STATISTIK */
    .order-stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 15px;
    }

    .stat-card {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
        padding: 19px 17px;
        border: 1px solid var(--order-border);
        border-radius: 17px;
        background: var(--order-cream);
        box-shadow: var(--order-shadow);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 30px rgba(103,72,65,.09);
    }

    .stat-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 45px;
        height: 45px;
        border-radius: 14px;
        background: #f5e7e7;
        color: #96696e;
        font-size: 18px;
    }

    .stat-icon.orange {
        background: #f9eadb;
        color: #a7784e;
    }

    .stat-icon.blue {
        background: #e6edf5;
        color: #5c7695;
    }

    .stat-icon.green {
        background: #e6f1e5;
        color: #5c805e;
    }

    .stat-info {
        min-width: 0;
    }

    .stat-info span {
        display: block;
        margin-bottom: 6px;
        color: var(--order-muted);
        font-size: 10px;
        font-weight: 650;
        line-height: 1.5;
    }

    .stat-info strong {
        display: block;
        color: var(--order-text);
        font-size: 25px;
        font-weight: 800;
        line-height: 1.1;
    }

    /* NOTIFIKASI */
    .alert {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 14px 16px;
        border-radius: 13px;
        font-size: 12px;
        line-height: 1.7;
    }

    .alert > i {
        margin-top: 2px;
        font-size: 16px;
    }

    .alert-success {
        background: #edf6ed;
        color: #426b47;
        border: 1px solid #d5e8d4;
    }

    .alert-error {
        background: #fff0ef;
        color: #985052;
        border: 1px solid #f0d3d1;
    }

    .alert-error ul {
        margin-top: 7px;
        padding-left: 19px;
    }

    /* PANEL TABEL */
    .table-box {
        overflow: hidden;
        border: 1px solid var(--order-border);
        border-radius: 20px;
        background: var(--order-cream);
        box-shadow: var(--order-shadow);
    }

    .table-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        padding: 22px 24px;
        border-bottom: 1px solid var(--order-border);
    }

    .table-title {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .table-title-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 43px;
        height: 43px;
        border-radius: 13px;
        background: var(--order-pink);
        color: var(--order-dark);
        font-size: 17px;
    }

    .table-title h3 {
        margin: 0 0 5px;
        color: var(--order-text);
        font-size: 15px;
        font-weight: 750;
    }

    .table-title p {
        color: var(--order-muted);
        font-size: 11px;
        line-height: 1.5;
    }

    .table-count {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 12px;
        flex-shrink: 0;
        border: 1px solid #ead5d6;
        border-radius: 30px;
        background: #f8ebeb;
        color: #8d5f65;
        font-size: 11px;
        font-weight: 750;
        white-space: nowrap;
    }

    .table-tools {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        padding: 17px 24px;
    }

    .table-description {
        color: var(--order-muted);
        font-size: 11px;
        line-height: 1.7;
    }

    .search-box {
        display: flex;
        align-items: center;
        gap: 9px;
        width: min(100%, 310px);
        padding: 11px 13px;
        border: 1px solid #eaded8;
        border-radius: 11px;
        background: #fff;
        color: #a17d7c;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .search-box:focus-within {
        border-color: var(--order-primary);
        box-shadow: 0 0 0 3px rgba(184,137,141,.12);
    }

    .search-box input {
        width: 100%;
        min-width: 0;
        border: 0;
        outline: none;
        background: transparent;
        color: var(--order-text);
        font: inherit;
        font-size: 12px;
    }

    .search-box input::placeholder {
        color: #b4a09a;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
        border-top: 1px solid var(--order-border);
    }

    .order-table {
        width: 100%;
        min-width: 1250px;
        border-collapse: separate;
        border-spacing: 0;
    }

    .order-table thead th {
        padding: 14px 15px;
        background: #f8efea;
        color: #806761;
        text-align: left;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .55px;
        text-transform: uppercase;
        white-space: nowrap;
        border-bottom: 1px solid var(--order-border);
    }

    .order-table tbody td {
        padding: 15px;
        color: #705b55;
        font-size: 12px;
        line-height: 1.6;
        vertical-align: middle;
        border-bottom: 1px solid #f1e8e3;
    }

    .order-table tbody tr {
        transition: background .2s ease;
    }

    .order-table tbody tr:hover {
        background: #fff4ef;
    }

    .order-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .number-cell {
        color: #b1948e !important;
        font-weight: 750;
    }

    .order-id {
        display: inline-block;
        padding: 6px 9px;
        border: 1px solid #eadcda;
        border-radius: 8px;
        background: #fff;
        color: #8c6768;
        font-size: 11px;
        font-weight: 750;
        white-space: nowrap;
    }

    .customer-profile {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 160px;
    }

    .customer-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 39px;
        height: 39px;
        border: 1px solid #ead5d6;
        border-radius: 12px;
        background: linear-gradient(145deg, #f7e8e8, #f0dada);
        color: #94656b;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .customer-profile strong {
        display: block;
        max-width: 170px;
        color: var(--order-text);
        font-size: 12px;
        font-weight: 750;
        overflow-wrap: anywhere;
    }

    .customer-profile small {
        display: block;
        margin-top: 3px;
        color: #aa9690;
        font-size: 10px;
    }

    .clothing-cell {
        color: var(--order-text);
        font-weight: 650;
    }

    .quantity-badge {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        min-width: 31px;
        padding: 5px 8px;
        border-radius: 9px;
        background: #f4e9e3;
        color: #8e6d60;
        font-size: 11px;
        font-weight: 750;
    }

    .date-cell {
        min-width: 110px;
        white-space: nowrap;
    }

    .date-cell i {
        margin-right: 5px;
        color: #b38b88;
        font-size: 11px;
    }

    .price-cell {
        color: #79575a !important;
        font-weight: 800;
        white-space: nowrap;
    }

    .status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 10px;
        border-radius: 30px;
        font-size: 10px;
        font-weight: 750;
        white-space: nowrap;
    }

    .status::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-menunggu {
        background: #fbefd9;
        color: #98713e;
    }

    .status-proses {
        background: #f1e2e7;
        color: #936070;
    }

    .status-selesai {
        background: #e6f2e5;
        color: #547a56;
    }

    .status-diambil {
        background: #e6edf5;
        color: #597594;
    }

    .status-lain {
        background: #eee8f5;
        color: #78638e;
    }

    /* AKSI */
    .action-group {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .action-group form {
        margin: 0;
    }

    .btn-action {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        padding: 8px 10px;
        border: 0;
        border-radius: 9px;
        color: #fff;
        text-decoration: none;
        font-family: inherit;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        white-space: nowrap;
        transition: .2s ease;
    }

    .btn-action:hover {
        transform: translateY(-1px);
        filter: brightness(.96);
    }

    .btn-edit {
        background: #c49a9b;
    }

    .btn-revisi {
        background: #b89b7d;
    }

    .btn-hapus {
        background: #986c72;
    }

    /* DATA KOSONG */
    .empty {
        padding: 55px 20px !important;
        text-align: center;
    }

    .empty-illustration {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 68px;
        height: 68px;
        margin: 0 auto 15px;
        border-radius: 22px;
        background: #f6e8e6;
        color: #b8898d;
        font-size: 27px;
    }

    .empty strong {
        display: block;
        margin-bottom: 7px;
        color: var(--order-text);
        font-size: 14px;
    }

    .empty p {
        color: var(--order-muted);
        font-size: 12px;
    }

    .no-search-results {
        display: none;
        padding: 30px 15px;
        color: var(--order-muted);
        text-align: center;
        font-size: 12px;
    }

    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding: 14px 24px;
        border-top: 1px solid var(--order-border);
        background: #fffaf6;
        color: var(--order-muted);
        font-size: 11px;
    }

    .table-footer i {
        margin-right: 5px;
        color: #b8898d;
    }

    @media (max-width: 1200px) {
        .order-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 700px) {
        .order-page {
            gap: 16px;
        }

        .order-hero {
            align-items: flex-start;
            flex-direction: column;
            padding: 23px;
            border-radius: 18px;
        }

        .hero-content {
            padding-right: 36px;
        }

        .hero-content h2 {
            font-size: 23px;
        }

        .hero-content p {
            font-size: 12px;
        }

        .hero-decoration {
            position: absolute;
            top: 19px;
            right: 17px;
            width: 56px;
            height: 56px;
            border-radius: 16px;
            opacity: .65;
        }

        .hero-decoration i {
            font-size: 24px;
        }

        .btn-add {
            width: 100%;
            box-sizing: border-box;
        }

        .order-stats {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .stat-card {
            padding: 15px;
        }

        .table-top {
            padding: 17px;
        }

        .table-tools {
            align-items: stretch;
            flex-direction: column;
            padding: 15px 17px;
        }

        .search-box {
            width: 100%;
            box-sizing: border-box;
        }

        .table-count {
            font-size: 10px;
            padding: 7px 9px;
        }

        .table-footer {
            align-items: flex-start;
            flex-direction: column;
            padding: 13px 17px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .order-page *,
        .order-page *::before,
        .order-page *::after {
            transition: none !important;
            animation: none !important;
        }
    }
</style>
@endsection

@section('content')
<div class="order-page">

    {{-- HEADER --}}
    <section class="order-hero">
        <div class="hero-content">
            <div class="hero-label">
                <i class="fa-solid fa-scissors"></i>
                MANAJEMEN PESANAN
            </div>

            <h2>Data Pesanan</h2>

            <p>
                Pantau pesanan jahitan, status pengerjaan, tenggat waktu,
                dan total biaya pelanggan dalam satu tempat.
            </p>
        </div>

        <div class="hero-decoration" aria-hidden="true">
            <i class="fa-solid fa-clipboard-check"></i>
        </div>

        <a href="{{ route('admin.pesanan.create') }}" class="btn-add">
            <i class="fa-solid fa-plus"></i>
            Tambah Pesanan
        </a>
    </section>

    {{-- NOTIFIKASI --}}
    @if (session('success'))
        <div class="alert alert-success" role="status">
            <i class="fa-solid fa-circle-check"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error" role="alert">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error" role="alert">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <strong>Periksa kembali data berikut:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    
@php
    $semuaPesanan = $pesanan;

    $jumlahMenunggu = $semuaPesanan->filter(function ($item) {
        $status = strtolower(trim($item->status_pengerjaan ?? 'menunggu produksi'));

        return in_array($status, [
            'menunggu',
            'menunggu produksi',
            'menunggu diproses',
            'pending',
            'baru',
        ]);
    })->count();

    $jumlahProses = $semuaPesanan->filter(function ($item) {
        $status = strtolower(trim($item->status_pengerjaan ?? ''));

        return in_array($status, [
            'sedang dipotong',
            'sedang menjahit',
            'finishing',
            'quality check',
            'sedang dikerjakan',
            'dalam pengerjaan',
            'diproses',
        ]);
    })->count();

    $jumlahSelesai = $semuaPesanan->filter(function ($item) {
        $status = strtolower(trim($item->status_pengerjaan ?? ''));

        return in_array($status, [
            'siap diambil',
            'sudah diambil',
            'selesai',
            'diambil',
        ]);
    })->count();
@endphp


    {{-- STATISTIK --}}
    <section class="order-stats">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa-solid fa-receipt"></i>
            </div>
            <div class="stat-info">
                <span>Total Pesanan</span>
                <strong>{{ $semuaPesanan->count() }}</strong>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="fa-solid fa-hourglass-half"></i>
            </div>
            <div class="stat-info">
                <span>Menunggu</span>
                <strong>{{ $jumlahMenunggu }}</strong>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fa-solid fa-person-digging"></i>
            </div>
            <div class="stat-info">
                <span>Sedang Diproses</span>
                <strong>{{ $jumlahProses }}</strong>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="stat-info">
                <span>Selesai / Diambil</span>
                <strong>{{ $jumlahSelesai }}</strong>
            </div>
        </div>
    </section>

    {{-- TABEL --}}
    <section class="table-box">
        <div class="table-top">
            <div class="table-title">
                <div class="table-title-icon">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <div>
                    <h3>Daftar Pesanan Pelanggan</h3>
                    <p>Informasi pesanan dan progres pengerjaan jahitan.</p>
                </div>
            </div>

            <span class="table-count">
                <i class="fa-solid fa-database"></i>
                {{ $semuaPesanan->count() }} pesanan
            </span>
        </div>

        <div class="table-tools">
            <p class="table-description">
                <i class="fa-solid fa-circle-info"></i>
                Cari berdasarkan pelanggan, pakaian, tanggal, atau status.
            </p>

            <label class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input
                    type="search"
                    id="orderSearch"
                    placeholder="Cari data pesanan..."
                    aria-label="Cari data pesanan"
                    autocomplete="off"
                >
            </label>
        </div>

        <div class="table-responsive">
            <table class="order-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Jenis Pakaian</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pesan</th>
                        <th>Tanggal Harapan</th>
                        <th>Estimasi Selesai</th>
                        <th>Status</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody id="orderTableBody">
                    @forelse ($semuaPesanan as $item)
                        
@php
    $statusPengerjaan = trim(
        $item->status_pengerjaan ?? 'Menunggu Produksi'
    );

    $statusLower = strtolower($statusPengerjaan);

    if (in_array($statusLower, ['sudah diambil', 'diambil'])) {
        $statusClass = 'status-diambil';
    } elseif (in_array($statusLower, [
        'siap diambil',
        'selesai',
    ])) {
        $statusClass = 'status-selesai';
    } elseif (in_array($statusLower, [
        'sedang dipotong',
        'sedang menjahit',
        'finishing',
        'quality check',
        'sedang dikerjakan',
        'dalam pengerjaan',
        'diproses',
    ])) {
        $statusClass = 'status-proses';
    } elseif (in_array($statusLower, [
        'menunggu',
        'menunggu produksi',
        'menunggu diproses',
        'pending',
        'baru',
    ])) {
        $statusClass = 'status-menunggu';
    } else {
        $statusClass = 'status-lain';
    }

    $namaPelanggan = $item->user->nama
        ?? $item->user->name
        ?? 'Pelanggan';

    $inisial = \Illuminate\Support\Str::substr(
        trim($namaPelanggan),
        0,
        1
    );
@endphp


                        <tr class="order-row">
                            <td class="number-cell">{{ $loop->iteration }}</td>

                            <td>
                                <span class="order-id">
                                    #{{ $item->id_pesanan }}
                                </span>
                            </td>

                            <td>
                                <div class="customer-profile">
                                    <div class="customer-avatar">
                                        {{ $inisial }}
                                    </div>
                                    <div>
                                        <strong>{{ $namaPelanggan }}</strong>
                                        <small>Pelanggan JAITIN</small>
                                    </div>
                                </div>
                            </td>

                            <td class="clothing-cell">
                                {{ $item->jenis_pakaian ?? '-' }}
                            </td>

                            <td>
                                <span class="quantity-badge">
                                    {{ $item->jumlah ?? 0 }} pcs
                                </span>
                            </td>

                            <td class="date-cell">
                                @if ($item->tanggal_pesan)
                                    <i class="fa-regular fa-calendar"></i>
                                    {{ \Carbon\Carbon::parse($item->tanggal_pesan)->format('d-m-Y H:i') }}
                                @else
                                    -
                                @endif
                            </td>

                            <td class="date-cell">
                                @if ($item->tanggal_harapan)
                                    <i class="fa-regular fa-calendar-check"></i>
                                    {{ \Carbon\Carbon::parse($item->tanggal_harapan)->format('d-m-Y') }}
                                @else
                                    -
                                @endif
                            </td>

                            <td class="date-cell">
                                @if ($item->estimasi_selesai)
                                    <i class="fa-regular fa-clock"></i>
                                    {{ \Carbon\Carbon::parse($item->estimasi_selesai)->format('d-m-Y') }}
                                @else
                                    -
                                @endif
                            </td>

                            
<td>
    <span class="status {{ $statusClass }}">
        {{ $statusPengerjaan }}
    </span>
</td>


                            <td class="price-cell">
                                Rp {{ number_format($item->total_harga ?? 0, 0, ',', '.') }}
                            </td>

                            <td>
                                <div class="action-group">
                                    
<a
    href="{{ route('admin.pesanan.edit', $item->id_pesanan) }}"
    class="btn-action btn-edit"
    title="Ubah total harga"
>
    <i class="fa-solid fa-pen-to-square"></i>
    Edit Harga
</a>


                                    <a
                                        href="{{ route('admin.revisi.index', $item->id_pesanan) }}"
                                        class="btn-action btn-revisi"
                                        title="Kelola revisi pesanan"
                                    >
                                        <i class="fa-solid fa-rotate"></i>
                                        Revisi
                                    </a>

                                    <form
                                        action="{{ route('admin.pesanan.destroy', $item->id_pesanan) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus pesanan ini? Tindakan ini tidak dapat dibatalkan.');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-action btn-hapus"
                                            title="Hapus pesanan"
                                        >
                                            <i class="fa-solid fa-trash-can"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="empty">
                                <div class="empty-illustration">
                                    <i class="fa-solid fa-box-open"></i>
                                </div>
                                <strong>Belum ada data pesanan</strong>
                                <p>Pesanan pelanggan yang masuk akan ditampilkan di sini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="no-search-results" id="noOrderResults">
                <i class="fa-solid fa-magnifying-glass" style="margin-right: 6px;"></i>
                Pesanan yang kamu cari tidak ditemukan.
            </div>
        </div>

        <div class="table-footer">
            <span>
                <i class="fa-solid fa-scissors"></i>
                Sistem Manajemen Pesanan JAITIN
            </span>

            <span id="visibleOrderCount">
                Menampilkan {{ $semuaPesanan->count() }} pesanan
            </span>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('orderSearch');
    const rows = Array.from(document.querySelectorAll('.order-row'));
    const noResults = document.getElementById('noOrderResults');
    const visibleCount = document.getElementById('visibleOrderCount');

    if (!searchInput) return;

    function filterOrders() {
        const keyword = searchInput.value.trim().toLocaleLowerCase('id-ID');
        let visible = 0;

        rows.forEach(function (row) {
            const matches = row.textContent
                .toLocaleLowerCase('id-ID')
                .includes(keyword);

            row.style.display = matches ? '' : 'none';

            if (matches) visible++;
        });

        if (noResults) {
            noResults.style.display =
                rows.length > 0 && visible === 0 ? 'block' : 'none';
        }

        if (visibleCount) {
            visibleCount.textContent =
                'Menampilkan ' + visible + ' dari ' + rows.length + ' pesanan';
        }
    }

    searchInput.addEventListener('input', filterOrders);
});
</script>
@endsection
