```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ukuran - Jaitin</title>
    <style>
        * { box-sizing: border-box; font-family: Arial, sans-serif; }
        body { margin: 0; background: #f8f1eb; color: #4b3832; }
        .container { max-width: 850px; margin: 35px auto; padding: 0 20px; }
        .card { background: #fffaf5; padding: 28px; border: 1px solid #ead6ca;
                border-radius: 15px; box-shadow: 0 4px 12px rgba(120,90,80,.06); }
        h1 { margin: 0 0 8px; font-size: 26px; }
        .subtitle { color: #806e69; margin-bottom: 25px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .field { display: flex; flex-direction: column; gap: 8px; }
        .field.full { grid-column: 1 / -1; }
        label { font-size: 14px; font-weight: bold; }
        input, select { width: 100%; padding: 12px; border: 1px solid #dfc9bd;
                        border-radius: 8px; background: white; color: #4b3832; }
        .actions { display: flex; gap: 10px; margin-top: 25px; }
        .btn { display: inline-block; border: 0; border-radius: 8px; padding: 12px 18px;
               text-decoration: none; cursor: pointer; font-size: 14px; }
        .btn-save { background: #b8898d; color: white; }
        .btn-back { background: #ead6ca; color: #5d4843; }
        .errors { margin-bottom: 20px; padding: 12px; border-radius: 8px;
                  background: #f8dddd; color: #8f4f55; }
        @media (max-width: 600px) {
            .form-grid { grid-template-columns: 1fr; }
            .field.full { grid-column: auto; }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Edit Ukuran Pelanggan</h1>
        <p class="subtitle">Perbarui data ukuran pelanggan Jaitin.</p>

        @if ($errors->any())
            <div class="errors">
                <strong>Periksa kembali data berikut:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.ukuran.update', $ukuran->id_ukuran) }}"
              method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="field full">
                    <label for="id_user">Nama Pelanggan</label>
                    <select name="id_user" id="id_user" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach ($pelanggan as $p)
                            <option value="{{ $p->id_user }}"
                                {{ old('id_user', $ukuran->id_user) == $p->id_user ? 'selected' : '' }}>
                                {{ $p->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <label for="panjang_baju">Panjang Baju</label>
                    <input type="number" step="0.01" min="0" name="panjang_baju"
                           id="panjang_baju"
                           value="{{ old('panjang_baju', $ukuran->panjang_baju) }}">
                </div>

                <div class="field">
                    <label for="lebar_bahu">Lebar Bahu</label>
                    <input type="number" step="0.01" min="0" name="lebar_bahu"
                           id="lebar_bahu"
                           value="{{ old('lebar_bahu', $ukuran->lebar_bahu) }}">
                </div>

                <div class="field">
                    <label for="lingkar_dada">Lingkar Dada</label>
                    <input type="number" step="0.01" min="0" name="lingkar_dada"
                           id="lingkar_dada"
                           value="{{ old('lingkar_dada', $ukuran->lingkar_dada) }}">
                </div>

                <div class="field">
                    <label for="lingkar_pinggang">Lingkar Pinggang</label>
                    <input type="number" step="0.01" min="0" name="lingkar_pinggang"
                           id="lingkar_pinggang"
                           value="{{ old('lingkar_pinggang', $ukuran->lingkar_pinggang) }}">
                </div>

                <div class="field">
                    <label for="lingkar_lengan">Lingkar Lengan</label>
                    <input type="number" step="0.01" min="0" name="lingkar_lengan"
                           id="lingkar_lengan"
                           value="{{ old('lingkar_lengan', $ukuran->lingkar_lengan) }}">
                </div>

                <div class="field">
                    <label for="tanggal">Tanggal Pengukuran</label>
                    <input type="date" name="tanggal" id="tanggal"
                           value="{{ old('tanggal', $ukuran->tanggal ? \Carbon\Carbon::parse($ukuran->tanggal)->format('Y-m-d') : '') }}"
                           required>
                </div>
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-save">Simpan Perubahan</button>
                <a href="{{ route('admin.ukuran.index') }}" class="btn btn-back">Kembali</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
```