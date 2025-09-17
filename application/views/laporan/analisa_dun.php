<div class="row g-3">
                    <div class="col-lg-3 col-sm-12">
                        <div class="p-3">
                            <canvas id="analisa_dun" width="200" height="200"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-9 col-sm-12">
                        <div class="p-3">
                            <div class="row g-2">
                                <?php foreach($senarai_warna as $warna): ?>
                                <div class="col-12">
                                <p class="small text-muted mb-0">Kawasan "<?php echo $warna->harian_grading; ?>"</p>
                                    <div class="border rounded" style="<?php echo $warna->harian_color; ?>">
                                        
                                        <div class="row g-2" id="ad_papar_putih">
                                            <?php foreach($senarai_dun as $dun): if($dun->harian_grading == $warna->harian_grading && $dun->harian_color == $warna->harian_color) { ?>
                                            <div class="col">
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
                    getChart();

                    async function getChart(){
                        const gradingDun = await get_data();
                        const ctx = document.getElementById('analisa_dun').getContext('2d');
                        const myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: gradingDun.grading,
                        datasets: [{
                            label: 'Analisa Status DUN',
                            data: gradingDun.bilangan_dun,
                            backgroundColor: gradingDun.warna,
                            borderColor: 'rgb(129, 133, 137)',
                            borderWidth: 1,
                            hoverOffset: 4
                        }]
                    }
                });
                    }
              

async function get_data()
{
    var postData = new FormData();
    postData.append('tarikh', '<?php echo $tarikh; ?>');
    const response = await fetch("<?php echo base_url(); ?>laporan/data_dun", {
        method: 'POST',
        body: postData
    });
    const data = await response.json();
    const grading = [];
    const bilangan_dun = [];
    const warna = [];
    for(var count = 0; count < data.length; count++){
        grading.push(data[count].grading);
        bilangan_dun.push(data[count].bilangan_dun);
        warna.push(data[count].warna);
    }
    return { grading, bilangan_dun, warna };
}





</script>