<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends My_Controller
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

        $server = null;
        foreach ($this->main_model->getTable('server') as $row){
            $alfa = getMeetings($row->id)->meetings;
            $server[$row->id]['data'] = $alfa;
            $server[$row->id]['meetingCount'] = count($alfa->meeting);
            $server[$row->id]['participantCount'] = 0;
            foreach ($alfa->meeting as $sub1){
                $server[$row->id]['participantCount'] += $sub1->participantCount;
            }
        }

        $data['title'] = "Panel";
        $data['server'] = $server;
        $this->load->view('_master/head',$data);
        $this->load->view('_master/header',$data);
        $this->load->view('_master/navbar',$data);
        $dir = $this->session->userdata('level');
        $this->load->view('home/'.$dir,$data);
        $this->load->view('_master/footer',$data);

    }



    function download(){
        $id = $this->uri->segment(3);
        $record = $this->main_model->getRow('records',['id' => $id]);
        $this->main_model->basicupdate('records',['downloads' => ($record->downloads + 1)],'id',$id);
        header("Location: ".$record->mp4);
    }

    function allList(){

        $data['title'] = "Panel";
        $this->load->view('admin/_master/head',$data);
        $this->load->view('admin/_master/header',$data);
        $this->load->view('admin/_master/navbar',$data);
        $this->load->view('admin/rcList',$data);
        $this->load->view('admin/_master/footer',$data);
    }

    function insert(){
        $this->google->validate();
        $this->google->gdriveList();
    }

    function uploadGdrive(){
        $id = $_POST['id'];
        $record = $this->main_model->getRow('records',['id' =>$id]);
        $this->google->validate();
        echo json_encode($this->google->upload_gdrive($record->mp4,$record->name.$record->id));
    }

}