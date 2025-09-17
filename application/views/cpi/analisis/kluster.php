<?php $this->load->view('cpi/nav'); ?>

<div class="p-3 border rounded mb-3">
    <h2>Analisis Mengikut Kluster <?= $kluster_pilihan->kit_nama ?></h2>
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
                <h3>A. Jumlah Isu Mengikut Negeri</h3>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th valign="middle">Negeri</th>
                                <th valign="middle" class="text-center">Bilangan Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $jumlah_bilangan_isu_kluster = 0;
                            $senarai_isu_kluster = array();
                            $bilangan = 1;

                            foreach($senarai_negeri as $negeri):
                                $jumlah_isu = 0;
                                $senarai_pelapor = $data_pengguna->ikut_negeri($negeri->nt_nama);
                                foreach($senarai_pelapor as $p){
                                    $isu = array();
                                    $kluster = $data_kluster->hari_ini_terima($kluster_pilihan->kit_shortform, $p['bil'], date("Y"), date('Y-m-d'));
                                    $bil_isu = 0;
                                    if(!empty($kluster)){
                                        $bil_isu = count($kluster);
                                    }
                                    $jumlah_isu = $jumlah_isu + $bil_isu;
                                }
                                $jumlah_bilangan_isu_kluster = $jumlah_bilangan_isu_kluster + $jumlah_isu;
                                $isu = array(
                                    'nama' => $negeri->nt_nama,
                                    'bil_isu' => $jumlah_isu
                                );
                                array_push($senarai_isu_kluster, $isu);
                            endforeach;

                            array_multisort(array_column($senarai_isu_kluster, 'bil_isu'), SORT_DESC, $senarai_isu_kluster);
                            foreach($senarai_isu_kluster as $sik): ?>
                            <tr>
                                <td valign="middle" class="text-center"><?= $bilangan++ ?></td>
                                <td valign="middle"><?= $sik['nama'] ?></td>
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
                <h3>B. Isu Trending Kluster <?= $kluster_pilihan->kit_nama ?></h3>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Isu Trending</th>
                                <th>Bilangan Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $bilangan = 1;
                            $senarai_trending = array();

                            $senarai_pelapor_semua = $data_pengguna->senarai_penuh_pelapor();
                            foreach($senarai_pelapor_semua as $pelapor){

                                if($kluster_pilihan->kit_shortform == 'politik'){
                                    $senarai_laporan = $data_kluster->hari_ini_terima($kluster_pilihan->kit_shortform, $pelapor->bil, date("Y"), date('Y-m-d'));
                                    foreach($senarai_laporan as $laporan){
                                        $cari = array(
                                            'isu' => $laporan->isu_politik
                                        );
                                        if(array_search($laporan->isu_politik, array_column($senarai_trending, 'isu')) !== false){
                                        //if(!in_array($senarai_trending, $cari, TRUE)){
                                            $isu = array(
                                                'isu' => $laporan->isu_politik,
                                                'bilangan' => 1
                                            );
                                            array_push($senarai_trending, $isu);
                                        }
                                        else{
                                            $b = 0;
                                            foreach($senarai_trending as $t){
                                                if($t['isu'] == $laporan->isu_politik){
                                                    $b = $t['bilangan'] + 1;
                                                }
                                            }
                                            $edit_isu = array(
                                                'isu' => $laporan->isu_politik,
                                                'bilangan' => $b
                                            );
                                            $senarai_trending = array_replace($senarai_trending, $edit_isu);
                                        }
                                    }
                                }


                            }

                            array_multisort(array_column($senarai_trending, 'bilangan'), $senarai_trending);
                            foreach($senarai_trending as $trend): ?>
                            <tr>
                                <td><?= $bilangan++ ?></td>
                                <td><?= $trend['isu'] ?></td>
                                <td><?= $trend['bilangan'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            

        </div>
    </div>


    <div class="tab-pane fade" id="minggu" role="tabpanel" aria-labelledby="minggu-tab"></div>



    <div class="tab-pane fade" id="bulan" role="tabpanel" aria-labelledby="bulan-tab"></div>



    <div class="tab-pane fade" id="tahun" role="tabpanel" aria-labelledby="tahun-tab"></div>


    </div>
