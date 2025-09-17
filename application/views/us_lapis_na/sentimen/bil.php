<?php 
$this->load->view('us_lapis_na/susunletak/atas');
$this->load->view('us_lapis_na/susunletak/sidebar');
$this->load->view('us_lapis_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LKS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('sentimen') ?>">RIMS@LKS</a></li>
                <li class="breadcrumb-item active">Laporan Khas Sentimen [Nombor Siri: <?= $sentimen->stBil ?>]</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Laporan Khas Sentimen [Nombor Siri: <?= $sentimen->stBil ?>]</h5>
            <?php if(!empty($sentimen->stBil)): ?>
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 text-primary">Nombor Siri</div>
                    <div class="col-lg-9 col-md-8"><?= $sentimen->stBil ?></div>
            </div>
            <?php endif; ?>
            <?php if(!empty($sentimen->stTarikhLaporan)): ?>
            <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 text-primary">Tarikh Laporan</div>
                    <div class="col-lg-9 col-md-8"><?= date_format(date_create($sentimen->stTarikhLaporan), "d.m.Y") ?></div>
            </div>
            <?php endif; ?>
            <?php if(!empty($sentimen->stPelaporBil)): 
                $pelapor = $dataPengguna->pengguna($sentimen->stPelaporBil); ?>
            <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 text-primary">Pelapor</div>
                    <div class="col-lg-9 col-md-8"><?= $pelapor->nama_penuh ?></div>
            </div>
            <?php endif; ?>
            <?php if(!empty($sentimen->stDaerahBil)): 
                $daerah = $dataDaerah->daerah($sentimen->stDaerahBil); ?>
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 text-primary">Negeri</div>
                    <div class="col-lg-9 col-md-8"><?= $daerah->nt_nama ?></div>
            </div>
            <?php endif; ?>
            <?php if(!empty($sentimen->stDaerahBil)): 
                $daerah = $dataDaerah->daerah($sentimen->stDaerahBil); ?>
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 text-primary">Daerah</div>
                    <div class="col-lg-9 col-md-8"><?= $daerah->nama ?></div>
            </div>
            <?php endif; ?>
            <?php if(!empty($sentimen->stParlimenBil)): 
                $parlimen = $dataParlimen->parlimen_bil($sentimen->stParlimenBil); ?>
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 text-primary">Parlimen</div>
                    <div class="col-lg-9 col-md-8"><?= $parlimen->pt_nama ?></div>
            </div>
            <?php endif; ?>
            <?php if(!empty($sentimen->stDunBil)): 
                $dun = $dataDun->dun_bil($sentimen->stDunBil); ?>
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 text-primary">Pelapor</div>
                    <div class="col-lg-9 col-md-8"><?= $dun->dun_nama ?></div>
            </div>
            <?php endif; ?>
            <?php if(!empty($sentimen->stKawasan)): ?>
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 text-primary">Kawasan</div>
                    <div class="col-lg-9 col-md-8"><?= $sentimen->stKawasan ?></div>
            </div>
            <?php endif; ?>
            <?php if(!empty($sentimen->stSentimen)): ?>
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 text-primary">Sentimen</div>
                    <div class="col-lg-9 col-md-8"><?= $sentimen->stSentimen ?></div>
            </div>
            <?php endif; ?>
            <?php if(!empty($sentimen->stAlasan)): ?>
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 text-primary">Ulasan</div>
                    <div class="col-lg-9 col-md-8"><?= $sentimen->stAlasan ?></div>
            </div>
            <?php endif; ?>
                
                <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                <?php if(!empty($sentimen->stPenggunaBil)): 
                    $user = $dataPengguna->pengguna($sentimen->stPenggunaBil); ?>
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 text-primary">Akaun</div>
                    <div class="col-lg-9 col-md-8"><?= $user->nama_penuh ?></div>
            </div>
            <?php endif; ?>
                <?php if(!empty($sentimen->stPenggunaWaktu)): ?>
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 text-primary">Waktu Dihantar</div>
                    <div class="col-lg-9 col-md-8"><?= $sentimen->stPenggunaWaktu ?></div>
            </div>
            <?php endif; ?>

            <div class="d-flex justify-content-center">
            <?= form_open('sentimen/keputusanPenghantaran') ?>
            <input type="hidden" name="inputBil" value="<?= $sentimen->stBil ?>">
            <div class="row g-1">
                <div class="col-auto">
                    <button type="submit" value="Terima" name="inputKeputusan" class="btn btn-outline-success shadow-sm">Terima</button>
                </div>
                <div class="col-auto">
                    <button type="submit" value="Semakan Semula" name="inputKeputusan" class="btn btn-outline-warning shadow-sm">Semakan Semula</button>
                </div>
            </div>
            </form>
            </div>

        </div>
    </div>

    </section>

</main>


<?php $this->load->view('us_lapis_na/susunletak/bawah'); ?>