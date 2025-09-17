<?php
$this->load->view('negeri_na/susunletak/atas');
$this->load->view('negeri_na/susunletak/navbar');
$this->load->view('negeri_na/susunletak/sidebar');
?>


<main id="main" class="main">


    <div class="pagetitle">
        <h1>RIMS@OBP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">RIMS</a></li>
                <li class="breadcrumb-item">RIMS@OBP</li>
                <li class="breadcrumb-item active">Kemaskini Maklumat</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <a class="btn btn-primary rounded-pill" data-placement="top" href="<?php echo site_url('obp/senarai'); ?>"><i
            class="bi bi-arrow-90deg-left"></i></a>

    <div class="mb-5 mt-5">

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Kemaskini Gambar OBP:<b> <?= $obp->obp_nama; ?></b></h5>
                            <div class="mb-3 mt-3">
                                <div class="d-flex justify-content-center mb-4">
                                    <?= form_open('obp/proses_kemaskini_gambar') ?>
                                    <?php     
                                            if(empty($obp->og_file))
                                            {
                                                ?>
                                    <img src="https://cdn-icons-png.flaticon.com/512/25/25634.png"
                                        class="rounded-circle" alt="example placeholder"
                                        style="width: 200px; max-height: 200px;" />
                                    <?php
                                            }
                                            else
                                            {
                                                ?>
                                    <img src="<?php echo base_url('assets/img/obp/'.$obp->og_file);?>"
                                        class="rounded-circle" style="width: 200px; max-height: 200px;" />
                                    <?php
                                            }
                                            ?>
                                </div>

                                <div class="mb-3 mt-3">

                                    <div class="row mb-3">

                                        <label for="inputNumber" class="col-sm-2 col-form-label">Muat Naik
                                            Gambar</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" id="formFile">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <button type="submit" class="btn btn-outline-primary">Kemaskini
                                                    Gambar</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Kemaskini Maklumat OBP: <b><?= $obp->obp_nama; ?></b></h5>
                                <?php echo validation_errors(); ?>
                                <?= form_open('obp/proses_kemaskini') ?>
                                <div class="mb-3 mt-3">

                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <select name="inputNegeri" id="inputNegeri" class="form-control">
                                                <option value="">Sila pilih Negeri</option>
                                                <?php 
                                            $tmpNegeri = array();
                                            foreach($senaraiDaerah as $negeri): 
                                                if(!in_array($negeri->nt_nama, $tmpNegeri)): 
                                                array_push($tmpNegeri, $negeri->nt_nama); 
                                            ?>
                                                <option value="<?= $negeri->negeri_bil ?>"
                                                    <?php if($negeri->negeri_bil == $obp->negeri_id) {echo "selected";} ?>>
                                                    <?= $negeri->nt_nama ?></option>
                                                <?php 
                                                endif;
                                            endforeach; ?>
                                            </select>
                                            <label for="inputNegeri">Negeri</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <select name="inputDaerah" id="inputDaerah" class="form-control">
                                                <option value="">Sila pilih Daerah</option>
                                                <?php foreach($senaraiDaerah as $daerah): ?>
                                                <option value="<?= $daerah->bil ?>"
                                                    <?php if($daerah->bil == $obp->daerah_id) {echo "selected";} ?>>
                                                    <?= $daerah->nama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <label for="inputDaerah">Daerah</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <select name="inputParlimen" id="inputParlimen" class="form-control">
                                                <option value="">Sila pilih Parlimen</option>
                                                <?php foreach($senaraiParlimen as $parlimen): ?>
                                                <option value="<?= $parlimen->pt_bil ?>"
                                                    <?php if($parlimen->pt_bil == $obp->parlimen_id) {echo "selected";}?>>
                                                    <?= $parlimen->pt_nama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <label for="inputParlimen">Parlimen</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <select name="inputDun" id="inputDun" class="form-control">
                                                <option value="">Sila pilih DUN</option>
                                                <?php foreach($senaraiDun as $dun): ?>
                                                <option value="<?= $dun->dun_bil ?>"
                                                    <?php if($dun->dun_bil == $obp->dun_id) {echo "selected";} ?>>
                                                    <?= $dun->dun_nama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <label for="inputDun">DUN</label>
                                        </div>
                                    </div>

                                    <form class="row g-10">

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="inputNama"
                                                        name="inputNama" value="<?= $obp->obp_nama ?>" placeholder="Nama" required>
                                                    <label for="inputNama">Nama</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="inputJawatan"
                                                        name="inputJawatan" value="<?= $obp->obp_jawatan ?>" placeholder="Jawatan" required>
                                                    <label for="inputJawatan">Jawatan</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Address"
                                                        id="inputAlamat" style="height: 100px;" name="inputAlamat"
                                                        placeholder="Alamat" required><?= $obp->obp_alamat ?></textarea>
                                                    <label for="inputAlamat">Alamat</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input type="phoneNumber" class="form-control" id="inputNoTel"
                                                        name="inputNoTel" value="<?= $obp->obp_no_tel ?>" placeholder="No. Telefon" required>
                                                    <label for="inputNoTel">No. Telefon</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input type="email" class="form-control" id="inputE-mail"
                                                        name="inputE-mail" value="<?= $obp->obp_email ?>" placeholder="E-mel" required>
                                                    <label for="inputE-mail">E-mel</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <select name="inputUmur" id="inputUmur" class="form-control">
                                                    <option value="">Sila pilih kategori umur</option>
                                                    <option <?php if($obp->obp_umur == "18 - 24") {echo "selected";}?>>
                                                        18 - 24</option>
                                                    <option <?php if($obp->obp_umur == "25 - 40") {echo "selected";}?>>
                                                        25 - 40</option>
                                                    <option <?php if($obp->obp_umur == "41 - 60") {echo "selected";}?>>
                                                        41 - 60</option>
                                                    <option <?php if($obp->obp_umur == "61 - 70") {echo "selected";}?>>
                                                        61 - 70</option>
                                                    <option <?php if($obp->obp_umur == "71 - 80") {echo "selected";}?>>
                                                        71 - 80</option>
                                                    <option
                                                        <?php if($obp->obp_umur == "81 dan ke atas") {echo "selected";}?>>
                                                        81 dan ke atas</option>
                                                </select>
                                                <label for="inputUmur">Kategori Umur</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <select name="inputJantina" id="inputJantina" class="form-control">
                                                    <option value="">Sila pilih jantina</option>
                                                    <option
                                                        <?php if($obp->obp_jantina == "Lelaki") {echo "selected";}?>>
                                                        Lelaki</option>
                                                    <option
                                                        <?php if($obp->obp_jantina == "Perempuan") {echo "selected";}?>>
                                                        Perempuan</option>
                                                </select>
                                                <label for="inputJantina">Jantina</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <select name="inputKaum" id="inputKaum" class="form-control">
                                                    <option value="">Sila pilih kaum</option>
                                                    <option <?php if($obp->obp_kaum == "Melayu") {echo "selected";}?>>
                                                        Melayu</option>
                                                    <option <?php if($obp->obp_kaum == "Cina") {echo "selected";}?>>Cina
                                                    </option>
                                                    <option <?php if($obp->obp_kaum == "India") {echo "selected";}?>>
                                                        India</option>
                                                    <option
                                                        <?php if($obp->obp_kaum == "Bumiputera Islam Sabah (Lain-Lain Kaum)") {echo "selected";}?>>
                                                        Bumiputera Islam Sabah (Lain-Lain Kaum)</option>
                                                    <option
                                                        <?php if($obp->obp_kaum == "Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)") {echo "selected";}?>>
                                                        Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)</option>
                                                    <option <?php if($obp->obp_kaum == "Iban") {echo "selected";}?>>Iban
                                                    </option>
                                                    <option <?php if($obp->obp_kaum == "Bidayuh") {echo "selected";}?>>
                                                        Bidayuh</option>
                                                    <option <?php if($obp->obp_kaum == "Melanau") {echo "selected";}?>>
                                                        Melanau</option>
                                                    <option
                                                        <?php if($obp->obp_kaum == "Orang Ulu") {echo "selected";}?>>
                                                        Orang Ulu</option>
                                                    <option
                                                        <?php if($obp->obp_kaum == "Orang Asli") {echo "selected";}?>>
                                                        Orang Asli</option>
                                                    <option
                                                        <?php if($obp->obp_kaum == "Punjabi / Sikh") {echo "selected";}?>>
                                                        Punjabi / Sikh</option>
                                                    <option
                                                        <?php if($obp->obp_kaum == "Lain-Lain Kaum") {echo "selected";}?>>
                                                        Lain-Lain Kaum</option>
                                                </select>
                                                <label for="inputKaum">Kaum</label>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="hidden" name="inputPeranan"
                                                        value="<?= $this->session->userdata('peranan_bil')?>">
                                                    <input type="hidden" name="inputPengguna" value="1">
                                                    <input type="hidden" name="inputBil" value="<?= $obp->siriObp ?>">
                                                    <button type="submit" class="btn btn-outline-primary">Kemaskini
                                                        Maklumat</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
        </section>
</main>
</div>
</div>


<?php $this->load->view('negeri_na/susunletak/bawah'); ?>