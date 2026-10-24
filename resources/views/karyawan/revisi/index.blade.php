
@extends('layouts.karyawan')

@section('title', 'Riwayat Revisi - JAITIN')
@section('page-title', 'Riwayat Revisi')
@section('page-description', 'Kelola riwayat revisi dan batas waktu revisi pesanan pelanggan.')

@push('styles')
<style>
    .revisi-page {
        color: #493b3b;
    }

    .revisi-intro {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 22px;
        margin-bottom: 24px;
        border: 1px solid #f0dedb;
        border-radius: 18px;
        background: linear-gradient(120deg, #f7e9e7, #fffaf5);
    }

    .revisi-intro-icon {
        width: 52px;
        height: 52px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        background: #fff;
        color: #9f7378;
    }

    .revisi-intro-icon .material-symbols-rounded {
        font-size: 28px;
    }

    .revisi-intro h2 {
        margin: 0 0 6px;
        font-size: 16px;
        font-weight: 700;
        color: #493b3b;
    }

    .revisi-intro p {
        margin: 0;
        color: #8c7b7b;
        font-size: 12px;
        line-height: 1.7;
    }

    .revisi-alert {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 16px;
        margin-bottom: 22px;
        border: 1px solid #cfe5d4;
        border-radius: 12px;
        background: #edf7ef;
        color: #426d4c;
        font-size: 13px;
        line-height: 1.6;
    }

    .revisi-alert .material-symbols-rounded {
        font-size: 21px;
        flex-shrink: 0;
    }

    .revisi-section {
        padding: 25px;
        border: 1px solid #eee1dc;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 8px 24px rgba(99, 65, 65, .06);
    }

    .revisi-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 23px;
    }

    .revisi-heading {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .revisi-heading-icon {
        width: 43px;
        height: 43px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #f5e5e5;
        color: #80575d;
    }

    .revisi-heading-icon .material-symbols-rounded {
        font-size: 23px;
    }

    .revisi-heading h2 {
        margin: 0;
        font-size: 16px;
        font-weight: 800;
        color: #493b3b;
    }

    .revisi-heading p {
        margin: 5px 0 0;
        color: #8c7b7b;
        font-size: 12px;
    }

    .btn-tambah-revisi {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 12px 16px;
        border-radius: 11px;
        background: #b8898d;
        color: #fff;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
        transition: background .2s, transform .2s;
    }

    .btn-tambah-revisi:hover {
        background: #9f7378;
        color: #fff;
        transform: translateY(-1px);
    }

    .btn-tambah-revisi .material-symbols-rounded {
        font-size: 19px;
    }

    .revisi-table-wrapper {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #eee1dc;
        border-radius: 12px;
    }

    .revisi-table {
        width: 100%;
        min-width: 1050px;
        border-collapse: collapse;
        text-align: left;
    }

    .revisi-table thead {
        background: #f7eeea;
    }

    .revisi-table th {
        padding: 15px 14px;
        color: #725b57;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .revisi-table td {
        padding: 14px;
        border-top: 1px solid #f1e8e4;
        color: #655453;
        font-size: 12px;
        vertical-align: middle;
    }

    .revisi-table tbody tr {
        transition: background .2s;
    }

    .revisi-table tbody tr:hover {
        background: #fffaf8;
    }

    .revisi-number {
        color: #8c7b7b !important;
        font-weight: 600;
    }

    .revisi-customer {
        color: #493b3b !important;
        font-weight: 700;
        white-space: nowrap;
    }

    .revisi-order {
        color: #80575d !important;
        font-weight: 600;
        white-space: nowrap;
    }

    .revisi-description {
        min-width: 180px;
        max-width: 280px;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .revisi-date {
        white-space: nowrap;
        color: #776665 !important;
    }

    .revisi-cost {
        white-space: nowrap;
        color: #493b3b !important;
        font-weight: 700;
    }

    .revisi-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 7px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .revisi-status .material-symbols-rounded {
        font-size: 15px;
    }

    .revisi-status.overdue {
        background: #fce8e7;
        color: #a14f4f;
    }

    .revisi-status.safe {
        background: #e7f3e9;
        color: #4c7954;
    }

    .revisi-status.no-deadline {
        background: #f3efed;
        color: #857471;
    }

    .revisi-actions {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .btn-edit-revisi,
    .btn-hapus-revisi {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 8px 10px;
        border-radius: 9px;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s;
    }

    .btn-edit-revisi {
        border: 1px solid #eedbd9;
        background: #fbefee;
        color: #80575d;
    }

    .btn-edit-revisi:hover {
        background: #f1dedd;
        color: #80575d;
    }

    .btn-hapus-revisi {
        border: 1px solid #f0d5d5;
        background: #fceaea;
        color: #a14f4f;
    }

    .btn-hapus-revisi:hover {
        background: #f4d7d7;
    }

    .btn-edit-revisi .material-symbols-rounded,
    .btn-hapus-revisi .material-symbols-rounded {
        font-size: 15px;
    }

    .revisi-empty {
        padding: 50px 20px !important;
        text-align: center;
    }

    .revisi-empty-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        color: #8c7b7b;
    }

    .revisi-empty-content > .material-symbols-rounded {
        font-size: 42px;
        color: #d1afb1;
    }

    .revisi-empty-content strong {
        color: #493b3b;
        font-size: 13px;
    }

    .revisi-empty-content span:last-child {
        font-size: 12px;
    }

    .revisi-table-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 16px;
        color: #8c7b7b;
        font-size: 11px;
    }

    .revisi-table-footer strong {
        color: #493b3b;
    }

    .revisi-table-hint {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .revisi-table-hint .material-symbols-rounded {
        font-size: 17px;
    }

    @media (max-width: 700px) {
        .revisi-section {
            padding: 18px 14px;
        }

        .revisi-section-header {
            align-items: stretch;
            flex-direction: column;
        }

        .btn-tambah-revisi {
            width: 100%;
        }

        .revisi-table-footer {
            align-items: flex-start;
            flex-direction: column;
        }

        .revisi-intro {
            padding: 16px;
        }
    }

    @media (max-width: 420px) {
        .revisi-intro {
            align-items: flex-start;
            gap: 11px;
        }

        .revisi-intro-icon {
            width: 43px;
            height: 43px;
        }

        .revisi-heading h2 {
            font-size: 14px;
        }
    }
</style>
@endpush

@section('content')
<div class="revisi-page">

    <!-- INFORMASI HALAMAN -->
    <section class="revisi-intro">
        <div class="revisi-intro-icon">
            <span class="material-symbols-rounded">edit_note</span>
        </div>

        <div>
            <h2>Pengelolaan Riwayat Revisi</h2>
            <p>
                Pantau keterangan revisi, biaya, dan batas waktu revisi
                untuk membantu memastikan setiap pesanan ditangani dengan baik.
            </p>
        </div>
    </section>

    <!-- NOTIFIKASI BERHASIL -->
    @if(session('success'))
        <div class="revisi-alert">
            <span class="material-symbols-rounded">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- DATA REVISI -->
    <section class="revisi-section">

        <div class="revisi-section-header">
            <div class="revisi-heading">
                <div class="revisi-heading-icon">
                    <span class="material-symbols-rounded">history</span>
                </div>

                <div>
                    <h2>Data Riwayat Revisi</h2>
                    <p>Daftar revisi pesanan pelanggan yang tercatat.</p>
                </div>
            </div>

            <a href="{{ route('karyawan.revisi.create') }}"
               class="btn-tambah-revisi">
                <span class="material-symbols-rounded">add</span>
                Tambah Revisi
            </a>
        </div>

        <div class="revisi-table-wrapper">
            <table class="revisi-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pelanggan</th>
                        <th>Pesanan</th>
                        <th>Keterangan</th>
                        <th>Tanggal Revisi</th>
                        <th>Batas Waktu</th>
                        <th>Biaya Revisi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($revisi as $item)
                        @php
                            $terlambat = $item->batas_waktu_revisi
                                && \Carbon\Carbon::parse($item->batas_waktu_revisi)
                                    ->startOfDay()
                                    ->lt(\Carbon\Carbon::today());
                        @endphp

                        <tr>
                            <td class="revisi-number">
                                {{ $loop->iteration }}
                            </td>

                            <td class="revisi-customer">
                                {{ $item->pesanan->user->nama ?? '-' }}
                            </td>

                            <td class="revisi-order">
                                {{ $item->pesanan->jenis_pakaian ?? '-' }}
                            </td>

                            <td class="revisi-description">
                                {{ $item->keterangan ?? '-' }}
                            </td>

                            <td class="revisi-date">
                                {{ $item->tanggal_revisi
                                    ? \Carbon\Carbon::parse($item->tanggal_revisi)->format('d/m/Y H:i')
                                    : '-' }}
                            </td>

                            <td class="revisi-date">
                                {{ $item->batas_waktu_revisi
                                    ? \Carbon\Carbon::parse($item->batas_waktu_revisi)->format('d/m/Y')
                                    : '-' }}
                            </td>

                            <td class="revisi-cost">
                                Rp {{ number_format($item->biaya_revisi ?? 0, 0, ',', '.') }}
                            </td>

                            <td>
                                @if(!$item->batas_waktu_revisi)
                                    <span class="revisi-status no-deadline">
                                        <span class="material-symbols-rounded">event_busy</span>
                                        Belum Ditentukan
                                    </span>
                                @elseif($terlambat)
                                    <span class="revisi-status overdue">
                                        <span class="material-symbols-rounded">warning</span>
                                        Melewati Batas
                                    </span>
                                @else
                                    <span class="revisi-status safe">
                                        <span class="material-symbols-rounded">check_circle</span>
                                        Dalam Batas
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="revisi-actions">
                                    <a href="{{ route('karyawan.revisi.edit', $item->id_revisi) }}"
                                       class="btn-edit-revisi">
                                        <span class="material-symbols-rounded">edit</span>
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('karyawan.revisi.destroy', $item->id_revisi) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data revisi ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-hapus-revisi">
                                            <span class="material-symbols-rounded">delete</span>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="revisi-empty">
                                <div class="revisi-empty-content">
                                    <span class="material-symbols-rounded">edit_note</span>
                                    <strong>Belum ada riwayat revisi</strong>
                                    <span>Data revisi yang ditambahkan akan muncul di sini.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="revisi-table-footer">
            <span>
                Total data: <strong>{{ $revisi->count() }}</strong> riwayat revisi
            </span>

            <span class="revisi-table-hint">
                <span class="material-symbols-rounded">swipe</span>
                Geser tabel ke samping untuk melihat kolom lainnya.
            </span>
        </div>

    </section>
</div>
@endsection
