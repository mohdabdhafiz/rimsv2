<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grading extends CI_Controller {

	public function getRumusanGradingDun(){
		//INITIALIZATION
		$sesi = strtoupper($this->session->userdata('peranan'));

		if(strpos($sesi, 'PERUMUS') !== FALSE){
			$sesi = 'PERUMUS';
		}

		switch($sesi){
			case 'PERUMUS' :

				$pilihanrayaBil = $this->input->post('pilihanrayaBil');
				$dunBil = $this->input->post('dunBil');

				//LOAD MODEL
				$this->load->model('harian_model');
				$this->load->model('pencalonan_model');
				$this->load->model('pdm_model');
				$this->load->model('parti_model');
				$this->load->model('status_grading_model');
				

				//LOAD DATA
				$senaraiTarikh = $this->harian_model->senaraiTarikhDun($pilihanrayaBil, $dunBil);

				$sTarikh = array();
				$rPeratusan = array();
				$rMajoriti = array();

				foreach($senaraiTarikh as $st){
					$majoritiPengundi = 0;
					//Majoriti Pengundi = Parti Kerajaan - Parti Lain-lain
					$bilanganPengundi = 0;
					//Bilangan Pengundi merujuk kepada pengundi yang dijangka keluar
					$senaraiCalon = $this->pencalonan_model->calon_dun($dunBil, $pilihanrayaBil);
					$senaraiDm = $this->pdm_model->dun($dunBil);
					

					//MENCARI JUMLAH KELUAR MENGUNDI
					foreach($senaraiDm as $dm){
						$harianDm = $this->harian_model->dm_harian($st->harian_tarikh, $dm->pdt_bil);
						if(!empty($harianDm)){
							$jumlahPengundi = floor(($harianDm->hddt_keluar_mengundi / 100) * $dm->pdt_bilangan_pengundi);
							$bilanganPengundi = $bilanganPengundi + $jumlahPengundi;
						}
					}

					//MENCARI PENGUNDI MENGIKUT CALON
					$pengundi = array();
					foreach($senaraiCalon as $calon){
						$pengundi[$calon->pencalonan_bil] = 0;
						foreach($senaraiDm as $dm){
							$harianDm = $this->harian_model->dm_harian($st->harian_tarikh, $dm->pdt_bil);
							if(!empty($harianDm)){
								$grading = $this->status_grading_model->hari_pdm_dun($calon->pencalonan_bil, $dm->pdt_bil, $st->harian_tarikh);
								$pengundiCalonDm = floor(($grading->sgpdt_peratus/100) * $jumlahPengundi);
								$pengundi[$calon->pencalonan_bil] = $pengundi[$calon->pencalonan_bil] + $pengundiCalonDm;
							}
						}
						
					}

					//MENCARI MAJORITI
					$tempPutih = 0;
					$tempNotPutih = 0;

					foreach($senaraiCalon as $calon){
						$partiPilihan = $this->parti_model->pilihan_parti($calon->pencalonan_parti);
						if(!empty($partiPilihan)){
							if($pengundi[$calon->pencalonan_bil] >= $tempPutih){
								$tempPutih = $pengundi[$calon->pencalonan_bil];
							}
						}else{
							if($pengundi[$calon->pencalonan_bil] >= $tempNotPutih){
								$tempNotPutih = $pengundi[$calon->pencalonan_bil];
							}
						}
					}
					$majoritiPengundi = $tempPutih - $tempNotPutih;
					$rMajoriti[] = $majoritiPengundi;
					$peratus = ($majoritiPengundi / $bilanganPengundi) * 100;
					//$sTarikh[] = date_format(date_create($st->harian_tarikh), "d/m");
					$sTarikh[] = $st->harian_tarikh;
					$rPeratusan[] = number_format($peratus, 2, '.', '');
				}

				$rumusan = array(
					'hari' => $sTarikh,
					'peratusan' => $rPeratusan,
					'majoriti' => $rMajoriti
				);
				echo json_encode($rumusan);
				break;
			default :
				redirect(base_url());
		}
	}

	public function proses_grading_dun_kedua(){
		$this->load->model('pilihanraya_model');
		$this->load->model('harian_model');
		$this->load->model('pencalonan_model');
		$this->load->model('status_grading_model');
		$this->load->model('parti_model');
		$pilihanraya_bil = $this->input->post('input_pilihanraya_bil');
		$pr = $this->pilihanraya_model->pilihanraya($pilihanraya_bil);
		$jumlah_atas_pagar = 0;
		if($pr->pilihanraya_jenis == "DUN"){
			$dun_bil = $this->input->post("input_dun_bil");
			$senarai_calon = $this->pencalonan_model->senarai_calon_tanpa_grading($dun_bil, $pilihanraya_bil);
			$input_dm_bil = $this->input->post('input_dm_bil');
			if(!empty($input_dm_bil)){
				$senarai_dm = $this->input->post('input_dm_bil');
				$senarai_hddt_bil = $this->input->post('input_hddt_bil');
				$senarai_hddt_pengundi = $this->input->post('input_hddt_pengundi');
				$senarai_hddt_keluar_mengundi = $this->input->post('input_hddt_keluar_mengundi');
				$senarai_hddt_atas_pagar = $this->input->post("input_hddt_atas_pagar");
				$senarai_grading = $this->input->post("input_grading");
				$senarai_grading_bil = $this->input->post('input_grading_bil');
				$senarai_hddt_parti = $this->input->post('input_hddt_parti');
				$bil = count($senarai_dm);
				$jumlah_keluar_mengundi = 0;
				$jumlah_pengundi = 0;
				$senarai_bilangan_pengundi = array();
				foreach($senarai_calon as $calon){
					$senarai_bilangan_pengundi[$calon->pencalonan_bil] = 0;
				}
				for($i = 0; $i < $bil; $i++){
					$hddt_bil = $senarai_hddt_bil[$i];
					$hddt_pengundi = $senarai_hddt_pengundi[$i];
					$jumlah_pengundi = $jumlah_pengundi + $hddt_pengundi;
					$hddt_keluar_mengundi = $senarai_hddt_keluar_mengundi[$i];
					$jangkaan_keluar_mengundi = $hddt_keluar_mengundi/100*$hddt_pengundi;
					$jumlah_keluar_mengundi = $jumlah_keluar_mengundi + $jangkaan_keluar_mengundi;
					$hddt_atas_pagar = $senarai_hddt_atas_pagar[$i];
					$ap = $hddt_atas_pagar/100*$jangkaan_keluar_mengundi;
					$jumlah_atas_pagar = $jumlah_atas_pagar + $ap;
					$hddt_dun_bil = $dun_bil;
					$hddt_tarikh = date("Y-m-d H:i:s");
					$hddt_dm_bil = $senarai_dm[$i];
					$hddt_parti = $senarai_hddt_parti[$i];
					$this->harian_model->kemaskini_harian_pdm(
						$hddt_bil, 
						$hddt_pengundi, 
						$hddt_keluar_mengundi, 
						$hddt_atas_pagar, 
						$hddt_dun_bil, 
						$hddt_dm_bil, 
						$hddt_tarikh,
						$hddt_parti
					);
					foreach($senarai_calon as $calon){
						$grad = $senarai_grading[$calon->pencalonan_bil];
						$grading_bil = $senarai_grading_bil[$calon->pencalonan_bil];
						$g = $grad[$i];
						$pencalonan_bil = $calon->pencalonan_bil;
						$peratus = $g;
						$senarai_bilangan_pengundi[$calon->pencalonan_bil] = $senarai_bilangan_pengundi[$calon->pencalonan_bil] + floor(($peratus/100)*$jangkaan_keluar_mengundi);
						$dm_bil = $hddt_dm_bil;
						$g_bil = $grading_bil[$i];
						$this->status_grading_model->kemaskini_grading_pdm_dun($g_bil, $pencalonan_bil, $peratus, $dm_bil);
					}
				}
			}
			//STATUS DUN
			$input_grading_dun = $this->input->post('input_grading_dun');
			$tertinggi = 0;
			$parti_tertinggi = 0;
			if(!empty($input_grading_dun)){
				$tmp_putih = 0;
				$tmp_not_putih = 0;

				foreach($senarai_calon as $calon){
					$pencalonan_bil = $calon->pencalonan_bil;
					$bilangan_pengundi = $senarai_bilangan_pengundi[$calon->pencalonan_bil];
					$parti_pilihan = $this->parti_model->pilihan_parti($calon->pencalonan_parti);
					if(!empty($parti_pilihan)){
						if($tmp_putih <= $bilangan_pengundi){
							$tmp_putih = $bilangan_pengundi;
						}
					}else{
						if($tmp_not_putih <= $bilangan_pengundi){
							$tmp_not_putih = $bilangan_pengundi;
						}
					}
					if($tertinggi <= $bilangan_pengundi){
						$tertinggi = $bilangan_pengundi;
						$parti_tertinggi = $calon->pencalonan_parti;
					}
					$peratus = $bilangan_pengundi / $jumlah_keluar_mengundi * 100;
					$tarikh = date("Y-m-d");
					$grading_dun = $this->status_grading_model->hari_ini_dun_tarikh($pencalonan_bil, $dun_bil, $tarikh);
					if(empty($grading_dun)){
						$this->status_grading_model->tambah_grading_dun($tarikh, $pencalonan_bil, $peratus, $dun_bil);
					}else{
						$bil = $grading_dun->status_grading_bil;
						$this->status_grading_model->kemaskini_grading_dun($bil, $pencalonan_bil, $peratus, $dun_bil);
					}
				}
			}
			//HARIAN DUN
			$bil = $this->input->post('input_harian_bil');
			$majoriti = $tmp_putih - $tmp_not_putih;
			$peratusan = $majoriti/$jumlah_keluar_mengundi*100;
			$grade = $this->grading_status($peratusan);
			$grading = $grade['grade'];
			$tarikh = date("Y-m-d");
			$pengguna_bil = $this->session->userdata('pengguna_bil');
			$waktu = date("Y-m-d H:i:s");
			$ulasan = $this->input->post('input_harian_ulasan');
			$atas_pagar = $jumlah_atas_pagar/$jumlah_keluar_mengundi*100;
			$keluar_mengundi = $jumlah_keluar_mengundi / $jumlah_pengundi * 100;
			$this->harian_model->kemaskini_harian_dun($bil, $grading, $tarikh, $dun_bil, $pengguna_bil, $waktu, $ulasan, $pilihanraya_bil, $atas_pagar, $keluar_mengundi, $parti_tertinggi);
		}	
		if(empty($pilihanraya_bil)){
			redirect(base_url());
		}
		if(empty($bil)){
			redirect('grading/pilihanraya/'.$pilihanraya_bil, 'refresh');
		}
		redirect('grading/harianDun/'.$bil, 'refresh');
	}

	public function harianParlimen($harianBil){
		if(empty($harianBil)){
			redirect(base_url());
		}
		$sesi = strtoupper($this->session->userdata('peranan'));
		if(strpos($sesi, 'PPD') !== FALSE){
			$sesi = 'PPD';
		}
		$penggunaBil = $this->session->userdata('pengguna_bil');

		//PERANAN BIL
		$perananBil = $this->session->userdata('peranan_bil');

		//Loading MODEL
		$this->load->model('pengguna_model');
		$this->load->model('harian_parlimen_model');
		$this->load->model('parlimen_model');
		$this->load->model('pilihanraya_model');
		$this->load->model('pdm_model');
		$this->load->model('pencalonan_parlimen_model');
		$this->load->model('parti_model');
		$this->load->model('status_grading_model');
		$this->load->model('foto_model');

		//Loading DATA
		$data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
		$data['harian'] = $this->harian_parlimen_model->harian($harianBil);
		$data['parlimen'] = $this->parlimen_model->parlimen_bil($data['harian']->parlimenBil);
		$data['pilihanraya'] = $this->pilihanraya_model->pilihanraya($data['harian']->pruBil);
		$data['senaraiDM'] = $this->pdm_model->parlimenGrading($data['harian']->parlimenBil, $data['harian']->tarikh);
		$data['senaraiCalon'] = $this->pencalonan_parlimen_model->calonParlimenGrading($data['harian']->parlimenBil, $data['harian']->pruBil, $data['harian']->tarikh);
		if(empty($data['senaraiCalon'])){
			$data['senaraiCalon'] = $this->pencalonan_parlimen_model->calon_parlimen($data['parlimen']->pt_bil, $data['pilihanraya']->pilihanraya_bil);
		}
		$data['dataParti'] = $this->parti_model;
		$data['dataGrading'] = $this->status_grading_model;
		$data['dataFoto'] = $this->foto_model;

		switch($sesi){
			case 'PPD' :
				$data['senaraiParlimenPilihanraya'] = $this->pilihanraya_model->senaraiParlimenPilihanrayaPeranan($data['harian']->pruBil, $perananBil);
				$this->load->view('ppd_na/sismap/harian/harianParlimenBil', $data);
				break;
			default :
				redirect(base_url());
		}
	}

	public function binaDun(){

		//SEMAK PASS VALUE SECARA POST, KALAU EMPTY BACK TO HOME
		$dunBil = $this->input->post('inputDunBil');
		$pilihanrayaBil = $this->input->post('inputPilihanrayaBil');
		if(empty($dunBil)){
			redirect(base_url());
		}
		if(empty($pilihanrayaBil)){
			redirect(base_url());
		}

		//PENGGUNA BIL
		$penggunaBil = $this->session->userdata('pengguna_bil');

		//TARIKH
		$tarikh = date('Y-m-d');
		$waktu = date('Y-m-d H:i:s');

		//LOAD MODEL YANG BERKAITAN
		$this->load->model('pencalonan_model');
		$this->load->model('pdm_model');
		$this->load->model('harian_model');
		$this->load->model('status_grading_model');

		echo "LOAD HARIAN MODULE FOR DUN<br>";
		//SEMAK KEWUJUDAN DALAM HARIAN
		$harian = $this->harian_model->hari_ini($dunBil, $pilihanrayaBil, $tarikh);
		//KALAU TIADA WUJUDKAN DAN RETRIEVE
		if(empty($harian)){

			//BINA TEMP
			$tempHarian = $this->harian_model->semasa_dun($dunBil);

			//SEANDAINYA ADA
			if(!empty($tempHarian)){

				echo "HARIAN $dunBil EXISTED<br>";

				//MASUKKAN KE TARIKH HARI INI
				$this->harian_model->tambah_harian_dun($tempHarian->harian_grading, $tarikh, $dunBil, $tempHarian->harian_ulasan, $pilihanrayaBil, $waktu, $tempHarian->harian_parti, $tempHarian->harian_atas_pagar, $tempHarian->harian_keluar_mengundi);
							
				//SEMAK SEKALI LAGI
				$harian = $this->harian_model->hari_ini($dunBil, $pilihanrayaBil, $tarikh);
			}else{

				echo "HARIAN $dunBil NOT EXISTS<br>";

				//ATAS PAGAR
				$atasPagar = 70;

				//MASUK BAHARU
				$this->harian_model->tambah_harian_dun(0, $tarikh, $dunBil, '', $pilihanrayaBil, $waktu, 0, 100, 70);

				//SEMAK SEKALI LAGI
				$harian = $this->harian_model->hari_ini($dunBil, $pilihanrayaBil, $tarikh);
			}
		}
		
		echo "LOAD HARIAN MODULE FOR DAERAH MENGUNDI<br>";
		//SEMAK KEWUJUDAN DALAM HARIAN DM
		//LOAD DM DALAM PARLIMEN
		$senaraiDM = $this->pdm_model->dun($dunBil);
		//LOOP SENARAI DM
		foreach($senaraiDM as $dm){

			echo "CREATING FOR $dm->pdt_nama<br>";

			$dmHarian = $this->harian_model->dm_harian($tarikh, $dm->pdt_bil);
			if(empty($dmHarian)){
				$tempDmHarian = $this->harian_model->dm_semasa($dm->pdt_bil);
				if(!empty($tempDmHarian)){
					echo "HARIAN FOR $dm->pdt_nama EXISTED<br>";
					$this->harian_model->tambah_harian_pdm($tempDmHarian->hddt_pengundi, $tempDmHarian->hddt_keluar_mengundi, $tempDmHarian->hddt_atas_pagar, $tempDmHarian->hddt_dun_bil, $dm->pdt_bil, $waktu, $tempDmHarian->hddt_parti);
					$dmHarian = $this->harian_model->dm_harian($tarikh, $dm->pdt_bil);
				}else{
					echo "HARIAN FOR $dm->pdt_nama NOT EXISTS<br>";
					$keluarMengundi = 70;
					$bilanganPengundi = 0;
					$bilanganPengundi = ($keluarMengundi/100) * $dm->pdt_bilangan_pengundi;
					$this->harian_model->tambah_harian_pdm($bilanganPengundi, $keluarMengundi, 100, $dunBil, $dm->pdt_bil, $waktu, 0);
					$dmHarian = $this->harian_model->dm_harian($tarikh, $dm->pdt_bil);
				}
			}
		}

		echo "LOAD GRADING MODULE FOR DUN<br>";
		//SEMAK STATUS GRADING DUN

		//SENARAI CALON
		$senaraiCalon = $this->pencalonan_model->calon_dun($dunBil, $pilihanrayaBil);
		//LOAD CALON SEANDAINYA ADA
		if(!empty($senaraiCalon)){
			echo 'CALON EXISTED<br>';
			foreach($senaraiCalon as $calon){
				$g = $this->status_grading_model->hari_ini_dun_tarikh($calon->pencalonan_bil, $dunBil, $tarikh);
				//SEANDAINYA TIADA
				if(empty($g)){
					echo "LATEST GRADING CALON $calon->pencalonan_bil NOT EXISTS<br>";
					$tempG = $this->status_grading_model->hari_ini_dun($calon->pencalonan_bil, $dunBil);
					if(!empty($tempG)){
						echo "GRADING CALON $calon->pencalonan_bil EXISTED<br>";
						$this->status_grading_model->tambah_grading_dun($tarikh, $calon->pencalonan_bil, $tempG->status_grading_peratus, $dunBil);
						$g = $this->status_grading_model->hari_ini_dun_tarikh($calon->pencalonan_bil, $dunBil, $tarikh);
					}else{
						echo "GRADING CALON $calon->pencalonan_bil NOT EXISTS<br>";
						$this->status_grading_model->tambah_grading_dun($tarikh, $calon->pencalonan_bil, 0, $dunBil);
						$g = $this->status_grading_model->hari_ini_dun_tarikh($calon->pencalonan_bil, $dunBil, $tarikh);
					}
				}

				//SEMAK STATUS GRADING DM
				//LOOP SENARAI DM UNTUK CALON
				foreach($senaraiDM as $dm){
					$gdm = $this->status_grading_model->hari_pdm_dun($calon->pencalonan_bil, $dm->pdt_bil, $tarikh);
					//SEANDAINYA TIADA
					if(empty($gdm)){
						echo "GRADING DM $dm->pdt_bil FOR CALON $calon->pencalonan_bil NOT EXISTS<br>";
						//LOAD LATEST
						$tempGdm = $this->status_grading_model->hari_ini_pdm_dun($calon->pencalonan_bil, $dm->pdt_bil);
						if(!empty($tempGdm)){
							echo "GRADING LATEST DM $dm->pdt_bil FOR CALON $calon->pencalonan_bil EXISTS<br>";
							$this->status_grading_model->tambah_grading_pdm_dun($tarikh, $calon->pencalonan_bil, $tempGdm->sgpdt_peratus, $dm->pdt_bil);
							$g = $this->status_grading_model->hari_pdm_dun($calon->pencalonan_bil, $dm->pdt_bil, $tarikh);
						}else{
							echo "GRADING LATEST DM $dm->pdt_bil FOR CALON $calon->pencalonan_bil NOT EXISTS<br>";
							$this->status_grading_model->tambah_grading_pdm_dun($tarikh, $calon->pencalonan_bil, 0, $dm->pdt_bil);
							$g = $this->status_grading_model->hari_pdm_dun($calon->pencalonan_bil, $dm->pdt_bil, $tarikh);
						}
					}
				}
			}
		}

		echo "PROSES DONE";

		redirect('grading/harianDun/'.$harian->harian_bil);
	}

	public function binaParlimen(){

		//SEMAK PASS VALUE SECARA POST, KALAU EMPTY BACK TO HOME
		$parlimenBil = $this->input->post('inputParlimenBil');
		$pilihanrayaBil = $this->input->post('inputPilihanrayaBil');
		if(empty($parlimenBil)){
			redirect(base_url());
		}
		if(empty($pilihanrayaBil)){
			redirect(base_url());
		}

		//PENGGUNA BIL
		$penggunaBil = $this->session->userdata('pengguna_bil');

		//TARIKH
		$tarikh = date('Y-m-d');
		$waktu = date('Y-m-d H:i:s');

		//LOAD MODEL YANG BERKAITAN
		$this->load->model('pencalonan_parlimen_model');
		$this->load->model('pdm_model');
		$this->load->model('harian_parlimen_model');
		$this->load->model('status_grading_model');

		echo "LOAD HARIAN MODULE FOR PARLIMEN<br>";
		//SEMAK KEWUJUDAN DALAM HARIAN
		$harian = $this->harian_parlimen_model->hari_ini($parlimenBil, $pilihanrayaBil, $tarikh);
		//KALAU TIADA WUJUDKAN DAN RETRIEVE
		if(empty($harian)){

			//BINA TEMP
			$tempHarian = $this->harian_parlimen_model->semasa_parlimen($parlimenBil);

			//SEANDAINYA ADA
			if(!empty($tempHarian)){

				echo "HARIAN $parlimenBil EXISTED<br>";

				//MASUKKAN KE TARIKH HARI INI
				$this->harian_parlimen_model->tambah_harian_parlimen_penuh($tempHarian->harian_parlimen_grading, $tarikh, $parlimenBil, $penggunaBil, $waktu, $tempHarian->harian_parlimen_ulasan, $pilihanrayaBil, $tempHarian->harian_parlimen_atas_pagar, $tempHarian->harian_parlimen_keluar_mengundi, $tempHarian->harian_parlimen_parti);
							
				//SEMAK SEKALI LAGI
				$harian = $this->harian_parlimen_model->hari_ini($parlimenBil, $pilihanrayaBil, $tarikh);
			}else{

				echo "HARIAN $parlimenBil NOT EXISTS<br>";

				//ATAS PAGAR
				$atasPagar = 70;

				//MASUK BAHARU
				$returnHarian = $this->harian_parlimen_model->binaDataHarian($tarikh, $parlimenBil, $pilihanrayaBil, $atasPagar);

				//SEMAK SEKALI LAGI
				$harian = $this->harian_parlimen_model->hari_ini($parlimenBil, $pilihanrayaBil, $tarikh);
			}
		}
		
		echo "LOAD HARIAN MODULE FOR DAERAH MENGUNDI<br>";
		//SEMAK KEWUJUDAN DALAM HARIAN DM
		//LOAD DM DALAM PARLIMEN
		$senaraiDM = $this->pdm_model->parlimen($parlimenBil);
		//LOOP SENARAI DM
		foreach($senaraiDM as $dm){

			echo "CREATING FOR $dm->ppt_nama<br>";

			$dmHarian = $this->harian_parlimen_model->dm_harian($tarikh, $dm->ppt_bil);
			if(empty($dmHarian)){
				$tempDmHarian = $this->harian_parlimen_model->dm_semasa($dm->ppt_bil);
				if(!empty($tempDmHarian)){
					echo "HARIAN FOR $dm->ppt_nama EXISTED<br>";
					$this->harian_parlimen_model->tambah_harian_pdm($tempDmHarian->hdpt_pengundi, $tempDmHarian->hdpt_keluar_mengundi, $tempDmHarian->hdpt_atas_pagar, $tempDmHarian->hdpt_parlimen_bil, $dm->ppt_bil, $waktu, $tempDmHarian->hdpt_parti);
					$dmHarian = $this->harian_parlimen_model->dm_harian($tarikh, $dm->ppt_bil);
				}else{
					echo "HARIAN FOR $dm->ppt_nama NOT EXISTS<br>";
					$keluarMengundi = 70;
					$bilanganPengundi = 0;
					$bilanganPengundi = ($keluarMengundi/100) * $dm->ppt_bilangan_pengundi;
					$this->harian_parlimen_model->tambah_harian_pdm($bilanganPengundi, $keluarMengundi, 100, $parlimenBil, $dm->ppt_bil, $waktu, 0);
					$dmHarian = $this->harian_parlimen_model->dm_harian($tarikh, $dm->ppt_bil);
				}
			}
		}

		echo "LOAD GRADING MODULE FOR PARLIMEN<br>";
		//SEMAK STATUS GRADING PARLIMEN

		//SENARAI CALON
		$senaraiCalon = $this->pencalonan_parlimen_model->calon_parlimen($parlimenBil, $pilihanrayaBil);
		//LOAD CALON SEANDAINYA ADA
		if(!empty($senaraiCalon)){
			echo 'CALON EXISTED<br>';
			foreach($senaraiCalon as $calon){
				$g = $this->status_grading_model->hari_ini_parlimen_tarikh($calon->pencalonan_parlimen_bil, $parlimenBil, $tarikh);
				//SEANDAINYA TIADA
				if(empty($g)){
					echo "LATEST GRADING CALON $calon->pencalonan_parlimen_bil NOT EXISTS<br>";
					$tempG = $this->status_grading_model->hari_ini_parlimen($calon->pencalonan_parlimen_bil, $parlimenBil);
					if(!empty($tempG)){
						echo "GRADING CALON $calon->pencalonan_parlimen_bil EXISTED<br>";
						$this->status_grading_model->tambah_grading_parlimen($tarikh, $calon->pencalonan_parlimen_bil, $tempG->sgpt_peratus, $parlimenBil);
						$g = $this->status_grading_model->hari_ini_parlimen_tarikh($calon->pencalonan_parlimen_bil, $parlimenBil, $tarikh);
					}else{
						echo "GRADING CALON $calon->pencalonan_parlimen_bil NOT EXISTS<br>";
						$this->status_grading_model->tambah_grading_parlimen($tarikh, $calon->pencalonan_parlimen_bil, 0, $parlimenBil);
						$g = $this->status_grading_model->hari_ini_parlimen_tarikh($calon->pencalonan_parlimen_bil, $parlimenBil, $tarikh);
					}
				}

				//SEMAK STATUS GRADING DM
				//LOOP SENARAI DM UNTUK CALON
				foreach($senaraiDM as $dm){
					$gdm = $this->status_grading_model->hari($tarikh, $calon->pencalonan_parlimen_bil, $dm->ppt_bil);
					//SEANDAINYA TIADA
					if(empty($gdm)){
						echo "GRADING DM $dm->ppt_bil FOR CALON $calon->pencalonan_parlimen_bil NOT EXISTS<br>";
						//LOAD LATEST
						$tempGdm = $this->status_grading_model->semasa($calon->pencalonan_parlimen_bil, $dm->ppt_bil);
						if(!empty($tempGdm)){
							echo "GRADING LATEST DM $dm->ppt_bil FOR CALON $calon->pencalonan_parlimen_bil EXISTS<br>";
							$this->status_grading_model->tambah_grading_pdm_parlimen($tarikh, $calon->pencalonan_parlimen_bil, $tempGdm->sgppt_peratus, $dm->ppt_bil);
							$g = $this->status_grading_model->hari($tarikh, $calon->pencalonan_parlimen_bil, $dm->ppt_bil);
						}else{
							echo "GRADING LATEST DM $dm->ppt_bil FOR CALON $calon->pencalonan_parlimen_bil NOT EXISTS<br>";
							$this->status_grading_model->tambah_grading_pdm_parlimen($tarikh, $calon->pencalonan_parlimen_bil, 0, $dm->ppt_bil);
							$g = $this->status_grading_model->hari($tarikh, $calon->pencalonan_parlimen_bil, $dm->ppt_bil);
						}
					}
				}
			}
		}

		echo "PROSES DONE";

		redirect('grading/harianParlimen/'.$harian->harian_parlimen_bil);
	}

	public function parlimenPilihanraya(){
		$parlimenBil = $this->input->post('inputParlimenBil');
		if(empty($parlimenBil)){
			redirect(base_url());
		}
		$pilihanrayaBil = $this->input->post('inputPilihanrayaBil');
		if(empty($pilihanrayaBil)){
			redirect(base_url());
		}
		$sesi = strtoupper($this->session->userdata('peranan'));
		if(strpos($sesi, 'PPD') !== FALSE){
			$sesi = 'PPD';
		}
		$penggunaBil = $this->session->userdata('pengguna_bil');
		//Loading MODEL
		$this->load->model('pengguna_model');
		$this->load->model('harian_parlimen_model');
		$this->load->model('parlimen_model');
		$this->load->model('pilihanraya_model');

		//Loading DATA
		$data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
		$data['senaraiHarian'] = $this->harian_parlimen_model->senarai_harian($parlimenBil, $pilihanrayaBil);
		$data['parlimen'] = $this->parlimen_model->parlimen_bil($parlimenBil);
		$data['pilihanraya'] = $this->pilihanraya_model->pilihanraya($pilihanrayaBil);

		switch($sesi){
			case 'PPD' :
				$this->load->view('ppd_na/sismap/harian/harianParlimenKedua', $data);
				break;
			default :
				redirect(base_url());
		}
	}

	public function harianDun($harianBil){
		if(empty($harianBil)){
			redirect(base_url());
		}
		$sesi = strtoupper($this->session->userdata('peranan'));
		if(strpos($sesi, 'PPD') !== FALSE){
			$sesi = 'PPD';
		}

		//TARIKH
		$tarikh = date('Y-m-d');

		//PENGGUNA BIL
		$penggunaBil = $this->session->userdata('pengguna_bil');

		//PERANAN BIL
		$perananBil = $this->session->userdata('peranan_bil');

		//Loading MODEL
		$this->load->model('pengguna_model');
		$this->load->model('harian_model');
		$this->load->model('dun_model');
		$this->load->model('pilihanraya_model');
		$this->load->model('pdm_model');
		$this->load->model('pencalonan_model');
		$this->load->model('parti_model');
		$this->load->model('status_grading_model');
		$this->load->model('foto_model');

		//Loading DATA
		$data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
		$data['harian'] = $this->harian_model->harian($harianBil);
		$data['dun'] = $this->dun_model->dun($data['harian']->harian_dun);
		$data['pilihanraya'] = $this->pilihanraya_model->pilihanraya($data['harian']->harian_pilihanraya);
		$data['senaraiDM'] = $this->pdm_model->dunGrading($data['harian']->harian_dun, $data['harian']->harian_tarikh);
		$data['senaraiCalon'] = $this->pencalonan_model->calonDunGrading($data['dun']->dun_bil, $data['pilihanraya']->pilihanraya_bil, $data['harian']->harian_tarikh);
		if(empty($data['senaraiCalon'])){
			$data['senaraiCalon'] = $this->pencalonan_model->calon_dun($data['dun']->dun_bil, $data['pilihanraya']->pilihanraya_bil);
		}
		$data['dataParti'] = $this->parti_model;
		$data['dataGrading'] = $this->status_grading_model;
		$data['dataFoto'] = $this->foto_model;

		switch($sesi){
			case 'PPD' :
				$data['senaraiDunPilihanraya'] = $this->pilihanraya_model->senaraiDunPilihanrayaPeranan($data['harian']->harian_pilihanraya, $perananBil);
				//SEANDAINYA TARIKH HARI INI
				if($tarikh == $data['harian']->harian_tarikh){
					$this->load->view('ppd_na/sismap/harian/kemaskiniGradingDun', $data);
				}else{
					$this->load->view('ppd_na/sismap/harian/harianDunBil', $data);
				}
				break;
			default :
				redirect(base_url());
		}
	}

	public function dunPilihanraya(){
		$dunBil = $this->input->post('inputDunBil');
		if(empty($dunBil)){
			redirect(base_url());
		}
		$pilihanrayaBil = $this->input->post('inputPilihanrayaBil');
		if(empty($pilihanrayaBil)){
			redirect(base_url());
		}
		$sesi = strtoupper($this->session->userdata('peranan'));
		if(strpos($sesi, 'PPD') !== FALSE){
			$sesi = 'PPD';
		}
		$penggunaBil = $this->session->userdata('pengguna_bil');
		//Loading MODEL
		$this->load->model('pengguna_model');
		$this->load->model('harian_model');
		$this->load->model('dun_model');
		$this->load->model('pilihanraya_model');

		//Loading DATA
		$data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
		$data['senaraiHarian'] = $this->harian_model->senarai_harian($dunBil, $pilihanrayaBil);
		$data['dun'] = $this->dun_model->dun($dunBil);
		$data['pilihanraya'] = $this->pilihanraya_model->pilihanraya($pilihanrayaBil);

		switch($sesi){
			case 'PPD' :
				$this->load->view('ppd_na/sismap/harian/harianDun', $data);
				break;
			default :
				redirect(base_url());
		}
	}

	public function status_grading($parlimen_bil)
	{

	}

	public function parlimen()
	{
		$sesi = strtoupper($this->session->userdata("peranan"));
		$penggunaBil = $this->session->userdata("pengguna_bil");
		$this->load->model("pengguna_model");
		$data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
		if(strpos($sesi, 'PPD') !== FALSE){
			$sesi = "PPD";
		}
		switch($sesi){
			case 'DATA' :
				$this->load->model('harian_parlimen_model');
				$data['senaraiGrading'] = $this->harian_parlimen_model->senaraiGradingParlimen();
				$this->load->view('us_sismap_na/sismap/harian/utamaParlimen', $data);
				break;
			default :
				redirect(base_url());
		}
	}

	public function parlimenBil($parlimen_bil)
	{
		$sesi = strtoupper($this->session->userdata("peranan"));
		$penggunaBil = $this->session->userdata("pengguna_bil");
		$this->load->model("pengguna_model");
		$data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
		if(strpos($sesi, 'PPD') !== FALSE){
			$sesi = "PPD";
		}
		switch($sesi){
			case 'PPD' :
				$this->load->model('parlimen_model');
				$this->load->model('pdm_model');
				$this->load->model('pilihanraya_model');
				$this->load->model('harian_parlimen_model');
				$this->load->model('pencalonan_parlimen_model');
				$this->load->model('status_grading_model');
				$data['data_grading'] = $this->status_grading_model;
				$data['data_dm_harian'] = $this->harian_parlimen_model;
				$data['senarai_pilihanraya'] = $this->pilihanraya_model->parlimen_pr_aktif($parlimen_bil);
				$data['senarai_daerah_mengundi'] = $this->pdm_model->parlimen($parlimen_bil);
				$data['parlimen'] = $this->parlimen_model->parlimen_bil($parlimen_bil);
				$data['data_calon'] = $this->pencalonan_parlimen_model;
				$this->load->view('susunletak/atas', $data);
				$this->load->view('ppd/grading_parlimen');
				$this->load->view('susunletak/bawah');
				break;
			default :
				redirect(base_url());
		}
	}

	private function grading_status($majoriti){
		$grade = 'BELUM DITETAPKAN';
		$warna = 'background:red; color:white';
		if(10.00 <= $majoriti){
			$grade = 'PUTIH';
			$warna = 'background:white; color:black';
		}
		if($majoriti >= 0.00 && $majoriti < 10.00){
			$grade = 'KELABU PUTIH';
			$warna = 'background:#BEBEBE; color:black';
		}
		if($majoriti < 0.00 && $majoriti > -10.00){
			$grade = 'KELABU HITAM';
			$warna = 'background:#696969; color:white';
		}
		if($majoriti <= -10.00){
			$grade = 'HITAM';
			$warna = 'background:#000000; color:white';
		}
		$grading = array(
			'grade' => $grade,
			'warna' => $warna
		);
		return $grading;
	}

	public function index()
	{
		$sesi = strtoupper($this->session->userdata('peranan'));
		$penggunaBil = $this->session->userdata('pengguna_bil');
		$this->load->model('pengguna_model');
		$data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
		switch($sesi){
			case 'DATA' :
				$this->load->model('status_grading_model');
				$data['bilanganGradingDun'] = $this->status_grading_model->bilanganGradingDun();
				$data['bilanganGradingParlimen'] = $this->status_grading_model->bilanganGradingParlimen();
				$this->load->view('us_sismap_na/sismap/harian/lamanUtama', $data);
				break;
		}
	}

	public function kemaskini(){
		$tmp_status_grading_bil = $this->input->post('status_grading_bil');
		if(empty($tmp_status_grading_bil)){
			redirect(base_url());
		}
		$this->load->model('status_grading_model');
		$this->status_grading_model->set($this->input->post('status_grading_bil'), $this->input->post('status_grading_peratus'));
		redirect('dun/papar_dun/'.$this->input->post('dun_bil'));
		
	}

	public function grading_parlimen($parlimen_id)
	{
		$tmp_parlimen = $parlimen_id;
		if(empty($tmp_parlimen)){
			redirect(base_url());
		}
		$sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE)
		{
			redirect(base_url());
		}
		$this->load->model('parlimen_model');
		$this->load->model('harian_parlimen_model');
		$this->load->model('pengguna_model');
		$data['data_pengguna'] = $this->pengguna_model;
		$data['parlimen'] = $this->parlimen_model->parlimen_bil($parlimen_id);
		$data['senarai_grading'] = $this->harian_parlimen_model->senarai($parlimen_id);
		$this->load->view('susunletak/atas', $data);
		$this->load->view('parlimen/grading');
		$this->load->view('susunletak/bawah');
	}

	public function pilihanraya2($pilihanraya_bil){
		$peranan = $this->session->userdata('peranan');
		if(empty($peranan))
		{
			redirect(base_url());
		}
		$this->load->model('japen_model');
		$this->load->model('pengguna_model');
		$this->load->model('harian_parlimen_model');
		$data['senarai_parlimen'] = $this->japen_model->senarai_tugas_parlimen($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
		$data['data_harian'] = $this->harian_parlimen_model;
		$this->load->view('susunletak/atas', $data);
		$this->load->view('ppd/senarai_parlimen');
		$this->load->view('susunletak/bawah');
	}

	//LOCK KAT SINI
	public function pilihanraya($pilihanraya_bil){
		$peranan = $this->session->userdata('peranan');
		if(empty($peranan))
		{
			redirect(base_url());
		}
		if(empty($pilihanraya_bil)){
			redirect(base_url());
		}
		if(strpos(strtoupper($peranan), "PPD") === FALSE){
			redirect(base_url());
		}
		$this->load->model('pilihanraya_model');
		$this->load->model('japen_model');
		$this->load->model('pengguna_model');
		$this->load->model('parlimen_model');
		$this->load->model('dun_model');
		$this->load->model('harian_parlimen_model');
		$this->load->model('harian_model');
		$this->load->model('pdm_model');
		$this->load->model('pencalonan_parlimen_model');
		$this->load->model('pencalonan_model');
		$this->load->model('parti_model');
		$this->load->model('pengundi_parlimen_model');
		$this->load->model('pengundi_model');
		$this->load->model('status_grading_model');
		$this->load->model('foto_model');
		$data['data_foto'] = $this->foto_model;
		$data['data_grading'] = $this->status_grading_model;
		$data['data_parti'] = $this->parti_model;
		$data['data_dm'] = $this->pdm_model;
		$data['pru'] = $this->pilihanraya_model->pilihanraya($pilihanraya_bil);
		$data['data_pilihanraya'] = $this->pilihanraya_model;
		if($data['pru']->pilihanraya_jenis == 'PARLIMEN'){
			$data['data_calon'] = $this->pencalonan_parlimen_model;
			$data['data_parlimen'] = $this->parlimen_model;
			$data['data_harian'] = $this->harian_parlimen_model;
			$data['senarai_tugas_parlimen'] = $this->japen_model->senarai_tugas_parlimen($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
			$data['data_pengundi'] = $this->pengundi_parlimen_model;
		}
		if($data['pru']->pilihanraya_jenis == 'DUN'){
			$data['data_calon'] = $this->pencalonan_model;
			$data['data_dun'] = $this->dun_model;
			$data['data_harian'] = $this->harian_model;
			$data['senarai_tugas_dun'] = $this->japen_model->senarai_tugas_dun($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
			$data['data_pengundi'] = $this->pengundi_model;
		}
		$this->load->view('susunletak/atas', $data);
		if($data['pru']->pilihanraya_jenis == 'PARLIMEN'){
			$this->load->view('pilihanraya/grading_parlimen');
		}
		if($data['pru']->pilihanraya_jenis == 'DUN'){
			$this->load->view('pilihanraya/grading');
		}
		$this->load->view('susunletak/bawah');
	}

	public function proses_grading(){
		$this->load->model('pilihanraya_model');
		$this->load->model('harian_parlimen_model');
		$this->load->model('pencalonan_parlimen_model');
		$this->load->model('status_grading_model');
		$this->load->model('harian_parlimen_model');
		$this->load->model('parti_model');
		$pilihanraya_bil = $this->input->post('input_pilihanraya_bil');
		$pr = $this->pilihanraya_model->pilihanraya($pilihanraya_bil);
		$jumlah_atas_pagar = 0;
		if(empty($pr)){
			echo "x jumpa pilihanraya<br />";
		}
		if($pr->pilihanraya_jenis == "PARLIMEN" && !empty($pr)){
			$parlimen_bil = $this->input->post("input_parlimen_bil");
			$senarai_calon = $this->pencalonan_parlimen_model->senarai_calon_tanpa_grading($parlimen_bil, $pilihanraya_bil);
			$input_dm_bil = $this->input->post('input_dm_bil');
			if(!empty($input_dm_bil)){
				$senarai_dm = $this->input->post('input_dm_bil');
				$senarai_hdpt_bil = $this->input->post('input_hdpt_bil');
				$senarai_hdpt_pengundi = $this->input->post('input_hdpt_pengundi');
				$senarai_hdpt_keluar_mengundi = $this->input->post('input_hdpt_keluar_mengundi');
				$senarai_hdpt_atas_pagar = $this->input->post("input_hdpt_atas_pagar");
				$senarai_hdpt_parti = $this->input->post('input_hdpt_parti');
				$senarai_grading = $this->input->post("input_grading");
				$senarai_grading_bil = $this->input->post('input_grading_bil');
				$bil = count($senarai_dm);
				$jumlah_keluar_mengundi = 0;
				$jumlah_pengundi = 0;
				$senarai_bilangan_pengundi = array();
				foreach($senarai_calon as $calon){
					$senarai_bilangan_pengundi[$calon->pencalonan_parlimen_bil] = 0;
				}
				for($i = 0; $i < $bil; $i++){
					if(isset($senarai_hdpt_bil[$i]) && isset($senarai_hdpt_keluar_mengundi[$i]) && isset($senarai_hdpt_pengundi[$i]) && isset($senarai_hdpt_atas_pagar[$i]) && isset($senarai_dm[$i])){
						$hdpt_bil = $senarai_hdpt_bil[$i];
					$hdpt_pengundi = $senarai_hdpt_pengundi[$i];
					$jumlah_pengundi = $jumlah_pengundi + $hdpt_pengundi;
					$hdpt_keluar_mengundi = $senarai_hdpt_keluar_mengundi[$i];
					$jangkaan_keluar_mengundi = $hdpt_keluar_mengundi/100*$hdpt_pengundi;
					$jumlah_keluar_mengundi = $jumlah_keluar_mengundi + $jangkaan_keluar_mengundi;
					$hdpt_atas_pagar = $senarai_hdpt_atas_pagar[$i];
					$hdpt_parti = $senarai_hdpt_parti[$i];
					$ap = $hdpt_atas_pagar/100*$jangkaan_keluar_mengundi;
					$jumlah_atas_pagar = $jumlah_atas_pagar + $ap;
					$hdpt_parlimen_bil = $parlimen_bil;
					$hdpt_tarikh = date("Y-m-d H:i:s");
					$hdpt_dm_bil = $senarai_dm[$i];
					$this->harian_parlimen_model->kemaskini_harian_pdm(
						$hdpt_bil, 
						$hdpt_pengundi, 
						$hdpt_keluar_mengundi, 
						$hdpt_atas_pagar, 
						$hdpt_parlimen_bil, 
						$hdpt_dm_bil, 
						$hdpt_tarikh,
						$hdpt_parti
					);
					}
					foreach($senarai_calon as $calon){
						$grad = $senarai_grading[$calon->pencalonan_parlimen_bil];
						$grading_bil = $senarai_grading_bil[$calon->pencalonan_parlimen_bil];
						$g = $grad[$i];
						$pencalonan_bil = $calon->pencalonan_parlimen_bil;
						$peratus = $g;
						$senarai_bilangan_pengundi[$calon->pencalonan_parlimen_bil] = $senarai_bilangan_pengundi[$calon->pencalonan_parlimen_bil] + floor(($peratus/100)*$jangkaan_keluar_mengundi);
						$dm_bil = $hdpt_dm_bil;
						$g_bil = $grading_bil[$i];
						$this->status_grading_model->kemaskini_grading_pdm_parlimen($g_bil, $pencalonan_bil, $peratus, $dm_bil);
					}
				}
			}
			//STATUS PARLIMEN
			$input_grading_parlimen = $this->input->post('input_grading_parlimen');
			$parti_tertinggi = 0;
			$tertinggi = 0;
			$tmp_putih = 0;
			$tmp_not_putih = 0;
			if(!empty($input_grading_parlimen)){
				
				foreach($senarai_calon as $calon){
					$pencalonan_bil = $calon->pencalonan_parlimen_bil;
					$bilangan_pengundi = $senarai_bilangan_pengundi[$calon->pencalonan_parlimen_bil];
					$parti_pilihan = $this->parti_model->pilihan_parti($calon->pencalonan_parlimen_partiBil);
					if(!empty($parti_pilihan)){
						if($tmp_putih <= $bilangan_pengundi){
							$tmp_putih = $bilangan_pengundi;
						}
					}else{
						if($tmp_not_putih <= $bilangan_pengundi){
							$tmp_not_putih = $bilangan_pengundi;
						}
					}
					if($tertinggi <= $bilangan_pengundi){
						$tertinggi = $bilangan_pengundi;
						$parti_tertinggi = $calon->pencalonan_parlimen_partiBil;
					}
					$peratus = $bilangan_pengundi / $jumlah_keluar_mengundi * 100;
					$tarikh = date("Y-m-d");
					$grading_parlimen = $this->status_grading_model->hari_ini_parlimen_tarikh($pencalonan_bil, $parlimen_bil, $tarikh);
					if(empty($grading_parlimen)){
						$this->status_grading_model->tambah_grading_parlimen($tarikh, $pencalonan_bil, $peratus, $parlimen_bil);
					}else{
						$bil = $grading_parlimen->sgpt_bil;
						$this->status_grading_model->kemaskini_grading_parlimen($bil, $pencalonan_bil, $peratus, $parlimen_bil);
					}
				}
			}
			//HARIAN PARLIMEN
			$bil = $this->input->post('input_harian_bil');
			$majoriti = $tmp_putih - $tmp_not_putih;
			$peratusan = $majoriti/$jumlah_keluar_mengundi*100;
			$grade = $this->grading_status($peratusan);
			$grading = $grade['grade'];
			$tarikh = date("Y-m-d");
			$pengguna_bil = $this->session->userdata('pengguna_bil');
			$waktu = date("Y-m-d H:i:s");
			$ulasan = $this->input->post('input_harian_ulasan');
			$atas_pagar = $jumlah_atas_pagar/$jumlah_keluar_mengundi*100;
			$parti_bil = $parti_tertinggi;
			$keluar_mengundi = $jumlah_keluar_mengundi / $jumlah_pengundi * 100;
			$this->harian_parlimen_model->kemaskini_harian_parlimen($bil, $grading, $tarikh, $parlimen_bil, $pengguna_bil, $waktu, $ulasan, $pilihanraya_bil, $atas_pagar, $keluar_mengundi, $parti_bil);
		}

		redirect('grading/pilihanraya/'.$pilihanraya_bil, 'refresh');
	}

	public function proses_grading_dun(){
		$this->load->model('pilihanraya_model');
		$this->load->model('harian_model');
		$this->load->model('pencalonan_model');
		$this->load->model('status_grading_model');
		$this->load->model('parti_model');
		$pilihanraya_bil = $this->input->post('input_pilihanraya_bil');
		$pr = $this->pilihanraya_model->pilihanraya($pilihanraya_bil);
		$jumlah_atas_pagar = 0;
		if($pr->pilihanraya_jenis == "DUN"){
			$dun_bil = $this->input->post("input_dun_bil");
			$senarai_calon = $this->pencalonan_model->senarai_calon_tanpa_grading($dun_bil, $pilihanraya_bil);
			$input_dm_bil = $this->input->post('input_dm_bil');
			if(!empty($input_dm_bil)){
				$senarai_dm = $this->input->post('input_dm_bil');
				$senarai_hddt_bil = $this->input->post('input_hddt_bil');
				$senarai_hddt_pengundi = $this->input->post('input_hddt_pengundi');
				$senarai_hddt_keluar_mengundi = $this->input->post('input_hddt_keluar_mengundi');
				$senarai_hddt_atas_pagar = $this->input->post("input_hddt_atas_pagar");
				$senarai_grading = $this->input->post("input_grading");
				$senarai_grading_bil = $this->input->post('input_grading_bil');
				$senarai_hddt_parti = $this->input->post('input_hddt_parti');
				$bil = count($senarai_dm);
				$jumlah_keluar_mengundi = 0;
				$jumlah_pengundi = 0;
				$senarai_bilangan_pengundi = array();
				foreach($senarai_calon as $calon){
					$senarai_bilangan_pengundi[$calon->pencalonan_bil] = 0;
				}
				for($i = 0; $i < $bil; $i++){
					$hddt_bil = $senarai_hddt_bil[$i];
					$hddt_pengundi = $senarai_hddt_pengundi[$i];
					$jumlah_pengundi = $jumlah_pengundi + $hddt_pengundi;
					$hddt_keluar_mengundi = $senarai_hddt_keluar_mengundi[$i];
					$jangkaan_keluar_mengundi = $hddt_keluar_mengundi/100*$hddt_pengundi;
					$jumlah_keluar_mengundi = $jumlah_keluar_mengundi + $jangkaan_keluar_mengundi;
					$hddt_atas_pagar = $senarai_hddt_atas_pagar[$i];
					$ap = $hddt_atas_pagar/100*$jangkaan_keluar_mengundi;
					$jumlah_atas_pagar = $jumlah_atas_pagar + $ap;
					$hddt_dun_bil = $dun_bil;
					$hddt_tarikh = date("Y-m-d H:i:s");
					$hddt_dm_bil = $senarai_dm[$i];
					$hddt_parti = $senarai_hddt_parti[$i];
					$this->harian_model->kemaskini_harian_pdm(
						$hddt_bil, 
						$hddt_pengundi, 
						$hddt_keluar_mengundi, 
						$hddt_atas_pagar, 
						$hddt_dun_bil, 
						$hddt_dm_bil, 
						$hddt_tarikh,
						$hddt_parti
					);
					foreach($senarai_calon as $calon){
						$grad = $senarai_grading[$calon->pencalonan_bil];
						$grading_bil = $senarai_grading_bil[$calon->pencalonan_bil];
						$g = $grad[$i];
						$pencalonan_bil = $calon->pencalonan_bil;
						$peratus = $g;
						$senarai_bilangan_pengundi[$calon->pencalonan_bil] = $senarai_bilangan_pengundi[$calon->pencalonan_bil] + floor(($peratus/100)*$jangkaan_keluar_mengundi);
						$dm_bil = $hddt_dm_bil;
						$g_bil = $grading_bil[$i];
						$this->status_grading_model->kemaskini_grading_pdm_dun($g_bil, $pencalonan_bil, $peratus, $dm_bil);
					}
				}
			}
			//STATUS DUN
			$input_grading_dun = $this->input->post('input_grading_dun');
			$tertinggi = 0;
			$parti_tertinggi = 0;
			if(!empty($input_grading_dun)){
				$tmp_putih = 0;
				$tmp_not_putih = 0;

				foreach($senarai_calon as $calon){
					$pencalonan_bil = $calon->pencalonan_bil;
					$bilangan_pengundi = $senarai_bilangan_pengundi[$calon->pencalonan_bil];
					$parti_pilihan = $this->parti_model->pilihan_parti($calon->pencalonan_parti);
					if(!empty($parti_pilihan)){
						if($tmp_putih <= $bilangan_pengundi){
							$tmp_putih = $bilangan_pengundi;
						}
					}else{
						if($tmp_not_putih <= $bilangan_pengundi){
							$tmp_not_putih = $bilangan_pengundi;
						}
					}
					if($tertinggi <= $bilangan_pengundi){
						$tertinggi = $bilangan_pengundi;
						$parti_tertinggi = $calon->pencalonan_parti;
					}
					$peratus = $bilangan_pengundi / $jumlah_keluar_mengundi * 100;
					$tarikh = date("Y-m-d");
					$grading_dun = $this->status_grading_model->hari_ini_dun_tarikh($pencalonan_bil, $dun_bil, $tarikh);
					if(empty($grading_dun)){
						$this->status_grading_model->tambah_grading_dun($tarikh, $pencalonan_bil, $peratus, $dun_bil);
					}else{
						$bil = $grading_dun->status_grading_bil;
						$this->status_grading_model->kemaskini_grading_dun($bil, $pencalonan_bil, $peratus, $dun_bil);
					}
				}
			}
			//HARIAN DUN
			$bil = $this->input->post('input_harian_bil');
			$majoriti = $tmp_putih - $tmp_not_putih;
			$peratusan = $majoriti/$jumlah_keluar_mengundi*100;
			$grade = $this->grading_status($peratusan);
			$grading = $grade['grade'];
			$tarikh = date("Y-m-d");
			$pengguna_bil = $this->session->userdata('pengguna_bil');
			$waktu = date("Y-m-d H:i:s");
			$ulasan = $this->input->post('input_harian_ulasan');
			$atas_pagar = $jumlah_atas_pagar/$jumlah_keluar_mengundi*100;
			$keluar_mengundi = $jumlah_keluar_mengundi / $jumlah_pengundi * 100;
			$this->harian_model->kemaskini_harian_dun($bil, $grading, $tarikh, $dun_bil, $pengguna_bil, $waktu, $ulasan, $pilihanraya_bil, $atas_pagar, $keluar_mengundi, $parti_tertinggi);
		}	
		if(empty($pilihanraya_bil)){
			redirect(base_url());
		}
		redirect('grading/pilihanraya/'.$pilihanraya_bil, 'refresh');
	}

	public function proses_parlimen(){
		$this->load->model('harian_parlimen_model');
		$this->load->model('pencalonan_parlimen_model');
		$this->load->model('status_grading_model');
		$parlimen_bil = $this->input->post('input_parlimen_bil');
		$pilihanraya_bil = $this->input->post('input_pilihanraya_bil');
		$senarai_calon = $this->pencalonan_parlimen_model->senarai_calon_tanpa_grading($parlimen_bil, $pilihanraya_bil);
		$senarai_dm_keluar_mengundi = array();
		$senarai_dm_keluar_mengundi = $this->input->post('input_dm_keluar_mengundi');
		$senarai_dm_bil = $this->input->post('input_dm_bil');
		$senarai_pengundi = $this->input->post('input_bilangan_pengundi');
		$bilangan_data = $this->input->post('bilangan_data');
		$senarai_daerah_mengundi_bil = $this->input->post('input_daerah_mengundi_bil');
		$senarai_atas_pagar = $this->input->post('input_dm_atas_pagar');
		$senarai_grading_calon = $this->input->post('input_grading');
		$senarai_grading_calon_bil = $this->input->post('input_grading_bil');
		$jumlah_pengundi_calon = $this->input->post('input_jumlah_pengundi_calon');
		$jumlah_atas_pagar = $this->input->post('input_jumlah_atas_pagar');
		$jumlah_jangkaan_keluar_mengundi = $this->input->post('input_jumlah_jangkaan_keluar_mengundi');
		$jumlah_pengundi = $this->input->post('input_jumlah_pengundi');
		$ulasan = $this->input->post('input_ulasan');
		for($i = 0; $i < $bilangan_data; $i++){
			if($senarai_dm_bil[$i] == 'TIADA'){
				$this->harian_parlimen_model->tambah_harian_pdm($senarai_pengundi[$i], $senarai_dm_keluar_mengundi[$i], 100, $parlimen_bil, $senarai_daerah_mengundi_bil[$i], date("Y-m-d H:i:s"));
			}else{
				$this->harian_parlimen_model->kemaskini_harian_pdm($senarai_dm_bil[$i], $senarai_pengundi[$i], $senarai_dm_keluar_mengundi[$i], $senarai_atas_pagar[$i], $parlimen_bil, $senarai_daerah_mengundi_bil[$i], date("Y-m-d H:i:s"));
			}
			foreach($senarai_calon as $calon){
				if($senarai_grading_calon_bil[$calon->pencalonan_parlimen_bil][$i] != 'TIADA'){
					$this->status_grading_model->kemaskini_grading_pdm_parlimen($senarai_grading_calon_bil[$calon->pencalonan_parlimen_bil][$i], $calon->pencalonan_parlimen_bil, $senarai_grading_calon[$calon->pencalonan_parlimen_bil][$i], $senarai_daerah_mengundi_bil[$i]);
				}else{
					$this->status_grading_model->tambah_grading_pdm_parlimen(date("Y-m-d"), $calon->pencalonan_parlimen_bil, $senarai_grading_calon[$calon->pencalonan_parlimen_bil][$i], $senarai_daerah_mengundi_bil[$i]);
				}
			}
		}

		$this->load->model('parti_model');
		$this->load->model('status_grading_model');
		
		$temp_putih = 0;
		$temp_not_putih = 0;
		foreach($senarai_calon as $calon){
			$status = $this->status_grading_model->hari_ini_parlimen_tarikh($calon->pencalonan_parlimen_bil, $parlimen_bil, date("Y-m-d"));
			$peratus = 0;
			if($jumlah_jangkaan_keluar_mengundi > 0){
				$peratus = ($jumlah_pengundi_calon[$calon->pencalonan_parlimen_bil]/$jumlah_jangkaan_keluar_mengundi)*100;
			}
			if(!empty($status)){
				$this->status_grading_model->kemaskini_grading_parlimen($status->sgpt_bil, $calon->pencalonan_parlimen_bil, $peratus, $parlimen_bil);
			}else{
				$this->status_grading_model->tambah_grading_parlimen(date("Y-m-d"), $calon->pencalonan_parlimen_bil, $peratus, $parlimen_bil);
			}
			$parti_putih = $this->parti_model->pilihan_parti($calon->pencalonan_parlimen_partiBil);
			if(!empty($parti_putih)){
				if($jumlah_pengundi_calon[$calon->pencalonan_parlimen_bil] > $temp_putih){
					$temp_putih = $jumlah_pengundi_calon[$calon->pencalonan_parlimen_bil];
				}
			}else{
				if($jumlah_pengundi_calon[$calon->pencalonan_parlimen_bil] > $temp_not_putih){
					$temp_not_putih = $jumlah_pengundi_calon[$calon->pencalonan_parlimen_bil];
				}
			}
		}
		$majoriti = $temp_putih - $temp_not_putih;
		$peratusan = 0;
		if($jumlah_jangkaan_keluar_mengundi > 0){
			$peratusan = ($majoriti / $jumlah_jangkaan_keluar_mengundi) * 100;
		}
		$grading = $this->grading_status($peratusan);
		$harian = $this->harian_parlimen_model->parlimen_harian($parlimen_bil, date("Y-m-d"));
		if(empty($harian)){
			$atas_pagar = 0;
			if($jumlah_jangkaan_keluar_mengundi > 0){
				$atas_pagar = ($jumlah_atas_pagar/$jumlah_jangkaan_keluar_mengundi)*100;
			}
			$this->harian_parlimen_model->tambah_harian_parlimen($grading['grade'], date("Y-m-d"), $parlimen_bil, $this->session->userdata('pengguna_bil'), date("Y-m-d H:i:s"), $ulasan, $pilihanraya_bil, $atas_pagar, ($jumlah_jangkaan_keluar_mengundi/$jumlah_pengundi)*100);
		}else{
			$this->harian_parlimen_model->kemaskini_harian_parlimen($harian->harian_parlimen_bil, $grading['grade'], date('Y-m-d'), $parlimen_bil, $this->session->userdata('pengguna_bil'), date("Y-m-d H:i:s"), $ulasan, $pilihanraya_bil, ($jumlah_atas_pagar/$jumlah_jangkaan_keluar_mengundi)*100, ($jumlah_jangkaan_keluar_mengundi/$jumlah_pengundi)*100);
		}
		redirect('grading/parlimen/'.$parlimen_bil);
	}

	public function padam_bil()
	{
		$this->load->model('harian_parlimen_model');
		$this->harian_parlimen_model->padam();
		redirect('grading/grading_parlimen/'.$this->input->post('input_parlimen_bil'), 'refresh');
	}

	public function negeri(){
		$this->load->model('winnable_candidate_assign_model');
		$this->load->model('pengguna_model');
		$this->load->model('parlimen_model');
		$negeri = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
		$data['negeri'] = $negeri;
		$data['parlimen'] = $this->parlimen_model;
		$this->load->view('susunletak/atas', $data);
		$this->load->view('grading/negeri');
		$this->load->view('susunletak/bawah');
	}

	



}