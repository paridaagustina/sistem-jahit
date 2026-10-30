@extends('layouts.pelanggan')

@section('title', 'Pesan Jasa Jahit - JAITIN')

@section('styles')
<style>
    .pesanan-page {
        --pink: #b77d8b;
        --pink-dark: #965e6d;
        --pink-soft: #f8eaf0;
        --cream: #fffaf7;
        --ink: #49343a;
        --muted: #856d73;
        --border: #ecd9df;
        width: 100%;
        max-width: 1180px;
        margin: 0 auto;
        color: var(--ink);
    }

    .pesanan-hero {
        position: relative;
        overflow: hidden;
        padding: clamp(24px, 4vw, 36px);
        margin-bottom: 24px;
        border: 1px solid #edd5dd;
        border-radius: 22px;
        background: linear-gradient(120deg, #f6e4e9, #fff7f3 60%, #f3e6e8);
    }

    .pesanan-hero::after {
        content: "";
        position: absolute;
        top: -65px;
        right: -45px;
        width: 170px;
        height: 170px;
        border-radius: 50%;
        background: rgba(183, 125, 139, .12);
        pointer-events: none;
    }

    .pesanan-eyebrow {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
        color: var(--pink-dark);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .12em;
        text-transform: uppercase;
    }

    .pesanan-eyebrow::before {
        content: "";
        width: 22px;
        height: 2px;
        border-radius: 2px;
        background: var(--pink);
    }

    .pesanan-title {
        position: relative;
        z-index: 1;
        margin: 0 0 10px;
        color: #3e2930;
        font-size: clamp(25px, 3vw, 34px);
        font-weight: 800;
        line-height: 1.25;
        letter-spacing: -.035em;
    }

    .pesanan-subtitle {
        position: relative;
        z-index: 1;
        max-width: 720px;
        margin: 0;
        color: #785e66;
        font-size: 14px;
        line-height: 1.8;
    }

    .pesanan-card {
        padding: clamp(18px, 3vw, 30px);
        border: 1px solid var(--border);
        border-radius: 20px;
        background: var(--cream);
        box-shadow: 0 10px 30px rgba(104, 63, 76, .055);
    }

    .pesanan-section + .pesanan-section {
        margin-top: 32px;
        padding-top: 28px;
        border-top: 1px solid #f0e1e5;
    }

    .section-heading {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        margin-bottom: 22px;
    }

    .section-number {
        display: inline-flex;
        flex: 0 0 38px;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: var(--pink-soft);
        color: var(--pink-dark);
        font-size: 14px;
        font-weight: 800;
    }

    .section-title {
        margin: 0 0 5px;
        color: var(--ink);
        font-size: 18px;
        font-weight: 800;
    }

    .section-description {
        margin: 0;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.6;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 21px 20px;
    }

    .form-group {
        min-width: 0;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .pesanan-page .form-label {
        display: block;
        margin-bottom: 8px;
        color: #533c43;
        font-size: 13px;
        font-weight: 750;
    }

    .required {
        color: #b75d75;
    }

    .pesanan-page .form-control,
    .pesanan-page .form-select,
    .pesanan-page textarea {
        display: block;
        width: 100%;
        min-height: 46px;
        padding: 12px 14px;
        border: 1px solid #e5cbd4;
        border-radius: 11px;
        outline: none;
        background: #fff;
        color: var(--ink);
        font-family: inherit;
        font-size: 14px;
        line-height: 1.5;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .pesanan-page .form-control:focus,
    .pesanan-page .form-select:focus,
    .pesanan-page textarea:focus {
        border-color: var(--pink);
        box-shadow: 0 0 0 4px rgba(183, 125, 139, .13);
    }

    .pesanan-page textarea {
        min-height: 112px;
        resize: vertical;
    }

    .pesanan-page .form-control::placeholder,
    .pesanan-page textarea::placeholder {
        color: #b09ba1;
    }

    .form-help {
        display: block;
        margin-top: 7px;
        color: #947c83;
        font-size: 12px;
        line-height: 1.6;
    }

    .error-box {
        margin-bottom: 24px;
        padding: 16px 18px;
        border: 1px solid #efb9c4;
        border-radius: 13px;
        background: #fff0f2;
        color: #963f55;
        font-size: 13px;
    }

    .error-box strong {
        display: block;
        margin-bottom: 8px;
    }

    .error-box ul {
        margin: 0;
        padding-left: 20px;
        line-height: 1.8;
    }

    .referensi-info {
        margin: -5px 0 19px;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.7;
    }

    .referensi-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    .referensi-option {
        position: relative;
        min-width: 0;
    }

    .referensi-radio {
        position: absolute;
        width: 1px;
        height: 1px;
        opacity: 0;
        pointer-events: none;
    }

    .referensi-card {
        display: flex;
        height: 100%;
        flex-direction: column;
        overflow: hidden;
        border: 2px solid #efdee3;
        border-radius: 15px;
        background: #fff;
        cursor: pointer;
        transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease;
    }

    .referensi-card:hover {
        transform: translateY(-3px);
        border-color: #d4a5b1;
        box-shadow: 0 9px 22px rgba(104, 63, 76, .09);
    }

    .referensi-radio:focus-visible + .referensi-card {
        outline: 3px solid rgba(183, 125, 139, .4);
        outline-offset: 3px;
    }

    .referensi-radio:checked + .referensi-card {
        border-color: var(--pink);
        box-shadow: 0 0 0 3px rgba(183, 125, 139, .13);
    }

    .referensi-image-wrap {
        position: relative;
        overflow: hidden;
        background: #f7eaee;
    }

    .referensi-image {
        display: block;
        width: 100%;
        height: 180px;
        object-fit: cover;
        transition: transform .25s ease;
    }

    .referensi-card:hover .referensi-image {
        transform: scale(1.035);
    }

    .referensi-check {
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border: 2px solid rgba(255, 255, 255, .9);
        border-radius: 50%;
        background: #fff;
        color: transparent;
        font-size: 15px;
        font-weight: 800;
        box-shadow: 0 2px 8px rgba(55, 30, 38, .12);
    }

    .referensi-radio:checked + .referensi-card .referensi-check {
        background: var(--pink-dark);
        color: #fff;
    }

    .referensi-content {
        padding: 14px;
    }

    .referensi-name {
        margin-bottom: 6px;
        color: #4c343c;
        font-size: 14px;
        font-weight: 800;
    }

    .referensi-desc {
        margin: 0;
        color: #8b737b;
        font-size: 12px;
        line-height: 1.6;
    }

    .selected-reference {
        display: none;
        align-items: center;
        gap: 10px;
        margin-top: 16px;
        padding: 13px 15px;
        border: 1px solid #ead0d8;
        border-radius: 12px;
        background: #fbf0f3;
        color: #76505c;
        font-size: 13px;
        line-height: 1.6;
    }

    .selected-reference.show {
        display: flex;
    }

    .selected-reference-icon {
        display: inline-flex;
        flex: 0 0 28px;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 9px;
        background: #efd7df;
        color: var(--pink-dark);
        font-weight: 800;
    }

    .button-area {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 30px;
        padding-top: 24px;
        border-top: 1px solid #f0e1e5;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        min-height: 46px;
        padding: 12px 22px;
        border: 1px solid transparent;
        border-radius: 11px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s ease, transform .2s ease;
    }

    .btn-action:active {
        transform: translateY(1px);
    }

    .btn-submit {
        background: var(--pink);
        color: #fff;
        box-shadow: 0 5px 12px rgba(150, 94, 109, .18);
    }

    .btn-submit:hover {
        background: var(--pink-dark);
        color: #fff;
    }

    .btn-cancel {
        border-color: #e8d2d9;
        background: #fff;
        color: #785b64;
    }

    .btn-cancel:hover {
        background: #fbf0f3;
    }

    @media (max-width: 1000px) {
        .referensi-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 700px) {
        .form-grid {
            grid-template-columns: minmax(0, 1fr);
            gap: 18px;
        }

        .form-group.full {
            grid-column: auto;
        }

        .pesanan-card {
            border-radius: 16px;
        }

        .pesanan-hero {
            border-radius: 17px;
        }
    }

    @media (max-width: 480px) {
        .referensi-grid {
            grid-template-columns: minmax(0, 1fr);
        }

        .referensi-image {
            height: 215px;
        }

        .button-area {
            flex-direction: column-reverse;
        }

        .btn-action {
            width: 100%;
        }

        .section-heading {
            gap: 10px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .pesanan-page *,
        .pesanan-page *::before,
        .pesanan-page *::after {
            transition-duration: .01ms !important;
            animation-duration: .01ms !important;
        }
    }
</style>
@endsection

@section('content')
<div class="pesanan-page">

    <header class="pesanan-hero">
        <div class="pesanan-eyebrow">Layanan JAITIN</div>
        <h1 class="pesanan-title">Pesan Jasa Jahit</h1>
        <p class="pesanan-subtitle">
            Lengkapi detail pakaian, ukuran, dan tanggal penyelesaian yang
            diharapkan. Anda juga dapat memilih referensi model untuk membantu
            penjahit memahami kebutuhan Anda.
        </p>
    </header>

    <div class="pesanan-card">

        @if ($errors->any())
            <div class="error-box" role="alert" aria-live="polite">
                <strong>Periksa kembali data pesanan Anda:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pelanggan.pesanan.store') }}" method="POST">
            @csrf

            <section class="pesanan-section" aria-labelledby="informasi-pesanan-title">
                <div class="section-heading">
                    <span class="section-number">01</span>
                    <div>
                        <h2 class="section-title" id="informasi-pesanan-title">
                            Informasi Pesanan
                        </h2>
                        <p class="section-description">
                            Lengkapi jenis pakaian dan detail pengerjaan.
                        </p>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="jenis_pakaian">
                            Jenis Pakaian <span class="required">*</span>
                        </label>

                        <select id="jenis_pakaian" name="jenis_pakaian"
                                class="form-select" required>
                            <option value="">Pilih jenis pakaian</option>
                            @foreach (['Kebaya', 'Pakaian', 'Dress', 'Perbaikan Pakaian', 'Permak'] as $jenis)
                                <option value="{{ $jenis }}"
                                    @selected(old('jenis_pakaian') === $jenis)>
                                    {{ $jenis === 'Permak' ? 'Permak / Penyesuaian Ukuran' : $jenis }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="model_pakaian">Model Pakaian</label>
                        <input id="model_pakaian" type="text" name="model_pakaian"
                               class="form-control" value="{{ old('model_pakaian') }}"
                               placeholder="Contoh: Dress panjang lengan panjang">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="jumlah">
                            Jumlah <span class="required">*</span>
                        </label>
                        <input id="jumlah" type="number" name="jumlah"
                               class="form-control" value="{{ old('jumlah', 1) }}"
                               min="1" step="1" required>
                        <small class="form-help">
                            Masukkan jumlah pakaian yang ingin dijahit atau diperbaiki.
                        </small>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="tanggal_harapan">
                            Tanggal yang Diharapkan <span class="required">*</span>
                        </label>
                        <input id="tanggal_harapan" type="date" name="tanggal_harapan"
                               class="form-control" value="{{ old('tanggal_harapan') }}"
                               min="{{ now()->toDateString() }}" required>
                        <small class="form-help">
                            Pilih tanggal target penyelesaian pesanan Anda.
                        </small>
                    </div>

                    <div class="form-group full">
                        <label class="form-label" for="ukuran">
                            Ukuran <span class="required">*</span>
                        </label>
                        <textarea id="ukuran" name="ukuran"
                                  placeholder="Contoh: Lingkar dada 90 cm, panjang baju 65 cm, panjang lengan 55 cm"
                                  required>{{ old('ukuran') }}</textarea>
                        <small class="form-help">
                            Cantumkan ukuran dalam sentimeter bila memungkinkan.
                        </small>
                    </div>

                    <div class="form-group full">
                        <label class="form-label" for="catatan">Catatan Tambahan</label>
                        <textarea id="catatan" name="catatan"
                                  placeholder="Tuliskan detail tambahan, pilihan bahan, warna, atau permintaan khusus...">{{ old('catatan') }}</textarea>
                    </div>
                </div>
            </section>

            <section class="pesanan-section" aria-labelledby="referensi-title">
                <div class="section-heading">
                    <span class="section-number">02</span>
                    <div>
                        <h2 class="section-title" id="referensi-title">
                            Referensi Model dari Penjahit
                        </h2>
                        <p class="section-description">
                            Pilih contoh model yang paling mendekati keinginan Anda.
                        </p>
                    </div>
                </div>

                <p class="referensi-info">
                    Referensi bersifat opsional. Jika tidak ada model yang sesuai,
                    jelaskan model yang diinginkan pada kolom catatan tambahan.
                </p>

                {{-- Kedua field ini hanya menyimpan ID model dari database. --}}
                <input type="hidden" name="referensi_pilihan" id="referensi_pilihan"
                       value="{{ old('referensi_pilihan', old('model_katalog_id')) }}">

                <input type="hidden" name="model_katalog_id" id="model_katalog_id"
                       value="{{ old('model_katalog_id', old('referensi_pilihan')) }}">

                @php
                    $kartuReferensi = [
                        [
                            'judul' => 'Kebaya',
                            'kategori' => 'kebaya',
                            'gambar' => 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?auto=format&fit=crop&w=800&q=85',
                            'deskripsi' => 'Referensi busana kebaya untuk acara formal dan momen istimewa.',
                        ],
                        [
                            'judul' => 'Dress',
                            'kategori' => 'dress',
                            'gambar' => 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&w=800&q=85',
                            'deskripsi' => 'Referensi model dress untuk berbagai kesempatan.',
                        ],
                        [
                            'judul' => 'Pakaian',
                            'kategori' => 'pakaian',
                            'gambar' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=800&q=85',
                            'deskripsi' => 'Referensi pakaian yang dapat disesuaikan dengan kebutuhan.',
                        ],
                        [
                            'judul' => 'Perbaikan Pakaian',
                            'kategori' => 'perbaikan',
                            'gambar' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=800&q=85',
                            'deskripsi' => 'Referensi perbaikan atau perubahan pakaian.',
                        ],
                        [
                            'judul' => 'Permak',
                            'kategori' => 'permak',
                            'gambar' => 'https://placehold.co/800x500/f8eaf0/965e6d?text=Permak+Pakaian',
                            'deskripsi' => 'Referensi penyesuaian ukuran pakaian.',
                        ],
                        [
                            'judul' => 'Model Lainnya',
                            'kategori' => 'lainnya',
                            'gambar' => 'https://images.unsplash.com/photo-1551232864-3f0890e580d9?auto=format&fit=crop&w=800&q=85',
                            'deskripsi' => 'Inspirasi lain untuk didiskusikan dengan penjahit.',
                        ],
                    ];

                    $idPilihanLama = old('model_katalog_id', old('referensi_pilihan'));
                @endphp

                <div class="referensi-grid">
                    @foreach ($kartuReferensi as $kartu)
                        @php
                            $modelKartu = $referensiModel->first(function ($model) use ($kartu) {
                                $kategori = strtolower(trim((string) $model->kategori));
                                $nama = strtolower(trim((string) $model->nama_model));
                                $jenis = strtolower(trim((string) $model->jenis_model));

                                if ($kartu['kategori'] === 'lainnya') {
                                    return !in_array($kategori, [
                                        'kebaya', 'dress', 'pakaian',
                                        'perbaikan', 'perbaikan pakaian', 'permak'
                                    ], true);
                                }

                                if ($kartu['kategori'] === 'perbaikan') {
                                    return in_array($kategori, ['perbaikan', 'perbaikan pakaian'], true)
                                        || str_contains($nama, 'perbaikan');
                                }

                                if ($kartu['kategori'] === 'permak') {
                                    return $kategori === 'permak'
                                        || str_contains($nama, 'permak')
                                        || str_contains($nama, 'penyesuaian');
                                }

                                return $kategori === $kartu['kategori']
                                    || str_contains($nama, $kartu['kategori'])
                                    || str_contains($jenis, $kartu['kategori']);
                            });

                            $idModelKartu = $modelKartu?->id;
                            $isSelected = $idModelKartu !== null
                                && (string) $idPilihanLama === (string) $idModelKartu;
                        @endphp

                        <div class="referensi-option">
                            <input
                                type="radio"
                                class="referensi-radio"
                                id="referensi_kartu_{{ $loop->index }}"
                                name="referensi_kartu_tampilan"
                                value="{{ $idModelKartu ?? '' }}"
                                data-id="{{ $idModelKartu ?? '' }}"
                                data-nama="{{ $modelKartu?->nama_model ?? $kartu['judul'] }}"
                                data-kategori="{{ $kartu['kategori'] }}"
                                @checked($isSelected)
                            >

                            <label for="referensi_kartu_{{ $loop->index }}"
                                   class="referensi-card">
                                <div class="referensi-image-wrap">
                                    <img
                                        src="{{ $kartu['gambar'] }}"
                                        alt="Referensi {{ $kartu['judul'] }}"
                                        class="referensi-image"
                                        loading="lazy"
                                    >
                                    <span class="referensi-check" aria-hidden="true">✓</span>
                                </div>

                                <div class="referensi-content">
                                    <div class="referensi-name">{{ $kartu['judul'] }}</div>
                                    <p class="referensi-desc">{{ $kartu['deskripsi'] }}</p>

                                    @if (!$modelKartu)
                                        <small class="form-help">
                                            Kartu ini hanya sebagai inspirasi karena belum
                                            ada model aktif yang cocok di katalog.
                                        </small>
                                    @endif
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>

                <small class="form-help">
                    Klik kartu untuk memilih inspirasi. Jika kartu belum memiliki model
                    di katalog database, kamu tetap dapat mengirim pesanan tanpa referensi.
                </small>

                <div id="selectedReference" class="selected-reference" aria-live="polite">
                    <span class="selected-reference-icon" aria-hidden="true">✓</span>
                    <span>
                        Referensi dipilih:
                        <strong id="selectedReferenceName"></strong>
                    </span>
                </div>
            </section>

            <div class="button-area">
                <a href="{{ route('dashboard') }}" class="btn-action btn-cancel">
                    Batal
                </a>

                <button type="submit" class="btn-action btn-submit">
                    Kirim Pesanan <span aria-hidden="true">→</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const kartuRadios = document.querySelectorAll('.referensi-radio');
    const referensiPilihan = document.getElementById('referensi_pilihan');
    const modelKatalogId = document.getElementById('model_katalog_id');
    const selectedReference = document.getElementById('selectedReference');
    const selectedReferenceName = document.getElementById('selectedReferenceName');
    const dateInput = document.getElementById('tanggal_harapan');
    const jenisPakaian = document.getElementById('jenis_pakaian');

    function syncReferenceSelection(radio) {
        if (!radio) {
            referensiPilihan.value = '';
            modelKatalogId.value = '';
            selectedReferenceName.textContent = '';
            selectedReference.classList.remove('show');
            return;
        }

        const id = radio.dataset.id || '';

        // Jangan pernah mengirim label teks sebagai ID database.
        referensiPilihan.value = id;
        modelKatalogId.value = id;

        selectedReferenceName.textContent = radio.dataset.nama || 'Model dipilih';
        selectedReference.classList.add('show');

        const jenisMap = {
            kebaya: 'Kebaya',
            dress: 'Dress',
            pakaian: 'Pakaian',
            perbaikan: 'Perbaikan Pakaian',
            permak: 'Permak'
        };

        if (jenisMap[radio.dataset.kategori]) {
            jenisPakaian.value = jenisMap[radio.dataset.kategori];
        }
    }

    kartuRadios.forEach(function (radio) {
        radio.addEventListener('change', function () {
            syncReferenceSelection(radio);
        });
    });

    // Pulihkan pilihan jika halaman dibuka kembali setelah validasi gagal.
    const pilihanTersimpan = document.querySelector('.referensi-radio:checked');

    if (pilihanTersimpan) {
        syncReferenceSelection(pilihanTersimpan);
    } else {
        syncReferenceSelection(null);
    }

    if (dateInput) {
        const today = new Date();
        dateInput.min = [
            today.getFullYear(),
            String(today.getMonth() + 1).padStart(2, '0'),
            String(today.getDate()).padStart(2, '0')
        ].join('-');
    }
});
</script>
@endsection