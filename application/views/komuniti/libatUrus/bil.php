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
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">RIMS</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('komuniti') ?>">RIMS@KOMUNITI</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('komuniti/senaraiLibatUrus') ?>">SENARAI LAPORAN</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('komuniti/laporanLibatUrus/'.$laporan->libatUrusBil) ?>">LAPORAN LIBAT URUS KOMUNITI SIRI <?= $laporan->libatUrusBil ?> <?= date_format(date_create($laporan->libatUrusTarikh), "d.m.Y") ?></a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Laporan Libat Urus Komuniti Siri <?= $laporan->libatUrusBil ?> <?= date_format(date_create($laporan->libatUrusTarikh), "d.m.Y") ?></h1>
            <hr>
            <div class="row g-3">
                <div class="col-12 col-lg-3 col-md-3 col-sm-6">
                    <a href="<?= site_url('komuniti/libatUrus') ?>" class="btn btn-outline-info shadow-sm w-100">Laman Laporan Libat Urus Komuniti</a>
                </div>
                <div class="col-12 col-lg-3 col-md-3 col-sm-6">
                    <a href="<?= site_url('komuniti/senaraiLibatUrus') ?>" class="btn btn-outline-info shadow-sm w-100">Senarai Laporan Libat Urus Komuniti</a>
                </div>
                <div class="col-12 col-lg-3 col-md-3 col-sm-6">
                    <a href="<?= site_url('komuniti/tambahLibatUrus') ?>" class="btn btn-outline-info shadow-sm w-100">Tambah Laporan</a>
                </div>
                <div class="col-12 col-lg-3 col-md-3 col-sm-6">
                    <a href="<?= site_url('komuniti/padamLaporanLibatUrus/'.$laporan->libatUrusBil) ?>" class="btn btn-danger shadow-sm w-100">Padam Laporan</a>
                </div>
            </div>
            <hr>
            <?= form_open('komuniti/prosesKemaskiniUmum') ?>
            <div class="mb-3 p-3 border rounded">
                <label for="inputTajukPerjumpaan" class="form-label">1. Tajuk Perjumpaan:</label>
                <input type="text" name="inputTajukPerjumpaan" id="inputTajukPerjumpaan" class="form-control" value="<?= strtoupper($laporan->libatUrusNama) ?>" required>
            </div>
            <div class="mb-3 p-3 border rounded">
                <label for="inputLokasi" class="form-label">2. Lokasi Perjumpaan:</label>
                <input type="text" name="inputLokasi" id="inputLokasi" class="form-control" value="<?= strtoupper($laporan->libatUrusLokasi) ?>">
            </div>
            <div class="mb-3 p-3 border rounded">
                <label for="inputTarikhMasa" class="form-label">3. Tarikh dan Masa Perjumpaan:</label>
                <input type="datetime-local" name="inputTarikhMasa" id="inputTarikhMasa" class="form-control" value="<?= $laporan->libatUrusTarikhMasa ?>">
            </div>
            <div class="mb-3 p-3 border rounded">
                <label for="inputKehadiran" class="form-label">4. Bilangan Kehadiran / Penyertaan (Orang):</label>
                <input type="text" name="inputKehadiran" id="inputKehadiran" class="form-control" value="<?= $laporan->libatUrusKehadiran ?>">
            </div>
            <div class="mb-3 p-3 border rounded">
                <label for="inputCatatan" class="form-label">5. Catatan / Rumusan:</label>
                <textarea name="inputCatatan" id="inputCatatan" cols="30" rows="10" class="form-control"><?= strtoupper($laporan->libatUrusCatatan) ?></textarea>
            </div>
            <input type="hidden" name="inputLibatUrusBil" value="<?= $laporan->libatUrusBil ?>">
            <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
            <input type="hidden" name="inputPenggunaNama" value="<?= $pengguna->nama_penuh ?>">
            <input type="hidden" name="inputPenggunaJawatan" value="<?= $pengguna->pekerjaan ?>">
            <input type="hidden" name="inputPenggunaNoTel" value="<?= $pengguna->no_tel ?>">
            <input type="hidden" name="inputPenggunaPenempatan" value="<?= $pengguna->pengguna_tempat_tugas ?>">
            <button type="submit" class="btn btn-outline-primary shadow-sm w-100">Simpan</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Komuniti</h1>
            <?= form_open('komuniti/prosesSenaraiKomunitiLibatUrus') ?>
            <label class="form-label mb-3">1. Pilihan Komuniti:</label><br>
            <?php foreach($senaraiNegeri as $negeri): ?>
                <p><strong><?= strtoupper($negeri->nt_nama) ?></strong></p>
                <div class="row g-3">
                    <?php foreach($senaraiDaerah as $daerah): 
                        if($daerah->nt_bil == $negeri->nt_bil): ?>
                    <div class="col-12 col-lg-3 col-md-4 col-sm-12">
                        <p><?= strtoupper($daerah->nama) ?></p>
                        <div class="mb-3 border rounded p-3">
                            <?php foreach($senaraiKomuniti as $komuniti): 
                                if($komuniti->daerahBil == $daerah->bil): ?>
                                <div class="form-check">
                                    <input class="form-check-input" 
                                    <?php foreach($senaraiKomunitiTerlibat as $km){
                                        if($km->komunitiBil == $komuniti->komunitiBil){
                                            echo "checked";
                                        }
                                    } ?>
                                    type="checkbox" name="inputKomunitiBil[]" id="inputKomunitiBil<?= $komuniti->komunitiBil ?>" value="<?= $komuniti->komunitiBil ?>"> <?= strtoupper($komuniti->komunitiNama) ?>
                                    <label for="inputKomunitiBil<?= $komuniti->komunitiBil ?>" class="form-check-label"></label>
                                </div>
                            <?php endif; 
                            endforeach; ?>
                        </div>
                    </div>
                    <?php endif; 
                    endforeach; ?>
                </div>
            <?php endforeach; ?>
            <input type="hidden" name="inputLaporanBil" value="<?= $laporan->libatUrusBil ?>">
            <button type="submit" class="btn btn-outline-secondary shadow-sm w-100">Simpan</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
                Senarai Gambar / Video
            </h1>   
            <?php echo form_open_multipart('komuniti/prosesGambarLibatUrus'); ?> 
            <div class="mb-3 border rounded p-3">
                <label for="inputGambar" class="form-label">1. Pilih Gambar:</label>
                <input type="file" name="inputGambar[]"  multiple class="form-control"/>
                <input type="hidden" name="inputLibatUrusBil" value="<?= $laporan->libatUrusBil ?>">
            </div>
                <input type="submit" value="Muat Naik Gambar" class="btn btn-outline-secondary w-100 shadow-sm"/>
            </form>
            <div class="row g-0 mt-3">
                            <?php foreach($gambarLibatUrus as $bg): ?>
                            <div class="col-12 col-lg-3 col-md-4 col-sm-6">
                                <div class="text-center">
                                    <img src="<?= base_url() ?>assets/img/gambarKomuniti/<?= $bg->gambarNama ?>" alt="<?= $laporan->libatUrusNama?> <?= $bg->gambarBil ?>" style="object-fit:cover; height:400px; width:100%;">
                                    <div class="text-center my-1">
                                        <?= form_open('komuniti/padamGambarLibatUrus') ?>
                                        <input type="hidden" name="inputLibatUrusGambarBil" value="<?= $bg->gambarBil ?>">
                                        <input type="hidden" name="inputLibatUrusBil" value="<?= $laporan->libatUrusBil ?>">
                                        <button type="submit" class="btn btn-danger btn-sm shadow-sm">Padam</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
        </div>
    </div>



    </section>


</main>


<?php $this->load->view($footer); ?>