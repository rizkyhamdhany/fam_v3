<!-- BEGIN PAGE BREADCRUMB -->

<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
<div class="row">
    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-pencil-square-o font-blue-chambray"></i> <span
                        class="caption-subject font-blue-chambray bold uppercase"><?php echo $menu_header ?></span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a> <a
                        href="javascript:;" class="fullscreen"> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <span id="event_result"> 
                        <?php
                        if ($this->session->flashdata('success') != '') {
                            echo '
                        <div class="row-fluid">
                        <div class="span12 alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>' . $this->session->flashdata('success') . '
                        </div>
                        </div>';
                        }
                        if ($this->session->flashdata('error') != '') {
                            echo '
                        <div class="row-fluid">
                        <div class="span12 alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert">×</button>' . $this->session->flashdata('error') . '
                        </div>
                        </div>';
                        }
                        ?>
                    </span>
                </div>
                <form role="form" method="post" class="cls_from_utility_db" action="<?php echo base_url('utility/utility_db/home'); ?>" id="id_formutilityDb">
                    <input type="text" id="idTmpAksiBtn" class="hidden">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row-fluid">
                                <div class="span12 alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    Pastikan tidak ada user yang login
                                </div>
                            </div>
                            <div class="form-actions">
                                <button name="btnProses" class="btn blue" id="id_btnProses" title="Proses" type="submit">
                                    <span class="fa fa-gear"></span>
                                    Backup DB
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6"></div>
</div>

<!-- END PAGE CONTENT-->


<!--  END  MODAL Data Supplier -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url('metronic/global/plugins/respond.min.js'); ?>"></script>
<script src="<?php echo base_url('metronic/global/plugins/excanvas.min.js'); ?>"></script> 
<![endif]-->
<script src="<?php echo base_url('metronic/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/js.cookie.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/bootstrap-toastr/toastr.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/scripts/datatable.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/datatables/datatables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'); ?>"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<?php include "app.min.inc.php"; ?>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->

<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo base_url('metronic/layouts/layout4/scripts/layout.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/layouts/layout4/scripts/demo.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/layouts/global/scripts/quick-sidebar.min.js'); ?>" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script src="<?php echo base_url('metronic/additional/start.js'); ?>" type="text/javascript"></script>
<script>
    jQuery(document).ready(function () {
        //UITree.init();
    });
    //$(function () {
    var judul_menu = $('#id_a_menu_<?php echo $menu_id; ?>').text();
    $('#id_judul_menu').text(judul_menu);
    // MENU OPEN
    $(".menu_root").removeClass('start active open');
    $("#menu_root_<?php echo $menu_parent; ?>").addClass('start active open');
    // END MENU OPEN

    btnStart();
    readyToStart();

    $('#id_btnBatal').click(function () {
        btnStart();
        resetForm();
    });
    $("#id_btnProses").click(function () {
        $('#idTmpAksiBtn').val('1');
    });

    function callDownload() {
        ajaxModal();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>utility/utility_db/download",
            data: dataString,
            success: function (data) {

            }

        });

    }
    function ajaxSubmit() {
        ajaxModal();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>utility/utility_db/backup",
            data: dataString,
            success: function (data) {
                UIToastr.init(data.tipePesan, data.pesan);
                callDownload();
            }

        });

    }
    /*$('#id_formutilityDb').submit(function (event) {
        dataString = $("#id_formutilityDb").serialize();
        event.preventDefault();
        var aksiBtn = $('#idTmpAksiBtn').val();
        if (aksiBtn == '1') {
            var r = confirm('Anda yakin melakukan proses ini?');
            if (r == true) {
                ajaxSubmit();
            } else {//if(r)
                return false;
            }
        }
    });*/
</script>


<!-- END JAVASCRIPTS -->