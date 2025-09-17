<div class="row g-2">
    
    <h1 class="display-1">Pilih DUN</h1>

    <div class="col-12">
    <div class="p-3 bg-light border rounded">
        <p>Jika tiada dalam senarai. Tambah DUN:</p>
        <?php echo form_open('dun/daftar'); ?>
            <div class="form-row row">
                <div class="col-6 mb-3">
                <input type="text" id="dun_nama" name="dun_nama" class="form-control" placeholder="Nama DUN">
                </div>
                <div class="col-6 mb-3">
                <input type="text" id="dun_negeri" name="dun_negeri" class="form-control" placeholder="Negeri">
                </div>
                <input type="hidden" name="dun_pengguna" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                <div class="col-12 mb-3">
                    <button type="submit" class="btn btn-sm btn-primary">Daftar DUN</button>
                </div>
            </div>
        </form>
    </div>
    </div>

    <div class="col-12 align-items-center">
        <div class="p-3 bg-light border rounded">
            <p class="small text-muted mb-0">Carian Mengikut DUN:</p>
        <?php echo form_open('dun/cari'); ?>
            <div class="row g-1">
                <div class="col-10">
                    <input type="text" name="dun_nama" id="dun_nama" class="form-control">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary">Cari DUN</button>
                </div>
            </div>
        </form>
    </div></div>
    
    <?php foreach($senarai_negeri as $negeri): ?>
    <div class="col-12">
        <div class="row g-3">
            <div class="col">
                <h2><?php echo $negeri->dun_negeri; ?></h2>
            </div>
        </div>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-2 g-lg-3">
            <?php
            foreach($senarai_dun as $dun): 
                if($dun->dun_negeri == $negeri->dun_negeri){
                    echo "<div class='col'><div class='p-3 border rounded bg-light text-center'>";
                    echo anchor('dun/papar_dun/'.$dun->dun_bil, $dun->dun_nama, 'class="text-decoration-none text-dark"');
                    echo "</div></div>";
                }
            endforeach; ?>
        </div>
        <div class="row">
            <small class="text-muted">Klik pada nama DUN untuk operasi seterusnya.</small>
        </div>
    </div>
    <?php endforeach; ?>

    
    
</div>
    </div>

</div>