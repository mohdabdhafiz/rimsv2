<?php $harian = $dataHarian->senaraiStatus($pilihanrayaBil);
$jumlahDUN = 0;
$jumlahDUN = count($senaraiDUNPencalonan);
?>


<?php foreach($senaraiPilihanraya as $pr2)
{
    $tarikhLockStatus = $pr2->pilihanraya_penamaan_calon;
}
?>

<div class="p-3 border rounded shadow my-3">
    <h2>Jangkaan Keputusan</h2>
    <div class="row g-3">
        <div class="col">
            <div class="p-3 border shadow-sm">
                <p>Terdapat persaingan sengit antara [parti A] dan [parti B] dalam mengekal atau menguasai kerusi-kerusi Parlimen.</p>
                <p>[Parti A] dijangka boleh menang di [kerusi Parti A] kerusi, manakala [Parti B] pula boleh menang di [kerusi Parti B] kerusi dengan julat perbezaan hanya [kerusi Parti A - kerusi Parti B] kerusi sahaja.</p>
                <p>Di pihak [Parti C] pula, parti itu dijangka hanya mampu memenangi sebanyak [kerusi Parti C] kerusi sahaja.</p>
            </div>
        </div>
        <div class="col">
        <canvas id="analisaDun" width="400" height="400"></canvas>
<script>
const ctx = document.getElementById('analisaDun').getContext('2d');
const senaraiParti = await dataParti();
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['red', 'blue'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

function dataParti()
{
    var postData = new FormData()
}
</script>

        </div>
    </div>
</div>

<div class="p-3 border rounded shadow mb-3">
    <h2>Analisa Keseluruhan</h2>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>DUN</th>
                <?php $senaraiTarikh = $dataHarian->senaraiTarikh($pilihanrayaBil); 
                foreach($senaraiTarikh as $t):?>
                <th><?php echo date_format(date_create($t->harian_tarikh), "d.m.Y"); ?></th>
                <?php endforeach; ?>
            </tr>
            <?php foreach($senaraiDUNPencalonan as $dun):
                $maklumatDUN = $dataDUN->papar($dun->pencalonan_dun);
                foreach($maklumatDUN as $d): ?>
            <tr>
                <td><?php echo $d->dun_nama; ?></td>
                <?php $senaraiTarikh = $dataHarian->senaraiTarikh($pilihanrayaBil); 
                foreach($senaraiTarikh as $t):?>
                <?php
                $senaraiStatus = $dataHarian->semak_ikut_tarikh($d->dun_bil, $pilihanrayaBil, $t->harian_tarikh); 
                foreach($senaraiStatus as $status){
                    echo "<td style='$status->harian_color'>".$status->harian_grading."</td>";
                }?>
                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<div class="p-3 border rounded shadow mb-3">
<h2>Analisa Status DUN</h2>
<p>Tarikh: <?php $today = date_format(date_create(), "d.m.Y"); 
if($today < $tarikhLockStatus)
{
    $today = date_format(date_create($tarikhLockStatus), "d.m.Y"); 
}
echo $today; ?></p>
<table class="table border">
    <tr>
        <th>STATUS</th>
        <th>BILANGAN DUN</th>
        <th>PERATUSAN (%)</th>
    </tr>
    <?php foreach($harian as $h): ?>
    <tr>
        <td><?php echo $h->harian_grading; ?></td>
        <td><?php $senaraiStatus = $dataHarian->dunStatus($pilihanrayaBil, date_format(date_create($today),'Y-m-d'), $h->harian_grading); 
        $bilanganDUN = count($senaraiStatus); 
        echo $bilanganDUN; ?></td>
        <td> <?php $peratusan = ($bilanganDUN/$jumlahDUN)*100; 
        echo $peratusan; ?></td>
    </tr>
    <?php $bilanganDUN = 0;
    $peratusan = 0;  
    endforeach; ?>
</table>
</div>

<div class="p-3 border rounded shadow mb-3">
    <div class="row g-3">
        <?php foreach($harian as $h): ?>
        <div class="col-12">
            <div class="p-3 border rounded">
                <p>Kawasan <?php echo $h->harian_grading;
                $senaraiDUNGrading = $dataHarian->senaraiDUNGrading($pilihanrayaBil, $h->harian_grading, $today);
                ?></p>
                <div class="row g-3">
                    <?php foreach($senaraiDUNGrading as $DG): ?>
                    <div class="col">
                        <div class="p-3">
                        <?php
                        $senaraiDUN = $dataDUN->papar($DG->harian_dun); 
                        foreach($senaraiDUN as $dun){
                            echo $dun->dun_nama;
                        }?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>