<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends My_Controller
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

    function index(){
        $data['title'] = "User List";
        $this->load->view('_master/head',$data);
        $this->load->view('_master/header',$data);
        $this->load->view('_master/navbar',$data);
        $dir = $this->session->userdata('level');
        $this->load->view('user/list/'.$dir,$data);
        $this->load->view('_master/footer',$data);
    }

    function getData(){
        echo json_encode($this->main_model->getRow('user',['id' => $_POST['id']]));
    }

    function update_do(){
      $data = $_POST;
      $this->main_model->basicupdate('user',$data,'id',$data['id']);
        $this->session->set_flashdata('msg', ['color' => 'success','text' => 'User data updated']);
      redirect(base_url('user'));
    }

    function update_password_do(){
        $data = $_POST;
        $data['password'] = md5($data['password']);
        $this->main_model->basicupdate('user',$data,'id',$_POST['id']);
        $this->session->set_flashdata('msg', ['color' => 'success','text' => 'User password updated']);
        redirect(base_url('user'));
    }

    function delete(){
        $this->main_model->basicdelete('user','id', $this->uri->segment(3));
        $this->main_model->basicdelete('user','staff', $this->uri->segment(3));
        $this->main_model->basicdelete('server','owner', $this->uri->segment(3));
        $this->session->set_flashdata('msg', ['color' => 'success','text' => 'User removed']);
        redirect(base_url('user'));
    }

    function add_manager_do(){
        $data = $_POST;
        if (!$this->main_model->getRow('user',['mail' => $data['mail']])){
            $data['password'] = md5($data['password']);
            $data['staff'] = $this->session->userdata('id');
            $data['level'] = 'staff';
            $this->main_model->basicinsert('user',$data);

            $this->session->set_flashdata('msg', ['color' => 'success','text' => 'New user created']);
            redirect(base_url('user'));
        }else{
            $this->session->set_flashdata('msg', ['color' => 'error','text' => 'Mail is already registered']);
            redirect($_SERVER['HTTP_REFERER']);
        }

    }
}