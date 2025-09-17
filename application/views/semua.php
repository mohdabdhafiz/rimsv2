<div class="container-fluid p-5">
    <h1 class="mb-5">LESTARI PENGUNDI (SLP)</h1>
    <div class="p-5 rounded bg-light mb-5">
        <h2>KEHADIRAN PENGUNDI</h2>
        <div class="row g-5">
            <div class="col-12 col-lg-4">
                <canvas id="chart_kehadiran" width="100" height="100"></canvas>
            </div>
        </div>
    </div>

    <div class="p-5 rounded bg-light mb-5">
        <h2>SDAFSOADFOSADFOSADOFAOSDFOS</h2>
        <div class="row g-5">
            <div class="col-12 col-lg-4">
                <canvas id="chart_2" width="100" height="100"></canvas>
            </div>
        </div>
    </div>

    <div class="p-5 rounded bg-light mb-5">
        <h2>SDAFSOADFOSADFOSADOFAOSDFOS</h2>
        <div class="row g-5">
            <div class="col-12 col-lg-4">
                <canvas id="" width="100" height="100"></canvas>
            </div>
        </div>
    </div>

</div>

<script>
const ctx = document.getElementById('chart_kehadiran').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['PENGUNDI PUTIH', 'BUKAN PENGUNDI PUTIH', 'BELUM KELUAR MENGUNDI'],
        datasets: [{
            label: '# of BILANGAN PENGUNDI',
            data: [12, 19, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    }
});

const ctx2 = document.getElementById('chart_2').getContext('2d');
const myChart2 = new Chart(ctx2, {
    type: 'pie',
    data: {
        labels: ['PENGUNDI PUTIH', 'BUKAN PENGUNDI PUTIH', 'BELUM KELUAR MENGUNDI'],
        datasets: [{
            label: '# of BILANGAN PENGUNDI',
            data: [12, 19, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    }
});

</script>
