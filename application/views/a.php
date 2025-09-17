<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INTEREST</title>
    <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/rekabentuk.css'); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</head>
<body>
<div class="container-fluid">

    <div class="row g-3">

        <div class="col-lg-4">
            <div class="p-2">
            <div id="keputusan_pilihan_japen" class="bg-light text-dark p-3 rounded">
            
            </div>

            </div>
        </div>

        <div class="col-lg-4">
            <div class="p-2">
            <div id="keputusan_tidak_rasmi" class="bg-light text-dark p-3 rounded"></div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="p-2">
            <div id="keputusan_rasmi" class="bg-light text-dark p-3 rounded"></div>
            </div>
        </div>

        

    </div>

    <div class="row g-3">

        <div class="col-lg-12">
            <div class="p-2">
            <div id="senarai_dun" class="p-3">
            </div>
            </div>
        </div>

        

    </div>



</div>

<script src="<?php echo base_url('js/bootstrap.bundle.min.js') ?>"></script>
<script>

async function getKeputusanPilihanJapen()
{
    const response = await fetch("<?php echo base_url(); ?>data_virtualization/keputusan_pilihan_japen");
    const data = await response.text();
    return data;
}

async function setKeputusanPilihanJapen()
{
    const data = await getKeputusanPilihanJapen();
    document.getElementById("keputusan_pilihan_japen").innerHTML = data;
}

async function getKeputusanTidakRasmi()
{
    const response = await fetch("<?php echo base_url(); ?>data_virtualization/keputusan_tidak_rasmi_calc");
    const data = await response.text();
    return data;
}

async function setKeputusanTidakRasmi()
{
    const data = await getKeputusanTidakRasmi();
    document.getElementById("keputusan_tidak_rasmi").innerHTML = data;
}        

async function getKeputusanRasmi()
{
    const response = await fetch("<?php echo base_url(); ?>data_virtualization/keputusan_rasmi");
    const data = await response.text();
    return data;
}

async function setKeputusanRasmi()
{
    const data = await getKeputusanRasmi();
    document.getElementById("keputusan_rasmi").innerHTML = data;
}


async function getSenaraiDun()
{
    const response = await fetch("<?php echo base_url(); ?>data_virtualization/senarai_dun");
    const data = await response.text();
    return data;
}

async function setSenaraiDun()
{
    const data = await getSenaraiDun();
    document.getElementById("senarai_dun").innerHTML = data;
}

setInterval(setSenaraiDun, 1000);
setInterval(setKeputusanPilihanJapen, 1000);
setInterval(setKeputusanTidakRasmi, 1000);
setInterval(setKeputusanRasmi, 1000);

</script>


</body>
</html>