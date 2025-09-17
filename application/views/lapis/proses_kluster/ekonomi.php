<?php $this->load->view('lapis/nav'); ?>

<div class="p-3 border rounded mb-3">
    <h2>Kluster Isu: <?= $kluster_isu->kit_nama ?></h2>
    <p><?= $kluster_isu->kit_deskripsi ?></p>
    <?php echo form_open('lapis/proses_ekonomi'); ?>
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
            <label for="input_kenaikan_barangan[]" class="form-label">5) Kenaikan harga barangan:</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Ayam" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Ayam
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Telur Ayam" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Telur Ayam
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Minyak Masak Botol" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Minyak Masak Botol
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Minyak Masak Paket" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Minyak Masak Paket
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Sayur-sayuran" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Sayur-sayuran
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Ikan" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Ikan
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Daging" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Daging
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Tepung" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Tepung
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Gula" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Gula
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Ubat-ubatan" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Ubat-ubatan
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Petrol" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Petrol
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Lain-lain
                </label>
                <textarea name="input_lain" id="input_lain" cols="5" rows="5" class="form-control"></textarea>
            </div>
        </div>
        <div class="mb-3">
            <label for="input_faktor[]" class="form-label">6) Tandakan mana yang berkenaan bagi faktor kenaikan harga barangan:</label>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Kekurangan Bekalan</th>
                            <th>Kos Pengangkutan</th>
                            <th>Kos Pengeluaran</th>
                            <th>Lain-lain</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Ayam</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kekurangan Bekalan" id="input_faktor_ayam[]" name="input_faktor_ayam[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_faktor_ayam[]" name="input_faktor_ayam[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_faktor_ayam[]" name="input_faktor_ayam[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_faktor_ayam[]" name="input_faktor_ayam[]">
                                    <textarea name="input_lain_ayam" id="input_lain_ayam" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Telur Ayam</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kekurangan Bekalan" id="input_faktor_telur_ayam[]" name="input_faktor_telur_ayam[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_faktor_telur_ayam[]" name="input_faktor_telur_ayam[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_faktor_telur_ayam[]" name="input_faktor_telur_ayam[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_faktor_telur_ayam[]" name="input_faktor_telur_ayam[]">
                                    <textarea name="input_lain_telur_ayam" id="input_lain_telur_ayam" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Minyak masak botol</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kekurangan Bekalan" id="input_faktor_minyak_botol[]" name="input_faktor_minyak_botol[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_faktor_minyak_botol[]" name="input_faktor_minyak_botol[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_faktor_minyak_botol[]" name="input_faktor_minyak_botol[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_faktor_minyak_botol[]" name="input_faktor_minyak_botol[]">
                                    <textarea name="input_lain_minyak_botol" id="input_lain_minyak_botol" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Minyak masak paket</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kekurangan Bekalan" id="input_faktor_minyak_paket[]" name="input_faktor_minyak_paket[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_faktor_minyak_paket[]" name="input_faktor_minyak_paket[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_faktor_minyak_paket[]" name="input_faktor_minyak_paket[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_faktor_minyak_paket[]" name="input_faktor_minyak_paket[]">
                                    <textarea name="input_lain_minyak_paket" id="input_lain_minyak_paket" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Sayur-sayuran</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kekurangan Bekalan" id="input_faktor_sayur[]" name="input_faktor_sayur[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_faktor_sayur[]" name="input_faktor_sayur[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_faktor_sayur[]" name="input_faktor_sayur[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_faktor_sayur[]" name="input_faktor_sayur[]">
                                    <textarea name="input_lain_sayur" id="input_lain_sayur" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Ikan</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kekurangan Bekalan" id="input_faktor_ikan[]" name="input_faktor_ikan[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_faktor_ikan[]" name="input_faktor_ikan[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_faktor_ikan[]" name="input_faktor_ikan[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_faktor_ikan[]" name="input_faktor_ikan[]">
                                    <textarea name="input_lain_ikan" id="input_lain_ikan" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Daging</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kekurangan Bekalan" id="input_faktor_daging[]" name="input_faktor_daging[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_faktor_daging[]" name="input_faktor_daging[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_faktor_daging[]" name="input_faktor_daging[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_faktor_daging[]" name="input_faktor_daging[]">
                                    <textarea name="input_lain_daging" id="input_lain_daging" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Tepung</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kekurangan Bekalan" id="input_faktor_tepung[]" name="input_faktor_tepung[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-chetepung
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_faktor_tepung[]" name="input_faktor_tepung[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_faktor_tepung[]" name="input_faktor_tepung[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_faktor_tepung[]" name="input_faktor_tepung[]">
                                    <textarea name="input_lain_tepung" id="input_lain_tepung" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Gula</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kekurangan Bekalan" id="input_faktor_gula[]" name="input_faktor_gula[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_faktor_gula[]" name="input_faktor_gula[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_faktor_gula[]" name="input_faktor_gula[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_faktor_gula[]" name="input_faktor_gula[]">
                                    <textarea name="input_lain_gula" id="input_lain_gula" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Ubat-ubatan</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kekurangan Bekalan" id="input_faktor_ubat[]" name="input_faktor_ubat[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_faktor_ubat[]" name="input_faktor_ubat[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_faktor_ubat[]" name="input_faktor_ubat[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_faktor_ubat[]" name="input_faktor_ubat[]">
                                    <textarea name="input_lain_ubat" id="input_lain_ubat" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Petrol</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kekurangan Bekalan" id="input_faktor_petrol[]" name="input_faktor_petrol[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_faktor_petrol[]" name="input_faktor_petrol[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_faktor_petrol[]" name="input_faktor_petrol[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_faktor_petrol[]" name="input_faktor_petrol[]">
                                    <textarea name="input_lain_petrol" id="input_lain_petrol" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mb-3">
            <label for="input_caj" class="form-label">7) Isu kenaikan kos/caj perkhidmatan. Nyatakan:</label>
            <textarea name="input_caj" id="input_caj" cols="5" rows="5" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="input_kurang" class="form-label">8) Isu kekurangan bekalan:</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Ayam" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Ayam
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Telur Ayam" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Telur Ayam
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Minyak Masak Botol" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Minyak Masak Botol
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Minyak Masak Paket" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Minyak Masak Paket
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Sayur-sayuran" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Sayur-sayuran
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Ikan" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Ikan
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Daging" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Daging
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Tepung" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Tepung
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Gula" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Gula
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Ubat-ubatan" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Ubat-ubatan
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Petrol" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Petrol
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_kurang_barangan" name="input_kurang_barangan[]">
                <label class="form-check-label" for="input_kurang_barangan[]">
                    Lain-lain
                </label>
                <textarea name="input_kurang_lain" id="input_lain" cols="5" rows="5" class="form-control"></textarea>
            </div>
        </div>
        <div class="mb-3">
            <label for="input_kurang_bekalan" class="form-label">8a) Lain-lain (isu kekurangan bekalan):</label>
            <textarea name="input_kurang_bekalan" id="input_kurang_bekalan" cols="5" rows="5" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="input_faktor_kurang" class="form-label">9) Tandakan mana yang berkenaan bagi faktor kekurangan bekalan barangan:</label>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Kelewatan pengeluaran dari kilang / pengeluar</th>
                            <th>Kos Pengangkutan</th>
                            <th>Kos Pengeluaran</th>
                            <th>Lain-lain</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Ayam</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kelewatan pengeluaran dari kilang / pengeluar" id="input_kurang_ayam[]" name="input_kurang_ayam[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_kurang_ayam[]" name="input_kurang_ayam[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_kurang_ayam[]" name="input_kurang_ayam[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_kurang_ayam[]" name="input_kurang_ayam[]">
                                    <textarea name="input_lain_kurang_ayam" id="input_lain_kurang_ayam" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Telur Ayam</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kelewatan pengeluaran dari kilang / pengeluar" id="input_kurang_telur_ayam[]" name="input_kurang_telur_ayam[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_kurang_telur_ayam[]" name="input_kurang_telur_ayam[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_kurang_telur_ayam[]" name="input_kurang_telur_ayam[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_kurang_telur_ayam[]" name="input_kurang_telur_ayam[]">
                                    <textarea name="input_lain_kurang_telur_ayam" id="input_lain_kurang_telur_ayam" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Minyak masak botol</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kelewatan pengeluaran dari kilang / pengeluar" id="input_kurang_minyak_botol[]" name="input_kurang_minyak_botol[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_kurang_minyak_botol[]" name="input_kurang_minyak_botol[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_kurang_minyak_botol[]" name="input_kurang_minyak_botol[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_kurang_minyak_botol[]" name="input_kurang_minyak_botol[]">
                                    <textarea name="input_lain_kurang_minyak_botol" id="input_lain_kurang_minyak_botol" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Minyak masak paket</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kelewatan pengeluaran dari kilang / pengeluar" id="input_kurang_minyak_paket[]" name="input_kurang_minyak_paket[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_kurang_minyak_paket[]" name="input_kurang_minyak_paket[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_kurang_minyak_paket[]" name="input_kurang_minyak_paket[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_kurang_minyak_paket[]" name="input_kurang_minyak_paket[]">
                                    <textarea name="input_lain_minyak_paket" id="input_lain_minyak_paket" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Sayur-sayuran</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kelewatan pengeluaran dari kilang / pengeluar" id="input_kurang_sayur[]" name="input_kurang_sayur[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_kurang_sayur[]" name="input_kurang_sayur[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_kurang_sayur[]" name="input_kurang_sayur[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_kurang_sayur[]" name="input_kurang_sayur[]">
                                    <textarea name="input_lain_kurang_sayur" id="input_lain_kurang_sayur" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Ikan</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kelewatan pengeluaran dari kilang / pengeluar" id="input_kurang_ikan[]" name="input_kurang_ikan[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_kurang_ikan[]" name="input_kurang_ikan[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_kurang_ikan[]" name="input_kurang_ikan[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_kurang_ikan[]" name="input_kurang_ikan[]">
                                    <textarea name="input_lain_kurang_ikan" id="input_lain_kurang_ikan" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Daging</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kelewatan pengeluaran dari kilang / pengeluar" id="input_kurang_daging[]" name="input_kurang_daging[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_kurang_daging[]" name="input_kurang_daging[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_kurang_daging[]" name="input_kurang_daging[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_kurang_daging[]" name="input_kurang_daging[]">
                                    <textarea name="input_lain_kurang_daging" id="input_lain_kurang_daging" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Tepung</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kelewatan pengeluaran dari kilang / pengeluar" id="input_kurang_tepung[]" name="input_kurang_tepung[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-chetepung
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_kurang_tepung[]" name="input_kurang_tepung[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_kurang_tepung[]" name="input_kurang_tepung[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_kurang_tepung[]" name="input_kurang_tepung[]">
                                    <textarea name="input_lain_kurang_tepung" id="input_lain_kurang_tepung" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Gula</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kelewatan pengeluaran dari kilang / pengeluar" id="input_kurang_gula[]" name="input_kurang_gula[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_kurang_gula[]" name="input_kurang_gula[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_kurang_gula[]" name="input_kurang_gula[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_kurang_gula[]" name="input_kurang_gula[]">
                                    <textarea name="input_lain_kurang_gula" id="input_lain_kurang_gula" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Ubat-ubatan</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kelewatan pengeluaran dari kilang / pengeluar" id="input_kurang_ubat[]" name="input_kurang_ubat[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_kurang_ubat[]" name="input_kurang_ubat[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_kurang_ubat[]" name="input_kurang_ubat[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_kurang_ubat[]" name="input_kurang_ubat[]">
                                    <textarea name="input_lain_kurang_ubat" id="input_lain_kurang_ubat" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Petrol</th>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kelewatan pengeluaran dari kilang / pengeluar" id="input_kurang_petrol[]" name="input_kurang_petrol[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengangkutan" id="input_kurang_petrol[]" name="input_kurang_petrol[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Kos Pengeluaran" id="input_kurang_petrol[]" name="input_kurang_petrol[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Lain-lain" id="input_kurang_petrol[]" name="input_kurang_petrol[]">
                                    <textarea name="input_lain_kurang_petrol" id="input_lain_kurang_petrol" cols="5" rows="5" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mb-3">
            <label for="input_isu_ekonomi_lain" class="form-label">10) Lain-lain isu ekonomi. Nyatakan:</label>
            <textarea name="input_isu_ekonomi_lain" id="input_isu_ekonomi_lain" cols="5" rows="5" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Hantar</button>
    </form>
</div>

