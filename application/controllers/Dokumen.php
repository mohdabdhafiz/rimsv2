<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen extends CI_Controller {

    private function template($sesi){
        switch($sesi){
            case 'URUSETIA' :
                $view = 'urusetia_na';
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

    public function senaraiDokumen(){
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $data = array_merge($data, $this->template($sesi));
        $data['nav'] = "dokumen/nav";
        $this->load->model('dokumen_model');
        $this->load->library('pagination');

        $config['base_url'] = base_url('dokumen/senaraiDokumen'); 
        $config['total_rows'] = $this->dokumen_model->jumlahDokumen(); 
        $config['per_page'] = 20;
        $config['uri_segment'] = 3; // Segment URL untuk pagination
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        $start = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) * $config['per_page'] : 0;
        $data['senaraiDokumen'] = $this->dokumen_model->senaraiDokumen($config['per_page'], $start);

        $data['linksPagi'] = $this->pagination->create_links();
        $data['gunaView'] = "dokumen/senaraiDokumen";
        $this->load->view('dokumen/template', $data);
    }

    public function index(){
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $data = array_merge($data, $this->template($sesi));
        $data['nav'] = "dokumen/nav";
        $this->load->model('dokumen_model');
        $data['bilanganLaporan'] = $this->dokumen_model->jumlahDokumen();
        $data['gunaView'] = "dokumen/utama";
        $this->load->view('dokumen/template', $data);
    }

}

?>