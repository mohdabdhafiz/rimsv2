<?php 
$this->load->view('us_program_na/susunletak/atas');
$this->load->view('us_program_na/susunletak/sidebar');
$this->load->view('us_program_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@KOMUNITI</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('komuniti/daftar') ?>">Negeri</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('komuniti/pilihDaerah/'.$negeriBil) ?>">Daerah</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Pilih Daerah</h1>
            <div class="row g-3">
                <?php foreach($senaraiDaerah as $daerah): ?>
                <div class="col-12 col-lg-3 col-md-4 col-sm-6 text-center">
                    <a href="<?= site_url('komuniti/pilihParlimen/'.$daerah->bil) ?>" class="btn btn-outline-primary w-100"><?= $daerah->nama ?></a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Daftar Komuniti</h1>
            <?= form_open('komuniti/daftarKomuniti') ?>
            <div class="form-floating mb-3">
                <input type="text" name="inputNama" id="inputNama" class="form-control" placeholder="1. Nama Komuniti" required>
                <label for="inputNama" class="form-label">1. Nama Komuniti</label>
            </div>
            <input type="hidden" name="inputNegeriBil" value="<?= $negeriBil ?>">
            <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
            <button type="submit" class="btn btn-outline-primary">Daftar</button>
            </form>
        </div>
    </div>

    </section>

</main>


<?php $this->load->view('us_program_na/susunletak/bawah'); ?>