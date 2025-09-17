<?php

if(empty($obp))
{
    die('tiada');
} 

$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/navbar');
$this->load->view('urusetia_na/susunletak/sidebar');
?>


<main id="main" class="main">


    <div class="pagetitle">
        <h1>RIMS@OBP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">RIMS</a></li>
                <li class="breadcrumb-item">RIMS@OBP</li>
                <li class="breadcrumb-item active">Maklumat Lanjut</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <a class="btn btn-info rounded-pill" data-placement="top" href="<?php echo site_url('obp/senarai'); ?>"><i
            class="bi bi-arrow-90deg-left"></i></a>
    <div class="mb-5 mt-5">

        <section class="section">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column">

                            <div class="d-flex justify-content-center mb-4">
                                <?php     
                                            if(empty($obp->og_file))
                                            {
                                                ?>
                                <img src="https://cdn-icons-png.flaticon.com/512/25/25634.png" class="rounded-circle"
                                    alt="example placeholder" style="width: 200px; max-height: 200px;" />
                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                <img src="<?php echo base_url('assets/img/obp/'.$obp->og_file);?>"
                                    class="rounded-circle" style="width: 200px; max-height: 200px;" />
                                <?php
                                            }
                                                    ?>
                            </div>
                            <div class="text-center">
                                <h3><b><?php echo  $obp->obp_nama; ?></b></h3>
                            </div>
                            <h5 class="card-title">Kawasan</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label "><b>Negeri</b></div>
                                <div class="col-lg-9 col-md-8">
                                    <?php echo $obp->nt_nama; ?>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label "><b>Parlimen</b></div>
                                <div class="col-lg-9 col-md-8"><?= $obp->pt_nama; ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label "><b>Daerah</b></div>
                                <div class="col-lg-9 col-md-8"><?= $obp->nama; ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label "><b>Dun</b></div>
                                <div class="col-lg-9 col-md-8"><?= $obp->dun_nama; ?></div>
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
                                <tr>
                                    <th>Kategori Umur</th>
                                    <td><?= $obp->obp_umur ?></td>
                                </tr>
                                <tr>
                                    <th>Jantina</th>
                                    <td><?= $obp->obp_jantina ?></td>
                                </tr>
                                <tr>
                                    <th>Kaum</th>
                                    <td><?= $obp->obp_kaum ?></td>
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