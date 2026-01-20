<div class="p-3 border rounded">
            <h1>Tambah Akaun Pegawai</h1>
            <?php echo validation_errors(); ?>
            <?php echo form_open('pengguna/proses_tambah'); ?>
                <div class="mb-3">
                    <label for="input_nama_penuh" class="form-label">1) Nama Penuh:</label>
                    <input type="text" name="input_nama_penuh" id="input_nama_penuh" class="form-control" value="<?= set_value('input_nama_penuh'); ?>">
                </div>
                <div class="mb-3">
                    <label for="input_no_ic" class="form-label">2) Nombor Kad Pengenalan:</label>
                    <input type="text" name="input_no_ic" id="input_no_ic" class="form-control" value="<?= set_value('input_no_ic'); ?>">
                </div>
                <div class="mb-3">
                    <label for="input_no_tel" class="form-label">3) Nombor Telefon:</label>
                    <input type="text" name="input_no_tel" id="input_no_tel" class="form-control" value="<?= set_value('input_no_tel'); ?>">
                </div>
                <div class="mb-3">
                    <label for="input_emel" class="form-label">4) e-Mel:</label>
                    <input type="email" name="input_emel" id="input_emel" class="form-control" value="<?= set_value('input_emel'); ?>">
                </div>
                <div class="mb-3">
                    <label for="input_jawatan" class="form-label">5) Jawatan:</label>
                    <select name="input_jawatan" id="input_jawatan" class="form-control">
                        <option value="Pegawai Penerangan Gred S44">Pegawai Penerangan Gred S44</option>
                        <option value="Pegawai Penerangan Gred S41">Pegawai Penerangan Gred S41</option>
                        <option value="Penolong Pegawai Penerangan Gred S40">Penolong Pegawai Penerangan Gred S40</option>
                        <option value="Penolong Pegawai Penerangan Gred S38">Penolong Pegawai Penerangan Gred S38</option>
                        <option value="Penolong Pegawai Penerangan Gred S32">Penolong Pegawai Penerangan Gred S32</option>
                        <option value="Penolong Pegawai Penerangan Gred S29">Penolong Pegawai Penerangan Gred S29</option>
                        <option value="Pembantu Penerangan Gred S28">Pembantu Penerangan Gred S28</option>
                        <option value="Pembantu Penerangan Gred S26">Pembantu Penerangan Gred S26</option>
                        <option value="Pembantu Penerangan Gred S22">Pembantu Penerangan Gred S22</option>
                        <option value="Pembantu Penerangan Gred S19">Pembantu Penerangan Gred S19</option>
                    </select>
                </div>
                <input type="hidden" name="input_peranan_bil" value="<?= $this->session->userdata('peranan_bil'); ?>">
                <input type="hidden" name="input_peranan_nama" value="<?= $this->session->userdata('peranan'); ?>">
                <button type="submit" class="btn btn-primary w-100">Tambah Akaun Pegawai</button>
            </form>
        </div>