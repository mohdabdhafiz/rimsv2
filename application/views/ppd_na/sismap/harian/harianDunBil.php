<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<?php
function warnaGrading($grading){
    $warna = "";
    switch($grading){
        case 'PUTIH': 
            $warna = 'background:white; color:black';
            break;
        case 'KELABU PUTIH':
            $warna = 'background:#BEBEBE; color:black';
            break;
        case 'KELABU HITAM' :
            $warna = 'background:#696969; color:white';
            break;
        case 'HITAM' :
            $warna = 'background:#000000; color:white';
            break;
    }   
    return $warna;
}
function grading_status($majoriti){
    $grade = 'BELUM DITETAPKAN';
    $warna = 'background:red; color:white';
    if(10.00 <= $majoriti){
        $grade = 'PUTIH';
        $warna = 'background:white; color:black';
    }
    if($majoriti >= 0.00 && $majoriti < 10.00){
        $grade = 'KELABU PUTIH';
        $warna = 'background:#BEBEBE; color:black';
    }
    if($majoriti < 0.00 && $majoriti > -10.00){
        $grade = 'KELABU HITAM';
        $warna = 'background:#696969; color:white';
    }
    if($majoriti <= -10.00){
        $grade = 'HITAM';
        $warna = 'background:#000000; color:white';
    }
    $grading = array(
        'grade' => $grade,
        'warna' => $warna
    );
    return $grading;
}
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('harian') ?>">Harian</a></li>
                <li class="breadcrumb-item active">Harian DUN <?= $dun->dun_nama ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Grading Harian DUN</h1>
            <div class="row g-1">
                <?php foreach($senaraiDunPilihanraya as $dunPru): ?>
                <div class="col-auto">
                    <?= form_open('grading/dunPilihanraya') ?>
                        <input type="hidden" name="inputDunBil" value="<?= $dunPru->dun_bil ?>">
                        <input type="hidden" name="inputPilihanrayaBil" value="<?= $harian->harian_pilihanraya ?>">
                        <button type="submit" class="btn btn-outline-primary shadow-sm"><?= $dunPru->dun_nama ?></button>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Grading Harian bagi <?= $dun->dun_nama ?> untuk <?= $pilihanraya->pilihanraya_singkatan ?></h5>
                
            </div>

            <div class="table-responsive">
                <table class="table table-borderless">
                    <tr>
                        <th class="text-secondary">Tarikh</th>
                        <td><?= $harian->harian_tarikh ?></td>
                    </tr>
                    <tr>
                        <th class="text-secondary">DUN</th>
                        <td><?= $dun->dun_nama ?></td>
                    </tr>
                    <tr>
                        <th class="text-secondary">Pilihan Raya</th>
                        <td><?= $pilihanraya->pilihanraya_nama ?> (<?= $pilihanraya->pilihanraya_singkatan ?>)</td>
                    </tr>
                    <tr>
                        <th class="text-secondary">Menang</th>
                        <td style="<?= $harian->parti_warna ?>"><?= $harian->parti_nama ?> (<?= $harian->parti_singkatan ?>)</td>
                    </tr>
                    <tr>
                        <th class="text-secondary">Status Grading</th>
                        <td style="<?= warnaGrading($harian->harian_grading) ?>"><?= $harian->harian_grading ?></td>
                    </tr>
                    <tr>
                        <th class="text-secondary">Peratus Keluar Mengundi (%)</th>
                        <td><?= $harian->harian_keluar_mengundi ?></td>
                    </tr>
                    <tr>
                        <th class="text-secondary">Pengundi Atas Pagar / Rosak (%)</th>
                        <td><?= $harian->harian_atas_pagar ?></td>
                    </tr>
                    <tr>
                        <th class="text-secondary">Kemaskini</th>
                        <td><?= $harian->harian_waktu ?></td>
                    </tr>
                </table>
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>DM</th>
                            <th>Bilangan Pengundi (Orang)</th>
                            <th colspan='2'>Jangkaan Keluar Mengundi (DM)</th>
                            <?php 
                            $jumlahPengundiCalon = array();
                            foreach($senaraiCalon as $calon): 
                                $jumlahPengundiCalon[$calon->pencalonan_bil] = 0; ?>
                                <th colspan="2" style="<?= $calon->parti_warna ?>"><?= $calon->ahli_nama ?> (<?= $calon->parti_singkatan ?>)</th>
                            <?php endforeach; ?>
                            <th>Atas Pagar / Undi Rosak</th>
                            <th>100%</th>
                            <th>Majoriti (Grading)</th>
                            <th>Peratus Majoriti (Grading)</th>
                            <th>Status Grading</th>
                            <th>Pilihan Parti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $jumlah = 1;
                        $jumlahBilanganPengundi = 0;
                        $dunKeluarMengundi = 0;
                        $bilanganDM = count($senaraiDM);
                        $jumlahPeratusKeluarMengundi = 0;
                        $jumlahAtasPagar = 0;
                        $dunAtasPagar = 0;
                        $jumlahPengundiKeluar = 0;
                        foreach($senaraiDM as $dm):
                            $seratus = 0; 
                        ?>
                        <tr>
                            <td><?= $dm->pdt_nama ?></td>
                            <td>
                                <?= number_format($dm->pdt_bilangan_pengundi, 0, '', ',') ?>
                                <?php $jumlahBilanganPengundi = $jumlahBilanganPengundi + $dm->pdt_bilangan_pengundi; ?>
                            </td>
                            <td><?= $dm->hddt_keluar_mengundi ?></td>
                            <?php
                            $pengundiKeluar = 0;
                            $pengundiKeluar = ($dm->hddt_keluar_mengundi/100) * $dm->pdt_bilangan_pengundi;
                            $jumlahPengundiKeluar = $jumlahPengundiKeluar + $pengundiKeluar;
                            ?>
                            <td><?= number_format(floor($pengundiKeluar), 0, '', ',') ?></td>
                            <?php 
                            $jumlahPeratusKeluarMengundi = $jumlahPeratusKeluarMengundi + $dm->hddt_keluar_mengundi;
                            $pengundiDM = $dm->hddt_keluar_mengundi/100 * $dm->pdt_bilangan_pengundi;
                            $highest = 0;
                            $calonMenangBil = 0;
                            $tempPutihHighest = 0;
                            $tempNotPutihHighest = 0;
                            foreach($senaraiCalon as $calon):
                                $grading = $dataGrading->hari_pdm_dun($calon->pencalonan_bil, $dm->pdt_bil, $harian->harian_tarikh);
                                    $peratusGrading = 0;
                                    if(!empty($grading->sgpdt_peratus)){
                                        $peratusGrading = $grading->sgpdt_peratus;
                                    }
                            $pengundi = $peratusGrading/100 * floor($pengundiDM);
                            $jumlahPengundiCalon[$calon->pencalonan_bil] = $jumlahPengundiCalon[$calon->pencalonan_bil] + $pengundi;
                            ?>
                                <td style="<?= $calon->parti_warna ?>">
                                    <?= number_format(floor($pengundi), 0, '', ',') ?>
                                </td>
                                <td style="<?= $calon->parti_warna ?>">
                                    <?= $peratusGrading ?>%
                                    <?php 
                                    $seratus = $seratus + $peratusGrading;
                                    $parti_pilihan = $dataParti->pilihan_parti($calon->pencalonan_parti); 
                                    $pengundi = floor($pengundi);
                                    if(!empty($parti_pilihan)){
                                        if($pengundi >= $tempPutihHighest){
                                            $tempPutihHighest = $pengundi;
                                        }
                                    }else{
                                        if($pengundi >= $tempNotPutihHighest){
                                            $tempNotPutihHighest = $pengundi;
                                        }
                                    }
                                    if($pengundi > $highest){
                                        $highest = $pengundi;
                                        $calonMenangBil = $calon->parti_singkatan;
                                        $warnaParti = $calon->parti_warna;
                                    }
                                    ?>
                                </td>
                            <?php 
                                endforeach; ?>
                            <td>
                                <?= $dm->hddt_atas_pagar ?>%
                                <?php 
                                $jumlahAtasPagar = $jumlahAtasPagar + $dm->hddt_atas_pagar;
                                $seratus = $seratus + $dm->hddt_atas_pagar; ?>
                            </td>
                            <?php
                            $warnaSeratus = 0;
                            if($seratus > 100){
                                $warnaSeratus = "background-color:red; color:white";
                            }
                            if($seratus < 100){
                                $warnaSeratus = "background-color:yellow; color:black";
                            }
                            ?>
                            <td style="<?= $warnaSeratus ?>"><?= number_format($seratus, 2, '.', ',') ?>%</td>
                            <td>
                                <?php 
                                $majoriti = 0;
                                $majoriti = $tempPutihHighest - $tempNotPutihHighest;
                                echo $majoriti;
                                ?>
                            </td>
                            <td>
                                <?php 
                                $peratusMajoriti = 0;
                                $peratusMajoriti = ($majoriti/$pengundiDM) * 100;
                                echo number_format($peratusMajoriti, 2, '.', ','); 
                                ?>%
                            </td>
                            <?php 
                                //SEBELUM CELL GRADING
                                //INTIALIZE GRADING
                                $gr = '';
                                $grWarna = '';
                                //GUNA FUNCTION GRADING
                                $tempGrading = grading_status($peratusMajoriti);
                                //LOAD
                                $gr = $tempGrading['grade'];
                                $grWarna = $tempGrading['warna'];
                                ?>
                            <td style="<?= $grWarna ?>"><?= $gr ?></td>
                            <td style="<?= $warnaParti ?>"><?= $calonMenangBil ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <?php $jumlahSeratus = 0; ?>
                        <tr>
                            <th>JUMLAH</th>
                            <th><?= number_format($jumlahBilanganPengundi, 0, '', ',') ?></th>
                            <?php
                            $dunKeluarMengundi = ($jumlahPengundiKeluar / $jumlahBilanganPengundi) * 100;
                            ?>
                            <th><?= number_format($dunKeluarMengundi, 2, '.', '') ?></th>
                            <th><?= number_format($jumlahPengundiKeluar, 0, '', ',') ?></th>
                            <?php 
                            $tempPutihHighest = 0;
                            $tempNotPutihHighest = 0;
                            $highest = 0;
                            $calonMenangBil = 0;
                            $warnaParti = "";
                            foreach($senaraiCalon as $calon): ?>
                            <th style="<?= $calon->parti_warna ?>"><?= number_format($jumlahPengundiCalon[$calon->pencalonan_bil], 0, '', ',') ?></th>
                            <?php 
                            $peratusPengundiCalon = ($jumlahPengundiCalon[$calon->pencalonan_bil] / (($dunKeluarMengundi/100) * $jumlahBilanganPengundi)) * 100;
                            $jumlahSeratus = $jumlahSeratus + $peratusPengundiCalon;
                            ?>
                            <th style="<?= $calon->parti_warna ?>"><?= number_format($peratusPengundiCalon, 2, '.', '') ?>%</th>
                            <?php 
                            $parti_pilihan = $dataParti->pilihan_parti($calon->pencalonan_parti); 
                            $pengundi = floor($jumlahPengundiCalon[$calon->pencalonan_bil]);
                            if(!empty($parti_pilihan)){
                                if($pengundi >= $tempPutihHighest){
                                    $tempPutihHighest = $pengundi;
                                }
                            }else{
                                if($pengundi >= $tempNotPutihHighest){
                                    $tempNotPutihHighest = $pengundi;
                                }
                            }
                            if($pengundi > $highest){
                                $highest = $pengundi;
                                $calonMenangBil = $calon->parti_singkatan;
                                $warnaParti = $calon->parti_warna;
                            }
                            endforeach; ?>
                            <?php
                            $dunAtasPagar = $jumlahAtasPagar / $bilanganDM;
                            $jumlahSeratus = $jumlahSeratus + $dunAtasPagar;
                            ?>
                            <th><?= number_format($dunAtasPagar, 2, '.', '') ?>%</th>
                            <th><?= number_format($jumlahSeratus, 2, '.', '') ?>%</th>
                            <th>
                                <?php 
                                $majoriti = 0;
                                $majoriti = $tempPutihHighest - $tempNotPutihHighest;
                                echo $majoriti;
                                ?>
                            </th>
                            <th>
                                <?php 
                                $peratusMajoriti = 0;
                                $peratusMajoriti = ($majoriti/(($dunKeluarMengundi/100) * $jumlahBilanganPengundi)) * 100;
                                echo number_format($peratusMajoriti, 2, '.', ','); 
                                ?>%
                            </th>
                            <?php 
                                //SEBELUM CELL GRADING
                                //INTIALIZE GRADING
                                $gr = '';
                                $grWarna = '';
                                //GUNA FUNCTION GRADING
                                $tempGrading = grading_status($peratusMajoriti);
                                //LOAD
                                $gr = $tempGrading['grade'];
                                $grWarna = $tempGrading['warna'];
                                ?>
                            <th style="<?= $grWarna ?>"><?= $gr ?></th>
                            <th style="<?= $warnaParti ?>"><?= $calonMenangBil ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Justifikasi</h1>
            <p><?= $harian->harian_ulasan ?></p>
        </div>
    </div>

    


    </section>

</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>