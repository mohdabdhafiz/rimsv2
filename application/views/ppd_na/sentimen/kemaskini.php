<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LKS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('sentimen') ?>">RIMS@LKS</a></li>
                <li class="breadcrumb-item active">Kemaskini Laporan Khas Sentimen [Nombor Siri: <?= $sentimen->stBil ?>]</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Laporan Khas Sentimen [Nombor Siri: <?= $sentimen->stBil ?>]</h5>
            <?= validation_errors() ?>
            <?= form_open('sentimen/prosesKemaskini') ?>
            <div class="form-floating mb-3">
                <input type="date" name="inputTarikhLaporan" id="inputTarikhLaporan" class="form-control" value="<?= $sentimen->stTarikhLaporan ?>" required>
                <label for="inputTarikhLaporan" class="form-label">Tarikh Laporan</label>
            </div>
            <div class="form-floating mb-3">
                <select name="inputPelaporBil" id="inputPelaporBil" class="form-control" required>
                    <option value="">Sila pilih..</option>
                    <?php foreach($senaraiPelapor as $pelapor): ?>
                        <option value="<?= $pelapor->bil ?>" <?php if($pelapor->bil == $sentimen->stPelaporBil){ echo "selected"; } ?>><?= $pelapor->nama_penuh ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="inputPelaporBil" class="form-label">Pelapor</label>
            </div>
            <div class="form-floating mb-3">
                <select name="inputDaerahBil" id="inputDaerahBil" class="form-control" required>
                    <option value="">Sila pilih..</option>
                    <?php foreach($senaraiDaerah as $daerah): ?>
                        <option value="<?= $daerah->bil ?>" <?php if($daerah->bil == $sentimen->stDaerahBil){ echo "selected"; } ?>><?= $daerah->nama ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="inputDaerahBil" class="form-label">Daerah</label>
            </div>
            <?php if(!empty($senaraiParlimen)): ?>
            <div class="form-floating mb-3">
                <select name="inputParlimenBil" id="inputParlimenBil" class="form-control">
                    <option value="">Sila pilih..</option>
                    <?php foreach($senaraiParlimen as $parlimen): ?>
                        <option value="<?= $parlimen->pt_bil ?>" <?php if($parlimen->pt_bil == $sentimen->stParlimenBil){ echo "selected"; } ?>><?= $parlimen->pt_nama ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="inputParlimenBil" class="form-label">Parlimen</label>
            </div>
            <?php endif; ?>
            <?php if(!empty($senaraiDun)): ?>
            <div class="form-floating mb-3">
                <select name="inputDunBil" id="inputDunBil" class="form-control">
                    <option value="">Sila pilih..</option>
                    <?php foreach($senaraiDun as $dun): ?>
                        <option value="<?= $dun->dun_bil ?>" <?php if($dun->dun_bil == $sentimen->stDunBil){ echo "selected"; } ?>><?= $dun->dun_nama ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="inputDunBil" class="form-label">DUN</label>
            </div>
            <?php endif; ?>
            <div class="form-floating mb-3">
                <select name="inputKawasan" id="inputKawasan" class="form-control">
                    <option value="" <?php if($sentimen->stKawasan == ''){ echo "selected"; } ?>>Sila pilih..</option>
                    <option value="Bandar" <?php if($sentimen->stKawasan == 'Bandar'){ echo "selected"; } ?>>Bandar</option>
                    <option value="Pinggir Bandar" <?php if($sentimen->stKawasan == 'Pinggir Bandar'){ echo "selected"; } ?>>Pinggir Bandar</option>
                    <option value="Luar Bandar" <?php if($sentimen->stKawasan == 'Luar Bandar'){ echo "selected"; } ?>>Luar Bandar</option>
                </select>
                <label for="inputKawasan" class="form-label">Kawasan</label>
            </div>
            <div class="form-floating mb-3">
                <select name="inputSentimen" id="inputSentimen" class="form-control" required>
                    <option value="" <?php if($sentimen->stSentimen == ''){ echo "selected"; } ?>>Sila pilih..</option>
                    <option value="Teruja" <?php if($sentimen->stSentimen == 'Teruja'){ echo "selected"; } ?>>Teruja</option>
                    <option value="Gembira" <?php if($sentimen->stSentimen == 'Gembira'){ echo "selected"; } ?>>Gembira</option>
                    <option value="Senang Hati" <?php if($sentimen->stSentimen == 'Senang Hati'){ echo "selected"; } ?>>Senang Hati</option>
                    <option value="Bersyukur" <?php if($sentimen->stSentimen == 'Bersyukur'){ echo "selected"; } ?>>Bersyukur</option>
                    <option value="Okey" <?php if($sentimen->stSentimen == 'Okey'){ echo "selected"; } ?>>Okey</option>
                    <option value="Kecewa" <?php if($sentimen->stSentimen == 'Kecewa'){ echo "selected"; } ?>>Kecewa</option>
                    <option value="Sedih" <?php if($sentimen->stSentimen == 'Sedih'){ echo "selected"; } ?>>Sedih</option>
                    <option value="Risau" <?php if($sentimen->stSentimen == 'Risau'){ echo "selected"; } ?>>Risau</option>
                    <option value="Tidak Peduli" <?php if($sentimen->stSentimen == 'Tidak Peduli'){ echo "selected"; } ?>>Tidak Peduli</option>
                    <option value="Tidak Puas Hati" <?php if($sentimen->stSentimen == 'Tidak Puas Hati'){ echo "selected"; } ?>>Tidak Puas Hati</option>
                </select>
                <label for="inputSentimen" class="form-label">Apakah perasaan anda terhadap pentadbiran kerajaan baharu?</label>
            </div>
            <div class="form-floating mb-3">
                <textarea name="inputAlasan" id="inputAlasan" cols="5" rows="10" class="form-control" placeholder="Alasan" style="height:200px;" required><?= $sentimen->stAlasan ?></textarea>
                <label for="inputAlasan" class="form-label">Sila nyatakan alasan anda</label>
            </div>
            <div class="text-center">
                <input type="hidden" name="inputBil" value="<?= $sentimen->stBil ?>">
                <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                <input type="hidden" name="inputPenggunaWaktu" value="<?= date('Y-m-d H:i:s') ?>">
                <button type="submit" class="btn btn-outline-primary shadow-sm">Kemaskini</button>
            </div>
            </form>
        </div>
    </div>

    </section>

</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>