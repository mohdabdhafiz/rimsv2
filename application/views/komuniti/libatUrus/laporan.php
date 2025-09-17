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
                <div class="col-12 col-lg-4 col-md-4 col-sm-6">
                    <a href="<?= site_url('komuniti/libatUrus') ?>" class="btn btn-outline-info shadow-sm w-100">Laman Laporan Libat Urus Komuniti</a>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-6">
                    <a href="<?= site_url('komuniti/senaraiLibatUrus') ?>" class="btn btn-outline-info shadow-sm w-100">Senarai Laporan Libat Urus Komuniti</a>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-6">
                    <a href="<?= site_url('komuniti/tambahLibatUrus') ?>" class="btn btn-outline-info shadow-sm w-100">Tambah Laporan</a>
                </div>
            </div>
            <hr>
            <div class="row g-3">
                <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="p-3 border rounded">
                        <div>1. Tajuk Perjumpaan:</div>
                        <h3 class="text-start"><?= $laporan->libatUrusNama ?></h3>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="p-3 border rounded">
                        <div>2. Nombor Siri Laporan:</div>
                        <h3 class="text-start"><?= $laporan->libatUrusBil ?></h3>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="p-3 border rounded">
                        <div>3. Tarikh dan Masa:</div>
                        <h3 class="text-start"><?= $laporan->libatUrusTarikhMasa ?></h3>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="p-3 border rounded">
                        <div>4. Lokasi:</div>
                        <h3 class="text-start"><?= $laporan->libatUrusLokasi ?></h3>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="p-3 border rounded">
                        <div>5. Bilangan Kehadiran / Penyertaan (Orang):</div>
                        <h3 class="text-start"><?= $laporan->libatUrusKehadiran ?></h3>
                    </div>
                </div>
                <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="p-3 border rounded">
                        <div>6. Catatan / Rumusan Perjumpaan:</div>
                        <h3 class="text-start"><?= $laporan->libatUrusCatatan ?></h3>
                    </div>
                </div>
                <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="p-3 border rounded">
                        <div>7. Pelapor:</div>
                        <h3 class="text-start"><?= strtoupper($laporan->libatUrusPelaporNama) ?></h3>
                        <h3 class="text-start"><?= strtoupper($laporan->libatUrusPelaporJawatan) ?></h3>
                        <h3 class="text-start"><?= strtoupper($laporan->libatUrusPelaporPenempatan) ?></h3>
                        <h3 class="text-start"><?= $laporan->libatUrusPelaporNoTel ?></h3>
                    </div>
                </div>
            </div>
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