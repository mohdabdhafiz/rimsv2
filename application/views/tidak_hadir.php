<div class="container p-5">
    <h1>SENARAI PENGUNDI PUTIH YANG BELUM HADIR</h1>
    <p><strong>SENARAI PENGUNDI PUTIH YANG BELUM DIHUBUNGI BAGI DUN: <?php echo strtoupper($dun); ?></strong></p>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tr>
                <th>NAMA PENGUNDI</th>
                <th>NOMBOR KAD PENGENALAN</th>
                <th>NOMBOR TELEFON</th>
                <th>ALAMAT</th>
            </tr>
            <?php foreach($senarai_pengundi_putih as $pengundi): 
                if(!$data_kehadiran->semak($pengundi->ppt_no_ic)){?>
                <tr>
                    <td><?php echo $pengundi->ppt_nama_penuh; ?></td>
                    <td><?php echo $pengundi->ppt_no_ic; ?></td>
                    <td><?php echo $pengundi->ppt_no_tel; ?></td>
                    <td><?php echo $pengundi->ppt_alamat; ?></td>
                </tr>
                <?php } endforeach; ?>
        </table>
    </div>
</div>