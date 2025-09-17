<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Force PHP to display errors.
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Merdeka extends CI_Controller {

    private $sheet_url = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTC7fA6VypmWGqjMGuT4zzrPa_0GNcdLtj-sV9o0d14IPRzOEjP7G03P3ma-jRwM8pZ2yw1Y3Ih7wuP/pub?gid=1384752118&single=true&output=csv';
    
    //try
    //private $sheet_url = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTTVMtv8epe6ZaHytp395SDe3P1zdQbp1DXTkBK2L7Tv_x_0NQLCQNgyrsb0hkNRxYwGEzS6yFV5h3y/pub?gid=1384752118&single=true&output=csv';
    private $unique_column_name = 'NRIC/Passport Number';
    private $sijil_pin = '2025';

    // **FUNGSI BAHARU UNTUK TEMPLAT E-MEL**
    private function _template_email_sijil($nama_peserta) {
        $nama_peserta_escaped = html_escape($nama_peserta);
        
        $html = <<<EOD
        <!DOCTYPE html>
        <html lang="ms">
        <head>
            <meta charset="UTF-8">
            <style>
                body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
                .container { max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
                .header { background: linear-gradient(to right, #00529b, #d40000); color: #ffffff; padding: 30px 20px; text-align: center; }
                .header h1 { margin: 0; font-size: 24px; }
                .content { padding: 30px; color: #333333; line-height: 1.6; }
                .content h2 { font-size: 20px; color: #00529b; }
                .content p { margin-bottom: 20px; }
                .footer { background-color: #f8f8f8; padding: 20px; text-align: center; font-size: 12px; color: #777777; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>MERDEKA 6.8 KM FUN RUN & WALK</h1>
                </div>
                <div class="content">
                    <h2>Tahniah, {$nama_peserta_escaped}!</h2>
                    <p>Syabas dan terima kasih diucapkan atas penyertaan anda dalam acara larian kami. Semangat kesukanan dan patriotisme yang anda tunjukkan amat kami hargai.</p>
                    <p>Sebagai tanda penghargaan, kami sertakan <strong>Sijil Penyertaan</strong> anda dalam lampiran e-mel ini. Sila muat turun untuk simpanan anda.</p>
                    <p>Kami berharap dapat berjumpa anda lagi di acara akan datang!</p>
                    <p>Ikhlas,<br><strong>Urus Setia Penganjur Merdeka 6.8km Fun Run & Walk</strong></p>
                </div>
                <div class="footer">
                    <p>Ini adalah e-mel yang dijana secara automatik. Sila jangan balas e-mel ini.</p>
                </div>
            </div>
        </body>
        </html>
EOD;
        return $html;
    }

        public function hantar_semula_sijil($unique_id = '') {
        if (!$this->session->userdata('sijil_access_granted') || empty($unique_id)) {
            redirect('merdeka/sijil');
        }

        $decoded_id = urldecode($unique_id);
        $peserta = $this->peserta_fun_run_model->get_participant($decoded_id);

        if ($peserta && !empty($peserta['email'])) {
            $this->load->library('email');
            $serial_no = 'MFR2025-' . str_pad($peserta['id'], 5, '0', STR_PAD_LEFT);
            $pdf_path = $this->_generate_certificate_pdf($peserta['full_name'], $peserta['unique_id'], $serial_no);

            $this->email->clear(TRUE);
            $this->email->from('donotreply@inform.gov.my', 'Urus Setia Penganjur Merdeka Fun Run & Walk');
            $this->email->to($peserta['email']);
            $this->email->subject('Sijil Penyertaan Merdeka 6.8 KM Fun Run & Walk 2025 (Hantaran Semula)');
            $this->email->message('Berikut adalah salinan sijil penyertaan anda seperti yang diminta.');
            $this->email->attach($pdf_path);

            if ($this->email->send()) {
                $this->session->set_flashdata('result', ['status' => 'success', 'message' => 'Sijil untuk ' . html_escape($decoded_id) . ' telah berjaya dihantar semula.']);
            } else {
                $this->session->set_flashdata('result', ['status' => 'error', 'message' => 'Gagal menghantar semula e-mel. Sila semak konfigurasi e-mel anda.']);
            }
            unlink($pdf_path);
        } else {
            $this->session->set_flashdata('result', ['status' => 'error', 'message' => 'Peserta tidak dijumpai atau tidak mempunyai alamat e-mel.']);
        }
        redirect('merdeka/senarai_sijil');
    }


    public function senarai_sijil() {
        // Hanya admin yang log masuk dengan PIN boleh akses
        if (!$this->session->userdata('sijil_access_granted')) {
            redirect('merdeka/sijil');
        }

        // 1. Dapatkan senarai yang SUDAH terima sijil dari DB
        $data['recipients'] = $this->peserta_fun_run_model->get_certificate_recipients();

        // 2. Dapatkan SEMUA peserta dari Google Sheet
        $sheet_participants = $this->_get_sheet_data();

        // 3. Cipta senarai ID yang sudah terima untuk perbandingan mudah
        $recipient_ids = array();
        foreach ($data['recipients'] as $recipient) {
            $recipient_ids[] = $recipient['unique_id'];
        }

        // 4. Tapis untuk dapatkan senarai yang BELUM terima sijil
        $non_recipients = array();
        if ($sheet_participants) {
            foreach ($sheet_participants as $sheet_p) {
                $details = $this->_get_participant_details_from_row($sheet_p);
                // Jika peserta ada ID unik dan e-mel, dan ID itu TIADA dalam senarai penerima, tambah ke senarai 'belum terima'
                if (!empty($details['unique_id']) && !empty($details['email']) && !in_array($details['unique_id'], $recipient_ids)) {
                    $non_recipients[] = $details;
                }
            }
        }
        $data['non_recipients'] = $non_recipients;

        $this->load->view('merdeka2025/senarai_sijil_view', $data);
    }

    public function sijil() {
        $data = array();
        $data['error'] = $this->session->flashdata('error');
        if ($this->input->post('pin')) {
            if ($this->input->post('pin') == $this->sijil_pin) {
                $this->session->set_userdata('sijil_access_granted', TRUE);
            } else {
                $this->session->set_flashdata('error', 'PIN yang dimasukkan salah. Sila cuba lagi.');
            }
            redirect('merdeka/sijil');
        }
        $this->load->view('merdeka2025/sijil_view', $data);
    }

    public function proses_sijil() {
        if (!$this->session->userdata('sijil_access_granted')) {
            redirect('merdeka/sijil');
        }
        $this->load->library('email');
        $sheet_participants = $this->_get_sheet_data();
        $local_participants = $this->peserta_fun_run_model->get_all_participants();
        $sent_list = array();
        foreach ($local_participants as $p) {
            if (!empty($p['certificate_sent_at'])) {
                $sent_list[] = $p['unique_id'];
            }
        }
        $new_registrants = array();
        if ($sheet_participants) {
            foreach ($sheet_participants as $sheet_p) {
                $details = $this->_get_participant_details_from_row($sheet_p);
                if (!empty($details['unique_id']) && !empty($details['email']) && !in_array($details['unique_id'], $sent_list)) {
                    $new_registrants[] = $details;
                }
            }
        }
        $sent_count = 0;
        $fail_count = 0;
        if (!empty($new_registrants)) {
            foreach ($new_registrants as $peserta) {
                $local_data = $this->peserta_fun_run_model->ensure_participant_exists($peserta);
                $serial_no = 'MFR2025-' . str_pad($local_data['id'], 5, '0', STR_PAD_LEFT);
                $pdf_path = $this->_generate_certificate_pdf($peserta['full_name'], $peserta['unique_id'], $serial_no);

                // **PERUBAHAN DI SINI: Mesej E-mel HTML Baharu**
                $email_message = $this->_template_email_sijil($peserta['full_name']);


                $this->email->clear(TRUE);
                $this->email->from('donotreply@inform.gov.my', 'Urus Setia Penganjur Merdeka Fun Run & Walk');
                $this->email->to($peserta['email']);
                $this->email->subject('Sijil Penyertaan Merdeka 6.8 KM Fun Run & Walk');
                $this->email->message($email_message);
                $this->email->attach($pdf_path);
                if ($this->email->send()) {
                    $this->peserta_fun_run_model->mark_certificate_sent($peserta['unique_id']);
                    $sent_count++;
                } else {
                    $fail_count++;
                }
                unlink($pdf_path);
            }
        }
        $message = "Proses selesai. " . $sent_count . " sijil baharu telah berjaya dihantar. " . $fail_count . " e-mel gagal dihantar.";
        $this->session->set_flashdata('result', array('status' => 'success', 'message' => $message));
        $this->session->unset_userdata('sijil_access_granted');
        redirect('merdeka/sijil');
    }

    public function tambah_manual() {
        if (!$this->session->userdata('sijil_access_granted')) {
            redirect('merdeka/sijil');
        }
        $unique_id = $this->input->post('unique_id');
        $is_unique = TRUE;
        $message = '';
        $local_participant = $this->peserta_fun_run_model->get_participant($unique_id);
        if ($local_participant) {
            $is_unique = FALSE;
            $message = 'Gagal: Peserta dengan No. KP/Pasport ini sudah wujud dalam pangkalan data tempatan.';
        }
        if ($is_unique) {
            $sheet_participants = $this->_get_sheet_data();
            if ($sheet_participants) {
                foreach ($sheet_participants as $row) {
                    if (isset($row[$this->unique_column_name]) && strcasecmp(trim($row[$this->unique_column_name]), trim($unique_id)) == 0) {
                        $is_unique = FALSE;
                        $message = 'Gagal: Peserta dengan No. KP/Pasport ini sudah wujud dalam senarai pendaftaran Google Sheet.';
                        break;
                    }
                }
            }
        }
        if ($is_unique) {
            $new_participant_data = array(
                'unique_id'  => $unique_id,
                'full_name'  => $this->input->post('full_name'),
                'email'      => $this->input->post('email'),
                'shirt_size' => $this->input->post('shirt_size')
            );
            if ($this->peserta_fun_run_model->add_manual_participant($new_participant_data)) {
                $message = 'Berjaya: Peserta baharu telah ditambah secara manual.';
                $this->session->set_flashdata('result', array('status' => 'success', 'message' => $message));
            } else {
                $message = 'Gagal: Ralat pangkalan data semasa cuba menambah peserta.';
                $this->session->set_flashdata('result', array('status' => 'error', 'message' => $message));
            }
        } else {
            $this->session->set_flashdata('result', array('status' => 'error', 'message' => $message));
        }
        redirect('merdeka/sijil');
    }

    public function muat_turun_sijil($unique_id = '') {
        if (!$this->session->userdata('sijil_access_granted') || empty($unique_id)) {
            redirect('merdeka/sijil');
        }
        $decoded_id = urldecode($unique_id);
        $peserta = $this->peserta_fun_run_model->get_participant($decoded_id);
        if ($peserta) {
            $serial_no = 'MFR2025-' . str_pad($peserta['id'], 5, '0', STR_PAD_LEFT);
            $pdf_content = $this->_generate_certificate_pdf($peserta['full_name'], $peserta['unique_id'], $serial_no, TRUE); // TRUE untuk dapatkan output
            $nama_fail = 'Sijil-MerdekaFunRun-' . preg_replace('/[^a-zA-Z0-9]/', '', $decoded_id) . '.pdf';
            force_download($nama_fail, $pdf_content);
            exit;
        }
    }

    private function _generate_certificate_pdf($nama_peserta, $unique_id, $serial_no, $return_output = FALSE) {
        // **PEMBETULAN DI SINI:** Gunakan require_once untuk mengelakkan ralat
        require_once(APPPATH . 'third_party/fpdf/fpdf.php');
        $upload_dir = FCPATH . 'uploads';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, TRUE);
        }
        
        // **PERUBAHAN DI SINI: Tukar 'L' kepada 'P' untuk Potret**
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        
        // **PERUBAHAN DI SINI: Tukar saiz imej kepada saiz A4 Potret**
        $pdf->Image(APPPATH . 'assets/sijil/sijil_kosong.jpeg', 0, 0, 210, 297);
        
        // **PERUBAHAN DI SINI: Selaraskan kedudukan teks untuk Potret**
        // Anda mungkin perlu mengubah nilai ini agar sepadan dengan templat anda
        $pdf->SetXY(10, 58); 
        $pdf->SetFont('Arial', 'B', 20);
        $nama_peserta_utf8 = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $nama_peserta);
        $pdf->Cell(190, 10, strtoupper($nama_peserta_utf8), 0, 1, 'C');
        
        $pdf->SetXY(10, 65);
        $pdf->SetFont('Arial', '', 16);
        $unique_id_utf8 = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $unique_id);
        $pdf->Cell(190, 10, $unique_id_utf8, 0, 1, 'C');
        
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetTextColor(255, 0, 0);
        $serial_no_text = 'No. Siri: ' . $serial_no;
        $string_width = $pdf->GetStringWidth($serial_no_text);
        $x_position = 210 - 3 - $string_width; // Lebar halaman potret - margin kanan - lebar teks
        $pdf->SetXY($x_position, 3);
        $serial_no_utf8 = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $serial_no_text);
        $pdf->Cell($string_width, 10, $serial_no_utf8, 0, 1, 'L');
        $pdf->SetTextColor(0, 0, 0);
        
        if ($return_output) {
            return $pdf->Output(NULL, 'S'); // 'S' untuk dapatkan sebagai string
        } else {
            $file_path = $upload_dir . '/sijil_' . time() . '_' . rand() . '.pdf';
            $pdf->Output($file_path, 'F'); // 'F' untuk simpan sebagai fail
            return $file_path;
        }
    }


    // Memaparkan halaman semakan penamat
public function penamat() {
    $data['result'] = $this->session->flashdata('result');
    $this->load->view('merdeka2025/finisher_view', $data);
}

public function carian_penamat() {
        $search_id = $this->input->post('search_term');
        $result = array();

        if (empty($search_id)) {
            $result['status'] = 'error';
            $result['message'] = 'Sila masukkan ID Peserta untuk membuat carian.';
        } else {
            // Bersihkan input pengguna untuk hanya menyimpan nombor dan huruf
            $cleaned_search_id = preg_replace('/[^a-zA-Z0-9]/', '', $search_id);

            $sheet_participants = $this->_get_sheet_data();
            $found_in_sheet = NULL;

            if ($sheet_participants) {
                foreach ($sheet_participants as $row) {
                     if (isset($row[$this->unique_column_name])) {
                        // Bersihkan data dari sheet untuk perbandingan
                        $cleaned_sheet_id = preg_replace('/[^a-zA-Z0-9]/', '', $row[$this->unique_column_name]);
                        
                        if (!empty($cleaned_sheet_id) && strcasecmp($cleaned_sheet_id, $cleaned_search_id) == 0) {
                            $found_in_sheet = $row;
                            break;
                        }
                    }
                }
            }

            if ($found_in_sheet) {
                // Gunakan ID asal dari sheet (dengan aksara khas) untuk semakan DB
                $original_sheet_id = trim($found_in_sheet[$this->unique_column_name]);
                $local_participant = $this->peserta_fun_run_model->get_participant($original_sheet_id);
                $result['participant'] = $this->_get_participant_details_from_row($found_in_sheet);

                if ($local_participant && $local_participant['finished_at'] !== NULL) {
                    $result['status'] = 'warning';
                    $result['message'] = 'Peserta ini SUDAH direkodkan tamat pada ' . date('d F Y, g:i a', strtotime($local_participant['finished_at']));
                } else {
                    $result['status'] = 'success';
                    $result['message'] = 'Peserta disahkan! LAYAK untuk direkod sebagai penamat.';
                }
            } else {
                $result['status'] = 'error';
                $result['message'] = 'Peserta dengan ID "' . html_escape($search_id) . '" tidak dijumpai dalam senarai pendaftaran induk.';
            }
        }
    
        $this->session->set_flashdata('result', $result);
        redirect('merdeka/penamat');
    }


// Menanda peserta sebagai telah tamat
public function tanda_tamat($unique_id) {
    if (!empty($unique_id)) {
        $decoded_id = urldecode($unique_id);

        // Dapatkan semula butiran penuh dari Google Sheet untuk integriti data
        $sheet_participants = $this->_get_sheet_data();
        $found_in_sheet = NULL;
        foreach ($sheet_participants as $row) {
            if (isset($row[$this->unique_column_name]) && strcasecmp(trim($row[$this->unique_column_name]), trim($decoded_id)) == 0) {
                $found_in_sheet = $row;
                break;
            }
        }

        if ($found_in_sheet) {
            $participant_data = $this->_get_participant_details_from_row($found_in_sheet);
            if ($this->peserta_fun_run_model->add_and_mark_finished($participant_data)) {
                $result['status'] = 'success';
                $result['message'] = 'Peserta ' . html_escape($decoded_id) . ' berjaya direkod sebagai penamat.';
            } else {
                $result['status'] = 'error';
                $result['message'] = 'Gagal merekod. Peserta mungkin sudah direkodkan sebelumnya.';
            }
            $result['participant'] = $this->peserta_fun_run_model->get_participant($decoded_id);
            $this->session->set_flashdata('result', $result);
        } else {
            // Kes jarang berlaku jika data hilang antara carian dan klik
            $result['status'] = 'error';
            $result['message'] = 'Gagal mengesahkan peserta dari senarai induk.';
            $this->session->set_flashdata('result', $result);
        }
    }
    redirect('merdeka/penamat');
}



    public function __construct() {
        parent::__construct();
        $this->load->model('peserta_fun_run_model');
        $this->load->helper(array('url', 'download')); // Muatkan helper download
        $this->load->library('session');
    }

    public function index() {
        $this->peserta_fun_run_model->setup_database_table();
        $data['result'] = $this->session->flashdata('result');
        $this->load->view('merdeka2025/checkin_view', $data);
    }

    // New function to test the Google Sheet connection.
    // Access this via your-site.com/index.php/merdeka/debug_sheet
    public function debug_sheet() {
        echo "<h1>Attempting to fetch Google Sheet...</h1>";
        $sheet_data = $this->_get_sheet_data();

        if ($sheet_data === FALSE) {
            die("<h2>ERROR: Failed to retrieve data from Google Sheet.</h2><p>This likely means your server's firewall is blocking the outgoing connection, or there is a problem with the cURL extension. Please check your server's PHP error logs for more details.</p>");
        }

        if (empty($sheet_data)) {
            die("<h2>ERROR: The sheet data is empty.</h2><p>The script retrieved the file, but it contains no data or could not be parsed.</p>");
        }

        echo "<h2>Sheet data retrieved successfully!</h2>";
        echo "<p>This means the connection to Google is working. Please verify that the column names below match the ones in your code EXACTLY (case-sensitive).</p>";
        echo "<pre>";
        print_r($sheet_data[0]); // Print the first row of data
        echo "</pre>";
    }

    public function search() {
        $search_id = $this->input->post('search_term');
        $result = array();

        if (empty($search_id)) {
            $result['status'] = 'error';
            $result['message'] = 'Sila masukkan ID Peserta untuk membuat carian.';
        } else {
            // Bersihkan input pengguna untuk hanya menyimpan nombor dan huruf
            $cleaned_search_id = preg_replace('/[^a-zA-Z0-9]/', '', $search_id);
            
            $sheet_participants = $this->_get_sheet_data();
            $found_in_sheet = NULL;

            if ($sheet_participants) {
                foreach ($sheet_participants as $row) {
                    if (isset($row[$this->unique_column_name])) {
                        // Bersihkan data dari sheet untuk perbandingan
                        $cleaned_sheet_id = preg_replace('/[^a-zA-Z0-9]/', '', $row[$this->unique_column_name]);
                        
                        if (!empty($cleaned_sheet_id) && strcasecmp($cleaned_sheet_id, $cleaned_search_id) == 0) {
                            $found_in_sheet = $row;
                            break;
                        }
                    }
                }
            }

            if ($found_in_sheet) {
                // Gunakan ID asal dari sheet (dengan aksara khas) untuk semakan DB
                $original_sheet_id = trim($found_in_sheet[$this->unique_column_name]);
                $local_participant = $this->peserta_fun_run_model->get_participant($original_sheet_id);
                $result['participant'] = $this->_get_participant_details_from_row($found_in_sheet);

                if ($local_participant && $local_participant['collected_at'] !== NULL) {
                    $result['status'] = 'warning';
                    $result['message'] = 'Peserta ini SUDAH mengambil baju mereka pada ' . date('d F Y, g:i a', strtotime($local_participant['collected_at']));
                } else {
                    $result['status'] = 'success';
                    $result['message'] = 'Peserta dijumpai! Mereka LAYAK untuk mengambil baju.';
                }
            } else {
                $result['status'] = 'error';
                $result['message'] = 'Peserta dengan ID "' . html_escape($search_id) . '" tidak dijumpai dalam senarai pendaftaran.';
            }
        }
        
        $this->session->set_flashdata('result', $result);
        redirect('merdeka/index');
    }


    public function mark_collected($unique_id) {
        if (!empty($unique_id)) {
            $decoded_id = urldecode($unique_id);
            $sheet_participants = $this->_get_sheet_data();
            $found_in_sheet = NULL;

            if ($sheet_participants !== FALSE) {
                foreach ($sheet_participants as $row) {
                    if (isset($row[$this->unique_column_name]) && strcasecmp(trim($row[$this->unique_column_name]), trim($decoded_id)) == 0) {
                        $found_in_sheet = $row;
                        break;
                    }
                }
            }

            if ($found_in_sheet) {
                $participant_data_to_save = $this->_get_participant_details_from_row($found_in_sheet);

                if (!empty($participant_data_to_save['unique_id'])) {
                    if ($this->peserta_fun_run_model->add_and_mark_collected($participant_data_to_save)) {
                        $result['status'] = 'success';
                        $result['message'] = 'Peserta ' . html_escape($decoded_id) . ' berjaya ditanda sebagai sudah diambil.';
                    } else {
                        $result['status'] = 'error';
                        $result['message'] = 'Database error. Could not mark participant as collected.';
                    }
                } else {
                     $result['status'] = 'error';
                     $result['message'] = 'Critical error: Participant ID is missing from sheet data. Cannot save.';
                }
                $result['participant'] = $participant_data_to_save;
                $this->session->set_flashdata('result', $result);
            } else {
                 $result['status'] = 'error';
                 $result['message'] = 'Could not find participant to mark as collected. The Google Sheet might be unavailable.';
                 $this->session->set_flashdata('result', $result);
            }
        }
        redirect('merdeka/index');
    }

    private function _get_participant_details_from_row($row) {
        return array(
            'unique_id'  => isset($row['NRIC/Passport Number']) ? trim($row['NRIC/Passport Number']) : '',
            'full_name'  => isset($row['Nama Penuh']) ? trim($row['Nama Penuh']) : '',
            'email'      => isset($row['e-Mel']) ? trim($row['e-Mel']) : '',
            'shirt_size' => isset($row['T-Shirt Size']) ? trim($row['T-Shirt Size']) : ''
        );
    }

    private function _get_sheet_data()
    {
        // Check for cURL support
        if (!function_exists('curl_init')) {
            log_message('error', 'cURL is not enabled on the server.');
            return FALSE;
        }

        // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->sheet_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        $csv_string = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Check HTTP response
        if ($http_code != 200 || $csv_string === FALSE) {
            log_message('error', 'Failed to fetch sheet data. HTTP Code: ' . $http_code);
            return FALSE;
        }

        $lines = explode("\n", $csv_string);
        if (count($lines) < 2) {
            log_message('error', 'CSV content is too short.');
            return FALSE;
        }

        $headers = str_getcsv(trim(array_shift($lines)));
        $data = array();

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') continue;

            $row_data = str_getcsv($line);
            if (count($headers) == count($row_data)) {
                $row = array_combine($headers, $row_data);
                $data[] = $row;
            } else {
                log_message('debug', 'Skipped CSV row due to header/data count mismatch.');
            }
        }

        return $data;
    }

            public function dashboard() {
        // Dapatkan data pendaftaran daripada Google Sheet
        $sheet_participants = $this->_get_sheet_data();
        $data['total_registered'] = ($sheet_participants !== FALSE) ? count($sheet_participants) : 0;

        // Dapatkan jumlah kutipan daripada pangkalan data tempatan
        $data['total_collected'] = $this->peserta_fun_run_model->get_total_collected();

        // TAMBAH BARIS INI untuk mendapatkan jumlah penamat (penerima medal)
    $data['total_finishers'] = $this->peserta_fun_run_model->get_total_finishers();

        // Kira peratusan
        if ($data['total_registered'] > 0) {
            $data['percentage'] = round(($data['total_collected'] / $data['total_registered']) * 100, 2);
        } else {
            $data['percentage'] = 0;
        }

        // Muatkan paparan papan pemuka yang baharu
        $this->load->view('merdeka2025/dashboard_view', $data);
    }





}
