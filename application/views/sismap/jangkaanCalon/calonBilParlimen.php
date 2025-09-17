<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

    <section class="section">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Jangkaan Calon Parlimen</h1>
    
    <div class="p-3 border rounded mb-3">
        <div class="d-flex justify-content-between align-items-start">
            <h3 class="text-primary">MAKLUMAT CALON</h3>
            <p class="small text-muted text-end">BIL : <?php echo $calon->wct_bil; ?></p>
        </div>
        <div class="table-responsive mb-3">
            <table class="table table-sm table-hover">
                <tr>
                    <th>Gambar</th>
                    <td><img src="<?php echo base_url('assets/img/').$calon->fotoJangkaanCalon; ?>" style="object-fit: cover;width: 100px;height: 100px; border-radius: 100%;"/></td>
                </tr>
                <tr>
                    <th>Nama Penuh</th>
                    <td><?php echo strtoupper($calon->wct_nama_penuh); ?></td>
                </tr>
                <tr>
                    <th>Parti</th>
                    <td><img src="<?php echo base_url('assets/img/').$calon->fotoParti; ?>" style="object-fit: contain;width: 100px;height: 100px;"/>
                        <br /><?php echo strtoupper($calon->parti_nama); ?></td>
                </tr>
                <tr>
                    <th>Jawatan Dalam Parti</th>
                    <td><?php echo strtoupper($calon->wct_jawatan_parti); ?></td>
                </tr>
                <tr>
                    <th>Kategori Umur</th>
                    <td><?php echo $calon->wct_kategori_umur; ?></td>
                </tr>
                <tr>
                    <th>Penyandang</th>
                    <td><?php echo strtoupper($calon->wct_status_calon); ?></td>
                </tr>
                <tr>
                    <th>Parlimen</th>
                    <td><?php echo strtoupper($calon->pt_nama); ?></td>
                </tr>
                <tr>
                    <th>Negeri</th>
                    <td><?php echo strtoupper($calon->pt_negeri); ?></td>
                </tr>
            </table>
        </div>
        <h3 class="text-primary">KEKUATAN DAN KELEMAHAN CALON</h3>
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
        <div class="row g-3">
            <div class="col-12 col-lg-6">
                <p><strong>KEKUATAN CALON</strong></p>
                <?php foreach($kekuatan_calon as $kuat): ?>
                <div class="p-3 border rounded mb-3">
                    <p><?php echo $kuat->wctm_deskripsi; ?></p>
                    <p class="small text-muted text-end">Oleh: <?php echo strtoupper($kuat->nama_penuh); ?> - <?php echo $kuat->wctm_pengguna_waktu; ?></p>
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
                    <p class="small text-muted text-end">Oleh: <?php echo strtoupper($kuat->nama_penuh); ?> - <?php echo $lemah->wctm_pengguna_waktu; ?></p>
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
    </div>
    </section>


</main>


<?php $this->load->view($footer); ?>