<?php
class Data_model extends CI_Model {

    public function hasilKeputusanNaratifProgram($senaraiProgram, $senaraiNegeri, $tarikhMula = NULL, $tarikhTamat = NULL){
        $this->db->select("program.program_jenis_program AS jenisBil");
        $this->db->select("kandungan_program_kandungan AS naratifNama");
        $this->db->select("COUNT(program.program_jenis_program) AS programBilangan");
        $this->db->join("program", "program.program_bil = kandungan_program.kandungan_program_program", "left");
        $this->db->group_start();
        foreach($senaraiProgram as $program){
            $this->db->or_where("program.program_jenis_program", $program->jenisBil);
        }
        $this->db->group_end();
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where("program.program_negeri", $negeri->negeriBil);
        }
        $this->db->group_end();
        if(!empty($tarikhMula)){
            $this->db->where('DATE(program.program_tarikh_masa) >= ', $tarikhMula);
        }
        if(!empty($tarikhTamat)){
            $this->db->where('DATE(program.program_tarikh_masa) <= ', $tarikhTamat);
        }
        $this->db->where('UPPER(program.program_status)', "SELESAI");
        $this->db->group_by("kandungan_program_kandungan");
        $this->db->order_by("programBilangan", "DESC");
        $query = $this->db->get("kandungan_program");
        return $query->result();
    }

}
?>