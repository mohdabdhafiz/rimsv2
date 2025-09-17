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
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">RIMS</a></li>
                <li class="breadcrumb-item active">RIMS@OBP</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="mb-5 mt-5">

        <section class="section">
            <div class="row">
                
                <?php if(!empty($h)): ?>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Senarai OBP</h5>
                                <a class="btn btn-outline-success float-end"
                                    href="<?php echo site_url('obp/tambah/'); ?>">Tambah</a>
                            </div>
                            <!-- Table with hoverable rows -->
                            <div class="table-responsive">
                                <table class="table table-hover datatable">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Nama</th>
                                            <th>Nombor Telefon</th>
                                            <th>Jawatan</th>
                                            <th>Daerah</th>
                                            <th>Parlimen</th>
                                            <th>DUN</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  
         foreach ($h as $row):  
          
            ?><tr>
                                            <td>
                                                <?php     
                                            if(empty($row->og_file))
                                            {
                                                ?>
                                                <img src="https://cdn-icons-png.flaticon.com/512/25/25634.png"
                                                    class="rounded-circle" alt="example placeholder"
                                                    style="width: 100px; max-height: 100px;" />
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <img src="<?php echo base_url('assets/img/obp/'.$row->og_file);?>"
                                                    class="rounded-circle" style="width: 100px; max-height: 100px;" />
                                                <?php
                                            }
                                            ?>
                                            </td>
                                            <td><?php echo $row->obp_nama;?></td>
                                            <td><?= $row->obp_no_tel ?></td>
                                            <td><?php echo $row->obp_jawatan;?></td>
                                            <td>
                                                <?php $daerah = $dataDaerah->daerah($row->daerah_id);
                                                if(!empty($daerah)){
                                                    echo $daerah->nama;
                                                }
                                                 ?>
                                            </td>
                                            <td>
                                                <?php $parlimen = $dataParlimen->parlimen_bil($row->parlimen_id);
                                                if(!empty($parlimen)){
                                                    echo $parlimen->pt_nama;
                                                }
                                                 ?>
                                            </td>
                                            <td>
                                                <?php $dun = $dataDun->dun($row->dun_id);
                                                if(!empty($dun)){
                                                    echo $dun->dun_nama;
                                                }
                                                 ?>
                                            </td>
                                            <td>
                                                <div class="row g-1">
                                                    <div class="col">
                                                        <a href="<?php echo site_url('obp/maklumat/'.$row->siriObp) ?>"
                                                            class="btn btn-sm btn-outline-info w-100">Maklumat
                                                            Lanjut</a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="<?php echo site_url('obp/kemaskini/'.$row->siriObp) ?>"
                                                            class="btn btn-sm btn-outline-primary w-100">Kemaskini</a>
                                                    </div>
                                                    <div class="col">
                                                        <!-- Extra Large Modal -->
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger w-100"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#ExtralargeModal<?php echo $row->siriObp; ?>">
                                                            Padam
                                                        </button>
                                                    </div>
                                                    <?= form_open('obp/proses_padam') ?>
                                                    <div class="modal fade"
                                                        id="ExtralargeModal<?php echo $row->siriObp; ?>" tabindex="-1">
                                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Padam Data</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div
                                                                        class="d-flex justify-content-evenly align-items center">
                                                                        <?php     
                                            if(empty($row->og_file))
                                            {
                                                ?>
                                                                        <img src="https://cdn-icons-png.flaticon.com/512/25/25634.png"
                                                                            class="rounded-circle"
                                                                            alt="example placeholder"
                                                                            style="width: 200px; max-height: 200px;" />
                                                                        <?php
                                            }
                                            else
                                            {
                                                ?>
                                                                        <img src="<?php echo base_url('assets/img/obp/'.$row->og_file);?>"
                                                                            class="rounded-circle"
                                                                            style="width: 200px; max-height: 200px;" />
                                                                        <?php
                                            }
                                                    ?> 
                                                                        <div class="row g-1">
                                                                            <div class="mt-5">
                                                                                <div class="mt-4">
                                                                                    <div>
                                                                                    Adakah anda pasti untuk padam data
                                                                                    bagi
                                                                                    OBP:
                                                                                    <br><b><?= $row->obp_nama; ?></b>
                                        </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="inputPeranan"
                                                                        value="<?= $this->session->userdata('peranan_bil')?>">
                                                                    <input type="hidden" name="inputPengguna"
                                                                        value="<?= $this->session->userdata('pengguna_bil') ?>">
                                                                    <input type="hidden" name="inputBil"
                                                                        value="<?= $row->siriObp ?>">
                                                                    <button type="submit"
                                                                        class="btn btn-outline-danger">Ya</button>
                                                                    <button type="button"
                                                                        class="btn btn-outline-primary"
                                                                        data-bs-dismiss="modal">Tidak</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- End Extra Large Modal-->

                                            </td>
                                        </tr>
                                        <?php 
         endforeach;
         ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table with hoverable rows -->
                        </div>
                    </div>
                    <?php endif; ?>

                </div>

                <?php if(empty($h)): ?>
                
                    <div class="alert alert-warning">
                        Tiada OBP yang telah didaftarkan.
                    </div>
                
                <?php endif; ?>


            </div>
        </section>
</main>
</div>
</div>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>