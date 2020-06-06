<script src="<?php echo base_url()?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="<?php echo base_url()?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url()?>assets/js/demo_pages/datatables_basic.js"></script>

<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <?php $server = $this->main_model->getRow('server',['id' => $this->uri->segment(3)]) ?>
                <span class="text-semibold"><?php echo $server->name  ?></span> - Record List
            </h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="<?php echo base_url('cron/saveRc/'. $this->uri->segment(3))?>" class="btn bg-teal-400 btn-labeled"><b><i class="icon-reload-alt"></i></b> Reload Records</a>
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
                <div class="col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h6 class="panel-title">Records</h6>
                        </div>

                        <table class="table datatable-basic table-striped table-xxs">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Participants</th>
                                <th>Size</th>
                                <th>Length</th>
                                <th>Origin Server</th>
                                <th>Playback</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $main = $this->main_model->getRow('server',['id' => $this->uri->segment(3)]) ?>
                                <?php foreach ($this->main_model->getTable('records',['server' => $main->id]) as $row): ?>
                                    <tr>
                                        <td  class="col-md-4">
                                            <?php echo $row->name?>
                                        </td>
                                        <td  class="col-md-1">
                                            <?php
                                            $epoch = substr($row->startTime, 0, 10);
                                            $dt = new DateTime("@$epoch");
                                            echo $dt->format('d/m/Y');
                                            ?>
                                        </td>
                                        <td class="col-md-1">
                                            <?php echo $row->participants?>
                                        </td>
                                        <td  class="col-md-1">
                                            <?php echo number_format($row->size / 1048576, 2) . ' MB';?>
                                        </td  class="col-md-1">
                                        <td>
                                            <?php echo $row->length?> min
                                        </td>
                                        <td  class="col-md-2">
                                            <?php echo $row->server_name?>
                                        </td>
                                        <td  class="col-md-1">
                                            <a target="_blank" href="<?php echo $row->url?>">Watch</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>

