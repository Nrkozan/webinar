<script src="<?php echo base_url()?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="<?php echo base_url()?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url()?>assets/js/demo_pages/datatables_basic.js"></script>
<script src="<?php echo base_url()?>assets/js/plugins/forms/styling/uniform.min.js"></script>
<script src="<?php echo base_url()?>assets/js/plugins/forms/styling/switchery.min.js"></script>
<script src="<?php echo base_url()?>assets/js/plugins/forms/styling/switch.min.js"></script>
<script src="<?php echo base_url()?>assets/js/demo_pages/form_checkboxes_radios.js"></script>

<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <span class="text-semibold">User</span> - List
            </h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <button type="button" class="btn btn-primary"><i class="icon-user-plus position-left"></i> Add New User</button>
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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h6 class="panel-title">List</h6>
                        </div>

                        <table class="table datatable-basic table-xxs">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Mail</th>
                                <th>Level</th>
                                <th>Staff</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($this->main_model->getTable('user') as $row): ?>
                                <tr>
                                    <td><?php echo $row->id?></td>
                                    <td><?php echo $row->name?></td>
                                    <td><?php echo $row->mail?></td>
                                    <td><?php echo $row->level?></td>
                                    <td>
                                        <?php if ($this->main_model->getRow('user',['id' => $row->staff])): ?>
                                        <?php echo $this->main_model->getRow('user',['id' => $row->staff])->name?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a class="edituser" data-id="<?php echo $row->id?>" >Edit</a></li>
                                                    <li><a href="<?php echo base_url('user/delete/'.$row->id)?>">Delete</a></li>
                                                    <li><a class="cuser" data-id="<?php echo $row->id?>" >Change Password</a></li>
                                                </ul>
                                            </li>
                                        </ul>
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


<div id="edit" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Edit User</h5>
            </div>

            <form action="<?php echo base_url('user/update_do')?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" id="user_name">
                    </div>
                    <div class="form-group">
                        <label for="">Mail</label>
                        <input type="text" class="form-control" name="mail" id="user_mail">
                    </div>
                    <div class="form-group">
                        <label for="">Level</label>
                        <select name="level" class="form-control" id="user_level">
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>
                    <div class="form-group" id="staffinput" style="display: none">
                        <label for="">Staff</label>
                        <select name="staff" class="form-control" id="user_staff">
                            <option value="">Null</option>
                            <?php foreach ($this->main_model->getTable('user',['level' => 'manager']) as $row): ?>
                                <option value="<?php echo $row->id?>"><?php echo $row->name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" id="user_id" name="id">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="pwc" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Change User Password</h5>
            </div>

            <form action="<?php echo base_url('user/update_password_do')?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="text" class="form-control" name="password">
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" id="user_id_pw" name="id">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.edituser').click(function () {
        var id = $(this).data('id');
        $.ajax({
            type: "POST",
            data: {id: id},
            url: "<?php echo base_url('user/getData')?>",
            dataType: "json",
            success: function (data) {
                if (data.level == 'staff'){
                    $('#staffinput').show();
                    $('#user_staff').val(data.staff);
                }else{
                    $('#staffinput').hide();
                    $('#user_staff').val(0);
                }
                $('#user_name').val(data.name);
                $('#user_level').val(data.level);
                $('#user_mail').val(data.mail);
                $('#user_id').val(data.id);
                $('#edit').modal('show');
            }
        });
    });

    $('.cuser').click(function () {
        var id = $(this).data('id');
        $('#user_id_pw').val(id);
        $('#pwc').modal('show');
    });
</script>