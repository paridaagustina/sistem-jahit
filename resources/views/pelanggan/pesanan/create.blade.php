```blade
@extends('layouts.pelanggan')

@section('title', 'Pesan Jasa Jahit - Jaitin')

@section('content')
@php
    $kategoriTersedia = [
        'kebaya' => [
            'nama' => 'Kebaya',
            'ikon' => '🪡',
            'deskripsi' => 'Kebaya Modern, Kebaya Klasik, dan Kebaya Minimalis.',
        ],
        'dress' => [
            'nama' => 'Dress',
            'ikon' => '👗',
            'deskripsi' => 'Pilih model dress sesuai kebutuhan Anda.',
        ],
        'perbaikan' => [
            'nama' => 'Perbaikan Pakaian',
            'ikon' => '🧵',
            'deskripsi' => 'Mengecilkan, memendekkan, dan mengganti resleting.',
        ],
    ];

    // Urutan jenis model yang diinginkan.
    $urutanJenis = [
        'kebaya' => [
            'Kebaya Modern',
            'Kebaya Klasik',
            'Kebaya Minimalis',
        ],
        'dress' => [
            'Dress Pesta',
            'Dress Formal',
            'Dress Casual',
        ],
        'perbaikan' => [
            'Mengecilkan Pakaian',
            'Memendekkan Pakaian',
            'Mengganti Resleting',
        ],
    ];

    $modelDikelompokkan = collect($referensiModel ?? [])
        ->where('aktif', true)
        ->groupBy('kategori')
        ->map(function ($models) {
            return $models->groupBy(function ($model) {
                return $model->jenis_model ?: $model->nama_model;
            });
        });

    // Urutkan jenis berdasarkan daftar di atas.
    $modelDikelompokkan = $modelDikelompokkan->map(
        function ($jenisModel, $kategori) use ($urutanJenis) {
            $urutan = $urutanJenis[$kategori] ?? [];

            return $jenisModel->sortBy(function ($daftarModel, $namaJenis) use ($urutan) {
                $posisi = array_search($namaJenis, $urutan, true);

                return $posisi === false
                    ? count($urutan) + 1
                    : $posisi;
            });
        }
    );

    $kategoriLama = old('kategori_pilihan');
    $idModelLama = old('model_katalog_id', old('referensi_pilihan'));
@endphp

<style>
    .pesanan-container {
        width: 100%;
        margin: auto;
        color: #3d2a25;
    }

    .pesanan-card {
        background: #fffaf5;
        border: 1px solid #e6cfc0;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 4px 15px rgba(120,80,70,.08);
    }

    .pesanan-title {
        font-size: 25px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .pesanan-subtitle {
        color: #805e55;
        margin-bottom: 25px;
        line-height: 1.6;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .form-group { min-width: 0; }
    .form-group.full { grid-column: 1 / -1; }

    .form-label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .required { color: #b66f6f; }

    .form-control,
    .form-select,
    .form-grid textarea {
        width: 100%;
        box-sizing: border-box;
        padding: 12px 14px;
        border: 1px solid #dfbfb2;
        border-radius: 9px;
        background: #fff;
        color: #4b3832;
        font-size: 14px;
    }

    .form-grid textarea {
        min-height: 100px;
        resize: vertical;
    }

    .form-control:focus,
    .form-select:focus,
    .form-grid textarea:focus {
        outline: none;
        border-color: #b98787;
        box-shadow: 0 0 0 2px rgba(185,135,135,.12);
    }

    .form-help {
        display: block;
        margin-top: 6px;
        color: #90675d;
        font-size: 12px;
        line-height: 1.5;
    }

    .referensi-section {
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #ead5ca;
    }

    .referensi-title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .referensi-info {
        color: #805e55;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 18px;
    }

    .kategori-grid,
    .jenis-grid,
    .model-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    .kategori-button {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
        text-align: left;
        padding: 20px;
        border: 1px solid #ead5ca;
        border-radius: 13px;
        background: #fff;
        color: #3d2a25;
        cursor: pointer;
        transition: .2s;
        min-height: 150px;
    }

    .kategori-button:hover,
    .kategori-button.active {
        border-color: #b98787;
        background: #fff4f0;
        box-shadow: 0 0 0 2px rgba(185,135,135,.12);
    }

    .kategori-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        border-radius: 13px;
        background: #f3dfe0;
        font-size: 25px;
    }

    .kategori-button strong { font-size: 17px; }

    .kategori-button .kategori-deskripsi {
        color: #805e55;
        font-size: 13px;
        line-height: 1.6;
    }

    .pilihan-area { margin-top: 25px; }

    .subjudul {
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 15px;
    }

    .jenis-button {
        display: block;
        width: 100%;
        text-align: left;
        padding: 0;
        overflow: hidden;
        border: 1px solid #ead5ca;
        border-radius: 13px;
        background: #fffaf5;
        color: #3d2a25;
        cursor: pointer;
        transition: .2s;
    }

    .jenis-button:hover,
    .jenis-button.active {
        border-color: #b98787;
        box-shadow: 0 4px 15px rgba(120,80,70,.1);
    }

    .jenis-cover {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 145px;
        background: #f1dfe0;
        font-size: 38px;
    }

    .jenis-content { padding: 15px; }

    .jenis-nama {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .jenis-deskripsi {
        color: #805e55;
        font-size: 13px;
        line-height: 1.6;
    }

    .jenis-link {
        display: block;
        width: 100%;
        box-sizing: border-box;
        text-align: center;
        margin-top: 14px;
        padding: 10px;
        background: #b98787;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: background .2s ease;
    }

    .jenis-button:hover .jenis-link,
    .jenis-button.active .jenis-link {
        background: #a97676;
    }

    .model-grid { align-items: stretch; }

    .model-item {
        position: relative;
        min-width: 0;
    }

    .model-radio {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 2;
        width: 21px;
        height: 21px;
        accent-color: #a97676;
        cursor: pointer;
    }

    .model-card {
        display: block;
        height: 100%;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid #ead5ca;
        border-radius: 13px;
        background: #fffaf5;
        transition: .2s;
    }

    .model-radio:checked + .model-card {
        border-color: #a97676;
        box-shadow: 0 0 0 3px rgba(169,118,118,.15);
    }

    .model-photo,
    .model-placeholder {
        width: 100%;
        height: 240px;
        display: block;
        object-fit: cover;
        background: #f5e8e2;
    }

    .model-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px;
        box-sizing: border-box;
        text-align: center;
        color: #90675d;
        font-size: 13px;
    }

    .model-content { padding: 15px; }

    .model-name {
        font-weight: 700;
        margin-bottom: 8px;
        overflow-wrap: anywhere;
    }

    .model-description {
        color: #80645c;
        font-size: 13px;
        line-height: 1.6;
        margin-bottom: 12px;
    }

    .model-badge {
        display: inline-block;
        border-radius: 20px;
        padding: 6px 10px;
        background: #f3dfe0;
        color: #98696e;
        font-size: 12px;
    }

    .pilih-model-text {
        display: block;
        margin-top: 13px;
        text-align: center;
        padding: 10px;
        border-radius: 8px;
        background: #b98787;
        color: white;
        font-size: 13px;
        font-weight: 600;
    }

    .model-radio:checked + .model-card .pilih-model-text {
        background: #805e55;
    }

    .empty-box {
        grid-column: 1 / -1;
        background: #f8eee8;
        color: #805e55;
        padding: 18px;
        border-radius: 10px;
        line-height: 1.6;
    }

    .selected-reference {
        display: none;
        margin-top: 15px;
        padding: 12px 15px;
        background: #f7e9e1;
        border-radius: 9px;
        color: #694b44;
        line-height: 1.6;
    }

    .selected-reference.show { display: block; }

    .upload-reference {
        margin-top: 24px;
        padding: 20px;
        background: #fff7f1;
        border: 1px dashed #c99b9d;
        border-radius: 12px;
    }

    .upload-title {
        display: block;
        margin-bottom: 8px;
        font-weight: 700;
    }

    .upload-control {
        display: block;
        width: 100%;
        box-sizing: border-box;
        margin-top: 12px;
        padding: 10px;
        border: 1px solid #dfbfb2;
        border-radius: 8px;
        background: white;
    }

    .preview-container { display: none; margin-top: 16px; }

    .preview-image {
        display: block;
        width: 190px;
        max-width: 100%;
        max-height: 250px;
        object-fit: contain;
        margin-top: 10px;
        border-radius: 10px;
        border: 1px solid #ead5ca;
        background: white;
    }

    .btn-remove-image {
        margin-top: 10px;
        padding: 8px 13px;
        border: 1px solid #dfbfb2;
        border-radius: 8px;
        background: white;
        color: #795b54;
        cursor: pointer;
    }

    .button-area {
        margin-top: 30px;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .btn-submit,
    .btn-cancel {
        padding: 13px 25px;
        border-radius: 9px;
        font-weight: 600;
        cursor: pointer;
        text-align: center;
    }

    .btn-submit {
        border: none;
        background: #b98787;
        color: white;
    }

    .btn-submit:hover { background: #a97676; }

    .btn-cancel {
        text-decoration: none;
        background: white;
        color: #795b54;
        border: 1px solid #dfc2b6;
    }

    .error-box {
        background: #fde4e4;
        border: 1px solid #e8aaaa;
        color: #9b4d4d;
        padding: 14px;
        border-radius: 9px;
        margin-bottom: 20px;
    }

    .field-error {
        display: block;
        margin-top: 6px;
        color: #b34242;
        font-size: 12px;
    }

    @media (max-width: 900px) {
        .kategori-grid,
        .jenis-grid,
        .model-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        .form-grid { grid-template-columns: 1fr; }
        .form-group.full { grid-column: auto; }
        .pesanan-card { padding: 17px; }

        .kategori-grid,
        .jenis-grid,
        .model-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .kategori-button { padding: 13px; }
        .kategori-button strong { font-size: 14px; }
        .kategori-button .kategori-deskripsi { font-size: 12px; }
        .jenis-cover { min-height: 100px; }
        .jenis-content { padding: 10px; }
        .jenis-nama { font-size: 14px; }
        .model-photo,
        .model-placeholder { height: 160px; }
        .model-content { padding: 10px; }
        .model-name { font-size: 13px; }
        .button-area { flex-direction: column-reverse; }
        .btn-submit,
        .btn-cancel {
            width: 100%;
            box-sizing: border-box;
        }
    }
</style>

<div class="pesanan-container">
    <div class="pesanan-card">
        <div class="pesanan-title">Informasi Pesanan</div>

        <div class="pesanan-subtitle">
            Pilih model pakaian dari katalog atau unggah foto referensi sendiri,
            kemudian lengkapi informasi pesanan Anda.
        </div>

        @if ($errors->any())
            <div class="error-box">
                <strong>Periksa kembali data pesanan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pelanggan.pesanan.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label for="jenis_pakaian" class="form-label">
                        Jenis Pakaian <span class="required">*</span>
                    </label>

                    <select name="jenis_pakaian" id="jenis_pakaian"
                            class="form-select" required>
                        <option value="">-- Pilih jenis pakaian --</option>

                        @foreach (['Kebaya', 'Dress', 'Perbaikan Pakaian'] as $jenis)
                            <option value="{{ $jenis }}"
                                @selected(old('jenis_pakaian') === $jenis)>
                                {{ $jenis }}
                            </option>
                        @endforeach
                    </select>

                    @error('jenis_pakaian')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="model_pakaian" class="form-label">
                        Model Pakaian
                    </label>

                    <input type="text" name="model_pakaian" id="model_pakaian"
                           class="form-control" maxlength="255"
                           value="{{ old('model_pakaian') }}"
                           placeholder="Terisi otomatis saat memilih model">

                    @error('model_pakaian')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jumlah" class="form-label">
                        Jumlah <span class="required">*</span>
                    </label>

                    <input type="number" name="jumlah" id="jumlah"
                           class="form-control" min="1"
                           value="{{ old('jumlah', 1) }}" required>

                    @error('jumlah')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_harapan" class="form-label">
                        Tanggal yang Diharapkan <span class="required">*</span>
                    </label>

                    <input type="date" name="tanggal_harapan"
                           id="tanggal_harapan" class="form-control"
                           value="{{ old('tanggal_harapan') }}"
                           min="{{ date('Y-m-d') }}" required>

                    <small class="form-help">
                        Tentukan tanggal yang Anda harapkan untuk penyelesaian pesanan.
                    </small>

                    @error('tanggal_harapan')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group full">
                    <label for="ukuran" class="form-label">
                        Ukuran <span class="required">*</span>
                    </label>

                    <textarea name="ukuran" id="ukuran" required
                        placeholder="Contoh: Lingkar dada 90 cm, panjang baju 65 cm, panjang lengan 55 cm">{{ old('ukuran') }}</textarea>

                    @error('ukuran')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group full">
                    <label for="catatan" class="form-label">
                        Catatan Tambahan
                    </label>

                    <textarea name="catatan" id="catatan"
                        placeholder="Tuliskan detail tambahan untuk penjahit">{{ old('catatan') }}</textarea>

                    @error('catatan')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="referensi-section">
                <div class="referensi-title">Referensi Model dari Penjahit</div>

                <div class="referensi-info">
                    Pilih kategori, buka jenis model yang diinginkan, lalu pilih
                    foto referensi dari katalog admin.
                </div>

                <input type="hidden" name="referensi_model"
                       id="referensi_model" value="{{ old('referensi_model') }}">

                <input type="hidden" name="referensi_pilihan"
                       id="referensi_pilihan" value="{{ old('referensi_pilihan') }}">

                <input type="hidden" name="kategori_pilihan"
                       id="kategori_pilihan" value="{{ $kategoriLama }}">

                {{-- KARTU KATEGORI --}}
                <div class="kategori-grid" id="kategoriGrid">
                    @foreach ($kategoriTersedia as $key => $kategori)
                        <button type="button"
                                class="kategori-button {{ $kategoriLama === $key ? 'active' : '' }}"
                                data-kategori="{{ $key }}">
                            <span class="kategori-icon">{{ $kategori['ikon'] }}</span>
                            <strong>{{ $kategori['nama'] }}</strong>
                            <span class="kategori-deskripsi">
                                {{ $kategori['deskripsi'] }}
                            </span>
                        </button>
                    @endforeach
                </div>

                {{-- PILIHAN JENIS MODEL PER KATEGORI --}}
                @foreach ($kategoriTersedia as $key => $kategori)
                    @php
                        $jenisDalamKategori = $modelDikelompokkan->get($key, collect());
                    @endphp

                    <section class="pilihan-area kategori-panel"
                             data-panel-kategori="{{ $key }}"
                             style="display: {{ $kategoriLama === $key ? 'block' : 'none' }}">

                        <div class="subjudul">
                            Pilih jenis model {{ $kategori['nama'] }}
                        </div>

                        <div class="jenis-grid">
                            @forelse ($jenisDalamKategori as $jenisModel => $daftarModel)
                                <button type="button"
                                        class="jenis-button"
                                        data-kategori="{{ $key }}"
                                        data-jenis="{{ $jenisModel }}">

                                    <div class="jenis-cover">
                                        {{ $kategori['ikon'] }}
                                    </div>

                                    <div class="jenis-content">
                                        <div class="jenis-nama">{{ $jenisModel }}</div>

                                        <div class="jenis-deskripsi">
                                            @if ($key === 'perbaikan')
                                                Lihat referensi layanan {{ strtolower($jenisModel) }}.
                                            @else
                                                Lihat koleksi foto {{ strtolower($jenisModel) }}.
                                            @endif
                                        </div>

                                        <span class="jenis-link">Lihat Galeri →</span>
                                    </div>
                                </button>
                            @empty
                                <div class="empty-box">
                                    Belum ada jenis model aktif pada kategori ini.
                                    Silakan periksa kembali nanti.
                                </div>
                            @endforelse
                        </div>

                        {{-- GALERI FOTO PER JENIS MODEL --}}
                        @foreach ($jenisDalamKategori as $jenisModel => $daftarModel)
                            <div class="pilihan-area model-panel"
                                 data-model-kategori="{{ $key }}"
                                 data-model-jenis="{{ $jenisModel }}"
                                 style="display:none">

                                <div class="subjudul">
                                    Galeri {{ $jenisModel }}
                                </div>

                                <div class="referensi-info">
                                    Pilih salah satu foto untuk menggunakan model tersebut
                                    sebagai referensi pesanan.
                                </div>

                                <div class="model-grid">
                                    @foreach ($daftarModel as $model)
                                        <div class="model-item">
                                            <input type="radio"
                                                   class="model-radio"
                                                   name="model_katalog_id"
                                                   id="model_{{ $model->id }}"
                                                   value="{{ $model->id }}"
                                                   data-nama="{{ $model->nama_model }}"
                                                   data-jenis="{{ $model->jenis_model ?: $model->nama_model }}"
                                                   data-kategori="{{ $model->kategori }}"
                                                   @checked((string) $idModelLama === (string) $model->id)>

                                            <label for="model_{{ $model->id }}"
                                                   class="model-card">

                                                @if ($model->foto)
                                                    <img class="model-photo"
                                                         src="{{ asset('storage/' . ltrim($model->foto, '/')) }}"
                                                         alt="{{ $model->nama_model }}"
                                                         loading="lazy"
                                                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">

                                                    <div class="model-placeholder" style="display:none">
                                                        Foto tidak dapat ditampilkan
                                                    </div>
                                                @else
                                                    <div class="model-placeholder">
                                                        Belum ada foto referensi
                                                    </div>
                                                @endif

                                                <div class="model-content">
                                                    <div class="model-name">
                                                        {{ $model->nama_model }}
                                                    </div>

                                                    @if ($model->deskripsi)
                                                        <div class="model-description">
                                                            {{ $model->deskripsi }}
                                                        </div>
                                                    @endif

                                                    <span class="model-badge">
                                                        Referensi Model
                                                    </span>

                                                    <span class="pilih-model-text">
                                                        Pilih Model Ini
                                                    </span>
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </section>
                @endforeach

                <div id="selectedReference" class="selected-reference">
                    Model dipilih:
                    <strong id="selectedReferenceName"></strong>
                </div>

                @error('model_katalog_id')
                    <small class="field-error">{{ $message }}</small>
                @enderror

                @error('referensi_pilihan')
                    <small class="field-error">{{ $message }}</small>
                @enderror

                {{-- UNGGAH FOTO SENDIRI --}}
                <div class="upload-reference">
                    <label for="referensi_upload" class="upload-title">
                        Atau Unggah Model Sendiri
                    </label>

                    <div class="referensi-info">
                        Gunakan pilihan ini jika model yang Anda inginkan
                        tidak tersedia di katalog.
                    </div>

                    <input type="file"
                           name="referensi_upload"
                           id="referensi_upload"
                           class="upload-control"
                           accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">

                    <small class="form-help">
                        Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    </small>

                    @error('referensi_upload')
                        <small class="field-error">{{ $message }}</small>
                    @enderror

                    <div id="preview-container" class="preview-container">
                        <strong>Pratinjau foto</strong>

                        <img id="preview-referensi"
                             class="preview-image"
                             alt="Pratinjau foto referensi">

                        <button type="button" id="hapus-referensi"
                                class="btn-remove-image">
                            Hapus foto
                        </button>
                    </div>
                </div>
            </div>

            <div class="button-area">
                <a href="{{ route('dashboard') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit">Kirim Pesanan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const kategoriButtons = document.querySelectorAll('.kategori-button');
    const kategoriPanels = document.querySelectorAll('.kategori-panel');
    const jenisButtons = document.querySelectorAll('.jenis-button');
    const modelPanels = document.querySelectorAll('.model-panel');
    const modelRadios = document.querySelectorAll('input[name="model_katalog_id"]');

    const kategoriInput = document.getElementById('kategori_pilihan');
    const pilihanInput = document.getElementById('referensi_pilihan');
    const referensiInput = document.getElementById('referensi_model');
    const modelPakaian = document.getElementById('model_pakaian');
    const jenisPakaian = document.getElementById('jenis_pakaian');

    const selectedBox = document.getElementById('selectedReference');
    const selectedName = document.getElementById('selectedReferenceName');

    const uploadInput = document.getElementById('referensi_upload');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-referensi');
    const removeButton = document.getElementById('hapus-referensi');

    let previewUrl = null;

    function hapusPreview() {
        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }
    }

    function tutupSemuaGaleri() {
        modelPanels.forEach(panel => {
            panel.style.display = 'none';
        });

        jenisButtons.forEach(button => {
            button.classList.remove('active');
        });
    }

    function bukaKategori(kategori) {
        kategoriInput.value = kategori;

        kategoriButtons.forEach(button => {
            button.classList.toggle(
                'active',
                button.dataset.kategori === kategori
            );
        });

        kategoriPanels.forEach(panel => {
            panel.style.display =
                panel.dataset.panelKategori === kategori ? 'block' : 'none';
        });

        tutupSemuaGaleri();
    }

    function bukaGaleri(kategori, jenis, scroll = true) {
        // Buka kategori terlebih dahulu.
        bukaKategori(kategori);

        // Aktifkan kartu jenis yang sesuai.
        jenisButtons.forEach(button => {
            button.classList.toggle(
                'active',
                button.dataset.kategori === kategori &&
                button.dataset.jenis === jenis
            );
        });

        // Tampilkan hanya galeri yang dipilih.
        modelPanels.forEach(panel => {
            const cocok =
                panel.dataset.modelKategori === kategori &&
                panel.dataset.modelJenis === jenis;

            panel.style.display = cocok ? 'block' : 'none';
        });

        const panelAktif = Array.from(modelPanels).find(panel =>
            panel.dataset.modelKategori === kategori &&
            panel.dataset.modelJenis === jenis
        );

        if (panelAktif && scroll) {
            panelAktif.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }

    function bersihkanPilihanModel() {
        modelRadios.forEach(radio => {
            radio.checked = false;
        });

        pilihanInput.value = '';
        referensiInput.value = '';
        selectedBox.classList.remove('show');
    }

    function pilihModel(radio, scroll = false) {
        if (!radio) return;

        radio.checked = true;

        const kategori = radio.dataset.kategori;
        const jenis = radio.dataset.jenis;
        const nama = radio.dataset.nama;

        kategoriInput.value = kategori;
        pilihanInput.value = radio.value;
        referensiInput.value = nama;
        modelPakaian.value = nama;

        const jenisKategori = {
            kebaya: 'Kebaya',
            dress: 'Dress',
            perbaikan: 'Perbaikan Pakaian'
        };

        if (jenisKategori[kategori]) {
            jenisPakaian.value = jenisKategori[kategori];
        }

        selectedName.textContent = nama + ' (' + jenis + ')';
        selectedBox.classList.add('show');

        // Buka galeri tanpa menghapus pilihan radio.
        bukaGaleri(kategori, jenis, scroll);
    }

    kategoriButtons.forEach(button => {
        button.addEventListener('click', function () {
            const kategoriBaru = this.dataset.kategori;
            const modelTerpilih = document.querySelector(
                'input[name="model_katalog_id"]:checked'
            );

            if (
                modelTerpilih &&
                modelTerpilih.dataset.kategori !== kategoriBaru
            ) {
                bersihkanPilihanModel();
            }

            bukaKategori(kategoriBaru);
        });
    });

    jenisButtons.forEach(button => {
        button.addEventListener('click', function () {
            bukaGaleri(this.dataset.kategori, this.dataset.jenis);
        });
    });

    modelRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (!this.checked) return;

            uploadInput.value = '';
            previewContainer.style.display = 'none';
            previewImage.removeAttribute('src');
            hapusPreview();

            pilihModel(this);
        });
    });

    uploadInput.addEventListener('change', function () {
        const file = this.files && this.files[0];

        if (!file) return;

        const tipeDiizinkan = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!tipeDiizinkan.includes(file.type)) {
            alert('Pilih foto dengan format JPG, PNG, atau WEBP.');
            this.value = '';
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran foto maksimal 2 MB.');
            this.value = '';
            return;
        }

        bersihkanPilihanModel();

        hapusPreview();
        previewUrl = URL.createObjectURL(file);
        previewImage.src = previewUrl;
        previewContainer.style.display = 'block';
    });

    removeButton.addEventListener('click', function () {
        uploadInput.value = '';
        previewImage.removeAttribute('src');
        previewContainer.style.display = 'none';
        hapusPreview();
    });

    // Pulihkan pilihan ketika validasi form gagal.
    if (kategoriInput.value) {
        bukaKategori(kategoriInput.value);
    }

    const radioLama = document.querySelector(
        'input[name="model_katalog_id"]:checked'
    );

    if (radioLama) {
        pilihModel(radioLama, false);
    }

    window.addEventListener('beforeunload', hapusPreview);
});
</script>
@endsection
```