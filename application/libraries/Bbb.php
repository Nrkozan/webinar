<?php defined('BASEPATH') OR exit('No direct script access allowed');

use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;
use BigBlueButton\Parameters\EndMeetingParameters;
use BigBlueButton\Parameters\GetMeetingInfoParameters;
use BigBlueButton\Parameters\DeleteRecordingsParameters;
use BigBlueButton\Parameters\GetRecordingsParameters;

class Bbb
{
    public function __construct(){

        require_once dirname(__FILE__).'/vendor/autoload.php';
        $BigBlueButton = new BigBlueButton();
        $CI =& get_instance();
        $CI->bbb = $BigBlueButton;
    }

    public function getRecord(){

        $BigBlueButton = new BigBlueButton();
        $recordingParams = new GetRecordingsParameters();
        $response = $BigBlueButton->getRecordings($recordingParams);
        return $response;
    }
}