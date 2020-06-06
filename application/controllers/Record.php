<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Record extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper('string');
        $this->load->library('bbb');
        date_default_timezone_set('Europe/Istanbul');
    }

    function index(){

        $data['record'] = $this->main_model->getTable('record');
        $this->load->view('admin/_master/head');
        $this->load->view('admin/_master/header');
        $this->load->view('admin/_master/navbar');
        $this->load->view('admin/record/index',$data);
        $this->load->view('admin/_master/footer');


        /* $this->load->library('bbb');
         foreach ($this->bbb->getRecord()->getRawXml()->recordings->recording as $row){
             codepreview($row);
         }*/
    }
}