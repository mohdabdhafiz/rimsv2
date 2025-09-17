
<h1>Senarai DUN</h1>
            <div class="row g-1">
                <?php foreach($senarai_dun as $dun): ?>
                <div class="col">
                    <div class="p-3 border rounded bg-light">
                        <p><?php echo strtoupper($dun->dun_nama); ?></p> 
                        <table class="table table-bordered">
                            <tr>
                                <td >Jangkaan</td>
                                <td style="<?php echo $warna_parti->warna_parti_ikut_nama($keputusan->dun_jangkaan_japen($dun->dun_bil)); ?>"><?php echo $keputusan->dun_jangkaan_japen($dun->dun_bil); ?></td>
                            </tr>
                            <tr>
                                <td>Tidak Rasmi</td>
                                <td style="<?php echo $warna_parti->warna_parti_ikut_nama($keputusan->dun_tidak_rasmi($dun->dun_bil, $pilihanraya_bil)); ?>"><?php echo $keputusan->dun_tidak_rasmi($dun->dun_bil, $pilihanraya_bil); ?></td>
                            </tr>
                            <tr>
                                <td>Rasmi</td>
                                <td style="<?php echo $warna_parti->warna_parti_ikut_nama($keputusan->dun_rasmi($dun->dun_bil)); ?>"><?php echo $keputusan->dun_rasmi($dun->dun_bil); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
