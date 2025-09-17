<?php $this->load->view('lapis/nav'); ?>

<div class="p-3 border rounded mb-3">
    <h2>Kluster Isu: <?= $kluster_isu->kit_nama ?></h2>
    <p><?= $kluster_isu->kit_deskripsi ?></p>
    <?php echo form_open('lapis/proses_keselamatan'); ?>
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
            <label for="input_daerah" class="form-label">5) Daerah:</label>
            <select name="input_daerah" id="input_daerah" class="form-control" required>
                <option value="">Sila pilih..</option>
                <?php foreach($senaraiDaerah as $daerah): ?>
                    <option value="<?= $daerah->bil ?>"><?= $daerah->nama ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_jenis_kawasan" class="form-label">6) Jenis Kawasan:</label>
            <select name="input_jenis_kawasan" id="input_jenis_kawasan" class="form-control">
                <option value="">Sila pilih..</option>
                <option value="Bandar">Bandar</option>
                <option value="Pinggir Bandar">Pinggir Bandar</option>
                <option value="Luar Bandar">Luar Bandar</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_isu_keselamatan" class="form-label">7) Isu:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_keselamatan" id="input_isu_keselamatan" value="3R (Race, Religion, Royalty)">
                <label class="form-check-label" for="input_isu_keselamatan">
                    3R (Race, Religion, Royalty)
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_keselamatan" id="input_isu_keselamatan" value="Penipuan atas talian (scammer)">
                <label class="form-check-label" for="input_isu_keselamatan">
                    Penipuan atas talian (scammer)
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_keselamatan" id="input_isu_keselamatan" value="Banjir">
                <label class="form-check-label" for="input_isu_keselamatan">
                    Banjir
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_keselamatan" id="input_isu_keselamatan" value="Ribut taufan">
                <label class="form-check-label" for="input_isu_keselamatan">
                    Ribut taufan
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_keselamatan" id="input_isu_keselamatan" value="Puting beliung">
                <label class="form-check-label" for="input_isu_keselamatan">
                    Puting beliung
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_keselamatan" id="input_isu_keselamatan" value="Tanah runtuh">
                <label class="form-check-label" for="input_isu_keselamatan">
                    Tanah runtuh
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_keselamatan" id="input_isu_keselamatan" value="Pendatang Tanpa Izin (PATI)">
                <label class="form-check-label" for="input_isu_keselamatan">
                    Pendatang Tanpa Izin (PATI)
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_keselamatan" id="input_isu_keselamatan" value="Keselamatan jalan raya">
                <label class="form-check-label" for="input_isu_keselamatan">
                    Keselamatan jalan raya
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_keselamatan" id="input_isu_keselamatan" value="Keselamatan sempadan negara">
                <label class="form-check-label" for="input_isu_keselamatan">
                    Keselamatan sempadan negara
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_keselamatan" id="input_isu_keselamatan" value="Gangguan Haiwan liar berkeliaran">
                <label class="form-check-label" for="input_isu_keselamatan">
                    Gangguan Haiwan liar berkeliaran
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_keselamatan" id="input_isu_keselamatan" value="Lain-lain">
                <label class="form-check-label" for="input_isu_keselamatan">
                    Lain-lain
                    
                </label>
                <textarea name="input_isu_keselamatan_lain" id="input_isu_keselamatan_lain" cols="10" rows="5" class="form-control"></textarea>
            </div>
        </div>
        <div class="mb-3">
            <label for="input_ringkasan_isu" class="form-label">8) Ringkasan Isu:</label>
            <textarea name="input_ringkasan_isu" id="input_ringkasan_isu" cols="5" rows="5" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="input_lokasi_isu" class="form-label">9) Lokasi Isu:</label>
            <input type="text" name="input_lokasi_isu" id="input_lokasi_isu" class="form-control">
        </div>
        <input type="hidden" name="input_kluster_bil" value="<?= $kluster_isu->kit_bil ?>">
        <input type="hidden" name="input_pengguna_bil" value="<?= $this->session->userdata('pengguna_bil') ?>">
        <button type="submit" class="btn btn-primary w-100">Hantar</button>
    </form>
</div>