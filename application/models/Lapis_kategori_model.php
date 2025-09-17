<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lapis_kategori_model extends CI_Model {

    public function kemaskiniSenarai(){
        $data = array(
            'deskripsi' => $this->input->post('inputDeskripsi'),
            'tapisan' => $this->input->post('inputTapisan')
        );
        $this->db->where("bil", $this->input->post("inputBil"));
        return $this->db->update("lapis_kategori_tb", $data);
    }

    public function kategori($kategoriBil){
        $this->db->join('kluster_isu_tb', 'kluster_isu_tb.kit_bil = lapis_kategori_tb.klusterBil', 'left');
        $this->db->where('bil', $kategoriBil);
        $query = $this->db->get('lapis_kategori_tb');
        return $query->row();
    }

    public function senaraiIkutKlusterBorang($klusterBil){
        $this->db->where('klusterBil', $klusterBil);
        $this->db->where('tapisan', 'Aktif');
        $query = $this->db->get('lapis_kategori_tb');
        return $query->result();
    }

    public function senaraiIkutKluster($klusterBil){
        $this->db->where('klusterBil', $klusterBil);
        $query = $this->db->get('lapis_kategori_tb');
        return $query->result();
    }

    public function semakanNama($nama, $klusterBil){
        $this->db->where('nama', $nama);
        $this->db->where('klusterBil', $klusterBil);
        $query = $this->db->get('lapis_kategori_tb');
        return $query->result();
    }

    public function tambahPost(){
        $data = array(
            'klusterBil' => $this->input->post('inputKlusterBil'),
            'nama' => $this->input->post('inputNama'),
            'deskripsi' => $this->input->post('inputDeskripsi'),
            'tapisan' => $this->input->post('inputTapisan'),
            'penggunaBil' => $this->input->post('inputPenggunaBil'),
            'penggunaWaktu' => $this->input->post('inputPenggunaWaktu')
        );
        return $this->db->insert('lapis_kategori_tb', $data); 
    }

    public function senarai(){
        $query = $this->db->get('lapis_kategori_tb');
        return $query->result();
    }

    //NEW UPDATES
    public function update20231029(){
        $this->binaTable();
    }

    private function binaTable()
    {   
        $this->load->dbforge();
        $namaTable = 'lapis_kategori_tb';
        if($this->db->table_exists($namaTable) == FALSE){
            $fields = array(
                'bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'klusterBil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'nama' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => TRUE
                ),
                'deskripsi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'tapisan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                    'null' => TRUE
                ),
                'penggunaBil' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'null' => TRUE
                ),
                'penggunaWaktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('bil', TRUE);
            $this->dbforge->create_table($namaTable, TRUE);
        }
    }

}