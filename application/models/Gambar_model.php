<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gambar_model extends CI_Model {

    protected $table = 'gambar_tb';

    private function checkTableExists($checkTable)
    {
        $this->load->dbforge();
        if($this->db->table_exists($checkTable) == FALSE){
            $fields = array(
                'gt_bil' => array(
                        'type' => 'BIGINT',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'gt_nama' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'gt_bilProgram' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'gt_tarikhMasa' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('gt_bil', TRUE);
            $this->dbforge->create_table($this->table, TRUE);
        }
    }

    public function tambahGambar($namaFail, $bil)
    {
      $this->checkTableExists($this->table);
      $data = array(
        "gt_nama" => $namaFail,
        "gt_bilProgram" => $bil,
        "gt_tarikhMasa" => date("Y-m-d H:i:s")
      );
      $this->db->insert($this->table, $data);
    }

    public function senaraiGambar($bil)
    {
      $this->checkTableExists($this->table);
      $this->db->where('gt_bilProgram', $bil);
      $query = $this->db->get($this->table);
      return $query->result();
    }

    public function satuGambar($programBil)
    {
      $this->checkTableExists($this->table);
      $this->db->where('gt_bilProgram', $programBil);
      $query = $this->db->get($this->table);
      return $query->row();
    }

    public function gambar($bil)
    {
      $this->checkTableExists($this->table);
      $this->db->where('gt_bil', $bil);
      $query = $this->db->get($this->table);
      return $query->row();
    }

    public function padam($gambarBil)
    {
      $this->checkTableExists($this->table);
      $this->db->where('gt_bil', $gambarBil);
      $this->db->delete($this->table);
    }

    public function semua()
    {
      $this->checkTableExists($this->table);
      $this->db->order_by('gt_tarikhMasa', 'DESC');
      $query = $this->db->get($this->table);
      return $query->result();
    }

}
