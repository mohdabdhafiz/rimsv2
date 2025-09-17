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
                <li class="breadcrumb-item active">Helaian Mata</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="mb-5 mt-5">

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                <?php foreach($senaraiParlimen as $parlimen):?>
                    <div class="card">
                        <div class="card-body">
                            <!-- Table with hoverable rows -->
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered border-secondary">
                                    <thead class="text-center">
                                        <tr>
                                            <div class="mt-3">
                                                <div class="text-center">
                                                    <b><?= strtoupper($score->nama_helaian) ?></b>
                                                </div>
                                                
                                            </div>
                                            <div class="text-center">
                                                <b>BAHAGIAN PILIHAN RAYA NEGERI: <?= strtoupper($parlimen->pt_nama) ?></b>
                                            </div>
                                            <b>JUMLAH PEMILIH: 60,876</b>
                                        </tr>
                                        <tr>
                                            <th rowspan="2">Bil</th>
                                            <th rowspan="2">No. Kod Daerah Mengundi</th>
                                            <th rowspan="2">Nama Pusat Mengundi</th>
                                            <th rowspan="2">Nombor Tempat Mengundi (Saluran)</th>
                                            <th rowspan="2">Jumlah kertas undi yang patut berada di dalam peti undi (A)
                                            </th>
                                            <th colspan="4">Bilangan undian oleh pemilih bagi setiap orang calon yang
                                                bertanding (B)</th>
                                            <th rowspan="2">Bilangan kertas undi yang di tolak (C)</th>
                                            <th rowspan="2">Jumlah kertas undi yang dikeluarkan kepada pengundi tetapi
                                                tidak dimasukkan ke dalam peti undi (D)</th>
                                        </tr>
                                        <tr>
                                            <td>FATHIN AMELINA</td>
                                            <td>SHAHIDAN KASSIM</td>
                                            <td>ROZABIL @ TOK BEN</td>
                                            <th>Jumlah Undian Oleh Pemilih</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    <?php 
                                    $senaraiPdm = $dataPdm->parlimen($parlimen->pt_bil);
                                    $bil = 1; 
                                    foreach($senaraiPdm as $pdm):
                                     ?>    
                                    <tr>
                                            <td><?= $bil++ ?></td>
                                            <td><?= $pdm->ppt_nama ?></td>
                                            <td>Undi Pos</td>
                                            <td></td>
                                            <td>1,045</td>
                                            <td>95</td>
                                            <td>651</td>
                                            <td>166</td>
                                            <td>912</td>
                                            <td>59</td>
                                            <td>74</td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                    <tfoot class="text-center">
                                        <tr>
                                            <th colspan="3">JUMLAH</th>
                                            <th>118</th>
                                            <th>47,605</th>
                                            <th>7,089</th>
                                            <th>31,458</th>
                                            <th>8,242</th>
                                            <th>46,789</th>
                                            <th>727</th>
                                            <th>89</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- End Table with hoverable rows -->
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
</main>
</div>
</div>
<?php
$this->load->view('us_sismap_na/susunletak/bawah');
?>