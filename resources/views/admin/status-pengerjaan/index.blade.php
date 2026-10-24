@extends('layouts.admin')

@section('title', 'Status Pengerjaan - JAITIN')
@section('page-title', 'Status Pengerjaan')
@section('page-description', 'Pantau perkembangan pesanan pelanggan dan status pengerjaan pakaian JAITIN.')

@section('styles')
<style>


        .main { flex: 1; min-width: 0; padding: 32px clamp(18px, 3vw, 42px); }
        .topbar {
            display: flex; justify-content: space-between; align-items: center;
            gap: 20px; margin-bottom: 28px;
        }
        .eyebrow {
            color: var(--pink-dark); font-size: 11px; font-weight: 800;
            letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 7px;
        }
        .topbar h1 { font-size: clamp(25px, 2.2vw, 32px); line-height: 1.2; letter-spacing: -.7px; }
        .topbar p { margin-top: 9px; max-width: 620px; color: var(--muted); line-height: 1.7; }
        .admin-info {
            display: flex; align-items: center; gap: 11px; padding: 10px 14px;
            border-radius: 15px; background: var(--surface);
            border: 1px solid var(--line); box-shadow: 0 4px 14px rgba(91,62,55,.03);
            white-space: nowrap;
        }
        .admin-avatar {
            display: grid; place-items: center; width: 36px; height: 36px;
            border-radius: 12px; color: var(--pink-dark); background: var(--pink-soft);
            font-weight: 800;
        }
        .admin-meta strong { display: block; font-size: 12px; }
        .admin-meta span { display: block; color: var(--muted); font-size: 11px; margin-top: 1px; }

        .alert {
            padding: 13px 16px; border-radius: 12px; margin-bottom: 20px;
            background: var(--green-soft); color: #32633c;
            border: 1px solid #cce5d0; font-weight: 600;
        }
        .summary {
            display: grid; grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px; margin-bottom: 25px;
        }
        .summary-card {
            position: relative; overflow: hidden; padding: 20px;
            background: var(--surface); border: 1px solid var(--line);
            border-radius: 18px; box-shadow: var(--shadow);
        }
        .summary-card::after {
            content: ""; position: absolute; right: -23px; top: -29px;
            width: 92px; height: 92px; border-radius: 50%;
            background: var(--accent-soft); opacity: .72;
        }
        .summary-top { position: relative; z-index: 1; display: flex; justify-content: space-between; align-items: center; gap: 8px; }
        .summary-title { font-size: 12px; color: var(--muted); font-weight: 700; }
        .summary-icon {
            display: grid; place-items: center; width: 42px; height: 42px;
            border-radius: 14px; color: var(--accent); background: var(--accent-soft);
            font-size: 19px; flex-shrink: 0;
        }
        .summary-number { position: relative; z-index: 1; margin-top: 16px; font-size: 32px; font-weight: 800; letter-spacing: -1px; line-height: 1.1; }
        .summary-note { position: relative; z-index: 1; margin-top: 9px; color: var(--muted); font-size: 11px; }
        .accent-pink { --accent: #98656c; --accent-soft: #f3e3e2; }
        .accent-amber { --accent: #946b36; --accent-soft: #fbefd9; }
        .accent-purple { --accent: #80658e; --accent-soft: #eee5f3; }
        .accent-green { --accent: #477653; --accent-soft: #e4f2e6; }

        .table-box {
            background: var(--surface); border: 1px solid var(--line);
            border-radius: 18px; padding: 24px; box-shadow: var(--shadow);
            min-width: 0;
        }
        .table-header {
            display: flex; justify-content: space-between; align-items: flex-start;
            gap: 16px; margin-bottom: 20px;
        }
        .table-header h2 { font-size: 18px; letter-spacing: -.25px; }
        .table-header p { margin-top: 5px; color: var(--muted); font-size: 12px; }
        .table-tag {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 8px 11px; background: #f8eee9; color: var(--pink-dark);
            border: 1px solid var(--line); border-radius: 10px;
            font-size: 11px; font-weight: 700; white-space: nowrap;
        }
        .table-wrapper { width: 100%; overflow-x: auto; border: 1px solid #efe3dc; border-radius: 13px; }
        table { width: 100%; min-width: 960px; border-collapse: separate; border-spacing: 0; }
        thead th {
            background: #f7eee8; color: #78625b; padding: 14px 15px;
            text-align: left; font-size: 10px; text-transform: uppercase;
            letter-spacing: .65px; white-space: nowrap; border-bottom: 1px solid var(--line);
        }
        tbody td {
            padding: 15px; border-bottom: 1px solid #f0e6e0;
            font-size: 12px; vertical-align: middle; line-height: 1.6;
        }
        tbody tr:last-child td { border-bottom: 0; }
        tbody tr { transition: background .15s ease; }
        tbody tr:hover { background: #fff5f0; }
        .number-cell { color: #a18f89; font-weight: 700; }
        .order-number {
            display: inline-flex; padding: 5px 9px; border-radius: 8px;
            background: #f6e8e7; color: #925e65; font-weight: 800; white-space: nowrap;
        }
        .customer-name { font-weight: 750; color: #4b3832; }
        .secondary { color: #9a8983; font-size: 11px; margin-top: 3px; }
        .status {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 10px; border-radius: 9px; font-size: 11px;
            font-weight: 750; white-space: nowrap;
        }
        .status::before { content: ""; width: 6px; height: 6px; border-radius: 50%; background: currentColor; }
        .status-menunggu { background: var(--amber-soft); color: var(--amber); }
        .status-proses { background: var(--pink-soft); color: #925e65; }
        .status-selesai { background: var(--green-soft); color: var(--green); }
        .status-diambil { background: var(--blue-soft); color: var(--blue); }
        .status-lain { background: #f0e9e8; color: #775b60; }
        .date-main { font-weight: 700; white-space: nowrap; }
        .date-time { color: var(--muted); font-size: 11px; margin-top: 2px; }
        .empty { text-align: center; padding: 52px 20px !important; color: var(--muted); }
        .empty-icon {
            display: grid; place-items: center; width: 58px; height: 58px;
            margin: 0 auto 13px; border-radius: 18px;
            background: var(--pink-soft); color: var(--pink-dark); font-size: 25px;
        }
        .empty strong { color: var(--brown); font-size: 13px; }
        .empty p { margin-top: 6px; font-size: 12px; }
        .pagination { padding-top: 20px; overflow-x: auto; }
        .pagination nav { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
        .pagination nav div p { color: var(--muted); font-size: 11px; }
        .pagination nav a, .pagination nav span[aria-current="page"] span {
            display: inline-block; padding: 8px 12px; margin: 2px;
            border-radius: 9px; border: 1px solid var(--line);
            color: var(--pink-dark); background: #fffdfa;
            text-decoration: none; font-size: 12px;
        }
        .pagination nav span[aria-current="page"] span { background: var(--pink); border-color: var(--pink); color: white; }

        @media (max-width: 1200px) {
            .sidebar { width: 235px; }
            .summary { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (max-width: 800px) {
            .layout { display: block; }
            .sidebar { width: 100%; min-height: auto; padding: 18px; }
            .logo-area { display: flex; align-items: center; text-align: left; gap: 12px; margin-bottom: 18px; }
            .logo-circle { width: 48px; height: 48px; border-radius: 14px; margin: 0; flex-shrink: 0; }
            .logo-circle img { width: 42px; height: 42px; }
            .brand { font-size: 19px; }
            .role { margin-top: 0; }
            .menu-label { padding: 0 4px 8px; }
            .menu { display: flex; overflow-x: auto; padding-bottom: 5px; }
            .menu li { flex: 0 0 auto; }
            .menu a { padding: 10px 12px; white-space: nowrap; }
            .sidebar-bottom { padding-top: 12px; }
            .sidebar-note { display: none; }
            .logout { max-width: 180px; }
            .main { padding: 24px 18px; }
        }
        @media (max-width: 540px) {
            .main { padding: 20px 13px; }
            .topbar { align-items: flex-start; flex-direction: column; margin-bottom: 20px; }
            .admin-info { width: 100%; }
            .summary { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
            .summary-card { padding: 15px; border-radius: 15px; }
            .summary-title { font-size: 11px; }
            .summary-icon { width: 34px; height: 34px; border-radius: 11px; font-size: 16px; }
            .summary-number { font-size: 27px; margin-top: 13px; }
            .summary-note { font-size: 10px; }
            .table-box { padding: 15px; border-radius: 15px; }
            .table-header { flex-direction: column; }
            .table-tag { align-self: flex-start; }
        }
        @media (max-width: 360px) {
            .summary { grid-template-columns: 1fr; }
        }

        .status-page { min-width: 0; color: var(--brown); }
        .status-page .summary { margin-top: 8px; }
        .status-page .table-box { margin-bottom: 24px; }
        @media (max-width: 800px) {
            .status-page .summary { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (max-width: 540px) {
            .status-page .summary { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

</style>
@endsection

@section('content')
<div class="status-page">


        @if (session('success'))
            <div class="alert">✓ &nbsp; {{ session('success') }}</div>
        @endif

        <section class="summary">
            <div class="summary-card accent-pink">
                <div class="summary-top"><div class="summary-title">Total Pesanan Tercatat</div><div class="summary-icon">▤</div></div>
                <div class="summary-number">{{ number_format($totalPesanan, 0, ',', '.') }}</div>
                <div class="summary-note">Pesanan dengan riwayat status</div>
            </div>
            <div class="summary-card accent-amber">
                <div class="summary-top"><div class="summary-title">Menunggu</div><div class="summary-icon">◷</div></div>
                <div class="summary-number">{{ number_format($totalMenunggu, 0, ',', '.') }}</div>
                <div class="summary-note">Menunggu proses pengerjaan</div>
            </div>
            <div class="summary-card accent-purple">
                <div class="summary-top"><div class="summary-title">Dalam Proses</div><div class="summary-icon">✂</div></div>
                <div class="summary-number">{{ number_format($totalProses, 0, ',', '.') }}</div>
                <div class="summary-note">Pesanan sedang dikerjakan</div>
            </div>
            <div class="summary-card accent-green">
                <div class="summary-top"><div class="summary-title">Selesai</div><div class="summary-icon">✓</div></div>
                <div class="summary-number">{{ number_format($totalSelesai, 0, ',', '.') }}</div>
                <div class="summary-note">Selesai atau siap diambil</div>
            </div>
        </section>

        <section class="table-box">
            <div class="table-header">
                <div>
                    <h2>Riwayat Status Pengerjaan</h2>
                    <p>Daftar pembaruan status pesanan yang tercatat di sistem.</p>
                </div>
                <div class="table-tag"><span>●</span> Riwayat terbaru</div>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Jenis Pakaian</th>
                        <th>Karyawan</th>
                        <th>Status Pengerjaan</th>
                        <th>Keterangan</th>
                        <th>Tanggal Pembaruan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($statusPengerjaan as $item)
                        @php
                            $pesanan = $item->pesanan;
                            $status = strtolower(trim($item->status ?? ''));

                            if (
                                str_contains($status, 'siap diambil') ||
                                str_contains($status, 'sudah diambil') ||
                                $status === 'diambil'
                            ) {
                                $statusClass = 'status-diambil';
                            } elseif (str_contains($status, 'selesai')) {
                                $statusClass = 'status-selesai';
                            } elseif (
                                str_contains($status, 'proses') ||
                                str_contains($status, 'dikerjakan')
                            ) {
                                $statusClass = 'status-proses';
                            } elseif (str_contains($status, 'menunggu')) {
                                $statusClass = 'status-menunggu';
                            } else {
                                $statusClass = 'status-lain';
                            }
                        @endphp
                        <tr>
                            <td class="number-cell">{{ method_exists($statusPengerjaan, 'firstItem') ? $statusPengerjaan->firstItem() + $loop->index : $loop->iteration }}</td>
                            <td><span class="order-number">#{{ $item->id_pesanan }}</span></td>
                            <td><div class="customer-name">{{ $pesanan?->user?->nama ?? $pesanan?->user?->name ?? 'Pelanggan tidak ditemukan' }}</div></td>
                            <td>
                                <div class="customer-name" style="font-weight:600;">{{ $pesanan?->jenis_pakaian ?? '-' }}</div>
                                @if ($pesanan?->model_pakaian)
                                    <div class="secondary">{{ $pesanan->model_pakaian }}</div>
                                @endif
                            </td>
                            <td>{{ $pesanan?->karyawan?->nama ?? $pesanan?->karyawan?->name ?? 'Belum ditentukan' }}</td>
                            <td><span class="status {{ $statusClass }}">{{ $item->status ?? 'Belum ada status' }}</span></td>
                            <td>{{ $item->keterangan ?: '-' }}</td>
                            <td>
                                @if ($item->tanggal_status)
                                    <div class="date-main">{{ \Illuminate\Support\Carbon::parse($item->tanggal_status)->translatedFormat('d M Y') }}</div>
                                    <div class="date-time">{{ \Illuminate\Support\Carbon::parse($item->tanggal_status)->format('H:i') }} WIB</div>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty">
                                <div class="empty-icon">✂</div>
                                <strong>Belum ada riwayat status pengerjaan</strong>
                                <p>Data akan tampil setelah status pengerjaan pesanan tercatat.</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($statusPengerjaan, 'links'))
                <div class="pagination">{{ $statusPengerjaan->links() }}</div>
            @endif
        </section>
</div>
@endsection
