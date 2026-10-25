
@extends('layouts.pelanggan')

@section('title', 'Galeri ' . $jenis . ' - Jaitin')

@section('content')
<style>
.galeri-page{max-width:1100px;margin:auto;color:#4b3832}
.kembali{display:inline-block;margin-bottom:24px;color:#9f7378;text-decoration:none;font-weight:bold}
.galeri-page h1{font-size:27px;margin-bottom:8px}
.galeri-page p{color:#806e69;line-height:1.6}
.model-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px;margin:25px 0}
.model-option{position:relative;min-width:0}
.model-option input{position:absolute;top:12px;right:12px;width:22px;height:22px;accent-color:#a97676;z-index:2}
.model-card{display:block;height:100%;overflow:hidden;border:2px solid #ead5ca;border-radius:13px;background:#fffaf5;cursor:pointer}
.model-option input:checked + label{border-color:#a97676;box-shadow:0 0 0 3px #b8898d30}
.model-photo,.no-photo{width:100%;height:240px;object-fit:cover;display:block;background:#f1dfe0}
.no-photo{display:flex;align-items:center;justify-content:center;color:#806e69}
.model-body{padding:15px}
.model-body h3{margin-bottom:8px}
.model-body p{font-size:13px}
.form-card{background:#fffaf5;border:1px solid #ead5ca;border-radius:14px;padding:24px;margin-top:25px}
.form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}
.form-group{min-width:0}
.form-group.full{grid-column:1/-1}
.form-group label{display:block;font-weight:bold;margin-bottom:8px}
.form-group input,.form-group select,.form-group textarea{width:100%;padding:12px;border:1px solid #dfbfb2;border-radius:8px;background:white;box-sizing:border-box;font:inherit}
.form-group textarea{min-height:90px}
.btn-submit{background:#b8898d;color:white;border:0;border-radius:8px;padding:13px 22px;cursor:pointer;font-weight:bold}
.errors{background:#fde4e4;padding:14px;border-radius:8px;margin:18px 0;color:#9b4d4d}
@media(max-width:750px){.model-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(max-width:500px){.model-grid,.form-grid{grid-template-columns:1fr}.form-group.full{grid-column:auto}.model-photo,.no-photo{height:190px}}
</style>

<div class="galeri-page">
    <a class="kembali" href="{{ route('pelanggan.pesanan.jenis', $kategori) }}">← Kembali ke pilihan jenis</a>

    <h1>Galeri {{ $jenis }}</h1>
    <p>Pilih foto model yang ingin dijadikan referensi pesanan.</p>

    @if ($errors->any())
        <div class="errors">
            <strong>Periksa kembali pesananmu:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pelanggan.pesanan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="kategori_pilihan" value="{{ $kategori }}">

        <div class="model-grid">
            @forelse ($referensiModel as $model)
                <div class="model-option">
                    <input type="radio"
                           name="model_katalog_id"
                           id="model_{{ $model->id }}"
                           value="{{ $model->id }}"
                           data-nama="{{ $model->nama_model }}"
                           @checked((string) old('model_katalog_id', old('referensi_pilihan')) === (string) $model->id)
                           required>

                    <label class="model-card" for="model_{{ $model->id }}">
                        @if ($model->foto)
                            <img class="model-photo"
                                 src="{{ asset('storage/' . ltrim($model->foto, '/')) }}"
                                 alt="{{ $model->nama_model }}"
                                 onerror="this.outerHTML='<div class=&quot;no-photo&quot;>Foto tidak tersedia</div>'">
                        @else
                            <div class="no-photo">Belum ada foto</div>
                        @endif

                        <div class="model-body">
                            <h3>{{ $model->nama_model }}</h3>
                            <p>{{ $model->deskripsi ?: 'Referensi model dari katalog penjahit.' }}</p>
                        </div>
                    </label>
                </div>
            @empty
                <p>Belum ada foto aktif untuk jenis model ini.</p>
            @endforelse
        </div>

        <div class="form-card">
            <h2 style="margin-bottom:20px">Informasi Pesanan</h2>

            <div class="form-grid">
                <div class="form-group">
                    <label for="jenis_pakaian">Jenis Pakaian *</label>
                    <input id="jenis_pakaian" name="jenis_pakaian"
                           value="{{ old('jenis_pakaian', $kategori === 'kebaya' ? 'Kebaya' : ($kategori === 'dress' ? 'Dress' : 'Perbaikan Pakaian')) }}"
                           required>
                </div>

                <div class="form-group">
                    <label for="model_pakaian">Model Pakaian</label>
                    <input id="model_pakaian" name="model_pakaian"
                           value="{{ old('model_pakaian') }}"
                           placeholder="Pilih foto atau tulis nama model">
                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah *</label>
                    <input type="number" id="jumlah" name="jumlah"
                           min="1" value="{{ old('jumlah', 1) }}" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_harapan">Tanggal yang Diharapkan *</label>
                    <input type="date" id="tanggal_harapan" name="tanggal_harapan"
                           min="{{ date('Y-m-d') }}"
                           value="{{ old('tanggal_harapan') }}" required>
                </div>

                <div class="form-group full">
                    <label for="ukuran">Ukuran *</label>
                    <textarea id="ukuran" name="ukuran" required
                              placeholder="Contoh: lingkar dada 90 cm, panjang baju 65 cm">{{ old('ukuran') }}</textarea>
                </div>

                <div class="form-group full">
                    <label for="catatan">Catatan Tambahan</label>
                    <textarea id="catatan" name="catatan"
                              placeholder="Tuliskan detail tambahan">{{ old('catatan') }}</textarea>
                </div>

                <div class="form-group full">
                    <label for="referensi_upload">Atau unggah foto sendiri</label>
                    <input type="file" id="referensi_upload" name="referensi_upload"
                           accept=".jpg,.jpeg,.png,.webp">
                    <p style="margin-top:8px;font-size:12px">Format JPG, PNG, WEBP. Maksimal 2 MB.</p>
                </div>
            </div>

            <div style="display:flex;justify-content:flex-end;margin-top:24px">
                <button type="submit" class="btn-submit">Kirim Pesanan</button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const radios = document.querySelectorAll('input[name="model_katalog_id"]');
    const modelInput = document.getElementById('model_pakaian');
    const upload = document.getElementById('referensi_upload');

    radios.forEach(function (radio) {
        radio.addEventListener('change', function () {
            if (this.checked) {
                modelInput.value = this.dataset.nama || '';
                upload.value = '';
            }
        });
    });

    upload.addEventListener('change', function () {
        if (this.files.length > 0) {
            radios.forEach(radio => radio.checked = false);
        }
    });

    const selected = document.querySelector('input[name="model_katalog_id"]:checked');
    if (selected) modelInput.value = selected.dataset.nama || modelInput.value;
});
</script>
@endsection
