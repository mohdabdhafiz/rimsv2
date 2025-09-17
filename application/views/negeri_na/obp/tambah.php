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
                <li class="breadcrumb-item active">RIMS@OBP</li>
                <li class="breadcrumb-item active">Tambah Maklumat</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="mb-5 mt-5">

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Maklumat OBP</h5>
                            <?php echo validation_errors(); ?>
                            <?= form_open('obp/proses_tambah') ?>
                            <div class="mb-3 mt-3">

                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select name="inputNegeri" id="inputNegeri" class="form-control" required>
                                            <option value="">Sila pilih Negeri</option>
                                            <?php 
                                            $tmpNegeri = array();
                                            foreach($senaraiDaerah as $negeri): 
                                                if(!in_array($negeri->nt_nama, $tmpNegeri)): 
                                                array_push($tmpNegeri, $negeri->nt_nama); 
                                            ?>
                                            <option value="<?= $negeri->negeri_bil ?>"><?= $negeri->nt_nama ?></option>
                                            <?php 
                                                endif;
                                            endforeach; ?>
                                        </select>
                                        <label for="inputNegeri">Negeri</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select name="inputDaerah" id="inputDaerah" class="form-control" required>
                                            <option value="">Sila pilih Daerah</option>
                                            <?php foreach($senaraiDaerah as $daerah): ?>
                                            <option value="<?= $daerah->bil ?>"><?= $daerah->nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="inputDaerah">Daerah</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select name="inputParlimen" id="inputParlimen" class="form-control" required>
                                            <option value="">Sila pilih Parlimen</option>
                                            <?php foreach($senaraiParlimen as $parlimen): ?>
                                            <option value="<?= $parlimen->pt_bil ?>"><?= $parlimen->pt_nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="inputParlimen">Parlimen</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select name="inputDun" id="inputDun" class="form-control" required>
                                            <option value="">Sila pilih DUN</option>
                                            <?php foreach($senaraiDun as $dun): ?>
                                            <option value="<?= $dun->dun_bil ?>"><?= $dun->dun_nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="inputDun">DUN</label>
                                    </div>
                                </div>

                                <form class="row g-10">

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="inputNama" name="inputNama"
                                                    placeholder="Nama" required>
                                                <label for="inputNama">Nama</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="inputJawatan"
                                                    name="inputJawatan" placeholder="Jawatan">
                                                <label for="inputJawatan">Jawatan</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Alamat" id="inputAlamat"
                                                    style="height: 100px;" name="inputAlamat"></textarea>
                                                <label for="inputAlamat">Alamat</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="phoneNumber" class="form-control" id="inputNoTel"
                                                    name="inputNoTel" placeholder="No. Telefon" required>
                                                <label for="inputNoTel">No. Telefon</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="inputE-mail"
                                                    name="inputE-mail" placeholder="E-mail">
                                                <label for="inputE-mail">E-mail</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <select name="inputUmur" id="inputUmur" class="form-control">
                                                <option value="">Sila pilih kategori umur</option>
                                                <option value="18 - 24">18 - 24</option>
                                                <option value="25 - 40">25 - 40</option>
                                                <option value="41 - 60">41 - 60</option>
                                                <option value="61 - 70">61 - 70</option>
                                                <option value="71 - 80">71 - 80</option>
                                                <option value="81 dan ke atas">81 dan ke atas</option>
                                            </select>
                                            <label for="inputUmur">Kategori Umur</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <select name="inputJantina" id="inputJantina" class="form-control">
                                                <option value="">Sila pilih jantina</option>
                                                <option value="Lelaki">Lelaki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                            <label for="inputJantina">Jantina</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <select name="inputKaum" id="inputKaum" class="form-control">
                                                <option value="">Sila pilih kaum</option>
                                                <option value="Melayu">Melayu</option>
                                                <option value="Cina">Cina</option>
                                                <option value="India">India</option>
                                                <option value="Bumiputera Islam Sabah (Lain-Lain Kaum)">Bumiputera Islam Sabah (Lain-Lain Kaum)</option>
                                                <option value="Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)">Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)</option>
                                                <option value="Iban">Iban</option>
                                                <option value="Bidayuh">Bidayuh</option>
                                                <option value="Melanau">Melanau</option>
                                                <option value="Orang Ulu">Orang Ulu</option>
                                                <option value="Orang Asli">Orang Asli</option>
                                                <option value="Punjabi / Sikh">Punjabi / Sikh</option>
                                                <option value="Lain-Lain Kaum">Lain-Lain Kaum</option>
                                            </select>
                                            <label for="inputKaum">Kaum</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <input type="hidden" name="inputPeranan" value="<?= $this->session->userdata('peranan_bil')?>">
                                                <input type="hidden" name="inputPengguna" value="<?= $this->session->userdata('pengguna_bil')?>">
                                                <button type="submit" class="btn btn-outline-success">Tambah
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