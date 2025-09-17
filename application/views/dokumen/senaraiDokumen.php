<main id="main" class="main">
<div class="pagetitle">
    <h1>RIMS@PROGRAM - DOKUMEN SOKONGAN</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('program') ?>">Utama</a></li>
        </ol>
    </nav>
</div>
<section class="section">
    <?php $this->load->view($nav); ?>
    <div class="p-3 border rounded bg-white">
        <h1>Senarai Dokumen</h1>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombor Siri</th>
                        <th>Nama Dokumen</th>
                        <th>Nama Program</th>
                        <th>Tarikh Muat Naik</th>
                        <th>Pelapor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <?= $linksPagi ?>
        </div>
    </div>
</section>
</main>