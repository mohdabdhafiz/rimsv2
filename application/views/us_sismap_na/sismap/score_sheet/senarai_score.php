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
                                <a class="btn btn-sm btn-outline-success float-end"
                                    href="<?php echo site_url('scoresheet/tambahScore/'); ?>">Tambah
                                    Helaian Mata</a>
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
                                        <?php
                                    foreach($senaraiScore as $ss):
                                    ?>
                                        <tr>
                                            <td><?= $ss->nama_helaian ?></td>
                                            <td style="width: 30%;" class="text-end">
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editModal<?= $ss->bil ?>">
                                                    <i class="bi bi-pen-fill"></i>
                                                </button>
                                                <a type="button" class="btn btn-outline-secondary"
                                                    href="<?php echo site_url('scoresheet/maklumat/'.$ss->bil); ?>"><i
                                                        class="bi bi-clipboard-fill"></i></a>
                                                <button type="button" class="btn btn-outline-danger"><i
                                                        class="bi bi-trash-fill"></i>
                                                </button>
                                                <!-- Basic Modal -->
                                                <div class="modal fade text-start" id="editModal<?= $ss->bil ?>" tabindex="-1" data-bs-backdrop="false">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Kemaskini Maklumat <?= $ss->nama_helaian ?></h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?= form_open('scoresheet/proses_kemaskini_hm') ?>
                                                                <div class="form-floating mb-3">
                                                                    <p>TEXT FIELD HERE</p>
                                                                </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End Basic Modal-->
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
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