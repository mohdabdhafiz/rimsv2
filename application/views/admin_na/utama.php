<?php 
$this->load->view('admin_na/susunletak/atas');
$this->load->view('admin_na/susunletak/sidebar');
$this->load->view('admin_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@ADMIN</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="<?= base_url() ?>">Utama</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <?php $this->load->view('admin_na/admin_nav'); ?>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">DASHBOARD</h1>
            <ol>
                <li><a href="<?= site_url("admin/liveStatus") ?>">Live Status</a></li>
            </ol>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">RIMS@PERSONEL</h1>
            <ol>
                <li><a href="<?= site_url('personel/carian') ?>">Carian</a></li>
            </ol>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">RIMS@PROGRAM</h1>
            <ol>
                <li><a href="<?= site_url('admin/pemutihanProgram') ?>">Padam Semua Maklumat Program</a></li>
            </ol>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">CALIBRATION LAPIS</h1>
            <a href="<?= site_url('lapis/calib/2022') ?>">Calib</a>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">MODULE BAHARU</h5>
            <ol>
                <li>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>EasyBot</span>
                        <a href="<?= site_url('admin/easybot') ?>" class="btn btn-primary shadow-sm btn-sm">Lihat</a>
                    </div>
                </li>
                <li>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>ZG FORM</span>
                        <a href="<?= site_url('admin/zg') ?>" class="btn btn-primary shadow-sm btn-sm mt-3">Lihat</a>
                    </div>
                </li>
            </ol>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">EASY FORMS</h1>
            <!-- Easy Forms -->
<div id="c1">
    Fill out my <a href="http://localhost/app/app/form?id=2lyEsw">online form</a>.
</div>
        </div>
    </div>

    </section>

</main>


<script type="text/javascript">
    (function(d, t) {
        var s = d.createElement(t), options = {
            'id': '2lyEsw',
            'container': 'c1',
            'height': '373px',
            'form': '//localhost/app/app/embed'
        };
        s.type= 'text/javascript';
        s.src = '//localhost/app/static_files/js/form.widget.js';
        s.onload = s.onreadystatechange = function() {
            var rs = this.readyState; if (rs) if (rs != 'complete') if (rs != 'loaded') return;
            try { (new EasyForms()).initialize(options).display() } catch (e) { }
        };
        var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
    })(document, 'script');
</script>
<!-- End Easy Forms -->

<?php $this->load->view('admin_na/susunletak/bawah'); ?>