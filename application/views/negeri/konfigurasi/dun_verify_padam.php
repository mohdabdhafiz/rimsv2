<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi', 'Konfigurasi RIMS'); ?></li>
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi/dun', 'DUN'); ?></li>
    <li class="breadcrumb-item active" aria-current="page">Padam DUN <?= $dun->dun_nama ?></li>
  </ol>
</nav>

<?php $this->load->view('negeri/konfigurasi/nav_dun'); ?>

<div class="p-3 border rounded mb-3">
    <p><strong>Anda pasti untuk memadam maklumat DUN ini?</strong></p>
    <p>
        <strong>Nama DUN:</strong><br>
        <?= $dun->dun_nama ?>
    </p>
    <p>
        <strong>Negeri:</strong><br>
        <?= $dun->dun_negeri ?>
    </p>
    <?php echo form_open('konfigurasi/dun_proses_padam'); ?>
        <input type="hidden" name="input_bil" value="<?= $dun->dun_bil ?>">
        <button type="submit" class="btn btn-sm btn-danger w-100">Padam</button>
    </form>
</div>