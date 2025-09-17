<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?= anchor(base_url(), 'RIMS (JaPen Negeri)') ?></li>
    <li class="breadcrumb-item active" aria-current="page">RIMS@LAPIS</li>
  </ol>
</nav>

<?php $this->load->view('negeri/lapis/nav'); ?>

    <div class="p-3 border rounded mt-3">
        <p><strong>Status Penghantaran LAPIS</strong></p>
        <?= form_open('lapis/carianStatusPenghantaran') ?>
        <div class="form-floating mb-3">
            <select name="inputPelapor" id="inputPelapor" class="form-control" required>
                <option value="">Sila pilih..</option>
                <option value="Semua">Semua Pelapor</option>
                <?php foreach($senarai_pelapor as $pelapor): ?>
                    <option value="<?= $pelapor->bil ?>"><?= $pelapor->nama_penuh ?></option>
                <?php endforeach; ?>
            </select>
            <label for="inputPelapor" class="form-label">Pilih Pelapor: </label>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-12 col-lg-6">
                <div class="form-floating">
                    <input type="date" name="inputTarikhMula" id="inputTarikhMula" class="form-control" required>
                    <label for="inputTarikhMula" class="form-label">Tarikh Mula: </label>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-floating">
                    <input type="date" name="inputTarikhTamat" id="inputTarikhTamat" class="form-control" required>
                    <label for="inputTarikhTamat" class="form-label">Tarikh Tamat: </label>
                </div>
            </div>
        </div>
        <div class="form-floating mb-3">
            <select name="inputKlusterBil" id="inputKlusterBil" class="form-control" required>
                <option value="">Sila pilih..</option>
                <option value="Semua">Semua Kluster</option>
                <?php foreach($senarai_kluster as $kluster): ?>
                    <option value="<?= $kluster->kit_bil ?>"><?= $kluster->kit_nama ?></option>
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


    <div class="p-3 border rounded my-3">
        <p><strong>Bilangan Laporan</strong></p>
    <div class="table-responsive">
                <table class="table table-sm table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th rowspan=2 valign='middle' class='text-center'></th>
                            <th rowspan=2 valign='middle' class='text-center'>Pelapor</th>
                            <th rowspan=2 valign='middle' class='text-center'>Jawatan</th>
                            <th rowspan=2 valign='middle' class='text-center'>Penempatan</th>
                            <th colspan=<?= count($senarai_kluster)+1 ?> valign='middle' class='text-center'>Hari Ini (<?= date('d.m.Y') ?>)</th>
                            <th colspan=<?= count($senarai_kluster)+1 ?> valign='middle' class='text-center'>Minggu Ini (Minggu <?= date('W') ?>)</th>
                            <th colspan=<?= count($senarai_kluster)+1 ?> valign='middle' class='text-center'>Bulan Ini (<?= date('M Y') ?>)</th>
                            <th colspan=<?= count($senarai_kluster)+1 ?> valign='middle' class='text-center'>Tahun Ini (<?= date('Y') ?>)</th>
                        </tr>
                        <tr>
                            <?php foreach($senarai_kluster as $kluster): ?>
                            <th valign='middle' class='text-center'><?= $kluster->kit_nama ?></th>
                            <?php endforeach; ?>
                            <th valign='middle' class='text-center' style="background-color:green; color:white">Jumlah</th>
                            <?php foreach($senarai_kluster as $kluster): ?>
                            <th valign='middle' class='text-center'><?= $kluster->kit_nama ?></th>
                            <?php endforeach; ?>
                            <th valign='middle' class='text-center' style="background-color:green; color:white">Jumlah</th>
                            <?php foreach($senarai_kluster as $kluster): ?>
                            <th valign='middle' class='text-center'><?= $kluster->kit_nama ?></th>
                            <?php endforeach; ?>
                            <th valign='middle' class='text-center' style="background-color:green; color:white">Jumlah</th>
                            <?php foreach($senarai_kluster as $kluster): ?>
                            <th valign='middle' class='text-center'><?= $kluster->kit_nama ?></th>
                            <?php endforeach; ?>
                            <th valign='middle' class='text-center' style="background-color:green; color:white">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $bilangan = 1;
                        foreach($senarai_pelapor as $pelapor): ?>
                        <tr>
                            <td valign='middle' class='text-center'><?= $bilangan++ ?></td>
                            <td valign='middle'><?= $pelapor->nama_penuh; ?></td>
                            <td valign='middle'><?= $pelapor->pekerjaan; ?></td>
                            <td valign='middle'><?= $pelapor->pengguna_tempat_tugas; ?></td>
                            <?php 
                            // Hari ini
                            $jumlah_kluster = 0;
                            foreach($senarai_kluster as $kluster): ?>
                            <td valign='middle' class='text-center'>
                                <?php
                                $nama_kluster = $kluster->kit_shortform;
                                $pelapor_bil = $pelapor->bil;
                                $tarikh = date('Y-m-d'); 
                                $tahun = date('Y');
                                $senarai_laporan = $data_laporan->hari_ini($nama_kluster, $pelapor_bil, $tahun, $tarikh);
                                if(!empty($senarai_laporan)){
                                    $jumlah_kluster = $jumlah_kluster + count($senarai_laporan);
                                    echo count($senarai_laporan);
                                }else{
                                    echo '0';
                                }
                                ?>
                            </td>
                            <?php endforeach; ?>
                            <td valign='middle' class='text-center' style="background-color:green; color:white"><?php echo $jumlah_kluster; ?></td>
                            <?php
                            // Minggu ini 
                            $jumlah_kluster = 0;
                            foreach($senarai_kluster as $kluster): ?>
                            <td valign='middle' class='text-center'>
                                <?php
                                $nama_kluster = $kluster->kit_shortform;
                                $pelapor_bil = $pelapor->bil;
                                $tarikh = date('Y-m-d'); 
                                $tahun = date('Y');
                                $senarai_laporan = $data_laporan->minggu_ini($nama_kluster, $pelapor_bil, $tahun, $tarikh);
                                if(!empty($senarai_laporan)){
                                    $jumlah_kluster = $jumlah_kluster + count($senarai_laporan);
                                    echo count($senarai_laporan);
                                }else{
                                    echo '0';
                                }
                                ?>
                            </td>
                            <?php endforeach; ?>
                            <td valign='middle' class='text-center' style="background-color:green; color:white"><?php echo $jumlah_kluster; ?></td>
                            <?php 
                            // Bulan ini
                            $jumlah_kluster = 0;
                            foreach($senarai_kluster as $kluster): ?>
                            <td valign='middle' class='text-center'>
                                <?php
                                $nama_kluster = $kluster->kit_shortform;
                                $pelapor_bil = $pelapor->bil;
                                $bulan = date('M'); 
                                $tahun = date('Y');
                                $senarai_laporan = $data_laporan->bulan_ini($nama_kluster, $pelapor_bil, $tahun, $tarikh);
                                if(!empty($senarai_laporan)){
                                    $jumlah_kluster = $jumlah_kluster + count($senarai_laporan);
                                    echo count($senarai_laporan);
                                }else{
                                    echo '0';
                                }
                                ?>
                            </td>
                            <?php endforeach; ?>
                            <td valign='middle' class='text-center' style="background-color:green; color:white"><?php echo $jumlah_kluster; ?></td>
                            <?php 
                            // Tahun ini
                            $jumlah_kluster = 0;
                            foreach($senarai_kluster as $kluster): ?>
                            <td valign='middle' class='text-center'>
                                <?php
                                $nama_kluster = $kluster->kit_shortform;
                                $pelapor_bil = $pelapor->bil;
                                $tahun = date('Y');
                                $senarai_laporan = $data_laporan->tahun_ini($nama_kluster, $pelapor_bil, $tahun);
                                if(!empty($senarai_laporan)){
                                    $jumlah_kluster = $jumlah_kluster + count($senarai_laporan);
                                    echo count($senarai_laporan);
                                }else{
                                    echo '0';
                                }
                                ?>
                            </td>
                            <?php endforeach; ?>
                            <td valign='middle' class='text-center' style="background-color:green; color:white"><?php echo $jumlah_kluster; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
</div>
