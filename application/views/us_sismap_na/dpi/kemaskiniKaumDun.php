<?php

$this->load->view('us_sismap_na/susunletak/atas');
$this->load->view('us_sismap_na/susunletak/navbar');
$this->load->view('us_sismap_na/susunletak/sidebar');
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">RIMS</a></li>
                <li class="breadcrumb-item active">RIMS@SISMAP</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

        <section class="section">

            <?php $this->load->view('us_sismap_na/dpi/nav'); ?>
            
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Kemaskini Maklumat Kaum Bagi DUN <?= $dun->dun_nama ?></h1>
                   
                    <?= form_open('dpi/prosesKaumDun') ?>
                    <?php
                    $jumlahKaumMelayu = 0;
                    $jumlahKaumCina = 0;
                    $jumlahKaumIndia = 0;
                    $jumlahKaumBumiSabah = 0;
                    $jumlahKaumBumiSarawak = 0;
                    $jumlahKaumOrangAsli = 0;
                    $jumlahKaumLain = 0;
                    $jumlahPengundiRims = 0;
                    $jumlahPengundiDataKaum = 0;
                    ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Daerah Mengundi</th>
                                    <th>Bilangan Pengundi Mengikut Data RIMS</th>
                                    <th>Melayu</th>
                                    <th>Cina</th>
                                    <th>India</th>
                                    <th>Bumi Sabah</th>
                                    <th>Bumi Sarawak</th>
                                    <th>Orang Asli</th>
                                    <th>Lain-Lain</th>
                                    <th>Bilangan Pengundi Mengikut Data Kaum</th>
                                    <th>Majoriti Kaum</th>
                                    <th>Peratus Majoriti</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($senaraiDaerahMengundi as $dm): 
                                    $jumlahPengundiKaum = 0;
                                    ?>
                                <tr>
                                    <td><?= $dm->pdt_nama ?></td>
                                    <td><?= number_format($dm->pdt_bilangan_pengundi, 0, '', ',') ?>
                                        <?php $jumlahPengundiRims = $jumlahPengundiRims + $dm->pdt_bilangan_pengundi; ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $dpiKaum = $dataDpiKaum->dmKaumDun($dm->pdt_bil, 'Melayu');
                                        $bilanganPengundi = 0;
                                        if(!empty($dpiKaum)){
                                            $bilanganPengundi = $dpiKaum->dkdt_bilangan_pengundi;
                                        }
                                        $jumlahPengundiKaum = $jumlahPengundiKaum + $bilanganPengundi;
                                        $pMelayu = $bilanganPengundi;
                                        $jumlahKaumMelayu = $jumlahKaumMelayu + $pMelayu;
                                        ?>
                                        <input type="text" name="inputKaumMelayu[<?= $dm->pdt_bil ?>]" id="inputKaumMelayu[<?= $dm->pdt_bil ?>]" class="form-control" value="<?= $bilanganPengundi ?>" style="width:100px;">
                                    </td>
                                    <td>
                                        <?php 
                                        $dpiKaum = $dataDpiKaum->dmKaumDun($dm->pdt_bil, 'Cina');
                                        $bilanganPengundi = 0;
                                        if(!empty($dpiKaum)){
                                            $bilanganPengundi = $dpiKaum->dkdt_bilangan_pengundi;
                                        }
                                        $jumlahPengundiKaum = $jumlahPengundiKaum + $bilanganPengundi;
                                        $pCina = $bilanganPengundi;
                                        $jumlahKaumCina = $jumlahKaumCina + $pCina;
                                        ?>
                                        <input type="text" name="inputKaumCina[<?= $dm->pdt_bil ?>]" id="inputKaumCina[<?= $dm->pdt_bil ?>]" class="form-control" value="<?= $bilanganPengundi ?>" style="width:100px;"></td>
                                    <td>
                                        <?php 
                                        $dpiKaum = $dataDpiKaum->dmKaumDun($dm->pdt_bil, 'India');
                                        $bilanganPengundi = 0;
                                        if(!empty($dpiKaum)){
                                            $bilanganPengundi = $dpiKaum->dkdt_bilangan_pengundi;
                                        }
                                        $jumlahPengundiKaum = $jumlahPengundiKaum + $bilanganPengundi;
                                        $pIndia = $bilanganPengundi;
                                        $jumlahKaumIndia = $jumlahKaumIndia + $pIndia;
                                        ?>
                                        <input type="text" name="inputKaumIndia[<?= $dm->pdt_bil ?>]" id="inputKaumIndia[<?= $dm->pdt_bil ?>]" class="form-control" value="<?= $bilanganPengundi ?>" style="width:100px;"></td>
                                    <td>
                                        <?php 
                                        $dpiKaum = $dataDpiKaum->dmKaumDun($dm->pdt_bil, 'Bumi Sabah');
                                        $bilanganPengundi = 0;
                                        if(!empty($dpiKaum)){
                                            $bilanganPengundi = $dpiKaum->dkdt_bilangan_pengundi;
                                        }
                                        $jumlahPengundiKaum = $jumlahPengundiKaum + $bilanganPengundi;
                                        $pSabah = $bilanganPengundi;
                                        $jumlahKaumBumiSabah = $jumlahKaumBumiSabah + $pSabah;
                                        ?>
                                        <input type="text" name="inputKaumBumiSabah[<?= $dm->pdt_bil ?>]" id="inputKaumBumiSabah[<?= $dm->pdt_bil ?>]" class="form-control" value="<?= $bilanganPengundi ?>" style="width:100px;"></td>
                                    <td>
                                        <?php 
                                        $dpiKaum = $dataDpiKaum->dmKaumDun($dm->pdt_bil, 'Bumi Sarawak');
                                        $bilanganPengundi = 0;
                                        if(!empty($dpiKaum)){
                                            $bilanganPengundi = $dpiKaum->dkdt_bilangan_pengundi;
                                        }
                                        $jumlahPengundiKaum = $jumlahPengundiKaum + $bilanganPengundi;
                                        $pSarawak = $bilanganPengundi;
                                        $jumlahKaumBumiSarawak = $jumlahKaumBumiSarawak + $pSarawak;
                                        ?>
                                        <input type="text" name="inputKaumBumiSarawak[<?= $dm->pdt_bil ?>]" id="inputKaumBumiSarawak[<?= $dm->pdt_bil ?>]" class="form-control" value="<?= $bilanganPengundi ?>" style="width:100px;"></td>
                                    <td>
                                        <?php 
                                        $dpiKaum = $dataDpiKaum->dmKaumDun($dm->pdt_bil, 'Orang Asli');
                                        $bilanganPengundi = 0;
                                        if(!empty($dpiKaum)){
                                            $bilanganPengundi = $dpiKaum->dkdt_bilangan_pengundi;
                                        }
                                        $jumlahPengundiKaum = $jumlahPengundiKaum + $bilanganPengundi;
                                        $pAsli = $bilanganPengundi;
                                        $jumlahKaumOrangAsli = $jumlahKaumOrangAsli + $pAsli;
                                        ?>
                                        <input type="text" name="inputKaumOrangAsli[<?= $dm->pdt_bil ?>]" id="inputKaumOrangAsli[<?= $dm->pdt_bil ?>]" class="form-control" value="<?= $bilanganPengundi ?>" style="width:100px;"></td>
                                    <td>
                                        <?php 
                                        $dpiKaum = $dataDpiKaum->dmKaumDun($dm->pdt_bil, 'Lain-lain');
                                        $bilanganPengundi = 0;
                                        if(!empty($dpiKaum)){
                                            $bilanganPengundi = $dpiKaum->dkdt_bilangan_pengundi;
                                        }
                                        $jumlahPengundiKaum = $jumlahPengundiKaum + $bilanganPengundi;
                                        $pLain = $bilanganPengundi;
                                        $jumlahKaumLain = $jumlahKaumLain + $pLain;
                                        ?>
                                        <input type="text" name="inputKaumLain[<?= $dm->pdt_bil ?>]" id="inputKaumLain[<?= $dm->pdt_bil ?>]" class="form-control" value="<?= $bilanganPengundi ?>" style="width:100px;"></td>
                                    <td><?= number_format($jumlahPengundiKaum, 0, '', ',') ?>
                                        <?php $jumlahPengundiDataKaum = $jumlahPengundiDataKaum + $jumlahPengundiKaum; ?>    
                                    </td>

                                    <?php
                                        $pilihanKaum = '-';
                                        $peratusMajoriti = 0;
                                        if($jumlahPengundiKaum != 0):
                                        $tempPeratus = ($pMelayu/$jumlahPengundiKaum)*100;
                                        if($tempPeratus > $majoriti){
                                            $pilihanKaum = 'Melayu';
                                            $peratusMajoriti = $tempPeratus;
                                        }

                                        $tempPeratus = ($pCina/$jumlahPengundiKaum)*100;
                                        if($tempPeratus > $majoriti){
                                            $pilihanKaum = 'Cina';
                                            $peratusMajoriti = $tempPeratus;
                                        }
                                        
                                        $tempPeratus = ($pIndia/$jumlahPengundiKaum)*100;
                                        if($tempPeratus > $majoriti){
                                            $pilihanKaum = 'India';
                                            $peratusMajoriti = $tempPeratus;
                                        }
                                        
                                        $tempPeratus = ($pSabah/$jumlahPengundiKaum)*100;
                                        if($tempPeratus > $majoriti){
                                            $pilihanKaum = 'Bumi Sabah';
                                            $peratusMajoriti = $tempPeratus;
                                        }
                                        
                                        $tempPeratus = ($pSarawak/$jumlahPengundiKaum)*100;
                                        if($tempPeratus > $majoriti){
                                            $pilihanKaum = 'Bumi Sarawak';
                                            $peratusMajoriti = $tempPeratus;
                                        }
                                        
                                        $tempPeratus = ($pAsli/$jumlahPengundiKaum)*100;
                                        if($tempPeratus > $majoriti){
                                            $pilihanKaum = 'Orang Asli';
                                            $peratusMajoriti = $tempPeratus;
                                        }
                                        
                                        $tempPeratus = ($pLain/$jumlahPengundiKaum)*100;
                                        if($tempPeratus > $majoriti){
                                            $pilihanKaum = 'Lain-Lain';
                                            $peratusMajoriti = $tempPeratus;
                                        }
                                        endif;
                                        
                                    ?>

                                    <td><?= $pilihanKaum ?></td>
                                    <td><?= number_format($peratusMajoriti, 2, '.', ',') ?></td>
                                </tr>
                                <input type="hidden" name="inputDmBil[<?= $dm->pdt_bil ?>]" value="<?= $dm->pdt_bil ?>">
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>JUMLAH</th>
                                    <th><?= number_format($jumlahPengundiRims, 0, '', ',') ?>
                                    </th>
                                    <th><?= number_format($jumlahKaumMelayu, 0, '', ',') ?>
                                    <?php $jpMelayu =  $jumlahKaumMelayu; ?>
                                    </th>
                                    <th><?= number_format($jumlahKaumCina, 0, '', ',') ?>
                                    <?php $jpCina =  $jumlahKaumCina; ?>
                                </th>
                                    <th><?= number_format($jumlahKaumIndia, 0, '', ',') ?>
                                    <?php $jpIndia =  $jumlahKaumIndia; ?>
                                </th>
                                    <th><?= number_format($jumlahKaumBumiSabah, 0, '', ',') ?>
                                    <?php $jpSabah =  $jumlahKaumBumiSabah; ?>
                                </th>
                                    <th><?= number_format($jumlahKaumBumiSarawak, 0, '', ',') ?>
                                    <?php $jpSarawak =  $jumlahKaumBumiSarawak; ?>
                                </th>
                                    <th><?= number_format($jumlahKaumOrangAsli, 0, '', ',') ?>
                                    <?php $jpAsli =  $jumlahKaumOrangAsli; ?>
                                </th>
                                    <th><?= number_format($jumlahKaumLain, 0, '', ',') ?>
                                    <?php $jpLain =  $jumlahKaumLain; ?>
                                </th>
                                    <th><?= number_format($jumlahPengundiDataKaum, 0, '', ',') ?></th>
                                    <?php
                                        $pilihanKaum = '-';
                                        $peratusMajoriti = 0;
                                        if($jumlahPengundiDataKaum != 0):
                                        $tempPeratus = ($jpMelayu/$jumlahPengundiDataKaum)*100;
                                        if($tempPeratus > $majoriti){
                                            $pilihanKaum = 'Melayu';
                                            $peratusMajoriti = $tempPeratus;
                                        }

                                        $tempPeratus = ($jpCina/$jumlahPengundiDataKaum)*100;
                                        if($tempPeratus > $majoriti){
                                            $pilihanKaum = 'Cina';
                                            $peratusMajoriti = $tempPeratus;
                                        }
                                        
                                        $tempPeratus = ($jpIndia/$jumlahPengundiDataKaum)*100;
                                        if($tempPeratus > $majoriti){
                                            $pilihanKaum = 'India';
                                            $peratusMajoriti = $tempPeratus;
                                        }
                                        
                                        $tempPeratus = ($jpSabah/$jumlahPengundiDataKaum)*100;
                                        if($tempPeratus > $majoriti){
                                            $pilihanKaum = 'Bumi Sabah';
                                            $peratusMajoriti = $tempPeratus;
                                        }
                                        
                                        $tempPeratus = ($jpSarawak/$jumlahPengundiDataKaum)*100;
                                        if($tempPeratus > $majoriti){
                                            $pilihanKaum = 'Bumi Sarawak';
                                            $peratusMajoriti = $tempPeratus;
                                        }
                                        
                                        $tempPeratus = ($jpAsli/$jumlahPengundiDataKaum)*100;
                                        if($tempPeratus > $majoriti){
                                            $pilihanKaum = 'Orang Asli';
                                            $peratusMajoriti = $tempPeratus;
                                        }
                                        
                                        $tempPeratus = ($jpLain/$jumlahPengundiDataKaum)*100;
                                        if($tempPeratus > $majoriti){
                                            $pilihanKaum = 'Lain-Lain';
                                            $peratusMajoriti = $tempPeratus;
                                        }
                                        endif;
                                        
                                    ?>

                                    <th><?= $pilihanKaum ?></th>
                                    <th><?= number_format($peratusMajoriti, 2, '.', ',') ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="text-center">
                        <input type="hidden" name="inputDunBil" value="<?= $dun->dun_bil ?>">
                        <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                        <input type="hidden" name="inputPenggunaWaktu" value="<?= date("Y-m-d H:i:s") ?>">
                        <button type="submit" class="btn btn-outline-success shadow-sm">Simpan</button>
                    </div>
                    </form>

                </div>
            </div>

        </section>
</main>
</div>
</div>

<?php
$this->load->view('us_sismap_na/susunletak/bawah');
?>