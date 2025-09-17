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
                <li class="breadcrumb-item active">Maklumat Program</li>
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
                <div class="h4">Status Laporan Semasa</div>
                <div class="text-secondary"><?= strtoupper($program->program_status) ?></div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h1 class="card-title">Tukar Status Laporan</h1>
        <?= form_open('program/tukarStatusLaporan/'.$program->program_bil) ?>
            <div class="form-floating mb-3">
                <select name="inputStatus" id="inputStatus" class="form-control" required>
                    <option value="">Sila Pilih</option>
                    <option value="Draf" <?php if($program->program_status == 'Draf'){ echo "selected"; } ?>>Draf</option>
                    <option value="Draf Negeri" <?php if($program->program_status == 'Draf Negeri'){ echo "selected"; } ?>>Draf Negeri</option>
                    <option value="Pengesahan Perancangan PPD" <?php if($program->program_status == 'Pengesahan Perancangan PPD'){ echo "selected"; } ?>>Pengesahan Perancangan PPD</option>
                    <option value="Pengesahan Perancangan PP PKPM" <?php if($program->program_status == 'Pengesahan Perancangan PP PKPM'){ echo "selected"; } ?>>Pengesahan Perancangan PP PKPM</option>
                    <option value="Pengesahan Perancangan PP BPKPM" <?php if($program->program_status == 'Pengesahan Perancangan PP BPKPM'){ echo "selected"; } ?>>Pengesahan Perancangan PP BPKPM</option>
                    <option value="Jadual Aktiviti" <?php if($program->program_status == 'Jadual Aktiviti'){ echo "selected"; } ?>>Jadual Aktiviti</option>
                    <option value="Pengesahan Hantar PPD" <?php if($program->program_status == 'Pengesahan Hantar PPD'){ echo "selected"; } ?>>Pengesahan Hantar PPD</option>
                    <option value="Pengesahan Hantar Negeri" <?php if($program->program_status == 'Pengesahan Hantar Negeri'){ echo "selected"; } ?>>Pengesahan Hantar Negeri</option>
                    <option value="Pengesahan Hantar PP PKPM Negeri" <?php if($program->program_status == 'Pengesahan Hantar PP PKPM Negeri'){ echo "selected"; } ?>>Pengesahan Hantar PP PKPM Negeri</option>
                    <option value="Pengesahan Hantar PP BPKPM" <?php if($program->program_status == 'Pengesahan Hantar PP BPKPM'){ echo "selected"; } ?>>Pengesahan Hantar PP BPKPM</option>
                </select>
                <label for="inputStatus" class="form-label">Status Laporan Baharu:</label>
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