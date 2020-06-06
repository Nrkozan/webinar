<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php if (isset($title)){ echo $title;} else { echo 'NO_TITLE'; } ?>
    </title>

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
    <script src="<?php echo base_url()?>assets/js/plugins/ui/nicescroll.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/plugins/ui/drilldown.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="<?php echo base_url()?>assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script src="<?php echo base_url()?>assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script src="<?php echo base_url()?>assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/plugins/pickers/daterangepicker.js"></script>

    <script src="<?php echo base_url()?>assets/js/app.js"></script>
    <script src="<?php echo base_url()?>assets/js/demo_pages/dashboard_boxed.js"></script>
    <!-- /theme JS files -->

    <script src="<?php echo base_url('assets/')?>/js/sweetalert.min.js"></script>

    <script src="<?php echo base_url('assets/')?>js/plugins/notifications/noty.min.js"></script>
    <script src="<?php echo base_url('assets/')?>js/plugins/notifications/jgrowl.min.js"></script>
    <script src="<?php echo base_url('assets/')?>js/demo_pages/components_notifications_other.js"></script>
    <?php if($this->session->flashdata('msg')): ?>
        <script type="text/javascript">
            $( document ).ready(function() {
                new Noty({
                    text: <?php echo "'".$this->session->flashdata('msg')['text']."'";?>,
                    type: <?php echo "'".$this->session->flashdata('msg')['color']."'";?>}).show();
            });
        </script>
    <?php endif; ?>

</head>