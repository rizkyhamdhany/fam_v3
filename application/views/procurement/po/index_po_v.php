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
                    <span class="caption-subject font-red sbold uppercase">PO</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
            <div class="visual">
                <i class="fa fa-comments"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="1449">1449</span>
                </div>
                <div class="desc"> Jumlah PR & PA </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 green" href="#">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="549">549</span>
                </div>
                <div class="desc"> PO Keluar </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 red" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="12,5">123</span> </div>
                <div class="desc"> PO Pending </div>
            </div>
        </a>
    </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if($this->session->flashdata('success')): ?>
                                        <div class="alert alert-success">
                                            <strong>Success!</strong> <?php echo $this->session->flashdata('success');?> 
                                        </div>
                                    <?php endif ?>
                                    <?php if($this->session->flashdata('error')): ?>
                                        <div class="alert alert-danger">
                                            <strong>Error!</strong> <?php echo $this->session->flashdata('error');?> 
                                        </div>
                                    <?php endif ?>
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
                                                    No PR
                                                </th>
                                                <th>
                                                    Tanggal Request
                                                </th>
                                                <th>
                                                    Request Type
                                                </th>
                                                <th>
                                                    Category Name
                                                </th>
                                                <th>
                                                    Name Project
                                                </th>
                                                <th>
                                                    Branch
                                                </th>
                                                <th>
                                                    Divisi
                                                </th>
                                                <th>
                                                    Status Akhir
                                                </th>
                                                <th>
                                                    Catatan
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
    var TableManaged = function () {
        var initTable1 = function () {
            var table = $('#idTabelUserGroup');

            var table2 = $('#idTablePo');

            // begin first table
            table2.dataTable({
                "ajax": "<?php echo base_url("procurement/po/getTableList"); ?>",
                "columns": [
                    {"data": "noPr"},
                    {"data": "tglReq"},
                    {"data": "reqType"},
                    {"data": "catName"},
                    {"data": "projName"},
                    {"data": "branch"},
                    {"data": "divisi"},
                    {"data": "status"},
                    {"data": "catatan"},
                    {data: "jumlah",
                        className: "center",
                        render: function ( data, type, full, meta ) {
                            if (data.Jumlah == 0) {
                                return '<a href="<?php echo base_url('procurement/po/po_form');?>/'+data.RequestID+'" class="btn btn-primary">Edit</a>';
                            }else{
                                return '<a href="<?php echo base_url('procurement/po/po_dokumen');?>/'+data.RequestID+'" class="btn btn-primary">Upload</a>';
                            }
                        }
                    }
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