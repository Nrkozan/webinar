<?php

//Xss and php tag clean
function xssClean($val){
    $ci=& get_instance();
    $ci->load->helper('security');
    return encode_php_tags($ci->security->xss_clean($val));
}


//Set custom javascript
function jsSet($arr = array(),$path,$pathBase = false){
    if (!$path){
        $path = base_url('assets/admin/');
    }
    $block ="";
    array_unique($arr);
    foreach ($arr as $row){
        $block .= "<script src='".$path."$row'></script>\n";
    }
    return $block;
}


function uniqkey($tabloadi,$satiradi)
{
    $ci=& get_instance();
    do
    {
        $key = substr(str_shuffle('123456789') , 0, 8);
        $query = $ci->db->query("SELECT ".$tabloadi.".".$satiradi." FROM ".$tabloadi."
	        WHERE ".$tabloadi.".".$satiradi." LIKE '" . $key . "'");
    }
    while ($query->num_rows() > 0);

    return $key;
}

// fast view mainFolder = front or back
function fView ($mainFolder,$view,$data){
    $ci=& get_instance();

    $mainFolder = $ci->session->userdata('level');


    $ci->load->view($mainFolder.'/_master/head',$data);

    if ($mainFolder == 'user' || $mainFolder == 'manager' || $mainFolder == 'referee'){
        $ci->load->view($mainFolder.'/_master/header',$data);
        $ci->load->view($mainFolder.'/_master/navbar',$data);
        $ci->load->view($mainFolder.'/'.$view, $data);
        $ci->load->view($mainFolder.'/_master/footer',$data);
    }
    elseif ($mainFolder == 'admin'){
        $ci->load->view($mainFolder.'/_master/navbar',$data);
        $ci->load->view($mainFolder.'/_master/sidebar',$data);
        $ci->load->view($mainFolder.'/'.$view, $data);
        $ci->load->view($mainFolder.'/_master/footer',$data);
    }
    elseif ($mainFolder == 'classfield'){
        if ($view != 'index'){
            $ci->load->view($mainFolder.'/_master/header',$data);
        }
        $ci->load->view($mainFolder.'/'.$view, $data);
        $ci->load->view($mainFolder.'/_master/footer',$data);
        $ci->load->view($mainFolder.'/_master/popup',$data);
        $ci->load->view($mainFolder.'/_master/foot',$data);
    }


}


function dmyDate($date){
    return date('d-m-Y', strtotime($date));
}

function getFileExtension($file){
    return strtolower(strrchr($file,'.'));
}

function file_upload_add($files,$path,$input,$name = array()){
    $ci=& get_instance();
    if ($files[$input]['name'] != NULL){
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        if ($name){
            $config['file_name'] = $name['pre'].$name['last'];
        }else{
            $config['encrypt_name'] = TRUE;
        }
        $config['max_size']     = '52224';
        $ci->load->library('upload', $config);
        if (!$ci->upload->do_upload($input))
        {
            $error = array('error' => $ci->upload->display_errors());
            print_r($error);
           return false;
        }
        else
        {
            $filedata = $ci->upload->data();
            return $filedata['file_name'];
        }
    }
}

function dateRevision($revsion,$date = false,$time = false){
    if (!$date){
        $date = date('Y-m-d');
    }
    if (!$time){
        return date( "Y-m-d", strtotime( "$date $revsion" ) );
    }else{
        return date( "Y-m-d H:i:s", strtotime( "$date $revsion" ) );
    }

}

function siteName(){
    return " - Bakkal Sepeti";
}

function multipleUpload($path,$input){
    $data = [];
    $ci=& get_instance();
    $count = count($_FILES[$input]['name']);

    for($i=0;$i<$count;$i++){

        if(!empty($_FILES[$input]['name'][$i])){

            $_FILES['file']['name'] = $_FILES[$input]['name'][$i];
            $_FILES['file']['type'] = $_FILES[$input]['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES[$input]['tmp_name'][$i];
            $_FILES['file']['error'] = $_FILES[$input]['error'][$i];
            $_FILES['file']['size'] = $_FILES[$input]['size'][$i];

            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']     = '5222';
            $config['encrypt_name'] = TRUE;

            $ci->load->library('upload',$config);

            if($ci->upload->do_upload('file')){
                $uploadData = $ci->upload->data();
                $filename = $uploadData['file_name'];
                $data['totalFiles'][] = $filename;
            }
        }
    }

    return $data;

}

function limit_text($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}


function place($mainText,$safe = false){
    $ci=& get_instance();
    if ($safe){
        return $ci->lang->line($mainText);
    }
    else{
        echo $ci->lang->line($mainText);
    }
    return false;
}

function cLink($url,$get = NULL){
    $ci=& get_instance();
    if($get == NULL){
        echo $newUrl = base_url(). $ci->uri->segment(1).'/'.$url;
    }
    else {
        echo $newUrl = base_url(). $_SESSION['ecode'].'/'.$url.$get;
    }

    return TRUE;
}

function cLinkSafe($url,$get = NULL){
    $ci=& get_instance();
    if($get == NULL){
        return $newUrl = base_url().$ci->uri->segment(1).'/'.$url;
    }
    else {
        return $newUrl = base_url().$_SESSION['ecode'].'/'.$url.$get;
    }

    return TRUE;
}

function codepreview($val){
    echo "<pre>";
    print_r($val);
    echo "</pre>";
}

function trim_all($veri)
{
    $veri = str_replace("/s+/","",$veri);
    $veri = str_replace(" ","",$veri);
    $veri = str_replace(" ","",$veri);
    $veri = str_replace(" ","",$veri);
    $veri = str_replace("/s/g","",$veri);
    $veri = str_replace("/s+/g","",$veri);
    $veri = trim($veri);
    return $veri;
};

function joinGroup($arr = array()){

    $fullGroup = array();
    foreach ($arr as $row){
        foreach ($row as $td => $tm){
            foreach ($tm as $cx => $v){
                $fullGroup[$cx][$td] = $v;
            }
        }
    }

    return $fullGroup;
}

function paperstatus($status){
    if ($status == 1)
        return 'new';
    elseif($status == 2)
        return 'accepted';
    elseif($status == 3)
        return 'withdraw';
    elseif($status == 4)
        return 'rejected';
    elseif($status == 5)
        return 'draft';
    elseif($status == 6)
        return 'wait_payment';
    elseif($status == 7)
        return 'paid';
    elseif($status == 8)
        return 'pending';
}

function paperstatus_ico($status){
    if ($status == 1)
        return 'fa fa-upload tx-primary';
    elseif($status == 2)
        return 'fa fa-check tx-success';
    elseif($status == 3)
        return 'fa fa-window-close-o tx-gray-700';
    elseif($status == 4)
        return 'fa fa-ban tx-danger';
    elseif($status == 5)
        return 'fa fa-save tx-gray-600';
    elseif($status == 6)
        return 'fa fa-credit-card-alt tx-success';
    elseif($status == 7)
        return 'fa fa-star tx-success';
    elseif($status == 8)
        return 'fa fa-hourglass-2 tx-warning';
}

function cd_dir($path){
    $dir = array();
    if ($handle = opendir($path)) {

        while (false !== ($entry = readdir($handle))) {

            if ($entry != "." && $entry != "..") {
                $dir[] = $entry;
            }
        }

        closedir($handle);
        return $dir;
    }
}

function getCountryName($id){
    $ci=& get_instance();
    return $ci->main_model->getRow('country',['id' => $id])->name;
}

function basicalert($color,$title,$text){
    $ci=& get_instance();
    $ci->session->set_flashdata('login_alert', [
        'color' => $color,
        'title' => $title,
        'text' => $text
    ]);
}

function ratingacademy(){
    return '
                                                                                                                                                          
                                                                                                                                                          
RRRRRRRRRRRRRRRRR                             tttt            iiii                                                                                        
R::::::::::::::::R                         ttt:::t           i::::i                                                                                       
R::::::RRRRRR:::::R                        t:::::t            iiii                                                                                        
RR:::::R     R:::::R                       t:::::t                                                                                                        
  R::::R     R:::::R  aaaaaaaaaaaaa  ttttttt:::::ttttttt    iiiiiiinnnn  nnnnnnnn       ggggggggg   ggggg                                                 
  R::::R     R:::::R  a::::::::::::a t:::::::::::::::::t    i:::::in:::nn::::::::nn    g:::::::::ggg::::g                                                 
  R::::RRRRRR:::::R   aaaaaaaaa:::::at:::::::::::::::::t     i::::in::::::::::::::nn  g:::::::::::::::::g                                                 
  R:::::::::::::RR             a::::atttttt:::::::tttttt     i::::inn:::::::::::::::ng::::::ggggg::::::gg                                                 
  R::::RRRRRR:::::R     aaaaaaa:::::a      t:::::t           i::::i  n:::::nnnn:::::ng:::::g     g:::::g                                                  
  R::::R     R:::::R  aa::::::::::::a      t:::::t           i::::i  n::::n    n::::ng:::::g     g:::::g                                                  
  R::::R     R:::::R a::::aaaa::::::a      t:::::t           i::::i  n::::n    n::::ng:::::g     g:::::g                                                  
  R::::R     R:::::Ra::::a    a:::::a      t:::::t    tttttt i::::i  n::::n    n::::ng::::::g    g:::::g                                                  
RR:::::R     R:::::Ra::::a    a:::::a      t::::::tttt:::::ti::::::i n::::n    n::::ng:::::::ggggg:::::g                                                  
R::::::R     R:::::Ra:::::aaaa::::::a      tt::::::::::::::ti::::::i n::::n    n::::n g::::::::::::::::g                                                  
R::::::R     R:::::R a::::::::::aa:::a       tt:::::::::::tti::::::i n::::n    n::::n  gg::::::::::::::g                                                  
RRRRRRRR     RRRRRRR  aaaaaaaaaa  aaaa         ttttttttttt  iiiiiiii nnnnnn    nnnnnn    gggggggg::::::g                                                  
                                                                                                 g:::::g                                                  
                                                                                     gggggg      g:::::g                                                  
                                                                                     g:::::gg   gg:::::g                                                  
                                                                                      g::::::ggg:::::::g                                                  
                                                                                       gg:::::::::::::g                                                   
                                                                                         ggg::::::ggg                                                     
                                                                                            gggggg                                                        
                                                                                                                                                          
                                                                               dddddddd                                                                   
               AAA                                                             d::::::d                                                                   
              A:::A                                                            d::::::d                                                                   
             A:::::A                                                           d::::::d                                                                   
            A:::::::A                                                          d:::::d                                                                    
           A:::::::::A            cccccccccccccccc  aaaaaaaaaaaaa      ddddddddd:::::d     eeeeeeeeeeee       mmmmmmm    mmmmmmm yyyyyyy           yyyyyyy
          A:::::A:::::A         cc:::::::::::::::c  a::::::::::::a   dd::::::::::::::d   ee::::::::::::ee   mm:::::::m  m:::::::mmy:::::y         y:::::y 
         A:::::A A:::::A       c:::::::::::::::::c  aaaaaaaaa:::::a d::::::::::::::::d  e::::::eeeee:::::eem::::::::::mm::::::::::my:::::y       y:::::y  
        A:::::A   A:::::A     c:::::::cccccc:::::c           a::::ad:::::::ddddd:::::d e::::::e     e:::::em::::::::::::::::::::::m y:::::y     y:::::y   
       A:::::A     A:::::A    c::::::c     ccccccc    aaaaaaa:::::ad::::::d    d:::::d e:::::::eeeee::::::em:::::mmm::::::mmm:::::m  y:::::y   y:::::y    
      A:::::AAAAAAAAA:::::A   c:::::c               aa::::::::::::ad:::::d     d:::::d e:::::::::::::::::e m::::m   m::::m   m::::m   y:::::y y:::::y     
     A:::::::::::::::::::::A  c:::::c              a::::aaaa::::::ad:::::d     d:::::d e::::::eeeeeeeeeee  m::::m   m::::m   m::::m    y:::::y:::::y      
    A:::::AAAAAAAAAAAAA:::::A c::::::c     ccccccca::::a    a:::::ad:::::d     d:::::d e:::::::e           m::::m   m::::m   m::::m     y:::::::::y       
   A:::::A             A:::::Ac:::::::cccccc:::::ca::::a    a:::::ad::::::ddddd::::::dde::::::::e          m::::m   m::::m   m::::m      y:::::::y        
  A:::::A               A:::::Ac:::::::::::::::::ca:::::aaaa::::::a d:::::::::::::::::d e::::::::eeeeeeee  m::::m   m::::m   m::::m       y:::::y         
 A:::::A                 A:::::Acc:::::::::::::::c a::::::::::aa:::a d:::::::::ddd::::d  ee:::::::::::::e  m::::m   m::::m   m::::m      y:::::y          
AAAAAAA                   AAAAAAA cccccccccccccccc  aaaaaaaaaa  aaaa  ddddddddd   ddddd    eeeeeeeeeeeeee  mmmmmm   mmmmmm   mmmmmm     y:::::y           
                                                                                                                                       y:::::y            
                                                                                                                                      y:::::y             
                                                                                                                                     y:::::y              
                                                                                                                                    y:::::y               
                                                                                                                                   yyyyyyy                
                                                                                                                                                          
                                                                                                                                                          
';
}

function set_activity($action,$val = 0,$type,$user = null,$event = null){
    $ci=& get_instance();

    if (!$user){
        $data['user'] = $ci->session->userdata('id');
    }else{
        $data['user'] = $user;
    }

    if (!$event){
        if (!empty($_SESSION['event_set'])){
            $data['event'] = $_SESSION['event_set']->id;
        }else{
            $data['event'] = 0;
        }
    }else{
        $data['event'] = $event;
    }

    $data['date'] = date('Y-m-d H:i:s');
    $data['ip'] = $ci->input->ip_address();
    $data['action'] = $action;
    $data['val'] = $val;
    $data['is_read'] = 0;
    $data['type'] = $type;
    $ci->main_model->basicinsert('activity',$data);
}

function get_time_ago( $time )
{
    $ci=& get_instance();
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return $ci->lang->line('less_than_1_second_ago'); }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
        30 * 24 * 60 * 60       =>  $ci->lang->line('month'),
        24 * 60 * 60            =>  $ci->lang->line('day'),
        60 * 60                 =>  $ci->lang->line('hour'),
        60                      =>  $ci->lang->line('minute'),
        1                       =>  $ci->lang->line('second')
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return $ci->lang->line('about').' ' . $t . ' ' . $str . ( $t > 1 ? ' ' : '' ) . ' '.$ci->lang->line('ago');
        }
    }
}

function viewsubcat($id)
{
    $ci=& get_instance();
    echo "<ul>";
    foreach ($ci->main_model->getTable('category',['main' => $id]) as $row){
        echo "<li>".$row->name."</li>";
        if ($ci->main_model->getTable('category',['main' => $row->id])){
            viewsubcat($row->id);
        }
    }
    echo "</ul>";
}