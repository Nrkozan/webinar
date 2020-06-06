
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BBB Control</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url()?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url()?>assets/css/core.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url()?>assets/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url()?>assets/css/colors.min.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="<?php echo base_url()?>assets/js/plugins/loaders/pace.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/core/libraries/jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/core/libraries/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->


    <!-- Theme JS files -->
    <script src="<?php echo base_url()?>assets/js/app.js"></script>
    <!-- /theme JS files -->

</head>

<body class="login-container">

<!-- Main navbar -->
<div class="navbar navbar-inverse">



</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <!-- Simple login form -->
                <form action="<?php echo base_url('login/sign_in_do')?>" method="post">
                    <div class="panel panel-body login-form">
                        <div class="text-center">
                            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                            <h5 class="content-group">Login <small class="display-block">
                                    Fill in the information to start the session
                                </small></h5>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="text" class="form-control" name="username" placeholder="Username">
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>


                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Login <i class="icon-circle-right2 position-right"></i></button>
                        </div>

                        <div class="content-divider text-muted form-group"><span>or sign in with</span></div>
                        <ul class="list-inline form-group list-inline-condensed text-center">
                            <a href="<?php echo $this->google->get_login_url();?>">
                                <img src="<?php echo base_url('btn.png')?>" class="img-responsive cursor-pointer">
                            </a>
                        </ul>

                        <div class="content-divider text-muted form-group"><span>Don't have an account?</span></div>
                        <a href="<?php echo base_url('login/register')?>" class="btn btn-default btn-block content-group">Sign up</a>
                        <span class="help-block text-center no-margin">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span>

                    </div>
                </form>
                <!-- /simple login form -->


                <!-- Footer -->
                <div class="footer text-muted text-center">
                    &copy; 2020. <a href="#" target="_blank">BBB Control</a>
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>
