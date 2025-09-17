<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends CI_Controller {

    private function template($sesi){
        switch($sesi){
            case "US_PROGRAM" :
                $view = "us_program_na";
                break;
        }
        if(!empty($view)){
            $template = [
                "header" => "$view/susunletak/atas",
                "sidebar" => "$view/susunletak/sidebar",
                "navbar" => "$view/susunletak/navbar",
                "footer" => "$view/susunletak/bawah"
            ];
            return $template;
        }
        redirect(base_url());
    }

    private function pengguna(){
        $penggunaBil = $this->session->userdata("pengguna_bil");
        $this->load->model("pengguna_model");
        $pengguna = $this->pengguna_model->pengguna($penggunaBil);
        return $pengguna;
    }

    private function sesi(){
        $sesi = strtoupper($this->session->userdata("peranan"));
        return $sesi;
    }

    public function kerangkaNaratif(){
        $sesi = $this->sesi();
        $data["pengguna"] = $this->pengguna();
        $data = array_merge($data, $this->template($sesi));
        $data["gunaView"] = "us_program_na/konfigurasi/program/kerangkaNaratif";
        $this->load->view("baseTemplate", $data);
    }

    //KONFIGURASI PENERBITAN

    public function penerbitanBil($bil){
        if(empty($bil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_penerbitan_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['penerbitan'] = $this->senarai_penerbitan_model->penerbitan($bil);
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/konfigurasi/program/penerbitan', $data);
                break;
            case 'URUSETIA' :
                $this->load->view('us_urusetia_na/konfigurasi/program/penerbitan', $data);
                break;
            default :
                redirect(base_url());
        }
    }
    
    public function kemaskiniSenaraipenerbitan($bil){
        if(empty($bil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_penerbitan_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $kemaskini = $this->input->post('inputOperasi');
        if(!empty($kemaskini)){
            $entri = $this->senarai_penerbitan_model->kemaskiniPost();
            if($entri){
                $data['kemaskiniStatus'] = 'Kemaskini Berjaya';
            }
        }
        $data['penerbitan'] = $this->senarai_penerbitan_model->penerbitan($bil);
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/konfigurasi/program/kemaskiniPenerbitan', $data);
                break;
            case 'URUSETIA' :
                $this->load->view('urusetia_na/konfigurasi/program/kemaskiniPenerbitan', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function padamSenaraipenerbitan(){
        $bil = $this->input->post('inputBil');
        if(empty($bil)){
            redirect(base_url());
        }
        $this->load->model('senarai_penerbitan_model');
        $sesi = strtoupper($this->session->userdata('peranan'));
        switch($sesi){
            case 'US_PROGRAM' :
                $entri = $this->senarai_penerbitan_model->padam();
                if($entri){
                    redirect('konfigurasi/senaraipenerbitan');
                }else{
                    die('Terdapat masalah. Sila hubungi urus setia');
                }
                break;
            case 'URUSETIA' :
                $entri = $this->senarai_penerbitan_model->padam();
                if($entri){
                    redirect('konfigurasi/senaraipenerbitan');
                }else{
                    die('Terdapat masalah. Sila hubungi urus setia');
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function confirmPadamPenerbitan($bil){
        if(empty($bil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_penerbitan_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'US_PROGRAM' :
                $data['penerbitan'] = $this->senarai_penerbitan_model->penerbitan($bil);
                $this->load->view('us_program_na/konfigurasi/program/confirmPadamPenerbitan', $data);
                break;
            case 'URUSETIA' :
                $data['penerbitan'] = $this->senarai_penerbitan_model->penerbitan($bil);
                $this->load->view('urusetia_na/konfigurasi/program/confirmPadamPenerbitan', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function tambahSenaraipenerbitan(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_penerbitan_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['inputTajuk'] = $this->input->post('inputpenerbitan');
        if(!empty($data['inputTajuk'])){
            $tajuk = $this->senarai_penerbitan_model->ikutTajuk($data['inputTajuk']);
            if(empty($tajuk)){
                $this->senarai_penerbitan_model->tambah();
            }else{
                $data['inputTajuk'] = '';
            }
        }
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/konfigurasi/program/tambahSenaraiPenerbitan', $data);
                break;
            case 'URUSETIA' :
                $this->load->view('urusetia_na/konfigurasi/program/tambahSenaraiPenerbitan', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function senaraiPenerbitan(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_penerbitan_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['senaraiPenerbitan'] = $this->senarai_penerbitan_model->senarai();
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/konfigurasi/program/senaraiPenerbitan', $data);
                break;
            case 'URUSETIA' :
                $this->load->view('urusetia_na/konfigurasi/program/senaraiPenerbitan', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    //KONFIGURASI AGENSI

    public function agensiBil($bil){
        if(empty($bil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_agensi_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['agensi'] = $this->senarai_agensi_model->agensi($bil);
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/konfigurasi/program/agensi', $data);
                break;
            case 'URUSETIA' :
                $this->load->view('us_urusetia_na/konfigurasi/program/agensi', $data);
                break;
            default :
                redirect(base_url());
        }
    }
    
    public function kemaskiniSenaraiagensi($bil){
        if(empty($bil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_agensi_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $kemaskini = $this->input->post('inputOperasi');
        if(!empty($kemaskini)){
            $entri = $this->senarai_agensi_model->kemaskiniPost();
            if($entri){
                $data['kemaskiniStatus'] = 'Kemaskini Berjaya';
            }
        }
        $data['agensi'] = $this->senarai_agensi_model->agensi($bil);
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/konfigurasi/program/kemaskiniAgensi', $data);
                break;
            case 'URUSETIA' :
                $this->load->view('urusetia_na/konfigurasi/program/kemaskiniAgensi', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function padamSenaraiagensi(){
        $bil = $this->input->post('inputBil');
        if(empty($bil)){
            redirect(base_url());
        }
        $this->load->model('senarai_agensi_model');
        $sesi = strtoupper($this->session->userdata('peranan'));
        switch($sesi){
            case 'US_PROGRAM' :
                $entri = $this->senarai_agensi_model->padam();
                if($entri){
                    redirect('konfigurasi/senaraiagensi');
                }else{
                    die('Terdapat masalah. Sila hubungi urus setia');
                }
                break;
            case 'URUSETIA' :
                $entri = $this->senarai_agensi_model->padam();
                if($entri){
                    redirect('konfigurasi/senaraiagensi');
                }else{
                    die('Terdapat masalah. Sila hubungi urus setia');
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function confirmPadamAgensi($bil){
        if(empty($bil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_agensi_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'US_PROGRAM' :
                $data['agensi'] = $this->senarai_agensi_model->agensi($bil);
                $this->load->view('us_program_na/konfigurasi/program/confirmPadamAgensi', $data);
                break;
            case 'URUSETIA' :
                $data['agensi'] = $this->senarai_agensi_model->agensi($bil);
                $this->load->view('urusetia_na/konfigurasi/program/confirmPadamAgensi', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function tambahSenaraiagensi(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_agensi_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['inputTajuk'] = $this->input->post('inputagensi');
        if(!empty($data['inputTajuk'])){
            $tajuk = $this->senarai_agensi_model->ikutTajuk($data['inputTajuk']);
            if(empty($tajuk)){
                $this->senarai_agensi_model->tambah();
            }else{
                $data['inputTajuk'] = '';
            }
        }
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/konfigurasi/program/tambahSenaraiAgensi', $data);
                break;
            case 'URUSETIA' :
                $this->load->view('urusetia_na/konfigurasi/program/tambahSenaraiAgensi', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function senaraiAgensi(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_agensi_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['senaraiAgensi'] = $this->senarai_agensi_model->senarai();
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/konfigurasi/program/senaraiAgensi', $data);
                break;
            case 'URUSETIA' :
                $this->load->view('urusetia_na/konfigurasi/program/senaraiAgensi', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    //KONFUGURASI PENGISIAN

    public function pengisianBil($bil){
        if(empty($bil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_pengisian_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['pengisian'] = $this->senarai_pengisian_model->pengisian($bil);
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/konfigurasi/program/pengisian', $data);
                break;
            case 'URUSETIA' :
                $this->load->view('us_urusetia_na/konfigurasi/program/pengisian', $data);
                break;
            default :
                redirect(base_url());
        }
    }
    
    public function kemaskiniSenaraipengisian($bil){
        if(empty($bil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_pengisian_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $kemaskini = $this->input->post('inputOperasi');
        if(!empty($kemaskini)){
            $entri = $this->senarai_pengisian_model->kemaskiniPost();
            if($entri){
                $data['kemaskiniStatus'] = 'Kemaskini Berjaya';
            }
        }
        $data['pengisian'] = $this->senarai_pengisian_model->pengisian($bil);
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/konfigurasi/program/kemaskiniPengisian', $data);
                break;
            case 'URUSETIA' :
                $this->load->view('urusetia_na/konfigurasi/program/kemaskiniPengisian', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function padamSenaraipengisian(){
        $bil = $this->input->post('inputBil');
        if(empty($bil)){
            redirect(base_url());
        }
        $this->load->model('senarai_pengisian_model');
        $sesi = strtoupper($this->session->userdata('peranan'));
        switch($sesi){
            case 'US_PROGRAM' :
                $entri = $this->senarai_pengisian_model->padam();
                if($entri){
                    redirect('konfigurasi/senaraipengisian');
                }else{
                    die('Terdapat masalah. Sila hubungi urus setia');
                }
                break;
            case 'URUSETIA' :
                $entri = $this->senarai_pengisian_model->padam();
                if($entri){
                    redirect('konfigurasi/senaraipengisian');
                }else{
                    die('Terdapat masalah. Sila hubungi urus setia');
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function confirmPadamPengisian($bil){
        if(empty($bil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_pengisian_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'US_PROGRAM' :
                $data['pengisian'] = $this->senarai_pengisian_model->pengisian($bil);
                $this->load->view('us_program_na/konfigurasi/program/confirmPadamPengisian', $data);
                break;
            case 'URUSETIA' :
                $data['pengisian'] = $this->senarai_pengisian_model->pengisian($bil);
                $this->load->view('urusetia_na/konfigurasi/program/confirmPadamPengisian', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function tambahSenaraipengisian(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_pengisian_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['inputTajuk'] = $this->input->post('inputpengisian');
        if(!empty($data['inputTajuk'])){
            $tajuk = $this->senarai_pengisian_model->ikutTajuk($data['inputTajuk']);
            if(empty($tajuk)){
                $this->senarai_pengisian_model->tambah();
            }else{
                $data['inputTajuk'] = '';
            }
        }
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/konfigurasi/program/tambahSenaraiPengisian', $data);
                break;
            case 'URUSETIA' :
                $this->load->view('urusetia_na/konfigurasi/program/tambahSenaraiPengisian', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function senaraiPengisian(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_pengisian_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['senaraiPengisian'] = $this->senarai_pengisian_model->senarai();
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/konfigurasi/program/senaraiPengisian', $data);
                break;
            case 'URUSETIA' :
                $this->load->view('urusetia_na/konfigurasi/program/senaraiPengisian', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    //KONFUGURASI HEBAHAN

    public function kandunganBil($bil){
        if(empty($bil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_kandungan_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['kandungan'] = $this->senarai_kandungan_model->kandungan($bil);
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/konfigurasi/program/kandungan', $data);
                break;
            case 'URUSETIA' :
                $this->load->view('us_program_na/konfigurasi/program/kandungan', $data);
                break;
            default :
                redirect(base_url());
        }
    }
    
    public function kemaskiniSenaraiKandungan($bil){
        if(empty($bil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_kandungan_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $kemaskini = $this->input->post('inputOperasi');
        if(!empty($kemaskini)){
            $entri = $this->senarai_kandungan_model->kemaskiniPost();
            if($entri){
                $data['kemaskiniStatus'] = 'Kemaskini Berjaya';
            }
        }
        $data['kandungan'] = $this->senarai_kandungan_model->kandungan($bil);
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/konfigurasi/program/kemaskiniKandungan', $data);
                break;
            case 'URUSETIA' :
                $this->load->view('urusetia_na/konfigurasi/program/kemaskiniKandungan', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function padamSenaraiKandungan(){
        $bil = $this->input->post('inputBil');
        if(empty($bil)){
            redirect(base_url());
        }
        $this->load->model('senarai_kandungan_model');
        $sesi = strtoupper($this->session->userdata('peranan'));
        switch($sesi){
            case 'US_PROGRAM' :
                $entri = $this->senarai_kandungan_model->padam();
                if($entri){
                    redirect('konfigurasi/senaraiKandungan');
                }else{
                    die('Terdapat masalah. Sila hubungi urus setia');
                }
                break;
            case 'URUSETIA' :
                $entri = $this->senarai_kandungan_model->padam();
                if($entri){
                    redirect('konfigurasi/senaraiKandungan');
                }else{
                    die('Terdapat masalah. Sila hubungi urus setia');
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function confirmPadam($bil){
        if(empty($bil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_kandungan_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'US_PROGRAM' :
                $data['kandungan'] = $this->senarai_kandungan_model->kandungan($bil);
                $this->load->view('us_program_na/konfigurasi/program/confirmPadam', $data);
                break;
            case 'URUSETIA' :
                $data['kandungan'] = $this->senarai_kandungan_model->kandungan($bil);
                $this->load->view('urusetia_na/konfigurasi/program/confirmPadam', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function tambahSenaraiKandungan(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_kandungan_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['inputTajuk'] = $this->input->post('inputKandungan');
        if(!empty($data['inputTajuk'])){
            $tajuk = $this->senarai_kandungan_model->ikutTajuk($data['inputTajuk']);
            if(empty($tajuk)){
                $this->senarai_kandungan_model->tambah();
            }else{
                $data['inputTajuk'] = '';
            }
        }
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/konfigurasi/program/tambahSenaraiKandungan', $data);
                break;
            case 'URUSETIA' :
                $this->load->view('urusetia_na/konfigurasi/program/tambahSenaraiKandungan', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function senaraiKandungan(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('senarai_kandungan_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['senaraiKandungan'] = $this->senarai_kandungan_model->senarai();
        switch($sesi){
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/konfigurasi/program/senaraiKandungan', $data);
                break;
            case 'URUSETIA' :
                $this->load->view('urusetia_na/konfigurasi/program/senaraiKandungan', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    //SIMULASI DPI KAUM

    public function konfigurasiSimulasiKaum()
    {
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        switch($sesi){
            case 'DATA' :
                $this->load->view('us_sismap_na/konfigurasi/konfigurasiSimulasiKaum', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    //DUN

    public function dun_proses_set()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_peranan_bil', 'Akaun PPD', 'required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $this->form_validation->set_message('required', 'Sila penuhi ruangan {field}');
        $dun_bil = $this->input->post('input_dun_bil');
        if($this->form_validation->run() === FALSE){
            $this->dun_set($dun_bil);
        }else{
            $this->load->model('dun_model');
            $sudah_ada = $this->dun_model->tugas_dun($dun_bil);
            if(empty($sudah_ada)){
                $this->dun_model->tambah_tugas_dun();
                redirect('konfigurasi/dun_set/'.$dun_bil, 'refresh');
            }else{
                $this->dun_model->kemaskini_tugas_dun($sudah_ada->tdt_bil);
                redirect('konfigurasi/dun_set/'.$dun_bil, 'refresh');
            }
        }
    }

    public function dun_set($dun_bil)
    {
        if(empty($dun_bil)){
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->load->model('dun_model');
        $this->load->model('peranan_model');
        $data['senarai_peranan'] = $this->peranan_model->senarai_peranan_ppd();
        $data['data_dun'] = $this->dun_model;
        $data['dun'] = $this->dun_model->dun($dun_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/dun_set');
        $this->load->view('susunletak/bawah');
    }

    public function tugas_dun()
    {
        $peranan_bil = $this->session->userdata('peranan_bil');
        if(empty($peranan_bil)){
            redirect(base_url());
        }
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('dun_model');
        $this->load->model('negeri_model');
        $data['data_dun'] = $this->dun_model;
        $negeri_peranan = $this->winnable_candidate_assign_model->assign($peranan_bil);
        $negeri = $this->negeri_model->negeri_nama($negeri_peranan->wcat_negeri);
        $data['senarai_dun'] = $this->dun_model->dun_negeri($negeri->nt_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/tugas_dun_senarai');
        $this->load->view('susunletak/bawah');
    }

    public function dun_proses_padam()
    {
        $dun_bil = $this->input->post('input_bil');
        if(empty($dun_bil)){
            redirect(base_url());
        }
        $this->load->model('dun_model');
        $this->dun_model->padam_bil();
        redirect('konfigurasi/dun');
    }

    public function padam_dun($dun_bil)
    {   
        if(empty($dun_bil)){
            redirect(base_url());
        }
        $this->load->model('dun_model');
        $this->load->model('negeri_model');
        $data['data_negeri'] = $this->negeri_model;
        $data['dun'] = $this->dun_model->dun($dun_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/dun_verify_padam');
        $this->load->view('susunletak/bawah');
    }

    public function dun_bil($dun_bil)
    {
        if(empty($dun_bil)){
            redirect(base_url());
        }
        $this->load->model('dun_model');
        $this->load->model('negeri_model');
        $data['data_dun'] = $this->dun_model;
        $data['data_negeri'] = $this->negeri_model;
        $data['dun'] = $this->dun_model->dun($dun_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/dun_bil');
        $this->load->view('susunletak/bawah');
    }

    public function proses_tambah_dun()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_nama', 'Nama dun', 'required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $this->form_validation->set_message('required', 'Sila penuhi ruangan {field}');
        if($this->form_validation->run() === FALSE)
        {
            $this->tambah_dun();
        }else{
            $this->load->model('dun_model');
            $dun_baru = $this->dun_model->tambah();
            redirect('konfigurasi/dun_bil/'.$dun_baru['last_id']);
        }
    }

    public function tambah_dun()
    {
        $peranan_bil = $this->session->userdata('peranan_bil');
        if(empty($peranan_bil)){
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('negeri_model');
        $negeri_peranan = $this->winnable_candidate_assign_model->assign($peranan_bil);
        $data['negeri'] = $this->negeri_model->negeri_nama($negeri_peranan->wcat_negeri);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/tambah_dun');
        $this->load->view('susunletak/bawah');
    }

    public function dun()
    {
        $peranan_bil = $this->session->userdata('peranan_bil');
        if(empty($peranan_bil)){
            redirect(base_url());
        }
        $this->load->model('dun_model');
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('negeri_model');
        $negeri_peranan = $this->winnable_candidate_assign_model->assign($peranan_bil);
        $negeri = $this->negeri_model->negeri_nama($negeri_peranan->wcat_negeri);
        $data['senarai_dun'] = $this->dun_model->dun_negeri($negeri->nt_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/dun');
        $this->load->view('susunletak/bawah');
    }

    //PARLIMEN

    public function parlimen_proses_set()
    {
        $peranan_bil = $this->input->post('input_peranan_bil');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_peranan_bil', 'Akaun PPD', 'required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $this->form_validation->set_message('required', 'Sila penuhi ruangan {field}');
        $parlimen_bil = $this->input->post('input_parlimen_bil');
        if($this->form_validation->run() === FALSE && $peranan_bil == ''){
            $this->parlimen_set($parlimen_bil);
        }else{
            $this->load->model('parlimen_model');
            $sudah_ada = $this->parlimen_model->tugas_parlimen($parlimen_bil);
            if(empty($sudah_ada)){
                $this->parlimen_model->tambah_tugas_parlimen();
                redirect('konfigurasi/parlimen_set/'.$parlimen_bil, 'refresh');
            }else{
                $this->parlimen_model->kemaskini_tugas_parlimen($sudah_ada->tpt_bil);
                redirect('konfigurasi/parlimen_set/'.$parlimen_bil, 'refresh');
            }
        }
    }

    public function parlimen_set($parlimen_bil)
    {
        if(empty($parlimen_bil)){
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->load->model('parlimen_model');
        $this->load->model('peranan_model');
        $data['senarai_peranan'] = $this->peranan_model->senarai_peranan_ppd();
        $data['data_parlimen'] = $this->parlimen_model;
        $data['parlimen'] = $this->parlimen_model->parlimen_bil($parlimen_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/parlimen_set');
        $this->load->view('susunletak/bawah');
    }

    public function tugas_parlimen()
    {
        $peranan_bil = $this->session->userdata('peranan_bil');
        if(empty($peranan_bil)){
            redirect(base_url());
        }
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('parlimen_model');
        $this->load->model('negeri_model');
        $data['data_parlimen'] = $this->parlimen_model;
        $negeri_peranan = $this->winnable_candidate_assign_model->assign($peranan_bil);
        $negeri = $this->negeri_model->negeri_nama($negeri_peranan->wcat_negeri);
        $data['senarai_parlimen'] = $this->parlimen_model->parlimen_negeri($negeri->nt_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/tugas_parlimen_senarai');
        $this->load->view('susunletak/bawah');
    }

    public function parlimen_proses_padam()
    {
        $parlimen_bil = $this->input->post('input_bil');
        if(empty($parlimen_bil)){
            redirect(base_url());
        }
        $this->load->model('parlimen_model');
        $this->parlimen_model->padam_bil();
        redirect('konfigurasi/parlimen');
    }

    public function padam_parlimen($parlimen_bil)
    {   
        if(empty($parlimen_bil)){
            redirect(base_url());
        }
        $this->load->model('parlimen_model');
        $this->load->model('negeri_model');
        $data['data_negeri'] = $this->negeri_model;
        $data['parlimen'] = $this->parlimen_model->parlimen_bil($parlimen_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/parlimen_verify_padam');
        $this->load->view('susunletak/bawah');
    }

    public function parlimen_bil($parlimen_bil)
    {
        if(empty($parlimen_bil)){
            redirect(base_url());
        }
        $this->load->model('parlimen_model');
        $this->load->model('negeri_model');
        $data['data_parlimen'] = $this->parlimen_model;
        $data['data_negeri'] = $this->negeri_model;
        $data['parlimen'] = $this->parlimen_model->parlimen_bil($parlimen_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/parlimen_bil');
        $this->load->view('susunletak/bawah');
    }

    public function proses_tambah_parlimen()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_nama', 'Nama Parlimen', 'required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $this->form_validation->set_message('required', 'Sila penuhi ruangan {field}');
        if($this->form_validation->run() === FALSE)
        {
            $this->tambah_parlimen();
        }else{
            $this->load->model('parlimen_model');
            $parlimen_baru = $this->parlimen_model->tambah();
            redirect('konfigurasi/parlimen_bil/'.$parlimen_baru['last_id']);
        }
    }

    public function tambah_parlimen()
    {
        $peranan_bil = $this->session->userdata('peranan_bil');
        if(empty($peranan_bil)){
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('negeri_model');
        $negeri_peranan = $this->winnable_candidate_assign_model->assign($peranan_bil);
        $data['negeri'] = $this->negeri_model->negeri_nama($negeri_peranan->wcat_negeri);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/tambah_parlimen');
        $this->load->view('susunletak/bawah');
    }

    public function parlimen()
    {
        $peranan_bil = $this->session->userdata('peranan_bil');
        if(empty($peranan_bil)){
            redirect(base_url());
        }
        $this->load->model('parlimen_model');
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('negeri_model');
        $negeri_peranan = $this->winnable_candidate_assign_model->assign($peranan_bil);
        $negeri = $this->negeri_model->negeri_nama($negeri_peranan->wcat_negeri);
        $data['senarai_parlimen'] = $this->parlimen_model->parlimen_negeri($negeri->nt_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/parlimen');
        $this->load->view('susunletak/bawah');
    }

    //DAERAH

    public function daerah_proses_set()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_peranan_bil', 'Akaun PPD', 'required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $this->form_validation->set_message('required', 'Sila penuhi ruangan {field}');
        $daerah_bil = $this->input->post('input_daerah_bil');
        if($this->form_validation->run() === FALSE){
            $this->daerah_set($daerah_bil);
        }else{
            $this->load->model('daerah_model');
            $sudah_ada = $this->daerah_model->tugas_daerah($daerah_bil);
            if(empty($sudah_ada)){
                $this->daerah_model->tambah_tugas_daerah();
                redirect('konfigurasi/daerah_set/'.$daerah_bil, 'refresh');
            }else{
                $this->daerah_model->kemaskini_tugas_daerah($sudah_ada->bil);
                redirect('konfigurasi/daerah_set/'.$daerah_bil, 'refresh');
            }
        }
    }

    public function daerah_set($daerah_bil)
    {
        if(empty($daerah_bil)){
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->load->model('daerah_model');
        $this->load->model('peranan_model');
        $data['senarai_peranan'] = $this->peranan_model->senarai_peranan_ppd();
        $data['data_daerah'] = $this->daerah_model;
        $data['daerah'] = $this->daerah_model->daerah($daerah_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/daerah_set');
        $this->load->view('susunletak/bawah');
    }

    public function tugas_daerah()
    {
        $peranan_bil = $this->session->userdata('peranan_bil');
        if(empty($peranan_bil)){
            redirect(base_url());
        }
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('daerah_model');
        $this->load->model('negeri_model');
        $data['data_daerah'] = $this->daerah_model;
        $negeri_peranan = $this->winnable_candidate_assign_model->assign($peranan_bil);
        $negeri = $this->negeri_model->negeri_nama($negeri_peranan->wcat_negeri);
        $data['senarai_daerah'] = $this->daerah_model->daerah_negeri($negeri->nt_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/tugas_daerah_senarai');
        $this->load->view('susunletak/bawah');
    }

    public function daerah_proses_padam()
    {
        $daerah_bil = $this->input->post('input_bil');
        if(empty($daerah_bil)){
            redirect(base_url());
        }
        $this->load->model('daerah_model');
        $this->daerah_model->padam();
        redirect('konfigurasi/daerah');
    }

    public function padam_daerah($daerah_bil)
    {   
        if(empty($daerah_bil)){
            redirect(base_url());
        }
        $this->load->model('daerah_model');
        $this->load->model('negeri_model');
        $data['data_negeri'] = $this->negeri_model;
        $data['daerah'] = $this->daerah_model->daerah($daerah_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/daerah_verify_padam');
        $this->load->view('susunletak/bawah');
    }

    public function index()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        switch($sesi){
            case 'NEGERI' :
                $this->load->view('susunletak/atas');
                $this->load->view('negeri/konfigurasi/utama');
                $this->load->view('susunletak/bawah');
                break;
            default :
                redirect(base_url());
        }
    }

    public function daerah_bil($daerah_bil)
    {
        if(empty($daerah_bil)){
            redirect(base_url());
        }
        $this->load->model('daerah_model');
        $this->load->model('negeri_model');
        $data['data_daerah'] = $this->daerah_model;
        $data['data_negeri'] = $this->negeri_model;
        $data['daerah'] = $this->daerah_model->daerah($daerah_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/daerah_bil');
        $this->load->view('susunletak/bawah');
    }

    public function proses_tambah_daerah()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_nama', 'Nama Daerah', 'required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $this->form_validation->set_message('required', 'Sila penuhi ruangan {field}');
        if($this->form_validation->run() === FALSE)
        {
            $this->tambah_daerah();
        }else{
            $this->load->model('daerah_model');
            $daerah_baru = $this->daerah_model->tambah();
            redirect('konfigurasi/daerah_bil/'.$daerah_baru['last_id']);
        }
    }

    public function tambah_daerah()
    {
        $peranan_bil = $this->session->userdata('peranan_bil');
        if(empty($peranan_bil)){
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('negeri_model');
        $negeri_peranan = $this->winnable_candidate_assign_model->assign($peranan_bil);
        $data['negeri'] = $this->negeri_model->negeri_nama($negeri_peranan->wcat_negeri);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/tambah_daerah');
        $this->load->view('susunletak/bawah');
    }

    public function daerah()
    {
        $peranan_bil = $this->session->userdata('peranan_bil');
        if(empty($peranan_bil)){
            redirect(base_url());
        }
        $this->load->model('daerah_model');
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('negeri_model');
        $negeri_peranan = $this->winnable_candidate_assign_model->assign($peranan_bil);
        $negeri = $this->negeri_model->negeri_nama($negeri_peranan->wcat_negeri);
        $data['senarai_daerah'] = $this->daerah_model->daerah_negeri($negeri->nt_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/konfigurasi/daerah');
        $this->load->view('susunletak/bawah');
    }

}
?>