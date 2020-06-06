<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends My_Controller
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
        $data['title'] = "Dashboard";
        $this->load->view('_master/head',$data);
        $this->load->view('_master/header',$data);
        $this->load->view('_master/navbar',$data);
        $dir = $this->session->userdata('level');
        $this->load->view('server/'.$dir,$data);
        $this->load->view('_master/footer',$data);
    }

    function posting(){
        $data['title'] = "Dashboard";
        $this->load->view('_master/head',$data);
        $this->load->view('_master/header',$data);
        $this->load->view('_master/navbar',$data);
        $dir = $this->session->userdata('level');
        $this->load->view('server/posting',$data);
        $this->load->view('_master/footer',$data);
    }

    function records(){
        $data['title'] = "Dashboard";
        $this->load->view('_master/head',$data);
        $this->load->view('_master/header',$data);
        $this->load->view('_master/navbar',$data);
        $dir = $this->session->userdata('level');
        $this->load->view('records/'.$dir,$data);
        $this->load->view('_master/footer',$data);
    }

    function changeStatus(){


        $server = $this->main_model->getRow('server',['id' => $_POST['id']]);
        if ($server->active == 1){
            $alfa['active'] = 0;
        }else{
            $alfa['active'] = 1;
        }
        $this->main_model->basicupdate('server',$alfa,'id',$_POST['id']);
        echo json_decode("1");
    }

    function getData(){
        echo json_encode($this->main_model->getRow('server',['id' => $_POST['id']]));
    }

    function update_do(){
        $data = $_POST;
        $this->main_model->basicupdate('server',$data,'id',$_POST['id']);
        redirect(base_url('server'));
    }

    function add(){
        $data = $_POST;
        $result = simplexml_load_string(curlXML($data['bbb_url'].'/api'));
        if ($result->returncode == 'SUCCESS'){
            $key = sha1('getMeetings'.$data['bbb_secret']);
            $param = $data['bbb_url'].'api/getMeetings?checksum='.$key;
            $resultData = simplexml_load_string(curlXML($param));
            if ($resultData->returncode == "SUCCESS"){
                $this->main_model->basicinsert('server',$data);
                $this->session->set_flashdata('msg',['text' => "Server Created",'color' => 'success']);
                redirect(base_url('server'));
            }else{
                $this->session->set_flashdata('msg',['text' => "Api Connect Error",'color' => 'error']);
                redirect($_SERVER['HTTP_REFERER']);
            }
        }else{
            $this->session->set_flashdata('msg',['text' => "Api Connect Error",'color' => 'error']);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function delete(){
        $this->main_model->basicdelete('server','id', $this->uri->segment(3));
        redirect(base_url('server'));
    }

    function user_remove(){
        $this->main_model->basicdelete('user_server','id', $this->uri->segment(3));
        redirect($_SERVER['HTTP_REFERER']);
    }

    function user_add(){
        $data = $_POST;
        $this->main_model->basicinsert('user_server',$data);
        redirect($_SERVER['HTTP_REFERER']);
    }


}