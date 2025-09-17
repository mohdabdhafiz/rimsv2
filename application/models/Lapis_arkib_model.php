<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lapis_arkib_model extends CI_Model {

    public function senaraiKluster(){
        $this->db->select('kit_bil');
        $query = $this->db->get('kluster_isu_tb');
        return $query->result(); 
    }

    public function senaraiPelapor(){
        $this->db->select('bil');
        $this->db->where('pengguna_status != ', '');
        $query = $this->db->get('pengguna_tb');
        return $query->result();
    }

    public function tahun($tahun, $senaraiNegeri){
        $laporan = array();
        $this->db->select('bil');
        $this->db->where('pengguna_status !=', '');
        $query1 = $this->db->get('pengguna_tb');
        $senaraiPelapor = $query1->result();
        $this->db->select('kit_shortform');
        $query2 = $this->db->get('kluster_isu_tb');
        $senaraiKluster = $query2->result();
        foreach($senaraiPelapor as $pelapor){
            foreach($senaraiKluster as $kluster){
                    $nama_table = $kluster->kit_shortform.'_'.$pelapor->bil.'_'.$tahun;
                    if($this->db->table_exists($nama_table)){
                        $this->db->select('kluster_isu_tb.kit_nama');
                        $this->db->select('kluster_isu_tb.kit_shortform');
                        $this->db->select('pengguna_tb.nama_penuh');
                        $this->db->select('daerah.nama');
                        $this->db->select('parlimen_tb.pt_nama');
                        $this->db->select('dun_tb.dun_nama');
                        if($this->db->field_exists('ringkasan_isu', $nama_table)){
                            $this->db->select($nama_table.'.ringkasan_isu');
                        }else{
                            $this->db->select("'Tidak Berkenaan' AS ringkasan_isu");
                        }
                        $this->db->select($nama_table.'.pengguna_waktu');
                        $this->db->select($nama_table.'.bil');
                        $this->db->select($nama_table.'.pelapor');
                        $this->db->join('daerah', 'daerah.bil = '.$nama_table.".daerah", 'left');
                        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = '.$nama_table.".parlimen", 'left');
                        $this->db->join('dun_tb', 'dun_tb.dun_bil = '.$nama_table.".dun", 'left');
                        $this->db->join('kluster_isu_tb', 'kluster_isu_tb.kit_bil = '.$nama_table.".kluster_bil", 'left');
                        $this->db->join('pengguna_tb', 'pengguna_tb.bil = '.$nama_table.".pelapor", 'left');
                        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
                        if(!empty($senaraiNegeri)){
                            foreach($senaraiNegeri as $negeri){
                                $this->db->where('negeri_tb.nt_bil', $negeri->nt_bil);
                            }
                        }
                        $this->db->where('tapisan', 'Terima');
                        $query = $this->db->get($nama_table);
                        $laporan = array_merge($laporan, $query->result());
                    }
            }
        }
        return $laporan;
    }

    public function cariTahunSebelum(){
        $tahun = date('Y');
        $tahunMula = 2021;
        $tahunTamat = date('Y');
        $this->db->select('bil');
        $this->db->where('pengguna_status !=', '');
        $query1 = $this->db->get('pengguna_tb');
        $this->db->select('kit_shortform');
        $query2 = $this->db->get('kluster_isu_tb');
        foreach($query1->result() as $pelapor){
            foreach($query2->result() as $kluster){
                for($i = $tahunMula; $i <= $tahunTamat; $i++){
                    $nama_table = $kluster->kit_shortform.'_'.$pelapor->bil.'_'.$i;
                    if($this->db->table_exists($nama_table)){
                        $this->db->select('bil');
                        $query = $this->db->get($nama_table);
                        if(!empty($query->row())){
                            if($i < $tahun){
                                $tahun = $i;
                            }
                        }
                    }
                }
            }
        }
        return $tahun;
    }

}
?>