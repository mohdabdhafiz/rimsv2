<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Senarai_kandungan_model extends CI_Model {

    private $tableName = 'senarai_kandungan';

    public function kemaskiniPost(){
        $data = array(
            'senarai_kandungan_kandungan' => $this->input->post('inputKandungan')
        );
        $this->db->where('senarai_kandungan_bil', $this->input->post('inputBil'));
        return $this->db->update($this->tableName, $data);
    }

    public function kandungan($bil){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = senarai_kandungan.senarai_kandungan_pengguna', 'left');
        $this->db->where('senarai_kandungan_bil', $bil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function padam(){
        $this->db->where('senarai_kandungan_bil', $this->input->post('inputBil'));
        return $this->db->delete($this->tableName);
    }

    public function ikutTajuk($tajuk){
        $this->db->where('senarai_kandungan_kandungan', $tajuk);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function tambah(){
        $data = array(
            'senarai_kandungan_kandungan' => $this->input->post('inputKandungan'),
            'senarai_kandungan_pengguna' => $this->input->post('inputPengguna'),
            'senarai_kandungan_pengguna_waktu' => date('Y-m-d H:i:s')
        );
        $this->db->insert($this->tableName, $data);
    }

    public function senarai(){
        $this->db->order_by('senarai_kandungan_kandungan', 'ASC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function update20240108(){
        $this->binaTable();
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableName) == FALSE)
        {
            $fields = array(
                'senarai_kandungan_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'senarai_kandungan_kandungan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'senarai_kandungan_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'senarai_kandungan_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('senarai_kandungan_bil', TRUE);
            $this->dbforge->create_table($this->tableName);
        }
    }

}
