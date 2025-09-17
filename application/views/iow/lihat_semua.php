<div class="d-flex justify-content-center border mb-3 p-2">
    <h1 class="display-1">Info On Wheels</h1>
</div>

<div class="d-flex justify-content-evenly border mb-3 p-2">
    <?php echo anchor('iow/tambah', 'Tambah Perancangan / Makluman Awal', 'title="Tambah Perancangan / Makluman Awal"'); ?>  
    <?php echo anchor('iow/jenis', 'Operasi IOW', 'title="Operasi Info On Wheels"'); ?>
</div>

<div class="border mb-3 p-2">
    <h2 class="display-2">Senarai IOW</h2>
    <h3 class="display-3 mt-5">Senarai Perancangan / Makluman Awal</h3>

    <table class="table table-hover table-sm">
        <tr>
            <th>#</th>
            <th>PROGRAM</th>
            <th>TARIKH</th>
            <th>MASA MULA</th>
            <th>MASA TAMAT</th>
            <th>LOKASI</th>
            <th>PETUGAS</th>
            <th>PEJABAT</th>
            <th>NEGERI</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Program Info On Wheels (IOW) Pematuhan SOP dan Kempen Kibar Jalur Gemilang</td>
            <td>3.8.2021</td>
            <td>2.00 petang</td>
            <td>4.00 petang</td>
            <td>1. Pangsapuri Baiduri <br />
                2. Jalan Perindustrian Mahkota <br />
                3. Jalan Kesuma
            </td>
            <td>
                1. Hafif <br />
                2. Farid
            </td>
            <td>Pejabat Penerangan Daerah Hulu Langat</td>
            <td>Selangor</td>
        </tr>
    </table>

    <a href="#">Senarai Penuh Perancangan / Makluman Awal</a>

    <h3 class="display-3 mt-5">Senarai Laporan Penuh IOW</h3>

    <table class="table table-hover table-sm">
        <tr>
            <th>#</th>
            <th>PROGRAM</th>
            <th>TARIKH</th>
            <th>MASA MULA</th>
            <th>MASA TAMAT</th>
            <th>PARLIMEN</th>
            <th>DUN</th>
            <th>PEJABAT</th>
            <th>NEGERI</th>
        </tr>
        <tr>
            <td><?php $id_laporan="SEL1"; echo $id_laporan; ?></td>
            <td><?php echo anchor('iow/laporan_iow/'.$id_laporan, 'Info On Wheels (IOW) Daerah Hulu Selangor (IOW Merdeka - Tidak Berbayar)', 'title="Info On Wheels (IOW) Daerah Hulu Selangor (IOW Merdeka - Tidak Berbayar)"'); ?></td>
            <td>7.8.2021</td>
            <td>10.00 pagi</td>
            <td>1.30 tengah hari</td>
            <td>Hulu Selangor</td>
            <td>Batang Kali & Kuala Kubu Bharu</td>
            <td>Pejabat Penerangan Daerah Hulu Selangor</td>
            <td>Selangor</td>
        </tr>
    </table>

    <a href="#">Senarai Penuh Laporan</a>
</div>