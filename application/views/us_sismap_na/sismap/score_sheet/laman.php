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
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="mb-5 mt-5">

        <section class="section">
            <div class="row g-3 mt-3">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Senarai Pilihan Raya</h5>
                            </div>
                            <?php foreach($senaraiPRU as $pr): 
                            if($pr->pilihanraya_jenis == 'PARLIMEN')
                            {

                            ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>PARLIMEN</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= $pr->pilihanraya_nama ?></td>
                                            <td>
                                                <div class="row g-1">
                                                    <div class="col">
                                                        <a type="button" class="btn btn-outline-primary float-end"
                                                            href="<?php echo site_url('scoresheet/senaraiScoreP/'.$pr->pilihanraya_bil); ?>"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Lihat Senarai Helaian Mata"><i
                                                                class="bi bi-clipboard-fill"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php } 
                            else{?>
                            <div class="table-responsive mt-5">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>DUN</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= $pr->pilihanraya_nama ?></td>
                                            <td>
                                                <div class="row g-1">
                                                    <div class="col">
                                                        <a type="button" class="btn btn-outline-primary float-end"
                                                            href="<?php echo site_url('scoresheet/senaraiScoreD/'.$pr->pilihanraya_bil); ?>"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Lihat Senarai Helaian Mata"><i
                                                                class="bi bi-clipboard-fill"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php } 
                        endforeach;?>
                        </div>
                    </div>
                </div>
        </section>
</main>
</div>
</div>

<?php
$this->load->view('us_sismap_na/susunletak/bawah');
?>