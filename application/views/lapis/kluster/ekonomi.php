<?php $this->load->view('lapis/nav'); ?>

<div class="p-3 border rounded mb-3">
    <h2>Kluster Isu: <?= $kluster_isu->kit_nama ?></h2>
    <p><?= $kluster_isu->kit_deskripsi ?></p>
    <?php echo form_open('lapis/proses_ekonomi'); ?>
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
                <input class="form-check-input" type="checkbox" value="Kenaikan OPR" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Kenaikan OPR
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Kenaikan harga tambang kapal terbang" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Kenaikan harga tambang kapal terbang
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Kenaikan harga tambang bas" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Kenaikan harga tambang bas
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Kenaikan harga tambang feri" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Kenaikan harga tambang feri
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Kenaikan kos sara hidup" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Kenaikan kos sara hidup
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Kenaikan harga makanan siap dimasak" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Kenaikan harga makanan siap dimasak
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Kenaikan harga baja/racun pertanian" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Kenaikan harga baja/racun pertanian
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Kenaikan harga belajar ambil lesen memandu" id="input_kenaikan_barangan" name="input_kenaikan_barangan[]">
                <label class="form-check-label" for="input_kenaikan_barangan[]">
                    Kenaikan harga belajar ambil lesen memandu
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
            <label for="input_kurang" class="form-label">6) Isu kekurangan bekalan:</label>
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
            <label for="input_ringkasan_isu" class="form-label">7) Keterangan Isu:</label>
            <textarea name="input_ringkasan_isu" id="input_ringkasan_isu" cols="5" rows="5" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="input_lokasi_isu" class="form-label">8) Lokasi Isu:</label>
            <input type="text" name="input_lokasi_isu" id="input_lokasi_isu" class="form-control">
        </div>
        <div class="mb-3">
            <label for="inputCadanganIntervensi" class="form-label">9) Cadangan Intervensi:</label>
            <textarea name="inputCadanganIntervensi" id="inputCadanganIntervensi" cols="5" rows="5" class="form-control"></textarea>
        </div>
        <input type="hidden" name="input_kluster_bil" value="<?= $kluster_isu->kit_bil ?>">
        <input type="hidden" name="input_pengguna_bil" value="<?= $this->session->userdata('pengguna_bil') ?>">
        <button type="submit" class="btn btn-primary w-100">Hantar</button>
    </form>
</div>

