<?php
class Lapis_model extends CI_Model
{

    public function senaraiKluster(){
        $query = $this->db->get('kluster_isu_tb');
        return $query->result();
    }
    

    public function bilanganLaporanTahun($pelaporBil, $tahun){
        $bilanganLaporan = 0;
        $senaraiKluster = $this->senaraiKluster();
        foreach($senaraiKluster as $kluster){
            $nama_table = $kluster->kit_shortform.'_'.$pelaporBil.'_'.$tahun;
            if($this->db->table_exists($nama_table)){
                $this->db->select('COUNT(*) AS bilanganLaporan');
                $query = $this->db->get($nama_table);
                $bilanganLaporan = $bilanganLaporan + $query->row()->bilanganLaporan;
            }
        }
        return $bilanganLaporan;
    }

}