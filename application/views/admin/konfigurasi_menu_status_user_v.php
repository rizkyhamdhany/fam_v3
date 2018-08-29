<!--<div class="modal_json" style="display:none"></div>-->
<div class="row">
    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs  font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Group User</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div><span id="event_result">

                    </span></div>
                <div>
                    <form method="post" id="id_from_sec_group_user"  action="<?php echo base_url('admin/konfigurasi_menu_status_user/simpan'); ?>">
                        <div class="form-body">

                            <div class="form-group">
                                <label>Group User</label>
                                <?php
                                $data = array();
                                $data[''] = '';
                                foreach ($status_user as $row) :
                                    $data[$row['usergroup_id']] = $row['usergroup_desc'];
                                endforeach;
                                echo form_dropdown('status_user', $data, '', 'id="id_group_user" class="form-control  input-sm" required="required" ');
                                ?>
                            </div>
                            <div class="form-group">
                                <!--<label>Menu yang diizinkan</label>-->
                                <input type="text" name="menu_allow" class="form-control hidden" placeholder="" id="id_menu_allow">
                                <!-- HIDDEN INPUT -->

                                <!-- END HIDDEN INPUT -->    
                            </div>    
                        </div>
                        <div class="form-actions">
                            <button type="button" name="btnSimpan" class="btn blue" id="id_btnSimpan"><!--<i class="fa fa-check"></i>--> Simpan</button>
                            <button type="button" class="btn default" onclick="">Batal</button>
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Menu</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div><span id="event_result"></span></div>
                <div id="jstree1" class="scroller" style="height:400px">
                    <ul>
                        <?php
                        $i = 2;
                        foreach ($menu_all as $data) {
                            echo '<li id = "' . $data['id'] . '">';
                            echo '<a href="#" id = "a' . $data['id'] . '">';
                            echo $data['nama'];
                            echo '</a>';
                            echo '<ul>';
                            echo print_recursive_menu_all_li($data['child']);
                            echo '</ul>';
                            echo '</li>';
                            $i++;
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div><!-- end <div class="portlet green-meadow box"> -->
    </div><!-- end <div class="col-md-6"> -->
</div>


<!-- END PAGE CONTENT-->
<?php $this->load->view('app.min.inc.php'); ?>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/jstree/dist/jstree.min.js'); ?>"></script>

<script>


    var UITree = function () {
        var t = function () {
            $("#jstree1").jstree({
                plugins: ["wholerow", "checkbox", "types"],
                core: {themes: {responsive: !1}}, types: {"default": {icon: "fa fa-folder icon-state-warning icon-lg"}, file: {icon: "fa fa-file icon-state-warning icon-lg"}}})

        };
        return{init: function () {
                t()
            }}
    }();
    App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
        UIBootbox.init();
        UITree.init();
    });

    $(function () {
        //$("#8").attr('data-jstree','{"opened":true,"selected":true}');
        $("#id_group_user").change(function () {
            var kd = $(this).val();
            kd = kd.trim();
            if (kd != '') {
                //  alert(kd);
                $.post("<?php echo site_url('/admin/konfigurasi_menu_status_user/get_menu_group_user'); ?>",
                        {
                            'kd_group_user': kd
                        },
                        function (data) {
                            console.log(data);
                            var total_menu = data.data_menu.length;
                            var i,j;
                            $('#jstree1').jstree("deselect_all");
                            $("#jstree1").jstree('open_all');

                            for (i = 0; i < total_menu; i++) {
                                if (data.data_menu[i].parent == 0){
                                    $("#a" + data.data_menu[i].menu_id).trigger('click');

                                }else{
//
                                    $("#a" + data.data_menu[i].menu_id + "_" + data.data_menu[i].parent).trigger('click');
//                                alert("#" + data.data_menu[i].menu_id+ "_" + data.data_menu[i].parent)
                                }
                            }
                        }, "json");
            }//if kd<>''

        });
    });
    function get_selected_node_tree() {
        $("#id_menu_allow").val('');
        var result = $('#jstree1').jstree('get_checked');
        $("#id_menu_allow").val(result);

    }

    //$(document).on('click', '#id_btnSimpan', function(){
    $("#id_btnSimpan").click(function () {
        get_selected_node_tree();
        bootbox.confirm("Apakah anda yakin menyimpan data ini?", function (o) {
            if (o == true) {
                $('#id_from_sec_group_user').submit();
            }
        });

    });


</script>
<!-- END JAVASCRIPTS -->