<?php
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/navbar');
$this->load->view('ppd_na/susunletak/sidebar');
?>


<main id="main" class="main">


    <div class="pagetitle">
        <h1>RIMS@OBP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="mt-3">
    <a class="btn btn-info rounded-pill" data-placement="top"
                                            href="<?php echo site_url('obp/senarai'); ?>"><i class="bi bi-arrow-90deg-left"></i></a>
    <div class="mt-5">

        <section class="section">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column">

                            <div class="d-flex justify-content-center mb-4">
                                <img src="https://cdn-icons-png.flaticon.com/512/25/25634.png" class="rounded-circle"
                                    alt="example placeholder" style="width: 200px;" />
                            </div>
                            <h5 class="card-title">Kawasan</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label "><b>Negeri</b></div>
                                <div class="col-lg-9 col-md-8"><?= $obp->negeri_id; ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label "><b>Parlimen</b></div>
                                <div class="col-lg-9 col-md-8"><?= $obp->parlimen_id; ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label "><b>Daerah</b></div>
                                <div class="col-lg-9 col-md-8"><?= $obp->daerah_id; ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label "><b>Dun</b></div>
                                <div class="col-lg-9 col-md-8"><?= $obp->dun_id; ?></div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Maklumat OBP</h5>

                            <table class="table table-bordered border-info">
                                <tr>
                                    <th>Nama</th>
                                    <td><?= $obp->obp_nama; ?></td>
                                </tr>
                                <tr>
                                    <th>Jawatan</th>
                                    <td><?= $obp->obp_jawatan ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td><?= $obp->obp_alamat ?></td>
                                </tr>
                                <tr>
                                    <th>No. Telefon</th>
                                    <td><?= $obp->obp_no_tel ?></td>
                                </tr>
                                <tr>
                                    <th>E-mail</th>
                                    <td><?= $obp->obp_email ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
</main>
</div>
</div>


<?php $this->load->view('ppd/susunletak/bawah'); ?>
