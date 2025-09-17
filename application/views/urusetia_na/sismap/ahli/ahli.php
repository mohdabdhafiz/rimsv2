<?php

$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/navbar');
$this->load->view('urusetia_na/susunletak/sidebar');
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">RIMS</a></li>
                <li class="breadcrumb-item active">Maklumat Calon</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

        <section class="section">
            
        <?php if(empty($senarai_ahli)){ redirect(base_url()); } ?>

<?php foreach($senarai_ahli as $ahli): ?>

    

        <div class="card">
            <div class="card-body">
                <h1 class="card-title"><?php echo $ahli->ahli_nama; ?></h1>
            <div class="text-center">
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

                <input type="submit" value="Tukar Gambar" class="btn btn-outline-primary shadow-sm" />
                </form>
            </div>
        </div>
        </div>
        </div>






    

    <div class="card">
        <div class="card-body">
        <?php echo form_open('ahli/proses_maklumat'); ?>
            <h1 class="card-title">Maklumat Peribadi</h1>
            <div class="table-responsive">
                <table class="table table-borderless">
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
                        <td><strong><?php echo $ahli->ahli_tempat_lahir; ?></strong>
                            <select name="input_ahli_jantina" id="input_ahli_jantina" class="form-control">
                                <option value="0">Sila Pilih..</option>
                                <option value="LELAKI" <?php if(strtoupper($ahli->ahli_jantina) == 'LELAKI'){ echo "selected"; } ?>>Lelaki</option>
                                <option value="PEREMPUAN" <?php if(strtoupper($ahli->ahli_jantina) == 'PEREMPUAN'){ echo "selected"; } ?>>Perempuan</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="input_ahli_bil" value="<?= $ahli->ahli_bil ?>">
                <div class="text-center">
                <button type="submit" class="btn btn-outline-primary shadow-sm">Simpan</button>
                </div>
            </div>
            </form>
            </div>
            </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Pilihan Raya</h1>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr class="bg-secondary text-white">
                        <th>BIL</th>
                        <th>NAMA PILIHAN RAYA</th>
                        <th>PARTI CALON</th>
                        <th>OPERASI</th>
                    </tr>
                    </thead>
                    <tbody>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>









</div>
<?php endforeach; ?>

        </section>
</main>
</div>
</div>

<?php
$this->load->view('urusetia_na/susunletak/bawah');
?>