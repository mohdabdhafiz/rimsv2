<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@KOMUNITI</h1>
        <nav>
            <ol class="breadcrumb">
                <?php foreach($breadCrumbs as $b): ?>
                    <li class="breadcrumb-item"><a href="<?= site_url($b['url']) ?>"><?= $b['title'] ?></a></li>
                <?php endforeach; ?>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <?php
    if(!empty($tabNav)){
        $this->load->view($tabNav);
    }
    if(!empty($gunaView)){
        $this->load->view($gunaView);
    }
    ?>

    </section>


</main>


<?php $this->load->view($footer); ?>