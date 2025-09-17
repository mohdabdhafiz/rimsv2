<?php
$this->load->view('us_lapis_na/susunletak/atas');
$this->load->view('us_lapis_na/susunletak/navbar');
$this->load->view('us_lapis_na/susunletak/sidebar');
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
                <div class="col-auto">
           <div class="card">
           <div class="card-body">
    <h1 class="card-title">Terima Laporan</h1>
    <p>Adakah anda pasti untuk menerima laporan ini?</p>
    <div class="row g-1">
        <div class="col-auto">
    <p>
        <strong>Tarikh Laporan:</strong><br>
        <?= date_format(date_create($laporan->tarikh_laporan), 'd.m.Y') ?>
    </p>
    <p>
        <strong>Pelapor:</strong><br>
        <?php
        $pelapor = $data_pengguna->pengguna($laporan->pelapor); 
        echo $pelapor->nama_penuh;
        ?>
    </p>
    <p>
        <strong>Negeri:</strong><br>
        <?php
        $nama_negeri = '-';
        if(!empty($laporan->negeri)){
            $negeri = $data_negeri->negeri($laporan->negeri);
            $nama_negeri = $negeri->nt_nama;
        }
        echo $nama_negeri;
        ?>
    </p>
    <p>
        <strong>Daerah:</strong><br>
        <?php
        $nama_daerah = '-';
        if(!empty($laporan->daerah)){
            $daerah = $data_daerah->daerah($laporan->daerah);
            if(empty($daerah)){
                $nama_daerah = $laporan->daerah;
            }else{
                $nama_daerah = $daerah->nama;
            }
        }
        echo $nama_daerah;
        ?>
    </p>
    <p>
        <strong>Parlimen:</strong><br>
        <?php
        $nama_parlimen = "-";
        if(!empty($laporan->parlimen)){
            $parlimen = $data_parlimen->parlimen_bil($laporan->parlimen);
            $nama_parlimen = $parlimen->pt_nama;
        }
        echo $nama_parlimen;
        ?>
    </p>
    <p>
        <strong>DUN:</strong><br>
        <?php
        $nama_dun = '-';
        if(!empty($laporan->dun)){
            $dun = $data_dun->dun_bil($laporan->dun);
            $nama_dun = $dun->dun_nama;
        }
        echo $nama_dun;
        ?>
    </p>
    <p>
        <strong>Kluster:</strong><br>
        <?php
        $nama_kluster = '-';
        if(!empty($laporan->kluster_bil)){
            $kluster = $dataKluster->papar($laporan->kluster_bil);
            $nama_kluster = $kluster->kit_nama;
        }
        echo $nama_kluster;
        ?>
    </p>
    <p>
        <strong>Ringkasan Isu:</strong><br>
        <?php
        $ringkasan_isu = '-';
        if(!empty($laporan->ringkasan_isu)){
            $ringkasan_isu = $laporan->ringkasan_isu;
        }
        echo $ringkasan_isu;
        ?>
    </p>
    <p>
        <strong>Lokasi Isu:</strong><br>
        <?php
        $lokasi_isu = '-';
        if(!empty($laporan->lokasi_isu)){
            $lokasi_isu = $laporan->lokasi_isu;
        }
        echo $lokasi_isu;
        ?>
    </p>
    </div>
    <?php 
           if($kluster->kit_shortform == 'telekomunikasi'):
            $tahun = date_format(date_create($laporan->tarikh_laporan), 'Y');
           $isuRangkaian = $dataIsuTelekomunikasi->isuRangkaian($laporan->bil, $laporan->pelapor, $tahun); 
           if(!empty($isuRangkaian)):?>
            <div class="col-auto">


            <div class="row g-3">
            <div class="col">
                <img class="img-fluid" src="<?= base_url() ?>/assets/img/<?= $isuRangkaian->dokumen ?>" alt="Screenshot untuk Isu Telekomunikasi <?= $laporan->bil ?>">
            </div>
            <div class="col">
                <p>
                    <strong>Mobile Operator:</strong>
                    <br><?= $isuRangkaian->mobile_operator ?>
                </p>
                <p>
                    <strong>Download Rate (Mbps):</strong>
                    <br><?= $isuRangkaian->download ?>
                </p>
                <p>
                    <strong>Upload Rate (Mbps):</strong>
                    <br><?= $isuRangkaian->upload ?>
                </p>
                <p>
                    <strong>Ping Rate (ms):</strong>
                    <br><?= $isuRangkaian->ping ?>
                </p>
            </div>
        </div>


            </div>
            <?php 
        endif;
        endif; ?>
    </div>
    <div class="d-flex justify-content-center">
    <div class="row g-1">
        <div class="col-auto">
            <?php echo form_open('lapis/laporanTerima'); ?>
                <input type="hidden" name="input_pengesahan" value="Ya">
                        <input type="hidden" name="input_kluster_shortform" value="<?= $kluster_shortform ?>">
                        <input type="hidden" name="input_tahun_laporan" value="<?= date_format(date_create($laporan->tarikh_laporan), 'Y') ?>">
                        <input type="hidden" name="input_pelapor_bil" value="<?= $laporan->pelapor ?>">
                        <input type="hidden" name="input_laporan_bil" value="<?= $laporan->bil ?>">
                        <button type="submit" class="btn btn-outline-success shadow-sm">Terima</button>
                        </form>
        </div>
        <div class="col-auto">
            <?php echo anchor('lapis/senaraiHantarNegeri/'.$laporan->kluster_bil, 'Kembali', "class='btn btn-outline-secondary shadow-sm'"); ?>
        </div>
    </div>
    </div>
</div>
           </div>

           </div>

           

           </div>


        </section>
    

</main>


<?php $this->load->view('us_lapis_na/susunletak/bawah'); ?>