<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_model extends CI_Model {

    protected $table = 'pengguna_tb';

    /**
     * Mengira jumlah keseluruhan pengguna yang mempunyai peranan 'PPD'.
     * @return int
     */
    public function jumlah_pelapor_ppd()
    {
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = pengguna_tb.pengguna_peranan_bil', 'left');
        $this->db->like('peranan_tb.peranan_nama', 'PPD', 'after');
        return $this->db->count_all_results('pengguna_tb');
    }

    public function update20250716(){
        $this->fieldUpdate();
    }

    private function fieldUpdate(){
        $fieldsToAdd = [];
        if ($this->db->field_exists('pengguna_status', $this->table) == FALSE)
        {   
            $fieldsToAdd['pengguna_status'] = [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => TRUE
            ];
        }
        if ($this->db->field_exists('pengguna_tempat_tugas', $this->table) == FALSE)
        {   
            $fieldsToAdd['pengguna_tempat_tugas'] = [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => TRUE
            ];
        }
        if ($this->db->field_exists('pengguna_waktu', $this->table) == FALSE)
        {   
            $fieldsToAdd['pengguna_waktu'] = [
                'type' => 'DATETIME',
                'null' => TRUE
            ];
        }
        if (!empty($fieldsToAdd)) {
            $this->dbforge->add_column($this->table, $fieldsToAdd);
        }
    }

    public function senaraiDuplicate($nama, $noIC, $noTel, $personelBil){
        $this->db->group_start();
            if(!empty($nama)){
                $this->db->like("UPPER(nama_penuh)", strtoupper($nama));
            }
            if(!empty($noIC)){
                $this->db->or_where("pengguna_ic", $noIC);
            }
            if(!empty($noTel)){
                $this->db->or_where("no_tel", $noTel);
            }
        $this->db->group_end();
        $this->db->where("bil !=", $personelBil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiPelaporCarian(){
        $column = [
            'pengguna_tb.bil AS penggunaBil', 
            'UPPER(pengguna_tb.nama_penuh) AS penggunaNama'
        ];
        $this->db->select($column);
        $this->db->order_by("penggunaNama", "ASC");
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function bilanganLaporan(){
        $query = $this->db->get($this->table);
        $bilanganLaporan = $query->num_rows();
        return $bilanganLaporan;
    }

    public function senaraiAnggotaNegeri($senaraiNegeri){
        $column = ['pengguna_tb.bil', 'pengguna_tb.nama_penuh'];
        $this->db->select($column);
        $joins = [
            ['tugas_daerah', 'tugas_daerah.peranan_bil = pengguna_tb.pengguna_peranan_bil', 'left'],
            ['daerah', 'daerah.bil = tugas_daerah.daerah_bil', 'left'],
            ['tugas_negeri', 'tugas_negeri.peranan = pengguna_tb.pengguna_peranan_bil', 'left']
        ];
        foreach ($joins as $join) {
            $this->db->join($join[0], $join[1], $join[2]);
        }
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('daerah.negeri_bil', $negeri->nt_bil);
            $this->db->or_where('tugas_negeri.negeri', $negeri->nt_bil);
        }
        $this->db->group_end();
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function tukarPenempatan(){
        $data = array(
            'pengguna_peranan_bil' => $this->input->post('inputPerananBil'),
            'pengguna_peranan_nama' => $this->input->post('inputPerananNama'),
            'pengguna_tempat_tugas' => $this->input->post('inputOrganisasiNama')
        );
        $this->db->where('bil', $this->input->post('inputAnggotaBil'));
        $this->db->update($this->table, $data);
    }

    public function jumlahAkaun()
    {
        $this->db->select("COUNT(*) as bilangan");
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function bilanganTadbir()
    {
        $this->db->select("COUNT(*) as bilangan");
        $this->db->where("pengguna_status", "");
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function bilanganAnggota()
    {
        $this->db->select("COUNT(*) as bilangan");
        $this->db->where("pengguna_status !=", "");
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function carianPenggunaNama($carian){
        $this->db->select("bil as penggunaBil");
        $this->db->select("nama_penuh as penggunaNama");
        $this->db->select("pekerjaan as penggunaJawatan");
        $this->db->select("pengguna_tempat_tugas as penggunaPenempatan");
        $this->db->like("nama_penuh", $carian);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kemaskiniPilihanPengguna(){
        $data = array(
            'nama_penuh' => $this->input->post('inputNamaPenuh'),
            'no_tel' => $this->input->post('inputNoTel'),
            'pengguna_ic' => $this->input->post('inputNoIc'),
            'emel' => $this->input->post('inputEmel'),
            'pekerjaan' => $this->input->post('inputJawatan'),
            'pengguna_tempat_tugas' => $this->input->post('inputPenempatan')
        );
        $this->db->where('bil', $this->input->post('inputPenggunaBil'));
        return $this->db->update($this->table, $data);
    }

    public function daftarIkutPeranan($perananBil, $perananNama)
    {
        $data = array(
            'nama_penuh' => $this->input->post('inputNama'),
            'no_tel' => $this->input->post('inputNoTel'),
            'pengguna_ic' => $this->input->post('inputNoIc'),
            'emel' => $this->input->post('inputEmel'),
            'pekerjaan' => $this->input->post('inputJawatan'),
            'pengguna_peranan_bil' => $perananBil,
            'pengguna_peranan_nama' => $perananNama,
            'pengguna_status' => "Baharu",
            'pengguna_waktu' => date("Y-m-d H:i:s"),
            'pengguna_tempat_tugas' => $this->input->post('inputPenempatan')
        );
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function daftarPpn($perananBil, $perananNama, $tempatTugas)
    {
        $data = array(
            'nama_penuh' => $this->input->post('input_nama_penuh'),
            'no_tel' => $this->input->post('input_no_tel'),
            'pengguna_ic' => $this->input->post('input_no_ic'),
            'emel' => $this->input->post('input_emel'),
            'pekerjaan' => $this->input->post('input_jawatan'),
            'pengguna_peranan_bil' => $perananBil,
            'pengguna_peranan_nama' => $perananNama,
            'pengguna_status' => "Baharu",
            'pengguna_waktu' => date("Y-m-d H:i:s"),
            'pengguna_tempat_tugas' => $tempatTugas
        );
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function senaraiPerjawatanDaerah3($senaraiNegeri){
        $this->db->select('UPPER(pengguna_tb.pekerjaan) AS perjawatan');
        $this->db->select('COUNT(pengguna_tb.pekerjaan) AS jumlahAnggota');
        $this->db->join('tugas_daerah', 'tugas_daerah.peranan_bil = pengguna_tb.pengguna_peranan_bil', 'left');
        $this->db->join('daerah', 'daerah.bil = tugas_daerah.daerah_bil', 'left');
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('daerah.negeri_bil', $negeri->nt_bil);
        }
        $this->db->where('pengguna_status !=', '');
        $this->db->like('UPPER(pengguna_peranan_nama)', 'PPD');
        $this->db->group_by('pengguna_tb.pekerjaan');
        $this->db->order_by('pengguna_tb.pekerjaan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiPerjawatanDaerah($senaraiNegeri){
        $this->db->select('pengguna_tb.pekerjaan');
        $this->db->select('COUNT(pengguna_tb.pekerjaan) AS jumlahAnggota');
        $this->db->join('tugas_daerah', 'tugas_daerah.peranan_bil = pengguna_tb.pengguna_peranan_bil', 'left');
        $this->db->join('daerah', 'daerah.bil = tugas_daerah.daerah_bil', 'left');
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('daerah.negeri_bil', $negeri->nt_bil);
        }
        $this->db->where('pengguna_status !=', '');
        $this->db->group_by('pengguna_tb.bil');
        $this->db->order_by('pengguna_tb.pekerjaan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiAnggotaDaerah($senaraiNegeri){
        $this->db->join('tugas_daerah', 'tugas_daerah.peranan_bil = pengguna_tb.pengguna_peranan_bil', 'left');
        $this->db->join('daerah', 'daerah.bil = tugas_daerah.daerah_bil', 'left');
        foreach($senaraiNegeri as $negeri){
            $this->db->where('daerah.negeri_bil', $negeri->nt_bil);
        }
        $this->db->where('pengguna_status !=', '');
        $this->db->group_by('pengguna_tb.bil');
        $this->db->order_by('pengguna_tb.pekerjaan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiBukanAdmin(){
        $this->db->where('pengguna_tb.pengguna_status !=', '');
        $this->db->order_by('pengguna_tb.nama_penuh', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai(){
        $this->db->order_by('pengguna_tb.nama_penuh', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiPerjawatanDaerah2($senaraiNegeri){
        $this->db->select('b.pekerjaan');
        $this->db->select('(SELECT COUNT(pekerjaan) 
        FROM pengguna_tb AS a 
        WHERE a.pengguna_peranan_bil = b.pengguna_peranan_bil
        ) as jumlahAnggota');
        $this->db->join('tugas_daerah', 'tugas_daerah.peranan_bil = b.pengguna_peranan_bil', 'left');
        $this->db->join('daerah', 'daerah.bil = tugas_daerah.daerah_bil', 'left');
        foreach($senaraiNegeri as $negeri){
            $this->db->where('daerah.negeri_bil', $negeri->nt_bil);
        }
        $this->db->where('b.pengguna_status !=', '');
        $this->db->group_by('b.bil');
        $this->db->order_by('b.pekerjaan', 'DESC');
        $query = $this->db->get($this->table." AS b");
        return $query->result();
    }

    public function senaraiPejabat(){
        $this->db->order_by('pengguna_tempat_tugas', 'ASC');
        $this->db->group_by('pengguna_tempat_tugas');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiPerjawatan($perananBil){
        $this->db->select('UPPER(pekerjaan) AS pekerjaan');
        $this->db->select('COUNT(pekerjaan) as jumlahAnggota');
        $this->db->where('pengguna_status !=', '');
        $this->db->where('pengguna_peranan_bil', $perananBil);
        $this->db->group_by('pekerjaan');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function bilanganPengguna($peranan_bil)
    {
        $this->db->select('COUNT(*) AS jumlahPengguna');
        $this->db->where('pengguna_peranan_bil', $peranan_bil);
        $this->db->where('pengguna_status !=', '');
        $query = $this->db->get($this->table);
        return $query->row(); 
    }

    public function penggunaSenaraiNegeri($senaraiNegeri){
        $this->db->select('pengguna_tb.bil');
        $this->db->select('pengguna_tb.nama_penuh');
        $this->db->select('pengguna_tb.pekerjaan');
        $this->db->select('pengguna_tb.pengguna_status');
        $this->db->select('pengguna_tb.no_tel');
        $this->db->select('pengguna_tb.pengguna_ic');
        $this->db->select('pengguna_tb.emel');
        $this->db->select('pengguna_tb.pengguna_tempat_tugas');
        $this->db->select('pengguna_tb.pengguna_peranan_bil');
        $this->db->join('tugas_negeri', 'tugas_negeri.peranan = pengguna_tb.pengguna_peranan_bil', 'left');
        foreach($senaraiNegeri as $n){
            $this->db->or_where('tugas_negeri.negeri', $n->nt_bil);
        }
        $this->db->where('pengguna_tb.pengguna_status !=', '');
        $this->db->group_by('pengguna_tb.bil');
        $this->db->order_by('nama_penuh', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result(); 
    }

    public function senaraiPenggunaIkutDun($dunBil){
        $this->db->join('tugas_dun_tb', 'tugas_dun_tb.tdt_peranan_bil = pengguna_tb.pengguna_peranan_bil', 'left');
        $this->db->where('tugas_dun_tb.tdt_dun_bil', $dunBil);
        $query = $this->db->get('pengguna_tb');
        return $query->result(); 
    }

    public function ikut_negeri($nama_negeri)
    {
        $senarai_pengguna = array();
        $senarai_pelapor = $this->senarai_penuh_pelapor();
        foreach($senarai_pelapor as $pelapor){
            $p = array();
            $pelapor_parlimen = $this->negeri_parlimen($pelapor->bil);
            if(empty($pelapor_parlimen)){
                $pelapor_dun = $this->negeri_dun($pelapor->bil);
                if(empty($pelapor_dun)){
                    $n_negeri = 'Belum Ditetapkan';
                }else{
                    $n_negeri = $pelapor_dun->dun_negeri;
                }
            }else{
                $n_negeri = $pelapor_parlimen->pt_negeri;
            }
            if(strtoupper($n_negeri) == strtoupper($nama_negeri)){
                $p = array(
                    'bil' => $pelapor->bil,
                    'peranan' => $pelapor->pengguna_peranan_bil,
                    'nama_negeri' => $n_negeri
                );
                array_push($senarai_pengguna, $p);
            }
        }
        return $senarai_pengguna;
    }

    public function negeri_dun($pengguna_bil){
        $this->db->select('bil');
        $this->db->select('nama_penuh');
        $this->db->select('pekerjaan');
        $this->db->select('pengguna_status');
        $this->db->select('no_tel');
        $this->db->select('pengguna_ic');
        $this->db->select('emel');
        $this->db->select('pengguna_tempat_tugas');
        $this->db->select('pengguna_peranan_bil');
        $this->db->select('dun_tb.dun_negeri');
        $this->db->join('tugas_dun_tb', 'tugas_dun_tb.tdt_peranan_bil = pengguna_tb.pengguna_peranan_bil');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = tugas_dun_tb.tdt_dun_bil');
        $this->db->where('pengguna_tb.bil', $pengguna_bil);
        $query = $this->db->get($this->table);
        return $query->row(); 
    }

    public function negeri_parlimen($pengguna_bil){
        $this->db->select('bil');
        $this->db->select('nama_penuh');
        $this->db->select('pekerjaan');
        $this->db->select('pengguna_status');
        $this->db->select('no_tel');
        $this->db->select('pengguna_ic');
        $this->db->select('emel');
        $this->db->select('pengguna_tempat_tugas');
        $this->db->select('pengguna_peranan_bil');
        $this->db->select('parlimen_tb.pt_negeri');
        $this->db->join('tugas_parlimen_tb', 'tugas_parlimen_tb.tpt_peranan_bil = pengguna_tb.pengguna_peranan_bil');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = tugas_parlimen_tb.tpt_parlimen_bil');
        $this->db->where('pengguna_tb.bil', $pengguna_bil);
        $query = $this->db->get($this->table);
        return $query->row(); 
    }

    public function pelapor_negeri($negeri_nama){
        $this->db->select('pengguna_tb.bil');
        $this->db->select('pengguna_tb.nama_penuh');
        $this->db->select('pengguna_tb.pekerjaan');
        $this->db->select('pengguna_tb.pengguna_status');
        $this->db->select('pengguna_tb.no_tel');
        $this->db->select('pengguna_tb.pengguna_ic');
        $this->db->select('pengguna_tb.emel');
        $this->db->select('pengguna_tb.pengguna_tempat_tugas');
        $this->db->select('pengguna_tb.pengguna_peranan_bil');
        $this->db->join('tugas_daerah', 'tugas_daerah.peranan_bil = pengguna_tb.pengguna_peranan_bil', 'left');
        $this->db->join('daerah', 'daerah.bil = tugas_daerah.daerah_bil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil');
        $this->db->where('pengguna_tb.pengguna_status !=', '');
        $this->db->where('negeri_tb.nt_nama', $negeri_nama);
        $this->db->group_by('pengguna_tb.bil');
        $this->db->order_by('nama_penuh', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result(); 
    }

    public function senarai_penuh_pelapor(){
        $this->db->select('bil');
        $this->db->select('UPPER(nama_penuh) AS nama_penuh');
        $this->db->select('UPPER(pekerjaan) AS pekerjaan');
        $this->db->select('pengguna_status');
        $this->db->select('no_tel');
        $this->db->select('pengguna_ic');
        $this->db->select('emel');
        $this->db->select('UPPER(pengguna_tempat_tugas) AS pengguna_tempat_tugas');
        $this->db->select('pengguna_peranan_bil');
        $this->db->where('pengguna_status !=', '');
        $this->db->like('UPPER(pengguna_peranan_nama)', 'PPD');
        $this->db->where('pengguna_peranan_bil !=', '');
        $this->db->order_by('nama_penuh', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result(); 
    }

    public function senarai_pelapor($peranan_bil)
    {
        $this->db->select('bil');
        $this->db->select('nama_penuh');
        $this->db->select('pekerjaan');
        $this->db->select('pengguna_status');
        $this->db->select('no_tel');
        $this->db->select('pengguna_ic');
        $this->db->select('emel');
        $this->db->select('pengguna_tempat_tugas');
        $this->db->where('pengguna_peranan_bil', $peranan_bil);
        $this->db->where('pengguna_status !=', '');
        $this->db->order_by('pengguna_waktu', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result(); 
    }

    public function padam()
    {
        $this->db->where('bil', $this->input->post('input_bil'));
        $this->db->delete($this->table);
    }

    public function senarai_padam_dun($negeri_bil)
    {
        $this->db->select('pengguna_tb.bil');
        $this->db->select('pengguna_tb.nama_penuh');
        $this->db->select('pengguna_tb.pekerjaan');
        $this->db->select('pengguna_tb.pengguna_tempat_tugas');
        $this->db->join('tugas_dun_tb', 'tugas_dun_tb.tdt_peranan_bil = pengguna_tb.pengguna_peranan_bil');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = tugas_dun_tb.tdt_dun_bil');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = dun_tb.dun_negeri');
        $this->db->where('pengguna_tb.pengguna_status', 'Menunggu Pengesahan Padam');
        $this->db->where('negeri_tb.nt_bil', $negeri_bil);
        $this->db->group_by('pengguna_tb.bil');
        $this->db->order_by('pengguna_tb.pengguna_waktu', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result(); 
    }

    public function senarai_padam_parlimen($negeri_bil)
    {
        $this->db->select('pengguna_tb.bil');
        $this->db->select('pengguna_tb.nama_penuh');
        $this->db->select('pengguna_tb.pekerjaan');
        $this->db->select('pengguna_tb.pengguna_tempat_tugas');
        $this->db->join('tugas_parlimen_tb', 'tugas_parlimen_tb.tpt_peranan_bil = pengguna_tb.pengguna_peranan_bil');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = tugas_parlimen_tb.tpt_parlimen_bil');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = parlimen_tb.pt_negeri');
        $this->db->where('pengguna_tb.pengguna_status', 'Menunggu Pengesahan Padam');
        $this->db->where('negeri_tb.nt_bil', $negeri_bil);
        $this->db->group_by('pengguna_tb.bil');
        $this->db->order_by('pengguna_tb.pengguna_waktu', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result(); 
    }

    public function senarai_padam($negeri_bil)
    {
        $this->db->select('pengguna_tb.bil');
        $this->db->join('tugas_dun_tb', 'tugas_dun_tb.tdt_peranan_bil = pengguna_tb.pengguna_peranan_bil');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = tugas_dun_tb.tdt_dun_bil');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = dun_tb.dun_negeri');
        $this->db->where('pengguna_tb.pengguna_status', 'Menunggu Pengesahan Padam');
        $this->db->where('negeri_tb.nt_bil', $negeri_bil);
        $this->db->group_by('pengguna_tb.bil');
        $this->db->order_by('pengguna_tb.pengguna_waktu', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result(); 
    }

    public function kemaskini_ppd()
    {
        $data = array(
            'nama_penuh' => $this->input->post('input_nama_penuh'),
            'no_tel' => $this->input->post('input_no_tel'),
            'pengguna_ic' => $this->input->post('input_no_ic'),
            'emel' => $this->input->post('input_emel'),
            'pekerjaan' => $this->input->post('input_jawatan'),
            'pengguna_peranan_bil' => $this->input->post('input_peranan_bil'),
            'pengguna_peranan_nama' => $this->input->post('input_peranan_nama'),
            'pengguna_status' => $this->input->post('input_pengguna_status'),
            'pengguna_waktu' => date("Y-m-d H:i:s"),
            'pengguna_tempat_tugas' => $this->input->post('input_tempat'),
        );
        $this->db->where('bil', $this->input->post('input_bil'));
        return $this->db->update($this->table, $data);
    }

    public function anggota($peranan_bil)
    {
        $this->db->select('bil');
        $this->db->select('nama_penuh');
        $this->db->select('pekerjaan');
        $this->db->select('pengguna_status');
        $this->db->select('no_tel');
        $this->db->select('pengguna_ic');
        $this->db->select('emel');
        $this->db->select('pengguna_tempat_tugas');
        $this->db->where('pengguna_peranan_bil', $peranan_bil);
        $this->db->where('pengguna_status !=', '');
        $this->db->order_by('pengguna_waktu', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result(); 
    }
    
    public function semakan($pengguna_ic, $no_tel)
    {
        $this->db->select('bil');
        $this->db->where('pengguna_ic', $pengguna_ic);
        $this->db->or_where('no_tel', $no_tel);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function tambah_ppd()
    {
        $data = array(
            'nama_penuh' => $this->input->post('input_nama_penuh'),
            'no_tel' => $this->input->post('input_no_tel'),
            'pengguna_ic' => $this->input->post('input_no_ic'),
            'emel' => $this->input->post('input_emel'),
            'pekerjaan' => $this->input->post('input_jawatan'),
            'pengguna_peranan_bil' => $this->input->post('input_peranan_bil'),
            'pengguna_peranan_nama' => $this->input->post('input_peranan_nama'),
            'pengguna_status' => $this->input->post('input_pengguna_status'),
            'pengguna_waktu' => date("Y-m-d H:i:s"),
            'pengguna_tempat_tugas' => $this->input->post('input_tempat')
        );
        return $this->db->insert($this->table, $data);
    }

	public function daftar_pengguna()
	{
        $data = array(
            'nama_penuh' => $this->input->post('nama_penuh'),
            'no_tel' => $this->input->post('no_tel'),
            'pengguna_ic' => $this->input->post('no_ic'),
            'emel' => $this->input->post('emel')      
        );

    return $this->db->insert($this->table, $data);
    }

    public function daftar_pengguna_manual($nama_penuh, $no_tel, $pengguna_ic, $peranan_bil, $pengguna_peranan_nama)
	{
        $data = array(
            'nama_penuh' => $nama_penuh,
            'no_tel' => $no_tel,
            'pengguna_ic' => $pengguna_ic,
            'pengguna_peranan_bil' => $peranan_bil,
            'pengguna_peranan_nama' => $pengguna_peranan_nama 
        );

    return $this->db->insert($this->table, $data);
    }

    public function ada_pengguna($nama_pengguna)
    {
        $this->db->where('nama_penuh', $nama_pengguna);
        $this->db->where('no_tel', $nama_pengguna);
        $this->db->where('pengguna_ic', $nama_pengguna);
        $query = $this->db->get($this->table);
        return $query->row();
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
        $this->db->order_by('nama_penuh', 'ASC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function semak_ada($pengguna_ic, $no_tel){
        $this->db->where('pengguna_tb.pengguna_ic', $pengguna_ic);
        $this->db->where('pengguna_tb.no_tel', $no_tel);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function maklumat_pengguna($pengguna_bil){
        $this->db->join('peranan_tb', 'peranan_tb.peranan_petugas = pengguna_tb.bil', 'left');
        $this->db->where('bil', $pengguna_bil);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function nama_pengguna($pengguna_bil){
        $nama = "NAMA PENGGUNA";
        $this->db->where('bil', $pengguna_bil);
        foreach($this->db->get($this->table)->result() as $p){
            $nama = $p->nama_penuh;
        }
        return $nama;
    }

    public function bilanganPerananPengguna($perananBil)
    {
        $this->db->select("COUNT(pengguna_peranan_bil) as bilanganPengguna");
        $this->db->where('pengguna_peranan_bil', $perananBil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function tiadaPeranan()
    {
        $this->db->where('pengguna_peranan_nama', "");
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function tambahPeranan()
    {
        $data = array(
            'pengguna_peranan_bil' => $this->input->post('inputPerananBil'),
            'pengguna_peranan_nama' => $this->input->post('inputPerananNama')
        );
        $this->db->where('bil', $this->input->post('inputPenggunaBil'));
        $this->db->update($this->table, $data);
    }

    public function tamatPeranan()
    {
        $data = array(
            'pengguna_peranan_bil' => "",
            'pengguna_peranan_nama' => ""
        );
        $this->db->where('bil', $this->input->post('inputPenggunaBil'));
        $this->db->update($this->table, $data);
    }

    public function penggunaIc($ic)
    {
        $this->db->where('pengguna_ic', $ic);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function pengguna($penggunaBil)
    {
        $this->db->where('bil', $penggunaBil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function peranan($perananBil)
    {
        $this->db->where('pengguna_peranan_bil', $perananBil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function peranan_terakhir($peranan_bil)
    {
        $this->db->where('pengguna_peranan_bil', $peranan_bil);
        $this->db->where('pengguna_status', '');
        $this->db->order_by('bil', 'DESC');
        $query = $this->db->get($this->table);
        return $query->row();
    }

}
