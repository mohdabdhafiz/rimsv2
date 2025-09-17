<h3>PENGGUNA</h3>
<p>Senarai Pengguna</p>
<div class="row g-3 mb-3">
  <div class="col-12 col-lg-3 col-md-4 col-sm-6">
    <?php echo anchor('pengguna/daftar', 'Pendaftaran Pengguna', "class = 'btn btn-primary w-100 shadow-sm'"); ?>
  </div>
  <div class="col-12 col-lg-3 col-md-4 col-sm-6">
    <a href="<?= site_url('ppn') ?>" class="btn btn-primary w-100 shadow-sm">Utama PPN</a>
  </div>
</div>
<div class="row g-3 mb-3">
  <?php foreach($senarai_pengguna as $pengguna): ?>
  <div class="col col-lg-4 col-md-6 col-sm-12 d-flex align-items-stretch">
    <div class="p-3 border rounded">
      <h3><?php echo $pengguna->nama_penuh; ?></h3>
      <p>
        <?php echo $pengguna->pengguna_ic; ?> <br>
        <?php echo $pengguna->no_tel; ?> <br>
        <?php echo $pengguna->emel; ?> <br>
        <?php echo $pengguna->pekerjaan; ?> <br>
        <?php echo $pengguna->pengguna_peranan_nama; ?>
      </p>
      <div class="mt-auto row g-3">
        <div class="col-12">
          <?php echo anchor('pengguna/bil/'.$pengguna->bil, 'Maklumat Lanjut', "class='btn btn-info w-100'"); ?>
        </div>
        <div class="col-12">
        <?php echo anchor('pengguna/kemaskini/'.$pengguna->bil, 'Kemaskini Maklumat Pengguna', "class = 'btn btn-primary w-100'"); ?>
        </div>
        <div class="col-12">
        <?php echo form_open('pengguna/buang'); ?>
        <input type="hidden" name="inputPenggunaBil" value="<?php echo $pengguna->bil; ?>">
        <button type="submit" class="btn btn-danger w-100">Padam Maklumat Pengguna</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<p><?php echo $links; ?></p>