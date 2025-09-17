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
                <li class="breadcrumb-item"><a href="<?= site_url('komuniti/daftar') ?>"><?= $daerah->nt_nama ?></a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('komuniti/pilihDaerah/'.$daerah->nt_bil) ?>"><?= $daerah->nama ?></a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('komuniti/pilihParlimen/'.$daerah->bil) ?>">Parlimen</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Pilih Parlimen</h1>
            <div class="row g-3">
                <?php foreach($senaraiParlimen as $parlimen): ?>
                <div class="col-12 col-lg-3 col-md-4 col-sm-6 text-center">
                    <?= form_open('komuniti/pilihDun') ?>
                        <input type="hidden" name="inputDaerahBil" value="<?= $daerah->bil ?>">
                        <input type="hidden" name="inputParlimenBil" value="<?= $parlimen->pt_bil ?>">
                        <button type="submit" class="btn btn-outline-primary w-100"><?= $parlimen->pt_nama ?></button>
                    </form>
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
            <div class="form-floating mb-3">
                <input type="text" name="inputNegeriNama" id="inputNegeriNama" class="form-control" disabled value="<?= $daerah->nt_nama ?>">
                <label for="inputNegeriNama" class="form-label">2. Nama Negeri</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="inputDaerahNama" id="inputDaerahNama" disabled value="<?= $daerah->nama ?>" class="form-control">
                <label for="inputDaerahNama" class="form-label">3. Nama Daerah</label>
            </div>
            <input type="hidden" name="inputDaerahBil" value="<?= $daerah->bil ?>">
            <input type="hidden" name="inputNegeriBil" value="<?= $daerah->nt_bil ?>">
            <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
            <button type="submit" class="btn btn-outline-primary">Daftar</button>
            </form>
        </div>
    </div>

    </section>

</main>


<?php $this->load->view('us_program_na/susunletak/bawah'); ?>