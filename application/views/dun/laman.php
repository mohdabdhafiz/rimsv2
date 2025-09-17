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
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">UTAMA</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('dun') ?>">DUN</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai DUN</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">BIL</th>
                            <th class="text-start">NEGERI</th>
                            <th class="text-start">DUN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $bil = 1;
                        foreach($senaraiDun as $dun):
                        ?>
                        <tr>
                            <td class="text-center"><?= $bil++ ?></td>
                            <td class="text-start"><?= $dun->negeriNama ?></td>
                            <td class="text-start"><?= $dun->dunNama ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </section>


</main>


<?php $this->load->view($footer); ?>