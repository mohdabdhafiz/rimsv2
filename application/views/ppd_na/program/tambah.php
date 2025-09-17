<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
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
    <h5 class="card-title">Tambah Laporan Program Baharu</h5>
<?php echo validation_errors(); ?>
<?php echo form_open('program/prosesTambahPost');
    $bilanganSoalan = 1;
?>

<div class="form-floating mb-3">
  <select name="inputPelapor" id="inputPelapor" class="form-control" autofocus required>
    <?php foreach($senaraiPelapor as $pelapor): ?>
    <option value="<?= $pelapor->bil ?>" <?php if(set_value('inputPelapor') == $pelapor->bil){ echo "selected"; } ?>><?= strtoupper($pelapor->nama_penuh) ?></option>
    <?php endforeach; ?>
  </select>
  <label for="inputPelapor" class="form-label">Nama Pegawai Pelapor: <span style="color:red;">*</span></label>
</div>

<?php if(!empty($senaraiNaratif)): ?>
<div class="form-floating mb-3">
  <div class="border p-3 rounded">
    <div class="small text-muted">Senarai Naratif: <span style="color:red;">*</span></div>
    <?php foreach($senaraiNaratif as $naratif): ?>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="inputNaratif[]" value="<?= strtoupper($naratif->senarai_kandungan_kandungan) ?>" id="checkNaratif<?= strtoupper($naratif->senarai_kandungan_bil) ?>">
      <label class="form-check-label" for="checkNaratif<?= strtoupper($naratif->senarai_kandungan_bil) ?>">
        <?= strtoupper($naratif->senarai_kandungan_kandungan) ?>
      </label>
    </div>
    <?php endforeach; ?>
    <div class="small text-muted">
      <em>** Pastikan tuan-tuan dan puan-puan merancang program mengikut naratif-naratif yang telah diselia oleh urus setia. Jika terdapat kandungan program yang berbeza sila nyatakan di Bahagian B dalam pelaporan.</em>
    </div>
  </div>
</div>
<?php endif; ?>

<div class="form-control mb-3">
  <div class="small text-muted">Program: <span style="color:red;">*</span></div>
  <?php foreach($senaraiJenis as $program): ?>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="inputJenisProgram" id="inputJenisProgram<?= $program->jt_bil ?>" value="<?= $program->jt_bil ?>" <?php if(set_value('inputJenisProgram') == $program->jt_bil){ echo "checked"; } ?> required>
    <label class="form-check-label" for="inputJenisProgram<?= $program->jt_bil ?>">
      <?= strtoupper($program->jt_nama) ?>
    </label>
  </div>
  <?php endforeach; ?>
</div>

<?php if(!empty($senaraiNegeri)): ?>
    <div class="form-floating mb-3">
        <select name="inputNegeri" id="inputNegeri" class="form-control" required>
            <?php foreach($senaraiNegeri as $negeri): ?>
                <option value="<?= $negeri->nt_bil ?>" <?php if($negeri->nt_bil == set_value('inputNegeri')){ echo 'selected'; } ?>><?= strtoupper($negeri->nt_nama) ?></option>
            <?php endforeach; ?>
        </select>
        <label for="inputNegeri" class="form-label">Pilih Negeri: <span style="color:red;">*</span></label>
    </div>
    <?php endif; ?>

    <?php if(!empty($senaraiDaerah)): ?>
    <div class="form-floating mb-3">
        <select name="inputDaerah" id="inputDaerah" class="form-control" required>
          <option value="">Sila pilih..</option>
            <?php foreach($senaraiDaerah as $daerah): 
                $negeriBil = $daerah->negeri_bil; ?>
                <option value="<?= $daerah->bil ?>" <?php if($daerah->bil == set_value('inputDaerah')){ echo 'selected'; } ?>><?= strtoupper($daerah->nama) ?></option>
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
                <option value="<?= $parlimen->pt_bil ?>" <?php if($parlimen->pt_bil == set_value('inputParlimen')){ echo 'selected'; } ?> ><?= strtoupper($parlimen->pt_nama) ?></option>
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
                    <option value="<?= $dun->dun_bil ?>" <?php if($dun->dun_bil == set_value('inputDun')){ echo 'selected'; } ?>><?= strtoupper($dun->dun_nama) ?></option>
                <?php endforeach; ?>
            </select>
            <label for="inputDun" class="form-label">Pilih DUN:</label>
        </div>
    <?php endif; ?>

    <?php if(empty($senaraiDun)): ?>
      <input type="hidden" name="inputDun" value="">
    <?php endif; ?>
  
  <div class="form-floating mb-3">
    <input type="datetime-local" class="form-control" id="inputMasa" name = "inputMasa" value = "<?php echo set_value('inputMasa'); ?>">
    <label for="inputMasa" class="form-label">Tarikh dan Masa Program: <span style="color:red;">*</span></label>
  </div>

  <div class="form-floating mb-3">
    <input type="text" name="inputPerasmi" id="inputPerasmi" placeholder="Perasmi:" class="form-control">
    <label for="inputPerasmi" class="form-label">Perasmi:</label>
  </div>

  <div class="form-floating mb-3">
    <input type="text" name="inputKhalayak" id="inputKhalayak" class="form-control" placeholder='Jumlah Khalayak'>
    <label for="inputKhalayak" class="form-label">Jumlah Khalayak:</label>
  </div>

  <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
  <input type="hidden" name="inputPerananBil" value="<?= $pengguna->pengguna_peranan_bil ?>">
<p class="small text-muted mb-3">Sila rujuk pada senarai draf program selepas selesai bahagian ini.</p>
<div class="text-center">
<button type="submit" class="btn btn-outline-primary shadow-sm">Simpan</button>
</div>
</form>
</div>
</div>

</section>


</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>