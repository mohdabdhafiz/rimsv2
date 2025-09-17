

<div class="d-flex justify-content-center border mb-3 p-2">
<h1>UTAMA</h1>
</div>

<div class="d-flex justify-content-evenly border mb-3 p-2">
<?php
echo anchor('pengguna', 'Pengguna', 'class="text-decoration-none"');
echo anchor('iow', 'Laporan Info on Wheels (IOW)', 'class="text-decoration-none"');
echo anchor('foto', 'Arkib Foto', 'class="text-decoration-none"');
echo anchor('pengguna/logout', 'Log Keluar', 'class="text-decoration-none btn btn-primary"');
?>
</div>