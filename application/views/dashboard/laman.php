<section class="section dashboard">

<div class="row">

    <div class="col-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Statistik Mengikut Negeri</h5>
                <div id="container-peta" style="width: 100%; height: calc(100vh - 100px); overflow: hidden;"></div>
            </div>
        </div>

        <div class="modal fade" id="infoModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Negeri</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalBody">
                        Loading...
                    </div>
                </div>
            </div>
        </div>


    </div>
                    
                            
                            

</div>

</section>

<!-- Template MALAYSIA MAPS JS File -->
<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/countries/my/my-all.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
// Data Contoh: Anda boleh pass ini dari PHP Controller menggunakan json_encode($data_negeri)
// Format key mestilah kod 'hc-key' untuk negeri di Malaysia (contoh: my-jh untuk Johor)
var dataStatistik = [
    ['my-sa', 10], // Sabah
    ['my-sk', 20], // Sarawak
    ['my-la', 30], // Labuan
    ['my-pg', 40], // Pulau Pinang
    ['my-kh', 50], // Kedah
    ['my-pl', 60], // Perlis
    ['my-pk', 70], // Perak
    ['my-kl', 80], // Kelantan
    ['my-tr', 90], // Terengganu
    ['my-ph', 100], // Pahang
    ['my-sl', 110], // Selangor
    ['my-kl', 120], // Kuala Lumpur
    ['my-pj', 130], // Putrajaya
    ['my-ns', 140], // Negeri Sembilan
    ['my-mk', 150], // Melaka
    ['my-jh', 160]  // Johor
];

Highcharts.mapChart('container-peta', {
    chart: {
        map: 'countries/my/my-all'
    },
    accessibility: {
        enabled: false
    },
    title: {
        text: 'Taburan Data Mengikut Negeri'
    },
    mapNavigation: {
        enabled: true,
        buttonOptions: {
            verticalAlign: 'bottom'
        }
    },
    colorAxis: {
        min: 0,
        minColor: '#E6E7E8',
        maxColor: '#0056b3' // Warna biru gelap untuk nilai tinggi
    },
    series: [{
        data: dataStatistik,
        name: 'Jumlah Data',
        states: {
            hover: {
                color: '#BADA55' // Warna bila mouse lalu
            }
        },
        dataLabels: {
            enabled: true,
            format: '{point.name}'
        },
        // --- EVENT BILA KLIK ---
        point: {
            events: {
                click: function () {
                    // Tunjuk Modal
                    var myModal = new bootstrap.Modal(document.getElementById('infoModal'));
                    
                    // Set Data dalam Modal
                    document.getElementById('modalTitle').innerText = this.name;
                    document.getElementById('modalBody').innerHTML = `
                        <h4>Statistik: ${this.value}</h4>
                        <p>Kod Negeri: ${this['hc-key']}</p>
                        <br>
                        <button class="btn btn-primary btn-sm" onclick="window.location.href='<?= site_url('laporan/detail/') ?>/${this['hc-key']}'">Lihat Perincian</button>
                    `;
                    
                    myModal.show();
                }
            }
        }
    }]
});
</script>