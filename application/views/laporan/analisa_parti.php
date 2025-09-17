<div class="row g-3">
                    <div class="col-lg-6 col-sm-12">
                        <div class="p-3">
                            <canvas id="analisa_parti" width="200" height="200"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="p-3">
                            <div class="row g-2">
                                <?php foreach($senarai_parti as $parti): ?>
                                <div class="col">
                                    <div class="border rounded" style="<?php echo $parti->parti_warna; ?>">
                                        <div class="row g-2">
                                            <?php foreach($senarai_dun as $dun): if($dun->dun_bil == $parti->pencalonan_dun) { ?>
                                            <div class="col">
                                                <h2><?php echo $parti->parti_nama; ?><small class="text-muted">(<?php echo $parti->kira_parti; ?>)</small></h2>
                                                <div class="p-3 text-center">
                                                    <?php echo $dun->dun_nama; ?>
                                                </div>
                                            </div>
                                            <?php } endforeach; ?>
                                            
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                
                               
                                </div>
                                
                            </div>




                            
                            
                            
                            
                        </div>
                    </div>
                </div>


<script>
                    apChart();

                    async function apChart(){
                        const partiDun = await get_ap_data();
                        const ctx = document.getElementById('analisa_parti').getContext('2d');
                        const myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: partiDun.nama_parti,
                        datasets: [{
                            label: 'Analisa Status Parti Menang Mengikut Parti',
                            data: partiDun.bilangan_parti,
                            backgroundColor: partiDun.warna,
                            borderColor: 'rgb(129, 133, 137)',
                            borderWidth: 1,
                            hoverOffset: 4
                        }]
                    }
                });
                    }
              

async function get_ap_data()
{
    var postData = new FormData();
    postData.append('tarikh', '<?php echo $tarikh; ?>');
    const response = await fetch("<?php echo base_url(); ?>laporan/data_parti", {
        method: 'POST',
        body: postData
    });
    const data = await response.json();
    const nama_parti = [];
    const bilangan_parti = [];
    const warna = [];
    for(var count = 0; count < data.length; count++){
        nama_parti.push(data[count].nama_parti);
        bilangan_parti.push(data[count].bilangan_parti);
        warna.push(data[count].warna);
    }
    return { nama_parti, bilangan_parti, warna };
}





</script>