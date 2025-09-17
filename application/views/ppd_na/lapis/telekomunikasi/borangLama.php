<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LAPIS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">RIMS@LAPIS</a></li>
                <li class="breadcrumb-item active">Kluster <?= $kluster_isu->kit_nama ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <?php $this->load->view("ppd_na/lapis/peringatan"); ?>

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Tambah Laporan Kluster <?= $kluster_isu->kit_nama ?></h1>
                <p><?= $kluster_isu->kit_deskripsi ?></p>
                <?= validation_errors() ?>
    <?php echo form_open_multipart('lapis/proses_telekomunikasi'); 
    $bilangan = 1; ?>
    <h3>BAHAGIAN A</h3>
        <div class="mb-3">
            <label for="input_tarikh_laporan" class="form-label"><?= $bilangan++ ?>) Tarikh Laporan:</label>
            <input type="date" disabled id="input_tarikh_laporan" class="form-control" value="<?= date('Y-m-d') ?>">
        </div>
        <div class="mb-3">
            <label for="input_pelapor" class="form-label"><?= $bilangan++ ?>) Pelapor:</label>
            <select name="input_pelapor" id="input_pelapor" class="form-control" required>
                <option value="">Sila pilih..</option>
                <?php foreach($senarai_anggota as $pelapor): ?>
                    <option value="<?= $pelapor->bil ?>" <?php if($pelapor->bil == set_value('input_pelapor')){ echo "selected"; } ?>><?= $pelapor->nama_penuh ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_daerah" class="form-label"><?= $bilangan++ ?>) Daerah:</label>
            <select name="input_daerah" id="input_daerah" class="form-control" required>
                <option value="">Sila pilih..</option>
                <?php foreach($senaraiDaerah as $daerah): ?>
                    <option value="<?= $daerah->bil ?>" <?php if($daerah->bil == set_value('input_daerah')){ echo "selected"; } ?>><?= $daerah->nama ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_parlimen" class="form-label"><?= $bilangan++ ?>) Parlimen:</label>
            <select name="input_parlimen" id="input_parlimen" class="form-control">
                <option value="">Sila pilih..</option>
                <?php foreach($senarai_parlimen as $parlimen): ?>
                    <option value="<?= $parlimen->pt_bil ?>" <?php if($parlimen->pt_bil == set_value('input_parlimen')){ echo "selected"; } ?>><?= $parlimen->pt_nama ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php if(!empty($senarai_dun)): ?>
        <div class="mb-3">
            <label for="input_dun" class="form-label"><?= $bilangan++ ?>) DUN:</label>
            <select name="input_dun" id="input_dun" class="form-control">
                <option value="">Sila pilih..</option>
                <?php foreach($senarai_dun as $dun): ?>
                    <option value="<?= $dun->dun_bil ?>" <?php if($dun->dun_bil == set_value('input_dun')){ echo "selected"; } ?>><?= $dun->dun_nama ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php endif; ?>
        <?php if(!empty($senaraiPdm)): ?>
            <div class="mb-3">
                <label for="inputPdm" class="form-label"><?= $bilangan++ ?>) Daerah Mengundi:</label>
                <select name="inputPdm" id="inputPdm" class="form-control">
                    <option value="">Sila Pilih..</option>
                    <?php foreach($senaraiPdm as $dm): ?>
                        <option value="<?= $dm->ppt_bil ?>"><?= $dm->pt_nama ?> - <?= $dm->ppt_nama ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="input_jenis_kawasan" class="form-label"><?= $bilangan++ ?>) Jenis Kawasan:</label>
            <select name="input_jenis_kawasan" id="input_jenis_kawasan" class="form-control">
                <option value="">Sila pilih..</option>
                <option value="Bandar" <?php if('Bandar' == set_value('input_jenis_kawasan')){ echo "selected"; } ?>>Bandar</option>
                <option value="Pinggir Bandar" <?php if('Pinggir Bandar' == set_value('input_jenis_kawasan')){ echo "selected"; } ?>>Pinggir Bandar</option>
                <option value="Luar Bandar" <?php if('Luar Bandar' == set_value('input_jenis_kawasan')){ echo "selected"; } ?>>Luar Bandar</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_isu_telekomunikasi" class="form-label"><?= $bilangan++ ?>) Isu:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_telekomunikasi" id="input_isu_telekomunikasi" value="Rangkaian Internet / Data" <?php if('Rangkaian Internet / Data' == set_value('input_isu_telekomunikasi')){ echo "selected"; } ?>>
                <label class="form-check-label" for="input_isu_telekomunikasi">
                    Rangkaian Internet / Data
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_telekomunikasi" id="input_isu_telekomunikasi" value="Rangkaian Cellular / Cellular Networks" <?php if('Rangkaian Cellular / Cellular Networks' == set_value('input_isu_telekomunikasi')){ echo "selected"; } ?>>
                <label class="form-check-label" for="input_isu_telekomunikasi">
                    Rangkaian Cellular / Cellular Networks
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_telekomunikasi" id="input_isu_telekomunikasi" value="Rangkaian Radio" <?php if('Rangkaian Radio' == set_value('input_isu_telekomunikasi')){ echo "selected"; } ?>>
                <label class="form-check-label" for="input_isu_telekomunikasi">
                    Rangkaian Radio
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_telekomunikasi" id="input_isu_telekomunikasi" value="Rangkaian Televisyen" <?php if('Rangkaian Televisyen' == set_value('input_isu_telekomunikasi')){ echo "selected"; } ?>>
                <label class="form-check-label" for="input_isu_telekomunikasi">
                    Rangkaian Televisyen
                </label>
            </div>
        </div>
        <div class="mb-3">
            <label for="input_ringkasan_isu" class="form-label"><?= $bilangan++ ?>) Keterangan Isu:</label>
            <textarea name="input_ringkasan_isu" id="input_ringkasan_isu" cols="5" rows="5" class="form-control"><?= set_value('input_ringkasan_isu') ?></textarea>
        </div>
        <div class="mb-3">
            <label for="input_lokasi_isu" class="form-label"><?= $bilangan++ ?>) Lokasi Isu:</label>
            <input type="text" name="input_lokasi_isu" id="input_lokasi_isu" class="form-control" value="<?= set_value('input_lokasi_isu') ?>">
            <div class="row g-3 mt-1">
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="form-floating">
                        <input type="text" name="inputLatitude" id="inputLatitude" placeholder="a) Latitude Lokasi:" class="form-control">
                        <label for="inputLatitude" class="form-label">a) Latitude Lokasi:</label>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="form-floating">
                        <input type="text" name="inputLongitude" id="inputLongitude" placeholder="b) Longitude Lokasi:" class="form-control">
                        <label for="inputLongitude" class="form-label">b) Longitude Lokasi:</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="inputCadanganIntervensi" class="form-label"><?= $bilangan++ ?>) Cadangan Intervensi:</label>
            <textarea name="inputCadanganIntervensi" id="inputCadanganIntervensi" cols="30" rows="10" class="form-control" style="height:200px;"></textarea>
        </div>


        <h3>BAHAGIAN B</h3>
        <p class="small text-muted">Dokumen Sokongan Untuk Topik Rangkaian Internet / Data.</p>

        <div class="mb-3">
            <label for="input_mobile" class="form-label">1) Jenis TELCO (DIGI / CELCOM / UNIFI dll.):</label>
            <input type="text" name="input_mobile" id="input_mobile" class="form-control" value="<?= set_value('input_mobile') ?>">
        </div>

        <div class="mb-3">
            <label for="input_download" class="form-label">2) Download Rate (Mbps):</label>
            <input type="text" name="input_download" id="input_download" class="form-control" value='<?= set_value('input_download') ?>'>
        </div>

        <div class="mb-3">
            <label for="input_upload" class="form-label">3) Upload Rate (Mbps):</label>
            <input type="text" name="input_upload" id="input_upload" class="form-control" value="<?= set_value('input_upload') ?>">
        </div>

        <div class="mb-3">
            <label for="input_ping" class="form-label">4) Ping Rate (ms):</label>
            <input type="text" name="input_ping" id="input_ping" class="form-control" value="<?= set_value('input_ping') ?>">
        </div>

        <div class="mb-3">
            <label for="input_gambar" class="form-label">5) Dokumen Sokongan:</label>
            <input type="file"
       id="input_gambar" name="input_gambar"
       accept="image/png, image/jpeg" class="form-control">
        </div>
        

        <input type="hidden" name="input_kluster_bil" value="<?= $kluster_isu->kit_bil ?>">
        <input type="hidden" name="input_pengguna_bil" value="<?= $this->session->userdata('pengguna_bil') ?>">
        <div class="text-center">
        <button type="submit" class="btn btn-outline-primary shadow-sm">Hantar</button>
        </div>
    </form>
            </div>
        </div>

    </section>

</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>