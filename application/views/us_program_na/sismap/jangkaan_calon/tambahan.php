<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Pilihan Raya</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        
        <?php $this->load->view('urusetia_na/sismap/jangkaan_calon/nav'); ?>

        <div class="card">
            <div class="card-body">
            <?php echo validation_errors(); ?>
        <div class="row g-3">
            <div class="col-12 col-lg-6">
                <?php echo form_open('winnable_candidate/kuat_lemah'); ?>
                    <div class="mb-3">
                        <label for="input_kekuatan" class="form-label card-title">Kekuatan Calon</label>
                        <textarea name="input_kekuatan" id="input_kekuatan" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="text-center">
                        <input type="hidden" name="input_calon" value="<?php echo $calon->wct_bil; ?>">
                        <input type="hidden" name="input_kuat_lemah" value="Kekuatan Calon">
                        <input type="hidden" name="input_pengguna_bil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                        <input type="hidden" name="input_pengguna_waktu" value="<?php echo date("Y-m-d H:i:s"); ?>">
                        <button type="submit" class="btn btn-outline-primary shadow-sm">Hantar Maklumat Kekuatan Calon</button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-lg-6">
                <?php echo form_open('winnable_candidate/kuat_lemah'); ?>
                    <div class="mb-3">
                        <label for="input_kekuatan" class="form-label card-title">Kelemahan Calon</label>
                        <textarea name="input_kekuatan" id="input_kekuatan" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="text-center">
                        <input type="hidden" name="input_calon" value="<?php echo $calon->wct_bil; ?>">
                        <input type="hidden" name="input_kuat_lemah" value="Kelemahan Calon">
                        <input type="hidden" name="input_pengguna_bil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                        <input type="hidden" name="input_pengguna_waktu" value="<?php echo date("Y-m-d H:i:s"); ?>">
                        <button type="submit" class="btn btn-outline-secondary shadow-sm">Hantar Maklumat Kelemahan Calon</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
        <h3 class="card-title">MAKLUMAT CALON</h3>
        <div class="table-responsive mb-3">
            <table class="table table-sm table-hover">
                <tr>
                    <th>Gambar</th>
                    <td><img src="<?php echo base_url('assets/img/').$data_foto->foto($calon->wct_foto_bil)->foto_nama; ?>" style="object-fit: cover;width: 100px;height: 100px; border-radius: 100%;"/></td>
                </tr>
                <tr>
                    <th>Nama Penuh</th>
                    <td><?php echo $calon->wct_nama_penuh; ?></td>
                </tr>
                <tr>
                    <th>Parti</th>
                    <td><img src="<?php echo base_url('assets/img/').$data_foto->foto($data_parti->parti($calon->wct_parti_bil)->parti_logo)->foto_nama; ?>" style="object-fit: contain;width: 100px;height: 100px;"/>
                        <br /><?php echo $data_parti->parti($calon->wct_parti_bil)->parti_nama; ?></td>
                </tr>
                <tr>
                    <th>Jawatan Dalam Parti</th>
                    <td><?php echo $calon->wct_jawatan_parti; ?></td>
                </tr>
                <tr>
                    <th>Kategori Umur</th>
                    <td><?php echo $calon->wct_kategori_umur; ?></td>
                </tr>
                <tr>
                    <th>Penyandang</th>
                    <td><?php echo $calon->wct_status_calon; ?></td>
                </tr>
                <tr>
                    <th>Parlimen</th>
                    <td><?php echo $data_parlimen->parlimen_bil($calon->wct_parlimen_bil)->pt_nama; ?></td>
                </tr>
                <tr>
                    <th>Negeri</th>
                    <td><?php echo $data_parlimen->parlimen_bil($calon->wct_parlimen_bil)->pt_negeri; ?></td>
                </tr>
            </table>
        </div>
        <h3 class="card-title">KEKUATAN DAN KELEMAHAN CALON</h3>
        <div class="row g-3">
            <div class="col-12 col-lg-6">
                <p><strong>KEKUATAN CALON</strong></p>
                <?php foreach($kekuatan_calon as $kuat): ?>
                <div class="p-3 border rounded mb-3">
                    <p><?php echo $kuat->wctm_deskripsi; ?></p>
                    <p class="small text-muted text-end">Oleh: <?php echo $data_pengguna->pengguna($kuat->wctm_pengguna_bil)->nama_penuh; ?> - <?php echo $kuat->wctm_pengguna_waktu; ?></p>
                    <?php echo form_open('winnable_candidate/padam_kuat_lemah'); ?>
                    <input type="hidden" name="input_wctm_bil" value="<?php echo $kuat->wctm_bil; ?>">
                    <input type="hidden" name="input_calon" value="<?php echo $calon->wct_bil; ?>">
                    <input type="hidden" name="input_pengguna_bil" value="<?php echo $kuat->wctm_pengguna_bil; ?>">
                    <div class="text-center">
                    <button type="submit" class='btn btn-outline-danger shadow-sm'>Padam</button>
                    </div>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="col-12 col-lg-6">
                <p><strong>KELEMAHAN CALON</strong></p>
                <?php foreach($kelemahan_calon as $lemah): ?>
                <div class="p-3 border rounded mb-3">
                    <p><?php echo $lemah->wctm_deskripsi; ?></p>
                    <p class="small text-muted text-end">Oleh: <?php echo $data_pengguna->pengguna($lemah->wctm_pengguna_bil)->nama_penuh; ?> - <?php echo $lemah->wctm_pengguna_waktu; ?></p>
                    <?php echo form_open('winnable_candidate/padam_kuat_lemah'); ?>
                    <input type="hidden" name="input_wctm_bil" value="<?php echo $lemah->wctm_bil; ?>">
                    <input type="hidden" name="input_calon" value="<?php echo $calon->wct_bil; ?>">
                    <input type="hidden" name="input_pengguna_bil" value="<?php echo $lemah->wctm_pengguna_bil; ?>">
                    <div class="text-center">
                    <button type="submit" class='btn btn-outline-danger shadow-sm'>Padam</button>
                    </div>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        </div>
    </div>

    </section>


    </main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>
