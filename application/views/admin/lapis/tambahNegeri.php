<div class="p-3 mb-5">
    <p><strong>Calibration - Tambah Negeri dalam laporan</strong></p>
    <p>Bilangan Laporan = <?= count($senaraiPenuhLaporan) ?></p>
    <ol>
        <?php 
        foreach($senaraiPenuhLaporan as $laporan): ?>
        <li>
            <?= $laporan->ringkasan_isu ?><br>
            <?php
            $negeri = "Belum Ditetapkan";
            
            if(empty($laporan->negeri) && $negeri == "Belum Ditetapkan"){
                
                $shortFormKluster = $dataKlusterIsu->papar($laporan->kluster_bil);
                $dataKlusterIsu->tambahColumnNegeri($shortFormKluster->kit_shortform, $laporan->pelapor, date_format(date_create($laporan->tarikh_laporan), "Y"));
                echo $shortFormKluster->kit_nama."<br>";
                $negeriDaerah = $dataDaerah->negeriDaerahNama($laporan->daerah);
                if(!empty($negeriDaerah) && $negeri == "Belum Ditetapkan"){
                    $negeri = $negeriDaerah->nt_nama;
                }else{
                    $negeriParlimen = $dataParlimen->parlimen_bil($laporan->parlimen);
                    if(!empty($negeriParlimen) && $negeri == "Belum Ditetapkan"){
                        $negeri = $negeriParlimen->pt_negeri;
                    }else{
                        $negeriDun = $dataDun->dun($laporan->dun);
                        if(!empty($negeriDun) && $negeri == "Belum Ditetapkan"){
                            $negeri = $negeriDun->dun_negeri;
                        }
                    }
                }

                $listNegeri = $dataNegeri->negeri_nama($negeri);

                if(!empty($listNegeri)){
                    $dataKlusterIsu->masukNegeri(
                        $shortFormKluster->kit_shortform, 
                        $laporan->pelapor, 
                        date_format(date_create($laporan->tarikh_laporan), "Y"), 
                        $laporan->bil,
                        $listNegeri->nt_bil
                    );
                }

            }
            if(!empty($laporan->negeri) && $negeri == 'Belum Ditetapkan'){
                $maklumatNegeri = $dataNegeri->negeri($laporan->negeri);
                $negeri = $maklumatNegeri->nt_nama;
                $tempPengguna = $dataPengguna->maklumat_pengguna($laporan->pelapor);
                if(!empty($tempPengguna->pengguna_peranan_bil)){
                    $ada = $dataNegeri->ada($tempPengguna->pengguna_peranan_bil, $maklumatNegeri->nt_bil);
                    if(count($ada) == 0){
                        $dataNegeri->tambahTugasanNegeri($tempPengguna->pengguna_peranan_bil, $maklumatNegeri->nt_bil, $this->session->userdata('pengguna_bil'));
                    }
                }
            }

            

            if($negeri != 'Belum Ditetapkan'){
                $maklumatNegeri = $dataNegeri->negeri_nama($negeri);
                $tempPengguna = $dataPengguna->maklumat_pengguna($laporan->pelapor);
                if(!empty($tempPengguna->pengguna_peranan_bil)){
                    $ada = $dataNegeri->ada($tempPengguna->pengguna_peranan_bil, $maklumatNegeri->nt_bil);
                    if(count($ada) == 0){
                        $dataNegeri->tambahTugasanNegeri($tempPengguna->pengguna_peranan_bil, $maklumatNegeri->nt_bil, $this->session->userdata('pengguna_bil'));
                    }
                }
            }

                $negeri_pelapor_parlimen = $dataPengguna->negeri_parlimen($laporan->pelapor);
                if(!empty($negeri_pelapor_parlimen)){
                    $nama_negeri = $negeri_pelapor_parlimen->pt_negeri;
                    $maklumatNegeri = $dataNegeri->negeri_nama($nama_negeri);
                    $tempPengguna = $dataPengguna->maklumat_pengguna($laporan->pelapor);
                    if(!empty($tempPengguna->pengguna_peranan_bil)){
                        $ada = $dataNegeri->ada($tempPengguna->pengguna_peranan_bil, $maklumatNegeri->nt_bil);
                        if(count($ada) == 0){
                            $jadi = $dataNegeri->tambahTugasanNegeri($tempPengguna->pengguna_peranan_bil, $maklumatNegeri->nt_bil, $this->session->userdata('pengguna_bil'));
                            if(!$jadi){
                                die('Tak Jadi');
                            }
                        }
                    }
                }

                $negeriPelaporDun = $dataPengguna->negeri_dun($laporan->pelapor);
                if(!empty($negeriPelaporDun)){
                    $namaNegeri = $negeriPelaporDun->dun_negeri;
                    $maklumatNegeri = $dataNegeri->negeri_nama($namaNegeri);
                    $tempPengguna = $dataPengguna->maklumat_pengguna($laporan->pelapor);
                    if(!empty($tempPengguna->pengguna_peranan_bil)){
                        $adaDun = $dataNegeri->ada($tempPengguna->pengguna_peranan_bil, $maklumatNegeri->nt_bil);
                        if(count($adaDun) == 0){
                            $jadi = $dataNegeri->tambahTugasanNegeri($tempPengguna->pengguna_peranan_bil, $maklumatNegeri->nt_bil, $this->session->userdata('pengguna_bil'));
                            if(!$jadi){
                                die('Tak Jadi');
                            }
                        }else{
                            die(count($adaDun));
                        }
                    }
                }else{
                    die('xde pelapor');
                }

            ?>
            <strong>Negeri = <?= $negeri ?></strong><br>
        </li>
        <?php endforeach; ?>
    </ol>
</div>