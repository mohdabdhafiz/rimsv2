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
                <?php echo form_open('lapis/proses_alamsekitar'); 
                $bilangan = 1; ?>
        <div class="mb-3">
            <label for="input_tarikh_laporan" class="form-label"><?= $bilangan++ ?>) Tarikh Laporan:</label>
            <input type="date" id="input_tarikh_laporan" class="form-control" value="<?= date('Y-m-d') ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="input_pelapor" class="form-label"><?= $bilangan++ ?>) Pelapor:</label>
            <select name="input_pelapor" id="input_pelapor" class="form-control" required>
                <option>Sila pilih..</option>
                <?php foreach($senarai_anggota as $pelapor): ?>
                    <option value="<?= $pelapor->bil ?>"><?= $pelapor->nama_penuh ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_daerah" class="form-label"><?= $bilangan++ ?>) Daerah:</label>
            <select name="input_daerah" id="input_daerah" class="form-control" required>
                <option value="">Sila pilih..</option>
                <?php foreach($senaraiDaerah as $daerah): ?>
                    <option value="<?= $daerah->bil ?>"><?= $daerah->nama ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php if(!empty($senaraiParlimen)): ?>
            <div class="mb-3">
                <label for="input_parlimen" class="form-label"><?= $bilangan ++ ?>) Parlimen:</label>
                <select name="input_parlimen" id="input_parlimen" class="form-control">
                    <option value="">Sila Pilih..</option>
                    <?php foreach($senaraiParlimen as $parlimen): ?>
                        <option value="<?= $parlimen->pt_bil ?>"><?= $parlimen->pt_nama ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>
        <?php if(!empty($senaraiDun)): ?>
            <div class="mb-3">
                <label for="input_dun" class="form-label"><?= $bilangan++ ?>) DUN:</label>
                <select name="input_dun" id="input_dun" class="form-control">
                    <option value="">Sila Pilih..</option>
                    <?php foreach($senaraiDun as $dun): ?>
                        <option value="<?= $dun->dun_bil ?>"><?= $dun->dun_nama ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>
        <?php if(!empty($senaraiPdm)): ?>
            <div class="mb-3">
                <label for="input_pdm" class="form-label"><?= $bilangan++ ?>) Daerah Mengundi:</label>
                <select name="input_pdm" id="input_pdm" class="form-control">
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
                <option value="Bandar">Bandar</option>
                <option value="Pinggir Bandar">Pinggir Bandar</option>
                <option value="Luar Bandar">Luar Bandar</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_tajuk_isu" class="form-label"><?= $bilangan++ ?>) Isu:</label>
                        <?php foreach($senaraiKategori as $k): ?>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_tajuk_isu" id="input_tajuk_isu" value="<?= $k->nama ?>">
                <label class="form-check-label" for="input_tajuk_isu">
                <?= $k->nama ?>
                                <?php if(!empty($k->deskripsi)): ?>
                                    <em class="small text-muted"><?= $k->deskripsi ?></em>
                                <?php endif; ?>
                </label>
            </div>
                        <?php endforeach; ?>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_tajuk_isu" id="input_tajuk_isu" value="Lain-lain">
                <label class="form-check-label" for="input_tajuk_isu">
                    Lain-lain
                </label>
                <textarea name="input_tajuk_isu_lain" id="input_tajuk_isu_lain" cols="10" rows="5" class="form-control"></textarea>
            </div>
        </div>
        <div class="mb-3">
            <label for="input_ringkasan_isu" class="form-label"><?= $bilangan++ ?>) Keterangan Isu:</label>
            <textarea name="input_ringkasan_isu" id="input_ringkasan_isu" cols="5" rows="5" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="input_lokasi" class="form-label"><?= $bilangan++ ?>) Lokasi Isu:</label>
            <input type="text" name="input_lokasi" id="input_lokasi" class="form-control" required>
            <div class="row g-3 mt-1">
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="form-floating">
                        <input type="text" name="input_latitude" id="input_latitude" placeholder="a) Latitude Lokasi:" class="form-control">
                        <label for="input_latitude" class="form-label">a) Latitude Lokasi:</label>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="form-floating">
                        <input type="text" name="input_longitude" id="input_longitude" placeholder="b) Longitude Lokasi:" class="form-control">
                        <label for="input_longitude" class="form-label">b) Longitude Lokasi:</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="input_cadangan_intervensi" class="form-label"><?= $bilangan++ ?>) Cadangan Intervensi:</label>
            <textarea name="input_cadangan_intervensi" id="input_cadangan_intervensi" cols="10" rows="10" class="form-control"></textarea>
        </div>
        <input type="hidden" name="input_kluster_bil" value="<?= $kluster_isu->kit_bil ?>">
        <input type="hidden" name="input_pengguna_bil" value="<?= $this->session->userdata('pengguna_bil') ?>">
        <button type="submit" class="btn btn-primary w-100">Hantar</button>
    </form>
            </div>
        </div>

    </section>

</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>