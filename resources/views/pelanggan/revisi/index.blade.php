@extends('layouts.app')

@section('content')
<style>
    .riwayat-revisi {
        padding: 30px;
        background: #fffaf7;
        min-height: 80vh;
        color: #59464a;
    }

    .revisi-header {
        margin-bottom: 25px;
    }

    .revisi-header h2 {
        color: #805b65;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .revisi-header p {
        color: #927d81;
        margin-bottom: 0;
    }

    .revisi-card {
        background: #ffffff;
        border: 1px solid #f0dfe2;
        border-radius: 16px;
        padding: 22px;
        margin-bottom: 18px;
        box-shadow: 0 4px 14px rgba(128, 91, 101, 0.06);
    }

    .revisi-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        padding-bottom: 15px;
        border-bottom: 1px solid #f4e8e9;
        margin-bottom: 18px;
    }

    .revisi-card-header h5 {
        color: #805b65;
        font-weight: 700;
        margin: 0;
    }

    .revisi-id {
        background: #f8e8eb;
        color: #805b65;
        border-radius: 20px;
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .revisi-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .revisi-label {
        color: #a18b90;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .revisi-value {
        color: #59464a;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .revisi-keterangan {
        background: #fff7f5;
        border-radius: 10px;
        padding: 14px;
        margin-top: 18px;
    }

    .revisi-empty {
        background: #ffffff;
        border: 1px dashed #e7cbd1;
        border-radius: 16px;
        text-align: center;
        padding: 55px 20px;
    }

    .revisi-empty h5 {
        color: #805b65;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .revisi-empty p {
        color: #927d81;
        margin-bottom: 20px;
    }

    .btn-revisi {
        display: inline-block;
        background: #c58f9d;
        color: #ffffff;
        padding: 10px 18px;
        border-radius: 9px;
        text-decoration: none;
        font-weight: 600;
    }

    .btn-revisi:hover {
        background: #ae7484;
        color: #ffffff;
    }

    @media (max-width: 600px) {
        .riwayat-revisi {
            padding: 18px;
        }

        .revisi-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="riwayat-revisi">
    <div class="revisi-header">
        <h2>Riwayat Revisi</h2>
        <p>Lihat riwayat revisi dan informasi perubahan pesanan jahitmu.</p>
    </div>

    @if(isset($revisi) && $revisi->count() > 0)

        @foreach($revisi as $item)
            <div class="revisi-card">

                <div class="revisi-card-header">
                    <h5>
                        {{ $item->pesanan->jenis_pakaian ?? 'Pesanan Jahit' }}
                    </h5>

                    <span class="revisi-id">
                        Revisi #{{ $item->id_revisi }}
                    </span>
                </div>

                <div class="revisi-grid">
                    <div>
                        <div class="revisi-label">Nomor Pesanan</div>
                        <div class="revisi-value">
                            #{{ $item->id_pesanan }}
                        </div>
                    </div>

                    <div>
                        <div class="revisi-label">Tanggal Revisi</div>
                        <div class="revisi-value">
                            {{ $item->tanggal_revisi
                                ? $item->tanggal_revisi->format('d-m-Y H:i')
                                : 'Belum tersedia' }}
                        </div>
                    </div>

                    <div>
                        <div class="revisi-label">Biaya Revisi</div>
                        <div class="revisi-value">
                            {{ $item->biaya_revisi !== null
                                ? 'Rp ' . number_format((float) $item->biaya_revisi, 0, ',', '.')
                                : 'Belum ditentukan' }}
                        </div>
                    </div>

                    <div>
                        <div class="revisi-label">Batas Waktu Revisi</div>
                        <div class="revisi-value">
                            {{ $item->batas_waktu_revisi
                                ? $item->batas_waktu_revisi->format('d-m-Y')
                                : 'Belum ditentukan' }}
                        </div>
                    </div>
                </div>

                <div class="revisi-keterangan">
                    <div class="revisi-label">Keterangan Revisi</div>
                    <div class="revisi-value">
                        {{ $item->keterangan ?: 'Belum ada keterangan revisi.' }}
                    </div>
                </div>

            </div>
        @endforeach

    @else
        <div class="revisi-empty">
            <h5>Belum Ada Riwayat Revisi</h5>
            <p>
                Riwayat revisi pesananmu akan muncul di sini
                apabila sudah tercatat dalam sistem.
            </p>

            <a href="{{ route('pelanggan.pesanan.index') }}"
               class="btn-revisi">
                Lihat Pesanan Saya
            </a>
        </div>
    @endif
</div>
@endsection