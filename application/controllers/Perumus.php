<?php
class Perumus extends CI_Controller {

    public function dashboardDun($dunBil){
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');
        $this->load->model('dun_model');
        $this->load->model('pdm_model');
        $this->load->model('pilihanraya_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['dun'] = $this->dun_model->dun($dunBil);
        $data['senaraiDm'] = $this->pdm_model->dun($dunBil);
        $data['senaraiPilihanraya'] = $this->pilihanraya_model->dun_pr_aktif($dunBil);

        if(strpos($sesi, 'PERUMUS') !== FALSE){
            $sesi = 'PERUMUS';
        }

        //ACCORDINGLY
        switch($sesi){
            case 'PERUMUS' :
                $this->load->view('susunletak/atas', $data);
                $this->load->view('perumus/dashboardDun');
                $this->load->view('susunletak/bawah');
                break;
            default :
                redirect(base_url());
        }
    }


    public function maklumat_harian_dun($harian_bil){
        $this->load->model('dun_model');
        $this->load->model('negeri_model');
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_model');
        $this->load->model('parti_model');
        $this->load->model('harian_model');
		$this->load->model('pdm_model');
        $this->load->model('pengundi_model');
        $this->load->model('harian_model');
        $this->load->model('status_grading_model');
        $data['hari'] = $this->harian_model->harian($harian_bil);
        $pilihanraya_bil = $data['hari']->harian_pilihanraya;
        $dun_bil = $data['hari']->harian_dun;
		$data['data_grading'] = $this->status_grading_model;
		$data['data_harian'] = $this->harian_model;
		$data['data_pengundi'] = $this->pengundi_model;
		$data['data_dm'] = $this->pdm_model;
        $data['data_pru'] = $this->pilihanraya_model;
        $data['data_parti'] = $this->parti_model;
        $data['data_calon_dun'] = $this->pencalonan_model;
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['data_negeri'] = $this->negeri_model;
        $data['dun'] = $this->dun_model->dun_bil($dun_bil);
        $data['data_dun'] = $this->dun_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('perumus/maklumat_harian_dun');
        $this->load->view('susunletak/bawah');
    }

    public function index(){
        redirect(base_url());
    }

    public function maklumat_dun($dun_bil){
        if(empty($dun_bil)){
            redirect(base_url());
        }
        $peranan = $this->session->userdata('peranan');
        if(empty($peranan)){
            redirect(base_url());
        }

        //INTIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));

        //CHECK PERUMUS
        if(strpos($sesi, 'PERUMUS') !== FALSE){
            $sesi = 'PERUMUS';
        }

        switch($sesi){
            case 'PERUMUS': 
                //LOAD MODEL
                $this->load->model('dun_model');
                $this->load->model('negeri_model');
                $this->load->model('pilihanraya_model');
                $this->load->model('pencalonan_model');
                $this->load->model('parti_model');
                $this->load->model('harian_model');
                $this->load->model('pdm_model');
                $this->load->model('pengundi_model');
                $this->load->model('harian_model');
                $this->load->model('status_grading_model');
                $this->load->model('pengguna_model');

                //LOAD DATA
                $data['data_grading'] = $this->status_grading_model;
                $data['data_harian'] = $this->harian_model;
                $data['data_pengundi'] = $this->pengundi_model;
                $data['data_dm'] = $this->pdm_model;
                $data['data_pru'] = $this->pilihanraya_model;
                $data['data_parti'] = $this->parti_model;
                $data['data_calon_dun'] = $this->pencalonan_model;
                $data['senarai_pilihanraya'] = $this->pilihanraya_model->dun_pr_aktif($dun_bil);
                $data['data_negeri'] = $this->negeri_model;
                $data['dun'] = $this->dun_model->dun_bil($dun_bil);
                $data['data_dun'] = $this->dun_model;
                $data['dataPelapor'] = $this->pengguna_model;

                //LOAD VIEW
                $this->load->view('susunletak/atas', $data);
                $this->load->view('perumus/maklumat_dun');
                $this->load->view('susunletak/bawah');
                break;
            default:
                redirect(base_url());
        }

        
    }

    public function maklumat_negeri($negeri_bil)
    {   
        if(empty($negeri_bil)){
            redirect(base_url());
        }

        $peranan = $this->session->userdata('peranan');
        if(empty($peranan)){
            redirect(base_url());
        }

        $this->load->model('negeri_model');
        $data['negeri'] = $this->negeri_model->negeri($negeri_bil);

        $this->load->view('susunletak/atas', $data);
        $this->load->view('perumus/maklumat_negeri');
        $this->load->view('susunletak/bawah');
    }

    public function maklumat_parlimen($parlimen_bil)
    {   
        if(empty($parlimen_bil)){
            redirect(base_url());
        }
        $peranan = $this->session->userdata('peranan');
        if(empty($peranan)){
            redirect(base_url());
        }
        $this->load->model('parlimen_model');
        $this->load->model('negeri_model');
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('parti_model');
        $this->load->model('harian_parlimen_model');
		$this->load->model('pdm_model');
        $this->load->model('pengundi_parlimen_model');
        $this->load->model('harian_parlimen_model');
        $this->load->model('status_grading_model');
		$data['data_grading'] = $this->status_grading_model;
		$data['data_harian'] = $this->harian_parlimen_model;
		$data['data_pengundi'] = $this->pengundi_parlimen_model;
		$data['data_dm'] = $this->pdm_model;
        $data['data_pru'] = $this->pilihanraya_model;
        $data['data_parti'] = $this->parti_model;
        $data['data_calon_parlimen'] = $this->pencalonan_parlimen_model;
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->parlimen_pr_aktif($parlimen_bil);
        $data['data_negeri'] = $this->negeri_model;
        $data['parlimen'] = $this->parlimen_model->parlimen_bil($parlimen_bil);
        $data['data_parlimen'] = $this->parlimen_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('perumus/maklumat_parlimen');
        $this->load->view('susunletak/bawah');
    }

    public function maklumat_harian($harian_bil){
        $this->load->model('parlimen_model');
        $this->load->model('negeri_model');
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('parti_model');
        $this->load->model('harian_parlimen_model');
		$this->load->model('pdm_model');
        $this->load->model('pengundi_parlimen_model');
        $this->load->model('harian_parlimen_model');
        $this->load->model('status_grading_model');
        $data['hari'] = $this->harian_parlimen_model->harian($harian_bil);
        $pilihanraya_bil = $data['hari']->harian_parlimen_pilihanraya;
        $parlimen_bil = $data['hari']->harian_parlimen_parlimen;
		$data['data_grading'] = $this->status_grading_model;
		$data['data_harian'] = $this->harian_parlimen_model;
		$data['data_pengundi'] = $this->pengundi_parlimen_model;
		$data['data_dm'] = $this->pdm_model;
        $data['data_pru'] = $this->pilihanraya_model;
        $data['data_parti'] = $this->parti_model;
        $data['data_calon_parlimen'] = $this->pencalonan_parlimen_model;
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['data_negeri'] = $this->negeri_model;
        $data['parlimen'] = $this->parlimen_model->parlimen_bil($parlimen_bil);
        $data['data_parlimen'] = $this->parlimen_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('perumus/maklumat_harian');
        $this->load->view('susunletak/bawah');
    }

//////////// KOMPONEN //////////////////////

    public function rumusan_kiraan_parti(){
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('pencalonan_model');
        $this->load->model('parti_model');
        $this->load->model('foto_model');
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->aktif();
        $data['data_calon_parlimen'] = $this->pencalonan_parlimen_model;
        $data['data_calon_dun'] = $this->pencalonan_model;
        $data['data_parti'] = $this->parti_model;
        $data['data_foto'] = $this->foto_model;
        $this->load->view('perumus/komponen/senarai_parti_keseluruhan', $data);
    }

    public function nav_perumus(){
        $this->load->view('perumus/komponen/nav');
    }

    public function senarai_negeri(){
        $this->load->model('negeri_model');
        $data['senarai_negeri'] = $this->negeri_model->senarai_negeri_ikut_parlimen();
        $this->load->view('perumus/komponen/senarai_negeri', $data);
    }

    public function senarai_parlimen($negeri_bil){
        $this->load->model('negeri_model');
        $this->load->model('parlimen_model');
        $data['data_parlimen'] = $this->parlimen_model;
        $data['negeri'] = $this->negeri_model->negeri($negeri_bil);
        $this->load->view('perumus/komponen/senarai_parlimen_ikut_negeri', $data);
    }

    public function senarai_dun($negeri_bil){
        $this->load->model('negeri_model');
        $this->load->model('dun_model');
        $data['data_dun'] = $this->dun_model;
        $data['negeri'] = $this->negeri_model->negeri($negeri_bil);
        $this->load->view('perumus/komponen/senarai_dun_ikut_negeri', $data);
    }

}
?>