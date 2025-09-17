<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencalonan_parlimen_model extends CI_Model {

    protected $table = 'pencalonan_parlimen_tb';

    public function senaraiKeputusanTidakRasmi($pilihanrayaBil){
        $columns = [
            "UPPER(parti_tb.parti_singkatan) AS partiSingkatan",
            "UPPER(parti_tb.parti_nama) AS partiNama",
            "foto_tb.foto_nama AS partiFoto",
            "COUNT(*) AS bilanganKerusi",
        ];
    
        // Select columns
        $this->db->select($columns);
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', 'left');
        $this->db->join("parti_tb", "parti_tb.parti_bil = pencalonan_parlimen_tb.pencalonan_parlimen_partiBil", "left");
        $this->db->join('foto_tb', 'foto_tb.foto_bil = parti_tb.parti_logo', 'left');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanrayaBil);
        $this->db->where('pencalonan_parlimen_keputusan_tidak_rasmi', 'MENANG');
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_partiBil');
        $this->db->order_by('bilanganKerusi', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiKeputusanRasmi($pilihanrayaBil){
        $columns = [
            "UPPER(parti_tb.parti_singkatan) AS partiSingkatan",
            "UPPER(parti_tb.parti_nama) AS partiNama",
            "foto_tb.foto_nama AS partiFoto",
            "COUNT(*) AS bilanganKerusi",
        ];
    
        // Select columns
        $this->db->select($columns);
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', 'left');
        $this->db->join("parti_tb", "parti_tb.parti_bil = pencalonan_parlimen_tb.pencalonan_parlimen_partiBil", "left");
        $this->db->join('foto_tb', 'foto_tb.foto_bil = parti_tb.parti_logo', 'left');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanrayaBil);
        $this->db->where('pencalonan_parlimen_keputusan_sebenar', 'MENANG');
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_partiBil');
        $this->db->order_by('bilanganKerusi', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiRumusanKeputusan($pilihanrayaBil){
        $columns = [
            "UPPER(parlimen_tb.pt_nama) AS kawasanNama",
            "(
                SELECT UPPER(p2.parti_singkatan) AS partiSingkatan
                FROM pencalonan_parlimen_tb ppt1
                LEFT JOIN parti_tb p2 ON p2.parti_bil = ppt1.pencalonan_parlimen_partiBil
                WHERE ppt1.pencalonan_parlimen_parlimenBil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil
                AND ppt1.pencalonan_parlimen_pilihanrayaBil = pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil
                AND ppt1.pencalonan_parlimen_jangkaan_japen = 'MENANG'
            ) AS partiJangkaanJapen",
            "(
                SELECT UPPER(p3.parti_singkatan) AS partiSingkatan
                FROM pencalonan_parlimen_tb ppt2
                LEFT JOIN parti_tb p3 ON p3.parti_bil = ppt2.pencalonan_parlimen_partiBil
                WHERE ppt2.pencalonan_parlimen_parlimenBil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil
                AND ppt2.pencalonan_parlimen_pilihanrayaBil = pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil
                AND ppt2.pencalonan_parlimen_keputusan_tidak_rasmi = 'MENANG'
            ) AS partiKeputusanTidakRasmi",
            "(
                SELECT UPPER(p4.parti_singkatan) AS partiSingkatan
                FROM pencalonan_parlimen_tb ppt3
                LEFT JOIN parti_tb p4 ON p4.parti_bil = ppt3.pencalonan_parlimen_partiBil
                WHERE ppt3.pencalonan_parlimen_parlimenBil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil
                AND ppt3.pencalonan_parlimen_pilihanrayaBil = pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil
                AND ppt3.pencalonan_parlimen_keputusan_sebenar = 'MENANG'
            ) AS partiKeputusanSebenar",
        ];
    
        // Select columns
        $this->db->select($columns);
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', 'left');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanrayaBil);        
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil');
        $this->db->order_by('kawasanNama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiRumusanLockStatus($pilihanrayaBil){
        $columns = [
            "UPPER(parti_tb.parti_singkatan) AS partiSingkatan",
            "UPPER(parti_tb.parti_nama) AS partiNama",
            "foto_tb.foto_nama AS partiFoto",
            "COUNT(*) AS bilanganKerusi",
        ];
    
        // Select columns
        $this->db->select($columns);
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', 'left');
        $this->db->join("parti_tb", "parti_tb.parti_bil = pencalonan_parlimen_tb.pencalonan_parlimen_partiBil", "left");
        $this->db->join('foto_tb', 'foto_tb.foto_bil = parti_tb.parti_logo', 'left');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanrayaBil);
        $this->db->where('pencalonan_parlimen_jangkaan_japen', 'MENANG');
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_partiBil');
        $this->db->order_by('bilanganKerusi', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiLockStatus($pilihanrayaBil){
        $columns = [
            "UPPER(parlimen_tb.pt_nama) AS kawasanNama",
            "UPPER(parti_tb.parti_singkatan) AS partiSingkatan",
            "UPPER(parti_tb.parti_nama) AS partiNama",
            "foto_tb.foto_nama AS partiFoto",
            "f2.foto_nama AS gambarNama",
            "UPPER(ahli_tb.ahli_nama) AS calonNama",
        ];
    
        // Select columns
        $this->db->select($columns);
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', 'left');
        $this->db->join("parti_tb", "parti_tb.parti_bil = pencalonan_parlimen_tb.pencalonan_parlimen_partiBil", "left");
        $this->db->join('foto_tb', 'foto_tb.foto_bil = parti_tb.parti_logo', 'left');
        $this->db->join('foto_tb f2', 'f2.foto_bil = ahli_tb.ahli_foto', 'left');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanrayaBil);        
        $this->db->where('pencalonan_parlimen_jangkaan_japen', 'MENANG');
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil');
        $this->db->order_by('kawasanNama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function bilanganLaporanUtama(){
        $this->db->select("COUNT(*) AS bilanganLaporan");
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function senarai($senaraiParlimen){
        $this->db->select("(pencalonan_parlimen_tb.pencalonan_parlimen_bil) AS nomborSiri");
        $this->db->select("(pilihanraya_tb.pilihanraya_nama) AS pilihanrayaNama");
        $this->db->select("(pilihanraya_tb.pilihanraya_bil) AS pilihanrayaBil");
        $this->db->select("(ahli_tb.ahli_nama) AS calonNama");
        $this->db->select("(ahli_tb.ahli_umur) AS calonUmur");
        $this->db->select("(ahli_tb.ahli_bil) AS ahliBil");
        $this->db->select("(parti_tb.parti_nama) AS partiNama");
        $this->db->select("(parlimen_tb.pt_nama) AS parlimenNama");
        $this->db->select("(SELECT foto_tb.foto_nama FROM foto_tb WHERE foto_tb.foto_bil = ahli_tb.ahli_foto) AS calonFoto");
        $this->db->select("pencalonan_parlimen_tb.pencalonan_parlimen_keputusan_sebenar AS calonMenang");
        $this->db->select("pilihanraya_tb.pilihanraya_status AS pruAktif");
        $this->db->select("pilihanraya_tb.pilihanraya_penamaan_calon AS penamaanCalon");
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', 'left');
        $this->db->join("ahli_tb", "ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil", "left");
        $this->db->join("parti_tb", "parti_tb.parti_bil = pencalonan_parlimen_tb.pencalonan_parlimen_partiBil", "left");
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', 'left');
        $this->db->group_start();
        foreach($senaraiParlimen as $parlimen){
            $this->db->or_where('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', $parlimen->pt_bil);
        }
        $this->db->group_end();
        $this->db->order_by('pilihanraya_tb.pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function bilanganCalon($senaraiParlimen){
        $this->db->select("COUNT(*) AS bilangan");
        $this->db->group_start();
        foreach($senaraiParlimen as $parlimen){
            $this->db->or_where('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', $parlimen->pt_bil);
        }
        $this->db->group_end();
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function senaraiCalonHarian($parlimenBil, $pilihanrayaBil, $tarikh){
        $this->db->select("ahli_tb.ahli_nama AS namaCalon");
        $this->db->select("pencalonan_parlimen_tb.pencalonan_parlimen_bil AS nomborSiriCalon");
        $this->db->select("pencalonan_parlimen_tb.pencalonan_parlimen_waktu AS tarikhDaftar");
        $this->db->select("pelaporAhli.nama_penuh AS pelaporCalon");
        $this->db->select("parti_tb.parti_nama AS partiNama");
        $this->db->select("parti_tb.parti_singkatan AS partiSingkatan");
        $this->db->select("ahli_tb.ahli_umur AS calonUmur");
        $this->db->select("ahli_tb.ahli_jantina AS calonJantina");
        $this->db->select("(SELECT statusGrading.sgpt_peratus FROM status_grading_parlimen_tb AS statusGrading WHERE statusGrading.sgpt_pencalonan = nomborSiriCalon AND statusGrading.sgpt_parlimen_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil AND statusGrading.sgpt_tarikh = $tarikh ORDER BY statusGrading.sgpt_bil DESC LIMIT 1) AS gradingSokongan");
        $this->db->join("ahli_tb", "ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil", "left");
        $this->db->join("pengguna_tb AS pelaporAhli", "pelaporAhli.bil = pencalonan_parlimen_tb.pencalonan_parlimen_penggunaBil", "left");
        $this->db->join("parti_tb", "parti_tb.parti_bil = pencalonan_parlimen_tb.pencalonan_parlimen_partiBil", "left");
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', $parlimenBil);
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanrayaBil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function calonParlimenGrading($parlimenBil, $pilihanraya_bil, $tarikh)
    {
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_parlimen_tb.pencalonan_parlimen_partiBil', 'left');
        $this->db->join('status_grading_parlimen_tb', 'status_grading_parlimen_tb.sgpt_pencalonan = pencalonan_parlimen_tb.pencalonan_parlimen_bil', 'left');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', $parlimenBil);
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->where('DATE(status_grading_parlimen_tb.sgpt_tarikh)', $tarikh);
        $this->db->order_by('status_grading_parlimen_tb.sgpt_peratus', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function calon_undi($negeri, $pilihanraya_bil, $parti_bil)
    {
        $this->db->select('keputusan_parlimen_tb.kpt_undi');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil');
        $this->db->join('keputusan_parlimen_tb', 'keputusan_parlimen_tb.kpt_pencalonan = pencalonan_parlimen_tb.pencalonan_parlimen_bil');
        $this->db->where('parlimen_tb.pt_negeri', $negeri);
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_partiBil', $parti_bil);
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rasmi($parlimen_bil, $pilihanraya_bil){
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->where('pencalonan_parlimen_parlimenBil', $parlimen_bil);
        $this->db->where('pencalonan_parlimen_keputusan_sebenar', 'MENANG');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function tidak_rasmi($parlimen_bil, $pilihanraya_bil){
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->where('pencalonan_parlimen_parlimenBil', $parlimen_bil);
        $this->db->where('pencalonan_parlimen_keputusan_tidak_rasmi', 'MENANG');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function senarai_calon_jangkaan($parti_bil, $pilihanraya_bil){
        $this->db->select('parlimen_tb.pt_nama, parlimen_tb.pt_negeri');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil');
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->where('pencalonan_parlimen_partiBil', $parti_bil);
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_jangkaan_japen', 'MENANG');
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_parti_jangkaan($pilihanraya_bil)
    {
        $this->db->select('pencalonan_parlimen_tb.pencalonan_parlimen_partiBil, COUNT(*) AS kira');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_jangkaan_japen', 'MENANG');
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_partiBil');
        $this->db->order_by('kira', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function pilih_jangkaan(){
        $data = array(
            'pencalonan_parlimen_jangkaan_japen' => 'MENANG'
        );
        $this->db->where('pencalonan_parlimen_bil', $this->input->post('input_calon_bil'));
        $this->db->update($this->table, $data);
    }

    public function kosongkan_jangkaan(){
        $data = array(
            'pencalonan_parlimen_jangkaan_japen' => ''
        );
        $this->db->where('pencalonan_parlimen_parlimenBil', $this->input->post('input_parlimen_bil'));
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $this->input->post('input_pilihanraya_bil'));
        $this->db->update($this->table, $data);
    }

    public function kosongkan($calon_bil)
    {
        $data = array(
            'pencalonan_parlimen_keputusan_tidak_rasmi' => ''
        );
        $this->db->where('pencalonan_parlimen_bil', $calon_bil);
        $this->db->update($this->table, $data);
    }

    public function kemaskini_menang($calon_bil)
    {
        $data = array(
            'pencalonan_parlimen_keputusan_tidak_rasmi' => 'MENANG'
        );
        $this->db->where('pencalonan_parlimen_bil', $calon_bil);
        $this->db->update($this->table, $data);
    }

    public function parti_menang($pilihanraya_bil)
    {
        $this->db->select('pencalonan_parlimen_partiBil, COUNT(*) as kira');
        $this->db->where('pencalonan_parlimen_keputusan_tidak_rasmi', 'MENANG');
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->order_by('kira', 'DESC');
        $this->db->group_by('pencalonan_parlimen_partiBil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function jangkaan($parlimen_bil, $pilihanraya_bil)
    {
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->where('pencalonan_parlimen_parlimenBil', $parlimen_bil);
        $this->db->where('pencalonan_parlimen_jangkaan_japen', 'MENANG');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function semak_jangkaan($parlimen_bil, $pilihanraya_bil)
    {
        $this->db->select('pencalonan_parlimen_bil');
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->where('pencalonan_parlimen_parlimenBil', $parlimen_bil);
        $this->db->where('pencalonan_parlimen_jangkaan_japen', 'MENANG');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function menang_hari_ini($tarikh, $parlimen_bil, $pilihanraya_bil){
        $this->db->join('status_grading_parlimen_tb', 'status_grading_parlimen_tb.sgpt_pencalonan = pencalonan_parlimen_tb.pencalonan_parlimen_bil');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_parlimen_tb.pencalonan_parlimen_partiBil');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', $parlimen_bil);
        $this->db->where('status_grading_parlimen_tb.sgpt_tarikh', $tarikh);
        $this->db->group_by('status_grading_parlimen_tb.sgpt_pencalonan');
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil');
        $this->db->order_by('status_grading_parlimen_tb.sgpt_tarikh', 'DESC');
        $this->db->order_by('status_grading_parlimen_tb.sgpt_peratus', 'DESC');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function calon_ikut_parti($parti_bil, $pilihanraya_bil){
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->where('pencalonan_parlimen_partiBil', $parti_bil);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function parti_bertanding_aktif(){
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_parlimen_tb.pencalonan_parlimen_partiBil');
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'AKTIF');
        $this->db->where('pilihanraya_tb.pilihanraya_jenis', 'PARLIMEN');
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_partiBil');
        $this->db->order_by('parti_tb.parti_nama', 'ASC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function senarai_calon_grading_tarikh($parlimenID, $pilihanrayaID, $tarikh)
    {
        $this->checkTableExists($this->table);
        $this->db->join('status_grading_parlimen_tb', 'status_grading_parlimen_tb.sgpt_pencalonan = pencalonan_parlimen_tb.pencalonan_parlimen_bil');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_parlimen_tb.pencalonan_parlimen_partiBil');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', $parlimenID);
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanrayaID);
        $this->db->where('status_grading_parlimen_tb.sgpt_tarikh', $tarikh);
        $this->db->order_by('status_grading_parlimen_tb.sgpt_tarikh', 'DESC');
        $this->db->order_by('status_grading_parlimen_tb.sgpt_peratus', 'DESC');
        $this->db->group_by('status_grading_parlimen_tb.sgpt_pencalonan');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function calon($calon_bil)
    {
        $this->db->where('pencalonan_parlimen_bil', $calon_bil);
        $query = $this->db->get($this->table);
        return $query->row(); 
    }

    public function menang($parlimen_bil, $pilihanraya_bil){
        $this->db->join('status_grading_parlimen_tb', 'status_grading_parlimen_tb.sgpt_pencalonan = pencalonan_parlimen_tb.pencalonan_parlimen_bil');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', $parlimen_bil);
        $this->db->order_by('status_grading_parlimen_tb.sgpt_tarikh', 'DESC');
        $this->db->order_by('status_grading_parlimen_tb.sgpt_peratus', 'DESC');
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil');
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_partiBil');
        $query = $this->db->get($this->table);
        return $query->row();
    }
    
    public function senarai_menang_parti_parlimen($parti_bil, $pilihanraya_bil){
        $this->db->select('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil , MAX(status_grading_parlimen_tb.sgpt_peratus) as peratus');
        $this->db->join('status_grading_parlimen_tb', 'status_grading_parlimen_tb.sgpt_pencalonan = pencalonan_parlimen_tb.pencalonan_parlimen_bil');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_partiBil', $parti_bil);
        $this->db->order_by('status_grading_parlimen_tb.sgpt_tarikh', 'DESC');
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function menang_parlimen($pilihanraya_bil){
        $this->db->select('pencalonan_parlimen_parlimenBil');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil');
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $this->db->group_by('pencalonan_parlimen_parlimenBil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_parti_pilihanraya($pilihanraya_bil)
    {
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_parlimen_tb.pencalonan_parlimen_partiBil');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->order_by('parti_tb.parti_singkatan', 'ASC');
        $this->db->group_by('pencalonan_parlimen_partiBil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function semua_negeri($negeri, $pilihanraya_bil){
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil');
        $this->db->where('parlimen_tb.pt_negeri', $negeri);
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->order_by('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', 'ASC');
        $this->db->order_by('pencalonan_parlimen_tb.pencalonan_parlimen_partiBil', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function calon_parlimen($parlimen_bil, $pilihanraya_bil)
    {
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil');
        $this->db->where('pencalonan_parlimen_parlimenBil', $parlimen_bil);
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->order_by('pencalonan_parlimen_partiBil', 'ASC');
        $this->db->order_by('pencalonan_parlimen_waktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_jantina($pilihanraya_bil){
        $this->db->select('ahli_tb.ahli_jantina, COUNT(*) AS kira');
        $this->db->group_by('ahli_tb.ahli_jantina');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_umur($pilihanraya_bil){
        $this->db->select('ahli_tb.ahli_umur, COUNT(*) AS kira');
        $this->db->group_by('ahli_tb.ahli_umur');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_parti($pilihanraya_bil){
        $this->db->select('pencalonan_parlimen_tb.pencalonan_parlimen_partiBil, COUNT(*) AS kira');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_partiBil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_negeri($pilihanraya_bil){
        $this->db->select('parlimen_tb.pt_negeri, COUNT(*) AS kira');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->group_by('parlimen_tb.pt_negeri');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function semua($pilihanraya_bil)
    {
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function jantina_parlimen($jantina)
    {
        $this->db->select('pencalonan_parlimen_parlimenBil, COUNT(*) AS kira');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil');
        $this->db->where('ahli_tb.ahli_jantina', $jantina);
        $this->db->group_by('pencalonan_parlimen_parlimenBil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function calon_umur($umur)
    {
        $this->db->select('pencalonan_parlimen_parlimenBil, COUNT(*) AS kira');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil');
        $this->db->where('ahli_tb.ahli_umur', $umur);
        $this->db->group_by('pencalonan_parlimen_parlimenBil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function calon_parti($parti_bil, $pilihanraya_bil)
    {
        $this->db->select('pencalonan_parlimen_parlimenBil, COUNT(*) AS kira');
        $this->db->where('pencalonan_parlimen_partiBil', $parti_bil);
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->group_by('pencalonan_parlimen_parlimenBil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function tukar_parti()
    {
        $data = array(
            'pencalonan_parlimen_partiBil' => $this->input->post('input_parti_bil')
        );
        $this->db->where('pencalonan_parlimen_bil', $this->input->post('input_pencalonan_parlimen_bil'));
        $this->db->update($this->table, $data);
    }

    public function pr_ahli_aktif($ahli_bil){
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil');
        $this->db->where('pilihanraya_tb.pilihanraya_jenis', 'PARLIMEN');
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'AKTIF');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil', $ahli_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    private function checkTableExists($checkTable)
    {   
        $this->load->dbforge();
        if($this->db->table_exists($checkTable) == FALSE){
            $fields = array(
                'pencalonan_parlimen_bil' => array(
                        'type' => 'BIGINT',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'pencalonan_parlimen_parlimenBil' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'pencalonan_parlimen_parlimenNama' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'pencalonan_parlimen_ahliBil' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'pencalonan_parlimen_ahliNama' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'pencalonan_parlimen_partiBil' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'pencalonan_parlimen_penggunaBil' => array(
                        'type' => 'BIGINT',
                        'null' => TRUE
                ),
                'pencalonan_parlimen_penggunaNama' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
                ),
                'pencalonan_parlimen_pilihanrayaBil' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'pencalonan_parlimen_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                ),
                'pencalonan_parlimen_jangkaan_japen' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
                ),
                'pencalonan_parlimen_keputusan_tidak_rasmi' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
                ),
                'pencalonan_parlimen_keputusan_sebenar' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('pencalonan_parlimen_bil', TRUE);
            $this->dbforge->create_table($this->table, TRUE);
        }
    }

    public function papar_ada($pilihanraya_bil, $parlimenBil, $ahliBil)
    {
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->where('pencalonan_parlimen_parlimenBil', $parlimenBil);
        $this->db->where('pencalonan_parlimen_ahliBil', $ahliBil);
        $query = $this->db->get($this->table);

        return $query->row();
    }

    public function daftar_calon($parlimenBil, $parlimenNama, $ahliBil, $ahliNama, $partiBil, $penggunaBil, $penggunaNama, $pilihanrayaBil)
    {
        $this->checkTableExists($this->table);
        $data = array(
            'pencalonan_parlimen_parlimenBil' => $parlimenBil,
            'pencalonan_parlimen_parlimenNama' => $parlimenNama,
            'pencalonan_parlimen_ahliBil' => $ahliBil,
            'pencalonan_parlimen_ahliNama' => $ahliNama,
            'pencalonan_parlimen_partiBil' => $partiBil,
            'pencalonan_parlimen_penggunaBil' => $penggunaBil,
            'pencalonan_parlimen_penggunaNama' => $penggunaNama,
            'pencalonan_parlimen_pilihanrayaBil' => $pilihanrayaBil,
            'pencalonan_parlimen_waktu' => date ('Y-m-d H:i:s')        
        );
        $return_data['insert_data'] = $this->db->insert($this->table, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    public function senaraiCalon($parlimenID, $pilihanrayaID)
    {
        $this->checkTableExists($this->table);
        $this->db->join('status_grading_parlimen_tb', 'status_grading_parlimen_tb.sgpt_pencalonan = pencalonan_parlimen_tb.pencalonan_parlimen_bil', 'left');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', $parlimenID);
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanrayaID);
        $this->db->where('status_grading_parlimen_tb.sgpt_tarikh', date("Y-m-d"));
        $this->db->order_by('status_grading_parlimen_tb.sgpt_peratus', 'DESC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function senaraiCalonDenganGrading($parlimenID, $pilihanrayaID)
    {
        $this->db->join('status_grading_parlimen_tb', 'status_grading_parlimen_tb.sgpt_pencalonan = pencalonan_parlimen_tb.pencalonan_parlimen_bil');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_parlimen_tb.pencalonan_parlimen_partiBil');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', $parlimenID);
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanrayaID);
        $this->db->order_by('status_grading_parlimen_tb.sgpt_tarikh', 'DESC');
        $this->db->order_by('status_grading_parlimen_tb.sgpt_peratus', 'DESC');
        $this->db->group_by('status_grading_parlimen_tb.sgpt_pencalonan');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function senarai_calon_tanpa_grading($parlimenID, $pilihanrayaID)
    {
        $this->checkTableExists($this->table);
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', $parlimenID);
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanrayaID);
        $this->db->order_by('ahli_tb.ahli_nama', 'ASC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function senaraiPencalonanPru($pilihanrayaID)
    {

        $columns = [
            "pencalonan_parlimen_tb.pencalonan_parlimen_bil AS nomborSiri",
            "UPPER(parlimen_tb.pt_nama) AS kawasanNama",
            "foto_tb.foto_nama AS gambarNama",
            "UPPER(ahli_tb.ahli_nama) AS calonNama",
            "UPPER(parti_tb.parti_nama) AS namaParti",
            "UPPER(ahli_tb.ahli_umur) AS calonUmur",
            "UPPER(ahli_tb.ahli_jantina) AS calonJantina",
            "UPPER(ahli_tb.ahli_pendidikan) AS calonPendidikan",
            "UPPER(ahli_tb.ahli_kaum) AS calonKaum"
        ];
    
        // Select columns
        $this->db->select($columns);

        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_parlimen_tb.pencalonan_parlimen_partiBil', 'left');
        $this->db->join('foto_tb', 'foto_tb.foto_bil = ahli_tb.ahli_foto', 'left');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanrayaID);
        $this->db->order_by('kawasanNama', 'ASC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function senaraiCalonPilihanraya($pilihanrayaID)
    {
        $this->checkTableExists($this->table);
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_parlimen_tb.pencalonan_parlimen_partiBil', 'left');
        $this->db->join('foto_tb', 'foto_tb.foto_bil = ahli_tb.ahli_foto', 'left');
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pilihanrayaID);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function kemaskiniCalon()
    {
        $data = array(
            'pencalonan_parlimen_parlimenBil' => $this->input->post('inputCalonParlimenBil'),
            'pencalonan_parlimen_parlimenNama' => $this->input->post('inputCalonParlimenNama'),
            'pencalonan_parlimen_ahliBil' => $this->input->post('inputCalonAhliBil'),
            'pencalonan_parlimen_ahliNama' => $this->input->post('inputCalonAhliNama'),
            'pencalonan_parlimen_partiBil' => $this->input->post('inputCalonPartiBil'),
            'pencalonan_parlimen_partiNama' => $this->input->post('inputCalonPartiNama'),
            'pencalonan_parlimen_penggunaBil' => $this->input->post('inputCalonPenggunaBil'),
            'pencalonan_parlimen_penggunaNama' => $this->input->post('inputCalonPenggunaNama'),
            'pencalonan_parlimen_pilihanrayaBil' => $this->input->post('inputCalonPilihanrayaBil'),
            'pencalonan_parlimen_waktu' => date ('Y-m-d H:i:s')        
        );
        $this->db->where('pencalonan_parlimen_bil', $this->input->post('inputCalonBil'));
        $this->db->update($this->table, $data);
    }

    public function padam()
    {
        $this->db->where('pencalonan_parlimen_bil', $this->input->post('inputCalonParlimenBil'));
        $this->db->delete($this->table);
    }

    public function padam_parlimen($parlimen_bil, $pilihanraya_bil)
    {
        $this->db->where('pencalonan_parlimen_parlimenBil', $parlimen_bil);
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->delete($this->table);
    }

    public function senaraiParlimen($pilihanrayaID)
    {
        $this->checkTableExists($this->table);
        $this->db->select('pencalonan_parlimen_parlimenBil, pencalonan_parlimen_parlimenNama');
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pilihanrayaID);
        $this->db->group_by('pencalonan_parlimen_parlimenNama');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function calonUnik()
    {

        $this->checkTableExists($this->table);
        $this->db->select('pencalonan_parlimen_ahliBil');
        $this->db->group_by('pencalonan_parlimen_ahliBil');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function senaraiSemuaCalon()
    {
        $this->checkTableExists($this->table);
        $this->db->order_by('pencalonan_parlimen_ahliNama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_negeri($negeri)
    {
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil');
        $this->db->order_by('pencalonan_parlimen_ahliNama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_parlimen($pr_bil)
    {
        $this->db->select('pencalonan_parlimen_parlimenBil');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil');
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pr_bil);
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $this->db->group_by('pencalonan_parlimen_parlimenBil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function cari_kuat($pencalonan_parlimen_bil, $kekuatan, $deskripsi)
    {
        $this->db->where('pptt_pencalonan_bil', $pencalonan_parlimen_bil);
        $query = $this->db->get('pencalonan_parlimen_tambahan_tb');
        return $query->result();
    }

    public function tambah_kuat($data)
    {
        $this->db->insert('pencalonan_parlimen_tambahan_tb', $data);
    }

    public function kira_calon_ikut_parlimen($pilihanraya_bil, $parlimen_bil){
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', $parlimen_bil);
        $query = $this->db->get($this->table);
        return count($query->result());
    }

    public function papar_ikut_calon($pilihanraya_bil){
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', 'left');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function parlimen_pilihanraya($pilihanraya_bil){
        $this->db->select('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil');
        $this->db->select('parlimen_tb.pt_nama');
        $this->db->select('parlimen_tb.pt_bil');
        $this->db->select('parlimen_tb.pt_negeri');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', 'left');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', 'left');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil');
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kira_penjuru($pilihanraya_bil){
        $this->load->model('parlimen_model');
        $penjuru = array();
        $kira_calon = count($this->papar_ikut_calon($pilihanraya_bil));
        $senarai_parlimen = $this->parlimen_model->semuaParlimen();
        $jumlah_parlimen = count($this->parlimen_pilihanraya($pilihanraya_bil));
        for($i = 1; $i<=$kira_calon; $i++){
            $penjuru[$i]['jumlah_calon'] = 0;
            $penjuru[$i]['bilangan_penjuru'] = $i;
            $penjuru[$i]['bilangan_parlimen'] = 0;
            foreach($senarai_parlimen as $parlimen){
                if($penjuru[$i]['bilangan_penjuru'] == $this->kira_calon_ikut_parlimen($pilihanraya_bil,$parlimen->pt_bil) ){
                    $penjuru[$i]['bilangan_parlimen']++;
                    $penjuru[$i]['jumlah_calon'] = $penjuru[$i]['jumlah_calon'] + $penjuru[$i]['bilangan_penjuru'];
                }
                
            }
            $penjuru[$i]['peratusan'] = (sprintf("%.2f", ($penjuru[$i]['bilangan_parlimen']/$jumlah_parlimen)*100)).'%';
        }
            
        
        
        return $penjuru;
    }

    public function penjuru_bilangan($pilihanraya_bil)
    {  
        $this->db->select('COUNT(pencalonan_parlimen_parlimenBil) as kiraan_parlimen');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil');
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil');
        $query = $this->db->get($this->table);
        return $query->result();  
    }

    public function penjuru($pilihanraya_bil)
    {   
        $this->db->select('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil, COUNT(*) AS kira');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil');
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil');
        $query = $this->db->get($this->table);
        return $query->result();    
    }

    public function bilangan_penjuru($penjuru, $pilihanraya_bil)
    {   
        $bilangan_penjuru = 0;
        $parlimen = $this->senarai_parlimen($pilihanraya_bil);
        foreach($parlimen as $par){
            if(count($this->calon_parlimen($par->pencalonan_parlimen_parlimenBil, $pilihanraya_bil)) == $penjuru){
                $bilangan_penjuru++;
            }
        }
        return $bilangan_penjuru;
    }

    public function senarai_calon_tua($umur, $pilihanraya_bil)
    {
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil');
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->where('ahli_tb.ahli_umur', $umur);
        $this->db->order_by('ahli_tb.ahli_umur', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result(); 
    }

    public function calon_tua($pilihanraya_bil)
    {
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil');
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->order_by('ahli_tb.ahli_umur', 'DESC');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function senarai_calon_muda($umur, $pilihanraya_bil)
    {
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil');
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->where('ahli_tb.ahli_umur', $umur);
        $this->db->order_by('ahli_tb.ahli_umur', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result(); 
    }

    public function calon_muda($pilihanraya_bil)
    {
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil');
        $this->db->where('pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->order_by('ahli_tb.ahli_umur', 'ASC');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function bilangan_penjuru2($penjuru, $pilihanraya_bil)
    {   
        $this->db->select('pencalonan_parlimen_tb.pencalonan_parlimen_bil, COUNT(*) AS kira');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->having('COUNT(pencalonan_parlimen_tb.pencalonan_parlimen_bil)', $penjuru);
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil');
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function senarai_parti($pilihanraya_bil)
    {
        $this->db->select('pencalonan_parlimen_tb.pencalonan_parlimen_partiBil, COUNT(*) AS kira');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->group_by('pencalonan_parlimen_tb.pencalonan_parlimen_partiBil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_parlimen_ikut_nama($nama)
    {  
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_parlimen_tb.pencalonan_parlimen_partiBil');
        $this->db->where('ahli_tb.ahli_nama', $nama);
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'AKTIF');
        $query = $this->db->get($this->table);
        return $query->result();
    }

}