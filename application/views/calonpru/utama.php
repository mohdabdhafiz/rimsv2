

<div class="d-flex justify-content-center border mb-3 p-2">
<h1>UTAMA</h1>
</div>

<?php foreach($data_dun as $dd): ?>
<div class="d-flex justify-content-evenly border mb-3 p-2">
<?php
echo anchor('pengguna', 'Pengguna', 'class="text-decoration-none"');
echo anchor('parti', 'Senarai Parti', 'class="text-decoration-none"');
echo anchor('ahli/daftar_calon/'.$dd->dun_bil, 'Daftar Calon', 'class="text-decoration-none"');
echo anchor('pengguna/logout', 'Logout', 'class="text-decoration-none btn btn-primary"');
?>
</div>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'INTEGRASI21', 'title="INTEGRASI21"'); ?> </li>
    <li class="breadcrumb-item">Pilihan Raya Umum Dewan Undangan Negeri Sarawak Ke-12 (2021)</li>
    <li class="breadcrumb-item active" aria-current="page">Senarai Calon PRU DUN <?php echo $dd->dun_nama; ?></li>
  </ol>
</nav>


<div class="border mb-3 p-2">
    <h1>Senarai Calon PRU DUN <?php echo $dd->dun_nama; ?></h1>
    <table class="table table-sm">
        <tr>
            <th>BIL</th>
            <th>FOTO CALON</th>
            <th>PARTI</th>
            <th>NAMA CALON</th>
            <th>UMUR</th>
            <th>PENDIDIKAN</th>
            <th>STATUS CALON</th>
            <th>SEMAKAN</th>
        </tr>
        <?php foreach($data_pencalonan as $sa): ?>
        <tr>
            <td><?php echo $sa->pencalonan_bil; ?></td>
            <td><img src="<?php echo base_url('assets/img/').$sa->foto_nama; ?>" class="img-fluid rounded" style="object-fit: cover;width: 200px;height: 200px"/> </td>
            <td style="text-align:center"><img src="<?php echo base_url('assets/img/'.$parti->logo($sa->pencalonan_parti)); ?>" class="img-fluid rounded" style="object-fit: cover;width: 100px;height: 100px"/> <br />
                <?php echo $sa->parti_singkatan; ?></td>
            <td><?php echo $sa->ahli_nama; ?></td>
            <td><?php echo $sa->ahli_umur; ?></td>
            <td><?php echo $sa->ahli_pendidikan; ?></td>
            <td>Calon Baharu</td>
            <td>DRAF</td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php endforeach; ?>