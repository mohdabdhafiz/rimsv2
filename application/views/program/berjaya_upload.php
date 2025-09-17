<div class="container">
  <div class="p-3 border rounded mb-3">
    <div class="mb-3">
      <h4>Gambar berjaya dimuatnaik.</h4>
    </div>
    <div class="row g-3 mb-3">
      <div class="col-12 col-lg-6 col-md-6 col-sm-12">
        <?php echo anchor('program', 'Laman Utama Program', "class='btn btn-success w-100'"); ?>
      </div>
      <div class="col-12 col-lg-6 col-md-6 col-sm-12">
        <?php echo anchor('program/bil/'.$program->pt_bil, $program->pt_nama, "class='btn btn-primary w-100'"); ?>
      </div>
    </div>
    <?php echo form_open_multipart('program/tambah_gambar/');?>
    <div class="row g-3">
    <div class="col">
        <input type='file' name='userfile' size="20" class = "form-control">
    </div>
    <div class="col">
      <input type="hidden" name="inputBilProgram" value="<?php echo $program->pt_bil; ?>">
      <input type='submit' value='Upload' name='upload' class = "btn btn-primary"/>
    </div>
    </div>

      </form>
  </div>
</div>
