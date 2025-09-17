<?php 
$this->load->view('negeri_na/susunletak/atas');
$this->load->view('negeri_na/susunletak/sidebar');
$this->load->view('negeri_na/susunletak/navbar');


//SEANDAINYA TIDAK BERTARIKH
if(empty($tarikhHarian)){
    $tarikhHarian = date('Y-m-d');
}
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('harian') ?>">Harian</a></li>
                <li class="breadcrumb-item active">Etnografi DUN</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Carian Status Grading Harian Mengikut Tarikh</h1>
            <p>Tarikh: <strong><?= $tarikhHarian ?></strong></p>
            <?= form_open('harian/pilihanrayaDun/'.$pru->pilihanraya_bil) ?>
                <div class="form-floating mb-3">
                <input type="date" name="inputTarikh" id="inputTarikh" placeholder="Tarikh" value="<?= $tarikhHarian ?>" class="form-control" required>
                <label for="inputTarikh" class="form-label">Tarikh</label>
                </div>
                <button type="submit" class="btn btn-outline-primary shadow-sm">Cari</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Maklumat Harian <?= $pru->pilihanraya_singkatan ?></h1>
            <p>Tarikh: <strong><?= $tarikhHarian ?></strong></p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama DUN</th>
                            <th>Status Grading</th>
                            <th>Parti</th>
                            <th>Operasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($senaraiNegeri as $negeri): 
                            $senaraiDun = $dataDun->senaraiDunPruIkutNegeri($pru->pilihanraya_bil, $negeri->nt_bil);
                        ?>
                        <?php 
                            foreach($senaraiDun as $dun): 
                                $harianDun = $dataHarian->statusHari($dun->dun_bil, $pru->pilihanraya_bil, $tarikhHarian);
                                if(!empty($harianDun)):
                        ?>
                        <tr>
                            <td><?= $dun->dun_nama ?></td>
                            <td style="<?= $harianDun->harian_color ?>"><?= $harianDun->harian_grading ?></td>
                            <td style="<?= $harianDun->parti_warna ?>"><?= $harianDun->parti_nama ?> (<?= $harianDun->parti_singkatan ?>)</td>
                            <td>
                                <!-- Large Modal -->
                                <button type="button" class="btn btn-outline-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#lihat<?= $harianDun->harian_bil ?>">
                                    Lihat
                                </button>

                                <div class="modal fade" id="lihat<?= $harianDun->harian_bil ?>" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title">Maklumat Harian DUN <?= $dun->dun_nama ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-borderless">
                                                    <tr>
                                                        <th>Tarikh</th>
                                                        <td><?= $tarikhHarian ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Pilihan Raya</th>
                                                        <td><?= $harianDun->pilihanraya_nama ?> (<?= $harianDun->pilihanraya_singkatan ?>)</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jangkaan Keluar Mengundi</th>
                                                        <td><?= $harianDun->harian_keluar_mengundi ?>%</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status Grading</th>
                                                        <td style="<?= $harianDun->harian_color ?>"><?= $harianDun->harian_grading ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Pilihan Parti</th>
                                                        <td style="<?= $harianDun->parti_warna ?>"><?= $harianDun->parti_nama ?> (<?= $harianDun->parti_singkatan ?>)</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Atas Pagar / Rosak</th>
                                                        <td><?= $harianDun->harian_atas_pagar ?>%</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tarikh Kemaskini</th>
                                                        <td><?= $harianDun->harian_waktu ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th colspan='2'>Justifikasi</th>
                                                    </tr>
                                                    <tr>
                                                        <td colspan='2'><?= $harianDun->harian_ulasan ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                    </div>
                                </div><!-- End Large Modal-->
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    </section>

</main>


<?php $this->load->view('negeri_na/susunletak/bawah'); ?>