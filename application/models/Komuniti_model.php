<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komuniti_model extends CI_Model {

    private $tableName = "komuniti";

    public function bilanganLaporan(){
      $query = $this->db->get($this->tableName);
      $bilanganLaporan = $query->num_rows();
      return $bilanganLaporan;
  }

    public function senaraiKomunitiDaerah($daerahSenarai){
      $this->db->select('komuniti.komuniti_bil AS komunitiBil');
      $this->db->select('komuniti.komuniti_nama AS komunitiNama');
      $this->db->select('komuniti.komuniti_daerah AS daerahBil');
      $this->db->select('daerah.nama AS komunitiDaerah');
      $this->db->select('parlimen_tb.pt_nama AS komunitiParlimen');
      $this->db->select('dun_tb.dun_nama AS komunitiDun');
      $this->db->join('daerah', 'daerah.bil = komuniti.komuniti_daerah', 'left');
      $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = komuniti.komuniti_parlimen', 'left');
      $this->db->join('dun_tb', 'dun_tb.dun_bil = komuniti.komuniti_dun', 'left');
      $this->db->or_group_start();
      foreach($daerahSenarai as $daerah){
        $this->db->or_where('komuniti.komuniti_daerah', $daerah->bil);
      }
      $this->db->group_end();
      $this->db->order_by('komunitiDaerah', 'ASC');
      $this->db->order_by('komunitiParlimen', 'ASC');
      $this->db->order_by('komunitiDun', 'ASC');
      $this->db->order_by('komunitiNama', 'ASC');
      $query = $this->db->get($this->tableName);
      return $query->result();
    }

    public function senaraiDaerahParlimenDun($daerahSenarai, $parlimenSenarai, $dunSenarai){
      $this->db->join('negeri_tb', 'negeri_tb.nt_bil = komuniti.komuniti_negeri', 'left');
      $this->db->join('daerah', 'daerah.bil = komuniti.komuniti_daerah', 'left');
      $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = komuniti.komuniti_parlimen', 'left');
      $this->db->join('dun_tb', 'dun_tb.dun_bil = komuniti.komuniti_dun', 'left');
      if(!empty($daerahSenarai)){
        $this->db->or_group_start();
        foreach($daerahSenarai as $daerah){
          $this->db->or_where('komuniti.komuniti_daerah', $daerah->bil);
        }
        $this->db->group_end();
      }
      if(!empty($parlimenSenarai)){
        $this->db->or_group_start();
        foreach($parlimenSenarai as $parlimen){
          $this->db->or_where('komuniti.komuniti_parlimen', $parlimen->pt_bil);
        }
        $this->db->group_end();
      }
      if(!empty($dunSenarai)){
        $this->db->or_group_start();
        foreach($dunSenarai as $dun){
          $this->db->or_where('komuniti.komuniti_dun', $dun->dun_bil);
        }
        $this->db->group_end();
      }
      $this->db->order_by('daerah.nama', 'ASC');
      $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
      $this->db->order_by('dun_tb.dun_nama', 'ASC');
      $query = $this->db->get($this->tableName);
      return $query->result();
    }
    
    public function rumusanKomunitiDunPeranan($perananBil, $penggunaBil){
      $this->db->select('dn.dun_nama as namaDun');
      $this->db->select('(
          SELECT COUNT(*)
          FROM komuniti AS k
          WHERE k.komuniti_dun = dn.dun_bil
          ) AS jumlahKomuniti');
      $this->db->select('(
          SELECT COUNT(*)
          FROM komuniti AS k
          WHERE k.komuniti_dun = dn.dun_bil 
          AND k.komuniti_pengguna_bil = '.$penggunaBil.'
          ) AS jumlahIkutPelapor');
      $this->db->join('tugas_dun_tb AS tugas', 'tugas.tdt_dun_bil = dn.dun_bil', 'left');
      $this->db->where('tugas.tdt_peranan_bil', $perananBil);
      $this->db->order_by('dn.dun_nama', 'ASC');
      $query = $this->db->get('dun_tb AS dn');
      return $query->result();
  }

    public function rumusanKomunitiDaerahPeranan($perananBil, $penggunaBil){
      $this->db->select('d.nama as namaDaerah');
      $this->db->select('(
          SELECT COUNT(*)
          FROM komuniti AS k
          WHERE k.komuniti_daerah = d.bil
          ) AS jumlahKomuniti');
      $this->db->select('(
          SELECT COUNT(*)
          FROM komuniti AS k
          WHERE k.komuniti_daerah = d.bil 
          AND k.komuniti_pengguna_bil = '.$penggunaBil.'
          ) AS jumlahIkutPelapor');
      $this->db->join('tugas_daerah AS tugas', 'tugas.daerah_bil = d.bil', 'left');
      $this->db->where('tugas.peranan_bil', $perananBil);
      $this->db->order_by('d.nama', 'ASC');
      $query = $this->db->get('daerah AS d');
      return $query->result();
  }

    public function rumusanKomunitiParlimenPeranan($perananBil, $penggunaBil){
      $this->db->select('pt.pt_nama as namaParlimen');
      $this->db->select('(
          SELECT COUNT(*)
          FROM komuniti AS k
          WHERE k.komuniti_parlimen = pt.pt_bil
          ) AS jumlahKomuniti');
      $this->db->select('(
          SELECT COUNT(*)
          FROM komuniti AS k
          WHERE k.komuniti_parlimen = pt.pt_bil 
          AND k.komuniti_pengguna_bil = '.$penggunaBil.'
          ) AS jumlahIkutPelapor');
      $this->db->join('tugas_parlimen_tb AS tugas', 'tugas.tpt_parlimen_bil = pt.pt_bil', 'left');
      $this->db->where('tugas.tpt_peranan_bil', $perananBil);
      $this->db->order_by('pt.pt_nama', 'ASC');
      $query = $this->db->get('parlimen_tb AS pt');
      return $query->result();
  }

    public function ada($nama, $negeriBil, $daerahBil, $parlimenBil, $dunBil, $penggunaBil){
      $this->db->where('komuniti_nama', $nama);
      $this->db->where('komuniti_negeri', $negeriBil);
      $this->db->where('komuniti_daerah', $daerahBil);
      $this->db->where('komuniti_parlimen', $parlimenBil);
      $this->db->where('komuniti_dun', $dunBil);
      $this->db->where('komuniti_pengguna_bil', $penggunaBil);
      $query = $this->db->get($this->tableName);
      return $query->row();
    }

    public function bilanganKomunitiPelapor($penggunaBil){
      $this->db->select('COUNT(*) AS bilangan');
      $this->db->where('komuniti.komuniti_pengguna_bil', $penggunaBil);
      $query = $this->db->get($this->tableName);
      return $query->row();
    }

    public function senaraiKomunitiPelapor($penggunaBil){
      $this->db->join('negeri_tb', 'negeri_tb.nt_bil = komuniti.komuniti_negeri', 'left');
      $this->db->join('daerah', 'daerah.bil = komuniti.komuniti_daerah', 'left');
      $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = komuniti.komuniti_parlimen', 'left');
      $this->db->join('dun_tb', 'dun_tb.dun_bil = komuniti.komuniti_dun', 'left');
      $this->db->join('pengguna_tb', 'pengguna_tb.bil = komuniti.komuniti_pengguna_bil', 'left');
      $this->db->where('komuniti.komuniti_pengguna_bil', $penggunaBil);
      $this->db->order_by('komuniti.komuniti_pengguna_waktu', 'DESC');
      $query = $this->db->get($this->tableName);
      return $query->result();
    }

    public function senaraiIkutDaerah($senaraiDaerah){
      $this->db->join('negeri_tb', 'negeri_tb.nt_bil = komuniti.komuniti_negeri', 'left');
      $this->db->join('daerah', 'daerah.bil = komuniti.komuniti_daerah', 'left');
      $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = komuniti.komuniti_parlimen', 'left');
      $this->db->join('dun_tb', 'dun_tb.dun_bil = komuniti.komuniti_dun', 'left');
      $this->db->join('pengguna_tb', 'pengguna_tb.bil = komuniti.komuniti_pengguna_bil', 'left');
      $this->db->group_start();
      foreach($senaraiDaerah as $daerah){
        $this->db->or_where('komuniti_daerah', $daerah->bil);
      }
      $this->db->group_end();
      $query = $this->db->get($this->tableName);
      return $query->result();
    }

    public function bilanganKomunitiNegeri($senaraiNegeri)
    {
      $this->db->select('COUNT(*) AS jumlahKomuniti');
      foreach($senaraiNegeri as $n){
          $this->db->or_group_start();
            $this->db->where('komuniti_negeri', $n->nt_bil);
          $this->db->group_end();
        }
      $query = $this->db->get($this->tableName);
      return $query->row();
    }

    public function senaraiIkutNamaNegeri($senaraiNegeri)
    {
        $this->db->select('*');
        foreach($senaraiNegeri as $n){
            $this->db->where('komuniti_negeri', $n->nt_bil);
        }
        $query = $this->db->get($this->tableName);
      return $query->result();
    }

    public function senaraiIkutNama(){
      $this->db->join('negeri_tb', 'negeri_tb.nt_bil = komuniti.komuniti_negeri', 'left');
      $this->db->join('daerah', 'daerah.bil = komuniti.komuniti_daerah', 'left');
      $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = komuniti.komuniti_parlimen', 'left');
      $this->db->join('dun_tb', 'dun_tb.dun_bil = komuniti.komuniti_dun', 'left');
      $this->db->join('pengguna_tb', 'pengguna_tb.bil = komuniti.komuniti_pengguna_bil', 'left');
      $this->db->order_by('komuniti.komuniti_nama', 'ASC');
      $query = $this->db->get($this->tableName);
      return $query->result();
    }

    public function keputusanCarian(){
      $this->db->join('negeri_tb', 'negeri_tb.nt_bil = komuniti.komuniti_negeri', 'left');
      $this->db->join('daerah', 'daerah.bil = komuniti.komuniti_daerah', 'left');
      $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = komuniti.komuniti_parlimen', 'left');
      $this->db->join('dun_tb', 'dun_tb.dun_bil = komuniti.komuniti_dun', 'left');
      $this->db->join('pengguna_tb', 'pengguna_tb.bil = komuniti.komuniti_pengguna_bil', 'left');
      $nama = $this->input->post('inputNama');
      if(!empty($nama)){
        $this->db->like('komuniti_nama', $nama);
      }
      $tarikhPenubuhan = $this->input->post('inputTarikhPenubuhan');
      if(!empty($tarikhPenubuhan)){
        $this->db->where('komuniti_tarikh_penubuhan', $tarikhPenubuhan);
      }
      $negeri = $this->input->post('inputNegeri');
      if(!empty($negeri)){
        $this->db->where('komuniti_negeri', $negeri);
      }
      $daerah = $this->input->post('inputDaerah');
      if(!empty($daerah)){
        $this->db->where('komuniti_daerah', $daerah);
      }
      $parlimen = $this->input->post('inputParlimen');
      if(!empty($parlimen)){
        $this->db->where('komuniti_parlimen', $parlimen);
      }
      $dun = $this->input->post('inputDun');
      if(!empty($dun)){
        $this->db->where('komuniti_dun', $dun);
      }
      $this->db->order_by('komuniti.komuniti_pengguna_waktu', 'DESC');
      $query = $this->db->get($this->tableName);
      return $query->result();
    }

    public function mengikutCarian($senaraiNegeri, $senaraiDaerah, $senaraiParlimen, $senaraiDun){
      $tempKomunitiNama = $this->input->post('inputNama');
      $tempTarikhPenubuhan = $this->input->post("inputTarikhPenubuhan");
      $tempNegeriBil = $this->input->post("inputNegeri");
      $tempDaerahBil = $this->input->post("inputDaerah");
      $tempParlimenBil = $this->input->post("inputParlimen");
      $tempDunBil = $this->input->post("inputDun");
      $this->db->join('negeri_tb', 'negeri_tb.nt_bil = komuniti.komuniti_negeri', 'left');
      $this->db->join('daerah', 'daerah.bil = komuniti.komuniti_daerah', 'left');
      $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = komuniti.komuniti_parlimen', 'left');
      $this->db->join('dun_tb', 'dun_tb.dun_bil = komuniti.komuniti_dun', 'left');
      $this->db->join('pengguna_tb', 'pengguna_tb.bil = komuniti.komuniti_pengguna_bil', 'left');
      if(empty($tempNegeriBil)){
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
          $this->db->or_where('komuniti.komuniti_negeri', $negeri->nt_bil);
        }
        $this->db->group_end();
      }elseif(!empty($tempNegeriBil)){
        $this->db->where("komuniti.komuniti_negeri", $tempNegeriBil);
      }
      if(empty($tempDaerahBil)){
        $this->db->group_start();
        foreach($senaraiDaerah as $daerah){
          $this->db->or_where('komuniti.komuniti_daerah', $daerah->bil);
        }
        $this->db->group_end();
      }elseif(!empty($tempDaerahBil)){
        $this->db->where("komuniti.komuniti_daerah", $tempDaerahBil);
      }
      if(empty($tempParlimenBil)){
        $this->db->group_start();
        foreach($senaraiParlimen as $parlimen){
          $this->db->or_where('komuniti.komuniti_parlimen', $parlimen->pt_bil);
        }
        $this->db->group_end();
      }elseif(!empty($tempParlimenBil)){
        $this->db->where("komuniti.komuniti_parlimen", $tempParlimenBil);
      }
      if(empty($tempDunBil)){
        $this->db->group_start();
        foreach($senaraiDun as $dun){
          $this->db->or_where('komuniti.komuniti_dun', $dun->dun_bil);
        }
        $this->db->group_end();
      }elseif(!empty($tempDunBil)){
        $this->db->where("komuniti.komuniti_dun", $tempDunBil);
      }
      if(!empty($tempKomunitiNama)){
        $this->db->like("komuniti.komuniti_nama", $tempKomunitiNama);
      }
      if(!empty($tempTarikhPenubuhan)){
        $this->db->where("komuniti.komuniti_tarikh_penubuhan", $tempTarikhPenubuhan);
      }
      $this->db->order_by('komuniti.komuniti_pengguna_waktu', 'DESC');
      $query = $this->db->get($this->tableName);
      return $query->result();
    }

    public function senaraiKomuniti($senaraiNegeri, $senaraiDaerah, $senaraiParlimen, $senaraiDun){
      $this->db->join('negeri_tb', 'negeri_tb.nt_bil = komuniti.komuniti_negeri', 'left');
      $this->db->join('daerah', 'daerah.bil = komuniti.komuniti_daerah', 'left');
      $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = komuniti.komuniti_parlimen', 'left');
      $this->db->join('dun_tb', 'dun_tb.dun_bil = komuniti.komuniti_dun', 'left');
      $this->db->join('pengguna_tb', 'pengguna_tb.bil = komuniti.komuniti_pengguna_bil', 'left');
      foreach($senaraiNegeri as $negeri){
        $this->db->or_where('komuniti.komuniti_negeri', $negeri->nt_bil);
      }
      foreach($senaraiDaerah as $daerah){
        $this->db->or_where('komuniti.komuniti_daerah', $daerah->bil);
      }
      foreach($senaraiParlimen as $parlimen){
        $this->db->or_where('komuniti.komuniti_parlimen', $parlimen->pt_bil);
      }
      foreach($senaraiDun as $dun){
        $this->db->or_where('komuniti.komuniti_dun', $dun->dun_bil);
      }
      $this->db->order_by('komuniti.komuniti_pengguna_waktu', 'DESC');
      $query = $this->db->get($this->tableName);
      return $query->result();
    }

    public function senaraiKomunitiPenuh(){
      $this->db->join('negeri_tb', 'negeri_tb.nt_bil = komuniti.komuniti_negeri', 'left');
      $this->db->join('daerah', 'daerah.bil = komuniti.komuniti_daerah', 'left');
      $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = komuniti.komuniti_parlimen', 'left');
      $this->db->join('dun_tb', 'dun_tb.dun_bil = komuniti.komuniti_dun', 'left');
      $this->db->join('pengguna_tb', 'pengguna_tb.bil = komuniti.komuniti_pengguna_bil', 'left');
      $this->db->order_by('komuniti.komuniti_pengguna_waktu', 'DESC');
      $query = $this->db->get($this->tableName);
      return $query->result();
    }

    public function padamKomuniti($komunitiBil){
      $this->db->where('komuniti_bil', $komunitiBil);
      return $this->db->delete($this->tableName);
    }

    public function kemaskiniAmPost(){
      $data = array(
        'komuniti_nama' => $this->input->post('inputNama'),
        'komuniti_negeri' => $this->input->post('inputNegeriBil'),
        'komuniti_daerah' => $this->input->post('inputDaerahBil'),
        'komuniti_parlimen' => $this->input->post('inputParlimenBil'),
        'komuniti_dun' => $this->input->post('inputDunBil'),
        'komuniti_tarikh_penubuhan' => $this->input->post('inputTarikhPenubuhan'),
        'komuniti_pengguna_bil' => $this->input->post('inputPenggunaBil')
      );
      $this->db->where('komuniti_bil', $this->input->post('inputKomunitiBil'));
      return $this->db->update($this->tableName, $data);
    }

    public function komuniti($komunitiBil){
      $this->db->join('negeri_tb', 'negeri_tb.nt_bil = komuniti.komuniti_negeri', 'left');
      $this->db->join('daerah', 'daerah.bil = komuniti.komuniti_daerah', 'left');
      $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = komuniti.komuniti_parlimen', 'left');
      $this->db->join('dun_tb', 'dun_tb.dun_bil = komuniti.komuniti_dun', 'left');
      $this->db->where('komuniti_bil', $komunitiBil);
      $query = $this->db->get($this->tableName);
      return $query->row();
    }

    public function daftar($nama, $negeriBil, $daerahBil, $parlimenBil, $dunBil, $penggunaBil){
      $data = array(
        'komuniti_nama' => $nama,
        'komuniti_negeri' => $negeriBil,
        'komuniti_daerah' => $daerahBil,
        'komuniti_parlimen' => $parlimenBil,
        'komuniti_dun' => $dunBil,
        'komuniti_tarikh_penubuhan' => date('Y-m-d'),
        'komuniti_pengguna_bil' => $penggunaBil,
        'komuniti_pengguna_waktu' => date("Y-m-d H:i:s")
      );
      $return_data['insert_data'] = $this->db->insert($this->tableName, $data);
      $return_data['last_id'] = $this->db->insert_id();
      return $return_data;
    }

    public function update20231218(){
      $this->binaTable();
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableName) == FALSE){
            $fields = array(
                'komuniti_bil' => array(
                    'type' => 'BIGINT',
                    'null'=> FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
            ),
            'komuniti_nama' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
            ),
            'komuniti_negeri' => array(
              'type' => 'BIGINT',
              'null' => TRUE
            ),
            'komuniti_daerah' => array(
              'type' => 'BIGINT',
              'null' => TRUE
            ),
            'komuniti_parlimen' => array(
              'type' => 'BIGINT',
              'null' => TRUE
            ),
            'komuniti_dun' => array(
              'type' => 'BIGINT',
              'null' => TRUE
            ),
            'komuniti_tarikh_penubuhan' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'komuniti_pengguna_bil' => array(
              'type' => 'BIGINT',
              'null' => TRUE
            ),
            'komuniti_pengguna_waktu' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('komuniti_bil', TRUE);
            $this->dbforge->create_table($this->tableName, TRUE);
        }
    }
}