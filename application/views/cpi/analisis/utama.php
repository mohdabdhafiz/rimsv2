<?php $this->load->view('cpi/nav'); ?>

<div class="p-3 border rounded mb-3">
    <h2>Analisis LAPIS</h2>
    <p class="text-muted">Keseluruhan</p>
    <?php $this->load->view('cpi/analisis/nav_analisis'); ?>
</div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="hari-tab" data-bs-toggle="tab" data-bs-target="#hari" type="button" role="tab" aria-controls="hari" aria-selected="true">Hari Ini</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="minggu-tab" data-bs-toggle="tab" data-bs-target="#minggu" type="button" role="tab" aria-controls="minggu" aria-selected="false">Minggu Ini</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="bulan-tab" data-bs-toggle="tab" data-bs-target="#bulan" type="button" role="tab" aria-controls="bulan" aria-selected="false">Bulan Ini</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="tahun-tab" data-bs-toggle="tab" data-bs-target="#tahun" type="button" role="tab" aria-controls="tahun" aria-selected="false">Tahun Ini</button>
    </li>
    </ul>
    <div class="tab-content border" id="myTabContent">
    <div class="tab-pane fade show active" id="hari" role="tabpanel" aria-labelledby="hari-tab">
        <div class="p-3 rounded">
            <h2>Hari Ini - <?= date('d.m.Y') ?></h2>
            <div class="mb-3">
                <h3>A. Jumlah Isu Mengikut Kluster</h3>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th valign="middle" class="text-center">Jenis Kluster</th>
                                <th valign="middle" class="text-center">Bilangan Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $jumlah_bilangan_isu_kluster = 0;
                            $senarai_isu_kluster = array();
                            $bilangan = 1; 
                                foreach($senarai_kluster as $sk){
                                    $jumlah_isu = 0;
                                    foreach($senarai_pelapor as $p){
                                    $isu = array();
                                    $kluster = $data_kluster->hari_ini_terima($sk->kit_shortform, $p->bil, date("Y"), date('Y-m-d'));
                                    $bil_isu = 0;
                                    if(!empty($kluster)){
                                        $bil_isu = count($kluster);
                                    }
                                    $jumlah_isu = $jumlah_isu + $bil_isu;
                                    }
                                    $jumlah_bilangan_isu_kluster = $jumlah_bilangan_isu_kluster + $jumlah_isu;
                                    $isu = array(
                                        'nama' => $sk->kit_nama,
                                        'bil_isu' => $jumlah_isu
                                    );
                                    array_push($senarai_isu_kluster, $isu);
                            }
                            array_multisort(array_column($senarai_isu_kluster, 'bil_isu'), SORT_DESC, $senarai_isu_kluster);
                            foreach($senarai_isu_kluster as $sik): ?>
                            <tr>
                                <td valign="middle" class="text-center"><?= $bilangan++ ?></td>
                                <td valign="middle" class="text-center"><?= $sik['nama'] ?></td>
                                <td valign="middle" class="text-center"><?= $sik['bil_isu'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th></th>
                                <th valign="middle" class="text-center">Jumlah</th>
                                <th valign="middle" class="text-center"><?= $jumlah_bilangan_isu_kluster ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="mb-3">
                <h3>B. Jumlah Kluster Isu Mengikut Negeri</h3>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th valign="middle">Negeri</th>
                                <?php foreach($senarai_kluster as $s): ?>
                                <th valign="middle" class="text-center"><?= $s->kit_nama ?></th>
                                <?php endforeach; ?>
                                <th valign="middle" class="text-center">Bilangan Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $bilangan = 1; 
                            foreach($senarai_negeri as $n):
                                $jumlah_isu = 0;
                            ?>
                            <tr>
                                <td valign="middle" class="text-center"><?= $bilangan++ ?></td>
                                <td valign="middle"><?= $n->nt_nama ?></td>
                                <?php 
                                $senarai_pelapor_negeri = $data_pengguna->ikut_negeri($n->nt_nama);
                                foreach($senarai_kluster as $s_k): 
                                    $bilangan_laporan_hari = 0;
                                ?>
                                <td valign="middle" class="text-center">
                                    <?php foreach($senarai_pelapor_negeri as $p){
                                        $kluster = $data_kluster->hari_ini_terima($s_k->kit_shortform, $p['bil'], date("Y"), date('Y-m-d'));
                                        if(!empty($kluster)){
                                            $bilangan_laporan_hari = $bilangan_laporan_hari + count($kluster);
                                            $jumlah_isu = $jumlah_isu + count($kluster);
                                        }
                                    }
                                    echo $bilangan_laporan_hari;
                                     ?>
                                </td>
                                <?php endforeach; ?>
                                <td valign="middle" class="text-center"><?= $jumlah_isu ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


    <div class="tab-pane fade" id="minggu" role="tabpanel" aria-labelledby="minggu-tab">
        <div class="p-3 rounded">
            <h2>Minggu ke <?= date('W') ?></h2>
            <p class="small text-muted">Bermula hari Isnin hingga hari Ahad</p>
            <div class="mb-3">
                <h3>A. Jumlah Isu Mengikut Kluster</h3>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th valign="middle" class="text-center">Jenis Kluster</th>
                                <th valign="middle" class="text-center">Bilangan Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $jumlah_bilangan_isu_kluster = 0;
                            $senarai_isu_kluster = array();
                            $bilangan = 1; 
                                foreach($senarai_kluster as $sk){
                                    $jumlah_isu = 0;
                                    foreach($senarai_pelapor as $p){
                                    $isu = array();
                                    $kluster = $data_kluster->minggu_ini_terima($sk->kit_shortform, $p->bil, date("Y"), date('Y-m-d'));
                                    $bil_isu = 0;
                                    if(!empty($kluster)){
                                        $bil_isu = count($kluster);
                                    }
                                    $jumlah_isu = $jumlah_isu + $bil_isu;
                                    }
                                    $jumlah_bilangan_isu_kluster = $jumlah_bilangan_isu_kluster + $jumlah_isu;
                                    $isu = array(
                                        'nama' => $sk->kit_nama,
                                        'bil_isu' => $jumlah_isu
                                    );
                                    array_push($senarai_isu_kluster, $isu);
                            }
                            array_multisort(array_column($senarai_isu_kluster, 'bil_isu'), SORT_DESC, $senarai_isu_kluster);
                            foreach($senarai_isu_kluster as $sik): ?>
                            <tr>
                                <td valign="middle" class="text-center"><?= $bilangan++ ?></td>
                                <td valign="middle" class="text-center"><?= $sik['nama'] ?></td>
                                <td valign="middle" class="text-center"><?= $sik['bil_isu'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th></th>
                                <th valign="middle" class="text-center">Jumlah</th>
                                <th valign="middle" class="text-center"><?= $jumlah_bilangan_isu_kluster ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="mb-3">
                <h3>B. Jumlah Kluster Isu Mengikut Negeri</h3>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th valign="middle">Negeri</th>
                                <?php foreach($senarai_kluster as $s): ?>
                                <th valign="middle" class="text-center"><?= $s->kit_nama ?></th>
                                <?php endforeach; ?>
                                <th valign="middle" class="text-center">Bilangan Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $bilangan = 1; 
                            foreach($senarai_negeri as $n):
                                $jumlah_isu = 0;
                            ?>
                            <tr>
                                <td valign="middle" class="text-center"><?= $bilangan++ ?></td>
                                <td valign="middle"><?= $n->nt_nama ?></td>
                                <?php 
                                $senarai_pelapor_negeri = $data_pengguna->ikut_negeri($n->nt_nama);
                                foreach($senarai_kluster as $s_k): 
                                    $bilangan_laporan_minggu = 0;
                                ?>
                                <td valign="middle" class="text-center">
                                    <?php foreach($senarai_pelapor_negeri as $p){
                                        $kluster = $data_kluster->minggu_ini_terima($s_k->kit_shortform, $p['bil'], date("Y"), date('Y-m-d'));
                                        if(!empty($kluster)){
                                            $bilangan_laporan_minggu = $bilangan_laporan_minggu + count($kluster);
                                            $jumlah_isu = $jumlah_isu + count($kluster);
                                        }
                                    }
                                    echo $bilangan_laporan_minggu;
                                     ?>
                                </td>
                                <?php endforeach; ?>
                                <td valign="middle" class="text-center"><?= $jumlah_isu ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>



    <div class="tab-pane fade" id="bulan" role="tabpanel" aria-labelledby="bulan-tab">

    <div class="p-3 rounded">
            <h2><?= date('F Y') ?></h2>
            <div class="mb-3">
                <h3>A. Jumlah Isu Mengikut Kluster</h3>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th valign="middle" class="text-center">Jenis Kluster</th>
                                <th valign="middle" class="text-center">Bilangan Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $jumlah_bilangan_isu_kluster = 0;
                            $senarai_isu_kluster = array();
                            $bilangan = 1; 
                                foreach($senarai_kluster as $sk){
                                    $jumlah_isu = 0;
                                    foreach($senarai_pelapor as $p){
                                    $isu = array();
                                    $kluster = $data_kluster->bulan_ini_terima($sk->kit_shortform, $p->bil, date("Y"), date('Y-m-d'));
                                    $bil_isu = 0;
                                    if(!empty($kluster)){
                                        $bil_isu = count($kluster);
                                    }
                                    $jumlah_isu = $jumlah_isu + $bil_isu;
                                    }
                                    $jumlah_bilangan_isu_kluster = $jumlah_bilangan_isu_kluster + $jumlah_isu;
                                    $isu = array(
                                        'nama' => $sk->kit_nama,
                                        'bil_isu' => $jumlah_isu
                                    );
                                    array_push($senarai_isu_kluster, $isu);
                            }
                            array_multisort(array_column($senarai_isu_kluster, 'bil_isu'), SORT_DESC, $senarai_isu_kluster);
                            foreach($senarai_isu_kluster as $sik): ?>
                            <tr>
                                <td valign="middle" class="text-center"><?= $bilangan++ ?></td>
                                <td valign="middle" class="text-center"><?= $sik['nama'] ?></td>
                                <td valign="middle" class="text-center"><?= $sik['bil_isu'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th></th>
                                <th valign="middle" class="text-center">Jumlah</th>
                                <th valign="middle" class="text-center"><?= $jumlah_bilangan_isu_kluster ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="mb-3">
                <h3>B. Jumlah Kluster Isu Mengikut Negeri</h3>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th valign="middle">Negeri</th>
                                <?php foreach($senarai_kluster as $s): ?>
                                <th valign="middle" class="text-center"><?= $s->kit_nama ?></th>
                                <?php endforeach; ?>
                                <th valign="middle" class="text-center">Bilangan Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $bilangan = 1; 
                            foreach($senarai_negeri as $n):
                                $jumlah_isu = 0;
                            ?>
                            <tr>
                                <td valign="middle" class="text-center"><?= $bilangan++ ?></td>
                                <td valign="middle"><?= $n->nt_nama ?></td>
                                <?php 
                                $senarai_pelapor_negeri = $data_pengguna->ikut_negeri($n->nt_nama);
                                foreach($senarai_kluster as $s_k): 
                                    $bilangan_laporan_bulan = 0;
                                ?>
                                <td valign="middle" class="text-center">
                                    <?php foreach($senarai_pelapor_negeri as $p){
                                        $kluster = $data_kluster->bulan_ini_terima($s_k->kit_shortform, $p['bil'], date("Y"), date('Y-m-d'));
                                        if(!empty($kluster)){
                                            $bilangan_laporan_bulan = $bilangan_laporan_bulan + count($kluster);
                                            $jumlah_isu = $jumlah_isu + count($kluster);
                                        }
                                    }
                                    echo $bilangan_laporan_bulan;
                                     ?>
                                </td>
                                <?php endforeach; ?>
                                <td valign="middle" class="text-center"><?= $jumlah_isu ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>



    <div class="tab-pane fade" id="tahun" role="tabpanel" aria-labelledby="tahun-tab">

    <div class="p-3 rounded">
            <h2>Tahun <?= date('Y') ?></h2>
            <div class="mb-3">
                <h3>A. Jumlah Isu Mengikut Kluster</h3>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th valign="middle" class="text-center">Jenis Kluster</th>
                                <th valign="middle" class="text-center">Bilangan Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $jumlah_bilangan_isu_kluster = 0;
                            $senarai_isu_kluster = array();
                            $bilangan = 1; 
                                foreach($senarai_kluster as $sk){
                                    $jumlah_isu = 0;
                                    foreach($senarai_pelapor as $p){
                                    $isu = array();
                                    $kluster = $data_kluster->tahun_ini_terima($sk->kit_shortform, $p->bil, date("Y"));
                                    $bil_isu = 0;
                                    if(!empty($kluster)){
                                        $bil_isu = count($kluster);
                                    }
                                    $jumlah_isu = $jumlah_isu + $bil_isu;
                                    }
                                    $jumlah_bilangan_isu_kluster = $jumlah_bilangan_isu_kluster + $jumlah_isu;
                                    $isu = array(
                                        'nama' => $sk->kit_nama,
                                        'bil_isu' => $jumlah_isu
                                    );
                                    array_push($senarai_isu_kluster, $isu);
                            }
                            array_multisort(array_column($senarai_isu_kluster, 'bil_isu'), SORT_DESC, $senarai_isu_kluster);
                            foreach($senarai_isu_kluster as $sik): ?>
                            <tr>
                                <td valign="middle" class="text-center"><?= $bilangan++ ?></td>
                                <td valign="middle" class="text-center"><?= $sik['nama'] ?></td>
                                <td valign="middle" class="text-center"><?= $sik['bil_isu'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th></th>
                                <th valign="middle" class="text-center">Jumlah</th>
                                <th valign="middle" class="text-center"><?= $jumlah_bilangan_isu_kluster ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="mb-3">
                <h3>B. Jumlah Kluster Isu Mengikut Negeri</h3>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th valign="middle">Negeri</th>
                                <?php foreach($senarai_kluster as $s): ?>
                                <th valign="middle" class="text-center"><?= $s->kit_nama ?></th>
                                <?php endforeach; ?>
                                <th valign="middle" class="text-center">Bilangan Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $bilangan = 1; 
                            foreach($senarai_negeri as $n):
                                $jumlah_isu = 0;
                            ?>
                            <tr>
                                <td valign="middle" class="text-center"><?= $bilangan++ ?></td>
                                <td valign="middle"><?= $n->nt_nama ?></td>
                                <?php 
                                $senarai_pelapor_negeri = $data_pengguna->ikut_negeri($n->nt_nama);
                                foreach($senarai_kluster as $s_k): 
                                    $bilangan_laporan_tahun = 0;
                                ?>
                                <td valign="middle" class="text-center">
                                    <?php foreach($senarai_pelapor_negeri as $p){
                                        $kluster = $data_kluster->tahun_ini_terima($s_k->kit_shortform, $p['bil'], date("Y"));
                                        if(!empty($kluster)){
                                            $bilangan_laporan_tahun = $bilangan_laporan_tahun + count($kluster);
                                            $jumlah_isu = $jumlah_isu + count($kluster);
                                        }
                                    }
                                    echo $bilangan_laporan_tahun;
                                     ?>
                                </td>
                                <?php endforeach; ?>
                                <td valign="middle" class="text-center"><?= $jumlah_isu ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>


    </div>
