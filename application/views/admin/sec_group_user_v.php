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
                    <i class="fa fa-cogs  font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Group User</span>
                </div>
                <div class="tools">
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <span id="event_result">

                    </span>
                </div>
                <ul class="nav nav-pills">
                    <li class="linav active" id="linav1">
                        <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                            Data usergroup </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Form usergroup</a>
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

                                    <table class="table table-striped table-bordered table-hover text_kanan"
                                           id="idTabelUserGroup">
                                        <thead>
                                            <tr>                                     
                                                <th>
                                                    Kode user group
                                                </th>
                                                <th>
                                                    Nama user group
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
                        <form role="form"  method="post" id="id_from_sec_group_user"  action="<?php echo base_url('sec_group_user/home'); ?>">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Nama user group</label>
                                    <input id="id_id_usergroup" class="form-control hidden"  name="idUsergroup" placeholder=""/>
                                    <input id="id_desc_usergroup" maxlength="240" required="required" class="form-control" type="text" name="descUsergroup" placeholder=""/>
                                    <!-- HIDDEN INPUT -->
                                    <input type="text" id="idTmpAksiBtn" class="hidden">
                                    <!-- END HIDDEN INPUT -->    

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
            </div>
        </div><!-- end <div class="portlet green-meadow box"> -->
    </div><!-- end <div class="col-md-6"> -->

    <div class="col-md-6">

    </div><!-- end <div class="col-md-6"> -->
</div>
<div class="row">
    <div class="col-md-6">

    </div>
</div>

<!-- END PAGE CONTENT-->
<!-- /.modal -->

<!--  END MODAL-->
<?php $this->load->view('app.min.inc.php'); ?>
<script>

    var TableManaged = function () {
        var initTable1 = function () {
            var table = $('#idTabelUserGroup');

            // begin first table
            table.dataTable({
                "ajax": "<?php echo base_url("/admin/sec_group_user/getUserGroupAll"); ?>",
                "columns": [
                    {"data": "usergroupId"},
                    {"data": "usergroupDesc"}
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
                var idUg = $(this).find("td").eq(0).html();
                var descUg = $(this).find("td").eq(1).html();

                $('#id_id_usergroup').val(idUg);
                $('#id_desc_usergroup').val(descUg);

                $("#navitab_2_2").trigger('click');
                //$('#').val();
                $('#id_btnSimpan').attr('disabled', true);
                $('#id_btnUbah').attr("disabled", false);
                $('#id_btnHapus').attr("disabled", false);
                $('#id_namaSpl').focus();

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
    App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
        UIBootbox.init();
        TableManaged.init();
      
        $('#id_desc_usergroup').focus();
        $("#id_btnUbah").attr("disabled", "disabled");
        $("#id_btnHapus").attr("disabled", "disabled");
        
    });
    $('#id_btnBatal').click(function () {
        btnStart();
        resetForm();
        readyToStart();
        tglTransStart();
        $('#id_body_data').empty();
    });
    $("#navitab_2_2").click(function () {
        $('#id_desc_usergroup').focus();
    });
    
    $('#id_from_sec_group_user').submit(function (event) {
        dataString = $("#id_from_sec_group_user").serialize();

        var aksiBtn = $('#idTmpAksiBtn').val();
        if (aksiBtn == '1') {
            bootbox.confirm("Apakah anda yakin menyimpan data ini?", function (o) {
                if (o == true) {
                    ajaxSubmit("admin/sec_group_user/simpan",dataString);
                } 
            });
        } else if (aksiBtn == '2') {
            bootbox.confirm("Apakah anda yakin merubah data ini?", function (o) {
                if (o == true) {
                    ajaxSubmit("admin/sec_group_user/ubah",dataString);
                } 
            });
        } else if (aksiBtn == '3') {
            bootbox.confirm("Apakah anda yakin menghapus data ini?", function (o) {
                if (o == true) {
                    var id = $('#id_id_usergroup').val();
                    id = id.trim();
                    ajaxNonSubmit("admin/sec_group_user/hapus",dataString,id);
                } 
            });
        }
        
        event.preventDefault();
    });



</script>


<!-- END JAVASCRIPTS -->