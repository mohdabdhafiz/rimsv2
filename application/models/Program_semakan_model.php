<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_semakan_model extends CI_Model {

    protected $tableName = 'program_semakan';

    public function tukarFalse($semakanBil, $penggunaBil){
        $data = array(
            'ps_isi' => FALSE,
            'ps_pengguna' => $penggunaBil,
            'ps_pengguna_waktu' => date('Y-m-d H:i:s')
        );
        $this->db->where('ps_bil', $semakanBil);
        $this->db->update($this->tableName, $data);
    }

    public function selesai($semakanBil, $tajuk, $penggunaBil){
        $data = array(
            'ps_tajuk' => $tajuk,
            'ps_isi' => TRUE,
            'ps_pengguna' => $penggunaBil,
            'ps_pengguna_waktu' => date('Y-m-d H:i:s')
        );
        $this->db->where('ps_bil', $semakanBil);
        $this->db->update($this->tableName, $data);
    }

    public function tambah($programBil, $tajuk, $penggunaBil){
        $data = array(
            'ps_program' => $programBil,
            'ps_tajuk' => $tajuk,
            'ps_isi' => TRUE,
            'ps_pengguna' => $penggunaBil,
            'ps_pengguna_waktu' => date('Y-m-d H:i:s')
        );
        $this->db->insert($this->tableName, $data);
    }

    public function semakan($programBil, $tajuk){
        $this->db->where('program_semakan.ps_program', $programBil);
        $this->db->where('program_semakan.ps_tajuk', $tajuk);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function semakanLaporan($programBil){
        $this->db->where('program_semakan.ps_program', $programBil);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function update20240226(){
        $this->binaTable();
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableName) == FALSE)
        {
            $fields = array(
                'ps_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'ps_program' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE
                ),
                'ps_tajuk' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'ps_isi' => array(
                    'type' => 'BOOLEAN',
                    'null' => TRUE
                ),
                'ps_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE
                ),
                'ps_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('ps_bil', TRUE);
            $this->dbforge->create_table($this->tableName);
        }
    }

}

?>