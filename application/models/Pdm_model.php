<?php
class Pdm_model extends CI_Model
{
    protected $pdm_parlimen = "pdm_parlimen_tb";
    protected $pdm_dun = "pdm_dun_tb";

    //======================================================================
    // FUNGSI BARU DITAMBAH DI SINI
    //======================================================================

    /**
     * Mendapatkan satu baris data PDM DUN berdasarkan ID (bil).
     *
     * @param int $bil ID PDM (pdt_bil).
     * @return object Data PDM.
     */
    public function satu_data_dun($bil)
    {
        $this->db->where('pdt_bil', $bil);
        $query = $this->db->get($this->pdm_dun);
        return $query->row();
    }

    /**
     * Mendapatkan satu baris data PDM Parlimen berdasarkan ID (bil).
     *
     * @param int $bil ID PDM Parlimen (ppt_bil).
     * @return object Data PDM Parlimen.
     */
    public function satu_data_parlimen($bil)
    {
        $this->db->where('ppt_bil', $bil);
        $query = $this->db->get($this->pdm_parlimen);
        return $query->row();
    }

    //======================================================================
    // FUNGSI SEDIA ADA ANDA
    //======================================================================

    public function bilanganDmParlimen($senaraiParlimen){
        $this->db->select("COUNT(*) AS bilanganDm");
        foreach($senaraiParlimen as $parlimen){
            $this->db->or_where('ppt_parlimen_bil', $parlimen->pt_bil);
        }
        $query = $this->db->get($this->pdm_parlimen);
        return $query->row();
    }

    public function senaraiPdmParlimen($senaraiParlimen){
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pdm_parlimen_tb.ppt_parlimen_bil', 'left');
        foreach($senaraiParlimen as $parlimen){
            $this->db->or_where('ppt_parlimen_bil', $parlimen->pt_bil);
        }
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $this->db->order_by('pdm_parlimen_tb.ppt_nama', 'ASC');
        $query = $this->db->get($this->pdm_parlimen);
        return $query->result();
    }

    public function parlimenGrading($parlimenBil, $tarikh)
    {
        $this->db->join('harian_dm_parlimen_tb AS harian', 'harian.hdpt_dm_bil = '.$this->pdm_parlimen.'.ppt_bil', 'left');
        $this->db->where($this->pdm_parlimen.'.ppt_parlimen_bil', $parlimenBil);
        $this->db->where('DATE(harian.hdpt_tarikh)', $tarikh);
        $query = $this->db->get($this->pdm_parlimen);
        return $query->result();
    }


    public function dunGrading($dun_bil, $tarikh)
    {
        $this->db->join('harian_dm_dun_tb AS harian', 'harian.hddt_dm_bil = '.$this->pdm_dun.'.pdt_bil', 'left');
        $this->db->where($this->pdm_dun.'.pdt_dun', $dun_bil);
        $this->db->where('DATE(harian.hddt_tarikh)', $tarikh);
        $query = $this->db->get($this->pdm_dun);
        return $query->result();
    }

    public function tambah_pdm_parlimen($nama_pdm, $parlimen_bil, $bilangan_pengundi)
    {
        $data = array(
            'ppt_nama' => $nama_pdm,
            'ppt_bilangan_pengundi' => $bilangan_pengundi,
            'ppt_parlimen_bil' => $parlimen_bil
        );
        $this->db->insert($this->pdm_parlimen, $data);
    }
    public function tambah_pdm_dun($nama_pdm, $dun_bil, $bilangan_pengundi)
    {
        $data = array(
            'pdt_nama' => $nama_pdm,
            'pdt_bilangan_pengundi' => $bilangan_pengundi,
            'pdt_dun' => $dun_bil
        );
        $this->db->insert($this->pdm_dun, $data);
    }
    
    public function senarai_pdm_parlimen()
    {
        $this->db->order_by('ppt_nama', 'ASC');
        $query = $this->db->get($this->pdm_parlimen);
        return $query->result();
    }
    public function senarai_pdm_dun()
    {
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pdm_dun_tb.pdt_dun', 'left');
        $this->db->join("negeri_tb", "UPPER(negeri_tb.nt_nama) = UPPER(dun_tb.dun_negeri)", "left");
        $this->db->order_by('pdt_nama', 'ASC');
        $query = $this->db->get($this->pdm_dun);
        return $query->result();
    }
    public function semak_pdm_parlimen($parlimen_bil, $nama_pdm)
    {
        $this->db->where('ppt_parlimen_bil', $parlimen_bil);
        $this->db->where('ppt_nama', $nama_pdm);
        $query = $this->db->get($this->pdm_parlimen);
        return $query->row();
    }
    public function semak_pdm_dun($dun_bil, $nama_pdm)
    {
        $this->db->where('pdt_dun', $dun_bil);
        $this->db->where('pdt_nama', $nama_pdm);
        $query = $this->db->get($this->pdm_dun);
        return $query->row();
    }

    public function parlimen($parlimen_bil)
    {
        $this->db->where('ppt_parlimen_bil', $parlimen_bil);
        $query = $this->db->get($this->pdm_parlimen);
        return $query->result();
    }

    public function dun($dun_bil)
    {
        $this->db->where('pdt_dun', $dun_bil);
        $this->db->order_by('pdt_nama', 'ASC');
        $query = $this->db->get($this->pdm_dun);
        return $query->result();
    }

    public function kemaskini($bil, $nama, $bilangan_pengundi)
    {
        $data = array(
            'ppt_nama' => $nama,
            'ppt_bilangan_pengundi' => $bilangan_pengundi
        );
        $this->db->where('ppt_bil', $bil);
        $this->db->update($this->pdm_parlimen, $data);
    }

    public function padam($bil)
    {
        $this->db->where('ppt_bil', $bil);
        $this->db->delete($this->pdm_parlimen);
    }
    
    public function kemaskini_dun($bil, $nama, $bilangan_pengundi)
    {
        $data = array(
            'pdt_nama' => $nama,
            'pdt_bilangan_pengundi' => $bilangan_pengundi
        );
        $this->db->where('pdt_bil', $bil);
        $this->db->update($this->pdm_dun, $data);
    }

    public function padam_dun($bil)
    {
        $this->db->where('pdt_bil', $bil);
        $this->db->delete($this->pdm_dun);
    }

    public function jumlah_pengundi_keseluruhan()
    {
        $this->db->select('SUM(ppt_bilangan_pengundi) as total');
        $query = $this->db->get($this->pdm_parlimen);
        return $query->row();
    }

    public function jumlah_pengundi_parlimen($parlimen_bil)
    {
        $this->db->select('SUM(ppt_bilangan_pengundi) as jumlah');
        $this->db->where('ppt_parlimen_bil', $parlimen_bil);
        $query = $this->db->get($this->pdm_parlimen);
        return $query->row();
    }

    public function jumlah_pengundi_dun($dun_bil)
    {
        $this->db->select('SUM(pdt_bilangan_pengundi) as jumlah');
        $this->db->where('pdt_dun', $dun_bil);
        $query = $this->db->get($this->pdm_dun);
        return $query->row();
    }
}
?>
