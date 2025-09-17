<?php foreach($pilihanraya as $pr): ?>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><?php echo anchor('pilihanraya', "<i class='bx bxs-city'></i> Pilihan Raya", "class='text-decoration-none'"); ?></li>
          <li class="breadcrumb-item active" aria-current="page"><i class='bx bxs-select-multiple'></i> <?php echo $pr->pilihanraya_nama; ?></li>
        </ol>
      </nav>
    <div class="p-3 border rounded mb-3">
        <h3>
            <?php echo $pr->pilihanraya_nama; ?>
        </h3>
        <div class="row g-3 mt-3">
    <div class="col-12 col-lg-4 col-md-4 col-sm-12">
      <?php echo anchor('pilihanraya', 'Pilihan Raya', "class='btn btn-primary w-100'"); ?>
    </div>
    <div class="col-12 col-lg-4 col-md-4 col-sm-12">
      <?php echo anchor('pilihanraya/tambah', 'Daftar Pilihan Raya', "class='btn btn-secondary w-100'"); ?>
    </div>
        <div class="col-12 col-lg-4 col-md-4 col-sm-12">
          <?php echo anchor('pilihanraya/padam/'.$pr->pilihanraya_bil, 'Padam '.$pr->pilihanraya_nama, array('class' => 'btn btn-outline-danger w-100')); ?>
        </div>
  </div>
    </div>
    <div class="p-3 border rounded mb-3">
        <p><strong>MAKLUMAT PILIHAN RAYA</strong></p>
        <?php echo validation_errors(); ?>
        <?php if(isset($status_berjaya))
        {
            echo "<div class='alert alert-info'><i class='bx bxs-info-circle'></i> ".$status_berjaya."</div>";
        } 
        ?>
        <?php echo form_open('pilihanraya/info/'.$pr->pilihanraya_bil); ?>
        <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>Nama Pilihan Raya</th>
                <td><input type="text" name="pilihanraya_nama" id="pilihanraya_nama" class="form-control" value="<?php echo $pr->pilihanraya_nama; ?>"></td>
            </tr>
            <tr>
                <th>Nama Singkatan Pilihan Raya</th>
                <td><input type="text" name="pilihanraya_singkatan" id="pilihanraya_singkatan" class="form-control" value="<?php echo $pr->pilihanraya_singkatan; ?>"></td>
            </tr>
            <tr>
                <th>Tahun Pilihan Raya</th>
                <td><input type="text" name="pilihanraya_tahun" id="pilihanraya_tahun" value="<?php echo $pr->pilihanraya_tahun; ?>" class="form-control"></td>
            </tr>
            <tr>
                <th>Jenis Pilihan Raya (Parlimen / DUN)</th>
                <td><select name="pilihanraya_jenis" id="pilihanraya_jenis" class="form-control">
                    <?php if($pr->pilihanraya_jenis != "PARLIMEN" && $pr->pilihanraya_jenis != "DUN"){ ?>
                        <option>Sila Pilih</option>
                    <?php } ?>
                    <option value="PARLIMEN" <?php echo ($pr->pilihanraya_jenis == "PARLIMEN") ? 'selected' : ''; ?>>Parlimen</option>
                    <option value="DUN" <?php echo ($pr->pilihanraya_jenis == "DUN") ? 'selected' : ''; ?>>DUN</option>
                </select></td>
            </tr>
            <tr>
                <th>Tarikh Penamaan Calon</th>
                <td><input type="date" name="pilihanraya_penamaan_calon" id="pilihanraya_penamaan_calon" value="<?php echo $pr->pilihanraya_penamaan_calon; ?>" class="form-control"></td>
            </tr>
            <tr>
                <th>Tarikh Lock Status</th>
                <td><input type="date" name="pilihanraya_lock_status" id="pilihanraya_lock_status" value = "<?php echo $pr->pilihanraya_lock_status; ?>" class = "form-control"></td>
            </tr>
            <tr>
                <th>Status Pengemaskinian Maklumat</th>
                <td><select name="pilihanraya_status" id="pilihanraya_status" class="form-control">
                    <?php if($pr->pilihanraya_status != "AKTIF" && $pr->pilihanraya_status != "SELESAI"){ ?>
                        <option>Sila Pilih</option>
                    <?php } ?>
                    <option value="DRAF" <?php echo ($pr->pilihanraya_status == "DRAF") ? 'selected' : ''; ?>>Draf</option>
                    <option value="AKTIF" <?php echo ($pr->pilihanraya_status == "AKTIF") ? 'selected' : ''; ?>>Aktif</option>
                    <option value="SELESAI" <?php echo ($pr->pilihanraya_status == "SELESAI") ? 'selected' : ''; ?>>Selesai</option>
                </select></td>
            </tr>
            <tr>
                <th>Pengguna Yang Mendaftar Pilihan Raya</th>
                <td><?php echo $model_pengguna->nama_pengguna($pr->pilihanraya_pengguna); ?></td>
            </tr>
            <tr>
                <th>Tarikh Data Dimasukkan</th>
                <td><?php $t = date_format(date_create($pr->pilihanraya_waktu), 'd.m.Y'); echo $t; ?></td>
            </tr>
        </table>
        </div>
        <div class="row g-3">
            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
        <button type="submit" class="btn btn-primary w-100">Kemaskini Maklumat Pilihan Raya</button>

            </div>
            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
        <button type="reset" class="btn btn-info text-white w-100">Set Semula</button>

            </div>
        </div>
        </form>
    </div>

    <?php if($pr->pilihanraya_jenis == "PARLIMEN" || $pr->pilihanraya_jenis == "DUN"){ ?>
    <div class="p-3 border rounded mb-3">

    <p><strong>TAMBAH DALAM SENARAI <?php echo ($pr->pilihanraya_jenis == "PARLIMEN") ? "PARLIMEN" : "DUN"; ?> YANG BERTANDING DALAM <?php echo strtoupper($pr->pilihanraya_nama); ?></strong></p>
    <?php 
    $proses = "";
    $kawasan = "";
    $senarai_kawasan = array();
    $senarai_parlimen_dun = array();
    if($pr->pilihanraya_jenis == "PARLIMEN"){
        $proses = "pilihanraya/proses_parlimen";
        $proses_buang = "pilihanraya/buang_parlimen_tanding";
        $kawasan = "Parlimen";
        $senarai_kawasan = $data_parlimen;
        $senarai_parlimen_dun = $data_pr->pr_parlimen($pr->pilihanraya_bil);
    }
    if($pr->pilihanraya_jenis == "DUN"){
        $proses = "pilihanraya/proses_dun";
        $proses_buang = "pilihanraya/buang_dun_tanding";
        $kawasan = "DUN";
        $senarai_kawasan = $data_dun;
        $senarai_parlimen_dun = $data_pr->pr_dun($pr->pilihanraya_bil);
    }
    echo form_open($proses); ?>
    <div class="mb-3">
        <label for="input_senarai_<?= strtolower($kawasan); ?>" class="form-label">1) Pilih <?= $kawasan; ?></label>
        <div class="row g-1">
            <?php foreach($senarai_negeri as $negeri): ?>
                <div class="col-12">
                    <strong><?php echo $negeri->nt_nama; ?></strong>
                </div>
        <?php 
        $kawasan_berkenaan = $senarai_kawasan->negeri($negeri->nt_nama);
        foreach($kawasan_berkenaan as $k): ?>
                        <div class="col-4 col-lg-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="input_<?= strtolower($kawasan); ?>[]" value="<?php echo ($kawasan == "Parlimen") ? $k->pt_bil : $k->dun_bil; ?>" id="input_<?= strtolower($kawasan); ?>[]">
                                <label class="form-check-label" for="input_<?= strtolower($kawasan); ?>[]">
                                <?php echo ($kawasan == "Parlimen") ? $k->pt_nama : $k->dun_nama; ?>
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
            <?php endforeach; ?>
                    </div>
    </div>
    <input type="hidden" name="input_pilihanraya_bil" value="<?= $pr->pilihanraya_bil ?>">
    <input type="hidden" name="input_pengguna_bil" value="<?= $this->session->userdata('pengguna_bil') ?>">
    <input type="hidden" name="input_pengguna_waktu" value="<?= date("Y-m-d H:i:s") ?>">
    <button type="submit" class="btn btn-primary w-100">Tambah <?= $kawasan ?></button>
                    </form>
    </div>

    <?php if(!empty($senarai_parlimen_dun)){ ?>
        <div class="p-3 border rounded">
        <p><strong>SENARAI KAWASAN YANG BERTANDING</strong></p>
        <div class="row g-1 mb-3">
            <?php foreach($senarai_parlimen_dun as $pd): ?>
            <div class="col-6 col-lg-3">
                <div class="p-3 border rounded">
                <div class="row">
                    <div class="col">
                <?= ($kawasan == "Parlimen") ? $pd->pt_nama : $pd->dun_nama ?>
                    </div>
                    <div class="col">
                <?php 
                ($kawasan == "Parlimen") ? $bil = $pd->ppt_bil : $bil = $pd->pdt_bil; 
                ($kawasan == "Parlimen") ? $parlimen_dun = $pd->ppt_parlimen_bil : $parlimen_dun = $pd->pdt_dun_bil; 
                echo form_open($proses_buang); ?>
                <input type="hidden" name="input_bil" value="<?= $bil ?>">
                <input type="hidden" name="input_parlimen_dun_bil" value="<?= $parlimen_dun ?>">
                <input type="hidden" name="input_pilihanraya_bil" value="<?= $pr->pilihanraya_bil ?>">
                <button type="submit" class="btn btn-danger">Buang</button>
                </form>
                    </div>
                </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        </div>
    <?php }
    ?>

    <?php } ?>


<?php endforeach; ?>