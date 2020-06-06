<div class="row">
    <div class="col-md-12">
        <table class="table table-xxs table-striped table-bordered">
            <thead>
            <tr>
                <th>User ID</th>
                <th>Full Name</th>
                <th>Role</th>
                <th>Presenter</th>
                <th>Listening Only</th>
                <th>Joined Voice</th>
                <th>Video</th>
                <th>Client</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($attendees->attendee as $row): ?>
                <tr>
                    <td class="col-md-1" ><?php echo $row->userID?></td>
                    <td class="col-md-2" ><?php echo $row->fullName?></td>
                    <td class="col-md-2" ><?php echo $row->role?></td>
                    <td class="col-md-1" >
                        <?php if ($row->isPresenter == 'true'): ?>
                        <i class="icon-circle2 text-success"></i>
                        <?php else: ?>
                            <i class="icon-circle2 text-slate"></i>
                        <?php endif; ?>
                    </td>
                    <td class="col-md-1" >
                        <?php if ($row->isListeningOnly == 'true'): ?>
                            <i class="icon-circle2 text-success"></i>
                        <?php else: ?>
                            <i class="icon-circle2 text-slate"></i>
                        <?php endif; ?>
                    </td>
                    <td class="col-md-1" >
                        <?php if ($row->hasJoinedVoice == 'true'): ?>
                            <i class="icon-circle2 text-success"></i>
                        <?php else: ?>
                            <i class="icon-circle2 text-slate"></i>
                        <?php endif; ?>
                    </td>
                    <td class="col-md-1" >
                        <?php if ($row->hasVideo == 'true'): ?>
                            <i class="icon-circle2 text-success"></i>
                        <?php else: ?>
                            <i class="icon-circle2 text-slate"></i>
                        <?php endif; ?>
                    </td>
                    <td class="col-md-1" ><?php echo $row->clientType?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>




