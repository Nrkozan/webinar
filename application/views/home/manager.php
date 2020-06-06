<script src="<?php echo base_url()?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="<?php echo base_url()?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url()?>assets/js/demo_pages/datatables_basic.js"></script>

<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <span class="text-semibold">Dashboard</span> - Welcome
                <small class="display-block">Hi, <?php echo $this->session->userdata('name')?></small>
            </h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">

            </div>
        </div>
    </div>
</div>
<!-- /page header -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">



        <!-- Main content -->
        <div class="content-wrapper">
            <div class="row">
                <?php foreach ($this->main_model->getTable('server',['owner' => $this->session->userdata('id'),'active' => 1]) as $row): ?>
                    <div class="col-md-3">
                        <div class="panel text-center">
                            <div class="panel-body">
                                <h6 class="text-semibold no-margin-bottom mt-5">
                                    <?php echo $row->name?>
                                </h6>
                            </div>

                            <div class="panel-body panel-body-accent pb-15">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="text-uppercase text-size-mini text-muted">Sessions</div>
                                        <h5 class="text-semibold no-margin">
                                            <?php echo $server[$row->id]['meetingCount']; ?>
                                        </h5>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="text-uppercase text-size-mini text-muted">Partipicants</div>
                                        <h5 class="text-semibold no-margin">
                                            <?php echo $server[$row->id]['participantCount']; ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php foreach ($this->main_model->getTable('server',['owner' => $this->session->userdata('id'),'active' => 1]) as $row): ?>
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">
                                    <b><?php echo $row->name?></b>
                                </h6>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped  table-xxs">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Meeting</th>
                                        <th>Participant</th>
                                        <th>Join</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($server[$row->id]['data']->meeting  as $sub): ?>
                                        <tr>
                                            <td>
                                                <i data-server="<?php echo $row->id?>" data-name="<?php echo $sub->meetingName?>" data-id="<?php echo $sub->meetingID?>" class="icon icon-eye cursor-pointer text-primary-600 detailMetting"></i>
                                            </td>
                                            <td class="col-md-5" >
                                                <?php echo $sub->meetingName?>
                                            </td>
                                            <td class="col-md-2">
                                                <?php echo $sub->participantCount?>
                                                <span  data-server="<?php echo $row->id?>" data-name="<?php echo $sub->meetingName?>" data-id="<?php echo $sub->meetingID?>" class="text-primary cursor-pointer partipicantList">Detail</span>
                                            </td>
                                            <td class="col-md-5">
                                                <a target="_blank" href="<?php echo join_meeting($row->id,$sub->meetingID, trim_all($this->session->userdata('name')),$sub->attendeePW)?>" class="label bg-success">attendee </a>
                                                <a target="_blank" href="<?php echo join_meeting($row->id,$sub->meetingID, trim_all($this->session->userdata('name')),$sub->moderatorPW)?>" class="label bg-primary">moderator </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Records</h6>
                        </div>

                        <table class="table table-striped table-xxs">
                            <thead>
                            <tr>
                                <th>Server</th>
                                <th>Video</th>
                                <th>Dakika</th>
                                <th>Katılımcı</th>
                                <th>Boyut</th>
                                <th>Liste</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($this->main_model->getTable('server',['owner' => $this->session->userdata('id'),'active' => 1]) as $row): ?>
                                <tr>
                                    <td>
                                        <?php echo $row->name?>
                                    </td>
                                    <td>
                                        <?php echo $this->main_model->getNumRows('records',['server' => $row->id],'id')?>
                                    </td>
                                    <td>
                                        <?php echo $this->main_model->getSum('records','length',['server' => $row->id])?> .dk
                                    </td>
                                    <td>
                                        <?php echo $this->main_model->getSum('records','participants',['server' => $row->id])?>
                                    </td>
                                    <td>
                                        <?php echo round($this->main_model->getSum('records','size',['server' => $row->id]) / 1024 / 1024 / 1024,2)?> Gb
                                    </td>
                                    <td>
                                        <a target="_blank" href="<?php echo base_url('server/records/'.$row->id)?>">Get</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <a href="<?php echo base_url('home/allList')?>" target="_blank" class="btn btn-primary">Tüm Kayıtlar</a>
                    <a href="<?php echo base_url('cron/saveRc')?>" target="_blank" class="btn btn-danger">Kayıtları Yenile</a>
                </div>
            </div>
        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>

<div id="meetingDetailModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header bg-purple">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title" id="meetname"></h5>
            </div>

            <div id="meetingDetailModalBody">

            </div>

        </div>
    </div>
</div>

<div id="partipicantModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-teal-400">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <span id="mmetName"></span>
            </div>

            <div id="partipicantModalBody">

            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $('.detailMetting').click(function () {
        var name = $(this).data('name');
        var id = $(this).data('id');
        var server = $(this).data('server');
        $('#meetname').text(name);
        $.ajax({
            type: "POST",
            data: {id: id,server:server},
            url: "<?php echo base_url('data/getMettingsModal')?>",
            dataType: "json",
            success: function (data) {
                $('#meetingDetailModalBody').empty();
                $('#meetingDetailModalBody').append(data);
                $('#meetingDetailModal').modal('show');
            }
        });
    });

    $('.partipicantList').click(function () {
        var name = $(this).data('name');
        var id = $(this).data('id');
        var server = $(this).data('server');
        $('#mmetName').text(name);
        $.ajax({
            type: "POST",
            data: {id: id,server:server},
            url: "<?php echo base_url('data/getMettingPartipicant')?>",
            dataType: "json",
            success: function (data) {
                $('#partipicantModalBody').empty();
                $('#partipicantModalBody').append(data);
                $('#partipicantModal').modal('show');
            }
        });
    });
</script>