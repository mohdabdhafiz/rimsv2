<?php 
$this->load->view('us_sismap_na/susunletak/atas');
$this->load->view('us_sismap_na/susunletak/sidebar');
$this->load->view('us_sismap_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Jangkaan Calon</a></li>
                <li class="breadcrumb-item active"><?= $negeri->nt_nama ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        
        <?php $this->load->view('us_sismap_na/sismap/jangkaan_calon/nav'); ?>

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Senarai Mengikut Parlimen (<?= count($senaraiParlimen) ?>)</h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Parlimen</th>
                                <th>Jangkaan Calon</th>
                                <th>Operasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($senaraiParlimen as $parlimen): 
                                $senaraiCalonParlimen = $dataCalonParlimen->calon_parlimen($parlimen->pt_bil); ?>
                            <tr>
                                <td>
                                    <?= $parlimen->pt_nama ?>
                                    <br>(<?= count($senaraiCalonParlimen) ?>)
                                </td>
                                <td>
                                    <?php if(!empty($senaraiCalonParlimen)): ?>
                                    <div class="row g-1">
                                        <?php foreach($senaraiCalonParlimen as $calonParlimen): ?>
                                        <div class="col-12 col-lg-3">
                                            <div class="p-1 text-center">
                                            <img src="<?php echo base_url('assets/img/').$dataFoto->foto($calonParlimen->wct_foto_bil)->foto_nama; ?>" style="object-fit: cover;width: 50px;height: 50px; border-radius: 100%;"/>
                                            <p>
                                                <?= $calonParlimen->wct_nama_penuh ?> (<?= $calonParlimen->wct_kategori_umur ?>)
                                                <br><?= $calonParlimen->parti_singkatan ?>
                                            </p>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                </td>
                                <td style="width: 10%;">
                                    <a href="<?= site_url('winnable_candidate/parlimen/'.$parlimen->pt_bil) ?>" class="btn btn-outline-primary shadow-sm">Maklumat Lanjut</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>


    </main>


<?php $this->load->view('us_sismap_na/susunletak/bawah'); ?>
