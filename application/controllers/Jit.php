<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jit extends CI_Controller {

    public function keputusanCarian(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(empty($sesi)){
            redirect(base_url());
        }
        switch($sesi){
            case 'US_PROGRAM' :
                //DATA CARIAN
                $data['programNama'] = "SEMUA PROGRAM";
                $data['hebahanNama'] = "SEMUA TAJUK HEBAHAN / NARATIF";
                $data['tarikhMula'] = "SEMUA TARIKH MULA";
                $data['tarikhTamat'] = "SEMUA TARIKH TAMAT";
                $data['negeriNama'] = "SEMUA NEGERI";

                $this->load->model('jenis_model');
                $jenisBil = $this->input->post('inputJenisBil');
                $jenisProgram = $this->jenis_model->jenis($jenisBil);
                if(!empty($jenisProgram)){
                    $data['programNama'] = strtoupper($jenisProgram->jt_nama);
                }
                
                $hebahanNama = $this->input->post('inputTajukHebahan');
                if(!empty($hebahanNama)){
                    $data['hebahanNama'] = strtoupper($hebahanNama);
                }

                $tarikhMula = $this->input->post('inputTarikhMula');
                if(!empty($tarikhMula)){
                    $data['tarikhMula'] = $tarikhMula;
                }

                $tarikhTamat = $this->input->post('inputTarikhTamat');
                if(!empty($tarikhTamat)){
                    $data['tarikhTamat'] = $tarikhTamat;
                }

                $this->load->model('negeri_model');
                $negeriBil = $this->input->post('inputNegeriBil');
                if(!empty($negeriBil)){
                    $negeri = $this->negeri_model->negeri($negeriBil);
                    $data['negeriNama'] = strtoupper($negeri->nt_nama);
                }

                $this->load->dbutil(); 
                $this->load->model('program_model');
                $this->load->helper('download');
                $query = $this->program_model->jomMuatTurun();
                $delimiter = ","; 
                $newline = "\r\n"; 
                $enclosure = '"'; 
                $csv_data = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure); 
                $file_name = 'RIMS_' . date('Ymd') . '.csv'; 
                force_download($file_name, $csv_data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function carian(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(empty($sesi)){
            redirect(base_url());
        }
        switch($sesi){
            case 'US_PROGRAM' :
                //1. JENIS PROGRAM
                $this->load->model('program_model');
                $data['senaraiProgram'] = $this->program_model->senaraiProgram();

                //2. HEBAHAN PROGRAM
                $this->load->model('program_kandungan_model');
                $data['senaraiHebahan'] = $this->program_kandungan_model->senaraiHebahan();

                //5. NEGERI
                $this->load->model('negeri_model');
                $data['senaraiNegeri'] = $this->negeri_model->senarai();

                $data['header'] = 'us_program_na/susunletak/atas';
                $data['navbar'] = 'us_program_na/susunletak/navbar';
                $data['sidebar'] = 'us_program_na/susunletak/sidebar';
                $data['footer'] = 'us_program_na/susunletak/bawah';
                $this->load->view('program/jit/carian', $data);
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
        if(empty($sesi)){
            redirect(base_url());
        }
        switch($sesi){
            case 'US_PROGRAM' :
                $data['header'] = 'us_program_na/susunletak/atas';
                $data['navbar'] = 'us_program_na/susunletak/navbar';
                $data['sidebar'] = 'us_program_na/susunletak/sidebar';
                $data['footer'] = 'us_program_na/susunletak/bawah';
                $this->load->view('program/jit/laman', $data);
                break;
            default :
                redirect(base_url());
        }
    }

}