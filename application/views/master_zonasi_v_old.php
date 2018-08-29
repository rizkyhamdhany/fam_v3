<!--BEGIN PAGE BREADCRUMB -->
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
                            Data Master Zonasi </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Form Data Master Zonasi</a>
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
                                                    NO
                                                </th>
                                                <th>
                                                    Nama Zonasi   
                                                </th>
                                                <th>
                                                    Action   
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
                              action="<?php echo base_url('master_zonasi/home'); ?>" id="idFormUser">    

                            <div class="form-body">
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">NO</label>
                                    <div class="col-md-9">
                                        <input id="id_ZoneID" class="form-control" type="text" name="ZoneID" readonly="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Nama Zonasi
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <input required id="id_ZoneName"  name="ZoneName" data-required="1" class="form-control" type="text"> 
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                            <i class="fa fa-check"></i> Simpan
                                        </button>
                                        <button name="btnUbah" class="btn green" id="id_btnUbah">
                                            <i class="fa fa-edit-o"></i> Ubah
                                        </button>
                                        <button name="btnHapus" class="btn red" id="id_btnHapus">
                                            <i class="fa fa-trash-o"></i> Hapus
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
   jQuery(document).ready(function () {
        var dataTable = $('#idTabelUser').DataTable({
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
//                // set the initial value
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/master_zonasi/get_server_side"); ?>", // json datasource
                type: "post", // method  , by default get
                error: function () {  // error handling
                    $(".idTabelUser-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#idTabelUser tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#idTabelUser_processing").css("display", "none");

                }
            }
        });
    dataTable.on('click', 'tbody tr', function () {
                $("#navitab_2_2").trigger('click');
                var ZoneID = $(this).find("td").eq(0).html();
                var ZoneName = $(this).find("td").eq(1).html();
             
                // alert(passwd);

                $('#id_ZoneID').val(ZoneID);
                $('#id_ZoneName').val(ZoneName);
                $('#id_btnSimpan').attr('disabled', true);
                $('#id_btnUbah').attr('disabled', false);
                $('#id_btnHapus').attr('disabled', false);


            });


    });


    // var TableManaged = function () {

    //     var initTable1 = function () {
    //         var table = $('#idTabelUser');
    //         // begin first table
    //         table.dataTable({
    //             "ajax": "<?php echo base_url("parameter/parameter_propinsi/getUserInfo"); ?>",
    //             "columns": [
    //                 {"data": "kodepropinsi"},
    //                 {"data": "namapropinsi"}

    //             ],
    //             // Internationalisation. For more info refer to http://datatables.net/manual/i18n
    //             "language": {
    //                 "aria": {
    //                     "sortAscending": ": activate to sort column ascending",
    //                     "sortDescending": ": activate to sort column descending"
    //                 },
    //                 "emptyTable": "No data available in table",
    //                 "info": "Showing _START_ to _END_ of _TOTAL_ entries",
    //                 "infoEmpty": "No entries found",
    //                 "infoFiltered": "(filtered1 from _MAX_ total entries)",
    //                 "lengthMenu": "Show _MENU_ entries",
    //                 "search": "Search:",
    //                 "zeroRecords": "No matching records found"
    //             },
    //             "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.


    //             "lengthMenu": [
    //                 [5, 10, 15, 20, -1],
    //                 [5, 10, 15, 20, "All"] // change per page values here
    //             ],
    //             // set the initial value
    //             "pageLength": 5,
    //             "pagingType": "bootstrap_full_number",
    //             "language": {
    //                 "search": "Cari: ",
    //                 "lengthMenu": "  _MENU_ records",
    //                 "paginate": {
    //                     "previous": "Prev",
    //                     "next": "Next",
    //                     "last": "Last",
    //                     "first": "First"
    //                 }
    //             },
    //             "aaSorting": [[0, 'asc']/*, [5,'desc']*/],
    //             "columnDefs": [{// set default column settings
    //                     'orderable': true,
    //                     "searchable": true,
    //                     'targets': [0]
    //                 }],
    //             "order": [
    //                 [0, "asc"]
    //             ] // set first column as a default sort by asc
    //         });
    //         $('#id_Reload').click(function () {
    //             table.api().ajax.reload();
    //         });

    //         var tableWrapper = jQuery('#example_wrapper');

    //         table.find('.group-checkable').change(function () {
    //             var set = jQuery(this).attr("data-set");
    //             var checked = jQuery(this).is(":checked");
    //             jQuery(set).each(function () {
    //                 if (checked) {
    //                     $(this).attr("checked", true);
    //                     $(this).parents('tr').addClass("active");
    //                 } else {
    //                     $(this).attr("checked", false);
    //                     $(this).parents('tr').removeClass("active");
    //                 }
    //             });
    //             jQuery.uniform.update(set);
    //         });

    //         table.on('change', 'tbody tr .checkboxes', function () {
    //             $(this).parents('tr').toggleClass("active");
    //         });
    //         table.on('click', 'tbody tr', function () {
    //             $("#navitab_2_2").trigger('click');
    //             var kodepropinsi = $(this).find("td").eq(0).html();
    //             var namapropinsi = $(this).find("td").eq(1).html();
    //             $('#id_btnSimpan').attr('disabled', true);
    //             $('#id_btnUbah').attr('disabled', false);
    //             $('#id_btnHapus').attr('disabled', false);
    //             // alert(passwd);

    //             $('#id_kodepropinsi').val(kodepropinsi);
    //             $('#id_namapropinsi').val(namapropinsi);


    //         });

    //         tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
    //     }

    //     return {
    //         //main function to initiate the module
    //         init: function () {
    //             if (!jQuery().dataTable) {
    //                 return;
    //             }
    //             initTable1();
    //         }
    //     };
    // }();
    // jQuery(document).ready(function () {
    //     TableManaged.init();
    // });
    btnStart();
    $("#id_namakyw").focus();
    $("#id_btnSimpan").click(function () {
        $('#idTmpAksiBtn').val('1');
    });

    $('#id_btnBatal').click(function () {
        btnStart();
    });

    $("#id_btnSimpan").click(function () {
        $('#idTmpAksiBtn').val('1');
        var o = confirm("Apakah anda yakin menyimpan data ini?");
        if (o == true) {
            $('#idFormUser').submit();
        }
    });
    $("#id_btnUbah").click(function () {
        $('#idTmpAksiBtn').val('2');
        var o = confirm("Apakah anda yakin mengubah data ini?");
        if (o == true) {
            $('#idFormUser').submit();
        }
    });
    $("#id_btnHapus").click(function () {
        $('#idTmpAksiBtn').val('3');
        var o = confirm("Apakah anda yakin menghapus data ini?");
        if (o == true) {
            $('#idFormUser').submit();
        }

    });

</script>


<!-- END JAVASCRIPTS