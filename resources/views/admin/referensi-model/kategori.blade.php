<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @if ($kategori === 'kebaya')
            Katalog Kebaya
        @elseif ($kategori === 'dress')
            Katalog Dress
        @else
            Perbaikan Pakaian
        @endif
        - Jaitin
    </title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f8f1eb;
            color: #4b3832;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 30px;
        }

        .back {
            display: inline-block;
            margin-bottom: 25px;
            color: #8f6268;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .back:hover {
            color: #79545a;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
            color: #806e69;
            line-height: 1.6;
        }

        .brand {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            color: #8e6268;
            border-radius: 20px;
            padding: 11px 18px;
            font-weight: bold;
        }

        .notice {
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 25px;
        }

        .notice h2 {
            font-size: 19px;
            margin-bottom: 10px;
        }

        .notice p {
            color: #806e69;
            font-size: 14px;
            line-height: 1.8;
        }

        .section-title {
            font-size: 21px;
            margin-bottom: 18px;
        }

        .section-description {
            color: #806e69;
            font-size: 14px;
            line-height: 1.7;
            margin-top: -8px;
            margin-bottom: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .card {
            display: flex;
            flex-direction: column;
            background: #fffaf5;
            border: 1px solid #ead6ca;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(120, 90, 80, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 18px rgba(120, 90, 80, 0.12);
        }

        .card-link {
            display: flex;
            flex-direction: column;
            flex: 1;
            color: inherit;
            text-decoration: none;
        }

        .card-link:focus-visible {
            outline: 3px solid #b8898d;
            outline-offset: -3px;
        }

        .placeholder {
            min-height: 220px;
            padding: 20px;
            background: #f1dfe0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 12px;
            color: #8f6268;
            text-align: center;
        }

        .placeholder .icon {
            font-size: 43px;
        }

        .placeholder span:last-child {
            font-size: 13px;
            line-height: 1.6;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 20px;
        }

        .card-content h3 {
            font-size: 18px;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        .card-content p {
            color: #806e69;
            font-size: 14px;
            line-height: 1.7;
            flex: 1;
        }

        .tag {
            display: inline-block;
            align-self: flex-start;
            margin-top: 15px;
            padding: 7px 10px;
            border-radius: 20px;
            background: #eee0e2;
            color: #8f5d64;
            font-size: 12px;
        }

        .card-action {
            display: block;
            margin: 0 20px 20px;
            padding: 11px;
            border-radius: 9px;
            background: #b8898d;
            color: white;
            text-decoration: none;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.2s;
        }

        .card-action:hover {
            background: #9f7378;
        }

        .empty {
            background: #fffaf5;
            border: 1px dashed #d8b7b8;
            border-radius: 14px;
            padding: 30px;
            text-align: center;
            color: #806e69;
            line-height: 1.8;
        }

        .empty strong {
            display: block;
            color: #4b3832;
            margin-bottom: 6px;
        }

        @media (max-width: 900px) {
            .grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            .header {
                align-items: flex-start;
                flex-direction: column;
            }

            .header h1 {
                font-size: 24px;
            }

            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <a class="back" href="{{ route('admin.referensi-model.index') }}">
        &larr; Kembali ke Referensi Model
    </a>

    <div class="header">
        <div>
            <h1>
                @if ($kategori === 'kebaya')
                    Katalog Kebaya
                @elseif ($kategori === 'dress')
                    Katalog Dress
                @else
                    Layanan Perbaikan Pakaian
                @endif
            </h1>

            <p>
                Pilih jenis model untuk melihat kumpulan foto referensinya.
            </p>
        </div>

        <div class="brand">Jaitin</div>
    </div>

    <section class="notice">
        <h2>
            @if ($kategori === 'kebaya')
                Pilihan Jenis Kebaya
            @elseif ($kategori === 'dress')
                Pilihan Jenis Dress
            @else
                Pilihan Layanan Perbaikan
            @endif
        </h2>

        <p>
            @if ($kategori === 'kebaya')
                Pilih Kebaya Klasik, Kebaya Modern, atau Kebaya Minimalis.
                Setiap pilihan membuka galeri foto khusus untuk jenis tersebut.
            @elseif ($kategori === 'dress')
                Pilih Dress Pesta, Dress Formal, atau Dress Casual untuk
                melihat kumpulan foto referensi masing-masing.
            @else
                Pilih salah satu dari dua kelompok layanan, yaitu Perbaikan
                Kerusakan & Robekan (Mending) atau Penyesuaian Ukuran & Model
                (Alteration / Vermak). Setiap pilihan membuka galeri referensi
                layanan yang sesuai.
            @endif
        </p>
    </section>

    <h2 class="section-title">
        @if ($kategori === 'kebaya')
            Pilihan Model Kebaya
        @elseif ($kategori === 'dress')
            Pilihan Model Dress
        @else
            Jenis Layanan Perbaikan
        @endif
    </h2>

    <p class="section-description">
        Klik salah satu kartu atau tombol di bawahnya untuk membuka halaman
        jenis model atau layanan yang dipilih.
    </p>

    @php
        $daftarJenis = [
            'kebaya' => [
                [
                    'slug' => 'kebaya-klasik',
                    'nama' => 'Kebaya Klasik',
                    'deskripsi' => 'Kumpulan referensi kebaya klasik untuk inspirasi jahitan.',
                    'ikon' => '🪡',
                ],
                [
                    'slug' => 'kebaya-modern',
                    'nama' => 'Kebaya Modern',
                    'deskripsi' => 'Kumpulan foto kebaya modern dengan beragam desain dan detail.',
                    'ikon' => '👗',
                ],
                [
                    'slug' => 'kebaya-minimalis',
                    'nama' => 'Kebaya Minimalis',
                    'deskripsi' => 'Referensi kebaya minimalis dengan desain sederhana dan elegan.',
                    'ikon' => '🌷',
                ],
            ],

            'dress' => [
                [
                    'slug' => 'dress-pesta',
                    'nama' => 'Dress Pesta',
                    'deskripsi' => 'Kumpulan referensi dress untuk acara pesta.',
                    'ikon' => '✨',
                ],
                [
                    'slug' => 'dress-formal',
                    'nama' => 'Dress Formal',
                    'deskripsi' => 'Referensi dress formal untuk acara resmi.',
                    'ikon' => '👗',
                ],
                [
                    'slug' => 'dress-casual',
                    'nama' => 'Dress Casual',
                    'deskripsi' => 'Kumpulan referensi dress untuk gaya sehari-hari.',
                    'ikon' => '🌸',
                ],
            ],

            'perbaikan' => [
                [
                    'slug' => 'perbaikan-kerusakan-robekan',
                    'nama' => 'Perbaikan Kerusakan & Robekan (Mending)',
                    'deskripsi' => 'Layanan untuk memperbaiki pakaian yang rusak, sobek, jahitan terlepas, atau bagian pakaian yang perlu diperbaiki.',
                    'ikon' => '🪡',
                ],
                [
                    'slug' => 'penyesuaian-ukuran-model',
                    'nama' => 'Penyesuaian Ukuran & Model (Alteration / Vermak)',
                    'deskripsi' => 'Layanan untuk menyesuaikan ukuran dan model pakaian, seperti mengecilkan, memperbesar, memendekkan, atau mengganti resleting.',
                    'ikon' => '✂️',
                ],
            ],
        ];

        $pilihanJenis = $daftarJenis[$kategori] ?? [];
    @endphp

    @if (count($pilihanJenis) > 0)

        <div class="grid">

            @foreach ($pilihanJenis as $jenis)
                <article class="card">

                    <a
                        class="card-link"
                        href="{{ route('admin.referensi-model.jenis', [
                            'kategori' => $kategori,
                            'jenis' => $jenis['slug']
                        ]) }}"
                    >
                        <div class="placeholder">
                            <span class="icon">{{ $jenis['ikon'] }}</span>
                            <span>Galeri {{ $jenis['nama'] }}</span>
                        </div>

                        <div class="card-content">
                            <h3>{{ $jenis['nama'] }}</h3>

                            <p>{{ $jenis['deskripsi'] }}</p>

                            <span class="tag">
                                {{ $kategori === 'perbaikan' ? 'Layanan Jaitin' : 'Referensi Model' }}
                            </span>
                        </div>
                    </a>

                    <a
                        class="card-action"
                        href="{{ route('admin.referensi-model.jenis', [
                            'kategori' => $kategori,
                            'jenis' => $jenis['slug']
                        ]) }}"
                    >
                        Lihat Galeri &rarr;
                    </a>

                </article>
            @endforeach

        </div>

    @else

        <div class="empty">
            <strong>Kategori tidak ditemukan.</strong>
            Silakan kembali ke halaman Referensi Model dan pilih kategori yang tersedia.
        </div>

    @endif

</div>
</body>
</html>