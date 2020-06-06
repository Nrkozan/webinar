<div class="row">
    <div class="col-md-12">
        <table class="table table-xxs table-striped table-bordered">
            <tr>
                <td colspan="2" class="col-md-6">meetingID</td>
                <td colspan="2"><?php echo $meetingID?></td>
            </tr>
            <tr>
                <td colspan="2" >meetingName</td>
                <td colspan="2"><?php echo $meetingName?></td>
            </tr>
            <tr>
                <td>createTime</td>
                <td><?php echo date('m/d H:i:s', substr($createTime,0,10));?></td>
                <td>startTime</td>
                <td><?php echo date('m/d H:i:s', substr($startTime,0,10));?></td>
            </tr>
            <tr>
                <td>participantCount</td>
                <td><?php echo $participantCount?></td>
                <td>moderatorCount</td>
                <td><?php echo $moderatorCount?></td>
            </tr>
            <tr>
                <td>running</td>
                <td><?php echo $running?></td>
                <td>recording</td>
                <td><?php echo $recording?></td>
            </tr>
        </table>
    </div>
</div>





