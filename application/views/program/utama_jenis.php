<div class="p-3 border rounded mb-3">
  <h3>JENIS PROGRAM</h3>
  <div class="row g-3 mt-3">
    <div class="col">
      <?php echo anchor('program', 'Program', "class = 'btn btn-primary w-100'"); ?>
    </div>
    <div class="col">
      <?php echo anchor('jenis/tambah', 'Tambah Jenis Program', "class = 'btn btn-secondary w-100'"); ?>
    </div>
  </div>
</div>
<div class="p-3 border rounded mb-3">
<p>Jenis program yang didaftarkan</p>
<?php if($senaraiJenis){ ?>
<div class="table-responsive">
  <table class="table table-hover table-sm">
    <tr>
      <th>Jenis Program</th>
      <th>Peruntukan Program (RM)</th>
      <th>Tindakan</th>
    </tr>
    <?php foreach($senaraiJenis as $jenis): ?>
      <tr>
        <td><?php echo $jenis->jt_nama; ?></td>
        <td><?php echo number_format((float)$jenis->jt_peruntukan, 2, '.', ','); ?></td>
        <td>
        </td>
      </tr>
      
    <?php endforeach; ?>
  </table>

</div>
<?php } else { ?>
<div class="alert alert-warning">
  Tiada program yang direkodkan.
</div>
  <?php } ?>
</div>
