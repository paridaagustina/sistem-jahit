
@extends('layouts.pelanggan')

@section('title', 'Pembayaran Pesanan - JAITIN')
@section('page-title', 'Pembayaran Pesanan')
@section('page-description', 'Selesaikan pembayaran pesanan jahitan Anda dengan aman.')

@section('styles')
<style>
    .pay-page {
        max-width: 760px;
        margin: 0 auto;
        color: #4b3832;
    }

    .pay-card {
        padding: 28px;
        border: 1px solid #ead6ca;
        border-radius: 20px;
        background: #fffaf5;
        box-shadow: 0 8px 24px rgba(92, 61, 54, .06);
    }

    .pay-icon {
        display: grid;
        place-items: center;
        width: 58px;
        height: 58px;
        margin-bottom: 18px;
        border-radius: 17px;
        background: #f4e3e3;
        font-size: 27px;
    }

    .pay-card h2 {
        margin: 0 0 8px;
        font-size: 23px;
    }

    .pay-description {
        margin: 0 0 24px;
        color: #806e69;
        line-height: 1.7;
        font-size: 14px;
    }

    .pay-details {
        margin-bottom: 23px;
        padding: 18px;
        border: 1px solid #efdfd6;
        border-radius: 13px;
        background: #fff;
    }

    .pay-row {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        padding: 11px 0;
        border-bottom: 1px solid #f1e8e3;
        font-size: 13px;
    }

    .pay-row:last-child {
        border-bottom: 0;
    }

    .pay-label {
        color: #806e69;
    }

    .pay-value {
        font-weight: 700;
        text-align: right;
        overflow-wrap: anywhere;
    }

    .pay-total {
        color: #9f7378;
        font-size: 21px;
    }

    .pay-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .pay-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 19px;
        border: 0;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    .pay-btn-primary {
        flex: 1;
        background: #b8898d;
        color: #fff;
    }

    .pay-btn-primary:hover {
        background: #9f7378;
    }

    .pay-btn-secondary {
        background: #f1e6df;
        color: #654e48;
    }

    .pay-note {
        margin-top: 18px;
        color: #806e69;
        font-size: 12px;
        line-height: 1.7;
    }

    @media (max-width: 500px) {
        .pay-card { padding: 19px; }
        .pay-row { align-items: flex-start; }
        .pay-total { font-size: 18px; }
        .pay-actions { flex-direction: column; }
        .pay-btn { width: 100%; }
    }
</style>
@endsection

@section('content')
<div class="pay-page">
    <div class="pay-card">
        <div class="pay-icon">💳</div>

        <h2>Konfirmasi Pembayaran</h2>
        <p class="pay-description">
            Periksa detail pesanan sebelum melanjutkan ke pembayaran online.
        </p>

        <div class="pay-details">
            <div class="pay-row">
                <span class="pay-label">Nomor pesanan</span>
                <span class="pay-value">#{{ $pesanan->id_pesanan }}</span>
            </div>

            <div class="pay-row">
                <span class="pay-label">Jenis pakaian</span>
                <span class="pay-value">{{ $pesanan->jenis_pakaian ?? '-' }}</span>
            </div>

            <div class="pay-row">
                <span class="pay-label">Jenis pembayaran</span>
                <span class="pay-value">
                    {{ $jumlahBayar < (float) ($pesanan->total_harga ?? 0) ? 'Uang muka (DP)' : 'Pelunasan' }}
                </span>
            </div>

            <div class="pay-row">
                <span class="pay-label">ID transaksi</span>
                <span class="pay-value">{{ $orderId }}</span>
            </div>

            <div class="pay-row">
                <span class="pay-label">Total yang dibayar</span>
                <span class="pay-value pay-total">
                    Rp {{ number_format($jumlahBayar, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <div class="pay-actions">
            <button type="button" id="btn-bayar" class="pay-btn pay-btn-primary">
                Bayar Sekarang →
            </button>

            <a href="{{ route('pelanggan.pesanan.index') }}"
               class="pay-btn pay-btn-secondary">
                Kembali ke Pesanan
            </a>
        </div>

        <p class="pay-note">
            Pembayaran diproses melalui Midtrans. Status transaksi akan diperbarui
            setelah sistem menerima konfirmasi pembayaran dari penyedia layanan.
        </p>
    </div>
</div>
@endsection

@section('scripts')
@if($isProduction)
    <script src="https://app.midtrans.com/snap/snap.js"
        data-client-key="{{ $clientKey }}"></script>
@else
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ $clientKey }}"></script>
@endif

<script>
    document.getElementById('btn-bayar').addEventListener('click', function () {
        if (typeof window.snap === 'undefined') {
            alert('Layanan pembayaran belum tersedia. Silakan coba kembali.');
            return;
        }

        window.snap.pay(@json($snapToken), {
            onSuccess: function () {
                window.location.href = @json(route('pelanggan.pembayaran.index'));
            },
            onPending: function () {
                window.location.href = @json(route('pelanggan.pembayaran.index'));
            },
            onError: function () {
                alert('Pembayaran gagal diproses. Silakan coba kembali.');
            },
            onClose: function () {
                // Popup ditutup tanpa menyelesaikan pembayaran.
                // Pelanggan tetap berada di halaman pembayaran.
            }
        });
    });
</script>
@endsection
