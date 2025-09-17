<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('harian') ?>">Harian</a></li>
                <li class="breadcrumb-item active">Utama</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Parlimen</h5>
                <a href="<?= site_url('harian/harianParlimen') ?>" class="btn btn-outline-primary">
                        Kemaskini Etnografi
                    </a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-bordered">
                    <thead>
                        <tr>
                            <th>Status Grading</th>
                            <th>Bilangan Parlimen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $jumlah = 0;
                        foreach($rumusanGradingParlimen as $r): ?>
                            <?php if($r->grading == 'PUTIH'){ ?>
                        <tr>
                            <td>PUTIH</td>
                            <td>
                                <?php echo $r->kiraanGrading; ?>
                            </td>
                        </tr>
                        <?php 
                        $jumlah = $jumlah + $r->kiraanGrading;    
                        } ?>
                        <?php endforeach; ?>
                        <?php foreach($rumusanGradingParlimen as $r): ?>
                            <?php if($r->grading == 'KELABU PUTIH'){ ?>
                        <tr>
                            <td>KELABU PUTIH</td>
                            <td><?= $r->kiraanGrading; ?>
                            </td>
                        </tr>
                        <?php $jumlah = $jumlah + $r->kiraanGrading; }
                            
                    endforeach; ?>
                        <?php foreach($rumusanGradingParlimen as $r): ?>
                            <?php if($r->grading == 'KELABU HITAM'){ ?>
                        <tr>
                            <td>KELABU HITAM</td>
                            <td><?= $r->kiraanGrading; ?>
                            </td>
                        </tr>
                        <?php $jumlah = $jumlah + $r->kiraanGrading; } endforeach; ?>
                        <?php foreach($rumusanGradingParlimen as $r): ?>
                            <?php if($r->grading == 'HITAM'){ ?>
                        <tr>
                            <td>HITAM</td>
                            <td><?= $r->kiraanGrading ?>
                            </td>
                        </tr>
                        <?php 
                        $jumlah = $jumlah + $r->kiraanGrading;
                        } endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Jumlah</th>
                            <th><?= $jumlah ?> / <?= count($senaraiParlimen) ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">DUN</h5>
                <a href="<?= site_url('harian/dun') ?>" class="btn btn-outline-primary">
                        Kemaskini Etnografi
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Negeri</th>
                            <th class="text-center" valign="middle">Putih</th>
                            <th class="text-center" valign="middle">Kelabu Putih</th>
                            <th class="text-center" valign="middle">Kelabu Hitam</th>
                            <th class="text-center" valign="middle">Hitam</th>
                            <th class="text-center" valign="middle">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($senaraiNegeri as $negeri): 
                            $jumlah = 0;
                            $rumusanGradingDun = $dataHarianDun->rumusanGrading($negeri->nt_nama);
                            ?>
                        <tr>
                            <td><?= $negeri->nt_nama ?></td>
                            <td width="200px" class="text-center" valign="middle">
                                <?php 
                                foreach($rumusanGradingDun as $rgd){
                                    if($rgd->grading == 'PUTIH'){
                                        $jumlah = $jumlah + $rgd->kiraanGrading;
                                        echo $rgd->kiraanGrading;
                                    }
                                }
                                ?>
                            </td>
                            <td width="200px" class="text-center" valign="middle">
                                <?php 
                                foreach($rumusanGradingDun as $rgd){
                                    if($rgd->grading == 'KELABU PUTIH'){
                                        $jumlah = $jumlah + $rgd->kiraanGrading;
                                        echo $rgd->kiraanGrading;
                                    }
                                }
                                ?>
                            </td>
                            <td width="200px" class="text-center" valign="middle">
                            <?php 
                                foreach($rumusanGradingDun as $rgd){
                                    if($rgd->grading == 'KELABU HITAM'){
                                        $jumlah = $jumlah + $rgd->kiraanGrading;
                                        echo $rgd->kiraanGrading;
                                    }
                                }
                                ?>
                            </td>
                            <td width="200px" class="text-center" valign="middle">
                            <?php 
                                foreach($rumusanGradingDun as $rgd){
                                    if($rgd->grading == 'HITAM'){
                                        $jumlah = $jumlah + $rgd->kiraanGrading;
                                        echo $rgd->kiraanGrading;
                                    }
                                }
                                ?>
                            </td>
                            <td width="200px" class="text-center" valign="middle">
                                <?= $jumlah ?>
                                / <?= count($dataDun->dun_negeri($negeri->nt_bil)) ?>
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


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>