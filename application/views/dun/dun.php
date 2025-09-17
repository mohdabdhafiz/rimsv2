<?php foreach($dun as $d): ?>

<div class="row g-3">
    <div class="col">
        <small>Nombor Siri: <?php echo $d->dun_bil; ?></small>
        <h1 class="display-1">DUN <?php echo strtoupper($d->dun_nama); ?></h1>        
    </div>
</div>

<div class="row g-3">
    <div class="col-12">
        <div class="p-3 border bg-info rounded text-white">
    <h2>Maklumat DUN</h2>        
    
    <div class="row">
        <div class="col-lg-3">
            <p><strong>Nama DUN</strong></p>
        </div>
        <div class="col">
            <p><?php echo strtoupper($d->dun_nama); ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <p><strong>Negeri DUN</strong></p>
        </div>
        <div class="col">
            <p><?php echo strtoupper($d->dun_negeri); ?></p>
        </div>
    </div>
    </div></div>

    <div class="col-12 col-lg-12">
        <div class="p-3 border bg-light rounded">
        <h2>Daftar Calon</h2>
        <?php echo form_open('ahli/daftar_calon/'.$d->dun_bil); ?>

        <div class="mb-3">
            <label for="pencalonan_pilihanraya" class="form-label">1) Pilih Pilihan Raya :</label>
            <select name="pencalonan_pilihanraya" id="pencalonan_pilihanraya" class="form-control">
                <option value="0">Sila pilih..</option>
                <?php foreach($senarai_pilihanraya as $pru): ?>
                <option value="<?php echo $pru->pilihanraya_bil; ?>"><?php echo $pru->pilihanraya_nama; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
        <label for="ahli_nama" class="form-label">2) Masukkan Nama Calon :</label>
        <input type="text" name="ahli_nama" class="form-control"/>
    </div>

    <div class="mb-3">
        <label for="ahli_umur" class="form-label">3) Masukkan Umur :</label>
        <input type="text" name="ahli_umur" id="ahli_umur" class="form-control">
    </div>

    <div class="form-group mb-3">
    <label for="ahli_jantina" class="form-label">4) Pilih Jantina </label>
    <select class="form-control" id="ahli_jantina" name="ahli_jantina">
        <option value="0">Sila pilih..</option>
      <option value="Lelaki">Lelaki</option>
      <option value="Perempuan">Perempuan</option>
    </select>
  </div>

    <div class="mb-3">
        <label for="ahli_pendidikan" class="form-label">5) Pendidikan</label>
        <input type="text" name="ahli_pendidikan" class="form-control"/>
    </div>

    <div class="form-group mb-3">
    <label for="parti" class="form-label">6) Parti Calon</label>
    <select class="form-control" id="parti" name="pencalonan_parti" aria-describedby="partiHelp">
        <option value="0">Sila pilih..</option>
      <?php foreach($senarai_parti as $p): ?>
      <option value="<?php echo $p->parti_bil; ?>"><?php echo $p->parti_nama; ?> (<?php echo $p->parti_singkatan; ?>)</option>
      <?php endforeach; ?>
    </select>
    <div id="partiHelp" class="form-text">Jika tiada dalam senarai, sila hubungi urus setia.</div>
  </div>

    <input type="hidden" id="ahli_pengguna" name="ahli_pengguna" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
    <input type="hidden" id="pencalonan_pengguna" name="pencalonan_pengguna" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
    <input type="hidden" id="ahli_foto" name="ahli_foto" value="5">
    <input type="hidden" id="pencalonan_dun" name="pencalonan_dun" value="<?php echo $d->dun_bil; ?>">
    <input type="hidden" id="pencalonan_pilihanraya" name="pencalonan_pilihanraya" value="<?php echo $this->session->userdata('pilihanraya_bil'); ?>">
    
    <div class="mb-3">
        <input type="submit" name="submit" value="Daftar Calon" class="btn btn-primary w-100"/>
    </div>
        </form>
    </div></div>

    <?php $count = 0; if(!empty($pencalonan_dun)){foreach($semua_pilihanraya as $pru): foreach($pencalonan_dun as $calon): if($calon->pilihanraya_bil == $pru->pilihanraya_bil){ $count++; } endforeach; if($count!=0){?>
    <div class="col-lg-8">
        <div class="p-3 bg-light border rounded">
        <h2><?php echo strtoupper($pru->pilihanraya_nama); ?></h2>
        <table class="table">
            <tr>
                <th>BIL</th>
                <th>NAMA CALON</th>
                <th>PARTI CALON</th>
            </tr>
            <?php $b=1;foreach($pencalonan_dun as $calon): if($calon->pilihanraya_bil == $pru->pilihanraya_bil){?>
            <tr>
                <td><?php echo $b++; ?></td>
                <td><?php echo anchor('ahli/id/'.$calon->ahli_bil, $calon->ahli_nama); ?></td>
                <td><?php echo anchor('parti/id/'.$calon->parti_bil, $calon->parti_nama." (".$calon->parti_singkatan.")"); ?></td>
            </tr>
            <?php } endforeach; ?>
        </table>
    </div>
    </div>
    <?php } $count=0; endforeach; } ?>

</div>



    <?php endforeach; ?>