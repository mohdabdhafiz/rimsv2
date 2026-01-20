<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Lihat Isu</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url('sentimen'); ?>">Sentimen</a></li> 
        <li class="breadcrumb-item active">Lihat Isu</li>
      </ol>
    </nav>
  </div><section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Maklumat Terperinci Isu</h5>

            <div class="row mb-3">
              <div class="col-lg-3 col-md-4 fw-bold">Isu Bil:</div>
              <div class="col-lg-9 col-md-8">
                <?= $isu->sit_bil; ?>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-lg-3 col-md-4 fw-bold">Isu Tajuk:</div>
              <div class="col-lg-9 col-md-8">
                <?= $isu->sit_isu; ?>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-lg-3 col-md-4 fw-bold">Huraian / Keterangan:</div>
              <div class="col-lg-9 col-md-8">
                <p style="text-align: justify;">
                  <?= nl2br($isu->sit_keterangan); ?>
                </p>
              </div>
            </div>

            <div class="row mb-3">
  <div class="col-lg-3 col-md-4 fw-bold">Status:</div>
  <div class="col-lg-9 col-md-8">
    <?php if ($isu->sit_aktif == 'YA'): ?>
      <span class="badge bg-success">Aktif</span>
    <?php else: ?>
      <span class="badge bg-danger">Tidak Aktif</span>
    <?php endif; ?>
  </div>
</div>

            <div class="row mb-3">
              <div class="col-lg-3 col-md-4 fw-bold">Dicipta Pada:</div>
              <div class="col-lg-9 col-md-8">
                <?= $isu->sit_tarikh_dibina; ?>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-lg-3 col-md-4 fw-bold">Dicipta Oleh:</div>
              <div class="col-lg-9 col-md-8">
                <?= $isu->pengguna_nama; ?>
              </div>
            </div>

            <div class="text-start mt-4">
              <a href="<?php echo site_url('sentimen/urus_tadbir'); ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Senarai Isu
              </a>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

</main>

<?php $this->load->view($footer); ?>
