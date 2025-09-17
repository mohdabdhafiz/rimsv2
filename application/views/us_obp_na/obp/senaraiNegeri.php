<?php 
$this->load->view('us_obp_na/susunletak/atas');
$this->load->view('us_obp_na/susunletak/sidebar');
$this->load->view('us_obp_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@OBP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Senarai Negeri</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Senarai Negeri</h5>
            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th>Nama Negeri</th>
                            <th>Bilangan Daerah</th>
                            <th>Bilangan Parlimen</th>
                            <th>Lengkap (Parlimen)</th>
                            <th>Tidak Lengkap (Parlimen)</th>
                            <th>Jumlah OBP (Parlimen)</th>
                            <th>Bilangan DUN</th>
                            <th>Lengkap (DUN)</th>
                            <th>Tidak Lengkap (DUN)</th>
                            <th>Jumlah OBP (DUN)</th>
                            <th>Operasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiNegeri as $negeri): ?>
                        <tr>
                            <td><?= $negeri->nt_nama ?></td>
                            <td>
                                <?php
                                $senaraiDaerah = $dataDaerah->daerah_negeri($negeri->nt_bil);
                                if(empty($senaraiDaerah)){
                                    echo 0;
                                }
                                if(!empty($senaraiDaerah)){
                                    echo count($senaraiDaerah);
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                $bilanganParlimen = 0;
                                $senaraiParlimen = $dataParlimen->parlimen_negeri($negeri->nt_bil);
                                if(empty($senaraiParlimen)){
                                    echo 0;
                                }
                                if(!empty($senaraiParlimen)){
                                    echo count($senaraiParlimen);
                                    $bilanganParlimen = count($senaraiParlimen);
                                }
                                ?>

                                <?php 
                                $jumlahIkutParlimen = 25 * $bilanganParlimen;
                                echo '<br><br>'.$jumlahIkutParlimen." orang";  ?>
                            </td>
                            <?php
                                $parlimenBawah = 0;
                                $parlimenSelesai = 0;
                                $jumlahObpParlimen = 0;
                                foreach($senaraiParlimen as $parlimen){
                                    $bilanganObpParlimen = 0;
                                    $senaraiPeranan = $dataPeranan->senaraiPerananIkutParlimen($parlimen->pt_bil);
                                    foreach($senaraiPeranan as $peranan){
                                        $senaraiObpParlimen = $dataObp->senaraiObpIkutParlimenPeranan($parlimen->pt_bil, $peranan->tpt_peranan_bil);
                                        if(!empty($senaraiObpParlimen)){
                                            $bilanganObpParlimen = $bilanganObpParlimen + count($senaraiObpParlimen);
                                        }
                                    }
                                    if($bilanganObpParlimen < 25){
                                        $parlimenBawah++;
                                    }
                                    if($bilanganObpParlimen >= 25){
                                        $parlimenSelesai++;
                                    }
                                    $jumlahObpParlimen = $jumlahObpParlimen + $bilanganObpParlimen;
                                }
                                ?>
                            <td><?= $parlimenSelesai ?></td>
                            <td><?= $parlimenBawah ?></td>
                            <td><?= $jumlahObpParlimen ?></td>
                            <td>
                                <?php
                                $bilanganDun = 0;
                                $senaraiDun = $dataDun->dun_negeri($negeri->nt_bil);
                                if(empty($senaraiDun)){
                                    echo 0;
                                }
                                if(!empty($senaraiDun)){
                                    echo count($senaraiDun);
                                    $bilanganDun = count($senaraiDun);
                                }
                                ?>

                                <?php 
                                $jumlahIkutDun = 25 * $bilanganDun;
                                echo '<br><br>'.$jumlahIkutDun." orang";  ?>
                            </td>
                            <?php
                                $dunBawah = 0;
                                $dunSelesai = 0;
                                $jumlahObpDun = 0;
                                foreach($senaraiDun as $dun){
                                    $bilanganObp = 0;
                                    $senaraiPeranan = $dataPeranan->senaraiPerananIkutDun($dun->dun_bil);
                                    foreach($senaraiPeranan as $peranan){
                                        $senaraiObp = $dataObp->senaraiObpIkutDunPeranan($dun->dun_bil, $peranan->tdt_peranan_bil);
                                        if(!empty($senaraiObp)){
                                            $bilanganObp = $bilanganObp + count($senaraiObp);
                                        }
                                    }
                                    if($bilanganObp < 25){
                                        $dunBawah++;
                                    }
                                    if($bilanganObp >= 25){
                                        $dunSelesai++;
                                    }
                                    $jumlahObpDun = $jumlahObpDun + $bilanganObp;
                                }
                                ?>
                            <td><?= $dunSelesai ?></td>
                            <td><?= $dunBawah ?></td>
                            <td><?= $jumlahObpDun ?></td>
                            <td>
                                <a href="<?= site_url('obp/senaraiIkutNegeri/'.$negeri->nt_bil) ?>" class="btn btn-outline-primary shadow-sm">Senarai Keseluruhan</a>
                                <a href="<?= site_url('obp/senaraiIkutDaerah/'.$negeri->nt_bil) ?>" class="btn btn-outline-primary shadow-sm">Senarai Daerah</a>
                                <a href="<?= site_url('obp/senaraiIkutParlimen/'.$negeri->nt_bil) ?>" class="btn btn-outline-primary shadow-sm">Senarai Parlimen</a>
                                <?php if((strtoupper($negeri->nt_nama) != 'WILAYAH PERSEKUTUAN KUALA LUMPUR') || (strtoupper($negeri->nt_nama) != 'WILAYAH PERSEKUTUAN PUTRAJAYA') || (strtoupper($negeri->nt_nama) != 'WILAYAH PERSEKUTUAN LABUAN')): ?>
                                <a href="<?= site_url('obp/senaraiIkutDun/'.$negeri->nt_bil) ?>" class="btn btn-outline-primary shadow-sm">Senarai DUN</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </section>

</main>


<?php $this->load->view('us_obp_na/susunletak/bawah'); ?>