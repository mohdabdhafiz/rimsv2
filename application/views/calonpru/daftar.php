
<div class="mt-3 mb-5">
    <h2 class="display-2"><?php echo $title; ?></h2>
    <small class="text-muted">DUN <?php foreach($dun as $d){ $dunBil = $d->dun_bil; echo $d->dun_nama; } ?></small>
  </div>

<?php echo validation_errors(); ?>


<?php echo form_open('ahli/daftar_calon/'.$dun_bil); ?>

    <div class="mb-3 mt-5">
        <label for="ahli_nama" class="form-label">Nama Calon</label>
        <input type="text" name="ahli_nama" class="form-control"/>
    </div>

    <div class="mb-3">
        <label for="ahli_umur" class="form-label">Umur</label>
        <input type="text" name="ahli_umur" id="ahli_umur" class="form-control">
    </div>

    <div class="form-group mb-3">
    <label for="ahli_jantina">Jantina</label>
    <select class="form-control" id="ahli_jantina" name="ahli_jantina">
      <option value="LELAKI">LELAKI</option>
      <option value="PEREMPUAN">PEREMPUAN</option>
    </select>
  </div>

    <div class="mb-3">
        <label for="ahli_pendidikan" class="form-label">Pendidikan</label>
        <input type="text" name="ahli_pendidikan" class="form-control"/>
    </div>

    <?php if(empty($list_data['parti_bil'])){ ?>
    <div class="form-group mb-3">
    <label for="parti">Parti Calon</label>
    <select class="form-control" id="parti" name="pencalonan_parti" aria-describedby="partiHelp">
      <?php foreach($senarai_parti as $p): ?>
      <option value="<?php echo $p->parti_bil; ?>"><?php echo $p->parti_nama; ?> (<?php echo $p->parti_singkatan; ?>)</option>
      <?php endforeach; ?>
    </select>
    <div id="partiHelp" class="form-text">Jika tiada dalam senarai, sila daftarkan parti di sini. <?php echo anchor('parti/daftar', 'Daftar Parti', 'class="text-decoration-none"'); ?></div>
  </div>
  <?php }else{ ?>
    <input type="hidden" name="pencalonan_parti" value="<?php echo $list_data['parti_bil']; ?>">
    <?php } ?>


    <input type="hidden" id="ahli_pengguna" name="ahli_pengguna" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
    <input type="hidden" id="pencalonan_pengguna" name="pencalonan_pengguna" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
    <input type="hidden" id="ahli_foto" name="ahli_foto" value="5">
    <input type="hidden" id="pencalonan_dun" name="pencalonan_dun" value="<?php echo $dunBil; ?>">
    <input type="hidden" id="pencalonan_pilihanraya" name="pencalonan_pilihanraya" value="<?php echo $this->session->userdata('pilihanraya_bil'); ?>">
    
    <div class="mb-3">
        <input type="submit" name="submit" value="Daftar Calon" class="btn btn-primary"/>
    </div>
</form>