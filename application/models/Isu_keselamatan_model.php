<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Isu_keselamatan_model extends CI_Model
{

    public function senarai_laporan($pelapor, $tahun)
    {
        $namaTable = 'keselamatan_'.$pelapor.'_'.$tahun;
        if($this->db->table_exists('keselamatan_'.$pelapor.'_'.$tahun) != FALSE){
            $this->db->select('*');
            $this->db->select($namaTable.'.bil AS laporanBil');
            $this->db->join('daerah', 'daerah.bil = '.$namaTable.'.daerah', 'left');
            $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
            $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = '.$namaTable.'.parlimen', 'left');
            $this->db->join('dun_tb', 'dun_tb.dun_bil = '.$namaTable.'.dun', 'left');
            $this->db->join('pdm_parlimen_tb', 'pdm_parlimen_tb.ppt_bil = '.$namaTable.'.pdm', 'left');
            $query = $this->db->get('keselamatan_'.$pelapor.'_'.$tahun);
            return $query->result();
        }
    }

    public function tambah()
    {
        $pelapor = $this->input->post('input_pelapor');
        $this->checkTableExists($pelapor, date('Y'));
        $lain = $this->input->post('input_tajuk_isu_lain');
        $isu_keselamatan = $this->input->post('input_tajuk_isu');
        if(!empty($lain) && $isu_keselamatan == 'Lain-lain'){
            $isu_keselamatan = $lain;
        }
        $data = array(
            'tarikh_laporan' => date('Y-m-d'),
            'pelapor' => $this->input->post('input_pelapor'),
            'parlimen' => $this->input->post('input_parlimen'),
            'dun' => $this->input->post('input_dun'),
            'pdm' => $this->input->post('input_pdm'),
            'ringkasan_isu' => $this->input->post('input_ringkasan_isu'),
            'lokasi_isu' => $this->input->post('input_lokasi'),
            'latitude' => $this->input->post('input_latitude'),
            'longitude' => $this->input->post('input_longitude'),
            'kluster_bil' => $this->input->post('input_kluster_bil'),
            'pengguna_bil' => $this->input->post('input_pengguna_bil'),
            'pengguna_waktu' => date('Y-m-d H:i:s'),
            'daerah' => $this->input->post('input_daerah'),
            'jenis_kawasan' => $this->input->post('input_jenis_kawasan'),
            'isu_keselamatan' => $isu_keselamatan,
            'cadangan_intervensi' => $this->input->post('input_cadangan_intervensi'),
            'tapisan' => 'Terima'
        );
        $this->db->insert('keselamatan_'.$pelapor.'_'.date("Y"), $data);
    }

    public function checkTableExists($pelapor, $tahun)
    {   
        $this->load->dbforge();
        $namaTable = 'keselamatan_'.$pelapor.'_'.$tahun;
        if($this->db->table_exists($namaTable) == FALSE){
            $fields = array(
                'bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'tarikh_laporan' => array(
                        'type' => 'DATE',
                        'null' => TRUE
                ),
                'pelapor' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'parlimen' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'dun' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'pdm' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'ringkasan_isu' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'lokasi_isu' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'latitude' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'longitude' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'kluster_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'null' => TRUE
                ),
                'pengguna_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'null' => TRUE
                ),
                'pengguna_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                ),
                'daerah' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 200,
                    'null' => TRUE
                ),
                'jenis_kawasan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => TRUE
                ),
                'isu_keselamatan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'tapisan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                    'null' => TRUE
                ),
                'cadangan_intervensi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('bil', TRUE);
            $this->dbforge->create_table('keselamatan_'.$pelapor.'_'.$tahun, TRUE);
        }

        if($this->db->table_exists($namaTable) == TRUE){
            if ($this->db->field_exists('cadangan_intervensi', $namaTable) == FALSE)
            {   
                $fields = array(
                    'cadangan_intervensi' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($namaTable, $fields);
            }
            if ($this->db->field_exists('pdm', $namaTable) == FALSE)
            {   
                $fields = array(
                    'pdm' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($namaTable, $fields);
            }
            if ($this->db->field_exists('latitude', $namaTable) == FALSE)
            {   
                $fields = array(
                    'latitude' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($namaTable, $fields);
            }
            if ($this->db->field_exists('longitude', $namaTable) == FALSE)
            {   
                $fields = array(
                    'longitude' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($namaTable, $fields);
            }
        }


    }
}


?>