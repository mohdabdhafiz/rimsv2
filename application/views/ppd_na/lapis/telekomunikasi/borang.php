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

            <!-- Display validation errors -->
            <?= validation_errors() ?>

            <?php echo form_open_multipart('lapis/proses_telekomunikasi'); ?>

            <!-- Bahagian A -->
            <h3>BAHAGIAN A</h3>

            <div class="mb-3">
                <label for="input_tarikh_laporan" class="form-label">1) Tarikh Laporan:</label>
                <input type="date" disabled id="input_tarikh_laporan" class="form-control" value="<?= date('Y-m-d') ?>">
            </div>

            <div class="mb-3">
                <label for="input_pelapor" class="form-label">2) Pelapor:</label>
                <select name="input_pelapor" id="input_pelapor" class="form-control" required>
                    <option value="">Sila pilih..</option>
                    <?php foreach($senarai_anggota as $pelapor): ?>
                        <option value="<?= $pelapor->bil ?>" <?= set_select('input_pelapor', $pelapor->bil) ?>><?= $pelapor->nama_penuh ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="input_daerah" class="form-label">3) Daerah:</label>
                <select name="input_daerah" id="input_daerah" class="form-control" required>
                    <option value="">Sila pilih..</option>
                    <?php foreach($senaraiDaerah as $daerah): ?>
                        <option value="<?= $daerah->bil ?>" <?= set_select('input_daerah', $daerah->bil) ?>><?= $daerah->nama ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="input_parlimen" class="form-label">4) Parlimen:</label>
                <select name="input_parlimen" id="input_parlimen" class="form-control" required>
                    <option value="">Sila pilih..</option>
                    <?php foreach($senarai_parlimen as $parlimen): ?>
                        <option value="<?= $parlimen->pt_bil ?>" <?= set_select('input_parlimen', $parlimen->pt_bil) ?>><?= $parlimen->pt_nama ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <?php if(!empty($senarai_dun)): ?>
                <div class="mb-3">
                    <label for="input_dun" class="form-label">5) DUN:</label>
                    <select name="input_dun" id="input_dun" class="form-control" required>
                        <option value="">Sila pilih..</option>
                        <?php foreach($senarai_dun as $dun): ?>
                            <option value="<?= $dun->dun_bil ?>" <?= set_select('input_dun', $dun->dun_bil) ?>><?= $dun->dun_nama ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>

            <?php if(!empty($senaraiPdm)): ?>
            <div class="mb-3">
            <label for="input_pdm" class="form-label">6) Daerah Mengundi:</label>
            <select name="input_pdm" id="input_pdm" class="form-control">
                <option value="">Sila Pilih..</option>
                <?php foreach($senaraiPdm as $dm): ?>
                <option value="<?= $dm->ppt_bil ?>"><?= $dm->pt_nama ?> - <?= $dm->ppt_nama ?></option>
                <?php endforeach; ?>
            </select>
            </div>
        <?php endif; ?>

            <div class="mb-3">
                <label for="input_jenis_kawasan" class="form-label">7) Jenis Kawasan:</label>
                <select name="input_jenis_kawasan" id="input_jenis_kawasan" class="form-control">
                    <option value="">Sila pilih..</option>
                    <option value="Bandar" <?= set_select('input_jenis_kawasan', 'Bandar') ?>>Bandar</option>
                    <option value="Pinggir Bandar" <?= set_select('input_jenis_kawasan', 'Pinggir Bandar') ?>>Pinggir Bandar</option>
                    <option value="Luar Bandar" <?= set_select('input_jenis_kawasan', 'Luar Bandar') ?>>Luar Bandar</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="input_tajuk_isu" class="form-label">8) Isu:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="input_tajuk_isu" id="input_tajuk_isu_1" value="Rangkaian Internet / Data" <?= set_radio('input_tajuk_isu', 'Rangkaian Internet / Data') ?>>
                    <label class="form-check-label" for="input_tajuk_isu_1">Rangkaian Internet / Data</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="input_tajuk_isu" id="input_tajuk_isu_2" value="Rangkaian Cellular / Cellular Networks" <?= set_radio('input_tajuk_isu', 'Rangkaian Cellular / Cellular Networks') ?>>
                    <label class="form-check-label" for="input_tajuk_isu_2">Rangkaian Cellular / Cellular Networks</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="input_tajuk_isu" id="input_tajuk_isu_3" value="Rangkaian Radio" <?= set_radio('input_tajuk_isu', 'Rangkaian Radio') ?>>
                    <label class="form-check-label" for="input_tajuk_isu_3">Rangkaian Radio</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="input_tajuk_isu" id="input_tajuk_isu_4" value="Rangkaian Televisyen" <?= set_radio('input_tajuk_isu', 'Rangkaian Televisyen') ?>>
                    <label class="form-check-label" for="input_tajuk_isu_4">Rangkaian Televisyen</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="input_ringkasan_isu" class="form-label">9) Keterangan Isu:</label>
                <textarea name="input_ringkasan_isu" id="input_ringkasan_isu" cols="5" rows="5" class="form-control"><?= set_value('input_ringkasan_isu') ?></textarea>
            </div>

            <div class="mb-3">
                <label for="input_lokasi" class="form-label">10) Lokasi Isu:</label>
                <input type="text" name="input_lokasi" id="input_lokasi" class="form-control" value="<?= set_value('input_lokasi') ?>">
                <div class="row g-3 mt-1">
                    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="form-floating">
                            <input type="text" name="input_latitude" id="input_latitude" placeholder="a) Latitude Lokasi:" class="form-control" value="<?= set_value('input_latitude') ?>">
                            <label for="input_latitude" class="form-label">a) Latitude Lokasi:</label>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="form-floating">
                            <input type="text" name="input_longitude" id="input_longitude" placeholder="b) Longitude Lokasi:" class="form-control" value="<?= set_value('input_longitude') ?>">
                            <label for="input_longitude" class="form-label">b) Longitude Lokasi:</label>
                        </div>
                    </div>
                </div>
            </div>

        <div class="mb-3">
            <label for="input_cadangan_intervensi" class="form-label">10) Cadangan Intervensi:</label>
            <textarea name="input_cadangan_intervensi" id="input_cadangan_intervensi" cols="30" rows="10" class="form-control" style="height:200px;"><?= set_value('input_cadangan_intervensi') ?></textarea>
        </div>

            <!-- Bahagian B -->
            <h3>BAHAGIAN B</h3>
            <p class="small text-muted">Dokumen Sokongan Untuk Topik Rangkaian Internet / Data.</p>

            <div class="mb-3">
                <label for="input_mobile" class="form-label">1) Jenis TELCO (DIGI / CELCOM / UNIFI dll.):</label>
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

            <!-- File Upload with Preview -->
            <div class="mb-3">
                <label for="input_gambar" class="form-label">5) Dokumen Sokongan: <span class="text-danger">*</span></label>
                <input 
                    type="file" 
                    name="input_gambar" 
                    id="input_gambar" 
                    class="form-control"  
                    onchange="previewImage(event)" 
                    aria-label="Dokumen Sokongan">
                <img id="imagePreview" src="#" alt="Image Preview" class="img-fluid mt-3 d-none" />
            </div>

            <input type="hidden" name="input_kluster_bil" value="<?= $kluster_isu->kit_bil ?>">
            <input type="hidden" name="input_pengguna_bil" value="<?= $this->session->userdata('pengguna_bil') ?>">

            <div class="text-center">
                <button type="submit" class="btn btn-outline-primary shadow-sm">Hantar</button>
            </div>

            </form>
        </div>
    </div>

</section>

</main>

<script>
    // Preview Image
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

<?php $this->load->view('ppd_na/susunletak/bawah'); ?>
