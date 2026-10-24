@extends('layouts.karyawan')

@section('title', 'Status Pengerjaan - JAITIN')
@section('page-title', 'Status Pengerjaan')
@section('page-description', 'Kelola proses pengerjaan dan estimasi penyelesaian pesanan pelanggan.')

@push('styles')
<style>
    .pengerjaan-page {
        color: #493b3b;
    }

    .pengerjaan-page .content-card {
        background: #fff;
        border: 1px solid #eee1dc;
        border-radius: 18px;
        padding: 25px;
        box-shadow: 0 8px 24px rgba(99, 65, 65, .05);
    }

    .pengerjaan-page .section-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 22px;
        flex-wrap: wrap;
    }

    .pengerjaan-page .section-heading h2 {
        font-size: 19px;
        font-weight: 700;
        color: #493b3b;
        margin: 0;
    }

    .pengerjaan-page .section-heading p {
        color: #8c7b7b;
        font-size: 13px;
        margin-top: 5px;
    }

    .pengerjaan-page .alert-success {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        background: #edf7ef;
        color: #34734a;
        border: 1px solid #d2ead8;
        font-size: 14px;
    }

    .pengerjaan-page .table-wrapper {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #eee1dc;
        border-radius: 12px;
    }

    .pengerjaan-page table {
        width: 100%;
        min-width: 1050px;
        border-collapse: collapse;
    }

    .pengerjaan-page thead th {
        background: #f8eeeb;
        color: #76585b;
        font-size: 12px;
        font-weight: 700;
        padding: 15px 14px;
        text-align: left;
        white-space: nowrap;
        border-bottom: 1px solid #eee1dc;
    }

    .pengerjaan-page tbody td {
        padding: 15px 14px;
        border-bottom: 1px solid #f1e8e4;
        font-size: 13px;
        vertical-align: middle;
    }

    .pengerjaan-page tbody tr:last-child td {
        border-bottom: none;
    }

    .pengerjaan-page tbody tr:hover {
        background: #fdf9f7;
    }

    .pengerjaan-page .number-cell {
        color: #9b8585;
        width: 45px;
    }

    .pengerjaan-page .customer-name {
        font-weight: 600;
        color: #493b3b;
    }

    .pengerjaan-page .muted {
        color: #8c7b7b;
    }

    .pengerjaan-page .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
        background: #f5e5e5;
        color: #80575d;
    }

    .pengerjaan-page .status-badge::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .pengerjaan-page .status-menunggu {
        background: #fff3d9;
        color: #956b1e;
    }

    .pengerjaan-page .status-proses {
        background: #e9f0ff;
        color: #4569ae;
    }

    .pengerjaan-page .status-selesai {
        background: #e8f6eb;
        color: #34734a;
    }

    .pengerjaan-page .status-form {
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 440px;
    }

    .pengerjaan-page .form-control {
        min-height: 38px;
        padding: 9px 10px;
        border: 1px solid #e6d7d2;
        border-radius: 9px;
        background: #fff;
        color: #493b3b;
        font-family: inherit;
        font-size: 12px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .pengerjaan-page .form-control:focus {
        border-color: #b8898d;
        box-shadow: 0 0 0 3px rgba(184, 137, 141, .13);
    }

    .pengerjaan-page select.form-control {
        width: 180px;
    }

    .pengerjaan-page input[type="date"].form-control {
        width: 145px;
    }

    .pengerjaan-page .btn-save {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        min-height: 38px;
        padding: 9px 13px;
        border: none;
        border-radius: 9px;
        background: #b8898d;
        color: #fff;
        font-family: inherit;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s, transform .2s;
        white-space: nowrap;
    }

    .pengerjaan-page .btn-save:hover {
        background: #9f7378;
        transform: translateY(-1px);
    }

    .pengerjaan-page .empty-state {
        padding: 55px 20px;
        text-align: center;
        color: #8c7b7b;
    }

    .pengerjaan-page .empty-state .material-symbols-rounded {
        display: block;
        font-size: 42px;
        color: #c7a6a7;
        margin-bottom: 12px;
    }

    .pengerjaan-page .empty-state strong {
        display: block;
        color: #654f50;
        font-size: 14px;
        margin-bottom: 6px;
    }

    .pengerjaan-page .empty-state p {
        font-size: 13px;
    }

    .pengerjaan-page .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-top: 17px;
        color: #8c7b7b;
        font-size: 12px;
        flex-wrap: wrap;
    }

    @media (max-width: 768px) {
        .pengerjaan-page .content-card {
            padding: 17px;
            border-radius: 14px;
        }

        .pengerjaan-page .section-heading h2 {
            font-size: 17px;
        }

        .pengerjaan-page .table-footer {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>
@endpush

@section('content')
<div class="pengerjaan-page">

    <div class="content-card">

        <div class="section-heading">
            <div>
                <h2>Data Pengerjaan Pesanan</h2>
                <p>Pantau status produksi dan perbarui estimasi penyelesaian jahitan.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">
                <span class="material-symbols-rounded">check_circle</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="alert-success" style="background:#fff0f0;color:#a33d48;border-color:#f0cccc;">
                <span class="material-symbols-rounded">error</span>
                <div>
                    <strong>Data belum berhasil disimpan.</strong>
                    <ul style="margin:6px 0 0 18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pelanggan</th>
                        <th>Jenis Pakaian</th>
                        <th>Jumlah</th>
                        <th>Status Saat Ini</th>
                        <th>Estimasi Selesai</th>
                        <th>Perbarui Pengerjaan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pesanan as $item)
                        @php
                            $status = $item->status_pengerjaan ?? 'Menunggu Produksi';

                            $statusClass = match ($status) {
                                'Menunggu Produksi' => 'status-menunggu',
                                'Sedang Dipotong',
                                'Sedang Menjahit',
                                'Finishing',
                                'Quality Check' => 'status-proses',
                                'Siap Diambil',
                                'Sudah Diambil' => 'status-selesai',
                                default => '',
                            };
                        @endphp

                        <tr>
                            <td class="number-cell">{{ $loop->iteration }}</td>

                            <td>
                                <span class="customer-name">
                                    {{ $item->user->nama ?? '-' }}
                                </span>
                            </td>

                            <td>{{ $item->jenis_pakaian ?? '-' }}</td>

                            <td>{{ $item->jumlah ?? 0 }} pcs</td>

                            <td>
                                <span class="status-badge {{ $statusClass }}">
                                    {{ $status }}
                                </span>
                            </td>

                            <td>
                                @if($item->estimasi_selesai)
                                    {{ \Carbon\Carbon::parse($item->estimasi_selesai)->format('d/m/Y') }}
                                @else
                                    <span class="muted">Belum ditentukan</span>
                                @endif
                            </td>

                            <td>
                                <form
                                    action="{{ route('karyawan.pengerjaan.update', $item->id_pesanan) }}"
                                    method="POST"
                                    class="status-form"
                                >
                                    @csrf
                                    @method('PUT')

                                    <select
                                        name="status_pengerjaan"
                                        class="form-control"
                                        required
                                        aria-label="Status pengerjaan"
                                    >
                                        @foreach([
                                            'Menunggu Produksi',
                                            'Sedang Dipotong',
                                            'Sedang Menjahit',
                                            'Finishing',
                                            'Quality Check',
                                            'Siap Diambil',
                                            'Sudah Diambil'
                                        ] as $pilihanStatus)
                                            <option
                                                value="{{ $pilihanStatus }}"
                                                {{ $status === $pilihanStatus ? 'selected' : '' }}
                                            >
                                                {{ $pilihanStatus }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <input
                                        type="date"
                                        name="estimasi_selesai"
                                        class="form-control"
                                        value="{{ $item->estimasi_selesai ? \Carbon\Carbon::parse($item->estimasi_selesai)->format('Y-m-d') : '' }}"
                                        aria-label="Estimasi selesai"
                                    >

                                    <button type="submit" class="btn-save">
                                        <span class="material-symbols-rounded" style="font-size:16px;">save</span>
                                        Simpan
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <span class="material-symbols-rounded">content_cut</span>
                                    <strong>Belum ada pesanan</strong>
                                    <p>Pesanan yang perlu dikelola akan ditampilkan di sini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <span>Menampilkan {{ $pesanan->count() }} data pengerjaan</span>
            <span>JAITIN · Manajemen Produksi</span>
        </div>

    </div>
</div>
@endsection
