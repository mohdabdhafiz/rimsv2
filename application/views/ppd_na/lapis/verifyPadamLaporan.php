<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LAPIS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">RIMS@LAPIS</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <div class="p-3 border rounded mb-3 bg-white shadow">
    <h1 class="text-danger">
        <i class="bi bi-trash"></i>
        PADAM LAPORAN</h1>
    <p>Adakah anda pasti untuk memadam laporan ini?</p>
    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-4 col-md-6 col-sm-12">
            <div class="p-3 border rounded">
                <strong>Tarikh Laporan:</strong><br>
                <?= strtoupper(date_format(date_create($laporan->tarikhLaporan), 'd.m.Y')) ?>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-6 col-sm-12">
            <div class="p-3 border rounded">
                <strong>Pelapor:</strong><br>
                <?= strtoupper($laporan->pelaporNama) ?>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-6 col-sm-12">
            <div class="p-3 border rounded">
                <strong>Negeri:</strong><br>
                <?= strtoupper($laporan->negeri) ?>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-6 col-sm-12">
            <div class="p-3 border rounded">
                <strong>Daerah:</strong><br>
                <?= strtoupper($laporan->daerah) ?>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-6 col-sm-12">
            <div class="p-3 border rounded">
                <strong>Parlimen:</strong><br>
                <?= strtoupper($laporan->parlimen) ?>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-6 col-sm-12">
            <div class="p-3 border rounded">
                <strong>DUN:</strong><br>
                <?= strtoupper($laporan->dun) ?>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-6 col-sm-12">
            <div class="p-3 border rounded">
                <strong>Daerah Mengundi (DM):</strong><br>
                <?= strtoupper($laporan->dm) ?>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-6 col-sm-12">
            <div class="p-3 border rounded">
                <strong>Kluster:</strong><br>
                <?= strtoupper($laporan->kluster) ?>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-6 col-sm-12">
            <div class="p-3 border rounded">
                <strong>Jenis Kawasan:</strong><br>
                <?= strtoupper($laporan->jenis_kawasan) ?>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-md-6 col-sm-12">
            <div class="p-3 border rounded">
                <strong>Lokasi Isu:</strong><br>
                <?php
                $lokasi_isu = '-';
                if(!empty($laporan->lokasi_isu)){
                    $lokasi_isu = $laporan->lokasi_isu;
                }
                echo strtoupper($lokasi_isu);
                ?>
            </div>
        </div><div class="col-12 col-lg-6 col-md-6 col-sm-12">
            <div class="p-3 border rounded">
                <strong>Latitude dan Longitude Lokasi Isu:</strong><br>
                <em>Latitude: </em><?= $laporan->latitude ?><br>
                <em>Longitude: </em><?= $laporan->longitude ?>
            </div>
        </div>
        <?php if($kluster_shortform == 'politik'): ?>
        <div class="col-12 col-lg-12 col-md-12 col-sm-12">
            <div class="p-3 border rounded">
                <strong>Isu:</strong><br>
                <?= strtoupper($laporan->isu_politik) ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="col-12 col-lg-12 col-md-12 col-sm-12">
            <div class="p-3 border rounded">
                <strong>Ringkasan Isu:</strong><br>
                <?php
                $ringkasan_isu = '-';
                if(!empty($laporan->ringkasan_isu)){
                    $ringkasan_isu = $laporan->ringkasan_isu;
                }
                echo strtoupper($ringkasan_isu);
                ?>
            </div>
        </div>
        <div class="col-12 col-lg-12 col-md-12 col-sm-12">
            <div class="p-3 border rounded">
                <strong>Cadangan Intervensi:</strong><br>
                <?= strtoupper($laporan->cadangan_intervensi) ?>
            </div>
        </div>
        <div class="col-12 col-lg-12 col-md-12 col-sm-12">
            <div class="p-3 border rounded">
                <strong>Dimasukkan pada:</strong><br>
                <?= strtoupper($laporan->pengguna_waktu) ?>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-6">
            <?php echo form_open('lapis/proses_padam_laporan_sah'); ?>
                <input type="hidden" name="input_pengesahan" value="Ya">
                        <input type="hidden" name="input_kluster_shortform" value="<?= $kluster_shortform ?>">
                        <input type="hidden" name="input_tahun_laporan" value="<?= date_format(date_create($laporan->tarikhLaporan), 'Y') ?>">
                        <input type="hidden" name="input_pelapor_bil" value="<?= $laporan->pelaporBil ?>">
                        <input type="hidden" name="input_laporan_bil" value="<?= $laporan->laporanBil ?>">
                        <button type="submit" class="btn btn-sm btn-danger w-100">Ya</button>
                        </form>
        </div>
        <div class="col-6">
            <?php echo anchor('lapis/penuh/'.$kluster_shortform, 'Tidak', "class='btn btn-secondary btn-sm w-100'"); ?>
        </div>
    </div>
</div>

    </section>

</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>