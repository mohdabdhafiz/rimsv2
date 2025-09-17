<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.gmail.com'; // Contoh untuk Gmail
$config['smtp_port'] = 465;
$config['smtp_user'] = 'hafizawang@inform.gov.my'; // Gantikan dengan alamat e-mel anda
$config['smtp_pass'] = 'qdqm unyt jrkj nrjd'; // GANTIKAN dengan kata sandian aplikasi (bukan kata sandian biasa)
$config['mailtype']  = 'html';
$config['charset']   = 'utf-8';
$config['newline']   = "\r\n";
$config['wordwrap']  = TRUE;