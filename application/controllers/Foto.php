<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Foto extends CI_Controller {

	public function padamKeratanAkhbarProgram(){
		//1. LOAD HELPER
		$this->load->helper('file');
		//2. INITIALIZATION
			//2.1 SESSION
			$sesi = strtoupper($this->session->userdata('peranan'));
			if(empty($sesi)){
				redirect(base_url());
			}
			//2.2 GAMBAR BIL
			$keratanAkhbar = $this->input->post('inputKeratanAkhbarBil');
			if(empty($keratanAkhbar)){
				redirect(base_url());
			}
			//2.3 PROGRAM BIL
			$programBil = $this->input->post('inputProgramBil');
			if(empty($programBil)){
				redirect(base_url());
			}
		//3. LOAD MODEL
		$this->load->model('program_keratan_akhbar_model');
		
				$keratanAkhbarProgram = $this->program_keratan_akhbar_model->keratanAkhbar($keratanAkhbar);
				//4.1.2. DELETE
					//1. DELETE FILES
						//1.1 FILE EXISTS
						$filePointer = './assets/img/keratanAkhbarProgram/'.$keratanAkhbarProgram->keratan_akhbar_program_nama_fail;
						if(file_exists($filePointer)){
							unlink($filePointer);
						}
						//1.2 DELETE GAMBAR PROGRAM MODEL
						$this->program_keratan_akhbar_model->padamKeratanAkhbar($keratanAkhbar);
				//4.1.2 REDIRECT
				redirect('program/bil/'.$programBil."#e");
			
	}

	public function prosesTambahKeratanAkhbarProgram(){
		//1. LOAD HELPER
		$this->load->helper('file');
		$this->load->library('upload');
		//2. INTIALIZATION
		//2.1 SESI
		$sesi = strtoupper($this->session->userdata('peranan'));
		if(empty($sesi)){
			redirect(base_url());
		}
		//2.2 PENGGUNA
		$penggunaBil = $this->session->userdata('pengguna_bil');
		//2.2.1 LOAD MODEL PENGGUNA
		$this->load->model('pengguna_model');
		//2.2.2 DATA PENGGUNA
		$data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
		//2.3 PROGRAM BIL
		$programBil = $this->input->post('inputProgramBil');
		if(empty($programBil)){
			redirect(base_url());
		}
		//3. LOAD MODEL
		//3.1 PROGRAM GAMBAR
		$this->load->model('program_keratan_akhbar_model');
		//4. ADD NEW PICTURE INTO PROGRAM GAMBAR MODEL
		//4.1 ADD PICTURE
		$dataEntryGambar = $this->program_keratan_akhbar_model->tambah();
		if(empty($dataEntryGambar)){
			die('Tambah maklumat tidak berjaya!');
		}
		//4.2 GET GAMBAR BIL
		$gambarBil = $dataEntryGambar['last_id'];
		//5. FILE CONFIGURATION
		//5.1 FILE NAME
		$fileName = "keratanAkhbar".$gambarBil;
		//5.2 PATH
		$config['upload_path'] = './assets/img/keratanAkhbarProgram/';
		//5.3 PLUS MINUS CONFIGURATION
        $config['allowed_types'] = '*';
		$config['file_name'] = $fileName;
		$config['overwrite'] = FALSE;
		$this->upload->initialize($config);
		//6. LOAD LIBRARY WITH CONFIGURATION
		//7. IF CONDITION
    	if ( ! $this->upload->do_upload('input_userfile')){
			//7.1 NOT SUCCESS : 
			//7.1.1 DELETE VALUES PROGRAM GAMBAR MODEL
			//$this->program_gambar_model->padam($gambarBil);
			//7.1.2 PROMPT FAILED
			$error = array('error' => $this->upload->display_errors());
			die(var_dump($error));
		}else{
			//7.2 SUCCESS :
				//7.2.1 MODIFY GAMBAR PROGRAM MODEL
                $data = array('upload_data' => $this->upload->data());
				$namaFail = $this->upload->data('file_name');
				$this->program_keratan_akhbar_model->kemaskiniNamaFail($namaFail, $gambarBil);
				//7.2.2 REDIRECT PROGRAM/BIL/PROGRAM BIL
				redirect('program/bil/'.$programBil."#l");
		}
	}

	public function index()
	{
		$this->load->model("foto_model");

		$data['semua_foto'] = $this->foto_model->papar_semua();

		$this->load->view('susunletak/atas');
		$this->load->view('foto/arkib', $data);
		$this->load->view('susunletak/bawah');
	}
	//ADD NEW FOTO
	//1. PROGRAM
	public function prosesTambahGambarProgram(){
		//1. LOAD HELPER
		$this->load->helper('file');
		$this->load->library('upload');
		//2. INTIALIZATION
		//2.1 SESI
		$sesi = strtoupper($this->session->userdata('peranan'));
		if(empty($sesi)){
			redirect(base_url());
		}
		//2.2 PENGGUNA
		$penggunaBil = $this->session->userdata('pengguna_bil');
		//2.2.1 LOAD MODEL PENGGUNA
		$this->load->model('pengguna_model');
		//2.2.2 DATA PENGGUNA
		$data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
		//2.3 PROGRAM BIL
		$programBil = $this->input->post('inputProgramBil');
		if(empty($programBil)){
			redirect(base_url());
		}
		//3. LOAD MODEL
		//3.1 PROGRAM GAMBAR
		$this->load->model('program_gambar_model');
		//4. ADD NEW PICTURE INTO PROGRAM GAMBAR MODEL
		//4.1 ADD PICTURE
		$dataEntryGambar = $this->program_gambar_model->tambah();
		if(empty($dataEntryGambar)){
			die('Tambah maklumat tidak berjaya!');
		}
		//4.2 GET GAMBAR BIL
		$gambarBil = $dataEntryGambar['last_id'];
		//5. FILE CONFIGURATION
		//5.1 FILE NAME
		$fileName = "program".$gambarBil;
		//5.2 PATH
		$config['upload_path'] = './assets/img/gambarProgram/';
		//5.3 PLUS MINUS CONFIGURATION
        $config['allowed_types'] = '*';
		$config['file_name'] = $fileName;
		$config['overwrite'] = TRUE;
		$this->upload->initialize($config);
		//6. LOAD LIBRARY WITH CONFIGURATION
		//7. IF CONDITION
    	if ( ! $this->upload->do_upload('input_userfile')){
			//7.1 NOT SUCCESS : 
			//7.1.1 DELETE VALUES PROGRAM GAMBAR MODEL
			//$this->program_gambar_model->padam($gambarBil);
			//7.1.2 PROMPT FAILED
			$error = array('error' => $this->upload->display_errors());
			die(var_dump($error));
		}else{
			//7.2 SUCCESS :
				//7.2.1 MODIFY GAMBAR PROGRAM MODEL
                $data = array('upload_data' => $this->upload->data());
				$namaFail = $this->upload->data('file_name');
				$this->program_gambar_model->kemaskiniNamaFail($namaFail, $gambarBil);
				//7.2.2 REDIRECT PROGRAM/BIL/PROGRAM BIL
				redirect('program/bil/'.$programBil."#e");
		}
	}
	//DELETE PHOTO
	//1. DELETE PROGRAM PHOTO
	public function padamGambarProgram(){
		//1. LOAD HELPER
		$this->load->helper('file');
		//2. INITIALIZATION
			//2.1 SESSION
			$sesi = strtoupper($this->session->userdata('peranan'));
			//2.2 GAMBAR BIL
			$gambarBil = $this->input->post('inputGambarBil');
			if(empty($gambarBil)){
				redirect(base_url());
			}
			//2.3 PROGRAM BIL
			$programBil = $this->input->post('inputProgramBil');
			if(empty($programBil)){
				redirect(base_url());
			}
		//3. LOAD MODEL
		$this->load->model('program_gambar_model');
		
				$gambarProgram = $this->program_gambar_model->gambar($gambarBil);
				//4.1.2. DELETE
					//1. DELETE FILES
						//1.1 FILE EXISTS
						$filePointer = './assets/img/gambarProgram/'.$gambarProgram->gambar_program_nama_fail;
						if(file_exists($filePointer)){
							unlink($filePointer);
						}
						//1.2 DELETE GAMBAR PROGRAM MODEL
						$this->program_gambar_model->padamGambar($gambarBil);
				//4.1.2 REDIRECT
				redirect('program/bil/'.$programBil."#e");
			
	}
	public function padam_foto($bil){
		$this->load->model("foto_model");

		$s = $this->foto_model->padam($bil);
		//PADAM FILE

	
			$data['semua_foto'] = $this->foto_model->papar_semua();

			$this->load->view('susunletak/atas');
			$this->load->view('foto/arkib', $data);
			$this->load->view('susunletak/bawah');

		
	}

	public function tukar_gambar_parti(){
		$tmp_parti_bil = $this->input->post('parti_bil');
		if(empty($tmp_parti_bil)){
			redirect('utama');
		}

		$this->load->model('pilihanraya_model');
        $this->load->model('parti_model');

        $sesi = strtoupper($this->session->userdata('peranan'));
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');

        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);

		$this->load->model('foto_model');
		$data['parti'] = $this->parti_model->papar($this->input->post('parti_bil'));
		$filename = "parti".$this->input->post('parti_bil');
                $config['upload_path'] = './assets/img/';
                $config['allowed_types'] = '*';
				$config['file_name'] = $filename;
				$config['overwrite'] = TRUE;

                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('susunletak/atas', $data);
                        $this->load->view('parti/parti', $error);
                        $this->load->view('susunletak/bawah');

                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                
                        $insert_id = $this->foto_model->muatnaik_parti($this->upload->data('file_name'));
						$this->parti_model->tukar_gambar_parti($this->input->post('parti_bil'), $insert_id);

                        redirect('parti');
                }

	}

	public function tukar_gambar_ahli(){
		$tmp_ahli_bil = $this->input->post('ahli_bil');
		if(empty($tmp_ahli_bil)){
			redirect('utama');
		}

		$this->load->library('upload');
		$this->load->model('pilihanraya_model');
        $this->load->model('ahli_model');

        $sesi = strtoupper($this->session->userdata('peranan'));
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');

        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);

		$this->load->model('foto_model');
		$data['ahli'] = $this->ahli_model->papar($this->input->post('ahli_bil'));
		$filename = "ahli".$this->input->post('ahli_bil');
                $config['upload_path'] = './assets/img/';
                $config['allowed_types'] = '*';
				$config['file_name'] = $filename;
				$config['overwrite'] = TRUE;

				//LOADING LIBRARY
                $this->upload->initialize($config);
				//$this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('susunletak/atas', $data);
                        $this->load->view('calonpru/papar_ahli', $error);
                        $this->load->view('susunletak/bawah');

                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                
                        $insert_id = $this->foto_model->muatnaik_parti($this->upload->data('file_name'));
						$this->ahli_model->tukar_gambar_ahli($this->input->post('ahli_bil'), $insert_id);

                        redirect('ahli/id/'.$this->input->post('ahli_bil'), 'refresh');
                }

	}

	public function tukar_gambar_wct(){
		//SEDUT PASS DATA
		$tmp_wct_bil = $this->input->post('input_wct_bil');
		//KALAU KOSONG, REDIRECT MAIN
		if(empty($tmp_wct_bil)){
			redirect(base_url());
		}

		//INITIAL
		$sesi = strtoupper($this->session->userdata('peranan'));
		//JIKA SEANDAI PPD DALAM PPDXX, SESI ITU PPD
		if(strpos($sesi, 'PPD') !== FALSE){
			$sesi = 'PPD';
		}
		//JIKA SEANDAINYA NEGERI DALAM NEGERIXX, SESI ITU NEGERI
		if(strpos($sesi, 'NEGERI') !== FALSE){
			$sesi = 'NEGERI';
		}

		//LOAD MODEL YANG DIPERLUKAN
		//FOTO
		$this->load->model('foto_model');
		//JANGKAAN CALON PARLIMEN
		$this->load->model('winnable_candidate_parlimen_model');

		//KELUARKAN MAKLUMAT CALON
		$calon = $this->winnable_candidate_parlimen_model->calon_id($this->input->post('input_wct_bil'));

		//PROSES FILE
		//FILENAME YANG STANDARD - wctXXXX
		$filename = "wct".$tmp_wct_bil;

		//KONFIGURASI FILE
		$config['upload_path'] = './assets/img/'; //DIREKTORI UPLOAD
        $config['allowed_types'] = '*'; //JENIS
		$config['file_name'] = $filename;
		$config['overwrite'] = TRUE;

		//LOADING LIBRARY
		$this->load->library('upload', $config);

		switch($sesi){

			//APABILA USER ITU DATA
			case 'DATA'	: 
				if ( ! $this->upload->do_upload('input_userfile'))
                {
					redirect('winnable_candidate/proses_gambar/'.$this->input->post('input_wct_bil'), 'refresh');

                }
                else
                {
                    //MASUK DALAM TABLE FOTO    
					$insert_id = $this->foto_model->muatnaik_wct($this->upload->data('file_name'));

					//MASUK DALAM TABLE JANGKAAN CALON
					$this->winnable_candidate_parlimen_model->tukar_gambar_wct($this->input->post('input_wct_bil'), $insert_id);

					//SELESAI
                    redirect('winnable_candidate/proses_gambar/'.$tmp_wct_bil, 'refresh');
                }
				break;

			//APABILA USER ITU NEGERI
			case 'NEGERI'	:
				//CONDITION UNTUK LOADING
				if ( ! $this->upload->do_upload('input_userfile'))
                {
					redirect('winnable_candidate/proses_gambar/'.$this->input->post('input_wct_bil'), 'refresh');

                }
                else
                {
                    //MASUK DALAM TABLE FOTO    
					$insert_id = $this->foto_model->muatnaik_wct($this->upload->data('file_name'));

					//MASUK DALAM TABLE JANGKAAN CALON
					$this->winnable_candidate_parlimen_model->tukar_gambar_wct($this->input->post('input_wct_bil'), $insert_id);

					//SELESAI
                    redirect('winnable_candidate/proses_gambar/'.$tmp_wct_bil, 'refresh');
                }
				break;
				break;

			//APABILA USER ITU PPD
			case 'PPD'	:

				//CONDITION UNTUK LOADING
				if ( ! $this->upload->do_upload('input_userfile'))
                {
					redirect('winnable_candidate/proses_gambar/'.$this->input->post('input_wct_bil'), 'refresh');

                }
                else
                {
                    //MASUK DALAM TABLE FOTO    
					$insert_id = $this->foto_model->muatnaik_wct($this->upload->data('file_name'));

					//MASUK DALAM TABLE JANGKAAN CALON
					$this->winnable_candidate_parlimen_model->tukar_gambar_wct($this->input->post('input_wct_bil'), $insert_id);

					//SELESAI
                    redirect('winnable_candidate/proses_gambar/'.$tmp_wct_bil, 'refresh');
                }
				break;

			//SELAIN DARIPADA ITU
			default:
				redirect(base_url());
		}

	}

	public function tukar_gambar_jdt(){
		$this->load->helper('file');
		$sesi = strtoupper($this->session->userdata('peranan'));
		$penggunaBil = $this->session->userdata('pengguna_bil');
		$this->load->model('pengguna_model');
		$data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
		if(strpos($sesi, 'PPD') !== FALSE){
			$sesi = 'PPD';
		}
		if(strpos($sesi, 'NEGERI') !== FALSE){
			$sesi = 'NEGERI';
		}
		$this->load->model('foto_model');
		$this->load->model('jangka_dun_model');
		switch($sesi){
			case 'PPD1' :
		$tmp_jdt_bil = $this->input->post('input_jdt_bil');
		if(empty($tmp_jdt_bil)){
			redirect(base_url());
		}
		$data['calon'] = $this->jangka_dun_model->calon_id($this->input->post('input_jdt_bil'));
		$filename = "jdt".$this->input->post('input_jdt_bil');
                $config['upload_path'] = './assets/img/';
                $config['allowed_types'] = '*';
				$config['file_name'] = $filename;
				$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);
                //$this->upload->initialize($config);

                if ( ! $this->upload->do_upload('input_userfile'))
                {
					redirect('dun/proses_gambar/'.$this->input->post('input_jdt_bil'), 'refresh');

                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                
                        $insert_id = $this->foto_model->muatnaik_jdt($this->upload->data('file_name'));
						$this->jangka_dun_model->tukar_gambar_jdt($this->input->post('input_jdt_bil'), $insert_id);

                        redirect('dun/proses_gambar/'.$this->input->post('input_jdt_bil'), 'refresh');
                }
				break;
			case 'DATA' :
				$dunBil = $this->input->post('inputDunBil');
		$filename = "jdt".$this->input->post('input_calon_bil');
        $config['upload_path'] = './assets/img/';
        $config['allowed_types'] = '*';
        $config['file_name'] = $filename;
        $config['overwrite'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('input_userfile'))
        {
            $error = array(
                'error' => $this->upload->display_errors()
            );
            foreach($error as $e){
                echo $e;
            }
			echo "<br>".site_url('winnable_candidate/dun/'.$calonBil);
        }
        else
        {
            $insert_id = $this->foto_model->muatnaik_jdt($this->upload->data('file_name'));
			$this->jangka_dun_model->tukar_gambar_jdt($this->input->post('input_calon_bil'), $insert_id);
        	redirect('winnable_candidate/dun/'.$dunBil);
		}
				break;
		case 'PPD' :
			$tmp_jdt_bil = $this->input->post('input_jdt_bil');
			if(empty($tmp_jdt_bil)){
				redirect(base_url());
			}
			$filename = "jdt".$this->input->post('input_jdt_bil');
			$config['upload_path'] = './assets/img/';
			$config['allowed_types'] = '*';
			$config['file_name'] = $filename;
			$config['overwrite'] = TRUE;
	
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('input_userfile'))
			{
				$error = array(
					'error' => $this->upload->display_errors()
				);
				foreach($error as $e){
					echo $e;
				}
				echo "<br>".site_url('dun/proses_gambar/'.$this->input->post('input_jdt_bil'));
			}
			else
			{
				$insert_id = $this->foto_model->muatnaik_jdt($this->upload->data('file_name'));
						$this->jangka_dun_model->tukar_gambar_jdt($this->input->post('input_jdt_bil'), $insert_id);

                        redirect('dun/proses_gambar/'.$this->input->post('input_jdt_bil'), 'refresh');
			}
					break;
			case 'NEGERI' :
				$tmp_jdt_bil = $this->input->post('input_jdt_bil');
				if(empty($tmp_jdt_bil)){
					redirect(base_url());
				}
				$filename = "jdt".$this->input->post('input_jdt_bil');
				$config['upload_path'] = './assets/img/';
				$config['allowed_types'] = '*';
				$config['file_name'] = $filename;
				$config['overwrite'] = TRUE;
		
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('input_userfile'))
				{
					$error = array(
						'error' => $this->upload->display_errors()
					);
					foreach($error as $e){
						echo $e;
					}
					echo "<br>".site_url('dun/proses_gambar/'.$this->input->post('input_jdt_bil'));
				}
				else
				{
					$insert_id = $this->foto_model->muatnaik_jdt($this->upload->data('file_name'));
							$this->jangka_dun_model->tukar_gambar_jdt($this->input->post('input_jdt_bil'), $insert_id);
	
							redirect('dun/proses_gambar/'.$this->input->post('input_jdt_bil'), 'refresh');
				}
						break;
			default :
				redirect(base_url());
		}

	}



}