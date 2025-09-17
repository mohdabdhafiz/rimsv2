<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_virtualization extends CI_Controller {

    public function senarai_penuh($pilihanraya_bil)
    {
        $sesi = $this->session->userdata('peranan');
        if(strtoupper($sesi) != 'TOPONE'){
            redirect(base_url());
        }
        $this->load->model('pilihanraya_model');
        $data['pru'] = $this->pilihanraya_model->pilihanraya($pilihanraya_bil);
        $this->load->view('susunletak/atas', $data);
        if($data['pru']->pilihanraya_jenis == "PARLIMEN"){
            $this->load->view('topone/keputusan_pilihanraya_penuh');
        }
        if($data['pru']->pilihanraya_jenis == "DUN"){
            $this->load->view('topone/keputusan_pilihanraya_penuh');
        }
        $this->load->view('susunletak/bawah');
    }

    public function keputusan_pilihanraya($pilihanraya_bil){
        $sesi = $this->session->userdata('peranan');
        if(strtoupper($sesi) != 'TOPONE'){
            redirect(base_url());
        }
        if(empty($pilihanraya_bil)){
            redirect(base_url());
        }
        $this->load->model('pilihanraya_model');
        $data['pru'] = $this->pilihanraya_model->pilihanraya($pilihanraya_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('topone/keputusan_pilihanraya');
        $this->load->view('susunletak/bawah');
    }

    

    public function index(){
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_model');
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['penjuru'] = $this->pencalonan_model->kira_penjuru($pilihanraya_bil);
        $data['jumlah_calon'] = count($this->pencalonan_model->papar_ikut_calon($pilihanraya_bil));
        $this->load->view('susunletak/atas', $data);
        $this->load->view('urusetia/urusetia_nav');
        $this->load->view('data_virtualization/utama');
        $this->load->view('susunletak/bawah');
    }
    
    public function pilih($bil)
    {
        switch($bil){
            case "1" :$this->load->view('data_virtualization/landing_one'); break;
            case "2" :$this->load->view('data_virtualization/landing_two'); break;
            case "3" : redirect('data_virtualization/tidak_rasmi', 'refresh'); break;
            case "4" :
                $this->load->model('dun_model');
                $this->load->model('pencalonan_model');
                $data['senarai_dun'] = $this->pencalonan_model->dun_pilihanraya($this->session->userdata('pilihanraya_bil'));
                $data['senarai_calon'] = $this->pencalonan_model;
                $this->load->view('susunletak/atas', $data);
                $this->load->view('b', $data); 
                $this->load->view('susunletak/bawah');
                break;
            default: redirect(base_url());
        }
    }

    public function pilih_pilihanraya()
    {
        $pilihanraya_bil = $this->input->post('input_pilihanraya_bil');
        if(empty($pilihanraya_bil))
        {
            $this->pilihanraya_parlimen(1);
        }
        else
        {
            $this->pilihanraya_parlimen($pilihanraya_bil);
        }
    }

    public function pilihanraya_parlimen($pilihanraya_bil)
    {
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_parlimen_model');
        //PARLIMEN
        if(empty($pilihanraya_bil)){
        $data['pru'] = $this->pilihanraya_model->pilihanraya_parlimen_baru();
        }else{
            $tmp_pr = $this->pilihanraya_model->pilihanraya($pilihanraya_bil);
            if(!empty($tmp_pr)){
                $data['pru'] = $this->pilihanraya_model->pilihanraya($pilihanraya_bil);
            }else{
                $data['pru'] = $this->pilihanraya_model->pilihanraya_parlimen_baru();
            }
        }
        $this->load->model('parlimen_model');
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('pengguna_model');
        $this->load->model('pencalonan_model');
        $this->load->model('pencalonan_parlimen_model');
        $data['data_pencalonan_parlimen'] = $this->pencalonan_parlimen_model;
        $data['data_pencalonan_dun'] = $this->pencalonan_model;
        $negeri = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->papar_aktif();
        $data['data_pilihanraya'] = $this->pilihanraya_model;
        $data['data_parlimen'] = $this->parlimen_model;
        $data['negeri'] = $negeri;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('data_virtualization/landing_negeri');
        $this->load->view('susunletak/bawah');
    }

    public function tidak_rasmi()
    {
        $this->load->model('pencalonan_model');
        $this->load->model('pilihanraya_model');
        $data['pilihanraya_bil'] = "4";
        $data['senarai_dun'] = $this->pencalonan_model->dun_pilihanraya($data['pilihanraya_bil']);
        $data['keputusan'] = $this->pilihanraya_model;
        $this->load->view('susunletak/atas');
        $this->load->view('data_virtualization/keputusan', $data);
        $this->load->view('susunletak/bawah');
    }

    public function senarai_dun()
    {
        $this->load->model('pencalonan_model');
        $this->load->model('pilihanraya_model');
        $this->load->model('parti_model');
        $data['pilihanraya_bil'] = "4";
        $data['senarai_dun'] = $this->pencalonan_model->dun_pilihanraya($data['pilihanraya_bil']);
        $data['keputusan'] = $this->pilihanraya_model;
        $data['warna_parti'] = $this->parti_model;
        return $this->load->view('keputusan_senarai_dun', $data); 
    }

    public function keputusan_tidak_rasmi_calc()
    {
        $this->load->model('pencalonan_model');
        $this->load->model('pilihanraya_model');
        $this->load->model('parti_model');
        $data['pilihanraya_bil'] = "4";
        $data['ktr_tajuk'] = "KEPUTUSAN TIDAK RASMI";
        $senarai_parti = $this->parti_model->parti_ikut_pilihanraya($data['pilihanraya_bil']);
        $list_parti = array();
        $count = 0;
        foreach($senarai_parti as $parti)
        {
            $list_parti[$count]['bilangan_kerusi'] = $this->pilihanraya_model->keputusan_tidak_rasmi($data['pilihanraya_bil'], $parti->pencalonan_parti); 
            $list_parti[$count]['nama_parti'] = $parti->parti_nama;
            $list_parti[$count]['parti_bil'] = $parti->pencalonan_parti;
            $count++;
        }
        $tempMax = 0;
        $id = 0;
        for($i = 0; $i < $count; $i++)
        {
            if($list_parti[$i]['bilangan_kerusi'] > $tempMax)
            {
                $tempMax = $list_parti[$i]['bilangan_kerusi'];
                $id = $i;
            }
        }
        $data['parti_kerusi'] = $list_parti;
        $data['ktr_nama_parti'] = $list_parti[$id]['nama_parti'];
        $data['ktr_bilangan_kerusi'] = $list_parti[$id]['bilangan_kerusi'];
        if($data['ktr_bilangan_kerusi'] == 0)
        {
            $data['ktr_nama_parti'] = 'BELUM DITENTUKAN';
        }
        $parti_bil = $list_parti[$id]['parti_bil'];
        $kod = $this->parti_model->code_color($parti_bil);
        foreach($kod as $k)
        {
            $data['warna_parti'] = $k->parti_warna;
        }
        if($data['ktr_bilangan_kerusi'] < (2/3*56))
        {
            $status = "Bilangan Kerusi";
        }
        if($data['ktr_bilangan_kerusi'] > (2/3*56))
        {
            $status = "Menang Majoriti Dua Per Tiga";
        }
        $data['ktr_status_kerusi'] = $status;
        if($data['ktr_bilangan_kerusi'] == 0)
        {
            $data['ktr_nama_parti'] = 'BELUM DITENTUKAN';
            $data['warna_parti'] = "";
        }
        $col = array_column($list_parti, 'bilangan_kerusi');
        array_multisort($col, SORT_DESC, $list_parti);
        $data['parti_kerusi'] = $list_parti;
        $data['parti_detail'] = $this->parti_model;
        return $this->load->view('keputusan_tidak_rasmi_info', $data); 
    }

    public function keputusan_pilihan_japen()
    {
        $this->load->model('pencalonan_model');
        $this->load->model('pilihanraya_model');
        $this->load->model('parti_model');
        $data['pilihanraya_bil'] = "4";
        $data['tajuk'] = "KEPUTUSAN JANGKAAN";
        $senarai_parti = $this->parti_model->parti_ikut_pilihanraya($data['pilihanraya_bil']);
        $list_parti = array();
        $count = 0;
        foreach($senarai_parti as $parti)
        {
            $list_parti[$count]['bilangan_kerusi'] = $this->pilihanraya_model->jangkaan_japen($data['pilihanraya_bil'], $parti->pencalonan_parti); 
            $list_parti[$count]['nama_parti'] = $parti->parti_nama;
            $list_parti[$count]['parti_bil'] = $parti->pencalonan_parti;
            $count++;
        }
        $tempMax = 0;
        $id = 0;
        for($i = 0; $i < count($list_parti); $i++)
        {
            if($list_parti[$i]['bilangan_kerusi'] > $tempMax)
            {
                $tempMax = $list_parti[$i]['bilangan_kerusi'];
                $id = $i;
            }
        }
        $data['nama_parti'] = $list_parti[$id]['nama_parti'];
        $data['bilangan_kerusi'] = $list_parti[$id]['bilangan_kerusi'];

        
        $parti_bil = $list_parti[$id]['parti_bil'];
        $kod = $this->parti_model->code_color($parti_bil);
        foreach($kod as $k)
        {
            $data['warna_parti'] = $k->parti_warna;
        }
        if($data['bilangan_kerusi'] < (2/3*56))
        {
            $status = "Bilangan Kerusi";
        }
        if($data['bilangan_kerusi'] > (2/3*56))
        {
            $status = "Menang Majoriti Dua Per Tiga";
        }
        $data['status_kerusi'] = $status;
        if($data['bilangan_kerusi'] == 0)
        {
            $data['nama_parti'] = 'BELUM DITENTUKAN';
            $data['warna_parti'] = "";
        }
        $col = array_column($list_parti, 'bilangan_kerusi');
        array_multisort($col, SORT_DESC, $list_parti);
        $data['parti_kerusi'] = $list_parti;
        $data['parti_detail'] = $this->parti_model;
        return $this->load->view('keputusan_pilihan_japen', $data); 
    }

    public function keputusan_rasmi()
    {
        $this->load->model('pencalonan_model');
        $this->load->model('pilihanraya_model');
        $this->load->model('parti_model');
        $data['pilihanraya_bil'] = "4";
        $data['tajuk'] = "KEPUTUSAN RASMI";
        $senarai_parti = $this->parti_model->parti_ikut_pilihanraya($data['pilihanraya_bil']);
        $list_parti = array();
        $count = 0;
        foreach($senarai_parti as $parti)
        {
            $list_parti[$count]['bilangan_kerusi'] = $this->pilihanraya_model->keputusan_rasmi($data['pilihanraya_bil'], $parti->pencalonan_parti); 
            $list_parti[$count]['nama_parti'] = $parti->parti_nama;
            $list_parti[$count]['parti_bil'] = $parti->pencalonan_parti;
            $count++;
        }
        $tempMax = 0;
        $id = 0;
        for($i = 0; $i < count($list_parti); $i++)
        {
            if($list_parti[$i]['bilangan_kerusi'] > $tempMax)
            {
                $tempMax = $list_parti[$i]['bilangan_kerusi'];
                $id = $i;
            }
        }
        $data['nama_parti'] = $list_parti[$id]['nama_parti'];
        $data['bilangan_kerusi'] = $list_parti[$id]['bilangan_kerusi'];
        
        $parti_bil = $list_parti[$id]['parti_bil'];
        $kod = $this->parti_model->code_color($parti_bil);
        foreach($kod as $k)
        {
            $data['warna_parti'] = $k->parti_warna;
        }
        
        if($data['bilangan_kerusi'] < (2/3*56))
        {
            $status = "Bilangan Kerusi";
        }
        if($data['bilangan_kerusi'] > (2/3*56))
        {
            $status = "Menang Majoriti Dua Per Tiga";
        }
        $data['status_kerusi'] = $status;
        if($data['bilangan_kerusi'] == 0)
        {
            $data['nama_parti'] = 'BELUM DITENTUKAN';
            $data['warna_parti'] = "";
        }
        $col = array_column($list_parti, 'bilangan_kerusi');
        array_multisort($col, SORT_DESC, $list_parti);
        $data['parti_kerusi'] = $list_parti;
        $data['parti_detail'] = $this->parti_model;
        return $this->load->view('keputusan_rasmi', $data); 
    }

    public function penjuru(){
        //security
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_model');
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['penjuru'] = $this->pencalonan_model->kira_penjuru($pilihanraya_bil);
        $data['jumlah_calon'] = count($this->pencalonan_model->papar_ikut_calon($pilihanraya_bil));
        $this->load->view('susunletak/atas', $data);
        $this->load->view('urusetia/urusetia_nav');
        $this->load->view('data_virtualization/penjuru');
        $this->load->view('susunletak/bawah');
    }

    public function parti(){
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_model');
		$this->load->model('parti_model');
        $data['parti'] = $this->parti_model;
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['senarai_parti_calon'] = $this->pencalonan_model->kira_calon($pilihanraya_bil);
        $data['kira_parti_calon'] = $this->pencalonan_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('urusetia/urusetia_nav');
        $this->load->view('data_virtualization/parti');
        $this->load->view('susunletak/bawah');
    }

    public function julat(){
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_model');
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['julat_umur'] = $this->pencalonan_model->julat_umur($pilihanraya_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('urusetia/urusetia_nav');
        $this->load->view('data_virtualization/julat');
        $this->load->view('susunletak/bawah');
    }

    public function umur(){
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_model');
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['pilihanraya_bil'] = $pilihanraya_bil;
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['kira_parti_calon'] = $this->pencalonan_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('urusetia/urusetia_nav');
        $this->load->view('data_virtualization/umur');
        $this->load->view('susunletak/bawah');
    }

    public function jantina(){
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_model');
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['pilihanraya_bil'] = $pilihanraya_bil;
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['kira_parti_calon'] = $this->pencalonan_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('urusetia/urusetia_nav');
        $this->load->view('data_virtualization/jantina');
        $this->load->view('susunletak/bawah');
    }

    public function senarai(){
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_model');
        $this->load->model('parti_model');
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['pilihanraya_bil'] = $pilihanraya_bil;
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['senarai_dun'] = $this->pencalonan_model;
        $data['parti'] = $this->parti_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('urusetia/urusetia_nav');
        $this->load->view('data_virtualization/senarai');
        $this->load->view('susunletak/bawah');
    }

    public function parti_bertanding(){
        $this->load->model('pilihanraya_model');
        $this->load->model('parti_model');
        $this->load->model('pencalonan_model');
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['pilihanraya_bil'] = $pilihanraya_bil;
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['senarai_parti'] = $this->parti_model->senarai_ikut_pilihanraya($pilihanraya_bil);
        $data['kira_calon'] = count($this->pencalonan_model->papar_ikut_calon($pilihanraya_bil));
        $this->load->view('susunletak/atas', $data);
        $this->load->view('urusetia/urusetia_nav');
        $this->load->view('data_virtualization/parti_bertanding');
        $this->load->view('susunletak/bawah');
    }

    public function keputusan_penuh(){
        $this->load->model('pilihanraya_model');
        $this->load->model('parti_model');
        $this->load->model('pencalonan_model');
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['pilihanraya_bil'] = $pilihanraya_bil;
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['senarai_parti'] = $this->pilihanraya_model->keputusan_penuh($pilihanraya_bil);
        $data['kira_calon'] = count($this->pencalonan_model->papar_ikut_calon($pilihanraya_bil));
        $this->load->view('susunletak/atas', $data);
        $this->load->view('urusetia/urusetia_nav');
        $this->load->view('data_virtualization/keputusan_penuh');
        $this->load->view('susunletak/bawah');
    }

    public function sismap_keputusan(){
        $this->load->model('pilihanraya_model');
        $this->load->model('parti_model');
        $this->load->model('pencalonan_model');
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['pilihanraya_bil'] = $pilihanraya_bil;
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['senarai_parti'] = $this->pilihanraya_model->keputusan_penuh($pilihanraya_bil);
        $data['kira_calon'] = count($this->pencalonan_model->papar_ikut_calon($pilihanraya_bil));
        $this->load->view('susunletak/atas', $data);
        $this->load->view('urusetia/urusetia_nav');
        $this->load->view('data_virtualization/sismap_keputusan');
        $this->load->view('susunletak/bawah');
    }

    public function perbandingan_jangkaan(){
        $this->load->model('pilihanraya_model');
        $this->load->model('parti_model');
        $this->load->model('pencalonan_model');
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['pilihanraya_bil'] = $pilihanraya_bil;
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['senarai_parti'] = $this->pilihanraya_model->keputusan_penuh($pilihanraya_bil);
        $data['kira_dun'] = count($this->pencalonan_model->dun_pilihanraya($pilihanraya_bil));
        $this->load->view('susunletak/atas', $data);
        $this->load->view('urusetia/urusetia_nav');
        $this->load->view('data_virtualization/perbandingan_jangkaan');
        $this->load->view('susunletak/bawah');
    }

    public function keputusan_dun(){
        $this->load->model('pilihanraya_model');
        $this->load->model('parti_model');
        $this->load->model('pencalonan_model');
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['pilihanraya_bil'] = $pilihanraya_bil;
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['senarai_dun'] = $this->pilihanraya_model->keputusan_dun($pilihanraya_bil);
        $data['kira_dun'] = count($this->pencalonan_model->dun_pilihanraya($pilihanraya_bil));
        $this->load->view('susunletak/atas', $data);
        $this->load->view('urusetia/urusetia_nav');
        $this->load->view('data_virtualization/keputusan_dun');
        $this->load->view('susunletak/bawah');
    }

////COMPONENT//////////////////////

    public function senarai_penuh_parlimen($pilihanraya_bil)
    {
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('parti_model');
        $this->load->model('foto_model');
        $this->load->model('undi_model');
        $this->load->model('rekod_pilihanraya_model');
        $data['data_undi'] = $this->undi_model;
        $data['data_calon'] = $this->pencalonan_parlimen_model;
        $data['data_parti'] = $this->parti_model;
        $data['data_foto'] = $this->foto_model;
        $data['pru'] = $this->pilihanraya_model->pilihanraya($pilihanraya_bil);
        $data['senarai_parlimen'] = $this->pilihanraya_model->senarai_parlimen_pilihanraya($pilihanraya_bil);
        $data['data_rekod'] = $this->rekod_pilihanraya_model;
        $this->load->view('topone/keputusan_tidak_rasmi', $data);
    }

    public function senarai_penuh_dun($pilihanraya_bil)
    {
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_model');
        $this->load->model('parti_model');
        $this->load->model('foto_model');
        $this->load->model('undi_model');
        $this->load->model('rekod_pilihanraya_model');
        $data['data_undi'] = $this->undi_model;
        $data['data_calon'] = $this->pencalonan_model;
        $data['data_parti'] = $this->parti_model;
        $data['data_foto'] = $this->foto_model;
        $data['pru'] = $this->pilihanraya_model->pilihanraya($pilihanraya_bil);
        $data['senarai_dun'] = $this->pilihanraya_model->senarai_dun_pilihanraya($pilihanraya_bil);
        $data['data_rekod'] = $this->rekod_pilihanraya_model;
        $this->load->view('topone/keputusan_tidak_rasmi_dun', $data);
    }

    public function topone_view(){
        $this->load->model('pilihanraya_model');
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->papar_aktif();
        $this->load->view('topone/nav_view', $data);
    }

    public function senarai_parti($pilihanraya_bil)
    {
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('pencalonan_model');
        $this->load->model('parti_model');
        $this->load->model('foto_model');
        $data['data_pru'] = $this->pilihanraya_model;
        $data['data_foto'] = $this->foto_model;
        $data['data_parti'] = $this->parti_model;
        $data['pru'] = $this->pilihanraya_model->pilihanraya($pilihanraya_bil);
        $data['data_calon_parlimen'] = $this->pencalonan_parlimen_model;
        $data['data_calon_dun'] = $this->pencalonan_model;
        $this->load->view('topone/view_parti', $data);
    }

    public function senarai_tidak_rasmi($pilihanraya_bil)
    {
        $this->load->model('pilihanraya_model');
        $this->load->model('rekod_pilihanraya_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('pencalonan_model');
        $this->load->model('parti_model');
        $this->load->model('foto_model');
        $this->load->model('undi_model');
        $this->load->model('negeri_model');
        $data['data_negeri'] = $this->negeri_model;
        $data['data_undi'] = $this->undi_model;
        $data['data_dun'] = $this->dun_model;
        $data['data_foto'] = $this->foto_model;
        $data['data_parti'] = $this->parti_model;
        $data['data_parlimen'] = $this->parlimen_model;
        $data['pru'] = $this->pilihanraya_model->pilihanraya($pilihanraya_bil);
        if($data['pru']->pilihanraya_jenis == "PARLIMEN"){
            $data['senarai_rekod'] = $this->rekod_pilihanraya_model->rekod_pilihanraya_parlimen($pilihanraya_bil);
            $data['data_calon'] = $this->pencalonan_parlimen_model;
            $this->load->view('topone/senarai_tidak_rasmi', $data);
        }
        if($data['pru']->pilihanraya_jenis == "DUN"){
            $data['senarai_rekod'] = $this->rekod_pilihanraya_model->rekod_pilihanraya_dun($pilihanraya_bil);
            $data['data_calon'] = $this->pencalonan_model;
            $this->load->view('topone/senarai_tidak_rasmi_dun', $data);
        }
    }



}