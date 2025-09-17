<?php $this->load->view('lapis/nav'); ?>

<div class="p-3 border rounded mb-3">
    <h2>Kluster Isu: <?= $kluster_isu->kit_nama ?></h2>
    <p><?= $kluster_isu->kit_deskripsi ?></p>
    <?= validation_errors() ?>
    <?php echo form_open_multipart('lapis/proses_telekomunikasi'); ?>
    <h3>BAHAGIAN A</h3>
        <div class="mb-3">
            <label for="input_tarikh_laporan" class="form-label">1) Tarikh Laporan:</label>
            <input type="date" id="input_tarikh_laporan" class="form-control" value="<?= date('Y-m-d') ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="input_pelapor" class="form-label">2) Pelapor:</label>
            <select name="input_pelapor" id="input_pelapor" class="form-control">
                <option value="">Sila pilih..</option>
                <?php foreach($senarai_anggota as $pelapor): ?>
                    <option value="<?= $pelapor->bil ?>" <?php if($pelapor->bil == set_value('input_pelapor')){ echo "selected"; } ?>><?= $pelapor->nama_penuh ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_daerah" class="form-label">3) Daerah:</label>
            <select name="input_daerah" id="input_daerah" class="form-control">
                <option value="">Sila pilih..</option>
                <?php foreach($senaraiDaerah as $daerah): ?>
                    <option value="<?= $daerah->bil ?>" <?php if($daerah->bil == set_value('input_daerah')){ echo "selected"; } ?>><?= $daerah->nama ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_parlimen" class="form-label">4) Parlimen:</label>
            <select name="input_parlimen" id="input_parlimen" class="form-control">
                <option value="">Sila pilih..</option>
                <?php foreach($senarai_parlimen as $parlimen): ?>
                    <option value="<?= $parlimen->pt_bil ?>" <?php if($parlimen->pt_bil == set_value('input_parlimen')){ echo "selected"; } ?>><?= $parlimen->pt_nama ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_dun" class="form-label">5) DUN:</label>
            <select name="input_dun" id="input_dun" class="form-control">
                <option value="">Sila pilih..</option>
                <?php foreach($senarai_dun as $dun): ?>
                    <option value="<?= $dun->dun_bil ?>" <?php if($dun->dun_bil == set_value('input_dun')){ echo "selected"; } ?>><?= $dun->dun_nama ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_jenis_kawasan" class="form-label">6) Jenis Kawasan:</label>
            <select name="input_jenis_kawasan" id="input_jenis_kawasan" class="form-control">
                <option value="">Sila pilih..</option>
                <option value="Bandar" <?php if('Bandar' == set_value('input_jenis_kawasan')){ echo "selected"; } ?>>Bandar</option>
                <option value="Pinggir Bandar" <?php if('Pinggir Bandar' == set_value('input_jenis_kawasan')){ echo "selected"; } ?>>Pinggir Bandar</option>
                <option value="Luar Bandar" <?php if('Luar Bandar' == set_value('input_jenis_kawasan')){ echo "selected"; } ?>>Luar Bandar</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_isu_telekomunikasi" class="form-label">7) Isu:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_telekomunikasi" id="input_isu_telekomunikasi" value="Rangkaian Internet / Data" <?php if('Rangkaian Internet / Data' == set_value('input_isu_telekomunikasi')){ echo "selected"; } ?>>
                <label class="form-check-label" for="input_isu_telekomunikasi">
                    Rangkaian Internet / Data
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_telekomunikasi" id="input_isu_telekomunikasi" value="Rangkaian Cellular / Cellular Networks" <?php if('Rangkaian Cellular / Cellular Networks' == set_value('input_isu_telekomunikasi')){ echo "selected"; } ?>>
                <label class="form-check-label" for="input_isu_telekomunikasi">
                    Rangkaian Cellular / Cellular Networks
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_telekomunikasi" id="input_isu_telekomunikasi" value="Rangkaian Radio" <?php if('Rangkaian Radio' == set_value('input_isu_telekomunikasi')){ echo "selected"; } ?>>
                <label class="form-check-label" for="input_isu_telekomunikasi">
                    Rangkaian Radio
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_telekomunikasi" id="input_isu_telekomunikasi" value="Rangkaian Televisyen" <?php if('Rangkaian Televisyen' == set_value('input_isu_telekomunikasi')){ echo "selected"; } ?>>
                <label class="form-check-label" for="input_isu_telekomunikasi">
                    Rangkaian Televisyen
                </label>
            </div>
        </div>
        <div class="mb-3">
            <label for="input_ringkasan_isu" class="form-label">8) Keterangan Isu:</label>
            <textarea name="input_ringkasan_isu" id="input_ringkasan_isu" cols="5" rows="5" class="form-control"><?= set_value('input_ringkasan_isu') ?></textarea>
        </div>
        <div class="mb-3">
            <label for="input_lokasi_isu" class="form-label">9) Lokasi Isu:</label>
            <input type="text" name="input_lokasi_isu" id="input_lokasi_isu" class="form-control" value="<?= set_value('input_lokasi_isu') ?>">
        </div>

        <h3>BAHAGIAN B</h3>
        <p class="small text-muted">Dokumen Sokongan Untuk Topik Rangkaian Internet / Data.</p>

        <div class="mb-3">
            <label for="input_mobile" class="form-label">1) Jenis TELCO (DIGI / CELCOM / UNIFI DLL.):</label>
            <input type="text" name="input_mobile" id="input_mobile" class="form-control" value="<?= set_value('input_mobile') ?>">
        </div>

        <div class="mb-3">
            <label for="input_download" class="form-label">2) Download Rate (Mbps):</label>
            <input type="text" name="input_download" id="input_download" class="form-control" value='<?= set_value('input_download') ?>'>
        </div>

        <div class="mb-3">
            <label for="input_upload" class="form-label">3) Upload Rate (Mbps):</label>
            <input type="text" name="input_upload" id="input_upload" class="form-control" value="<?= set_value('input_upload') ?>">
        </div>

        <div class="mb-3">
            <label for="input_ping" class="form-label">4) Ping Rate (ms):</label>
            <input type="text" name="input_ping" id="input_ping" class="form-control" value="<?= set_value('input_ping') ?>">
        </div>

        <div class="mb-3">
            <label for="input_gambar" class="form-label">5) Dokumen Sokongan:</label>
            <input type="file"
       id="input_gambar" name="input_gambar"
       accept="image/png, image/jpeg" class="form-control">
        </div>
        

        <input type="hidden" name="input_kluster_bil" value="<?= $kluster_isu->kit_bil ?>">
        <input type="hidden" name="input_pengguna_bil" value="<?= $this->session->userdata('pengguna_bil') ?>">
        <div class="text-center">
        <button type="submit" class="btn btn-outline-primary shadow-sm">Hantar</button>
        </div>
    </form>
</div>