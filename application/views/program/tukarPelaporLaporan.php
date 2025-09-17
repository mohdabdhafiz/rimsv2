<?php 
$this->load->view($header);
$this->load->view($navbar);
$this->load->view($sidebar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('program') ?>">Laman</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('program/senarai') ?>">Senarai Program</a></li>
                <li class="breadcrumb-item active">Tukar Pelapor Laporan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <a href="<?= site_url("program/bil/".$program->program_bil) ?>" class="btn btn-outline-info shadow-sm mb-3">Kembali</a>

    <?php if($statusPertukaran): ?>
        <div class="alert alert-success mb-3">
            Pertukaran Status Laporan Berjaya!
        </div>
    <?php endif; ?>

<div class="card">
    <div class="card-body">
        <h1 class="card-title">Maklumat Laporan</h1>
        <div class="row g-3 mb-3">
            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                <div class="h4">Nombor Siri</div>
                <div class="text-secondary"><?= $program->program_bil ?></div>
            </div>
            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                <div class="h4">Nama Pelapor</div>
                <div class="text-secondary"><?= strtoupper($program->nama_penuh) ?></div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h1 class="card-title">Tukar Pelapor Laporan</h1>
        <?= form_open('program/tukarPelaporLaporan/'.$program->program_bil) ?>
            <div class="form-floating mb-3">
                <select name="inputPelaporLaporan" id="inputPelaporLaporan" class="form-control" required>
                    <option value="">Sila Pilih</option>
                    <?php foreach($senaraiPelapor as $pelapor): ?>
                    <option value="<?= $pelapor->bil ?>" <?php if($program->program_pelapor == $pelapor->bil){ echo "selected"; } ?>>[<?= $pelapor->bil ?>] <?= strtoupper($pelapor->nama_penuh) ?> | <?= strtoupper($pelapor->pekerjaan) ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="inputPelaporLaporan" class="form-label">Nama Pelapor:</label>
            </div>
            <input type="hidden" name="inputProgramBil" value="<?= $program->program_bil ?>">
            <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
            <input type="hidden" name="inputPenggunaWaktu" value="<?= date("Y-m-d H:i:s") ?>">
            <button type="submit" class="btn btn-outline-primary shadow-sm">Tukar</button>
        </form>
    </div>
</div>

</section>


</main>


<?php $this->load->view($footer); ?>