<?php
$this->load->view('negeri_na/susunletak/atas');
$this->load->view('negeri_na/susunletak/navbar');
$this->load->view('negeri_na/susunletak/sidebar');
?>


<main id="main" class="main">


    <div class="pagetitle">
        <h1>RIMS@PENGGUNA</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">RIMS</a></li>
                <li class="breadcrumb-item">RIMS@PENGGUNA</li>
                <li class="breadcrumb-item active">Maklumat Pengguna</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="https://cdn-icons-png.flaticon.com/512/25/25634.png" class="rounded-circle"
                            alt="example placeholder" />
                        <h2><?= $pengguna->nama_penuh; ?></h2>
                        <h3><?= $pengguna->pengguna_tempat_tugas; ?></h3>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Maklumat Profil</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Kemaskini
                                    Profil</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Kemaskini Kata Laluan</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nama Penuh</div>
                                    <div class="col-lg-9 col-md-8"><?= $pengguna->nama_penuh; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Nombor Telefon</div>
                                    <div class="col-lg-9 col-md-8"><?= $pengguna->no_tel; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">E-mail</div>
                                    <div class="col-lg-9 col-md-8"><?= $pengguna->emel; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Jawatan</div>
                                    <div class="col-lg-9 col-md-8"><?= $pengguna->pekerjaan; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Tempat Bertugas</div>
                                    <div class="col-lg-9 col-md-8"><?= $pengguna->pengguna_tempat_tugas; ?></div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form>
                                    <div class="row mb-3">
                                        <div class="col-md-8 col-lg-12">
                                            <div class="d-flex justify-content-center">
                                                <img src="https://cdn-icons-png.flaticon.com/512/25/25634.png"
                                                    alt="Profile">
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="pt-3">
                                                    <a href="#" class="btn btn-primary btn-sm"
                                                        title="Upload new profile image"><i
                                                            class="bi bi-upload"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm"
                                                        title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="inputNama" name="inputNama"
                                                    value="<?= $pengguna->nama_penuh; ?>" placeholder="Nama Penuh"
                                                    required>
                                                <label for="inputNama">Nama Penuh</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="phoneNumber" class="form-control" id="inputNoTel"
                                                    name="inputNoTel" value="<?= $pengguna->no_tel; ?>"
                                                    placeholder="Nombor Telefon" required>
                                                <label for="inputNoTel">Nombor Telefon</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="inputEmel" name="inputEmel"
                                                    value="<?= $pengguna->emel; ?>" placeholder="E-mel" required>
                                                <label for="inputEmel">E-mel</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="inputPekerjaan"
                                                    name="inputPekerjaan" value="<?= $pengguna->pekerjaan; ?>"
                                                    placeholder="Jawatan" required>
                                                <label for="inputEmel">Jawatan</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="inputPenggunaTempatTugas"
                                                    name="inputPenggunaTempatTugas"
                                                    value="<?= $pengguna->pengguna_tempat_tugas; ?>"
                                                    placeholder="Tempat Bertugas" required>
                                                <label for="inputEmel">Tempat Bertugas</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-outline-primary">Kemaskini</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <div class="form-floating">
                                                    <input type="password" class="form-control" id="inputKataLaluan"
                                                        name="inputKataLaluan" placeholder="Kata Laluan Semasa"
                                                        required>
                                                    <label for="inputKataLaluan">Kata Laluan Semasa</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input type="password" class="form-control" id="inputkataLaluan"
                                                        name="inputkataLaluan" placeholder="Kata Laluan Baru" required>
                                                    <label for="inputkataLaluan">Kata Laluan Baru</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input type="password" class="form-control" id="inputkataLaluan"
                                                        name="inputkataLaluan" placeholder="Ulang Kata Laluan Baru"
                                                        required>
                                                    <label for="inputkataLaluan">Ulang Kata Laluan Baru</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-outline-primary">Kemaskini Kata
                                                Laluan</button>
                                        </div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
</div>
</div>


<?php $this->load->view('ppd/susunletak/bawah'); ?>