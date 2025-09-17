<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi', 'Konfigurasi RIMS'); ?></li>
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi/parlimen', 'Parlimen'); ?></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Parlimen</li>
  </ol>
</nav>

<?php 
$this->load->view('negeri/konfigurasi/nav_parlimen');
?>

<div class="p-3 border rounded mb-3">
    <p><strong>Tambah Parlimen</strong></p>
    <?php echo validation_errors(); ?>
    <?php echo form_open('konfigurasi/proses_tambah_parlimen'); ?>
    <div class="mb-3">
        <label for="input_nama" class="form-label">1) Nama Parlimen:</label>
        <input type="text" name="input_nama" id="input_nama" class="form-control form-control-sm" value="<?php echo set_value('input_nama'); ?>">
    </div>
    <input type="hidden" name="input_negeri_bil" value="<?= $negeri->nt_bil ?>">
    <input type="hidden" name="input_negeri_nama" value="<?= $negeri->nt_nama ?>">
    <button type="submit" class="btn btn-sm btn-primary w-100">Tambah</button>
    </form>
</div>