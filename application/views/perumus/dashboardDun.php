<?php
$dunBil = $dun->dun_bil;
$pilihanrayaBil = '';
?>

<div class="row g-3 mb-3">
    <div class="col-12">
        <div class="p-3 border rounded bg-primary text-white text-center">
            <h6 class="display-6">RUMUSAN DUN <?= strtoupper($dun->dun_nama) ?></h6>
        </div>
    </div>
    <div class="col-12 col-lg-3 col-md-6">
        <div class="p-3 border rounded text-center">
            <h1 class="display-1" id="bilanganPengundi">0</h1>
            <p class="text-muted">Bilangan Pengundi</p>
        </div>
    </div>
    <div class="col-12 col-lg-3 col-md-6">
        <div class="p-3 border rounded text-center">
            <h1 class="display-1"><?= count($senaraiDm) ?></h1>
            <p class="text-muted">Bilangan Daerah Mengundi</p>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="p-3 border rounded text-center">
            <h1 class="display-1" id="kaumDun">-</h1>
            <p class="text-muted">Majoriti Kaum</p>
        </div>
    </div>
    <?php
    foreach($senaraiPilihanraya as $pru): ?>
    <div class="col-12 col-lg-12">
        <div class="p-3 border rounded text-center bg-secondary text-white">
            <h3 class="display-3"><?= $pru->pilihanraya_singkatan ?></h3>
            <p class=""><?= $pru->pilihanraya_nama ?></p>
        </div>
    </div>
    <?php 
    $pilihanrayaBil = $pru->pilihanraya_bil;
    endforeach; ?>
    <div class="col-12">
        <div class="p-3 border rounded bg-light">
            <h3>PURATA MAJORITI SISMAP (%) MENGIKUT DUN <?= strtoupper($dun->dun_nama) ?></h3>
            <div class="row g-3">
                <div class="col-12 col-lg-12">
                    <div class="row g-3">
                        <div class="col-12 col-lg-12">
                            <canvas id="chartDun" height="100"></canvas>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="" id="showTableDun"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
    $count = 0;
    foreach($senaraiDm as $dm): 
        $majoritiKaum = '-';
        $jangkaanKeluarMengundi = 70;
        $pengundiJangkaan = floor(($jangkaanKeluarMengundi / 100) * $dm->pdt_bilangan_pengundi);
        ?>
    <div class="col-12">
        <div class="p-3 border rounded">
            <h3>PURATA MAJORITI SISMAP (%) MENGIKUT <?= strtoupper($dm->pdt_nama) ?></h3>
            <div class="mt-3 d-flex justify-content-between align-items-start">
                <div class="me-3">
                    <h5 class="display-5"><?= $dm->pdt_nama ?></h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <th>Majoriti Kaum</th>
                                <td><?= $majoritiKaum ?></td>
                            </tr>
                            <tr>
                                <th>Bilangan Pengundi</th>
                                <td><?= number_format($dm->pdt_bilangan_pengundi, 0, '', ',') ?></td>
                            </tr>
                            <tr>
                                <th>Jangkaan Keluar Mengundi (%)</th>
                                <td><?= $jangkaanKeluarMengundi ?></td>
                            </tr>
                            <tr>
                                <th>Bilangan Pengundi (Jangkaan)</th>
                                <td><?= number_format($pengundiJangkaan, 0, '', ',') ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="">
                    <canvas id="chart_dm_<?= $count++ ?>" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; //END SENARAI DM ?>
</div>

<script>

    async function setBilanganPengundi(){
        const bp = document.getElementById('bilanganPengundi');
        const response = await fetch("<?= site_url('dun/getBilanganPengundi/'.$dun->dun_bil) ?>");
        const getBilanganPengundi = await response.json();
        bp.innerText = getBilanganPengundi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function setKaumDun(){
        const k = document.getElementById('kaumDun');
        let tk = 'Melayu';
        k.innerText = tk.toUpperCase();
    }

    function setDm(){
        const bilanganDm = <?= json_encode(count($senaraiDm)); ?>;
        for(i = 0; i < bilanganDm; i++){
            let a =  'chart_dm_' + i;
            const ctx = document.getElementById(a);

            new Chart(ctx, {
                type: 'line',
                data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: 'Majoriti (%)',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.2
                }]
                }
            });
        }
    }

    

    async function setDun(){
            let a =  'chartDun';
            const showTableDun = document.getElementById('showTableDun');
            var labels = ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'];
            var peratusan = [65, 59, 80, 81, 56, 55, 40];
            var majoriti = [65, 59, 80, 81, 56, 55, 40];
            
            const hantarData = new FormData();
            hantarData.append("dunBil", <?= $dunBil ?>);
            hantarData.append("pilihanrayaBil", <?= $pilihanrayaBil ?>);
            const response = await fetch('<?= site_url('grading/getRumusanGradingDun') ?>', {
                method: 'POST',
                body: hantarData
            });
            const hasil = await response.json();
            labels = hasil.hari;
            peratusan = hasil.peratusan;

            let bilanganData = labels.length;
            const ctx = document.getElementById(a);

            new Chart(ctx, {
                type: 'line',
                data: {
                labels: labels,
                datasets: [{
                    label: 'Majoriti (%)',
                    data: peratusan,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.2
                }]
                }
            });

            var tableDun = document.createElement("table");
            tableDun.setAttribute('id', 'tableDun');
            tableDun.setAttribute('class', 'table w-100 table-sm table-bordered');
            showTableDun.appendChild(tableDun);

            var tableHeader = document.createElement('tr');
            tableHeader.setAttribute('id', 'tableHead');
            tableDun.appendChild(tableHeader);

            for(i = 0; i < bilanganData; i++){
                var tableCell = document.createElement('th');
                var isiCell = document.createTextNode(labels[i]);
                tableCell.setAttribute('class', 'text-center');
                tableCell.appendChild(isiCell);
                tableHeader.appendChild(tableCell);
            }

            var tableContent = document.createElement('tr');
            tableContent.setAttribute('id', 'tableCont');
            tableDun.appendChild(tableContent);

            for(i = 0; i < bilanganData; i++){
                var tableCell = document.createElement('td');
                var isiCell = document.createTextNode(peratusan[i] + '% (' + majoriti[i] + ')');
                tableCell.setAttribute('class', 'text-center');
                tableCell.appendChild(isiCell);
                tableContent.appendChild(tableCell);
            }

    }

    setInterval(5000, setBilanganPengundi());
    setInterval(5001, setKaumDun());
    setInterval(5002, setDun());
    setInterval(5003, setDm());
    
</script>