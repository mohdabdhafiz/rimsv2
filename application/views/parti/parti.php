<?php foreach($parti as $p): ?>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><?php echo anchor('parti', 'RIMS'); ?> </li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $p->parti_nama; ?> (<?php echo $p->parti_singkatan; ?>)</li>
      </ol>
    </nav>

        <div class="p-3 border rounded mb-3">
            <h3>KEMASKINI MAKLUMAT PARTI</h3>
  <div class="row g-3 mt-3">
    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
      <?php echo anchor('parti', 'Parti', "class='btn btn-primary w-100'"); ?>
    </div>
    <div class="col-12 col-lg-6 col-md-6 col-sm-12">
      <?php echo anchor('parti/daftar', 'Daftar Parti Baharu', "class='btn btn-secondary w-100'"); ?>
    </div>
  </div>

        </div>

<div class="p-3 border rounded mb-3">

    <div class="row g-2">

    <div class="col-12 col-lg-12">
        
                <div class="row g-1 align-items-stretch rounded" style="<?php echo $p->parti_warna; ?>">
                    <div class="col-3 text-center d-flex align-items-center justify-content-center">
                    <img src="<?php echo base_url('assets/img/').$p->foto_nama; ?>" class="img-fluid rounded mb-3" style="object-fit: contain;width: 300px;height: 300px"/>
                    </div>
                    <div class="col-9 p-3 rounded d-flex flex-column align-items-start justify-content-center">
                        <p class="small text-muted">Nombor Siri: <?php echo $p->parti_bil; ?></p>
                        <h3><?php echo $p->parti_nama; ?> <small class="text-muted">(<?php echo $p->parti_singkatan; ?>)</small></h3>
                        
                    </div>
                </div>
    </div>

    <div class="col-12 col-lg-4 col-sm-12 d-flex align-items-stretch">
        <div class="p-3 d-flex flex-column w-100">
            <h2>LOGO PARTI</h2>
            <div class="p-3 border rounded d-flex flex-column align-items-center">
                <img src="<?php echo base_url('assets/img/').$p->foto_nama; ?>" class="img-fluid rounded mb-3" style="object-fit: contain;width: 80px;max-height: 80px"/>
                
                <?php if(!empty($error)){
                    echo $error;
                }?>

                <?php echo form_open_multipart('foto/tukar_gambar_parti');?>

                <input type="file" name="userfile" size="20" />

                <br /><br />
                <input type="hidden" name="foto_deskripsi" value="Logo bagi <?php echo $p->parti_nama; ?>">
                <input type="hidden" name="pengguna_bil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                <input type="hidden" name="parti_bil" value="<?php echo $p->parti_bil; ?>">

                <input type="submit" value="Tukar Gambar" class="btn btn-primary w-100 mt-auto"/>

                </form>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-8 col-sm-12">
        <div class="p-3">
            <h2>MAKLUMAT UMUM</h2>
            <div class="p-3 border rounded">
                <?php echo form_open('parti/tukar_umum'); ?>
                <div class="form-group mb-3">
                    <label for="parti_nama">Nama Parti</label>
                    <input type="text" class="form-control" id="parti_nama" name="parti_nama" aria-describedby="parti_nama_help" value="<?php echo $p->parti_nama; ?>">
                    <small id="parti_nama_help" class="form-text text-muted">Case-sensitive</small>
                </div>
                <div class="form-group mb-3">
                    <label for="parti_singkatan">Nama Singkatan Parti</label>
                    <input type="text" class="form-control" id="parti_singkatan" name="parti_singkatan" value="<?php echo $p->parti_singkatan; ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="parti_jenis" class="form-label">Jenis Parti</label>
                    <select name="parti_jenis" id="parti_jenis" class="form-control">
                        <option value="0">Sila Pilih</option>
                        <option value="Parti Gabungan" <?php if($p->parti_jenis == "Parti Gabungan"){ echo "selected"; } ?>>Parti Gabungan</option>
                        <option value="Parti Komponen" <?php if($p->parti_jenis == "Parti Komponen"){ echo "selected"; } ?>>Parti Komponen</option>
                    </select>
                </div>
                <input type="hidden" name="parti_bil" value="<?php echo $p->parti_bil; ?>">
                <button type="submit" class="btn btn-primary mt-3 w-100">Kemaskini</button>
                </form>
                </div>
                
            </div>
        </div>

    <div class="col col-lg-4">
        <div class="p-3">
            <h2>WARNA</h2>
            <div class="p-3 border rounded">
                <p>Contoh:</p>
                <p class="rounded border p-5" style="<?php echo $p->parti_warna; ?>">
                    <?php echo $p->parti_nama; ?>
                </p>
                <?php echo form_open('parti/tukar_warna'); ?>
                <div class="form-group">
                    <label for="warna_parti">Warna Parti</label>
                    <input type="text" class="form-control" id="warna_parti" name="warna_parti" aria-describedby="warna_parti_help" placeholder="#800080">
                    <small id="parti_nama_help" class="form-text text-muted">Gunakan Hex Color Code. Contoh "#800080".</small>
                </div>
                <div class="form-group mt-3">
                    <label for="warna_teks">Warna Teks</label>
                    <input type="text" class="form-control" id="warna_teks" name="warna_teks" aria-describedby="warna_teks_help" placeholder="#800080">
                    <small id="warna_teks_help" class="form-text text-muted">Gunakan Hex Color Code. Contoh "#800080".</small>
                </div>
                <input type="hidden" name="parti_bil" value="<?php echo $p->parti_bil; ?>">
                <button type="submit" class="btn btn-primary mt-3 w-100">Tukar Warna</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="p-3">
            <h2>PADAM MAKLUMAT PARTI</h2>
            <div class="p-3 border rounded">
                <p>Adakah anda pasti untuk memadam maklumat ini? Turut dipadam maklumat pencalonan dan maklumat grading berkait dengan parti ini.</p>
                <?php echo form_open('parti/padam'); ?>
                <input type="hidden" name="parti_bil" value="<?php echo $p->parti_bil; ?>">
                <input type="hidden" name="kebenaran" value="Benar">
                <button type="submit" class="btn btn-danger mt-3 w-100">Padam</button>
                </form>
            </div>
        </div>
    </div>


</div>

    </div>

<div class="p-3 border rounded mb-3">
    <h3>JAWATAN DALAM PARTI</h3>
    <?php echo validation_errors(); ?>
    <?php echo form_open('parti/tambah_jawatan'); ?>
        <div class="row g-3 mb-3">
            <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                <label for="input_nama" class="form-label">Nama Jawatan :</label>
                <input type="text" name="input_nama" id="input_nama" class="form-control">
            </div>
            <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                <label for="input_kumpulan" class="form-label">Kumpulan Jawatan :</label>
                <input type="text" name="input_kumpulan" id="input_kumpulan" class="form-control">
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12 d-flex align-self-stretch flex-column">
                <input type="hidden" name="input_parti_bil" value="<?php echo $p->parti_bil; ?>">
                <input type="hidden" name="input_pengguna_bil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                <input type="hidden" name="input_pengguna_waktu" value="<?php echo date('Y-m-d H:i:s'); ?>">
                <button type="submit" class="btn btn-primary w-100 mt-auto">Tambah Jawatan</button>
            </div>
        </div>
    </form>
    <h4>SENARAI JAWATAN</h4>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tr class="bg-primary text-white">
                <th>BIL</th>
                <th>NAMA JAWATAN</th>
                <th>KUMPULAN JAWATAN</th>
                <th>PENGGUNA</th>
                <th>OPERASI</th>
            </tr>
            <?php 
            $count = 1;
            foreach($senarai_jawatan as $jawatan): ?>
            <tr>
                <?php echo form_open('parti/proses_kemaskini_jawatan'); ?>
                    <td><?php echo $count++; ?></td>
                    <td>
                        <input type="text" name="input_nama" id="input_nama" class="form-control" value = "<?php echo $jawatan->pjt_nama; ?>">
                    </td>
                    <td>
                    <div class="row">
                        <?php foreach($senarai_kumpulan_jawatan as $sjk): ?>
                        <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="input_kumpulan" id="input_kumpulan.<?php echo $sjk->pjt_kumpulan; ?>" <?php if($sjk->pjt_kumpulan == $jawatan->pjt_kumpulan){ echo "checked"; } ?> value="<?php echo $sjk->pjt_kumpulan; ?>">
                            <label class="form-check-label" for="input_kumpulan.<?php echo $sjk->pjt_kumpulan; ?>">
                                <?php echo $sjk->pjt_kumpulan; ?>
                            </label>
                        </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    </td>
                    <td><?php 
                    $nama_pengguna = "Nama Pengguna";
                    $nama_pengguna = $data_pengguna->pengguna($jawatan->pjt_pengguna_bil)->nama_penuh; 
                    echo $nama_pengguna; ?> - <?php echo $jawatan->pjt_pengguna_waktu; ?></td>
                    <td>
                        <input type="hidden" name="input_pengguna_bil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                        <input type="hidden" name="input_pengguna_waktu" value="<?php echo date('Y-m-d H:i:s'); ?>">
                        <input type="hidden" name="input_jawatan_parti_bil" value="<?php echo $jawatan->pjt_bil; ?>">
                        <input type="hidden" name="input_parti_bil" value="<?php echo $p->parti_bil; ?>">
                        <button type="submit" class="btn btn-secondary w-100">Simpan</button>
                    </td>
                </form>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

    </div>
<?php endforeach; ?>
