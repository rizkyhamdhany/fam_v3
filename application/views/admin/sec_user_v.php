<!-- BEGIN PAGE BREADCRUMB -->
<!--

-->
<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit  bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-red"></i>
                    <span class="caption-subject font-red sbold uppercase"><?php echo $menu_header; ?></span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <ul class="nav nav-pills">
                    <li class="linav active" id="linav1">
                        <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                            Data user </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Form data user</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <div class="scroller" style="height:400px; ">
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="id_Reload" style="display: none;"></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelUser">
                                        <thead>
                                            <tr>
                                                <th>
                                                    User ID
                                                </th>
                                                <th>
                                                    User Name
                                                </th>
                                                <th>
                                                    Nama Karyawan
                                                </th>
                                                <th>
                                                    Password
                                                </th>
                                                <th>
                                                    User Group
                                                </th>
                                                <th>
                                                    Id Kyw
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                        <tfoot>


                                        </tfoot>
                                    </table>
                                </div>
                                <!-- end col-12 -->
                            </div>
                            <!-- END ROW-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_2_2">
                        <!-- BEGIN FORM-->
                        <form role="form" method="post" class="form-horizontal cls_from_sec_user cls_form_validate "
                              action="<?php echo base_url('admin/sec_user/home'); ?>" id="idFormUser" novalidate="novalidate">    

                            <div class="form-body">
                                <!--                                <div class="alert alert-danger display-hide">
                                                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. 
                                                                </div>-->
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                <div class="form-group hidden">
                                    <label class="control-label col-md-3">User id 

                                    </label>
                                    <div class="col-md-9">
                                        <input id="id_userId" class="form-control"
                                               type="text" name="userId" readonly/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Karyawan
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array();
                                        $data[''] = '';
                                        foreach ($karyawan as $k) :
                                            $data[$k->id_kyw] = $k->nama_kyw;
                                        endforeach;
                                        echo form_dropdown('karyawan', $data, '', 'id="id_karyawan" class="form-control" required');
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">User name 
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input required id="id_userName"  name="userName" data-required="1" class="form-control" type="text"> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Password
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input required id="id_kataKunci"  name="kataKunci" data-required="1" class="form-control clsPasswd" type="password"> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Konfirmasi Password
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input required id="id_confKataKunci"  name="confKataKunci" data-required="1" class="form-control clsPasswd" type="password"> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">&nbsp;</label>
                                    <div class="col-md-4">
                                        <div class="mt-checkbox-list" >
                                            <label class="mt-checkbox mt-checkbox-outline" id ="id_showPassword">
                                                <input type="checkbox" name="remember" value="1" id="id_chckshowPassword" /> Show password
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Group User
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array();
                                        $data[''] = '';
                                        foreach ($group_user as $row) :
                                            $data[$row['usergroup_id']] = $row['usergroup_desc'];
                                        endforeach;
                                        echo form_dropdown('userGroup', $data, '', 'id="id_groupUser" class="form-control" required');
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Golongan User
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array();
                                        $data[''] = '';
                                        foreach ($goluser as $k) :
                                            $data[$k->goluser_id] = $k->goluser_desc;
                                        endforeach;
                                        echo form_dropdown('golUser', $data, '', 'id="id_golUser" class="form-control" required');
                                        ?>                                   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Status User
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array();
                                        $data[''] = '';
                                        foreach ($statususer as $k) :
                                            $data[$k->statususer_id] = $k->statususer_desc;
                                        endforeach;
                                        echo form_dropdown('statusUser', $data, '', 'id="id_statusUser" class="form-control" required');
                                        ?>                                   
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type ="button" name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                            <i class="fa fa-check"></i> Simpan
                                        </button>
                                        <button id="id_btnBatal" type="reset" class="btn default"><i class="fa fa-refresh"></i> Batal</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>    
                </div>

            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>


<!-- END PAGE CONTENT-->
<!--  MODAL APPROVAL -->
<div class="modal fade draggable-modal" id="idDivTabelUser" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data User</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="col-md-12">
                            <button id="id_Reload" style="display: none;"></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-body">



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
                <button type="button" class="btn default" data-dismiss="modal" id="btnCloseModalDataUser">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--  END MODAL APPROVAL -->
<?php $this->load->view('app.min.inc.php'); ?>
<script>

    var TableManaged = function () {

        var initTable1 = function () {
            var table = $('#idTabelUser');
            // begin first table
            table.dataTable({
                "ajax": "<?php echo base_url("/admin/sec_user/getUserInfo"); ?>",
                "columns": [
                    {"data": "userid"},
                    {"data": "username"},
                    {"data": "nama_kyw"},
                    {"data": "passwd"},
                    {"data": "usergroup"},
                    {"data": "id_kyw"}
                ],
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "No data available in table",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "No entries found",
                    "infoFiltered": "(filtered1 from _MAX_ total entries)",
                    "lengthMenu": "Show _MENU_ entries",
                    "search": "Search:",
                    "zeroRecords": "No matching records found"
                },
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.


                "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 5,
                "pagingType": "bootstrap_full_number",
                "language": {
                    "search": "Cari: ",
                    "lengthMenu": "  _MENU_ records",
                    "paginate": {
                        "previous": "Prev",
                        "next": "Next",
                        "last": "Last",
                        "first": "First"
                    }
                },
                "aaSorting": [[0, 'asc']/*, [5,'desc']*/],
                "columnDefs": [{// set default column settings
                        'orderable': true,
                        "searchable": true,
                        'targets': [0]
                    }],
                "order": [
                    [0, "asc"]
                ] // set first column as a default sort by asc
            });
            $('#id_Reload').click(function () {
                table.api().ajax.reload();
            });

            var tableWrapper = jQuery('#example_wrapper');

            table.find('.group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr("checked", true);
                        $(this).parents('tr').addClass("active");
                    } else {
                        $(this).attr("checked", false);
                        $(this).parents('tr').removeClass("active");
                    }
                });
                jQuery.uniform.update(set);
            });

            table.on('change', 'tbody tr .checkboxes', function () {
                $(this).parents('tr').toggleClass("active");
            });
            table.on('click', 'tbody tr', function () {
                $("#navitab_2_2").trigger('click');
                var userId = $(this).find("td").eq(0).html();
                var userName = $(this).find("td").eq(1).html();
                //var userFullName = $(this).find("td").eq(2).html();
                var passwd = $(this).find("td").eq(3).html();
                var userGroup = $(this).find("td").eq(4).html();
                var id_kyw = $(this).find("td").eq(5).html();

                $('#id_userId').val(userId);
                $('#id_userName').val(userName);
                $('#id_karyawan').val(id_kyw);
                $('#id_kataKunci').val(passwd);
                $('#id_confKataKunci').val(passwd);
                $('#id_groupUser').val(userGroup);
                //$('#').val();
                $('#id_userName').focus();

            });

            tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
        }

        return {
            //main function to initiate the module
            init: function () {
                if (!jQuery().dataTable) {
                    return;
                }
                initTable1();
            }
        };
    }();
    jQuery(document).ready(function () {
        TableManaged.init();
    });
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
        var passwd = $('#id_kataKunci').val();
        var confPasswd = $('#id_confKataKunci').val();
        if (passwd == confPasswd) {
            return true;
        } else {
            alert("Password dan konfirmasi password tidak sama.");
            $("#id_password").focus();
            return false;
        }
    });

    $('#id_btnBatal').click(function () {
        btnStart();
    });

    $("#id_btnSimpan").click(function () {
        $('#idTmpAksiBtn').val('1');
        bootbox.confirm("Apakah anda yakin menyimpan data ini?", function (o) {
            if (o == true) {
                $('#idFormUser').submit();
            }
        });

    });

</script>


<!-- END JAVASCRIPTS -->