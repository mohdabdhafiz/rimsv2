<?php 
$this->load->view('us_lapis_na/susunletak/atas');
$this->load->view('us_lapis_na/susunletak/sidebar');
$this->load->view('us_lapis_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@BENCANA</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('bencana') ?>">RIMS@BENCANA</a></li>
                <li class="breadcrumb-item active">Tambah Laporan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Tambah Laporan</h1>
            <?= form_open('bencana/prosesTambah') ?>
                <div class="form-floating mb-3">
                    <input type="date" id="inputTarikhLaporan" placeholder="Tarikh Laporan:" class="form-control" value="<?= date('Y-m-d') ?>" disabled>
                    <label for="inputTarikhLaporan" class="form-label">Tarikh Laporan:</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="inputPelapor" id="inputPelapor" class="form-control" required>
                        <option value="">Sila Pilih..</option>
                        <?php foreach($senaraiPelapor as $pelapor): ?>
                            <option value="<?= $pelapor->bil ?>"><?= $pelapor->nama_penuh ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="inputPelapor" class="form-label">Pelapor:</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="inputNegeri" id="inputNegeri" class="form-control" required>
                        <option value="">Sila Pilih..</option>
                        <?php foreach($senaraiNegeri as $negeri): ?>
                            <option value="<?= $negeri->nt_bil ?>"><?= $negeri->nt_nama ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="inputNegeri" class="form-label">Negeri:</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="inputDaerah" id="inputDaerah" class="form-control" required>
                        <option value="">Sila Pilih..</option>
                        <?php foreach($senaraiDaerah as $daerah): ?>
                            <option value="<?= $daerah->bil ?>"><?= $daerah->nt_nama ?> - <?= $daerah->nama ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="inputDaerah" class="form-label">Daerah:</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="inputSituasiSemasa" id="inputSituasiSemasa" cols="30" rows="10" class="form-control" style="height:200px;" placeholder="Situasi Semasa:"></textarea>
                    <label for="inputSituasiSemasa" class="form-label">Situasi Semasa:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="inputBilanganPps" id="inputBilanganPps" placeholder="Bilangan PPS:" class="form-control">
                    <label for="inputBilanganPps" class="form-label">Bilangan PPS:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="inputJumlahMangsa" id="inputJumlahMangsa" placeholder="Jumlah Mangsa:" class="form-control">
                    <label for="inputJumlahMangsa" class="form-label">Jumlah Mangsa:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="inputBilanganKematian" id="inputBilanganKematian" placeholder="Bilangan Kematian:" class="form-control">
                    <label for="inputBilanganKematian" class="form-label">Bilangan Kematian:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="inputBilanganHilang" id="inputBilanganHilang" placeholder="Bilangan Hilang:" class="form-control">
                    <label for="inputBilanganHilang" class="form-label">Bilangan Hilang:</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="inputReaksi" id="inputReaksi" class="form-control">
                        <option value="">Sila Pilih..</option>
                        <option value="Positif">Positif</option>
                        <option value="Neutral">Neutral</option>
                        <option value="Negatif">Negatif</option>
                    </select>
                    <label for="inputReaksi" class="form-label">Reaksi Orang Ramai Terhadap Pengurusan Banjir:</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="inputUlasanReaksi" id="inputUlasanReaksi" cols="30" rows="10" class="form-control" placeholder="Ulasan Reaksi Neutral / Negatif:" style="height:200px;"></textarea>
                    <label for="inputUlasanReaksi" class="form-label">Ulasan Reaksi Neutral / Negatif:</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="inputMasalahBerbangkit" id="inputMasalahBerbangkit" cols="30" rows="10" class="form-control" placeholder="Masalah / Isu Berbangkit Semasa Banjir (PPS / Agensi Terlibat):" style="height:200px;"></textarea>
                    <label for="inputMasalahBerbangkit" class="form-label">Masalah / Isu Berbangkit Semasa Banjir (PPS / Agensi Terlibat):</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="inputLokasi" id="inputLokasi" placeholder="Lokasi:" class="form-control">
                    <label for="inputLokasi" class="form-label">Lokasi:</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="inputCadanganIntervensi" id="inputCadanganIntervensi" cols="30" rows="10" class="form-control" placeholder="Cadangan Intervensi:" style="height:200px;"></textarea>
                    <label for="inputCadanganIntervensi" class="form-label">Cadangan Intervensi:</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="inputRumusan" id="inputRumusan" cols="30" rows="10" class="form-control" placeholder="Rumusan:" style="height:200px;"></textarea>
                    <label for="inputRumusan" class="form-label">Rumusan:</label>
                </div>
                <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                <button type="submit" class="btn btn-outline-primary shadow-sm">Simpan</button>
            </form>

        </div>
    </div>

    </section>

</main>


<?php $this->load->view('us_lapis_na/susunletak/bawah'); ?>