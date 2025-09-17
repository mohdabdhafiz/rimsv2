<?php $this->load->view('lapis/nav'); ?>

<div class="p-3 border rounded mb-3">
    <h2>Kluster Isu: <?= $kluster_isu->kit_nama ?></h2>
    <p><?= $kluster_isu->kit_deskripsi ?></p>
    <?php echo form_open('lapis/proses_kesihatan'); ?>
        <div class="mb-3">
            <label for="input_tarikh_laporan" class="form-label">1) Tarikh Laporan:</label>
            <input type="date" name="input_tarikh_laporan" id="input_tarikh_laporan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="input_pelapor" class="form-label">2) Pelapor:</label>
            <select name="input_pelapor" id="input_pelapor" class="form-control" required>
                <option>Sila pilih..</option>
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
            <label for="input_isu_kesihatan" class="form-label">5) Isu:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_kesihatan" id="input_isu_kesihatan" value="COVID-19">
                <label class="form-check-label" for="input_isu_kesihatan">
                    COVID-19
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_kesihatan" id="input_isu_kesihatan" value="Keracunan makanan">
                <label class="form-check-label" for="input_isu_kesihatan">
                    Keracunan makanan
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_kesihatan" id="input_isu_kesihatan" value="Vaksinasi">
                <label class="form-check-label" for="input_isu_kesihatan">
                    Vaksinasi
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_kesihatan" id="input_isu_kesihatan" value="Lain-lain">
                <label class="form-check-label" for="input_isu_kesihatan">
                    Lain-lain
                    
                </label>
                <textarea name="input_isu_kesihatan_lain" id="input_isu_kesihatan_lain" cols="10" rows="5" class="form-control"></textarea>
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