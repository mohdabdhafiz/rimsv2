<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi', 'Konfigurasi RIMS'); ?></li>
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi/parlimen', 'Parlimen'); ?></li>
    <li class="breadcrumb-item active" aria-current="page">Padam Parlimen <?= $parlimen->pt_nama ?></li>
  </ol>
</nav>

<?php $this->load->view('negeri/konfigurasi/nav_parlimen'); ?>

<div class="p-3 border rounded mb-3">
    <p><strong>Anda pasti untuk memadam maklumat Parlimen ini?</strong></p>
    <p>
        <strong>Nama Parlimen:</strong><br>
        <?= $parlimen->pt_nama ?>
    </p>
    <p>
        <strong>Negeri:</strong><br>
        <?= $parlimen->pt_negeri ?>
    </p>
    <?php echo form_open('konfigurasi/parlimen_proses_padam'); ?>
        <input type="hidden" name="input_bil" value="<?= $parlimen->pt_bil ?>">
        <button type="submit" class="btn btn-sm btn-danger w-100">Padam</button>
    </form>
</div>