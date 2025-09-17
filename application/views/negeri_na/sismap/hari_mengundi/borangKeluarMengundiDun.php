<?php 
$this->load->view('negeri_na/susunletak/atas');
$this->load->view('negeri_na/susunletak/sidebar');
$this->load->view('negeri_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('undi') ?>">UNDI</a></li>
                <li class="breadcrumb-item active">Borang Status Keluar Mengundi Mengikut DUN</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <?php foreach($senaraiPilihanrayaNegeriDun as $pru): 
        $senaraiDun = $dataDun->senarai_dun_pilihanraya($pru->pilihanraya_bil);
        $senaraiKeluarMengundi = $dataUndi->senaraiKeluarMengundiDun($pru->pilihanraya_bil);
        ?>
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Borang Status Keluar Mengundi Mengikut DUN</h1>
            <p><?= $pru->pilihanraya_nama ?></p>
            <?= form_open('undi/prosesKeluarMengundiDun') ?>
                <div class="form-floating mb-3">
                    <select name="inputDunBil" id="inputDunBil<?= $pru->pilihanraya_bil ?>" class="form-control" required>
                        <option value="">Sila pilih..</option>
                        <?php foreach($senaraiDun as $dun): ?>
                        <option value="<?= $dun->dun_bil ?>"><?= $dun->dun_nama ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="inputDunBil<?= $pru->pilihanraya_bil ?>" class="form-label">Senarai DUN:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="inputBilanganPengundi" id="inputBilanganPengundi<?= $pru->pilihanraya_bil ?>" placeholder="Bilangan Pengundi:" class="form-control" required>
                    <label for="inputBilanganPengundi<?= $pru->pilihanraya_bil ?>" class="form-label">Bilangan Pengundi:</label>
                </div>
                <div class="text-center">
                    <input type="hidden" name="inputPilihanrayaBil" value="<?= $pru->pilihanraya_bil ?>">
                    <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                    <input type="hidden" name="inputWaktu" value="<?= date("Y-m-d H:i:s") ?>">
                    <button type="submit" class="btn btn-outline-secondary shadow-sm">Hantar</button>
                </div>
            </form>
            <div class="mt-3">
                <h5>Nota:</h5>
                <p>Bilangan Pengundi merujuk kepada bilangan pengundi (orang).</p>
            </div>
        </div>
    </div>


    <?php if(!empty($senaraiKeluarMengundi)): ?>
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Status Keluar Mengundi</h1>
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>DUN</th>
                            <th>Status Keluar Mengundi</th>
                            <th>Waktu</th>
                            <th>Operasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiKeluarMengundi as $skm): ?>
                        <tr>
                            <td><?= $skm->dun_nama ?></td>
                            <?php 
                            $bilanganPengundi = 0;
                            if(!empty($skm->dkmt_bilangan_pengundi)){
                                $bilanganPengundi = $skm->dkmt_bilangan_pengundi;
                            }
                            ?>
                            <td><?= number_format($bilanganPengundi, 0, '', ',') ?></td>
                            <td><?= $skm->dkmt_waktu ?></td>
                            <td class="text-center">
                                <!-- Large Modal -->
              <button type="button" class="btn btn-outline-danger shadow-sm" data-bs-toggle="modal" data-bs-target="#largeModal<?= $skm->dkmt_bil ?>">
                Padam
              </button>

              <div class="modal fade" id="largeModal<?= $skm->dkmt_bil ?>" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Padam Maklumat Status Keluar Mengundi</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <?= form_open('undi/padamStatusKeluarMengundiDun'); ?>
                    <div class="modal-body">                    
                        <p>Anda pasti untuk memadam maklumat ini?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="inputDkmtBil" value="<?= $skm->dkmt_bil ?>">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-outline-danger shadow-sm">Padam</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div><!-- End Large Modal-->
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php endforeach; ?>



    </section>

</main>


<?php $this->load->view('negeri_na/susunletak/bawah'); ?>