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
                <li class="breadcrumb-item"><a href="<?= site_url('lapis/statusPenghantaran') ?>">Status Penghantaran LAPIS</a></li>
                <li class="breadcrumb-item active">Carian Status Penghantaran LAPIS</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


        <section class="section">

            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Carian Status Penghantaran LAPIS</h1>
                    <?= form_open('lapis/carianStatusPenghantaran') ?>
                    <div class="form-floating mb-3">
                        <select name="inputPelapor" id="inputPelapor" class="form-control" required>
                            <option value="" <?php if($bilPelapor == ""){ echo 'selected'; } ?>>Sila pilih..</option>
                            <option value="Semua" <?php if($bilPelapor == "Semua"){ echo 'selected'; } ?>>Semua Pelapor</option>
                            <?php foreach($senarai_pelapor as $pelapor): ?>
                                <option value="<?= $pelapor->bil ?>" <?php if($bilPelapor == $pelapor->bil){ echo 'selected'; } ?>><?= $pelapor->nama_penuh ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputPelapor" class="form-label">Pilih Pelapor: </label>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-6">
                            <div class="form-floating">
                                <input type="date" name="inputTarikhMula" id="inputTarikhMula" class="form-control" value="<?= $tarikhMula ?>" required>
                                <label for="inputTarikhMula" class="form-label">Tarikh Mula: </label>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-floating">
                                <input type="date" name="inputTarikhTamat" id="inputTarikhTamat" class="form-control" value="<?= $tarikhTamat ?>" required>
                                <label for="inputTarikhTamat" class="form-label">Tarikh Tamat: </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="inputKlusterBil" id="inputKlusterBil" class="form-control" required>
                            <option value="" <?php if($bilKluster == ""){ echo 'selected'; } ?>>Sila pilih..</option>
                            <option value="Semua" <?php if($bilKluster == "Semua"){ echo 'selected'; } ?>>Semua Kluster</option>
                            <?php foreach($senarai_kluster as $kluster): ?>
                                <option value="<?= $kluster->kit_bil ?>" <?php if($bilKluster == $kluster->kit_bil){ echo 'selected'; } ?>><?= $kluster->kit_nama ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputKlusterBil" class="form-label">Pilih Kluster: </label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-outline-primary shadow-sm">Cari</button>
                    </div>
                    </form>
                    <em class="small text-muted">'Tarikh' merujuk kepada tarikh 'Timestamp'.</em>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Ketetapan Carian</h1>
                    <div class="row g-1">
                        <div class="col col-lg-3">
                            <p>
                                <strong>Pelapor:</strong>
                                <br><?= $namaPelapor ?>
                            </p>
                        </div>
                        <div class="col col-lg-3">
                            <p>
                                <strong>Kluster:</strong>
                                <br><?= $namaKluster ?>
                            </p>
                        </div>
                        <div class="col col-lg-3">
                            <p>
                                <strong>Tarikh Mula:</strong>
                                <br><?= $tarikhMula ?>
                            </p>
                        </div>
                        <div class="col col-lg-3">
                            <p>
                                <strong>Tarikh Tamat:</strong>
                                <br><?= $tarikhTamat ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <?php if(!empty($senaraiPelaporCarian)): ?>
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Keputusan Carian</h1>
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Nama Pelapor</th>
                                    <th>Jawatan / Gred</th>
                                    <th>Penempatan</th>
                                    <?php
                                    foreach($senaraiKlusterCarian as $kluster):
                                    ?>
                                    <th><?= $kluster->kit_nama ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($senaraiPelaporCarian as $pelapor): ?>
                                <tr>
                                    <td><?= $pelapor->nama_penuh ?></td>
                                    <td><?= $pelapor->pekerjaan ?></td>
                                    <td><?= $pelapor->pengguna_tempat_tugas ?></td>
                                    <?php foreach($senaraiKlusterCarian as $kluster): 
                                        $kluster_shortform = $kluster->kit_shortform;
                                        $pelapor_bil = $pelapor->bil;
                                        $tahun = date_format(date_create($tarikhTamat), 'Y');
                                        $status = 'TERIMA';
                                        $senaraiLaporan = $dataLaporan->carianSenaraiLaporan('', '', '',$kluster_shortform, $pelapor_bil, $tahun, $status, $tarikhMula, $tarikhTamat); ?>
                                    <td>
                                        <?php if(!empty($senaraiLaporan)): ?>
                                        <button type="button" class="btn btn-outline-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#kluster_<?= $kluster->kit_bil ?>_pelapor_<?= $pelapor->bil ?>" style="width:60px;">
                                            <?php 
                                            $bilanganLaporan = 0;
                                            if(!empty($senaraiLaporan)){
                                                $bilanganLaporan = count($senaraiLaporan);
                                            }
                                            echo $bilanganLaporan;
                                            ?>
                                        </button>
                                        <!-- Large Modal -->
                                        <div class="modal fade" id="kluster_<?= $kluster->kit_bil ?>_pelapor_<?= $pelapor->bil ?>" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Kluster <?= $kluster->kit_nama ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Waktu Penghantaran</th>
                                                                <th>Tarikh Laporan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach($senaraiLaporan as $laporan): ?>
                                                            <tr>
                                                                <td><?= $laporan->pengguna_waktu ?></td>
                                                                <td><?= $laporan->tarikh_laporan ?></td>
                                                            </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <p>
                                                    <strong>Jumlah Laporan:</strong> <?= count($senaraiLaporan) ?>
                                                </p>
                                                </div>
                                                
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div><!-- End Large Modal-->
                                        <?php endif; ?>
                                    </td>

                                    

                                    <?php endforeach; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            


        </section>
    

</main>


<?php $this->load->view('negeri_na/susunletak/bawah'); ?>