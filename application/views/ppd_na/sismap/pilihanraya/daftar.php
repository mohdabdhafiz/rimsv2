<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Pilihan Raya</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        
    <div class="card">
        <div class="card-body">
    <h3 class="card-title">DAFTAR PILIHAN RAYA</h3>
  <div class="row g-3 mt-3">
    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
      <?php echo anchor('pilihanraya', 'Pilihan Raya', "class='btn btn-primary w-100'"); ?>
    </div>
    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
      <?php echo anchor('pilihanraya/tambah', 'Daftar Pilihan Raya', "class='btn btn-secondary w-100'"); ?>
    </div>
  </div>
</div>
</div>

<div class="card">
    <div class="card-body">
    <p class="card-title"><strong>Pendaftaran Pilihan Raya</strong></p>
        <?php echo validation_errors(); ?>
        <?php echo form_open('pilihanraya/daftar'); ?>
        <div class="row g-3">
          <div class="col-12">
            <label for="pilihanraya_nama" class="form-label">Nama Pilihan Raya</label>
            <input type="text" name="pilihanraya_nama" id="pilihanraya_nama" value = "<?php echo set_value('pilihanraya_nama'); ?>" class="form-control">  
          </div>
          <div class="col-12">
            <label for="pilihanraya_singkatan" class="form-label">Nama Singkatan Pilihan Raya</label>
            <input type="text" name="pilihanraya_singkatan" id="pilihanraya_singkatan" value = "<?php echo set_value('pilihanraya_singkatan_nama'); ?>" class="form-control">
          </div>
          <div class="col-12">
            <label for="pilihanraya_tahun" class="form-label">Tahun Pilihan Raya</label>
            <input type="text" name="pilihanraya_tahun" id="pilihanraya_tahun" value="<?php echo set_value('pilihanraya_tahun'); ?>" class="form-control">
          </div>
          <input type="hidden" name="pilihanraya_status" value="SEMASA">
          <div class="col-12">
            <button type="submit" class="btn btn-primary w-100"><i class='bx bx-import'></i> Daftar</button>
          </div>
          </div>
        </form>
</div>
</div>

    </section>


    </main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>
