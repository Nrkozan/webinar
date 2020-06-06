<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper('string');
        $this->load->library('google');

    }

    function index(){

        $this->load->view('other/login');
    }

    function register(){
        $this->load->view('other/register');
    }

    function register_do(){
        $data = $_POST;
        if ($data['mail'] != $data['mail2']){
            $this->session->set_flashdata('login_alert', "Email not match");
            redirect($_SERVER['HTTP_REFERER']);
        }
        if ($this->main_model->getRow('user',['mail' => $data['mail']])){
            $this->session->set_flashdata('login_alert', "Email already taken");
            redirect($_SERVER['HTTP_REFERER']);
        }
        else{
            unset($data['mail2']);
            $data['password'] = md5($data['password']);
            $data['level'] = 'manager';
            $this->main_model->basicinsert('user',$data);

            $user = $this->main_model->getRow('user',['mail' => $data['mail']]);
            $sesionData = json_decode(json_encode($user),true);
            $this->session->set_userdata($sesionData);
            redirect(base_url('home'));

        }
    }

    function sign_in_do(){
       // $this->load->library('bbb');
        $username =  $this->input->post('username');
        $pw =  md5($this->input->post('password'));

        if ($user = $this->main_model->getRow('user',['mail' => $username])){
            if ($user->password == $pw){
                $sesionData = json_decode(json_encode($user),true);
                $this->session->set_userdata($sesionData);
                redirect(base_url('home'));
            }
            else{
                $this->session->set_flashdata('login_alert', [
                    'color' => 'danger',
                    'title' => place('error',true),
                    'text' => place('pwnotmatch',true)
                ]);
                redirect($_SERVER['HTTP_REFERER']);
            }
        }else{
            $this->session->set_flashdata('login_alert', [
                'color' => 'danger',
                'title' => place('error',true),
                'text' => place('Mail_not_registered',true)
            ]);
            redirect($_SERVER['HTTP_REFERER']);
        }

        $this->session->set_flashdata('login_alert', [
            'color' => 'danger',
            'title' => place('error',true),
            'text' => place('error',true)
        ]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    function logout(){
        $this->session->unset_userdata(array('id','password','mail'));
        $this->session->set_flashdata('login_alert', [
            'color' => 'success',
            'title' => place('success',true),
            'text' => place('session_closed_successfully',true)
        ]);
        redirect(base_url('login'));
    }

    function googlelogin(){
        $gdata=$this->google->validate();
        $alfa['name'] = $gdata['name'];
        $alfa['id'] = $gdata['id'];
        $alfa['picture'] = $gdata['picture'];
        $alfa['email'] = $gdata['email'];
        $_SESSION['user'] = $alfa;
        if ($this->main_model->getRow('user',['mail' => $gdata['email']])){
            $user = $this->main_model->getRow('user',['mail' => $gdata['email']]);
            $sesionData = json_decode(json_encode($user),true);
            $this->session->set_userdata($sesionData);
            redirect(base_url('home'));

        }else{
            $beta['name'] = $gdata['name'];
            $beta['google_id'] = $gdata['id'];
            $beta['mail'] = $gdata['email'];
            $beta['level'] = 'manager';
            $this->main_model->basicinsert('user',$beta);

            $user = $this->main_model->getRow('user',['mail' => $gdata['email']]);
            $sesionData = json_decode(json_encode($user),true);
            $this->session->set_userdata($sesionData);
            redirect(base_url('home'));
        }
        redirect(base_url('login'));
    }

    function logout_google(){
        unset($_SESSION['access_token']);
        unset($_SESSION['user']);
        redirect(base_url('home'));
    }
}