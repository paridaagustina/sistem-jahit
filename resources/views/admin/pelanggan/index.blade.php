@extends('layouts.admin')

@section('title', 'Data Pelanggan - JAITIN')
@section('page-title', 'Data Pelanggan')
@section('page-description', 'Kelola informasi dan data pelanggan JAITIN.')

@section('styles')
<style>
    :root {
        --customer-primary: #b8898d;
        --customer-primary-dark: #96696e;
        --customer-pink-soft: #f5e7e7;
        --customer-cream: #fffaf6;
        --customer-text: #493936;
        --customer-muted: #927f7b;
        --customer-border: #eee3de;
        --customer-shadow: 0 10px 30px rgba(103, 72, 65, .055);
    }

    .customer-page {
        display: flex;
        flex-direction: column;
        gap: 22px;
        color: var(--customer-text);
    }

    /* HEADER */
    .customer-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 22px;
        padding: 30px;
        border-radius: 22px;
        background: linear-gradient(120deg, #b8898d 0%, #c99b9d 58%, #dfb9ad 100%);
        color: #fff;
        box-shadow: 0 12px 28px rgba(153, 103, 109, .16);
    }

    .customer-hero::before,
    .customer-hero::after {
        content: "";
        position: absolute;
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 50%;
        pointer-events: none;
    }

    .customer-hero::before {
        width: 250px;
        height: 250px;
        right: 80px;
        top: -155px;
    }

    .customer-hero::after {
        width: 190px;
        height: 190px;
        right: -50px;
        bottom: -120px;
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
        letter-spacing: 1.4px;
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
        color: rgba(255,255,255,.86);
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
        width: 100px;
        height: 100px;
        border: 1px solid rgba(255,255,255,.3);
        border-radius: 28px;
        background: rgba(255,255,255,.13);
        transform: rotate(-7deg);
    }

    .hero-decoration i {
        color: #fff;
        font-size: 43px;
        transform: rotate(7deg);
    }

    /* TOMBOL */
    .btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 9px;
        padding: 12px 17px;
        border: 0;
        border-radius: 12px;
        font-family: inherit;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        white-space: nowrap;
        transition: .2s ease;
    }

    .btn-add {
        position: relative;
        z-index: 2;
        flex-shrink: 0;
        background: #fffaf7;
        color: var(--customer-primary-dark);
        box-shadow: 0 5px 15px rgba(76, 43, 43, .09);
    }

    .btn-add:hover {
        background: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(76, 43, 43, .14);
    }

    .btn-edit,
    .btn-delete {
        padding: 8px 11px;
        border-radius: 9px;
        font-size: 11px;
    }

    .btn-edit {
        background: #f3e4e5;
        color: #8d5f65;
    }

    .btn-edit:hover {
        background: #e9d1d3;
        transform: translateY(-1px);
    }

    .btn-delete {
        background: #fff0ed;
        color: #a74f52;
    }

    .btn-delete:hover {
        background: #f8dcd7;
        transform: translateY(-1px);
    }

    /* STATISTIK */
    .customer-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    .stat-card {
        display: flex;
        align-items: center;
        gap: 15px;
        min-width: 0;
        padding: 20px;
        border: 1px solid var(--customer-border);
        border-radius: 18px;
        background: var(--customer-cream);
        box-shadow: var(--customer-shadow);
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
        width: 50px;
        height: 50px;
        border-radius: 15px;
        background: var(--customer-pink-soft);
        color: var(--customer-primary-dark);
        font-size: 20px;
    }

    .stat-icon.peach {
        background: #f9e9dd;
        color: #ae795b;
    }

    .stat-icon.green {
        background: #e8f1e7;
        color: #638468;
    }

    .stat-info {
        min-width: 0;
    }

    .stat-info span {
        display: block;
        margin-bottom: 6px;
        color: var(--customer-muted);
        font-size: 11px;
        font-weight: 600;
    }

    .stat-info strong {
        display: block;
        color: var(--customer-text);
        font-size: 25px;
        line-height: 1.1;
        font-weight: 800;
        letter-spacing: -.5px;
        overflow-wrap: anywhere;
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
        border: 1px solid #d5e8d4;
        color: #426b47;
    }

    .alert-error,
    .validation-error {
        background: #fff0ef;
        border: 1px solid #f0d3d1;
        color: #985052;
    }

    .validation-error ul {
        margin: 7px 0 0;
        padding-left: 18px;
    }

    /* TABEL */
    .table-box {
        overflow: hidden;
        border: 1px solid var(--customer-border);
        border-radius: 20px;
        background: var(--customer-cream);
        box-shadow: var(--customer-shadow);
    }

    .table-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        padding: 23px 24px;
        border-bottom: 1px solid var(--customer-border);
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
        width: 43px;
        height: 43px;
        flex-shrink: 0;
        border-radius: 13px;
        background: var(--customer-pink-soft);
        color: var(--customer-primary-dark);
        font-size: 17px;
    }

    .table-title h3 {
        margin: 0 0 5px;
        color: var(--customer-text);
        font-size: 15px;
        font-weight: 750;
    }

    .table-title p {
        color: var(--customer-muted);
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
    }

    .table-tools {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 17px 24px;
    }

    .table-description {
        color: var(--customer-muted);
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
        border-color: var(--customer-primary);
        box-shadow: 0 0 0 3px rgba(184,137,141,.12);
    }

    .search-box input {
        width: 100%;
        min-width: 0;
        border: 0;
        outline: none;
        background: transparent;
        color: var(--customer-text);
        font: inherit;
        font-size: 12px;
    }

    .search-box input::placeholder {
        color: #b4a09a;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
        border-top: 1px solid var(--customer-border);
    }

    .customer-table {
        width: 100%;
        min-width: 950px;
        border-collapse: separate;
        border-spacing: 0;
    }

    .customer-table thead th {
        padding: 14px 16px;
        background: #f8efea;
        color: #806761;
        text-align: left;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .65px;
        text-transform: uppercase;
        white-space: nowrap;
        border-bottom: 1px solid var(--customer-border);
    }

    .customer-table tbody td {
        padding: 15px 16px;
        color: #705b55;
        font-size: 12px;
        line-height: 1.6;
        vertical-align: middle;
        border-bottom: 1px solid #f1e8e3;
    }

    .customer-table tbody tr {
        transition: background .2s ease;
    }

    .customer-table tbody tr:hover {
        background: #fff4ef;
    }

    .customer-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .number-cell {
        width: 55px;
        color: #b1948e !important;
        font-weight: 750;
    }

    .customer-profile {
        display: flex;
        align-items: center;
        gap: 11px;
        min-width: 175px;
    }

    .customer-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 41px;
        height: 41px;
        flex-shrink: 0;
        border: 1px solid #ead5d6;
        border-radius: 13px;
        background: linear-gradient(145deg, #f7e8e8, #f0dada);
        color: #94656b;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .customer-profile strong {
        display: block;
        max-width: 210px;
        color: var(--customer-text);
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

    .email-cell {
        min-width: 180px;
        overflow-wrap: anywhere;
    }

    .phone-cell {
        white-space: nowrap;
    }

    .address-cell {
        min-width: 160px;
        max-width: 230px;
        overflow-wrap: anywhere;
    }

    .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 10px;
        border: 1px solid #ead8d9;
        border-radius: 30px;
        background: #f8ebeb;
        color: #8d5f65;
        font-size: 10px;
        font-weight: 750;
        white-space: nowrap;
    }

    .role-badge i {
        font-size: 10px;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .action-buttons form {
        margin: 0;
    }

    .empty {
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

    .empty strong {
        display: block;
        margin-bottom: 7px;
        color: var(--customer-text);
        font-size: 14px;
    }

    .empty p {
        color: var(--customer-muted);
        font-size: 12px;
    }

    .no-search-results {
        display: none;
        padding: 30px 15px;
        color: var(--customer-muted);
        text-align: center;
        font-size: 12px;
    }

    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding: 14px 24px;
        border-top: 1px solid var(--customer-border);
        background: #fffaf6;
        color: var(--customer-muted);
        font-size: 11px;
    }

    .table-footer i {
        margin-right: 5px;
        color: #b8898d;
    }

    @media (max-width: 1000px) {
        .customer-stats {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 11px;
        }

        .stat-card {
            padding: 15px;
            gap: 11px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
        }

        .stat-info strong {
            font-size: 22px;
        }
    }

    @media (max-width: 700px) {
        .customer-page {
            gap: 16px;
        }

        .customer-hero {
            align-items: flex-start;
            flex-direction: column;
            padding: 23px;
            border-radius: 18px;
        }

        .hero-decoration {
            position: absolute;
            right: 17px;
            top: 20px;
            width: 57px;
            height: 57px;
            border-radius: 17px;
            opacity: .65;
        }

        .hero-decoration i {
            font-size: 25px;
        }

        .hero-content {
            padding-right: 35px;
        }

        .hero-content h2 {
            font-size: 23px;
        }

        .hero-content p {
            font-size: 12px;
        }

        .btn-add {
            width: 100%;
        }

        .customer-stats {
            grid-template-columns: 1fr;
        }

        .stat-card {
            padding: 16px;
        }

        .stat-info strong {
            font-size: 23px;
        }

        .table-box {
            border-radius: 16px;
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
        .customer-page *,
        .customer-page *::before,
        .customer-page *::after {
            transition: none !important;
            animation: none !important;
        }
    }
</style>
@endsection

@section('content')
<div class="customer-page">

    {{-- HEADER --}}
    <section class="customer-hero">
        <div class="hero-content">
            <div class="hero-label">
                <i class="fa-solid fa-users"></i>
                MANAJEMEN PELANGGAN
            </div>

            <h2>Data Pelanggan</h2>

            <p>
                Kelola informasi akun pelanggan JAITIN dengan lebih mudah,
                rapi, dan terorganisasi dalam satu halaman.
            </p>
        </div>

        <div class="hero-decoration" aria-hidden="true">
            <i class="fa-solid fa-user-group"></i>
        </div>

        <a href="{{ route('admin.pelanggan.create') }}" class="btn btn-add">
            <i class="fa-solid fa-user-plus"></i>
            Tambah Pelanggan
        </a>
    </section>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success" role="status">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error" role="alert">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="alert validation-error" role="alert">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <strong>Periksa kembali data berikut:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- STATISTIK --}}
    <section class="customer-stats">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="stat-info">
                <span>Total Data Pelanggan</span>
                <strong>{{ $pelanggan->count() }}</strong>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon peach">
                <i class="fa-solid fa-user-check"></i>
            </div>
            <div class="stat-info">
                <span>Akun Terdaftar</span>
                <strong>{{ $pelanggan->count() }}</strong>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fa-solid fa-address-book"></i>
            </div>
            <div class="stat-info">
                <span>Informasi Kontak</span>
                <strong>{{ $pelanggan->filter(fn ($item) => filled($item->email) || filled($item->no_hp))->count() }}</strong>
            </div>
        </div>
    </section>

    {{-- TABEL DATA --}}
    <section class="table-box">
        <div class="table-top">
            <div class="table-title">
                <div class="table-title-icon">
                    <i class="fa-solid fa-address-card"></i>
                </div>
                <div>
                    <h3>Daftar Pelanggan</h3>
                    <p>Informasi akun dan kontak pelanggan yang terdaftar.</p>
                </div>
            </div>

            <span class="table-count">
                <i class="fa-solid fa-database"></i>
                {{ $pelanggan->count() }} data
            </span>
        </div>

        <div class="table-tools">
            <p class="table-description">
                <i class="fa-solid fa-circle-info"></i>
                Gunakan pencarian untuk menemukan data dengan cepat.
            </p>

            <label class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input
                    type="search"
                    id="customerSearch"
                    placeholder="Cari nama, email, nomor HP..."
                    aria-label="Cari data pelanggan"
                    autocomplete="off"
                >
            </label>
        </div>

        <div class="table-responsive">
            <table class="customer-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pelanggan</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody id="customerTableBody">
                    @forelse($pelanggan as $item)
                        <tr class="customer-row">
                            <td class="number-cell">{{ $loop->iteration }}</td>

                            <td>
                                <div class="customer-profile">
                                    <div class="customer-avatar">
                                        {{ \Illuminate\Support\Str::substr(
                                            trim($item->nama ?? 'P'),
                                            0,
                                            1
                                        ) }}
                                    </div>

                                    <div>
                                        <strong>{{ $item->nama ?? '-' }}</strong>
                                        <small>ID pelanggan: {{ $item->id_user }}</small>
                                    </div>
                                </div>
                            </td>

                            <td class="email-cell">
                                {{ $item->email ?? '-' }}
                            </td>

                            <td class="phone-cell">
                                {{ $item->no_hp ?? '-' }}
                            </td>

                            <td class="address-cell">
                                {{ $item->alamat ?? '-' }}
                            </td>

                            <td>
                                <span class="role-badge">
                                    <i class="fa-solid fa-user-tag"></i>
                                    {{ ucfirst($item->role ?? 'pelanggan') }}
                                </span>
                            </td>

                            <td>
                                <div class="action-buttons">
                                    <a
                                        href="{{ route('admin.pelanggan.edit', $item->id_user) }}"
                                        class="btn btn-edit"
                                        aria-label="Edit pelanggan {{ $item->nama }}"
                                    >
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.pelanggan.destroy', $item->id_user) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus pelanggan {{ addslashes($item->nama ?? 'ini') }}? Tindakan ini tidak dapat dibatalkan.');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-delete"
                                            aria-label="Hapus pelanggan {{ $item->nama }}"
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
                            <td colspan="7" class="empty">
                                <div class="empty-illustration">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <strong>Belum ada data pelanggan</strong>
                                <p>Tambahkan pelanggan baru agar datanya tampil di halaman ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="no-search-results" id="noSearchResults">
                <i class="fa-solid fa-magnifying-glass" style="margin-right: 6px;"></i>
                Data pelanggan yang kamu cari tidak ditemukan.
            </div>
        </div>

        <div class="table-footer">
            <span>
                <i class="fa-solid fa-shield-heart"></i>
                Kelola data pelanggan dengan cermat.
            </span>

            <span id="visibleCustomerCount">
                Menampilkan {{ $pelanggan->count() }} data
            </span>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('customerSearch');
    const rows = Array.from(document.querySelectorAll('.customer-row'));
    const noResults = document.getElementById('noSearchResults');
    const visibleCount = document.getElementById('visibleCustomerCount');

    if (!searchInput) return;

    function filterCustomers() {
        const keyword = searchInput.value.trim().toLocaleLowerCase('id-ID');
        let visible = 0;

        rows.forEach(function (row) {
            const matches = row.textContent
                .toLocaleLowerCase('id-ID')
                .includes(keyword);

            row.style.display = matches ? '' : 'none';

            if (matches) {
                visible++;
            }
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

    searchInput.addEventListener('input', filterCustomers);
});
</script>
@endsection
