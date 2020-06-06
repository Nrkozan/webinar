<div class="navbar navbar-default" id="navbar-second">
    <div class="navbar-boxed">
        <ul class="nav navbar-nav no-border visible-xs-block">
            <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
        </ul>

        <div class="navbar-collapse collapse" id="navbar-second-toggle">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo base_url()?>"><i class="icon-display4 position-left"></i> Panel</a></li>

                <?php if ($this->session->userdata('level') == 'admin'): ?>
                    <li><a href="<?php echo base_url('server')?>"><i class="icon-display4 position-left"></i> Server</a></li>
                    <li><a href="<?php echo base_url('user')?>"><i class="icon-display4 position-left"></i> User</a></li>
                <?php endif; ?>

                <?php if ($this->session->userdata('level') == 'manager'): ?>
                    <li><a href="<?php echo base_url('server')?>"><i class="icon-display4 position-left"></i> Server</a></li>
                    <li><a href="<?php echo base_url('user')?>"><i class="icon-display4 position-left"></i> User</a></li>
                <?php endif; ?>



            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?php echo base_url('login/logout')?>">
                        <i class="icon-history position-left"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>