<?php 
$this->load->view('us_program_na/susunletak/atas');
$this->load->view('us_program_na/susunletak/sidebar');
$this->load->view('us_program_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM - KONFIGURASI</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('konfigurasi') ?>">Konfigurasi</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('konfigurasi/senaraipengisian') ?>">Senarai Pengisian Program</a></li>
                <li class="breadcrumb-item active"><?= $pengisian->senarai_pengisian_pengisian ?></li>
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
            <?= form_open('konfigurasi/kemaskiniSenaraipengisian/'.$pengisian->senarai_pengisian_bil) ?>
                <div class="form-floating mb-3">
                    <input required type="text" name="inputpengisian" id="inputpengisian" value="<?= $pengisian->senarai_pengisian_pengisian ?>" placeholder="Pengisian Program" class="form-control">
                    <label for="inputpengisian" class="form-label">Pengisian Program</label>
                </div>
                <input type="hidden" name="inputBil" value="<?= $pengisian->senarai_pengisian_bil ?>">
                <button type="submit" class="btn btn-outline-primary shadow-sm" name="inputOperasi" value="kemaskini">
                    <i class="bi bi-gear"></i>
                    Kemaskini Maklumat
                </button>
            </form>
        </div>
    </div>
    


    </section>

</main>


<?php $this->load->view('us_program_na/susunletak/bawah'); ?>