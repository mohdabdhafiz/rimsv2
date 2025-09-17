<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perancangan_program_model extends CI_Model {

    private $tableName = 'perancangan_program';

    public function senaraiGSPI(){
        // $this->db->where('nama', 'Taklimat Isu Semasa (HQ)');
        // $this->db->where('nama', 'Taklimat Isu Semasa (Daerah)');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function update20240109(){
        $this->binaTable();
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableName) == FALSE)
        {
            $fields = array(
                'bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'negeri' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'daerah' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'parlimen' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'dun' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'nama' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'tarikh' => array(
                    'type' => 'date',
                    'null' => TRUE
                ),
                'lokasi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'perasmi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'kaedah' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'peserta' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'urusetia' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('bil', TRUE);
            $this->dbforge->create_table($this->tableName);
        }
    }

}
?>