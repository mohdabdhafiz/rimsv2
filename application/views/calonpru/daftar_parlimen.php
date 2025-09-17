<?php 
$namaPilihanraya = $this->session->userdata('pilihanraya_nama');
$bilPilihanraya = $this->session->userdata('pilihanraya_bil');
$namaNegeri = $this->session->userdata('negeri_nama');
$bilNegeri = $this->session->userdata('negeri_bil');
$namaPengguna = $this->session->userdata('pengguna_nama');
$bilPengguna = $this->session->userdata('pengguna_bil');
foreach($senaraiParlimen as $parlimen){
  $namaParlimen = $parlimen->pt_nama;
  $bilParlimen = $parlimen->pt_bil;
}
foreach($senaraiParti as $parti){
  $namaParti = $parti->parti_nama;
  $bilParti = $parti->parti_bil;
}
$stored = array(
    'parti_nama' => $namaParti,
    'parti_bil' => $bilParti
);
$this->session->set_userdata($stored);
?>
<div class="container-fluid">
<div class="mt-3 mb-3 p-3 border rounded shadow">
    <h2>Daftar Pencalonan Parlimen</h2>
    <small class="text-muted">Parlimen <?php echo $namaParlimen; ?></small>
  </div>

<div class="p-3 border shadow rounded mb-3">
<?php echo validation_errors(); ?>


<?php echo form_open('pencalonan/proses_parlimen'); ?>

    <div class="mb-3">
        <label for="inputCalonAhliNama" class="form-label">Nama Calon</label>
        <input type="text" name="inputCalonAhliNama" class="form-control" value="<?php echo set_value('inputCalonAhliNama'); ?>"/>
    </div>

    <div class="mb-3">
        <label for="inputCalonAhliUmur" class="form-label">Umur</label>
        <input type="text" name="inputCalonAhliUmur" id="inputCalonAhliUmur" class="form-control" value="<?php echo set_value('inputCalonAhliUmur'); ?>"/>
    </div>

    <div class="form-group mb-3">
    <label for="inputCalonAhliJantina">Jantina</label>
    <select class="form-control" id="inputCalonAhliJantina" name="inputCalonAhliJantina">
      <option value="LELAKI">Lelaki</option>
      <option value="PEREMPUAN">Perempuan</option>
    </select>
  </div>

    <div class="mb-3">
        <label for="inputCalonAhliPendidikan" class="form-label">Pendidikan</label>
        <input type="text" name="inputCalonAhliPendidikan" class="form-control"/>
    </div>

<fieldset disabled="disabled">
    <div class="mb-3">
        <label for="inputCalonParti" class="form-label">Parti</label>
        <input type="text" value = "<?php echo $namaParti; ?>" class="form-control" />
        
    </div>
    <div class="mb-3">
        <label for="inputCalonParlimen" class="form-label">Parlimen</label>
        <input type="text" value = "<?php echo $namaParlimen; ?>" class="form-control" />
       
    </div>
    <div class="mb-3">
        <label for="inputCalonNegeri" class="form-label">Negeri</label>
        <input type="text" value = "<?php echo $namaNegeri; ?>" class="form-control" />
      </div>
</fieldset>

<input type="hidden" name="inputCalonParlimenNama" value = "<?php echo $namaParlimen; ?>">
        <input type="hidden" name="inputCalonParlimenBil" value="<?php echo $bilParlimen; ?>">
<input type="hidden" name="inputCalonPartiNama" value = "<?php echo $namaParti; ?>">
        <input type="hidden" name="inputCalonPartiBil" value="<?php echo $bilParti; ?>">
    <input type="hidden" id="inputCalonPenggunaBil" name="inputCalonPenggunaBil" value="<?php echo $bilPengguna; ?>">
    <input type="hidden" id="inputCalonPenggunaNama" name="inputCalonPenggunaNama" value="<?php echo $bilPengguna; ?>">
    <input type="hidden" id="inputCalonFotoBil" name="inputCalonFotoBil" value="5">
    <input type="hidden" id="inputCalonPilihanrayaBil" name="inputCalonPilihanrayaBil" value="<?php echo $bilPilihanraya; ?>">
    
    <div class="mb-3">
      <div class="row g-3">
        <div class="col col-lg-6 d-flex align-item-stretch">
          <input type="submit" name="submit" value="Daftar Calon" class="btn btn-primary w-100"/>
        </div>
        <div class="col col-lg-3 d-flex align-item-stretch">
          <button type="reset" class="btn btn-secondary w-100">Set Semula</button>
        </div>
        <div class="col col-lg-3 d-flex align-item-stretch">
          <?php echo anchor('parlimen/papar_parlimen/'.$bilParlimen, 'Kembali ke Laman '.$namaParlimen, "class = 'btn btn-warning w-100'"); ?>
        </div>
      </div> 
    </div>
</form>
</div>
</div>