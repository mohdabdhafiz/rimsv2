<div class="container p-5">
    <h1>AKSES MASUK</h1>
<?php echo form_open('pengguna/proses_log'); ?>
  <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="text" id="form2Example1" class="form-control" name="input_pengguna_nama"/>
    <label class="form-label" for="form2Example1">ID</label>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <input type="password" id="form2Example2" class="form-control" name="input_pengguna_password"/>
    <label class="form-label" for="form2Example2">Password</label>
  </div>

  <!-- Submit button -->
  <button type="submit" class="btn btn-primary btn-block mb-4 w-100">Log Masuk</button>

  
</form>
</div>