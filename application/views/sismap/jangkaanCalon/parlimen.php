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
                <li class="breadcrumb-item"><a href="<?= site_url('winnable_candidate') ?>">JANGKAAN CALON</a></li>
                <li class="breadcrumb-item"><?= strtoupper($parlimen->pt_negeri) ?></li>
                <li class="breadcrumb-item active"><?= strtoupper($parlimen->pt_nama) ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        
        <?php $this->load->view('us_sismap_na/sismap/jangkaan_calon/nav'); ?>

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Jangkaan Calon <?= $parlimen->pt_nama ?></h1>
                <?php foreach($senaraiCalon as $calon): ?>
                    <hr>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th style="<?= $calon->partiWarna ?>">Nama</th>
                            <td><a href="<?= site_url('winnable_candidate/calonParlimen/'.$calon->calonBil) ?>"><?= strtoupper($calon->calonNama) ?></a></td>
                            <td rowspan=5 class="text-center" valign="top"><img src="<?php echo base_url('assets/img/').$calon->fotoCalon; ?>" style="object-fit: cover;width: 200px;height: auto; border-radius: 5%;"/></td>
                            <td rowspan=5 class="text-center" valign="top"><img src="<?php echo base_url('assets/img/').$calon->fotoParti; ?>" style="object-fit: cover;width: 200px;height: auto; border-radius: 5%;"/></td>
                        </tr>
                        <tr>
                            <th style="<?= $calon->partiWarna ?>">Kategori Umur</th>
                            <td><?= $calon->calonUmur ?></td>
                        </tr>
                        <tr>
                            <th style="<?= $calon->partiWarna ?>">Parti</th>
                            <td><?= strtoupper($calon->partiNama) ?> (<?= $calon->partiSF ?>)</td>
                        </tr>
                        <tr>
                            <th style="<?= $calon->partiWarna ?>">Kekuatan</th>
                            <td colspan=3>
                                <?php if(!empty($senaraiKekuatan)): ?>
                                    <?php foreach($senaraiKekuatan as $kuat): 
                                        if($kuat->wctm_winnable_candidate_bil == $calon->calonBil): ?>
                                    <?= $kuat->wctm_deskripsi ?><br>
                                    <?php endif;
                                    endforeach; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th style="<?= $calon->partiWarna ?>">Kelemahan</th>
                            <td colspan=3>
                            <?php if(!empty($senaraiKelemahan)): ?>
                                    <?php foreach($senaraiKelemahan as $lemah): 
                                        if($lemah->wctm_winnable_candidate_bil == $calon->calonBil): ?>
                                    <?= $lemah->wctm_deskripsi ?><br>
                                    <?php endif;
                                    endforeach; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </section>


    </main>


<?php $this->load->view($footer); ?>
