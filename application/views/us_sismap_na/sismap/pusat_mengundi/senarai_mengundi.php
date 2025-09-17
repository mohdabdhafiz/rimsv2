<?php
$this->load->view('us_sismap_na/susunletak/atas');
$this->load->view('us_sismap_na/susunletak/navbar');
$this->load->view('us_sismap_na/susunletak/sidebar');
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">RIMS</a></li>
                <li class="breadcrumb-item active">RIMS@SISMAP</li>
                <li class="breadcrumb-item active">Pusat Mengundi</li>
                <li class="breadcrumb-item active">Senarai Pusat Mengundi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="mt-5">
        <section class="section">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Senarai Pusat Mengundi</h5>

                            <button class="btn btn-outline-success float-end" data-bs-toggle="modal"
                                data-bs-target="#Tambah"><i class="bi bi-plus-lg"></i></button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($senaraiPusat as $sp): ?>
                                    <tr>
                                        <td><?= $sp->nama_pusat ?></td>
                                        <!-- Tambah -->
                                        <div class="modal fade" id="Tambah" tabindex="-1">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Tambah Pusat Mengundi Baru</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?= form_open('pusat_mengundi/proses_tambah') ?>
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="inputPusat"
                                                                name="inputPusat" placeholder="Nama Pusat Mengundi"
                                                                required>
                                                            <label for="inputNama">Nama Pusat Mengundi</label>
                                                            <input type="hidden" class="form-control" id="inputPdmBil"
                                                                name="inputPdmBil" value="<?= $sp->pdm_bil ?>">
                                                            <input type="hidden" name="inputPeranan"
                                                                value="<?= $this->session->userdata('peranan_bil')?>">
                                                            <input type="hidden" name="inputPengguna"
                                                                value="<?= $this->session->userdata('pengguna_bil')?>">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Tambah</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Tambah-->
                                        <td style="width: 30%;" class="text-end">
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#Kemaskini"><i class="bi bi-pen-fill"></i></button>
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#Padam"><i class="bi bi-trash-fill"></i>
                                            </button>
                                            <!-- Kemaskini -->
                                            <div class="modal fade" id="Kemaskini" tabindex="-1">
                                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Kemaskini Pusat Mengundi</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control"
                                                                    id="inputNamaHelaian" name="inputNamaHelaian"
                                                                    value="<?= $sp->nama_pusat ?>">
                                                                <label for="inputNama">Nama Pusat Mengundi</label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                class="btn btn-primary">Kemaskini</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- Kemaskini-->
                                            <!-- Padam -->
                                            <div class="modal fade" id="Padam" tabindex="-1">
                                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Padam Pusat Mengundi</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            Adakah anda pasti untuk padam data:
                                                            <b><?= $sp->nama_pusat ?></b>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit"
                                                                class="btn btn-outline-danger">Ya</button>
                                                            <button type="button" class="btn btn-outline-primary"
                                                                data-bs-dismiss="modal">Tidak</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Padam-->
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</main>
</div>
</div>
<?php
$this->load->view('us_sismap_na/susunletak/bawah')
?>