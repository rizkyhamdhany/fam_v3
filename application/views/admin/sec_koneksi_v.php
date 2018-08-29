<!-- BEGIN PAGE BREADCRUMB -->
<!--

-->
<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">
<div class="portlet-title">
    <div class="caption">
        <i class="fa fa-cogs  font-red-sunglo"></i>
        <span class="caption-subject font-red-sunglo bold uppercase">Form Koneksi database</span>
    </div>
    <div class="tools">
        <a href="javascript:;" class="collapse">
        </a>
        <a href="#portlet-config" data-toggle="modal" class="config">
        </a>
        <a href="javascript:;" class="reload">
        </a>
        <a href="javascript:;" class="remove">
        </a>
    </div>
</div>
<div class="portlet-body">
    <div>
                	<span id="event_result">
                    <?php
                    if ($this->session->flashdata('success') != '') {
                        echo '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>' . $this->session->flashdata('success') . '
						  </div>';
                    }
                    if ($this->session->flashdata('error') != '') {
                        echo '<div class="span12 alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">×</button>' . $this->session->flashdata('error') . '
						</div>';
                    }
                    ?>
                    </span>
    </div>
    <form role="form" method="post" class="cls_from_koneksi"
          action="<?php echo base_url('sec_koneksi/home'); ?>" enctype="multipart/form-data">
        <div class="row">

            <div class="form-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Key institusi</label>

                        <div class="input-group">
                            <div class="input-icon">
                                <i class="fa fa-list fa-fw"></i>
                                <input type="text" class="form-control" placeholder="" name="institusiName"
                                       id="id_institusiName" required="" readonly
                                       >
                                <input type="file" style="display: none;" class="form-control" placeholder=""
                                       name="institusiFile"
                                       id="id_institusiFile">
                            </div>
                                    <span class="input-group-btn">
                                        <a href="#" class="btn btn-success" data-target="#"
                                           id="id_btnFile" data-toggle="modal">
                                            <i class="fa fa-search fa-fw"/></i>
                                        </a>
                                    </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Server database</label>

                        <div class="input-icon">
                            <i class="fa fa-list"></i>
                            <input type="text" class="form-control target-dis" placeholder=""
                                   name="serverDb"
                                   id="id_serverDb" required=""
                                   >
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama database</label>

                        <div class="input-icon">
                            <i class="fa fa-list"></i>
                            <input type="text" class="form-control target-dis" placeholder=""
                                   name="namaDb"
                                   id="id_namaDb" required=""
                                >
                        </div>
                    </div>

                </div>
                <!--end <div class="col-md-6"> 1 -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>User database</label>

                        <div class="input-icon">
                            <i class="fa fa-list"></i>
                            <input type="text" class="form-control target-dis" placeholder=""
                                   name="userDb"
                                   id="id_userDb" required=""
                                >
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password database</label>

                        <div class="input-icon">
                            <i class="fa fa-list"></i>
                            <input type="text" class="form-control target-dis" placeholder=""
                                   name="passwdDb"
                                   id="id_passwdDb" required=""
                                >
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Port database</label>

                        <div class="input-icon">
                            <i class="fa fa-list"></i>
                            <input type="text" class="form-control target-dis input-small nomor" placeholder=""
                                   name="portDb"
                                   id="id_portDb" required=""
                                >
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!--END ROW 1 -->
        <div class="row">
            <div class="col-md-12">
                <div class="form-actions">
                    <button name="btnCreate" class="btn blue" id="id_btnCreate">
                        <i class="m-icon-swapright m-icon-white"></i> Buat file koneksi DB
                    </button>
                    <button name="btnRead" class="btn yellow" id="id_btnRead" style="display: none;">
                        <!--<i class="fa fa-check"></i>--> Baca key
                    </button>

                    <button id="id_btnBatal" type="reset" class="btn default">
                        <i class="fa fa-refresh"></i> Batal
                    </button>
                </div>
            </div>

        </div>
    </form>

</div>
</div>
<!-- end <div class="portlet green-meadow box"> -->
</div>
<!-- end <div class="col-md-6"> -->
<!--
<div class="col-md-6">


</div>
-->
<!-- end <div class="col-md-6"> -->
</div>
<div class="row">
    <div class="col-md-6">

    </div>
</div>

<!-- END PAGE CONTENT-->


<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url('metronic/global/plugins/respond.min.js'); ?>"></script>
<script src="<?php echo base_url('metronic/global/plugins/excanvas.min.js'); ?>"></script>
<![endif]-->
<script src="<?php echo base_url('metronic/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-migrate.min.js'); ?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('metronic/global/plugins/jquery-ui/jquery-ui.min.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>"
        type="text/javascript"></script>
<script
    src="<?php echo base_url('metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>"
    type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.cokie.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/uniform/jquery.uniform.min.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>"
        type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/select2/select2.min.js'); ?>"></script>
<script src="<?php echo base_url('metronic/admin/pages/scripts/components-pickers.js'); ?>"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"
        type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/pages/scripts/ui-general.js'); ?>" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- END CORE PLUGINS -->
<script src="<?php echo base_url('metronic/global/scripts/metronic.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout4/scripts/layout.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout4/scripts/demo.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/scripts/php_number_format.js') ?>"></script>
<script>

    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        ComponentsPickers.init();

    });
    $(".cls_from_koneksi").submit(function(e){
        if (!confirm("Anda yakin melakukan proses ini ?")){
            e.preventDefault();
            return;
        }
    });
    $('.nomor').keyup(function(){
        var val = $(this).val();
        if(isNaN(val)){
            val = val.replace(/[^0-9\.]/g,'');
            if(val.split('.').length>2)
                val =val.replace(/\.+$/,"");
        }
        $(this).val(val);
    });
    $("#id_btnFile").click(function () {
        $("#id_institusiFile").trigger('click');
    });
    $("#id_institusiFile").change(function () {
        var insFile = $("#id_institusiFile").val();
        $("#id_institusiName").val(insFile);
    });
    $(document).ajaxStart(function () {
        $('.modal_json').fadeIn('fast');
    }).ajaxStop(function () {
        $('.modal_json').fadeOut('fast');
    });

</script>


<!-- END JAVASCRIPTS -->