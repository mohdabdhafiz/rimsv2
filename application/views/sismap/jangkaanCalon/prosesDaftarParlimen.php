<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

    <section class="section">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Tambah Jangkaan Calon Parlimen</h1>
            <div class="mb-3">
                <a href="<?= site_url('winnable_candidate/bil/'.$calon->wct_bil) ?>" class="btn btn-outline-info shadow-sm"><i class="bi bi-arrow-left-square"></i> <?= strtoupper($calon->wct_nama_penuh) ?></a>
            </div>
            <?php 
$parlimen = $data_parlimen->parlimen_bil($calon->wct_parlimen_bil);
?>
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

                <input type="submit" value="Tukar Gambar" class="btn btn-outline-primary w-100 shadow-sm"/>

                </form>
            </div>
    </div>
        </div>
    </div>
    </section>


</main>


<?php $this->load->view($footer); ?>