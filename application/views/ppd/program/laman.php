<div class="mb-1">
    <?php $this->load->view('ppd/program/nav'); ?>
</div>

<div class="p-3 border mb-1">
    <p><strong>Laman RIMS@PROGRAM</strong></p>

    <?php if(empty($senaraiProgram)): ?>
        <div class="alert alert-warning">
            Tiada laporan didaftarkan.
        </div>
    <?php endif; ?>

    <?php if(!empty($senaraiProgram)): ?>
    <?php $bilanganPetunjuk = 1; ?>

    <?php if(!empty($senaraiJenisProgramDaerah)): ?>
    <p><?= $bilanganPetunjuk++ ?>) Bilangan Program Mengikut Daerah</p>
    <div class="row g-1">
        <div class="col-auto col-lg-12">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-bordered table-striped">
                    <tr>
                        <th>#</th>
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
                    <?php $bilDaerah = 1;
                    $jumlahBesarProgram = 0;
                    $jumlahBesarPeruntukan = 0;
                    foreach($senaraiDaerah as $daerah): 
                        $jumlahKecilProgram = 0;
                        $jumlahKecilPeruntukan = 0;
                    ?>
                    <tr>
                        <td><?= $bilDaerah++ ?></td>
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
                    <tr>
                        <th></th>
                        <th>Jumlah</th>
                        <?php foreach($senaraiJenisProgramDaerah as $program): ?>
                        <th><?= $jumlahColumn[$program->pt_jenisBil] ?></th>
                        <?php endforeach; ?>
                        <th><?= $jumlahBesarProgram ?></th>
                        <th><?= number_format($jumlahBesarPeruntukan, 2, '.', ',') ?></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>


    <?php if(!empty($senaraiJenisProgramParlimen)): ?>
    <p><?= $bilanganPetunjuk++ ?>) Bilangan Program Mengikut Parlimen</p>
    <div class="row g-1">
        <div class="col-auto col-lg-12">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-bordered table-striped">
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
                    <?php $bilParlimen = 1;
                    $jumlahBesarProgram = 0;
                    $jumlahBesarPeruntukan = 0;
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
                    <tr>
                        <th></th>
                        <th>Jumlah</th>
                        <?php foreach($senaraiJenisProgramParlimen as $program): ?>
                        <th><?= $jumlahColumn[$program->pt_jenisBil] ?></th>
                        <?php endforeach; ?>
                        <th><?= $jumlahBesarProgram ?></th>
                        <th><?= number_format($jumlahBesarPeruntukan, 2, '.', ',') ?></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(!empty($senaraiJenisProgramDun)): ?>
    <p><?= $bilanganPetunjuk++ ?>) Bilangan Program Mengikut DUN</p>
    <div class="row g-1">
        <div class="col-auto col-lg-12">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-bordered table-striped">
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
                    <tr>
                        <th></th>
                        <th>Jumlah</th>
                        <?php foreach($senaraiJenisProgramDun as $program): ?>
                        <th><?= $jumlahColumn[$program->pt_jenisBil] ?></th>
                        <?php endforeach; ?>
                        <th><?= $jumlahBesarProgram ?></th>
                        <th><?= number_format($jumlahBesarPeruntukan, 2, '.', ',') ?></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php endif; ?>

</div>