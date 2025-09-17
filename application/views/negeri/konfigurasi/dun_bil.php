<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi', 'Konfigurasi RIMS'); ?></li>
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi/dun', 'DUN'); ?></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $dun->dun_nama; ?></li>
  </ol>
</nav>

<?php 
$this->load->view('negeri/konfigurasi/nav_dun');
?>

<div class="p-3 border rounded mb-3">
    <div class="float-end">
    <?php echo anchor('konfigurasi/padam_dun/'.$dun->dun_bil, 'Padam', "class='btn btn-sm btn-danger w-100'"); ?>
    </div>
    <p><strong>Maklumat DUN</strong></p>
    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover">
            <tr>
                <th>Nama DUN</th>
                <td><?= $dun->dun_nama ?></td>
            </tr>
            <tr>
                <th>Negeri</th>
                <td>
                    <?= $dun->dun_negeri ?>
                </td>
            </tr>
            <tr>
                <th>Akaun PPD</th>
                <td>
                    <?php 
                    $ppd = $data_dun->senarai_tugas_ppd_bil($dun->dun_bil);
                    if(!empty($ppd)){
                        echo anchor('peranan/peranan_bil/'.$ppd->peranan_bil,$ppd->peranan_nama);
                    }else{
                    ?>
                    <?= anchor('konfigurasi/dun_set/'.$dun->dun_bil, 'Penetapan Penugasan DUN', "class='btn btn-primary btn-sm w-100'") ?>
                    <?php } ?>
                </td>
            </tr>
        </table>
    </div>
    
</div>