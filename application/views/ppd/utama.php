<?php
$status = FALSE;
$senarai_pru_parlimen = array();
$senarai_pru_dun = array();
?>

<div class="row g-3 mb-3">

<div class="col-12 col-lg-3">
            <div id="nav_ppd"></div>

    <?php if(empty($pengguna->pengguna_status)): ?>
        <?php if(empty($organisasi)): ?>
    <div class="alert alert-warning mt-3">
        <h4 class="alert-heading">PENETAPAN NAMA ORGANISASI</h4>
        <ol>
            <li>RIMS@PROGRAM memerlukan beberapa <em>features</em> baharu, mohon kerjasama tuan/puan untuk mengemaskini maklumat <strong>Nama Organisasi</strong> untuk kegunaan RIMS.</li>
            <li>Kerjasama tuan/puan amatlah dihargai.</li>
            <li>Terima kasih.</li>
        </ol>
        <p class="small text-secondary mb-0">
            Mohd Abd Hafiz bin Awang, BGSPI
            <br>6.2.2024
        </p>

        <hr>
        <h5>Nama Organisasi</h5>
        <?= form_open('ppd/setOrganisasi') ?>
        <div class="form-floating mb-3">
            <input type="text" name="inputOrganisasi" id="inputOrganisasi" class="form-control" placeholder="Nama Organisasi:" required>
            <label for="inputOrganisasi" class="form-label">Nama Organisasi:</label>
            <em class="small text-muted mb-0">Contoh: Pejabat Penerangan Daerah Bera</em>
        </div>
        <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
        <input type="hidden" name="inputPeranan" value="<?= $pengguna->pengguna_peranan_bil ?>">
        <button type="submit" class="btn btn-warning shadow-sm">
            <i class="bi bi-gear"></i>
            Kemaskini
        </button>
        </form>
    </div>
    <?php endif; ?>
        <?php if(empty($ppd)): ?>
    <div class="alert alert-warning mt-3">
        <h4 class="alert-heading">PENETAPAN PEGAWAI PENERANGAN DAERAH</h4>
        <ol>
            <li>RIMS@PROGRAM memerlukan pengesahan <strong>Pegawai Penerangan Daerah</strong> untuk prosedur gerak kerja dalam pelaporan program jabatan.</li>
            <li>Tuan/Puan dimohon untuk mengemaskini maklumat Pegawai Penerangan Daerah seperti yang disediakan.</li>
            <li>Kerjasama tuan/puan dalam perkara ini amatlah dihargai.</li>
            <li>Terima kasih.</li>
        </ol>
        <p class="small text-secondary mb-0">
            Mohd Abd Hafiz bin Awang, BGSPI
            <br>6.2.2024
        </p>
        <hr>
        <h5>Penetapan Pegawai Penerangan Daerah</h5>
        <?= form_open('ppd/setPegawai') ?>
            <div class="form-floating mb-3">
                <select name="inputPpd" id="inputPpd" class="form-control" required>
                    <option value="">Sila Pilih..</option>
                    <?php foreach($senaraiAnggota as $anggota): ?>
                        <option value="<?= $anggota->bil ?>"><?= $anggota->nama_penuh ?> (<?= $anggota->pekerjaan ?>)</option>
                    <?php endforeach; ?>
                </select>
                <label for="inputPpd" class="form-label">Pilih Pegawai:</label>
            </div>
            <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
            <input type="hidden" name="inputPeranan" value="<?= $pengguna->pengguna_peranan_bil ?>">
            <button class="submit btn btn-warning shadow-sm">
                <i class="bi bi-gear"></i>
                Kemaskini
            </button>
        </form>
    </div>
    <?php endif; ?>
    <?php endif; ?>


    <?php if(!empty($organisasi)): ?>
        <div class="p-3 border rounded mt-3">
            <strong>Nama Organisasi:</strong>
            <br><?= strtoupper($organisasi->jt_pejabat) ?>
        </div>
    <?php endif; ?>

    <?php if(!empty($ppd)): ?>
        <div class="p-3 border rounded mt-3">
            <strong>Pegawai Penerangan Daerah:</strong>
            <br><?= strtoupper($ppd->nama_penuh) ?>
            <br><?= strtoupper($ppd->pekerjaan) ?>
            <div class="text-end">
                <a href="<?= site_url('ppd/kemaskiniPegawai') ?>" class="btn btn-sm btn-warning shadow-sm">
                    Kemaskini
                </a>
            </div>
        </div>
    <?php endif; ?>


        </div>


<div class="col-12 col-lg-9">

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'RIMS'); ?></li>
    <li class="breadcrumb-item active" aria-current="page">Utama</li>
  </ol>
</nav>


    <div class="p-3 border rounded mb-3">
        <p><strong>Maklumat Penugasan Sempadan Daerah, KAPAR dan KADUN</strong></p>
    <?php if(!empty($senarai_tugas_parlimen) || !empty($senarai_tugas_dun)){ ?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm">
            <tr class="bg-secondary text-white">
                <th class="text-center">BIL</th>
                <th>KATEGORI</th>
                <th>DAERAH / KAPAR / KADUN</th>
                <th>NEGERI</th>
            </tr>
            <?php
            $count = 1; 
            $senaraiDaerah = $dataDaerah->senaraiTugasanDaerah($this->session->userdata('peranan_bil'));
            foreach($senaraiDaerah as $daerah):
            ?>
            <tr>
                <td class="text-center"><?= $count++ ?></td>
                <td>DAERAH</td>
                <td><?= strtoupper($daerah->nama) ?></td>
                <td><?= strtoupper($daerah->nt_nama) ?></td>
            </tr>
            <?php endforeach; ?>
    <?php 
        foreach($senarai_tugas_parlimen as $tugas): 
        $parlimen_nama = $data_parlimen->parlimen_bil($tugas->tpt_parlimen_bil)->pt_nama;
        $negeri = $data_parlimen->parlimen_bil($tugas->tpt_parlimen_bil)->pt_negeri; 
        $senarai_pilihanraya = $data_pilihanraya->parlimen_pr_aktif($tugas->tpt_parlimen_bil);
        foreach($senarai_pilihanraya as $pilihanraya){
            if(!in_array($pilihanraya->ppt_pilihanraya_bil, $senarai_pru_parlimen)){
                array_push($senarai_pru_parlimen, $pilihanraya->ppt_pilihanraya_bil);
            }
        }
        ?>
            <tr>
                <td class="text-center"><?php echo $count++; ?></td>
                <td>PARLIMEN</td>
                <td><?php echo strtoupper($parlimen_nama); ?></td>
                <td><?php echo strtoupper($negeri); ?></td>
            </tr>
            <?php endforeach; ?>
            <?php foreach($senarai_tugas_dun as $tugas_dun): 
                $dun_nama = $data_dun->dun_bil($tugas_dun->tdt_dun_bil)->dun_nama; 
                $negeri = $data_dun->dun_bil($tugas_dun->tdt_dun_bil)->dun_negeri;
                $senarai_pilihanraya_dun = $data_pilihanraya->dun_pr_aktif($tugas_dun->tdt_dun_bil);
                foreach($senarai_pilihanraya_dun as $pilihanraya_dun){
                    if(!in_array($pilihanraya_dun->pilihanraya_bil, $senarai_pru_dun)){
                        array_push($senarai_pru_dun, $pilihanraya_dun->pilihanraya_bil);
                    }
                }
                ?>
            <tr>
                <td class="text-center"><?php echo $count++; ?></td>
                <td>DUN</td>
                <td><?php echo strtoupper($dun_nama); ?></td>
                <td><?php echo strtoupper($negeri); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php } ?>
    </div>
        
    
    <div class="p-3 mb-3 border rounded">
        <p><strong>Tugasan</strong></p>
        <div class="row g-3">

            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                <h5 class="text-primary">RIMS@PROGRAM</h5>
                <p><strong>Laporan Program</strong></p>
                <ol>
                    <li class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Membuat persediaan untuk program yang akan dilaksanakan.</span>
                            <a href="<?= site_url('program/tambah') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-plus-circle"></i>
                            </a>
                        </div>
                    </li>
                    <li class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Mengemaskini maklumat program.</span>
                            <a href="<?= site_url('program/senarai') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-gear-wide-connected"></i>
                            </a>
                        </div>
                    </li>
                    <?php if(!empty($ppd)): ?>
                    <?php if($ppd->p_anggota == $pengguna->bil): ?>
                        <li class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Mengesahkan maklumat program.</span>
                            <a href="<?= site_url('program/senaraiDraf') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-gear"></i>
                            </a>
                        </div>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>  
                </ol>
            </div>

            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                <h5 class="text-primary">RIMS@KOMUNITI</h5>
                <p><strong>Laporan Komuniti</strong></p>
                <ol>
                    <li class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Senarai penuh Komuniti.</span>
                            <a href="<?= site_url('komuniti/senarai') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-inboxes"></i>
                            </a>
                        </div>
                    </li>
                    <li class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Menubuhkan Komuniti baharu.</span>
                            <a href="<?= site_url('komuniti/daftar') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-node-plus"></i>
                            </a>
                        </div>
                    </li>
                    <li class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Mendaftarkan Ahli Komuniti baharu.</span>
                            <a href="<?= site_url('komuniti/carian') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-person-plus"></i>
                            </a>
                        </div>
                    </li>
                </ol>
            </div>

            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                <h5 class="text-primary">RIMS@KELABMALAYSIAKU</h5>
                <p><strong>Laporan Kelab Malaysiaku</strong></p>
                <ol>
                    <li class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Dashboard Kelab Malaysiaku.</span>
                            <a href="<?= site_url('kelabmalaysiaku') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-grid-1x2-fill"></i>
                            </a>
                        </div>
                    </li>
                    <li class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Senarai Kelab Malaysiaku.</span>
                            <a href="<?= site_url('kelabmalaysiaku/senarai') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-inboxes"></i>
                            </a>
                        </div>
                    </li>
                    <li class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Menubuhkan Kelab Malaysiaku Baharu.</span>
                            <a href="<?= site_url('kelabmalaysiaku/daftar') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-node-plus"></i>
                            </a>
                        </div>
                    </li>
                    <li class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Mendaftarkan Ahli Kelab Malaysiaku Baharu.</span>
                            <a href="<?= site_url('kelabmalaysiaku/carian') ?>" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-person-plus"></i>
                            </a>
                        </div>
                    </li>
                </ol>
            </div>

            <div class="col-12 col-lg-6" id="lapis"></div>

                <div class="col-12 col-lg-6 d-flex align-items-stretch">
                    <div class="border rounded bg-white d-flex flex-column w-100">
                        <div class="bg-primary p-3 mb-3">
                        <h5 class="text-white">RIMS@LPK <span class="text-white">: Laporan Persepsi Terhadap Kerajaan</span></h5>
                        </div>
                        <div class="bg-white p-3">
                        <div class="row g-3">
                            <a href="<?= site_url('sentimen') ?>" class="col-12 col-lg d-flex align-items-stretch btn btn-outline-primary m-1">
                                <div class="p-3 d-flex flex-column w-100">
                                        <i class="bi bi-grid-1x2-fill display-3"></i>
                                    <span class="my-auto">
                                        LAMAN RIMS@LPK
                                    </span>
                                </div>
                            </a>
                            <a href="<?= site_url('sentimen/borang') ?>" class="col-12 col-lg d-flex align-items-stretch btn btn-outline-primary m-1">
                                <div class="p-3 d-flex flex-column w-100">
                                        <i class="bi bi-plus-circle display-3"></i>
                                    <span class="my-auto">
                                        BORANG
                                    </span>
                                </div>
                            </a>
                            <a href="<?= site_url('sentimen/senarai') ?>" class="col-12 col-lg d-flex align-items-stretch btn btn-outline-primary m-1">
                                <div class="p-3 d-flex flex-column w-100">
                                    <i class="bi bi-inboxes display-3"></i>
                                    <span class="my-auto">SENARAI LAPORAN MENGIKUT INDIVIDU</span>
                                </div>
                            </a>
                            <a href="<?= site_url('sentimen/mengikutSenaraiAnggota') ?>" class="col-12 col-lg d-flex align-items-stretch btn btn-outline-primary m-1">
                                <div class="p-3 d-flex flex-column w-100">
                                    <i class="bi bi-people-fill display-3"></i>
                                    <span class="my-auto">SENARAI LAPORAN MENGIKUT ANGGOTA</span>
                                </div>
                            </a>
                            <a href="<?= site_url('sentimen/pilihMuatTurun') ?>" class="col-12 col-lg d-flex align-items-stretch btn btn-outline-primary m-1">
                                <div class="p-3 d-flex flex-column w-100">
                                    <i class="bi bi-zoom-in display-3"></i>
                                    <span class="my-auto">MUAT TURUN CSV</span>
                                </div>
                            </a>
                        </div>
                        </div>
                    </div>
                </div>


            <div class="col-12 col-lg-6" >
                <h5 class="text-primary">RIMS@OBP</h5>
                <p><strong>Orang Berpengaruh (OBP)</strong></p>
                <ol>
                    <li class="mb-3">
                        Melihat senarai OBP<br />
                        <a href="<?= site_url('obp/senarai') ?>" class="btn btn-outline-success">Senarai OBP</a>
                    </li>
                    <li class="mb-3">
                        Menambah maklumat OBP<br />
                        <a href="<?= site_url('obp/tambah') ?>" class="btn btn-outline-success">Tambah Maklumat OBP</a>
                    </li>
                </ol>
            </div>

            <?php 
            if(count($senarai_tugas_parlimen) > 0){ ?>
            <div class="col-12">
                <h5 class="text-primary">RIMS@SISMAP</h5>
                <p><strong>Laporan Penyediaan Profil Negeri, Daerah, Parlimen dan DUN</strong></p>
            </div>
            <div class="col-12 col-lg-6">
                <p><strong>Parlimen</strong></p>
                <ol>
                    <li class="mb-3">Sila pastikan nama daerah mengundi dan bilangan pengundi mengikut data terakhir yang telah diedarkan oleh urus setia.<br />
                    <div class="row g-3">
                        <div class="col-12 col-lg-12">
                    <?php echo anchor('parlimen/tambah_dm', 'Kemaskini Daerah Mengundi Parlimen', "class='btn btn-primary w-100 mt-1'"); ?>
                    </div>
                    </div>
                    </li>
                    <li class="mb-3">Memasukkan data jangkaan calon Parlimen.<br />
                    <div class="row g-3">
                        <div class="col-12 col-lg-12">
                    <?php echo anchor('winnable_candidate/daftar', 'Tambah Jangkaan Calon Parlimen', "class='btn btn-primary w-100 mt-1'"); ?>
                    </div>
                    </div>
                    </li>
                    <li class="mb-3">Mengemaskini maklumat jangkaan calon Parlimen.<br />
                    <div class="row g-3">
                    <?php foreach($senarai_tugas_parlimen as $tugas): 
                            $parlimen_nama = $data_parlimen->parlimen_bil($tugas->tpt_parlimen_bil)->pt_nama; 
                        ?>
                    <div class="col-12 col-lg-6">
                    <?php echo anchor('winnable_candidate/kemaskini_parlimen/'.$tugas->tpt_parlimen_bil, 'Kemaskini Jangkaan Calon Parlimen '.$parlimen_nama, "class='btn btn-primary w-100 mt-1'"); ?>
                    </div>
                    <?php endforeach; ?>
                    </div>
                    </li>
                    <li class="mb-3">Membuat rumusan kekuatan dan kelemahan calon.<br />
                    <div class="row g-3">
                    <?php foreach($senarai_tugas_parlimen as $tugas): 
                            $parlimen_nama = $data_parlimen->parlimen_bil($tugas->tpt_parlimen_bil)->pt_nama; 
                        ?>
                    <div class="col-12 col-lg-6">
                    <?php echo anchor('winnable_candidate/kemaskini_parlimen/'.$tugas->tpt_parlimen_bil, 'Kemaskini Jangkaan Calon Parlimen '.$parlimen_nama, "class='btn btn-primary w-100 mt-1'"); ?>
                    </div>
                    <?php endforeach; ?>
                    </div>
                    </li>
                    <li class="mb-3">Mengemaskini maklumat pencalonan pilihan raya.<br />
                    <div class="row g-3">
                        <?php foreach($senarai_pru_parlimen as $p_parlimen): 
                        $pp2 = $data_pilihanraya->pilihanraya($p_parlimen);
                        ?>
                            <div class="col-12 col-lg-6">
                                <?php echo anchor('pencalonan/maklumat_pencalonan/'.$p_parlimen, 'Senarai Pencalonan '.$pp2->pilihanraya_nama, "class='btn btn-primary w-100 mt-1'"); ?>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </li>
                    <li class="mb-3">Membuat grading mengikut Daerah Mengundi. Culaan SISMAP.<br />
                        <div class="row g-3">
                        <?php 
                        if($konfigurasiGradingLama == 'BUKA'):
                        foreach($senarai_pru_parlimen as $p_parlimen): 
                        $pp2 = $data_pilihanraya->pilihanraya($p_parlimen);
                        ?>
                            <div class="col-12 col-lg-6">
                                <?php echo anchor('grading/pilihanraya/'.$pp2->pilihanraya_bil, 'Kemaskini Maklumat Grading '.$pp2->pilihanraya_nama, "class='btn btn-primary w-100 mt-1'"); ?>
                            </div>
                        <?php endforeach; 
                        endif;
                        ?>

                        <?php foreach($senaraiParlimenPilihanraya as $parlimen): ?>
                            <div class="col-12 col-lg-6">
                                <?= form_open('grading/parlimenPilihanraya') ?>
                                    <input type="hidden" name="inputParlimenBil" value="<?= $parlimen->tpt_parlimen_bil ?>">
                                    <input type="hidden" name="inputPilihanrayaBil" value="<?= $parlimen->ppt_pilihanraya_bil ?>">
                                    <button type="submit" class="btn btn-outline-primary shadow-sm">Kemaskini Grading Parlimen <?= $parlimen->pt_nama ?> untuk <?= $parlimen->pilihanraya_singkatan ?></button>
                                </form>
                            </div>
                        <?php endforeach; ?>

                        </div>
                    </li> 
                </ol>
            </div>
            <?php } 
            if(count($senarai_tugas_dun) > 0){?>
            <div class="col-12 col-lg-6">
                <p><strong>DUN</strong></p>
                <ol>
                    <li class="mb-3">Sila pastikan nama daerah mengundi dan bilangan pengundi mengikut data terakhir yang telah diedarkan oleh urus setia.<br />
                    <div class="row g-3">
                    <div class="col-12 col-lg-12">
                    <?php echo anchor('dun/tambah_dm', 'Kemaskini Daerah Mengundi DUN', "class='btn btn-secondary w-100 mt-1'"); ?>
                    </div>
                    </div>
                    </li>
                    <li class="mb-3">Memasukkan data jangkaan calon DUN.<br />
                    <div class="row g-3">
                    <div class="col-12 col-lg-12">
                    <?php echo anchor('dun/tambah_jangkaan_calon', 'Tambah Jangkaan Calon DUN', "class='btn btn-secondary w-100 mt-1'"); ?>
                    </div>
                    </div>
                    </li>
                    <li class="mb-3">Mengemaskini maklumat jangkaan calon DUN.<br />
                    <div class="row g-3">
                    <?php foreach($senarai_tugas_dun as $tugas): 
                            $dun_nama = $data_dun->dun_bil($tugas->tdt_dun_bil)->dun_nama; 
                        ?>
                    <div class="col-12 col-lg-6">
                    <?php echo anchor('dun/kemaskini_jangkaan_dun/'.$tugas->tdt_dun_bil, 'Kemaskini Jangkaan Calon DUN '.$dun_nama, "class='btn btn-secondary w-100 mt-1'"); ?>
                    </div>
                    <?php endforeach; ?>
                    </div>
                    </li>
                    <li class="mb-3">Membuat rumusan kekuatan dan kelemahan calon.<br />
                    <div class="row g-3">
                    <?php foreach($senarai_tugas_dun as $tugas): 
                            $dun_nama = $data_dun->dun_bil($tugas->tdt_dun_bil)->dun_nama; 
                        ?>
                    <div class="col-12 col-lg-6">
                    <?php echo anchor('dun/kemaskini_jangkaan_dun/'.$tugas->tdt_dun_bil, 'Kemaskini Jangkaan Calon DUN '.$dun_nama, "class='btn btn-secondary w-100 mt-1'"); ?>
                    </div>
                    <?php endforeach; ?>
                    </div>
                    </li>
                    <li class="mb-3">Mengemaskini maklumat pencalonan pilihan raya.<br />
                    <div class="row g-3">
                        <?php foreach($senarai_pru_dun as $p_dun): 
                        $pd2 = $data_pilihanraya->pilihanraya($p_dun);
                        ?>
                            <div class="col-12 col-lg-6">
                                <?php echo anchor('pencalonan/maklumat_pencalonan/'.$p_dun, 'Senarai Pencalonan '.$pd2->pilihanraya_nama, "class='btn btn-secondary w-100 mt-1'"); ?>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </li>
                    <li class="mb-3">Membuat grading mengikut Daerah Mengundi. Culaan SISMAP.<br />
                        <div class="row g-3">
                        <?php 
                        if($konfigurasiGradingLama == 'BUKA'):
                        foreach($senarai_pru_dun as $p_dun): 
                        $pd2 = $data_pilihanraya->pilihanraya($p_dun);
                        ?>
                            <div class="col-12 col-lg-6">
                                <?php echo anchor('grading/pilihanraya/'.$p_dun, 'Kemaskini Maklumat Grading '.$pd2->pilihanraya_nama, "class='btn btn-secondary w-100 mt-1'"); ?>
                            </div>
                        <?php endforeach; 
                        endif; ?>

                        <?php foreach($senaraiDunPilihanraya as $dun): ?>
                            <div class="col-12 col-lg-6">
                                <?= form_open('grading/dunPilihanraya') ?>
                                    <input type="hidden" name="inputDunBil" value="<?= $dun->tdt_dun_bil ?>">
                                    <input type="hidden" name="inputPilihanrayaBil" value="<?= $dun->pdt_pilihanraya_bil ?>">
                                    <button type="submit" class="btn btn-outline-secondary shadow-sm">Kemaskini Grading DUN <?= $dun->dun_nama ?> untuk <?= $dun->pilihanraya_singkatan ?></button>
                                </form>
                            </div>
                        <?php endforeach; 
                        ?>

                        </div>
                    </li>
                </ol>
            </div>
            <?php } ?>

            

            
            

        </div>
    </div>

    </div>
    </div>



<script>

    async function setLapis()
    {
        const data = await getLapis();
        document.getElementById("lapis").innerHTML = data;
    }

    async function getLapis()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/lapis/ppd');
        const data = await response.text();
        return data;
    }

    async function setNav()
    {
        const data = await getNav();
        document.getElementById("nav_ppd").innerHTML = data;
    }

    async function getNav()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/ppd/nav');
        const data = await response.text();
        return data;
    }

    setNav();
    setLapis();

</script>