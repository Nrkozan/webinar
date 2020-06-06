<script src="<?php echo base_url()?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="<?php echo base_url()?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url()?>assets/js/demo_pages/datatables_basic.js"></script>

<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <span class="text-semibold">Panel</span> - Hoşgeldiniz
                <small class="display-block">Merhaba, <?php echo $this->session->userdata('name')?></small>
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
                <?php foreach ($this->main_model->getTable('server',['active' => 1]) as $row): ?>
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
                                        <div class="text-uppercase text-size-mini text-muted">Oturumlar</div>
                                        <h5 class="text-semibold no-margin">
                                            <?php $cacheData = getMeetingsCount($row->id); ?>
                                            <?php echo $cacheData['count']; ?>
                                        </h5>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="text-uppercase text-size-mini text-muted">Katılımcılar</div>
                                        <h5 class="text-semibold no-margin">
                                            <?php echo $cacheData['participantCount']; ?>
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
                    <?php foreach ($this->main_model->getTable('server',['active' => 1]) as $row): ?>
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
                                        <th>Oturum</th>
                                        <th>Katılımcı</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach (getMeetings($row->id)->meetings->meeting as $sub): ?>
                                        <tr>
                                            <td class="col-md-9" >
                                                <?php echo $sub->meetingName?>
                                            </td>
                                            <td>
                                                <?php echo $sub->participantCount?>
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
                            <h6 class="panel-title">Kayıtlar</h6>
                        </div>

                        <table class="table table-striped table-xxs">
                            <thead>
                            <tr>
                                <th>Sunucu</th>
                                <th>Video</th>
                                <th>Dakika</th>
                                <th>Katılımcı</th>
                                <th>Boyut</th>
                                <th>Liste</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($this->main_model->getTable('server',['active' => 1]) as $row): ?>
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
                                        <a target="_blank" href="<?php echo base_url('home/allList?server='.$row->id)?>">Get</a>
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