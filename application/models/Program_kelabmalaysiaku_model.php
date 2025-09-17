<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_kelabmalaysiaku_model extends CI_Model {

    private $tableName = 'kelabmalaysiaku_program';
    private $tableNameTambahan = 'maklumat_tambahan_program_kelabmalaysiaku';
    private $tableNameKaum = "maklumat_kaum_program_kelabmalaysiaku";

    public function tambahKelabProgram($programBil, $kelabBil){
        $data = array(
            'kelabmalaysiaku_program_program' => $programBil,
            'kelabmalaysiaku_program_kelabmalaysiaku' => $kelabBil,
            'kelabmalaysiaku_program_pengguna' => $this->input->post('inputPengguna'),
            'kelabmalaysiaku_program_pengguna_waktu' => date("Y-m-d H:i:s")
        );
        return $this->db->insert($this->tableName, $data);
    }

    public function padamKelabProgram($programBil){
        $this->db->where('kelabmalaysiaku_program_program', $programBil);
        $this->db->delete($this->tableName);
    }

    public function padamKaumProgram($bil){
        $this->db->where('mkpk_bil', $bil);
        return $this->db->delete($this->tableNameKaum);
    }

    public function senaraiKaumProgramSemua($programBil){
        $this->db->where('maklumat_kaum_program_kelabmalaysiaku.mkpk_program', $programBil);
        $query = $this->db->get($this->tableNameKaum);
        return $query->result();
    }

    public function kemaskiniKaumProgram($bil, $bilMurid){
        $data = array(
            'mkpk_bilangan_murid' => $bilMurid,
            'mkpk_pengguna' => $this->input->post('inputPengguna'),
            'mkpk_pengguna_waktu' => date("Y-m-d H:i:s")
        );
        $this->db->where('mkpk_bil', $bil);
        return $this->db->update($this->tableNameKaum, $data);
    }

    public function tambahKaumProgram($programBil, $namaKaum, $bilMurid){
        $data = array(
            'mkpk_program' => $programBil,
            'mkpk_kaum' => $namaKaum,
            'mkpk_bilangan_murid' => $bilMurid,
            'mkpk_pengguna' => $this->input->post('inputPengguna'),
            'mkpk_pengguna_waktu' => date("Y-m-d H:i:s")
        );
        return $this->db->insert($this->tableNameKaum, $data);
    }

    public function senaraiKaumProgram($programBil, $namaKaum){
        $this->db->where('maklumat_kaum_program_kelabmalaysiaku.mkpk_program', $programBil);
        $this->db->where('maklumat_kaum_program_kelabmalaysiaku.mkpk_kaum', $namaKaum);
        $query = $this->db->get($this->tableNameKaum);
        return $query->row();
    }

    public function kemaskiniMaklumatTambahanPost(){
        $data = array(
            'mtpk_peringkat' => $this->input->post('inputPeringkat'),
            'mtpk_mod_pelaksanaan' => $this->input->post('inputMod'),
            'mtpk_jumlah_murid' => $this->input->post('inputJumlahMurid'),
            'mtpk_jumlah_guru' => $this->input->post('inputJumlahGuru'),
            'mtpk_murid_lelaki' => $this->input->post('inputMuridLelaki'),
            'mtpk_murid_perempuan' => $this->input->post('inputMuridPerempuan'),
        );
        $this->db->where('mtpk_program', $this->input->post('inputProgram'));
        return $this->db->update($this->tableNameTambahan, $data);
    }

    public function tambahMaklumatTambahanPost(){
        $data = array(
            'mtpk_program' => $this->input->post('inputProgram'),
            'mtpk_peringkat' => $this->input->post('inputPeringkat'),
            'mtpk_mod_pelaksanaan' => $this->input->post('inputMod'),
            'mtpk_jumlah_murid' => $this->input->post('inputJumlahMurid'),
            'mtpk_jumlah_guru' => $this->input->post('inputJumlahGuru'),
            'mtpk_murid_lelaki' => $this->input->post('inputMuridLelaki'),
            'mtpk_murid_perempuan' => $this->input->post('inputMuridPerempuan'),
            'mtpk_pengguna' => $this->input->post('inputPengguna'),
            'mtpk_pengguna_waktu' => date('Y-m-d H:i:s')
        );
        return $this->db->insert($this->tableNameTambahan, $data);
    }

    public function maklumatTambahan($programBil){
        $this->db->where('maklumat_tambahan_program_kelabmalaysiaku.mtpk_program', $programBil);
        $query = $this->db->get($this->tableNameTambahan);
        return $query->row();
    }

    public function update20240203(){
        $this->binaTableTambahan();
        $this->binaTableMaklumatKaum();
    }

    private function binaTableMaklumatKaum(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableNameKaum) == FALSE){
            $fields = array(
                'mkpk_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'mkpk_program' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'mkpk_kaum' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'mkpk_bilangan_murid' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'mkpk_pengguna' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'mkpk_pengguna_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('mkpk_bil', TRUE);
            $this->dbforge->create_table($this->tableNameKaum);
        }
    }

    private function binaTableTambahan(){
        //LOAD LIBRARIES
        $this->load->dbforge();

        if($this->db->table_exists($this->tableNameTambahan) == FALSE)
        {
            $fields = array(
                'mtpk_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'mtpk_program' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'mtpk_peringkat' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'mtpk_jumlah_murid' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'mtpk_jumlah_guru' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'mtpk_murid_lelaki' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'mtpk_murid_perempuan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'mtpk_mod_pelaksanaan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'mtpk_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'mtpk_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('mtpk_bil', TRUE);
            $this->dbforge->create_table($this->tableNameTambahan);
        }
    }

    public function libatProgram($kelabmalaysiakuBil){
        $this->db->select('*');
        $this->db->select('DATE(program.program_tarikh_masa) AS tarikhProgram');
        $this->db->join('program', 'program.program_bil = kelabmalaysiaku_program.kelabmalaysiaku_program_program', 'left');
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        $this->db->where('kelabmalaysiaku_program.kelabmalaysiaku_program_kelabmalaysiaku', $kelabmalaysiakuBil);
        $this->db->order_by('program.program_tarikh_masa', 'DESC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function tambahSatu($kelabmalaysiakuBil, $programBil){
        $data = array(
            'kelabmalaysiaku_program_kelabmalaysiaku' => $kelabmalaysiakuBil,
            'kelabmalaysiaku_program_program' => $programBil,
            'kelabmalaysiaku_program_pengguna' => $this->input->post('inputPengguna'),
            'kelabmalaysiaku_program_pengguna_waktu' => date("Y-m-d H:i:s")
        );
        $this->db->insert($this->tableName, $data);
    }

    public function padamSatu($bil){
        $this->db->where('kelabmalaysiaku_program_bil', $bil);
        $this->db->delete($this->tableName);
    }

    public function senarai($programBil){
        $this->db->join('kelabmalaysiaku', 'kelabmalaysiaku.kelabmalaysiaku_bil = kelabmalaysiaku_program.kelabmalaysiaku_program_kelabmalaysiaku', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = kelabmalaysiaku.kelabmalaysiaku_negeri', 'left');
        $this->db->where('kelabmalaysiaku_program_program', $programBil);
        $this->db->order_by('kelabmalaysiaku.kelabmalaysiaku_nama', 'ASC');
        $this->db->order_by('negeri_tb.nt_nama', 'ASC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function update20240124(){
        $this->binaTable();
    }

    private function binaTable(){
        //LOAD LIBRARIES
        $this->load->dbforge();

        if($this->db->table_exists($this->tableName) == FALSE)
        {
            $fields = array(
                'kelabmalaysiaku_program_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'kelabmalaysiaku_program_program' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'kelabmalaysiaku_program_kelabmalaysiaku' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'kelabmalaysiaku_program_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'kelabmalaysiaku_program_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('kelabmalaysiaku_program_bil', TRUE);
            $this->dbforge->create_table($this->tableName);
        }
    }

}
?>