<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Japen_model extends CI_Model {

    protected $table = 'japen_tb';
    protected $organisasi = 'organisasi';

    /**
     * Mendapatkan rumusan N organisasi teratas berdasarkan jumlah pelapor PPD.
     * @param int $limit Bilangan organisasi untuk dipaparkan.
     * @return array
     */
    public function rumusan_pelapor_ppd_teratas($limit = 5)
    {
        $this->db->select([
            'UPPER(japen_tb.jt_pejabat) AS nama_organisasi',
            'COUNT(pengguna_tb.bil) AS total_pelapor'
        ]);

        $this->db->from('japen_tb');
        $this->db->join('organisasi', 'organisasi.o_japen = japen_tb.jt_bil', 'left');
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = organisasi.o_peranan', 'left');
        $this->db->join('pengguna_tb', 'pengguna_tb.pengguna_peranan_bil = peranan_tb.peranan_bil', 'left');

        $this->db->like('peranan_tb.peranan_nama', 'PPD', 'after');
        $this->db->where('pengguna_tb.bil IS NOT NULL'); // Pastikan hanya yang ada pengguna dikira

        $this->db->group_by('japen_tb.jt_pejabat');
        $this->db->order_by('total_pelapor', 'DESC');
        $this->db->limit($limit);

        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Mendapatkan rumusan bilangan pelapor (pengguna) untuk setiap peranan PPD,
     * dikumpulkan mengikut organisasi JAPEN.
     * @return array
     */
    public function rumusan_pelapor_ppd()
    {
        $this->db->select([
            'UPPER(japen_tb.jt_pejabat) AS nama_organisasi',
            'peranan_tb.peranan_nama AS nama_peranan',
            'COUNT(pengguna_tb.bil) AS bilangan_pelapor'
        ]);

        $this->db->from('japen_tb');
        $this->db->join('organisasi', 'organisasi.o_japen = japen_tb.jt_bil', 'left');
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = organisasi.o_peranan', 'left');
        $this->db->join('pengguna_tb', 'pengguna_tb.pengguna_peranan_bil = peranan_tb.peranan_bil', 'left');

        // Saring hanya untuk peranan yang mempunyai 'PPD'
        $this->db->like('peranan_tb.peranan_nama', 'PPD', 'after');

        $this->db->group_by('japen_tb.jt_pejabat, peranan_tb.peranan_nama');
        $this->db->order_by('nama_organisasi', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function padamOrganisasi($organisasiBil){
        $this->db->where('o_bil', $organisasiBil);
        return $this->db->delete($this->organisasi);
    }

    public function organisasiBil($organisasiBil){
        $select = [
            "organisasi.o_bil AS organisasiBil",
            "organisasi.o_peranan AS perananBil",
            "UPPER(japen_tb.jt_pejabat) AS japenNama",
            "UPPER(peranan_tb.peranan_nama) AS perananNama",
        ];
        $this->db->select($select);
        $this->db->join("japen_tb", "japen_tb.jt_bil = organisasi.o_japen", "left");
        $this->db->join("peranan_tb", "peranan_tb.peranan_bil = organisasi.o_peranan", "left");
        $this->db->where("o_bil", $organisasiBil);
        $query = $this->db->get($this->organisasi);
        return $query->row();
    }

    public function tambahOrganisasiPeranan($inputJapenBil, $inputPerananBil, $inputPenggunaBil, $inputPenggunaWaktu){
        $data = array(
            'o_japen' => $inputJapenBil,
            'o_peranan' => $inputPerananBil,
            'o_pengguna' => $inputPenggunaBil,
            'o_pengguna_waktu' => $inputPenggunaWaktu
        );
        return $this->db->insert($this->organisasi, $data);
    }

    public function semakOrganisasiPerananBil($inputJapenBil, $inputPerananBil){
        $this->db->where("organisasi.o_japen", $inputJapenBil);
        $this->db->where("organisasi.o_peranan", $inputPerananBil);
        $query = $this->db->get($this->organisasi);
        return $query->row();
    }

    public function tambahBaharu($inputJapenNama, $inputPenggunaBil){
        $data = array(
            'jt_pejabat' => $inputJapenNama,
            'jt_pengguna_bil' => $inputPenggunaBil,
            'jt_tarikh_masuk' => date('Y-m-d H:i:s')
        );
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function semakJapenNama($inputJapenNama){
        $this->db->select("japen_tb.jt_bil AS japenBil");
        $this->db->where("UPPER(japen_tb.jt_pejabat)", strtoupper($inputJapenNama));
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function perananBil($perananBil){
        $this->db->select("UPPER(peranan_tb.peranan_bil) AS perananBil");
        $this->db->select("UPPER(peranan_tb.peranan_nama) AS perananNama");
        $this->db->select("UPPER(peranan_tb.peranan_petugas) AS perananPetugas");
        $this->db->select("UPPER(peranan_tb.peranan_waktu) AS perananWaktu");
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS penggunaNama");
        $this->db->join("pengguna_tb", "pengguna_tb.bil = peranan_tb.peranan_dicipta", "left");
        $this->db->where("peranan_tb.peranan_bil", $perananBil);
        $query = $this->db->get("peranan_tb");
        return $query->row();
    }

    public function rumusanOrganisasi(){
        $this->db->select("UPPER(peranan_tb.peranan_nama) AS perananNama");
        $this->db->select('(
            SELECT UPPER(japen_tb.jt_pejabat) 
            FROM japen_tb
            LEFT JOIN organisasi ON organisasi.o_japen = japen_tb.jt_bil
            WHERE organisasi.o_peranan = peranan_tb.peranan_bil
            ORDER BY organisasi.o_pengguna_waktu DESC
            LIMIT 1
            ) AS organisasiNama');
        $this->db->select('(
            SELECT organisasi.o_pengguna_waktu
            FROM organisasi
            WHERE organisasi.o_peranan = peranan_tb.peranan_bil
            ORDER BY organisasi.o_pengguna_waktu DESC
            LIMIT 1
            ) AS organisasiWaktu');
        $this->db->select("peranan_tb.peranan_bil AS perananBil");
        $this->db->order_by("organisasiWaktu", "DESC");
        $query = $this->db->get("peranan_tb");
        return $query->result();
    }


    public function senaraiPenempatan()
    {
        $this->checkTableExists();
        $this->db->select('jt_pejabat AS namaPenempatan');
        $this->db->order_by('jt_pejabat', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function semakOrganisasiPejabat($perananBil, $japenBil){
        $this->db->join('japen_tb', 'japen_tb.jt_bil = organisasi.o_japen', 'left');
        $this->db->where('organisasi.o_peranan', $perananBil);
        $this->db->where('organisasi.o_japen', $japenBil);
        $query = $this->db->get($this->organisasi);
        return $query->row();
    }

    public function japenPpn(){
        $this->db->select("japen_tb.jt_bil AS japenBil");
        $this->db->select("japen_tb.jt_pejabat AS japenNama");
        $this->db->like('japen_tb.jt_pejabat', 'Jabatan Penerangan Malaysia');
        $query = $this->db->get($this->table);
        return $query->result();
    }


    public function organisasi($perananBil){
        $this->db->join('japen_tb', 'japen_tb.jt_bil = organisasi.o_japen', 'left');
        $this->db->where('organisasi.o_peranan', $perananBil);
        $query = $this->db->get($this->organisasi);
        return $query->row();
    }


    public function tambahOrganisasi($organisasiBil, $perananBil, $penggunaBil){
        $data = array(
            'o_japen' => $organisasiBil,
            'o_peranan' => $perananBil,
            'o_pengguna' => $penggunaBil,
            'o_pengguna_waktu' => date('Y-m-d H:i:s')
        );
        return $this->db->insert($this->organisasi, $data);
    }

    public function semakOrganisasi($perananBil){
        $this->db->where('organisasi.o_peranan', $perananBil);
        $query = $this->db->get($this->organisasi);
        return $query->row();
    }

    public function tambahPejabat($nama, $penggunaBil){
        $data = array(
            'jt_pejabat' => $nama,
            'jt_pengguna_bil' => $penggunaBil,
            'jt_tarikh_masuk' => date('Y-m-d H:i:s')
        );
        return $this->db->insert($this->table, $data);
    }

    public function namaJapen($nama){
        $this->db->where('japen_tb.jt_pejabat', $nama);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function update20240206(){
        $this->binaTable();
    }


    public function senaraiOrganisasiPerananBil($perananBil){
        $select = [
            "organisasi.o_bil AS organisasiBil",
            "UPPER(japen_tb.jt_pejabat) AS japenNama",
            "UPPER(pengguna_tb.nama_penuh) AS penggunaNama",
            "organisasi.o_pengguna_waktu AS organisasiWaktu",
        ];
        $this->db->select($select);
        $this->db->join("japen_tb", "japen_tb.jt_bil = organisasi.o_japen", "left");
        $this->db->join("pengguna_tb", "pengguna_tb.bil = organisasi.o_pengguna", "left");
        $this->db->where("organisasi.o_peranan", $perananBil);
        $this->db->order_by("organisasiWaktu", "DESC");
        $query = $this->db->get($this->organisasi);
        return $query->result();
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->organisasi) == FALSE){
            $fields = array(
                'o_bil' => array(
                    'type' => 'BIGINT',
                    'null' => FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'o_japen' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'o_peranan' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'o_pengguna' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'o_pengguna_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('o_bil', TRUE);
            $this->dbforge->create_table($this->organisasi, TRUE);
        }
    }

    private function checkTableExists()
    {
        $checkTable = $this->table;
        $this->load->dbforge();
        if($this->db->table_exists($checkTable) == FALSE){
            $fields = array(
                'jt_bil' => array(
                        'type' => 'BIGINT',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'jt_pejabat' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'jt_negeri' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'jt_pengguna_bil' => array(
                  'type' => 'BIGINT',
                  'null' => TRUE
                ),
                'jt_pengguna_nama' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'jt_tarikh_masuk' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('jt_bil', TRUE);
            $this->dbforge->create_table($this->table, TRUE);
        }
    }

    public function japen($japenBil){
        $this->checkTableExists();
        $this->db->where('jt_bil', $japenBil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function senaraiJapen()
    {
        $this->checkTableExists();
        $this->db->order_by('jt_pejabat', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function tambah()
    {
        $data = array(
            'jt_pejabat' => $this->input->post('inputPejabat'),
            'jt_negeri' => $this->input->post('inputNegeri'),
            'jt_pengguna_bil' => $this->input->post('inputPenggunaBil'),
            'jt_pengguna_nama' => $this->input->post('inputPenggunaNama'),
            'jt_tarikh_masuk' => date_format(date_create($this->input->post('inputTarikhMasa')), "Y-m-d H:i:s")
        );
        return $this->db->insert($this->table, $data);
    }

    public function kemaskini()
    {
        $data = array(
            'jt_pejabat' => $this->input->post('inputPejabat'),
            'jt_negeri' => $this->input->post('inputNegeri'),
            'jt_pengguna_bil' => $this->input->post('inputPenggunaBil'),
            'jt_pengguna_nama' => $this->input->post('inputPenggunaNama'),
            'jt_tarikh_masuk' => date_format(date_create($this->input->post('inputTarikhMasa')), "Y-m-d H:i:s")
        );
        $this->db->where('jt_bil', $this->input->post('inputJapenBil'));
        return $this->db->update($this->table, $data);
    }

    public function padam()
    {
        $this->db->where('jt_bil', $this->input->post('inputJapenBil'));
        return $this->db->delete($this->table);
    }

    public function tugasan_parlimen($peranan, $parlimen, $waktu, $pengguna)
    {
        $data = array(
            'tpt_peranan_bil' => $peranan,
            'tpt_parlimen_bil' => $parlimen,
            'tpt_waktu' => $waktu,
            'tpt_pengguna_bil' => $pengguna
        );
        $this->db->insert('tugas_parlimen_tb', $data);
    }

    public function semak_tugas_parlimen($parlimen){
        $this->db->where('tpt_parlimen_bil', $parlimen);
        $query = $this->db->get('tugas_parlimen_tb');
        return $query->row();
    }

    public function senarai_tugas_parlimen($peranan){
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = tugas_parlimen_tb.tpt_parlimen_bil');
        $this->db->where('tpt_peranan_bil', $peranan);
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $query = $this->db->get('tugas_parlimen_tb');
        return $query->result();
    }

    public function senarai_tugas_peranan($parlimen)
    {
        $this->db->where('tpt_parlimen_bil', $parlimen);
        $this->db->order_by('tpt_waktu', 'DESC');
        $query = $this->db->get('tugas_parlimen_tb');
        return $query->row();
    }

    public function tugasan_dun($peranan, $dun, $waktu, $pengguna)
    {
        $data = array(
            'tdt_peranan_bil' => $peranan,
            'tdt_dun_bil' => $dun,
            'tdt_waktu' => $waktu,
            'tdt_pengguna_bil' => $pengguna
        );
        $this->db->insert('tugas_dun_tb', $data);
    }

    public function semak_tugas_dun($dun){
        $this->db->where('tdt_dun_bil', $dun);
        $query = $this->db->get('tugas_dun_tb');
        return $query->row();
    }

    public function senarai_tugas_dun($peranan){
        $this->db->join('dun_tb', 'dun_tb.dun_bil = tugas_dun_tb.tdt_dun_bil');
        $this->db->where('tdt_peranan_bil', $peranan);
        $query = $this->db->get('tugas_dun_tb');
        return $query->result();
    }

    public function senarai_tugas_peranan_dun($dun)
    {
        $this->db->where('tdt_dun_bil', $dun);
        $this->db->order_by('tdt_waktu', 'DESC');
        $query = $this->db->get('tugas_dun_tb');
        return $query->row();
    }

    public function ubah_tugas_parlimen()
    {
        $this->db->where('tpt_bil', $this->input->post('input_tugas_parlimen_bil'));
        $this->db->delete('tugas_parlimen_tb');
    }

    public function ubah_tugas_dun()
    {
        $this->db->where('tdt_bil', $this->input->post('input_tugas_dun_bil'));
        $this->db->delete('tugas_dun_tb');
    }
}