<?php
$this->load->view('negeri_na/susunletak/atas');
$this->load->view('negeri_na/susunletak/navbar');
$this->load->view('negeri_na/susunletak/sidebar');
?>


<main id="main" class="main">


    <div class="pagetitle">
        <h1>RIMS@LAPIS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">RIMS@LAPIS</li>
                <li class="breadcrumb-item"><a href="<?= site_url('lapis/statusPenghantaran') ?>">Status Penghantaran Laporan</a></li>
                <li class="breadcrumb-item active">Tapisan Laporan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


        <section class="section">

            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Laporan Kluster <?= $kluster->kit_nama ?></h1>

    <?php if(!empty($senarai_laporan)): ?>
    <div class="table-responsive">
        <table class="table table-hover table-bordered datatable">
            <thead>
                <tr>
                    <th></th>
                    <th>Tarikh Laporan</th>
                    <th>Pelapor</th>
                    <th>Negeri</th>
                    <th>Daerah</th>
                    <th>Parlimen</th>
                    <th>DUN</th>
                    <th>Jenis Kawasan</th>
                    <?php if($kluster->kit_shortform != 'ekonomi'): ?>
                    <th>Isu</th>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'ekonomi'): ?>
                        <th>Isu Kenaikan Harga Barangan</th>
                        <th>Isu Kekurangan Bekalan Barangan</th>
                    <?php endif; ?>
                    <th>Ringkasan Isu</th>
                    <th>Lokasi Isu</th>
                    <th>Timestamp</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $bilangan = 1;
                foreach($senarai_laporan as $laporan){
                    $tarikh_temp[] = $laporan->tarikh_laporan;
                }
                array_multisort($tarikh_temp, SORT_DESC, $senarai_laporan);
                //array_multisort(array_column($senarai_laporan, 'pelapor'), SORT_DESC, $senarai_laporan);
                foreach($senarai_laporan as $laporan): ?>
                <tr>
                    <td><?= $bilangan++ ?></td>
                    <td><?= date_format(date_create($laporan->tarikh_laporan), "d.m.Y") ?></td>
                    <td><?php $pelapor = $data_pengguna->pengguna($laporan->pelapor);
                    echo $pelapor->nama_penuh ?>
                    </td>
                    <td>
                        <?php
                        $negeri_pelapor_dun = $data_pengguna->negeri_dun($pelapor->bil);
                        $nama_negeri = 'Belum Ditetapkan';
                        if(!empty($negeri_pelapor_dun)){
                            $nama_negeri = $negeri_pelapor_dun->dun_negeri;
                        }else{
                            $negeri_pelapor_parlimen = $data_pengguna->negeri_parlimen($pelapor->bil);
                            if(!empty($negeri_pelapor_parlimen)){
                                $nama_negeri = $negeri_pelapor_parlimen->pt_negeri;
                            }
                        }
                        echo $nama_negeri;
                        ?>
                    </td>
                    <td>
                        <?php 
                        $maklumatDaerah = $dataDaerah->daerah($laporan->daerah);
                        if(!empty($maklumatDaerah)){
                            echo $maklumatDaerah->nama;
                        }else{
                            $laporan->daerah;
                        }
                        ?>
                    </td>
                    <td><?= $laporan->pt_nama ?></td>
                    <td><?= $laporan->dun_nama ?></td>
                    <td><?= $laporan->jenis_kawasan ?></td>
                    <?php if($kluster->kit_shortform == 'politik'): 
                        $laporanBil = $laporan->bil; ?>
                    <td><?= $laporan->isu_politik ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'alamsekitar'): 
                        $laporanBil = $laporan->bil; ?>
                    <td><?= $laporan->isu_alamsekitar ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'kesihatan'): 
                        $laporanBil = $laporan->bil; ?>
                    <td><?= $laporan->isu_kesihatan ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'keselamatan'): 
                        $laporanBil = $laporan->bil; ?>
                    <td><?= $laporan->isu_keselamatan ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'sosial'): 
                        $laporanBil = $laporan->bil; ?>
                    <td><?= $laporan->isu_sosial ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'infrastruktur'): 
                        $laporanBil = $laporan->bil; ?>
                    <td><?= $laporan->isu_infrastruktur ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'telekomunikasi'): 
                        $laporanBil = $laporan->bil; ?>
                    <td><?= $laporan->isu_telekomunikasi ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'ekonomi'): 
                        $laporanBil = $laporan->bil; ?>
                        <td>
                            <ol>
                            <?php 
                            $tahun_laporan = date_format(date_create($laporan->tarikh_laporan), 'Y');
                            $senarai_kenaikan_harga = $data_isu->senarai_kenaikan_harga($tahun_laporan, $laporan->pelapor, $laporan->bil);
                            foreach($senarai_kenaikan_harga as $kh): 
                            ?>
                            <li><?= $kh->jenis_barangan ?></li>
                            <?php endforeach; ?>
                            </ol>   
                        </td>
                        <td>
                            <ol>
                                <?php
                                $tahun_laporan = date_format(date_create($laporan->tarikh_laporan), "Y");
                                $senarai_kekurangan_bekalan = $data_isu->senarai_kekurangan_bekalan($tahun_laporan, $laporan->pelapor, $laporan->bil);
                                foreach($senarai_kekurangan_bekalan as $kb): ?>
                                <li><?= $kb->jenis_barangan ?></li>
                                <?php endforeach; ?>
                            </ol>
                        </td>
                    <?php endif; ?>
                    <td><?= $laporan->ringkasan_isu ?></td>
                    <td><?= $laporan->lokasi_isu ?></td>
                    <td><?= $laporan->pengguna_waktu ?></td>
                    <td>
                        <div class="row g-1">

                            <div class="col-auto">
                            <?php echo form_open('lapis/prosesTerima'); ?>
                                <input type="hidden" name="input_kluster_bil" value="<?= $kluster->kit_bil ?>">
                            <input type="hidden" name="input_kluster_shortform" value="<?= $kluster->kit_shortform ?>">
                            <input type="hidden" name="input_tahun_laporan" value="<?= date_format(date_create($laporan->tarikh_laporan), 'Y') ?>">
                            <input type="hidden" name="input_pelapor_bil" value="<?= $laporan->pelapor ?>">
                            <input type="hidden" name="input_laporan_bil" value="<?= $laporanBil ?>">
                            <button type="submit" class="btn btn-outline-success shadow-sm">Terima</button>
                            </form>
                            </div>

                            <div class="col-auto">
                            <?php echo form_open('lapis/prosesDraf'); ?>
                                <input type="hidden" name="input_kluster_bil" value="<?= $kluster->kit_bil ?>">
                            <input type="hidden" name="input_kluster_shortform" value="<?= $kluster->kit_shortform ?>">
                            <input type="hidden" name="input_tahun_laporan" value="<?= date_format(date_create($laporan->tarikh_laporan), 'Y') ?>">
                            <input type="hidden" name="input_pelapor_bil" value="<?= $laporan->pelapor ?>">
                            <input type="hidden" name="input_laporan_bil" value="<?= $laporanBil ?>">
                            <button type="submit" class="btn btn-outline-danger shadow-sm">Semakan Semula Pelapor</button>
                            </form>
                            </div>

                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <?php if(empty($senarai_laporan)): ?>
        <div class="alert alert-success">
            Tiada laporan untuk ditapis.
        </div>
    <?php endif; ?>

                </div>
            </div>
            


        </section>
    

</main>


<?php $this->load->view('negeri_na/susunletak/bawah'); ?>