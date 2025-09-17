<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_pengisian_model extends CI_Model {

    private $tableName = 'pengisian_program';

    public function update20240118(){
        $this->binaTable();
    }

    //4. VIEW

    public function ada($pengisian, $programBil){
        $this->db->where('pengisian_program_program', $programBil);
        $this->db->where('pengisian_program_pengisian', $pengisian);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

        //4.1 VIEW MANY
        public function senaraipengisian($programBil){
            $select = [
                "*",
                "UPPER(pengisian_program.pengisian_program_pengisian) AS aktivitiNama"
            ];
            $this->db->select($select);
            $this->db->where('pengisian_program.pengisian_program_program', $programBil);
            $this->db->order_by('pengisian_program.pengisian_program_pengguna_waktu', 'DESC');
            $query = $this->db->get($this->tableName);
            return $query->result();
        }
    //5. ADD
        //5.1 ADD NEW URL USING POST
        public function tambahpengisianPost(){
            //5.1.1 COLLECT DATA
            $data = array(
                'pengisian_program_program' => $this->input->post('inputProgram'),
                'pengisian_program_pengisian' => $this->input->post('inputpengisian'),
                'pengisian_program_pengguna' => $this->input->post('inputPenggunaBil'),
                'pengisian_program_pengguna_waktu' => date("Y-m-d H:i:s")
            );
            //5.1.2 STORE DATA
            return $this->db->insert($this->tableName, $data);
        }
    //6. EDIT
        //6.1 EDIT URL USING POST
        public function kemaskiniPautan(){
            $data = array(
                'pautan_program_pautan' => $this->input->post('inputPautan'),
                'pautan_program_pengguna' => $this->input->post('inputPenggunaBil'),
                'pautan_program_pengguna_waktu' => date('Y-m-d H:i:s')
            );
            $this->db->where('pautan_program_program', $this->input->post('inputProgramBil'));
            $this->db->where('pautan_program_bil', $this->input->post('inputPautanBil'));
            $this->db->update($this->tableName, $data);
        }
    //7. DELETE

    public function padamPost(){
        $this->db->where('pengisian_program_program', $this->input->post('inputProgramBil'));
        $this->db->delete($this->tableName);
    }

    public function padampengisianProgram($pengisianBil){
        $this->db->where('pengisian_program_bil', $pengisianBil);
        return $this->db->delete($this->tableName);
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableName) == FALSE)
        {
            $fields = array(
                'pengisian_program_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'pengisian_program_program' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE
                ),
                'pengisian_program_pengisian' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'pengisian_program_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'pengisian_program_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('pengisian_program_bil', TRUE);
            $this->dbforge->create_table($this->tableName);
        }
    }

}

?>