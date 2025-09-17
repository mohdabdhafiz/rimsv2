<?php if(empty($senarai_ahli)){ redirect(base_url()); } ?>

<?php foreach($senarai_ahli as $ahli): ?>
<div class="row g-3 align-items-center">
    
    <div class="col-auto">
        <div class="p-3 text-center">
            <img src="<?php echo base_url('assets/img/').$ahli->foto_nama; ?>" class="img-fluid rounded" style="object-fit: cover;width: 100px;height: 100px"/>
            <div class="p-3">
                <?php if(!empty($error)){
                    echo $error;
                }?>
                <?php echo form_open_multipart('foto/tukar_gambar_ahli');?>

                <input type="file" name="userfile" size="20" class="form-control-file" />

                <br /><br />
                <input type="hidden" name="foto_deskripsi" value="Gambar bagi <?php echo $ahli->ahli_nama; ?>">
                <input type="hidden" name="pengguna_bil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                <input type="hidden" name="ahli_bil" value="<?php echo $ahli->ahli_bil; ?>">

                <input type="submit" value="Tukar Gambar" class="btn btn-primary w-100"/>

                </form>
            </div>
        </div>
    </div>

    <div class="col-auto">
        <div class="p-3">
            <h1><?php echo $ahli->ahli_nama; ?></h1>
        </div>
    </div>
</div>



<div class="row g-3">

    

    <div class="col-12 col-lg-12">
        <?php echo form_open('ahli/proses_maklumat'); ?>
        <div class="p-3">
            <h3>Maklumat Peribadi</h3>
            <div class="p-3 border rounded">
                <table class="table">
                    <tr>
                        <td>Nama Penuh</td>
                        <td>
                            <input type="text" name="input_ahli_nama" id="input_ahli_nama" class="form-control" value="<?php echo $ahli->ahli_nama; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Umur</td>
                        <td>
                            <input type="text" name="input_ahli_umur" id="input_ahli_umur" class="form-control" value="<?= $ahli->ahli_umur ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Pendidikan</td>
                        <td>
                            <input type="text" name="input_ahli_pendidikan" id="input_ahli_pendidikan" value="<?= $ahli->ahli_pendidikan ?>" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Jantina</td>
                        <td>
                            <select name="input_ahli_jantina" id="input_ahli_jantina" class="form-control" required>
                                <option value="">Sila Pilih..</option>
                                <option value="Lelaki" <?php if(strtoupper($ahli->ahli_jantina) == 'LELAKI'){ echo "selected"; } ?>>Lelaki</option>
                                <option value="Perempuan" <?php if(strtoupper($ahli->ahli_jantina) == 'PEREMPUAN'){ echo "selected"; } ?>>Perempuan</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Kaum</td>
                        <td>
                            <select name="input_kaum" id="input_kaum" class="form-control" required>
                                <option value="">Sila Pilih..</option>
                                <option value="Melayu" <?php if($ahli->ahli_kaum == "Melayu"){ echo "selected"; } ?>>Melayu</option>
                                <option value="Cina" <?php if($ahli->ahli_kaum == "Cina"){ echo "selected"; } ?>>Cina</option>
                                <option value="India" <?php if($ahli->ahli_kaum == "India"){ echo "selected"; } ?>>India</option>
                                <option value="Bumiputera Islam Sabah (Lain-Lain Kaum)" <?php if($ahli->ahli_kaum == "Bumiputera Islam Sabah (Lain-Lain Kaum)"){ echo "selected"; } ?>>Bumiputera Islam Sabah (Lain-Lain Kaum)</option>
                                <option value="Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)" <?php if($ahli->ahli_kaum == "Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)"){ echo "selected"; } ?>>Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)</option>
                                <option value="Iban" <?php if($ahli->ahli_kaum == "Iban"){ echo "selected"; } ?>>Iban</option>
                                <option value="Bidayuh" <?php if($ahli->ahli_kaum == "Bidayuh"){ echo "selected"; } ?>>Bidayuh</option>
                                <option value="Melanau" <?php if($ahli->ahli_kaum == "Melanau"){ echo "selected"; } ?>>Melanau</option>
                                <option value="Orang Ulu" <?php if($ahli->ahli_kaum == "Orang Ulu"){ echo "selected"; } ?>>Orang Ulu</option>
                                <option value="Orang Asli" <?php if($ahli->ahli_kaum == "Orang Asli"){ echo "selected"; } ?>>Orang Asli</option>
                                <option value="Punjabi / Sikh" <?php if($ahli->ahli_kaum == "Punjabi / Sikh"){ echo "selected"; } ?>>Punjabi / Sikh</option>
                                <option value="Lain-Lain Kaum" <?php if($ahli->ahli_kaum == "Lain-Lain Kaum"){ echo "selected"; } ?>>Lain-Lain Kaum</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="input_ahli_bil" value="<?= $ahli->ahli_bil ?>">
                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </div>
        </div>
            </form>
    </div>

    <div class="col-12">
        <div class="p-3">
            <h3>Pilihan Raya</h3>
            <div class="p-3 border rounded">
                <table class="table table-hover table-bordered">
                    <tr class="bg-secondary text-white">
                        <th>BIL</th>
                        <th>NAMA PILIHAN RAYA</th>
                        <th>PARTI CALON</th>
                        <th>OPERASI</th>
                    </tr>
                    <?php $bilangan = 1; foreach($pilihanraya_parlimen_aktif as $pru): 
                        echo form_open('ahli/tukar_parti'); ?>
                    <tr>
                        <td><?= $bilangan++ ?></td>
                        <td><?= $pru->pilihanraya_nama ?></td>
                        <td><select name="input_parti_bil" id="input_parti_bil" class="form-control">
                            <?php foreach($senarai_parti as $parti): ?>
                            <option value="<?= $parti->parti_bil ?>" <?php if($parti->parti_bil == $pru->pencalonan_parlimen_partiBil){ echo 'selected'; } ?>><?= $parti->parti_nama ?> (<?= $parti->parti_singkatan ?>)</option>
                            <?php endforeach; ?>
                        </select></td>
                        <td>
                            <input type="hidden" name="input_ahli_bil" value="<?= $ahli->ahli_bil ?>">
                            <input type="hidden" name="input_pencalonan_parlimen_bil" value="<?= $pru->pencalonan_parlimen_bil ?>">
                            <input type="hidden" name="input_pilihanraya_bil" value="<?= $pru->pencalonan_parlimen_pilihanrayaBil ?>">
                            <input type="hidden" name="input_pilihanraya_jenis" value="<?= $pru->pilihanraya_jenis ?>">
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php foreach($pilihanraya_dun_aktif as $pru): 
                        echo form_open('ahli/tukar_parti'); ?>
                    <tr>
                        <td><?= $bilangan++ ?></td>
                        <td><?= $pru->pilihanraya_nama ?></td>
                        <td><select name="input_parti_bil" id="input_parti_bil" class="form-control">
                            <?php foreach($senarai_parti as $parti): ?>
                            <option value="<?= $parti->parti_bil ?>" <?php if($parti->parti_bil == $pru->pencalonan_parti){ echo 'selected'; } ?>><?= $parti->parti_nama ?> (<?= $parti->parti_singkatan ?>)</option>
                            <?php endforeach; ?>
                        </select></td>
                        <td>
                            <input type="hidden" name="input_ahli_bil" value="<?= $ahli->ahli_bil ?>">
                            <input type="hidden" name="input_pencalonan_bil" value="<?= $pru->pencalonan_bil ?>">
                            <input type="hidden" name="input_pilihanraya_bil" value="<?= $pru->pencalonan_pilihanraya ?>">
                            <input type="hidden" name="input_pilihanraya_jenis" value="<?= $pru->pilihanraya_jenis ?>">
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>









</div>
<?php endforeach; ?>