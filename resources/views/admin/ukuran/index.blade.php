@extends('layouts.admin')

@section('title', 'Data Ukuran - JAITIN')
@section('page-title', 'Data Ukuran Pelanggan')
@section('page-description', 'Lihat data ukuran pelanggan untuk mendukung pengelolaan pesanan jahit.')

@section('styles')
<style>
    :root {
        --size-primary: #b8898d;
        --size-dark: #96696e;
        --size-pink: #f5e7e7;
        --size-cream: #fffaf6;
        --size-text: #493936;
        --size-muted: #927f7b;
        --size-border: #eee3de;
        --size-shadow: 0 10px 30px rgba(103, 72, 65, .055);
    }

    .size-page {
        display: flex;
        flex-direction: column;
        gap: 22px;
        color: var(--size-text);
    }

    /* HEADER */
    .size-hero {
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

    .size-hero::before,
    .size-hero::after {
        content: "";
        position: absolute;
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 50%;
        pointer-events: none;
    }

    .size-hero::before {
        width: 260px;
        height: 260px;
        right: 100px;
        top: -175px;
    }

    .size-hero::after {
        width: 190px;
        height: 190px;
        right: -45px;
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
        max-width: 510px;
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

    /* STATISTIK */
    .size-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 15px;
    }

    .stat-card {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
        padding: 20px;
        border: 1px solid var(--size-border);
        border-radius: 18px;
        background: var(--size-cream);
        box-shadow: var(--size-shadow);
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
        width: 48px;
        height: 48px;
        border-radius: 15px;
        background: var(--size-pink);
        color: var(--size-dark);
        font-size: 20px;
    }

    .stat-icon.peach {
        background: #f9eadb;
        color: #a7784e;
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
        color: var(--size-muted);
        font-size: 11px;
        font-weight: 650;
        line-height: 1.5;
    }

    .stat-info strong {
        display: block;
        color: var(--size-text);
        font-size: 25px;
        font-weight: 800;
        line-height: 1.2;
    }

    /* NOTIFIKASI */
    .size-alert {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 14px 16px;
        border-radius: 13px;
        font-size: 12px;
        line-height: 1.7;
    }

    .size-alert > i {
        margin-top: 2px;
        font-size: 16px;
    }

    .size-alert-success {
        background: #edf6ed;
        color: #426b47;
        border: 1px solid #d5e8d4;
    }

    .size-alert-error {
        background: #fff0ef;
        color: #985052;
        border: 1px solid #f0d3d1;
    }

    .size-alert ul {
        margin: 7px 0 0;
        padding-left: 19px;
    }

    /* PANEL TABEL */
    .size-table-card {
        overflow: hidden;
        border: 1px solid var(--size-border);
        border-radius: 20px;
        background: var(--size-cream);
        box-shadow: var(--size-shadow);
    }

    .table-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        padding: 22px 24px;
        border-bottom: 1px solid var(--size-border);
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
        background: var(--size-pink);
        color: var(--size-dark);
        font-size: 17px;
    }

    .table-title h3 {
        margin: 0 0 5px;
        color: var(--size-text);
        font-size: 15px;
        font-weight: 750;
    }

    .table-title p {
        color: var(--size-muted);
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
        color: var(--size-muted);
        font-size: 11px;
        line-height: 1.7;
    }

    .search-box {
        display: flex;
        align-items: center;
        gap: 9px;
        width: min(100%, 300px);
        padding: 11px 13px;
        border: 1px solid #eaded8;
        border-radius: 11px;
        background: #fff;
        color: #a17d7c;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .search-box:focus-within {
        border-color: var(--size-primary);
        box-shadow: 0 0 0 3px rgba(184,137,141,.12);
    }

    .search-box input {
        width: 100%;
        min-width: 0;
        border: 0;
        outline: none;
        background: transparent;
        color: var(--size-text);
        font: inherit;
        font-size: 12px;
    }

    .search-box input::placeholder {
        color: #b4a09a;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
        border-top: 1px solid var(--size-border);
    }

    .ukuran-table {
        width: 100%;
        min-width: 1050px;
        border-collapse: separate;
        border-spacing: 0;
    }

    .ukuran-table thead th {
        padding: 14px 15px;
        background: #f8efea;
        color: #806761;
        text-align: left;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .5px;
        text-transform: uppercase;
        white-space: nowrap;
        border-bottom: 1px solid var(--size-border);
    }

    .ukuran-table tbody td {
        padding: 15px;
        color: #705b55;
        font-size: 12px;
        line-height: 1.6;
        vertical-align: middle;
        border-bottom: 1px solid #f1e8e3;
    }

    .ukuran-table tbody tr {
        transition: background .2s ease;
    }

    .ukuran-table tbody tr:hover {
        background: #fff4ef;
    }

    .ukuran-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .number-cell {
        color: #b1948e !important;
        font-weight: 750;
    }

    .customer-profile {
        display: flex;
        align-items: center;
        gap: 11px;
        min-width: 180px;
    }

    .customer-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        border: 1px solid #ead5d6;
        border-radius: 12px;
        background: linear-gradient(145deg, #f7e8e8, #f0dada);
        color: #94656b;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .customer-profile strong {
        display: block;
        max-width: 220px;
        color: var(--size-text);
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

    .measurement-cell {
        white-space: nowrap;
        font-variant-numeric: tabular-nums;
    }

    .measurement-value {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 9px;
        border: 1px solid #efe1da;
        border-radius: 8px;
        background: #fff;
        color: #705750;
        font-size: 11px;
        font-weight: 700;
    }

    .measurement-value small {
        color: #ad918a;
        font-size: 9px;
        font-weight: 600;
    }

    .date-cell {
        white-space: nowrap;
    }

    .date-cell i {
        margin-right: 5px;
        color: #b38b88;
    }

    .no-search-results {
        display: none;
        padding: 30px 15px;
        color: var(--size-muted);
        text-align: center;
        font-size: 12px;
    }

    .ukuran-empty {
        padding: 55px 20px !important;
        text-align: center;
    }

    .empty-illustration {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 68px;
        height: 68px;
        margin: 0 auto 15px;
        border-radius: 22px;
        background: #f6e8e6;
        color: #b8898d;
        font-size: 27px;
    }

    .ukuran-empty strong {
        display: block;
        margin-bottom: 7px;
        color: var(--size-text);
        font-size: 14px;
    }

    .ukuran-empty p {
        color: var(--size-muted);
        font-size: 12px;
    }

    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding: 14px 24px;
        border-top: 1px solid var(--size-border);
        background: #fffaf6;
        color: var(--size-muted);
        font-size: 11px;
    }

    .table-footer i {
        margin-right: 5px;
        color: #b8898d;
    }

    @media (max-width: 1000px) {
        .size-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 700px) {
        .size-page {
            gap: 16px;
        }

        .size-hero {
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

        .size-stats {
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
            padding: 7px 9px;
            font-size: 10px;
        }

        .table-footer {
            align-items: flex-start;
            flex-direction: column;
            padding: 13px 17px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .size-page *,
        .size-page *::before,
        .size-page *::after {
            transition: none !important;
            animation: none !important;
        }
    }
</style>
@endsection

@section('content')
<div class="size-page">

    {{-- HEADER --}}
    <section class="size-hero">
        <div class="hero-content">
            <div class="hero-label">
                <i class="fa-solid fa-ruler-combined"></i>
                MANAJEMEN UKURAN
            </div>

            <h2>Data Ukuran Pelanggan</h2>

            <p>
                Lihat dan pantau catatan ukuran pelanggan untuk membantu
                proses pembuatan pakaian yang lebih rapi dan terorganisasi.
            </p>
        </div>

        <div class="hero-decoration" aria-hidden="true">
            <i class="fa-solid fa-shirt"></i>
        </div>
    </section>

    {{-- NOTIFIKASI --}}
    @if (session('success'))
        <div class="size-alert size-alert-success" role="status">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="size-alert size-alert-error" role="alert">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="size-alert size-alert-error" role="alert">
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
        $semuaUkuran = $ukuran;

        $kolomUkuran = [
            'panjang_baju',
            'lebar_bahu',
            'lingkar_dada',
            'lingkar_pinggang',
            'lingkar_lengan',
        ];

        $jumlahUkuranLengkap = $semuaUkuran->filter(function ($item) use ($kolomUkuran) {
            foreach ($kolomUkuran as $kolom) {
                if ($item->{$kolom} === null || $item->{$kolom} === '') {
                    return false;
                }
            }

            return true;
        })->count();

        $jumlahUkuranBelumLengkap = $semuaUkuran->count() - $jumlahUkuranLengkap;
    @endphp

    {{-- STATISTIK --}}
    <section class="size-stats">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="stat-info">
                <span>Total Catatan Ukuran</span>
                <strong>{{ $semuaUkuran->count() }}</strong>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="stat-info">
                <span>Ukuran Lengkap</span>
                <strong>{{ $jumlahUkuranLengkap }}</strong>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon peach">
                <i class="fa-solid fa-clipboard-list"></i>
            </div>
            <div class="stat-info">
                <span>Belum Lengkap</span>
                <strong>{{ $jumlahUkuranBelumLengkap }}</strong>
            </div>
        </div>
    </section>

    {{-- TABEL --}}
    <section class="size-table-card">
        <div class="table-top">
            <div class="table-title">
                <div class="table-title-icon">
                    <i class="fa-solid fa-ruler-combined"></i>
                </div>

                <div>
                    <h3>Daftar Ukuran Pelanggan</h3>
                    <p>Rincian ukuran badan sebagai referensi jahitan.</p>
                </div>
            </div>

            <span class="table-count">
                <i class="fa-solid fa-database"></i>
                {{ $semuaUkuran->count() }} data
            </span>
        </div>

        <div class="table-tools">
            <p class="table-description">
                <i class="fa-solid fa-circle-info"></i>
                Seluruh ukuran ditampilkan dalam satuan sentimeter (cm).
            </p>

            <label class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input
                    type="search"
                    id="sizeSearch"
                    placeholder="Cari nama pelanggan..."
                    aria-label="Cari nama pelanggan"
                    autocomplete="off"
                >
            </label>
        </div>

        <div class="table-responsive">
            <table class="ukuran-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pelanggan</th>
                        <th>Panjang Baju</th>
                        <th>Lebar Bahu</th>
                        <th>Lingkar Dada</th>
                        <th>Lingkar Pinggang</th>
                        <th>Lingkar Lengan</th>
                        <th>Tanggal Catatan</th>
                    </tr>
                </thead>

                <tbody id="sizeTableBody">
                    @forelse ($semuaUkuran as $item)
                        @php
                            $namaPelanggan = $item->user->nama
                                ?? $item->user->name
                                ?? 'Pelanggan';

                            $inisial = \Illuminate\Support\Str::substr(
                                trim($namaPelanggan),
                                0,
                                1
                            );
                        @endphp

                        <tr class="size-row">
                            <td class="number-cell">{{ $loop->iteration }}</td>

                            <td>
                                <div class="customer-profile">
                                    <div class="customer-avatar">
                                        {{ $inisial }}
                                    </div>
                                    <div>
                                        <strong>{{ $namaPelanggan }}</strong>
                                        <small>Data ukuran pelanggan</small>
                                    </div>
                                </div>
                            </td>

                            <td class="measurement-cell">
                                @if ($item->panjang_baju !== null)
                                    <span class="measurement-value">
                                        {{ number_format((float) $item->panjang_baju, 2, ',', '.') }}
                                        <small>cm</small>
                                    </span>
                                @else
                                    -
                                @endif
                            </td>

                            <td class="measurement-cell">
                                @if ($item->lebar_bahu !== null)
                                    <span class="measurement-value">
                                        {{ number_format((float) $item->lebar_bahu, 2, ',', '.') }}
                                        <small>cm</small>
                                    </span>
                                @else
                                    -
                                @endif
                            </td>

                            <td class="measurement-cell">
                                @if ($item->lingkar_dada !== null)
                                    <span class="measurement-value">
                                        {{ number_format((float) $item->lingkar_dada, 2, ',', '.') }}
                                        <small>cm</small>
                                    </span>
                                @else
                                    -
                                @endif
                            </td>

                            <td class="measurement-cell">
                                @if ($item->lingkar_pinggang !== null)
                                    <span class="measurement-value">
                                        {{ number_format((float) $item->lingkar_pinggang, 2, ',', '.') }}
                                        <small>cm</small>
                                    </span>
                                @else
                                    -
                                @endif
                            </td>

                            <td class="measurement-cell">
                                @if ($item->lingkar_lengan !== null)
                                    <span class="measurement-value">
                                        {{ number_format((float) $item->lingkar_lengan, 2, ',', '.') }}
                                        <small>cm</small>
                                    </span>
                                @else
                                    -
                                @endif
                            </td>

                            <td class="date-cell">
                                @if ($item->tanggal)
                                    <i class="fa-regular fa-calendar"></i>
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="ukuran-empty">
                                <div class="empty-illustration">
                                    <i class="fa-solid fa-ruler-combined"></i>
                                </div>
                                <strong>Belum ada data ukuran</strong>
                                <p>Data ukuran pelanggan akan ditampilkan di sini setelah tersedia.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="no-search-results" id="noSizeResults">
                <i class="fa-solid fa-magnifying-glass" style="margin-right: 6px;"></i>
                Nama pelanggan yang kamu cari tidak ditemukan.
            </div>
        </div>

        <div class="table-footer">
            <span>
                <i class="fa-solid fa-shield-heart"></i>
                Data ukuran untuk referensi pengerjaan jahitan.
            </span>

            <span id="visibleSizeCount">
                Menampilkan {{ $semuaUkuran->count() }} data
            </span>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('sizeSearch');
    const rows = Array.from(document.querySelectorAll('.size-row'));
    const noResults = document.getElementById('noSizeResults');
    const visibleCount = document.getElementById('visibleSizeCount');

    if (!searchInput) return;

    function filterSizes() {
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
                'Menampilkan ' + visible + ' dari ' + rows.length + ' data';
        }
    }

    searchInput.addEventListener('input', filterSizes);
});
</script>
@endsection
