<div class="container-fluid">
    <p class="small text-muted text-end">BIL : <?php echo $calon->wct_bil; ?></p>
    <div class="p-3 border rounded mb-3">
        <h3>KEKUATAN DAN KELEMAHAN CALON <?php echo strtoupper($calon->wct_nama_penuh); ?> </h3>
        <div class="row g-3 mt-3">
            <div class="col-12 col-lg-4">
                <?php echo anchor(base_url(), 'Laman Utama', "class='btn btn-primary w-100'"); ?>
            </div>
            <div class="col-12 col-lg-4">
                <?php echo anchor('winnable_candidate/senarai_negeri', 'Senarai Mengikut Parlimen', "class='btn btn-secondary w-100'"); ?>
            </div>
            <div class="col-12 col-lg-4">
                <?php echo anchor('winnable_candidate/kemaskini_parlimen/'.$calon->wct_parlimen_bil, 'Kemaskini Maklumat Calon', "class='btn btn-info w-100'"); ?>
            </div>
        </div>
    </div>
    <div class="p-3 border rounded mb-3">
            <?php echo validation_errors(); ?>
        <div class="row g-3">
            <div class="col-12 col-lg-6">
                <?php echo form_open('winnable_candidate/kuat_lemah'); ?>
                    <div class="mb-3">
                        <label for="input_kekuatan" class="form-label">Kekuatan Calon</label>
                        <textarea name="input_kekuatan" id="input_kekuatan" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="">
                        <input type="hidden" name="input_calon" value="<?php echo $calon->wct_bil; ?>">
                        <input type="hidden" name="input_kuat_lemah" value="Kekuatan Calon">
                        <input type="hidden" name="input_pengguna_bil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                        <input type="hidden" name="input_pengguna_waktu" value="<?php echo date("Y-m-d H:i:s"); ?>">
                        <button type="submit" class="btn btn-primary w-100">Hantar Maklumat Kekuatan Calon</button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-lg-6">
                <?php echo form_open('winnable_candidate/kuat_lemah'); ?>
                    <div class="mb-3">
                        <label for="input_kekuatan" class="form-label">Kelemahan Calon</label>
                        <textarea name="input_kekuatan" id="input_kekuatan" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="">
                        <input type="hidden" name="input_calon" value="<?php echo $calon->wct_bil; ?>">
                        <input type="hidden" name="input_kuat_lemah" value="Kelemahan Calon">
                        <input type="hidden" name="input_pengguna_bil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                        <input type="hidden" name="input_pengguna_waktu" value="<?php echo date("Y-m-d H:i:s"); ?>">
                        <button type="submit" class="btn btn-secondary w-100">Hantar Maklumat Kelemahan Calon</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="p-3 border rounded mb-3">
        <h3>MAKLUMAT CALON</h3>
        <div class="table-responsive mb-3">
            <table class="table table-sm table-hover">
                <tr>
                    <th>Gambar</th>
                    <td><img src="<?php echo base_url('assets/img/').$data_foto->foto($calon->wct_foto_bil)->foto_nama; ?>" style="object-fit: cover;width: 100px;height: 100px; border-radius: 100%;"/></td>
                </tr>
                <tr>
                    <th>Nama Penuh</th>
                    <td><?php echo $calon->wct_nama_penuh; ?></td>
                </tr>
                <tr>
                    <th>Parti</th>
                    <td><img src="<?php echo base_url('assets/img/').$data_foto->foto($data_parti->parti($calon->wct_parti_bil)->parti_logo)->foto_nama; ?>" style="object-fit: contain;width: 100px;height: 100px;"/>
                        <br /><?php echo $data_parti->parti($calon->wct_parti_bil)->parti_nama; ?></td>
                </tr>
                <tr>
                    <th>Jawatan Dalam Parti</th>
                    <td><?php echo $calon->wct_jawatan_parti; ?></td>
                </tr>
                <tr>
                    <th>Kategori Umur</th>
                    <td><?php echo $calon->wct_kategori_umur; ?></td>
                </tr>
                <tr>
                    <th>Penyandang</th>
                    <td><?php echo $calon->wct_status_calon; ?></td>
                </tr>
                <tr>
                    <th>Parlimen</th>
                    <td><?php echo $data_parlimen->parlimen_bil($calon->wct_parlimen_bil)->pt_nama; ?></td>
                </tr>
                <tr>
                    <th>Negeri</th>
                    <td><?php echo $data_parlimen->parlimen_bil($calon->wct_parlimen_bil)->pt_negeri; ?></td>
                </tr>
            </table>
        </div>
        <h3>KEKUATAN DAN KELEMAHAN CALON</h3>
        <div class="row g-3">
            <div class="col-12 col-lg-6">
                <p><strong>KEKUATAN CALON</strong></p>
                <?php foreach($kekuatan_calon as $kuat): ?>
                <div class="p-3 border rounded mb-3">
                    <p><?php echo $kuat->wctm_deskripsi; ?></p>
                    <p class="small text-muted text-end">Oleh: <?php echo $data_pengguna->pengguna($kuat->wctm_pengguna_bil)->nama_penuh; ?> - <?php echo $kuat->wctm_pengguna_waktu; ?></p>
                    <?php echo form_open('winnable_candidate/padam_kuat_lemah'); ?>
                    <input type="hidden" name="input_wctm_bil" value="<?php echo $kuat->wctm_bil; ?>">
                    <input type="hidden" name="input_calon" value="<?php echo $calon->wct_bil; ?>">
                    <input type="hidden" name="input_pengguna_bil" value="<?php echo $kuat->wctm_pengguna_bil; ?>">
                    <button type="submit" class='btn btn-danger w-100'>Padam</button>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="col-12 col-lg-6">
                <p><strong>KELEMAHAN CALON</strong></p>
                <?php foreach($kelemahan_calon as $lemah): ?>
                <div class="p-3 border rounded mb-3">
                    <p><?php echo $lemah->wctm_deskripsi; ?></p>
                    <p class="small text-muted text-end">Oleh: <?php echo $data_pengguna->pengguna($lemah->wctm_pengguna_bil)->nama_penuh; ?> - <?php echo $lemah->wctm_pengguna_waktu; ?></p>
                    <?php echo form_open('winnable_candidate/padam_kuat_lemah'); ?>
                    <input type="hidden" name="input_wctm_bil" value="<?php echo $lemah->wctm_bil; ?>">
                    <input type="hidden" name="input_calon" value="<?php echo $calon->wct_bil; ?>">
                    <input type="hidden" name="input_pengguna_bil" value="<?php echo $lemah->wctm_pengguna_bil; ?>">
                    <button type="submit" class='btn btn-danger w-100'>Padam</button>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>