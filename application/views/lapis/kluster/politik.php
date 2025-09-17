<?php $this->load->view('lapis/nav'); ?>

<div class="p-3 border rounded mb-3">
    <h2>Kluster Isu: <?= $kluster_isu->kit_nama ?></h2>
    <p><?= $kluster_isu->kit_deskripsi ?></p>
    <?= validation_errors() ?>
    <?php echo form_open('lapis/proses_politik');
    $bilangan = 1;
    ?>
        <div class="mb-3">
            <label for="input_tarikh_laporan" class="form-label"><?= $bilangan++ ?>) Tarikh Laporan:</label>
            <input type="date" id="input_tarikh_laporan" class="form-control" value="<?= date('Y-m-d') ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="input_pelapor" class="form-label"><?= $bilangan++ ?>) Pelapor:</label>
            <select name="input_pelapor" id="input_pelapor" class="form-control" required>
                <option value="">Sila pilih..</option>
                <?php foreach($senarai_anggota as $pelapor): ?>
                    <option value="<?= $pelapor->bil ?>"><?= $pelapor->nama_penuh ?></option>
                <?php endforeach; ?>
            </select>
        </div>


        <?php
        if(empty($senaraiDaerah)){
        ?>
        <div class="mb-3">
            <label for="input_daerah" class="form-label"><?= $bilangan++ ?>) Daerah:</label>
            <input type="text" name="input_daerah" id="input_daerah" class="form-control" required>
        </div>
        <?php
        }else{
        ?>
            <div class="mb-3">
                <label for="input_daerah" class="form-label"><?= $bilangan++ ?>) Daerah:</label>
                <select name="input_daerah" id="input_daerah" class="form-control" required>
                    <option value="">Sila Pilih..</option>
                    <?php
                    foreach($senaraiDaerah as $daerah):
                    ?>
                    <option value="<?= $daerah->bil ?>"><?= $daerah->nama ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>
        <?php
        }
        ?>
        <?php
        if(!empty($senaraiParlimen)):
        ?>
        <div class="mb-3">
            <label for="inputParlimen" class="form-label"><?= $bilangan++ ?>) Parlimen:</label>
            <select name="inputParlimen" id="inputParlimen" class="form-control" required>
                <option>Sila Pilih..</option>
                <?php
                foreach($senaraiParlimen as $parlimen): 
                ?>
                    <option value="<?= $parlimen->pt_bil ?>"><?= $parlimen->pt_nama ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <?php endif; ?>
        <?php 
        if(!empty($senaraiDun)):
        ?>
        <div class="mb-3">
            <label for="inputDun" class="form-label"><?= $bilangan++ ?>) DUN:</label>
            <select name="inputDun" id="inputDun" class="form-control" required>
                <option>Sila Pilih..</option>
                <?php
                foreach($senaraiDun as $dun):
                ?>
                    <option value="<?= $dun->dun_bil ?>"><?= $dun->dun_nama ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <?php
        endif;
        ?>
        <div class="mb-3">
            <label for="inputPdm" class="form-label"><?= $bilangan++ ?>) Daerah Mengundi:</label>
            <select name="inputPdm" id="inputPdm" class="form-control">
                <option value="">Sila Pilih..</option>
                <?php foreach($senaraiPdm as $dm): ?>
                    <option value="<?= $dm->ppt_bil ?>"><?= $dm->pt_nama ?> - <?= $dm->ppt_nama ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_jenis_kawasan" class="form-label"><?= $bilangan++ ?>) Jenis Kawasan:</label>
            <select name="input_jenis_kawasan" id="input_jenis_kawasan" class="form-control">
                <option value="">Sila pilih..</option>
                <option value="Bandar">Bandar</option>
                <option value="Pinggir Bandar">Pinggir Bandar</option>
                <option value="Luar Bandar">Luar Bandar</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_isu_politik" class="form-label"><?= $bilangan++ ?>) Isu-isu Politik:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_politik" id="input_isu_politik" value="Situasi politik semasa">
                <label class="form-check-label" for="input_isu_politik">
                    Situasi politik semasa
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_politik" id="input_isu_politik" value="Prestasi wakil rakyat semasa">
                <label class="form-check-label" for="input_isu_politik">
                    Prestasi wakil rakyat semasa
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_politik" id="input_isu_politik" value="Personaliti calon">
                <label class="form-check-label" for="input_isu_politik">
                    Personaliti calon
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_politik" id="input_isu_politik" value="Janji PRU">
                <label class="form-check-label" for="input_isu_politik">
                    Janji PRU
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_isu_politik" id="input_isu_politik" value="Lain-lain">
                <label class="form-check-label" for="input_isu_politik">
                    Lain-lain
                    
                </label>
                <textarea name="input_isu_politik_lain" id="input_isu_politik_lain" cols="10" rows="5" class="form-control"></textarea>
            </div>
        </div>
        <div class="mb-3">
            <label for="input_ringkasan_isu" class="form-label"><?= $bilangan++ ?>) Keterangan Isu:</label>
            <textarea name="input_ringkasan_isu" id="input_ringkasan_isu" cols="5" rows="5" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="input_lokasi_isu" class="form-label"><?= $bilangan++ ?>) Lokasi Isu:</label>
            <input type="text" name="input_lokasi_isu" id="input_lokasi_isu" class="form-control">
            <div class="row g-3 mt-1">
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="form-floating">
                        <input type="text" name="inputLatitude" id="inputLatitude" placeholder="a) Latitude Lokasi:" class="form-control">
                        <label for="inputLatitude" class="form-label">a) Latitude Lokasi:</label>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="form-floating">
                        <input type="text" name="inputLongitude" id="inputLongitude" placeholder="b) Longitude Lokasi:" class="form-control">
                        <label for="inputLongitude" class="form-label">b) Longitude Lokasi:</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="inputCadanganIntervensi" class="form-label"><?= $bilangan++ ?>) Cadangan Intervensi:</label>
            <textarea name="inputCadanganIntervensi" id="inputCadanganIntervensi" cols="10" rows="10" class="form-control"></textarea>
        </div>
        <input type="hidden" name="input_kluster_bil" value="<?= $kluster_isu->kit_bil ?>">
        <input type="hidden" name="input_pengguna_bil" value="<?= $this->session->userdata('pengguna_bil') ?>">
        <button type="submit" class="btn btn-primary w-100">Hantar</button>
    </form>
</div>
