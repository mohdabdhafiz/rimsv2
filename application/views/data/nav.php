<div class="mb-3">
    <div class="row g-3 mt-3">
        <div class="col-12 col-lg-2 col-md-4 col-sm-6">
            <a href="<?= site_url('program') ?>" class="btn btn-sm btn-outline-primary w-100 d-flex flex-column shadow">
                <i class="bi bi-calendar-event display-1"></i>
                <div class="mt-auto small">RIMS@PROGRAM</div>
            </a>
        </div>
        <div class="col-12 col-lg-2 col-md-4 col-sm-6">
            <a href="<?= site_url('dpi/senaraiKaum') ?>" class="btn btn-sm btn-outline-secondary w-100 d-flex flex-column shadow">
                <i class="bi bi-files display-1"></i>
                <div class="mt-auto small">DPI KAUM</div>
            </a>
        </div>
        <div class="col-12 col-lg-2 col-md-4 col-sm-6">
            <a href="<?= site_url('konfigurasi/konfigurasiSimulasiKaum') ?>" class="btn btn-sm btn-outline-secondary w-100 d-flex flex-column shadow">
                <i class="bi bi-gear-wide-connected display-1"></i>
                <div class="mt-auto small">SIMULASI DPI KAUM</div>
            </a>
        </div>
        <div class="col-12 col-lg-2 col-md-4 col-sm-6">
            <a href="<?= site_url('winnable_candidate') ?>" class="btn btn-sm btn-outline-success w-100 d-flex flex-column shadow">
                <i class="bi bi-person-plus display-1"></i>
                <div class="mt-auto small">JANGKAAN CALON</div>
            </a>
        </div>
        <div class="col-12 col-lg-2 col-md-4 col-sm-6">
            <a href="<?= site_url('pilihanraya') ?>" class="btn btn-sm btn-outline-success w-100 d-flex flex-column shadow">
                <i class="bi bi-gear-wide-connected display-1"></i>
                <div class="mt-auto small">PILIHAN RAYA</div>
            </a>
        </div>
        <div class="col-12 col-lg-2 col-md-4 col-sm-6">
            <a href="<?= site_url('grading') ?>" class="btn btn-sm btn-outline-success w-100 d-flex flex-column shadow">
                <i class="bi bi-bezier2 display-1"></i>
                <div class="mt-auto small">GRADING</div>
            </a>
        </div>
        <div class="col-12 col-lg-4">
            <?php echo anchor('pencalonan', 'PENCALONAN PILIHAN RAYA', 'class="btn btn-sm btn-primary w-100"'); ?>
        </div>
        <div class="col-12 col-lg-4">
            <?php echo anchor(base_url(), 'GRADING MENGIKUT NEGERI', 'class="btn btn-sm btn-primary w-100"'); ?>
        </div>
        <div class="col-12 col-lg-4">
            <?php echo anchor('laporan/keputusan_semasa', 'KEPUTUSAN SEMASA', 'class="btn btn-sm btn-primary w-100"'); ?>
        </div>
        <div class="col-12 col-lg-4">
            <?php echo anchor('laporan/jangkaan', 'LOCK STATUS', 'class="btn btn-sm btn-primary w-100"'); ?>
        </div>
        <div class="col-12 col-lg-4">
            <a href="<?= site_url('pilihanraya/lockRasmi') ?>" class="btn btn-sm btn-primary w-100">LOCK RASMI</a>
        </div>
        <div class="col-12 col-lg-4">
            <?php echo anchor('laporan/rasmi', 'RASMI', 'class="btn btn-sm btn-primary w-100"'); ?>
        </div>
        <div class="col-12 col-lg-4">
            <?php echo anchor('undi/rumusan', 'RUMUSAN UNDI', 'class="btn btn-sm btn-primary w-100"'); ?>
        </div>
        <div class="col-12 col-lg-4">
            <?php echo anchor('parlimen/rumusanPerwakilan', 'RUMUSAN UNDI', 'class="btn btn-sm btn-primary w-100"'); ?>
        </div>
    </div>
</div>