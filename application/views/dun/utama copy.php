
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'RIMS'); ?> </li>
    <li class="breadcrumb-item active" aria-current="page">DUN</li>
  </ol>
</nav>

<div class="p-3 border rounded">
<h3>SENARAI DUN</h3>
<?php echo anchor('dun/daftar', 'Tambah DUN', 'class=" btn btn-primary w-100 mt-3"'); ?>
</div>


<div class="row g-3 my-3">
<?php foreach($senarai_dun as $d): ?>
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 d-flex align-items-stretch">
              <div class="p-3 border rounded d-flex flex-column w-100">
                <p><?php echo $d->dun_nama; ?></p>
                <p><?php echo $d->dun_negeri; ?></p>
                <div class="p-3 border rounded mb-3">
                <?php
                $senarai_kapar_kadun = $data_kapar_kadun->dun($d->dun_bil);
                if(empty($senarai_kapar_kadun)){ 
                  echo form_open('dun/pilih_kapar'); ?>
                  <div class="mb-3">
                    <label for="input_parlimen" class="form-label">Pilihan Parlimen</label>
                    <select name="input_parlimen" id="input_parlimen" class="form-control">
                      <?php 
                      $senarai_parlimen = $data_parlimen->paparIkutNegeri($d->dun_negeri);
                      foreach($senarai_parlimen as $parlimen): ?>
                      <option value="<?php echo $parlimen->pt_bil; ?>"><?php echo $parlimen->pt_nama; ?>
                      </option>
                      <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="input_dun_bil" value="<?php echo $d->dun_bil; ?>">
                    <input type="hidden" name="input_dun_nama" value="<?php echo $d->dun_nama; ?>">
                    <input type="hidden" name="input_pengguna_bil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                    <input type="hidden" name="input_pengguna_waktu" value="<?php echo date("Y-m-d H:i:s"); ?>">
                  </div>
                  <div class="">
                    <div class="row g-3">
                      <div class="col-6">
                        <button type="submit" class="btn btn-secondary w-100">Pilih Parlimen</button>
                      </div>
                      <div class="col-6">
                        <?php echo anchor('parlimen/daftar', 'Tambah Parlimen', "class='btn btn-info w-100'"); ?>
                      </div>
                    </div>
                  </div>  
                  </form>
                <?php }
                else
                { ?>
                <p>Di bawah Parlimen: <?php echo $senarai_kapar_kadun->kkt_parlimen_nama; ?></p>
                <?php }
                ?>
                </div>
                <?php echo anchor('dun/papar_dun/'.$d->dun_bil, 'Maklumat Penuh DUN '.$d->dun_nama, "class='btn btn-primary w-100'"); ?>
              </div>
          </div>
        <?php endforeach; ?>
</div>