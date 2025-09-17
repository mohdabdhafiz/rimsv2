<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>KONFIGURASI RIMS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">DAERAH</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Daerah</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" colspan=2>BILANGAN DAERAH</th>
                            <th class="text-center"><?= count($senaraiDaerah) ?></th>
                        </tr>
                        <tr>
                            <th class="text-center">BIL</th>
                            <th>NEGERI</th>
                            <th>DAERAH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $bil = 1;
                            foreach($senaraiDaerah as $daerah):
                        ?>
                            <tr>
                                <td class="text-center"><?= $bil++ ?></td>
                                <td><?= $daerah->negeriNama ?></td>
                                <td><?= $daerah->daerahNama ?></td>
                            </tr>
                        <?php
                            endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    </section>

</main>


<?php $this->load->view($footer); ?>