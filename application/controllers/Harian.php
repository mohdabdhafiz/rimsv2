<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harian extends CI_Controller {

	public function utamaDun()
	{
		$sesi = strtoupper($this->session->userdata('peranan'));
		if(empty($sesi)){
			redirect(base_url());
		}
		$penggunaBil = $this->session->userdata('pengguna_bil');
		$this->load->model('pengguna_model');
		$data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
		if(strpos($sesi, 'NEGERI') !== FALSE){
			$sesi = 'NEGERI';
		}
		if(strpos($sesi, 'PPD') !== FALSE){
			$sesi = 'PPD';
		}

		switch($sesi){
			case 'PPD' : 
				$this->load->model('harian_model');
				$this->load->model('dun_model');
				$dunSenarai = $this->dun_model->senaraiTugasanDun($data['pengguna']->pengguna_peranan_bil);
				$data['senaraiHarianDun'] = $this->harian_model->senaraiHarianDun($dunSenarai);
				$data['header'] = 'ppd_na/susunletak/atas';
				$data['navbar'] = 'ppd_na/susunletak/navbar';
				$data['sidebar'] = 'ppd_na/susunletak/sidebar';
				$data['footer'] = 'ppd_na/susunletak/bawah';
				$this->load->view('sismap/harian/utamaDun', $data);
				break;
			case 'NEGERI' : 
				$this->load->model('harian_model');
				$this->load->model('negeri_model');
				$senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
				$data['senaraiHarianDun'] = $this->harian_model->senaraiHarianNegeri($senaraiNegeri);
				$data['header'] = 'negeri_na/susunletak/atas';
				$data['navbar'] = 'negeri_na/susunletak/navbar';
				$data['sidebar'] = 'negeri_na/susunletak/sidebar';
				$data['footer'] = 'negeri_na/susunletak/bawah';
				$this->load->view('sismap/harian/utamaDun', $data);
				break;
			case 'DATA' : 
				$this->load->model('harian_model');
				$data['senaraiHarianDun'] = $this->harian_model->senaraiHarian();
				$data['header'] = 'us_sismap_na/susunletak/atas';
				$data['navbar'] = 'us_sismap_na/susunletak/navbar';
				$data['sidebar'] = 'us_sismap_na/susunletak/sidebar';
				$data['footer'] = 'us_sismap_na/susunletak/bawah';
				$this->load->view('sismap/harian/utamaDun', $data);
				break;
			default :
				redirect(base_url());
		}


	}


	public function utamaParlimen()
	{
		$sesi = strtoupper($this->session->userdata('peranan'));
		if(empty($sesi)){
			redirect(base_url());
		}
		$penggunaBil = $this->session->userdata('pengguna_bil');
		$this->load->model('pengguna_model');
		$data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
		if(strpos($sesi, 'NEGERI') !== FALSE){
			$sesi = 'NEGERI';
		}
		if(strpos($sesi, 'PPD') !== FALSE){
			$sesi = 'PPD';
		}

		switch($sesi){
			case 'PPD' : 
				$this->load->model('harian_parlimen_model');
				$this->load->model('parlimen_model');
				$parlimenSenarai = $this->parlimen_model->senaraiTugasanParlimen($data['pengguna']->pengguna_peranan_bil);
				$data['senaraiHarianParlimen'] = $this->harian_parlimen_model->senaraiHarianParlimen($parlimenSenarai);
				$data['header'] = 'ppd_na/susunletak/atas';
				$data['navbar'] = 'ppd_na/susunletak/navbar';
				$data['sidebar'] = 'ppd_na/susunletak/sidebar';
				$data['footer'] = 'ppd_na/susunletak/bawah';
				$this->load->view('sismap/harian/utamaParlimen', $data);
				break;
			case 'NEGERI' : 
				$this->load->model('harian_parlimen_model');
				$this->load->model('negeri_model');
				$senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
				$data['senaraiHarianParlimen'] = $this->harian_parlimen_model->senaraiHarianNegeri($senaraiNegeri);
				$data['header'] = 'negeri_na/susunletak/atas';
				$data['navbar'] = 'negeri_na/susunletak/navbar';
				$data['sidebar'] = 'negeri_na/susunletak/sidebar';
				$data['footer'] = 'negeri_na/susunletak/bawah';
				$this->load->view('sismap/harian/utamaParlimen', $data);
				break;
			case 'DATA' : 
				$this->load->model('harian_parlimen_model');
				$data['senaraiHarianParlimen'] = $this->harian_parlimen_model->senaraiHarian();
				$data['header'] = 'us_sismap_na/susunletak/atas';
				$data['navbar'] = 'us_sismap_na/susunletak/navbar';
				$data['sidebar'] = 'us_sismap_na/susunletak/sidebar';
				$data['footer'] = 'us_sismap_na/susunletak/bawah';
				$this->load->view('sismap/harian/utamaParlimen', $data);
				break;
			default :
				redirect(base_url());
		}


	}


	public function harianParlimenBil($harianBil){
		if(empty($harianBil)){
			redirect(base_url());
		}
		$sesi = strtoupper($this->session->userdata('peranan'));
		$penggunaBil = $this->session->userdata("pengguna_bil");
		$this->load->model("pengguna_model");
		$data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
		switch($sesi){
			case 'DATA' : 
				$this->load->model('harian_parlimen_model');
				$this->load->model('pencalonan_parlimen_model');
				$data['maklumatHarian'] = $this->harian_parlimen_model->harian($harianBil);
				$data['senaraiCalon'] = $this->pencalonan_parlimen_model->senaraiCalonHarian($data['maklumatHarian']->parlimenBil, $data['maklumatHarian']->pruBil, $data['maklumatHarian']->tarikh);
				$this->load->view("us_sismap_na/sismap/harian/parlimen/harianParlimenBil", $data);
				break;
			default :
				redirect(base_url());
		}
	}

	public function pilihanrayaDun($pilihanrayaBil){

		//SEANDAINYA TIADA PILIHANRAYA_BIL
		if(empty($pilihanrayaBil)){
			redirect(base_url());
		}

		//SEANDAINYA ADA TARIKH
		$tempTarikh = $this->input->post('inputTarikh');
		if(!empty($tempTarikh)){
			$data['tarikhHarian'] = $tempTarikh;
		}

		//INITIALIZATION
		$sesi = strtoupper($this->session->userdata('peranan'));
		$penggunaBil = $this->session->userdata('pengguna_bil');

		//CHECK NEGERI
		if(strpos($sesi, 'NEGERI') !== FALSE){
			$sesi = 'NEGERI';
		}

		//LOAD MODEL 
		$this->load->model('pilihanraya_model');
		$this->load->model('pencalonan_model');
		$this->load->model('pengguna_model');

		//LOAD DATA
		$data['pru'] = $this->pilihanraya_model->pilihanraya($pilihanrayaBil);
		$data['senaraiParti'] = $this->pencalonan_model->senaraiParti($pilihanrayaBil);
		$data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

		//LOAD ACCOUNT
		switch($sesi){
			case 'NEGERI'	:

				//INITIALIZATION
				$perananBil = $this->session->userdata('peranan_bil');

				//LOAD MODEL NEGERI
				$this->load->model('dun_model');
				$this->load->model('harian_model');

				//LOAD DATA
				$data['senaraiNegeri'] = $this->pilihanraya_model->senaraiNegeriIkutPeranan($perananBil);
				$data['dataDun'] = $this->dun_model;
				$data['dataHarian'] = $this->harian_model;

				//LOAD VIEW
				$this->load->view('negeri_na/sismap/harian/senaraiHarianDun', $data);

				break;
			default	:
				redirect(base_url());
		}

	}

	public function dm_parlimen($parlimen_bil)
	{
		$hari_ini = date('Y-m-d');
		$this->load->model('harian_parlimen_model');
		$this->load->model('pdm_model');
		$senarai_dm = $this->pdm_model->parlimen($parlimen_bil);
		foreach($senarai_dm as $dm){
			$ada = $this->harian_parlimen_model->dm_harian($hari_ini, $dm->ppt_bil);
			if(empty($ada)){
				$sedia_ada = $this->harian_parlimen_model->dm_semasa($dm->ppt_bil);
				if(empty($sedia_ada)){
					$this->harian_parlimen_model->tambah_harian_pdm(
						$dm->ppt_bilangan_pengundi, 
						70, 
						100, 
						$parlimen_bil, 
						$dm->ppt_bil, 
						date('Y-m-d H:i:s')
					);
				}else{
					$this->harian_parlimen_model->tambah_harian_pdm(
						$sedia_ada->hdpt_pengundi, 
						$sedia_ada->hdpt_keluar_mengundi, 
						$sedia_ada->hdpt_atas_pagar, 
						$parlimen_bil, 
						$dm->ppt_bil, 
						date('Y-m-d H:i:s')
					);
				}
			}
		}
		redirect('grading/status_grading/'.$parlimen_bil);
	}

	public function parlimen($parlimen_bil)
	{
		$hari_ini = date("Y-m-d");
		$this->load->model('harian_parlimen_model');
		$this->load->model('pilihanraya_model');
		$senarai_pru = $this->pilihanraya_model->parlimen_pr_aktif($parlimen_bil);
		foreach($senarai_pru as $pru){
			$ada = $this->harian_parlimen_model->hari_ini($parlimen_bil, $pru->pilihanraya_bil, $hari_ini);
			if(empty($ada)){
				$harian_sebelum = $this->harian_parlimen_model->sedia_ada($parlimen_bil, $pru->pilihanraya_bil);
				if(empty($harian_sebelum)){
					$this->harian_parlimen_model->tambah_harian_parlimen_penuh(
						'BELUM DITETAPKAN', 
						$hari_ini, 
						$parlimen_bil, 
						$this->session->userdata('pengguna_bil'), 
						date("Y-m-d H:i:s"), 
						'', 
						$pru->pilihanraya_bil, 
						100, 
						70
					);
				}else{
					$this->harian_parlimen_model->tambah_harian_parlimen_penuh(
						$harian_sebelum->harian_parlimen_grading, 
						$hari_ini, 
						$parlimen_bil, 
						$this->session->userdata('pengguna_bil'), 
						date("Y-m-d H:i:s"), 
						$harian_sebelum->harian_parlimen_ulasan, 
						$pru->pilihanraya_bil, 
						$harian_sebelum->harian_parlimen_atas_pagar, 
						$harian_sebelum->harian_parlimen_keluar_mengundi
					);
				}
			}
		}
		redirect('harian/dm_parlimen/'.$parlimen_bil);
	}

	public function index()
	{
		$sesi = strtoupper($this->session->userdata('peranan'));
		if(empty($sesi)){
			redirect(base_url());
		}
		$penggunaBil = $this->session->userdata('pengguna_bil');
		$this->load->model('pengguna_model');
		$data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
		if(strpos($sesi, 'NEGERI') !== FALSE){
			$sesi = 'NEGERI';
		}
		if(strpos($sesi, 'PPD') !== FALSE){
			$sesi = 'PPD';
		}


		/* LAMA - SEBELUM 12.12.2024
		$this->load->model('parlimen_model');
		$data['senarai_parlimen'] = $this->parlimen_model->senarai();
		$this->load->model('harian_parlimen_model');
		$data['data_harian'] = $this->harian_parlimen_model;
		$this->load->view('susunletak/atas', $data);
		$this->load->view('urusetia/harian');
		$this->load->view('susunletak/bawah'); */

		switch($sesi){
			case 'PPD' : 
				$data['header'] = 'ppd_na/susunletak/atas';
				$data['navbar'] = 'ppd_na/susunletak/navbar';
				$data['sidebar'] = 'ppd_na/susunletak/sidebar';
				$data['footer'] = 'ppd_na/susunletak/bawah';
				$this->load->view('sismap/harian/utama', $data);
				break;
			case 'NEGERI' : 
				$data['header'] = 'negeri_na/susunletak/atas';
				$data['navbar'] = 'negeri_na/susunletak/navbar';
				$data['sidebar'] = 'negeri_na/susunletak/sidebar';
				$data['footer'] = 'negeri_na/susunletak/bawah';
				$this->load->view('sismap/harian/utama', $data);
				break;
			case 'DATA' : 
				$data['header'] = 'us_sismap_na/susunletak/atas';
				$data['navbar'] = 'us_sismap_na/susunletak/navbar';
				$data['sidebar'] = 'us_sismap_na/susunletak/sidebar';
				$data['footer'] = 'us_sismap_na/susunletak/bawah';
				$this->load->view('sismap/harian/utama', $data);
				break;
			default :
				redirect(base_url());
		}


	}

	public function tambah_grading_harian(){
		$tmp_peranan = strtoupper($this->session->userdata('peranan'));
		if($tmp_peranan != "URUSETIA"){
			redirect(base_url());
		}
		$this->load->model('harian_parlimen_model');
		$tmp_grading = $this->input->post('input_harian_bil');
		$tmp_grading_status = $this->input->post('input_grading');
		if(empty($tmp_grading_status) && empty($tmp_grading)){
            $this->index();
        }elseif(empty($tmp_grading)){
            $this->harian_parlimen_model->tambah_harian();
            $this->index();
        }else{
			$this->harian_parlimen_model->kemaskini_harian();
			$this->index();
		}
	}

	function pilih_check($str)
    {
        if ($str == 0)
                {
                        $this->form_validation->set_message('pilih_check', 'Sila pilih di ruangan {field}');
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
    }

	public function atas_pagar(){
		$tmp_harian_bil = $this->input->post('harian_bil');
		if(empty($tmp_harian_bil)){
			redirect(base_url());
		}
		$this->load->model('harian_model');
		$this->harian_model->set_atas_pagar($this->input->post('harian_bil'), $this->input->post('harian_atas_pagar'));
		redirect('dun/papar_dun/'.$this->input->post('dun_bil'));
		
	}

	public function grading(){
		$tmp_harian_bil = $this->input->post('harian_bil');
		if(empty($tmp_harian_bil)){
			redirect(base_url());
		}
		$this->load->model('harian_model');
		$this->harian_model->set_grading($this->input->post('harian_bil'), $this->input->post('harian_grading'));
		redirect('dun/papar_dun/'.$this->input->post('dun_bil'));
		
	}

	public function keluar_mengundi(){
		$tmp_harian_bil = $this->input->post('harian_bil');
		if(empty($tmp_harian_bil)){
			redirect(base_url());
		}
		$this->load->model('harian_model');
		$this->harian_model->set_keluar_mengundi($this->input->post('harian_bil'), $this->input->post('harian_keluar_mengundi'));
		redirect('dun/papar_dun/'.$this->input->post('dun_bil'));
		
	}

	



}