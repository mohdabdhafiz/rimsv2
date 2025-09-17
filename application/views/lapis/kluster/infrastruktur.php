<?php $this->load->view('lapis/nav'); ?>

<div class="p-3 border rounded mb-3">
    <h2>Kluster Isu: <?= $kluster_isu->kit_nama ?></h2>
    <p><?= $kluster_isu->kit_deskripsi ?></p>
    <?php echo form_open('lapis/proses_infrastruktur'); ?>
        <div class="mb-3">
            <label for="input_tarikh_laporan" class="form-label">1) Tarikh Laporan:</label>
            <input type="date" name="input_tarikh_laporan" id="input_tarikh_laporan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="input_pelapor" class="form-label">2) Pelapor:</label>
            <select name="input_pelapor" id="input_pelapor" class="form-control" required>
                <option value="">Sila pilih..</option>
                <?php foreach($senarai_anggota as $pelapor): ?>
                    <option value="<?= $pelapor->bil ?>"><?= $pelapor->nama_penuh ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_daerah" class="form-label">3) Daerah:</label>
            <select name="input_daerah" id="input_daerah" class="form-control" required>
                <option value="">Sila pilih..</option>
                <?php foreach($senaraiDaerah as $daerah): ?>
                <option value="<?= $daerah->bil ?>"><?= $daerah->nama ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_jenis_kawasan" class="form-label">4) Jenis Kawasan:</label>
            <select name="input_jenis_kawasan" id="input_jenis_kawasan" class="form-control">
                <option value="">Sila pilih..</option>
                <option value="Bandar">Bandar</option>
                <option value="Pinggir Bandar">Pinggir Bandar</option>
                <option value="Luar Bandar">Luar Bandar</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_isu_infrastruktur" class="form-label">5) Isu:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_infrastruktur" id="input_isu_infrastruktur" value="Bekalan Air">
                <label class="form-check-label" for="input_isu_infrastruktur">
                    Bekalan Air <br>
                    <em class="small text-muted">Tekanan air rendah, tiada bekalan air, air kotor dll</em>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_infrastruktur" id="input_isu_infrastruktur" value="Bekalan Elektrik">
                <label class="form-check-label" for="input_isu_infrastruktur">
                    Bekalan Elektrik <br>
                    <em class="small text-muted">Bekalan elektrik sering terputus, tiada bekalan elektrik</em>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_infrastruktur" id="input_isu_infrastruktur" value="Pengurusan Sisa Pepejal dan Air Sisa">
                <label class="form-check-label" for="input_isu_infrastruktur">
                    Pengurusan Sisa Pepejal dan Air Sisa <br>
                    <em class="small text-muted">Pengurusan sampah, pungutan tidak mengikut jadual</em>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_infrastruktur" id="input_isu_infrastruktur" value="Tambah Baik Perkhidmatan">
                <label class="form-check-label" for="input_isu_infrastruktur">
                    Tambah Baik Perkhidmatan<br>
                    <em class="small text-muted">Masa menunggu di klinik, Waktu temu janji, isu pemilikan tanah, perebutan tanah, tuntutan yang bertindih</em>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_infrastruktur" id="input_isu_infrastruktur" value="Bangunan Awam">
                <label class="form-check-label" for="input_isu_infrastruktur">
                    Bangunan Awam<br>
                    <em class="text-muted small">Bangunan awam adalah merujuk kepada bangunan kompleks pejabat kerajaan, sekolah dan semua institusi berkaitan dengan latihan, pengajaran dan pembelajaran, masjid</em>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_infrastruktur" id="input_isu_infrastruktur" value="Garisan Jalan">
                <label class="form-check-label" for="input_isu_infrastruktur">
                    Garisan Jalan<br>
                    <em class="text-muted small">Cat garisan jalan pudar, garisan jalan berbeza bertindih</em>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_infrastruktur" id="input_isu_infrastruktur" value="Jalan Raya">
                <label class="form-check-label" for="input_isu_infrastruktur">
                    Jalan Raya<br>
                    <em class="text-muted small">Jalan raya rosak, berlubang dan berlopak, permukaan jalan yang melendut</em>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_infrastruktur" id="input_isu_infrastruktur" value="Jambatan">
                <label class="form-check-label" for="input_isu_infrastruktur">
                    Jambatan<br>
                    <em class="small text-muted">Jambatan retak, tidak selamat, kelewatan pembinaan jambatan baharu, projek tergendala</em>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_infrastruktur" id="input_isu_infrastruktur" value="Kereta Tersadai">
                <label class="form-check-label" for="input_isu_infrastruktur">
                    Kereta Tersadai<br>
                    <em class="small text-muted">Mencacatkan pemandangan, menyusahkan penduduk setempat lebih-lebih lagi di kawasan yang kekurangan petak parkir</em>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_infrastruktur" id="input_isu_infrastruktur" value="Landskap">
                <label class="form-check-label" for="input_isu_infrastruktur">
                    Landskap<br>
                    <em class="text-muted small">Pokok tumbang, dahan pokok halang pandangan, akar pokok timbul dan pecakan lantau</em>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_infrastruktur" id="input_isu_infrastruktur" value="Lampu Jalan">
                <label class="form-check-label" for="input_isu_infrastruktur">
                    Lampu Jalan<br>
                    <em class="small text-muted">Lampu jalan dipasang di pembahagi jalan tidak bernyala, lampu jalan tidak berfungsi</em>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_infrastruktur" id="input_isu_infrastruktur" value="Lampu Isyarat">
                <label class="form-check-label" for="input_isu_infrastruktur">
                    Lampu Isyarat<br>
                    <em class="text-muted small">Lampu isyarat rosak/hilang/tidak berfungsi</em>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_infrastruktur" id="input_isu_infrastruktur" value="Longkang/Parit">
                <label class="form-check-label" for="input_isu_infrastruktur">
                    Longkang/Parit<br>
                    <em class="text-muted small">Tersumbat, tidak diselenggara, cerun</em>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_infrastruktur" id="input_isu_infrastruktur" value="Papan Tanda">
                <label class="form-check-label" for="input_isu_infrastruktur">
                    Papan Tanda<br>
                    <em class="text-muted small">Lokasi tidak strategik, papan tanda usang</em>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_infrastruktur" id="input_isu_infrastruktur" value="Parkir">
                <label class="form-check-label" for="input_isu_infrastruktur">
                    Parkir<br>
                    <em class="text-muted small">Kekurangan petak parkir, caj parkir tanpa tunai, cop parkir, guna parkir untuk berniaga dll</em>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_infrastruktur" id="input_isu_infrastruktur" value="Pengangkutan Awam">
                <label class="form-check-label" for="input_isu_infrastruktur">
                    Pengangkutan Awam<br>
                    <em class="text-muted small">Tambah baik perkhidmatan bas, teksi, lrt, mrt, tambang penerbangan mahal, jadual penerbangan tertunda banyak kali dll</em>
                </label>
            </div>

            
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_infrastruktur" id="input_isu_infrastruktur" value="Lain-lain">
                <label class="form-check-label" for="input_isu_infrastruktur">
                    Lain-lain
                </label>
                <textarea name="input_isu_infrastruktur_lain" id="input_isu_infrastruktur_lain" cols="10" rows="5" class="form-control"></textarea>
            </div>
        </div>
        <div class="mb-3">
            <label for="input_ringkasan_isu" class="form-label">6) Keterangan Isu:</label>
            <textarea name="input_ringkasan_isu" id="input_ringkasan_isu" cols="5" rows="5" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="input_lokasi_isu" class="form-label">7) Lokasi Isu:</label>
            <input type="text" name="input_lokasi_isu" id="input_lokasi_isu" class="form-control">
        </div>
        <input type="hidden" name="input_kluster_bil" value="<?= $kluster_isu->kit_bil ?>">
        <input type="hidden" name="input_pengguna_bil" value="<?= $this->session->userdata('pengguna_bil') ?>">
        <button type="submit" class="btn btn-primary w-100">Hantar</button>
    </form>
</div>