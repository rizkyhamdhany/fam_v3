<!-- BEGIN PAGE BREADCRUMB --> 

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
                    <span class="caption-subject font-red sbold uppercase"><?php echo $menu_header; ?></span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <ul class="nav nav-pills">
                    <li class="linav active" id="linav1">
                        <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                            Transfer </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Data Transfer </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_3" class="anavitab">
                            Terima Transfer </a>
                    </li>

                </ul> 
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <div class="panel panel-inverse">
                            <hr class="dotted">
                            <form class="validator-form form-horizontal" id="fm_datasave" enctype="multipart/form-data" method="POST">
                                <div class="validator-form form-horizontal">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Branch</label>
                                        <div class="col-sm-7">
                                            <input type='text' name='jangka_waktu' id='jangka_waktu' class='form-control' >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Tanggal Pengiriman</label>
                                        <div class="col-sm-7">
                                            <input type='text' name='jangka_waktu' id='jangka_waktu' class='form-control' >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Divisi</label>
                                        <div class="col-sm-7">
                                            <input type='text' name='jangka_waktu' id='jangka_waktu' class='form-control' >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Nama Pengirim</label>
                                        <div class="col-sm-7">
                                            <input type='text' name='jangka_waktu' id='jangka_waktu' class='form-control' >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Wilayah Balai Lelang</label>
                                        <div class="col-sm-7">
                                            <select id="ReqTypeID" name="ReqTypeID" class="form-control">
                                                <option selected="" disabled="" value="">-Select-</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Resi</label>
                                        <div class="col-sm-7">
                                            <input type='text' name='jangka_waktu' id='jangka_waktu' class='form-control' >
                                        </div>
                                        <div class="col-sm-2">
                                            <button id="addbutton" class="btn btn-primary" type="button">Pilih</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Jumlah Asset Transfer</label>
                                        <div class="col-sm-7">
                                            <input type='text' name='jangka_waktu' id='jangka_waktu' class='form-control' >
                                        </div>
                                    </div>
                                    <div class="form-group" id="hdrAddBtn">
                                        <div class="col-md-3"><button id="addbutton" class="btn btn-primary" type="button">Pilih Asset</button></div>
                                        <div class="col-md-7">
                                        </div>
                                    </div>
                                    <!--LOAD SEL OPTION RKT-->
                                    <div class="form-group">
                                        <div class="col-sm-12" align="center">
                                            <p>Daftar Asset Transfer</p>
                                            <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridItemProcess">
                                                <thead>
                                                    <tr>
                                                        <th>Zona</th>     
                                                        <th>Branch (Divisi)</th>
                                                        <th>Unit</th>
                                                        <th>Tanggal Pengakuan Asset</th>
                                                        <th>Fix Asset ID</th>
                                                        <th>Fix Asset ID Lama</th>
                                                        <th>Nama Asset</th>
                                                        <th>QTY</th>
                                                        <th>Image</th>
                                                        <th>Kode QR</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>

                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3"><button type="submit" class="btn btn-primary" id="reqsave" name="reqsave" value="Submit" >Transfer</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <!--end--> 
                <div class="tab-pane fade" id="tab_2_2">
                    <div class="row">
                        <div id="divBudget">
                            <div class="col-md-12" >
                                <br>
                                <table class="table table-striped table-bordered table-hover text_kanan" id="tabel">
                                    <thead>
                                        <tr>
                                            <th>ID Transfer</th>     
                                            <th>Branch</th>
                                            <th>Divisi</th>
                                            <th>Jumlah Asset Transfer</th>
                                            <th>Tujuan Transfer</th>
                                            <th>Tanggal Pengiriman</th>
                                            <th>Nama Pengirim</th>
                                            <th>Aksi</th>
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
                </div>

                <div class="tab-pane fade" id="tab_2_3">
                    <div class="row">
                        <div id="divBudget">
                            <div class="col-md-12" >
                                <br>
                                <table class="table table-striped table-bordered table-hover text_kanan" id="tabel1">
                                    <thead>
                                        <tr>
                                            <th>ID Transfer</th>     
                                            <th>Branch</th>
                                            <th>Divisi</th>
                                            <th>Jumlah Asset Transfer</th>
                                            <th>Tujuan Transfer</th>
                                            <th>Tanggal Pengiriman</th>
                                            <th>Nama Pengirim</th>
                                            <th>Aksi</th>
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
                </div>
            </div>

        </div>   
    </div>

</div>
</div>
<!-- END VALIDATION STATES-->
</div>
</div>


<!-- END PAGE CONTENT-->

<?php $this->load->view('app.min.inc.php'); ?>
<script type="text/javascript">
    $('#tabel').dataTable();
    $('#tabel1').dataTable();
</script>

