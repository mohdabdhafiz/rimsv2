<div class="container-fluid mb-3">
<div class="p-3 border rounded mb-3">
  <h3>PARTI</h3>
  <div class="row g-3 mt-3">
    <div class="col-12 col-lg-4 col-md-4 col-sm-12">
      <?php echo anchor('parti', 'Parti', "class='btn btn-primary w-100'"); ?>
    </div>
    <div class="col-12 col-lg-4 col-md-4 col-sm-12">
      <?php echo anchor('parti/daftar', 'Daftar Parti Baharu', "class='btn btn-secondary w-100'"); ?>
    </div>
    <div class="col-12 col-lg-4 col-md-4 col-sm-12">
      <?php echo anchor('parti/pilihan_parti', 'Konfigurasi Pilihan Parti', "class='btn btn-info w-100'"); ?>
    </div>
  </div>
</div>

<div class="p-3 border rounded mb-3">
    <h2>SENARAI PILIHAN PARTI UNTUK KIRAAN SISMAP</h2>
    <?php if(count($senarai_bukan_parti_pilihan) > 0) { ?>
    <div class="mb-3">
        <h3>TAMBAH PARTI</h3>
        <?php echo form_open('parti/tambah_parti_pilihan'); ?>
        <div class="mb-3">
            <label for="input_parti_bil" class="form-label">1) Pilih Parti:</label>
            <div class="row g-1">
            <?php foreach($senarai_bukan_parti_pilihan as $parti_lain): ?>
                <div class="col-12 col-lg-3 col-md-3">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" name="input_parti_bil[]" value="<?php echo $parti_lain->parti_bil; ?>" id="input_parti_bil[]">
            <label class="form-check-label" for="input_parti_bil[]">
            <?php echo $parti_lain->parti_singkatan; ?> - <?php echo $parti_lain->parti_nama; ?>
            </label>
            </div>
            </div>
            <?php endforeach; ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Tambah Parti</button>
        </form>
    </div>
    <?php } ?>
</div>

<?php if(count($senarai_parti_pilihan) > 0) { ?>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>BIL</th>
                <th>NAMA PARTI</th>
                <th>OPERASI</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $count = 1;
            foreach($senarai_parti_pilihan as $parti): ?>
            <tr>
                <td><?= $count++ ?></td>
                <td><?= $parti->parti_singkatan ?> - <?= $parti->parti_nama ?></td>
                <td>
                    <?php echo form_open('parti/buang_parti_pilihan'); ?>
                    <input type="hidden" name="input_parti_pilihan" value="<?= $parti->ppt_bil ?>">
                    <button class="btn btn-danger w-100">BUANG</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php } ?>

</div>