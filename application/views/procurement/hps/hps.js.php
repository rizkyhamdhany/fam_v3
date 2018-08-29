<script>
    var dataTable;
    var iStatus = '%';
    var iSearch = 'ItemName';
    var iZone = 1;

    jQuery(document).ready(function () {
        loadGridHPS();
//        dd_Zone("A");
        $('.date-picker').datepicker({
            orientation: "left",
            autoclose: true
        });

    });
    btnStart();

    function search(e) {
        iSearch = e;
    }

    function loadGridHPS() {
        iZone = $("#dd_id_zone_A").val();
        dataTable = $('#table_gridHPS').DataTable({
            dom: 'C<"clear">l<"toolbar">frtip',
            initComplete: function () {
                $("div.toolbar").append('<div class="col-md-8">\n\
            <div class="row">\n\
                <div class="col-md-1"></div>\n\
                <div class="col-md-2 text-right">Zone Name</div>\n\
                <div class="col-md-3"><div id="ddZone3"></div></div>\n\
                <div class="col-md-3 text-right">Search Param</div>\n\
                <div class="col-md-3">\n\
                    <select id="cat_itemclass" name="cat_itemclass" onchange="search(this.value)" class="form-control">\n\
                        <option value="ItemName">Item Name</option>\n\
                        <option value="ZoneName">Zone</option>\n\
                    </select>\n\
                </div>\n\
            </div>\n\
        </div>');
                dd_Zone("A");
            }, "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
//                // set the initial value
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/procurement/hps/ajax_GridHPS"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sSearch = iSearch;
                    z.sZone = iZone;
                },
                error: function () {  // error handling
                    $(".table_gridHPS-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_gridHPS tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_gridHPS_processing").css("display", "none");

                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
//                {"targets": [0], "orderable": false},
//                {"targets": [1], "orderable": false},
//                {"targets": [2], "orderable": false},
//                {"targets": [3], "orderable": false},
//                {"targets": [4], "orderable": false},
//                {"targets": [5], "orderable": false},
                {"targets": [6], "orderable": false},
                {"targets": [7], "visible": false, "searchable": false},
                {"targets": [8], "visible": false, "searchable": false},
            ],
        });
    }

    $('#table_gridHPS').on('click', '#btnUpdate', function () {
        $('#mdl_Update').find('.modal-title').text('Update');

        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();
        dd_Zone(idata[8]);

        $("#ItemName").val(idata[2]);
        $("#StartDate").val(idata[4]);
        $("#EndDate").val(idata[5]);
        $("#price").val(idata[3]);
        $("#HpsID").val(idata[7]);
    });

    function dd_Zone(a) {
        $.ajax({
            url: "<?php echo base_url("/procurement/hps/ddZone"); ?>?sParam=" + a, // json datasource
            dataType: "JSON", // what to expect back from the PHP script, if anything
            type: 'post',
            cache: false,
//            data: {sBranchID: $("#dd_id_branch").val()},
            success: function (e) {
                if (a == "B") {
                    $("#ddZone2").empty();
                    $("#ddZone2").append(e);
                } else if (a == "A") {
                    $("#ddZone3").empty();
                    $("#ddZone3").append(e);
                } else {
                    $("#ddZone").empty();
                    $("#ddZone").append(e);
                }
            },
            complete: function (e) {
                if (a != "A" || a != "B") {
                    $("#dd_id_zone").val(a);
                }
            }
        });
    }

    function onZone(e) {
        iZone = e.value;
        $('#table_gridHPS').DataTable().ajax.reload();
    }
    $("#fmUpdateHPS").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url("/procurement/hps/update_hps"); ?>?sZone=" + $("#dd_id_zone").val(), // json datasource
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            dataType: "JSON",
            success: function (e) {
                if (e.istatus == true) {
                    alert(e.iremarks);
                    $('#table_gridHPS').DataTable().ajax.reload();
                    $('#btnCloseHPS').trigger('click');
                } else {
                    alert(e.iremarks);
                }
            }
        });
    });

    $('#table_gridHPS').on('click', '#btnDelete', function () {
        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();

        $.ajax({
            type: "POST",
            cache: false,
            dataType: "JSON",
            url: "<?php echo base_url("/procurement/hps/ajax_Delete"); ?>", // json datasource
            data: {sID: idata[7]},
            success: function (e) {
                // console.log(e);
                if (e.istatus == true) {
                    alert(e.iremarks);
                    $('#table_gridHPS').DataTable().ajax.reload();
                } else {
                    alert(e.iremarks);
                }
            }
        });
    });

//    function onUpload() {
//        dd_Zone("");
//    }
    $("#fmsaveUpload").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url("/procurement/hps/readExcel"); ?>?sZone=" + $("#dd_id_zone_B").val(), // json datasource
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            dataType: "JSON",
            success: function (e) {
                if (e == true) {
//                    alert(e.iremarks);
                    $('#table_gridHPS').DataTable().ajax.reload();
                    $('#closeupload').trigger('click');
                }
            }
        });
    });



</script>