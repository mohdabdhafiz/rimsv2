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

    <a href="<?= site_url('lapis/pilih_kluster') ?>" class="btn btn-outline-info mb-3">Kembali Ke Pilihan Kluster</a>
    
    <section class="section">

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Tambah Laporan Kluster <?= $kluster_isu->kit_nama ?></h1>
                <p><?= $kluster_isu->kit_deskripsi ?></p>
                <?php 
                $nomborSoalan = 1;
                echo form_open('lapis/proses_keselamatan'); ?>
                    <div class="mb-3">
                        <label for="input_tarikh_laporan" class="form-label"><?= $nomborSoalan++ ?>) Masukkan Tarikh Laporan:</label>
                        <input type="date" name="input_tarikh_laporan" id="input_tarikh_laporan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="input_pelapor" class="form-label"><?= $nomborSoalan++ ?>) Pilih Pelapor:</label>
                        <select name="input_pelapor" id="input_pelapor" class="form-control" required>
                            <option value="">Sila pilih..</option>
                            <?php foreach($senarai_anggota as $pelapor): ?>
                                <option value="<?= $pelapor->bil ?>"><?= $pelapor->nama_penuh ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="input_daerah" class="form-label"><?= $nomborSoalan++ ?>) Pilih Daerah:</label>
                        <select name="input_daerah" id="input_daerah" class="form-control" required>
                            <option value="">Sila pilih..</option>
                            <?php foreach($senaraiDaerah as $daerah): ?>
                                <option value="<?= $daerah->bil ?>"><?= $daerah->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <?php if(!empty($senaraiParlimen)): ?>
                        <div class="mb-3">
                            <label for="inputParlimen" class="form-label"><?= $nomborSoalan++ ?>) Pilih Parlimen:</label>
                            <select name="inputParlimen" id="inputParlimen" class="form-control" required>
                                <option value="">Sila pilih..</option>
                                <?php foreach($senaraiParlimen as $parlimen): ?>
                                    <option value="<?= $parlimen->pt_bil ?>"><?= $parlimen->pt_nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($senaraiDun)): ?>
                        <div class="mb-3">
                            <label for="inputDun" class="form-label"><?= $nomborSoalan++ ?>) Pilih DUN:</label>
                            <select name="inputDun" id="inputDun" class="form-control" required>
                                <option value="">Sila pilih..</option>
                                <?php foreach($senaraiDun as $dun): ?>
                                    <option value="<?= $dun->dun_bil ?>"><?= $dun->dun_nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="input_jenis_kawasan" class="form-label"><?= $nomborSoalan++ ?>) Jenis Kawasan:</label>
                        <select name="input_jenis_kawasan" id="input_jenis_kawasan" class="form-control">
                            <option value="">Sila pilih..</option>
                            <option value="Bandar">Bandar</option>
                            <option value="Pinggir Bandar">Pinggir Bandar</option>
                            <option value="Luar Bandar">Luar Bandar</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="inputIsu" class="form-label"><?= $nomborSoalan++ ?>) Isu:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="inputIsu" id="inputIsu" value="3R (Race, Religion, Royalty)">
                            <label class="form-check-label" for="inputIsu">
                                3R (Race, Religion, Royalty)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="inputIsu" id="inputIsu" value="Penipuan atas talian (scammer)">
                            <label class="form-check-label" for="inputIsu">
                                Penipuan atas talian (scammer)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="inputIsu" id="inputIsu" value="Banjir">
                            <label class="form-check-label" for="inputIsu">
                                Banjir
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="inputIsu" id="inputIsu" value="Ribut taufan">
                            <label class="form-check-label" for="inputIsu">
                                Ribut taufan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="inputIsu" id="inputIsu" value="Puting beliung">
                            <label class="form-check-label" for="inputIsu">
                                Puting beliung
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="inputIsu" id="inputIsu" value="Tanah runtuh">
                            <label class="form-check-label" for="inputIsu">
                                Tanah runtuh
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="inputIsu" id="inputIsu" value="Pendatang Tanpa Izin (PATI)">
                            <label class="form-check-label" for="inputIsu">
                                Pendatang Tanpa Izin (PATI)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="inputIsu" id="inputIsu" value="Keselamatan jalan raya">
                            <label class="form-check-label" for="inputIsu">
                                Keselamatan jalan raya
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="inputIsu" id="inputIsu" value="Keselamatan sempadan negara">
                            <label class="form-check-label" for="inputIsu">
                                Keselamatan sempadan negara
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="inputIsu" id="inputIsu" value="Gangguan Haiwan liar berkeliaran">
                            <label class="form-check-label" for="inputIsu">
                                Gangguan Haiwan liar berkeliaran
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="inputIsu" id="inputIsu" value="Lain-lain">
                            <label class="form-check-label" for="inputIsu">
                                Lain-lain
                                
                            </label>
                            <input type="text" name="inputIsuLain" id="inputIsuLain" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="input_ringkasan_isu" class="form-label"><?= $nomborSoalan++ ?>) Ringkasan Isu:</label>
                        <textarea name="input_ringkasan_isu" id="input_ringkasan_isu" cols="5" rows="5" class="form-control"></textarea>
                    </div>
                    <?php
                    $nomborSoalanLokasi = $nomborSoalan++;
                    ?>
                    <div class="mb-3">
                        <label for="input_lokasi_isu" class="form-label"><?= $nomborSoalanLokasi ?>) Lokasi Isu:</label>
                        <input type="text" name="input_lokasi_isu" id="input_lokasi_isu" class="form-control mb-3">
                        <div class="p-3 border rounded">
                            <div class="row g-3">
                                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                                    <label for="inputLatitudeLokasi" class="form-label"><em><?= $nomborSoalanLokasi ?>a) Latitude:</em></label>
                                    <input type="text" name="inputLatitudeLokasi" id="inputLatitudeLokasi" class="form-control">
                                </div>
                                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                                    <label for="inputLongitudeLokasi" class="form-label"><em><?= $nomborSoalanLokasi ?>b) Longitude:</em></label>
                                    <input type="text" name="inputLongitudeLokasi" id="inputLongitudeLokasi" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="inputSemakan" name="inputSemakan" required>
                        <label class="form-check-label" for="inputSemakan">
                            Saya telah membuat semakan dan mendapat kelulusan Pegawai Penerangan Daerah saya untuk menghantar laporan ini.
                        </label>
                        </div>
                    </div>
                    <input type="hidden" name="input_kluster_bil" value="<?= $kluster_isu->kit_bil ?>">
                    <input type="hidden" name="input_pengguna_bil" value="<?= $this->session->userdata('pengguna_bil') ?>">
                    <div class="d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-primary">Hantar</button>
                    </div>
                </form>
            </div>
        </div>

    </section>

</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>