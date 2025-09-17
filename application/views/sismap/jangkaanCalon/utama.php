<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">UTAMA</a></li>
                <li class="breadcrumb-item active">JANGKAAN CALON BERTANDING</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        
        <?php $this->load->view('us_sismap_na/sismap/jangkaan_calon/nav'); ?>

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Senarai Jangkaan Calon / Calon Yang Disebut-sebut</h1>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NEGERI</th>
                                <th class="text-center">CALON PARLIMEN</th>
                                <th class="text-center">CALON DUN</th>
                            </tr>
                        </thead>
                        <?php $jumlahParlimen = 0; 
                        $jumlahDun = 0;
                        foreach($senaraiNegeriCalon as $calonNegeri): 
                            $jumlahParlimen = $jumlahParlimen + $calonNegeri->calonBilanganParlimen; 
                            $jumlahDun = $jumlahDun + $calonNegeri->calonBilanganDun; 
                            ?>
                            <tbody>
                                <tr>
                                    <td><?= $calonNegeri->negeriNama ?></td>
                                    <td class="text-center"><?= $calonNegeri->calonBilanganParlimen ?></td>
                                    <td class="text-center"><?= $calonNegeri->calonBilanganDun ?></td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                        <tfoot>
                            <tr>
                                <th>JUMLAH</th>
                                <th class="text-center"><?= $jumlahParlimen ?></th>
                                <th class="text-center"><?= $jumlahDun ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </section>


    </main>


<?php $this->load->view($footer); ?>
