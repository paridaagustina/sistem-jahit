
@extends('layouts.karyawan')

@section('title', 'Ukuran Pelanggan - JAITIN')
@section('page-title', 'Ukuran Pelanggan')
@section('page-description', 'Kelola data ukuran pelanggan untuk kebutuhan pengerjaan jahit.')

@push('styles')
<style>
    .ukuran-page {
        color: #493b3b;
    }

    .ukuran-intro {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 22px;
        margin-bottom: 24px;
        border: 1px solid #f0dedb;
        border-radius: 18px;
        background: linear-gradient(120deg, #f7e9e7, #fffaf5);
    }

    .ukuran-intro-icon {
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

    .ukuran-intro-icon .material-symbols-rounded {
        font-size: 28px;
    }

    .ukuran-intro h2 {
        margin: 0 0 6px;
        font-size: 16px;
        font-weight: 700;
        color: #493b3b;
    }

    .ukuran-intro p {
        margin: 0;
        color: #8c7b7b;
        font-size: 12px;
        line-height: 1.7;
    }

    .ukuran-section {
        padding: 25px;
        border: 1px solid #eee1dc;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 8px 24px rgba(99, 65, 65, .06);
    }

    .ukuran-section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 23px;
    }

    .ukuran-heading {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .ukuran-heading-icon {
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

    .ukuran-heading-icon .material-symbols-rounded {
        font-size: 23px;
    }

    .ukuran-heading h2 {
        margin: 0;
        font-size: 16px;
        font-weight: 800;
        color: #493b3b;
    }

    .ukuran-heading p {
        margin: 5px 0 0;
        color: #8c7b7b;
        font-size: 12px;
    }

    .btn-tambah-ukuran {
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

    .btn-tambah-ukuran:hover {
        background: #9f7378;
        color: #fff;
        transform: translateY(-1px);
    }

    .btn-tambah-ukuran .material-symbols-rounded {
        font-size: 19px;
    }

    .ukuran-table-wrapper {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #eee1dc;
        border-radius: 12px;
    }

    .ukuran-table {
        width: 100%;
        min-width: 950px;
        border-collapse: collapse;
        text-align: left;
    }

    .ukuran-table thead {
        background: #f7eeea;
    }

    .ukuran-table th {
        padding: 15px 14px;
        color: #725b57;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .ukuran-table td {
        padding: 15px 14px;
        border-top: 1px solid #f1e8e4;
        color: #655453;
        font-size: 12px;
        white-space: nowrap;
    }

    .ukuran-table tbody tr {
        transition: background .2s;
    }

    .ukuran-table tbody tr:hover {
        background: #fffaf8;
    }

    .ukuran-number {
        color: #8c7b7b !important;
        font-weight: 600;
    }

    .ukuran-customer {
        color: #493b3b !important;
        font-weight: 700;
    }

    .ukuran-value {
        color: #71585a;
        font-weight: 600;
    }

    .ukuran-unit {
        margin-left: 3px;
        color: #8c7b7b;
        font-size: 10px;
    }

    .ukuran-date {
        color: #8c7b7b !important;
    }

    .btn-edit-ukuran {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 8px 11px;
        border: 1px solid #eedbd9;
        border-radius: 9px;
        background: #fbefee;
        color: #80575d;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        transition: background .2s;
    }

    .btn-edit-ukuran:hover {
        background: #f1dedd;
        color: #80575d;
    }

    .btn-edit-ukuran .material-symbols-rounded {
        font-size: 16px;
    }

    .ukuran-empty {
        padding: 50px 20px !important;
        text-align: center;
        white-space: normal !important;
    }

    .ukuran-empty-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        color: #8c7b7b;
    }

    .ukuran-empty-content > .material-symbols-rounded {
        font-size: 42px;
        color: #d1afb1;
    }

    .ukuran-empty-content strong {
        color: #493b3b;
        font-size: 13px;
    }

    .ukuran-empty-content span:last-child {
        font-size: 12px;
    }

    .ukuran-table-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 16px;
        color: #8c7b7b;
        font-size: 11px;
    }

    .ukuran-table-footer strong {
        color: #493b3b;
    }

    .ukuran-table-hint {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .ukuran-table-hint .material-symbols-rounded {
        font-size: 17px;
    }

    @media (max-width: 700px) {
        .ukuran-section {
            padding: 18px 14px;
        }

        .ukuran-section-header {
            align-items: stretch;
            flex-direction: column;
        }

        .btn-tambah-ukuran {
            width: 100%;
        }

        .ukuran-table-footer {
            align-items: flex-start;
            flex-direction: column;
        }

        .ukuran-intro {
            padding: 16px;
        }
    }

    @media (max-width: 420px) {
        .ukuran-intro {
            align-items: flex-start;
            gap: 11px;
        }

        .ukuran-intro-icon {
            width: 43px;
            height: 43px;
        }

        .ukuran-heading h2 {
            font-size: 14px;
        }

        .ukuran-heading p {
            line-height: 1.6;
        }
    }
</style>
@endpush

@section('content')
<div class="ukuran-page">

    <!-- INFORMASI HALAMAN -->
    <section class="ukuran-intro">
        <div class="ukuran-intro-icon">
            <span class="material-symbols-rounded">straighten</span>
        </div>

        <div>
            <h2>Data Ukuran Pelanggan</h2>
            <p>
                Kelola dan periksa detail ukuran pelanggan sebagai acuan
                dalam proses pembuatan pakaian agar hasil jahitan sesuai kebutuhan.
            </p>
        </div>
    </section>

    <!-- DAFTAR UKURAN -->
    <section class="ukuran-section">

        <div class="ukuran-section-header">
            <div class="ukuran-heading">
                <div class="ukuran-heading-icon">
                    <span class="material-symbols-rounded">format_list_bulleted</span>
                </div>

                <div>
                    <h2>Daftar Ukuran Pelanggan</h2>
                    <p>Data ukuran pelanggan yang telah tersimpan.</p>
                </div>
            </div>

            <a href="{{ route('karyawan.ukuran.create') }}"
               class="btn-tambah-ukuran">
                <span class="material-symbols-rounded">add</span>
                Tambah Ukuran
            </a>
        </div>

        <div class="ukuran-table-wrapper">
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
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($ukuran as $item)
                        <tr>
                            <td class="ukuran-number">
                                {{ $loop->iteration }}
                            </td>

                            <td class="ukuran-customer">
                                {{ $item->user->nama ?? '-' }}
                            </td>

                            <td class="ukuran-value">
                                {{ $item->panjang_baju !== null ? number_format($item->panjang_baju, 2) : '-' }}
                                @if($item->panjang_baju !== null)
                                    <span class="ukuran-unit">cm</span>
                                @endif
                            </td>

                            <td class="ukuran-value">
                                {{ $item->lebar_bahu !== null ? number_format($item->lebar_bahu, 2) : '-' }}
                                @if($item->lebar_bahu !== null)
                                    <span class="ukuran-unit">cm</span>
                                @endif
                            </td>

                            <td class="ukuran-value">
                                {{ $item->lingkar_dada !== null ? number_format($item->lingkar_dada, 2) : '-' }}
                                @if($item->lingkar_dada !== null)
                                    <span class="ukuran-unit">cm</span>
                                @endif
                            </td>

                            <td class="ukuran-value">
                                {{ $item->lingkar_pinggang !== null ? number_format($item->lingkar_pinggang, 2) : '-' }}
                                @if($item->lingkar_pinggang !== null)
                                    <span class="ukuran-unit">cm</span>
                                @endif
                            </td>

                            <td class="ukuran-value">
                                {{ $item->lingkar_lengan !== null ? number_format($item->lingkar_lengan, 2) : '-' }}
                                @if($item->lingkar_lengan !== null)
                                    <span class="ukuran-unit">cm</span>
                                @endif
                            </td>

                            <td class="ukuran-date">
                                {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') : '-' }}
                            </td>

                            <td>
                                <a href="{{ route('karyawan.ukuran.edit', $item->id_ukuran) }}"
                                   class="btn-edit-ukuran">
                                    <span class="material-symbols-rounded">edit</span>
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="ukuran-empty">
                                <div class="ukuran-empty-content">
                                    <span class="material-symbols-rounded">straighten</span>
                                    <strong>Belum ada data ukuran</strong>
                                    <span>Data ukuran pelanggan akan ditampilkan di sini.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="ukuran-table-footer">
            <span>
                Total data: <strong>{{ $ukuran->count() }}</strong> ukuran pelanggan
            </span>

            <span class="ukuran-table-hint">
                <span class="material-symbols-rounded">swipe</span>
                Geser tabel ke samping untuk melihat kolom lainnya.
            </span>
        </div>

    </section>
</div>
@endsection
