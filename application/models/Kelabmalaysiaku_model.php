<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelabmalaysiaku_model extends CI_Model {

    private $tableName = "kelabmalaysiaku";

    /**
     * Mendapatkan rumusan bilangan kelab, sekolah, dan ahli mengikut daerah.
     * @param int $limit Bilangan daerah teratas untuk dipaparkan.
     */
    public function senaraiRumusanDaerah($limit = 10)
    {
        $this->db->select('daerah.nama AS kategoriNama');
        $this->db->select('COUNT(kelabmalaysiaku_bil) AS jumlahKelab');
        $this->db->join('kelabmalaysiaku', 'kelabmalaysiaku.kelabmalaysiaku_daerah = daerah.bil');
        $this->db->where('kelabmalaysiaku.kelabmalaysiaku_status_aktif', "AKTIF");
        $this->db->group_by('daerah.nama');
        $this->db->order_by('jumlahKelab', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('daerah');
        return $query->result();
    }

    public function bilanganLaporanUtama(){
      return $this->db->count_all($this->tableName);
    }

    public function bilanganKelabPengguna($penggunaBil){
      $this->db->select('COUNT(*) AS bilanganKelab');
      $this->db->where('kelabmalaysiaku_pengguna_bil', $penggunaBil);
      $query = $this->db->get($this->tableName);
      return $query->row();
    }

    public function bilanganKelabPeranan($perananBil){
      $this->db->select('COUNT(*) AS bilanganKelab');
      $this->db->join('pengguna_tb', 'pengguna_tb.bil = kelabmalaysiaku.kelabmalaysiaku_pengguna_bil', 'left');
      $this->db->where('pengguna_tb.pengguna_peranan_bil', $perananBil);
      $query = $this->db->get($this->tableName);
      return $query->row();
    }

    public function amUmum(){
      $this->db->select('COUNT(*) AS bilanganKelab');
      $this->db->select('COUNT(DISTINCT kelabmalaysiaku_sekolah) AS bilanganSekolah');
      $this->db->select('SUM(kelabmalaysiaku_jumlah_ahli) AS bilanganAhli');
      $this->db->where('kelabmalaysiaku_status_aktif', 'AKTIF');
      $query = $this->db->get($this->tableName);
      return $query->row();
    }

    public function amUmumPpd($senaraiDaerah){
      $this->db->select('COUNT(*) AS bilanganKelab');
      $this->db->select('COUNT(DISTINCT kelabmalaysiaku_sekolah) AS bilanganSekolah');
      $this->db->select('SUM(kelabmalaysiaku_jumlah_ahli) AS bilanganAhli');
      $this->db->where('kelabmalaysiaku_status_aktif', 'AKTIF');
      $this->db->group_start();
        foreach($senaraiDaerah as $daerah){
          $this->db->or_where('kelabmalaysiaku_daerah', $daerah->bil);
        }
      $this->db->group_end();
      $query = $this->db->get($this->tableName);
      return $query->row();
    }

    public function senaraiRumusanUmum($limit = NULL){
      $this->db->select('negeri_tb.nt_nama');
      $this->db->select('(
        SELECT COUNT(*)
        FROM kelabmalaysiaku
        WHERE kelabmalaysiaku.kelabmalaysiaku_negeri = negeri_tb.nt_bil
        AND kelabmalaysiaku.kelabmalaysiaku_status_aktif = "AKTIF"
      ) AS jumlahKelab');
      $this->db->select('(
        SELECT COUNT(DISTINCT kelabmalaysiaku.kelabmalaysiaku_sekolah)
        FROM kelabmalaysiaku
        WHERE kelabmalaysiaku.kelabmalaysiaku_negeri = negeri_tb.nt_bil
        AND kelabmalaysiaku.kelabmalaysiaku_status_aktif = "AKTIF"
        ) AS jumlahSekolah');
      $this->db->select('(
        SELECT SUM(kelabmalaysiaku.kelabmalaysiaku_jumlah_ahli)
        FROM kelabmalaysiaku
        WHERE kelabmalaysiaku.kelabmalaysiaku_negeri = negeri_tb.nt_bil
        AND kelabmalaysiaku.kelabmalaysiaku_status_aktif = "AKTIF"
        ) AS jumlahAhli');

      // Tambah logik untuk had
      if ($limit) {
          $this->db->order_by('jumlahKelab', 'DESC');
          $this->db->limit($limit);
      } else {
          $this->db->order_by('negeri_tb.nt_nama', 'ASC');
      }
      $this->db->order_by('negeri_tb.nt_nama', 'ASC');
      $query = $this->db->get('negeri_tb');
      return $query->result();
    }

    public function senaraiRumusanUmumPpd($senaraiDaerah){
      $this->db->select('daerah.nama AS kategoriNama');
      $this->db->select('(
        SELECT COUNT(*)
        FROM kelabmalaysiaku
        WHERE kelabmalaysiaku.kelabmalaysiaku_daerah = daerah.bil
        AND kelabmalaysiaku.kelabmalaysiaku_status_aktif = "AKTIF"
      ) AS jumlahKelab');
      $this->db->select('(
        SELECT COUNT(DISTINCT kelabmalaysiaku.kelabmalaysiaku_sekolah)
        FROM kelabmalaysiaku
        WHERE kelabmalaysiaku.kelabmalaysiaku_daerah = daerah.bil
        AND kelabmalaysiaku.kelabmalaysiaku_status_aktif = "AKTIF"
        ) AS jumlahSekolah');
      $this->db->select('(
        SELECT SUM(kelabmalaysiaku.kelabmalaysiaku_jumlah_ahli)
        FROM kelabmalaysiaku
        WHERE kelabmalaysiaku.kelabmalaysiaku_daerah = daerah.bil
        AND kelabmalaysiaku.kelabmalaysiaku_status_aktif = "AKTIF"
        ) AS jumlahAhli');
      $this->db->group_start();
        foreach($senaraiDaerah as $daerah){
          $this->db->or_where('daerah.bil', $daerah->bil);
        }
      $this->db->group_end();
      $this->db->order_by('daerah.nama', 'ASC');
      $query = $this->db->get('daerah');
      return $query->result();
    }

    public function senaraiRumusanParlimen($senaraiParlimen){
      $this->db->select('parlimen_tb.pt_nama AS kategoriNama');
      $this->db->select('(
        SELECT COUNT(*)
        FROM kelabmalaysiaku
        WHERE kelabmalaysiaku.kelabmalaysiaku_parlimen = parlimen_tb.pt_bil
        AND kelabmalaysiaku.kelabmalaysiaku_status_aktif = "AKTIF"
      ) AS jumlahKelab');
      $this->db->select('(
        SELECT COUNT(DISTINCT kelabmalaysiaku.kelabmalaysiaku_sekolah)
        FROM kelabmalaysiaku
        WHERE kelabmalaysiaku.kelabmalaysiaku_parlimen = parlimen_tb.pt_bil
        AND kelabmalaysiaku.kelabmalaysiaku_status_aktif = "AKTIF"
        ) AS jumlahSekolah');
      $this->db->select('(
        SELECT SUM(kelabmalaysiaku.kelabmalaysiaku_jumlah_ahli)
        FROM kelabmalaysiaku
        WHERE kelabmalaysiaku.kelabmalaysiaku_parlimen = parlimen_tb.pt_bil
        AND kelabmalaysiaku.kelabmalaysiaku_status_aktif = "AKTIF"
        ) AS jumlahAhli');
      $this->db->group_start();
        foreach($senaraiParlimen as $parlimen){
          $this->db->or_where('parlimen_tb.pt_bil', $parlimen->pt_bil);
        }
      $this->db->group_end();
      $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
      $query = $this->db->get('parlimen_tb');
      return $query->result();
    }

    public function senaraiRumusanDun($senaraiDun){
      $this->db->select('dun_tb.dun_nama AS kategoriNama');
      $this->db->select('(
        SELECT COUNT(*)
        FROM kelabmalaysiaku
        WHERE kelabmalaysiaku.kelabmalaysiaku_dun = dun_tb.dun_bil
        AND kelabmalaysiaku.kelabmalaysiaku_status_aktif = "AKTIF"
      ) AS jumlahKelab');
      $this->db->select('(
        SELECT COUNT(DISTINCT kelabmalaysiaku.kelabmalaysiaku_sekolah)
        FROM kelabmalaysiaku
        WHERE kelabmalaysiaku.kelabmalaysiaku_dun = dun_tb.dun_bil
        AND kelabmalaysiaku.kelabmalaysiaku_status_aktif = "AKTIF"
        ) AS jumlahSekolah');
      $this->db->select('(
        SELECT SUM(kelabmalaysiaku.kelabmalaysiaku_jumlah_ahli)
        FROM kelabmalaysiaku
        WHERE kelabmalaysiaku.kelabmalaysiaku_dun = dun_tb.dun_bil
        AND kelabmalaysiaku.kelabmalaysiaku_status_aktif = "AKTIF"
        ) AS jumlahAhli');
      $this->db->group_start();
        foreach($senaraiDun as $dun){
          $this->db->or_where('dun_tb.dun_bil', $dun->dun_bil);
        }
      $this->db->group_end();
      $this->db->order_by('dun_tb.dun_nama', 'ASC');
      $query = $this->db->get('dun_tb');
      return $query->result();
    }

    public function senaraiIkutDaerah($senaraiDaerah){
      if(!empty($senaraiDaerah)){
        foreach($senaraiDaerah as $daerah){
          $this->db->or_where('kelabmalaysiaku_daerah', $daerah->bil);
        }
        $query = $this->db->get($this->tableName);
        return $query->result();
      }
    }

    public function bilanganKelabmalaysiakuNegeri($senaraiNegeri)
    {
        $this->db->select('COUNT(*) AS jumlahKelabmalaysiaku');
        foreach($senaraiNegeri as $n){
            $this->db->where('kelabmalaysiaku_negeri', $n->nt_bil);
        }
        $query = $this->db->get($this->tableName);
      return $query->row();
    }

    public function senaraiIkutNamaNegeri($senaraiNegeri)
    {
        $this->db->select('*');
        foreach($senaraiNegeri as $n){
            $this->db->where('kelabmalaysiaku_negeri', $n->nt_bil);
        }
        $query = $this->db->get($this->tableName);
      return $query->result();
    }

    public function senaraiIkutNama(){
      $this->db->join('negeri_tb', 'negeri_tb.nt_bil = kelabmalaysiaku.kelabmalaysiaku_negeri', 'left');
      $this->db->join('daerah', 'daerah.bil = kelabmalaysiaku.kelabmalaysiaku_daerah', 'left');
      $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = kelabmalaysiaku.kelabmalaysiaku_parlimen', 'left');
      $this->db->join('dun_tb', 'dun_tb.dun_bil = kelabmalaysiaku.kelabmalaysiaku_dun', 'left');
      $this->db->join('pengguna_tb', 'pengguna_tb.bil = kelabmalaysiaku.kelabmalaysiaku_pengguna_bil', 'left');
      $this->db->order_by('kelabmalaysiaku.kelabmalaysiaku_nama', 'ASC');
      $query = $this->db->get($this->tableName);
      return $query->result();
    }

    public function keputusanCarian(){
      $this->db->join('negeri_tb', 'negeri_tb.nt_bil = kelabmalaysiaku.kelabmalaysiaku_negeri', 'left');
      $this->db->join('daerah', 'daerah.bil = kelabmalaysiaku.kelabmalaysiaku_daerah', 'left');
      $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = kelabmalaysiaku.kelabmalaysiaku_parlimen', 'left');
      $this->db->join('dun_tb', 'dun_tb.dun_bil = kelabmalaysiaku.kelabmalaysiaku_dun', 'left');
      $this->db->join('pengguna_tb', 'pengguna_tb.bil = kelabmalaysiaku.kelabmalaysiaku_pengguna_bil', 'left');
      $nama = $this->input->post('inputNama');
      if(!empty($nama)){
        $this->db->like('kelabmalaysiaku_nama', $nama);
      }
      $tarikhPenubuhan = $this->input->post('inputTarikhPenubuhan');
      if(!empty($tarikhPenubuhan)){
        $this->db->where('kelabmalaysiaku_tarikh_penubuhan', $tarikhPenubuhan);
      }
      $negeri = $this->input->post('inputNegeri');
      if(!empty($negeri)){
        $this->db->where('kelabmalaysiaku_negeri', $negeri);
      }
      $daerah = $this->input->post('inputDaerah');
      if(!empty($daerah)){
        $this->db->where('kelabmalaysiaku_daerah', $daerah);
      }
      $parlimen = $this->input->post('inputParlimen');
      if(!empty($parlimen)){
        $this->db->where('kelabmalaysiaku_parlimen', $parlimen);
      }
      $dun = $this->input->post('inputDun');
      if(!empty($dun)){
        $this->db->where('kelabmalaysiaku_dun', $dun);
      }
      $this->db->order_by('kelabmalaysiaku.kelabmalaysiaku_pengguna_waktu', 'DESC');
      $query = $this->db->get($this->tableName);
      return $query->result();
    }

    public function senaraiKelabmalaysiaku($senaraiNegeri, $senaraiDaerah, $senaraiParlimen, $senaraiDun){
      $this->db->join('negeri_tb', 'negeri_tb.nt_bil = kelabmalaysiaku.kelabmalaysiaku_negeri', 'left');
      $this->db->join('daerah', 'daerah.bil = kelabmalaysiaku.kelabmalaysiaku_daerah', 'left');
      $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = kelabmalaysiaku.kelabmalaysiaku_parlimen', 'left');
      $this->db->join('dun_tb', 'dun_tb.dun_bil = kelabmalaysiaku.kelabmalaysiaku_dun', 'left');
      $this->db->join('pengguna_tb', 'pengguna_tb.bil = kelabmalaysiaku.kelabmalaysiaku_pengguna_bil', 'left');
      foreach($senaraiNegeri as $negeri){
        $this->db->or_where('kelabmalaysiaku.kelabmalaysiaku_negeri', $negeri->nt_bil);
      }
      foreach($senaraiDaerah as $daerah){
        $this->db->or_where('kelabmalaysiaku.kelabmalaysiaku_daerah', $daerah->bil);
      }
      foreach($senaraiParlimen as $parlimen){
        $this->db->or_where('kelabmalaysiaku.kelabmalaysiaku_parlimen', $parlimen->pt_bil);
      }
      foreach($senaraiDun as $dun){
        $this->db->or_where('kelabmalaysiaku.kelabmalaysiaku_dun', $dun->dun_bil);
      }
      $this->db->order_by('kelabmalaysiaku.kelabmalaysiaku_pengguna_waktu', 'DESC');
      $query = $this->db->get($this->tableName);
      return $query->result();
    }

    public function senaraiKelabmalaysiakuPenuh(){
      $this->db->join('negeri_tb', 'negeri_tb.nt_bil = kelabmalaysiaku.kelabmalaysiaku_negeri', 'left');
      $this->db->join('daerah', 'daerah.bil = kelabmalaysiaku.kelabmalaysiaku_daerah', 'left');
      $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = kelabmalaysiaku.kelabmalaysiaku_parlimen', 'left');
      $this->db->join('dun_tb', 'dun_tb.dun_bil = kelabmalaysiaku.kelabmalaysiaku_dun', 'left');
      $this->db->join('pengguna_tb', 'pengguna_tb.bil = kelabmalaysiaku.kelabmalaysiaku_pengguna_bil', 'left');
      $this->db->order_by('kelabmalaysiaku.kelabmalaysiaku_pengguna_waktu', 'DESC');
      $query = $this->db->get($this->tableName);
      return $query->result();
    }

    public function padamKelabmalaysiaku($kelabmalaysiakuBil){
      $this->db->where('kelabmalaysiaku_bil', $kelabmalaysiakuBil);
      return $this->db->delete($this->tableName);
    }

    public function kemaskiniAmPost(){
      $data = array(
        'kelabmalaysiaku_nama' => $this->input->post('inputNama'),
        'kelabmalaysiaku_negeri' => $this->input->post('inputNegeriBil'),
        'kelabmalaysiaku_daerah' => $this->input->post('inputDaerahBil'),
        'kelabmalaysiaku_parlimen' => $this->input->post('inputParlimenBil'),
        'kelabmalaysiaku_dun' => $this->input->post('inputDunBil'),
        'kelabmalaysiaku_tarikh_penubuhan' => $this->input->post('inputTarikhPenubuhan'),
        'kelabmalaysiaku_pengguna_bil' => $this->input->post('inputPenggunaBil'),
        'kelabmalaysiaku_sekolah' => $this->input->post('inputNamaSekolah'),
        'kelabmalaysiaku_jenis_sekolah' => $this->input->post('inputJenisSekolah'),
        'kelabmalaysiaku_guru_penyelaras' => $this->input->post('inputNamaGuru'),
        'kelabmalaysiaku_jumlah_ahli' => $this->input->post('inputJumlahAhli'),
        'kelabmalaysiaku_status_aktif' => $this->input->post('inputStatusKelab')
      );
      $this->db->where('kelabmalaysiaku_bil', $this->input->post('inputKelabmalaysiakuBil'));
      return $this->db->update($this->tableName, $data);
    }

    public function kelabmalaysiaku($kelabmalaysiakuBil){
      $this->db->join('negeri_tb', 'negeri_tb.nt_bil = kelabmalaysiaku.kelabmalaysiaku_negeri', 'left');
      $this->db->join('daerah', 'daerah.bil = kelabmalaysiaku.kelabmalaysiaku_daerah', 'left');
      $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = kelabmalaysiaku.kelabmalaysiaku_parlimen', 'left');
      $this->db->join('dun_tb', 'dun_tb.dun_bil = kelabmalaysiaku.kelabmalaysiaku_dun', 'left');
      $this->db->where('kelabmalaysiaku_bil', $kelabmalaysiakuBil);
      $query = $this->db->get($this->tableName);
      return $query->row();
    }

    public function daftar($nama, $negeriBil, $daerahBil, $parlimenBil, $dunBil, $penggunaBil){
      $data = array(
        'kelabmalaysiaku_nama' => $nama,
        'kelabmalaysiaku_negeri' => $negeriBil,
        'kelabmalaysiaku_daerah' => $daerahBil,
        'kelabmalaysiaku_parlimen' => $parlimenBil,
        'kelabmalaysiaku_dun' => $dunBil,
        'kelabmalaysiaku_tarikh_penubuhan' => date('Y-m-d'),
        'kelabmalaysiaku_pengguna_bil' => $penggunaBil,
        'kelabmalaysiaku_pengguna_waktu' => date("Y-m-d H:i:s"),
        'kelabmalaysiaku_sekolah' => $this->input->post('inputNamaSekolah'),
        'kelabmalaysiaku_jenis_sekolah' => $this->input->post('inputJenisSekolah'),
        'kelabmalaysiaku_guru_penyelaras' => $this->input->post('inputNamaGuru'),
        'kelabmalaysiaku_jumlah_ahli' => $this->input->post('inputJumlahAhli'),
        'kelabmalaysiaku_status_aktif' => $this->input->post('inputStatusKelab'),
      );
      $return_data['insert_data'] = $this->db->insert($this->tableName, $data);
      $return_data['last_id'] = $this->db->insert_id();
      return $return_data;
    }

    public function update20240124(){
      $this->binaTable();
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableName) == FALSE){
            $fields = array(
                'kelabmalaysiaku_bil' => array(
                    'type' => 'BIGINT',
                    'null'=> FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
            ),
            'kelabmalaysiaku_nama' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
            ),
            'kelabmalaysiaku_negeri' => array(
              'type' => 'BIGINT',
              'null' => TRUE
            ),
            'kelabmalaysiaku_daerah' => array(
              'type' => 'BIGINT',
              'null' => TRUE
            ),
            'kelabmalaysiaku_parlimen' => array(
              'type' => 'BIGINT',
              'null' => TRUE
            ),
            'kelabmalaysiaku_dun' => array(
              'type' => 'BIGINT',
              'null' => TRUE
            ),
            'kelabmalaysiaku_tarikh_penubuhan' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'kelabmalaysiaku_sekolah' => array(
              'type' => 'TEXT',
              'null' => TRUE
            ),
            'kelabmalaysiaku_jenis_sekolah' => array(
              'type' => 'TEXT',
              'null' => TRUE
            ),
            'kelabmalaysiaku_guru_penyelaras' => array(
              'type' => 'TEXT',
              'null' => TRUE
            ),
            'kelabmalaysiaku_jumlah_ahli' => array(
              'type' => 'TEXT',
              'null' => TRUE
            ),
            'kelabmalaysiaku_status_aktif' => array(
              'type' => 'TEXT',
              'null' => TRUE
            ),
            'kelabmalaysiaku_pengguna_bil' => array(
              'type' => 'BIGINT',
              'null' => TRUE
            ),
            'kelabmalaysiaku_pengguna_waktu' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('kelabmalaysiaku_bil', TRUE);
            $this->dbforge->create_table($this->tableName, TRUE);
        }
    }
}