@extends('layouts.karyawan')

@section('title', 'Dashboard Karyawan - JAITIN')
@section('page-title', 'Dashboard Karyawan')
@section('page-description', 'Pantau pesanan dan kelola proses pengerjaan jahitan.')

@section('content')

<style>
    .dashboard-karyawan {
        --pink: #b8898d;
        --pink-dark: #9f7378;
        --pink-deep: #80575d;
        --pink-light: #f5e5e5;
        --cream: #fcf8f4;
        --text: #493b3b;
        --muted: #8c7b7b;
        --border: #eee1dc;
        color: var(--text);
    }

    .dashboard-karyawan * {
        box-sizing: border-box;
    }

    /* WELCOME */
    .dashboard-karyawan .welcome {
        position: relative;
        overflow: hidden;
        padding: 27px 29px;
        margin-bottom: 25px;
        border: 1px solid #ead1d1;
        border-radius: 18px;
        background: linear-gradient(115deg, #f5e4e3, #fff6f0);
    }

    .dashboard-karyawan .welcome::after {
        content: '✂';
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%) rotate(-15deg);
        color: rgba(159, 115, 120, .16);
        font-size: 90px;
        line-height: 1;
        pointer-events: none;
    }

    .dashboard-karyawan .welcome-content {
        position: relative;
        z-index: 1;
        max-width: 80%;
    }

    .dashboard-karyawan .welcome-label {
        display: inline-block;
        margin-bottom: 8px;
        color: var(--pink-deep);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.4px;
        text-transform: uppercase;
    }

    .dashboard-karyawan .welcome h2 {
        margin: 0 0 7px;
        color: #563e42;
        font-size: 22px;
        font-weight: 800;
    }

    .dashboard-karyawan .welcome p {
        max-width: 650px;
        margin: 0;
        color: #806b6b;
        font-size: 13px;
        line-height: 1.8;
    }

    /* SUMMARY CARDS */
    .dashboard-karyawan .summary-cards {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 17px;
        margin-bottom: 26px;
    }

    .dashboard-karyawan .summary-card {
        min-width: 0;
        padding: 21px;
        border: 1px solid var(--border);
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 8px 24px rgba(99, 65, 65, .05);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .dashboard-karyawan .summary-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(99, 65, 65, .09);
    }

    .dashboard-karyawan .summary-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 15px;
    }

    .dashboard-karyawan .summary-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        border-radius: 12px;
        background: var(--pink-light);
        color: var(--pink-deep);
    }

    .dashboard-karyawan .summary-icon .material-symbols-rounded {
        font-size: 23px;
    }

    .dashboard-karyawan .summary-number {
        color: var(--pink-deep);
        font-size: 29px;
        font-weight: 800;
        line-height: 1.2;
        overflow-wrap: anywhere;
    }

    .dashboard-karyawan .summary-card h3 {
        margin: 0 0 5px;
        color: var(--text);
        font-size: 13px;
        font-weight: 700;
    }

    .dashboard-karyawan .summary-card p {
        margin: 0;
        color: var(--muted);
        font-size: 11px;
        line-height: 1.7;
    }

    /* SECTION */
    .dashboard-karyawan .content-section {
        padding: 24px;
        margin-bottom: 25px;
        border: 1px solid var(--border);
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 8px 24px rgba(99, 65, 65, .05);
    }

    .dashboard-karyawan .section-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 19px;
    }

    .dashboard-karyawan .section-heading h2 {
        margin: 0;
        color: var(--text);
        font-size: 17px;
        font-weight: 800;
    }

    .dashboard-karyawan .section-heading p {
        margin: 4px 0 0;
        color: var(--muted);
        font-size: 12px;
    }

    .dashboard-karyawan .section-tag {
        padding: 6px 10px;
        border-radius: 8px;
        background: var(--pink-light);
        color: var(--pink-deep);
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    /* QUICK MENU */
    .dashboard-karyawan .quick-menu {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 15px;
    }

    .dashboard-karyawan .quick-menu a {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
        padding: 17px;
        border: 1px solid var(--border);
        border-radius: 13px;
        background: #fffdfb;
        color: var(--text);
        text-decoration: none;
        transition: border-color .2s ease, background .2s ease,
                    transform .2s ease;
    }

    .dashboard-karyawan .quick-menu a:hover {
        transform: translateY(-2px);
        border-color: #d9b5b8;
        background: #fff7f5;
    }

    .dashboard-karyawan .quick-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        flex-shrink: 0;
        border-radius: 12px;
        background: var(--pink-light);
        color: var(--pink-deep);
    }

    .dashboard-karyawan .quick-icon .material-symbols-rounded {
        font-size: 24px;
    }

    .dashboard-karyawan .quick-text {
        min-width: 0;
        flex: 1;
    }

    .dashboard-karyawan .quick-text strong {
        display: block;
        margin-bottom: 3px;
        font-size: 12px;
        font-weight: 700;
    }

    .dashboard-karyawan .quick-text span {
        display: block;
        color: var(--muted);
        font-size: 10px;
        line-height: 1.6;
    }

    .dashboard-karyawan .quick-arrow {
        color: #b89a9a;
        font-size: 19px;
    }

    /* TABLE */
    .dashboard-karyawan .table-responsive {
        width: 100%;
        overflow-x: auto;
        border: 1px solid var(--border);
        border-radius: 12px;
    }

    .dashboard-karyawan table {
        width: 100%;
        min-width: 720px;
        border-collapse: collapse;
    }

    .dashboard-karyawan thead th {
        padding: 13px 15px;
        background: #fbf0ed;
        color: #72585a;
        text-align: left;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .dashboard-karyawan tbody td {
        padding: 14px 15px;
        border-bottom: 1px solid #f2e8e3;
        color: #675656;
        font-size: 12px;
        vertical-align: middle;
    }

    .dashboard-karyawan tbody tr:last-child td {
        border-bottom: none;
    }

    .dashboard-karyawan tbody tr:hover {
        background: #fffaf8;
    }

    .dashboard-karyawan .table-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 27px;
        height: 27px;
        border-radius: 8px;
        background: #f8eeee;
        color: var(--pink-deep);
        font-size: 11px;
        font-weight: 700;
    }

    .dashboard-karyawan .customer-name {
        color: var(--text);
        font-weight: 700;
    }

    .dashboard-karyawan .status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 10px;
        border: 1px solid #ead5d5;
        border-radius: 20px;
        background: #fbefef;
        color: #8b5d63;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .dashboard-karyawan .status::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .dashboard-karyawan .empty {
        padding: 35px 20px !important;
        color: var(--muted);
        text-align: center;
    }

    .dashboard-karyawan .empty .material-symbols-rounded {
        display: block;
        margin-bottom: 8px;
        color: #c6a3a5;
        font-size: 30px;
    }

    @media (max-width: 1200px) {
        .dashboard-karyawan .summary-cards {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .dashboard-karyawan .quick-menu {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 560px) {
        .dashboard-karyawan .welcome {
            padding: 22px 19px;
        }

        .dashboard-karyawan .welcome-content {
            max-width: 100%;
        }

        .dashboard-karyawan .welcome::after {
            right: 12px;
            top: 18px;
            transform: rotate(-15deg);
            font-size: 55px;
        }

        .dashboard-karyawan .welcome h2 {
            max-width: 85%;
            font-size: 19px;
        }

        .dashboard-karyawan .welcome p {
            font-size: 12px;
        }

        .dashboard-karyawan .summary-cards {
            gap: 10px;
        }

        .dashboard-karyawan .summary-card {
            padding: 15px;
        }

        .dashboard-karyawan .summary-icon {
            width: 35px;
            height: 35px;
        }

        .dashboard-karyawan .summary-number {
            font-size: 25px;
        }

        .dashboard-karyawan .summary-card h3 {
            font-size: 12px;
        }

        .dashboard-karyawan .summary-card p {
            font-size: 10px;
        }

        .dashboard-karyawan .content-section {
            padding: 17px 14px;
        }

        .dashboard-karyawan .section-heading h2 {
            font-size: 15px;
        }

        .dashboard-karyawan .quick-menu a {
            padding: 13px;
        }
    }

    @media (max-width: 360px) {
        .dashboard-karyawan .summary-cards {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dashboard-karyawan">

    {{-- SAMBUTAN --}}
    <section class="welcome">
        <div class="welcome-content">
            <span class="welcome-label">Ruang Kerja JAITIN</span>

            <h2>
                Selamat datang, {{ Auth::user()->nama ?? 'Karyawan' }}!
            </h2>

            <p>
                Selamat bekerja! Gunakan dashboard ini untuk mengelola
                ukuran pelanggan, memantau riwayat revisi, dan memperbarui
                status pengerjaan jahitan agar setiap pesanan dapat
                ditangani dengan baik.
            </p>
        </div>
    </section>

    {{-- RINGKASAN DATA --}}
    <section class="summary-cards">

        <article class="summary-card">
            <div class="summary-card-top">
                <div class="summary-icon">
                    <span class="material-symbols-rounded">receipt_long</span>
                </div>
                <div class="summary-number">
                    {{ $totalPesanan ?? 0 }}
                </div>
            </div>

            <h3>Total Pesanan</h3>
            <p>Jumlah seluruh pesanan yang tercatat dalam sistem.</p>
        </article>

        <article class="summary-card">
            <div class="summary-card-top">
                <div class="summary-icon">
                    <span class="material-symbols-rounded">apparel</span>
                </div>
                <div class="summary-number">
                    {{ $pesananDiproses ?? 0 }}
                </div>
            </div>

            <h3>Sedang Dikerjakan</h3>
            <p>Pesanan yang masih berada dalam proses pengerjaan.</p>
        </article>

        <article class="summary-card">
            <div class="summary-card-top">
                <div class="summary-icon">
                    <span class="material-symbols-rounded">task_alt</span>
                </div>
                <div class="summary-number">
                    {{ $pesananSelesai ?? 0 }}
                </div>
            </div>

            <h3>Pesanan Selesai</h3>
            <p>Pesanan yang sudah selesai dikerjakan.</p>
        </article>

        <article class="summary-card">
            <div class="summary-card-top">
                <div class="summary-icon">
                    <span class="material-symbols-rounded">history</span>
                </div>
                <div class="summary-number">
                    {{ $totalRevisi ?? 0 }}
                </div>
            </div>

            <h3>Riwayat Revisi</h3>
            <p>Jumlah data revisi yang tercatat di sistem.</p>
        </article>

    </section>

    {{-- MENU KARYAWAN --}}
    <section class="content-section">
        <div class="section-heading">
            <div>
                <h2>Akses Menu Karyawan</h2>
                <p>Pilih menu untuk melanjutkan pekerjaan Anda.</p>
            </div>

            <span class="section-tag">Menu Utama</span>
        </div>

        <div class="quick-menu">

            <a href="{{ route('karyawan.ukuran.index') }}">
                <div class="quick-icon">
                    <span class="material-symbols-rounded">straighten</span>
                </div>

                <div class="quick-text">
                    <strong>Ukuran Pelanggan</strong>
                    <span>Lihat dan kelola data ukuran pelanggan.</span>
                </div>

                <span class="material-symbols-rounded quick-arrow">chevron_right</span>
            </a>

            <a href="{{ route('karyawan.revisi.index') }}">
                <div class="quick-icon">
                    <span class="material-symbols-rounded">history</span>
                </div>

                <div class="quick-text">
                    <strong>Riwayat Revisi</strong>
                    <span>Pantau catatan revisi pesanan jahitan.</span>
                </div>

                <span class="material-symbols-rounded quick-arrow">chevron_right</span>
            </a>

            <a href="{{ route('karyawan.pengerjaan.index') }}">
                <div class="quick-icon">
                    <span class="material-symbols-rounded">content_cut</span>
                </div>

                <div class="quick-text">
                    <strong>Status Pengerjaan</strong>
                    <span>Periksa status dan estimasi penyelesaian.</span>
                </div>

                <span class="material-symbols-rounded quick-arrow">chevron_right</span>
            </a>

        </div>
    </section>

    {{-- PESANAN TERBARU --}}
    <section class="content-section">
        <div class="section-heading">
            <div>
                <h2>Pesanan Terbaru</h2>
                <p>Ringkasan pesanan yang tercatat di sistem JAITIN.</p>
            </div>

            <span class="section-tag">
                {{ isset($pesananTerbaru) ? $pesananTerbaru->count() : 0 }} Data
            </span>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pelanggan</th>
                        <th>Jenis Pakaian</th>
                        <th>Jumlah</th>
                        <th>Status Pengerjaan</th>
                        <th>Estimasi Selesai</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse(($pesananTerbaru ?? []) as $item)
                        <tr>
                            <td>
                                <span class="table-number">
                                    {{ $loop->iteration }}
                                </span>
                            </td>

                            <td>
                                <span class="customer-name">
                                    {{ $item->user->nama ?? '-' }}
                                </span>
                            </td>

                            <td>
                                {{ $item->jenis_pakaian ?? '-' }}
                            </td>

                            <td>
                                {{ $item->jumlah ?? 0 }} pcs
                            </td>

                            <td>
                                <span class="status">
                                    {{ $item->status_pengerjaan ?? $item->status ?? '-' }}
                                </span>
                            </td>

                            <td>
                                @if(!empty($item->estimasi_selesai))
                                    {{ $item->estimasi_selesai instanceof \Carbon\Carbon
                                        ? $item->estimasi_selesai->format('d M Y')
                                        : $item->estimasi_selesai }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">
                                <span class="material-symbols-rounded">inbox</span>
                                Belum ada pesanan yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

</div>

@endsection
