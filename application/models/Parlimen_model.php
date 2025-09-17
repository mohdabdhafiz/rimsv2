<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parlimen_model extends CI_Model {

    protected $table = 'parlimen_tb';

    //======================================================================
    // FUNGSI BARU DITAMBAH DI SINI
    //======================================================================

    /**
     * Mendapatkan satu baris data parlimen berdasarkan ID (bil).
     * Ini adalah alias untuk fungsi parlimen_bil($bil) untuk konsistensi.
     *
     * @param int $bil ID parlimen (pt_bil).
     * @return object Data parlimen.
     */
    public function satu_data($bil)
    {
        // Memanggil fungsi 'parlimen_bil' yang sedia ada.
        return $this->parlimen_bil($bil);
    }

    //======================================================================
    // FUNGSI SEDIA ADA ANDA
    //======================================================================

    public function senarai_ikut_negeri($negeri_bil)
    {
        // JOIN dengan negeri_tb dan tapis menggunakan ID negeri
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = parlimen_tb.pt_negeri', 'left');
        $this->db->where('negeri_tb.nt_bil', $negeri_bil); // Tapis guna ID
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $query = $this->db->get('parlimen_tb');
        return $query->result();
    }
    

    public function senaraiParlimenCarian(){
        $column = [
            'parlimen_tb.pt_bil AS parlimenBil', 
            'UPPER(parlimen_tb.pt_nama) AS parlimenNama',
            "UPPER(negeri_tb.nt_nama) AS negeriNama"
        ];
        $this->db->select($column);
        $this->db->join("negeri_tb", "UPPER(negeri_tb.nt_nama) = UPPER(parlimen_tb.pt_negeri)", "left");
        $this->db->order_by("parlimenNama", "ASC");
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function bilanganLaporanUtama(){
        $this->db->select("COUNT(*) AS bilanganLaporan");
        $query = $this->db->get($this->table);
        $bilanganLaporan = $query->row();
        return $bilanganLaporan->bilanganLaporan;
    }

    public function senaraiParlimenNegeri($senaraiNegeri){
        $this->db->select('UPPER(parlimen_tb.pt_nama) AS parlimenNama');
        $this->db->select('parlimen_tb.pt_nama');
        $this->db->select('parlimen_tb.pt_bil');
        $this->db->select('UPPER(negeri_tb.nt_nama) AS negeriNama');
        $this->db->join('negeri_tb', 'UPPER(negeri_tb.nt_nama) = UPPER(parlimen_tb.pt_negeri)', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->group_by('parlimenNama');
        $this->db->order_by('negeriNama', 'ASC');
        $this->db->order_by('parlimenNama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function parlimenNegeriSenarai($negeriBil){
        $this->db->select('parlimen_tb.pt_bil AS parlimenBil');
        $this->db->select('UPPER(parlimen_tb.pt_nama) AS parlimenNama');
        $this->db->join('negeri_tb', 'UPPER(negeri_tb.nt_nama) = UPPER(parlimen_tb.pt_negeri)', 'left');
        $this->db->where('negeri_tb.nt_bil', $negeriBil);
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiWakilRakyat()
    {
        $this->db->join('pencalonan_parlimen_tb', 'pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil = parlimen_tb.pt_bil', 'left');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', 'left');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_parlimen_tb.pencalonan_parlimen_partiBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = parlimen_tb.pt_negeri', 'left');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_keputusan_tidak_rasmi', 'MENANG');
        $this->db->order_by('negeri_tb.nt_nama', 'ASC');
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $this->db->order_by('pilihanraya_tb.pilihanraya_lock_status', 'ASC');
        $this->db->group_by('parlimen_tb.pt_nama');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function parlimenMengikutSenaraiNegeri($senaraiNegeri)
    {
        $this->db->select('*');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = parlimen_tb.pt_negeri');
        $this->db->group_start();
        foreach($senaraiNegeri as $n){
            $this->db->or_where('negeri_tb.nt_bil', $n->negeri);
        }
        $this->db->group_end();
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiTugasanParlimen($perananBil)
    {
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = tugas_parlimen_tb.tpt_parlimen_bil');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = parlimen_tb.pt_negeri', 'left');
        $this->db->where('tugas_parlimen_tb.tpt_peranan_bil', $perananBil);
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $query = $this->db->get('tugas_parlimen_tb');
        return $query->result();
    }

    public function kemaskini_tugas_parlimen($tugas_bil)
    {
        $data = array(
            'tpt_peranan_bil' => $this->input->post('input_peranan_bil'),
            'tpt_parlimen_bil' => $this->input->post('input_parlimen_bil'),
            'tpt_pengguna_bil' => $this->input->post('input_pengguna_bil'),
            'tpt_waktu' => date('Y-m-d H:i:s')
        );
        $this->db->where('tpt_bil', $tugas_bil);
        return $this->db->update('tugas_parlimen_tb', $data);
    }

    public function tambah_tugas_parlimen()
    {
        $data = array(
            'tpt_peranan_bil' => $this->input->post('input_peranan_bil'),
            'tpt_parlimen_bil' => $this->input->post('input_parlimen_bil'),
            'tpt_pengguna_bil' => $this->input->post('input_pengguna_bil'),
            'tpt_waktu' => date('Y-m-d H:i:s')
        );
        return $this->db->insert('tugas_parlimen_tb', $data);
    }

    public function tugas_parlimen($parlimen_bil)
    {
        $this->db->where('tpt_parlimen_bil', $parlimen_bil);
        $query = $this->db->get('tugas_parlimen_tb');
        return $query->row();
    }

    public function senarai_tugas_ppd($parlimen_bil)
    {
        $this->db->select('tugas_parlimen_tb.tpt_bil');
        $this->db->select('tugas_parlimen_tb.tpt_peranan_bil');
        $this->db->select('peranan_tb.peranan_nama');
        $this->db->select('peranan_tb.peranan_bil');
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = tugas_parlimen_tb.tpt_peranan_bil');
        $this->db->where('tugas_parlimen_tb.tpt_parlimen_bil', $parlimen_bil);
        $this->db->order_by('peranan_tb.peranan_nama', 'ASC');
        $query = $this->db->get('tugas_parlimen_tb');
        return $query->result();
    }

    public function padam_bil()
    {
        $this->db->where('pt_bil', $this->input->post('input_bil'));
        $this->db->delete($this->table);
    }

    public function tambah()
    {
        $data = array(
            'pt_nama' => $this->input->post('input_nama'),
            'pt_negeri' => $this->input->post('input_negeri_nama')
        );
        
        $return_data['insert_data'] = $this->db->insert($this->table, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;

    }

    public function senarai_tugas_ppd_bil($parlimen_bil)
    {
        $this->db->select('tugas_parlimen_tb.tpt_bil');
        $this->db->select('tugas_parlimen_tb.tpt_peranan_bil');
        $this->db->select('peranan_tb.peranan_nama');
        $this->db->select('peranan_tb.peranan_bil');
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = tugas_parlimen_tb.tpt_peranan_bil');
        $this->db->where('tugas_parlimen_tb.tpt_parlimen_bil', $parlimen_bil);
        $this->db->order_by('tugas_parlimen_tb.tpt_waktu', 'DESC');
        $query = $this->db->get('tugas_parlimen_tb');
        return $query->row();
    }

    public function parlimen_negeri($negeri_bil)
    {
        $this->db->select('*');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = parlimen_tb.pt_negeri');
        $this->db->where('negeri_tb.nt_bil', $negeri_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_parlimen_pilihanraya($pilihanraya_bil)
    {
        $this->db->join('pilihanraya_parlimen_tb', 'pilihanraya_parlimen_tb.ppt_parlimen_bil = parlimen_tb.pt_bil');
        $this->db->where('pilihanraya_parlimen_tb.ppt_pilihanraya_bil', $pilihanraya_bil);
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function cari_dm_no($nombor_parlimen){
        $this->db->like('pt_nama', $nombor_parlimen);
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
                'pt_nama' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'pt_negeri' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'pt_pengguna' => array(
                        'type' => 'BIGINT',
                        'null' => TRUE
                ),
                'pt_nama_pengguna' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
                ),
                'pt_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('pt_bil', TRUE);
            $this->dbforge->create_table($this->table, TRUE);
        }
    }

    public function semuaParlimen()
    {
        $this->checkTableExists($this->table);
        $this->db->order_by('pt_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function negeri($nama){
        $this->db->where('pt_negeri', $nama);
        $this->db->order_by('pt_nama', 'ASC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function senaraiParlimen()
    {
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai()
    {
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = parlimen_tb.pt_negeri', 'left');
        $this->db->order_by('negeri_tb.nt_nama', 'ASC');
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function paparIkutNegeri($negeri)
    {
        $this->checkTableExists($this->table);
        $this->db->where('pt_negeri', $negeri);
        $this->db->order_by('pt_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikut_tugasan($peranan_bil)
    {
        $this->db->join('tugas_parlimen_tb', 'tugas_parlimen_tb.tpt_parlimen_bil = parlimen_tb.pt_bil');
        $this->db->where('tugas_parlimen_tb.tpt_peranan_bil', $peranan_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function daftar()
    {
        $this->checkTableExists($this->table);
        $data = array(
            'pt_nama' => $this->input->post('inputParlimenNama'),
            'pt_negeri' => $this->input->post('inputParlimenNegeri'),
            'pt_waktu' => date ('Y-m-d H:i:s'),
            'pt_pengguna' => $this->input->post('inputParlimenBilPengguna'),
            'pt_nama_pengguna' => $this->input->post('inputParlimenNamaPengguna')          
        );
        $return_data['insert_data'] = $this->db->insert($this->table, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    public function parlimen2($parlimenBil)
    {
        $this->checkTableExists($this->table);
        $this->db->select("*");
        $this->db->select("parlimen_tb.pt_bil AS parlimenBil");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS parlimenNama");
        $this->db->select("negeri_tb.nt_bil AS negeriBil");
        $this->db->select("UPPER(negeri_tb.nt_nama) AS negeriNama");
        $this->db->select("UPPER(parlimen_tb.pt_nama_pengguna) AS penggunaNama");
        $this->db->select("parlimen_tb.pt_waktu AS penggunaWaktu");
        $this->db->join('negeri_tb', 'UPPER(negeri_tb.nt_nama) = UPPER(parlimen_tb.pt_negeri)', 'left');
        $this->db->where('parlimen_tb.pt_bil', $parlimenBil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function parlimen($parlimenBil)
    {
        $this->checkTableExists($this->table);
        $this->db->select("*");
        $this->db->select("parlimen_tb.pt_bil AS parlimenBil");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS parlimenNama");
        $this->db->select("negeri_tb.nt_bil AS negeriBil");
        $this->db->select("UPPER(negeri_tb.nt_nama) AS negeriNama");
        $this->db->join('negeri_tb', 'UPPER(negeri_tb.nt_nama) = UPPER(parlimen_tb.pt_negeri)', 'left');
        $this->db->where('parlimen_tb.pt_bil', $parlimenBil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function parlimen_bil($id)
    {
        $this->db->where('pt_bil', $id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function padam($id)
    {
        $this->db->where('pt_bil', $id);
        $this->db->delete($this->table);
    }

    public function kemaskini($id)
    {
        $data = array('pt_nama' => $this->input->post('inputParlimenNama'));
        $this->db->where('pt_bil', $id);
        $this->db->update($this->table, $data);
    }

    public function senarai_negeri()
    {
        $this->db->select('pt_negeri');
        $this->db->order_by('pt_negeri', 'ASC');
        $this->db->group_by('pt_negeri');
        $query = $this->db->get($this->table);
        return $query->result();
    }

}
