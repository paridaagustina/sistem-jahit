<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pembayaran - Jaitin</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f7f2f0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .payment-card {
            width: 100%;
            max-width: 600px;
            background: white;
            border-radius: 18px;
            padding: 35px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 70px;
            height: 70px;
            object-fit: contain;
        }

        h1 {
            text-align: center;
            color: #4d3b3b;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #777;
            margin-bottom: 30px;
        }

        .detail {
            background: #faf7f5;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .label {
            color: #777;
        }

        .value {
            font-weight: 600;
            color: #4d3b3b;
        }

        .total {
            font-size: 22px;
            color: #9b6f68;
        }

        #pay-button {
            width: 100%;
            border: none;
            border-radius: 10px;
            padding: 15px;
            background: #b98f89;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        #pay-button:hover {
            background: #9f736d;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #777;
            text-decoration: none;
        }
    </style>

    <script
        type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}">
    </script>
</head>

<body>

<div class="payment-card">

    <div class="logo">
        <img src="{{ asset('images/logo-jaitin.png') }}" alt="Jaitin">
    </div>

    <h1>Pembayaran Pesanan</h1>

    <p class="subtitle">
        Silakan lanjutkan pembayaran pesanan jahit Anda.
    </p>

    <div class="detail">

        <div class="detail-row">
            <span class="label">No. Pesanan</span>
            <span class="value">
                #{{ $pesanan->id_pesanan }}
            </span>
        </div>

        <div class="detail-row">
            <span class="label">Pelanggan</span>
            <span class="value">
                {{ $pesanan->user->nama ?? '-' }}
            </span>
        </div>

        <div class="detail-row">
            <span class="label">Jenis Pakaian</span>
            <span class="value">
                {{ $pesanan->jenis_pakaian }}
            </span>
        </div>

        <div class="detail-row">
            <span class="label">Jumlah</span>
            <span class="value">
                {{ $pesanan->jumlah }}
            </span>
        </div>

        <div class="detail-row">
            <span class="label">Jumlah Pembayaran</span>
            <span class="value total">
                Rp {{ number_format($jumlahBayar, 0, ',', '.') }}
            </span>
        </div>

    </div>

    <button id="pay-button">
        Bayar Sekarang
    </button>

    <a href="{{ route('admin.pesanan.index') }}" class="back">
        ← Kembali ke Data Pesanan
    </a>

</div>

<script>
    document.getElementById('pay-button').onclick = function () {

        window.snap.pay('{{ $snapToken }}', {

            onSuccess: function(result) {
                alert('Pembayaran berhasil!');
                window.location.href =
                    "{{ route('admin.pesanan.index') }}";
            },

            onPending: function(result) {
                alert('Pembayaran sedang menunggu penyelesaian.');
                window.location.href =
                    "{{ route('admin.pesanan.index') }}";
            },

            onError: function(result) {
                alert('Pembayaran gagal. Silakan coba lagi.');
            },

            onClose: function() {
                console.log('Popup pembayaran ditutup.');
            }

        });

    };
</script>

</body>
</html>