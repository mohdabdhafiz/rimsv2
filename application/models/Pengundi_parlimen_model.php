<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengundi_parlimen_model extends CI_Model {

    protected $table = 'pengundi_parlimen_tb';

    private function checkTableExists($checkTable)
    {   
        $this->load->dbforge();
        if($this->db->table_exists($checkTable) == FALSE){
            $fields = array(
                'ppt_bil' => array(
                        'type' => 'BIGINT',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'ppt_parlimen_nama' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'ppt_parlimen_negeri' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'ppt_pengguna' => array(
                        'type' => 'BIGINT',
                        'null' => TRUE
                ),
                'ppt_parlimen_bil' => array(
                        'type' => 'BIGINT',
                        'null' => TRUE
                ),
                'ppt_pilihanraya_bil' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'ppt_jumlah_pengundi' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'ppt_nama_pengguna' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
                ),
                'ppt_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('ppt_bil', TRUE);
            $this->dbforge->create_table($this->table, TRUE);
        }
    }

    public function daftar()
    {
        $this->checkTableExists($this->table);
        $data = array(
            'ppt_parlimen_nama' => $this->input->post('inputParlimenNama'),
            'ppt_parlimen_negeri' => $this->input->post('inputParlimenNegeri'),
            'ppt_waktu' => date ('Y-m-d H:i:s'),
            'ppt_pengguna' => $this->input->post('inputPenggunaBil'),
            'ppt_nama_pengguna' => $this->input->post('inputNamaPengguna'),
            'ppt_parlimen_bil' => $this->input->post('inputParlimenBil'),
            'ppt_jumlah_pengundi' => $this->input->post('inputJumlahPengundi')         
        );
        $return_data['insert_data'] = $this->db->insert($this->table, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    public function jumlahPengundi($parlimenID, $pilihanrayaID)
    {
        $this->checkTableExists($this->table);
        $this->db->where('ppt_parlimen_bil', $parlimenID);
        $this->db->where('ppt_pilihanraya_bil', $pilihanrayaID);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function jumlah_pengundi($parlimen_bil)
    {
        $this->db->where('ppt_parlimen_bil', $parlimen_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function pengundi($parlimen_bil, $pilihanraya_bil){
        $this->db->where('ppt_parlimen_bil', $parlimen_bil);
        $this->db->where('ppt_pilihanraya_bil', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function setJumlahPengundi()
    {
        $data = array('ppt_jumlah_pengundi' => $this->input->post('inputJumlahPengundi'));
        $this->db->where('ppt_bil', $this->input->post('inputJumlahPengundiBil'));
        $this->db->update($this->table, $data);
    }

    public function setJumlahPengundiPilihanraya()
    {
        $data = array(
            'ppt_jumlah_pengundi' => $this->input->post('inputJumlahPengundi'),
            'ppt_pilihanraya_bil' => $this->input->post('input_pilihanraya_bil'),
            'ppt_parlimen_bil' => $this->input->post('input_parlimen_bil')
        );
        $this->db->where('ppt_bil', $this->input->post('inputJumlahPengundiBil'));
        $this->db->update($this->table, $data);
    }
}