<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">LAMAN UTAMA</li>
                <li class="breadcrumb-item">PILIHAN RAYA</li>
                <li class="breadcrumb-item active"><?= $pr->pilihanraya_nama ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">MAKLUMAT ASAS</h1>
            <div class="table-responsive">
            <table class="table table-bordered table-striped">
        <tr>
          <th>Nama Pilihan Raya</th>
          <td><?= $pr->pilihanraya_nama ?></td>
</tr>
<tr>
          <th>Singkatan Pilihan Raya</th>
          <td><?= $pr->pilihanraya_singkatan ?></td>
</tr>
<tr>
          <th>Tahun</th>
          <td><?= $pr->pilihanraya_tahun ?></td>
</tr>
<tr>
          <th>Tarikh Penamaan Calon</th>
          <td><?= $pr->pilihanraya_penamaan_calon ?></td>
</tr>
<tr>
          <th>Tarikh Lock Status</th>
          <td><?= $pr->pilihanraya_lock_status ?></td>
</tr>
<tr>
          <th>Jenis Pilihan Raya</th>
          <td><?= $pr->pilihanraya_jenis ?></td>
</tr>
      </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">SENARAI PARLIMEN / DUN</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr class="bg-warning">
                            <th colspan=2>BILANGAN KERUSI</th>
                            <th class="text-center"><?= count($senaraiKawasan) ?></th>
                        </tr>
                        <tr class="bg-primary text-white">
                            <th class="text-center">BIL</th>
                            <th class="text-center">PARLIMEN / DUN</th>
                            <th class="text-center">NEGERI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; foreach($senaraiKawasan as $kaw): ?>
                        <tr>
                            <td class="text-center"><?= $count++ ?></td>
                            <td><?= $kaw->nama ?></td>
                            <td><?= $kaw->negeri ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">MODUL JANGKAAN CALON</h1>

            <div class="p-3 border rounded mb-3">
                <h3>MENGIKUT KERUSI</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th class="text-center">BIL</th>
                            <th>PARLIMEN / DUN</th>
                            <th class="text-center">BILANGAN CALON</th>
                        </tr>
                        <?php $jumlah = 0; $count = 1; foreach($kawasanBilanganCalon as $kc): $jumlah = $jumlah + $kc->bilanganCalon; ?>
                        <tr>
                            <td class="text-center"><?= $count++ ?></td>
                            <td><?= $kc->kerusiNama ?></td>
                            <td class="text-center"><?= $kc->bilanganCalon ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <th colspan=2 class="text-center">JUMLAH</th>
                            <th class="text-center"><?= $jumlah ?></th>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="p-3 border rounded mb-3">
                <h3>MENGIKUT PARTI</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">BIL</th>
                                <th class="text-center">LOGO PARTI</th>
                                <th class="text-center">PARTI</th>
                                <th>NAMA PARTI</th>
                                <th class="text-center">BILANGAN CALON</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $jumlahPc = 0; $count = 1; foreach($partiBilanganCalon as $pc): $jumlahPc = $jumlahPc + $pc->bilanganCalon;?>
                            <tr style="<?= $pc->partiWarna ?>">
                                <td class="text-center"><?= $count++ ?></td>
                                <td class="text-center">
                                <img src="<?php echo base_url('assets/img/').$pc->fotoParti; ?>" style="object-fit: contain;width: 100px;height: 100px;"/>
                                </td>
                                <td class="text-center"><h4><?= $pc->partiSingkatan ?></h4></td>
                                <td>
                                    
                                    <?= $pc->partiNama ?>
                                </td>
                                <td class="text-center"><?= $pc->bilanganCalon ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th colspan=4 class="text-center">JUMLAH</th>
                                <th class="text-center"><?= $jumlahPc ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">MODUL HARI PENAMAAN CALON</h1>
            <div class="table-responsive">
                <table class="table table-sm datatable">
                    <thead>
                        <th>Nombor Siri Pencalonan</th>
                        <th>Parlimen / DUN</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Parti</th>
                        <th>Umur</th>
                        <th>Jantina</th>
                        <th>Pendidikan</th>
                        <th>Kaum</th>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiCalon as $calon): ?>
                            <tr>
                                <td><?= $calon->nomborSiri ?></td>
                                <td><?= $calon->kawasanNama ?></td>
                                <td>
                                <img class="img-fluid" style="max-width: 200px; max-height: 200px; object-fit:scale-down;" src="<?= base_url() ?>assets/img/<?= $calon->gambarNama ?>" alt="<?= $calon->calonNama ?>">    
                                </td>
                                <td><?= $calon->calonNama ?></td>
                                <td><?= $calon->namaParti ?></td>
                                <td><?= $calon->calonUmur ?></td>
                                <td><?= $calon->calonJantina ?></td>
                                <td><?= $calon->calonPendidikan ?></td>
                                <td><?= $calon->calonKaum ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">MODUL GRADING</h1>
            <div class="p-3 border rounded mb-3">
                <h3>MENGIKUT PARLIMEN / DUN</h3>
                <div class="row g-3">
                    <?php foreach($senaraiKawasanGrading as $kawasan): ?>
                    <div class="col col-lg-4 d-flex align-items-stretch">
                        <div class="p-3 border rounded w-100 d-flex flex-column" style="<?= $kawasan->color ?>">
                            <div class="mb-3">
                                <div class=""><strong><?= $kawasan->kawasanNama ?></strong></div>
                            </div>
                            <div class="table-responsive my-auto">
                                    <table class="table" style="<?= $kawasan->color ?>">
                                        <thead>
                                            <tr>
                                                <th>Grading</th>
                                                <td class="text-end"><?= $kawasan->grading ?></td>
                                            </tr>
                                            <tr>
                                                <th>Peratus Keluar Mengundi</th>
                                                <td class="text-end"><?= $kawasan->keluarMengundi ?>%</td>
                                            </tr>
                                            <tr>
                                                <th>Peratus Atas Pagar</th>
                                                <td class="text-end"><?= $kawasan->keluarMengundi ?>%</td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>
                                                    <strong>Ulasan:</strong><br>
                                                    <?= $kawasan->ulasan ?>
                                                </td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            <div class="mt-auto">
                                <div class="text-end bg-white text-primary rounded"><small class="me-2"><?= $kawasan->pelaporNama ?> | <?= $kawasan->harianTarikh ?></small></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="p-3 border rounded mb-3">
                <h3>RUMUSAN LOCK STATUS</h3>
                <div class="row g-3">
                    <?php foreach($senaraiRumusanLockStatus as $rls): ?>
                    <div class="col col-lg-2 d-flex align-items-stretch">
                        <div class="p-3 border rounded w-100 d-flex flex-column text-center">
                            <img src="<?= base_url() ?>assets/img/<?= $rls->partiFoto ?>" alt="<?= $rls->partiSingkatan ?>" class="img-fluid mx-auto my-auto" style="max-width: 200px; max-height: 200px;">
                            <div class="display-1 mt-auto"><?= $rls->bilanganKerusi ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="p-3 border rounded">
                <h3>MENGIKUT LOCK STATUS</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Bil</th>
                                <th class="text-center">Parlimen / DUN</th>
                                <th class="text-center">Parti</th>
                                <th class="text-center">Calon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; foreach($senaraiLockStatus as $ls): ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= $ls->kawasanNama ?></td>
                                <td>
                                    <div class="d-flex flex-column text-center">
                                        <img src="<?= base_url() ?>assets/img/<?= $ls->partiFoto ?>" alt="<?= $ls->partiSingkatan ?>" class="img-fluid mx-auto my-auto" style="max-width: 200px; max-height: 200px;">
                                        <?= $ls->partiNama ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column text-center">
                                        <img class="img-fluid mx-auto" style="max-width: 200px; max-height: 200px; object-fit:scale-down;" src="<?= base_url() ?>assets/img/<?= $ls->gambarNama ?>" alt="<?= $ls->calonNama ?>">    
                                        <?= $ls->calonNama ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">MODUL HARI MENGUNDI</h1>
            <div class="row g-3 mb-3">
                <div class="col-12 col-lg-6 d-flex align-items-stretch">
                    <div class="p-3 border rounded w-100 d-flex flex-column">
                        <h4>KEPUTUSAN RASMI</h4>
                        <div class="row g-3 my-auto">
                            <?php foreach($senaraiKeputusanRasmi as $skr): ?>
                            <div class="col col-lg-2 d-flex align-items-stretch">
                                <div class="p-3 border rounded w-100 d-flex flex-column text-center">
                                    <img src="<?= base_url() ?>assets/img/<?= $skr->partiFoto ?>" alt="<?= $skr->partiSingkatan ?>" class="img-fluid mx-auto my-auto" style="max-width: 50px; max-height: 200px;">
                                    <div class="display-1 mt-auto"><?= $skr->bilanganKerusi ?></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 d-flex align-items-stretch">
                    <div class="p-3 border rounded w-100 d-flex flex-column">
                        <h4>KEPUTUSAN TIDAK RASMI</h4>
                        <div class="row g-3 my-auto">
                            <?php foreach($senaraiKeputusanTidakRasmi as $sktr): ?>
                            <div class="col col-lg-2 d-flex align-items-stretch">
                                <div class="p-3 border rounded w-100 d-flex flex-column text-center">
                                    <img src="<?= base_url() ?>assets/img/<?= $sktr->partiFoto ?>" alt="<?= $sktr->partiSingkatan ?>" class="img-fluid mx-auto my-auto" style="max-width: 50px; max-height: 200px;">
                                    <div class="display-1 mt-auto"><?= $sktr->bilanganKerusi ?></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-3 border rounded">
                <h3>MENGIKUT KEPUTUSAN</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Bil</th>
                                <th class="text-center">Parlimen / DUN</th>
                                <th class="text-center">Pilihan JAPEN</th>
                                <th class="text-center">Keputusan Tidak Rasmi</th>
                                <th class="text-center">Keputusan Rasmi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; foreach($senaraiKeputusan as $k): ?>
                            <tr>
                                <td class="text-center"><?= $count++ ?></td>
                                <td><?= $k->kawasanNama ?></td>
                                <td class="text-center"><?= $k->partiJangkaanJapen ?></td>
                                <td class="text-center"><?= $k->partiKeputusanTidakRasmi ?></td>
                                <td class="text-center"><?= $k->partiKeputusanSebenar ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    

    </section>

</main>


<?php $this->load->view($footer); ?>