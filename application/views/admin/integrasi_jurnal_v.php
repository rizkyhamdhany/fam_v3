<!-- BEGIN PAGE BREADCRUMB -->
<style type="text/css">
    table#idTabelRumah td:nth-child(4) {
        text-align: right;
    }
    table#idTabelRumah td:nth-child(5) {
        text-align: right;
    }
</style>
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
                    <span class="caption-subject font-red-sunglo bold uppercase"><?php echo $menu_nama ?></span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <span id="event_result">

                    </span>
                </div>
                <form role="form" method="post" class="cls_from_rumah"
                      action="<?php echo base_url('integrasi_jurnal/home'); ?>" id="id_formIntegrasi">
                    <div class="row">

                        <div class="form-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Id jurnal integrasi </label>
                                            <div class="input-group">
                                                <input id="id_jurnalId" required="required" class="form-control input-sm"
                                                       type="text" name="jurnalId" readonly/>
                                                <span class="input-group-btn">
                                                    <a href="#" class="btn btn-success btn-sm" data-target="#idDivTabelJurnal"
                                                       id="id_btnModalJurnal" data-toggle="modal">
                                                        <i class="fa fa-search fa-fw"/></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label>Nama jurnal integrasi</label>
                                            <input id="id_namaJurnal" required="required" class="form-control  input-sm"
                                                   type="text" name="namaJurnal" />
                                        </div>
                                        <div class="col-md-4">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>No rek GL</label>
                                            <div class="input-group">
                                                <input id="id_GL" required="required" class="form-control input-sm"
                                                       type="text" name="GL" readonly/>
                                                <span class="input-group-btn">
                                                    <a href="#" class="btn btn-success btn-sm" data-target="#idDivTabelPerk"
                                                       id="id_btnModal" data-toggle="modal">
                                                        <i class="fa fa-search fa-fw"/></i>

                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input id="id_namaGL" readonly class="form-control input-sm"
                                           type="text" name="namaGL"/>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea rows="2" cols="" name="keterangan" id="id_keterangan"
                                                  class="form-control input-sm"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!--end <div class="col-md-6"> 1 -->
                            <!--
                            <div class="col-md-6">

                            </div>
                            -->
                        </div>
                        <!-- HIDDEN INPUT -->
                        <input type="text" id="idTmpAksiBtn" class="hidden">
                        <!-- END HIDDEN INPUT -->

                    </div>
                    <!--END ROW 1 -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-actions">

                                <button name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                    <!--<i class="fa fa-check"></i>--> Simpan
                                </button>
                                <button name="btnUbah" onclick="" class="btn yellow" id="id_btnUbah">
                                    <!--<i class="fa fa-edit"></i>--> Ubah
                                </button>
                                <button name="btnHapus" class="btn red" id="id_btnHapus">
                                    <!--<i class="fa fa-trash"></i>-->
                                    Hapus
                                </button>
                                <button id="id_btnBatal" type="button" class="btn default">Batal</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <!-- end <div class="portlet green-meadow box"> -->
    </div>
    <!-- end <div class="col-md-6"> -->
    <!--
    <div class="col-md-6">
    </div>
    -->
    <!-- end <div class="col-md-6"> -->
</div>
<div class="row">
    <div class="col-md-6">

    </div>
</div>

<!-- END PAGE CONTENT-->
<!--  MODAL Data Karyawan -->
<div class="modal fade draggable-modal" id="idDivTabelJurnal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Jurnal Integrasi</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="col-md-12">
                            <button id="id_ReloadJurnal" style="display: none;"></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-body">
                                <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelJurnal">
                                    <thead>
                                        <tr>
                                            <th>
                                                Id Integrasi
                                            </th>
                                            <th>
                                                Nama
                                            </th>
                                            <th>
                                                Kode GL
                                            </th>
                                            <th>
                                                Nama GL
                                            </th>
                                            <th>
                                                Keterangan
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                    <tfoot>


                                    </tfoot>
                                </table>
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
                <button type="button" class="btn default" data-dismiss="modal" id="btnCloseModalDataJurnal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--  END  MODAL Data Karyawan -->
<!--  MODAL Data Perkiraan -->
<div class="modal fade draggable-modal" id="idDivTabelPerk" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data Perkiraan</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="col-md-12">
                            <button id="id_ReloadPerk" style="display: none;"></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-body">
                                <table class="table table-striped table-bordered table-hover text_kanan"
                                       id="idTabelPerk">
                                    <thead>
                                        <tr>
                                            <th width='10%' align='left'>Kd Perk</th>
                                            <th width='10%' align='left'>Kd Alt</th>
                                            <th width='50%' align='left'>Nama Perk</th>
                                            <th width='10%' align='center'>Level</th>
                                            <th width='10%' align='center'>Type</th>
                                            <th width='10%' align='center'>DK</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
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
                <button type="button" class="btn default" data-dismiss="modal" id="btnCloseModalPerk">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--  END  MODAL Data Perkiraan -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<?php $this->load->view('app.min.inc.php'); ?>
<script>
    App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        ComponentsSelect2.init();
        $("input[readonly='true']").focus(function () {
            $(this).next();
        });
        TableManaged.init();
    });
    
    var TableManaged = function () {

        var initTableJurnal = function () {
            //var table = $('#id_TabelPerk');
            // begin first table
            var table = $('#idTabelJurnal').dataTable({
                "ajax": "<?php echo base_url("/admin/integrasi_jurnal/getAllJurnal"); ?>",
                "columns": [
                    {"data": "id_integrasi"},
                    {"data": "nama_integrasi"},
                    {"data": "kode_perk"},
                    {"data": "nama_perk"},
                    {"data": "keterangan"}
                ],
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                
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
                // "aaSorting": [[4,'desc'], [5,'desc']],
                "columnDefs": [{// set default column settings
                        'orderable': true,
                        'type': 'string',
                        'targets': [0]
                    }, {
                        "searchable": true,
                        "targets": [0]
                    }],
                "order": [
                    [0, "asc"]
                ] // set first column as a default sort by asc
            });
            
            $('#id_ReloadJurnal').click(function () {
                table.api().ajax.reload();
            });
            table.on('click', 'tbody tr', function () {
                var idJurnal = $(this).find("td").eq(0).html();
                $('#id_jurnalId').val(idJurnal);

                var namaJurnal = $(this).find("td").eq(1).html();
                $('#id_namaJurnal').val(namaJurnal);

                var kodePerk = $(this).find("td").eq(2).html();
                $('#id_GL').val(kodePerk);
                var namaPerk = $(this).find("td").eq(3).html();
                $('#id_namaGL').val(namaPerk);
                var keterangan = $(this).find("td").eq(4).html();
                $('#id_keterangan').val(keterangan);
                $("#btnCloseModalDataJurnal").trigger("click");
                $('#id_btnSimpan').attr('disabled', true);
                $('#id_btnUbah').attr("disabled", false);
                $('#id_btnHapus').attr("disabled", false);
                $('#id_userId').focus();
            });
        }
        var initTablePerk = function () {
            //var table = $('#id_TabelPerk');
            // begin first table
            var table = $('#idTabelPerk').dataTable({
                "ajax": "<?php echo base_url("/master/master_perkiraan/getAllPerkiraan"); ?>",
                "columns": [
                    {"data": "kode_perk"},
                    {"data": "kode_alt"},
                    {"data": "nama_perk"},
                    {"data": "level"},
                    {"data": "type"},
                    {"data": "dk"}
                ],
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
                // "aaSorting": [[4,'desc'], [5,'desc']],
                "columnDefs": [{// set default column settings
                        'orderable': true,
                        'type': 'string',
                        'targets': [0]
                    }, {
                        "searchable": true,
                        "targets": [0]
                    }],
                "order": [
                    [0, "asc"]
                ] // set first column as a default sort by asc
            });

            
            $('#id_Reload').click(function () {
                table.api().ajax.reload();
            });
            table.on('click', 'tbody tr', function () {
                var typePerk = $(this).find("td").eq(4).html();
                //$('#idTxtTempJnsKode').val('1');
                if (typePerk == 'D') {
                    var kodePerk = $(this).find("td").eq(0).html();
                    $('#id_GL').val(kodePerk);
                    var namaPerk = $(this).find("td").eq(2).html();
                    $('#id_namaGL').val(namaPerk);

                    $("#btnCloseModalPerk").trigger("click");
                } else {
                    alert("Tidak diijinkan pilih kode induk.");
                }
            });

        }

        return {
            //main function to initiate the module
            init: function () {
                if (!jQuery().dataTable) {
                    return;
                }
                initTableJurnal();
                initTablePerk();
            }
        };
    }();
    btnStart();
    readyToStart();
    $("#id_namaJurnal").focus();

    $("#id_btnSimpan").click(function () {
        $('#idTmpAksiBtn').val('1');
    });

    $('#id_btnUbah').click(function () {
        $('#idTmpAksiBtn').val('2');
    });
    $('#id_btnHapus').click(function () {
        $('#idTmpAksiBtn').val('3');
    });
    $('#id_btnBatal').click(function () {
        btnStart();
        resetForm();
        readyToStart();
    });

    function ajaxSubmit() {
        ajaxModal();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>admin/integrasi_jurnal/simpan",
            data: dataString,
            success: function (data) {
                $('#id_ReloadJurnal').trigger('click');
                $('#id_btnBatal').trigger('click');
                UIToastr.init(data.tipePesan, data.pesan);
            }

        });
        
    }
    function ajaxUbah() {
        ajaxModal();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>admin/integrasi_jurnal/ubah",
            data: dataString,
            success: function (data) {
                $('#id_ReloadJurnal').trigger('click');
                $('#id_btnBatal').trigger('click');
                UIToastr.init(data.tipePesan, data.pesan);
            }

        });
    }
    function ajaxHapus() {
        ajaxModal();
        var idJurnal = $('#id_jurnalId').val();
        idJurnal = idJurnal.trim();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>admin/integrasi_jurnal/hapus",
            data: {idJurnal: idJurnal},
            success: function (data) {
                $('#id_ReloadJurnal').trigger('click');
                $('#id_btnBatal').trigger('click');
                UIToastr.init(data.tipePesan, data.pesan);
            }

        });
    }
    $('#id_formIntegrasi').submit(function (event) {
        dataString = $("#id_formIntegrasi").serialize();
        var aksiBtn = $('#idTmpAksiBtn').val();
        if (aksiBtn == '1') {
            var r = confirm('Anda yakin menyimpan data ini?');
            if (r == true) {
                ajaxSubmit();
                event.preventDefault();
            } else {//if(r)
                return false;
            }
        } else if (aksiBtn == '2') {
            var r = confirm('Anda yakin merubah data ini?');
            if (r == true) {
                ajaxUbah();
                event.preventDefault();
            } else {//if(r)
                return false;
            }
        } else if (aksiBtn == '3') {
            var r = confirm('Anda yakin menghapus data ini?');
            if (r == true) {
                ajaxHapus();
                event.preventDefault();
            } else {//if(r)
                return false;
            }
        }
    });

</script>


<!-- END JAVASCRIPTS -->