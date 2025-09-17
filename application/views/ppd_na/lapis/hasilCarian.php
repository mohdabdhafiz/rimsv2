<?php
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/navbar');
$this->load->view('ppd_na/susunletak/sidebar');
?>


<main id="main" class="main">


    <div class="pagetitle">
        <h1>RIMS@LAPIS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">RIMS@LAPIS</li>
                <li class="breadcrumb-item active">Carian</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


        <section class="section">
            
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">Carian</h1>
                        <?= form_open('lapis/carian') ?>
                                <div class="form-floating mb-3">
                                    <select name="inputKluster" id="inputKluster" class="form-control" required>
                                        <option value="">Sila pilih Kluster</option>
                                        <?php foreach($senarai_kluster as $kluster1): ?>
                                        <option value="<?= $kluster1->kit_bil ?>" <?php if($kluster1->kit_bil == $kluster->kit_bil){ echo "selected"; } ?>><?= $kluster1->kit_nama ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="inputDaerah">Kluster</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="inputTahun" id="inputTahun" placeholder="Tahun:" value="<?= $tahun ?>" class="form-control">
                                    <label for="inputTahun" class="form-label">Tahun:</label>
                                </div>
                                <button type="submit" class="btn btn-outline-success shadow-sm w-100">Cari</button>
                        </form>
                    </div>
                </div>


            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Hasil Carian</h1>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover datatable">
                            <thead>
                                <tr>
                                    <th>Timestamp</th>
                                    <th>Nama Pelapor</th>
                                    <th>Daerah</th>
                                    <th>Parlimen</th>
                                    <th>DUN</th>
                                    <th>Jenis Kawasan</th>
                                    <th>Isu</th>
                                    <?php if($kluster->kit_shortform == 'ekonomi'): ?>
                                        <th>Isu Kenaikan Harga Barangan</th>
                                        <th>Isu Kekurangan Bekalan Barangan</th>
                                    <?php endif; ?>
                                    <th>Ringkasan Isu</th>
                                    <th>Lokasi Isu</th>
                                    <?php if($kluster->kit_shortform == 'telekomunikasi'): ?>
                                        <th>Mobile Operator</th>
                                        <th>Download Rate (Mbps)</th>
                                        <th>Upload Rate (Mbps)</th>
                                        <th>Ping (ms)</th>
                                        <th>Screenshot</th>
                                    <?php endif; ?>
                                    <?php if($kluster->kit_shortform == 'infrastruktur'): ?>
                                        <th>Persekutuan / PBT</th>
                                    <?php endif; ?>
                                    <th>Cadangan Intervensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(!empty($senaraiLaporan)){
                                foreach($senaraiLaporan as $laporan){
                                    $tarikh_temp[] = $laporan->tarikhLaporan;
                                }
                                array_multisort($tarikh_temp, SORT_DESC, $senaraiLaporan);
                                }
                                foreach($senaraiLaporan as $laporan): 
                                    ?>
                                <tr>
                                    <td><?= $laporan->tarikhLaporan ?></td>
                                    <td><?= $laporan->nama_penuh ?></td>
                                    <td><?= $laporan->nama ?></td>
                                    <td><?= $laporan->pt_nama ?></td>
                                    <td><?= $laporan->dun_nama ?></td>
                                    <td><?= $laporan->jenis_kawasan ?></td>
                    <?php if($kluster->kit_shortform == 'politik'): ?>
                    <td><?= $laporan->isu_politik ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'alamsekitar'): ?>
                    <td><?= $laporan->isu_alamsekitar ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'kesihatan'): ?>
                    <td><?= $laporan->isu_kesihatan ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'keselamatan'): ?>
                    <td><?= $laporan->isu_keselamatan ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'sosial'): ?>
                    <td><?= $laporan->isu_sosial ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'infrastruktur'): ?>
                    <td><?= $laporan->isu_infrastruktur ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'telekomunikasi'): ?>
                    <td><?= $laporan->isu_telekomunikasi ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'ekonomi'): ?>
                        <td><?= $laporan->isu_ekonomi ?></td>
                        <td>
                            <?= $laporan->senaraiBarangNaik ?> 
                        </td>
                        <td>
                            <?= $laporan->senaraiBarangKurang ?>
                        </td>
                    <?php endif; ?>
                    <td><?= $laporan->ringkasan_isu ?></td>
                    <td><?= $laporan->lokasi_isu ?></td>
                    <?php if($kluster->kit_shortform == 'telekomunikasi'): ?>
                        <td><?= $laporan->mobile_operator ?></td>
                        <td><?= $laporan->download ?></td>
                        <td><?= $laporan->upload ?></td>
                        <td><?= $laporan->ping ?></td>
                        <td>
                            <?php if(!empty($laporan->dokumen)): ?>
                            <img class="img-fluid" src="<?= base_url() ?>/assets/img/<?= $laporan->dokumen ?>" alt="Screenshot untuk Isu Telekomunikasi <?= $laporan->laporanBil ?>">
                            <?php endif; ?>
                        </td>
                    <?php endif; ?>

                    <?php if($kluster->kit_shortform == 'infrastruktur'): ?>
                        <td>
                            <?php if(!empty($laporan->kategori)): ?>
                                <?= $laporan->kategori ?></td>
                            <?php endif; ?>
                    <?php endif; ?>
                    <td><?= $laporan->cadangan_intervensi ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            


        </section>
    

</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>