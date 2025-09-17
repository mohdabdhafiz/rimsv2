<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@KELABMALAYSIAKU</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('kelabmalaysiaku/daftar') ?>"><?= $daerah->nt_nama ?></a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('kelabmalaysiaku/pilihDaerah/'.$daerah->nt_bil) ?>"><?= $daerah->nama ?></a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('kelabmalaysiaku/pilihParlimen/'.$daerah->bil) ?>">Parlimen</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('kelabmalaysiaku/pilihParlimen/'.$daerah->bil) ?>">DUN</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Pilih DUN</h1>
            <div class="row g-3">
                <?php foreach($senaraiDun as $dun): ?>
                <div class="col-12 col-lg-3 col-md-4 col-sm-6 text-center">
                    <?= form_open('kelabmalaysiaku/daftarKelabmalaysiakuDun') ?>
                        <input type="hidden" name="inputDaerahBil" value="<?= $daerah->bil ?>">
                        <input type="hidden" name="inputParlimenBil" value="<?= $parlimen->pt_bil ?>">
                        <input type="hidden" name="inputDunBil" value="<?= $dun->dun_bil ?>">
                        <button type="submit" class="btn btn-outline-primary w-100"><?= $dun->dun_nama ?></button>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    </section>

</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>