
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
                <form action="<?php echo base_url('login/register_do')?>" method="post">

                    <div class="panel panel-body login-form">

                        <div class="text-center">
                            <div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
                            <h5 class="content-group">Create account <small class="display-block">All fields are required</small></h5>
                        </div>

                        <div class="content-divider text-muted form-group"><span>Your credentials</span></div>


                        <?php if (!empty($this->session->flashdata('login_alert'))): ?>
                            <div class="alert alert-danger alert-bordered">
                                <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                                <span class="text-semibold">Oh snap!</span> <br> <?php echo $this->session->flashdata('login_alert')?></a>.
                            </div>
                        <?php endif; ?>
                        
                        <div class="form-group has-feedback has-feedback-left">
                            <input type="text" class="form-control" name="name" placeholder="Your name">
                            <div class="form-control-feedback">
                                <i class="icon-user-check text-muted"></i>
                            </div>
                        </div>



                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" class="form-control" name="password" placeholder="Create password">
                            <div class="form-control-feedback">
                                <i class="icon-user-lock text-muted"></i>
                            </div>
                        </div>

                        <div class="content-divider text-muted form-group"><span>Your privacy</span></div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="text" class="form-control" name="mail" placeholder="Your email">
                            <div class="form-control-feedback">
                                <i class="icon-mention text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="text" class="form-control" name="mail2" placeholder="Repeat email">
                            <div class="form-control-feedback">
                                <i class="icon-mention text-muted"></i>
                            </div>
                        </div>

                        <div class="content-divider text-muted form-group"><span>Additions</span></div>

                        <div class="form-group">


                            <div class="checkbox">
                                <label>
                                    <input required type="checkbox" class="styled">
                                    Accept <a href="#">terms of service</a>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn bg-teal btn-block btn-lg">Register <i class="icon-circle-right2 position-right"></i></button>
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
