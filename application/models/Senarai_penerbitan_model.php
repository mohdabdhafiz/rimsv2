<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Senarai_penerbitan_model extends CI_Model {

    private $tableName = 'senarai_penerbitan';

    public function kemaskiniPost(){
        $data = array(
            'senarai_penerbitan_penerbitan' => $this->input->post('inputpenerbitan')
        );
        $this->db->where('senarai_penerbitan_bil', $this->input->post('inputBil'));
        return $this->db->update($this->tableName, $data);
    }

    public function penerbitan($bil){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = senarai_penerbitan.senarai_penerbitan_pengguna', 'left');
        $this->db->where('senarai_penerbitan_bil', $bil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function padam(){
        $this->db->where('senarai_penerbitan_bil', $this->input->post('inputBil'));
        return $this->db->delete($this->tableName);
    }

    public function ikutTajuk($tajuk){
        $this->db->where('senarai_penerbitan_penerbitan', $tajuk);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function tambah(){
        $data = array(
            'senarai_penerbitan_penerbitan' => $this->input->post('inputpenerbitan'),
            'senarai_penerbitan_pengguna' => $this->input->post('inputPengguna'),
            'senarai_penerbitan_pengguna_waktu' => date('Y-m-d H:i:s')
        );
        $this->db->insert($this->tableName, $data);
    }

    public function senarai(){
        $this->db->order_by('senarai_penerbitan_penerbitan', 'ASC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function update20240120(){
        $this->binaTable();
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableName) == FALSE)
        {
            $fields = array(
                'senarai_penerbitan_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'senarai_penerbitan_penerbitan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'senarai_penerbitan_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'senarai_penerbitan_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('senarai_penerbitan_bil', TRUE);
            $this->dbforge->create_table($this->tableName);
        }
    }

}
