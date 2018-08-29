<script>
    var dataTable, dataTableItmPr;
    var iStatus = '%';
    var iSearch = 'BudgetCOA';
    var selected = [];
    var iItemIDDelete = "";
    var iItemID = "";
    jQuery(document).ready(function () {
        loadGridOutRequest();
    });
    // jQuery(document).ready(function () {
    //     TableManaged.init();
    // });
    btnStart();
//===== form request =====
    function onDDCategory() {
        var RequestID = document.getElementById('ReqTypeID').value;
        if (RequestID == 3) {
            $(".period_area").show();
            $("#tempo_sewa").hide();
        } else {
            var pr = document.getElementById('priod');
            if (pr != '') {
                document.getElementById('priod').value = '0';
            } else {
                document.getElementById('priod').value = '0';
            }
            $(".period_area").hide();
        }
        $('#load_reqcategory').fadeIn('slow');
        $.ajax({
            url: "<?php echo base_url("/procurement/purchase_request/dd_selreqcategory"); ?>", // json datasource
            type: "POST",
            cache: false,
            dataType: "html",
            data: {sRequestID: RequestID},
            success: function (jawaban) {
                $('#load_reqcategory').html(jawaban);
            },
        });
    }

    function onDDRkt() {
        var iReqCategoryID = document.getElementById('ReqCategoryID').value;

        $('#load_Rkt').fadeIn('slow');
        $.ajax({
            url: "<?php echo base_url("/procurement/purchase_request/dd_Rkt"); ?>", // json datasource
            type: "POST",
            cache: false,
            dataType: "html",
            data: {sReqCategoryID: iReqCategoryID},
            success: function (jawaban) {
                $('#load_Rkt').html(jawaban);
            },
        });
    }

    function itemList() {
        $('#mdl_Add').modal({show: true});
        dataTableItmPr.destroy();
//        console.log(dataTable);
//    for (var index = 1; index < dataTable[0].rows.length; index++)
//    {
//        var row = dataTable[0].rows[index];
//        var phaCheckbox = $(row.cells[11]).find('input');
//        var profilerCheckbox = $(row.cells[12]).find('input');
// 
//        if (!phaCheckbox.is(':checked') || !profilerCheckbox.is(':checked'))
//        {
//            $(row.cells[0]).removeClass('select-checkbox');
//        }
//    }
    }
    function loadGridItemList() {
        console.log($("#ReqCategoryID").val());
        var iReqTypeID = document.getElementById('ReqTypeID').value;
        if (iReqTypeID == 2) {
            onDDRkt();
            $("#load_Rkt").show();
        } else {
            onDDRkt();
            $("#load_Rkt").hide();
        }
        $('#mdl_Add').modal({show: true});
        dataTable = $('#table_gridItemList').DataTable({
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            retrieve: true,
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/procurement/purchase_request/ajax_GridPopupItemList"); ?>",
                type: "post", // method  , by default get
//                data: function (z) {
//                    z.sSearch = iSearch;
//                },
                error: function () {  // error handling
                    $(".table_gridItemList-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_gridItemList tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_gridItemList_processing").css("display", "none");
                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
                {"targets": [0], "orderable": false},
//                {"targets": [1], "orderable": false},
//                {"targets": [2], "orderable": false},
//                {"targets": [3], "orderable": false},
//                {"targets": [4], "orderable": false},
                {"targets": [5], "checkboxes": {"selectRow": true}},
//                { "targets": 0, "checkboxes":{ "selectRow":true}}
            ],
            "select": {"style": "multi"},
        });
    }

    function processItem() {
        $("#hdrAddBtn").show();
        var rows_selected = dataTable.column(5).checkboxes.selected();
        if (iItemID == "") {
            iItemID = iItemID + rows_selected.join(",");
        } else {
            iItemID = rows_selected.join(",");
        }
//        console.log(iItemID);
        dataTableItmPr = $('#table_gridItemProcess').DataTable({
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            retrieve: true,
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/procurement/purchase_request/ajax_GridProcessItem"); ?>",
                type: "post", // method  , by default get
                data: function (z) {
                    z.sItemID = iItemID;
                    z.sItemIDDelete = iItemIDDelete;
                },
                error: function () {  // error handling
                    $(".table_gridItemProcess-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_gridItemProcess tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_gridItemProcesss_processing").css("display", "none");
                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
                {"targets": [0], "orderable": false},
                {"targets": [1], "orderable": false},
                {"targets": [2], "orderable": false},
                {"targets": [3], "orderable": false},
                {"targets": [4], "orderable": false},
                {"targets": [5], "orderable": false},
                {"targets": [6], "orderable": false},
                {"targets": [7], "orderable": false},
                {"targets": [8], "orderable": false},
//                {"targets": [5], "checkboxes": {"selectRow": true}},
//                { "targets": 0, "checkboxes":{ "selectRow":true}}
            ],
//            "select": {"style": "multi"},
        });

    }

    function totalPrice(a) {
        $("#" + a.name).val(a.value * a.id);
        var ttlLength = $("#table_gridItemProcess_info").text().substring(18, 19);
        var total = 0;
        for (i = 0; i < parseInt(ttlLength); i++) {
            total = total + parseInt($("#price_" + (i + 1)).val());
        }
        $("#myBudgetUsed").text("Rp. " + total);
        $("#BudgetUsed").val(total);
    }

    function deleteItem(e) {
        var arrItemDel = [];
        arrItemDel.push(e.id);
        if (iItemIDDelete == "") {
            iItemIDDelete = arrItemDel.join();
        } else {
            iItemIDDelete = iItemIDDelete + "," + arrItemDel.join();
        }
        console.log(iItemIDDelete);
        $('#table_gridItemProcess').DataTable().ajax.reload();
    }

    $("#fm_datasave").submit(function (e) {  // passing down the event 
        console.log(document.getElementById('Rkt').value);
        e.preventDefault(); // could also use: return false;
        $.ajax({
            url: "<?php echo base_url("/procurement/purchase_request/add_requestproc"); ?>",
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            dataType: "JSON",
            success: function (e) {
                if (e.istatus) {
                    alert(e.iremarks);
                } else {
                    alert(e.iremarks);
                }

            },
            error: function () {
                alert("Fail")
            }
        });
    });






    function onjenisperiode(val) {
        var ket = "Hari";
        if (val == 1) {
            $("#tempo_sewa").hide();
            ket = "Hari";
            //alert('a');

        } else if (val == 2) {
            $("#tempo_sewa").show();
            ket = "Bulan";
            //alert('b');
        } else {
            $("#tempo_sewa").show();
            ket = "Tahun";
            //alert('b');
        }
        document.getElementById("ket1").innerHTML = ket;
        document.getElementById("ket2").innerHTML = "/ " + ket;
        document.getElementById("jangka_waktu").value = 0;
        document.getElementById("priod").value = 0;
    }
    ;
    function angka(e) {
        if (!/^[0-9]+$/.test(e.value)) {
            e.value = e.value.substring(0, e.value.length - 1);
        }
    }

    function cek_sumperiod() {
        var jumlah = parseFloat($('#jangka_waktu').val());
        var priod = parseFloat($('#priod').val());
        var load = (jumlah % priod);
        if (load > 0) {
            alert('Termin tidak sesuai dengan Periode pembayaran! Silahkan atur ulang termin');
            document.getElementById("priod").value = 0;
        }
    }
//===== end form request =====



//===== out request =====

    function search(e) {
        iSearch = e;
    }
    function loadGridOutRequest() {
//         var category = document.getElementById("category").value;
//           var src = document.getElementById("src").value;
        dataTable = $('#table_gridOutRequest').DataTable({
            dom: 'C<"clear">l<"toolbar">frtip',
            initComplete: function () {
                $("div.toolbar").append('<div class="col-md-8">\n\
            <div class="row">\n\
                <div class="col-md-6"></div>\n\
                <div class="col-md-3">Search Param :</div>\n\
                <div class="col-md-3">\n\
                    <select id="cat_itemclass" name="cat_itemclass" onchange="search(this.value)" class="form-control">\n\
                        <option value="BudgetCOA">Coa</option>\n\
                        <option value="ReqTypeName">Request Type</option>\n\
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
            "autoWidth": true,
            "pageLength": 5,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/procurement/purchase_request/ajax_GridOutRequest"); ?>", // json datasource
                type: "post", // method  , by default get
                data: function (z) {
                    z.sSearch = iSearch;
                },
                error: function () {  // error handling
                    $(".table_gridOutRequest-error").html("");
                    // $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $('#table_gridOutRequest tbody').html('<tbody class="employee-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#table_gridOutRequest_processing").css("display", "none");
                }
            },
            "columnDefs": [
                {"targets": [-1], "orderable": false, "searchable": false},
                {"targets": [0], "orderable": false},
                {"targets": [1], "orderable": false},
                {"targets": [2], "orderable": false},
                {"targets": [3], "orderable": false},
                {"targets": [4], "orderable": false},
                {"targets": [5], "orderable": false},
                {"targets": [6], "orderable": false},
                {"targets": [7], "orderable": false},
                {"targets": [8], "orderable": false},
                {"targets": [9], "orderable": false},
                {"targets": [10], "visible": false, "searchable": false},
            ],
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                if (aData[10] == "1")
                {
                    $('td', nRow).css('background-color', 'Red');
                }
            }
        });
    }


    function detailOR(e) {
//alert(e);
        $.ajax({
            url: "<?php echo base_url("procurement/purchase_request/detil_requestproc"); ?>", // json datasource
            dataType: "html", // what to expect back from the PHP script, if anything
            type: 'post',
            cache: false,
            data: {sId: e},
            success: function (a) {
                document.getElementById("modal-body1").innerHTML = a;
//                $("#ddProject").empty();
//                $("#ddProject").append(e);
                // console.log(e);
            }
        });
    }

    function set_req(req) {
        document.getElementById('req').value = req;

    }

    $("form#deletepr").submit(function (event) {
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "<?php echo base_url("procurement/purchase_request/delete_requestproc2"); ?>", // json datasource
            type: 'POST',
            data: new FormData(this),
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (e) {
                if (e.istatus == true) {
                    alert(e.iremarks);
                    $('#table_gridOutRequest').DataTable().ajax.reload();
                }
            }
        });
    });

    function set_reqid(val) {
        setTimeout(function () {
            $('#requestid').val(val);
            var boolean = $('#requestid').val();
            if (boolean == '') {

                document.getElementById("submit_upload").disabled = true;
            } else {

                document.getElementById("submit_upload").disabled = false;
            }
        }, 500);

    }
    $("form#uploadpr").submit(function (event) {
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "<?php echo base_url("procurement/purchase_request/upload_requestproc"); ?>", // json datasource
            type: 'POST',
            data: new FormData(this),
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (e) {
                console.log(e);
                if (e.istatus == true) {
                    alert(e.iremarks);
                    $("#btnCloseUpload").trigger("click");
                    $('#table_gridOutRequest').DataTable().ajax.reload();
                }
            }
        });
        return false;
    });



//===== end out request =====

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
                $('#table_gridOutRequest').DataTable().ajax.reload();
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



    $('#table_gridOutRequest').on('click', '#btnDelete', function () {
        var iclosestRow = $(this).closest('tr');
        var idata = dataTable.row(iclosestRow).data();
        $.ajax({
            url: "<?php echo base_url("/procurement/budget_capex/ajax_Delete"); ?>", // json datasource
            type: "POST",
            cache: false,
            dataType: "JSON",
            data: {sbudgetID: idata[9]},
            success: function (e) {
                // console.log(e);
                if (e.istatus == true) {
                    alert(e.iremarks);
                    $('#table_gridOutRequest').DataTable().ajax.reload();
                } else {
                    alert(e.msgTitle);
                }
            }
        });
    });
    function clickUpdate_() {
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
                    $('#table_gridOutRequest').DataTable().ajax.reload();
                } else {
                    alert(e.iremarks);
                }
            }
        });
    }

    $('#table_gridOutRequest').on('click', '#btnUpdate', function () {
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