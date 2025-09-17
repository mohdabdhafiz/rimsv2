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
                <li class="breadcrumb-item"><a href="<?= site_url('konfigurasi/senaraiKandungan') ?>">Senarai Tajuk Hebahan atau Ceramah Program</a></li>
                <li class="breadcrumb-item active"><?= $kandungan->senarai_kandungan_kandungan ?></li>
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
            <?= form_open('konfigurasi/kemaskiniSenaraiKandungan/'.$kandungan->senarai_kandungan_bil) ?>
                <div class="form-floating mb-3">
                    <input required type="text" name="inputKandungan" id="inputKandungan" value="<?= $kandungan->senarai_kandungan_kandungan ?>" placeholder="Tajuk Hebahan / Ceramah Program" class="form-control">
                    <label for="inputKandungan" class="form-label">Tajuk Hebahan / Ceramah Program</label>
                </div>
                <input type="hidden" name="inputBil" value="<?= $kandungan->senarai_kandungan_bil ?>">
                <button type="submit" class="btn btn-outline-primary shadow-sm w-100" name="inputOperasi" value="kemaskini">
                    <i class="bi bi-gear"></i>
                    Kemaskini Maklumat
                </button>
            </form>
        </div>
    </div>
    


    </section>

</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>