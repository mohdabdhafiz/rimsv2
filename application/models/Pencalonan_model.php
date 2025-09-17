<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencalonan_model extends CI_Model {

    protected $table = 'pencalonan_tb';

    public function senaraiKeputusanTidakRasmi($pilihanrayaBil){
        $columns = [
            "UPPER(parti_tb.parti_singkatan) AS partiSingkatan",
            "UPPER(parti_tb.parti_nama) AS partiNama",
            "foto_tb.foto_nama AS partiFoto",
            "COUNT(*) AS bilanganKerusi",
        ];
    
        // Select columns
        $this->db->select($columns);
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join("parti_tb", "parti_tb.parti_bil = pencalonan_tb.pencalonan_parti", "left");
        $this->db->join('foto_tb', 'foto_tb.foto_bil = parti_tb.parti_logo', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanrayaBil);
        $this->db->where('pencalonan_keputusan_tidak_rasmi', 'MENANG');
        $this->db->group_by('pencalonan_tb.pencalonan_parti');
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
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join("parti_tb", "parti_tb.parti_bil = pencalonan_tb.pencalonan_parti", "left");
        $this->db->join('foto_tb', 'foto_tb.foto_bil = parti_tb.parti_logo', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanrayaBil);
        $this->db->where('pencalonan_keputusan_sebenar', 'MENANG');
        $this->db->group_by('pencalonan_tb.pencalonan_parti');
        $this->db->order_by('bilanganKerusi', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiRumusanKeputusan($pilihanrayaBil){
        $columns = [
            "UPPER(dun_tb.dun_nama) AS kawasanNama",
            "(
                SELECT UPPER(p2.parti_singkatan) AS partiSingkatan
                FROM pencalonan_tb ppt1
                LEFT JOIN parti_tb p2 ON p2.parti_bil = ppt1.pencalonan_parti
                WHERE ppt1.pencalonan_dun = pencalonan_tb.pencalonan_dun
                AND ppt1.pencalonan_pilihanraya = pencalonan_tb.pencalonan_pilihanraya
                AND ppt1.pencalonan_jangkaan_japen = 'MENANG'
            ) AS partiJangkaanJapen",
            "(
                SELECT UPPER(p3.parti_singkatan) AS partiSingkatan
                FROM pencalonan_tb ppt2
                LEFT JOIN parti_tb p3 ON p3.parti_bil = ppt2.pencalonan_parti
                WHERE ppt2.pencalonan_dun = pencalonan_tb.pencalonan_dun
                AND ppt2.pencalonan_pilihanraya = pencalonan_tb.pencalonan_pilihanraya
                AND ppt2.pencalonan_keputusan_tidak_rasmi = 'MENANG'
            ) AS partiKeputusanTidakRasmi",
            "(
                SELECT UPPER(p4.parti_singkatan) AS partiSingkatan
                FROM pencalonan_tb ppt3
                LEFT JOIN parti_tb p4 ON p4.parti_bil = ppt3.pencalonan_parti
                WHERE ppt3.pencalonan_dun = pencalonan_tb.pencalonan_dun
                AND ppt3.pencalonan_pilihanraya = pencalonan_tb.pencalonan_pilihanraya
                AND ppt3.pencalonan_keputusan_sebenar = 'MENANG'
            ) AS partiKeputusanSebenar",
        ];
    
        // Select columns
        $this->db->select($columns);
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanrayaBil);        
        $this->db->group_by('pencalonan_tb.pencalonan_dun');
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
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join("parti_tb", "parti_tb.parti_bil = pencalonan_tb.pencalonan_parti", "left");
        $this->db->join('foto_tb', 'foto_tb.foto_bil = parti_tb.parti_logo', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanrayaBil);
        $this->db->where('pencalonan_jangkaan_japen', 'MENANG');
        $this->db->group_by('pencalonan_tb.pencalonan_parti');
        $this->db->order_by('bilanganKerusi', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiLockStatus($pilihanrayaBil){
        $columns = [
            "UPPER(dun_tb.dun_nama) AS kawasanNama",
            "UPPER(parti_tb.parti_singkatan) AS partiSingkatan",
            "UPPER(parti_tb.parti_nama) AS partiNama",
            "foto_tb.foto_nama AS partiFoto",
            "f2.foto_nama AS gambarNama",
            "UPPER(ahli_tb.ahli_nama) AS calonNama",
        ];
    
        // Select columns
        $this->db->select($columns);
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join("parti_tb", "parti_tb.parti_bil = pencalonan_tb.pencalonan_parti", "left");
        $this->db->join('foto_tb', 'foto_tb.foto_bil = parti_tb.parti_logo', 'left');
        $this->db->join('foto_tb f2', 'f2.foto_bil = ahli_tb.ahli_foto', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanrayaBil);        
        $this->db->where('pencalonan_jangkaan_japen', 'MENANG');
        $this->db->group_by('pencalonan_tb.pencalonan_dun');
        $this->db->order_by('kawasanNama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiPencalonanPru($pilihanrayaID)
    {

        $columns = [
            "pencalonan_tb.pencalonan_bil AS nomborSiri",
            "UPPER(dun_tb.dun_nama) AS kawasanNama",
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

        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->join('foto_tb', 'foto_tb.foto_bil = ahli_tb.ahli_foto', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanrayaID);
        $this->db->order_by('kawasanNama', 'ASC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function bilanganLaporanUtama(){
        $this->db->select("COUNT(*) AS bilanganLaporan");
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function tidak_rasmi($dunBil, $pilihanraya_bil){
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_dun', $dunBil);
        $this->db->where('pencalonan_keputusan_tidak_rasmi', 'MENANG');
        $query = $this->db->get($this->table);
        return $query->row();
    }
    

    public function rasmi($dun_bil, $pilihanraya_bil){
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_dun', $dun_bil);
        $this->db->where('pencalonan_keputusan_sebenar', 'MENANG');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function kosongRasmi($pilihanrayaBil, $dunBil)
    {
        $data = array(
            'pencalonan_keputusan_sebenar' => ''
        );
        $this->db->where('pencalonan_pilihanraya', $pilihanrayaBil);
        $this->db->where('pencalonan_dun', $dunBil);
        $this->db->update($this->table, $data);
    }

    public function kemaskiniMenangRasmi($calon_bil)
    {
        $data = array(
            'pencalonan_keputusan_sebenar' => 'MENANG'
        );
        $this->db->where('pencalonan_bil', $calon_bil);
        $this->db->update($this->table, $data);
    }

    public function senaraiParti($pilihanrayaBil){
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanrayaBil);
        $this->db->group_by('pencalonan_tb.pencalonan_parti');
        $this->db->order_by('parti_tb.parti_singkatan', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function calonDunGrading($dun_bil, $pilihanraya_bil, $tarikh)
    {
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->join('status_grading_tb', 'status_grading_tb.status_grading_pencalonan = pencalonan_tb.pencalonan_bil', 'left');
        $this->db->where('pencalonan_tb.pencalonan_dun', $dun_bil);
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('DATE(status_grading_tb.status_grading_tarikh)', $tarikh);
        $this->db->order_by('status_grading_tb.status_grading_peratus', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function calonGradingParti($partiBil, $pilihanrayaID)
    {
        $this->db->join('status_grading_tb', 'status_grading_tb.status_grading_pencalonan = pencalonan_tb.pencalonan_dun');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti');
        $this->db->where('pencalonan_tb.pencalonan_parti', $partiBil);
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanrayaID);
        $this->db->order_by('status_grading_tb.status_grading_tarikh', 'DESC');
        $this->db->order_by('status_grading_tb.status_grading_peratus', 'DESC');
        $this->db->group_by('status_grading_tb.status_grading_pencalonan');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function calon_undi($negeri, $pilihanraya_bil, $parti_bil)
    {
        $this->db->select('keputusan_dun_tb.kdt_undi');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun');
        $this->db->join('keputusan_dun_tb', 'keputusan_dun_tb.kdt_pencalonan = pencalonan_tb.pencalonan_bil');
        $this->db->where('dun_tb.dun_negeri', $negeri);
        $this->db->where('pencalonan_tb.pencalonan_parti', $parti_bil);
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_calon_jangkaan($parti_bil, $pilihanraya_bil){
        $this->db->select('dun_tb.dun_nama, dun_tb.dun_negeri');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun');
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_parti', $parti_bil);
        $this->db->where('pencalonan_jangkaan_japen', 'MENANG');
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_parti_jangkaan($pilihanraya_bil)
    {
        $this->db->select('pencalonan_tb.pencalonan_parti, COUNT(*) AS kira');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_tb.pencalonan_jangkaan_japen', 'MENANG');
        $this->db->group_by('pencalonan_tb.pencalonan_parti');
        $this->db->order_by('kira', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function semak_jangkaan($dun_bil, $pilihanraya_bil)
    {
        $this->db->select('pencalonan_bil');
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_dun', $dun_bil);
        $this->db->where('pencalonan_jangkaan_japen', 'MENANG');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function pilih_jangkaan(){
        $data = array(
            'pencalonan_jangkaan_japen' => 'MENANG'
        );
        $this->db->where('pencalonan_bil', $this->input->post('input_calon_bil'));
        $this->db->update($this->table, $data);
    }

    public function kosongkan_jangkaan(){
        $data = array(
            'pencalonan_jangkaan_japen' => ''
        );
        $this->db->where('pencalonan_dun', $this->input->post('input_dun_bil'));
        $this->db->where('pencalonan_pilihanraya', $this->input->post('input_pilihanraya_bil'));
        $this->db->update($this->table, $data);
    }

    public function kosongkan($calon_bil)
    {
        $data = array(
            'pencalonan_keputusan_tidak_rasmi' => ''
        );
        $this->db->where('pencalonan_bil', $calon_bil);
        $this->db->update($this->table, $data);
    }

    public function kemaskini_menang($calon_bil)
    {
        $data = array(
            'pencalonan_keputusan_tidak_rasmi' => 'MENANG'
        );
        $this->db->where('pencalonan_bil', $calon_bil);
        $this->db->update($this->table, $data);
    }

    public function partiMenangSebenar($pilihanraya_bil)
    {
        $this->db->select('pencalonan_parti, COUNT(*) as kiraMenang');
        $this->db->where('pencalonan_keputusan_sebenar', 'MENANG');
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->order_by('kiraMenang', 'DESC');
        $this->db->group_by('pencalonan_parti');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function parti_menang($pilihanraya_bil)
    {
        $this->db->select('pencalonan_parti, COUNT(*) as kira');
        $this->db->where('pencalonan_keputusan_tidak_rasmi', 'MENANG');
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->order_by('kira', 'DESC');
        $this->db->group_by('pencalonan_parti');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function jangkaan($dun_bil, $pilihanraya_bil)
    {
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_dun', $dun_bil);
        $this->db->where('pencalonan_jangkaan_japen', 'MENANG');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function menang_hari_ini($tarikh, $dun_bil, $pilihanraya_bil){
        $this->db->join('status_grading_tb', 'status_grading_tb.status_grading_pencalonan = pencalonan_tb.pencalonan_bil');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_tb.pencalonan_dun', $dun_bil);
        $this->db->where('status_grading_tb.status_grading_tarikh', $tarikh);
        $this->db->order_by('status_grading_tb.status_grading_tarikh', 'DESC');
        $this->db->order_by('status_grading_tb.status_grading_peratus', 'DESC');
        $this->db->group_by('pencalonan_tb.pencalonan_dun');
        $this->db->group_by('pencalonan_tb.pencalonan_parti');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    

    public function senaraiCalonDenganGrading($dun_bil, $pilihanrayaID)
    {
        $this->db->join('status_grading_tb', 'status_grading_tb.status_grading_pencalonan = pencalonan_tb.pencalonan_dun');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti');
        $this->db->where('pencalonan_tb.pencalonan_dun', $dun_bil);
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanrayaID);
        $this->db->order_by('status_grading_tb.status_grading_tarikh', 'DESC');
        $this->db->order_by('status_grading_tb.status_grading_peratus', 'DESC');
        $this->db->group_by('status_grading_tb.status_grading_pencalonan');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function senarai_calon_grading_tarikh($dun_bil, $pilihanrayaID, $tarikh)
    {
        $this->db->join('status_grading_tb', 'status_grading_tb.status_grading_pencalonan = pencalonan_tb.pencalonan_dun');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti');
        $this->db->where('pencalonan_tb.pencalonan_dun', $dun_bil);
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanrayaID);
        $this->db->where('status_grading_tb.status_grading_tarikh', $tarikh);
        $this->db->order_by('status_grading_tb.status_grading_tarikh', 'DESC');
        $this->db->order_by('status_grading_tb.status_grading_peratus', 'DESC');
        $this->db->group_by('status_grading_tb.status_grading_pencalonan');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function maklumat_calon($calon_bil)
    {
        $this->db->where('pencalonan_bil', $calon_bil);
        $query = $this->db->get($this->table);
        return $query->row(); 
    }

    public function menang($dun_bil, $pilihanraya_bil){
        $this->db->join('status_grading_tb', 'status_grading_tb.status_grading_pencalonan = pencalonan_tb.pencalonan_bil');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_tb.pencalonan_dun', $dun_bil);
        $this->db->order_by('status_grading_tb.status_grading_tarikh', 'DESC');
        $this->db->order_by('status_grading_tb.status_grading_peratus', 'DESC');
        $this->db->group_by('pencalonan_tb.pencalonan_dun');
        $this->db->group_by('pencalonan_tb.pencalonan_parti');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function menang_dun($pilihanraya_bil){
        $this->db->select('pencalonan_dun');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun');
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $this->db->group_by('pencalonan_dun');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_menang_parti_dun($parti_bil, $pilihanraya_bil){
        $this->db->select('pencalonan_tb.pencalonan_dun , MAX(status_grading_tb.status_grading_peratus) as peratus');
        $this->db->join('status_grading_tb', 'status_grading_tb.status_grading_pencalonan = pencalonan_tb.pencalonan_bil');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_tb.pencalonan_parti', $parti_bil);
        $this->db->where('status_grading_tb.status_grading_tarikh', date('Y-m-d'));
        $this->db->group_by('pencalonan_tb.pencalonan_dun');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_parti_pilihanraya($pilihanraya_bil)
    {
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->order_by('parti_tb.parti_singkatan', 'ASC');
        $this->db->group_by('pencalonan_parti');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function calon_dun($dun_bil, $pilihanraya_bil)
    {
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where('pencalonan_dun', $dun_bil);
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->order_by('pencalonan_parti', 'ASC');
        $this->db->order_by('pencalonan_dun', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_dun($pilihanraya_bil)
    {
        $this->db->select('pencalonan_dun');
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->group_by('pencalonan_dun');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function bilangan_penjuru($penjuru, $pilihanraya_bil)
    {   
        $bilangan_penjuru = 0;
        $senarai_dun = $this->senarai_dun($pilihanraya_bil);
        foreach($senarai_dun as $dun){
            if(count($this->calon_dun($dun->pencalonan_dun, $pilihanraya_bil)) == $penjuru){
                $bilangan_penjuru++;
            }
        }
        return $bilangan_penjuru;
    }

    public function senarai_calon_muda($umur, $pilihanraya_bil)
    {
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('ahli_tb.ahli_umur', $umur);
        $this->db->order_by('ahli_tb.ahli_umur', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result(); 
    }

    public function calon_muda($pilihanraya_bil)
    {
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->order_by('ahli_tb.ahli_umur', 'ASC');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function senarai_calon_tua($umur, $pilihanraya_bil)
    {
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('ahli_tb.ahli_umur', $umur);
        $this->db->order_by('ahli_tb.ahli_umur', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result(); 
    }

    public function calon_tua($pilihanraya_bil)
    {
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli');
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->order_by('ahli_tb.ahli_umur', 'DESC');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function penjuru($pilihanraya_bil)
    {   
        $this->db->select('pencalonan_tb.pencalonan_dun, COUNT(*) AS kira');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->group_by('pencalonan_tb.pencalonan_dun');
        $this->db->group_by('pencalonan_tb.pencalonan_pilihanraya');
        $query = $this->db->get($this->table);
        return $query->result();    
    }

    public function rumusan_ikut_negeri($pilihanraya_bil){
        $this->db->select('dun_tb.dun_negeri, COUNT(*) AS kira');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->group_by('dun_tb.dun_negeri');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_jantina($pilihanraya_bil){
        $this->db->select('ahli_tb.ahli_jantina, COUNT(*) AS kira');
        $this->db->group_by('ahli_tb.ahli_jantina');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_jantina2($pilihanraya_bil){
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
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_parti($pilihanraya_bil){
        $this->db->select('pencalonan_tb.pencalonan_parti, COUNT(*) AS kira');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->group_by('pencalonan_tb.pencalonan_parti');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiCalonPilihanraya($pilihanrayaID)
    {
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->join('foto_tb', 'foto_tb.foto_bil = ahli_tb.ahli_foto', 'left');
        $this->db->where('pencalonan_pilihanraya', $pilihanrayaID);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function senarai_calon_tanpa_grading($dun_bil, $pilihanrayaID)
    {
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli');
        $this->db->where('pencalonan_tb.pencalonan_dun', $dun_bil);
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanrayaID);
        $this->db->order_by('ahli_tb.ahli_nama', 'ASC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function tukar_parti()
    {
        $data = array(
            'pencalonan_parti' => $this->input->post('input_parti_bil')
        );
        $this->db->where('pencalonan_bil', $this->input->post('input_pencalonan_bil'));
        $this->db->update($this->table, $data);
    }

    public function pr_ahli_aktif($ahli_bil){
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya');
        $this->db->where('pilihanraya_tb.pilihanraya_jenis', 'DUN');
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'AKTIF');
        $this->db->where('pencalonan_tb.pencalonan_ahli', $ahli_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

	public function daftar($pencalonan_ahli)
	{
        $data = array(
            'pencalonan_dun' => $this->input->post('pencalonan_dun'),
            'pencalonan_ahli' => $pencalonan_ahli,
            'pencalonan_parti' => $this->input->post('pencalonan_parti'),
            'pencalonan_pilihanraya' => $this->input->post('pencalonan_pilihanraya'),
            'pencalonan_waktu' => date ('Y-m-d H:i:s'),
            'pencalonan_pengguna' => $this->input->post('pencalonan_pengguna')          
        );

        $ada = $this->semak_ada($data['pencalonan_dun'],$data['pencalonan_ahli']);

        if(count($ada) == 0){
            $return_data['insert_data'] = $this->db->insert($this->table, $data);
            $return_data['last_id'] = $this->db->insert_id();
            $return_data['status'] = TRUE;
        }else{
            foreach($ada as $a){
                $return_data['last_id'] = $a->dun_bil;
            }
            $return_data['status'] = FALSE;           
        }    
        return $return_data;
        
    }

    public function kira_semua(){
        return $this->db->count_all($this->table);
    }
    
    public function lihat_semua($limit, $start){
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function papar_semua(){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = pencalonan_tb.pencalonan_pengguna', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya', 'left');
        $this->db->join('foto_tb', 'foto_tb.foto_bil = ahli_tb.ahli_foto', 'left');

        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function daftar_calon($dunBil, $ahliBil, $partiBil, $penggunaBil, $penggunaNama, $pilihanrayaBil)
    {
        $data = array(
            'pencalonan_dun' => $dunBil,
            'pencalonan_ahli' => $ahliBil,
            'pencalonan_parti' => $partiBil,
            'pencalonan_pengguna' => $penggunaBil,
            'pencalonan_pilihanraya' => $pilihanrayaBil,
            'pencalonan_waktu' => date ('Y-m-d H:i:s')        
        );
        $return_data['insert_data'] = $this->db->insert($this->table, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    public function papar_ada($pilihanraya_bil, $dunBil, $ahliBil)
    {
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_dun', $dunBil);
        $this->db->where('pencalonan_ahli', $ahliBil);
        $query = $this->db->get($this->table);

        return $query->row();
    }

    public function senaraiCalon($dunBil, $pilihanrayaBil){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = pencalonan_tb.pencalonan_pengguna', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya', 'left');
        $this->db->join('foto_tb AS a', 'a.foto_bil = ahli_tb.ahli_foto', 'left');

        $this->db->where('pencalonan_dun', $dunBil);
        $this->db->where('pencalonan_pilihanraya', $pilihanrayaBil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiDUN($pilihanrayaBil)
    {
        $this->db->select('pencalonan_dun');
        $this->db->where('pencalonan_pilihanraya', $pilihanrayaBil);
        $this->db->group_by('pencalonan_dun');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function papar_ikut_negeri($negeri){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = pencalonan_tb.pencalonan_pengguna', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya', 'left');
        $this->db->join('foto_tb', 'foto_tb.foto_bil = ahli_tb.ahli_foto', 'left');

        $this->db->where('dun_tb.dun_negeri', $negeri);
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function papar_ikut_dun($dun_bil){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = pencalonan_tb.pencalonan_pengguna', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya', 'left');
        $this->db->join('foto_tb AS a', 'a.foto_bil = ahli_tb.ahli_foto', 'left');

        $this->db->where('dun_tb.dun_bil', $dun_bil);
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function papar($bil){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = pencalonan_tb.pencalonan_pengguna', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya', 'left');
        $this->db->join('foto_tb', 'foto_tb.foto_bil = ahli_tb.ahli_foto', 'left');
        $this->db->where('pencalonan_tb.pencalonan_bil', $bil);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function padam($bil){
        $this->db->where('pencalonan_bil', $bil);
        $this->db->delete($this->table);
    }

    public function padam_calon(){
        $this->db->where('pencalonan_bil', $this->input->post('inputCalonDunBil'));
        $this->db->delete($this->table);
    }

    public function padam_parti($parti_bil)
    {
        $this->db->where('pencalonan_parti', $parti_bil);
        $this->db->delete($this->table);
    }

    public function semak_ada($pencalonan_dun,$pencalonan_ahli){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = pencalonan_tb.pencalonan_pengguna', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya', 'left');
        $this->db->join('foto_tb', 'foto_tb.foto_bil = ahli_tb.ahli_foto', 'left');
        
        $this->db->where('pencalonan_tb.pencalonan_dun', $pencalonan_dun);
        $this->db->where('pencalonan_tb.pencalonan_ahli', $pencalonan_ahli);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function papar_ikut_pilihanraya_parti($pilihanraya_bil, $parti_bil){
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya', 'left');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_tb.pencalonan_parti', $parti_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function papar_ikut_pilihanraya($pilihanraya_bil){
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function papar_ikut_calon($pilihanraya_bil){
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->join('foto_tb', 'foto_tb.foto_bil = ahli_tb.ahli_foto', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikut_parti($parti_bil)
    {
        $this->db->where('pencalonan_parti', $parti_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kira_calon($pilihanraya_bil){
        $this->db->select('pencalonan_tb.pencalonan_parti');
        $this->db->select('parti_tb.parti_nama');
        $this->db->select('parti_tb.parti_singkatan');
        $this->db->select('parti_tb.parti_bil');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->group_by('pencalonan_tb.pencalonan_parti');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kira_parti_calon($parti_bil, $pilihanraya_bil){
        $this->db->where('pencalonan_parti', $parti_bil);
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_parti_calon($parti_bil, $pilihanraya_bil){
        $this->db->join('status_grading_tb', 'status_grading_tb.status_grading_pencalonan = pencalonan_tb.pencalonan_bil', 'left');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->where('pencalonan_tb.pencalonan_parti', $parti_bil);
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('status_grading_tb.status_grading_tarikh', date('Y-m-d'));
        $this->db->order_by('status_grading_peratus', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kira_calon_ikut_dun($pilihanraya_bil, $dun_bil){
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_tb.pencalonan_dun', $dun_bil);
        $query = $this->db->get($this->table);
        return count($query->result());
    }



    public function dun_pilihanraya($pilihanraya_bil){
        $this->db->select('pencalonan_tb.pencalonan_dun');
        $this->db->select('dun_tb.dun_nama');
        $this->db->select('dun_tb.dun_bil');
        $this->db->select('dun_tb.dun_negeri');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->group_by('pencalonan_tb.pencalonan_dun');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kira_penjuru($pilihanraya_bil){
        $this->load->model('dun_model');
        $penjuru = array();
        $kira_calon = count($this->papar_ikut_calon($pilihanraya_bil));
        $senarai_dun = $this->dun_model->papar_semua();
        $jumlah_dun = count($this->dun_pilihanraya($pilihanraya_bil));
        for($i = 1; $i<=$kira_calon; $i++){
            $penjuru[$i]['jumlah_calon'] = 0;
            $penjuru[$i]['bilangan_penjuru'] = $i;
            $penjuru[$i]['bilangan_dun'] = 0;
            foreach($senarai_dun as $dun){
                if($penjuru[$i]['bilangan_penjuru'] == $this->kira_calon_ikut_dun($pilihanraya_bil,$dun->dun_bil) ){
                    $penjuru[$i]['bilangan_dun']++;
                    $penjuru[$i]['jumlah_calon'] = $penjuru[$i]['jumlah_calon'] + $penjuru[$i]['bilangan_penjuru'];
                }
                
            }
            $penjuru[$i]['peratusan'] = (sprintf("%.2f", ($penjuru[$i]['bilangan_dun']/$jumlah_dun)*100)).'%';
        }
            
        
        
        return $penjuru;
    }

    public function umur_tua($pilihanraya_bil){
        $this->db->select_max('ahli_tb.ahli_umur');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function papar_umur_tua($pilihanraya_bil){
        
        foreach($this->umur_tua($pilihanraya_bil) as $u){
            $tua = $u->ahli_umur;
        }
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join('foto_tb', 'foto_tb.foto_bil = ahli_tb.ahli_foto', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where('ahli_tb.ahli_umur', $tua);
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function umur_muda($pilihanraya_bil){
        $this->db->select_min('ahli_tb.ahli_umur');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function papar_umur_muda($pilihanraya_bil){
        
        foreach($this->umur_muda($pilihanraya_bil) as $u){
            $muda = $u->ahli_umur;
        }
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join('foto_tb', 'foto_tb.foto_bil = ahli_tb.ahli_foto', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where('ahli_tb.ahli_umur', $muda);
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kira_jantina($pilihanraya_bil, $jantina){
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('ahli_tb.ahli_jantina', $jantina);
        $query = $this->db->get($this->table);
        return count($query->result());
    }

    public function kira_calon_umur($pilihanraya_bil, $mula, $tamat){
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('ahli_tb.ahli_umur >= ', $mula);
        $this->db->where('ahli_tb.ahli_umur <= ', $tamat);
        $query = $this->db->get($this->table);
        return count($query->result());
    }

    public function julat_umur($pilihanraya_bil){
        $kira_calon = count($this->papar_ikut_calon($pilihanraya_bil));

        //Kategori 1 = 60 ke atas
        foreach($this->umur_tua($pilihanraya_bil) as $u){
            $tua = $u->ahli_umur;
        }
        if(empty($tua) || $tua < 60){
            $tua = "100";
        }
        $calon = 0;
        $calon = $this->kira_calon_umur($pilihanraya_bil, 60, $tua);
        $julat_umur[4]['deskripsi_1'] = "60 ke atas";
        $julat_umur[4]['bil_calon'] = $calon;
        if(!empty($kira_calon)){
            $julat_umur[4]['peratus'] = (sprintf ("%.2f", ($calon/$kira_calon)*100.0)).'%';
        }else{
            $julat_umur[4]['peratus'] = '0%';
        }

        //Kategori 2 = 50-59
        $calon = 0;
        $calon = $this->kira_calon_umur($pilihanraya_bil, 50, 59);
        $julat_umur[3]['deskripsi_1'] = "50-59";
        $julat_umur[3]['bil_calon'] = $calon;
        if(!empty($kira_calon)){
            $julat_umur[3]['peratus'] = (sprintf ("%.2f", ($calon/$kira_calon)*100.0)).'%';
        }else{
            $julat_umur[3]['peratus'] = '0%';
        }

        //Kategori 3 = 40-49
        $calon = 0;
        $calon = $this->kira_calon_umur($pilihanraya_bil, 40, 49);
        $julat_umur[2]['deskripsi_1'] = "40-49";
        $julat_umur[2]['bil_calon'] = $calon;
        if(!empty($kira_calon)){
            $julat_umur[2]['peratus'] = (sprintf ("%.2f", ($calon/$kira_calon)*100.0)).'%';
        }else{
            $julat_umur[2]['peratus'] = '0%';
        }

        //Kategori 4 = 31-39
        $calon = 0;
        $calon = $this->kira_calon_umur($pilihanraya_bil, 31, 39);
        $julat_umur[1]['deskripsi_1'] = "31-39";
        $julat_umur[1]['bil_calon'] = $calon;
        if(!empty($kira_calon)){
            $julat_umur[1]['peratus'] = (sprintf ("%.2f", ($calon/$kira_calon)*100.0)).'%';
        }else{
            $julat_umur[1]['peratus'] = '0%';
        }

        //Kategori 5 = 21-30
        $calon = 0;
        $calon = $this->kira_calon_umur($pilihanraya_bil, 21, 30);
        $julat_umur[0]['deskripsi_1'] = "21-30";
        $julat_umur[0]['bil_calon'] = $calon;
        if(!empty($kira_calon)){
            $julat_umur[0]['peratus'] = (sprintf ("%.2f", ($calon/$kira_calon)*100.0)).'%';
        }else{
            $julat_umur[0]['peratus'] = '0%';
        }

        return $julat_umur;
    }

    public function clear_semasa_japen($pilihanraya_bil, $dun_bil){
        $data = array('pencalonan_jangkaan_japen' => '');
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_dun', $dun_bil);
        $this->db->update($this->table, $data);
    }

    public function pilih_japen(){
        $pencalonan_bil = $this->input->post('pencalonan_bil');
        $data = array('pencalonan_jangkaan_japen' => 'MENANG');
        $this->db->where('pencalonan_bil', $pencalonan_bil);
        $this->db->update($this->table, $data);
    }

    public function clear_semasa_tidak_rasmi($pilihanraya_bil, $dun_bil){
        $data = array('pencalonan_keputusan_tidak_rasmi' => '');
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_dun', $dun_bil);
        $this->db->update($this->table, $data);
    }

    public function tidak_rasmi_2(){
        $pencalonan_bil = $this->input->post('pencalonan_bil');
        $data = array('pencalonan_keputusan_tidak_rasmi' => 'MENANG');
        $this->db->where('pencalonan_bil', $pencalonan_bil);
        $this->db->update($this->table, $data);
    }

    public function clear_semasa_rasmi($pilihanraya_bil, $dun_bil){
        $data = array('pencalonan_keputusan_sebenar' => '');
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_dun', $dun_bil);
        $this->db->update($this->table, $data);
    }

    public function pilih_rasmi(){
        $pencalonan_bil = $this->input->post('pencalonan_bil');
        $data = array('pencalonan_keputusan_sebenar' => 'MENANG');
        $this->db->where('pencalonan_bil', $pencalonan_bil);
        $this->db->update($this->table, $data);
    }

    public function kira_penyandang($parti_bil, $pilihanraya_bil){
        $this->db->where('pencalonan_parti', $parti_bil);
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_keputusan_sebenar', 'MENANG');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kira_calon_sahaja($parti_bil, $pilihanraya_bil){
        $this->db->where('pencalonan_parti', $parti_bil);
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_keputusan_sebenar', '');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function penglibatan_parti($parti_bil){
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where('pencalonan_parti', $parti_bil);
        $this->db->group_by('pencalonan_pilihanraya');
        $this->db->order_by('pilihanraya_tahun', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_calon_bertanding($pilihanraya_bil, $dun_bil){
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_dun', $dun_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_rumusan_calon($pilihanraya_bil, $dun_bil){
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->join('status_grading_tb', 'status_grading_tb.status_grading_pencalonan = pencalonan_tb.pencalonan_bil', 'left');
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_dun', $dun_bil);
        $this->db->where('status_grading_tb.status_grading_tarikh', date('Y-m-d'));
        $this->db->order_by('status_grading_tb.status_grading_peratus', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    public function senarai_rumusan_calon2($pilihanraya_bil, $dun_bil, $tarikh){
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->join('status_grading_tb', 'status_grading_tb.status_grading_pencalonan = pencalonan_tb.pencalonan_bil', 'left');
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_dun', $dun_bil);
        $this->db->where('status_grading_tb.status_grading_tarikh', $tarikh);
        $this->db->order_by('status_grading_tb.status_grading_peratus', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function bilangan_calon($dun_bil, $pilihanraya_bil){
        $this->db->where('pencalonan_dun', $dun_bil);
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function calon($pilihanraya_bil, $dun_bil){
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('status_grading_tb', 'status_grading_tb.status_grading_pencalonan = pencalonan_tb.pencalonan_bil', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where('pencalonan_dun', $dun_bil);
        $this->db->where('pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->order_by('status_grading_peratus', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_parti($pilihanraya_bil)
    {
        $this->db->select('pencalonan_tb.pencalonan_parti');
        $this->db->select('parti_tb.parti_nama');
        $this->db->select('parti_tb.parti_warna');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->group_by('pencalonan_tb.pencalonan_parti');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function calonUnik()
    {
        $this->db->select('pencalonan_tb.pencalonan_ahli');
        $this->db->group_by('pencalonan_tb.pencalonan_ahli');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function cari_kuat($pencalonan_bil, $kekuatan, $deskripsi)
    {
        $this->db->where('pdtt_pencalonan_bil', $pencalonan_bil);
        $query = $this->db->get('pencalonan_dun_tambahan_tb');
        return $query->result();
    }

    public function tambah_kuat($data)
    {
        $this->db->insert('pencalonan_dun_tambahan_tb', $data);
    }

    public function senarai_dun_ikut_nama($nama)
    {  
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli');
        $this->db->join('dun_tb', 'dun_tb.dun_nama = pencalonan_tb.pencalonan_dun');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti');
        $this->db->where('ahli_tb.ahli_nama', $nama);
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'AKTIF');
        $query = $this->db->get($this->table);
        return $query->result();
    }

}
