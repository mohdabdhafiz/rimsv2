<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programdua_model extends CI_Model {

    public function senaraiPenuh()
    {
      $this->tableProgram();
      $query = $this->db->get('program');
      return $query->result();
    }

    protected $table = 'program_tb';
    protected $jenis = 'jenis_tb';

    private function tableProgram()
{
        $this->load->dbforge();
        $tableName = 'program';

    if($this->db->table_exists($tableName) == FALSE)
    {
        $fields = array(
            'program_bil' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => FALSE,
                'auto_increment' => TRUE,
                'primary_key' => TRUE
            ),
            'program_pelapor' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'program_no_telefon' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE
            ),
            'program_jenis_program' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'program_negeri' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'program_daerah' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'program_parlimen' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'program_dun' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'program_tarikh_masa' => array(
                'type' => 'datetime',
                'null' => TRUE
            ),
            'program_khalayak' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'program_jumlah_bahan_penerbitan' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'program_pengguna' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'program_pengguna_waktu' => array(
                'type' => 'datetime',
                'null' => TRUE
            ),
            'program_peranan' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('program_bil', TRUE);
        $this->dbforge->create_table($tableName);
    }
}

private function tableLokasiProgram()
{
    $tableName = 'lokasi_program';

    if($this->db->table_exists($tableName) == FALSE)
    {
        $fields = array(
            'lokasi_program_bil' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => FALSE,
                'auto_increment' => TRUE,
                'primary_key' => TRUE
            ),
            'lokasi_program_program' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => FALSE
            ),
            'lokasi_program_lokasi' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'lokasi_program_pengguna' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'lokasi_program_pengguna_waktu' => array(
                'type' => 'datetime',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('lokasi_program_bil', TRUE);
        $this->dbforge->create_table($tableName);
    }
}

private function tableObpProgram()
{
    $tableName = 'obp_program';

    if($this->db->table_exists($tableName) == FALSE)
    {
        $fields = array(
            'obp_program_bil' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => FALSE,
                'auto_increment' => TRUE,
                'primary_key' => TRUE
            ),
            'obp_program_program' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'obp_program_obp' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'obp_program_pengguna' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'obp_program_pengguna_waktu' => array(
                'type' => 'datetime',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('obp_program_bil', TRUE);
        $this->dbforge->create_table($tableName);
    }
}

private function hebahan()
{
    $tableName = 'hebahan';

    if($this->db->table_exists($tableName) == FALSE)
    {
        $fields = array(
            'hebahan_bil' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE,
                'auto_increment' => TRUE,
                'primary_key' => TRUE
            ),
            'hebahan_tajuk' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE
            ),
            'hebahan_pengguna' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'hebahan_pengguna_waktu' => array(
                'type' => 'datetime',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('hebahan_bil', TRUE);
        $this->dbforge->create_table($tableName);
    }
}

private function tableTajukHebahan()
{
    $tableName = 'tajuk_hebahan';

    if($this->db->table_exists($tableName) == FALSE)
    {
        $fields = array(
            'tajuk_hebahan_bil' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE,
                'auto_increment' => TRUE,
                'primary_key' => TRUE
            ),
            'tajuk_hebahan_program' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'tajuk_hebahan_hebahan' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE
            ),
            'tajuk_hebahan_pengguna' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'tajuk_hebahan_pengguna_waktu' => array(
                'type' => 'datetime',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('tajuk_hebahan_bil', TRUE);
        $this->dbforge->create_table($tableName);
    }
}

private function tableTopik()
{
    $tableName = 'topik';

    if($this->db->table_exists($tableName) == FALSE)
    {
        $fields = array(
            'topik_bil' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE,
                'auto_increment' => TRUE,
                'primary_key' => TRUE
            ),
            'topik_topik' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE
            ),
            'topik_pengguna' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'topik_pengguna_waktu' => array(
                'type' => 'datetime',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('topik_bil', TRUE);
        $this->dbforge->create_table($tableName);
    }
}

private function tableJenisTopik()
{
    $tableName = 'jenis_topik';

    if($this->db->table_exists($tableName) == FALSE)
    {
        $field = array(
            'jenis_topik_bil' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE,
                'auto_increment' => TRUE,
                'primary_key' => TRUE
            ),
            'jenis_topik_deskripsi' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'jenis_topik_topik' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE
            ),
            'jenis_topik_pengguna' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'jenis_topik_pengguna_waktu' => array(
                'type' => 'datetime',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($field);
        $this->dbforge->add_key('jenis_topik_bil', TRUE);
        $this->dbforge->create_table($tableName);
    }
}

private function tableTopikProgram()
{
    $tableName = 'topik_program';

    if($this->db->table_exists($tableName) == FALSE)
    {
        $fields = array(
            'topik_program_bil' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE,
                'auto_increment' => TRUE,
                'primary_key' => TRUE
            ),
            'topik_program_program' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'topik_program_topik' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE
            ),
            'topik_program_jenis_topik' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE
            ),
            'topik_program_pengguna' => array(
                'type' => 'BIGINT',
                'constraint' =>'20',
                'null' => TRUE
            ),
            'topik_program_pengguna_waktu' => array(
                'type' => 'datetime',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('topik_program_bil', TRUE);
        $this->dbforge->create_table($tableName);
    }
}

private function tableSenaraiPengisianProgram()
{
    $tableName = 'senarai_pengisian_program';

    if($this->db->table_exists($tableName) == FALSE)
    {
        $fields = array(
            'senarai_pengisian_program_bil' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE,
                'auto_increment' => TRUE,
                'primary_key' => TRUE
            ),
            'senarai_pengisian_program_nama' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE
            ),
            'senarai_pengisian_program_deskripsi' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'senarai_pengisian_program_pengguna' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'senarai_pengisian_program_pengguna_waktu' => array(
                'type' => 'datetime',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('senarai_pengisian_program_bil', TRUE);
        $this->dbforge->create_table($tableName);
    }
}

private function tablePengisianProgram()
{
    $tableName = 'pengisian_program';

    if($this->db->table_exists($tableName) == FALSE)
    {
        $fields = array(
            'pengisian_program_bil' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE,
                'auto_increment' => TRUE,
                'primary_key' => TRUE
            ),
            'pengisian_program_program' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'pengisian_program_senarai_pengisian_program' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
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
        $this->dbforge->create_table($tableName);
    }
}

private function tableJenisPenerbitan()
{
    $tableName = 'jenis_penerbitan';

    if($this->db->table_exists($tableName) == FALSE)
    {
        $fields = array(
            'jenis_penerbitan_bil' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE,
                'auto_increment' => TRUE,
                'primary_key' => TRUE
            ),
            'jenis_penerbitan_deskripsi' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE
            ),
            'jenis_penerbitan_pengguna' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'jenis_penerbitan_pengguna_waktu' => array(
                'type' => 'datetime',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('jenis_penerbitan_bil' , TRUE);
        $this->dbforge->create_table($tableName);
    }
}

private function tableEdaranPenerbitan()
{
    $tableName = 'edaran_penerbitan';

    if($this->db->table_exists($tableName) == FALSE)
    {
        $fields = array(
            'edaran_penerbitan_bil' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE,
                'auto_increment' => TRUE,
                'primary_key' => TRUE
            ),
            'edaran_penerbitan_program' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'edaran_penerbitan_jenis_penerbitan' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE
            ),
            'edaran_penerbitan_pengguna' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'edaran_penerbitan_pengguna_waktu' => array(
                'type' => 'datetime',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('edaran_penerbitan_bil', TRUE);
        $this->dbforge->create_table($tableName);
    }
}

private function tableSenaraiAgensi()
{
    $tableName = 'senarai_agensi';

    if($this->db->table_exists($tableName) == FALSE)
    {
        $fields = array(
            'senarai_agensi_bil' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE,
                'auto_increment' => TRUE,
                'primary_key' => TRUE
            ),
            'senarai_agensi_nama_agensi' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE
            ),
            'senarai_agensi_singkatan_agensi' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE
            ),
            'senarai_agensi_pengguna' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'senarai_agensi_pengguna_waktu' => array(
                'type' => 'datetime',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('senarai_agensi_bil', TRUE);
        $this->dbforge->create_table($tableName);
    }
}

private function tableKerjasamaAgensi()
{
    $tableName = 'kerjasama_agensi';

    if($this->db->table_exists($tableName) == FALSE)
    {
        $fields = array(
            'kerjasama_agensi_bil' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE,
                'auto_increment' => TRUE,
                'primary_key' => TRUE
            ),
            'kerjasama_agensi_program' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'kerjasama_agensi_agensi' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE
            ),
            'kerjasama_agensi_pengguna' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'kerjasama_agensi_pengguna_waktu' => array(
                'type' => 'datetime',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('kerjasama_agensi_bil', TRUE);
        $this->dbforge->create_table($tableName);
    }
}

private function tableGambarProgram()
{
    $tableName = 'gambar_program';

    if($this->db->table_exists($tableName) == FALSE)
    {
        $fields = array(
            'gambar_program_bil' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE,
                'auto_increment' => TRUE,
                'primary_key' => TRUE
            ),
            'gambar_program_nama_fail' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE
            ),
            'gambar_program_program' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'gambar_program_deskripsi' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'gambar_program_pengguna' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'gambar_program_pengguna_waktu' => array(
                'type' => 'datetime',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('gambar_program_bil', TRUE);
        $this->dbforge->create_table($tableName);
    }
}

private function tableSenaraiPautanProgram()
{
    $tableName = 'senarai_pautan_program';

    if($this->db->table_exists($tableName) == FALSE)
    {
        $fields = array(
            'senarai_pautan_program_bil' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE,
                'auto_increment' => TRUE,
                'primary_key' => TRUE
            ),
            'senarai_pautan_program_program' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'senarai_pautan_program_pautan' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'senarai_pautan_program_pengguna' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'senarai_pautan_program_pengguna_waktu' => array(
                'type' => 'datetime',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('senarai_pautan_program_bil', TRUE);
        $this->dbforge->create_table($tableName);
    }
}

private function tableStatusProgram()
{
    $tableName = 'status_program';

    if($this->db->table_exists($tableName) == FALSE)
    {
        $fields = array(
            'status_program_bil' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE,
                'auto_increment' => TRUE,
                'primary_key' => TRUE
            ),
            'status_program_program' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'status_program_status' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE
            ),
            'status_program_deskripsi' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'status_program_pengguna' => array(
                'type' => 'BIGINT',
                'constraint' => '20',
                'null' => TRUE
            ),
            'status_program_pengguna_waktu' => array(
                'type' => 'datetime',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('status_program_bil', TRUE);
        $this->dbforge->create_table($tableName);
    }
}
    
    public function senaraiJenisProgramDunNegeri($namaNegeri){
      $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program_tb.pt_jenisBil', 'left');
      $this->db->join('dun_tb', 'dun_tb.dun_bil = program_tb.pt_dun');
      $this->db->where('dun_tb.dun_negeri', $namaNegeri);
      $this->db->order_by('jenis_tb.jt_peruntukan', 'DESC');
      $this->db->group_by('program_tb.pt_jenisBil');
      $query = $this->db->get($this->table);
      return $query->result();
    }

    public function senaraiJenisProgramParlimenNegeri($namaNegeri){
      $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program_tb.pt_jenisBil', 'left');
      $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program_tb.pt_parlimen');
      $this->db->where('parlimen_tb.pt_negeri', $namaNegeri);
      $this->db->order_by('jenis_tb.jt_peruntukan', 'DESC');
      $this->db->group_by('program_tb.pt_jenisBil');
      $query = $this->db->get($this->table);
      return $query->result();
    }

    public function senaraiJenisProgramDaerahNegeri($negeri){
      $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program_tb.pt_jenisBil', 'left');
      $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program_tb.pt_negeri', 'left');
      $this->db->where('negeri_tb.nt_nama', $negeri);
      $this->db->order_by('jenis_tb.jt_peruntukan', 'DESC');
      $this->db->group_by('program_tb.pt_jenisBil');
      $query = $this->db->get($this->table);
      return $query->result();
    }

    public function senaraiProgramNegeri($negeri)
    {
      $this->penambahanBaharu();
      $this->db->select('*');
      $this->db->select('jenis_tb.jt_nama AS jenisProgram');
      $this->db->select('program_tb.pt_nama AS namaProgram');
      $this->db->select('negeri_tb.nt_nama AS namaNegeri');
      $this->db->select('daerah.nama AS namaDaerah');
      $this->db->select('parlimen_tb.pt_nama AS namaParlimen');
      $this->db->select('dun_tb.dun_nama AS namaDun');
      $this->db->select('program_tb.pt_bil AS bilProgram');
      $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program_tb.pt_jenisBil', 'left');
      $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program_tb.pt_negeri', 'left');
      $this->db->join('daerah', 'daerah.bil = program_tb.pt_daerah', 'left');
      $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program_tb.pt_parlimen', 'left');
      $this->db->join('dun_tb', 'dun_tb.dun_bil = program_tb.pt_dun', 'left');
      $this->db->join('tugas_daerah', 'tugas_daerah.daerah_bil = program_tb.pt_daerah');
      $this->db->where('negeri_tb.nt_nama', $negeri);
      $this->db->order_by('program_tb.pt_penggunaWaktu', 'DESC');
      $query = $this->db->get($this->table);
      return $query->result();
    }

    public function padam()
    {
      $this->db->where('pt_bil', $this->input->post('inputProgramBil'));
      $this->db->delete($this->table);
    }

    public function bilanganJenisProgramDun($dunBil, $jenisProgramBil)
    {
      $this->db->select('*');
      $this->db->select('COUNT(program_tb.pt_jenisBil) AS kiraanProgram');
      $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program_tb.pt_jenisBil', 'left');
      $this->db->where('program_tb.pt_dun', $dunBil);
      $this->db->where('program_tb.pt_jenisBil', $jenisProgramBil);
      $query = $this->db->get($this->table);
      return $query->row();
    }

    public function senaraiJenisProgramDun($perananBil){
      $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program_tb.pt_jenisBil', 'left');
      $this->db->join('tugas_dun_tb', 'tugas_dun_tb.tdt_dun_bil = program_tb.pt_dun');
      $this->db->where('tugas_dun_tb.tdt_peranan_bil', $perananBil);
      $this->db->order_by('jenis_tb.jt_peruntukan', 'DESC');
      $this->db->group_by('program_tb.pt_jenisBil');
      $query = $this->db->get($this->table);
      return $query->result();
    }

    public function bilanganJenisProgramParlimen($parlimenBil, $jenisProgramBil)
    {
      $this->db->select('*');
      $this->db->select('COUNT(program_tb.pt_jenisBil) AS kiraanProgram');
      $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program_tb.pt_jenisBil', 'left');
      $this->db->where('program_tb.pt_parlimen', $parlimenBil);
      $this->db->where('program_tb.pt_jenisBil', $jenisProgramBil);
      $query = $this->db->get($this->table);
      return $query->row();
    }

    public function senaraiJenisProgramParlimen($perananBil){
      $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program_tb.pt_jenisBil', 'left');
      $this->db->join('tugas_parlimen_tb', 'tugas_parlimen_tb.tpt_parlimen_bil = program_tb.pt_parlimen');
      $this->db->where('tugas_parlimen_tb.tpt_peranan_bil', $perananBil);
      $this->db->order_by('jenis_tb.jt_peruntukan', 'DESC');
      $this->db->group_by('program_tb.pt_jenisBil');
      $query = $this->db->get($this->table);
      return $query->result();
    }

    public function bilanganJenisProgramDaerah($daerahBil, $jenisProgramBil)
    {
      $this->db->select('*');
      $this->db->select('COUNT(program_tb.pt_jenisBil) AS kiraanProgram');
      $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program_tb.pt_jenisBil', 'left');
      $this->db->where('program_tb.pt_daerah', $daerahBil);
      $this->db->where('program_tb.pt_jenisBil', $jenisProgramBil);
      $query = $this->db->get($this->table);
      return $query->row();
    }

    public function senaraiJenisProgramDaerah($perananBil){
      $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program_tb.pt_jenisBil', 'left');
      $this->db->join('tugas_daerah', 'tugas_daerah.daerah_bil = program_tb.pt_daerah');
      $this->db->where('tugas_daerah.peranan_bil', $perananBil);
      $this->db->order_by('jenis_tb.jt_peruntukan', 'DESC');
      $this->db->group_by('program_tb.pt_jenisBil');
      $query = $this->db->get($this->table);
      return $query->result();
    }

    private function penambahanBaharu(){
      $this->load->dbforge();
        if($this->db->table_exists($this->table)){
          if(!$this->db->field_exists('pt_statusLaporan', $this->table)){
            $fieldStatus = array(
                'pt_statusLaporan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 200,
                    'null' => TRUE
                )
            );
            $this->dbforge->add_column($this->table, $fieldStatus);
            }
          if(!$this->db->field_exists('pt_negeri', $this->table)){
            $fieldNegeri = array(
                'pt_negeri' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_column($this->table, $fieldNegeri);
            }
            if(!$this->db->field_exists('pt_daerah', $this->table)){
                $fieldDaerah = array(
                    'pt_daerah' => array(
                        'type' => 'BIGINT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($this->table, $fieldDaerah);
            }
            if(!$this->db->field_exists('pt_parlimen', $this->table)){
              $fieldParlimen = array(
                  'pt_parlimen' => array(
                      'type' => 'BIGINT',
                      'null' => TRUE
                  )
              );
              $this->dbforge->add_column($this->table, $fieldParlimen);
              }
              if(!$this->db->field_exists('pt_dun', $this->table)){
                  $fieldDun = array(
                      'pt_dun' => array(
                          'type' => 'BIGINT',
                          'null' => TRUE
                      )
                  );
                  $this->dbforge->add_column($this->table, $fieldDun);
              }
              if(!$this->db->field_exists('pt_pengguna', $this->table)){
                $fieldPengguna = array(
                    'pt_pengguna' => array(
                        'type' => 'BIGINT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($this->table, $fieldPengguna);
                }
                if(!$this->db->field_exists('pt_penggunaWaktu', $this->table)){
                    $fieldDaerah = array(
                        'pt_penggunaWaktu' => array(
                            'type' => 'DATETIME',
                            'null' => TRUE
                        )
                    );
                    $this->dbforge->add_column($this->table, $fieldDaerah);
                }
        }
    }

    public function senaraiProgramPeranan($perananBil)
    {
      $this->penambahanBaharu();
      $this->db->select('*');
      $this->db->select('jenis_tb.jt_nama AS jenisProgram');
      $this->db->select('program_tb.pt_nama AS namaProgram');
      $this->db->select('negeri_tb.nt_nama AS namaNegeri');
      $this->db->select('daerah.nama AS namaDaerah');
      $this->db->select('parlimen_tb.pt_nama AS namaParlimen');
      $this->db->select('dun_tb.dun_nama AS namaDun');
      $this->db->select('program_tb.pt_bil AS bilProgram');
      $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program_tb.pt_jenisBil', 'left');
      $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program_tb.pt_negeri', 'left');
      $this->db->join('daerah', 'daerah.bil = program_tb.pt_daerah', 'left');
      $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program_tb.pt_parlimen', 'left');
      $this->db->join('dun_tb', 'dun_tb.dun_bil = program_tb.pt_dun', 'left');
      $this->db->join('tugas_daerah', 'tugas_daerah.daerah_bil = program_tb.pt_daerah');
      $this->db->where('tugas_daerah.peranan_bil', $perananBil);
      $this->db->order_by('program_tb.pt_penggunaWaktu', 'DESC');
      $query = $this->db->get($this->table);
      return $query->result();
    }

    private function checkTableExists($checkTable)
    {
        $this->load->dbforge();
        if($this->db->table_exists($checkTable) == FALSE){
            $fields = array(
                'pt_bil' => array(
                        'type' => 'BIGINT',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'pt_negeri' => array(
                  'type' => 'BIGINT',
                  'null' => TRUE
                ),
                'pt_daerah' => array(
                  'type' => 'BIGINT',
                  'null' => TRUE
                ),
                'pt_parlimen' => array(
                  'type' => 'BIGINT',
                  'null' => TRUE
                ),
                'pt_dun' => array(
                  'type' => 'BIGINT',
                  'null' => TRUE
                ),
                'pt_nama' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'pt_jenisBil' => array(
                  'type' => 'BIGINT',
                  'null' => TRUE
                ),
                'pt_jenisNama' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'pt_anjuran' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'pt_tempat' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'pt_audien' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'pt_pengisian' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                ),
                'pt_penceramah' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'pt_vip' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'pt_tarikhMasa' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                ),
                'pt_pengguna' => array(
                  'type' => 'BIGINT',
                  'null' => TRUE
                ),
                'pt_penggunaWaktu' => array(
                  'type' => 'DATETIME',
                  'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('pt_bil', TRUE);
            $this->dbforge->create_table($this->table, TRUE);
        }
    }

    public function tambah()
    {
      $this->checkTableExists($this->table);
      $data = array(
        'pt_nama' => $this->input->post('inputNamaProgram'),
        'pt_anjuran' => $this->input->post('inputAnjuran'),
        'pt_tempat' => $this->input->post('inputTempat'),
        'pt_audien' => $this->input->post('inputAudien'),
        'pt_pengisian' => $this->input->post('inputPengisian'),
        'pt_penceramah' => $this->input->post('inputPenceramah'),
        'pt_vip' => $this->input->post('inputPenutup'),
        'pt_tarikhMasa' => $this->input->post('inputMasa'),
        'pt_jenisBil' => $this->input->post('inputJenisBil'),
        'pt_negeri' => $this->input->post('inputNegeri'),
        'pt_daerah' => $this->input->post('inputDaerah'),
        'pt_parlimen' => $this->input->post('inputParlimen'),
        'pt_dun' => $this->input->post('inputDun'),
        'pt_pengguna' => $this->input->post('inputPengguna'),
        'pt_penggunaWaktu' => date('Y-m-d H:i:s'),
        'pt_statusLaporan' => 'BAHARU'
      );

      $return_data['insert_data'] = $this->db->insert($this->table, $data);
      $return_data['last_id'] = $this->db->insert_id();
      return $return_data;
    }

    public function kemaskini()
    {
        $this->checkTableExists($this->table);
      $data = array(
        'pt_nama' => $this->input->post('inputNamaProgram'),
        'pt_anjuran' => $this->input->post('inputAnjuran'),
        'pt_tempat' => $this->input->post('inputTempat'),
        'pt_audien' => $this->input->post('inputAudien'),
        'pt_pengisian' => $this->input->post('inputPengisian'),
        'pt_penceramah' => $this->input->post('inputPenceramah'),
        'pt_vip' => $this->input->post('inputPenutup'),
        'pt_tarikhMasa' => $this->input->post('inputMasa'),
        'pt_jenisBil' => $this->input->post('inputJenisBil'),
        'pt_negeri' => $this->input->post('inputNegeri'),
        'pt_daerah' => $this->input->post('inputDaerah'),
        'pt_parlimen' => $this->input->post('inputParlimen'),
        'pt_dun' => $this->input->post('inputDun'),
        'pt_pengguna' => $this->input->post('inputPengguna'),
      );

      $this->db->where('pt_bil', $this->input->post('inputProgramBil'));
      $this->db->update($this->table, $data);
    }

    public function program($bil)
    {

        $this->checkTableExists($this->table);
      $this->db->where('pt_bil', $bil);
      $query = $this->db->get($this->table);
      return $query->result();
    }

    public function programDetail($bil)
    {

        $this->checkTableExists($this->table);
      $this->db->where('pt_bil', $bil);
      $query = $this->db->get($this->table);
      return $query->row();
    }

    public function semua()
    {
      $this->checkTableExists($this->table);
      $this->db->order_by('pt_tarikhMasa', 'DESC');
      $query = $this->db->get($this->table);
      return $query->result();
    }

    public function jenisProgram()
    {
      $this->checkTableExists($this->table);
      $this->db->select('pt_jenis');
      $this->db->group_by('pt_jenis');
      $query=$this->db->get($this->table);
      return $query->result();
    }

    public function ikutTarikh($tarikhMasa)
    {
        $this->checkTableExists($this->table);
        $this->db->where('DATE(pt_tarikhMasa)', date_format(date_create($tarikhMasa), "Y-m-d"));
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiJenis($jenisBil)
    {
        $this->checkTableExists($this->table);
        $this->db->where('pt_jenisBil', $jenisBil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiPenganjur()
    {
        $this->checkTableExists($this->table);
        $this->db->select('pt_anjuran');
        $this->db->group_by('pt_anjuran');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_ikut_jenis_program_negeri($jenis_program_bil, $penganjur, $tahun)
    {
      $this->checkTableExists($this->table);
      $this->db->where('pt_jenisBil', $jenis_program_bil);
      $this->db->where('pt_anjuran', $penganjur);
      $this->db->where('YEAR(pt_tarikhMasa)', $tahun);
      $query = $this->db->get($this->table);
      return $query->result();
    }

  }
