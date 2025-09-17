<?php 
$this->load->view('negeri_na/susunletak/atas');
$this->load->view('negeri_na/susunletak/sidebar');
$this->load->view('negeri_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('harian') ?>">Harian</a></li>
                <li class="breadcrumb-item active">Etnografi Parlimen</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Etnografi Parlimen</h5>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr class="bg-primary text-white">
                        <th class="text-center" valign="middle">BIL</th>
                        <th valign="middle">PARLIMEN</th>
                        <th valign="middle">PARTI</th>
                        <th class="text-center" valign="middle" style="width:20%">GRADING</th>
                        <th class="text-center" valign="middle">OPERASI</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count = 1; 
                    foreach($senarai_parlimen as $parlimen): 
                    $grading_harian = $data_harian->semasa_parlimen($parlimen->pt_bil); 
                    $grade = "";
                    if(!empty($grading_harian->harian_parlimen_grading)){
                        $grade = $grading_harian->harian_parlimen_grading;
                    }
                    ?>
                    <tr <?php if(!empty($grading_harian->harian_parlimen_color)){ ?> style="<?php echo $grading_harian->harian_parlimen_color; ?>" <?php }else{ ?> style="background:red; color:white;" <?php } ?>>
                        <?php echo form_open('harian/tambah_grading_harian'); ?>
                        <td class="text-center" valign="middle"><?php echo $count++; ?></td>
                        <td valign="middle"><?php echo $parlimen->pt_nama; ?></td>
                        <td class="text-center" valign="middle">
                            <select name="input_parti_bil" id="input_parti_bil" class="form-control">
                                <option value="">Sila pilih..</option>
                                <?php foreach($senaraiParti as $parti): ?>
                                <option value="<?= $parti->parti_bil ?>" <?php if($parti->parti_bil == $grading_harian->harian_parlimen_parti){ echo "selected"; } ?>>[<?= $parti->parti_singkatan ?>] <?= $parti->parti_nama ?></option>
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
                            if(!empty($grading_harian->harian_parlimen_bil)){ $g_bil = $grading_harian->harian_parlimen_bil; } echo $g_bil;?>">
                            <input type="hidden" name="input_parlimen_bil" value="<?php echo $parlimen->pt_bil; ?>">
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


    </section>

</main>


<?php $this->load->view('negeri_na/susunletak/bawah'); ?>