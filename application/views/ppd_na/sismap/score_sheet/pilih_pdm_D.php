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
                <li class="breadcrumb-item active">Senarai Helaian Mata</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="mb-5 mt-5">

        <section class="section">
            <div class="row g-3 mt-3">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Senarai Daerah Mengundi</h5>
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
                                    foreach($senaraiPdm as $sp):
                                    ?>
                                        <tr>
                                            <td><?= $sp->pdt_nama ?></td>
                                            <td style="width: 30%;" class="text-end">
                                                <a type="button" class="btn btn-outline-success"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Isi Helaian Mata" href="<?php echo site_url('scoresheet/isiScore/'.$sp->pdt_bil); ?>">
                                                    <i class="bi bi-vector-pen"></i>
                                                </a>
                                                <span data-bs-toggle="modal" data-bs-target="#editModal<?= $sp->pdt_bil ?>">
                                                <button type="button" class="btn btn-outline-primary"
                                                    data-bs-toggle="tooltip" 
                                                     data-bs-placement="top"
                                                    title="Kemaskini Helaian Mata">
                                                    <i class="bi bi-pen-fill"></i>
                                                </button>
                                    </span>
                                                <a type="button" class="btn btn-outline-secondary"
                                                    href="<?php echo site_url('scoresheet/maklumat/'.$sp->pdt_bil); ?>"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Lihat Helaian Mata"><i class="bi bi-eye-fill"></i></a>
                                                <button type="button" class="btn btn-outline-danger"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Padam Helaian Mata"><i class="bi bi-trash-fill"></i>
                                                </button>
                                                <!-- Basic Modal -->
                                                <div class="modal fade text-start" id="editModal<?= $sp->pdt_bil ?>"
                                                    tabindex="-1" data-bs-backdrop="false">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Kemaskini Maklumat
                                                                    <?= $sp->nama_helaian ?></h5>
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
        </section>
</main>
</div>
</div>

<?php
$this->load->view('ppd_na/susunletak/bawah');
?>