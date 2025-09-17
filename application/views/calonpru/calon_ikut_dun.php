
<div class="container-fluid mb-3">
<div class="mb-3 p-3 border rounded">
    <h1 class="mb-3">PENCALONAN DUN</h1>
    <div class="row g-3">
      <div class="col-12 col-lg-6">
      <?php $bil = $pru_latest->pilihanraya_bil;
      echo anchor('data_virtualization/pilihanraya_dun/'.$bil, 'Dashboard Penamaan Calon', "class='btn btn-primary w-100'"); ?>
      </div>
      <div class="col-12 col-lg-6">
        <?php echo anchor('pencalonan/senarai_pencalonan', 'Senarai Pencalonan', "class='btn btn-primary w-100'"); ?>
      </div>
    </div>
</div>

<div class="p-3 border rounded mb-3">
<?php echo validation_errors(); ?>


<?php echo form_open('pencalonan/proses_pencalonan_dun'); ?>

<div class="mb-3">
  <div class="row g-3">
    <label for="input_pilihanraya_bil" class="form-label"><strong>1) Pilih Pilihan Raya :</strong></label>
    <?php  
    $countRadio = 0;
                            foreach($senarai_pilihanraya as $senarai_pru): 
                            $pru = $data_pilihanraya->pilihanraya($senarai_pru->pdt_pilihanraya_bil);
                            $countRadio++; ?>
                    <div class="col-12 col-lg-12 col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="input_pilihanraya_bil" id="input_pilihanraya_bil.<?php echo $pru->pilihanraya_bil; ?>" <?php if($pru->pilihanraya_bil == set_value('input_pilihanraya_bil')){ echo "checked"; } ?> value="<?php echo $pru->pilihanraya_bil; ?>" <?php if($countRadio == 1){ echo 'required'; } ?>>
                            <label class="form-check-label" for="input_pilihanraya_bil.<?php echo $pru->pilihanraya_bil; ?>">
                                <div class="table-responsive">
                                  <table class="table table-hover table-bordered">
                                    <tr class="bg-secondary text-white">
                                      <td colspan=2 class="text-center" valign="middle"><?php echo strtoupper($pru->pilihanraya_nama); ?></td>
                                    </tr>
                                    <tr>
                                      <td class="text-start" valign="middle"><span class="text-muted small">Tarikh Penamaan Calon: </span><br>
                                        <?php echo $pru->pilihanraya_penamaan_calon; ?>
                                      </td>
                                      <td class="text-start" valign="middle">
                                      <span class="text-muted small">Tarikh Lock Status : </span><br>
                                        <?php echo $pru->pilihanraya_lock_status; ?>
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                            </label>
                        </div>
                    </div>
                            <?php endforeach; ?>
  </div>
</div>

            <div class="mb-3">
                <div class="row g-3">
                    <label class="form-label"><strong>2) Pilih DUN :</strong></label> 
                    <input type="text" name="inputCalonDUNBil2" id="inputCalonDUNBil2" value="<?= $data_dun->dun_bil($dun_bil)->dun_nama ?>" class="form-control" disabled>
                    <input type="hidden" name="inputCalonDUNBil" value="<?= $dun_bil ?>">
                </div>
            </div>

    <div class="mb-3">
        <label for="inputCalonAhliNama" class="form-label"><strong>3) Masukkan Nama Penuh Calon:</strong></label>
        <input type="text" name="inputCalonAhliNama" class="form-control" value="<?php echo set_value('inputCalonAhliNama'); ?>"/>
    </div>

    <div class="mb-3">
        <label for="inputCalonAhliUmur" class="form-label"><strong>4) Masukkan Umur Calon:</strong></label>
        <input type="text" name="inputCalonAhliUmur" id="inputCalonAhliUmur" class="form-control" value="<?php echo set_value('inputCalonAhliUmur'); ?>"/>
    </div>

    <div class="form-group mb-3">
    <label for="inputCalonAhliJantina"><strong>5) Pilih Jantina Calon:</strong></label>
    <select class="form-control" id="inputCalonAhliJantina" name="inputCalonAhliJantina">
      <option value="LELAKI">Lelaki</option>
      <option value="PEREMPUAN">Perempuan</option>
    </select>
  </div>

    <div class="mb-3">
        <label for="inputCalonAhliPendidikan" class="form-label"><strong>6) Masukkan Taraf Pendidikan Calon:</strong></label>
        <input type="text" name="inputCalonAhliPendidikan" class="form-control"/>
    </div>

    <div class="mb-3">
                <div class="row g-3">
                    <label class="form-label"><strong>7) Pilih Parti :</strong></label> 
                    <?php foreach($senarai_parti as $parti): ?>
                    <div class="col-12 col-lg-4 col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="input_parti_bil" id="input_parti_bil.<?php echo $parti->parti_bil; ?>" <?php if($parti->parti_bil == set_value('input_parti_bil')){ echo "checked"; } ?> value="<?php echo $parti->parti_bil; ?>">
                            <label class="form-check-label" for="input_parti_bil.<?php echo $parti->parti_bil; ?>">
                                <?php echo $parti->parti_singkatan; ?> - <?php echo $parti->parti_nama; ?>
                            </label>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <small id="input_parti_bil_help" class="form-text text-muted">Sila hubungi urus setia jika parti yang hendak dipilih tiada dalam senarai.</small>
                </div>
            </div>

    <input type="hidden" id="inputCalonPenggunaBil" name="inputCalonPenggunaBil" value="<?php echo $pengguna->bil; ?>">
    <input type="hidden" id="inputCalonPenggunaNama" name="inputCalonPenggunaNama" value="<?php echo $pengguna->nama_penuh; ?>">
    <input type="hidden" id="inputCalonFotoBil" name="inputCalonFotoBil" value="5">
    
    <div class="mb-3">
      <div class="row g-3">
        <div class="col col-lg-6 d-flex align-item-stretch">
          <input type="submit" name="submit" value="Daftar Calon" class="btn btn-primary w-100"/>
        </div>
        <div class="col col-lg-3 d-flex align-item-stretch">
          <button type="reset" class="btn btn-secondary w-100">Set Semula</button>
        </div>
        <div class="col col-lg-3 d-flex align-item-stretch">
          <?php echo anchor('data_virtualization/pilihanraya_dun/'.$bil, 'Dashboard Penamaan Calon', "class='btn btn-primary w-100'"); ?>
        </div>
      </div> 
    </div>
</form>
</div>
</div>