```php
@extends('layouts.pelanggan')

@section('title', 'Pesan Jasa Jahit - Jaitin')

@section('content')

<style>
    .pesanan-container {
        width: 100%;
        margin: 0 auto;
    }

    .pesanan-card {
        background: #fffaf5;
        border: 1px solid #e6cfc0;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(120, 80, 70, 0.08);
    }

    .pesanan-title {
        font-size: 25px;
        font-weight: 700;
        color: #3d2a25;
        margin-bottom: 8px;
    }

    .pesanan-subtitle {
        color: #805e55;
        margin-bottom: 25px;
        line-height: 1.6;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px 20px;
    }

    .form-group {
        margin-bottom: 5px;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #3d2a25;
        margin-bottom: 8px;
    }

    .required {
        color: #b66f6f;
    }

    .form-control,
    .form-select,
    textarea {
        width: 100%;
        box-sizing: border-box;
        padding: 12px 14px;
        border: 1px solid #dfbfb2;
        border-radius: 9px;
        background: #fff;
        color: #4b3832;
        font-size: 14px;
        outline: none;
    }

    .form-control:focus,
    .form-select:focus,
    textarea:focus {
        border-color: #b98787;
        box-shadow: 0 0 0 2px rgba(185, 135, 135, 0.12);
    }

    textarea {
        min-height: 110px;
        resize: vertical;
    }

    .form-help {
        display: block;
        margin-top: 6px;
        color: #90675d;
        font-size: 12px;
        line-height: 1.5;
    }

    /* =========================
       REFERENSI MODEL
    ========================= */

    .referensi-section {
        margin-top: 30px;
    }

    .referensi-title {
        font-size: 18px;
        font-weight: 700;
        color: #3d2a25;
        margin-bottom: 6px;
    }

    .referensi-info {
        color: #805e55;
        font-size: 14px;
        margin-bottom: 18px;
        line-height: 1.5;
    }

    .referensi-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    .referensi-option {
        position: relative;
    }

    .referensi-option input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .referensi-card {
        display: block;
        background: #fff;
        border: 2px solid #ead5ca;
        border-radius: 13px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.2s ease;
        height: 100%;
    }

    .referensi-card:hover {
        border-color: #bc8d8d;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(120, 80, 70, 0.12);
    }

    .referensi-option input:checked + .referensi-card {
        border-color: #a97676;
        box-shadow: 0 0 0 3px rgba(169, 118, 118, 0.15);
    }

    .referensi-option input:checked + .referensi-card::after {
        content: "✓";
        position: absolute;
        top: 10px;
        right: 10px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #a97676;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        z-index: 2;
    }

    .referensi-image {
        width: 100%;
        height: 190px;
        object-fit: cover;
        display: block;
        background: #f5e8e2;
    }

    .referensi-content {
        padding: 13px;
    }

    .referensi-name {
        font-weight: 700;
        color: #3d2a25;
        margin-bottom: 4px;
    }

    .referensi-desc {
        font-size: 12px;
        color: #80645c;
        line-height: 1.4;
    }

    .selected-reference {
        margin-top: 15px;
        padding: 12px 15px;
        background: #f7e9e1;
        border-radius: 9px;
        color: #694b44;
        font-size: 14px;
        display: none;
    }

    .selected-reference.show {
        display: block;
    }

    /* =========================
       BUTTON
    ========================= */

    .button-area {
        margin-top: 30px;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .btn-submit {
        border: none;
        background: #b98787;
        color: white;
        padding: 13px 28px;
        border-radius: 9px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-submit:hover {
        background: #a97676;
    }

    .btn-cancel {
        text-decoration: none;
        background: white;
        color: #795b54;
        border: 1px solid #dfc2b6;
        padding: 13px 25px;
        border-radius: 9px;
        font-weight: 600;
    }

    .btn-cancel:hover {
        background: #f8f1eb;
    }

    /* =========================
       ERROR
    ========================= */

    .error-box {
        background: #fde4e4;
        border: 1px solid #e8aaaa;
        color: #9b4d4d;
        padding: 14px;
        border-radius: 9px;
        margin-bottom: 20px;
    }

    .error-box ul {
        margin: 8px 0 0 18px;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1000px) {
        .referensi-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 800px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .pesanan-card {
            padding: 25px;
        }
    }

    @media (max-width: 550px) {
        .referensi-grid {
            grid-template-columns: 1fr;
        }

        .pesanan-card {
            padding: 20px;
        }

        .button-area {
            flex-direction: column;
        }

        .btn-submit,
        .btn-cancel {
            width: 100%;
            text-align: center;
        }
    }
</style>


<div class="pesanan-container">

    <div class="pesanan-card">

        {{-- =========================
             JUDUL
        ========================== --}}

        <div class="pesanan-title">
            Informasi Pesanan
        </div>

        <div class="pesanan-subtitle">
            Silakan isi detail pakaian, ukuran, referensi model,
            dan tanggal yang diharapkan untuk penyelesaian pesanan.
        </div>


        {{-- =========================
             ERROR VALIDASI
        ========================== --}}

        @if ($errors->any())

            <div class="error-box">

                <strong>
                    Periksa kembali data pesanan:
                </strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>

            </div>

        @endif


        {{-- =========================
             FORM PESANAN
        ========================== --}}

        <form
            action="{{ route('pelanggan.pesanan.store') }}"
            method="POST"
        >

            @csrf


            <div class="form-grid">


                {{-- JENIS PAKAIAN --}}

                <div class="form-group">

                    <label class="form-label">
                        Jenis Pakaian
                        <span class="required">*</span>
                    </label>

                    <select
                        name="jenis_pakaian"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Pilih jenis pakaian --
                        </option>

                        <option
                            value="Kebaya"
                            {{ old('jenis_pakaian') == 'Kebaya' ? 'selected' : '' }}
                        >
                            Kebaya
                        </option>

                        <option
                            value="Pakaian"
                            {{ old('jenis_pakaian') == 'Pakaian' ? 'selected' : '' }}
                        >
                            Pakaian
                        </option>

                        <option
                            value="Dress"
                            {{ old('jenis_pakaian') == 'Dress' ? 'selected' : '' }}
                        >
                            Dress
                        </option>

                        <option
                            value="Perbaikan Pakaian"
                            {{ old('jenis_pakaian') == 'Perbaikan Pakaian' ? 'selected' : '' }}
                        >
                            Perbaikan Pakaian
                        </option>

                        <option
                            value="Permak"
                            {{ old('jenis_pakaian') == 'Permak' ? 'selected' : '' }}
                        >
                            Permak / Penyesuaian Ukuran
                        </option>

                    </select>

                </div>


                {{-- MODEL PAKAIAN --}}

                <div class="form-group">

                    <label class="form-label">
                        Model Pakaian
                    </label>

                    <input
                        type="text"
                        name="model_pakaian"
                        class="form-control"
                        value="{{ old('model_pakaian') }}"
                        placeholder="Contoh: Dress panjang lengan panjang"
                    >

                </div>


                {{-- JUMLAH --}}

                <div class="form-group">

                    <label class="form-label">
                        Jumlah
                        <span class="required">*</span>
                    </label>

                    <input
                        type="number"
                        name="jumlah"
                        class="form-control"
                        value="{{ old('jumlah', 1) }}"
                        min="1"
                        required
                    >

                </div>


                {{-- TANGGAL --}}

                <div class="form-group">

                    <label class="form-label">
                        Tanggal yang Diharapkan
                        <span class="required">*</span>
                    </label>

                    <input
                        type="date"
                        name="tanggal_harapan"
                        class="form-control"
                        value="{{ old('tanggal_harapan') }}"
                        required
                    >

                    <small class="form-help">
                        Tentukan tanggal yang Anda harapkan
                        untuk penyelesaian pesanan.
                    </small>

                </div>


                {{-- UKURAN --}}

                <div class="form-group full">

                    <label class="form-label">
                        Ukuran
                        <span class="required">*</span>
                    </label>

                    <textarea
                        name="ukuran"
                        placeholder="Contoh: Lingkar dada 90 cm, panjang baju 65 cm, panjang lengan 55 cm"
                        required
                    >{{ old('ukuran') }}</textarea>

                </div>


                {{-- CATATAN --}}

                <div class="form-group full">

                    <label class="form-label">
                        Catatan Tambahan
                    </label>

                    <textarea
                        name="catatan"
                        placeholder="Tuliskan detail tambahan yang ingin disampaikan kepada penjahit..."
                    >{{ old('catatan') }}</textarea>

                </div>

            </div>


            {{-- =========================
                 REFERENSI MODEL
            ========================== --}}

            <div class="referensi-section">

                <div class="referensi-title">
                    Referensi Model dari Penjahit
                </div>

                <div class="referensi-info">
                    Pilih salah satu contoh hasil jahitan
                    yang tersedia sebagai referensi model
                    pesanan Anda.
                </div>


                {{-- NILAI REFERENSI YANG DISIMPAN --}}

                <input
                    type="hidden"
                    name="referensi_model"
                    id="referensi_model"
                    value="{{ old('referensi_model') }}"
                >


                <div class="referensi-grid">


                    {{-- KEBAYA --}}

                    <div class="referensi-option">

                        <input
                            type="radio"
                            name="referensi_pilihan"
                            id="referensi_kebaya"
                            value="Kebaya - Model Kebaya"
                            {{ old('referensi_model') == 'Kebaya - Model Kebaya' ? 'checked' : '' }}
                        >

                        <label
                            for="referensi_kebaya"
                            class="referensi-card"
                        >

                            <img
                                src="{{ asset('images/referensi/kebaya.jpg') }}"
                                alt="Model Kebaya"
                                class="referensi-image"
                            >

                            <div class="referensi-content">

                                <div class="referensi-name">
                                    Kebaya
                                </div>

                                <div class="referensi-desc">
                                    Contoh model kebaya hasil
                                    jahitan yang tersedia di Jaitin.
                                </div>

                            </div>

                        </label>

                    </div>


                    {{-- DRESS --}}

                    <div class="referensi-option">

                        <input
                            type="radio"
                            name="referensi_pilihan"
                            id="referensi_dress"
                            value="Dress - Model Dress"
                            {{ old('referensi_model') == 'Dress - Model Dress' ? 'checked' : '' }}
                        >

                        <label
                            for="referensi_dress"
                            class="referensi-card"
                        >

                            <img
                                src="{{ asset('images/referensi/dress.jpg') }}"
                                alt="Model Dress"
                                class="referensi-image"
                            >

                            <div class="referensi-content">

                                <div class="referensi-name">
                                    Dress
                                </div>

                                <div class="referensi-desc">
                                    Contoh model dress yang pernah
                                    dibuat oleh penjahit.
                                </div>

                            </div>

                        </label>

                    </div>


                    {{-- PAKAIAN --}}

                    <div class="referensi-option">

                        <input
                            type="radio"
                            name="referensi_pilihan"
                            id="referensi_pakaian"
                            value="Pakaian - Model Pakaian"
                            {{ old('referensi_model') == 'Pakaian - Model Pakaian' ? 'checked' : '' }}
                        >

                        <label
                            for="referensi_pakaian"
                            class="referensi-card"
                        >

                            <img
                                src="{{ asset('images/referensi/pakaian.jpg') }}"
                                alt="Model Pakaian"
                                class="referensi-image"
                            >

                            <div class="referensi-content">

                                <div class="referensi-name">
                                    Pakaian
                                </div>

                                <div class="referensi-desc">
                                    Contoh pakaian hasil jahitan
                                    yang tersedia.
                                </div>

                            </div>

                        </label>

                    </div>


                    {{-- PERBAIKAN PAKAIAN --}}

                    <div class="referensi-option">

                        <input
                            type="radio"
                            name="referensi_pilihan"
                            id="referensi_perbaikan"
                            value="Perbaikan Pakaian"
                            {{ old('referensi_model') == 'Perbaikan Pakaian' ? 'checked' : '' }}
                        >

                        <label
                            for="referensi_perbaikan"
                            class="referensi-card"
                        >

                            <img
                                src="{{ asset('images/referensi/perbaikan.jpg') }}"
                                alt="Perbaikan Pakaian"
                                class="referensi-image"
                            >

                            <div class="referensi-content">

                                <div class="referensi-name">
                                    Perbaikan Pakaian
                                </div>

                                <div class="referensi-desc">
                                    Contoh hasil perbaikan atau
                                    perubahan pakaian.
                                </div>

                            </div>

                        </label>

                    </div>


                    {{-- PERMAK --}}

                    <div class="referensi-option">

                        <input
                            type="radio"
                            name="referensi_pilihan"
                            id="referensi_permak"
                            value="Permak - Penyesuaian Ukuran"
                            {{ old('referensi_model') == 'Permak - Penyesuaian Ukuran' ? 'checked' : '' }}
                        >

                        <label
                            for="referensi_permak"
                            class="referensi-card"
                        >

                            <img
                                src="{{ asset('images/referensi/permak.jpg') }}"
                                alt="Permak Pakaian"
                                class="referensi-image"
                            >

                            <div class="referensi-content">

                                <div class="referensi-name">
                                    Permak
                                </div>

                                <div class="referensi-desc">
                                    Contoh hasil penyesuaian
                                    ukuran pakaian.
                                </div>

                            </div>

                        </label>

                    </div>


                    {{-- MODEL LAINNYA --}}

                    <div class="referensi-option">

                        <input
                            type="radio"
                            name="referensi_pilihan"
                            id="referensi_lainnya"
                            value="Model Lainnya"
                            {{ old('referensi_model') == 'Model Lainnya' ? 'checked' : '' }}
                        >

                        <label
                            for="referensi_lainnya"
                            class="referensi-card"
                        >

                            <img
                                src="{{ asset('images/referensi/lainnya.jpg') }}"
                                alt="Model Lainnya"
                                class="referensi-image"
                            >

                            <div class="referensi-content">

                                <div class="referensi-name">
                                    Model Lainnya
                                </div>

                                <div class="referensi-desc">
                                    Pilihan model lain yang tersedia
                                    dari penjahit.
                                </div>

                            </div>

                        </label>

                    </div>

                </div>


                {{-- MODEL TERPILIH --}}

                <div
                    id="selectedReference"
                    class="selected-reference {{ old('referensi_model') ? 'show' : '' }}"
                >

                    Referensi dipilih:

                    <strong id="selectedReferenceName">
                        {{ old('referensi_model') }}
                    </strong>

                </div>

            </div>


            {{-- =========================
                 BUTTON
            ========================== --}}

            <div class="button-area">

                <a
                    href="{{ route('dashboard') }}"
                    class="btn-cancel"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn-submit"
                >
                    Kirim Pesanan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection


{{-- =========================
     JAVASCRIPT
========================= --}}

@section('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const pilihan = document.querySelectorAll(
        'input[name="referensi_pilihan"]'
    );

    const referensiModel = document.getElementById(
        'referensi_model'
    );

    const selectedReference = document.getElementById(
        'selectedReference'
    );

    const selectedReferenceName = document.getElementById(
        'selectedReferenceName'
    );


    pilihan.forEach(function (radio) {

        radio.addEventListener('change', function () {

            referensiModel.value = this.value;

            selectedReferenceName.textContent =
                this.value;

            selectedReference.classList.add('show');

        });

    });

});
</script>

@endsection
```