<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jacc extends CI_Controller {

    public function index()
    {
        $this->load->view('jacc/login');
    }

}
