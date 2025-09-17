<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PERSONEL</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item">RIM@PERSONEL</li>
                <li class="breadcrumb-item"><a href="<?= site_url('pengguna') ?>">Senarai Pengguna</a></li>
                <li class="breadcrumb-item active">Kemaskini Maklumat Pengguna <?= strtoupper($pilihanPengguna->nama_penuh) ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
      <div class="card-body">
        <h1 class="card-title">Kemaskini Maklumat Pengguna</h1>
        <?= form_open('pengguna/prosesKemaskiniPilihanPengguna') ?>
        <div class="form-floating mb-3">
          <input type="text" name="inputNamaPenuh" id="inputNamaPenuh" class="form-control" required value="<?= $pilihanPengguna->nama_penuh ?>">
          <label for="inputNamaPenuh" class="form-label">Nama Penuh:</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" name="inputNoIc" id="inputNoIc" required class="form-control" value="<?= $pilihanPengguna->pengguna_ic ?>">
          <label for="inputNoIc" class="form-label">Nombor Kad Pengenalan:</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" name="inputNoTel" id="inputNoTel" required class="form-control" value="<?= $pilihanPengguna->no_tel ?>">
          <label for="inputNoTel" class="form-label">Nombor Telefon:</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" name="inputEmel" id="inputEmel" class="form-control" required value="<?= $pilihanPengguna->emel ?>">
          <label for="inputEmel" class="form-label">e-Mel:</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" name="inputJawatan" id="inputJawatan" value="<?= $pilihanPengguna->pekerjaan ?>" class="form-control">
          <label for="inputJawatan" class="form-label">Jawatan:</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" name="inputPenempatan" id="inputPenempatan" value="<?= $pilihanPengguna->pengguna_tempat_tugas ?>" class="form-control">
          <label for="inputPenempatan" class="form-label">Penempatan:</label>
        </div>
        <input type="hidden" name="inputNoIcSemasa" value="<?= $pilihanPengguna->pengguna_ic ?>">
        <input type="hidden" name="inputPenggunaBil" value="<?= $pilihanPengguna->bil ?>">
        <button type="submit" class="btn btn-outline-primary shadow-sm w-100">Kemaskini</button>
        </form>
      </div>
    </div>

    </section>

</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>