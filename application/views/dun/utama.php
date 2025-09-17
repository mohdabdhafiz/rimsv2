
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'RIMS'); ?> </li>
    <li class="breadcrumb-item active" aria-current="page">DUN</li>
  </ol>
</nav>

<div class="p-3 border rounded mb-3">
<h3>SENARAI DUN</h3>
<p>BILANGAN DUN: <?php echo count($senarai_dun); ?></p>
<?php echo anchor('dun/daftar', 'Tambah DUN', 'class=" btn btn-primary w-100 mt-3"'); ?>
</div>

<div class="table-responsive mb-3">
  <table class="table table-hover table-bordered">
    <tr class="bg-secondary text-white">
      <th class="text-center">BIL</th>
      <th>NEGERI</th>
      <th class="text-center">BILANGAN DUN</th>
    </tr>
    <?php $jumlah_dun = 0; $count = 1; foreach($senarai_negeri as $negeri): ?>
    <tr>
      <td class="text-center"><?php echo $count++; ?></td>
      <td><?php echo anchor('dun/negeri/'.$negeri->nt_bil, $negeri->nt_nama); ?></td>
      <td class="text-center"><?php $kira_dun = count($data_dun->papar_ikut_negeri($negeri->nt_nama)); 
      $jumlah_dun = $jumlah_dun + $kira_dun;
      echo $kira_dun;?></td>
    </tr>
    <?php endforeach; ?>
    <tr class="bg-light">
      <th colspan=2 class="text-center">JUMLAH</th>
      <th class="text-center"><?php echo $jumlah_dun; ?></th>
    </tr>
  </table>
</div>

