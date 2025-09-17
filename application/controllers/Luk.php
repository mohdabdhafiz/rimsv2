<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//LUK = CONTROLLER BAGI LIBAT URUS KOMUNITI

class Luk extends CI_Controller {

    private function pengguna(){
        $this->load->model('pengguna_model');
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $pengguna = $this->pengguna_model->pengguna($penggunaBil);
        if(empty($pengguna)){
            redirect(base_url());
        }
        return $pengguna;
    }

    private function rimsTemplate($sesi){
        if(empty($sesi)){
            redirect(base_url());
        }
        switch($sesi){
            case 'PPD' :
                $view = 'ppd_na';
                break;
            case 'US_PROGRAM' :
                $view = 'us_program_na';
                break;
        }
        $data['header'] = "$view/susunletak/atas";
        $data['sidebar'] = "$view/susunletak/sidebar";
        $data['navbar'] = "$view/susunletak/navbar";
        $data['footer'] = "$view/susunletak/bawah";
        return $data;
    }

    private function sesi(){
        $sesi = '';
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(empty($sesi)){
            redirect(base_url());
        }
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }elseif(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }elseif(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }elseif(strpos($sesi, 'PPN') !== FALSE){
            $sesi = 'PPN';
        }
        return $sesi;
    }

    public function siri($libatUrusBil){
        if(empty($libatUrusBil)){
            redirect(base_url());
        }
        $this->load->model('komuniti_libaturus_model');
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $data = array_merge($data, $this->rimsTemplate($sesi));
        $data['laporan'] = $this->komuniti_libaturus_model->laporan($libatUrusBil);
        $data['breadCrumbs'] = array(
            [ "title" => "RIMS@KOMUNITI", "url" => "komuniti"],
            [ "title" => "Laporan Libat Urus Komuniti", "url" => "komuniti/libatUrus"],
            [ "title" => $data['laporan']->libatUrusNama, "url" => "siri/".$data['laporan']->libatUrusBil]
        );
        $data['senaraiKomuniti'] = array();
        $data['senaraiKomuniti'] = $this->komuniti_libaturus_model->sKomunitiTerlibat($libatUrusBil);
        $data['gambarLibatUrus'] = array();
        $data['gambarLibatUrus'] = $this->komuniti_libaturus_model->senaraiGambar($libatUrusBil);
        $data['tabNav'] = 'komuniti/libatUrus/nav';
        $data['gunaView'] = 'komuniti/libatUrus/siri';
        $this->load->view('komuniti/baseTemplate', $data);
    }

    public function pilihanPerjumpaan(){
        //FORM
        $this->load->library('form_validation');
        $data = array();
        //1. CHECK SESI
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        //2. SWITCH - SEMUA VIEW SAMA
        $data = array_merge($data, $this->rimsTemplate($sesi));
        //3. BREADCRUMBS
        $data['breadCrumbs'] = array(
            [ "title" => "RIMS@KOMUNITI", "url" => "komuniti"],
            [ "title" => "Laporan Libat Urus Komuniti", "url" => "komuniti/libatUrus"],
            [ "title" => "Pilihan Perjumpaan", "url" => "luk/pilihanPerjumpaan"]
        );
        //4. LOAD DATA
        $this->load->model('komuniti_libaturus_model');
        
        $data['senaraiPerjumpaan'] = $this->komuniti_libaturus_model->senaraiPerjumpaan();
        $this->form_validation->set_rules('inputNama', 'Tajuk Perjumpaan', 'required');
        if($this->form_validation->run() === FALSE){    
            $data['gunaView'] = 'komuniti/libatUrus/pilihanPerjumpaan';
        }else{
            $namaPerjumpaan = $this->input->post('inputNama');
            $data['senaraiKeputusanPerjumpaan'] = $this->komuniti_libaturus_model->senaraiKeputusanPerjumpaanNama($namaPerjumpaan);
            $data['gunaView'] = 'komuniti/libatUrus/keputusanPilihanPerjumpaan';
        }
        //5. VIEW IKUT PERANAN - SEMUA SEKALI
        $this->load->view('komuniti/baseTemplate', $data);
    }

    public function index(){
        redirect('komuniti');
    }

}