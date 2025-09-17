<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_model extends CI_Model {

    protected $table = 'jenis_tb';

    public function semuaAktif()
    {
      $this->checkTableExists($this->table);
      $this->db->where('jt_aktif', 'Aktif');
      $this->db->order_by('jt_nama', 'ASC');
      $query=$this->db->get($this->table);
      return $query->result();
    }

    public function padam($jenisBil){
      $this->db->where('jt_bil', $jenisBil);
      return $this->db->delete($this->table);
    }

    public function kemaskiniPost(){
      $data = array(
        'jt_nama' => $this->input->post('inputNama'),
        'jt_peruntukan' => $this->input->post('inputPeruntukan'),
        'jt_aktif' => $this->input->post('inputAktif')
      );
      $this->db->where('jt_bil', $this->input->post('inputBil'));
      return $this->db->update($this->table, $data);
    }

    public function senarai(){
      $this->db->order_by('jt_nama', 'ASC');
      $query = $this->db->get($this->table);
      return $query->result();
    }

    private function checkTableExists($checkTable)
    {
        $this->load->dbforge();
        if($this->db->table_exists($checkTable) == FALSE){
            $fields = array(
                'jt_bil' => array(
                        'type' => 'BIGINT',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'jt_nama' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'jt_peruntukan' => array(
                  'type' => 'VARCHAR',
                  'constraint' => '200',
                  'null' => TRUE
                ),
                'jt_aktif' => array(
                  'type' => 'VARCHAR',
                  'constraint' => '200',
                  'null' => TRUE
                ),
                'jt_pengguna' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'jt_tarikhMasa' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('jt_bil', TRUE);
            $this->dbforge->create_table($this->table, TRUE);
        }
        if($this->db->table_exists($this->table)){
          if(!$this->db->field_exists('jt_aktif', $this->table)){
            $field = array(
                'jt_aktif' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_column($this->table, $field);
          }
          if(!$this->db->field_exists('jt_pengguna', $this->table)){
            $field = array(
                'jt_pengguna' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_column($this->table, $field);
          }
        }
    }

    public function semua()
    {
      $this->checkTableExists($this->table);
      $this->db->select("*");
      $this->db->select("(
        SELECT COUNT(*)
        FROM program
        WHERE jt_bil = program_jenis_program
      ) AS programBilangan");
      $this->db->order_by('jt_nama', 'ASC');
      $query=$this->db->get($this->table);
      return $query->result();
    }

    public function tambah()
    {
      $this->checkTableExists($this->table);
      $data = array(
        "jt_nama" => $this->input->post('inputJenis'),
        'jt_peruntukan' => $this->input->post('inputPeruntukan'),
        'jt_aktif' => 'Aktif',
        'jt_pengguna' => $this->session->userdata('pengguna_bil'),
        "jt_tarikhMasa" => date("Y-m-d H:i:s")
      );
      $this->db->insert($this->table, $data);
    }

    public function jenis($jenisBil)
    {
      $this->checkTableExists($this->table);
      $this->db->where('jt_bil', $jenisBil);
      $query=$this->db->get($this->table);
      return $query->row();
    }

  }
