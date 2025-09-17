<?php 
$this->load->view('us_program_na/susunletak/atas');
$this->load->view('us_program_na/susunletak/sidebar');
$this->load->view('us_program_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@KOMUNITI - KONFIGURASI KOMUNITI</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('konfigurasiKomuniti/daftar') ?>">Daftar</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">



    <div class="card">
        <div class="card-body">
            <h1 class="card-title">DAFTAR KOMUNITI</h1>
            <?= form_open('konfigurasiKomuniti/prosesDaftar') ?>
            <div class="form-floating">
                <input type="text" name="inputNama" id="inputNama" class="form-control" placeholder="1. Nama Komuniti" required>
                <label for="inputNama" class="form-label">1. Nama Komuniti</label>
            </div>
            <div class="mt-3">
                <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
            <button type="submit" class="btn btn-outline-primary shadow-sm">Daftar</button>
            </div>
            </form>
        </div>
    </div>


    </section>


</main>


<?php $this->load->view('us_program_na/susunletak/bawah'); ?>