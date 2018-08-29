<!-- BEGIN PAGE BREADCRUMB -->
<!--

-->
<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
<div class="row">
    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs  font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Menu User (Root)</span>
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
                        if ($this->session->flashdata('successRoot') != '') {
                            echo '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>' . $this->session->flashdata('successRoot') . '
						  </div>';
                        }
                        if ($this->session->flashdata('errorRoot') != '') {
                            echo '<div class="span12 alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">×</button>' . $this->session->flashdata('errorRoot') . '
						</div>';
                        }
                        ?>
                    </span>
                </div>
                <div>
                    <form role="form"  method="post" class="cls_from_sec_menu_user" id="id_from_sec_menu_root_user"  action="<?php echo base_url('admin/sec_menu_user/home'); ?>">
                        <div class="form-body">
                            <div class="form-group">
                                <label>Nama menu</label>
                                <div class="input-group">
                                    <input id="id_idRootMenu" class="form-control" type="hidden" name="idRootMenu" placeholder=""/>
                                    <input id="id_descRootMenu" required="required" class="form-control input-sm" type="text" name="descRootMenu" maxlength="240"/>

                                    <span class="input-group-btn" style="vertical-align:top;">
                                        <a href="#" class="btn btn-success btn-sm" data-target="#id_modalTreeRootMenu"
                                           id="id_btnModalTreeRootMenu" data-toggle="modal">
                                            <i class="fa fa-search fa-fw"/></i>
                                            <!--Lihat data-->
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Urutan menu</label>
                                <input type="text" class="form-control input-sm nomor1" placeholder="" name="urutRootMenu" id="id_UrutRootMenu" required="required">
                            </div>

                        </div>
                        <div class="form-actions">
                            <button name="btnSimpanRoot" value="simpan" class="btn blue" id="id_btnSimpanRoot">
                            <!--<i class="fa fa-check"></i>--> Simpan</button>
                            <button name="btnUbahRoot" onclick="" class="btn yellow" id="id_btnUbahRoot">
                            <!--<i class="fa fa-edit"></i>--> Ubah</button>
                            <button name="btnHapusRoot" class="btn red" id="id_btnHapusRoot">
                            <!--<i class="fa fa-trash"></i>--> Hapus</button>
                            <button id="id_btnBatalRoot" type="reset" class="btn default">Batal</button>
                        </div>
                    </form>

                </div>

            </div>
        </div><!-- end <div class="portlet green-meadow box"> -->
    </div><!-- end <div class="col-md-6"> -->

    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs  font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Menu User</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
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
                <div>
                    <form role="form"  method="post" id="menudetail" class="cls_from_sec_menu_user"  action="<?php echo base_url('admin/sec_menu_user/home'); ?>">
                        <input id="id_tempTreeFlag" class="form-control" type="hidden" name="tempTreeFlag" placeholder=""/>
                        <div class="form-body">
                            <div class="form-group">
                                <label>Nama menu root</label>
                                <div class="input-group">
                                    <input id="id_idParent" class="form-control" type="" name="idParent" placeholder=""/>
                                    <input id="id_descParent" required="required" readonly="readonly" class="form-control input-sm"
                                           type="text" name="descParent"/>
                                    <span class="input-group-btn" style="vertical-align:top;">
                                        <a href="#" class="btn btn-success btn-sm" data-target="#id_modalTreeMenu"
                                           id="id_btnModalTreeParent" data-toggle="modal">
                                            <i class="fa fa-search fa-fw"/></i>
                                            <!--Lihat data-->
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama menu</label>
                                <div class="input-group">
                                    <input id="id_idMenu" class="form-control" type="hidden" name="idMenu" placeholder=""/>
                                    <input id="id_descMenu" required="required" class="form-control input-sm" type="text" name="descMenu"/>
                                    <span class="input-group-btn" style="vertical-align:top;">
                                        <a href="#" class="btn btn-success btn-sm" data-target="#id_modalTreeMenu"
                                           id="id_btnModalTreeMenu" data-toggle="modal">
                                            <i class="fa fa-search fa-fw"/></i>
                                            <!--Lihat data-->
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Header menu</label>
                                <input type="text" class="form-control input-sm" placeholder="" name="headerMenu" id="id_headerMenu" required="required">
                            </div>
                            <div class="form-group">
                                <label>Uri menu</label>
                                <input type="text" class="form-control input-sm" placeholder="" name="uriMenu" id="id_UriMenu" required="required">
                            </div>
                            <div class="form-group">
                                <label>Urutan menu</label>
                                <input type="text" class="form-control input-sm nomor1" placeholder="" name="urutMenu" id="id_UrutMenu" required="required">
                            </div>

                        </div>
                        <div class="form-actions">
                            <button name="btnSimpan" class="btn blue" id="id_btnSimpan"><!--<i class="fa fa-check"></i>--> Simpan</button>
                            <button name="btnUbah" onclick="" class="btn yellow" id="id_btnUbah"><!--<i class="fa fa-edit"></i>--> Ubah</button>
                            <button name="btnHapus" class="btn red" id="id_btnHapus"><!--<i class="fa fa-trash"></i>--> Hapus</button>
                            <button id="id_btnBatal" type="reset" class="btn default">Batal</button>
                        </div>
                    </form>

                </div>

            </div>
        </div><!-- end <div class="portlet green-meadow box"> -->

    </div><!-- end <div class="col-md-6"> -->
</div>
<div class="row">
    <div class="col-md-6">

    </div>
</div>

<!-- END PAGE CONTENT-->
<!-- /.modal -->
<div id="id_modalTreeMenu" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button id="id_button_close_modal" type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Menu</h4>
            </div>
            <form id="id_form_trans_pb" role="form" method="post">
                <div class="modal-body">
                    <div class="scroller" style="height:350px" data-always-visible="1" data-rail-visible1="1">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-body">
                                    <div id="jstree1" class="clsjstree">
                                        <ul>
                                            <?php
                                            foreach ($menu_all as $data) {
                                                echo '<li id = "' . $data['id'] . '">';
                                                echo '<a href="#" id = "a' . $data['id'] . '" data-header="' . $data['header'] . '" data-urutan="' . $data['urutan'] . '" 
									  class = "' . $data['link'] . '">';
                                                echo $data['nama'];
                                                echo '</a>';
                                                echo '<ul>';
                                                echo print_recursive_secMenuUser($data['child']);
                                                echo '</ul>';
                                                echo '</li>';
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <!-- end col-12 -->
                        </div>
                        <!-- END ROW-->
                    </div>
                    <!-- END SCROLLER-->
                </div>
                <!-- END MODAL BODY-->

                <div class="modal-footer">

                    <button type="button" data-dismiss="modal" class="btn default">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--  END MODAL-->
<!-- /.modal -->
<div id="id_modalTreeRootMenu" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button id="id_button_close_modalRoot" type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Menu (Root)</h4>
            </div>
            <form id="" role="form" method="post">
                <div class="modal-body">
                    <div class="scroller" style="height:350px" data-always-visible="1" data-rail-visible1="1">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-body">
                                    <div id="jstree2" class="clsjstree">
                                        <ul>
                                            <?php
                                            foreach ($menu_all as $data) {
                                                echo '<li id = "b' . $data['id'] . '">';
                                                echo '<a href="#" id = "b' . $data['id'] . '" class = "b' . $data['link'] . '">';
                                                echo $data['nama'];
                                                echo '</a>';
                                                echo '<ul>';

                                                echo '</ul>';
                                                echo '</li>';
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <!-- end col-12 -->
                        </div>
                        <!-- END ROW-->
                    </div>
                    <!-- END SCROLLER-->
                </div>
                <!-- END MODAL BODY-->

                <div class="modal-footer">

                    <button type="button" data-dismiss="modal" class="btn default">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--  END MODAL-->

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
<script src="<?php echo base_url('metronic/global/plugins/bootbox/bootbox.min.js'); ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/jstree/dist/jstree.min.js'); ?>"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<?php include "app.min.inc.php"; ?>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->

<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo base_url('metronic/layouts/layout4/scripts/layout.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/layouts/layout4/scripts/demo.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/additional/start.js'); ?>" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script>
    var UITree = function () {
        var e = function () {
            $(".clsjstree").jstree({core: {themes: {responsive: !1}}, types: {"default": {icon: "fa fa-folder icon-state-warning icon-lg"}, file: {icon: "fa fa-file icon-state-warning icon-lg"}}, plugins: ["types"]}), $("#tree_1").on("select_node.jstree", function (e, t) {
                var n = $("#" + t.selected).find("a");
                return"#" != n.attr("href") && "javascript:;" != n.attr("href") && "" != n.attr("href") ? ("_blank" == n.attr("target") && (n.attr("href").target = "_blank"), document.location.href = n.attr("href"), !1) : void 0
            })
        };
        return{init: function () {
                e()
            }}
    }();
    jQuery(document).ready(function () {
        UITree.init();
        UIBootbox.init();
    });
/*    
$(document).ready(function() {
	$("#id_from_sec_group_user").validate();
	$("#menudetail").validate();

});
*/
    
        readyToStart();
        
        $('#id_desc_usergroup').focus();
        // MENU
        $("#id_btnUbah").attr("disabled", "disabled");
        $("#id_btnHapus").attr("disabled", "disabled");
        //ROOT MENU
        $("#id_btnUbahRoot").attr("disabled", "disabled");
        $("#id_btnHapusRoot").attr("disabled", "disabled");

        $('#id_btnBatal').click(function () {
            $("#id_btnSimpan").removeAttr("disabled");
            $("#id_btnUbah").attr("disabled", "disabled");
            $("#id_btnHapus").attr("disabled", "disabled");
            $("#id_descParent").focus();
            readyToStart();
        });
        $('#id_btnBatalRoot').click(function () {
            $("#id_btnSimpanRoot").removeAttr("disabled");
            $("#id_btnUbahRoot").attr("disabled", "disabled");
            $("#id_btnHapusRoot").attr("disabled", "disabled");
            $("#id_descRootMenu").focus();
            readyToStart();
        });
        /*Jika lihaat data parent menu*/
        $('#id_btnModalTreeParent').click(function () {
            $("#id_tempTreeFlag").val(0);
        });
        /*Jika lihat data menu biasa*/
        $('#id_btnModalTreeMenu').click(function () {
            $("#id_tempTreeFlag").val(1);
        });
        //
        $("#jstree1").on("select_node.jstree",
                function (evt, data) {
                    /*NOTE AJA
                     GET PARENT ID
                     data.node.parent
                     GET ALL PARENT ID
                     data.node.parents
                     */
                    console.log(data);
                    var tempTreeFlag = $("#id_tempTreeFlag").val();
                    var menuText = data.node.text;
                    var menuId = data.node.id
                    var menuIdParent = data.node.parent;
                    /*
                     var menuIdArray 	= new Array();
                     menuIdArray		= menuId.split("_");*/
                    if (tempTreeFlag == 0) {//jika Parent menu
                        $("#id_idParent").val((menuId.trim()));
                        $("#id_descParent").val(menuText);
                        $('#id_button_close_modal').trigger('click');
                    } else {//jika menu biasa
                        if (menuIdParent == '#') {
                            alert("Root menu tidak dapat dikonfigurasi di form ini !");
                        } else {
                            /*Kosongkan parent id dan desc jika menu yang diselect tidak punya parent*/
                            $("#id_idParent").val("");
                            $("#id_descParent").val("");
                            /*End Kosongkan parent id dan desc jika menu yang diselect tidak punya parent*/
                            $("#id_idParent").val((menuIdParent.trim()));//ID Parent

                            var idMenuTextParent = $("#id_idParent").val();
                            var menuTextParent = $('#a' + idMenuTextParent).text();

                            $("#id_descParent").val(menuTextParent);//Text Parent
                            $("#id_idMenu").val((menuId.trim()));//ID Menu
                            var menuUri = $("#a" + menuId).attr('attrMenuUri');// get nama class dari id node child_parent 
                            $("#id_UriMenu").val(menuUri);//menuUri
                            $("#id_descMenu").val(menuText);//Deskripsi Menu

                            getDescMenu(menuId.trim());

                            $("#id_btnUbah").removeAttr("disabled");
                            $("#id_btnHapus").removeAttr("disabled");
                            $('#id_button_close_modal').trigger('click');
                            $("#id_btnSimpan").attr("disabled", "disabled");
                        }
                    }

                });//end jstree1
        $("#jstree2").on("select_node.jstree",
                function (evt, data) {
                    console.log(data);
                    var menuRootText = data.node.text;
                    var menuRootId = data.node.id
                    var menuRootId = menuRootId.substr(1);
                    $("#id_idRootMenu").val("");
                    $("#id_descRootMenu").val("");
                    $("#id_idRootMenu").val(menuRootId);
                    $("#id_descRootMenu").val(menuRootText);
                    getDescMenuRoot(menuRootId.trim());
                    //urutMenuRoot

                    $('#id_button_close_modalRoot').trigger('click');
                    $("#id_btnSimpanRoot").attr("disabled", "disabled");
                    $("#id_btnUbahRoot").removeAttr("disabled");
                    $("#id_btnHapusRoot").removeAttr("disabled");
                });

        function getDescMenu(idMenu) {
            if (idMenu != '') {
                $.post("<?php echo site_url('/admin/sec_menu_user/getDescMenu'); ?>",
                        {
                            'idMenu': idMenu
                        }, function (data) {
                    if (data.baris == 1) {
                        $('#id_headerMenu').val(data.header);
                        $('#id_UrutMenu').val(data.urutan);
                        /*
                         $('#').val(data.); */
                    } else {
                        alert('Data tidak ditemukan!');
                        $('#id_btnBatal').trigger('click');
                    }
                }, "json");
            }
        }
        function getDescMenuRoot(idMenu) {
            if (idMenu != '') {
                $.post("<?php echo site_url('/admin//sec_menu_user/getDescMenu'); ?>",
                        {
                            'idMenu': idMenu
                        }, function (data) {
                    if (data.baris == 1) {
                        $('#id_UrutRootMenu').val(data.urutan);
                        /*
                         $('#').val(data.); */
                    } else {
                        alert('Data tidak ditemukan!');
                        $('#id_btnBatal').trigger('click');
                    }
                }, "json");
            }
        }
    

    
//$(function () {

// END MENU OPEN
    var UITree = function () {

        var handleSample4 = function () {
            $('.clsjstree').jstree({
                "plugins": ["wholerow", "types"],
                "core": {
                    "themes": {
                        "responsive": false
                },
                },
                "types": {
                    "default": {
                        "icon": "fa fa-folder icon-state-warning icon-lg"
                    },
                    "file": {
                        "icon": "fa fa-file icon-state-warning icon-lg"
                    }
                }
            });
            //.bind("select_node.jstree", function (e, data) { alert(data.rslt.obj.data("id")); })
        }

        return {
            //main function to initiate the module
            init: function () {
                handleSample4();
            }

        };

    }();
/*
     $('#id_from_sec_menu_root_user').submit(function (e) {
     
     
     var currentForm = this;
     e.preventDefault();
     bootbox.confirm("Are you sure?", function(result) {
     if (result) {
     $('#id_from_sec_menu_root_user').attr("action","");
     currentForm.submit();
     }
     });
     
     });
     
*/
</script>


<!-- END JAVASCRIPTS -->