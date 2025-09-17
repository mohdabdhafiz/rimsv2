<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

    private function template($sesi){
        switch($sesi){
            case 'URUSETIA' :
                $view = 'urusetia_na';
                break;
            case 'US_PROGRAM' :
                $view = 'us_program_na';
                break;    
            default : 
                redirect(base_url());
        }
        $template = [
            "header" => "$view/susunletak/atas",
            "sidebar" => "$view/susunletak/sidebar",
            "navbar" => "$view/susunletak/navbar",
            "footer" => "$view/susunletak/bawah"
        ];
        return $template;
    }

    private function pengguna(){
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $pengguna = $this->pengguna_model->pengguna($penggunaBil);
        if(empty($pengguna)){
            redirect(base_url());
        }
        return $pengguna;
    }
    
    private function sesi(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(empty($sesi)){
            redirect(base_url());
        }
        return $sesi;
    }

    public function naratifProgram(){
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $data = array_merge($data, $this->template($sesi));
        $data['nav'] = "data/nav";
        $this->load->model(['data_model', 'program_model', 'negeri_model']);
        $this->load->library("form_validation");
        $data['senaraiProgram'] = $this->program_model->senaraiProgram();
        $data['senaraiNegeri'] = $this->negeri_model->senaraiNegeri();
        $this->form_validation->set_rules('inputTarikhMula', 'Tarikh Mula', 'required');
        $this->form_validation->set_rules('inputTarikhTamat', 'Tarikh Tamat', 'required');
        if($this->form_validation->run() !== FALSE){
            $inputProgramBil = $this->input->post("inputProgram");
            $inputNegeriBil = $this->input->post("inputNegeri");
            $inputTarikhMula = $this->input->post("inputTarikhMula");
            $inputTarikhTamat = $this->input->post("inputTarikhTamat");
            if(!empty($inputProgramBil)){
                $data['senaraiPilihanProgram'] = $this->program_model->senaraiProgramBil($inputProgramBil);
            }else{
                $data['senaraiPilihanProgram'] = $this->program_model->senaraiProgram();
            }
            if(!empty($inputNegeriBil)){
                $senaraiNegeri = $this->negeri_model->senaraiNegeriBil($inputNegeriBil);
            }else{
                $senaraiNegeri = $this->negeri_model->senaraiNegeri();
            }
            $dataHasilKeputusan = $this->data_model->hasilKeputusanNaratifProgram($data['senaraiPilihanProgram'], $senaraiNegeri, $inputTarikhMula, $inputTarikhTamat);

            // Group results by jenisBil for faster access
            $keputusanByJenis = [];
            foreach ($dataHasilKeputusan as $keputusan) {
                $keputusanByJenis[$keputusan->jenisBil][] = $keputusan;
            }

            // Assign grouped results to each program
            foreach ($data['senaraiPilihanProgram'] as &$program) {
                $program->dataHasilKeputusan = isset($keputusanByJenis[$program->jenisBil]) ? $keputusanByJenis[$program->jenisBil] : [];
            }
            unset($program); // Prevent reference issues

        }
        $data['gunaView'] = "data/naratifProgram";
        $this->load->view('data/template', $data);
    }

    public function index(){
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $data = array_merge($data, $this->template($sesi));
        $data['nav'] = "data/nav";
        $this->load->model('data_model');
        $data['gunaView'] = "data/utama";
        $this->load->view('data/template', $data);
    }

}
?>