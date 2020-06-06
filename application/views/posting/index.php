<script src="<?php echo base_url()?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="<?php echo base_url()?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url()?>assets/js/demo_pages/datatables_basic.js"></script>

<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

           <div class="row">
               <div class="col-md-3">
                   <div class="panel panel-flat">
                       <div class="panel-heading">
                           <h6 class="panel-title">Yeni Kullanıcı Oluştur</h6>
                       </div>

                       <form action="<?php echo base_url('posting/addNewUser_do')?>" method="post">
                           <div class="panel-body">
                               <div class="form-group">
                                   <label for="">Adı</label>
                                   <input name="name" type="text" class="form-control">
                               </div>
                               <div class="form-group">
                                   <label for="">Mail</label>
                                   <input name="mail" type="text" class="form-control">
                               </div>
                               <div class="form-group">
                                   <label for="">Kurum</label>
                                   <input name="organization" type="text" class="form-control">
                               </div>
                               <div class="form-group">
                                   <label for="">Şifre</label>
                                   <input name="password" type="text" class="form-control">
                               </div>
                               <div class="form-group">
                                   <label for="">Kodu</label>
                                   <input name="recordTag" type="text" class="form-control">
                               </div>
                               <div class="form-group">
                                   <label for="">BBB Secret</label>
                                   <input name="bbb_secret"  type="text" class="form-control">
                               </div>
                               <div class="form-group">
                                   <label for="">BBB Url</label>
                                   <input name="bbb_url"  type="text" class="form-control">
                               </div>
                               <div class="form-group">
                                   <label for="">Tipi</label>
                                   <select name="level" id="" class="form-control">
                                       <option value="user">Kullanıcı</option>
                                       <option value="admin">Admin</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <button type="submit" class="btn btn-success btn-block">Kaydet</button>
                               </div>
                           </div>
                       </form>
                   </div>
               </div>
               <div class="col-md-9">
                   <div class="panel panel-flat">
                       <div class="panel-heading">
                           <h6 class="panel-title">Kullanıcı Listesi</h6>
                       </div>

                       <table class="table datatable-basic table-striped table-xxs">
                           <thead>
                           <tr>
                               <th>#</th>
                               <th>Adı</th>
                               <th>Kurum</th>
                               <th>Mail</th>
                               <th>Tag</th>
                               <th>İşlem</th>
                           </tr>
                           </thead>
                           <tbody>
                           <?php foreach ($this->main_model->getTable('user') as $row): ?>
                               <tr>
                                   <td><?php echo $row->id?></td>
                                   <td><?php echo $row->name?></td>
                                   <td><?php echo $row->organization?></td>
                                   <td><?php echo $row->mail?></td>
                                   <td><?php echo $row->recordTag?></td>
                                   <td>
                                       <button class="editBtn" data-id="<?php echo $row->id?>">Düzenle</button>
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

<div id="modal_default" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Düzenle</h5>
            </div>

            <form action="<?php echo base_url('posting/editUser_do')?>" method="post">
            <div class="modal-body">

                    <div class="panel-body">
                        <div class="form-group">
                            <label for="">Adı</label>
                            <input name="name" type="text" id="user_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Mail</label>
                            <input name="mail" type="text" id="user_mail" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Kurum</label>
                            <input name="organization" id="user_org" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Şifre</label>
                            <input name="password" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Kodu</label>
                            <input name="recordTag" id="user_tag" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">BBB Secret</label>
                            <input name="bbb_secret" id="bbb_secret" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">BBB Url</label>
                            <input name="bbb_url" id="bbb_url" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tipi</label>
                            <select name="level" id="user_level" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="user">Kullanıcı</option>
                            </select>
                        </div>
                    </div>

            </div>

            <div class="modal-footer">
                <input type="hidden" id="user_id" name="id">
                <button type="submit" class="btn btn-primary">Kaydet</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.editBtn').click(function () {
        var id = $(this).data('id');
        $.ajax({
            type: "POST",
            data: {id: id},
            url: "<?php echo base_url('posting/getUserData')?>",
            dataType: "json",
            success: function (data) {
                $('#user_id').val(data.id);
                $('#user_name').val(data.name);
                $('#user_mail').val(data.mail);
                $('#user_org').val(data.organization);
                $('#user_tag').val(data.recordTag);
                $('#bbb_secret').val(data.bbb_secret);
                $('#bbb_url').val(data.bbb_url);
                $('#user_level').val(data.level);
                $('#modal_default').modal('show');
            }
        });
    });
</script>