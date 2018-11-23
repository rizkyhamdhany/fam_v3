<!-- BEGIN PAGE BREADCRUMB --> 

<style type="text/css">
    


    table#table_gridCategory th:nth-child(2){
        display: none;
    } 
    table#table_gridCategory td:nth-child(2){
        display: none;
    }
</style>
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
                    <span class="caption-subject font-red sbold uppercase">Create Tiket HPS</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                        <form method="post" action="<?php echo base_url('procurement/pr/savedata'); ?>">
                            <div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 control-label">Tanggal Request</label>
                                    <div class="col-sm-6">
                                        <input type="text" required="" name="tgl" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 control-label">Jumlah Barang</label>
                                    <div class="col-sm-6">
                                        <input type="number" required="" name="jml" class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 control-label">Divisi</label>
                                    <div class="col-sm-6">
                                        <input type="text" required="" name="divisi" class="form-control input-sm">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 control-label">Spesifikasi</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" name="spek" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <label class="col-sm-6 control-label">Nama Barang</label>
                                    <div class="col-sm-6">
                                        <input type="text" required="" name="nama" class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn blue" type="submit">Kirim</button>
                            </div>
                        </form>
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="id_Reload" style="display: none;"></button>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 2%;">
                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered text_kanan"
                                           id="idTablePo">
                                        <thead>
                                            <tr>                                     
                                                <th>
                                                    Tanggal Request
                                                </th>
                                                <th>
                                                    Divisi Request
                                                </th>
                                                <th>
                                                    Nama Barang
                                                </th>
                                                <th>
                                                    Spesifikasi
                                                </th>
                                                <th>
                                                    Jumlah Barang
                                                </th>
                                                <th>
                                                    Status Tiket
                                                </th>
                                                <th>
                                                    Aksi
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

            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>


<?php $this->load->view('app.min.inc.php'); ?>

<script>
    $(document).on('click', '.date-picker', function(){
       $(this).datepicker({
            orientation: "left",
            format: "dd/mm/yyyy",
            autoclose: true
        }).focus();
       $(this).removeClass('datepicker');
    });
    var TableManaged = function () {
        var initTable1 = function () {
            var table = $('#idTabelUserGroup');

            var table2 = $('#idTablePo');

            // begin first table
            table2.dataTable({
                "ajax": "<?php echo base_url("procurement/pr/getTableList"); ?>",
                "columns": [
                    {"data": "tgl"},
                    {"data": "div"},
                    {"data": "nama"},
                    {"data": "spek"},
                    {"data": "jml"},
                    {"data": "status"},
                    {"data": "aksi"}
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

</script>


<!-- END JAVASCRIPTS