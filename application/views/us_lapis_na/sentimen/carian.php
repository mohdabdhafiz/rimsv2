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
                <li class="breadcrumb-item active">Carian Laporan Khas Sentimen</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Carian Senarai Sentimen</h1>
            <?= form_open('sentimen/prosesCarian') ?>
            <div class="row g-3">
                <div class="col-12 col-lg-6">
                    <div class="form-floating">
                        <input type="date" name="inputTarikhMula" id="inputTarikhMula" class="form-control" required>
                        <label for="inputTarikhMula" class="form-label">Tarikh Mula (Timestamp):</label>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-floating">
                        <input type="date" name="inputTarikhTamat" id="inputTarikhTamat" class='form-control' required>
                        <label for="inputTarikhTamat" class="form-label">Tarikh Tamat (Timestamp):</label>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-floating">
                        <select name="inputNegeri" id="inputNegeri" class="form-control">
                            <option value="Semua">Semua</option>
                            <?php foreach($senaraiNegeri as $negeri): ?>
                                <option value="<?= $negeri->nt_bil ?>"><?= $negeri->nt_nama ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputNegeri" class="form-label">Negeri:</label>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-floating">
                        <select name="inputKawasan" id="inputKawasan" class="form-control" required>
                            <option value="Semua">Semua</option>
                            <?php foreach($senaraiKawasan as $kawasan): ?>
                                <option value="<?= $kawasan->stKawasan ?>"><?= $kawasan->stKawasan ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputKawasan" class="form-label">Senarai Kawasan:</label>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-floating">
                        <select name="inputPekerjaan" id="inputPekerjaan" class="form-control" required>
                            <option value="Semua">Semua</option>
                            <?php foreach($senaraiPekerjaan as $kerja): ?>
                                <option value="<?= $kerja->stPekerjaan ?>"><?= $kerja->stPekerjaan ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputPekerjaan" class="form-label">Senarai Pekerjaan:</label>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-floating">
                        <select name="inputJulatUmur" id="inputJulatUmur" class="form-control" required>
                            <option value="Semua">Semua</option>
                            <?php foreach($senaraiJulatUmur as $julatUmur): ?>
                                <option value="<?= $julatUmur->stUmur ?>"><?= $julatUmur->stUmur ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputJulatUmur" class="form-label">Senarai Julat Umur:</label>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-floating">
                        <select name="inputKaum" id="inputKaum" class="form-control" required>
                            <option value="Semua">Semua</option>
                            <?php foreach($senaraiKaum as $kaum): ?>
                                <option value="<?= $kaum->stKaum ?>"><?= $kaum->stKaum ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputKaum" class="form-label">Senarai Kaum:</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <select name="inputSentimen" id="inputSentimen" class="form-control" required>
                            <option value="Semua">Semua</option>
                            <?php foreach($senaraiSentimen as $sentimen): ?>
                                <option value="<?= $sentimen->stSentimen ?>"><?= $sentimen->stSentimen ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputSentimen" class="form-label">Senarai Sentimen:</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="text-center">
                        <button type="submit" class="btn btn-outline-primary shadow-sm">Cari</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    </section>

</main>


<?php $this->load->view('us_lapis_na/susunletak/bawah'); ?>