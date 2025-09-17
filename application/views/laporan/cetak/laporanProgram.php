<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo base_url(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: smaller;
        }
    </style>
    <title>RIMS@PROGRAM - LAPORAN PROGRAM</title>
</head>
<body>

    <div class="text-end mb-3">
        <small class="text-muted">NOMBOR SIRI : <?= $program->programBil ?></small>
    </div>

    <div class="text-center mb-3">
        <h3>LAPORAN PELAKSANAAN AKTIVITI
            <br><?= strtoupper($pengguna->pengguna_tempat_tugas) ?>
        </h3>
    </div>

    <table class="table table-borderless">
            <tr class="bg-warning">
                <th>1</th>
                <th colspan=3>MAKLUMAT AM</th>
            </tr>
            <tr>
                <td>1.1</td>
                <th>PROGRAM</th>
                <td>:</td>
                <td><?= $program->programNama ?></td>
            </tr>
            <tr>
                <td>1.2</td>
                <th>DAERAH</th>
                <td>:</td>
                <td><?= $program->daerahNama ?></td>
            </tr>
            <tr>
                <td>1.3</td>
                <th>KAPAR</th>
                <td>:</td>
                <td><?= $program->parlimenNama ?></td>
            </tr>
            <tr>
                <td>1.4</td>
                <th>KADUN</th>
                <td>:</td>
                <td><?= $program->dunNama ?></td>
            </tr>
            <tr>
                <td>1.5</td>
                <th>NARATIF / TAJUK HEBAHAN / CERAMAH PROGRAM</th>
                <td>:</td>
                <td><?= $program->naratifSenarai ?></td>
            </tr>
            <tr>
                <td>1.6</td>
                <th>LOKASI</th>
                <td>:</td>
                <td><?= $program->lokasiSenarai ?></td>
            </tr>
            <tr>
                <td>1.7</td>
                <th>TARIKH</th>
                <td>:</td>
                <td><?= $program->programTarikh ?></td>
            </tr>
            <tr>
                <td>1.8</td>
                <th>MASA</th>
                <td>:</td>
                <td><?= $program->programMasa ?></td>
            </tr>
            <tr>
                <td>1.9</td>
                <th>JUMLAH EDARAN / SUMBANGAN</th>
                <td>:</td>
                <td><?= $program->edaranBilangan ?></td>
            </tr>
            <tr>
                <td>1.10</td>
                <th>JUMLAH KHALAYAK</th>
                <td>:</td>
                <td><?= $program->programKhalayak ?> ORANG</td>
            </tr>
            <tr>
                <td>1.11</td>
                <th>AGENSI YANG TERLIBAT</th>
                <td>:</td>
                <td><?= $program->agensiSenarai ?></td>
            </tr>
            <tr class="bg-warning">
                <th>2</th>
                <th colspan=3>AKTIVITI</th>
            </tr>
            <?php $count=1; foreach($senaraiAktiviti as $aktiviti): ?>
            <tr>
                <td>2.<?= $count++ ?></td>
                <td colspan=3><?= $aktiviti->aktivitiNama ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="bg-warning">
                <th>3</th>
                <th colspan=3>SENARAI OBP</th>
            </tr>
            <?php $count=1; foreach($senaraiObp as $obp): ?>
            <tr>
                <td>3.<?= $count++ ?></td>
                <th colspan=3><?= $obp->obpNama ?></th>
            </tr>
            <?php endforeach; ?>
            <tr class="bg-warning">
                <th>4</th>
                <th colspan=3>KOMUNITI</th>
            </tr>
            <?php $count=1; foreach($senaraiKomuniti as $komuniti): ?>
            <tr>
                <td>4.<?= $count++ ?></td>
                <td colspan=2><?= $komuniti->komunitiNama ?></td>
                <td><?= $komuniti->komunitiBilangan ?> ORANG</td>
            </tr>
            <?php endforeach; ?>
            <tr class="bg-warning">
                <th>5</th>
                <th colspan=3>KELAB MALAYSIAKU</th>
            </tr>
            <?php $count=1; foreach($senaraiKelabMalaysiaku as $kelab): ?>
            <tr>
                <td>5.<?= $count++ ?></td>
                <td colspan=3><?= $kelab->kelabNama ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="bg-warning">
                <th>6</th>
                <th colspan=3>GAMBAR</th>
            </tr>
            <?php $count=1; foreach($senaraiGambar as $gambar): 
                $filePointers = './assets/img/gambarProgram/'.$gambar->gambarNamaFail;
                if(file_exists($filePointers)){
                    $url = base_url('assets/img/gambarProgram/').$gambar->gambarNamaFail;
                    $headers = get_headers($url, 1);
                ?>
                
            <tr>
                <td>6.<?= $count++ ?></td>
                <td colspan=3>
                    <?= $gambar->gambarDeskripsi ?>
                </td>
            </tr>
            <tr>
                <td colspan=4 class="text-center">
                    <?php if(strpos($headers['Content-Type'], 'image/') !== FALSE): ?>
                    <img 
                        src="<?= $url ?>" 
                        class="img-fluid" 
                        style="max-width: 600px; max-height: 400px; width: 100%; height: auto; object-fit: contain;" 
                        alt="<?= htmlspecialchars($gambar->gambarDeskripsi, ENT_QUOTES, 'UTF-8') ?>. "
                    >
                    <?php endif; ?>
                </td>
            </tr>
            <?php
                } 
                endforeach; ?>
            <tr class="bg-warning">
                <th>7</th>
                <th colspan=3>KERATAN AKHBAR</th>
            </tr>
            <?php $count=1; foreach($senaraiKeratanAkhbar as $akhbar): 
                $filePointers = './assets/img/keratanAkhbarProgram/'.$akhbar->keratan_akhbar_program_nama_fail;
                if(file_exists($filePointers)){
                    $url = base_url('assets/img/keratanAkhbarProgram/').$akhbar->keratan_akhbar_program_nama_fail;
                    $headers = get_headers($url, 1);
                ?>
                
            <tr>
                <td>7.<?= $count++ ?></td>
                <td colspan=3>
                    <?= $akhbar->keratan_akhbar_program_deskripsi ?>
                </td>
            </tr>
            <tr>
                <td colspan=4 class="text-center">
                    <?php if(strpos($headers['Content-Type'], 'image/') !== FALSE): ?>
                    <img 
                        src="<?= $url ?>" 
                        class="img-fluid" 
                        style="max-width: 600px; max-height: 400px; width: 100%; height: auto; object-fit: contain;" 
                        alt="<?= htmlspecialchars($gambar->gambarDeskripsi, ENT_QUOTES, 'UTF-8') ?>. "
                    >
                    <?php endif; ?>
                </td>
            </tr>
            <?php
                } 
                endforeach; ?>
            <tr>
                <th>8</th>
                <th>DISEDIAKAN OLEH</th>
                <td>:</td>
                <td>
                    <?= $program->pelaporNama ?>
                    <br /><?= $program->pelaporJawatan ?>
                    <br /><?= $program->pelaporPenempatan ?>
                    <br /><?= $program->pelaporNomborTelefon ?>
                    <br /><?= $program->pelaporEmel ?>
                </td>
            </tr>
        </table>

        
        <div class="text-center">
        <small class="text-muted">Dibina oleh Reporting and Issues Management System (RIMS) pada <?= date("Y-m-d H:i:s") ?></small>
        </div>

        <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500); // Delays print by 500ms
        };
        </script>
   
</body>
</html>