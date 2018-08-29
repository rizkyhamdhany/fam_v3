<script>
    var dataTable;
    var iStatus = '%';
    var iSearch = 'BudgetCOA';

    jQuery(document).ready(function () {
        loadGridBudgetCapex();

    });
    // jQuery(document).ready(function () {
    //     TableManaged.init();
    // });
    btnStart();

    function loadGridBudgetCapex() {
        dataTable = $('#table_gridBudgetCapex').DataTable({
            dom: 'C<"clear">l<"toolbar">frtip',
            initComplete: function () {
                $("div.toolbar").append('<div class="col-md-8">\n\
            <div class="row">\n\
                <div class="col-md-6"></div>\n\
                <div class="col-md-3 text-right">Search Param</div>\n\
                <div class="col-md-3">\n\
                    <select id="cat_itemclass" name="cat_itemclass" onchange="search(this.value)" class="form-control">\n\
                        <option value="BudgetCOA">Coa</option>\n\
                        <option value="BranchName">Branch Name</option>\n\
                        <option value="DivisionName">Division Name</option>\n\
                    </select>\n\
                </div>\n\
            </div>\n\
        </div>');
            },
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
//                // set the initial value
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/procurement/budget_capex/ajax_GridBudgetCapex"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sSearch = iSearch;
                },
                error: function () {  // error handling
                    $(".table_gridBudgetCapex-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_gridBudgetCapex tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_gridBudgetCapex_processing").css("display", "none");

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
//                {"targets": [6], "orderable": false},
//                {"targets": [7], "orderable": false},
//                {"targets": [8], "orderable": false},
                {"targets": [9], "visible": false, "searchable": false},
                {"targets": [10], "visible": false, "searchable": false},
                {"targets": [11], "visible": false, "searchable": false},
            ],
        });
    }

    $("form#datasave").submit(function (event) {
        // event.preventDefault();
        var formData = new FormData($(this)[0]);
        $("#simandata").attr("disabled", "disabled").html("Loading...")
        $.ajax({
            url: "<?php echo base_url("/procurement/budget_capex/readExcel"); ?>", // json datasource
            type: 'POST',
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (e) {
                $('#table_gridBudgetCapex').DataTable().ajax.reload();
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
            url: "<?php echo base_url("/procurement/budget_capex/ddBranch"); ?>", // json datasource
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
            url: "<?php echo base_url("/procurement/budget_capex/ddDivisi"); ?>", // json datasource
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

    $('#table_gridBudgetCapex').on('click', '#btnDelete', function () {
        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();

        $.ajax({
            type: "POST",
            cache: false,
            dataType: "JSON",
            url: "<?php echo base_url("/procurement/budget_capex/ajax_Delete"); ?>", // json datasource
            data: {sbudgetID: idata[9]},
            success: function (e) {
                // console.log(e);
                if (e.istatus == true) {
                    alert(e.iremarks);
                    $('#table_gridBudgetCapex').DataTable().ajax.reload();
                } else {
                    alert(e.msgTitle);
                }
            }
        });
    });

    function clickUpdate() {
        console.log("s");
        var form_data = new FormData();
        form_data.append('BudgetID', $("#BudgetID").val());
        form_data.append('BudgetCOA', $("#BudgetCOA").val());
        form_data.append('branch', $("#dd_id_branch").val());
        form_data.append('divisi', $("#dd_id_divisi").val());
        form_data.append('BudgetValue', $("#BudgetValue").val());
        form_data.append('period', $("#period").val());
        console.log(form_data);
        $.ajax({
            url: "<?php echo base_url("/procurement/budget_capex/ajax_Update"); ?>", // json datasource
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
                    $('#table_gridBudgetCapex').DataTable().ajax.reload();
                } else {
                    alert(e.iremarks);
                }
            }
        });

    }

    $('#table_gridBudgetCapex').on('click', '#btnUpdate', function () {
        $('#mdl_Update').find('.modal-title').text('Update');

        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();
//        console.log(idata);
        ddBranch(idata[10], idata[11]);

        $("#BudgetCOA").val(idata[1]);
        $("#BudgetValue").val(idata[5]);
        $("#period").val(idata[2]);
        $("#BudgetID").val(idata[9]);
        document.getElementById("BudgetCOA").readOnly = true;
        $(".btnSC").show();
        $(".btnSC .save").hide();
        $(".btnSC .update").show();
        $(".btnSC .close_").show();
        $(".status").hide();

    });









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
    $("#id_btnUbah").click(function () {
        $('#idTmpAksiBtn').val('2');
        bootbox.confirm("Apakah anda yakin mengubah data ini?", function (o) {
            if (o == true) {
                $('#idFormUser').submit();
            }
        });

    });

    $("#id_btnHapus").click(function () {
        $('#idTmpAksiBtn').val('3');
        bootbox.confirm("Apakah anda yakin menghapus data ini?", function (o) {
            if (o == true) {
                $('#idFormUser').submit();
            }
        });

    });


</script>