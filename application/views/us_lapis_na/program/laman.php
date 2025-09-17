<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Rumusan Program</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">


    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Bilangan Program Mengikut Daerah</h5>
                    <div class="table-responsive">
                    <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th>Daerah</th>
                        <?php 
                        $jumlahColumn = array();
                        foreach($senaraiJenisProgramDaerah as $program): 
                        $jumlahColumn[$program->pt_jenisBil] = 0; ?>
                        <th>
                            <?= $program->jt_nama ?> <br>
                            [RM <?= number_format($program->jt_peruntukan, 2, '.', ',') ?>]
                        </th>
                        <?php endforeach; 
                        $jumlahColumn['bilanganProgram'] = 0; 
                        $jumlahColumn['peruntukan'] = 0; 
                        ?>
                        <th>Jumlah Bilangan Program</th>
                        <th>Jumlah Peruntukan (RM)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $bilDaerah = 1;
                    $jumlahBesarProgram = 0;
                    $jumlahBesarPeruntukan = 0;
                    foreach($senaraiDaerah as $daerah): 
                        $jumlahKecilProgram = 0;
                        $jumlahKecilPeruntukan = 0;
                    ?>
                    <tr>
                        <td><?= $daerah->nama ?></td>
                        <?php foreach($senaraiJenisProgramDaerah as $program): 
                            $bilanganProgram = 0;
                            $peruntukan = 0;
                            $daerahBil = $daerah->bil;
                            $jenisProgramBil = $program->pt_jenisBil;
                            $bilJenisProgram = $dataProgram->bilanganJenisProgramDaerah($daerahBil, $jenisProgramBil);
                            if(!empty($bilJenisProgram)){
                                $bilanganProgram = $bilJenisProgram->kiraanProgram;
                                $satuPeruntukan = $bilJenisProgram->jt_peruntukan;
                                if($satuPeruntukan != 0){
                                    $peruntukan = $bilanganProgram * $satuPeruntukan;
                                }
                            }
                            
                        $jumlahKecilProgram = $jumlahKecilProgram + $bilanganProgram;
                        $jumlahKecilPeruntukan = $jumlahKecilPeruntukan + $peruntukan;
                            $jumlahColumn[$program->pt_jenisBil] = $jumlahColumn[$program->pt_jenisBil] + $bilanganProgram;
                        ?>
                        <td><?= $bilanganProgram ?></td>
                        <?php endforeach; 
                        $jumlahBesarProgram = $jumlahBesarProgram + $jumlahKecilProgram;
                        $jumlahBesarPeruntukan = $jumlahBesarPeruntukan + $jumlahKecilPeruntukan;
                        ?>
                        <td><?= $jumlahKecilProgram ?></td>
                        <td><?= number_format($jumlahKecilPeruntukan, 2, '.', ',') ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Jumlah</th>
                        <?php foreach($senaraiJenisProgramDaerah as $program): ?>
                        <th><?= $jumlahColumn[$program->pt_jenisBil] ?></th>
                        <?php endforeach; ?>
                        <th><?= $jumlahBesarProgram ?></th>
                        <th><?= number_format($jumlahBesarPeruntukan, 2, '.', ',') ?></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Bilangan Program Mengikut Parlimen</h5>
                <div class="table-responsive">
                <table id="programParlimen" class="table table-borderless">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Parlimen</th>
                        <?php 
                        $jumlahColumn = array();
                        foreach($senaraiJenisProgramParlimen as $program): 
                        $jumlahColumn[$program->pt_jenisBil] = 0; ?>
                        <th>
                            <?= $program->jt_nama ?> <br>
                            [RM <?= number_format($program->jt_peruntukan, 2, '.', ',') ?>]
                        </th>
                        <?php endforeach; 
                        $jumlahColumn['bilanganProgram'] = 0; 
                        $jumlahColumn['peruntukan'] = 0; 
                        ?>
                        <th>Jumlah Bilangan Program</th>
                        <th>Jumlah Peruntukan (RM)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $bilParlimen = 1;
                    $jumlahBesarProgram = 0;
                    $jumlahBesarPeruntukan = 0;
                    $tmpNamaParlimen = array();
                    foreach($senaraiParlimen as $parlimen){
                        $tmpNamaParlimen[] = $parlimen->pt_nama;
                    }
                    array_multisort($tmpNamaParlimen, SORT_ASC, $senaraiParlimen);
                    foreach($senaraiParlimen as $parlimen): 
                        $jumlahKecilProgram = 0;
                        $jumlahKecilPeruntukan = 0;
                    ?>
                    <tr>
                        <td><?= $bilParlimen++ ?></td>
                        <td><?= $parlimen->pt_nama ?></td>
                        <?php foreach($senaraiJenisProgramParlimen as $program): 
                            $bilanganProgram = 0;
                            $peruntukan = 0;
                            $parlimenBil = $parlimen->pt_bil;
                            $jenisProgramBil = $program->pt_jenisBil;
                            $bilJenisProgram = $dataProgram->bilanganJenisProgramParlimen($parlimenBil, $jenisProgramBil);
                            if(!empty($bilJenisProgram)){
                                $bilanganProgram = $bilJenisProgram->kiraanProgram;
                                $satuPeruntukan = $bilJenisProgram->jt_peruntukan;
                                if($satuPeruntukan != 0){
                                    $peruntukan = $bilanganProgram * $satuPeruntukan;
                                }
                            }
                            $jumlahKecilProgram = $jumlahKecilProgram + $bilanganProgram;
                            $jumlahKecilPeruntukan = $jumlahKecilPeruntukan + $peruntukan;
                            $jumlahColumn[$program->pt_jenisBil] = $jumlahColumn[$program->pt_jenisBil] + $bilanganProgram;
                        ?>
                        <td><?= $bilanganProgram ?></td>
                        <?php endforeach;
                            $jumlahBesarProgram = $jumlahBesarProgram + $jumlahKecilProgram;
                            $jumlahBesarPeruntukan = $jumlahBesarPeruntukan + $jumlahKecilPeruntukan; ?>
                        <td><?= $jumlahKecilProgram ?></td>
                        <td><?= number_format($jumlahKecilPeruntukan, 2, '.', ',') ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>Jumlah</th>
                        <?php foreach($senaraiJenisProgramParlimen as $program): ?>
                        <th><?= $jumlahColumn[$program->pt_jenisBil] ?></th>
                        <?php endforeach; ?>
                        <th><?= $jumlahBesarProgram ?></th>
                        <th><?= number_format($jumlahBesarPeruntukan, 2, '.', ',') ?></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Bilangan Program Mengikut DUN</h5>
                <div class="table-responsive">
                <table id="programDun" class="table table-borderless">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>DUN</th>
                        <?php 
                        $jumlahColumn = array();
                        foreach($senaraiJenisProgramDun as $program): 
                        $jumlahColumn[$program->pt_jenisBil] = 0; ?>
                        <th>
                            <?= $program->jt_nama ?> <br>
                            [RM <?= number_format($program->jt_peruntukan, 2, '.', ',') ?>]
                        </th>
                        <?php endforeach; 
                        $jumlahColumn['bilanganProgram'] = 0; 
                        $jumlahColumn['peruntukan'] = 0; 
                        ?>
                        <th>Jumlah Bilangan Program</th>
                        <th>Jumlah Peruntukan (RM)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $bilDun = 1;
                    $jumlahBesarProgram = 0;
                    $jumlahBesarPeruntukan = 0;
                    foreach($senaraiDun as $dun): 
                        $jumlahKecilProgram = 0;
                        $jumlahKecilPeruntukan = 0;
                    ?>
                    <tr>
                        <td><?= $bilDun++ ?></td>
                        <td><?= $dun->dun_nama ?></td>
                        <?php foreach($senaraiJenisProgramDun as $program): 
                            $bilanganProgram = 0;
                            $peruntukan = 0;
                            $dunBil = $dun->dun_bil;
                            $jenisProgramBil = $program->pt_jenisBil;
                            $bilJenisProgram = $dataProgram->bilanganJenisProgramDun($dunBil, $jenisProgramBil);
                            if(!empty($bilJenisProgram)){
                                $bilanganProgram = $bilJenisProgram->kiraanProgram;
                                $satuPeruntukan = $bilJenisProgram->jt_peruntukan;
                                if($satuPeruntukan != 0){
                                    $peruntukan = $bilanganProgram * $satuPeruntukan;
                                }
                            }
                            $jumlahKecilProgram = $jumlahKecilProgram + $bilanganProgram;
                            $jumlahKecilPeruntukan = $jumlahKecilPeruntukan + $peruntukan;
                            $jumlahColumn[$program->pt_jenisBil] = $jumlahColumn[$program->pt_jenisBil] + $bilanganProgram;
                        ?>
                        <td><?= $bilanganProgram ?></td>
                        <?php endforeach; 
                            $jumlahBesarProgram = $jumlahBesarProgram + $jumlahKecilProgram;
                            $jumlahBesarPeruntukan = $jumlahBesarPeruntukan + $jumlahKecilPeruntukan;?>
                        <td><?= $jumlahKecilProgram ?></td>
                        <td><?= number_format($jumlahKecilPeruntukan, 2, '.', ',') ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>Jumlah</th>
                        <?php foreach($senaraiJenisProgramDun as $program): ?>
                        <th><?= $jumlahColumn[$program->pt_jenisBil] ?></th>
                        <?php endforeach; ?>
                        <th><?= $jumlahBesarProgram ?></th>
                        <th><?= number_format($jumlahBesarPeruntukan, 2, '.', ',') ?></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
                </div>
            </div>
        </div>


    </div>


    </section>


</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>