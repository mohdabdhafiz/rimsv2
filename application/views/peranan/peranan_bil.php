<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?= anchor(base_url(), 'RIMS (JaPen Negeri)') ?></li>
    <li class="breadcrumb-item"><?= anchor('peranan', 'Peranan') ?></li>
    <li class="breadcrumb-item active" aria-current="page"><?= $peranan->peranan_nama ?></li>
  </ol>
</nav>

<?php $this->load->view('peranan/peranan_nav'); ?>

<div class="p-3 border rounded mb-3">
    <p><strong>Tugasan Daerah</strong></p>
    <div class="table-responsive">
        <table class="table table-sm table-hover table-bordered table-striped">
            <tr>
                <th>#</th>
                <th>Daerah</th>
                <th>Negeri</th>
            </tr>
            <?php
            $bilangan = 1;
            foreach($senarai_daerah as $daerah):
            ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td><?= $daerah->nama ?></td>
                <td><?= $daerah->nt_nama ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<div class="p-3 border rounded mb-3">
    <p><strong>Tugasan Parlimen</strong></p>
    <div class="table-responsive">
        <table class="table table-sm table-hover table-bordered table-striped">
            <tr>
                <th>#</th>
                <th>Parlimen</th>
                <th>Negeri</th>
            </tr>
            <?php
            $bilangan = 1;
            foreach($senarai_parlimen as $parlimen):
            ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td><?= $parlimen->pt_nama ?></td>
                <td><?= $parlimen->pt_negeri ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<div class="p-3 border rounded mb-3">
    <p><strong>Tugasan DUN</strong></p>
    <div class="table-responsive">
        <table class="table table-sm table-hover table-bordered table-striped">
            <tr>
                <th>#</th>
                <th>DUN</th>
                <th>Negeri</th>
            </tr>
            <?php
            $bilangan = 1;
            foreach($senarai_dun as $dun):
            ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td><?= $dun->dun_nama ?></td>
                <td><?= $dun->dun_negeri ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>