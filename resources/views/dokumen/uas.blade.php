<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen Presentasi UAS – Aplikasi Poliklinik</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --indigo: #4f46e5;
            --indigo-dark: #3730a3;
            --indigo-light: #eef2ff;
            --slate-800: #1e293b;
            --slate-600: #475569;
            --slate-400: #94a3b8;
            --slate-100: #f1f5f9;
            --emerald: #059669;
            --amber: #d97706;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: var(--slate-800);
            line-height: 1.7;
            font-size: 14px;
        }

        /* ========== TOOLBAR ========== */
        .toolbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 999;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 6px rgba(0,0,0,0.07);
        }

        .toolbar-brand {
            font-weight: 800;
            color: var(--indigo);
            font-size: 15px;
            letter-spacing: -0.3px;
        }

        .toolbar-brand span { color: var(--slate-600); font-weight: 500; }

        .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--indigo);
            color: white;
            padding: 9px 20px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            border: none;
            transition: background 0.2s;
            text-decoration: none;
        }
        .btn-download:hover { background: var(--indigo-dark); }

        /* ========== DOCUMENT WRAPPER ========== */
        .doc-wrapper {
            max-width: 900px;
            margin: 80px auto 60px;
            padding: 0 20px;
        }

        /* ========== COVER PAGE ========== */
        .cover {
            background: linear-gradient(135deg, var(--indigo-dark) 0%, var(--indigo) 60%, #818cf8 100%);
            border-radius: 24px;
            padding: 60px 56px;
            color: white;
            margin-bottom: 48px;
            position: relative;
            overflow: hidden;
        }
        .cover::before {
            content: '';
            position: absolute;
            width: 280px; height: 280px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
            top: -80px; right: -60px;
        }
        .cover::after {
            content: '';
            position: absolute;
            width: 180px; height: 180px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            bottom: -60px; left: 40px;
        }
        .cover .badge {
            display: inline-block;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25);
            color: #c7d2fe;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 20px;
            margin-bottom: 20px;
        }
        .cover h1 {
            font-size: 32px;
            font-weight: 800;
            line-height: 1.25;
            margin-bottom: 12px;
        }
        .cover p { color: #c7d2fe; font-size: 15px; margin-bottom: 32px; }
        .cover-meta {
            display: flex;
            gap: 32px;
            flex-wrap: wrap;
            border-top: 1px solid rgba(255,255,255,0.15);
            padding-top: 24px;
        }
        .cover-meta-item label {
            display: block;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #a5b4fc;
            font-weight: 600;
            margin-bottom: 3px;
        }
        .cover-meta-item span { font-weight: 700; font-size: 14px; }

        /* ========== SECTION HEADERS ========== */
        .section {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            margin-bottom: 32px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .section-header {
            padding: 20px 28px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 12px;
            background: #fafafa;
        }
        .section-icon {
            width: 38px; height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }
        .section-icon.indigo { background: var(--indigo-light); }
        .section-icon.emerald { background: #d1fae5; }
        .section-icon.amber { background: #fef3c7; }
        .section-icon.rose { background: #ffe4e6; }
        .section-header h2 {
            font-size: 17px;
            font-weight: 800;
            color: var(--slate-800);
        }
        .section-header p {
            font-size: 12px;
            color: var(--slate-400);
            font-weight: 500;
        }
        .section-body { padding: 24px 28px; }

        /* ========== TIMELINE TABLE ========== */
        .timeline-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        .timeline-table thead th {
            background: var(--indigo-light);
            color: var(--indigo);
            font-weight: 700;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 10px 14px;
            text-align: left;
        }
        .timeline-table thead th:first-child { border-radius: 8px 0 0 8px; }
        .timeline-table thead th:last-child { border-radius: 0 8px 8px 0; }
        .timeline-table tbody td {
            padding: 11px 14px;
            border-bottom: 1px solid #f1f5f9;
            color: var(--slate-600);
        }
        .timeline-table tbody tr:last-child td { border-bottom: none; }
        .timeline-table tbody td:first-child { font-weight: 700; color: var(--slate-800); white-space: nowrap; }
        .time-badge {
            display: inline-block;
            background: #f1f5f9;
            color: var(--indigo);
            font-weight: 700;
            font-size: 11px;
            padding: 3px 10px;
            border-radius: 20px;
            font-family: 'JetBrains Mono', monospace;
        }

        /* ========== FLOW CARDS ========== */
        .flow-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .flow-card {
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 18px;
        }
        .flow-card h4 {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--slate-800);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .flow-card h4 .dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: var(--indigo);
        }
        .flow-step {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            margin-bottom: 10px;
            font-size: 12.5px;
            color: var(--slate-600);
        }
        .flow-step-num {
            width: 22px; height: 22px;
            background: var(--indigo-light);
            color: var(--indigo);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 800;
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* ========== ERD / DATABASE ========== */
        .erd-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 24px;
        }
        .table-card {
            border: 2px solid var(--indigo-light);
            border-radius: 12px;
            overflow: hidden;
        }
        .table-card-header {
            background: var(--indigo);
            color: white;
            padding: 8px 12px;
            font-weight: 700;
            font-size: 12px;
            font-family: 'JetBrains Mono', monospace;
        }
        .table-card-body { padding: 8px 12px; }
        .table-field {
            font-size: 11.5px;
            padding: 3px 0;
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--slate-600);
            font-family: 'JetBrains Mono', monospace;
        }
        .badge-pk {
            background: #fef3c7;
            color: #92400e;
            font-size: 9px;
            font-weight: 800;
            padding: 1px 5px;
            border-radius: 4px;
        }
        .badge-fk {
            background: #dbeafe;
            color: #1e40af;
            font-size: 9px;
            font-weight: 800;
            padding: 1px 5px;
            border-radius: 4px;
        }

        .relation-list { list-style: none; padding: 0; }
        .relation-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
            color: var(--slate-600);
        }
        .relation-list li:last-child { border-bottom: none; }
        .rel-icon {
            font-size: 16px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* ========== CODE BLOCKS ========== */
        .code-title {
            background: #1e293b;
            color: #94a3b8;
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            padding: 8px 16px;
            border-radius: 12px 12px 0 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .code-title span { color: #64748b; }
        .code-title .file-tag {
            background: #334155;
            padding: 2px 10px;
            border-radius: 6px;
            color: #7dd3fc;
        }
        pre {
            background: #0f172a;
            color: #e2e8f0;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            line-height: 1.7;
            padding: 16px;
            border-radius: 0 0 12px 12px;
            overflow-x: auto;
            margin-bottom: 20px;
        }
        .kw { color: #c084fc; font-weight: 700; }   /* keyword */
        .fn { color: #60a5fa; }                      /* function */
        .st { color: #86efac; }                      /* string */
        .cm { color: #475569; font-style: italic; }  /* comment */
        .nm { color: #fb923c; }                      /* number */
        .ty { color: #fbbf24; }                      /* type */
        .var { color: #f1f5f9; }                     /* variable */

        /* ========== REASONING ========== */
        .reason-card {
            border-left: 4px solid var(--indigo);
            background: var(--indigo-light);
            border-radius: 0 12px 12px 0;
            padding: 16px 20px;
            margin-bottom: 16px;
        }
        .reason-card h4 {
            font-size: 13px;
            font-weight: 700;
            color: var(--indigo-dark);
            margin-bottom: 6px;
        }
        .reason-card .why {
            font-size: 12px;
            font-weight: 600;
            color: var(--indigo);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 3px;
        }
        .reason-card p { font-size: 13px; color: var(--slate-600); line-height: 1.6; }

        /* ========== SCRIPT ========== */
        .script-block {
            background: #fafafa;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 20px 24px;
            margin-bottom: 16px;
        }
        .script-block .time-tag {
            display: inline-block;
            background: var(--indigo);
            color: white;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            margin-bottom: 10px;
            font-family: 'JetBrains Mono', monospace;
        }
        .script-block blockquote {
            border-left: 3px solid #c7d2fe;
            padding-left: 16px;
            color: var(--slate-600);
            font-style: italic;
            font-size: 13px;
            line-height: 1.7;
        }

        /* ========== PRINT STYLES ========== */
        @media print {
            .toolbar { display: none !important; }
            .doc-wrapper { margin-top: 20px; padding: 0; max-width: 100%; }
            body { background: white; font-size: 12px; }
            .section { page-break-inside: avoid; box-shadow: none; }
            .cover { page-break-after: always; border-radius: 0; }
            pre { font-size: 10px; }
            .flow-grid { grid-template-columns: 1fr 1fr; }
            .erd-grid { grid-template-columns: 1fr 1fr 1fr; }
        }
    </style>
</head>
<body>

    <!-- TOOLBAR -->
    <div class="toolbar">
        <div class="toolbar-brand">
            📋 Dokumen UAS <span>/ Aplikasi Poliklinik</span>
        </div>
        <button class="btn-download" onclick="window.print()">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a1 1 0 001-1v-4a1 1 0 00-1-1H9a1 1 0 00-1 1v4a1 1 0 001 1zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Cetak / Simpan PDF
        </button>
    </div>

    <!-- DOCUMENT -->
    <div class="doc-wrapper">

        <!-- COVER -->
        <div class="cover">
            <div class="badge">Bengkel Koding — UAS 2025/2026</div>
            <h1>Panduan & Bahan Presentasi UAS<br>Aplikasi Manajemen Poliklinik</h1>
            <p>Dokumen ini mencakup timeline presentasi, alur logika sistem, relasi basis data, reasoning kode, potongan kode utama, dan naskah presentasi individu.</p>
            <div class="cover-meta">
                <div class="cover-meta-item">
                    <label>Mata Kuliah</label>
                    <span>Bengkel Koding</span>
                </div>
                <div class="cover-meta-item">
                    <label>Jenis Ujian</label>
                    <span>Ujian Akhir Semester (UAS)</span>
                </div>
                <div class="cover-meta-item">
                    <label>Durasi Presentasi</label>
                    <span>7 – 10 Menit</span>
                </div>
                <div class="cover-meta-item">
                    <label>Bentuk</label>
                    <span>Individual / Tatap Muka</span>
                </div>
            </div>
        </div>

        <!-- SECTION 1: TIMELINE -->
        <div class="section">
            <div class="section-header">
                <div class="section-icon indigo">⏱️</div>
                <div>
                    <h2>1. Rencana Pembagian Waktu Presentasi</h2>
                    <p>Panduan distribusi durasi agar presentasi selesai dalam 7 – 10 menit</p>
                </div>
            </div>
            <div class="section-body">
                <table class="timeline-table">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Bagian Presentasi</th>
                            <th>Fokus Utama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="time-badge">0:00 – 1:30</span></td>
                            <td>Pendahuluan & Konsep Database</td>
                            <td>Perkenalan diri, tujuan aplikasi, dan penjelasan relasi database (ERD).</td>
                        </tr>
                        <tr>
                            <td><span class="time-badge">1:30 – 3:00</span></td>
                            <td>Demo Alur A: Dashboard Pasien</td>
                            <td>Registrasi antrean poli secara dinamis (AJAX) dan cetak tiket antrean.</td>
                        </tr>
                        <tr>
                            <td><span class="time-badge">3:00 – 5:30</span></td>
                            <td>Demo Alur B: Periksa & Manajemen Obat</td>
                            <td>Dokter mengisi pemeriksaan, kalkulasi biaya otomatis, dan admin kelola stok obat.</td>
                        </tr>
                        <tr>
                            <td><span class="time-badge">5:30 – 7:00</span></td>
                            <td>Demo Alur C: Riwayat Pasien</td>
                            <td>Riwayat dari sisi Admin (hapus/reset) dan Dokter (edit & walk-in).</td>
                        </tr>
                        <tr>
                            <td><span class="time-badge">7:00 – 8:00</span></td>
                            <td>Penutup & Tanya Jawab</td>
                            <td>Rangkuman keunggulan teknis kode dan sesi pertanyaan dosen.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SECTION 2: DATABASE & RELASI -->
        <div class="section">
            <div class="section-header">
                <div class="section-icon emerald">🗄️</div>
                <div>
                    <h2>2. Struktur Database & Relasi Tabel</h2>
                    <p>Deskripsi 7 tabel utama beserta kolom kunci dan hubungan antar tabel</p>
                </div>
            </div>
            <div class="section-body">
                <div class="erd-grid">
                    <div class="table-card">
                        <div class="table-card-header">🏥 poli</div>
                        <div class="table-card-body">
                            <div class="table-field"><span class="badge-pk">PK</span> id</div>
                            <div class="table-field">nama_poli</div>
                            <div class="table-field">keterangan</div>
                        </div>
                    </div>
                    <div class="table-card">
                        <div class="table-card-header">👤 users</div>
                        <div class="table-card-body">
                            <div class="table-field"><span class="badge-pk">PK</span> id</div>
                            <div class="table-field">nama, email</div>
                            <div class="table-field">role (admin/dokter/pasien)</div>
                            <div class="table-field">no_rm, no_ktp, no_hp</div>
                            <div class="table-field"><span class="badge-fk">FK</span> id_poli → poli</div>
                        </div>
                    </div>
                    <div class="table-card">
                        <div class="table-card-header">📅 jadwal_periksa</div>
                        <div class="table-card-body">
                            <div class="table-field"><span class="badge-pk">PK</span> id</div>
                            <div class="table-field"><span class="badge-fk">FK</span> id_dokter → users</div>
                            <div class="table-field">hari</div>
                            <div class="table-field">jam_mulai, jam_selesai</div>
                        </div>
                    </div>
                    <div class="table-card">
                        <div class="table-card-header">📋 daftar_poli</div>
                        <div class="table-card-body">
                            <div class="table-field"><span class="badge-pk">PK</span> id</div>
                            <div class="table-field"><span class="badge-fk">FK</span> id_pasien → users</div>
                            <div class="table-field"><span class="badge-fk">FK</span> id_jadwal → jadwal_periksa</div>
                            <div class="table-field">keluhan, no_antrian</div>
                            <div class="table-field">status_periksa (0/1)</div>
                        </div>
                    </div>
                    <div class="table-card">
                        <div class="table-card-header">🩺 periksa</div>
                        <div class="table-card-body">
                            <div class="table-field"><span class="badge-pk">PK</span> id</div>
                            <div class="table-field"><span class="badge-fk">FK</span> id_daftar_poli</div>
                            <div class="table-field">tgl_periksa, catatan</div>
                            <div class="table-field">biaya_periksa (angka tetap)</div>
                        </div>
                    </div>
                    <div class="table-card">
                        <div class="table-card-header">💊 obat</div>
                        <div class="table-card-body">
                            <div class="table-field"><span class="badge-pk">PK</span> id</div>
                            <div class="table-field">nama_obat, kemasan</div>
                            <div class="table-field">harga</div>
                        </div>
                    </div>
                </div>
                <!-- Detail Periksa -->
                <div class="table-card" style="margin-bottom: 24px;">
                    <div class="table-card-header">🔗 detail_periksa (Tabel Pivot)</div>
                    <div class="table-card-body" style="display:flex; gap:24px; padding: 12px;">
                        <div class="table-field"><span class="badge-pk">PK</span> id</div>
                        <div class="table-field"><span class="badge-fk">FK</span> id_periksa → periksa</div>
                        <div class="table-field"><span class="badge-fk">FK</span> id_obat → obat</div>
                    </div>
                </div>

                <ul class="relation-list">
                    <li><span class="rel-icon">🏥</span><div><strong>poli → users (Dokter)</strong> — Relasi <em>one-to-many</em>. Satu poli memiliki banyak dokter spesialis (kolom <code>id_poli</code> di tabel users).</div></li>
                    <li><span class="rel-icon">👤</span><div><strong>users (Pasien) → daftar_poli</strong> — Satu pasien dapat mendaftar ke banyak jadwal periksa (kolom <code>id_pasien</code>).</div></li>
                    <li><span class="rel-icon">📅</span><div><strong>jadwal_periksa → daftar_poli</strong> — Satu jadwal dokter memiliki banyak pasien yang terdaftar di slot waktu tersebut.</div></li>
                    <li><span class="rel-icon">🩺</span><div><strong>daftar_poli → periksa</strong> — Relasi <em>one-to-one</em>. Satu pendaftaran menghasilkan satu rekam hasil pemeriksaan dokter.</div></li>
                    <li><span class="rel-icon">💊</span><div><strong>periksa ↔ obat (melalui detail_periksa)</strong> — Relasi <em>many-to-many</em>. Satu pemeriksaan dapat meresepkan banyak obat, dan satu obat bisa ada di banyak resep.</div></li>
                </ul>
            </div>
        </div>

        <!-- SECTION 3: ALUR LOGIKA -->
        <div class="section">
            <div class="section-header">
                <div class="section-icon amber">🔄</div>
                <div>
                    <h2>3. Penjelasan Alur Logika Utama</h2>
                    <p>Tiga alur sistem yang menjadi inti fungsionalitas aplikasi poliklinik</p>
                </div>
            </div>
            <div class="section-body">
                <div class="flow-grid">
                    <div class="flow-card">
                        <h4><span class="dot"></span>A. Management Periksa Pasien</h4>
                        <div class="flow-step"><div class="flow-step-num">1</div><div>Pasien memilih Poli → Dokter → Jadwal melalui form AJAX cascading yang memperbarui dropdown tanpa reload halaman.</div></div>
                        <div class="flow-step"><div class="flow-step-num">2</div><div>Sistem menghitung nomor antrean: <code>max(no_antrian)+1</code> pada jadwal terpilih, lalu menyimpan status <code>status_periksa = 0</code>.</div></div>
                        <div class="flow-step"><div class="flow-step-num">3</div><div>Dokter membuka daftar antrean, mengisi diagnosis dan memilih obat resep.</div></div>
                        <div class="flow-step"><div class="flow-step-num">4</div><div>Biaya dihitung otomatis: <strong>Rp150.000 + Σ(harga obat)</strong> dan disimpan statis ke tabel periksa.</div></div>
                        <div class="flow-step"><div class="flow-step-num">5</div><div>Status pasien diubah menjadi <code>status_periksa = 1</code> (Sudah Diperiksa).</div></div>
                    </div>
                    <div class="flow-card">
                        <h4><span class="dot"></span>B. Management Riwayat Pasien</h4>
                        <div class="flow-step"><div class="flow-step-num">1</div><div><strong>Pasien</strong> melihat riwayat kunjungan beserta diagnosis, resep, dan biaya di dashboard pribadinya.</div></div>
                        <div class="flow-step"><div class="flow-step-num">2</div><div><strong>Dokter</strong> bisa melihat rekam medis semua pasien dan mengedit catatan/resep pemeriksaannya sendiri.</div></div>
                        <div class="flow-step"><div class="flow-step-num">3</div><div><strong>Walk-in</strong>: Dokter bisa mendaftarkan pasien langsung tanpa antrean online dengan tombol "Tambah Periksa".</div></div>
                        <div class="flow-step"><div class="flow-step-num">4</div><div><strong>Admin</strong> memiliki aksi Hapus Riwayat: menghapus data periksa & detail_periksa, lalu me-reset status ke 0 tanpa menghapus baris daftar_poli.</div></div>
                    </div>
                    <div class="flow-card" style="grid-column: 1 / -1;">
                        <h4><span class="dot"></span>C. Management Stok Obat (Admin CRUD)</h4>
                        <div class="flow-step"><div class="flow-step-num">1</div><div>Admin dapat menambah, mengedit, dan menghapus data obat (nama, kemasan, harga) melalui panel CRUD lengkap.</div></div>
                        <div class="flow-step"><div class="flow-step-num">2</div><div>Setiap obat baru langsung tersedia di formulir pemeriksaan dokter secara real-time.</div></div>
                        <div class="flow-step"><div class="flow-step-num">3</div><div>Perubahan harga obat di masa depan <strong>tidak merusak</strong> riwayat transaksi lama karena total biaya sudah tersimpan statis di tabel <code>periksa</code> (audit trail).</div></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 4: REASONING -->
        <div class="section">
            <div class="section-header">
                <div class="section-icon rose">💡</div>
                <div>
                    <h2>4. Reasoning — Alasan Perancangan Kode</h2>
                    <p>Penjelasan "mengapa" di balik setiap keputusan teknis yang dibuat</p>
                </div>
            </div>
            <div class="section-body">
                <div class="reason-card">
                    <div class="why">❓ Mengapa</div>
                    <h4>1. Auto-generasi No. RM di Model (Event Listener)</h4>
                    <p>Mengisi nomor Rekam Medis secara manual rawan duplikasi dan kesalahan pengetikan. Dengan memanfaatkan Eloquent Event <code>creating</code> pada model <code>User</code>, sistem otomatis membuat nomor RM format <code>YYYYMM-XXX</code> setiap kali pasien baru dibuat, tanpa intervensi manual dari admin maupun pasien.</p>
                </div>
                <div class="reason-card">
                    <div class="why">❓ Mengapa</div>
                    <h4>2. Dropdown AJAX Cascading di Form Registrasi</h4>
                    <p>Agar UX lebih responsif dan intuitif. Ketika pasien memilih Poli, mereka hanya ingin melihat dokter yang relevan pada poli tersebut — bukan seluruh dokter. Menggunakan Fetch API JavaScript alih-alih form reload menjaga performa dan pengalaman pengguna jauh lebih baik tanpa memerlukan package tambahan.</p>
                </div>
                <div class="reason-card">
                    <div class="why">❓ Mengapa</div>
                    <h4>3. Reset Status daripada Hard Delete di Riwayat Admin</h4>
                    <p>Jika admin langsung menghapus baris <code>daftar_poli</code>, nomor antrean pasien lain di jadwal yang sama akan menjadi "lompat" (tidak konsisten). Solusinya: hanya hapus rekam medis (<code>periksa</code> & <code>detail_periksa</code>), lalu kembalikan <code>status_periksa = 0</code> agar pasien kembali masuk antrean aktif dengan nomor antrean aslinya.</p>
                </div>
                <div class="reason-card">
                    <div class="why">❓ Mengapa</div>
                    <h4>4. Biaya Periksa Disimpan Statis (Audit Trail)</h4>
                    <p>Jika biaya dihitung secara dinamis setiap kali riwayat dibuka, maka perubahan harga obat di masa depan akan merusak laporan keuangan lama. Dengan menyimpan total biaya secara statis ke kolom <code>biaya_periksa</code> saat transaksi dilakukan, integritas data historis dan laporan keuangan klinik tetap terjaga.</p>
                </div>
            </div>
        </div>

        <!-- SECTION 5: KODE UTAMA -->
        <div class="section">
            <div class="section-header">
                <div class="section-icon indigo">💻</div>
                <div>
                    <h2>5. Potongan Kode Utama (Controller, Model, View)</h2>
                    <p>Kode esensial yang menunjukkan implementasi logika inti aplikasi</p>
                </div>
            </div>
            <div class="section-body">

                <div class="code-title">
                    <span>MODEL — Otomatisasi Nomor RM Pasien</span>
                    <span class="file-tag">User.php</span>
                </div>
<pre><span class="kw">protected static function</span> <span class="fn">boot</span>()
{
    <span class="kw">parent</span>::<span class="fn">boot</span>();

    <span class="kw">static</span>::<span class="fn">creating</span>(<span class="kw">function</span> (<span class="var">$user</span>) {
        <span class="kw">if</span> (<span class="var">$user</span>-><span class="var">role</span> === <span class="st">'pasien'</span> && <span class="fn">empty</span>(<span class="var">$user</span>-><span class="var">no_rm</span>)) {
            <span class="var">$yearMonth</span> = <span class="fn">now</span>()-><span class="fn">format</span>(<span class="st">'Ym'</span>); <span class="cm">// e.g. 202606</span>

            <span class="var">$lastPatient</span> = <span class="ty">self</span>::<span class="fn">where</span>(<span class="st">'role'</span>, <span class="st">'pasien'</span>)
                -><span class="fn">where</span>(<span class="st">'no_rm'</span>, <span class="st">'like'</span>, <span class="var">$yearMonth</span> . <span class="st">'-%'</span>)
                -><span class="fn">orderBy</span>(<span class="st">'no_rm'</span>, <span class="st">'desc'</span>)
                -><span class="fn">first</span>();

            <span class="var">$nextSequence</span> = <span class="var">$lastPatient</span>
                ? <span class="fn">intval</span>(<span class="fn">substr</span>(<span class="var">$lastPatient</span>-><span class="var">no_rm</span>, <span class="nm">7</span>)) + <span class="nm">1</span>
                : <span class="nm">1</span>;

            <span class="var">$user</span>-><span class="var">no_rm</span> = <span class="var">$yearMonth</span> . <span class="st">'-'</span> . <span class="fn">sprintf</span>(<span class="st">'%03d'</span>, <span class="var">$nextSequence</span>);
        }
    });
}</pre>

                <div class="code-title">
                    <span>CONTROLLER — Kalkulasi Biaya & Simpan Data Pemeriksaan</span>
                    <span class="file-tag">PeriksaPasienController.php</span>
                </div>
<pre><span class="cm">// 1. Hitung biaya periksa (Rp150.000 + total harga obat)</span>
<span class="var">$totalHargaObat</span> = <span class="ty">Obat</span>::<span class="fn">whereIn</span>(<span class="st">'id'</span>, <span class="var">$request</span>-><span class="var">obat_ids</span>)-><span class="fn">sum</span>(<span class="st">'harga'</span>);
<span class="var">$biayaPeriksa</span>   = <span class="nm">150000</span> + <span class="var">$totalHargaObat</span>;

<span class="cm">// 2. Simpan atau update rekam periksa</span>
<span class="kw">if</span> (<span class="var">$periksa</span>) {
    <span class="var">$periksa</span>-><span class="fn">update</span>([
        <span class="st">'tgl_periksa'</span>   => <span class="var">$request</span>-><span class="var">tgl_periksa</span>,
        <span class="st">'catatan'</span>       => <span class="var">$request</span>-><span class="var">catatan</span>,
        <span class="st">'biaya_periksa'</span> => <span class="var">$biayaPeriksa</span>,
    ]);
    <span class="ty">DetailPeriksa</span>::<span class="fn">where</span>(<span class="st">'id_periksa'</span>, <span class="var">$periksa</span>-><span class="var">id</span>)-><span class="fn">delete</span>(); <span class="cm">// reset resep lama</span>
}

<span class="cm">// 3. Simpan detail resep obat (tabel pivot)</span>
<span class="kw">foreach</span> (<span class="var">$request</span>-><span class="var">obat_ids</span> <span class="kw">as</span> <span class="var">$obatId</span>) {
    <span class="ty">DetailPeriksa</span>::<span class="fn">create</span>([<span class="st">'id_periksa'</span> => <span class="var">$periksa</span>-><span class="var">id</span>, <span class="st">'id_obat'</span> => <span class="var">$obatId</span>]);
}

<span class="cm">// 4. Tandai pasien sebagai sudah diperiksa</span>
<span class="var">$daftarPoli</span>-><span class="fn">update</span>([<span class="st">'status_periksa'</span> => <span class="nm">1</span>]);</pre>

                <div class="code-title">
                    <span>CONTROLLER — Hapus Riwayat dengan Aman (Reset Status)</span>
                    <span class="file-tag">Admin/RiwayatPasienController.php</span>
                </div>
<pre><span class="kw">public function</span> <span class="fn">destroy</span>(<span class="var">$daftarPoliId</span>)
{
    <span class="var">$daftarPoli</span> = <span class="ty">DaftarPoli</span>::<span class="fn">findOrFail</span>(<span class="var">$daftarPoliId</span>);
    <span class="var">$pasienId</span>   = <span class="var">$daftarPoli</span>-><span class="var">id_pasien</span>;

    <span class="ty">DB</span>::<span class="fn">beginTransaction</span>();
    <span class="kw">try</span> {
        <span class="var">$periksa</span> = <span class="ty">Periksa</span>::<span class="fn">where</span>(<span class="st">'id_daftar_poli'</span>, <span class="var">$daftarPoliId</span>)-><span class="fn">first</span>();
        <span class="kw">if</span> (<span class="var">$periksa</span>) {
            <span class="ty">DetailPeriksa</span>::<span class="fn">where</span>(<span class="st">'id_periksa'</span>, <span class="var">$periksa</span>-><span class="var">id</span>)-><span class="fn">delete</span>();
            <span class="var">$periksa</span>-><span class="fn">delete</span>();
        }
        <span class="cm">// Reset ke antrean aktif (TIDAK menghapus daftar_poli)</span>
        <span class="var">$daftarPoli</span>-><span class="fn">update</span>([<span class="st">'status_periksa'</span> => <span class="nm">0</span>]);

        <span class="ty">DB</span>::<span class="fn">commit</span>();
        <span class="kw">return</span> <span class="fn">redirect</span>()-><span class="fn">route</span>(<span class="st">'admin.riwayat.show'</span>, <span class="var">$pasienId</span>)
            -><span class="fn">with</span>(<span class="st">'success'</span>, <span class="st">'Riwayat berhasil dihapus.'</span>);
    } <span class="kw">catch</span> (\<span class="ty">Exception</span> <span class="var">$e</span>) {
        <span class="ty">DB</span>::<span class="fn">rollback</span>();
        <span class="kw">return</span> <span class="fn">back</span>()-><span class="fn">with</span>(<span class="st">'error'</span>, <span class="var">$e</span>-><span class="fn">getMessage</span>());
    }
}</pre>

                <div class="code-title">
                    <span>VIEW — JavaScript Cascading Dropdown (AJAX)</span>
                    <span class="file-tag">pasien/dashboard.blade.php</span>
                </div>
<pre><span class="cm">// Ketika Poli dipilih, muat daftar Dokter secara dinamis</span>
<span class="var">poliSelect</span>.<span class="fn">addEventListener</span>(<span class="st">'change'</span>, <span class="kw">function</span>() {
    <span class="kw">const</span> <span class="var">idPoli</span> = <span class="kw">this</span>.<span class="var">value</span>;
    <span class="var">dokterSelect</span>.<span class="var">innerHTML</span> = <span class="st">'&lt;option value=""&gt;-- Pilih Dokter --&lt;/option&gt;'</span>;
    <span class="var">dokterSelect</span>.<span class="var">disabled</span> = <span class="kw">true</span>;

    <span class="kw">if</span> (!<span class="var">idPoli</span>) <span class="kw">return</span>;

    <span class="cm">// Endpoint AJAX → mengembalikan JSON daftar dokter</span>
    <span class="fn">fetch</span>(<span class="st">`/pasien/get-dokter/<span class="var">${idPoli}</span>`</span>)
        .<span class="fn">then</span>(<span class="var">res</span> => <span class="var">res</span>.<span class="fn">json</span>())
        .<span class="fn">then</span>(<span class="var">data</span> => {
            <span class="var">data</span>.<span class="fn">forEach</span>(<span class="var">dokter</span> => {
                <span class="var">dokterSelect</span>.<span class="var">innerHTML</span> +=
                    <span class="st">`&lt;option value="${<span class="var">dokter</span>.<span class="var">id</span>}"&gt;${<span class="var">dokter</span>.<span class="var">nama</span>}&lt;/option&gt;`</span>;
            });
            <span class="var">dokterSelect</span>.<span class="var">disabled</span> = <span class="kw">false</span>;
        });
});</pre>

            </div>
        </div>

        <!-- SECTION 6: NASKAH PRESENTASI -->
        <div class="section">
            <div class="section-header">
                <div class="section-icon amber">🎙️</div>
                <div>
                    <h2>6. Naskah Presentasi Individu</h2>
                    <p>Panduan berbicara per segmen waktu selama presentasi tatap muka</p>
                </div>
            </div>
            <div class="section-body">
                <div class="script-block">
                    <span class="time-tag">Menit 0:00 – 1:30 | Pembukaan & Database</span>
                    <blockquote>
                        "Selamat pagi/siang Bapak/Ibu Dosen Penguji. Hari ini saya akan mempresentasikan proyek UAS Bengkel Koding — Aplikasi Manajemen Poliklinik. Aplikasi ini dirancang untuk memfasilitasi tiga peran: Admin, Dokter, dan Pasien, yang saling terintegrasi melalui satu platform berbasis web Laravel.
                        <br><br>
                        Pondasi sistem ini adalah basis data relasional yang terdiri dari 7 tabel utama. Tabel <code>users</code> menampung tiga peran sekaligus. Tabel <code>daftar_poli</code> menjadi inti transaksi antrean, sedangkan tabel <code>periksa</code> dan <code>detail_periksa</code> menyimpan hasil rekam medis dan resep obat secara terstruktur."
                    </blockquote>
                </div>

                <div class="script-block">
                    <span class="time-tag">Menit 1:30 – 3:00 | Demo Sisi Pasien</span>
                    <blockquote>
                        "Di sisi Pasien, ketika mereka pertama kali mendaftar, sistem secara otomatis membuat nomor Rekam Medis unik dengan format tahun-bulan plus nomor urut, seperti 202606-001. Ini dilakukan tanpa intervensi manual menggunakan Eloquent Event di model User.
                        <br><br>
                        Di dashboard, pasien dapat mendaftarkan pemeriksaan menggunakan formulir dinamis yang menggunakan AJAX. Ketika memilih Poli, daftar Dokter langsung diperbarui tanpa reload halaman. Setelah terdaftar, nomor antrean aktif ditampilkan sebagai tiket yang bisa langsung dicetak."
                    </blockquote>
                </div>

                <div class="script-block">
                    <span class="time-tag">Menit 3:00 – 5:30 | Demo Dokter & Admin</span>
                    <blockquote>
                        "Di sisi Dokter, antrean pasien yang baru mendaftar akan muncul di menu Periksa Pasien. Dokter mengisi diagnosis, memilih obat resep, dan sistem langsung menghitung total biaya secara otomatis: Rp150.000 jasa dokter ditambah total harga semua obat yang dipilih.
                        <br><br>
                        Biaya ini disimpan secara statis agar tidak berubah jika harga obat direvisi di masa depan — ini adalah prinsip audit trail dalam sistem keuangan.
                        <br><br>
                        Di sisi Admin, tersedia master data obat dengan CRUD lengkap. Admin juga dapat mengelola riwayat periksa dengan aksi hapus yang aman — hanya rekam medis yang dihapus, bukan antrian aslinya, sehingga konsistensi sistem terjaga."
                    </blockquote>
                </div>

                <div class="script-block">
                    <span class="time-tag">Menit 5:30 – 7:00 | Riwayat Pasien & Penutup</span>
                    <blockquote>
                        "Fitur Riwayat Pasien tersedia di ketiga peran. Pasien melihat semua riwayat kunjungan mereka beserta diagnosis dan resep. Dokter dapat mengedit catatan pemeriksaan lama atau menambahkan pemeriksaan walk-in langsung. Admin mendapatkan statistik total kunjungan dan kendali penuh atas data historis.
                        <br><br>
                        Secara keseluruhan, proyek ini mengimplementasikan best practices seperti: pemisahan concern melalui MVC, AJAX untuk responsivitas UI, transaction database untuk keamanan data, dan audit trail untuk integritas laporan. Demikian presentasi dari saya, terima kasih — saya persilakan untuk pertanyaan."
                    </blockquote>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
