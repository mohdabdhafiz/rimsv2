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
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">RIMS</a></li>
                <li class="breadcrumb-item active">RIMS@SISMAP</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

        <section class="section">

            <?php $this->load->view('us_sismap_na/dpi/nav'); ?>
            
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Bilangan Kaum Mengikut Negeri</h1>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Negeri</th>
                                    <th>Melayu</th>
                                    <th>Cina</th>
                                    <th>India</th>
                                    <th>Lain-Lain</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($senaraiNegeri as $negeri): ?>
                                <tr>
                                    <td><a href="<?= site_url('dpi/senaraiKaumNegeri/'.$negeri->nt_bil) ?>"><?= $negeri->nt_nama ?></a></td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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