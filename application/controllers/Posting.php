<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posting extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper('string');
        $this->load->library('bbb');
        date_default_timezone_set('Europe/Istanbul');
        if(!$this->session->userdata('id')){
            redirect(base_url('login'));
        }
        if($this->session->userdata('level') != 'admin'){
            //redirect(base_url('home'));
        }
    }

    function index(){

        $data['title'] = "Atama";
        $data['record'] = $this->main_model->getTable('record');
        $this->load->view('admin/_master/head',$data);
        $this->load->view('admin/_master/header',$data);
        $this->load->view('admin/_master/navbar',$data);
        $this->load->view('admin/posting/index',$data);
        $this->load->view('admin/_master/footer',$data);
    }

    function addNewUser_do(){
        $data = $_POST;
        $data['password'] = md5($data['password']);

        $this->main_model->basicinsert('user',$data);
        redirect(base_url('posting'));
    }

    function getUserData(){
        echo json_encode($this->main_model->getRow('user',['id' => $_POST['id']]));
    }

    function editUser_do(){
       $data = $_POST;
       if (empty($data['password'])){
           unset($data['password']);
       }else{
           $data['password'] = md5($data['password']);
       }

       $this->main_model->basicupdate('user',$data,'id',$data['id']);
        redirect(base_url('posting'));
    }
}