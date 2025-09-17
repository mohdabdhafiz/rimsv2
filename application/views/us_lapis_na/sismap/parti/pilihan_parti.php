<?php

$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/navbar');
$this->load->view('urusetia_na/susunletak/sidebar');
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('sismap') ?>">RIMS@SISMAP</a></li>
                <li class="breadcrumb-item active">Parti</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

        <section class="section">

        <?php $this->load->view('urusetia_na/sismap/parti/parti_nav'); ?>

        <div class="card">
            <div class="card-body">

            <div class="">


<div class="">
    <h2 class="card-title">SENARAI PILIHAN PARTI UNTUK KIRAAN SISMAP</h2>
    <?php if(count($senarai_bukan_parti_pilihan) > 0) { ?>
    <div class="mb-3">
        <?php echo form_open('parti/tambah_parti_pilihan'); ?>
        <div class="mb-3">
            <label for="input_parti_bil" class="form-label">1) Pilih Parti:</label>
            <div class="row g-1">
            <?php foreach($senarai_bukan_parti_pilihan as $parti_lain): ?>
                <div class="col-12 col-lg-3 col-md-3">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" name="input_parti_bil[]" value="<?php echo $parti_lain->parti_bil; ?>" id="input_parti_bil[]">
            <label class="form-check-label" for="input_parti_bil[]">
            <?php echo $parti_lain->parti_singkatan; ?> - <?php echo $parti_lain->parti_nama; ?>
            </label>
            </div>
            </div>
            <?php endforeach; ?>
            </div>
        </div>
        <div class="text-center">
        <button type="submit" class="btn btn-outline-primary">Tambah Parti</button>
        </div>
        </form>
    </div>
    <?php } ?>
</div>



</div>
        
            </div>
        </div>
        
        <?php if(count($senarai_parti_pilihan) > 0) { ?>
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Senarai Parti</h1>
<div class="table-responsive">
    <table class="table table-hover table-borderless">
        <tbody>
            <?php 
            $count = 1;
            foreach($senarai_parti_pilihan as $parti): ?>
            <tr>
                <td><?= $parti->parti_singkatan ?> - <?= $parti->parti_nama ?></td>
                <td>
                    <?php echo form_open('parti/buang_parti_pilihan'); ?>
                    <input type="hidden" name="input_parti_pilihan" value="<?= $parti->ppt_bil ?>">
                    <button class="btn btn-danger w-100">BUANG</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
            </div>
        </div>
        <?php } ?>

        </section>
</main>
</div>
</div>

<?php
$this->load->view('urusetia_na/susunletak/bawah');
?>