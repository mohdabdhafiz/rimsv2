<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?= anchor('konfigurasi', 'Konfigurasi RIMS') ?></li>
    <li class="breadcrumb-item"><?= anchor('konfigurasi/daerah', 'Daerah') ?></li>
    <li class="breadcrumb-item active" aria-current="page">Set Akaun PPD</li>
  </ol>
</nav>

<?php $this->load->view('negeri/konfigurasi/nav_daerah'); ?>

<div class="p-3 border rounded mb-3">
    <p><strong>Set Akaun PPD</strong></p>
    <p>
        <strong>Daerah:</strong><br>
        <?= $daerah->nama ?>
    </p>
    <p>
        <strong>Senarai PPD:</strong><br>
        <?php
        $senarai_ppd = $data_daerah->senarai_tugas_ppd($daerah->bil);
        foreach($senarai_ppd as $ppd): 
        ?>
        <?= $ppd->peranan_nama ?><br>
        <?php endforeach; ?>
    </p>
    <p><strong>Operasi Set Akaun PPD untuk Daerah <?= $daerah->nama ?>:</strong></p>
    <?php echo validation_errors(); ?>
    <?php echo form_open('konfigurasi/daerah_proses_set'); ?>
    <div class="mb-3">
        <label for="input_peranan_bil" class="form-label">1) Pilih Akaun PPD:</label>
        <select name="input_peranan_bil" id="input_peranan_bil" class="form-control">
            <option>Sila pilih..</option>
            <?php
            $peranan_nama_tmp = array(); 
            foreach($senarai_peranan as $peranan){
                $peranan_nama_tmp[] = $peranan->peranan_nama;
            }
            array_multisort($peranan_nama_tmp, SORT_NUMERIC, $senarai_peranan);
            foreach($senarai_peranan as $peranan): ?>
            <option value="<?= $peranan->peranan_bil ?>"><?= $peranan->peranan_nama ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <input type="hidden" name="input_daerah_bil" value="<?= $daerah->bil ?>">
    <input type="hidden" name="input_pengguna_bil" value="<?= $this->session->userdata('pengguna_bil') ?>">
    <button type="submit" class="btn btn-primary btn-sm w-100">Tambah</button>
    </form>
</div>