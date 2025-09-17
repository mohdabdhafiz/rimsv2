<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_agensi_model extends CI_Model {

    private $tableName = 'agensi_program';

    public function update20240120(){
        $this->binaTable();
    }

    //4. VIEW

    public function ada($agensi, $programBil){
        $this->db->where('agensi_program_program', $programBil);
        $this->db->where('agensi_program_agensi', $agensi);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

        //4.1 VIEW MANY
        public function senaraiagensi($programBil){
            $this->db->where('agensi_program_program', $programBil);
            $this->db->order_by('agensi_program_pengguna_waktu', 'DESC');
            $query = $this->db->get($this->tableName);
            return $query->result();
        }
    //5. ADD
        //5.1 ADD NEW URL USING POST
        public function tambahagensiPost(){
            //5.1.1 COLLECT DATA
            $data = array(
                'agensi_program_program' => $this->input->post('inputProgram'),
                'agensi_program_agensi' => $this->input->post('inputagensi'),
                'agensi_program_pengguna' => $this->input->post('inputPenggunaBil'),
                'agensi_program_pengguna_waktu' => date("Y-m-d H:i:s")
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
        $this->db->where('agensi_program_program', $this->input->post('inputProgramBil'));
        $this->db->delete($this->tableName);
    }

    public function padamagensiProgram($agensiBil){
        $this->db->where('agensi_program_bil', $agensiBil);
        return $this->db->delete($this->tableName);
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableName) == FALSE)
        {
            $fields = array(
                'agensi_program_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'agensi_program_program' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE
                ),
                'agensi_program_agensi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'agensi_program_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'agensi_program_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('agensi_program_bil', TRUE);
            $this->dbforge->create_table($this->tableName);
        }
    }

}

?>