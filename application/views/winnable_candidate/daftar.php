<div class="container-fluid">
    <div class="p-3 border rounded mb-3">
        <h3>JANGKAAN CALON PARLIMEN PRU15</h3>
        <div class="row g-3 mt-3">
            <div class="col-12">
                <?php echo anchor(base_url(), 'Laman Utama', "class='btn btn-primary w-100'"); ?>
            </div>
        </div>
    </div>
    <div class="p-3 border rounded mb-3">
        <?php echo validation_errors(); ?>
        <?php echo form_open('winnable_candidate/proses_daftar'); ?>
            <div class="mb-3">
                <div class="row g-3">
                    <label class="form-label"><strong>1) Pilih Parlimen :</strong></label> 
                        <?php if(strpos($this->session->userdata('peranan'), 'ppd') !== FALSE){
                                $senarai_parlimen = $data_parlimen->ikut_tugasan($pengguna->pengguna_peranan_bil); 
                            }else{
                                $senarai_parlimen = $data_parlimen->paparIkutNegeri($data_assign->assign($pengguna->pengguna_peranan_bil)->wcat_negeri); 
                            }
                            foreach($senarai_parlimen as $parlimen): ?>
                    <div class="col-12 col-lg-3 col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="input_parlimen_bil" id="input_parlimen_bil.<?php echo $parlimen->pt_bil; ?>" <?php if($parlimen->pt_bil == set_value('input_parlimen_bil')){ echo "checked"; } ?> value="<?php echo $parlimen->pt_bil; ?>">
                            <label class="form-check-label" for="input_parlimen_bil.<?php echo $parlimen->pt_bil; ?>">
                                <?php echo $parlimen->pt_nama; ?>
                            </label>
                        </div>
                    </div>
                            <?php endforeach; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="input_nama_penuh" class="form-label"><strong>2) Masukkan Nama Penuh Calon :</strong></label>
                <input type="text" name="input_nama_penuh" id="input_nama_penuh" class="form-control" value="<?php echo set_value('input_nama_penuh'); ?>">
            </div>
            <div class="mb-3">
                <div class="row g-3">
                    <label class="form-label"><strong>3) Pilih Parti :</strong></label> 
                    <?php foreach($senarai_parti as $parti): ?>
                    <div class="col-12 col-lg-4 col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="input_parti_bil" id="input_parti_bil.<?php echo $parti->parti_bil; ?>" <?php if($parti->parti_bil == set_value('input_parti_bil')){ echo "checked"; } ?> value="<?php echo $parti->parti_bil; ?>">
                            <label class="form-check-label" for="input_parti_bil.<?php echo $parti->parti_bil; ?>">
                                <?php echo $parti->parti_singkatan; ?> - <?php echo $parti->parti_nama; ?>
                            </label>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <small id="input_parti_bil_help" class="form-text text-muted">Sila hubungi urus setia jika parti yang hendak dipilih tiada dalam senarai.</small>
                </div>
            </div>
            <div class="mb-3">
                <label for="input_jawatan_parti" class="form-label"><strong>4) Masukkan Jawatan Dalam Parti :</strong></label>
                <input type="text" name="input_jawatan_parti" id="input_jawatan_parti" class="form-control" value="<?php echo set_value('input_jawatan_parti'); ?>">
            </div>
            <div class="mb-3">
                <label for="input_kategori_umur" class="form-label"><strong>5) Pilih Kategori Umur :</strong></label>
                <select name="input_kategori_umur" id="input_kategori_umur" class="form-control">
                    <option value="0">Sila Pilih</option>
                    <option value="18 - 24" <?php if(set_value('input_kategori_umur') == "18 - 24"){ echo "selected"; } ?>>18 - 24</option>
                    <option value="25 - 40" <?php if(set_value('input_kategori_umur') == "25 - 40"){ echo "selected"; } ?>>25 - 40</option>
                    <option value="41 - 60" <?php if(set_value('input_kategori_umur') == "41 - 60"){ echo "selected"; } ?>>41 - 60</option>
                    <option value="61 - 70" <?php if(set_value('input_kategori_umur') == "61 - 70"){ echo "selected"; } ?>>61 - 70</option>
                    <option value="71 - 80" <?php if(set_value('input_kategori_umur') == "71 - 80"){ echo "selected"; } ?>>71 - 80</option>
                    <option value="81 ke atas" <?php if(set_value('input_kategori_umur') == "81 ke atas"){ echo "selected"; } ?>>81 ke atas</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="input_jantina" class="form-label"><strong>6) Pilih Jantina :</strong></label>
                <select name="input_jantina" id="input_jantina" class="form-control">
                    <option value="0">Sila Pilih</option>
                    <option value="Lelaki" <?php if(set_value('input_jantina') == "Lelaki"){ echo "selected"; } ?>>Lelaki</option>
                    <option value="Perempuan" <?php if(set_value('input_jantina') == "Perempuan"){ echo "selected"; } ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="input_kaum" class="form-label"><strong>7) Pilih Kaum :</strong></label>
                <select name="input_kaum" id="input_kaum" class="form-control">
                    <option value="0">Sila Pilih</option>
                    <option value="Melayu" <?php if(set_value('input_kaum') == "Melayu"){ echo "selected"; } ?>>Melayu</option>
                    <option value="Cina" <?php if(set_value('input_kaum') == "Cina"){ echo "selected"; } ?>>Cina</option>
                    <option value="India" <?php if(set_value('input_kaum') == "India"){ echo "selected"; } ?>>India</option>
                    <option value="Bumiputera Islam Sabah (Lain-Lain Kaum)" <?php if(set_value('input_kaum') == "Bumiputera Islam Sabah (Lain-Lain Kaum)"){ echo "selected"; } ?>>Bumiputera Islam Sabah (Lain-Lain Kaum)</option>
                    <option value="Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)" <?php if(set_value('input_kaum') == "Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)"){ echo "selected"; } ?>>Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)</option>
                    <option value="Iban" <?php if(set_value('input_kaum') == "Iban"){ echo "selected"; } ?>>Iban</option>
                    <option value="Bidayuh" <?php if(set_value('input_kaum') == "Bidayuh"){ echo "selected"; } ?>>Bidayuh</option>
                    <option value="Melanau" <?php if(set_value('input_kaum') == "Melanau"){ echo "selected"; } ?>>Melanau</option>
                    <option value="Orang Ulu" <?php if(set_value('input_kaum') == "Orang Ulu"){ echo "selected"; } ?>>Orang Ulu</option>
                    <option value="Orang Asli" <?php if(set_value('input_kaum') == "Orang Asli"){ echo "selected"; } ?>>Orang Asli</option>
                    <option value="Punjabi" <?php if(set_value('input_kaum') == "Punjabi"){ echo "selected"; } ?>>Punjabi / Sikh</option>
                    <option value="Lain-Lain Kaum" <?php if(set_value('input_kaum') == "Lain-Lain Kaum"){ echo "selected"; } ?>>Lain-Lain Kaum</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="input_status_calon" class="form-label"><strong>8) Adakah Calon Merupakan Penyandang Parlimen?</strong></label>
                <select name="input_status_calon" id="input_status_calon" class="form-control">
                    <option value="0">Sila Pilih</option>
                    <option value="Penyandang" <?php if(set_value('input_status_calon') == "Penyandang"){ echo "selected"; } ?>>Ya</option>
                    <option value="Bukan Penyandang" <?php if(set_value('input_status_calon') == "Bukan Penyandang"){ echo "selected"; } ?>>Tidak</option>
                </select>
            </div>
            <div class="">
                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        <input type="hidden" name="input_foto_bil" value="5">
                        <input type="hidden" name="input_pengguna_bil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                        <input type="hidden" name="input_pengguna_waktu" value="<?php echo date("Y-m-d H:i:s"); ?>">
                        <button type="submit" class="btn btn-primary w-100">Tambah Calon</button>
                    </div>
                    <div class="col-12 col-lg-6">
                        <button type="reset" class="btn btn-secondary w-100">Set Semula</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
