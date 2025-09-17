<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM - KONFIGURASI</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('konfigurasi') ?>">Konfigurasi</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('konfigurasi/senaraipenerbitan') ?>">Senarai Penerbitan </a></li>
                <li class="breadcrumb-item active"><?= $penerbitan->senarai_penerbitan_penerbitan ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <?php if(!empty($kemaskiniStatus)): ?>
    <div class="alert alert-success">
        <h1 class="alert-heading">
        <i class="bi bi-bell"></i>    
        Status Kemaskini</h1>
        Kemaskini berjaya!
    </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
                <i class="bi bi-gear"></i>
                Kemaskini Maklumat
            </h1>
            <?= form_open('konfigurasi/kemaskiniSenaraipenerbitan/'.$penerbitan->senarai_penerbitan_bil) ?>
                <div class="form-floating mb-3">
                    <input required type="text" name="inputpenerbitan" id="inputpenerbitan" value="<?= $penerbitan->senarai_penerbitan_penerbitan ?>" placeholder="Penerbitan" class="form-control">
                    <label for="inputpenerbitan" class="form-label">Penerbitan</label>
                </div>
                <input type="hidden" name="inputBil" value="<?= $penerbitan->senarai_penerbitan_bil ?>">
                <button type="submit" class="btn btn-outline-primary shadow-sm" name="inputOperasi" value="kemaskini">
                    <i class="bi bi-gear"></i>
                    Kemaskini Maklumat
                </button>
            </form>
        </div>
    </div>
    


    </section>

</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>