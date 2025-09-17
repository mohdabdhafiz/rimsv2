<?php
class Undi extends CI_Controller {

    public function statusKeluarMengundi($pilihanrayaBil){
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));

        //CHECK IF NEGERI
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }

        //LOAD MODEL
        $this->load->model('pilihanraya_model');

        //LOAD DATA
        $data['pru'] = $this->pilihanraya_model->pilihanraya($pilihanrayaBil);

        //ACCORDINGLY
        switch($sesi){
            case 'TOPONE' :

                //IF DUN
                if($data['pru']->pilihanraya_jenis == 'DUN'){

                    //LOAD MODEL
                    $this->load->model('dun_model');

                    //LOAD DATA
                    $data['senaraiDun'] = $this->dun_model->senarai_dun_pilihanraya_pengundi($data['pru']->pilihanraya_bil);

                    $this->load->view('topone/statusKeluarMengundiDun', $data);
                }

                break;
            default :
                redirect(base_url());
        }
    }

    public function dashboard($pilihanrayaBil){
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //CHECK IF NEGERI
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }

        //LOAD MODEL
        $this->load->model('pengguna_model');
        $this->load->model('pilihanraya_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['pru'] = $this->pilihanraya_model->pilihanraya($pilihanrayaBil);

        //ACCORDINGLY
        switch($sesi){
            case 'TOPONE' :
                //LOAD VIEW ATAS
                $this->load->view('susunletak/atas', $data);

                //IF DUN
                if($data['pru']->pilihanraya_jenis == 'DUN'){

                    //LOAD MODEL
                    $this->load->model('dun_model');

                    //LOAD DATA
                    $data['senaraiDun'] = $this->dun_model->senarai_dun_pilihanraya_pengundi($data['pru']->pilihanraya_bil);

                    $this->load->view('topone/rumusanKeluarMengundiDun', $data);
                }

                //LOAD VIEW BAWAH
                $this->load->view('susunletak/bawah');
                break;
            default :
                redirect(base_url());
        }
    }

    public function padamStatusKeluarMengundiDun(){
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        
        //CHECK IF NEGERI
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        //ACCORDINGLY
        switch($sesi){
            case 'NEGERI' :

                //LOAD MODEL
                $this->load->model('undi_model');
                $this->undi_model->padamStatusKeluarMengundiDun();
                redirect('undi/tambahKeluarMengundiDun');

                break;
            default :
                redirect(base_url());
        }
    }

    public function padamStatusKeluarMengundiParlimen(){
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        
        //CHECK IF NEGERI
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        //ACCORDINGLY
        switch($sesi){
            case 'NEGERI' :

                //LOAD MODEL
                $this->load->model('undi_model');
                $this->undi_model->padamStatusKeluarMengundiParlimen();
                redirect('undi/tambahKeluarMengundiParlimen');

                break;
            default :
                redirect(base_url());
        }
    }

    public function prosesKeluarMengundiParlimen(){
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        
        //CHECK IF NEGERI
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        //ACCORDINGLY
        switch($sesi){
            case 'NEGERI' :

                //LOAD MODEL
                $this->load->model('undi_model');
                $this->undi_model->tambahKeluarMengundiParlimen();
                $this->tambahKeluarMengundiParlimen();

                break;
            default :
                redirect(base_url());
        }
    }

    public function tambahKeluarMengundiParlimen(){
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $perananBil = $this->session->userdata('peranan_bil');
        
        //CHECK IF NEGERI
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        //ACCORDINGLY
        switch($sesi){
            case 'NEGERI' :

                //LOAD MODEL
                $this->load->model('pilihanraya_model');
                $this->load->model('parlimen_model');
                $this->load->model('undi_model');

                //SENARAI PILIHAN RAYA MENGIKUT PERANAN
			    $data['senaraiPilihanrayaNegeriParlimen'] = $this->pilihanraya_model->ikutNegeriParlimen($perananBil);
                $data['dataParlimen'] = $this->parlimen_model;
                $data['dataUndi'] = $this->undi_model;
                
                //LOAD VIEW
                $this->load->view('negeri_na/sismap/hari_mengundi/borangKeluarMengundiParlimen', $data);

                break;
            default :
                redirect(base_url());
        }
    }

    public function prosesKeluarMengundiDun(){
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $perananBil = $this->session->userdata('peranan_bil');
        
        //CHECK IF NEGERI
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        //ACCORDINGLY
        switch($sesi){
            case 'NEGERI' :

                //LOAD MODEL
                $this->load->model('undi_model');
                $this->undi_model->tambahKeluarMengundiDun();
                $this->tambahKeluarMengundiDun();

                break;
            default :
                redirect(base_url());
        }
    }

    public function tambahKeluarMengundiDun(){
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $perananBil = $this->session->userdata('peranan_bil');
        
        //CHECK IF NEGERI
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        //ACCORDINGLY
        switch($sesi){
            case 'NEGERI' :

                //LOAD MODEL
                $this->load->model('pilihanraya_model');
                $this->load->model('dun_model');
                $this->load->model('undi_model');

                //SENARAI PILIHAN RAYA MENGIKUT PERANAN
			    $data['senaraiPilihanrayaNegeriDun'] = $this->pilihanraya_model->ikutNegeriDun($perananBil);
                $data['dataDun'] = $this->dun_model;
                $data['dataUndi'] = $this->undi_model;
                
                //LOAD VIEW
                $this->load->view('negeri_na/sismap/hari_mengundi/borangKeluarMengundiDun', $data);

                break;
            default :
                redirect(base_url());
        }
    }

    public function rumusan(){
        $this->load->view('susunletak/atas');
        $this->load->view('undi/rumusan');
        $this->load->view('susunletak/bawah');
    }

    public function index()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'DATA' :
                $data['header'] = 'us_sismap_na/susunletak/atas';
                $data['sidebar'] = 'us_sismap_na/susunletak/sidebar';
                $data['navbar'] = 'us_sismap_na/susunletak/navbar';
                $data['footer'] = 'us_sismap_na/susunletak/bawah';
                $this->load->model('pilihanraya_model');
                $data['senaraiPru'] = $this->pilihanraya_model->senaraiPru();
                $this->load->view('sismap/undi/utama', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function operasi()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(empty($sesi)){
            redirect(base_url());
        }

        //SET IF NEGERI
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }

        //ACCORDINGLY
        switch($sesi){
            case 'NEGERI' :
                $this->load->view('susunletak/atas');
                $this->load->view('undi/nav');
                $this->load->view('undi/pilihan_kawasan');
                $this->load->view('susunletak/bawah');
                break;
            default :
                redirect(base_url());
        }
    }

    public function parlimen($parlimen_bil){
        $sesi = $this->session->userdata('peranan');
        if(empty($sesi)){
            redirect(base_url());
        }
        if(empty($parlimen_bil)){
            redirect(base_url());
        }
        $this->load->model('parlimen_model');
        $this->load->model('undi_model');
        $data['data_undi'] = $this->undi_model;
        $data['parlimen'] = $this->parlimen_model->parlimen_bil($parlimen_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('undi/nav');
        $this->load->view('undi/parlimen');
        $this->load->view('susunletak/bawah');
    }

    public function dun($dun_bil){
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(empty($sesi)){
            redirect(base_url());
        }
        if(empty($dun_bil)){
            redirect(base_url());
        }
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }

        //ACCORDINGLY
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('dun_model');
                $this->load->model('undi_model');
                $data['data_undi'] = $this->undi_model;
                $data['dun'] = $this->dun_model->dun_bil($dun_bil);
                $this->load->view('susunletak/atas', $data);
                $this->load->view('undi/nav');
                $this->load->view('undi/dun');
                $this->load->view('susunletak/bawah');
                break;
            default:
                redirect(base_url());
        }
        
    }

////PROSES////////////////////////////////////////////////

    public function proses_dun(){
        $this->load->model('undi_model');
        $this->load->model('pencalonan_model');
        $this->load->model('rekod_pilihanraya_model');
        $dun_bil = $this->input->post('input_dun_bil');
        $pilihanraya_bil = $this->input->post('input_pilihanraya_bil');
        $peti_undi = $this->input->post('input_peti_undi');
        $sebelum = $this->undi_model->pemenang_dun($dun_bil, $pilihanraya_bil); 
        if(empty($dun_bil)){
            base_url();
        }
        $calon = $this->input->post('input_calon_bil');
        $undi = $this->input->post('input_bilangan_pengundi');
        if(empty($calon)){
            base_url();
        }   
        $perubahan = FALSE;
        $bilangan = count($calon);
        for($i = 0; $i < $bilangan; $i++){
            $this->pencalonan_model->kosongkan($calon[$i]);
            $ada = $this->undi_model->undi_dun($calon[$i]);
            if(empty($ada)){
                $this->undi_model->tambah_undi_dun($calon[$i], $undi[$i], date('Y-m-d H:i:s'));
            }else{
                $this->undi_model->simpan_dun($undi[$i], $ada->kdt_bil, date('Y-m-d H:i:s'));
            }
        }
        $menang = $this->undi_model->pemenang_dun($dun_bil, $pilihanraya_bil); 
        $this->pencalonan_model->kemaskini_menang($menang->pencalonan_bil);
        $senarai_undi = $this->undi_model->senarai_pemenang_dun($dun_bil, $pilihanraya_bil);
        $susunan = array();
        foreach($senarai_undi as $undi){
            array_push($susunan, $undi->kdt_undi);
        }
        array_multisort($susunan, SORT_DESC);
        $majoriti = $susunan[0] - $susunan[1];
        $calon_selepas = $menang->pencalonan_bil;
        $calon_baru = $calon_selepas;
        //CALON BARU
        if(!empty($sebelum)){
            $calon_sebelum = $sebelum->pencalonan_bil;
            $perubahan = FALSE;
        }else{
            $perubahan = TRUE;
            $calon_sebelum = $calon_baru;
            $kategori_perubahan = "BARU";
            $this->rekod_pilihanraya_model->tambah_rekod_dun($dun_bil, $pilihanraya_bil, $kategori_perubahan, $calon_sebelum, $calon_selepas, $calon_baru, $majoriti, date('Y-m-d H:i:s'), "background:#b2a285; color:black;", $peti_undi);
        }
        //TUKAR
        if($calon_sebelum != $calon_selepas){
            $perubahan = TRUE;
            $kategori_perubahan = "TUKAR";
            $waktu = date("Y-m-d H:i:s");
            $warna = "background:#bbeebb; color:white;";
            $this->rekod_pilihanraya_model->tambah_rekod_dun($dun_bil, $pilihanraya_bil, $kategori_perubahan, $calon_sebelum, $calon_selepas, $calon_baru, $majoriti, $waktu, $warna, $peti_undi);
        }
        //MAJORITI > 5000
        if($majoriti > 9999){
            $perubahan = TRUE;
            $kategori_perubahan = "10000";
            $waktu = date("Y-m-d H:i:s");
            $warna = "background:blue; color:white;";
            $this->rekod_pilihanraya_model->tambah_rekod_dun($dun_bil, $pilihanraya_bil, $kategori_perubahan, $calon_sebelum, $calon_selepas, $calon_baru, $majoriti, $waktu, $warna, $peti_undi);
        }
        if($perubahan == FALSE){
            $perubahan = TRUE;
            $kategori_perubahan = "PENGEMASKINIAN MAKLUMAT";
            $waktu = date("Y-m-d H:i:s");
            $warna = "background:#f5f5e8; color:white;";
            $this->rekod_pilihanraya_model->tambah_rekod_dun($dun_bil, $pilihanraya_bil, $kategori_perubahan, $calon_sebelum, $calon_selepas, $calon_baru, $majoriti, $waktu, $warna, $peti_undi);

        }
        redirect('undi/dun/'.$dun_bil, 'refresh');
    }

    public function proses_parlimen()
    {
        $this->load->model('undi_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('rekod_pilihanraya_model');
        $parlimen_bil = $this->input->post('input_parlimen_bil');
        $pilihanraya_bil = $this->input->post('input_pilihanraya_bil');
        $peti_undi = $this->input->post('input_peti_undi');
        $sebelum = $this->undi_model->pemenang($parlimen_bil, $pilihanraya_bil); 
        if(empty($parlimen_bil)){
            base_url();
        }
        $calon = $this->input->post('input_calon_bil');
        $undi = $this->input->post('input_bilangan_pengundi');
        if(empty($calon)){
            base_url();
        }   
        $perubahan = FALSE;
        $bilangan = count($calon);
        for($i = 0; $i < $bilangan; $i++){
            $this->pencalonan_parlimen_model->kosongkan($calon[$i]);
            $ada = $this->undi_model->undi($calon[$i]);
            if(empty($ada)){
                $this->undi_model->tambah_undi($calon[$i], $undi[$i], date('Y-m-d H:i:s'));
            }else{
                $this->undi_model->simpan($undi[$i], $ada->kpt_bil, date('Y-m-d H:i:s'));
            }
        }
        $menang = $this->undi_model->pemenang($parlimen_bil, $pilihanraya_bil); 
        $this->pencalonan_parlimen_model->kemaskini_menang($menang->pencalonan_parlimen_bil);
        $senarai_undi = $this->undi_model->senarai_pemenang($parlimen_bil, $pilihanraya_bil);
        $susunan = array();
        foreach($senarai_undi as $undi){
            array_push($susunan, $undi->kpt_undi);
        }
        array_multisort($susunan, SORT_DESC);
        $majoriti = $susunan[0] - $susunan[1];
        $calon_selepas = $menang->pencalonan_parlimen_bil;
        $calon_baru = $calon_selepas;
        //CALON BARU
        if(!empty($sebelum)){
            $calon_sebelum = $sebelum->pencalonan_parlimen_bil;
            $perubahan = FALSE;
        }else{
            $perubahan = TRUE;
            $calon_sebelum = $calon_baru;
            $kategori_perubahan = "BARU";
            $this->rekod_pilihanraya_model->tambah_rekod_parlimen($parlimen_bil, $pilihanraya_bil, $kategori_perubahan, $calon_sebelum, $calon_selepas, $calon_baru, $majoriti, date('Y-m-d H:i:s'), "background:green; color:white;", $peti_undi);
        }
        //TUKAR
        if($calon_sebelum != $calon_selepas){
            $perubahan = TRUE;
            $kategori_perubahan = "TUKAR";
            $waktu = date("Y-m-d H:i:s");
            $warna = "background:red; color:white;";
            $this->rekod_pilihanraya_model->tambah_rekod_parlimen($parlimen_bil, $pilihanraya_bil, $kategori_perubahan, $calon_sebelum, $calon_selepas, $calon_baru, $majoriti, $waktu, $warna, $peti_undi);
        }
        //MAJORITI > 9999
        if($majoriti > 9999){
            $perubahan = TRUE;
            $kategori_perubahan = "10000";
            $waktu = date("Y-m-d H:i:s");
            $warna = "background:blue; color:white;";
            $this->rekod_pilihanraya_model->tambah_rekod_parlimen($parlimen_bil, $pilihanraya_bil, $kategori_perubahan, $calon_sebelum, $calon_selepas, $calon_baru, $majoriti, $waktu, $warna, $peti_undi);
        }
        if($perubahan == FALSE){
            $perubahan = TRUE;
            $kategori_perubahan = "PENGEMASKINIAN MAKLUMAT";
            $waktu = date("Y-m-d H:i:s");
            $warna = "background:#f5f5e8; color:white;";
            $this->rekod_pilihanraya_model->tambah_rekod_parlimen($parlimen_bil, $pilihanraya_bil, $kategori_perubahan, $calon_sebelum, $calon_selepas, $calon_baru, $majoriti, $waktu, $warna, $peti_undi);

        }
        redirect('undi/parlimen/'.$parlimen_bil, 'refresh');
    }



//////COMPONENT//////////////////////////////////////////

    //NAV
    public function nav_data(){
        $this->load->view('data/nav');
    }


    //PELAPORAN UNDIAN
    public function rumusan_undian(){
        $this->load->model('pilihanraya_model');
        $this->load->model('negeri_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('pencalonan_model');
        $this->load->model('parti_model');
        $data['data_parti'] = $this->parti_model;
        $data['data_calon_parlimen'] = $this->pencalonan_parlimen_model;
        $data['data_calon_dun'] = $this->pencalonan_model;
        $data['senarai_negeri'] = $this->negeri_model->senarai_negeri_ikut_parlimen();
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->aktif();
        $this->load->view('undi/komponen/senarai_undi', $data);
    }

    //SENARAI PARLIMEN MENGIKUT NEGERI
    public function senarai_parlimen(){
        $sesi = $this->session->userdata('peranan');
        if(strpos($sesi, 'NEGERI') !== FALSE){
            redirect(base_url());
        }
        $this->load->model('parlimen_model');
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('pengguna_model');
		$negeri = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
		$data['senarai_parlimen'] = $this->parlimen_model->paparIkutNegeri($negeri);
        $this->load->view('parlimen/senarai_parlimen', $data);
    }

    public function parlimen_undi($parlimen_bil){
        $this->load->model('parlimen_model');
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('harian_parlimen_model');
        $this->load->model('undi_model');
        $this->load->model('foto_model');
        $this->load->model('parti_model');
        $this->load->model('ahli_model');
        $this->load->model('rekod_pilihanraya_model');
        $data['data_rekod'] = $this->rekod_pilihanraya_model;
        $data['data_ahli'] = $this->ahli_model;
        $data['data_parti'] = $this->parti_model;
        $data['data_foto'] = $this->foto_model;
        $data['data_undi'] = $this->undi_model;
        $data['data_harian'] = $this->harian_parlimen_model;
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->parlimen_pr_aktif($parlimen_bil);
        $data['parlimen'] = $this->parlimen_model->parlimen_bil($parlimen_bil);
        $data['data_calon'] = $this->pencalonan_parlimen_model;
        $this->load->view('parlimen/tambah_undi', $data);
    }   

    public function senarai_undi($parlimen_bil){
        $this->load->model('parlimen_model');
        $this->load->model('undi_model');
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_parlimen_model');
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->parlimen_pr_aktif($parlimen_bil);
        $data['data_calon'] = $this->pencalonan_parlimen_model;
        $data['senarai_undi'] = $this->undi_model->senarai_parlimen($parlimen_bil);
        $data['data_undi'] = $this->undi_model;
        $data['parlimen'] = $this->parlimen_model->parlimen_bil($parlimen_bil);
        $this->load->view('parlimen/senarai_undi', $data);

    }

    

    //SENARAI DUN MENGIKUT NEGERI
    public function senarai_dun(){
        $sesi = $this->session->userdata('peranan');
        if(empty($sesi)){
            redirect(base_url());
        }
        if(strpos($sesi, 'NEGERI') !== FALSE){
            redirect(base_url());
        }
        $this->load->model('dun_model');
		$this->load->model('winnable_candidate_assign_model');
        $this->load->model('pengguna_model');
        $negeri = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
		$data['senarai_dun'] = $this->dun_model->dun_pr_aktif($negeri);
        $this->load->view('dun/senarai_dun', $data);
    }

    public function dun_undi($dun_bil){

        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));

        //CHECK IF NEGERI
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = "NEGERI";
        }

        //ACCORDINGLY
        switch($sesi){
            case 'NEGERI' : 
                $this->load->model('dun_model');
                $this->load->model('pilihanraya_model');
                $this->load->model('pencalonan_model');
                $this->load->model('harian_model');
                $this->load->model('undi_model');
                $this->load->model('foto_model');
                $this->load->model('parti_model');
                $this->load->model('ahli_model');
                $this->load->model('rekod_pilihanraya_model');
                $data['data_rekod'] = $this->rekod_pilihanraya_model;
                $data['data_ahli'] = $this->ahli_model;
                $data['data_parti'] = $this->parti_model;
                $data['data_foto'] = $this->foto_model;
                $data['data_undi'] = $this->undi_model;
                $data['data_harian'] = $this->harian_model;
                $data['senarai_pilihanraya'] = $this->pilihanraya_model->dun_pr_aktif($dun_bil);
                $data['dun'] = $this->dun_model->dun_bil($dun_bil);
                $data['data_calon'] = $this->pencalonan_model;
                $this->load->view('dun/tambah_undi', $data);
                break;
            default :
                redirect(base_url());
        }

       
    } 

}
?>