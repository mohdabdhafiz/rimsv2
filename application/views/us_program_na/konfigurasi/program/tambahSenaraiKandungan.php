<?php 
$this->load->view('us_program_na/susunletak/atas');
$this->load->view('us_program_na/susunletak/sidebar');
$this->load->view('us_program_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('konfigurasi') ?>">Konfigurasi</a></li>
                <li class="breadcrumb-item active">Senarai Tajuk Hebahan / Ceramah</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Tambah Tajuk Hebahan / Ceramah</h1>
            <?= form_open('konfigurasi/tambahSenaraiKandungan') ?>
                      <div class="form-floating mb-3">
                        <input type="text" name="inputKandungan" id="inputKandungan" class="form-control" placeholder="Tajuk Hebahan / Ceramah">
                        <label for="inputKandungan" class="form-label">Tajuk Hebahan / Ceramah</label>
                      </div>
                    <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                      
                      <button type="submit" class="btn btn-outline-primary shadow-sm">
                        <i class="bi bi-plus"></i>
                        Tambah
                      </button>
                        </form>
        </div>
    </div>

    <?php if(!empty($inputTajuk)): ?>

        <div class="alert alert-success">
            <h1 class="alert-heading">Tambah Maklumat Berjaya!</h1>
        </div>    

    <?php endif; ?>

    </section>

</main>


<?php $this->load->view('us_program_na/susunletak/bawah'); ?>