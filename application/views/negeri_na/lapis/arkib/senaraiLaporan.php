<?php
$this->load->view('negeri_na/susunletak/atas');
$this->load->view('negeri_na/susunletak/navbar');
$this->load->view('negeri_na/susunletak/sidebar');
?>


<main id="main" class="main">


    <div class="pagetitle">
        <h1>RIMS@LAPIS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">RIMS@LAPIS</li>
                <li class="breadcrumb-item active">Senarai Arkib</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


        <section class="section">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Senarai Laporan</h1>
            <div class="row g-3">
                <?php foreach($senaraiNegeri as $negeri): ?>
                    <div class="col">
                        <img src="<?php echo base_url('assets/bendera/').$negeri->nt_nama_fail; ?>" alt="<?= $negeri->nt_nama ?>" class="img-fluid" style="object-fit:cover; max-width:100px; max-height:50px;"> 
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php if(empty($senaraiLaporan)): ?>
                <div class="alert alert-warning shadow-sm">
                    <h3>TIADA LAPORAN DICATATKAN.</h3>
                    <p class="small text-muted mb-0">Sila hubungi urus setia sistem.</p>
                </div>
            <?php endif; ?>

            <?php if(!empty($senaraiLaporan)): ?>
        <div class="p-3 border rounded shadow mb-3 bg-white">
            <h2>Senarai Laporan</h2>
            
                <p>Jumlah Laporan: <?= count($senaraiLaporan) ?></p>
                <div class="row g-3">
                <?php 
                $bilangan = 1;
                foreach($senaraiLaporan as $laporan){
                    $tarikh_temp[] = $laporan->pengguna_waktu;
                }
                array_multisort($tarikh_temp, SORT_DESC, $senaraiLaporan);
                //array_multisort(array_column($senarai_laporan, 'pelapor'), SORT_DESC, $senarai_laporan);
                foreach($senaraiLaporan as $laporan): ?>
                <div  class="col-12 col-lg-6 col-md-6 col-sm-12 d-flex align-items-stretch">
                    <div class="p-3 border rounded d-flex flex-column w-100">
                        <div class="d-flex justify-content-between align-items-start">
                                <div class="">
                                    <p class="small text-muted mb-0">Laporan: <?= $bilangan++ ?></p>
                                <h3><?= $laporan->kit_nama ?></h3>
                                </div>
                                <p>
                                    <strong><?= $laporan->nama_penuh ?></strong>
                                    <br><span class="text-muted small"><?= $laporan->pengguna_waktu ?></span>
                                </p>
                        </div>
                                <p><em><?= $laporan->ringkasan_isu ?></em></p>
                                <div class="mt-auto">
                                <p class="small text-muted"><?= $laporan->nama ?> | <?= $laporan->pt_nama ?> | <?= $laporan->dun_nama ?></p>
                <?= form_open('lapis/arkib') ?>
                        <input type="hidden" name="inputBil" value="<?= $laporan->bil ?>">
                        <input type="hidden" name="inputPelapor" value="<?= $laporan->pelapor ?>">
                        <input type="hidden" name="inputKlusterShortForm" value="<?= $laporan->kit_shortform ?>">
                        <input type="hidden" name="inputTahun" value="<?= date_format(date_create($laporan->pengguna_waktu), 'Y') ?>">
                        <button type="submit" class="btn btn-outline-primary shadow-sm w-100 d-flex justify-content-between align-items-center">
                            Maklumat Lanjut
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </button>
                </form>
                        </div>
                    </div>    
                </div>
                <?php
                if($bilangan == 101){
                    break;
                }
                endforeach; ?>
                </div>
        </div>
        <?php endif; ?>
            


        </section>
    

</main>


<?php $this->load->view('negeri_na/susunletak/bawah'); ?>