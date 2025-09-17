<?php
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/navbar');
$this->load->view('ppd_na/susunletak/sidebar');
?>


<main id="main" class="main">


    <div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">RIMS</a></li>
                <li class="breadcrumb-item active">RIMS@SISMAP</li>
                <li class="breadcrumb-item active">Tambah Helaian Mata</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="mb-5 mt-5">

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Helaian Mata</h5>
                            <?php echo validation_errors(); ?>
                            <?= form_open('scoresheet/proses_tambah_hm') ?>
                            <div class="mb-3 mt-3">

                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select name="inputPr" id="inputPr" class="form-control" required>
                                            <option value="">Sila pilih Pilihan Raya</option>
                                            <?php foreach($senaraiPilihanraya as $pr): ?>
                                            <option value="<?= $pr->pilihanraya_bil ?>"><?= $pr->pilihanraya_nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="inputPr">Senarai Pilihan Raya</label>
                                    </div>
                                </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="inputNamaHelaian" name="inputNamaHelaian"
                                                    placeholder="Nama Helaian Mata" required>
                                                <label for="inputNamaHelaian">Nama Helaian Mata</label>
                                            </div>
                                            <span class="small text-muted">Contoh: Helaian Mata (19.11.2022)</span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <input type="hidden" name="inputPdm" value="<?= $this->session->userdata('peranan_bil')?>">
                                                <input type="hidden" name="inputPeranan" value="<?= $this->session->userdata('peranan_bil')?>">
                                                <input type="hidden" name="inputPengguna" value="<?= $this->session->userdata('pengguna_bil')?>">
                                                <button type="submit" class="btn btn-outline-success">Tambah
                                                    Helaian Mata</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

</main>
</div>
</div>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>