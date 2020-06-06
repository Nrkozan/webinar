<?php

function getMeetings($id){
    $ci=& get_instance();
    $server =  $ci->main_model->getRow('server',['id' => $id]);
    $key = sha1('getMeetings'.$server->bbb_secret);
    $param = $server->bbb_url.'api/getMeetings?checksum='.$key;
    $result = simplexml_load_string(curlXML($param)) or die("Error: Cannot create object");
    return $result;

}

function getMeetingsInfo($serverID,$id){
    $ci=& get_instance();
    $server =  $ci->main_model->getRow('server',['id' => $serverID]);
    $key = sha1('getMeetingInfomeetingID='.$id.$server->bbb_secret);
    $param = $server->bbb_url.'api/getMeetingInfo?meetingID='.$id.'&checksum='.$key;
    $result = simplexml_load_string(curlXML($param)) or die("Error: Cannot create object");
    return $result;
}

function getRecordings($id){
    $ci=& get_instance();
    $server =  $ci->main_model->getRow('server',['id' => $id]);
    $key = sha1('getRecordings'.$server->bbb_secret);
    $param = $server->bbb_url.'api/getRecordings?checksum='.$key;
    $result = simplexml_load_string(curlXML($param)) or die("Error: Cannot create object");

    $alfa['data'] = $result;
    $alfa['participants'] = 0;
    $alfa['length'] = 0;
    $alfa['size'] = 0;
    $alfa['videos'] = 0;
    $data = $result;
    foreach ($data->recordings->recording as $row){
        $alfa['videos']++;
        $alfa['participants'] += $row->participants;
        $alfa['size'] = $alfa['size'] + ($row->size / 1024 / 1024);
        $alfa['length'] += $row->playback->format->length;
    }

    return $alfa;

}

function getMeetingsCount($id){
    $ci=& get_instance();
    $server =  $ci->main_model->getRow('server',['id' => $id]);
    $key = sha1('getMeetings'.$server->bbb_secret);
    $param = $server->bbb_url.'api/getMeetings?checksum='.$key;
    $result = simplexml_load_string(curlXML($param)) or die("Error: Cannot create object");

    $alfa['participantCount'] = 0;
    $alfa['count'] = 0;
    foreach ($result->meetings->meeting as $row){
        $alfa['participantCount'] += $row->participantCount;
        $alfa['count'] ++;
    }
    return $alfa;
}


function curlXML($url){
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
   $output = curl_exec($ch);
   curl_close($ch);

   return $output;
}

function join_meeting($id,$meetingID,$name,$pw){
    $ci=& get_instance();
    $server =  $ci->main_model->getRow('server',['id' => $id]);
    $key = sha1('joinfullName='.$name.'&meetingID='.$meetingID.'&password='.$pw.'&redirect=true'.$server->bbb_secret);
    $param = $server->bbb_url.'api/join?fullName='.$name.'&meetingID='.$meetingID.'&password='.$pw.'&redirect=true&checksum='.$key;
    return $param;
}