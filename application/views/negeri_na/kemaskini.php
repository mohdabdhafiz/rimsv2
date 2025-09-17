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
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="mb-5 mt-5">

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Kemaskini Maklumat OBP</h5>

                            <?= form_open('obp/proses_kemaskini') ?>
                            <div class="mb-3 mt-3">

                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select name="inputNegeri" id="inputNegeri" class="form-control">
                                            <option value="">Sila pilih Negeri</option>
                                            <option value="1">Wilayah Persekutuan Kuala Lumpur</option>
                                            <option value="2">Terengganu</option>
                                        </select>
                                        <label for="inputNegeri">Negeri</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select name="inputDaerah" id="inputDaerah" class="form-control">
                                            <option value="">Sila pilih Daerah</option>
                                            <option value="1">Kuala Terengganu</option>
                                            <option value="2">Hulu Terengganu</option>
                                        </select>
                                        <label for="inputDaerah">Daerah</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select name="inputParlimen" id="inputParlimen" class="form-control">
                                            <option value="">Sila pilih Parlimen</option>
                                            <option value="1">P.239 Jauh Di Sana</option>
                                            <option value="2">P.240 Tidak Tahu</option>
                                        </select>
                                        <label for="inputParlimen">Parlimen</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select name="inputDun" id="inputDun" class="form-control">
                                            <option value="">Sila pilih DUN</option>
                                            <option value="1">N.99 Ke Sana</option>
                                            <option value="2">N.100 Di Sini</option>
                                        </select>
                                        <label for="inputDun">DUN</label>
                                    </div>
                                </div>

                                <form class="row g-10">

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="inputNama" name="inputNama"
                                                    value="<?= $obp->obp_nama ?>" required>
                                                <label for="inputNama">Nama</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="inputJawatan"
                                                    name="inputJawatan" value="<?= $obp->obp_jawatan ?>" required>
                                                <label for="inputJawatan">Jawatan</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Address" id="inputAlamat"
                                                    style="height: 100px;" name="inputAlamat"
                                                    required><?= $obp->obp_alamat ?></textarea>
                                                <label for="inputAlamat">Address</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="phoneNumber" class="form-control" id="inputNoTel"
                                                    name="inputNoTel" value="<?= $obp->obp_no_tel ?>" required>
                                                <label for="inputNoTel">No. Telefon</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="inputE-mail"
                                                    name="inputE-mail" value="<?= $obp->obp_email ?>" required>
                                                <label for="inputE-mail">E-mail</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <input type="hidden" name="inputPengguna" value="1">
                                                <input type="hidden" name="inputBil" value="<?= $obp->obp_id ?>">
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