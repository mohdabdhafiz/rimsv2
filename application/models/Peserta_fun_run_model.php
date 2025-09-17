<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta_fun_run_model extends CI_Model {

    /**
     * Mendapatkan senarai semua peserta yang telah menerima sijil.
     * @return array
     */
    public function get_certificate_recipients() {
        $this->db->where('certificate_sent_at IS NOT NULL');
        $this->db->order_by('id', 'ASC'); // Susun mengikut nombor siri
        $query = $this->db->get('participants');
        return $query->result_array();
    }

    public function mark_certificate_sent($unique_id) {
        $this->db->where('unique_id', $unique_id);
        return $this->db->update('participants', array('certificate_sent_at' => date('Y-m-d H:i:s')));
    }

    public function ensure_participant_exists($participant_data) {
        $participant = $this->get_participant($participant_data['unique_id']);
        if (!$participant) {
            $data_to_insert = array(
                'unique_id'  => $participant_data['unique_id'],
                'full_name'  => $participant_data['full_name'],
                'email'      => $participant_data['email'],
                'shirt_size' => $participant_data['shirt_size']
            );
            $this->db->insert('participants', $data_to_insert);
            $participant = $this->get_participant($participant_data['unique_id']);
        }
        return $participant;
    }

    public function _get_sheet_data($unique_id) {
        $this->db->where('unique_id', $unique_id);
        return $this->db->update('participants', array('certificate_sent_at' => date('Y-m-d H:i:s')));
    }

    public function get_all_participants() {
        $query = $this->db->get('participants');
        return $query->result_array();
    }

        /**
     * Menambah peserta secara manual dari borang admin.
     * @param array $participant_data
     * @return bool
     */
    public function add_manual_participant($participant_data) {
        $data_to_insert = array(
            'unique_id'  => $participant_data['unique_id'],
            'full_name'  => $participant_data['full_name'],
            'email'      => $participant_data['email'],
            'shirt_size' => $participant_data['shirt_size']
            // 'collected_at', 'finished_at', 'certificate_sent_at' akan menjadi NULL secara lalai
        );
        return $this->db->insert('participants', $data_to_insert);
    }


    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Finds a participant in the local database.
     *
     * @param string $unique_id The ID to search for.
     * @return array|null The participant data or null if not found.
     */
    public function get_participant($unique_id) {
        $query = $this->db->get_where('participants', array('unique_id' => $unique_id));
        return $query->row_array();
    }

    /**
     * Inserts or updates a participant record and marks them as collected.
     *
     * @param array $participant_data The data of the participant from the Google Sheet.
     * @return bool True on success, false on failure.
     */
    public function add_and_mark_collected($participant_data) {
        $existing_participant = $this->get_participant($participant_data['unique_id']);
        
        $data_to_save = array(
            'unique_id'  => $participant_data['unique_id'],
            'full_name'  => $participant_data['full_name'],
            'email'      => $participant_data['email'],
            'shirt_size' => $participant_data['shirt_size'],
            'collected_at' => date('Y-m-d H:i:s')
        );

        if ($existing_participant) {
            $this->db->where('unique_id', $participant_data['unique_id']);
            return $this->db->update('participants', $data_to_save);
        } else {
            return $this->db->insert('participants', $data_to_save);
        }
    }

    public function setup_database_table() {
        $this->load->dbforge();
        if ($this->db->table_exists('participants') == FALSE) {
            $fields = array(
                'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
                'unique_id' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => FALSE, 'unique' => TRUE),
                'full_name' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => FALSE),
                'email' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE),
                'shirt_size' => array('type' => 'VARCHAR', 'constraint' => '10', 'null' => TRUE),
                'collected_at' => array('type' => 'DATETIME', 'null' => TRUE),
                'finished_at' => array('type' => 'DATETIME', 'null' => TRUE),
                'certificate_sent_at' => array('type' => 'DATETIME', 'null' => TRUE),
                'registered_at' => array('type' => 'TIMESTAMP', 'null' => FALSE)
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('participants', TRUE);
        } else {
            // Jika jadual sudah wujud, periksa dan tambah lajur jika perlu
            if ($this->db->field_exists('certificate_sent_at', 'participants') == FALSE) {
                $fields = array(
                    'certificate_sent_at' => array(
                        'type' => 'DATETIME',
                        'null' => TRUE,
                        'after' => 'finished_at'
                    )
                );
                $this->dbforge->add_column('participants', $fields);
            }
        }
    }

        /**
     * Gets the total number of collected shirts.
     *
     * @return int The total count of collected shirts.
     */
    public function get_total_collected() {
        $this->db->where('collected_at IS NOT NULL');
        return $this->db->count_all_results('participants');
    }

    /**
 * Menambah atau mengemas kini rekod peserta dan menanda mereka sebagai telah tamat.
 *
 * @param array $participant_data Data peserta dari Google Sheet.
 * @return bool
 */
public function add_and_mark_finished($participant_data) {
    $existing_participant = $this->get_participant($participant_data['unique_id']);

    if ($existing_participant) {
        // Peserta wujud, hanya kemas kini 'finished_at' jika ia kosong
        $this->db->where('unique_id', $participant_data['unique_id']);
        $this->db->where('finished_at IS NULL');
        return $this->db->update('participants', array('finished_at' => date('Y-m-d H:i:s')));
    } else {
        // Peserta tidak wujud dalam DB tempatan, cipta rekod baharu
        $data_to_save = array(
            'unique_id'  => $participant_data['unique_id'],
            'full_name'  => $participant_data['full_name'],
            'email'      => $participant_data['email'],
            'shirt_size' => $participant_data['shirt_size'],
            'finished_at' => date('Y-m-d H:i:s')
        );
        return $this->db->insert('participants', $data_to_save);
    }
}

/**
 * Mendapatkan jumlah peserta yang telah tamat (penerima medal).
 *
 * @return int Jumlah peserta yang telah tamat.
 */
public function get_total_finishers() {
    $this->db->where('finished_at IS NOT NULL');
    return $this->db->count_all_results('participants');
}




}
