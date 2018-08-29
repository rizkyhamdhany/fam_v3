<script>
    var dataTable;
    var iStatus = '%';
    var iSearch = 'ReqTypeName';

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
                        <option value="ReqTypeName">Request Type</option>\n\
                        <option value="ReqCategoryName">Request Category</option>\n\
                        <option value="RktName">Project</option>\n\
                        <option value="BranchName">From</option>\n\
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
                url: "<?php echo base_url("/procurement/termofpayment/ajax_GridBudgetCapex"); ?>", // json datasource
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
//                {"targets": [9], "visible": false, "searchable": false},
//                {"targets": [10], "visible": false, "searchable": false},
//                {"targets": [11], "visible": false, "searchable": false},
            ],
        });
    }

    function fom_modal(id, pengenal) {
        var iUrl;
        if (pengenal == "upd") {
            iUrl = "<?php echo base_url("/procurement/termofpayment/payment_termin"); ?>?iid=" + id;
        } else {
            iUrl = "<?php echo base_url("/procurement/termofpayment/set_termin"); ?>?iid=" + id;
        }
        $.ajax({
            url: iUrl, // json datasource
            dataType: "HTML", // what to expect back from the PHP script, if anything
            type: 'post',
            cache: false,
            success: function (e) {
                $("#bodyMyTermin").html(e);
            }
        });
    }

    $("form#datasave").submit(function (event) {
        event.preventDefault();
        var url;
        var r = confirm("Are You Sure, You Want to Process Set Termin!");
        if (r == true) {
            var totalvalue = document.getElementById("TotalPersen").value;
            var pricevendor = document.getElementById("PriceVendor").value;
            var progress1 = document.getElementById("progress1").value;
            if (parseInt(totalvalue) != parseInt(pricevendor) && progress1 != '100') { //totalvalue =0 mengidentifikasikan jika hanya ada satu row dan otomatis bernilai 100 %
                // alert(totalvalue+'-'+pricevendor);
                alert("Prosess Tidak Dapat Dilanjutkan, Belum Memenuhi ketentuan 100%");
            } else {
//                document.getElementById('prosessloading').innerHTML = "<img src='assets/img/prosessload.gif' width='100px' height='100px'>Waiting Process...";
                document.getElementById("simandata").disabled = true;
                var formData = new FormData($(this)[0]);
                var action = document.getElementById("action").value;
                if (action == "update") {
                    // alert('update');
                    url = '<?php echo base_url(); ?>procurement/termofpayment/update_termin';
                    // location.reload();
                } else {
                    // alert('insert');
                    url = '<?php echo base_url(); ?>procurement/termofpayment/prosess_termin';
                    // location.reload();
                }
//                console.log(url);
                $.ajax({
                    url: url, // json datasource
                    type: 'POST',
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (e) {
                        $('#table_gridBudgetCapex').DataTable().ajax.reload();
                        $('#btn_close').trigger('click');
                    }
                });

            }
        } else {
            alert("Cancel process");
        }
//        $("#simandata").attr("disabled", "disabled").html("Loading...")
    });
    function ondatepacker(row_d) {
        for (i = 1; i < row_d + 1; i++) {
            if (i == 1) {
                var dt = "'3d'";
            } else {
                if (i == 1) {
                    var nomor = i;
                } else {
                    var nomor = i - 1;
                }

                var strdate = document.getElementById("DatePayment" + nomor).value;
                var dt = strdate;
            }
            $("#DatePayment" + i).datepicker({
                format: 'yyyy-mm-dd',
                startDate: '3d'
                        //endDate: '2016-12-31'
            });
        }
    }
    function addupd(id) {
        $('#sorter').append(objekupd);
    }
    function objekupd() {
        var jmlrw = document.getElementById("totalrowtambah").value;
        var totpersen = document.getElementById("TotalPersen").value;
        var PriceVendor = document.getElementById("PriceVendor").value;
        //alert(PriceVendor);
        if (parseInt(PriceVendor) <= parseInt(totpersen)) {
            alert("Termin Sudah Set Max 100 %");
        } else {
            pos = $('.objek').length + parseInt(jmlrw);
            pos2 = $('.objek').length;
            //alert(pos);
            document.getElementById("totalrow").value = pos;
            if (pos > parseInt(jmlrw)) {
                //alert(pos);

                var dt = document.getElementById("DatePayment" + pos2).value;
                if (dt == "") {
                    alert("Untuk Menambahkan Termim Kembali. Silahkan Set Work Progress&DatePayment terlebih dahulu");
                } else {
                    //document.getElementById("totitem").value = pos;
                    html = '<tr id="row_' + pos + '" class="objek">'
                            + '<td width="5px"><select class="form-control" id="progress' + pos + '" name="progress' + pos + '" onchange="onWorkPayment_upd(' + pos + ',2)"> <option selected="" disabled="" value="">-Select-</option><option value="10">10%</option><option value="20">20%</option><option value="30">30%</option><option value="40">40%</option><option value="50">50%</option><option value="60">60%</option><option value="70">70%</option><option value="80">80%</option><option value="90">90%</option><option value="100">100%</option></select></td>'
                            + '<td><div id="divpayment' + pos + '"></div><input type="hidden" class="form-control" id="payment' + pos + '" name="payment' + pos + '" size="10" required /><input type="hidden" class="form-control" id="terminID' + pos + '" name="terminID' + pos + '" size="10" value="' + pos + '" required /></td>'
                            + '<td><input type="text" class="form-control" id="DatePayment' + pos + '" name="DatePayment' + pos + '" ize="10" placeholder="YYYY-mm-dd" required /></td>'
                            + '<td><a onclick="deleterow(' + pos + ')"><div id="delete' + pos + '"><i class="fa fa-times"></i></a> <input type="hidden" class="form-control" id="tot" name="tot" value="' + pos + '" /></div></td>'
                            + '</tr>';
                    return html;
                    $("#tot").removeAttr('disabled');

                }
            } else {
                html = '<tr id="row_' + pos + '" class="objek">'
                        + '<td width="5px"><select class="form-control" id="progress' + pos + '" name="progress' + pos + '" onchange="onWorkPayment_upd(' + pos + ',2)"> <option selected="" disabled="" value="">-Select-</option><option value="10">10%</option><option value="20">20%</option><option value="30">30%</option><option value="40">40%</option><option value="50">50%</option><option value="60">60%</option><option value="70">70%</option><option value="80">80%</option><option value="90">90%</option><option value="100">100%</option></select></td>'
                        + '<td><div id="divpayment' + pos + '"></div><input type="hidden" class="form-control" id="payment' + pos + '" name="payment' + pos + '" size="10" required /><input type="hidden" class="form-control" id="terminID' + pos + '" name="terminID' + pos + '" size="10" value="' + pos + '" required /></td>'
                        + '<td><input type="text" class="form-control" id="DatePayment' + pos + '" name="DatePayment' + pos + '" ize="10" placeholder="YYYY-mm-dd" required /></td>'
                        + '<td><a onclick="deleterow(' + pos + ')"><div id="delete' + pos + '"><i class="fa fa-times"></i></a> <input type="hidden" class="form-control" id="tot" name="tot" value="' + pos + '" /></div></td>'
                        + '</tr>';
                return html;
                $("#tot").removeAttr('disabled');
                alert(document.getElementById("DatePayment" + pos).value);
            }
        }

    }
    function onWorkPayment_upd(row_d, pengenal) {
        //alet(row_d);
        var PriceVendor = document.getElementById("PriceVendor").value;
        var myTotal = 0;
        if (pengenal === 1) {
            document.getElementById("val" + row_d).style.display = "none";
        }
        var Workprogress = document.getElementById("progress" + row_d).value;
        var TOt = PriceVendor * Workprogress / 100;
        for (i = 1; i < row_d + 1; i++) {
            if (i == 1) {
                var dt = "'3d'";
            } else {
                if (i == 1) {
                    var nomor = i;
                } else {
                    var nomor = i - 1;
                }

                var strdate = document.getElementById("DatePayment" + nomor).value;
                var dt = strdate;

                //document.getElementById("Delete"+nomor).value;
            }
            $("#DatePayment" + i).datepicker({
                format: 'yyyy-mm-dd',
                startDate: dt
                        //endDate: '2016-12-31'
            });
            var Wp = document.getElementById("progress" + i).value;
            var Tok = PriceVendor * Wp / 100;
            myTotal += Tok;
        }

        //document.getElementById("TotalPersen").value=myTotal;
        document.getElementById("divpayment" + row_d).innerHTML = 'Rp: ' + convertToRupiah(TOt);
        document.getElementById("payment" + row_d).value = TOt;
        if (parseInt(myTotal) > parseInt(PriceVendor)) {
            alert("Set Work Progress Melebihi Ketentuan 100%");
            document.getElementById("progress" + row_d).selectedIndex = 0;
            document.getElementById("divpayment" + row_d).innerHTML = '';
        } else {
            // document.getElementById("TotalPersen").value=myTotal;
            var vk = parseInt(document.getElementById("totalrow").value);
            var pr = 0;
            var vayment = 0;
            for (p = 1; p < vk + 1; p++) {
                var jmlit = document.getElementById("progress" + p).value;
                pr += parseInt(jmlit);
                var nilai = document.getElementById("payment" + p).value;
                vayment += parseInt(nilai);
            }
            document.getElementById("TotalPersen").value = vayment;
            if (pr > 100) {
                alert("Set Work Progress Melebihi Ketentuan 100%");
                if (row_d == 1) {
                    //document.getElementById("10").selected = "true";
                    document.getElementById("progress" + row_d).selectedIndex = 1;
                    var prg = document.getElementById("progress" + row_d).value

                    var rp = document.getElementById("payment" + row_d).value;
                    var hitung = PriceVendor * prg / 100;
                    //alert(hitung);
                    //myTotalreload = hitung; 
                    document.getElementById("payment" + row_d).value = hitung;
                    document.getElementById("divpayment" + row_d).innerHTML = 'Rp: ' + convertToRupiah(hitung);
                } else {
                    document.getElementById("progress" + row_d).selectedIndex = 0;
                    document.getElementById("divpayment" + row_d).innerHTML = '';
                }

            }

        }
        // alert(tot_persen);
    }

    function convertToRupiah(angka) {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0)
                rupiah += angkarev.substr(i, 3) + '.';
        return rupiah.split('', rupiah.length - 1).reverse().join('');
    }

    function deleterow(id) {
        $('#row_' + id).fadeOut("medium", function () {
            $(this).remove();
//            sort();

        });
        var nilai = document.getElementById("payment" + id).value;
        var totpersen = document.getElementById("TotalPersen").value;
        var hasil = totpersen - nilai;
        //alert(hasil);
        document.getElementById("TotalPersen").value = hasil;
    }






    function ddBranch(a, b) {
        $.ajax({
            url: "<?php echo base_url("/procurement/termofpayment/ddBranch"); ?>", // json datasource
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
            url: "<?php echo base_url("/procurement/termofpayment/ddDivisi"); ?>", // json datasource
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
            url: "<?php echo base_url("/procurement/termofpayment/ajax_Delete"); ?>", // json datasource
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
            url: "<?php echo base_url("/procurement/termofpayment/ajax_Update"); ?>", // json datasource
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