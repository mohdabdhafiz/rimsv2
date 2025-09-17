<?php 
$dun = $data_dun->dun_bil($calon->jdt_dun_bil);
?>
<div class="container-fluid">
    <div class="p-3 border rounded mb-3">
    <h3>JANGKAAN CALON DUN <?php echo strtoupper($dun->dun_nama); ?> : <?php echo strtoupper($calon->jdt_nama_penuh); ?></h3>
    <div class="row g-3 mt-3">
            <div class="col-12 col-lg-4">
                <?php echo anchor('dun/tambah_jangkaan_calon', 'Tambah Jangkaan Calon DUN', "class='btn btn-primary w-100'"); ?>
            </div>
            <div class="col-12 col-lg-4">
                <?php echo anchor('dun/senarai_negeri', 'Senarai Calon Mengikut DUN', "class='btn btn-secondary w-100'"); ?>
            </div>
            <div class="col-12 col-lg-4">
                <?php echo anchor('dun/senarai_jangkaan_calon/'.$dun->dun_bil, 'Senarai Jangkaan Calon DUN'.$dun->dun_nama, "class='btn btn-info w-100'"); ?>
            </div>
        </div>
    </div>
    <div class="text-center">
        <?php $nama_foto = $data_foto->foto($calon->jdt_foto_bil); ?>
        <img src="<?php echo base_url('assets/img/').$nama_foto->foto_nama; ?>" class="img-fluid" style="object-fit: cover;width: 400px;height: 400px; border-radius: 100%;"/>
            <div class="p-3">
                <?php echo form_open_multipart('foto/tukar_gambar_jdt');?>

                <input type="file" name="input_userfile" size="20" class="form-control-file" />

                <br /><br />
                <input type="hidden" name="input_foto_deskripsi" value="Gambar bagi <?php echo $calon->jdt_nama_penuh; ?>">
                <input type="hidden" name="input_pengguna_bil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                <input type="hidden" name="input_jdt_bil" value="<?php echo $calon->jdt_bil; ?>">

                <input type="submit" value="Tukar Gambar" class="btn btn-primary w-100"/>

                </form>
            </div>
    </div>
</div>