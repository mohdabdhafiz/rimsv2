<div class="p-5 mb-5">
    <p><strong>Senarai Pelapor <?= date("Y") ?></strong></p>
    <ol>
        <?php foreach($senaraiPelapor as $pelapor): ?>
        <li>
            <?php echo $pelapor->nama_penuh ?>
            <ol>
                <?php foreach($senaraiKluster as $kluster): ?>
                <li>
                    <?php 
                    $ada = 'Tiada'; 
                    $senaraiLaporan = $dataKlusterIsu->ada($kluster->kit_shortform, $pelapor->bil, date("Y"));
                    if($senaraiLaporan == 'FALSE'){
                        $ada = 'Tiada Maklumat';
                    }elseif(!empty($senaraiLaporan)){
                        $dataKlusterIsu->tambahColumnNegeri($kluster->kit_shortform, $pelapor->bil, date("Y"));
                        $dataKlusterIsu->tambahColumnCadanganIntervensi($kluster->kit_shortform, $pelapor->bil, date("Y"));
                        $ada = 'Bilangan Laporan = '.count($senaraiLaporan);
                    }else{
                        $dataKlusterIsu->tambahColumnNegeri($kluster->kit_shortform, $pelapor->bil, date("Y"));
                        $dataKlusterIsu->tambahColumnCadanganIntervensi($kluster->kit_shortform, $pelapor->bil, date("Y"));
                        $ada = 'Ada';
                    }
                    ?>
                    <?= $kluster->kit_nama ?> (<strong><?= $ada ?></strong>)
                </li>
                <?php endforeach; ?>
            </ol>
        </li>
        <?php endforeach; ?>
    </ol>
</div>