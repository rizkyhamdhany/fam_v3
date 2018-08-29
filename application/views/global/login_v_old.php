<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <title>SKI | Login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('metronic/global/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('metronic/global/plugins/simple-line-icons/simple-line-icons.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('metronic/global/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('metronic/global/plugins/uniform/css/uniform.default.css'); ?>" rel="stylesheet" type="text/css"/>

        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo base_url('metronic/admin/pages/css/login-soft.css'); ?>" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME STYLES -->
        <link href="<?php echo base_url('metronic/global/css/components-rounded.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('metronic/global/css/plugins.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('metronic/admin/layout/css/layout.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('metronic/admin/layout/css/themes/default.css'); ?>" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="<?php echo base_url('metronic/admin/layout/css/custom.css'); ?>" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="<?php echo base_url('metronic/img/mtm.ico'); ?>"/>
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="login">
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="menu-toggler sidebar-toggler">
        </div>
        <!-- END SIDEBAR TOGGLER BUTTON -->
        <!-- BEGIN LOGO -->
        <div class="logo"  style="color: #ffffff;">
            <!--<h2>PT. Perumnas</h2>-->
            <img id="id_imgCR" src="<?php echo base_url('metronic/img/ski.png'); ?>" alt=""/>
            <h3 class="form-title" style="color: #e36623;"><strong>PT Sumber Kita Indah</strong></h3>            
        </div>
        
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div id="id_divFormLogin" class="content">
            <!-- BEGIN LOGIN FORM -->

            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="login-form " action="<?php echo base_url('main/login') ?>" method="post">
                <h3 class="form-title" style="color: #000000;"><strong>Sistem Informasi </strong></h3>
                <h3 class="form-title" style="color: #000000;"><strong>Manajemen Inventory</strong></h3>


                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span>
                        Enter any username and password. </span>
                </div>

                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <?php
                        echo form_input(array('name' => 'username', 'class' => 'form-control placeholder-no-fix', 'value' => set_value('username'), 'placeholder' => 'Username', 'id' => 'username', 'autocomplete' => 'off'));
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <?php
                        echo form_password(array('name' => 'password', 'class' => 'form-control placeholder-no-fix', 'placeholder' => 'Password', 'id' => 'password', 'autocomplete' => 'off'));
                        ?>
                    </div>
                </div>

                <div class="form-group hidden">
                    <label class="control-label visible-ie8 visible-ie9">Tanggal</label>
                    <div class="input-icon">
                        <i class="fa fa-calendar"></i>
                        <?php
                        $tgl_hr_ini = $tanggal_hari_ini;
                        $tgl_hr_ini = str_replace("/", "-", $tgl_hr_ini);
                        $tgl_hr_ini = date("Y-m-d");
                        echo form_input(array('name' => 'tgl_login', 'class' => 'form-control placeholder-no-fix', 'value' => "$tgl_hr_ini", 'id' => 'tgl_login', 'readonly' => 'readonly', 'autocomplete' => 'off'));
                        //angga
                        ?>
                    </div>
                </div>
                <div class="form-group hidden">
                    <label class="control-label visible-ie8 visible-ie9">Kantor</label>
                    <div class="input-icon">
                        <i class="fa fa-home"></i>
                        <?php
                        echo form_input(array('name' => 'nama_kantor', 'class' => 'form-control placeholder-no-fix', 'value' => "$lembaga_nama", 'type' => 'text', 'readonly' => 'readonly', 'autocomplete' => 'off'));
                        ?>
                    </div>
                </div>
                <div class="form-actions">
                    <!--<label id="id_lblBacklogo">
                    << back to logo </label>-->
                    <button type="submit" class="btn blue pull-right">
                        Masuk <i class="m-icon-swapright m-icon-white"></i>
                    </button>
                </div>
                <div class=""><br></div>

            </form>
            <!-- END FORGOT PASSWORD FORM -->

        </div>
        <div class="copyright">
            <?php echo $copyright_year; ?>
            © 
            <?php echo $copyright_content; ?>
        </div>
        <!-- END LOGIN -->
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <!-- BEGIN CORE PLUGINS -->
        <!--[if lt IE 9]>
        <script src="../../assets/global/plugins/respond.min.js"></script>
        <script src="../../assets/global/plugins/excanvas.min.js"></script> 
        <![endif]-->

        <script src="<?php echo base_url('metronic/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('metronic/global/plugins/jquery-migrate.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('metronic/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('metronic/global/plugins/uniform/jquery.uniform.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('metronic/global/plugins/jquery.cokie.min.js'); ?>" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url('metronic/global/plugins/jquery-validation/js/jquery.validate.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('metronic/global/plugins/backstretch/jquery.backstretch.min.js'); ?>" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url('metronic/global/scripts/metronic.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('metronic/admin/layout/scripts/layout.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('metronic/admin/layout/scripts/demo.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('metronic/admin/pages/scripts/login-soft.js'); ?>" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <script>
            jQuery(document).ready(function () {
                Metronic.init(); // init metronic core components
                Layout.init(); // init current layout
                Demo.init();
                $("#username").focus();
                // init background slide images
                $.backstretch([
                    "<?php echo base_url('metronic/img/rusun01.jpg'); ?>",
                    "<?php echo base_url('metronic/img/rusun02.jpg'); ?>",
                    "<?php echo base_url('metronic/img/rusun03.jpg'); ?>"

                ], {
                    fade: 1000,
                    duration: 8000
                }
                );

                Login.init();

            });

        </script>
        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>