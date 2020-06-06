<?php
defined('BASEPATH') OR exit('No direct script allowed');

class My_Controller extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->library('session');
        $this->load->model('main_model');
        date_default_timezone_set('Europe/Istanbul');

        if (empty($_SESSION['lang'])){
            $_SESSION['lang'] = 'en';
        }

        $this->lang->load($_SESSION['lang'],$_SESSION['lang']);

    }

}