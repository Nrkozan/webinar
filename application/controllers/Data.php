<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends My_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper('string');
        $this->load->helper('bbb');
        $this->load->library('google');
        if(!$this->session->userdata('id')){
            redirect(base_url('login'));
        }
    }

    function getMettingsModal(){
        $data = getMeetingsInfo($_POST['server'],$_POST['id']);
        //codepreview($data);
        echo json_encode($this->load->view('cmp/meetingDetail',$data,true));
    }

    function getMettingPartipicant(){
        $data = getMeetingsInfo($_POST['server'],$_POST['id']);
        echo json_encode($this->load->view('cmp/meetingPartipacantDetail',$data,true));
    }
}