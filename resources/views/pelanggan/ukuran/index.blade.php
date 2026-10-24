 @extends('layouts.pelanggan')

@section('title', 'Ukuran Saya - JAITIN')
@section('page-title', 'Ukuran Saya')
@section('page-description', 'Simpan dan kelola ukuran tubuh untuk mempermudah proses pemesanan jahitan.')

@section('styles')
<style>
    .ukuran-page {
        color: #493a37;
        padding-bottom: 30px;
    }

    .ukuran-hero {
        position: relative;
        overflow: hidden;
        padding: 28px;
        margin-bottom: 24px;
        border-radius: 22px;
        background: linear-gradient(125deg, #f3dadd, #fff3ed 72%);
        border: 1px solid #efd8d8;
    }

    .ukuran-hero::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        right: -45px;
        top: -70px;
        border-radius: 50%;
        background: rgba(184, 137, 141, .13);
    }

    .ukuran-hero h2 {
        margin: 0 0 9px;
        font-size: 25px;
        font-weight: 750;
        color: #754e53;
    }

    .ukuran-hero p {
        max-width: 600px;
        margin: 0;
        color: #775f5c;
        line-height: 1.7;
        font-size: 14px;
    }

    .ukuran-layout {
        display: grid;
        grid-template-columns: minmax(300px, .85fr) minmax(0, 1.5fr);
        gap: 22px;
        align-items: start;
    }

    .ukuran-card {
        background: #fffdfb;
        border: 1px solid #eee4df;
        border-radius: 18px;
        padding: 23px;
        box-shadow: 0 5px 18px rgba(91, 60, 52, .045);
        min-width: 0;
    }

    .ukuran-card-header {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 21px;
    }

    .ukuran-icon {
        display: grid;
        place-items: center;
        flex: 0 0 44px;
        width: 44px;
        height: 44px;
        border-radius: 13px;
        background: #f7e5e6;
        color: #986a70;
        font-size: 21px;
    }

    .ukuran-card-header h3 {
        margin: 2px 0 5px;
        font-size: 17px;
        font-weight: 750;
        color: #533e3c;
    }

    .ukuran-card-header p {
        margin: 0;
        color: #927e78;
        font-size: 12px;
        line-height: 1.5;
    }

    .ukuran-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px 13px;
    }

    .ukuran-field {
        min-width: 0;
    }

    .ukuran-field.full {
        grid-column: 1 / -1;
    }

    .ukuran-field label {
        display: block;
        margin-bottom: 7px;
        color: #66504b;
        font-size: 12px;
        font-weight: 700;
    }

    .ukuran-field input {
        display: block;
        width: 100%;
        min-width: 0;
        padding: 11px 12px;
        border: 1px solid #e8d9d3;
        border-radius: 10px;
        outline: none;
        background: #fff;
        color: #493a37;
        font: inherit;
        font-size: 13px;
        transition: .2s;
    }

    .ukuran-field input:focus {
        border-color: #b8898d;
        box-shadow: 0 0 0 3px rgba(184, 137, 141, .13);
    }

    .ukuran-field input::placeholder {
        color: #b5a39d;
    }

    .ukuran-field small {
        display: block;
        margin-top: 5px;
        color: #a18c85;
        font-size: 11px;
    }

    .ukuran-actions {
        display: flex;
        gap: 9px;
        margin-top: 22px;
    }

    .btn-ukuran {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 7px;
        padding: 11px 15px;
        border: 0;
        border-radius: 10px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 750;
        cursor: pointer;
        transition: .2s;
    }

    .btn-ukuran:hover {
        transform: translateY(-1px);
        filter: brightness(.97);
    }

    .btn-primary-ukuran {
        flex: 1;
        background: #a9787d;
        color: #fff;
    }

    .btn-secondary-ukuran {
        background: #f4ebe7;
        color: #765d57;
    }

    .btn-edit-ukuran {
        background: #f7e8d4;
        color: #8c6337;
    }

    .btn-delete-ukuran {
        background: #fae5e5;
        color: #a14d51;
    }

    .ukuran-alert {
        padding: 13px 16px;
        border-radius: 12px;
        margin-bottom: 18px;
        font-size: 13px;
        line-height: 1.6;
    }

    .ukuran-alert.success {
        color: #276449;
        background: #e9f7ef;
        border: 1px solid #ccebd8;
    }

    .ukuran-alert.error {
        color: #9c4148;
        background: #fff0f0;
        border: 1px solid #f3d0d0;
    }

    .ukuran-alert ul {
        padding-left: 19px;
        margin: 5px 0 0;
    }

    .ukuran-history-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 19px;
    }

    .ukuran-history-top h3 {
        margin: 0 0 5px;
        font-size: 17px;
        color: #533e3c;
    }

    .ukuran-history-top p {
        margin: 0;
        color: #927e78;
        font-size: 12px;
    }

    .ukuran-count {
        padding: 7px 11px;
        border-radius: 30px;
        color: #895d63;
        background: #f8e8e9;
        font-size: 11px;
        font-weight: 750;
    }

    .ukuran-table-wrap {
        overflow-x: auto;
        border: 1px solid #eee5e0;
        border-radius: 12px;
    }

    .ukuran-table {
        width: 100%;
        border-collapse: collapse;
        white-space: nowrap;
        font-size: 12px;
    }

    .ukuran-table th {
        padding: 13px 12px;
        background: #faf1ed;
        color: #795e58;
        font-weight: 750;
        text-align: left;
    }

    .ukuran-table td {
        padding: 14px 12px;
        border-top: 1px solid #f1e8e3;
        color: #68534d;
        vertical-align: middle;
    }

    .ukuran-table tbody tr:hover {
        background: #fffaf7;
    }

    .ukuran-table .aksi-cell {
        display: flex;
        gap: 6px;
        align-items: center;
    }

    .ukuran-table .btn-ukuran {
        padding: 8px 10px;
        font-size: 11px;
    }

    .ukuran-empty {
        padding: 38px 18px;
        text-align: center;
        border: 1px dashed #e5d2cd;
        border-radius: 14px;
        background: #fffbf8;
    }

    .ukuran-empty .empty-icon {
        display: grid;
        place-items: center;
        width: 58px;
        height: 58px;
        margin: 0 auto 13px;
        border-radius: 18px;
        background: #f7e5e6;
        color: #a9787d;
        font-size: 25px;
    }

    .ukuran-empty h4 {
        margin: 0 0 7px;
        color: #624946;
        font-size: 15px;
    }

    .ukuran-empty p {
        max-width: 320px;
        margin: 0 auto;
        color: #95817b;
        font-size: 12px;
        line-height: 1.7;
    }

    .ukuran-note {
        margin-top: 18px;
        padding: 13px 15px;
        border-radius: 12px;
        background: #fbf4e9;
        color: #81694c;
        font-size: 12px;
        line-height: 1.7;
    }

    @media (max-width: 1100px) {
        .ukuran-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .ukuran-hero {
            padding: 22px 18px;
            border-radius: 17px;
        }

        .ukuran-hero h2 {
            font-size: 21px;
        }

        .ukuran-card {
            padding: 17px;
        }

        .ukuran-form-grid {
            grid-template-columns: 1fr;
        }

        .ukuran-field.full {
            grid-column: auto;
        }

        .ukuran-actions {
            flex-direction: column;
        }

        .ukuran-actions .btn-ukuran {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="ukuran-page">
    <div class="ukuran-hero">
        <h2>Ukuran tubuh, jahitan lebih pas ✨</h2>
        <p>
            Kelola catatan ukuran tubuhmu di satu tempat. Gunakan data ini sebagai
            referensi saat memesan pakaian di JAITIN.
        </p>
    </div>

    @if(session('success'))
        <div class="ukuran-alert success">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="ukuran-alert error">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="ukuran-alert error">
            <strong>Periksa kembali data yang kamu masukkan.</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="ukuran-layout">
        <section class="ukuran-card">
            <div class="ukuran-card-header">
                <div class="ukuran-icon">📏</div>
                <div>
                    <h3 id="form-title">Tambah Ukuran</h3>
                    <p>Masukkan ukuran tubuh dalam satuan sentimeter (cm).</p>
                </div>
            </div>

            <form id="form-ukuran" action="{{ route('pelanggan.ukuran.store') }}" method="POST">
                @csrf

                <div class="ukuran-form-grid">
                    <div class="ukuran-field full">
                        <label for="tanggal">Tanggal pencatatan *</label>
                        <input
                            type="date"
                            name="tanggal"
                            id="tanggal"
                            value="{{ old('tanggal', now()->format('Y-m-d')) }}"
                            required
                        >
                    </div>

                    <div class="ukuran-field">
                        <label for="panjang_baju">Panjang baju (cm)</label>
                        <input type="number" step="0.1" min="0.1" max="500"
                            name="panjang_baju" id="panjang_baju"
                            value="{{ old('panjang_baju') }}" placeholder="Contoh: 70">
                    </div>

                    <div class="ukuran-field">
                        <label for="lebar_bahu">Lebar bahu (cm)</label>
                        <input type="number" step="0.1" min="0.1" max="200"
                            name="lebar_bahu" id="lebar_bahu"
                            value="{{ old('lebar_bahu') }}" placeholder="Contoh: 42">
                    </div>

                    <div class="ukuran-field">
                        <label for="lingkar_dada">Lingkar dada (cm)</label>
                        <input type="number" step="0.1" min="0.1" max="300"
                            name="lingkar_dada" id="lingkar_dada"
                            value="{{ old('lingkar_dada') }}" placeholder="Contoh: 92">
                    </div>

                    <div class="ukuran-field">
                        <label for="lingkar_pinggang">Lingkar pinggang (cm)</label>
                        <input type="number" step="0.1" min="0.1" max="300"
                            name="lingkar_pinggang" id="lingkar_pinggang"
                            value="{{ old('lingkar_pinggang') }}" placeholder="Contoh: 78">
                    </div>

                    <div class="ukuran-field full">
                        <label for="lingkar_lengan">Lingkar lengan (cm)</label>
                        <input type="number" step="0.1" min="0.1" max="200"
                            name="lingkar_lengan" id="lingkar_lengan"
                            value="{{ old('lingkar_lengan') }}" placeholder="Contoh: 32">
                    </div>
                </div>

                <div class="ukuran-actions">
                    <button type="submit" class="btn-ukuran btn-primary-ukuran" id="btn-submit">
                        <span>＋</span> Simpan Ukuran
                    </button>
                    <button type="button" class="btn-ukuran btn-secondary-ukuran"
                        id="btn-reset" onclick="resetFormUkuran()" style="display:none">
                        Batal Edit
                    </button>
                </div>
            </form>

            <div class="ukuran-note">
                💡 <strong>Tips:</strong> Ukur tubuh menggunakan pita ukur dan pastikan
                pita tidak terlalu ketat. Isi setidaknya satu ukuran tubuh.
            </div>
        </section>

        <section class="ukuran-card">
            <div class="ukuran-history-top">
                <div>
                    <h3>Riwayat Ukuran</h3>
                    <p>Catatan ukuran tubuh yang sudah kamu simpan.</p>
                </div>
                <span class="ukuran-count">{{ $ukuran->count() }} catatan</span>
            </div>

            @if($ukuran->isNotEmpty())
                <div class="ukuran-table-wrap">
                    <table class="ukuran-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Panjang Baju</th>
                                <th>Lebar Bahu</th>
                                <th>Lingkar Dada</th>
                                <th>Lingkar Pinggang</th>
                                <th>Lingkar Lengan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ukuran as $item)
                                <tr>
                                    <td>
                                        {{ \Illuminate\Support\Carbon::parse($item->tanggal)->format('d M Y') }}
                                    </td>
                                    <td>{{ $item->panjang_baju ?? '—' }} cm</td>
                                    <td>{{ $item->lebar_bahu ?? '—' }} cm</td>
                                    <td>{{ $item->lingkar_dada ?? '—' }} cm</td>
                                    <td>{{ $item->lingkar_pinggang ?? '—' }} cm</td>
                                    <td>{{ $item->lingkar_lengan ?? '—' }} cm</td>
                                    <td>
                                        <div class="aksi-cell">
                                            <button
                                                type="button"
                                                class="btn-ukuran btn-edit-ukuran"
                                                onclick="editUkuran(this)"
                                                data-id="{{ $item->id_ukuran }}"
                                                data-tanggal="{{ $item->tanggal }}"
                                                data-panjang_baju="{{ $item->panjang_baju }}"
                                                data-lebar_bahu="{{ $item->lebar_bahu }}"
                                                data-lingkar_dada="{{ $item->lingkar_dada }}"
                                                data-lingkar_pinggang="{{ $item->lingkar_pinggang }}"
                                                data-lingkar_lengan="{{ $item->lingkar_lengan }}"
                                            >Edit</button>

                                            <form action="{{ route('pelanggan.ukuran.destroy', $item->id_ukuran) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus catatan ukuran ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-ukuran btn-delete-ukuran">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="ukuran-empty">
                    <div class="empty-icon">📐</div>
                    <h4>Belum ada ukuran tersimpan</h4>
                    <p>
                        Tambahkan ukuran tubuh melalui formulir di samping.
                        Catatan yang kamu simpan akan tampil di bagian ini.
                    </p>
                </div>
            @endif
        </section>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const formUkuran = document.getElementById('form-ukuran');
    const formUkuranDefaultAction = @json(route('pelanggan.ukuran.store'));

    function editUkuran(button) {
        const data = button.dataset;

        formUkuran.action = @json(url('/ukuran-saya')) + '/' + encodeURIComponent(data.id);

        let methodInput = formUkuran.querySelector('input[name="_method"]');

        if (!methodInput) {
            methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            formUkuran.appendChild(methodInput);
        }

        methodInput.value = 'PUT';

        document.getElementById('form-title').textContent = 'Edit Ukuran';
        document.getElementById('btn-submit').innerHTML = '✓ Perbarui Ukuran';
        document.getElementById('btn-reset').style.display = 'inline-flex';

        ['tanggal', 'panjang_baju', 'lebar_bahu', 'lingkar_dada',
         'lingkar_pinggang', 'lingkar_lengan'].forEach(function(field) {
            document.getElementById(field).value = data[field] || '';
        });

        document.getElementById('form-title').scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }

    function resetFormUkuran() {
        formUkuran.reset();
        formUkuran.action = formUkuranDefaultAction;

        const methodInput = formUkuran.querySelector('input[name="_method"]');
        if (methodInput) {
            methodInput.remove();
        }

        document.getElementById('tanggal').value =
            new Date().toLocaleDateString('en-CA');

        document.getElementById('form-title').textContent = 'Tambah Ukuran';
        document.getElementById('btn-submit').innerHTML = '<span>＋</span> Simpan Ukuran';
        document.getElementById('btn-reset').style.display = 'none';
    }
</script>
@endsection