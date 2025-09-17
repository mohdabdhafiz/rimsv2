<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bencana extends CI_Controller {

    public function padamGambar(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(empty($sesi)){
            redirect(base_url());
        }
        $this->load->model('bencana_model');
        $file = $this->bencana_model->gambarBencana($this->input->post('inputBencanaGambarBil'));
        if ($file) { 
            $file_path = './assets/img/gambarBencana/' . $file->bencana_gambar_nama; 
            if (file_exists($file_path)) { 
                $this->bencana_model->padamGambar($file->bencana_gambar_bil);
                unlink($file_path); 
            } 
        }
        redirect('bencana/bil/'.$this->input->post('inputBencanaBil').'#bahagianGambar');
    }
    
    public function tambahGambar() { 
        $this->load->library('upload');
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(empty($sesi)){
            redirect(base_url());
        }
        $this->load->model('bencana_model');
        $files = $_FILES; 
        $count = count($_FILES['inputGambarBencana']['name']); 
        for ($i = 0; $i < $count; $i++) { 
            $namaFail = $this->input->post('inputBencanaBil')."BENCANA".$files['inputGambarBencana']['name'][$i];
            $_FILES['userfile']['name'] = $namaFail; 
            $_FILES['userfile']['type'] = $files['inputGambarBencana']['type'][$i]; 
            $_FILES['userfile']['tmp_name'] = $files['inputGambarBencana']['tmp_name'][$i]; 
            $_FILES['userfile']['error'] = $files['inputGambarBencana']['error'][$i]; 
            $_FILES['userfile']['size'] = $files['inputGambarBencana']['size'][$i]; 
            $this->upload->initialize($this->set_upload_options()); 
            if ($this->upload->do_upload('userfile')) { 
                $uploadData = $this->upload->data(); 
                $this->bencana_model->tambahGambar($uploadData['file_name'], $this->input->post('inputBencanaBil'), $penggunaBil);
            } 
        } 
        redirect('bencana/bil/'.$this->input->post('inputBencanaBil').'#bahagianGambar');
    }
    
    private function set_upload_options() { 
        $config = array(); 
        $config['upload_path'] = './assets/img/gambarBencana/'; 
        $config['allowed_types'] = 'gif|jpg|png'; 
        $config['max_size'] = '2000'; 
        $config['overwrite'] = FALSE; 
        return $config;
    }

    public function carian(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'LAPIS' :
                $this->load->view('us_lapis_na/bencana/carian', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function jumlahLaporanHari(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $this->load->model('bencana_model');
        switch($sesi){
            case 'LAPIS' :
                $bilanganLaporan = $this->bencana_model->bilanganLaporanHari(date('Y-m-d'));
                echo $bilanganLaporan->bilangan;
                break;
            default :
                redirect(base_url());
        }
    }

    public function jumlahLaporanBulan(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $this->load->model('bencana_model');
        switch($sesi){
            case 'LAPIS' :
                $bilanganLaporan = $this->bencana_model->bilanganLaporanBulan(date('Y-m-d'));
                echo $bilanganLaporan->bilangan;
                break;
            default :
                redirect(base_url());
        }
    }

    public function bilangan(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $this->load->model('bencana_model');
        switch($sesi){
            case 'LAPIS' :
                $bilanganLaporan = $this->bencana_model->bilanganLaporanTahun(date('Y'));
                echo $bilanganLaporan->bilangan;
                break;
            default :
                redirect(base_url());
        }
    }

    public function senarai(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('bencana_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        switch($sesi){
            case 'PPD' :
                $data['header'] = 'ppd_na/susunletak/atas';
                $data['navbar'] = 'ppd_na/susunletak/navbar';
                $data['sidebar'] = 'ppd_na/susunletak/sidebar';
                $data['footer'] = 'ppd_na/susunletak/bawah';
                $data['senaraiLaporan'] = $this->bencana_model->senaraiIndividu($penggunaBil);
                $this->load->view('bencana/senarai', $data);
                break;
            case 'LAPIS' :
                $data['senaraiLaporan'] = $this->bencana_model->senarai();
                $this->load->view('us_lapis_na/bencana/senarai', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function padamLaporan(){
        $this->load->model('bencana_model');
        $this->bencana_model->padamLaporan();
        redirect('bencana/senarai');
    }

    public function hantarLaporan(){
        $this->load->model('bencana_model');
        $this->bencana_model->hantarLaporan();
        redirect('bencana/bil/'.$this->input->post('inputBil'));
    }

    public function kemaskini(){
        $bencanaBil = $this->input->post('inputBil');
        if(empty($bencanaBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $this->load->model('bencana_model');
        switch($sesi){
            case 'LAPIS' :
                $this->bencana_model->kemaskini();
                redirect('bencana/bil/'.$bencanaBil);
                break;
            default :
                redirect(base_url());
        }
    }

    public function bil($bencanaBil){
        if(empty($bencanaBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('bencana_model');
        $this->load->model('negeri_model');
        $this->load->model('daerah_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['bencana'] = $this->bencana_model->bencana($bencanaBil);
        $data['gambarBencana'] = $this->bencana_model->senaraiGambar($bencanaBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        switch($sesi){
            case 'PPD' :
                $data['header'] = 'ppd_na/susunletak/atas';
                $data['navbar'] = 'ppd_na/susunletak/navbar';
                $data['sidebar'] = 'ppd_na/susunletak/sidebar';
                $data['footer'] = 'ppd_na/susunletak/bawah';
                $data['senaraiNegeri'] = $this->daerah_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
                if($data['bencana']->bencana_status == 'Terima'){
                    $this->load->view('bencana/bencana', $data);
                }
                if($data['bencana']->bencana_status == 'Draf'){
                    $this->load->view('bencana/bil', $data);
                }
                break;
            case 'LAPIS' :
                $data['senaraiPelapor'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $data['senaraiDaerah'] = $this->daerah_model->senarai();
                if($data['bencana']->bencana_status == 'Terima'){
                    $this->load->view('us_lapis_na/bencana/bencana', $data);
                }
                if($data['bencana']->bencana_status == 'Draf'){
                    $this->load->view('us_lapis_na/bencana/bil', $data);
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function laporan($bencanaBil){
        if(empty($bencanaBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('bencana_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['bencana'] = $this->bencana_model->bencana($bencanaBil);
        switch($sesi){
            case 'LAPIS' :
                $this->load->view('us_lapis_na/bencana/bencana', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function prosesTambah(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        switch($sesi){
            case 'PPD' :
                $this->load->model('bencana_model');
                $entri = $this->bencana_model->tambah();
                redirect('bencana/bil/'.$entri['last_id']);
                break;
            case 'LAPIS' :
                $this->load->model('bencana_model');
                $entri = $this->bencana_model->tambah();
                redirect('bencana/bil/'.$entri['last_id']);
                break;
            default :
                redirect(base_url());
        }
    }
    
    public function tambah(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('negeri_model');
        $this->load->model('daerah_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        switch($sesi){
            case 'BPKPM' :
                $data['senaraiPelapor'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $data['senaraiDaerah'] = $this->daerah_model->senarai();
                $data['header'] = 'us_program_na/susunletak/atas';
                $data['navbar'] = 'us_program_na/susunletak/navbar';
                $data['sidebar'] = 'us_program_na/susunletak/sidebar';
                $data['footer'] = 'us_program_na/susunletak/bawah';
                $this->load->view('bencana/tambah', $data);
                break;
            case 'URUSETIA' :
                $data['senaraiPelapor'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $data['senaraiDaerah'] = $this->daerah_model->senarai();
                $data['header'] = 'urusetia_na/susunletak/atas';
                $data['navbar'] = 'urusetia_na/susunletak/navbar';
                $data['sidebar'] = 'urusetia_na/susunletak/sidebar';
                $data['footer'] = 'urusetia_na/susunletak/bawah';
                $this->load->view('bencana/tambah', $data);
                break;
            case 'NEGERI' :
                $data['senaraiPelapor'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $data['senaraiDaerah'] = $this->daerah_model->senarai();
                $data['header'] = 'negeri_na/susunletak/atas';
                $data['navbar'] = 'negeri_na/susunletak/navbar';
                $data['sidebar'] = 'negeri_na/susunletak/sidebar';
                $data['footer'] = 'negeri_na/susunletak/bawah';
                $this->load->view('bencana/tambah', $data);
                break;
            case 'PPD' :
                $data['senaraiPelapor'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiNegeri'] = $this->daerah_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
                $data['header'] = 'ppd_na/susunletak/atas';
                $data['navbar'] = 'ppd_na/susunletak/navbar';
                $data['sidebar'] = 'ppd_na/susunletak/sidebar';
                $data['footer'] = 'ppd_na/susunletak/bawah';
                $this->load->view('bencana/tambah', $data);
                break;
            case 'LAPIS' :
                $data['senaraiPelapor'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $data['senaraiDaerah'] = $this->daerah_model->senarai();
                $this->load->view('us_lapis_na/bencana/tambah', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function index(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        switch($sesi){
            case 'BPKPM' :
                $data['header'] = 'us_program_na/susunletak/atas';
                $data['navbar'] = 'us_program_na/susunletak/navbar';
                $data['sidebar'] = 'us_program_na/susunletak/sidebar';
                $data['footer'] = 'us_program_na/susunletak/bawah';
                $this->load->view('bencana/utama', $data);
                break;
            case 'URUSETIA' :
                $data['header'] = 'urusetia_na/susunletak/atas';
                $data['navbar'] = 'urusetia_na/susunletak/navbar';
                $data['sidebar'] = 'urusetia_na/susunletak/sidebar';
                $data['footer'] = 'urusetia_na/susunletak/bawah';
                $this->load->view('bencana/utama', $data);
                break;
            case 'NEGERI' :
                $data['header'] = 'negeri_na/susunletak/atas';
                $data['navbar'] = 'negeri_na/susunletak/navbar';
                $data['sidebar'] = 'negeri_na/susunletak/sidebar';
                $data['footer'] = 'negeri_na/susunletak/bawah';
                $this->load->view('bencana/utama', $data);
                break;
            case 'PPD' :
                $data['header'] = 'ppd_na/susunletak/atas';
                $data['navbar'] = 'ppd_na/susunletak/navbar';
                $data['sidebar'] = 'ppd_na/susunletak/sidebar';
                $data['footer'] = 'ppd_na/susunletak/bawah';
                $this->load->view('bencana/utama', $data);
                break;
            case 'LAPIS' :
                $this->load->view('us_lapis_na/bencana/utama', $data);
                break;
            default :
                redirect(base_url());
        }
    }

}