<?php
$senaraiKriteria = array(
    ["tajuk" => "1. Nombor Siri Laporan:", "perkara" => $laporan->libatUrusBil],
    ["tajuk" => "2. Tajuk Perjumpaan:", "perkara" => $laporan->libatUrusNama],
    ["tajuk" => "3. Tarikh dan Masa:", "perkara" => $laporan->libatUrusTarikhMasa],
    ["tajuk" => "4. Pelapor:", "perkara" => $laporan->libatUrusPelaporNama . ", " . $laporan->libatUrusPelaporJawatan . ", " . $laporan->libatUrusPelaporPenempatan . ", " .$laporan->libatUrusPelaporNoTel ],
    ["tajuk" => "5. Lokasi:", "perkara" => $laporan->libatUrusLokasi],
    ["tajuk" => "6. Catatan / Rumusan Perjumpaan:", "perkara" => $laporan->libatUrusCatatan],
);
?>

<div class="card">
        <div class="card-body">
            <h1 class="card-title">Laporan Libat Urus Komuniti Siri <?= $laporan->libatUrusBil ?> <?= date_format(date_create($laporan->libatUrusTarikh), "d.m.Y") ?></h1>
            <div class="row g-3">
                <?php foreach($senaraiKriteria as $kriteria): ?>
                <div class="col col-lg d-flex align-items-stretch">
                    <div class="p-3 w-100 d-flex flex-column">
                        <div class="text-secondary"><?= $kriteria['tajuk'] ?></div>
                        <p class="text-start"><?= $kriteria['perkara'] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Komuniti</h1>
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>Bil</th>
                            <th>Nama Komuniti</th>
                            <th>Negeri</th>
                            <th>Daerah</th>
                            <th>Parlimen</th>
                            <th>DUN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $bil = 1; foreach($senaraiKomuniti as $komuniti): ?>
                        <tr>
                            <td><?= $bil++ ?></td>
                            <td><?= $komuniti->komunitiNama ?></td>
                            <td><?= $komuniti->negeriNama ?></td>
                            <td><?= $komuniti->daerahNama ?></td>
                            <td><?= $komuniti->parlimenNama ?></td>
                            <td><?= $komuniti->dunNama ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
                Senarai Gambar / Video
            </h1>   
            <div class="row g-3">
                            <?php foreach($gambarLibatUrus as $bg): ?>
                            <div class="col-12 col-lg-3 col-md-4 col-sm-6">
                                <div class="text-center border rounded">
                                    <img src="<?= base_url() ?>assets/img/gambarKomuniti/<?= $bg->gambarNama ?>" alt="<?= $laporan->libatUrusNama?> <?= $bg->gambarBil ?>" style="object-fit:cover; height:400px; width:100%;">
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
        </div>
    </div>