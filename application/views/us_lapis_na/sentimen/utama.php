<?php 
$this->load->view('us_lapis_na/susunletak/atas');
$this->load->view('us_lapis_na/susunletak/sidebar');
$this->load->view('us_lapis_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LPK</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="<?= site_url('sentimen') ?>"><i class="bi bi-house"></i> Laporan Persepsi Terhadap Kerajaan</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <?php
    $this->load->view($nav);
    ?>

    <div class="p-3 border rounded bg-white">
        <h3>Rumusan Kumulatif Laporan Tahun 2025</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Bil</th>
                        <th class="text-center">Negeri</th>
                        <th class="text-center">Positif</th>
                        <th class="text-center">Neutral</th>
                        <th class="text-center">Negatif</th>
                        <th class="text-center">Dominan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; foreach($senaraiNegeri as $negeri):
                        if($negeri->dominan == 'POSITIF'){
                            $color = 'bg-success text-white';
                        }elseif($negeri->dominan == 'NEGATIF'){
                            $color = 'bg-danger text-white';
                        }else{
                            $color = "bg-secondary text-white";
                        } ?>
                    <tr>
                        <td class="text-center"><?= $count++ ?></td>
                        <td><?= $negeri->negeriNama ?></td>
                        <td class="text-center"><?= $negeri->positif ?></td>
                        <td class="text-center"><?= $negeri->neutral ?></td>
                        <td class="text-center"><?= $negeri->negatif ?></td>
                        <td class="text-center <?= $color ?>"><?= $negeri->dominan ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    </section>

</main>


<?php $this->load->view('us_lapis_na/susunletak/bawah'); ?>