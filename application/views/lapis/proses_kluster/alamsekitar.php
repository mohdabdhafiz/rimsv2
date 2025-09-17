<?php $this->load->view('lapis/nav'); ?>

<div class="p-3 border rounded mb-3">
<h2>Kluster Isu: <?= $kluster_isu->kit_nama ?></h2>
    <p><?= $kluster_isu->kit_deskripsi ?></p>
    <?php echo form_open('lapis/proses_alamsekitar'); ?>
        <div class="mb-3">
            <label for="input_tarikh_laporan" class="form-label">1) Tarikh Laporan:</label>
            <input type="date" name="input_tarikh_laporan" id="input_tarikh_laporan" class="form-control">
        </div>
        <div class="mb-3">
            <label for="input_pelapor_bil" class="form-label">2) Pelapor:</label>
            <select name="input_pelapor_bil" id="input_pelapor_bil" class="form-control">
                <option>Sila pilih..</option>
                <?php foreach($senarai_anggota as $pelapor): ?>
                    <option value="<?= $pelapor->bil ?>"><?= $pelapor->nama_penuh ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_parlimen_bil" class="form-label">3) Parlimen:</label>
            <select name="input_parlimen_bil" id="input_parlimen_bil" class="form-control">
                <option>Sila pilih..</option>
                <?php foreach($senarai_parlimen as $parlimen): ?>
                    <option value="<?= $parlimen->pt_bil ?>"><?= $parlimen->pt_nama ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_dun_bil" class="form-label">4) DUN:</label>
            <select name="input_dun_bil" id="input_dun_bil" class="form-control">
                <option>Sila pilih..</option>
                <?php foreach($senarai_dun as $dun): ?>
                    <option value="<?= $dun->dun_bil ?>"><?= $dun->dun_nama ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_kategori" class="form-label">5) Isu:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_kategori" id="flexRadioDefault1" checked>
                <label class="form-check-label" for="flexRadioDefault1">
                    Alam Sekitar (e.g: pencemaran sungai / pembalakan haram..dll)
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="input_kategori" id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">
                    Bencana (e.g: tanah runtuh / banjir / ribut..dll, impak berskala besar)
                </label>
            </div>
        </div>
        <div class="mb-3">
            <label for="input_ringkasan_isu" class="form-label">6) Ringkasan Isu:</label>
            <textarea name="input_ringkasan_isu" id="input_ringkasan_isu" cols="5" rows="5" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="input_lokasi_isu" class="form-label">7) Lokasi Isu:</label>
            <input type="text" name="input_lokasi_isu" id="input_lokasi_isu" class="form-control">
        </div>
        <div class="mb-3">
            <label for="input_implikasi" class="form-label">8) Implikasi (Kesan kepada orang awam/komuniti/negara):</label>
            <textarea name="input_implikasi" id="input_implikasi" cols="5" rows="5" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="input_penyelesaian" class="form-label">9) Cadangan Penyelesaian:</label>
            <textarea name="input_penyelesaian" id="input_penyelesaian" cols="5" rows="5" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="input_agensi" class="form-label">10) Agensi Terlibat:</label>
            <input type="text" name="input_agensi" id="input_agensi" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary w-100">Hantar</button>
    </form>
</div>

