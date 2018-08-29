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
        <span class="caption-subject font-red-sunglo bold uppercase">Aktivasi sistem</span>
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
                        $decryptedText = $this->session->flashdata('data');
                        $decryptedTextArray = explode('_', $decryptedText);
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
    <form role="form" method="post" class="cls_from_aktivasi"
          action="<?php echo base_url('sec_aktivasi/home'); ?>" enctype="multipart/form-data">
        <div class="row">

            <div class="form-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama institusi</label>

                        <div class="input-group">
                            <div class="input-icon">
                                <i class="fa fa-list fa-fw"></i>
                                <input type="text" class="form-control" placeholder="" name="institusiName"
                                       id="id_institusiName" required=""
                                       value="<?php if ($this->session->flashdata('data') != '') {
                                           echo $decryptedTextArray[0];
                                       } ?>">
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
                        <label>Serial number</label>

                        <div class="input-icon">
                            <i class="fa fa-list"></i>
                            <input type="text" class="form-control target-dis" placeholder=""
                                   name="serialNumb"
                                   id="id_serialNumb" required=""
                                   value="<?php if ($this->session->flashdata('data') != '') {
                                       echo $decryptedTextArray[1];
                                   } ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Jumlah max cabang</label>

                                <div class="input-icon">
                                    <i class="fa fa-list"></i>
                                    <input type="text" class="form-control target-dis nomor" placeholder=""
                                           name="maxCab"
                                           id="id_maxCab" required=""
                                           value="<?php if ($this->session->flashdata('data') != '') {
                                               echo $decryptedTextArray[2];
                                           } ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label>Cipher</label>

                                <div class="input-icon">
                                    <i class="fa fa-list"></i>
                                    <input type="text" class="form-control target-dis" placeholder=""
                                           name="cipher"
                                           id="id_cipher" required=""
                                           value="<?php if ($this->session->flashdata('data') != '') {
                                               echo $decryptedTextArray[3];
                                           } ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end <div class="col-md-6"> 1 -->
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Kode cabang</label>

                                <div class="input-icon">
                                    <i class="fa fa-list"></i>
                                    <input type="text" class="form-control target-dis" placeholder=""
                                           name="kodeCabang"
                                           id="id_kodeCabang" required=""
                                           value="<?php if ($this->session->flashdata('data') != '') {
                                               echo $decryptedTextArray[4];
                                           } ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label>Nama cabang</label>

                                <div class="input-icon">
                                    <i class="fa fa-list"></i>
                                    <input type="text" class="form-control target-dis" placeholder=""
                                           name="namaCabang"
                                           id="id_namaCabang" required=""
                                           value="<?php if ($this->session->flashdata('data') != '') {
                                               echo $decryptedTextArray[5];
                                           } ?>">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label>Startup password administrator</label>

                        <div class="input-icon">
                            <i class="fa fa-list"></i>
                            <input type="text" class="form-control target-dis" placeholder=""
                                   name="passwordAdm"
                                   id="id_passwordAdm" required=""
                                   value="<?php if ($this->session->flashdata('data') != '') {
                                       echo $decryptedTextArray[6];
                                   } ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Masa Pakai</label>

                                <div class="input-icon">
                                    <i class="fa fa-list"></i>
                                    <select name="masaPakai" id="id_masaPakai" class="form-control">
                                        <option value="0">Dibatasi</option>
                                        <option value="1">Tidak Dibatasi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label>Kadaluarsa</label>

                                <div class="input-group">
                                        	<span class="input-group-addon">
											<i class="fa fa-calendar"></i>
											</span>
                                    <input name="expired" id="id_expired"
                                           class="form-control form-control-inline input-medium date-picker  target-dis"
                                           data-date-format="dd-mm-yyyy" type="text"
                                           placeholder="dd-mm-yyyy" required
                                           value="<?php if ($this->session->flashdata('data') != '') {
                                               echo $decryptedTextArray[7];
                                           } ?>">
                                </div>
                            </div>
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
                        <!--<i class="fa fa-check"></i>--> Buat key
                    </button>
                    <button name="btnRead" class="btn yellow" id="id_btnRead" style="display: none;">
                        <!--<i class="fa fa-check"></i>--> Baca key
                    </button>
                    <a href="" data-toggle="modal" class="btn red" id="id_aDownload" style="display: none;">
                        <!--<i class="fa fa-check"></i>--> Unduh key
                    </a>
                    <button id="id_btnBatal" type="reset" class="btn default">Batal</button>
                </div>
            </div>

        </div>
    </form>
    <form action="<?php echo base_url('sec_aktivasi/home'); ?>" method="post">
        <?php
        if ($this->session->flashdata('path_file') != '') {
        ?>
            <input type="text" value="<?php echo $this->session->flashdata('path_file'); ?>" name="pathFileUnduh"  style="display: none;">
            <input type="text" value="<?php echo $this->session->flashdata('name_file'); ?>" name="nameFileUnduh"  style="display: none;">
        <?php
        }
        ?>
        <?php
        if ($this->session->flashdata('path_fileBaca') != '') {
            ?>
            <input type="text" value="<?php echo $this->session->flashdata('path_fileBaca'); ?>" name="pathFileUnduh"  style="display: none;">
            <input type="text" value="<?php echo $this->session->flashdata('name_fileBaca'); ?>" name="nameFileUnduh"  style="display: none;">
        <?php
        }
        ?>
        <button name="btnDownload" class="btn yellow" id="id_btnDownload" style="display: none;">

        </button>
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
    //$(function () {
    var judul_menu = $('#id_a_menu_<?php echo $menu_id; ?>').text();
    $('#id_judul_menu').text(judul_menu);
    // MENU OPEN
    $(".menu_root").removeClass('start active open');
    $("#menu_root_<?php echo $menu_parent; ?>").addClass('start active open');
    // END MENU OPEN
    //$("#id_aDownload").attr("disabled","disabled");
    //$("#id_btnRead").attr("disabled","disabled");
    $("#id_masaPakai").change(function () {
        var masaPakai = $("#id_masaPakai").val();
        if (masaPakai == 1) {
            $("#id_expired").attr("disabled", "disabled");
        } else {
            $("#id_expired").removeAttr("disabled");
        }
    });

    $("#id_btnFile").click(function () {
        $("#id_institusiFile").trigger('click');
    });
    $("#id_institusiFile").change(function () {
        var insFile = $("#id_institusiFile").val();
        $("#id_institusiName").val(insFile);
        $(".target-dis").attr("disabled", "disabled");
        $("#id_btnRead").trigger('click');
    });
    $("#id_btnBatal").click(function () {
        location.reload();
    });
    $("#id_aDownload").click(function () {
        $("#id_btnDownload").trigger('click');
    });
    <!-- JIKA LIMIT MASA PAKAI TIDAK DIBATASI -->
    <?php
    if ($this->session->flashdata('data') != '') {
        if ($decryptedTextArray[7]=='0000-00-00'){
        ?>
        $("#id_masaPakai").val(1);
        $("#id_expired").val("");
        $("#id_expired").attr("disabled", "disabled");
        <?php
        }
    } ?>
    <!-- JIKA BUAT KEY LANGSUNG AUTO DOWNLOAD DENGAN TRIGGER KLIK -->
    <?php
    if ($this->session->flashdata('path_file') != '') { ?>
        $("#id_btnDownload").trigger('click');
    <?php
    }
    ?>
    $('.nomor').keyup(function(){
        var val = $(this).val();
         if(isNaN(val)){
            val = val.replace(/[^0-9\.]/g,'');
            if(val.split('.').length>2)
                val =val.replace(/\.+$/,"");
        }
        $(this).val(val);
    });
    $(document).ajaxStart(function () {
        $('.modal_json').fadeIn('fast');
    }).ajaxStop(function () {
        $('.modal_json').fadeOut('fast');
    });

</script>


<!-- END JAVASCRIPTS -->