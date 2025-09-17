<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <title>Laporan LAPIS #<?= $laporan->lapis_bil ?></title>
    <style>
        @page {
            margin: 20mm;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.5;
            color: #333;
        }
        #header {
            position: fixed;
            top: -20mm;
            left: 0;
            right: 0;
            height: 20mm;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        #footer {
            position: fixed;
            bottom: -20mm;
            left: 0;
            right: 0;
            height: 20mm;
            text-align: center;
            font-size: 9pt;
            color: #777;
            border-top: 1px solid #ddd;
        }
        #footer .page:after {
            content: counter(page);
        }
        .report-title {
            font-size: 18pt;
            font-weight: bold;
            text-align: center;
            margin-bottom: 5px;
        }
        .report-subtitle {
            font-size: 12pt;
            text-align: center;
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 13pt;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 10px;
            background-color: #f2f2f2;
            padding: 8px;
            border-left: 4px solid #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        td, th {
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        .label {
            width: 30%;
            font-weight: bold;
            background-color: #f9f9f9;
        }
        .value {
            width: 70%;
        }
        .content-block {
            border: 1px solid #eee;
            padding: 10px;
            min-height: 100px;
            background-color: #fafafa;
        }
    </style>
</head>
<body>
    <div id="header">
        <!-- Anda boleh letak logo di sini -->
        <!-- <img src="path/to/your/logo.png" style="height: 15mm;"> -->
        <p>LAPORAN SULIT</p>
    </div>

    <div id="footer">
        Dicetak oleh RIMS@2025 | Halaman <span class="page"></span>
    </div>

    <div class="main-content">
        <div class="report-title">LAPORAN ISU RIMS@LAPIS 2.0</div>
        <div class="report-subtitle">Laporan #<?= htmlspecialchars($laporan->lapis_bil, ENT_QUOTES, 'UTF-8') ?></div>

        <div class="section-title">MAKLUMAT ASAS</div>
        <table>
            <tr>
                <td class="label">Tarikh Laporan</td>
                <td class="value"><?= date('d F Y', strtotime($laporan->lapis_tarikh_laporan)) ?></td>
            </tr>
            <tr>
                <td class="label">Pelapor</td>
                <td class="value"><?= htmlspecialchars($laporan->lapis_pelapor_nama, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
            <tr>
                <td class="label">Status</td>
                <td class="value"><?= htmlspecialchars($laporan->lapis_status, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
        </table>

        <div class="section-title">BUTIRAN ISU</div>
        <table>
            <tr>
                <td class="label">Tajuk Isu</td>
                <td class="value"><?= htmlspecialchars($laporan->lapis_tajuk_isu, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
            <tr>
                <td class="label">Kluster</td>
                <td class="value"><?= htmlspecialchars($laporan->lapis_kluster_nama, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
        </table>
        
        <p><strong>Ringkasan Isu:</strong></p>
        <div class="content-block">
            <?= $laporan->lapis_ringkasan_isu ?>
        </div>

        <p style="margin-top: 15px;"><strong>Cadangan Intervensi:</strong></p>
        <div class="content-block">
            <?= $laporan->lapis_cadangan_intervensi ?>
        </div>

        <div class="section-title">MAKLUMAT KAWASAN</div>
        <table>
            <tr>
                <td class="label">Negeri</td>
                <td class="value"><?= htmlspecialchars($laporan->lapis_negeri_nama, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
            <tr>
                <td class="label">Daerah</td>
                <td class="value"><?= htmlspecialchars($laporan->lapis_daerah_nama, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
            <tr>
                <td class="label">Parlimen</td>
                <td class="value"><?= htmlspecialchars($laporan->lapis_parlimen_nama, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
            <tr>
                <td class="label">DUN</td>
                <td class="value"><?= htmlspecialchars($laporan->lapis_dun_nama, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
            <tr>
                <td class="label">Daerah Mengundi</td>
                <td class="value"><?= htmlspecialchars($laporan->lapis_dm_nama, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
            <tr>
                <td class="label">Jenis Kawasan</td>
                <td class="value"><?= htmlspecialchars($laporan->lapis_jenis_kawasan, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
            <tr>
                <td class="label">Nama Lokasi</td>
                <td class="value"><?= htmlspecialchars($laporan->lapis_lokasi, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
            <tr>
                <td class="label">Koordinat</td>
                <td class="value"><?= htmlspecialchars($laporan->lapis_latitude, ENT_QUOTES, 'UTF-8') ?>, <?= htmlspecialchars($laporan->lapis_longitude, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
        </table>
    </div>
</body>
</html>
