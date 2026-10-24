@extends('layouts.karyawan')

@section('title', 'Tambah Revisi - JAITIN')
@section('page-title', 'Tambah Revisi')
@section('page-description', 'Tambahkan data revisi untuk pesanan pelanggan.')

@push('styles')
<style>
    .revisi-create {
        color: var(--text, #493b3b);
        max-width: 1000px;
        margin: 0 auto;
    }

    .revisi-create *,
    .revisi-create *::before,
    .revisi-create *::after {
        box-sizing: border-box;
    }

    .revisi-create .form-card {
        background: var(--white, #fff);
        border: 1px solid var(--border, #eee1dc);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: var(--shadow, 0 8px 24px rgba(99,65,65,.06));
    }

    .revisi-create .card-header {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 24px 28px;
        border-bottom: 1px solid var(--border, #eee1dc);
        background: linear-gradient(135deg, #fffaf7, #f9eeee);
    }

    .revisi-create .header-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 14px;
        background: #f2dfe1;
        color: var(--pink-deep, #80575d);
    }

    .revisi-create .header-icon .material-symbols-rounded {
        font-size: 27px;
    }

    .revisi-create .card-heading {
        margin: 0;
        font-size: 19px;
        font-weight: 750;
        color: var(--text, #493b3b);
    }

    .revisi-create .card-subheading {
        margin: 5px 0 0;
        color: var(--muted, #8c7b7b);
        font-size: 13px;
        line-height: 1.6;
    }

    .revisi-create .form-body {
        padding: 28px;
    }

    .revisi-create .section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0 0 20px;
        font-size: 14px;
        font-weight: 750;
        color: var(--pink-deep, #80575d);
    }

    .revisi-create .section-title .material-symbols-rounded {
        font-size: 20px;
    }

    .revisi-create .form-group {
        min-width: 0;
        margin-bottom: 22px;
    }

    .revisi-create .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .revisi-create .form-label {
        display: block;
        margin-bottom: 9px;
        color: var(--text, #493b3b);
        font-size: 13px;
        font-weight: 700;
    }

    .revisi-create .required {
        color: #c05e69;
    }

    .revisi-create .input-wrap {
        position: relative;
    }

    .revisi-create .input-icon {
        position: absolute;
        top: 50%;
        left: 14px;
        transform: translateY(-50%);
        color: #a48b8c;
        font-size: 20px;
        pointer-events: none;
    }

    .revisi-create .form-control {
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

    .revisi-create .input-wrap .form-control {
        padding-left: 44px;
    }

    .revisi-create textarea.form-control {
        min-height: 130px;
        resize: vertical;
        line-height: 1.7;
    }

    .revisi-create .form-control::placeholder {
        color: #b4a5a2;
    }

    .revisi-create .form-control:focus {
        border-color: var(--pink, #b8898d);
        box-shadow: 0 0 0 3px rgba(184, 137, 141, .14);
    }

    .revisi-create .field-hint {
        margin: 7px 0 0;
        color: var(--muted, #8c7b7b);
        font-size: 12px;
        line-height: 1.6;
    }

    .revisi-create .error-message {
        display: flex;
        align-items: flex-start;
        gap: 5px;
        margin-top: 7px;
        color: #b5414c;
        font-size: 12px;
        line-height: 1.5;
    }

    .revisi-create .error-message .material-symbols-rounded {
        font-size: 16px;
    }

    .revisi-create .form-divider {
        height: 1px;
        margin: 4px 0 24px;
        border: 0;
        background: var(--border, #eee1dc);
    }

    .revisi-create .form-actions {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 12px;
        padding-top: 8px;
    }

    .revisi-create .btn {
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

    .revisi-create .btn .material-symbols-rounded {
        font-size: 19px;
    }

    .revisi-create .btn-primary {
        background: var(--pink, #b8898d);
        color: #fff;
        box-shadow: 0 5px 12px rgba(184, 137, 141, .2);
    }

    .revisi-create .btn-primary:hover {
        background: var(--pink-dark, #9f7378);
        transform: translateY(-1px);
        box-shadow: 0 7px 16px rgba(184, 137, 141, .25);
    }

    .revisi-create .btn-secondary {
        background: #fff;
        border-color: var(--border, #eee1dc);
        color: #765e5e;
    }

    .revisi-create .btn-secondary:hover {
        background: #fbf4f1;
    }

    .revisi-create .notice {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        margin-bottom: 24px;
        padding: 13px 15px;
        border: 1px solid #ead8d9;
        border-radius: 11px;
        background: #fff8f8;
        color: #795b60;
        font-size: 12px;
        line-height: 1.7;
    }

    .revisi-create .notice .material-symbols-rounded {
        flex-shrink: 0;
        color: var(--pink-dark, #9f7378);
        font-size: 20px;
    }

    @media (max-width: 640px) {
        .revisi-create .card-header {
            padding: 20px;
        }

        .revisi-create .form-body {
            padding: 20px;
        }

        .revisi-create .form-grid {
            grid-template-columns: minmax(0, 1fr);
            gap: 0;
        }

        .revisi-create .form-actions {
            flex-direction: column-reverse;
        }

        .revisi-create .btn {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="revisi-create">
    <div class="form-card">
        <div class="card-header">
            <div class="header-icon">
                <span class="material-symbols-rounded">edit_note</span>
            </div>
            <div>
                <h2 class="card-heading">Data Revisi</h2>
                <p class="card-subheading">
                    Lengkapi informasi revisi sesuai kebutuhan pesanan pelanggan.
                </p>
            </div>
        </div>

        <div class="form-body">
            <div class="notice">
                <span class="material-symbols-rounded">info</span>
                <div>
                    Pastikan pesanan yang dipilih sudah benar. Isi keterangan revisi
                    dengan jelas agar proses perbaikan pakaian dapat dilakukan sesuai
                    permintaan pelanggan.
                </div>
            </div>

            <form action="{{ route('karyawan.revisi.store') }}" method="POST">
                @csrf

                <h3 class="section-title">
                    <span class="material-symbols-rounded">receipt_long</span>
                    Informasi Pesanan
                </h3>

                <div class="form-group">
                    <label class="form-label" for="id_pesanan">
                        Pesanan <span class="required">*</span>
                    </label>

                    <div class="input-wrap">
                        <span class="material-symbols-rounded input-icon">apparel</span>
                        <select
                            class="form-control"
                            name="id_pesanan"
                            id="id_pesanan"
                            required
                        >
                            <option value="">-- Pilih Pesanan --</option>
                            @foreach($pesanan as $item)
                                <option
                                    value="{{ $item->id_pesanan }}"
                                    {{ old('id_pesanan') == $item->id_pesanan ? 'selected' : '' }}
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

                <hr class="form-divider">

                <h3 class="section-title">
                    <span class="material-symbols-rounded">description</span>
                    Detail Revisi
                </h3>

                <div class="form-group">
                    <label class="form-label" for="keterangan">
                        Keterangan Revisi <span class="required">*</span>
                    </label>

                    <textarea
                        class="form-control"
                        name="keterangan"
                        id="keterangan"
                        placeholder="Contoh: Perkecil bagian pinggang atau pendekkan panjang lengan..."
                        required
                    >{{ old('keterangan') }}</textarea>

                    <p class="field-hint">
                        Jelaskan bagian pakaian yang perlu diperbaiki dan perubahan
                        yang diminta.
                    </p>

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
                                value="{{ old('tanggal_revisi', now()->format('Y-m-d\TH:i')) }}"
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
                                value="{{ old('batas_waktu_revisi') }}"
                                required
                            >
                        </div>

                        <p class="field-hint">
                            Tentukan tanggal target penyelesaian revisi.
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
                            value="{{ old('biaya_revisi', 0) }}"
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
                        Simpan Revisi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
