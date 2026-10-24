@extends('layouts.admin')

@section('title', 'Edit Harga Pesanan - JAITIN')
@section('page-title', 'Edit Harga Pesanan')
@section('page-description', 'Perbarui total harga pesanan pelanggan.')

@section('styles')
<style>
    .edit-order-page {
        display: flex;
        flex-direction: column;
        gap: 22px;
        color: #493936;
    }

    .edit-order-hero {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 27px;
        border-radius: 20px;
        color: #fff;
        background: linear-gradient(
            120deg,
            #b8898d 0%,
            #c99b9d 58%,
            #dfb9ad 100%
        );
        box-shadow: 0 12px 28px rgba(153, 103, 109, .14);
    }

    .edit-order-hero h2 {
        margin: 0 0 8px;
        color: #fff;
        font-size: 25px;
        font-weight: 750;
    }

    .edit-order-hero p {
        margin: 0;
        color: rgba(255,255,255,.88);
        font-size: 13px;
        line-height: 1.7;
    }

    .edit-order-hero-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 65px;
        height: 65px;
        border: 1px solid rgba(255,255,255,.3);
        border-radius: 18px;
        background: rgba(255,255,255,.15);
        font-size: 27px;
    }

    .edit-order-alert {
        padding: 14px 17px;
        border-radius: 12px;
        font-size: 13px;
        line-height: 1.7;
    }

    .edit-order-alert.success {
        border: 1px solid #d5e8d4;
        background: #edf6ed;
        color: #426b47;
    }

    .edit-order-alert.error {
        border: 1px solid #f0d3d1;
        background: #fff0ef;
        color: #985052;
    }

    .edit-order-alert ul {
        margin: 7px 0 0;
        padding-left: 20px;
    }

    .edit-order-card {
        overflow: hidden;
        border: 1px solid #eee3de;
        border-radius: 19px;
        background: #fffaf6;
        box-shadow: 0 10px 30px rgba(103, 72, 65, .055);
    }

    .edit-order-card-header {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 22px 25px;
        border-bottom: 1px solid #eee3de;
    }

    .edit-order-card-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        flex-shrink: 0;
        border-radius: 13px;
        background: #f5e7e7;
        color: #96696e;
        font-size: 18px;
    }

    .edit-order-card-header h3 {
        margin: 0 0 5px;
        color: #493936;
        font-size: 15px;
        font-weight: 750;
    }

    .edit-order-card-header p {
        margin: 0;
        color: #927f7b;
        font-size: 12px;
        line-height: 1.6;
    }

    .edit-order-card-body {
        padding: 25px;
    }

    .edit-order-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .edit-order-field {
        min-width: 0;
    }

    .edit-order-field.full {
        grid-column: 1 / -1;
    }

    .edit-order-field label {
        display: block;
        margin-bottom: 8px;
        color: #705b55;
        font-size: 12px;
        font-weight: 750;
    }

    .edit-order-value {
        display: block;
        width: 100%;
        min-height: 43px;
        padding: 12px 14px;
        border: 1px solid #eee3de;
        border-radius: 10px;
        background: #f8f1eb;
        color: #705b55;
        font-size: 13px;
        line-height: 1.5;
        overflow-wrap: anywhere;
    }

    .edit-order-value.status {
        display: inline-flex;
        align-items: center;
        width: auto;
        min-height: auto;
        border-radius: 30px;
        background: #f1e2e7;
        color: #936070;
        font-size: 11px;
        font-weight: 750;
    }

    .edit-order-value.status::before {
        content: "";
        width: 6px;
        height: 6px;
        margin-right: 8px;
        border-radius: 50%;
        background: currentColor;
    }

    .edit-order-price-box {
        padding: 20px;
        border: 1px solid #ead5d6;
        border-radius: 15px;
        background: #fff4f1;
    }

    .edit-order-price-box label {
        display: block;
        margin-bottom: 10px;
        color: #79575a;
        font-size: 13px;
        font-weight: 800;
    }

    .edit-order-price-input {
        display: flex;
        align-items: center;
        overflow: hidden;
        border: 1px solid #d9c1b7;
        border-radius: 11px;
        background: #fff;
        transition: border-color .2s, box-shadow .2s;
    }

    .edit-order-price-input:focus-within {
        border-color: #b8898d;
        box-shadow: 0 0 0 3px rgba(184,137,141,.13);
    }

    .edit-order-price-prefix {
        padding: 13px 15px;
        border-right: 1px solid #eee3de;
        background: #f8efea;
        color: #96696e;
        font-size: 13px;
        font-weight: 800;
    }

    .edit-order-price-input input {
        width: 100%;
        min-width: 0;
        padding: 13px 15px;
        border: 0;
        outline: none;
        background: transparent;
        color: #493936;
        font-family: inherit;
        font-size: 16px;
        font-weight: 750;
    }

    .edit-order-help {
        margin-top: 9px;
        color: #927f7b;
        font-size: 11px;
        line-height: 1.7;
    }

    .edit-order-actions {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #eee3de;
    }

    .edit-order-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 42px;
        padding: 11px 17px;
        border: 0;
        border-radius: 10px;
        font-family: inherit;
        font-size: 12px;
        font-weight: 750;
        text-decoration: none;
        cursor: pointer;
        transition: .2s ease;
    }

    .edit-order-btn:hover {
        transform: translateY(-1px);
    }

    .edit-order-btn.back {
        background: #f0e4dc;
        color: #705b55;
    }

    .edit-order-btn.save {
        background: #b8898d;
        color: #fff;
    }

    .edit-order-btn.save:hover {
        background: #9f7378;
    }

    @media (max-width: 650px) {
        .edit-order-hero {
            padding: 21px;
        }

        .edit-order-hero h2 {
            font-size: 21px;
        }

        .edit-order-hero-icon {
            width: 49px;
            height: 49px;
            font-size: 21px;
        }

        .edit-order-card-header,
        .edit-order-card-body {
            padding: 18px;
        }

        .edit-order-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .edit-order-field.full {
            grid-column: auto;
        }

        .edit-order-actions {
            flex-direction: column-reverse;
        }

        .edit-order-btn {
            width: 100%;
            box-sizing: border-box;
        }
    }
</style>
@endsection

@section('content')
<div class="edit-order-page">

    <section class="edit-order-hero">
        <div>
            <h2>Edit Harga Pesanan</h2>
            <p>
                Pesanan #{{ $pesanan->id_pesanan }}.
                Admin hanya dapat mengubah total harga.
                Status pengerjaan dikelola oleh karyawan.
            </p>
        </div>

        <div class="edit-order-hero-icon" aria-hidden="true">
            <i class="fa-solid fa-money-bill-wave"></i>
        </div>
    </section>

    @if (session('success'))
        <div class="edit-order-alert success" role="status">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="edit-order-alert error" role="alert">
            <strong>
                <i class="fa-solid fa-triangle-exclamation"></i>
                Periksa kembali data berikut:
            </strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="edit-order-card">
        <div class="edit-order-card-header">
            <div class="edit-order-card-icon">
                <i class="fa-solid fa-receipt"></i>
            </div>

            <div>
                <h3>Informasi Pesanan</h3>
                <p>Informasi berikut hanya dapat dilihat oleh admin.</p>
            </div>
        </div>

        <div class="edit-order-card-body">

            <div class="edit-order-grid">

                <div class="edit-order-field">
                    <label>ID Pesanan</label>
                    <div class="edit-order-value">
                        #{{ $pesanan->id_pesanan }}
                    </div>
                </div>

                <div class="edit-order-field">
                    <label>Pelanggan</label>
                    <div class="edit-order-value">
                        {{ $pesanan->user->nama
                            ?? $pesanan->user->name
                            ?? 'Pelanggan' }}
                    </div>
                </div>

                <div class="edit-order-field">
                    <label>Jenis Pakaian</label>
                    <div class="edit-order-value">
                        {{ $pesanan->jenis_pakaian ?? '-' }}
                    </div>
                </div>

                <div class="edit-order-field">
                    <label>Jumlah</label>
                    <div class="edit-order-value">
                        {{ $pesanan->jumlah ?? 0 }} pcs
                    </div>
                </div>

                <div class="edit-order-field">
                    <label>Tanggal Pesan</label>
                    <div class="edit-order-value">
                        {{ $pesanan->tanggal_pesan
                            ? \Carbon\Carbon::parse($pesanan->tanggal_pesan)->format('d-m-Y H:i')
                            : '-' }}
                    </div>
                </div>

                <div class="edit-order-field">
                    <label>Tanggal Harapan Selesai</label>
                    <div class="edit-order-value">
                        {{ $pesanan->tanggal_harapan
                            ? \Carbon\Carbon::parse($pesanan->tanggal_harapan)->format('d-m-Y')
                            : '-' }}
                    </div>
                </div>

                <div class="edit-order-field">
                    <label>Estimasi Selesai</label>
                    <div class="edit-order-value">
                        {{ $pesanan->estimasi_selesai
                            ? \Carbon\Carbon::parse($pesanan->estimasi_selesai)->format('d-m-Y')
                            : 'Belum ditentukan oleh karyawan' }}
                    </div>
                </div>

                <div class="edit-order-field">
                    <label>Status Pengerjaan</label>
                    <div>
                        <span class="edit-order-value status">
                            {{ $pesanan->status_pengerjaan ?? 'Menunggu Produksi' }}
                        </span>
                    </div>
                </div>

            </div>

            <form
                action="{{ route('admin.pesanan.update', $pesanan->id_pesanan) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <div class="edit-order-price-box" style="margin-top: 25px;">
                    <label for="total_harga">
                        <i class="fa-solid fa-money-bill-wave"></i>
                        Total Harga Pesanan
                    </label>

                    <div class="edit-order-price-input">
                        <span class="edit-order-price-prefix">Rp</span>

                        <input
                            type="number"
                            name="total_harga"
                            id="total_harga"
                            value="{{ old('total_harga', $pesanan->total_harga) }}"
                            min="0"
                            step="1"
                            placeholder="Masukkan total harga"
                            required
                            autofocus
                        >
                    </div>

                    <p class="edit-order-help">
                        Masukkan total biaya pesanan dalam rupiah.
                        Kolom lain tidak dikirim untuk diperbarui.
                    </p>
                </div>

                <div class="edit-order-actions">
                    <a
                        href="{{ route('admin.pesanan.index') }}"
                        class="edit-order-btn back"
                    >
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit" class="edit-order-btn save">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Harga
                    </button>
                </div>
            </form>

        </div>
    </section>

</div>
@endsection
