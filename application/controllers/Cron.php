<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper('string');
        $this->load->helper('bbb');
    }

    function saveMeeting(){
        foreach ($this->main_model->getTable('server') as $serverSet){

            $server =  $this->main_model->getRow('server',['id' => 3]);
            $key = sha1('getMeetings'.$server->bbb_secret);
            $param = $server->bbb_url.'api/getMeetings?checksum='.$key;
            $result = simplexml_load_file($param) or die("Error: Cannot create object");
            $data = json_decode(json_encode($result),true);
            $data = json_encode($data);
            $data = json_decode($data);
            if ($data->meetings){
                if ($data = $data->meetings){
                    foreach ($data->meeting as $key => $row){
                            if (!$this->main_model->getRow('meeting',['meetingID' => $row->meetingID])){
                                $alfa['meetingName'] = ($row->meetingName) ? $row->meetingName : 'null' ;
                                $alfa['meetingID'] = $row->meetingID;
                                $alfa['internalMeetingID'] = $row->internalMeetingID;
                                $alfa['createTime'] = $row->createTime;
                                $alfa['createDate'] = $row->createDate;
                                $this->main_model->basicinsert('meeting',$alfa);

                        }

                    }
                }
            }

        }
    }

    function saveRc(){
        $context = 'bbb-context';
        $sanme = 'bbb-origin-server-name';
        $main = $this->main_model->getRow('server',['id' => $this->uri->segment(3)]);
        $sub = getRecordings($main->id)['data'];
        foreach ($sub->recordings->recording as $row){
            if (!$this->main_model->getRow('records',['recordID' => $row->recordID])){
                $alfa['recordID'] = $row->recordID;
                $alfa['meetingID'] = $row->meetingID;
                $alfa['internalMeetingID'] = $row->internalMeetingID;
                $alfa['name'] = $row->name;
                $alfa['state'] = $row->state;
                $alfa['startTime'] = $row->startTime;
                $alfa['endTime'] = $row->endTime;
                $alfa['participants'] = $row->participants;
                $alfa['size'] = $row->size;
                $alfa['length'] =  $row->playback->format->length;
                $alfa['url'] = $row->playback->format->url;
                $alfa['mp4'] = $main->base_url . 'download/presentation/'.$row->recordID.'/'.$row->recordID.'.mp4';
                $alfa['server_name'] = $row->metadata->{$sanme};
                $alfa['context'] = $row->metadata->{$context};
                $alfa['api'] = $main->name;
                $alfa['server'] = $main->id;
                $this->main_model->basicinsert('records',$alfa);
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    function publish(){
        codepreview(getRecordings(3));
        die();

        $rid = '87ba7812cb514bb8eb7c8c1d7462f0b767141138-1587407194803';
        //http://yourserver.com/bigbluebutton/api/publishRecordings?recordID=record123&publish=true&checksum=1234
        $scc = 'AyvkKGL3uLus7DssTWwvJOwPJyEkqFFDOMV4tG0u4s';
        $pam = sha1('publishRecordingsrecordID='.$rid.'&publish=true'.$scc);
        $link = 'https://sanalsinif.gen.tr/bigbluebutton/api/publishRecordings?recordID='.$rid.'&publish=true&checksum='.$pam;
        echo $link;
        echo "<a href='".$link."' >get</a>";
        echo "<br>".$pam;
    }

    function listing(){
        $data = getRecordings(2);
        codepreview($data);
    }
}