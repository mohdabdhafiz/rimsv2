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
                        <h5 class="card-title">Senarai OBP</h5>
                        <div class="d-flex justify-content-end">
        <a class="btn btn-outline-success" href="<?php echo site_url('obp/tambah/'); ?>">Tambah</a>
</div>
                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <th></th>
                            <th>Nama OBP</th>
                            <th>Jawatan</th>
                            <th></th>

                            <?php  
         foreach ($h as $row):  
          
            ?><tr>
                                <td><img src="https://cdn-icons-png.flaticon.com/512/25/25634.png"
                                        class="rounded-circle" alt="example placeholder" style="width: 50px;" />
                                </td>
                                <td><?php echo $row->obp_nama;?></td>
                                <td><?php echo $row->obp_jawatan;?></td>
                                <td>
                                    <a class="btn btn-sm btn-outline-info" data-placement="top"
                                        href="<?php echo site_url('obp/maklumat/'.$row->obp_id); ?>">Maklumat
                                        Lanjut</a>
                                    <a class="btn btn-sm btn-outline-primary" data-placement="top"
                                        href="<?php echo site_url('obp/kemaskini/'.$row->obp_id); ?>">Kemaskini</a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#basicModal">
                                        Padam
                                    </button>
                                    <!-- Basic Modal -->
                                    <?= form_open('obp/proses_padam') ?>
                                    <input type="hidden" name="inputPengguna" value="1">
                                    <input type="hidden" name="inputBil" value="<?= $row->obp_id ?>">
                                    <div class="modal fade" id="basicModal" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Padam Data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body card text-center">
                                                    Adakah anda pasti untuk padam data bagi OBP:
                                                    <br><b><?= $row->obp_nama; ?></b>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-outline-danger">Ya</button>
                                                    <button type="button" class="btn btn-outline-primary"
                                                        data-bs-dismiss="modal">Tidak</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End Basic Modal-->

                                </td>
                            </tr>
                            <?php 
         endforeach;
         ?>
                        </table>
                        <!-- End Table with hoverable rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
</div>
</div>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>