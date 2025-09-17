<?php foreach($parlimen as $p): ?>
    <div class="p-3 rounded border shadow my-3">
        <h1>Kemaskini Maklumat Parlimen</h1>
        <p><?php echo $p->pt_nama; ?></p>
        <div class="row g-3 mt-3">
            <div class="col">
                <?php echo anchor('parlimen/senarai', 'Senarai Penuh Maklumat Parlimen', "class = 'btn btn-primary w-100'"); ?>
            </div>
            <div class="col">
                <?php echo anchor('parlimen/daftar', 'Daftar Parlimen Baru', "class = 'btn btn-secondary w-100'"); ?>
            </div>
        </div>
    </div>
    <div class="p-3 rounded border shadow mb-3">
        <?php echo validation_errors(); ?>
        <?php echo form_open('parlimen/proses_kemaskini'); ?>
            <table class="table">
                <tr>
                    <th>Nama Parlimen</th>
                    <td><input type="text" name="inputParlimenNama" id="inputParlimenNama" value="<?php echo $p->pt_nama; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Negeri</th>
                    <td><select name="inputParlimenNegeri" id="inputParlimenNegeri" class="form-control">
                        <?php foreach($senaraiNegeri as $negeri): ?>
                            <option value="<?php echo $negeri; ?>" <?php if($negeri == $p->pt_negeri){ echo 'selected'; } ?>><?php echo $negeri; ?></option>
                        <?php endforeach; ?>
                    </select></td>
                </tr>
            </table>
            <input type="hidden" name="inputParlimenBil" value = "<?php echo $p->pt_bil; ?>">
            <div class="row g-3">
                <div class="col">
                    <button type="submit" class = "btn btn-primary w-100">Kemaskini Maklumat Parlimen</button>
                </div>
                <div class="col">
                    <button type="reset" class = 'btn btn-info w-100'>Set Semula</button>
                </div>
            </div>
        </form>
    </div>
<?php endforeach; ?>