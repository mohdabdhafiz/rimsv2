<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Senarai_pengisian_model extends CI_Model {

    private $tableName = 'senarai_pengisian';

    public function kemaskiniPost(){
        $data = array(
            'senarai_pengisian_pengisian' => $this->input->post('inputpengisian')
        );
        $this->db->where('senarai_pengisian_bil', $this->input->post('inputBil'));
        return $this->db->update($this->tableName, $data);
    }

    public function pengisian($bil){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = senarai_pengisian.senarai_pengisian_pengguna', 'left');
        $this->db->where('senarai_pengisian_bil', $bil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function padam(){
        $this->db->where('senarai_pengisian_bil', $this->input->post('inputBil'));
        return $this->db->delete($this->tableName);
    }

    public function ikutTajuk($tajuk){
        $this->db->where('senarai_pengisian_pengisian', $tajuk);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function tambah(){
        $data = array(
            'senarai_pengisian_pengisian' => $this->input->post('inputpengisian'),
            'senarai_pengisian_pengguna' => $this->input->post('inputPengguna'),
            'senarai_pengisian_pengguna_waktu' => date('Y-m-d H:i:s')
        );
        $this->db->insert($this->tableName, $data);
    }

    public function senarai(){
        $this->db->order_by('senarai_pengisian_pengisian', 'ASC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function update20240118(){
        $this->binaTable();
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableName) == FALSE)
        {
            $fields = array(
                'senarai_pengisian_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'senarai_pengisian_pengisian' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'senarai_pengisian_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'senarai_pengisian_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('senarai_pengisian_bil', TRUE);
            $this->dbforge->create_table($this->tableName);
        }
    }

}
