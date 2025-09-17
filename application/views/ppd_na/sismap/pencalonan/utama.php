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
            </ol>
        </nav>
    </div><!-- End Page Title -->

        <section class="section">
            
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Pencalonan Parlimen</h1>
                    <div class="table-responsive">
                        <table class="table table-hover datatable">
                            <thead>
                                <tr>
                                    <th>Gambar Parti</th>
                                    <th>Nama Parti</th>
                                    <th>Gambar Calon</th>
                                    <th>Nama Calon</th>
                                    <th>Umur Calon</th>
                                    <th>Taraf Pendidikan Calon</th>
                                    <th>Jantina Calon</th>
                                    <th>Pilihan Raya</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($senaraiCalonParlimen as $calonParlimen): 
                                $ahli = $dataAhli->ahli($calonParlimen->pencalonan_parlimen_ahliBil);
                                $foto = $dataFoto->foto($ahli->ahli_foto); 
                                $parti = $dataParti->ahliParti($calonParlimen->pencalonan_parlimen_partiBil);
                                $fotoParti = $dataFoto->foto($parti->parti_logo);
                                $pilihanraya = $dataPilihanraya->pilihanraya($calonParlimen->pencalonan_parlimen_pilihanrayaBil);
                            ?>
                                <tr>
                                    <td><img src="<?php echo base_url('assets/img/').$fotoParti->foto_nama; ?>" alt="Gambar Parti <?php echo $parti->parti_nama; ?>" class="mb-3" style="border-radius:5%; max-width:200px; height:100px; object-fit:cover;"></td>
                                    <td><?php echo $parti->parti_nama; ?> (<?php echo $parti->parti_singkatan; ?>)</td>
                                    <td><img src="<?php echo base_url('assets/img/').$foto->foto_nama; ?>" alt="Gambar <?php echo $calonParlimen->pencalonan_parlimen_ahliNama; ?>" class=" mb-3" style="border-radius:50%; max-width:300px; height:200px; object-fit:cover;"></td>
                                    <td><?php echo strtoupper($calonParlimen->pencalonan_parlimen_ahliNama); ?></td>
                                    <td><?php echo $ahli->ahli_umur; ?></td>
                                    <td><?php echo $ahli->ahli_pendidikan; ?></td>
                                    <td><?php echo $ahli->ahli_jantina; ?></td>
                                    <td>
                                        <?php echo $pilihanraya->pilihanraya_nama; ?> - <?php echo $calonParlimen->pencalonan_parlimen_parlimenNama; ?> 
                                    </td>
                                    <td><?php echo anchor('ahli/id/'.$calonParlimen->pencalonan_parlimen_ahliBil, 'Maklumat Lanjut', "class='btn btn-primary w-100'"); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Pencalonan DUN</h1>
                    <div class="table-responsive">
                        <table class="table table-hover datatable">
                            <thead>
                                <tr>
                                    <th>Gambar Parti</th>
                                    <th>Nama Parti</th>
                                    <th>Gambar Calon</th>
                                    <th>Nama Calon</th>
                                    <th>Umur Calon</th>
                                    <th>Taraf Pendidikan Calon</th>
                                    <th>Jantina Calon</th>
                                    <th>Pilihan Raya</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($senaraiCalonDun as $calonDUN): 
                                $fotoParti = $dataFoto->foto($calonDUN->parti_logo);
                            ?>
                                <tr>
                                    <td><img src="<?php echo base_url('assets/img/').$fotoParti->foto_nama; ?>" alt="Gambar Parti <?php echo $calonDUN->parti_nama; ?>" class="mb-3" style="border-radius:5%; max-width:200px; height:100px; object-fit:cover;"></td>
                                    <td><?php echo $calonDUN->parti_nama; ?></td>
                                    <td><img src="<?php echo base_url('assets/img/').$calonDUN->foto_nama; ?>" alt="Gambar <?php echo $calonDUN->ahli_nama; ?>" class=" mb-3" style="border-radius:50%; max-width:300px; height:200px; object-fit:cover;"></td>
                                    <td><?php echo strtoupper($calonDUN->ahli_nama); ?></td>
                                    <td><?php echo $calonDUN->ahli_umur; ?></td>
                                    <td><?php echo $calonDUN->ahli_pendidikan; ?></td>
                                    <td><?php echo $calonDUN->ahli_jantina; ?></td>
                                    <td><?php echo $calonDUN->pilihanraya_nama; ?> - <?php echo $calonDUN->dun_nama; ?></td>
                                    <td><?php echo anchor('ahli/id/'.$calonDUN->ahli_bil, 'Maklumat Lanjut', "class='btn btn-primary w-100'"); ?></td>
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
$this->load->view('ppd_na/susunletak/bawah');
?>