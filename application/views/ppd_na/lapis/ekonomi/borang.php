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
                <?php echo form_open('lapis/proses_ekonomi'); 
                $bilangan = 1; ?>
        <div class="mb-3">
            <label for="input_tarikh_laporan" class="form-label"><?= $bilangan ++ ?>) Tarikh Laporan:</label>
            <input type="date" id="input_tarikh_laporan" class="form-control" value="<?= date('Y-m-d') ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="input_pelapor" class="form-label"><?= $bilangan ++ ?>) Pelapor:</label>
            <select name="input_pelapor" id="input_pelapor" class="form-control" autofocus required>
                <option>Sila pilih..</option>
                <?php foreach($senarai_anggota as $pelapor): ?>
                    <option value="<?= $pelapor->bil ?>"><?= $pelapor->nama_penuh ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_daerah" class="form-label"><?= $bilangan ++ ?>) Daerah:</label>
            <select name="input_daerah" id="input_daerah" class="form-control" required>
                <option value="">Sila pilih..</option>
                <?php foreach($senaraiDaerah as $daerah): ?>
                    <option value="<?= $daerah->bil ?>"><?= $daerah->nama ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_parlimen" class="form-label"><?= $bilangan++ ?>) Parlimen:</label>
            <select name="input_parlimen" id="input_parlimen" class="form-control" required>
            <option value="">Sila Pilih..</option>
            <?php if (!empty($senaraiParlimen)): ?>
                <?php foreach($senaraiParlimen as $parlimen): ?>
                <option value="<?= $parlimen->pt_bil ?>"><?= $parlimen->pt_nama ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
            </select>
        </div>
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
            <label for="input_kenaikan_barangan[]" class="form-label"><?= $bilangan++ ?>) Kenaikan harga barangan:</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Ayam" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Ayam
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Telur Ayam" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Telur Ayam
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Minyak Masak Botol" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Minyak Masak Botol
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Minyak Masak Paket" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Minyak Masak Paket
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Sayur-sayuran" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Sayur-sayuran
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Ikan" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Ikan
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Daging" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Daging
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Tepung" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Tepung
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Gula" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Gula
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Ubat-ubatan" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Ubat-ubatan
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Petrol" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Petrol
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Kenaikan OPR" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Kenaikan OPR
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Kenaikan harga tambang kapal terbang" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Kenaikan harga tambang kapal terbang
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Kenaikan harga tambang bas" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Kenaikan harga tambang bas
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Kenaikan harga tambang feri" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Kenaikan harga tambang feri
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Kenaikan kos sara hidup" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Kenaikan kos sara hidup
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Kenaikan harga makanan siap dimasak" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Kenaikan harga makanan siap dimasak
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Kenaikan harga baja/racun pertanian" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Kenaikan harga baja/racun pertanian
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Kenaikan harga belajar ambil lesen memandu" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Kenaikan harga belajar ambil lesen memandu
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Lain-lain
                </label>
                <textarea name="input_lain" id="input_lain" cols="5" rows="5" class="form-control"></textarea>
            </div>
        </div>
        <div class="mb-3">
            <label for="input_kurang" class="form-label"><?= $bilangan++ ?>) Isu kekurangan bekalan:</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Ayam" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Ayam
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Telur Ayam" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Telur Ayam
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Minyak Masak Botol" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Minyak Masak Botol
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Minyak Masak Paket" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Minyak Masak Paket
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Sayur-sayuran" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Sayur-sayuran
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Ikan" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Ikan
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Daging" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Daging
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Tepung" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Tepung
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Gula" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Gula
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Ubat-ubatan" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Ubat-ubatan
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Petrol" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Petrol
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Lain-lain
                </label>
                <textarea name="input_kurang_lain" id="input_lain" cols="5" rows="5" class="form-control"></textarea>
            </div>
        </div>
        <div class="mb-3">
            <label for="inputEkonomi" class="form-label"><?= $bilangan++ ?>) Tajuk Isu Lain:</label>
            <textarea name="inputEkonomi" id="inputEkonomi" cols="5" rows="5" class="form-control mb-3"></textarea>
            <ol>
                <li>Kolum ini (Tajuk Isu Lain) bertujuan untuk menghantar isu selain <strong>Kenaikan Harga Barang</strong> dan <strong>Kekurangan Bekalan Barangan</strong>.</li>
                <li>Isu yang dimasukkan ini hendaklah berkait dengan isu kluster ekonomi.</li>
                <li>Sila gunakan ayat yang ringkas. Untuk keterangan isu ini, boleh lah menggunakan kolum <strong>Keterangan Isu</strong> di bawah.</li>
                <li>Rujuk juga bersama penyelia tuan/puan untuk menentukan isu yang dikemukakan adalah berkadaran dengan kluster ekonomi ini.</li>
                <li>Penggunaan kolum ini bermula pada 22 Januari 2024.</li>
            </ol>
        </div>
        <div class="mb-3">
            <label for="input_ringkasan_isu" class="form-label"><?= $bilangan++ ?>) Keterangan Isu:</label>
            <textarea name="input_ringkasan_isu" id="input_ringkasan_isu" cols="5" rows="5" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="input_lokasi" class="form-label"><?= $bilangan++ ?>) Lokasi Isu:</label>
            <input type="text" name="input_lokasi" id="input_lokasi" class="form-control" required>
            <div class="row g-3 mt-1">
            <div class="col-12 col-lg-6 col-md-6">
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
            <textarea name="input_cadangan_intervensi" id="input_cadangan_intervensi" cols="5" rows="5" class="form-control"></textarea>
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