<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utama extends CI_Controller {

	private function bilanganLaporan(){
		 $this->load->model(['pengguna_model', 'program_model', 'komuniti_model', 'peranan_model', 'obp_model', 'lapis_model', 'harian_parlimen_model', 'harian_model', 'pilihanraya_model', 'pencalonan_parlimen_model', 'pencalonan_model', 'parti_model', 'negeri_model', 'daerah_model', 'parlimen_model', 'dun_model', 'kelabmalaysiaku_model']);
		$bilanganLaporan = array();
		$sesi = strtoupper($this->session->userdata('peranan'));
		switch($sesi){
			case 'URUSETIA' :
				$senaraiPeranan = $this->peranan_model->senarai();
				$bilanganLaporan['personel'] = $this->pengguna_model->bilanganLaporan();
				$bilanganLaporan['program'] = $this->program_model->bilanganLaporan();
				$bilanganLaporan['komuniti'] = $this->komuniti_model->bilanganLaporan();
				$bilanganLaporan['obp'] = $this->obp_model->bilanganLaporanUtama($senaraiPeranan);
				$bilanganLaporanHarian = 0;
				$bilanganLaporanHarianParlimen = $this->harian_parlimen_model->bilanganLaporanUtama();
				$bilanganLaporanHarianDun = $this->harian_model->bilanganLaporanUtama();
				$bilanganLaporanHarian = $bilanganLaporanHarianParlimen->bilanganLaporan + $bilanganLaporanHarianDun->bilanganLaporan;
				$bilanganLaporan['harian'] = $bilanganLaporanHarian;
				$bilanganLaporanPilihanraya = $this->pilihanraya_model->bilanganLaporanUtama();
				$bilanganLaporan['pilihanraya'] = $bilanganLaporanPilihanraya->bilanganLaporan;
				$bilanganLaporanPencalonan = 0;
				$bilanganLaporanPencalonanParlimen = $this->pencalonan_parlimen_model->bilanganLaporanUtama();
				$bilanganLaporanPencalonanDun = $this->pencalonan_model->bilanganLaporanUtama();
				$bilanganLaporanPencalonan = $bilanganLaporanPencalonanParlimen->bilanganLaporan + $bilanganLaporanPencalonanDun->bilanganLaporan;
				$bilanganLaporan['pencalonan'] = $bilanganLaporanPencalonan;
				$bilanganLaporan['parti'] = $this->parti_model->bilanganLaporanUtama();
				$bilanganLaporan['negeri'] = $this->negeri_model->bilanganLaporanUtama();
				$bilanganLaporan['daerah'] = $this->daerah_model->bilanganLaporanUtama();
				$bilanganLaporan['parlimen'] = $this->parlimen_model->bilanganLaporanUtama();
				$bilanganLaporan['dun'] = $this->dun_model->bilanganLaporanUtama();
				// TAMBAHKAN BARIS INI untuk mendapatkan bilangan Kelab Malaysiaku
            	$bilanganLaporan['kelabmalaysiaku'] = $this->kelabmalaysiaku_model->bilanganLaporanUtama(); // Anda mungkin perlu cipta fungsi ini dalam model
				break;
			default:
				redirect(base_url());
		}
		return $bilanganLaporan;
	}

	private function binaTable(){
		$models = [
			'komuniti_libaturus_model',
			'program_model',
			'kategori_peranan_model',
			'bencana_model',
			'pengguna_model',
			'japen_model'
		];
		$this->load->model($models);
		$this->komuniti_libaturus_model->update20241130();
		$this->kategori_peranan_model->update20240811();
		$this->bencana_model->update20241128();
		$this->program_model->update20231226();
		$this->pengguna_model->update20250716();
		$this->japen_model->update20240206();
	}

	public function index()
	{	

		// CALIBRATION
		$this->binaTable();

		$this->load->model('program_kandungan_model');
		$this->load->model('program_pengisian_model');
		$this->load->model('program_agensi_model');
		$this->load->model('senarai_kandungan_model');
		$this->load->model('senarai_pengisian_model');
		$this->load->model('senarai_agensi_model');
		$this->load->model('perancangan_program_model');
		$this->load->model('program_model');
		$this->load->model('senarai_penerbitan_model');
		$this->load->model('program_penerbitan_model');
		$this->load->model('kelabmalaysiaku_model');
		$this->load->model('kelabmalaysiaku_ahli_model');
		$this->load->model('program_kelabmalaysiaku_model');
		$this->load->model('japen_model');
		$this->load->model('ppd_model');
		$this->load->model('ketua_unit_model');
		$this->load->model('program_keratan_akhbar_model');
		$this->load->model('program_komuniti_model');
		$this->load->model('program_semakan_model');

		//MULA

		$this->load->model('pilihanraya_model');
		$this->load->model('parti_model');
		$this->load->model('bencana_model');
		$this->load->model('peranan_model');
		$sesi = strtoupper($this->session->userdata('peranan'));
		if(strpos($sesi, "PPD") !== FALSE)
		{
			$sesi = "PPD";
		}
		if(strpos($sesi, "NEGERI") !== FALSE)
		{
			$sesi = "NEGERI";
		}
		if(strpos($sesi, "PERUMUS") !== FALSE){
			$sesi = 'PERUMUS';
		}
		//SET PKPM
		if(strpos($sesi, 'PKPM') !== FALSE){
			$sesi = "PKPM";
		}
		if(strpos($sesi, 'PPN') !== FALSE){
			$sesi = "PPN";
		}
		$this->load->model('pengguna_model');
		$penggunaBil = $this->session->userdata('pengguna_bil');
		$perananBil = $this->session->userdata('peranan_bil');
		$data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
		switch($sesi){
			case 'SKRIN' :
				$this->load->model('program_gambar_model');
				$images = glob("./assets/img/gambarProgram/*.{jpg,png,gif}", GLOB_BRACE);
				$limited_images = array_slice($images, 0, 300);
				$data['senaraiProgram'] = $this->program_gambar_model->senaraiProgramIkutGambar($limited_images);
				$this->load->view('dashboard/landingSlide', $data);
				break;
			case 'TOPPROGRAM' :
				$this->load->model('negeri_model');
				//$data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
				$data['senaraiNegeri'] = $this->negeri_model->senarai();
				$this->load->view('ppkpm_na/utama', $data);
				break;
			case 'KP' :
				$hariIni = date("Y-m-d H:i:s");
				$this->load->model('negeri_model');
				$this->load->model('kluster_isu_model');
				$data['senaraiNegeri'] = $this->negeri_model->senaraiNegeri();
				$data['senaraiPru'] = $this->pilihanraya_model->papar_semua();
				$data['dataKluster'] = $this->kluster_isu_model;
				$this->load->view('kp_na/utama', $data);
				break;
			case 'PPN' :
				$data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
				$this->load->view('ppn_na/utama', $data);
				break;
			case 'PKPM':
				$data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
				$this->load->view('us_program_negeri_na/utama', $data);
				break;
			case 'US_PROGRAM' :
				redirect('program');
				break;
			case 'US_OBP' :
				$this->load->view('us_obp_na/utama', $data);
				break;
			case 'TOPMANAGEMENT'	:	$this->load->model('negeri_model');
										$data['senaraiNegeri'] = $this->negeri_model->senarai();
										$this->load->view('susunletak/atas', $data);
										$this->load->view('top/utama');
										$this->load->view('susunletak/bawah');
										break;							
			case 'PERUMUS'			:	$this->load->view('susunletak/atas');
										$this->load->view('perumus/utama');
										$this->load->view('susunletak/bawah');
										break;
			case 'PEGAWAI LAPANGAN' : 	$data['senarai_pilihanraya'] = $this->pilihanraya_model->papar_semua();
										//$this->load->view('pegawai_lapangan/atas', $data);
										//$this->load->view('pegawai_lapangan/pilih_pilihanraya');
										$this->load->view('pegawai_lapangan/slideshow2');
										//$this->load->view('pegawai_lapangan/bawah');
										break;
			case 'ADMIN'			:	
				$this->load->view('admin_na/utama', $data);
										break;
			case 'DASHBOARD'		:	$pilihanraya_bil = 2;
										$data['pilihanraya_bil'] = $pilihanraya_bil; 
										$this->load->model('pencalonan_model');
										$this->load->model('ahli_model');
										$data['senarai_parti_calon'] = $this->pencalonan_model->kira_calon($pilihanraya_bil);
										$data['kira_parti_calon'] = $this->pencalonan_model;
										$data['ahli'] = $this->ahli_model;
										$data['parti'] = $this->parti_model;
										$data['penjuru'] = $this->pencalonan_model->kira_penjuru($data['pilihanraya_bil']);
										$data['julat_umur'] = $this->pencalonan_model->julat_umur($data['pilihanraya_bil']);
										$data['senarai_calon'] = $this->pencalonan_model->papar_ikut_calon($pilihanraya_bil);
										$this->load->view('dashboard/atas', $data);
										$this->load->view('dashboard/landing', $data);
										$this->load->view('dashboard/bawah');
										break;
			case 'TOPONE'			:	$this->load->model('pilihanraya_model');
				$this->load->model('parlimen_model');
				$this->load->model('dun_model');
				$data['senaraiParlimen'] = $this->parlimen_model->senaraiWakilRakyat();
				$data['senaraiDun'] = $this->dun_model->senaraiWakilRakyat();
										$data['data_pilihanraya'] = $this->pilihanraya_model;
										$this->load->view('susunletak/atas', $data);
										//$this->load->view('topone/nav');
										$this->load->view('topone/senaraiAhli');
										$this->load->view('susunletak/bawah');
										break;
			case 'PPD'				:	

				//CONFIGURATIONS
				$data['konfigurasiGradingLama'] = 'TUTUP';

										$this->load->model('japen_model');
										$this->load->model('pengguna_model');
										$this->load->model('parlimen_model');
										$this->load->model('dun_model');
										$this->load->model('winnable_candidate_parlimen_model');
										$this->load->model('jangka_dun_model');
										$this->load->model('parti_model');
										$this->load->model('pilihanraya_model');
										$this->load->model('pencalonan_parlimen_model');
										$this->load->model('pencalonan_model');
										$this->load->model('daerah_model');
										$this->load->model('pdm_model');	
										$this->load->model('winnable_candidate_parlimen_model');
										$this->load->model('pencalonan_parlimen_model');	
										$data['dataDaerah'] = $this->daerah_model;
										$data['data_pencalonan_dun'] = $this->pencalonan_model;
										$data['data_pencalonan_parlimen'] = $this->pencalonan_parlimen_model;
										$data['data_parti'] = $this->parti_model;
										$data['data_jangkaan_parlimen'] = $this->winnable_candidate_parlimen_model;
										$data['data_jangkaan_dun'] = $this->jangka_dun_model;
										$data['data_dun'] = $this->dun_model;
										$data['data_parlimen'] = $this->parlimen_model;
										$data['senarai_tugas_parlimen'] = $this->japen_model->senarai_tugas_parlimen($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
										$data['senarai_tugas_dun'] = $this->japen_model->senarai_tugas_dun($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
										$data['data_pilihanraya'] = $this->pilihanraya_model;
										$statusPilihanraya = 'AKTIF';
										$data['senaraiDunPilihanraya'] = $this->pilihanraya_model->senaraiDunPilihanraya($statusPilihanraya, $perananBil);
										$data['senaraiParlimenPilihanraya'] = $this->pilihanraya_model->senaraiParlimenPilihanraya($statusPilihanraya, $perananBil);
										$data['senaraiAnggota'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
										$data['organisasi'] = $this->japen_model->organisasi($data['pengguna']->pengguna_peranan_bil);
										$data['ppd'] = $this->ppd_model->ppd($data['pengguna']->pengguna_peranan_bil);
										if($data['pengguna']->pengguna_status == ''){
											$this->load->view('susunletak/atas', $data);
											$this->load->view('ppd/utama');
											$this->load->view('susunletak/bawah');
										}
										if(!empty($data['pengguna']->pengguna_status)){
											$this->load->model('komuniti_model');
											$this->load->model('Kelabmalaysiaku_ahli_model');
											$this->load->model('lapis_model');
											$this->load->model('sentimen_model');
											$this->load->model('obp_model');
											$this->load->model('komuniti_libaturus_model');
											$data['senarai_pru_parlimen'] = $this->pilihanraya_model->senaraiPilihanrayaParlimenPeranan($data['pengguna']->pengguna_peranan_bil);
											$data['senarai_pru_dun'] = $this->pilihanraya_model->senaraiPilihanrayaDunPeranan($data['pengguna']->pengguna_peranan_bil);
											$data['senaraiStatusLaporan'] = $this->program_model->senaraiStatusIndividu($penggunaBil);
											$data['bilanganLaporanSemua'] = $this->program_model->bilanganLaporanSemuaIndividu($penggunaBil);
											$data['bilanganKomuniti'] = $this->komuniti_model->bilanganKomunitiPelapor($penggunaBil);
											$senaraiDaerah = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
											//RIMS@KOMUNITI
											$data['bilanganLibatUrus'] = $this->komuniti_libaturus_model->bilanganLibatUrus($penggunaBil);
											//RIMS@SISMAP
											$data['bilanganDmParlimen'] = $this->pdm_model->bilanganDmParlimen($data['senarai_tugas_parlimen'])->bilanganDm;
											$data['bilanganJangkaanCalonParlimen'] = $this->winnable_candidate_parlimen_model->bilanganJangkaanCalonParlimen($data['senarai_tugas_parlimen'])->bilanganCalon;
											$data['bilanganCalonPru'] = $this->pencalonan_parlimen_model->bilanganCalon($data['senarai_tugas_parlimen'])->bilangan;
											//RIMS@KELABMALAYSIAKU
											$data['bilanganKelab'] = 'BELUM DITETAPKAN';
											$data['bilanganKelab'] = $this->kelabmalaysiaku_model->bilanganKelabPeranan($data['pengguna']->pengguna_peranan_bil)->bilanganKelab;
											$data['bilanganAhli'] = 'BELUM DITETAPKAN';
											$data['bilanganAhli'] = $this->Kelabmalaysiaku_ahli_model->bilanganAhliPeranan($data['pengguna']->pengguna_peranan_bil)->bilanganAhli;
											//RIMS@LAPIS
											$data['bilanganLaporanLapis'] = 'BELUM DITETAPKAN';
											$data['bilanganLaporanLapis'] = $this->lapis_model->bilanganLaporanTahun($penggunaBil, date('Y'));
											//RIMS@LPK
											$data['bilanganLaporanLks'] = 'BELUM DITETAPKAN';
											$data['bilanganPenuhLpk'] = 'BELUM DITETAPKAN';
											$data['bilanganLaporanLks'] = $this->sentimen_model->bilanganLaporanTahun($penggunaBil, date("Y"))->bilanganLaporan;
											$data['bilanganPenuhLpk'] = $this->sentimen_model->bilanganLaporanTahunKeseluruhan($data['pengguna']->pengguna_peranan_bil, date("Y"))->bilanganLaporan;
											//RIMS@OBP
											$data['bilanganObp'] = 'BELUM DITETAPKAN';
											$data['bilanganObp'] = $this->obp_model->bilanganLaporan($data['pengguna']->pengguna_peranan_bil, $senaraiDaerah);
											//RIMS@BENCANA
											$data['bilanganLaporanBencana'] = $this->bencana_model->bilanganLaporanIndividu($penggunaBil)->bilanganLaporan;
											if(empty($data['bilanganLaporanBencana'])){
												$data['bilanganLaporanBencana'] = 'BELUM DITETAPKAN';
											}
											if($data['ppd']->p_anggota == $data['pengguna']->bil){
												$data['bilanganLaporanPengesahanPPD'] = $this->program_model->bilanganLaporanPengesahanPPD($data['pengguna']->pengguna_peranan_bil);
												$data['bilanganLaporanLaksana'] = $this->program_model->bilanganLaporanLaksanaPPD($data['pengguna']->pengguna_peranan_bil);
												$data['bilanganLaporanSemua'] = $this->program_model->bilanganLaporanSemuaPpd($data['pengguna']);
												$data['senaraiStatusLaporan'] = $this->program_model->senaraiStatusPpd($data['pengguna']);
											}
											$data['header'] = 'ppd_na/susunletak/atas';
											$data['navbar'] = 'ppd_na/susunletak/navbar';
											$data['sidebar'] = 'ppd_na/susunletak/sidebar';
											$data['footer'] = 'ppd_na/susunletak/bawah';
											$this->load->view('ppd_na/utama', $data);
										}
										break;
			case 'NEGERI' :
				$data['bilanganJangkaanCalonParlimen'] = 0;
				$data['bilanganJangkaanCalonDun'] = 0;
				$data['bilanganPru'] = 0;
				$this->load->model('pilihanraya_model');
				$this->load->model('jangkaan_calon_model');
				$this->load->model('negeri_model');
				$senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
				$rumusanJangkaanCalon = $this->jangkaan_calon_model->rumusanSatuNegeri($senaraiNegeri);
				if(!empty($rumusanJangkaanCalon)){
					$data['bilanganJangkaanCalonParlimen'] = $rumusanJangkaanCalon->calonBilanganParlimen;
					$data['bilanganJangkaanCalonDun'] = $rumusanJangkaanCalon->calonBilanganDun;
				}
				$bilanganPruDun = $this->pilihanraya_model->senaraiPruDunNegeri($senaraiNegeri);
				if(!empty($bilanganPruDun)){
					$data['bilanganPru'] = $data['bilanganPru'] + count($bilanganPruDun);
				}
				$bilanganPruParlimen = $this->pilihanraya_model->senaraiPruParlimenNegeri($senaraiNegeri);
				if(!empty($bilanganPruParlimen)){
					$data['bilanganPru'] = $data['bilanganPru'] + count($bilanganPruParlimen);
				}
				$this->load->view('negeri_na/utama', $data);
				break;
			case 'NEGERI2'			:					

				//LOAD MODEL
				$this->load->model('parlimen_model'); 
										$this->load->model('winnable_candidate_assign_model');
										$this->load->model('dun_model');
										$this->load->model('pengguna_model');
										$this->load->model('pilihanraya_model');
										$this->load->model('japen_model');
										$this->load->model('negeri_model');
										$this->load->model('peranan_model');

										//LOAD DATA
										$data['data_pengguna'] = $this->pengguna_model;
										$data['data_japen'] = $this->japen_model;
										$data['pru_latest'] = $this->pilihanraya_model->pilihanraya_baru();
										$negeri = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
										$data['negeri_bil'] = $this->negeri_model->negeri_nama($negeri);
										$this->session->set_userdata('negeri', $negeri);
										$data['senarai_parlimen'] = $this->parlimen_model->paparIkutNegeri($negeri);
										$data['senarai_dun'] = $this->dun_model->ikut_negeri($negeri);

										//SISMAP DUN
										$data['senaraiPilihanrayaNegeriDun'] = $this->pilihanraya_model->ikutNegeriDun($perananBil);

										//LOAD VIEW
										$this->load->view('susunletak/atas');
										$this->load->view('negeri/utama', $data);
										$this->load->view('susunletak/bawah');
										break;
			case 'DATA' :
				$this->load->model('pilihanraya_model');
				$data['senaraiPruAktif'] = $this->pilihanraya_model->senaraiPruAktif();

				// Guna corak baharu
				$data['role_view_folder'] = 'us_sismap_na'; // Folder templat untuk peranan DATA
				$data['content_view'] = 'us_sismap_na/utama';
				
				$this->load->view('templates/base_template', $data);
				break;
			case 'LAPIS' :
				// Muatkan model yang diperlukan untuk papan pemuka LAPIS
				$this->load->model(['kluster_isu_model', 'pengguna_model', 'sentimen_model', 'lapis_reject_model', 'japen_model']);
				
				// Dapatkan data untuk dipaparkan pada kad statistik dan widget
				$data['senarai_kluster'] = $this->kluster_isu_model->senarai_penuh();
				$data['bilangan_pelapor'] = is_array($this->pengguna_model->senarai_penuh_pelapor()) ? count($this->pengguna_model->senarai_penuh_pelapor()) : 0;
				$data['senaraiSentimenTerkini'] = $this->sentimen_model->laporan_terkini(5); // Ambil 5 laporan terkini
				$data['bilanganLaporanTolak'] = $this->lapis_reject_model->bilanganLaporanDiTolak();

				// KEMAS KINI: Panggil data PPD tanpa had
    			$data['rumusanPpd'] = $this->japen_model->rumusan_pelapor_ppd_teratas(); // Had 5 telah dibuang

				// TAMBAHAN BAHARU: Dapatkan jumlah keseluruhan pelapor PPD
    			$data['jumlahPelaporPpd'] = $this->pengguna_model->jumlah_pelapor_ppd();

				// TAMBAHAN BAHARU: Panggil data untuk laporan harian per kluster
    			$data['laporanHarianKluster'] = $this->kluster_isu_model->bilangan_laporan_harian_per_kluster();

				// Guna corak templat universal
				$data['page_title'] = 'Papan Pemuka LAPIS';
				$data['role_view_folder'] = 'us_lapis_na'; // Berdasarkan struktur fail asal anda
				$data['content_view'] = 'lapis/dashboard'; // Fail paparan baharu yang akan kita cipta
				
				$this->load->view('templates/base_template', $data);
				break;
			case 'URUSETIA': 
				$data['bilanganLaporan'] = $this->bilanganLaporan();

				// 1. Tetapkan folder templat untuk peranan ini
				$data['role_view_folder'] = 'urusetia_na'; 
				
				// 2. Tetapkan fail kandungan yang ingin dipaparkan
				$data['content_view'] = 'urusetia/dashboard';
				
				// 3. Muatkan templat induk universal (ia akan uruskan yang lain)
				$this->load->view('templates/base_template', $data);
				break;
			default 				: 	
				$this->load->view('login/login.php');
										
		}
		
	}
}
