<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LPK</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">UTAMA</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('sentimen') ?>">RIMS@LPK</a></li>
                <li class="breadcrumb-item active">BORANG LAPORAN PERSEPSI TERHADAP KERAJAAN</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">BORANG LAPORAN PERSEPSI TERHADAP KERAJAAN</h5>
            <?= validation_errors() ?>
            <?= form_open('sentimen/prosesTambah') ?>
            <div class="form-floating mb-3">
                <input type="date" name="inputTarikhLaporan" id="inputTarikhLaporan" class="form-control" value="<?= set_value('inputTarikhLaporan') ?>" required>
                <label for="inputTarikhLaporan" class="form-label">Tarikh Laporan</label>
            </div>
            <div class="form-floating mb-3">
                <select name="inputPelaporBil" id="inputPelaporBil" class="form-control" required>
                    <option value="">Sila pilih..</option>
                    <?php foreach($senaraiPelapor as $pelapor): ?>
                        <option value="<?= $pelapor->bil ?>"><?= $pelapor->nama_penuh ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="inputPelaporBil" class="form-label">Pelapor</label>
            </div>
            <div class="form-floating mb-3">
                <select name="inputDaerahBil" id="inputDaerahBil" class="form-control" required>
                    <option value="">Sila pilih..</option>
                    <?php foreach($senaraiDaerah as $daerah): ?>
                        <option value="<?= $daerah->bil ?>"><?= $daerah->nama ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="inputDaerahBil" class="form-label">Daerah</label>
            </div>
            <?php if(!empty($senaraiParlimen)): ?>
            <div class="form-floating mb-3">
                <select name="inputParlimenBil" id="inputParlimenBil" class="form-control">
                    <option value="">Sila pilih..</option>
                    <?php foreach($senaraiParlimen as $parlimen): ?>
                        <option value="<?= $parlimen->pt_bil ?>"><?= $parlimen->pt_nama ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="inputParlimenBil" class="form-label">Parlimen</label>
            </div>
            <?php endif; ?>
            <?php if(!empty($senaraiDun)): ?>
            <div class="form-floating mb-3">
                <select name="inputDunBil" id="inputDunBil" class="form-control">
                    <option value="">Sila pilih..</option>
                    <?php foreach($senaraiDun as $dun): ?>
                        <option value="<?= $dun->dun_bil ?>"><?= $dun->dun_nama ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="inputDunBil" class="form-label">DUN</label>
            </div>
            <?php endif; ?>
            <div class="form-floating mb-3">
                <select name="inputKawasan" id="inputKawasan" class="form-control">
                    <option value="">Sila pilih..</option>
                    <option value="Bandar">Bandar</option>
                    <option value="Pinggir Bandar">Pinggir Bandar</option>
                    <option value="Luar Bandar">Luar Bandar</option>
                </select>
                <label for="inputKawasan" class="form-label">Kawasan</label>
            </div>

            <div class="mb-3">
                <label for="inputPekerjaan" class="form-label">Demografi Latar Belakang Pekerjaan</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputPekerjaan" id="inputPekerjaan1" value="" checked="">
                    <label class="form-check-label" for="inputPekerjaan1">
                        Sila pilih..
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputPekerjaan" id="inputPekerjaan2" value="OBP">
                    <label class="form-check-label" for="inputPekerjaan2">
                        OBP
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputPekerjaan" id="inputPekerjaan3" value="Pengurusan & Professional">
                    <label class="form-check-label" for="inputPekerjaan3">
                        Pengurusan & Professional
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputPekerjaan" id="inputPekerjaan3" value="Pekerja Swasta">
                    <label class="form-check-label" for="inputPekerjaan3">
                        Pekerja Swasta
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputPekerjaan" id="inputPekerjaan4" value="Pendidik">
                    <label class="form-check-label" for="inputPekerjaan4">
                        Pendidik
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputPekerjaan" id="inputPekerjaan5" value="Petani">
                    <label class="form-check-label" for="inputPekerjaan5">
                        Petani
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputPekerjaan" id="inputPekerjaan6" value="Peniaga">
                    <label class="form-check-label" for="inputPekerjaan6">
                        Peniaga
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputPekerjaan" id="inputPekerjaan7" value="Pembekal">
                    <label class="form-check-label" for="inputPekerjaan7">
                        Pembekal
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputPekerjaan" id="inputPekerjaan8" value="Pengguna">
                    <label class="form-check-label" for="inputPekerjaan8">
                        Pengguna
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputPekerjaan" id="inputPekerjaan9" value="Remaja">
                    <label class="form-check-label" for="inputPekerjaan9">
                        Remaja
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputPekerjaan" id="inputPekerjaan10" value="Suri rumah">
                    <label class="form-check-label" for="inputPekerjaan10">
                       Suri rumah 
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputPekerjaan" id="inputPekerjaan11" value="Kerja sendiri">
                    <label class="form-check-label" for="inputPekerjaan11">
                        Kerja sendiri
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputPekerjaan" id="inputPekerjaan12" value="Penguatkuasa">
                    <label class="form-check-label" for="inputPekerjaan12">
                        Penguatkuasa
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputPekerjaan" id="inputPekerjaan13" value="Pelajar">
                    <label class="form-check-label" for="inputPekerjaan13">
                        Pelajar
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputPekerjaan" id="inputPekerjaan14" value="Tidak bekerja">
                    <label class="form-check-label" for="inputPekerjaan14">
                        Tidak bekerja
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputPekerjaan" id="inputPekerjaan15" value="Lain-lain">
                    <label class="form-check-label" for="inputPekerjaan15">
                        Lain-lain (Nyatakan)
                    </label>
                    <input type="text" name="inputPekerjaanLain" id="inputPekerjaanLain" class="form-control mt-1" placeholder="Lain-lain (Nyatakan)">
                </div>
            </div>
            <div class="form-floating mb-3">
                <select name="inputUmur" id="inputUmur" class="form-control">
                    <option value="">Sila pilih..</option>
                    <option value="20 tahun ke bawah">20 tahun ke bawah</option>
                    <option value="21-30">21-30</option>
                    <option value="31-40">31-40</option>
                    <option value="41-50">41-50</option>
                    <option value="51-60">51-60</option>
                    <option value="61 tahun ke atas">61 tahun ke atas</option>
                </select>
                <label for="inputUmur" class="form-label">Julat Umur</label>
            </div>
            <div class="mb-3">
                <label for="inputKaum" class="form-label">Kaum</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputKaum" id="inputKaum1" value="" checked="">
                    <label class="form-check-label" for="inputKaum1">
                        Sila pilih..
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputKaum" id="inputKaum2" value="Melayu">
                    <label class="form-check-label" for="inputKaum2">
                        Melayu
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputKaum" id="inputKaum3" value="Cina">
                    <label class="form-check-label" for="inputKaum3">
                        Cina
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputKaum" id="inputKaum4" value="India">
                    <label class="form-check-label" for="inputKaum4">
                        India
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputKaum" id="inputKaum5" value="Bumiputra Sarawak">
                    <label class="form-check-label" for="inputKaum5">
                        Bumiputra Sarawak
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputKaum" id="inputKaum6" value="Bumiputra Sabah">
                    <label class="form-check-label" for="inputKaum6">
                        Bumiputra Sabah
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputKaum" id="inputKaum7" value="Orang Asli">
                    <label class="form-check-label" for="inputKaum7">
                        Orang Asli
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="inputKaum" id="inputKaum8" value="Lain-lain">
                    <label class="form-check-label" for="inputKaum8">
                        Lain-lain (Nyatakan)
                    </label>
                    <input type="text" name="inputKaumLain" id="inputKaumLain" class="form-control" placeholder="Lain-lain (Nyatakan)">
                </div>
            </div>
            <div class="form-floating mb-3">
                <select name="inputJantina" id="inputJantina" class="form-control">
                    <option value="">Sila pilih..</option>
                    <option value="Lelaki">Lelaki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <label for="inputJantina" class="form-label">Jantina</label>
            </div>

            <div class="form-floating mb-3">
                <select name="inputSentimen" id="inputSentimen" class="form-control" required>
                    <option value="">Sila pilih..</option>
                    <option value="Positif">Teruja</option>
                    <option value="Positif">Gembira</option>
                    <option value="Positif">Senang Hati</option>
                    <option value="Positif">Bersyukur</option>
                    <option value="Neutral">Okey</option>
                    <option value="Negatif">Kecewa</option>
                    <option value="Negatif">Sedih</option>
                    <option value="Negatif">Risau</option>
                    <option value="Neutral">Tidak Peduli</option>
                    <option value="Negatif">Tidak Puas Hati</option>
                </select>
                <label for="inputSentimen" class="form-label">Apakah perasaan anda terhadap pentadbiran Kerajaan Persekutuan?</label>
            </div>
            <div class="form-floating mb-3">
                <select name="inputJenisPersepsi" id="inputJenisPersepsi" class="form-control" required>
                    <option value="">Sila pilih..</option>
                    <option value="Pentadbiran Kerajaan">Pentadbiran Kerajaan</option>
                    <option value="Inisiatif / Insentif / Subsidi">Inisiatif / Insentif / Subsidi</option>
                    <option value="Isu Semasa">Isu Semasa</option>
                </select>
                <label for="inputJenisPersepsi" class="form-label">Perkara<span class="text-danger">*</span></label>
            </div>
            <div class="form-floating mb-3">
                <textarea name="inputAlasan" id="inputAlasan" cols="5" rows="10" class="form-control" placeholder="Alasan" style="height:200px;" required></textarea>
                <label for="inputAlasan" class="form-label">Sila nyatakan alasan anda</label>
            </div>

            <hr class="my-4">
            <!--  SENTIMEN TERHADAP ISU SEMASA  -->

        <h5 class="text-primary">Penilaian Sentimen Terhadap Isu Semasa</h5>
        <p class="mb-4">Pilih sentimen bagi setiap isu yang disenaraikan di bawah dan berikan ulasan anda.</p>
            
            <?php
            foreach($senaraiIsu as $isu):
            ?>

<div class="border rounded p-3 mb-3">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <label for="isu-group-<?= $isu->id ?>" class="form-label"><strong><?= $isu->nama ?></strong></label>
                </div>
                <div class="col-md-8">
                    <div class="btn-group w-100" role="group" aria-label="Sentimen untuk <?= $isu->nama ?>" id="isu-group-<?= $isu->id ?>">
                        
                        <input type="radio" class="btn-check" name="inputIsu[<?= $isu->id ?>]" id="isu<?= $isu->id ?>-positif" value="Positif" autocomplete="off" required>
                        <label class="btn btn-outline-success" for="isu<?= $isu->id ?>-positif"><i class="bi bi-hand-thumbs-up me-2"></i>Positif</label>
                        
                        <input type="radio" class="btn-check" name="inputIsu[<?= $isu->id ?>]" id="isu<?= $isu->id ?>-neutral" value="Neutral" autocomplete="off" required>
                        <label class="btn btn-outline-warning" for="isu<?= $isu->id ?>-neutral"><i class="bi bi-circle me-2"></i>Neutral</label>

                        <input type="radio" class="btn-check" name="inputIsu[<?= $isu->id ?>]" id="isu<?= $isu->id ?>-negatif" value="Negatif" autocomplete="off" required>
                        <label class="btn btn-outline-danger" for="isu<?= $isu->id ?>-negatif"><i class="bi bi-hand-thumbs-down me-2"></i>Negatif</label>

                    </div>
                </div>
                <div class="col-12">
                    <textarea name="inputAlasanIsu[<?= $isu->id ?>]" id="inputAlasanIsu[<?= $isu->id ?>]" class="form-control mt-3" placeholder="Sila berikan ulasan atau alasan lanjut mengenai pilihan sentimen anda terhadap isu ini... (Maksimum 250 patah perkataan)" style="height: 100px"></textarea>
                </div>
            </div>
</div>

            <?php endforeach; ?>
            
            <hr class="my-4">

            <div class="row mb-3">
                <label for="inputIsuAlasan" class="form-label"><strong>Ulasan Sentimen</strong></label>
                <div class="col-sm-12">
                    <textarea name="inputIsuAlasan" id="inputIsuAlasan" class="form-control" style="height: 150px" placeholder="Berikan pandangan atau ulasan lanjut mengenai pilihan sentimen anda terhadap isu-isu di atas..."></textarea>
                </div>
            </div>


</div>

            <div class="text-center mt-4">
                <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                <input type="hidden" name="inputPenggunaWaktu" value="<?= date('Y-m-d H:i:s') ?>">
                <button type="submit" class="btn btn-primary"><i class="bi bi-send-fill me-2"></i>Hantar Penilaian</button>
                <button type="reset" class="btn btn-secondary">Set Semula</button>
            </div>

            </form>
        </div>


    </section>

</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>