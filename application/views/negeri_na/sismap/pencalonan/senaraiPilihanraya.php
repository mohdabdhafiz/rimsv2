<?php

$this->load->view('negeri_na/susunletak/atas');
$this->load->view('negeri_na/susunletak/navbar');
$this->load->view('negeri_na/susunletak/sidebar');
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

        <section class="section">
            
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Senarai Pilihan Raya</h1>
                    <div class="table-responsive">
                        <table class="table table-hover datatable">
                            <thead>
                                <tr>
                                    <th>Bil</th>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $count = 1;
                            foreach($senaraiPilihanraya as $pilihanraya):
                            ?>
                                <tr>
                                    <td><?= $count++ ?></td>
                                    <td>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span><?= $pilihanraya->pilihanraya_nama ?></span>
                                            <a href="<?= site_url('pencalonan/pilihanraya/'.$pilihanraya->pilihanraya_bil) ?>" class="btn btn-outline-primary">Lihat</a>
                                        </div>
                                    </td>
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
$this->load->view('negeri_na/susunletak/bawah');
?>