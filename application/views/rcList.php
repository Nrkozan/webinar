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

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Kayıt Listem</h6>
                </div>

                <table class="table datatable-basic table-striped table-xxs">
                    <thead>
                    <tr>
                        <th>Adı</th>
                        <th>Tarih</th>
                        <th>Katılımcı</th>
                        <th>Boyut</th>
                        <th>Süre</th>
                        <th>Kaynak</th>
                        <th>İzle</th>
                        <th>İndir</th>
                        <th>
                            İndrme
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php if (isset($_GET['server'])): ?>
                        <?php $main = $this->main_model->getRow('server',['id' => $_GET['server']]) ?>
                        <?php foreach ($this->main_model->getTable('records',['server' => $_GET['server']]) as $row): ?>
                                <tr>
                                    <td>
                                        <?php echo $row->name?>
                                    </td>
                                    <td>
                                        <?php
                                        $epoch = substr($row->startTime, 0, 10);
                                        $dt = new DateTime("@$epoch");
                                        echo $dt->format('d/m/Y');
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $row->participants?>
                                    </td>
                                    <td>
                                        <?php echo number_format($row->size / 1048576, 2) . '';?>
                                    </td>
                                    <td>
                                        <?php echo $row->length?> .dk
                                    </td>
                                    <td>
                                        <?php echo $main->name?>
                                    </td>
                                    <td>
                                        <a target="_blank" href="<?php echo $row->url?>">İzle</a>
                                    </td>
                                    <td>
                                        <?php $link = $row->mp4 ?>
                                        <a target="_blank" href="<?php echo base_url('home/download/'.$row->id)?>">İndir</a>
                                    </td>
                                    <td>
                                        <?php echo $row->downloads?>
                                    </td>
                                    <?php if (false): ?>
                                        <td>
                                            <button type="button" class="gdriveadd" data-id="<?php echo $row->id?>" >Ekle</button>
                                        </td>
                                    <?php  endif;?>
                                </tr>
                            <?php endforeach; ?>
                    <?php else: ?>
                        <?php foreach ($this->main_model->getTable('server') as $main): ?>
                            <?php foreach ($this->main_model->getTable('records',['server' => $main->id]) as $row): ?>
                                <tr>
                                    <td>
                                        <?php echo $row->name?>
                                    </td>
                                    <td>
                                        <?php
                                        $epoch = substr($row->startTime, 0, 10);
                                        $dt = new DateTime("@$epoch");
                                        echo $dt->format('d/m/Y');
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $row->participants?>
                                    </td>
                                    <td>
                                        <?php echo number_format($row->size / 1048576, 2) . ' MB';?>
                                    </td>
                                    <td>
                                        <?php echo $row->length?> .dk
                                    </td>
                                    <td>
                                        <?php echo $main->name?>
                                    </td>
                                    <td>
                                        <a target="_blank" href="<?php echo $row->url?>">İzle</a>
                                    </td>
                                    <td>
                                        <?php $link = $row->mp4 ?>
                                        <a target="_blank" href="<?php echo base_url('home/download/'.$row->id)?>">İndir</a>
                                    </td>
                                    <td>
                                        <?php echo $row->downloads?>
                                    </td>
                                    <?php if (false): ?>
                                    <td>
                                        <button type="button" class="gdriveadd" data-id="<?php echo $row->id?>" >Ekle</button>
                                    </td>
                                    <?php  endif;?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>

<script type="text/javascript">
    $('.gdriveadd').click(function () {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('home/uploadGdrive')?>",
            data: {'id': $(this).data('id')},
            dataType: 'json',
            success: function(data) {
                alert(7);
                console.log(data);
            }
        });
    });
</script>