
<div class="container-fluid">
<?php 
$parlimen = $data_parlimen->parlimen_bil($calon->wct_parlimen_bil);
?>
    <div class="p-3 border rounded mb-3">
    <h3>JANGKAAN CALON PRU15 PARLIMEN <?php echo strtoupper($parlimen->pt_nama); ?> : <?php echo strtoupper($calon->wct_nama_penuh); ?></h3>
    <div class="row g-3 mt-3">
            <div class="col-12 col-lg-4">
                <?php echo anchor('winnable_candidate/daftar', 'Pendaftaran Jangkaan Calon Parlimen PRU15', "class='btn btn-primary w-100'"); ?>
            </div>
            <div class="col-12 col-lg-4">
                <?php echo anchor('winnable_candidate/senarai_negeri', 'Senarai Calon Mengikut Parlimen', "class='btn btn-secondary w-100'"); ?>
            </div>
            <div class="col-12 col-lg-4">
                <?php echo anchor('winnable_candidate/senarai_calon/'.$parlimen->pt_bil, 'Senarai Jangkaan Calon PRU15 Parlimen '.$parlimen->pt_nama, "class='btn btn-info w-100'"); ?>
            </div>
        </div>
    </div>
    <div class="text-center">
        <?php $nama_foto = $data_foto->foto($calon->wct_foto_bil); ?>
        <img src="<?php echo base_url('assets/img/').$nama_foto->foto_nama; ?>" class="img-fluid" style="object-fit: cover;width: 400px;height: 400px; border-radius: 100%;"/>
            <div class="p-3">
                <?php echo form_open_multipart('foto/tukar_gambar_wct');?>

                <input type="file" name="input_userfile" size="20" class="form-control-file" />

                <br /><br />
                <input type="hidden" name="input_foto_deskripsi" value="Gambar bagi <?php echo $calon->wct_nama_penuh; ?>">
                <input type="hidden" name="input_pengguna_bil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                <input type="hidden" name="input_wct_bil" value="<?php echo $calon->wct_bil; ?>">

                <input type="submit" value="Tukar Gambar" class="btn btn-primary w-100"/>

                </form>
            </div>
    </div>
</div>