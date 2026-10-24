@extends('layouts.karyawan')

@section('title', 'Edit Ukuran - JAITIN')
@section('page-title', 'Edit Ukuran Pelanggan')
@section('page-description', 'Perbarui data ukuran pelanggan sesuai hasil pengukuran terbaru.')

@push('styles')
<style>
    .ukuran-edit {
        color: #493b3b;
    }

    .ukuran-edit .form-card {
        max-width: 950px;
        background: #fff;
        border: 1px solid #eee1dc;
        border-radius: 18px;
        padding: 28px;
        box-shadow: 0 8px 24px rgba(99, 65, 65, .05);
    }

    .ukuran-edit .form-heading {
        display: flex;
        align-items: center;
        gap: 14px;
        padding-bottom: 22px;
        margin-bottom: 24px;
        border-bottom: 1px solid #f0e6e2;
    }

    .ukuran-edit .heading-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 14px;
        background: #f5e5e5;
        color: #9f7378;
    }

    .ukuran-edit .heading-icon .material-symbols-rounded {
        font-size: 26px;
    }

    .ukuran-edit .form-heading h2 {
        margin: 0 0 5px;
        color: #493b3b;
        font-size: 18px;
        font-weight: 700;
    }

    .ukuran-edit .form-heading p {
        margin: 0;
        color: #8c7b7b;
        font-size: 13px;
        line-height: 1.6;
    }

    .ukuran-edit .form-section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 24px 0 17px;
        color: #80575d;
        font-size: 14px;
        font-weight: 700;
    }

    .ukuran-edit .form-section-title .material-symbols-rounded {
        font-size: 20px;
    }

    .ukuran-edit .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .ukuran-edit .form-group {
        min-width: 0;
        margin-bottom: 3px;
    }

    .ukuran-edit .full-width {
        grid-column: 1 / -1;
    }

    .ukuran-edit label {
        display: block;
        margin-bottom: 8px;
        color: #594646;
        font-size: 13px;
        font-weight: 600;
    }

    .ukuran-edit .required {
        margin-left: 3px;
        color: #c45f6a;
    }

    .ukuran-edit .form-control {
        display: block;
        width: 100%;
        min-height: 44px;
        padding: 11px 13px;
        border: 1px solid #e6d7d2;
        border-radius: 10px;
        background: #fff;
        color: #493b3b;
        font-family: inherit;
        font-size: 13px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .ukuran-edit .form-control:focus {
        border-color: #b8898d;
        box-shadow: 0 0 0 3px rgba(184, 137, 141, .13);
    }

    .ukuran-edit .form-control.is-invalid {
        border-color: #d98b91;
        background: #fffafa;
    }

    .ukuran-edit .field-hint {
        margin-top: 7px;
        color: #9a8987;
        font-size: 11px;
        line-height: 1.5;
    }

    .ukuran-edit .field-error {
        margin-top: 6px;
        color: #b6424b;
        font-size: 12px;
    }

    .ukuran-edit .alert-error {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 14px 16px;
        margin-bottom: 20px;
        border: 1px solid #f0cccc;
        border-radius: 11px;
        background: #fff2f2;
        color: #a33d48;
        font-size: 13px;
    }

    .ukuran-edit .alert-error .material-symbols-rounded {
        flex-shrink: 0;
        font-size: 21px;
    }

    .ukuran-edit .form-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 30px;
        padding-top: 22px;
        border-top: 1px solid #f0e6e2;
    }

    .ukuran-edit .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 43px;
        padding: 11px 18px;
        border: 1px solid transparent;
        border-radius: 10px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s, transform .2s;
    }

    .ukuran-edit .btn .material-symbols-rounded {
        font-size: 18px;
    }

    .ukuran-edit .btn-primary {
        background: #b8898d;
        color: #fff;
    }

    .ukuran-edit .btn-primary:hover {
        background: #9f7378;
        transform: translateY(-1px);
    }

    .ukuran-edit .btn-secondary {
        border-color: #e6d7d2;
        background: #fff;
        color: #76585b;
    }

    .ukuran-edit .btn-secondary:hover {
        background: #faf3f0;
    }

    @media (max-width: 640px) {
        .ukuran-edit .form-card {
            padding: 19px;
            border-radius: 14px;
        }

        .ukuran-edit .form-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .ukuran-edit .full-width {
            grid-column: auto;
        }

        .ukuran-edit .form-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .ukuran-edit .btn {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="ukuran-edit">

    <div class="form-card">

        <div class="form-heading">
            <div class="heading-icon">
                <span class="material-symbols-rounded">edit_note</span>
            </div>

            <div>
                <h2>Data Ukuran Pelanggan</h2>
                <p>Periksa dan perbarui informasi ukuran sebelum menyimpan perubahan.</p>
            </div>
        </div>

        @if($errors->any())
            <div class="alert-error">
                <span class="material-symbols-rounded">error</span>

                <div>
                    <strong>Periksa kembali data yang dimasukkan.</strong>
                    <ul style="margin: 7px 0 0 18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form
            action="{{ route('karyawan.ukuran.update', $ukuran->id_ukuran) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <div class="form-section-title">
                <span class="material-symbols-rounded">person</span>
                Informasi Pelanggan
            </div>

            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="id_user">
                        Nama Pelanggan<span class="required">*</span>
                    </label>

                    <select
                        name="id_user"
                        id="id_user"
                        class="form-control @error('id_user') is-invalid @enderror"
                        required
                    >
                        <option value="">-- Pilih Pelanggan --</option>

                        @foreach($pelanggan as $item)
                            <option
                                value="{{ $item->id_user }}"
                                {{ old('id_user', $ukuran->id_user) == $item->id_user ? 'selected' : '' }}
                            >
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>

                    @error('id_user')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                    <div class="field-hint">
                        Pilih pelanggan yang sesuai dengan data pengukuran ini.
                    </div>
                </div>
            </div>

            <div class="form-section-title">
                <span class="material-symbols-rounded">straighten</span>
                Detail Ukuran Tubuh
            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label for="panjang_baju">Panjang Baju (cm)</label>

                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        name="panjang_baju"
                        id="panjang_baju"
                        class="form-control @error('panjang_baju') is-invalid @enderror"
                        value="{{ old('panjang_baju', $ukuran->panjang_baju) }}"
                        placeholder="Contoh: 70"
                    >

                    @error('panjang_baju')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="lebar_bahu">Lebar Bahu (cm)</label>

                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        name="lebar_bahu"
                        id="lebar_bahu"
                        class="form-control @error('lebar_bahu') is-invalid @enderror"
                        value="{{ old('lebar_bahu', $ukuran->lebar_bahu) }}"
                        placeholder="Contoh: 42"
                    >

                    @error('lebar_bahu')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="lingkar_dada">Lingkar Dada (cm)</label>

                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        name="lingkar_dada"
                        id="lingkar_dada"
                        class="form-control @error('lingkar_dada') is-invalid @enderror"
                        value="{{ old('lingkar_dada', $ukuran->lingkar_dada) }}"
                        placeholder="Contoh: 92"
                    >

                    @error('lingkar_dada')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="lingkar_pinggang">Lingkar Pinggang (cm)</label>

                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        name="lingkar_pinggang"
                        id="lingkar_pinggang"
                        class="form-control @error('lingkar_pinggang') is-invalid @enderror"
                        value="{{ old('lingkar_pinggang', $ukuran->lingkar_pinggang) }}"
                        placeholder="Contoh: 80"
                    >

                    @error('lingkar_pinggang')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="lingkar_lengan">Lingkar Lengan (cm)</label>

                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        name="lingkar_lengan"
                        id="lingkar_lengan"
                        class="form-control @error('lingkar_lengan') is-invalid @enderror"
                        value="{{ old('lingkar_lengan', $ukuran->lingkar_lengan) }}"
                        placeholder="Contoh: 30"
                    >

                    @error('lingkar_lengan')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal">
                        Tanggal Pengukuran<span class="required">*</span>
                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        id="tanggal"
                        class="form-control @error('tanggal') is-invalid @enderror"
                        value="{{ old('tanggal', $ukuran->tanggal ? \Carbon\Carbon::parse($ukuran->tanggal)->format('Y-m-d') : '') }}"
                        required
                    >

                    @error('tanggal')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="form-actions">
                <a
                    href="{{ route('karyawan.ukuran.index') }}"
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
@endsection
