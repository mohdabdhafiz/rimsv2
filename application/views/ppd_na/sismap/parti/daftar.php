<?php

$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/navbar');
$this->load->view('ppd_na/susunletak/sidebar');
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

        <?php $this->load->view('ppd_na/sismap/parti/parti_nav'); ?>
            
        <div class="card">
            <div class="card-body">
    <h2 class="card-title"><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('parti/daftar'); ?>

    <div class="form-floating mb-3">
        <input type="text" name="parti_nama" class="form-control" placeholder="Nama Parti" />
        <label for="parti_nama" class="form-label">Nama Parti</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" name="parti_singkatan" id="parti_singkatan" class="form-control" placeholder="Nama Singkatan Parti" />
        <label for="parti_singkatan" class="form-label">Nama Singkatan Parti</label>
    </div>

    <input type="hidden" id="parti_pengguna" name="parti_pengguna" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
    <input type="hidden" id="parti_logo" name="parti_logo" value="1">

    <div class="text-center">
        <input type="submit" name="submit" value="Daftar Parti" class="btn btn-outline-primary"/>
    </div>
</form>
</div>
</div>

        </section>
</main>
</div>
</div>

<?php
$this->load->view('ppd_na/susunletak/bawah');
?>