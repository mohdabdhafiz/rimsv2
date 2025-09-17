<?php 
class Program_keratan_akhbar_model extends CI_Model {

    private $tableName = 'keratan_akhbar_program';

    public function padamKeratanAkhbar($keratanAkhbarBil){
        $this->db->where('keratan_akhbar_program_bil', $keratanAkhbarBil);
        $this->db->delete($this->tableName);
    }

    public function keratanAkhbar($keratanAkhbarBil){
        if($this->db->table_exists($this->tableName) == TRUE){
            $this->db->where('keratan_akhbar_program_bil', $keratanAkhbarBil);
            $query = $this->db->get($this->tableName);
            return $query->row();
        }
    }

    public function kemaskiniNamaFail($fileName, $keratanAkhbarBil){
        $data = array('keratan_akhbar_program_nama_fail' => $fileName);
        $this->db->where('keratan_akhbar_program_bil', $keratanAkhbarBil);
        $this->db->update($this->tableName, $data);
    }

    public function update20240220(){
        $this->binaTable();
    }

    private function binaTable()
    {
        //LOAD LIBRARIES
        $this->load->dbforge();

        if($this->db->table_exists($this->tableName) == FALSE)
        {
            $fields = array(
                'keratan_akhbar_program_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'keratan_akhbar_program_nama_fail' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
                ),
                'keratan_akhbar_program_program' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'keratan_akhbar_program_deskripsi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'keratan_akhbar_program_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'keratan_akhbar_program_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('keratan_akhbar_program_bil', TRUE);
            $this->dbforge->create_table($this->tableName);
        }
    }

    public function tambah(){
        $data = array(
            'keratan_akhbar_program_nama_fail' => $this->input->post('inputNamaFail'),
            'keratan_akhbar_program_program' => $this->input->post('inputProgramBil'),
            'keratan_akhbar_program_deskripsi' => $this->input->post('inputDeskripsi'), 
            'keratan_akhbar_program_pengguna' => $this->input->post('inputPenggunaBil'),
            'keratan_akhbar_program_pengguna_waktu' => date("Y-m-d H:i:s")
        );
        $return_data['insert_data'] = $this->db->insert($this->tableName, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    public function senaraiKeratanAkhbarIkutProgram($programBil){
        if($this->db->table_exists($this->tableName) == TRUE){
            $this->db->where('keratan_akhbar_program_program', $programBil);
            $query = $this->db->get($this->tableName);
            return $query->result();
        }
    }

}
?>