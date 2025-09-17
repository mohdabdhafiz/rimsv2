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
                <li class="breadcrumb-item active">Borang Laporan Khas Sentimen</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Borang Laporan Khas Sentimen</h5>
            <?= validation_errors() ?>
            <?= form_open('sentimen/prosesTambah') ?>
            <div class="form-floating mb-3">
                <input type="date" name="inputTarikhLaporan" id="inputTarikhLaporan" class="form-control" value="<?= set_value('inputTarikhLaporan') ?>" required>
                <label for="inputTarikhLaporan" class="form-label">Tarikh Laporan</label>
            </div>
            <div class="form-floating mb-3">
                <select name="inputPelaporBil" id="inputPelaporBil" class="form-control" required>
                    <option value="">Sila pilih..</option>
                    <?php foreach($senaraiPelapor as $pelapor): ?>
                        <option value="<?= $pelapor->bil ?>"><?= $pelapor->nama_penuh ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="inputPelaporBil" class="form-label">Pelapor</label>
            </div>
            <div class="form-floating mb-3">
                <select name="inputDaerahBil" id="inputDaerahBil" class="form-control" required>
                    <option value="">Sila pilih..</option>
                    <?php foreach($senaraiDaerah as $daerah): ?>
                        <option value="<?= $daerah->bil ?>"><?= $daerah->nama ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="inputDaerahBil" class="form-label">Daerah</label>
            </div>
            <?php if(!empty($senaraiParlimen)): ?>
            <div class="form-floating mb-3">
                <select name="inputParlimenBil" id="inputParlimenBil" class="form-control">
                    <option value="">Sila pilih..</option>
                    <?php foreach($senaraiParlimen as $parlimen): ?>
                        <option value="<?= $parlimen->pt_bil ?>"><?= $parlimen->pt_nama ?></option>
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
                        <option value="<?= $dun->dun_bil ?>"><?= $dun->dun_nama ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="inputDunBil" class="form-label">DUN</label>
            </div>
            <?php endif; ?>
            <div class="form-floating mb-3">
                <select name="inputKawasan" id="inputKawasan" class="form-control">
                    <option value="">Sila pilih..</option>
                    <option value="Bandar">Bandar</option>
                    <option value="Pinggir Bandar">Pinggir Bandar</option>
                    <option value="Luar Bandar">Luar Bandar</option>
                </select>
                <label for="inputKawasan" class="form-label">Kawasan</label>
            </div>
            <div class="form-floating mb-3">
                <select name="inputSentimen" id="inputSentimen" class="form-control" required>
                    <option value="">Sila pilih..</option>
                    <option value="Teruja">Teruja</option>
                    <option value="Gembira">Gembira</option>
                    <option value="Senang Hati">Senang Hati</option>
                    <option value="Bersyukur">Bersyukur</option>
                    <option value="Okey">Okey</option>
                    <option value="Kecewa">Kecewa</option>
                    <option value="Sedih">Sedih</option>
                    <option value="Risau">Risau</option>
                    <option value="Tidak Peduli">Tidak Peduli</option>
                    <option value="Tidak Puas Hati">Tidak Puas Hati</option>
                </select>
                <label for="inputSentimen" class="form-label">Apakah perasaan anda terhadap pentadbiran kerajaan baharu?</label>
            </div>
            <div class="form-floating mb-3">
                <textarea name="inputAlasan" id="inputAlasan" cols="5" rows="10" class="form-control" placeholder="Alasan" style="height:200px;" required></textarea>
                <label for="inputAlasan" class="form-label">Sila nyatakan alasan anda</label>
            </div>
            <div class="text-center">
                <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                <input type="hidden" name="inputPenggunaWaktu" value="<?= date('Y-m-d H:i:s') ?>">
                <button type="submit" class="btn btn-outline-primary shadow-sm">Hantar</button>
            </div>
            </form>
        </div>
    </div>

    </section>

</main>


<?php $this->load->view('us_lapis_na/susunletak/bawah'); ?>