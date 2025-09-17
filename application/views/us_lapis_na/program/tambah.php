<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('program') ?>">Laman</a></li>
                <li class="breadcrumb-item active">Tambah Laporan Program</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Tambah Laporan Pelaksanaan Program Baharu</h5>
    <p><strong>Bahagian A: Maklumat Am</strong></p>
<?php echo validation_errors(); ?>
<?php echo form_open('program/proses_bahagian_a');
    $bilanganSoalan = 1;
?>

<div class="form-floating mb-3">
  <select name="inputPelapor" id="inputPelapor" class="form-control" autofocus>
    <?php foreach($senaraiPelapor as $pelapor): ?>
    <option value="<?= $pelapor->bil ?>" <?php if(set_value('inputPelapor') == $pelapor->bil){ echo "selected"; } ?>><?= $pelapor->nama_penuh ?></option>
    <?php endforeach; ?>
  </select>
  <label for="inputPelapor" class="form-label">Nama Pegawai Pelapor: <span style="color:red;">*</span></label>
</div>



<div class="form-control mb-3">
  <label for="inputKategoriProgram" class="form-label">Program: <span style="color:red;">*</span></label>
  <?php foreach($senaraiProgram as $program): ?>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="inputJenisProgram" id="inputJenisProgram<?= $program->jt_bil ?>" value="<?= $program->jt_bil ?>" <?php if(set_value('inputJenisProgram') == $program->jt_bil){ echo "checked"; } ?>>
    <label class="form-check-label" for="inputJenisProgram<?= $program->jt_bil ?>">
      <?= $program->jt_nama ?>
    </label>
  </div>
  <?php endforeach; ?>
</div>

    <?php if(!empty($senaraiDaerah)): ?>
    <div class="form-floating mb-3">
        <select name="inputDaerah" id="inputDaerah" class="form-control">
            <?php foreach($senaraiDaerah as $daerah): 
                $negeriBil = $daerah->negeri_bil; ?>
                <option value="<?= $daerah->bil ?>" <?php if($daerah->bil == set_value('inputDaerah')){ echo 'selected'; } ?>><?= $daerah->nama ?></option>
            <?php endforeach; ?>
        </select>
        <label for="inputDaerah" class="form-label">Pilih Daerah: <span style="color:red;">*</span></label>
    </div>
    <?php endif; ?>

    <?php if(!empty($senaraiParlimen)): ?>
    <div class="form-floating mb-3">
        <select name="inputParlimen" id="inputParlimen" class="form-control">
            <option value="">Sila pilih..</option>
            <?php foreach($senaraiParlimen as $parlimen): ?>
                <option value="<?= $parlimen->pt_bil ?>" <?php if($parlimen->pt_bil == set_value('inputParlimen')){ echo 'selected'; } ?> ><?= $parlimen->pt_nama ?></option>
            <?php endforeach; ?>
        </select>
        <label for="inputParlimen" class="form-label">Pilih Parlimen:</label>
    </div>
    <?php endif; ?>

    <?php if(!empty($senaraiDun)): ?>
        <div class="form-floating mb-3">
            <select name="inputDun" id="inputDun" class="form-control">
                <option value="">Sila pilih..</option>
                <?php foreach($senaraiDun as $dun): ?>
                    <option value="<?= $dun->dun_bil ?>" <?php if($dun->dun_bil == set_value('inputDun')){ echo 'selected'; } ?>><?= $dun->dun_nama ?></option>
                <?php endforeach; ?>
            </select>
            <label for="inputDun" class="form-label">Pilih DUN:</label>
        </div>
    <?php endif; ?>
  
  <div class="form-floating mb-3">
    <input type="datetime-local" class="form-control" id="inputMasa" name = "inputMasa" value = "<?php echo set_value('inputMasa'); ?>">
    <label for="inputMasa" class="form-label">Tarikh dan Masa Program: <span style="color:red;">*</span></label>
  </div>



  <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
  <input type="hidden" name="inputPerananBil" value="<?= $pengguna->pengguna_peranan_bil ?>">
<p class="small text-muted mb-3">Laporan ini disimpan ke dalam draf sebelum dihantar ke Pegawai Pengesah.</p>
<button type="submit" class="btn btn-outline-primary shadow-sm w-100">Simpan</button>
</form>
</div>
</div>

</section>


</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>