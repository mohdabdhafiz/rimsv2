<?php
class Obp extends CI_Controller {

    public function bilangan(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('peranan_model');
        $this->load->model('obp_model');
        $pengguna = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PKPM') !== FALSE){
          $sesi = 'PKPM';
        }
        switch($sesi){
          case 'PKPM' :
            $bilanganObp = 0;
            $senaraiNegeri = $this->peranan_model->tugasNegeriPeranan($pengguna->pengguna_peranan_bil);
            $senaraiPeranan = $this->peranan_model->senarai();
                foreach($senaraiPeranan as $peranan){
                    $senaraiObp = $this->obp_model->bilanganObpNegeri($senaraiNegeri, $peranan->peranan_bil);
                    if(!empty($senaraiObp)){
                        $bilanganObp = $bilanganObp + $senaraiObp->jumlahObp;
                    }
                }
                echo $bilanganObp;
            break;
          default :
            redirect(base_url());
        }
      }

    public function senaraiIkutNegeri($negeriBil){
        //INITIALIZATION
        
    }

    public function bilanganNegeriPilihan()
    {
        $namaNegeri = $this->input->post('namaNegeri');
        if(!empty($namaNegeri)){
            $sesi = strtoupper($this->session->userdata('peranan'));
        switch($sesi){
            case 'US_OBP' :
                $bilanganObp = 0;
                $this->load->model('negeri_model');
                $this->load->model('obp_model');
                $this->load->model('peranan_model');
                $negeriBil = $this->negeri_model->negeri_nama($namaNegeri);
                $senaraiPeranan = $this->peranan_model->senarai();
                foreach($senaraiPeranan as $peranan){
                    $senaraiObp = $this->obp_model->senaraiObpIkutNegeriPeranan($negeriBil->nt_bil, $peranan->peranan_bil);
                    if(!empty($senaraiObp)){
                        $bilanganObp = $bilanganObp + count($senaraiObp);
                    }
                }
                echo $bilanganObp;
                break;
            default :
                redirect(base_url());
        }
        }else{
            echo 'TIADA APA-APA';
        }
    }

    public function bilanganKeseluruhan(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        switch($sesi){
            case 'US_OBP' :
                $bilanganObp = 0;
                $this->load->model('obp_model');
                $this->load->model('peranan_model');
                $senaraiPeranan = $this->peranan_model->senarai();
                foreach($senaraiPeranan as $peranan){
                    $senaraiObp = $this->obp_model->senarai($peranan->peranan_bil);
                    if(!empty($senaraiObp)){
                        $bilanganObp = $bilanganObp + count($senaraiObp);
                    }
                }
                echo $bilanganObp;
                break;
            default :
                redirect(base_url());
        }
        
    }

    public function senaraiIkutDaerah($negeriBil){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'US_OBP' :
                $this->load->model('negeri_model');
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $this->load->view('us_obp_na/obp/senaraiDaerah', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function senaraiNegeri()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'US_OBP' :
                $this->load->model('negeri_model');
                $this->load->model('daerah_model');
                $this->load->model('parlimen_model');
                $this->load->model('dun_model');
                $this->load->model('peranan_model');
                $this->load->model('obp_model');
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $data['dataDaerah'] = $this->daerah_model;
                $data['dataParlimen'] = $this->parlimen_model;
                $data['dataDun'] = $this->dun_model;
                $data['dataPeranan'] = $this->peranan_model;
                $data['dataObp'] = $this->obp_model;
                $this->load->view('us_obp_na/obp/senaraiNegeri', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function proses_tambah(){
        

        $this->form_validation->set_rules('inputNegeri', 'Negeri', 'required');
        $this->form_validation->set_rules('inputDaerah', 'Daerah', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->tambah();
        }
        else
        {
            $this->load->model('obp_model');
            $idObp = $this->obp_model->tambah();
            if(!empty($idObp)){
                redirect(site_url('obp/senarai'), 'refresh');
            }
            echo 'X MASUK BOH';
        }
    }

    public function proses_tambah_gambar(){

        $this->load->library('upload');
        $idObp = $this->input->post('inputObpId');
        $idPeranan = $this->session->userdata('peranan_bil');
        if(empty($idObp)){
            redirect(base_url());
        }

        $filename = "obp_".$idObp;

    
        if (!is_dir('assets/img/obp/')) {
            mkdir('./assets/img/obp/', 0777, TRUE);
        }

        $config['upload_path'] = './assets/img/obp/';
        $config['allowed_types'] = '*';
        $config['file_name'] = $filename;
		$config['overwrite'] = TRUE;
        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload('gambarObp'))
        {
                $error = array('error' => $this->upload->display_errors());
                die(var_dump($error));
                //$this->tambah_gambar($idObp);
        }
        else
        {
                $data = array('upload_data' => $this->upload->data());

                $this->load->model('obp_model');
                $fileName = $this->upload->data('file_name'); 
                $idPengguna = $this->session->userdata('pengguna_bil');
                $idGambar = $this->obp_model->muatNaikGambarObp($fileName, $idObp, $idPengguna, $idPeranan);
                
                redirect(site_url('obp/maklumat/'.$idObp));
        }
    }

    public function proses_kemaskini(){

        $bil = $this->input->post('inputBil');
        $idPeranan = $this->input->post('inputPeranan');

        $this->form_validation->set_rules('inputNegeri', 'Negeri', 'required');
        $this->form_validation->set_rules('inputDaerah', 'Daerah', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->kemaskini();
        }
        else
        {
            $this->load->model('obp_model');
            $this->obp_model->kemaskiniIkutPeranan($bil, $idPeranan);
            redirect(site_url('obp/kemaskini/'.$bil));
        }
    }

    public function proses_kemaskini_gambar(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        switch($sesi){
            case 'PPD' : 
		        $this->load->helper('file');
                $idObp = $this->input->post('inputBil');

                $idPeranan = $this->session->userdata('peranan_bil');

                $filename = "obp_".$idObp;

            
                if (!is_dir('./assets/img/obp/')) {
                    mkdir('./assets/img/obp/', 0777, TRUE);
                }

                $config['upload_path'] = './assets/img/obp/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $filename;
                $config['overwrite'] = TRUE;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('inputGambarObp'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        die(var_dump($error));
                        //$this->tambah_gambar($idObp);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                        $this->load->model('obp_model');
                        $fileName = $this->upload->data('file_name'); 
                        $idPengguna = $this->session->userdata('pengguna_bil');
                        $idPeranan = $this->session->userdata('peranan_bil');
                        $idGambar = $this->obp_model->muatNaikGambarObp($fileName, $idObp, $idPengguna, $idPeranan);
                        
                        redirect(site_url('obp/maklumat/'.$idObp));
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function proses_padam(){
        $bil = $this->input->post('inputBil');
        $idPeranan = $this->input->post('inputPeranan');
        if(empty($bil)){
            redirect(base_url());
        }
        $this->load->model('obp_model');
        $idObp = $this->obp_model->padamIkutPeranan($bil, $idPeranan);
        redirect(site_url('obp/senarai/'));
    }
    
    public function __construct()
        {
                parent::__construct();
                $this->load->helper('url');
                $this->load->helper('form');
                $this->load->library('form_validation');
        }

    public function index(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        switch($sesi){
            case 'US_OBP' :

                $this->load->model('pengguna_model');
        $this->load->model('negeri_model');
        $this->load->model('obp_model');
        $data['negeri'] = $this->negeri_model->senarai();
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        $senaraiObp = array();

                                $this->load->model('peranan_model');
                                $data['senaraiPeranan'] =  $this->peranan_model->senarai_peranan();
                                $senarai_peranan = $data['senaraiPeranan'];

                                foreach($senarai_peranan as $peranan)
                                {
                                    $obp = $this->obp_model->senaraiIkutPeranan($peranan->peranan_bil);
                                    if(!empty($obp))
                                    {
                                        $senaraiObp = array_merge($senaraiObp, $obp);
                                    }
                                }

                                $data['h'] = $senaraiObp; 

        $data['dataObp'] = $this->obp_model;
        $data['dataPeranan'] = $this->peranan_model;

        $this->load->view('us_obp_na/laman_utama', $data);

                break;
            default :
                redirect(base_url());
        }
        
    }

    public function senarai(){
        $sesi = strtoupper($this->session->userdata('peranan'));
		if(strpos($sesi, 'PPD') !== FALSE){
			$sesi = 'PPD';
		}

        if(strpos($sesi, 'NEGERI') !== FALSE){
			$sesi = 'NEGERI';
		}

		$this->load->model('pengguna_model');
		$data['pengguna'] = $this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'));

        $this->load->model('kluster_isu_model');
        $this->load->model('obp_model');  
        $data['senaraiKluster'] = $this->kluster_isu_model->senarai();
		switch($sesi){
            case 'US_OBP' :
                                $this->load->model('daerah_model');
                                $perananBil = $this->session->userdata('peranan_bil');

                                $senaraiDaerah = $this->daerah_model->senaraiTugasanDaerah($perananBil);

                                $senaraiObp = array();

                                $this->load->model('peranan_model');
                                $data['senaraiPeranan'] =  $this->peranan_model->senarai_peranan();
                                $senarai_peranan = $data['senaraiPeranan'];

                                foreach($senarai_peranan as $peranan)
                                {
                                    $obp = $this->obp_model->senaraiIkutPeranan($peranan->peranan_bil);
                                    if(!empty($obp))
                                    {
                                        $senaraiObp = array_merge($senaraiObp, $obp);
                                    }
                                }

                                $data['h'] = $senaraiObp;
                $this->load->view('us_obp_na/obp/senaraiCopy', $data);
                break;

            case 'DATA' :
                $this->load->model('obp_model');  
                                $this->load->model('daerah_model');
                                $perananBil = $this->session->userdata('peranan_bil');

                                $senaraiDaerah = $this->daerah_model->senaraiTugasanDaerah($perananBil);

                                $senaraiObp = array();

                                $this->load->model('peranan_model');
                                $data['senaraiPeranan'] =  $this->peranan_model->senarai_peranan();
                                $senarai_peranan = $data['senaraiPeranan'];

                                foreach($senarai_peranan as $peranan)
                                {
                                    $obp = $this->obp_model->senaraiIkutPeranan($peranan->peranan_bil);
                                    if(!empty($obp))
                                    {
                                        $senaraiObp = array_merge($senaraiObp, $obp);
                                    }
                                }

                                $data['h'] = $senaraiObp;
                                
                $this->load->view('us_obp_na/obp/senarai', $data);
                break;
            case 'NEGERI' :
                                $this->load->model('daerah_model');
                                $this->load->model('winnable_candidate_assign_model');
                                $perananBil = $this->session->userdata('peranan_bil');

                                $assign = $this->winnable_candidate_assign_model->assign($perananBil);

                                $senaraiObp = array();

                                $this->load->model('peranan_model');
                                $data['senaraiPeranan'] =  $this->peranan_model->senaraiPerananNegeri($assign->nt_bil);
                                $senarai_peranan = $data['senaraiPeranan'];

                                foreach($senarai_peranan as $peranan)
                                {
                                    $obp = $this->obp_model->senaraiIkutPeranan($peranan->peranan_bil);
                                    if(!empty($obp))
                                    {
                                        $senaraiObp = array_merge($senaraiObp, $obp);
                                    }
                                }

                                $data['h'] = $senaraiObp;
                                
                                $this->load->view('negeri_na/obp/senarai', $data);
                break;
			case 'PPD' 	: 	$this->load->model('obp_model');  
                            $this->load->model('daerah_model');
                            $this->load->model('parlimen_model');
                            $this->load->model('dun_model');
                            $perananBil = $this->session->userdata('peranan_bil');

                            $senaraiDaerah = $this->daerah_model->senaraiTugasanDaerah($perananBil);

                            $senaraiObp = array();

                            $data['dataDaerah'] = $this->daerah_model;
                            $data['dataParlimen'] = $this->parlimen_model;
                            $data['dataDun'] = $this->dun_model;
                            $data['h'] = $this->obp_model->senaraiIkutPeranan($perananBil);

							$this->load->view('ppd_na/obp/senarai', $data);
							break;
            case 'URUSETIA':    $this->load->model('obp_model');  
                                $this->load->model('daerah_model');
                                $perananBil = $this->session->userdata('peranan_bil');

                                $senaraiDaerah = $this->daerah_model->senaraiTugasanDaerah($perananBil);

                                $senaraiObp = array();

                                $this->load->model('peranan_model');
                                $data['senaraiPeranan'] =  $this->peranan_model->senarai_peranan();
                                $senarai_peranan = $data['senaraiPeranan'];

                                foreach($senarai_peranan as $peranan)
                                {
                                    $obp = $this->obp_model->maklumatIkutPerananSahaja($peranan->peranan_bil);
                                    if(!empty($obp))
                                    {
                                        $senaraiObp = array_merge($senaraiObp, $obp);
                                    }
                                }

                                $data['h'] = $senaraiObp;
                                
                                $this->load->view('urusetia_na/obp/senarai', $data);
                                break;
			default		:	
                                redirect(base_url());
        }
    }

    public function tambah(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $perananBil = $this->session->userdata('peranan_bil');
		if(strpos($sesi, 'PPD') !== FALSE){
			$sesi = 'PPD';
		}
        if(strpos($sesi, 'NEGERI') !== FALSE)
        {
        $sesi = 'NEGERI';
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('pengguna_model');
        $namaNegeri = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
        }
		$this->load->model('pengguna_model');
		$data['pengguna'] = $this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'));

        $this->load->model('kluster_isu_model');
        $data['senaraiKluster'] = $this->kluster_isu_model->senarai();

		switch($sesi){
			case 'PPD' 	:   
                            
                            //SENARAI NEGERI
                            $this->load->model('daerah_model');
                            $senaraiDaerah = $this->daerah_model->senaraiTugasanDaerah($perananBil);

                            //SENARAI DAERAH
                            $data['senaraiDaerah'] = $senaraiDaerah;

                            //SENARAI PARLIMEN
                            $this->load->model('parlimen_model');
                            $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($perananBil);

                            //SENARAI DUN
                            $this->load->model('dun_model');
                            $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($perananBil);
							
                            $this->load->view('ppd_na/obp/tambah', $data);
							break;
			default		:	
                redirect(base_url());
        }
    }

    public function tambah_gambar($idObp){
        $sesi = strtoupper($this->session->userdata('peranan'));
		if(strpos($sesi, 'PPD') !== FALSE){
			$sesi = 'PPD';
		}
        if(empty($idObp)){
            redirect(base_url());
        }
		$this->load->model('pengguna_model');
        $this->load->model('obp_model');
        $this->load->model('kluster_isu_model');
        $perananBil = $this->session->userdata('peranan_bil');
		$data['pengguna'] = $this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'));
        $data['senaraiKluster'] = $this->kluster_isu_model->senarai();
		switch($sesi){
			case 'PPD' 	: 	$this->load->helper('form');
                            $data['obp'] = $this->obp_model->maklumatIkutPeranan($idObp, $perananBil); 
                            $this->load->view('ppd_na/obp/tambah_gambar', $data);
							break;
			default		:	$this->load->view('ppd_na/laman_utama.php');
        }
    }

    public function maklumat($bil){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $perananBil = $this->session->userdata('peranan_bil');
		if(strpos($sesi, 'PPD') !== FALSE){
			$sesi = 'PPD';
		}
        //CONDITION IF OBP ID EMPTY
		$this->load->model('pengguna_model');
		$data['pengguna'] = $this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'));
		switch($sesi){
			case 'PPD' 	: 	$this->load->model('obp_model'); 

                            $data['obp']=$this->obp_model->maklumatIkutPeranan($bil, $perananBil); 
							$this->load->view('ppd_na/obp/maklumat', $data);
							break;
			default		:	
                redirect(base_url());
        } 
    }

    public function kemaskini($bil){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $perananBil = $this->session->userdata('peranan_bil');
		if(strpos($sesi, 'PPD') !== FALSE){
			$sesi = 'PPD';
		}
		$this->load->model('pengguna_model');
		$data['pengguna'] = $this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'));
		
        $this->load->model('kluster_isu_model');
        $data['senaraiKluster'] = $this->kluster_isu_model->senarai();

        switch($sesi){
			case 'PPD' 	: 	$this->load->helper('form');
                            $this->load->model('obp_model');  
                            $data['obp']=$this->obp_model->maklumatIkutPeranan($bil, $perananBil); 

                            //SENARAI NEGERI
                            $this->load->model('daerah_model');
                            $senaraiDaerah = $this->daerah_model->senaraiTugasanDaerah($perananBil);

                            //SENARAI DAERAH
                            $data['senaraiDaerah'] = $senaraiDaerah;

                            //SENARAI PARLIMEN
                            $this->load->model('parlimen_model');
                            $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($perananBil);

                            //SENARAI DUN
                            $this->load->model('dun_model');
                            $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($perananBil);

							$this->load->view('ppd_na/obp/kemaskini', $data);
							break;
			default		:	
                redirect(base_url());
        } 
    }

    public function kemaskini_gambar($bil){
        $sesi = strtoupper($this->session->userdata('peranan'));
		if(strpos($sesi, 'PPD') !== FALSE){
			$sesi = 'PPD';
		}
		$this->load->model('pengguna_model');
		$data['pengguna'] = $this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'));
		switch($sesi){
			case 'PPD' 	: 	$this->load->helper('form');
                            $this->load->model('obp_model');  
                            $data['obp']=$this->obp_model->maklumat($bil);  
							$this->load->view('ppd_na/obp/kemaskini_gambar', $data);
							break;
			default		:	$this->load->view('ppd_na/laman_utama.php');
        } 
    }

    public function padam($bil)
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
		if(strpos($sesi, 'PPD') !== FALSE){
			$sesi = 'PPD';
		}
		$this->load->model('pengguna_model');
		$data['pengguna'] = $this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'));

		switch($sesi){
			case 'PPD' 	: 	$this->load->helper('form');
                            $this->load->model('obp_model'); 
                            $data['obp']=$this->obp_model->maklumat($bil);  
							$this->load->view('ppd_na/obp/senarai', $data);
							break;
			default		:	$this->load->view('ppd_na/laman_utama.php');
        } 
    }
}
?>