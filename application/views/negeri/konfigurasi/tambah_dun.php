<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi', 'Konfigurasi RIMS'); ?></li>
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi/dun', 'DUN'); ?></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah DUN</li>
  </ol>
</nav>

<?php 
$this->load->view('negeri/konfigurasi/nav_dun');
?>

<div class="p-3 border rounded mb-3">
    <p><strong>Tambah DUN</strong></p>
    <?php echo validation_errors(); ?>
    <?php echo form_open('konfigurasi/proses_tambah_dun'); ?>
    <div class="mb-3">
        <label for="input_nama" class="form-label">1) Nama DUN:</label>
        <input type="text" name="input_nama" id="input_nama" class="form-control form-control-sm" value="<?php echo set_value('input_nama'); ?>">
    </div>
    <input type="hidden" name="input_negeri_nama" value="<?= $negeri->nt_nama ?>">
    <button type="submit" class="btn btn-sm btn-primary w-100">Tambah</button>
    </form>
</div>