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
                <li class="breadcrumb-item active"><a href="<?= site_url('parlimen') ?>">PARLIMEN</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">SENARAI NEGERI DAN BILANGAN PARLIMEN</h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-start">NAMA NEGERI</th>
                            <th class="text-end">BILANGAN PARLIMEN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $parlimenJumlah = 0;
                        foreach($negeriParlimenSenarai as $np):
                            $parlimenJumlah = $parlimenJumlah + $np->bilanganParlimen;
                        ?>
                        <tr>
                            <td class="text-start"><a href="<?= site_url('parlimen/negeri/'.$np->negeriBil) ?>"><?= $np->negeriNama ?></a></td>
                            <td class="text-end"><?= $np->bilanganParlimen ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-start">JUMLAH</th>
                            <th class="text-end"><?= $parlimenJumlah ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    </section>


</main>


<?php $this->load->view($footer); ?>