<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komuniti_ahli_model extends CI_Model {

    private $tableName = 'komuniti_ahli';

    public function tambahAhliPost(){
        $data = array(
            'ka_nama' => $this->input->post('inputNama'),
            'ka_jawatan' => $this->input->post('inputJawatan'),
            'ka_alamat' => $this->input->post('inputAlamat'),
            'ka_no_telefon' => $this->input->post('inputTelefon'),
            'ka_emel' => $this->input->post('inputEmel'),
            'ka_umur' => $this->input->post('inputUmur'),
            'ka_jantina' => $this->input->post('inputJantina'),
            'ka_kaum' => $this->input->post('inputKaum'),
            'ka_komuniti' => $this->input->post('inputKomuniti'),
            'ka_pendaftaran' => date('Y-m-d'),
            'ka_pengguna' => $this->input->post('inputPengguna'),
            'ka_pengguna_waktu' => date("Y-m-d H:i:s")
        );
        $return_data['insert_data'] = $this->db->insert($this->tableName, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    public function senarai($komunitiBil){
        $this->db->order_by('ka_nama', 'ASC');
        $this->db->where('ka_komuniti', $komunitiBil);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function update20231223(){
        $this->binaTable();
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableName) == FALSE){
            $fields = array(
                'ka_bil' => array(
                    'type' => 'BIGINT',
                    'null'=> FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
            ),
            'ka_nama' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
            ),
            'ka_jawatan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
            ),
            'ka_alamat' => array(
                    'type' => 'TEXT'
            ),
            'ka_no_telefon' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
            ),
            'ka_emel' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
            ),
            'ka_umur' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
            ),
            'ka_jantina' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
            ),
            'ka_kaum' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
            ),
            'ka_komuniti' => array(
              'type' => 'BIGINT',
              'null' => TRUE
            ),
            'ka_pendaftaran' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'ka_pengguna' => array(
              'type' => 'BIGINT',
              'null' => TRUE
            ),
            'ka_pengguna_waktu' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('ka_bil', TRUE);
            $this->dbforge->create_table($this->tableName, TRUE);
        }
    }
}
?>