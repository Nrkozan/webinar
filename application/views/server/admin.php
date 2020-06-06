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
                <span class="text-semibold">Server</span> - List
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
              <div class="col-md-9">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <h6 class="panel-title">List</h6>
                      </div>

                      <table class="table table-bordered table-striped table-xs">
                          <thead>
                          <tr>
                              <th>Name</th>
                              <th>Base Url</th>
                              <th>Owner</th>
                              <th>User</th>
                              <th>Status</th>
                              <th>Action</th>
                              <th>Posting</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($this->main_model->getTable('server') as $row): ?>
                              <tr>
                                  <td><?php echo $row->name?></td>
                                  <td><?php echo $row->base_url?></td>
                                  <td><?php echo $this->main_model->getRow('user',['id' => $row->owner])->name?></td>
                                  <td><?php echo $this->main_model->getNumRows('user_server',['server' => $row->id])?></td>
                                  <td class="switchery-sm">
                                      <input type="checkbox"  class="switchery checkbox-switchery  activate"  data-id="<?php echo $row->id?>" <?php if ($row->active) { echo 'checked="checked"';} ?>>
                                  </td>
                                  <td>
                                      <span data-id="<?php echo $row->id?>" class="label bg-primary edit cursor-pointer">Edit</span>
                                  </td>
                                  <td>
                                      <a href="<?php echo base_url('server/posting/'.$row->id)?>" class="label bg-warning edit cursor-pointer">Posting</a>
                                  </td>
                              </tr>
                          <?php endforeach; ?>
                          </tbody>
                      </table>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="panel panel-primary">
                      <div class="panel-heading">
                          <h6 class="panel-title">Server Add</h6>
                      </div>

                      <form action="<?php echo base_url('server/add')?>" method="post">
                          <div class="panel-body">
                              <div class="form-group">
                                  <label for="">Name</label>
                                  <input type="text" class="form-control" name="name">
                              </div>
                              <div class="form-group">
                                  <label for="">BBB URL</label>
                                  <input type="text" class="form-control" name="bbb_url">
                              </div>
                              <div class="form-group">
                                  <label for="">BBB SECRET</label>
                                  <input type="text" class="form-control" name="bbb_secret">
                              </div>

                              <div class="form-group">
                                  <label for="">Base URL</label>
                                  <input type="text" class="form-control" name="base_url">
                              </div>
                              <div class="form-group">
                                  <label for="">Owner</label>
                                  <select name="owner" class="form-control" id="">
                                      <?php foreach ($this->main_model->getTable('user',['level' => 'admin']) as $row): ?>
                                          <option value="<?php echo $row->id?>"><?php echo $row->name?></option>
                                      <?php endforeach; ?>
                                      <?php foreach ($this->main_model->getTable('user',['level' => 'manager']) as $row): ?>
                                          <option value="<?php echo $row->id?>"><?php echo $row->name?></option>
                                      <?php endforeach; ?>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <button type="submit" class="btn btn-success btn-block" >Submit</button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>



<!-- Basic modal -->
<div id="editserver" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Edit Server</h5>
            </div>

            <form action="<?php echo base_url('server/update_do')?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" id="server_name">
                    </div>
                    <div class="form-group">
                        <label for="">Url</label>
                        <input type="text" class="form-control" name="bbb_url" id="server_url">
                    </div>
                    <div class="form-group">
                        <label for="">Secret</label>
                        <input type="text" class="form-control" name="bbb_secret" id="server_secret">
                    </div>
                    <div class="form-group">
                        <label for="">Base Url</label>
                        <input type="text" class="form-control" name="base_url" id="server_base">
                    </div>
                    <div class="form-group">
                        <label for="">Owner</label>
                        <select name="owner" class="form-control" id="server_owner">
                            <?php foreach ($this->main_model->getTable('user',['level' => 'admin']) as $row): ?>
                                <option value="<?php echo $row->id?>"><?php echo $row->name?></option>
                            <?php endforeach; ?>
                            <?php foreach ($this->main_model->getTable('user',['level' => 'manager']) as $row): ?>
                                <option value="<?php echo $row->id?>"><?php echo $row->name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <input type="hidden" id="server_id" name="id">
                    <a id="deleteserver"  class="btn btn-danger pull-left btn-xs" >Remove Server</a>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.activate').change(function () {
        var id = $(this).data('id');
        $.ajax({
            type: "POST",
            data: {id: id},
            url: "<?php echo base_url('server/changeStatus')?>",
            dataType: "json",
            success: function (data) {
                console.log(data);
            }
        });
    });
    $('.edit').click(function () {
        var id = $(this).data('id');
        $.ajax({
            type: "POST",
            data: {id: id},
            url: "<?php echo base_url('server/getData')?>",
            dataType: "json",
            success: function (data) {
                $('#server_id').val(data.id);
                $('#server_name').val(data.name);
                $('#server_secret').val(data.bbb_secret);
                $('#server_base').val(data.base_url);
                $('#server_url').val(data.bbb_url);
                $('#server_owner').val(data.owner);
                $('#editserver').modal('show');
                $('#deleteserver').attr("href", "<?php echo base_url('server/delete/')?>"+id);
            }
        });

    })
</script>