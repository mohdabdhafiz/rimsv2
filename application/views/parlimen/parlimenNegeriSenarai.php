<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS - PARLIMEN</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">UTAMA</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('parlimen') ?>">PARLIMEN</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('parlimen/negeri/'.$negeri->nt_bil) ?>">SENARAI PARLIMEN BAGI <?= strtoupper($negeri->nt_nama) ?></a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <a href="<?= site_url('parlimen') ?>" class="btn btn-info shadow-sm mb-3">KEMBALI</a>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">SENARAI PARLIMEN</h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-start">NAMA PARLIMEN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($parlimenSenarai as $parlimen):
                        ?>
                        <tr>
                            <td class="text-start"><a href="<?= site_url('parlimen/bil/'.$parlimen->parlimenBil) ?>"><?= $parlimen->parlimenNama ?></a></td>
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