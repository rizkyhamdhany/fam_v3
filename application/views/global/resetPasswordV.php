<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $userid = $this->input->cookie('userId', TRUE);
if ($userid == '') exit('Anda tidak diijikan mengakses halaman ini.'); ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <title>Perumnas | Reset Password</title>
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
            <img id="id_imgCR" src="<?php echo base_url('metronic/img/perumnas_logoheader.png'); ?>" alt=""/>
        </div>
        <!-- END LOGO -->
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->

            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="login-form" action="<?php echo base_url('main/resetPassword') ?>" method="post">
                <h5 class="form-title" style="color: #000000;"><strong>Sistem Informasi Penyewaan Rumah Susun</strong></h5>
                <h3 class="form-title" style="color: #000000;"><strong>Reset Password </strong></h3>
                
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span>
                        Enter any username and password. </span>
                </div>
                <?php
                // menampilkan informasi error
                if (isset($login_info)) {
                    echo "<div class='alert alert-danger'>";
                    echo "<button class='close' data-close='alert'></button>";
                    echo "<span>" . $login_info . "<span>";
                    echo '</div>';
                }
                ?>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <?php
                        $this->load->helper('cookie');
                        echo form_input(array('name' => 'username', 'class' => 'form-control placeholder-no-fix', 'value' => get_cookie('userId'), 'placeholder' => 'Username', 'readonly' => 'readonly', 'id' => 'id_userName', 'autocomplete' => 'off'));
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <?php
                        echo form_password(array('name' => 'password', 'class' => 'form-control placeholder-no-fix clsPasswd', 'placeholder' => 'Password', 'id' => 'id_password', 'autocomplete' => 'off'));
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Konfirmasi Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <?php
                        echo form_password(array('name' => 'confPassword', 'class' => 'form-control placeholder-no-fix clsPasswd', 'placeholder' => 'Konfirmasi Password', 'id' => 'id_confPassword', 'autocomplete' => 'off'));
                        ?>
                    </div>
                </div>

                <div class="form-actions">
                    <label class="checkbox" id="id_showPassword">
                        <input type="checkbox" name="remember" value="1" id="id_chckshowPassword" /> Show password </label>
                    <button type="submit" class="btn blue pull-right" id="id_btnResetPasswd">
                        Reset <i class="m-icon-swapright m-icon-white"></i>
                    </button>
                </div>

            </form>

            <!-- END FORGOT PASSWORD FORM -->

        </div>
        <div class="copyright">
            <?php echo 2015; ?>
            © 
            <?php echo "mitrateknomadani"; ?>
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
                
                $.backstretch([
                    "<?php echo base_url('metronic/img/rusun01.jpg'); ?>",
                    "<?php echo base_url('metronic/img/rusun02.jpg'); ?>",
                    "<?php echo base_url('metronic/img/rusun03.jpg'); ?>"

                ], {
                    fade: 1000,
                    duration: 8000
                }
                );
                
                
                $("#id_password").focus();
                $("#id_showPassword").click(function () {
                    if ($('#id_chckshowPassword').is(':checked')) {
                        $('.clsPasswd').attr('type', 'text');
                    } else {
                        $('.clsPasswd').attr('type', 'password');
                    }
                });
                $("#id_btnResetPasswd").click(function () {
                    var passwd = $('#id_password').val();
                    var confPasswd = $('#id_confPassword').val();
                    if (passwd == confPasswd) {
                        return true;
                    } else {
                        alert("Password dan konfirmasi password tidak sama.");
                        $("#id_password").focus();
                        return false;
                    }
                });
                Login.init();

            });

        </script>
        
        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>