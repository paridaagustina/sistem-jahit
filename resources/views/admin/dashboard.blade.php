@extends('layouts.admin')

@section('title', 'Dashboard Admin - JAITIN')
@section('page-title', 'Dashboard')
@section('page-description', 'Ringkasan aktivitas dan pengelolaan sistem JAITIN.')

@section('styles')
<style>
    /* ===== DASHBOARD GLOBAL ===== */
    .dashboard {
    display: flex;
    flex-direction: column;
    gap: 40px !important;
}

    .dashboard * {
        box-sizing: border-box;
    }

    /* ===== WELCOME BANNER ===== */
    .dashboard-welcome {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        min-height: 220px;
        padding: 34px 36px;
        overflow: hidden;
        border-radius: 22px;
        background: linear-gradient(115deg, #9f6f75 0%, #bd8c8d 53%, #d6a89a 100%);
        color: #fffaf5;
        box-shadow: 0 14px 35px rgba(142, 98, 104, .16);
    }

    .dashboard-welcome::before,
    .dashboard-welcome::after {
        position: absolute;
        content: "";
        pointer-events: none;
        border-radius: 50%;
    }

    .dashboard-welcome::before {
        width: 290px;
        height: 290px;
        right: 90px;
        top: -185px;
        border: 1px solid rgba(255, 250, 245, .2);
        box-shadow:
            0 0 0 25px rgba(255, 250, 245, .035),
            0 0 0 55px rgba(255, 250, 245, .025);
    }

    .dashboard-welcome::after {
        width: 220px;
        height: 220px;
        right: -70px;
        bottom: -145px;
        background: rgba(255, 250, 245, .09);
    }

    .welcome-text {
        position: relative;
        z-index: 1;
        max-width: 650px;
    }

    .welcome-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        margin-bottom: 18px;
        border: 1px solid rgba(255, 250, 245, .22);
        border-radius: 30px;
        background: rgba(255, 250, 245, .13);
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1.4px;
    }

    .welcome-text h2 {
        margin-bottom: 11px;
        font-family: 'Playfair Display', serif;
        font-size: clamp(24px, 3vw, 34px);
        font-weight: 700;
        line-height: 1.35;
    }

    .welcome-text h2 span {
        color: #ffead8;
    }

    .welcome-text p {
        max-width: 530px;
        color: rgba(255, 250, 245, .9);
        font-size: 13px;
        line-height: 1.9;
    }

    .welcome-decoration {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 112px;
        height: 112px;
        flex-shrink: 0;
        margin-right: 25px;
        border: 1px solid rgba(255, 250, 245, .32);
        border-radius: 30px;
        background: rgba(255, 250, 245, .14);
        box-shadow: 0 12px 30px rgba(85, 48, 51, .08);
        transform: rotate(-5deg);
    }

    .welcome-decoration i {
        font-size: 48px;
        color: #fffaf5;
    }

    .welcome-decoration .decoration-sparkle {
        position: absolute;
        top: 12px;
        right: 13px;
        font-size: 17px;
        color: #ffead8;
    }

    /* ===== SECTION HEADER ===== */
    .dashboard-section {
        min-width: 0;
        
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 17px;
    }

    .section-heading {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-heading-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 43px;
        height: 43px;
        flex-shrink: 0;
        border: 1px solid #eddbd6;
        border-radius: 14px;
        background: #f7e9e6;
        color: #98676d;
        font-size: 17px;
    }

    .section-heading h2 {
        color: #493936;
        font-size: 17px;
        font-weight: 700;
    }

    .section-heading p {
        margin-top: 5px;
        color: #99847e;
        font-size: 12px;
        line-height: 1.6;
    }

    .section-date {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 13px;
        border: 1px solid #eee1da;
        border-radius: 12px;
        background: #fffdfb;
        color: #8b726d;
        font-size: 11px;
        white-space: nowrap;
    }

    /* ===== STATISTICS CARDS ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 17px;
    }

    .stat-card {
        position: relative;
        min-width: 0;
        padding: 22px 20px 19px;
        overflow: hidden;
        border: 1px solid #eee1da;
        border-radius: 18px;
        background: #fffdfb;
        box-shadow: 0 5px 18px rgba(103, 75, 66, .035);
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 28px rgba(103, 75, 66, .09);
    }

    .stat-card::after {
        position: absolute;
        right: -28px;
        bottom: -40px;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: var(--stat-soft);
        content: "";
        opacity: .65;
    }

    .stat-card-top {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
    }

    .stat-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 47px;
        height: 47px;
        flex-shrink: 0;
        border-radius: 15px;
        background: var(--stat-soft);
        color: var(--stat-color);
        font-size: 19px;
    }

    .stat-tag {
        padding: 6px 8px;
        border-radius: 8px;
        background: var(--stat-soft);
        color: var(--stat-color);
        font-size: 9px;
        font-weight: 700;
        letter-spacing: .3px;
    }

    .stat-label {
        position: relative;
        z-index: 1;
        margin-top: 23px;
        color: #927d77;
        font-size: 12px;
        font-weight: 500;
        line-height: 1.6;
    }

    .stat-number {
        position: relative;
        z-index: 1;
        margin-top: 5px;
        color: #493936;
        font-size: clamp(26px, 2.4vw, 34px);
        font-weight: 700;
        line-height: 1.25;
        overflow-wrap: anywhere;
        font-variant-numeric: tabular-nums;
    }

    .stat-footer {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 7px;
        margin-top: 13px;
        color: #a18b84;
        font-size: 10px;
        line-height: 1.5;
    }

    .stat-footer i {
        color: var(--stat-color);
        font-size: 10px;
    }

    .stat-pelanggan {
        --stat-color: #a36e77;
        --stat-soft: #f5e5e7;
    }

    .stat-pesanan {
        --stat-color: #a9774b;
        --stat-soft: #f7ebdc;
    }

    .stat-proses {
        --stat-color: #8171ad;
        --stat-soft: #eee9f8;
    }

    .stat-selesai {
        --stat-color: #588873;
        --stat-soft: #e4f1e8;
    }

    /* ===== PROGRESS OVERVIEW ===== */
    .overview-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.15fr) minmax(280px, .85fr);
        gap: 20px;
    }

    .panel {
        min-width: 0;
        padding: 24px;
        border: 1px solid #eee1da;
        border-radius: 19px;
        background: #fffdfb;
        box-shadow: 0 5px 18px rgba(103, 75, 66, .035);
    }

    .panel-heading {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 23px;
    }

    .panel-heading-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        border-radius: 13px;
        background: #f7e9e6;
        color: #98676d;
        font-size: 17px;
    }

    .panel-heading h3 {
        color: #493936;
        font-size: 15px;
        font-weight: 700;
    }

    .panel-heading p {
        margin-top: 5px;
        color: #99847e;
        font-size: 11px;
        line-height: 1.5;
    }

    /* Progress */
    .progress-summary {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 11px;
    }

    .progress-summary span:first-child {
        color: #806e69;
        font-size: 12px;
    }

    .progress-summary span:last-child {
        color: #493936;
        font-size: 12px;
        font-weight: 700;
    }

    .progress-track {
        height: 9px;
        overflow: hidden;
        border-radius: 20px;
        background: #f0e8e2;
    }

    .progress-fill {
        height: 100%;
        width: var(--progress-width);
        border-radius: inherit;
        background: linear-gradient(90deg, #b8898d, #d6a89a);
        transition: width .5s ease;
    }

    .progress-note {
        margin-top: 10px;
        color: #a18b84;
        font-size: 11px;
        line-height: 1.7;
    }

    .progress-divider {
        height: 1px;
        margin: 22px 0;
        background: #f0e6e0;
    }

    .mini-stats {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .mini-stat {
        padding: 14px;
        border: 1px solid #f0e6e0;
        border-radius: 13px;
        background: #fffaf7;
    }

    .mini-stat span {
        display: block;
        color: #927d77;
        font-size: 11px;
        line-height: 1.5;
    }

    .mini-stat strong {
        display: block;
        margin-top: 7px;
        color: #493936;
        font-size: 23px;
        font-weight: 700;
    }

    /* Quick actions */
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .quick-action {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        min-width: 0;
        min-height: 125px;
        padding: 16px;
        border: 1px solid #eee1da;
        border-radius: 15px;
        background: #fffaf7;
        transition: border-color .2s ease, transform .2s ease, background .2s ease;
    }

    .quick-action:hover {
        transform: translateY(-3px);
        border-color: #d9b8b2;
        background: #fff5f1;
    }

    .quick-action-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 39px;
        height: 39px;
        margin-bottom: 14px;
        border-radius: 12px;
        background: #f3e2e2;
        color: #98676d;
        font-size: 16px;
    }

    .quick-action strong {
        color: #604b46;
        font-size: 12px;
        line-height: 1.5;
    }

    .quick-action span {
        margin-top: 5px;
        color: #99847e;
        font-size: 10px;
        line-height: 1.6;
    }

    /* ===== INFORMASI ===== */
    .information-banner {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 20px 22px;
        border: 1px solid #ead9d1;
        border-radius: 17px;
        background: linear-gradient(110deg, #fbf0eb, #fffaf5);
    }

    .information-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 43px;
        height: 43px;
        flex-shrink: 0;
        border-radius: 14px;
        background: #f1dfe0;
        color: #98676d;
        font-size: 18px;
    }

    .information-banner h3 {
        margin-bottom: 6px;
        color: #604b46;
        font-size: 13px;
    }

    .information-banner p {
        color: #8d7770;
        font-size: 12px;
        line-height: 1.8;
    }

    /* ===== RESPONSIVE ===== */
    /* ===== RESPONSIVE ===== */
@media (max-width: 1200px) {
    .stats-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .overview-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 800px) {
    .dashboard {
        gap: 28px;
    }

    .dashboard-welcome {
        min-height: auto;
        padding: 27px 24px;
    }

    .welcome-decoration {
        width: 82px;
        height: 82px;
        margin-right: 5px;
        border-radius: 23px;
    }

    .welcome-decoration i {
        font-size: 36px;
    }

    .welcome-text h2 {
        font-size: 25px;
    }

    .panel {
        padding: 20px;
    }

    .dashboard > .dashboard-section:nth-of-type(3) {
        margin-top: 20px !important;
    }
}

@media (max-width: 520px) {
    .dashboard {
        gap: 21px;
    }

    .dashboard-welcome {
        padding: 23px 19px;
        border-radius: 18px;
    }

    .welcome-label {
        margin-bottom: 13px;
        font-size: 9px;
    }

    .welcome-text h2 {
        font-size: 22px;
    }

    .welcome-text p {
        font-size: 12px;
        line-height: 1.8;
    }

    .welcome-decoration {
        display: none;
    }

    .section-header {
        align-items: flex-start;
    }

    .section-heading {
        gap: 10px;
    }

    .section-heading-icon {
        width: 38px;
        height: 38px;
    }

    .section-heading h2 {
        font-size: 15px;
    }

    .section-heading p {
        font-size: 11px;
    }

    .section-date {
        display: none;
    }

    .stats-grid {
        gap: 12px;
    }

    .stat-card {
        padding: 17px 15px;
        border-radius: 15px;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        font-size: 16px;
    }

    .stat-tag {
        font-size: 8px;
    }

    .stat-label {
        margin-top: 17px;
        font-size: 11px;
    }

    .stat-number {
        font-size: 27px;
    }

    .stat-footer {
        font-size: 9px;
    }

    .panel {
        padding: 17px;
        border-radius: 16px;
    }

    .panel-heading {
        margin-bottom: 19px;
    }

    .quick-actions {
        gap: 9px;
    }

    .quick-action {
        min-height: 120px;
        padding: 13px;
    }

    .quick-action strong {
        font-size: 11px;
    }

    .mini-stat {
        padding: 12px;
    }

    .mini-stat strong {
        font-size: 21px;
    }

    .information-banner {
        padding: 16px;
    }

    .information-banner p {
        font-size: 11px;
    }

    .dashboard > .dashboard-section:nth-of-type(3) {
        margin-top: 16px !important;
    }
}

    @media (prefers-reduced-motion: reduce) {
        .stat-card,
        .quick-action,
        .progress-fill {
            transition: none;
        }
    }
    /* Jarak khusus antarbagian dashboard */
.dashboard > .dashboard-welcome {
    margin-bottom: 0;
}

.dashboard > .dashboard-section:nth-of-type(2) {
    margin-bottom: 24px;
}

.dashboard > .dashboard-section:nth-of-type(3) {
    margin-top: 0;
}
</style>
@endsection

@section('content')

@php
    $totalPelanggan = (int) ($jumlahPelanggan ?? 0);
    $totalPesanan = (int) ($jumlahPesanan ?? 0);
    $totalDiproses = (int) ($pesananDiproses ?? 0);
    $totalSelesai = (int) ($pesananSelesai ?? 0);

    $persentaseSelesai = $totalPesanan > 0
        ? min(100, round(($totalSelesai / $totalPesanan) * 100))
        : 0;
@endphp

<div class="dashboard">

    {{-- WELCOME BANNER --}}
    <section class="dashboard-welcome">
        <div class="welcome-text">
            <div class="welcome-label">
                <i class="fa-solid fa-sparkles"></i>
                JAITIN ADMINISTRATION
            </div>

            <h2>
                Selamat datang,<br>
                <span>{{ Auth::user()->nama ?? 'Admin' }}!</span>
            </h2>

            <p>
                Semua kendali JAITIN ada dalam satu tempat.
                Pantau pesanan, kelola pelanggan, dan pastikan setiap
                proses jahit berjalan dengan baik.
            </p>
        </div>

        <div class="welcome-decoration" aria-hidden="true">
            <i class="fa-solid fa-shirt"></i>
            <i class="fa-solid fa-sparkles decoration-sparkle"></i>
        </div>
    </section>

    {{-- RINGKASAN STATISTIK --}}
    <section class="dashboard-section">
        <div class="section-header">
            <div class="section-heading">
                <div class="section-heading-icon">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>
                <div>
                    <h2>Ringkasan Dashboard</h2>
                    <p>Gambaran umum aktivitas JAITIN saat ini.</p>
                </div>
            </div>

            <div class="section-date">
                <i class="fa-regular fa-calendar"></i>
                {{ now()->locale('id')->translatedFormat('d F Y') }}
            </div>
        </div>

        <div class="stats-grid">

            <article class="stat-card stat-pelanggan">
                <div class="stat-card-top">
                    <div class="stat-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <span class="stat-tag">PELANGGAN</span>
                </div>

                <div class="stat-label">Total Pelanggan</div>
                <div class="stat-number">{{ number_format($totalPelanggan, 0, ',', '.') }}</div>

                <div class="stat-footer">
                    <i class="fa-solid fa-user-check"></i>
                    Pelanggan terdaftar
                </div>
            </article>

            <article class="stat-card stat-pesanan">
                <div class="stat-card-top">
                    <div class="stat-icon">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                    <span class="stat-tag">PESANAN</span>
                </div>

                <div class="stat-label">Total Pesanan</div>
                <div class="stat-number">{{ number_format($totalPesanan, 0, ',', '.') }}</div>

                <div class="stat-footer">
                    <i class="fa-solid fa-layer-group"></i>
                    Seluruh pesanan tercatat
                </div>
            </article>

            <article class="stat-card stat-proses">
                <div class="stat-card-top">
                    <div class="stat-icon">
                        <i class="fa-solid fa-scissors"></i>
                    </div>
                    <span class="stat-tag">BERPROSES</span>
                </div>

                <div class="stat-label">Sedang Dikerjakan</div>
                <div class="stat-number">{{ number_format($totalDiproses, 0, ',', '.') }}</div>

                <div class="stat-footer">
                    <i class="fa-solid fa-spinner"></i>
                    Dalam proses pengerjaan
                </div>
            </article>

            <article class="stat-card stat-selesai">
                <div class="stat-card-top">
                    <div class="stat-icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <span class="stat-tag">SELESAI</span>
                </div>

                <div class="stat-label">Pesanan Selesai</div>
                <div class="stat-number">{{ number_format($totalSelesai, 0, ',', '.') }}</div>

                <div class="stat-footer">
                    <i class="fa-solid fa-check"></i>
                    Pengerjaan telah selesai
                </div>
            </article>

        </div>
    </section>

    {{-- PROGRES DAN PINTASAN --}}
    <section class="dashboard-section">
        <div class="section-header">
            <div class="section-heading">
                <div class="section-heading-icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <div>
                    <h2>Ikhtisar Operasional</h2>
                    <p>Pantau penyelesaian pesanan dan akses fitur penting.</p>
                </div>
            </div>
        </div>

        <div class="overview-grid">

            {{-- PROGRES PESANAN --}}
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-heading-icon">
                        <i class="fa-solid fa-chart-simple"></i>
                    </div>
                    <div>
                        <h3>Progres Pesanan</h3>
                        <p>Perbandingan pesanan selesai dengan seluruh pesanan.</p>
                    </div>
                </div>

                <div class="progress-summary">
                    <span>Penyelesaian pesanan</span>
                    <span>{{ $persentaseSelesai }}%</span>
                </div>

                <div
                    class="progress-track"
                    role="progressbar"
                    aria-label="Persentase pesanan selesai"
                    aria-valuemin="0"
                    aria-valuemax="100"
                    aria-valuenow="{{ $persentaseSelesai }}"
                >
                    <div
                        class="progress-fill"
                        style="--progress-width: {{ $persentaseSelesai }}%;"
                    ></div>
                </div>

                <p class="progress-note">
                    {{ $totalSelesai }} dari {{ $totalPesanan }} pesanan
                    telah selesai dikerjakan.
                </p>

                <div class="progress-divider"></div>

                <div class="mini-stats">
                    <div class="mini-stat">
                        <span>Total pelanggan</span>
                        <strong>{{ number_format($totalPelanggan, 0, ',', '.') }}</strong>
                    </div>

                    <div class="mini-stat">
                        <span>Pesanan aktif dikerjakan</span>
                        <strong>{{ number_format($totalDiproses, 0, ',', '.') }}</strong>
                    </div>
                </div>
            </div>

            {{-- PINTASAN MENU --}}
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-heading-icon">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <div>
                        <h3>Akses Cepat</h3>
                        <p>Langsung menuju fitur pengelolaan.</p>
                    </div>
                </div>

                <div class="quick-actions">
                    <a href="{{ route('admin.pelanggan.index') }}" class="quick-action">
                        <div class="quick-action-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <strong>Data Pelanggan</strong>
                        <span>Kelola data pelanggan</span>
                    </a>

                    <a href="{{ route('admin.pesanan.index') }}" class="quick-action">
                        <div class="quick-action-icon">
                            <i class="fa-solid fa-clipboard-list"></i>
                        </div>
                        <strong>Data Pesanan</strong>
                        <span>Periksa daftar pesanan</span>
                    </a>

                    <a href="{{ url('/admin/ukuran') }}" class="quick-action">
                        <div class="quick-action-icon">
                            <i class="fa-solid fa-ruler-combined"></i>
                        </div>
                        <strong>Data Ukuran</strong>
                        <span>Lihat data ukuran jahit</span>
                    </a>

                    <a href="{{ url('/admin/status-pengerjaan') }}" class="quick-action">
                        <div class="quick-action-icon">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                        <strong>Status Pengerjaan</strong>
                        <span>Pantau progres jahitan</span>
                    </a>
                </div>
            </div>

        </div>
    </section>

    {{-- INFORMASI --}}
    <section class="information-banner">
        <div class="information-icon">
            <i class="fa-solid fa-lightbulb"></i>
        </div>

        <div>
            <h3>Tips Pengelolaan JAITIN</h3>
            <p>
                Periksa data pesanan secara berkala, pastikan ukuran pelanggan
                tercatat dengan benar, dan perbarui status pengerjaan agar
                proses layanan jahit dapat dipantau dengan lebih mudah.
            </p>
        </div>
    </section>

</div>

@endsection