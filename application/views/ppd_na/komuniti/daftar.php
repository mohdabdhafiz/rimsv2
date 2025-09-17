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
                <li class="breadcrumb-item active"><a href="<?= site_url('komuniti/daftar') ?>">Daftar</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">



    <div class="card">
        <div class="card-body">
            <h1 class="card-title">DAFTAR KOMUNITI</h1>
            <?= form_open('komuniti/prosesDaftar') ?>
            <div class="form-floating mb-3">
                <input type="text" name="inputNama" id="inputNama" class="form-control" placeholder="1. Nama Komuniti" required>
                <label for="inputNama" class="form-label">1. Nama Komuniti</label>
            </div>
            <div class="form-floating mb-3">
                <select name="inputNegeri" id="inputNegeri" class="form-control" required>
                    <option value="">Sila Pilih..</option>
                    <?php foreach($senaraiNegeri as $negeri): ?>
                        <option value="<?= $negeri->nt_bil ?>"><?= $negeri->nt_nama ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="inputNegeri" class="form-label">2. Negeri</label>
            </div>
            <div class="form-floating mb-3">
                <select name="inputDaerah" id="inputDaerah" class="form-control" required>
                    <option value="">Sila Pilih..</option>
                    <?php foreach($senaraiDaerah as $daerah): ?>
                        <option value="<?= $daerah->bil ?>"><?= $daerah->nama ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="inputDaerah" class="form-label">3. Daerah</label>
            </div>
            <div class="form-floating mb-3">
                <select name="inputParlimen" id="inputParlimen" class="form-control">
                    <option value="">Sila Pilih..</option>
                    <?php foreach($senaraiParlimen as $parlimen): ?>
                        <option value="<?= $parlimen->pt_bil ?>"><?= $parlimen->pt_nama ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="inputParlimen" class="form-label">4. Parlimen</label>
            </div>
            <div class="form-floating mb-3">
                <select name="inputDun" id="inputDun" class="form-control">
                    <option value="">Sila Pilih..</option>
                    <?php foreach($senaraiDun as $dun): ?>
                        <option value="<?= $dun->dun_bil ?>"><?= $dun->dun_nama ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="inputDun" class="form-label">5. DUN</label>
            </div>
            <div class="mt-3">
                <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
            <button type="submit" class="btn btn-outline-primary shadow-sm">Daftar</button>
            </div>
            </form>
        </div>
    </div>


    </section>


</main>


<?php $this->load->view('us_program_na/susunletak/bawah'); ?>