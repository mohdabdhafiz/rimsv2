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
                <li class="breadcrumb-item active">Status Penghantaran Laporan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


        <section class="section">

            <div class="row">
                <?php foreach($senaraiKluster as $kluster): ?>
                <div class="col-auto">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title">Status Penghantaran Kluster <strong><?= $kluster->kit_nama ?></strong></h1>
                            <div class="row g-1">
                                <div class="col-auto">
                                    <?php
                                    $tahun = date('Y');
                                    $jumlahTerima = 0;
                                    $status = 'Terima';
                                    //Draf, Hantar Negeri, Terima
                                    foreach($senaraiPelapor as $pelapor){
                                        $pelapor_bil = $pelapor['bil'];
                                        $senaraiLaporan = $dataKlusterIsu->senaraiLaporan($kluster->kit_shortform, $pelapor_bil, $tahun, $status);
                                        if(!empty($senaraiLaporan)){
                                            $bilanganLaporan = count($senaraiLaporan);
                                            $jumlahTerima = $jumlahTerima + $bilanganLaporan;
                                        }
                                    }
                                    ?>
                                    <a href="<?= site_url('lapis/kluster/'.$kluster->kit_bil) ?>" class="btn btn-outline-success shadow-sm">Senarai Laporan Yang Diterima <span class="badge bg-success text-white"><?= $jumlahTerima ?></span></a>
                                </div>
                                <div class="col-auto">
                                <?php
                                    $tahun = date('Y');
                                    $jumlahHantar = 0;
                                    $status = 'Hantar Negeri';
                                    //Draf, Hantar Negeri, Terima
                                    foreach($senaraiPelapor as $pelapor){
                                        $pelapor_bil = $pelapor['bil'];
                                        $senaraiLaporan = $dataKlusterIsu->senaraiLaporan($kluster->kit_shortform, $pelapor_bil, $tahun, $status);
                                        if(!empty($senaraiLaporan)){
                                            $bilanganLaporan = count($senaraiLaporan);
                                            $jumlahHantar = $jumlahHantar + $bilanganLaporan;
                                        }
                                    }
                                    ?>
                                    <a href="<?= site_url('lapis/senaraiHantarNegeri/'.$kluster->kit_bil) ?>" class="btn btn-outline-success shadow-sm">Senarai Laporan Yang Perlu Ditapis <span class="badge bg-success text-white"><?= $jumlahHantar ?></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            


        </section>
    

</main>


<?php $this->load->view('negeri_na/susunletak/bawah'); ?>