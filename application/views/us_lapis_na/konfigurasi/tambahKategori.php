<?php 
$this->load->view('us_lapis_na/susunletak/atas');
$this->load->view('us_lapis_na/susunletak/sidebar');
$this->load->view('us_lapis_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LAPIS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">RIMS@LAPIS</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('cpi/kluster_isu') ?>">Konfigurasi</a></li>
                <li class="breadcrumb-item "><a href="<?= site_url('cpi/senarai_kluster_isu') ?>">Senarai Kluster Isu</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('cpi/senaraiKategori/'.$kluster->kit_bil) ?>">Kembali Ke Senarai Kategori Kluster <?= $kluster->kit_nama ?></a></li>
                <li class="breadcrumb-item active">Tambah Kategori Isu Baharu Mengikut Kluster <?= $kluster->kit_nama ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <a href="<?= site_url('cpi/senaraiKategori/'.$kluster->kit_bil) ?>" class="btn btn-outline-info mb-3 shadow-sm">Kembali Ke Senarai Kategori Kluster <?= $kluster->kit_nama ?></a>

    
    <section class="section">

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Tambah Kategori Isu Baharu Mengikut Kluster <?= $kluster->kit_nama ?></h1>
                <?= form_open('cpi/prosesTambahKategori') ?>
                    <div class="mb-3">
                        <label for="inputNama" class="form-label">1) Nama Kategori Isu:</label>
                        <input type="text" name="inputNama" id="inputNama" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="inputDeskripsi" class="form-label">2) Deskripsi Kategori Isu:</label>
                        <textarea name="inputDeskripsi" id="inputDeskripsi" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <input type="hidden" name="inputKlusterBil" value="<?= $kluster->kit_bil ?>">
                    <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                    <input type="hidden" name="inputPenggunaWaktu" value="<?= date("Y-m-d H:i:s") ?>">
                    <input type="hidden" name="inputTapisan" value="Aktif">
                    <div class="d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-outline-primary shadow-sm">Tambah Kategori Baharu</button>
                    </div>
                </form>
            </div>
        </div>
       


        

    </section>

</main>


<?php $this->load->view('us_lapis_na/susunletak/bawah'); ?>d