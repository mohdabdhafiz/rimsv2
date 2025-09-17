<div class="p-3 border rounded mb-3">
  <div class="mb-3">
    <h3>TAMBAH JENIS PROGRAM</h3>
  </div>
  <div class="row g-3 mt-3">
    <div class="col-12 col-lg-3 col-md-6 col-sm-12">
			<?php echo anchor('program', 'Laman Utama Program', "class = 'btn btn-outline-info w-100'"); ?>
    </div>
    <div class="col-12 col-lg-3 col-md-6 col-sm-12">
      <?php echo anchor('program/tambah', 'Tambah Program', "class = 'btn btn-outline-primary w-100'"); ?>
    </div>
    <div class="col-12 col-lg-3 col-md-6 col-sm-12">
			<?php echo anchor('program/recap', 'Recap Program', "class = 'btn btn-outline-success w-100'"); ?>
    </div>
    <div class="col-12 col-lg-3 col-md-6 col-sm-12">
			<?php echo anchor('jenis', 'Jenis Program', "class = 'btn btn-outline-dark w-100'"); ?>
    </div>
  </div>
</div>
<div class="p-3 border rounded mb-3">
  <div class="mb-3">
    <h3>Tambah Jenis Program</h3>
  </div>
  <?php echo validation_errors(); ?>
  <?php echo form_open('jenis/proses_tambah'); ?>
  <div class="mb-3">
    <label for="inputJenis" class="form_label">Jenis Program</label>
    <input type="text" name="inputJenis" value="<?php echo set_value('inputJenis'); ?>" class="form-control">
  </div>
  <div class="mb-3">
    <label for="inputPeruntukan" class="form_label">Peruntukan Program (RM)</label>
    <input type="text" name="inputPeruntukan" value="<?php echo set_value('inputPeruntukan'); ?>" class="form-control">
  </div>
  <div class="mb-3">
    <button type="submit" class="btn btn-outline-success w-100">Tambah Jenis Program</button>
  </div>
  </form>
</div>
