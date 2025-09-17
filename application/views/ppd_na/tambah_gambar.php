<?php
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/navbar');
$this->load->view('ppd_na/susunletak/sidebar');
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
                            <h5 class="card-title">Muat Naik Gambar OBP</h5>

                            <?= form_open('obp/proses_tambah_gambar') ?>
                            <div class="mb-3 mt-3">

                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Muat Naik Gambar</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="formFile">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-center">
                                        <div>
                                            <input type="hidden" name="inputPengguna" value="1">
                                            <button type="submit" class="btn btn-outline-success">Tambah
                                                Gambar</button>
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


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>