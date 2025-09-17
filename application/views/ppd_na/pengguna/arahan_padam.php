
<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">RIMS@PENGGUNA</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h3 class="text-danger mb-4">Anda pasti untuk memadam maklumat ini?</h3>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th>NO ID</th>
                        <td><?= $pengguna->bil ?></td>
                    </tr>
                    <tr>
                        <th>Nama Penuh</th>
                        <td class="text-primary"><?= $pengguna->nama_penuh ?></td>
                    </tr>
                    <tr>
                        <th>Nombor Kad Pengenalan</th>
                        <td><?= $pengguna->pengguna_ic ?></td>
                    </tr>
                    <tr>
                        <th>Nombor Telefon</th>
                        <td><?= $pengguna->no_tel ?></td>
                    </tr>
                    <tr>
                        <th>e-Mel</th>
                        <td><?= $pengguna->emel ?></td>
                    </tr>
                    <tr>
                        <th>Jawatan</th>
                        <td><?= $pengguna->pekerjaan ?></td>
                    </tr>
                    <tr>
                        <th>Penempatan</th>
                        <td><?= $pengguna->pengguna_tempat_tugas ?></td>
                    </tr>
                </table>
                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        <?php echo form_open('pengguna/proses_padam'); ?>
                            <input type="hidden" name="input_nama_penuh" value="<?= $pengguna->nama_penuh ?>">
                            <input type="hidden" name="input_no_tel" value="<?= $pengguna->no_tel ?>">
                            <input type="hidden" name="input_no_ic" value="<?= $pengguna->pengguna_ic ?>">
                            <input type="hidden" name="input_emel" value="<?= $pengguna->emel ?>">
                            <input type="hidden" name="input_jawatan" value="<?= $pengguna->pekerjaan ?>">
                            <input type="hidden" name="input_peranan_bil" value="<?= $this->session->userdata('peranan_bil') ?>">
                            <input type="hidden" name="input_peranan_nama" value="<?= $this->session->userdata('peranan') ?>">
                            <input type="hidden" name="input_pengguna_status" value="Menunggu Pengesahan Padam">
                            <input type="hidden" name="input_tempat" value="<?= $pengguna->pengguna_tempat_tugas ?>">
                            <input type="hidden" name="input_bil" value="<?= $pengguna->bil ?>">
                            <input type="hidden" name="input_pengguna_waktu" value="<?= date('Y-m-d H:i:s'); ?>">
                            <button type="submit" class="btn btn-danger shadow-sm w-100">Padam</button>
                        </form>
                    </div>
                    <div class="col-12 col-lg-6">
                        <?php echo anchor(base_url(), 'Batal', "class='btn btn-secondary shadow-sm w-100'"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>