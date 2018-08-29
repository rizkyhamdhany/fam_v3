<script type="text/javascript">
    //---FUNGSI UNTUK MENAMPILKAN JUMLAH YANG DI CHEK DI LIST POPUP*/
    function mycheck(no) {
        document.getElementById("totitemlist").value = no;
    }

    //---END FUNGSI UNTUK MENAMPILKAN JUMLAH YANG DI CHEK DI LIST POPUP*/
    function onProjectList() {
        var ReqCatID = document.getElementById('ReqCategoryID').value;
        $('#load_Rkt').fadeIn('slow');
        $.ajax({
            //Alamat url harap disesuaikan dengan lokasi script pada komputer anda
            url: 'procurement/requestproc/selrkt/' + ReqCatID,
            type: 'GET',
            //dataType: "json",
            dataType: 'html',
            success: function (jawaban) {
                $('#load_Rkt').html(jawaban);
                $.ajax({
                    url: "<?php echo base_url("/procurement/purchase_request/dd_selreqcategory"); ?>", // json datasource
//                              url      : '<?php echo base_url(); ?>procurement/requestproc/selitem_list',
                    type: 'POST',
                    dataType: 'html',
                    success: function (jawaban) {
                        $('#loaditemlist').html(jawaban);
//                        $.ajax({
//                            url: "<?php echo base_url("/procurement/purchase_request/sesitem_unset"); ?>", // json datasource
                                    url      : '<?php echo base_url(); ?>procurement/requestproc/sesitem_unset',
//                            type: 'GET',
//                            dataType: 'html',
//                            success: function (jawaban) {
//                                $.ajax({
//                                    url: "<?php echo base_url("/procurement/purchase_request/selitem_list"); ?>", // json datasource
                                            url      : '<?php echo base_url(); ?>procurement/requestproc/selitem_list',
//                                    type: 'POST',
//                                    dataType: 'html',
//                                    success: function (jawaban) {
//                                        $('#loaditemlist').html(jawaban);
//                                    },
//                                });
//                            },
//                        });
                    },
                });

                var Budget = ReqCatID.split(">", 1);
                var BranchID = document.getElementById('BranchID').value;
                document.getElementById("Coa_Code").innerHTML = "Budget : " + Budget;
                document.getElementById("budgetCOA").value = Budget;
            },
        });
    }


    //$('#ReqCategoryID').change(function() {
    function onItemList(pengenal) {
    alert("sss")
//document.getElementById("myadd").showModal(); 
        $('#myadd').modal({
            show: true

        });

        $('#modal-add').fadeIn('slow');
        $("#tempo_sewa").hide();
        var ReqTypeID = document.getElementById("ReqTypeID").value;
        var ReqCatID = document.getElementById("ReqCategoryID").value;
        if (ReqTypeID == 2 || ReqTypeID == 5) {
            var rtk = document.getElementById("Rkt").value;
            var zone = rtk;
        } else {
            var zone = "3-<?php echo $this->session->userdata('ZoneID'); ?>";
        }

        $.ajax({
//////            //Alamat url harap disesuaikan dengan lokasi script pada komputer anda
////            url: "<?php echo base_url("/procurement/purchase_request/popupitem_list"); ?>?ReqType=" + ReqTypeID + "&code=" + ReqCatID + "&zone=" + zone,
//            url: 'procurement/requestproc/popupitem_list?ReqType=' + ReqTypeID + '&code=' + ReqCatID + '&zone=' + zone,
            type: 'GET',
            dataType: 'html',
            success: function (jawaban) {
//                  alert('d3');
                $('#modal-add').html(jawaban);z
                $('#search_load').fadeIn('slow');
                $("#tempo_sewa").hide();
                $.ajax({
                    url: "<?php echo base_url("/procurement/purchase_request/pupup_search"); ?>?ReqType=" + ReqTypeID + "&code=" + ReqCatID + "&zone=" + zone,
//                    url: 'procurement/requestproc/pupup_search?ReqType=' + ReqTypeID + '&code=' + ReqCatID + '&zone=' + zone,
                    type: 'GET',
                    dataType: 'html',
                    success: function (jawaban) {
//                            alert('d4');
                        $('#search_load').html(jawaban);
                        $("#tempo_sewa").hide();
                        if (pengenal === 1) {
                            $.ajax({
                                url: "<?php echo base_url("/procurement/purchase_request/sesitem_unset"); ?>",
//                                url: '<?php echo base_url(); ?>procurement/requestproc/sesitem_unset',
                                type: 'GET',
                                dataType: 'html',
                                success: function (jawaban) {
                                    //alert('d5');
                                    $.ajax({
                                        url: "<?php echo base_url("/procurement/purchase_request/selitem_list"); ?>",
//                                        url: '<?php echo base_url(); ?>procurement/requestproc/selitem_list',
//                                        type: 'POST',
                                        dataType: 'html',
                                        success: function (jawaban) {
                                            //alert('d6');
                                            $('#loaditemlist').html(jawaban);
                                            $.ajax({
                                                //Alamat url harap disesuaikan dengan lokasi script pada komputer anda
                                                url: "<?php echo base_url("/procurement/purchase_request/popupitem_list"); ?>?ReqType=" + ReqTypeID + "&code=" + ReqCatID + "&zone=" + zone,
//                                                url: 'procurement/requestproc/popupitem_list?ReqType=' + ReqTypeID + '&code=' + ReqCatID + '&zone=' + zone,
                                                type: 'GET',
                                                dataType: 'html',
                                                success: function (jawaban2) {
                                                    $('#modal-add').html(jawaban2);
                                                },
                                            });

                                        },
                                    });
                                },
                            });
                        } else {
                            var itemchek = document.getElementById('totrow').value;
                            document.getElementById('totck').value = itemchek;
                            $.ajax({
                                url: "<?php echo base_url("/procurement/purchase_request/selitem_list/"); ?>" + itemchek,
//                                url: '<?php echo base_url(); ?>procurement/requestproc/selitem_list/' + itemchek,
                                type: 'POST',
                                dataType: 'html',
                                success: function (jawaban) {
                                    //$('#loaditemlist').html(jawaban);
                                },
                            });
                        }

                    },
                });
                var Budget = ReqCatID.split(">", 1);
                var BranchID = document.getElementById('BranchID').value;
                document.getElementById("Coa_Code").innerHTML = "Budget : " + Budget;
                document.getElementById("budgetCOA").value = Budget;
//                //*LOAD SELECT OPTION EKSEKUTOR PROJECT--------------------------------------------------------/
                if (ReqTypeID == 2) {
                    $('#load_exsekutor').fadeIn('slow');
                    $.ajax({
                        url: 'procurement/requestproc/selproject_eksekutor/' + zone,
                        type: 'GET',
                        dataType: 'html',
                        success: function (jawaban) {
                            $('#load_exsekutor').html(jawaban);

                        },
                    });
                } else if (ReqTypeID == 3) {
                    $('#load_exsekutor').fadeIn('slow');
                    $.ajax({
                        url: 'procurement/requestproc/selopt_sewaranch/' + zone,
                        type: 'GET',
                        dataType: 'html',
                        success: function (jawaban) {
                            $('#load_exsekutor').html(jawaban);

                        },
                    });
                }

            },
        });
    }
    //======PAGINATION=============================================================
    $(function () {
        $('#modal-add').fadeIn('slow');
        $("body").unbind(); //Untuk mencegah pengiriman ganda
        $('body').on('click', 'ul#search_page_pagination>li>a', function (e) {
            e.preventDefault();  // prevent default behaviour for anchor tag
            var ReqTypeID = document.getElementById('ReqTypeID').value;
            var ReqCatID = document.getElementById("ReqCategoryID").value;
            if (ReqTypeID == 2 || ReqTypeID == 5) {
                var zone = document.getElementById("Rkt").value;

            } else {
                var zone = "0-<?php echo $this->session->userdata('ZoneID'); ?>";
            }

            var src_cat = document.getElementById("src_cat").value;
            var Pagination_url = $(this).attr('href'); // getting href of <a> tag
            //alert(src_cat);
            if (src_cat == "") {
                var prosesurl = "<?php echo base_url(); ?>procurement/requestproc/popupitem_list" + Pagination_url + "?ReqType=" + ReqTypeID + "&code=" + ReqCatID + "&zone=" + zone;
            } else {
                //var prosesurl ="<?php echo base_url(); ?>procurement/requestproc/popupitem_list"+Pagination_url+"?code="+ReqCatID+"&zone="+zone;
                var prosesurl = "<?php echo base_url(); ?>procurement/requestproc/popupitem_list" + Pagination_url + "?ReqType=" + ReqTypeID + "&code=" + ReqCatID + "&zone=" + zone + "&srccategory=" + src_cat + "&pagesrc=1";
            }
            $.ajax({
                type: 'GET',
                url: prosesurl,
                cache: true,
                success: function (response) {
                    $("#modal-add").html(response);
                },
                dataType: "html"
            });
        });
    });
    //END PAGINATION ==============================================================>

    //function onItem(id){
    $(document).ready(function () {
        $("form#itemprosess").submit(function (event) {
            //disable submit------------------------------
            /* $(this).val('Please wait ...').attr('disabled','disabled');
             $('#itemprosess').submit();*/
            document.getElementById("proccesbtn").style.visibility = "hidden";

            event.preventDefault();
            var formData = new FormData($(this)[0]);
            //$('#loaditemlist').fadeIn('slow');
            $.ajax({
                url: 'procurement/requestproc/selitem_list',
                type: 'POST',
                data: new FormData(this),
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (returndata) {
                    $('#loaditemlist').html(returndata);
                    document.getElementById("proccesbtn").innerHTML = "Process again";
                    document.getElementById("addbutton").innerHTML = "<div class='form-group'><div class='col-sm-3'></div><div class='col-sm-7'><a href='#' onclick='onItemList(2)'><button class='btn btn-primary btn-xs' type='button'>Add New Item</button></a></div></div>";
                    //alert('tes');
                    //document.getElementById("proccesbtn").style.visibility = "visible";
                    //document.getElementById("proccesbtn").disabled = true;
                    /*var encripturl='<?php echo base_url(); ?>procurement/requestproc_tab';
                     $.ajax({
                     url      : encripturl,
                     type     : 'POST',
                     dataType : 'html',
                     success  : function(jawaban){
                     $('#loader').html(jawaban);
                     },
                     });*/
                }
            });

            return false;
        });



    });
</script>






