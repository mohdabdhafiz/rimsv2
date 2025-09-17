<div class="row g-3 mb-3">
    <div class="col-12 col-lg-3">
        <div id="nav_ppd"></div>
    </div>
    <div class="col-12 col-lg-9">
            <div id="status"></div>
    </div>
</div>

<script>

    async function setNav()
    {
        const data = await getNav();
        document.getElementById("nav_ppd").innerHTML = data;
    }

    async function getNav()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/ppd/nav');
        const data = await response.text();
        return data;
    }

    async function setStatus()
    {
        const data = await getStatus();
        document.getElementById("status").innerHTML = data;
    }

    async function getStatus()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/pengguna/status');
        const data = await response.text();
        return data;
    }
    
    setNav();
    setStatus();

</script>