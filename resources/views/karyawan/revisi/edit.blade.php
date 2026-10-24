@extends('layouts.karyawan')

@section('title', 'Edit Revisi - JAITIN')
@section('page-title', 'Edit Revisi')
@section('page-description', 'Perbarui data revisi pesanan pelanggan.')

@push('styles')
<style>
    .revisi-edit {
        max-width: 1000px;
        margin: 0 auto;
        color: var(--text, #493b3b);
    }

    .revisi-edit *,
    .revisi-edit *::before,
    .revisi-edit *::after {
        box-sizing: border-box;
    }

    .revisi-edit .form-card {
        overflow: hidden;
        background: var(--white, #fff);
        border: 1px solid var(--border, #eee1dc);
        border-radius: 18px;
        box-shadow: var(--shadow, 0 8px 24px rgba(99,65,65,.06));
    }

    .revisi-edit .card-header {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 24px 28px;
        background: linear-gradient(135deg, #fffaf7, #f9eeee);
        border-bottom: 1px solid var(--border, #eee1dc);
    }

    .revisi-edit .header-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: #f2dfe1;
        color: var(--pink-deep, #80575d);
    }

    .revisi-edit .header-icon .material-symbols-rounded {
        font-size: 27px;
    }

    .revisi-edit .card-heading {
        margin: 0;
        font-size: 19px;
        font-weight: 750;
        color: var(--text, #493b3b);
    }

    .revisi-edit .card-subheading {
        margin: 5px 0 0;
        color: var(--muted, #8c7b7b);
        font-size: 13px;
        line-height: 1.6;
    }

    .revisi-edit .form-body {
        padding: 28px;
    }

    .revisi-edit .section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0 0 18px;
        color: var(--pink-deep, #80575d);
        font-size: 14px;
        font-weight: 750;
    }

    .revisi-edit .section-title .material-symbols-rounded {
        font-size: 20px;
    }

    .revisi-edit .order-info {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 28px;
        padding: 20px;
        background: #fff8f6;
        border: 1px solid #efdfda;
        border-radius: 14px;
    }

    .revisi-edit .info-item {
        min-width: 0;
    }

    .revisi-edit .info-label {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 8px;
        color: var(--muted, #8c7b7b);
        font-size: 12px;
    }

    .revisi-edit .info-label .material-symbols-rounded {
        font-size: 17px;
        color: var(--pink-dark, #9f7378);
    }

    .revisi-edit .info-value {
        overflow-wrap: anywhere;
        color: var(--text, #493b3b);
        font-size: 14px;
        font-weight: 700;
    }

    .revisi-edit .order-number {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 8px;
        background: #f2dfe1;
        color: var(--pink-deep, #80575d);
        font-size: 13px;
        font-weight: 750;
    }

    .revisi-edit .form-group {
        min-width: 0;
        margin-bottom: 22px;
    }

    .revisi-edit .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .revisi-edit .form-label {
        display: block;
        margin-bottom: 9px;
        color: var(--text, #493b3b);
        font-size: 13px;
        font-weight: 700;
    }

    .revisi-edit .required {
        color: #c05e69;
    }

    .revisi-edit .input-wrap {
        position: relative;
    }

    .revisi-edit .input-icon {
        position: absolute;
        top: 50%;
        left: 14px;
        transform: translateY(-50%);
        color: #a48b8c;
        font-size: 20px;
        pointer-events: none;
    }

    .revisi-edit .form-control {
        display: block;
        width: 100%;
        min-height: 46px;
        padding: 12px 14px;
        border: 1px solid #e7d8d4;
        border-radius: 11px;
        outline: none;
        background: #fff;
        color: var(--text, #493b3b);
        font-family: inherit;
        font-size: 13px;
        transition: border-color .2s, box-shadow .2s;
    }

    .revisi-edit .input-wrap .form-control {
        padding-left: 44px;
    }

    .revisi-edit textarea.form-control {
        min-height: 130px;
        resize: vertical;
        line-height: 1.7;
    }

    .revisi-edit .form-control:focus {
        border-color: var(--pink, #b8898d);
        box-shadow: 0 0 0 3px rgba(184, 137, 141, .14);
    }

    .revisi-edit .form-control::placeholder {
        color: #b4a5a2;
    }

    .revisi-edit .field-hint {
        margin: 7px 0 0;
        color: var(--muted, #8c7b7b);
        font-size: 12px;
        line-height: 1.6;
    }

    .revisi-edit .error-message {
        display: flex;
        align-items: flex-start;
        gap: 5px;
        margin-top: 7px;
        color: #b5414c;
        font-size: 12px;
        line-height: 1.5;
    }

    .revisi-edit .error-message .material-symbols-rounded {
        font-size: 16px;
    }

    .revisi-edit .form-divider {
        height: 1px;
        margin: 4px 0 24px;
        border: 0;
        background: var(--border, #eee1dc);
    }

    .revisi-edit .form-actions {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 12px;
        padding-top: 8px;
    }

    .revisi-edit .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 44px;
        padding: 11px 19px;
        border: 1px solid transparent;
        border-radius: 11px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s, transform .2s, box-shadow .2s;
    }

    .revisi-edit .btn .material-symbols-rounded {
        font-size: 19px;
    }

    .revisi-edit .btn-primary {
        background: var(--pink, #b8898d);
        color: #fff;
        box-shadow: 0 5px 12px rgba(184, 137, 141, .2);
    }

    .revisi-edit .btn-primary:hover {
        background: var(--pink-dark, #9f7378);
        transform: translateY(-1px);
        box-shadow: 0 7px 16px rgba(184, 137, 141, .25);
    }

    .revisi-edit .btn-secondary {
        background: #fff;
        border-color: var(--border, #eee1dc);
        color: #765e5e;
    }

    .revisi-edit .btn-secondary:hover {
        background: #fbf4f1;
    }

    @media (max-width: 760px) {
        .revisi-edit .order-info {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 640px) {
        .revisi-edit .card-header {
            padding: 20px;
        }

        .revisi-edit .form-body {
            padding: 20px;
        }

        .revisi-edit .order-info,
        .revisi-edit .form-grid {
            grid-template-columns: minmax(0, 1fr);
            gap: 14px;
        }

        .revisi-edit .form-actions {
            flex-direction: column-reverse;
        }

        .revisi-edit .btn {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="revisi-edit">
    <div class="form-card">

        <div class="card-header">
            <div class="header-icon">
                <span class="material-symbols-rounded">edit_note</span>
            </div>

            <div>
                <h2 class="card-heading">Perbarui Data Revisi</h2>
                <p class="card-subheading">
                    Periksa informasi pesanan dan sesuaikan detail revisi pelanggan.
                </p>
            </div>
        </div>

        <div class="form-body">

            <h3 class="section-title">
                <span class="material-symbols-rounded">receipt_long</span>
                Informasi Pesanan
            </h3>

            <div class="order-info">
                <div class="info-item">
                    <div class="info-label">
                        <span class="material-symbols-rounded">person</span>
                        Pelanggan
                    </div>
                    <div class="info-value">
                        {{ $revisi->pesanan->user->nama ?? '-' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <span class="material-symbols-rounded">apparel</span>
                        Jenis Pakaian
                    </div>
                    <div class="info-value">
                        {{ $revisi->pesanan->jenis_pakaian ?? '-' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <span class="material-symbols-rounded">tag</span>
                        Nomor Pesanan
                    </div>
                    <div class="info-value">
                        <span class="order-number">
                            #{{ $revisi->id_pesanan }}
                        </span>
                    </div>
                </div>
            </div>

            <hr class="form-divider">

            <h3 class="section-title">
                <span class="material-symbols-rounded">description</span>
                Detail Revisi
            </h3>

            <form
                action="{{ route('karyawan.revisi.update', $revisi->id_revisi) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label" for="id_pesanan">
                        Pesanan <span class="required">*</span>
                    </label>

                    <div class="input-wrap">
                        <span class="material-symbols-rounded input-icon">receipt_long</span>

                        <select
                            class="form-control"
                            name="id_pesanan"
                            id="id_pesanan"
                            required
                        >
                            @foreach($pesanan as $item)
                                <option
                                    value="{{ $item->id_pesanan }}"
                                    {{ old('id_pesanan', $revisi->id_pesanan) == $item->id_pesanan ? 'selected' : '' }}
                                >
                                    #{{ $item->id_pesanan }}
                                    - {{ $item->user->nama ?? 'Pelanggan' }}
                                    - {{ $item->jenis_pakaian ?? 'Pesanan' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @error('id_pesanan')
                        <div class="error-message">
                            <span class="material-symbols-rounded">error</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="keterangan">
                        Keterangan Revisi <span class="required">*</span>
                    </label>

                    <textarea
                        class="form-control"
                        name="keterangan"
                        id="keterangan"
                        placeholder="Jelaskan bagian pakaian yang perlu diperbaiki..."
                        required
                    >{{ old('keterangan', $revisi->keterangan) }}</textarea>

                    @error('keterangan')
                        <div class="error-message">
                            <span class="material-symbols-rounded">error</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="tanggal_revisi">
                            Tanggal Revisi <span class="required">*</span>
                        </label>

                        <div class="input-wrap">
                            <span class="material-symbols-rounded input-icon">calendar_month</span>

                            <input
                                class="form-control"
                                type="datetime-local"
                                name="tanggal_revisi"
                                id="tanggal_revisi"
                                value="{{ old('tanggal_revisi', $revisi->tanggal_revisi ? \Carbon\Carbon::parse($revisi->tanggal_revisi)->format('Y-m-d\TH:i') : '') }}"
                                required
                            >
                        </div>

                        @error('tanggal_revisi')
                            <div class="error-message">
                                <span class="material-symbols-rounded">error</span>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="batas_waktu_revisi">
                            Batas Waktu Revisi <span class="required">*</span>
                        </label>

                        <div class="input-wrap">
                            <span class="material-symbols-rounded input-icon">event</span>

                            <input
                                class="form-control"
                                type="date"
                                name="batas_waktu_revisi"
                                id="batas_waktu_revisi"
                                value="{{ old('batas_waktu_revisi', $revisi->batas_waktu_revisi ? \Carbon\Carbon::parse($revisi->batas_waktu_revisi)->format('Y-m-d') : '') }}"
                                required
                            >
                        </div>

                        <p class="field-hint">
                            Tentukan target penyelesaian revisi.
                        </p>

                        @error('batas_waktu_revisi')
                            <div class="error-message">
                                <span class="material-symbols-rounded">error</span>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="biaya_revisi">
                        Biaya Tambahan Revisi (Rp)
                    </label>

                    <div class="input-wrap">
                        <span class="material-symbols-rounded input-icon">payments</span>

                        <input
                            class="form-control"
                            type="number"
                            name="biaya_revisi"
                            id="biaya_revisi"
                            min="0"
                            step="0.01"
                            value="{{ old('biaya_revisi', $revisi->biaya_revisi ?? 0) }}"
                            placeholder="0"
                        >
                    </div>

                    <p class="field-hint">
                        Isi 0 jika tidak ada biaya tambahan.
                    </p>

                    @error('biaya_revisi')
                        <div class="error-message">
                            <span class="material-symbols-rounded">error</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <hr class="form-divider">

                <div class="form-actions">
                    <a
                        href="{{ route('karyawan.revisi.index') }}"
                        class="btn btn-secondary"
                    >
                        <span class="material-symbols-rounded">arrow_back</span>
                        Batal
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <span class="material-symbols-rounded">save</span>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
