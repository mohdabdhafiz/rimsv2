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
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">UTAMA</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('parlimen') ?>">PILIHAN RAYA</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Calon Mengikut Parlimen</h1>
            <div class="row g-3 mb-3">
                <?php foreach($senarai_parlimen_negeri as $parlimen): ?>
                    <div class="col-12 col-lg-3 d-flex align-items-stretch">
                        <div class="p-3 border rounded w-100 d-flex flex-column">
                            <p><?php echo $parlimen->pt_nama; ?></p>
                            <?php $senarai_calon = $data_calon->calon_parlimen($parlimen->pt_bil);
                            if(!empty($senarai_calon)){ ?>
                            <div class="row g-1 mb-3">
                                <?php foreach($senarai_calon as $calon): ?>
                                <div class="col text-center"><img src="<?php echo base_url('assets/img/').$data_foto->foto($calon->wct_foto_bil)->foto_nama; ?>" style="object-fit: cover;width: 50px;height: 50px; border-radius: 100%;"/></div>
                                <?php endforeach; ?>
                            </div>
                            <p class="text-start text-muted small">Bilangan Calon : <?php echo count($senarai_calon); ?> orang</p>
                            <?php } ?>
                            <div class="mt-auto">
                                <?php echo anchor('winnable_candidate/senarai_calon/'.$parlimen->pt_bil, 'Senarai Calon', "class='btn btn-outline-primary shadow-sm w-100'"); ?> 
                            </div> 
                        </div>  
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Calon Mengikut DUN</h1>
            <div class="row g-3 mb-3">
                <?php foreach($senarai_parlimen_negeri as $parlimen): ?>
                    <div class="col-12 col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="p-3 border rounded w-100 d-flex flex-column">
                            <p><?php echo $parlimen->pt_nama; ?></p>
                            <?php $senarai_calon = $data_calon->calon_parlimen($parlimen->pt_bil);
                            if(!empty($senarai_calon)){ ?>
                            <div class="row g-1 mb-3">
                                <?php foreach($senarai_calon as $calon): ?>
                                <div class="col text-center"><img src="<?php echo base_url('assets/img/').$data_foto->foto($calon->wct_foto_bil)->foto_nama; ?>" style="object-fit: cover;width: 50px;height: 50px; border-radius: 100%;"/></div>
                                <?php endforeach; ?>
                            </div>
                            <p class="text-start text-muted small">Bilangan Calon : <?php echo count($senarai_calon); ?> orang</p>
                            <?php } ?>
                            <div class="mt-auto">
                                <?php echo anchor('winnable_candidate/senarai_calon/'.$parlimen->pt_bil, 'Senarai Calon', "class='btn btn-outline-secondary shadow-sm w-100'"); ?> 
                            </div> 
                        </div>  
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    </section>


</main>


<?php $this->load->view($footer); ?>