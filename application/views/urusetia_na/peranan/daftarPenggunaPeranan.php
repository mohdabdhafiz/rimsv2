<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PERSONEL</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">
                    <i class="bi bi-file-earmark-text"></i>
                    Borang Daftar Pengguna Mengikut Peranan
                </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section bg-light">
        
    <h2 class="my-5">
        <i class="bi bi-file-earmark-text"></i>
        BORANG DAFTAR PENGGUNA MENGIKUT PERANAN
    </h2>
    
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">
                <i class="bi bi-plus-circle"></i>
                Tambah Pengguna
            </h3>
            <?= form_open('peranan/prosesDaftarPengguna') ?>
                <div class="form-floating my-3">
                    <input type="text" name="inputDisbledPeranan" id="inputDisbledPeranan" placeholder="Peranan:" class="form-control" disabled value="<?= strtoupper($peranan->peranan_nama) ?>">
                    <label for="inputDisbledPeranan" class="form-label">Peranan:</label>
                </div>
                <div class="form-floating my-3">
                    <input type="text" name="inputNama" id="inputNama" placeholder="Nama Penuh:" class="form-control" required>
                    <label for="inputNama" class="form-label">Nama Penuh:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="inputNoIc" id="inputNoIc" placeholder="Nombor Kad Pengenalan:" class="form-control" required>
                    <label for="inputNoIc" class="form-label">Nombor Kad Pengenalan:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="inputNoTel" id="inputNoTel" placeholder="Nombor Telefon:" class="form-control" required>
                    <label for="inputNoTel" class="form-label">Nombor Telefon:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="inputEmel" id="inputEmel" placeholder="Alamat e-Mel:" class="form-control" required>
                    <label for="inputEmel" class="form-label">Alamat e-Mel:</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="inputJawatan" id="inputJawatan" class="form-control" required>
                        <option value="">Sila Pilih..</option>
                        <option value="PEGAWAI PENERANGAN GRED UTAMA B">PEGAWAI PENERANGAN GRED UTAMA B</option>
                        <option value="PEGAWAI PENERANGAN GRED UTAMA C">PEGAWAI PENERANGAN GRED UTAMA C</option>
                        <option value="PEGAWAI PENERANGAN GRED S54">PEGAWAI PENERANGAN GRED S54</option>
                        <option value="PEGAWAI PENERANGAN GRED S52">PEGAWAI PENERANGAN GRED S52</option>
                        <option value="PEGAWAI PENERANGAN GRED S48">PEGAWAI PENERANGAN GRED S48</option>
                        <option value="PEGAWAI PENERANGAN GRED S44">PEGAWAI PENERANGAN GRED S44</option>
                        <option value="PEGAWAI PENERANGAN GRED S41">PEGAWAI PENERANGAN GRED S41</option>
                        <option value="PENOLONG PEGAWAI PENERANGAN GRED S40">PENOLONG PEGAWAI PENERANGAN GRED S40</option>
                        <option value="PENOLONG PEGAWAI PENERANGAN GRED S38">PENOLONG PEGAWAI PENERANGAN GRED S38</option>
                        <option value="PENOLONG PEGAWAI PENERANGAN GRED S32">PENOLONG PEGAWAI PENERANGAN GRED S32</option>
                        <option value="PENOLONG PEGAWAI PENERANGAN GRED S29">PENOLONG PEGAWAI PENERANGAN GRED S29</option>
                        <option value="PEMBANTU PENERANGAN GRED S28">PEMBANTU PENERANGAN GRED S28</option>
                        <option value="PEMBANTU PENERANGAN GRED S26">PEMBANTU PENERANGAN GRED S26</option>
                        <option value="PEMBANTU PENERANGAN GRED S22">PEMBANTU PENERANGAN GRED S22</option>
                        <option value="PEMBANTU PENERANGAN GRED S19">PEMBANTU PENERANGAN GRED S19</option>
                    </select>
                    <label for="inputJawatan" class="form-label">Jawatan:</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="inputPenempatan" id="inputPenempatan" class="form-control" required>
                        <option value="">Sila Pilih</option>
                        <?php foreach($senaraiPenempatan as $penempatan): ?>
                            <option value="<?= strtoupper($penempatan->namaPenempatan) ?>"><?= strtoupper($penempatan->namaPenempatan) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="inputPenempatan" class="form-label">Penempatan:</label>
                </div>
                <input type="hidden" name="inputPeranan" value="<?= $perananBil ?>">
                <button type="submit" class="btn btn-outline-primary w-100 shadow-sm">
                    <i class="bi bi-plus-circle"></i>
                    Tambah Pengguna
                </button>
            </form>
        </div>
    </div>


    </section>

</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>