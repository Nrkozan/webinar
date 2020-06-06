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
                <span class="text-semibold">Server</span> - Detail
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

               <div class="col-md-5">
                   <div class="panel panel-success">
                       <div class="panel-heading">
                           <h6 class="panel-title">Add New Posting</h6>
                       </div>

                       <div class="panel-body">
                          <div class="row">
                              <form action="<?php echo base_url('server/user_add')?>" method="post">
                                  <div class="col-md-10">
                                      <select name="user" class="form-control" id="">
                                          <?php
                                          $ulist = null;
                                          if ($this->session->userdata('level') == 'admin'){
                                              $ulist = $this->main_model->getTable('user');
                                          }elseif ($this->session->userdata('level') == 'manager'){
                                              $ulist = $this->main_model->getTable('user',['staff' => $this->session->userdata('id')]);
                                          }
                                          
                                          ?>
                                          <?php foreach ($ulist as $row): ?>
                                              <?php if (!$this->main_model->getRow('user_server',['user' => $row->id,'server' => $this->uri->segment(3)])): ?>
                                                  <option value="<?php echo $row->id?>"><?php echo $row->name?></option>
                                              <?php endif; ?>
                                          <?php endforeach; ?>
                                      </select>
                                  </div>
                                  <div class="col-md-2">
                                      <input type="hidden" name="server" value="<?php echo $this->uri->segment(3)?>">
                                      <button class="btn btn-success btn-block">Add</button>
                                  </div>
                              </form>
                          </div>
                       </div>
                   </div>
                   <div class="panel panel-default">
                       <div class="panel-heading">
                           <h6 class="panel-title">User List</h6>
                       </div>

                       <table class="table table-bordered table-striped table-xs">
                           <thead>
                           <tr>
                               <th>Name</th>
                               <th>Action</th>
                           </tr>
                           </thead>
                           <tbody>
                           <?php foreach ($this->main_model->getTable('user_server',['server' => $this->uri->segment(3)]) as $row): ?>
                               <?php $user = $this->main_model->getRow('user',['id' => $row->user]) ?>
                               <tr>
                                   <td class="col-md-10"><?php echo $user->name?></td>
                                   <td>
                                       <a href="<?php echo base_url('server/user_remove/'.$row->id)?>" class="label label-danger">Remove</a>
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

