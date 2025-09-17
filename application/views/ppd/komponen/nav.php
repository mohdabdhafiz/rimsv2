<div class="p-3 mb-3 text-center border rounded bg-light">
    <p class="mb-0"><strong><?= $this->session->userdata('pengguna_nama') ?></strong></p>
</div>

            <div class="p-3 border rounded">
                <p><strong>Akaun</strong></p>
                <ol>
                    <li><?php echo anchor('pengguna/tambah', 'Tambah Akaun Pegawai'); ?></li>
                    <li><?php echo anchor('pengguna/status_tambah', 'Status Akaun'); ?></li>
                    <li><?php echo anchor('pengguna/senarai_pegawai_kemaskini/'.$this->session->userdata('peranan'), 'Kemaskini Akaun Pegawai'); ?></li>
                    <li><a href="<?= site_url('pengguna/pertukaran') ?>">Pertukaran Pegawai</a></li>
                </ol>
                <?php if(count($senarai_anggota_nav) > 0){ ?>
                    <p><strong>Senarai Pegawai</strong></p>
                <p class="small text-muted">Senarai pegawai yang telah didaftarkan bagi tujuan pelaporan.</p>
                <ol>
                    <?php foreach($senarai_anggota_nav as $anggota): ?>
                    <li>
                        <?= $anggota->nama_penuh ?><br />
                        <span class="small text-muted"><?= $anggota->pekerjaan ?></span>
                    </li>
                    <?php endforeach; ?>
                </ol>
                <?php } ?>
                <p class="small"><span class="text-muted">Muat Turun:</span><br /><?php echo anchor(base_url('assets/manual/mp_pengguna.pdf'), 'Manual Pengguna bagi Modul Akaun Pegawai', "target='blank'"); ?></p>
            </div>