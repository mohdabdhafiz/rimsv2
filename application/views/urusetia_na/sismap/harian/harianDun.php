<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('harian') ?>">Harian</a></li>
                <li class="breadcrumb-item active">Etnografi DUN</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Etnografi DUN</h5>

            <!-- Default Accordion -->
            <div class="accordion" id="accordionExample">
                <?php foreach($senaraiNegeri as $negeri): ?>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading<?= $negeri->nt_bil ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $negeri->nt_bil ?>" aria-expanded="false" aria-controls="collapse<?= $negeri->nt_bil ?>">
                      <?= $negeri->nt_nama ?>
                    </button>
                  </h2>
                  <div id="collapse<?= $negeri->nt_bil ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $negeri->nt_bil ?>" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr class="bg-primary text-white">
                        <th class="text-center" valign="middle">BIL</th>
                        <th valign="middle">DUN</th>
                        <th valign="middle">PARTI</th>
                        <th class="text-center" valign="middle" style="width:20%">GRADING</th>
                        <th class="text-center" valign="middle">OPERASI</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $senaraiDun = $dataDun->dun_negeri($negeri->nt_bil);
                    $count = 1; 
                    foreach($senaraiDun as $dun): 
                    $grading_harian = $data_harian->semasa_dun($dun->dun_bil); 
                    $grade = "";
                    if(!empty($grading_harian->harian_grading)){
                        $grade = $grading_harian->harian_grading;
                    }
                    ?>
                    <tr <?php if(!empty($grading_harian->harian_color)){ ?> style="<?php echo $grading_harian->harian_color; ?>" <?php }else{ ?> style="background:red; color:white;" <?php } ?>>
                        <?php echo form_open('harian/tambah_grading_harian_dun'); ?>
                        <td class="text-center" valign="middle"><?php echo $count++; ?></td>
                        <td valign="middle"><?php echo $dun->dun_nama; ?></td>
                        <td class="text-center" valign="middle">
                            <select name="input_parti_bil" id="input_parti_bil" class="form-control">
                                <option value="">Sila pilih..</option>
                                <?php foreach($senaraiParti as $parti): ?>
                                <option value="<?= $parti->parti_bil ?>" <?php if($parti->parti_bil == $grading_harian->harian_parti){ echo "selected"; } ?>>[<?= $parti->parti_singkatan ?>] <?= $parti->parti_nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td class="text-center" valign="middle">
                            <select name="input_grading" id="input_grading" class="form-control w-100">
                                <option value="0">Sila Pilih..</option>
                                <option value="PUTIH" <?php if($grade == "PUTIH"){ echo "selected"; } ?>>PUTIH</option>
                                <option value="KELABU PUTIH" <?php if($grade == "KELABU PUTIH"){ echo "selected"; } ?>>KELABU PUTIH</option>
                                <option value="KELABU HITAM" <?php if($grade == "KELABU HITAM"){ echo "selected"; } ?>>KELABU HITAM</option>
                                <option value="HITAM" <?php if($grade == "HITAM"){ echo "selected"; } ?>>HITAM</option>
                            </select>
                        </td>
                        <td class="text-center" valign="middle">
                            <input type="hidden" name="input_harian_bil" value="<?php $g_bil = ""; 
                            if(!empty($grading_harian->harian_bil)){ $g_bil = $grading_harian->harian_dun; } echo $g_bil;?>">
                            <input type="hidden" name="input_dun_bil" value="<?php echo $dun->dun_bil; ?>">
                            <input type="hidden" name="input_harian_tarikh" value="<?php echo date("Y-m-d"); ?>">
                            <button type="submit" class="btn btn-primary w-100">SIMPAN</button></td>
                        </form>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div><!-- End Default Accordion Example -->

            
        </div>
    </div>


    </section>

</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>