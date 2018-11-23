<script>
    var dataTable;
    var iSampai = '';
    var iMulai = '';
    var iSearch = 'ID_PO';

    jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        // loadGridBudgetCapex();
        // loadGridSetting();
        loadTableFPUR();
        loadTableFPUM();
    });
    // jQuery(document).ready(function () {
    //     TableManaged.init();
    // });
    btnStart();

    function ddMulai(e) {
        iMulai = e;
    }
    function ddSampai(e) {
        iSampai = e;
    }

    function onLihat() {
        $('#table_gridBudget').DataTable().ajax.reload();
    }
    $('.date-picker').datepicker({
        orientation: "left",
        format: "dd/mm/yyyy",
        autoclose: true
    });


    function loadGridBudgetCapex() {
        dataTable = $('#table_gridBudget').DataTable({
            dom: 'C<"clear">l<"toolbar">frtip',
            "lengthMenu": [
                [10, 20, 30, 40, 50, -1],
                [10, 20, 30, 40, 50, "All"] // change per page values here
            ],
//                // set the initial value
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/procurement/ias/ajax_GridBudgetCapex"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sSearch = iSearch;
                    z.sMulai = iMulai;
                    z.sSampai = iSampai;
                },
                error: function () {  // error handling
                    $(".table_gridBudget-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_gridBudget tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_gridBudget_processing").css("display", "none");

                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
                // {"targets": [1], "visible": false, "searchable": false},
                // {"targets": [2], "visible": false, "searchable": false},
                // {"targets": [3], "visible": false, "searchable": false},
            ],
        });
    }

    $("form#datasave").submit(function (event) {
        // event.preventDefault();
        var formData = new FormData($(this)[0]);
        $("#simandata").attr("disabled", "disabled").html("Loading...")
        $.ajax({
            url: "<?php echo base_url("/procurement/budget/readExcel"); ?>", // json datasource
            type: 'POST',
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (e) {
                $('#table_gridBudget').DataTable().ajax.reload();
                $('#closeupload').trigger('click');
            },
            complete: function () {
                $("#simandata").removeAttr("disabled", "disabled").html("Save")
            }
        });
        return false;
    });

    function ddBranch(a, b) {
        $.ajax({
            url: "<?php echo base_url("/procurement/ias/ddBranch"); ?>", // json datasource
            dataType: "JSON", // what to expect back from the PHP script, if anything
            type: 'post',
            cache: false,
            success: function (e) {
                $("#ddBranch").empty();
                $("#ddBranch").append(e);
                // console.log(e);
            },
            complete: function (e) {
                $("#dd_id_branch").val(parseInt(a));
                if (parseInt($("#dd_id_branch").val()) == 1) {
                    dd_Divisi(b);
                    $("#displaydivisi").show();
                } else {
                    $("#displaydivisi").hide();
                }

            }
        });
    }
    function dd_Divisi(b) {
        $.ajax({
            url: "<?php echo base_url("/procurement/ias/ddDivisi"); ?>", // json datasource
            dataType: "JSON", // what to expect back from the PHP script, if anything
            type: 'post',
            cache: false,
            data: {sBranchID: $("#dd_id_branch").val()},
            success: function (e) {
                if ($("#dd_id_branch").val() == 1) {
                    $("#displaydivisi").show();
                    $("#ddDivisi").empty();
                    $("#ddDivisi").append(e);
                } else {
                    $("#displaydivisi").hide();
                }
                // console.log(e);
            },
            complete: function (e) {
                if (b != "dd_id_branch") {
                    $("#dd_id_divisi").val(parseInt(b));
                }
            }
        });
    }


    function search(e) {
        iSearch = e;
    }

    $('#table_gridBudget').on('click', '#btnDelete', function () {
        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();

        $.ajax({
            type: "POST",
            cache: false,
            dataType: "JSON",
            url: "<?php echo base_url("/procurement/budget/ajax_Delete"); ?>", // json datasource
            data: {sbudgetID: idata[1]},
            success: function (e) {
                // console.log(e);
                if (e.istatus == true) {
                    alert(e.iremarks);
                    $('#table_gridBudget').DataTable().ajax.reload();
                } else {
                    alert(e.msgTitle);
                }
            }
        });
    });

    function clickUpdate() {
//        console.log("s");
        var form_data = new FormData();
        form_data.append('BudgetID', $("#BudgetID").val());
        form_data.append('BudgetCOA', $("#BudgetCOA").val());
        form_data.append('branch', $("#dd_id_branch").val());
        form_data.append('divisi', $("#dd_id_divisi").val());
        form_data.append('BudgetValue', $("#BudgetValue").val());
        form_data.append('period', $("#period").val());
        console.log(form_data);
        $.ajax({
            url: "<?php echo base_url("/procurement/budget/ajax_Update"); ?>", // json datasource
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            data: form_data,
            success: function (e) {
                console.log(e);
                if (e.istatus == true) {
                    alert(e.iremarks);
                    $('#mdl_Update').modal('hide');
                    $('#table_gridBudget').DataTable().ajax.reload();
                } else {
                    alert(e.iremarks);
                }
            }
        });

    }

    $('#table_gridBudget').on('click', '#btnUpdate', function () {
        $('#mdl_Update').find('.modal-title').text('Update');

        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();
//        console.log(idata);
        ddBranch(idata[2], idata[3]);

        $("#BudgetCOA").val(idata[4]);
        $("#BudgetValue").val(idata[8]);
        $("#period").val(idata[5].trim());
        $("#BudgetID").val(idata[1]);
        document.getElementById("BudgetCOA").readOnly = true;
        $(".btnSC").show();
        $(".btnSC .save").hide();
        $(".btnSC .update").show();
        $(".btnSC .close_").show();
        $(".status").hide();

    });

    $('#table_gridBudget').on('click', '#btnTransfer', function () {
        $('#mdl_Transfer').find('.modal-title').text('TRANSFER BUDGET');

        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();
        console.log('tes',idata);
        dd_BranchTF(idata[3].trim());

        $("#id_tf_nama").val($("#id_userName").val());
        $("#id_tf_posisi").val($("#id_posisi").val());
        $("#dd_tf_asal").select2('val', idata[3].trim());
//        document.getElementById("id_tf_nama").disabled = true;
//        document.getElementById("id_tf_posisi").disabled = true;
//        document.getElementById("dd_tf_asal").disabled = true;

    });

    function dd_BranchTF(a) {
//        console.log(a);
        $.ajax({
            url: "<?php echo base_url("/procurement/budget/ddBranchTF"); ?>", // json datasource
            dataType: "JSON", // what to expect back from the PHP script, if anything
            type: 'post',
            cache: false,
            data: {sDivAsal: a},
            success: function (e) {
                $("#DD_divTujuan").empty();
                $("#DD_divTujuan").append(e);
                // console.log(e);
            },
            complete: function (e) {
//                $("#dd_id_branch").val(parseInt(a));
//                if (parseInt($("#dd_id_branch").val()) == 1) {
//                    dd_Divisi(b);
//                    $("#displaydivisi").show();
//                } else {
//                    $("#displaydivisi").hide();
//                }

            }
        });
    }


    $("form#idTransfer").submit(function (event) {
        event.preventDefault();
//        $("#simandata").attr("disabled", "disabled").html("Loading...")
        $.ajax({
            url: "<?php echo base_url("/procurement/budget/ajax_Transfer"); ?>", // json datasource
            type: 'POST',
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (e) {
                console.log(e);
                if (e.istatus) {
                    $('#table_gridBudget').DataTable().ajax.reload();
                    UIToastr.init(e.type, e.iremarks);
                    $('.close_tf').trigger('click');
                }
            },
            complete: function () {
//                $("#simandata").removeAttr("disabled", "disabled").html("Save")
            }
        });
//        return false;
    });


    function loadTableFPUR() {
        dataTable_set = $('#table_fpur').DataTable({
            "lengthMenu": [
                [10, 15, 20, -1],
                [10, 15, 20, "All"]
            ],
            "scrollX": true,
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/procurement/fpur/ajax_table_fpur"); ?>", // json datasource
                type: "post",
                error: function () {  // error handling
                    $(".table_gridSetting-error").html("");
                    $('#table_gridSetting tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_gridSetting_processing").css("display", "none");

                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
            ],
        });
    }

    function loadTableFPUM() {
        dataTable_set = $('#table_fpum').DataTable({
            "lengthMenu": [
                [10, 15, 20, -1],
                [10, 15, 20, "All"]
            ],
            "scrollX": true,
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/procurement/fpur/ajax_table_fpum"); ?>", // json datasource
                type: "post",
                error: function () {  // error handling
                    $(".table_gridSetting-error").html("");
                    $('#table_gridSetting tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_gridSetting_processing").css("display", "none");

                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
            ],
        });
    }

    $('#id_st_Tahun').datepicker({
        orientation: "left",
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        autoclose: true
    });

    $("form#idSetting").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url("/procurement/budget/ajax_insert_setBudget"); ?>", // json datasource
            type: 'POST',
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (e) {
                if (e.istatus) {
                    $('#table_gridSetting').DataTable().ajax.reload();
                    UIToastr.init(e.type, e.iremarks);
                    $('.close_st').trigger('click');
                }
            },
            complete: function () {
            }
        });
//        return false;
    });

    function onDelete(a) {
        $.ajax({
            url: "<?php echo base_url("/procurement/budget/ajax_setDelete"); ?>", // json datasource
            dataType: "JSON", // what to expect back from the PHP script, if anything
            type: 'post',
            cache: false,
            data: {sID: a},
            success: function (e) {
                if (e.istatus) {
                    $('#table_gridSetting').DataTable().ajax.reload();
                    UIToastr.init(e.type, e.iremarks);
                }
            }
        });
    }

    function onDetail(a, b) {
        $.ajax({
            url: "<?php echo base_url("/procurement/budget/ajax_setBudget"); ?>", // json datasource
            dataType: "JSON", // what to expect back from the PHP script, if anything
            type: 'post',
            cache: false,
            data: {sID: a, sParam: b},
            success: function (e) {
                if (e.istatus) {
                    $('#table_gridSetting').DataTable().ajax.reload();
                    UIToastr.init(e.type, e.iremarks);
                }
            }
        });
    }

    function edit_sn(idpo, idtb)
    {
        $('#table_sn tbody').empty();
        $.ajax({
            url : "<?php echo base_url('procurement/ias/get_sn/')?>/" + idpo + "/" +idtb,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                for(var i = 0; i < data.length; i++){
                    $('#table_sn tbody').append('<tr><td>'+data[i].ID_PO+'</td><td>'+data[i].ID_TB+'</td><td>'+data[i].ITEM_ID+'</td><td>'+data[i].QTY+'</td><td>'+data[i].SN+'</td></tr>');
                }

                $('#table_sn').dataTable();

                $('#myModal').modal('show'); // show bootstrap modal when complete loaded
     
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

</script>