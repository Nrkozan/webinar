<?php

function send_mail($mesagge,$to,$subject,$attachFile = false){

    $ci=& get_instance();

    $mail = $ci->main_model->getRow('site_config');

    if ($mail->engine == 'smtp'){
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = $mail->host;
        $config['smtp_port'] = $mail->port;
        $config['smtp_user'] = $mail->user;
        $config['smtp_pass'] = $mail->pass;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
    }
    elseif($mail->engine == 'imap'){
        $config['protocol'] = 'imap';
        $config['imap_host'] = $mail->host;
        $config['imap_port'] = $mail->port;
        $config['imap_user'] = $mail->user;
        $config['imap_pass'] = $mail->pass;
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['smtp_crypto']  = 'ssl';
        $config['charset'] = 'utf-8';
        $config['smtp_timeout'] = 4;
        $config['newline'] = "\r\n";
    }
    else{
        return false;
    }

    $ci->load->library('email', $config);
    $ci->email->set_newline("\r\n");
    $ci->email->from($mail->user,$mail->sender); // change it to yours
    $ci->email->to($to);// change it to yours
    $ci->email->subject($subject);
    $ci->email->message($mesagge);
    if ($attachFile){
        $ci->email->attach($attachFile);
    }

    if($ci->email->send())
        return true;
    else
        return $ci->email->print_debugger();
}

function confirm_mail_draft($token){
    $mesagge  = "<h3>Academic Platform</h3>";
    $mesagge .= "<h4>".$_SESSION['event_set']->name."</h4>";
    $mesagge .= "Confirm email address<br>";
    $mesagge .= "<a href='".cLinkSafe('login/mail_approve?token=').$token."'>Click to confirm</a><br>";
    $mesagge .= "Or goto link : ".cLinkSafe('login/mail_approve?token=').$token;
    return $mesagge;
}

function your_paper_uploaded($paper){
    $mesagge  = "<h3>Academic Platform</h3>";
    $mesagge .= "<h4>".$_SESSION['event_set']->name."</h4>";
    $mesagge .= $paper." has been received. Your paper has been uploaded to the system. Thank you <br>";
    return $mesagge;
}

function reset_password_draft($pw){
    $mesagge  = "<h3>Academic Platform</h3>";
    $mesagge .= "<h4>".$_SESSION['event_set']->name."</h4>";
    $mesagge .= "<b>Your new password: </b>". $pw;
    $mesagge .= "<br>Don't share your password with anyone";
    return $mesagge;
}

function event_statistics($event){
    $ci=& get_instance();
    $data['totalPaper'] = $ci->main_model->getNumRows('paper',['event' => $event],'id');
    $data['totalUser'] = $ci->main_model->getNumRows('user_event',['event' => $event],'id');
    $data['totalAuthor'] = $ci->main_model->getNumRows('author_paper',['event' => $event],'id');
    return $data;
}

