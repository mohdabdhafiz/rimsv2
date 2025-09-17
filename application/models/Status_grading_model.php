<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_grading_model extends CI_Model {

    protected $table = 'status_grading_tb';
    protected $tableParlimen = 'status_grading_parlimen_tb';

    public function senaraiGradingParlimen(){
        $this->db->select('status_grading_parlimen_tb.sgpt_bil AS nomborSiri');
        $this->db->select('status_grading_parlimen_tb.sgpt_tarikh AS tarikhGrading');
        $this->db->select('status_grading_parlimen_tb.sgpt_peratus AS peratusSokongan');
        $this->db->select('ahli_tb.ahli_nama AS namaCalon');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = status_grading_parlimen_tb.sgpt_pencalonan', 'left');
        $this->db->order_by('tarikhGrading', 'DESC');
        $query = $this->db->get($this->tableParlimen);
        return $query->result();
    }

    public function bilanganGradingParlimen(){
        $query = $this->db->get($this->tableParlimen);
        return $query->num_rows();
    }

    public function bilanganGradingDun(){
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function senarai(){
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function gradingParti($partiBil, $pilihanraya_bil)
    {
        $this->db->select('COUNT(pencalonan_tb.pencalonan_parti) AS kira_parti');
        $this->db->select('parti_tb.parti_bil');
        $this->db->select('parti_tb.parti_warna');
        $this->db->select('parti_tb.parti_nama');
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_bil = status_grading_tb.status_grading_pencalonan', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where('pencalonan_tb.pencalonan_parti', $partiBil);
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->group_by('pencalonan_tb.pencalonan_parti');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function menangDun($dun_bil){
        $this->db->join('pencalonan_tb' , 'pencalonan_tb.pencalonan_bil = status_grading_tb.status_grading_pencalonan');
        $this->db->where('status_grading_tb.status_grading_dun', $dun_bil);
        $this->db->order_by('status_grading_tb.status_grading_tarikh', 'DESC');
        $this->db->order_by('status_grading_tb.status_grading_peratus', 'DESC');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function menang_dun($dun_bil){
        $this->db->where('status_grading_dun', $dun_bil);
        $this->db->order_by('status_grading_tarikh', 'DESC');
        $this->db->order_by('status_grading_peratus', 'DESC');
        $query = $this->db->get($this->table);
        return $query->row();
    }

	public function cipta($pencalonan_bil, $status_peratus, $status_grading_tarikh)
	{
        $data = array(
            'status_grading_pencalonan' => $pencalonan_bil,
            'status_grading_peratus' => $status_peratus,
            'status_grading_tarikh' => $status_grading_tarikh      
        );

        $return_data['insert_data'] = $this->db->insert($this->table, $data);
        $return_data['last_id'] = $this->db->insert_id();
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
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function papar_ikut_dun($dun_bil){
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_bil = status_grading_tb.status_grading_pencalonan', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->where('dun_tb.dun_bil', $dun_bil);
        $this->db->order_by('status_grading_tarikh', 'DESC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function padam($bil){
        $this->db->where('status_grading_bil', $bil);
        $this->db->delete($this->table);
    }

    public function padam_pencalonan($status_grading_pencalonan)
    {
        $this->db->where('status_grading_pencalonan', $status_grading_pencalonan);
        $this->db->delete($this->table);
    }

    public function set($bil, $peratus){
        $data = array('status_grading_peratus' => $peratus);
        $this->db->where('status_grading_bil', $bil);
        $this->db->update($this->table, $data);
    }

    public function semakAda($pencalonan_bil){
        $this->db->where('status_grading_pencalonan', $pencalonan_bil);
        $this->db->where('status_grading_tarikh', date('Y-m-d'));
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function semak_ikut_tarikh($pencalonan_bil, $status_grading_tarikh){
        $this->db->where('status_grading_pencalonan', $pencalonan_bil);
        $this->db->where('status_grading_tarikh', $status_grading_tarikh);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function tertinggi($dun_bil){
        $this->db->select_max('status_grading_tb.status_grading_peratus');
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_bil = status_grading_tb.status_grading_pencalonan', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->where('dun_tb.dun_bil', $dun_bil);
        $this->db->where('status_grading_tb.status_grading_tarikh', date('Y-m-d'));
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function pilihan($dun_bil){
        foreach($this->tertinggi($dun_bil) as $d){
            $n = $d->status_grading_peratus;
        }
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_bil = status_grading_tb.status_grading_pencalonan', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where('dun_tb.dun_bil', $dun_bil);
        $this->db->where('status_grading_tb.status_grading_tarikh', date('Y-m-d'));
        $this->db->where('status_grading_tb.status_grading_peratus', $n);
        $query = $this->db->get($this->table);

        return $query->result();

    }

    public function senarai_tarikh($pilihanraya_bil, $dun_bil){
        $this->db->select('status_grading_tb.status_grading_tarikh');
        $this->db->group_by('status_grading_tb.status_grading_tarikh');
        $this->db->order_by('status_grading_tb.status_grading_tarikh', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function calibrate($pencalonan_bil, $status_grading_tarikh){
        $ada = $this->semak_ikut_tarikh($pencalonan_bil, $status_grading_tarikh);
        if(empty($ada)){
            $status_peratus = 0;
            $this->cipta($pencalonan_bil, $status_peratus, $status_grading_tarikh);
        }
    }

    public function susunan_ikut_hari_selain_bn($pilihanraya_bil, $dun_bil, $tarikh)
    {
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_bil = status_grading_tb.status_grading_pencalonan', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where("parti_tb.parti_singkatan != 'BN'");
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_tb.pencalonan_dun', $dun_bil);
        $this->db->where('status_grading_tb.status_grading_tarikh', $tarikh);
        $this->db->order_by('status_grading_tb.status_grading_peratus', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function grading_bn($pilihanraya_bil, $dun_bil, $tarikh)
    {
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_bil = status_grading_tb.status_grading_pencalonan', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where("parti_tb.parti_singkatan", "BN");
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_tb.pencalonan_dun', $dun_bil);
        $this->db->where('status_grading_tb.status_grading_tarikh', $tarikh);
        $this->db->order_by('status_grading_tb.status_grading_peratus', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result();    
    }

    public function senarai_parti($pilihanraya_bil, $tarikh)
    {
        $this->db->select('COUNT(pencalonan_tb.pencalonan_parti) AS kira_parti');
        $this->db->select('parti_tb.parti_bil');
        $this->db->select('parti_tb.parti_warna');
        $this->db->select('parti_tb.parti_nama');
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_bil = status_grading_tb.status_grading_pencalonan', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('status_grading_tb.status_grading_tarikh', $tarikh);
        $this->db->group_by('pencalonan_tb.pencalonan_parti');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    //PARLIMEN

    public function menang($parlimen_bil){
        $this->db->where('sgpt_parlimen_bil', $parlimen_bil);
        $this->db->order_by('sgpt_tarikh', 'DESC');
        $this->db->order_by('sgpt_peratus', 'DESC');
        $query = $this->db->get('status_grading_parlimen_tb');
        return $query->row();
    }

    public function hari_ini_parlimen_tarikh($pencalonan_bil, $parlimen_bil, $tarikh)
    {
        $this->db->where('sgpt_parlimen_bil', $parlimen_bil);
        $this->db->where('sgpt_pencalonan', $pencalonan_bil);
        $this->db->where('DATE(sgpt_tarikh)', $tarikh);
        $this->db->order_by('sgpt_tarikh', 'DESC');
        $query = $this->db->get('status_grading_parlimen_tb');
        return $query->row();
    }
    
    public function hari_ini_parlimen($pencalonan_bil, $parlimen_bil)
    {
        $this->db->where('sgpt_parlimen_bil', $parlimen_bil);
        $this->db->where('sgpt_pencalonan', $pencalonan_bil);
        $this->db->order_by('sgpt_tarikh', 'DESC');
        $query = $this->db->get('status_grading_parlimen_tb');
        return $query->row();
    }

    public function tambah_grading_parlimen($tarikh, $pencalonan_bil, $peratus, $parlimen_bil)
    {
        $data = array(
            'sgpt_tarikh' => $tarikh,
            'sgpt_pencalonan' => $pencalonan_bil,
            'sgpt_peratus' => $peratus,
            'sgpt_parlimen_bil' => $parlimen_bil
        );
        $this->db->insert('status_grading_parlimen_tb', $data);
    }

    public function kemaskini_grading_parlimen($bil, $pencalonan_bil, $peratus, $parlimen_bil)
    {
        $data = array(
            'sgpt_pencalonan' => $pencalonan_bil,
            'sgpt_peratus' => $peratus,
            'sgpt_parlimen_bil' => $parlimen_bil
        );
        $this->db->where('sgpt_bil', $bil);
        $this->db->update('status_grading_parlimen_tb', $data);
    }

    //PARLIMEN PDM

    public function hari($tarikh, $pencalonan_bil, $dm_bil)
    {
        $this->db->where('sgppt_dm_bil', $dm_bil);
        $this->db->where('sgppt_pencalonan', $pencalonan_bil);
        $this->db->where('sgppt_tarikh', $tarikh);
        $this->db->order_by('sgppt_tarikh', 'DESC');
        $query = $this->db->get('status_grading_pdm_parlimen_tb');
        return $query->row();
    }

    public function semasa($pencalonan_bil, $dm_bil)
    {
        $this->db->where('sgppt_dm_bil', $dm_bil);
        $this->db->where('sgppt_pencalonan', $pencalonan_bil);
        $this->db->order_by('sgppt_tarikh', 'DESC');
        $query = $this->db->get('status_grading_pdm_parlimen_tb');
        return $query->row();
    }

    public function hari_ini_pdm_parlimen($pencalonan_bil, $dm_bil)
    {
        $this->db->where('sgppt_dm_bil', $dm_bil);
        $this->db->where('sgppt_pencalonan', $pencalonan_bil);
        $this->db->order_by('sgppt_tarikh', 'DESC');
        $query = $this->db->get('status_grading_pdm_parlimen_tb');
        return $query->row();
    }

    public function tambah_grading_pdm_parlimen($tarikh, $pencalonan_bil, $peratus, $dm_bil)
    {
        $data = array(
            'sgppt_tarikh' => $tarikh,
            'sgppt_pencalonan' => $pencalonan_bil,
            'sgppt_peratus' => $peratus,
            'sgppt_dm_bil' => $dm_bil
        );
        $this->db->insert('status_grading_pdm_parlimen_tb', $data);
    }

    public function kemaskini_grading_pdm_parlimen($bil, $pencalonan_bil, $peratus, $dm_bil)
    {
        $data = array(
            'sgppt_pencalonan' => $pencalonan_bil,
            'sgppt_peratus' => $peratus,
            'sgppt_dm_bil' => $dm_bil
        );
        $this->db->where('sgppt_bil', $bil);
        $this->db->update('status_grading_pdm_parlimen_tb', $data);
    }

    //DUN

    public function hari_ini_dun_tarikh($pencalonan_bil, $dun_bil, $tarikh)
    {
        $this->db->where('status_grading_dun', $dun_bil);
        $this->db->where('status_grading_pencalonan', $pencalonan_bil);
        $this->db->where('DATE(status_grading_tarikh)', $tarikh);
        $this->db->order_by('status_grading_tarikh', 'DESC');
        $query = $this->db->get('status_grading_tb');
        return $query->row();
    }
    
    public function hari_ini_dun($pencalonan_bil, $dun_bil)
    {
        $this->db->where('status_grading_dun', $dun_bil);
        $this->db->where('status_grading_pencalonan', $pencalonan_bil);
        $this->db->order_by('status_grading_tarikh', 'DESC');
        $query = $this->db->get('status_grading_tb');
        return $query->row();
    }

    public function tambah_grading_dun($tarikh, $pencalonan_bil, $peratus, $dun_bil)
    {
        $data = array(
            'status_grading_tarikh' => $tarikh,
            'status_grading_pencalonan' => $pencalonan_bil,
            'status_grading_peratus' => $peratus,
            'status_grading_dun' => $dun_bil
        );
        $this->db->insert('status_grading_tb', $data);
    }

    public function kemaskini_grading_dun($bil, $pencalonan_bil, $peratus, $dun_bil)
    {
        $data = array(
            'status_grading_pencalonan' => $pencalonan_bil,
            'status_grading_peratus' => $peratus,
            'status_grading_dun' => $dun_bil
        );
        $this->db->where('status_grading_bil', $bil);
        $this->db->update('status_grading_tb', $data);
    }

    //DUN PDM

    public function hari_ini_pdm_dun($pencalonan_bil, $dm_bil)
    {
        $this->db->where('sgpdt_dm_bil', $dm_bil);
        $this->db->where('sgpdt_pencalonan', $pencalonan_bil);
        $this->db->order_by('sgpdt_tarikh', 'DESC');
        $query = $this->db->get('status_grading_pdm_dun_tb');
        return $query->row();
    }

    public function hari_pdm_dun($pencalonan_bil, $dm_bil, $tarikh)
    {
        $this->db->where('sgpdt_dm_bil', $dm_bil);
        $this->db->where('sgpdt_pencalonan', $pencalonan_bil);
        $this->db->where('DATE(sgpdt_tarikh)', $tarikh);
        $this->db->order_by('sgpdt_tarikh', 'DESC');
        $query = $this->db->get('status_grading_pdm_dun_tb');
        return $query->row();
    }

    public function tambah_grading_pdm_dun($tarikh, $pencalonan_bil, $peratus, $dm_bil)
    {
        $data = array(
            'sgpdt_tarikh' => $tarikh,
            'sgpdt_pencalonan' => $pencalonan_bil,
            'sgpdt_peratus' => $peratus,
            'sgpdt_dm_bil' => $dm_bil
        );
        $this->db->insert('status_grading_pdm_dun_tb', $data);
    }

    public function kemaskini_grading_pdm_dun($bil, $pencalonan_bil, $peratus, $dm_bil)
    {
        $data = array(
            'sgpdt_pencalonan' => $pencalonan_bil,
            'sgpdt_peratus' => $peratus,
            'sgpdt_dm_bil' => $dm_bil
        );
        $this->db->where('sgpdt_bil', $bil);
        $this->db->update('status_grading_pdm_dun_tb', $data);
    }


}
