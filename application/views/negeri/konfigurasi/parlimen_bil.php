<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi', 'Konfigurasi RIMS'); ?></li>
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi/parlimen', 'Parlimen'); ?></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $parlimen->pt_nama; ?></li>
  </ol>
</nav>

<?php 
$this->load->view('negeri/konfigurasi/nav_parlimen');
?>

<div class="p-3 border rounded mb-3">
    <div class="float-end">
    <?php echo anchor('konfigurasi/padam_parlimen/'.$parlimen->pt_bil, 'Padam', "class='btn btn-sm btn-danger w-100'"); ?>
    </div>
    <p><strong>Maklumat Parlimen</strong></p>
    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover">
            <tr>
                <th>Nama Parlimen</th>
                <td><?= $parlimen->pt_nama ?></td>
            </tr>
            <tr>
                <th>Negeri</th>
                <td>
                    <?php  
                    echo $parlimen->pt_negeri;
                    ?>
                </td>
            </tr>
            <tr>
                <th>Akaun PPD</th>
                <td>
                    <?php 
                    $ppd = $data_parlimen->senarai_tugas_ppd_bil($parlimen->pt_bil);
                    if(!empty($ppd)){
                        echo anchor('peranan/peranan_bil/'.$ppd->peranan_bil,$ppd->peranan_nama);
                    }else{
                    ?>
                    <?= anchor('konfigurasi/parlimen_set/'.$parlimen->pt_bil, 'Penetapan Penugasan parlimen', "class='btn btn-primary btn-sm w-100'") ?>
                    <?php } ?>
                </td>
            </tr>
        </table>
    </div>
    
</div>