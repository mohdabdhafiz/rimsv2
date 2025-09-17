<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@KOMUNITI</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('komuniti') ?>">RIMS@KOMUNITI</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('komuniti') ?>">LAPORAN LIBAT URUS KOMUNITI</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Tambah Laporan Libat Urus Komuniti</h1>
            <hr>
            <div class="row g-3">
                <div class="col-12 col-lg-4 col-md-4 col-sm-4">
                    <a href="<?= site_url('komuniti/libatUrus') ?>" class="btn btn-outline-info shadow-sm w-100">Laman Laporan Libat Urus Komuniti</a>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-4">
                    <a href="<?= site_url('komuniti/senaraiLibatUrus') ?>" class="btn btn-outline-info shadow-sm w-100">Senarai Laporan Libat Urus Komuniti</a>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-4">
                    <a href="<?= site_url('komuniti/tambahLibatUrus') ?>" class="btn btn-outline-info shadow-sm w-100">Tambah Laporan</a>
                </div>
            </div>
            <hr>
            <?php echo form_open_multipart('komuniti/prosesTambahSemua'); ?>
            <div class="mb-3 p-3 border rounded">
                <label for="inputTajukPerjumpaan" class="form-label">1. Tajuk Perjumpaan:</label>
                <input type="text" name="inputTajukPerjumpaan" id="inputTajukPerjumpaan" class="form-control" required>
            </div>
            <div class="mb-3 p-3 border rounded">
                <label for="inputLokasi" class="form-label">2. Lokasi Perjumpaan:</label>
                <input type="text" name="inputLokasi" id="inputLokasi" class="form-control">
            </div>
            <div class="mb-3 p-3 border rounded">
                <label for="inputTarikhMasa" class="form-label">3. Tarikh dan Masa Perjumpaan:</label>
                <input type="datetime-local" name="inputTarikhMasa" id="inputTarikhMasa" class="form-control">
            </div>
            <div class="mb-3 p-3 border rounded">
                <label for="inputKehadiran" class="form-label">4. Bilangan Kehadiran / Penyertaan (Orang):</label>
                <input type="text" name="inputKehadiran" id="inputKehadiran" class="form-control">
            </div>
            <div class="mb-3 p-3 border rounded">
                <label for="inputCatatan" class="form-label">5. Catatan / Rumusan:</label>
                <textarea name="inputCatatan" id="inputCatatan" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="mb-3 p-3 border rounded">
                <p>6. Senarai Komuniti</p>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Pilih</th>
                                <th>Nama Komuniti</th>
                                <th>Daerah</th>
                                <th>Parlimen</th>
                                <th>DUN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($senaraiKomuniti as $komuniti): ?>
                            <tr>
                                <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="inputKomunitiBil[]" id="inputKomunitiBil<?= $komuniti->komunitiBil ?>" value="<?= $komuniti->komunitiBil ?>"> 
                                    <label for="inputKomunitiBil<?= $komuniti->komunitiBil ?>" class="form-check-label"></label>
                                </div>
                           
                                </td>
                                <td><?= strtoupper($komuniti->komunitiNama) ?></td>
                                <td><?= strtoupper($komuniti->komunitiDaerah) ?></td>
                                <td><?= strtoupper($komuniti->komunitiParlimen) ?></td>
                                <td><?= strtoupper($komuniti->komunitiDun) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mb-3 border rounded p-3">
                <label for="inputGambar" class="form-label">7. Pilih Gambar:</label>
                <input type="file" name="inputGambar[]"  multiple class="form-control"/>
            </div>
            <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
            <button type="submit" class="btn btn-outline-primary shadow-sm w-100">Hantar</button>
            </form>
        </div>
    </div>



    </section>


</main>


<?php $this->load->view($footer); ?>