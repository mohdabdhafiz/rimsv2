<?php 
class KerangkaNaratif extends CI_Controller
{

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
    
    public function senarai(){
        $sesi = $this->sesi();
        $data["pengguna"] = $this->pengguna();
        $data = array_merge($data, $this->template($sesi));
        $data["gunaView"] = "kerangkaNaratif/senarai";
        $this->load->view("baseTemplate", $data);
    }

    public function tambah(){
        $sesi = $this->sesi();
        $data["pengguna"] = $this->pengguna();
        $data = array_merge($data, $this->template($sesi));
        $data["gunaView"] = "kerangkaNaratif/tambah";
        $this->load->view("baseTemplate", $data);
    }

    public function kemaskini(){
        $sesi = $this->sesi();
        $data["pengguna"] = $this->pengguna();
        $data = array_merge($data, $this->template($sesi));
        $data["gunaView"] = "kerangkaNaratif/kemaskini";
        $this->load->view("baseTemplate", $data);
    }

    public function padam(){
        $sesi = $this->sesi();
        $data["pengguna"] = $this->pengguna();
        $data = array_merge($data, $this->template($sesi));
        $data["gunaView"] = "kerangkaNaratif/padam";
        $this->load->view("baseTemplate", $data);
    }


}