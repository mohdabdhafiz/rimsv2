<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi', 'Konfigurasi RIMS'); ?></li>
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi/daerah', 'Daerah'); ?></li>
    <li class="breadcrumb-item active" aria-current="page">Padam Daerah <?= $daerah->nama ?></li>
  </ol>
</nav>

<?php $this->load->view('negeri/konfigurasi/nav_daerah'); ?>

<div class="p-3 border rounded mb-3">
    <p><strong>Anda pasti untuk memadam maklumat daerah ini?</strong></p>
    <p>
        <strong>Nama Daerah:</strong><br>
        <?= $daerah->nama ?>
    </p>
    <p>
        <strong>Negeri:</strong><br>
        <?php
        $nama_negeri = '-';
        $negeri = $data_negeri->negeri($daerah->negeri_bil);
        if(!empty($negeri)){
            $nama_negeri = $negeri->nt_nama;
        }
        echo $nama_negeri;
        ?>
    </p>
    <?php echo form_open('konfigurasi/daerah_proses_padam'); ?>
        <input type="hidden" name="input_bil" value="<?= $daerah->bil ?>">
        <button type="submit" class="btn btn-sm btn-danger w-100">Padam</button>
    </form>
</div>