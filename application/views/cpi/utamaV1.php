<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?= anchor(base_url(), 'RIMS@LAPIS') ?></li>
    <li class="breadcrumb-item active" aria-current="page">Utama</li>
  </ol>
</nav>

<?php $this->load->view('cpi/nav'); ?>

<div class="row g-3 mb-3">
    <div class="col-12 col-lg-6">
        <div class="p-3 border rounded text-center">
            <h3>Bilangan Pelapor</h3>
            <h1 class="display-1"><?= $bilangan_pelapor ?></h1>
            <?php echo anchor('pengguna/senarai_pelapor', 'Senarai Pelapor', "class='btn btn-sm btn-outline-success w-100'"); ?>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="p-3 border rounded text-center">
            <h3>Bilangan Kluster Isu</h3>
            <h1 class="display-1"><?= $bilangan_kluster_isu ?></h1>
            <?php echo anchor('cpi/senarai_kluster_isu', 'Senarai Kluster Isu', "class='btn btn-sm btn-outline-success w-100'"); ?>
        </div>
    </div>
</div>

<div class="mb-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
            <h1 class="card-title">Carian</h1>
            <a href="<?= site_url('lapis/carianTerperinci') ?>" class="btn btn-success">Carian Terperinci</a>
            </div>
            <?= form_open('lapis/carian') ?>
            <div class="row g-3">
                <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                    <div class="form-floating">
                                        <select name="inputKluster" id="inputKluster" class="form-control" required>
                                            <option value="">Sila pilih Kluster</option>
                                            <?php foreach($senarai_kluster as $kluster): ?>
                                            <option value="<?= $kluster->kit_bil ?>"><?= $kluster->kit_nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="inputKluster">Kluster</label>
                    </div>
                </div>
                <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                    <div class="form-floating">
                                        <select name="inputNegeriBil" id="inputNegeriBil" class="form-control">
                                            <option value="">Sila pilih..</option>
                                            <?php foreach($senarai_negeri as $negeri): ?>
                                            <option value="<?= $negeri->nt_bil ?>"><?= $negeri->nt_nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="inputNegeriBil">Negeri</label>
                    </div>
                </div>
                <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                    <div class="form-floating">
                        <input type="date" name="inputTarikhMula" id="inputTarikhMula" required class="form-control">
                        <label for="inputTarikhMula" class="form-label">Tarikh Mula</label>
                    </div>
                </div>
                <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                    <div class="form-floating">
                        <input type="date" name="inputTarikhTamat" id="inputTarikhTamat" class="form-control" required>
                        <label for="inputTarikhTamat" class="form-label">Tarikh Tamat</label>
                    </div>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-outline-success shadow-sm">Cari</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-12">
        <div class="p-3 border rounded">
            <p><strong>Bilangan Laporan Hari Ini (<?= date("d.m.Y") ?>)</strong></p>
            <div class="row g-3 mb-3">
                <?php 
                $jumlah_keseluruhan = 0;
                foreach($senarai_kluster as $kluster): ?>
                <div class="col-12 col-lg-3">
                    <div class="p-3 border rounded text-center">
                        <h3><?= strtoupper($kluster->kit_nama) ?></h3>
                        <?php 
                        $bilangan_laporan = 0;
                        $bilangan_laporan_terima = 0;
                        $senarai_pelapor = $data_pengguna->senarai_penuh_pelapor();
                        $senaraiPelapor = $data_pengguna->senarai_penuh_pelapor();
                        foreach($senarai_pelapor as $pelapor){
                            $senarai_laporan = $data_isu->hari_ini($kluster->kit_shortform, $pelapor->bil, date('Y'), date('Y-m-d'));
                            if(!empty($senarai_laporan)){
                                $bilangan_laporan = $bilangan_laporan + count($senarai_laporan);
                            }
                        }
                        ?>
                        <h1 class="display-1">
                            <?= $bilangan_laporan ?>
                            <?php $jumlah_keseluruhan = $jumlah_keseluruhan + $bilangan_laporan; ?>
                        </h1>
                        <div class="row g-1">
                            <?php if($tutupLama): ?>
                            <div class="col d-flex align-items-stretch">
                                <?php
                                $senaraiLaporanHariIni = $dataKlusterIsu->senaraiLaporan($kluster->kit_shortform, null, date('Y'), date('Y-m-d'));
                                if(!empty($senaraiLaporanHariIni)){
                                    $bilanganLaporanHariIni = count($senaraiLaporanHariIni);
                                } else {
                                    $bilanganLaporanHariIni = 0;
                                }
                                ?>
                                <a href="<?= site_url('lapis/laporan_hari_ini/'.$kluster->kit_bil) ?>" class="btn btn-outline-success shadow-sm w-100">Laporan Hari Ini <span class="badge bg-success text-white"><?= $bilanganLaporanHariIni ?></span></a>
                            <?php echo anchor('lapis/laporan_hari_ini/'.$kluster->kit_bil, 'Laporan '.$kluster->kit_nama, "class='btn btn-outline-success shadow-sm'"); ?>
                            </div>
                            <?php endif; ?>
                                <div class="col">
                                    <?php
                                    $tahun = date('Y');
                                    $jumlahTerima = 0;
                                    $status = 'Terima';
                                    //Draf, Hantar Negeri, Terima
                                    foreach($senaraiPelapor as $pelapor){
                                        $pelapor_bil = $pelapor->bil;
                                        $senaraiLaporan = $dataKlusterIsu->senaraiLaporan($kluster->kit_shortform, $pelapor_bil, $tahun, $status);
                                        if(!empty($senaraiLaporan)){
                                            $bilanganLaporan = count($senaraiLaporan);
                                            $jumlahTerima = $jumlahTerima + $bilanganLaporan;
                                        }
                                    }
                                    ?>
                                    <a href="<?= site_url('lapis/terima/'.$kluster->kit_bil) ?>" class="btn btn-outline-success shadow-sm w-100">SENARAI LAPORAN YANG DITERIMA <span class="badge bg-success text-white"><?= $jumlahTerima ?></span></a>
                                </div>
                                <div class="col">
                                    <a href="<?= site_url('lapis/laporanTolak/'.$kluster->kit_bil) ?>" class="btn btn-outline-warning shadow-sm w-100">PROSES LAPORAN</a>
                                </div>
                                <?php if($tutupLama): ?>
                                <div class="col">
                                <?php
                                    $tahun = date('Y');
                                    $jumlahHantar = 0;
                                    $status = 'Hantar HQ';
                                    //Draf, Hantar Negeri, Terima
                                    foreach($senaraiPelapor as $pelapor){
                                        $pelapor_bil = $pelapor->bil;
                                        $senaraiLaporan = $dataKlusterIsu->senaraiLaporan($kluster->kit_shortform, $pelapor_bil, $tahun, $status);
                                        if(!empty($senaraiLaporan)){
                                            $bilanganLaporan = count($senaraiLaporan);
                                            $jumlahHantar = $jumlahHantar + $bilanganLaporan;
                                        }
                                    }
                                    ?>
                                    <a href="<?= site_url('lapis/senaraiHantarNegeri/'.$kluster->kit_bil) ?>" class="btn btn-outline-success shadow-sm">Senarai Laporan Yang Perlu Ditapis <span class="badge bg-success text-white"><?= $jumlahHantar ?></span></a>
                                </div>
                                <?php endif; ?>
                            </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php
                if(!empty($senaraiSemuaSentimen)):
                    $bilangan_laporan = count($senaraiSentimenHariIni);
                ?>
                <div class="col-12 col-lg-3 d-flex align-items-stretch">
                    <div class="p-3 border rounded text-center d-flex flex-column w-100">
                        <h3 class="mb-0">RIMS@LPK</h3>
                        <span class="small text-secondary">LAPORAN PERSEPSI TERHADAP KERAJAAN (LPK)</span>
                        <div class="my-auto">
                        <h1 class="display-1">
                            <?= $bilangan_laporan ?>
                            <?php $jumlah_keseluruhan = $jumlah_keseluruhan + $bilangan_laporan; ?>
                        </h1>
                        </div>
                        <div class="row g-3 mt-auto">
                            <div class="col d-flex align-items-stretch">
                                <a href="<?= site_url('sentimen') ?>" class="btn btn-outline-success shadow-sm w-100 d-flex flex-column">
                                    <div class="my-auto">
                                        <i class="bi bi-house"></i> RIMS@LPK
                                    </div>
                                </a>
                            </div>
                            <div class="col d-flex align-items-stretch">
                                <a href="<?= site_url('sentimen/carian') ?>" class="btn btn-outline-success shadow-sm w-100 d-flex flex-column">
                                    <div class="my-auto">
                                        <i class="bi bi-search"></i> Carian
                                    </div>
                                </a>
                            </div>
                        </div>   
                    </div>
                </div>
                <?php endif; ?>
                <div class="col-12 col-lg-3 d-flex align-self-stretch justify-content-center">
                    <div class="p-3 border rounded text-center d-flex flex-column w-100">
                            <h3>RIMS@BENCANA</h3>
                        <div class="my-auto">
                            <h1 class="display-1">
                                <span id="bilanganLaporanBencana"><?= $bilanganLaporanBencana ?></span>
                                <?php $jumlah_keseluruhan = $jumlah_keseluruhan + $bilanganLaporanBencana; ?>
                            </h1>
                        </div>
                        <div class="row g-1 mt-auto">  
                            <div class="col">
                                <a href="<?= site_url('bencana') ?>" class="btn btn-outline-success shadow-sm w-100">Laman</a>
                            </div>
                        </div>   
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="p-3 border rounded text-center h-100 bg-light d-flex justify-content-center align-items-center">
                        <div class="">
                        <h3>JUMLAH KESELURUHAN</h3>
                        <h1 class="display-1">
                            <?= $jumlah_keseluruhan ?>
                        </h1>
                        <p class="small text-muted">BILANGAN LAPORAN</p>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $namaNegeri = array();
            foreach($senarai_negeri as $negeri){
                $namaNegeri[] = $negeri->nt_nama;
            }
            array_multisort($namaNegeri, SORT_ASC, $senarai_negeri);
            ?>

            <p>
                <strong>Bilangan Laporan Mengikut Negeri (<?= date('d.m.Y') ?>)</strong> <br>
                <span class="small text-muted">Jumlah penghantaran laporan tanpa mengikut status.</span>
            </p>

            <div class="table-responsive">
                <table class="table table-sm table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th valign="middle" class="text-center"></th>
                            <th valign="middle">Negeri</th>
                            <?php foreach($senarai_kluster as $kluster): ?>
                            <th valign="middle" class="text-center"><?= $kluster->kit_nama ?></th>
                            <?php endforeach; ?>
                            <th valign='middle' class='text-center'>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $bilangan = 1; 
                        foreach($senarai_negeri as $negeri): 
                            $jumlah_laporan_negeri = 0;
                            ?>
                        <tr>
                            <td valign="middle" class="text-center"><?= $bilangan++ ?></td>
                            <td valign="middle"><?= $negeri->nt_nama; ?></td>
                            <?php 
                            $senarai_pelapor_negeri = $data_pengguna->pelapor_negeri($negeri->nt_nama);
                            foreach($senarai_kluster as $kluster): 
                                $jumlah_kluster = 0;
                                foreach($senarai_pelapor_negeri as $pelapor){
                                    $bil_laporan = $data_isu->hari_ini($kluster->kit_shortform, $pelapor->bil, date("Y"), date('Y-m-d'));
                                    if(!empty($bil_laporan)){
                                        $jumlah_kluster = $jumlah_kluster + count($bil_laporan);
                                    }
                                }
                                ?>
                                <td valign="middle" class="text-center"><?= $jumlah_kluster ?>
                                
                                </td>
                            <?php 
                            $jumlah_laporan_negeri = $jumlah_laporan_negeri + $jumlah_kluster;
                            endforeach; ?>
                            <td valign='middle' class='text-center'>
                                <?= $jumlah_laporan_negeri ?>
                                
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>