<?php

$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/navbar');
$this->load->view('urusetia_na/susunletak/sidebar');
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">RIMS</a></li>
                <li class="breadcrumb-item active">RIMS@SISMAP</li>
                <li class="breadcrumb-item active">Senarai Helaian Mata</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="mb-5 mt-5">

        <section class="section">
            <div class="row g-3 mt-3">

                <div class="col-12 col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Senarai Helaian Mata <?= $pr->pilihanraya_singkatan ?></h5>
                                <button type="button" class="btn btn-sm btn-outline-success float-end"
                                    data-bs-toggle="modal" data-bs-target="#addModal<?= $pr->pilihanraya_bil ?>">Tambah
                                    Helaian Mata</button>
                            </div>
                            <!-- Basic Modal -->
                            <div class="modal fade text-start" id="addModal<?= $pr->pilihanraya_bil ?>" tabindex="-1"
                                data-bs-backdrop="false">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Kemaskini Maklumat
                                                <?= $pr->pilihanraya_nama ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?= form_open('scoresheet/proses_tambah_hmd') ?>
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                    <select name="inputPdm" id="inputPdm" class="form-control" required>
                                                        <option value="">Sila pilih DUN</option>
                                                        <?php foreach($senaraiDun as $sd): ?>
                                                        <option value="<?= $sd->dun_bil ?>">
                                                            <?= $sd->dun_nama ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <label for="inputPdm">Senarai Pilihan Raya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="inputNamaHelaian"
                                                            name="inputNamaHelaian" placeholder="Nama Helaian Mata"
                                                            required>
                                                        <label for="inputNamaHelaian">Nama Helaian Mata</label>
                                                    </div>
                                                    <span class="small text-muted">Contoh: Helaian Mata
                                                        (19.11.2022)</span>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-center">
                                                    <div>
                                                        <input type="hidden" name="inputPr"
                                                            value="<?= $pr->pilihanraya_bil ?>">
                                                        <input type="hidden" name="inputPeranan"
                                                            value="<?= $this->session->userdata('peranan_bil')?>">
                                                        <input type="hidden" name="inputPengguna"
                                                            value="<?= $this->session->userdata('pengguna_bil')?>">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-outline-success">Tambah
                                                Helaian Mata</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- End Basic Modal-->
                            <div class="list-group">
                                <?php foreach($senaraiScore as $ss): ?>
                                <a type="button" class="list-group-item list-group-item-action" aria-current="true"
                                    href="<?= site_url('scoresheet/pilihPdmD/'.$ss->pdm) ?>">
                                    <?= $ss->nama_helaian ?>
                                </a>
                                <?php endforeach; ?>
                            </div><!-- End List group with Links and buttons -->
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Statistik <?= $pr->pilihanraya_singkatan ?></h5>
                            <!-- Doughnut Chart -->
                            <canvas id="doughnutChart" style="max-height: 400px;"></canvas>

                            <!-- End Doughnut CHart -->
                        </div>
                    </div>
                </div>
        </section>
</main>
</div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    new Chart(document.querySelector('#doughnutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Pakatan Harapan', 'Barisan Nasional', 'Perikatan Nasional'],
            datasets: [{
                label: 'Statistik Pilihan Raya',
                data: [4, 3, 1],
                backgroundColor: ['#Cb1d1d', '#063970', '#154c79']
            }]
        }
    });
});
</script>
<?php
$this->load->view('urusetia_na/susunletak/bawah');
?>