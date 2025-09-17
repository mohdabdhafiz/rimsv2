<?php 
class Admin extends CI_Controller {

    private function template($sesi){
        switch($sesi){
            case "ADMIN" :
                $view = "admin_na";
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
        $penggunaBil = $this->session->userdata("pengguna_bil");
        $this->load->model("pengguna_model");
        $pengguna = $this->pengguna_model->pengguna($penggunaBil);
        return $pengguna;
    }

    private function sesi(){
        $sesi = strtoupper($this->session->userdata("peranan"));
        if(empty($sesi)){
            redirect(base_url());
        }
        return $sesi;
    }

    public function liveStatus(){
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $data = array_merge($data, $this->template($sesi));
        $data['gunaView'] = "dashboard/liveStatus";
        $this->load->view("dashboard/baseTemplate", $data);
    }

    public function prosesPadamProgram(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'ADMIN' :
                $setuju = $this->input->post('inputSetuju');
                if($setuju == 'Setuju'){
                    $this->load->model('program_model');
                    $entri = $this->program_model->padamSemuaProgram();
                    if($entri){
                        $this->load->view('admin_na/program/selesaiPadamProgram', $data);
                    }else{
                        redirect(base_url());
                    }
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function pemutihanProgram(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'ADMIN' :
                $this->load->view('admin_na/program/padamSemuaProgram', $data);
                break;
            default :
                redirect(base_url());
        }
    }

}

?>