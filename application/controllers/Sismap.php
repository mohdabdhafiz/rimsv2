<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sismap extends CI_Controller {

    /**
     * Fungsi ini khusus untuk mendapatkan bilangan data berkaitan SISMAP.
     * Ia akan dipanggil oleh fungsi index() untuk dihantar ke paparan.
     */
    private function bilanganSismap(){
        // Muatkan semua model yang berkaitan dengan SISMAP
        $this->load->model([
            'harian_parlimen_model', 
            'harian_model', 
            'pilihanraya_model', 
            'pencalonan_parlimen_model', 
            'pencalonan_model', 
            'parti_model'
        ]);

        $bilangan = array();

        // 1. Kira Laporan Harian (Etnografi)
        $bilanganLaporanHarianParlimen = $this->harian_parlimen_model->bilanganLaporanUtama();
        $bilanganLaporanHarianDun = $this->harian_model->bilanganLaporanUtama();
        $bilangan['harian'] = ($bilanganLaporanHarianParlimen->bilanganLaporan ?? 0) + ($bilanganLaporanHarianDun->bilanganLaporan ?? 0);

        // 2. Kira Rekod Pilihan Raya
        $bilanganPilihanraya = $this->pilihanraya_model->bilanganLaporanUtama();
        $bilangan['pilihanraya'] = $bilanganPilihanraya->bilanganLaporan ?? 0;

        // 3. Kira Data Pencalonan
        $bilanganPencalonanParlimen = $this->pencalonan_parlimen_model->bilanganLaporanUtama();
        $bilanganPencalonanDun = $this->pencalonan_model->bilanganLaporanUtama();
        $bilangan['pencalonan'] = ($bilanganPencalonanParlimen->bilanganLaporan ?? 0) + ($bilanganPencalonanDun->bilanganLaporan ?? 0);

        // 4. Kira Parti Politik
        $bilangan['parti'] = $this->parti_model->bilanganLaporanUtama();

        return $bilangan;
    }

    public function index()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        // Pastikan hanya peranan yang dibenarkan boleh akses
        if($sesi == 'URUSETIA' || $sesi == 'ADMIN'){ // Anda boleh tambah peranan lain jika perlu

            $data['bilanganSismap'] = $this->bilanganSismap();

            $this->load->view('susunletak/atas', $data);
            
            // LALUAN PAPARAN TELAH DIKEMAS KINI DI SINI
            $this->load->view('sismap/utama', $data); 
            
            $this->load->view('susunletak/bawah');
        
        } else {
            redirect(base_url());
        }
    }

}