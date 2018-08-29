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
                    <span class="caption-subject font-red-sunglo bold uppercase">Closing Keuangan</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <span id="event_result">

                    </span>
                </div>
                <form role="form" method="post" class="cls_from_data_asuransi" action="#" id="idFormClosing" onsubmit="return false">
                    <div class="row">
                        <div class="form-body">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Bulan</label>
                                    <div class="input-group">
                                        <div class="input-icon">
                                            <select class="form-control" name="bulan" id="idbulan" onchange="pilih();">
                                             <option selected="selected" value="--semua--">Pilih Bulan</option>
                                                <?php
                                                    $bulan = array("01Januari" , "02Februari" , "03Maret" , "04April" , "05Mei" , "06Juni" , "07Juli" , "08Agustus" , "09September" , "10Oktober" , "11Novermber" , "12Desember");
                                                    foreach ($bulan as $newbulan) {
                                                        echo "<option value=".$newbulan.">".substr($newbulan,2)." </option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end <div class="col-md-6"> 1 -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <div class="input-group">
                                        <div class="input-icon">
                                            <select class="form-control" name="tahun" id="idthn" onchange="pilih();">
                                                    <option selected="selected" value="--semua--">Pilih Tahun</option>
                                                <?php
                                                   for ($thn = Date('Y'); $thn >= 1990; $thn--){
                                                        echo "<option  value=$thn>$thn</option>";
                                                    }
                                                ?>
                                                  
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- HIDDEN INPUT -->
                        <input type="text" id="idTmpAksiBtn" class="hidden">
                        <!-- END HIDDEN INPUT -->

                    </div>
                    <!--END ROW 1 -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-actions">

                                <button name="btnSimpan" class="btn blue" id="id_btnSimpan" onclick="ajaxSubmitAsuransi();">
                                    <!--<i class="fa fa-check"></i>--> Closing
                                </button>
                                <button id="id_btnBatal" type="reset" class="btn default">Batal</button>
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


<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url('metronic/global/plugins/respond.min.js'); ?>"></script>
<script src="<?php echo base_url('metronic/global/plugins/excanvas.min.js'); ?>"></script>
<![endif]-->
<script src="<?php echo base_url('metronic/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-migrate.min.js'); ?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('metronic/global/plugins/jquery-ui/jquery-ui.min.js'); ?>" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.cokie.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/uniform/jquery.uniform.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/bootstrap-toastr/toastr.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/select2/select2.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'); ?>"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- END CORE PLUGINS -->
<script type="text/javascript" src="<?php echo base_url('metronic/global/scripts/metronic.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/admin/layout4/scripts/layout.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/admin/layout4/scripts/demo.js'); ?>"></script>
<script src="<?php echo base_url('metronic/additional/start.js'); ?>" type="text/javascript"></script>
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        //UITree.init();
        // TableManaged.init();
        // $("#id_bUbah").attr("disabled", "disabled");
        // $("#id_bHapus").attr("disabled", "disabled");
    });
    //$(function () {
    var judul_menu = $('#id_a_menu_<?php echo $menu_id; ?>').text();
    $('#id_judul_menu').text(judul_menu);
    // MENU OPEN
    $(".menu_root").removeClass('start active open');
    $("#menu_root_<?php echo $menu_parent; ?>").addClass('start active open');
    // END MENU OPEN
   
    btnStart();
    $("#id_userName").focus();
    $("#id_showPassword").click(function () {
        if ($('#id_chckshowPassword').is(':checked')) {
            $('.clsPasswd').attr('type', 'text');
        } else {
            $('.clsPasswd').attr('type', 'password');
        }
    });
    $("#id_btnSimpan").click(function () {
        $('#idTmpAksiBtn').val('1');
    });
    $('#id_btnBatal').click(function () {
        btnStart();
    });

    function ajaxSubmitAsuransi() {
        dataString = $("#idFormClosing").serialize();
        ajaxModal();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>closing_perk/HitungClosingPerkiraan",
            data: dataString,
            success: function (data) {
                //console.log(data);
                $('#id_Reload').trigger('click');
                $('#id_btnBatal').trigger('click');
                // UIToastr.init(data.tipePesan, data.pesan);
                //$( "#event_result" ).append( data.notif );
                //untuk mendisabel button 
                $('#id_btnSimpan').attr('disabled',true);
                $('#id_btnBatal').attr('disabled',true);
            }

        });
        event.preventDefault();
    }
    
    $('#idFormAsuransi').submit(function (event) {
        dataString = $("#idFormClosing").serialize();
        var aksiBtn = $('#idTmpAksiBtn').val();
        if (aksiBtn == '1') {
            var r = confirm('Anda yakin menyimpan data ini?');
            if (r == true) {
                ajaxSubmitAsuransi();
            } else {//if(r)
                return false;
            }
        } else if (aksiBtn == '2') {
            var r = confirm('Anda yakin merubah data ini?');
            if (r == true) {
                ajaxUbahAsuransi();
            } else {//if(r)
                return false;
            }
        } else if (aksiBtn == '3') {
            var r = confirm('Anda yakin menghapus data ini?');
            if (r == true) {
                ajaxHapusAsuransi();
            } else {//if(r)
                return false;
            }
        }
    });
    // function btnclosing(){

    // }
    // $("#idbulan").click

//enable tombol dan mengaktifkannya//
    $(document).ready(function(){
        $('#id_btnSimpan').attr('disabled',true);
        $('#id_btnBatal').attr('disabled',true); 
    }
    );

    function pilih(){
          if (document.getElementById("idbulan").value == "--semua--"||document.getElementById("idthn").value == "--semua--"){
            $('#id_btnSimpan').attr('disabled',true);
            $('#id_btnBatal').attr('disabled',true);
          
        }     
        else{
            $('#id_btnSimpan').attr('disabled',false);
            $('#id_btnBatal').attr('disabled',false);
        }        

    }
//sampai sini enable tombol dan mengaktifkannya//

</script>


<!-- END JAVASCRIPTS -->