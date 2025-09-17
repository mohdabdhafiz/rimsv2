<?php class Pelapor extends CI_Controller {

    public function senarai(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'NEGERI')){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('winnable_candidate_assign_model');
                $data['data_pengguna'] = $this->pengguna_model;
                $data['negeri'] = $this->winnable_candidate_assign_model->assign($data['pengguna']->pengguna_peranan_bil)->wcat_negeri;
                $this->load->view('negeri_na/pengguna/pelapor/senarai_penuh', $data);
                break;
            default :
                redirect(base_url());
        }
    }

} ?>