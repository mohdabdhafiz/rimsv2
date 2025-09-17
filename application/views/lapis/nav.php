<?php $peranan_bil = $this->session->userdata('peranan_bil');
if(empty($peranan_bil)){
    redirect(base_url());
}
?>

<div class="p-3 border rounded mb-3">
    <p><strong>RIMS@LAPIS</strong></p>
    <div class="row g-3 mt-3">
        <div class="col-12 col-lg-4 col-md-4">
            <?php echo anchor('lapis', 'RIMS@LAPIS', "class='btn btn-sm btn-outline-success w-100'"); ?>
        </div>
        <div class="col-12 col-lg-4 col-md-4">
        <?php echo anchor('lapis/maklumat_penuh', 'Senarai Penuh Pelaporan', "class='btn btn-sm btn-outline-success w-100'"); ?>
        </div>
        <div class="col-12 col-lg-4 col-md-4">
            <?php echo anchor('lapis/pilih_kluster', 'Tambah Laporan', "class='btn btn-sm btn-outline-success w-100'"); ?>
        </div>
    </div>
</div>