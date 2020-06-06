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

        <!-- Main sidebar -->
        <div class="sidebar sidebar-main sidebar-default">
            <div class="sidebar-content">

                <!-- Title -->
                <div class="category-title h6">
                    <span>Components</span>
                    <ul class="icons-list">
                        <li><a href="#"><i class="icon-gear"></i></a></li>
                    </ul>
                </div>
                <!-- /title -->


                <!-- Search task -->
                <div class="sidebar-category">
                    <div class="category-title">
                        <span>Kayıt Ara</span>
                        <ul class="icons-list">
                            <li><a href="#" data-action="collapse"></a></li>
                        </ul>
                    </div>

                    <div class="category-content">
                        <form action="#">
                            <div class="has-feedback has-feedback-left">
                                <input type="search" class="form-control" placeholder="Type and hit Enter">
                                <div class="form-control-feedback">
                                    <i class="icon-search4 text-size-base text-muted"></i>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /search task -->


                <!-- Action buttons -->
                <div class="sidebar-category">
                    <div class="category-title">
                        <span>Action buttons</span>
                        <ul class="icons-list">
                            <li><a href="#" data-action="collapse"></a></li>
                        </ul>
                    </div>

                    <div class="category-content">
                        <div class="row">
                            <div class="col-xs-6">
                                <button class="btn bg-teal-400 btn-block btn-float btn-float-lg" type="button"><i class="icon-git-branch"></i> <span>Branch</span></button>
                                <button class="btn bg-purple-300 btn-block btn-float btn-float-lg" type="button"><i class="icon-mail-read"></i> <span>Messages</span></button>
                            </div>

                            <div class="col-xs-6">
                                <button class="btn bg-warning-400 btn-block btn-float btn-float-lg" type="button"><i class="icon-stats-bars"></i> <span>Statistics</span></button>
                                <button class="btn bg-blue btn-block btn-float btn-float-lg" type="button"><i class="icon-people"></i> <span>Users</span></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /action buttons -->



                <!-- /task navigation -->


                <!-- Assigned users -->





            </div>
        </div>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Kayıt Listem</h6>
                </div>

                <table class="table datatable-basic table-striped table-xxs">
                    <thead>
                    <tr>
                        <th>Adı</th>
                        <th>Başlık</th>
                        <th>Tarih</th>
                        <th>Boyut</th>
                        <th>İzle</th>
                        <th>İndir</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($record as $row): ?>
                        <tr>
                            <td>
                                <?php echo $row->title?>
                            </td>
                            <td>
                                <?php echo $row->name?>
                            </td>
                            <td>
                                <?php
                                $date = new DateTime();
                                echo $date->format('U = Y-m-d H:i:s') . "\n";

                                $date->setTimestamp($row->startTime);
                                echo $date->format('U = Y-m-d H:i:s') . "\n";
                                ?>
                            </td>
                            <td>
                                <?php echo number_format($row->size / 1048576, 2) . ' MB';?>
                            </td>
                            <td>
                                <a target="_blank" href="<?php echo $row->url?>">İzle</a>
                            </td>
                            <td>
                                <a target="_blank" href="<?php echo $row->mp4?>">İndir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>