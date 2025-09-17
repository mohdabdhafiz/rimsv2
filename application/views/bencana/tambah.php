<?php 
$this->load->view($header);
$this->load->view($navbar);
$this->load->view($sidebar);
?>


<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@BENCANA</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('bencana') ?>">RIMS@BENCANA</a></li>
                <li class="breadcrumb-item active">Borang Laporan RIMS@BENCANA - Bencana Banjir</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title mb-0">Borang Laporan RIMS@BENCANA - Bencana Banjir</h1>
            <p class="small text-danger"><em>Borang ini mula digunakan setelah "Pusat Pengurusan Bencana Negeri/Daerah" telah dibuka.</em></p>
            <h2 class="text-primary">Maklumat Am</h2>
            <?= form_open('bencana/prosesTambah') ?>
                <div class="mb-3 border rounded p-3">
                    <label for="inputTarikhLaporan" class="form-label">1. Tarikh Laporan:</label>
                    <input type="text" id="inputTarikhLaporan" class="form-control" value="<?= date("Y-m-d") ?>" disabled>
                    <input type="hidden" name="inputTarikhLaporan" value="<?= date("Y-m-d") ?>">
                    <p class="mt-2 mb-0"><em><strong>Deskripsi</strong>: Tarikh Laporan merujuk kepada tarikh laporan ini dihantar oleh pelapor.</em></p>
                </div>
                <div class="mb-3 border rounded p-3">
                    <label for="inputPelapor" class="form-label">2. Pelapor:</label>
                    <input type="text" id="inputPelapor" class="form-control" value="<?= strtoupper($pengguna->nama_penuh) ?>" disabled>
                    <input type="hidden" name="inputPelapor" value="<?= $pengguna->bil ?>">
                    <p class="mt-2 mb-0"><em><strong>Deskripsi</strong>: Pelapor merujuk kepada pelapor yang melaporkan borang ini melalui akaun individu.</em></p>
                </div>
                <div class="mb-3 border rounded p-3">
                    <label for="inputNegeri" class="form-label">3. Negeri:</label>
                    <select name="inputNegeri" id="inputNegeri" class="form-control" required>
                        <option value="">Sila Pilih..</option>
                        <?php foreach($senaraiNegeri as $negeri): ?>
                            <option value="<?= $negeri->nt_bil ?>"><?= $negeri->nt_nama ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p class="mt-2 mb-0"><em><strong>Deskripsi</strong>: Negeri merujuk kepada negeri yang terlibat dalam bencana.</em></p>
                </div>
                <div class="mb-3 border rounded p-3">
                    <label for="inputDaerah" class="form-label">4. Daerah:</label>
                    <select name="inputDaerah" id="inputDaerah" class="form-control" required>
                        <option value="">Sila Pilih..</option>
                        <?php foreach($senaraiDaerah as $daerah): ?>
                            <option value="<?= $daerah->bil ?>"><?= $daerah->nt_nama ?> - <?= $daerah->nama ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p class="mt-2 mb-0"><em><strong>Deskripsi</strong>: Daerah merujuk kepada daerah yang terlibat dalam bencana.</em></p>
                </div>
                <div class="mb-3 border rounded p-3">
                    <label for="inputSituasiSemasa" class="form-label">5. Situasi Semasa:</label>
                    <textarea name="inputSituasiSemasa" id="inputSituasiSemasa" cols="30" rows="10" class="form-control" style="height:200px;"></textarea>
                    <p class="mt-2 mb-0"><em><strong>Deskripsi</strong>: Situasi Semasa merujuk ulasan yang dibuat oleh Pelapor mengenai situasi semasa bencana mengikut perspektif daerah.</em></p>
                </div>
                <div class="mb-3 border rounded p-3">
                    <label for="inputBilanganPps" class="form-label">6. Jumlah Keseluruhan Bilangan PPS:</label>
                    <input type="text" name="inputBilanganPps" id="inputBilanganPps" class="form-control">
                    <p class="mt-2 mb-0"><em><strong>Deskripsi</strong>: Jumlah Keseluruhan Bilangan PPS merujuk bilangan PPS keseluruhan yang sedang dibuka dan didaftarkan dalam Bilik Gerakan Bencana Negeri/Daerah mengikut Daerah.</em></p>
                </div>
                <div class="mb-3 border rounded p-3">
                    <label for="inputJumlahMangsa" class="form-label">7. Jumlah Keseluruhan Mangsa:</label>
                    <input type="text" name="inputJumlahMangsa" id="inputJumlahMangsa" class="form-control">
                    <p class="mt-2 mb-0"><em><strong>Deskripsi</strong>: Jumlah Keseluruhan Mangsa merujuk bilangan keseluruhan mangsa mengikut Daerah.</em></p>
                </div>
                <div class="mb-3 border rounded p-3">
                    <label for="inputBilanganKematian" class="form-label">8. Bilangan Kematian:</label>
                    <input type="text" name="inputBilanganKematian" id="inputBilanganKematian" class="form-control">
                    <p class="mt-2 mb-0"><em><strong>Deskripsi</strong>: Bilangan Kematian merujuk bilangan kematian keseluruhan yang dicatatkan sepanjang Bilik Gerakan Bencana Daerah/Negeri dibuka mengikut Daerah.</em></p>
                </div>
                <div class="mb-3 border rounded p-3">
                    <label for="inputBilanganHilang" class="form-label">9. Bilangan Hilang:</label>
                    <input type="text" name="inputBilanganHilang" id="inputBilanganHilang" placeholder="Bilangan Hilang:" class="form-control">
                    <p class="mt-2 mb-0"><em><strong>Deskripsi</strong>: Bilangan Hilang merujuk bilangan mangsa yang hilang dan tidak dapat dijumpai secara keseluruhan yang dicatatkan sepanjang Bilik Gerakan Bencana Daerah/Negeri dibuka mengikut Daerah.</em></p>
                </div>
                <div class="mb-3">
                    <h2 class="text-primary">Pengurusan dan Pentadbiran Agensi</h2>
                </div>
                <div class="mb-3 p-3 border rounded">
                    <label for="inputReaksi" class="form-label">10. Reaksi Orang Ramai Terhadap Pengurusan Banjir:</label>
                    <select name="inputReaksi" id="inputReaksi" class="form-control">
                        <option value="">Sila Pilih..</option>
                        <option value="Positif">Positif</option>
                        <option value="Neutral">Neutral</option>
                        <option value="Negatif">Negatif</option>
                    </select>
                    <p class="mt-2 mb-0"><em><strong>Deskripsi</strong>: Merujuk kepada sentimen orang ramai terhadap pengurusan banjir oleh agensi-agensi kerajaan.</em></p>
                </div>
                <div class="mb-3 p-3 border rounded">
                    <label for="inputUlasanReaksi" class="form-label">11. Ulasan Reaksi Neutral / Negatif:</label>
                    <textarea name="inputUlasanReaksi" id="inputUlasanReaksi" cols="30" rows="10" class="form-control" style="height:200px;"></textarea>
                    <p class="mt-2 mb-0"><em><strong>Deskripsi</strong>: Merujuk kepada ulasan sentimen orang ramai terhadap pengurusan banjir oleh agensi-agensi kerajaan.</em></p>
                </div>
                <div class="mb-3 p-3 border rounded">
                    <label for="inputMasalahBerbangkit" class="form-label">12. Masalah / Isu Berbangkit Semasa Banjir (PPS / Agensi Terlibat):</label>
                    <textarea name="inputMasalahBerbangkit" id="inputMasalahBerbangkit" cols="30" rows="10" class="form-control" style="height:200px;"></textarea>
                    <p class="mt-2 mb-0"><em><strong>Deskripsi</strong>: Merujuk kepada masalah-masalah atau isu-isu yang timbul semasa bencana banjir melanda di kawasan tersebut.</em></p>
                </div>
                <div class="mb-3 p-3 border rounded">
                    <label for="inputLokasi" class="form-label">13. Lokasi:</label>
                    <input type="text" name="inputLokasi" id="inputLokasi" class="form-control">
                    <p class="mt-2 mb-0"><em><strong>Deskripsi</strong>: Merujuk kepada lokasi-lokasi yang terlibat dengan banjir pada hari tersebut.</em></p>
                </div>
                <div class="mb-3 p-3 border rounded">
                <label for="inputCadanganIntervensi" class="form-label">14. Cadangan Intervensi:</label>
                    <textarea name="inputCadanganIntervensi" id="inputCadanganIntervensi" cols="30" rows="10" class="form-control" style="height:200px;"></textarea>
                    <p class="mt-2 mb-0"><em><strong>Deskripsi</strong>: Merujuk kepada rumusan dapatan cadangan intervensi yang dibuat oleh pelapor berdasarkan pendapat-pendapat orang ramai.</em></p>
                </div>
                <div class="mb-3 p-3 border rounded">
                    <label for="inputRumusan" class="form-label">15. Rumusan:</label>
                    <textarea name="inputRumusan" id="inputRumusan" cols="30" rows="10" class="form-control" style="height:200px;"></textarea>
                    <p class="mt-2 mb-0"><em><strong>Deskripsi</strong>: Merujuk kepada rumusan yang dibuat oleh pelapor pada hari yang berkenaan.</em></p>
                </div>
                <input type="hidden" name="inputJenisBencana" value="Banjir">
                <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-primary shadow-sm">Simpan dan Seterusnya</button>
                    <p class="mt-2 mb-0"><em>Klik "Simpan dan Seterusnya" untuk menyimpan laporan ini dan menunggu untuk pengesahan oleh Pegawai Pengesah.</em></p>
                </div>
            </form>


        </div>
    </div>

    </section>

</main>


<?php $this->load->view($footer); ?>