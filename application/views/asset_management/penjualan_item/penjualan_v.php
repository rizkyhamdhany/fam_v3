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
                            Pengajuan Penjualan </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Daftar Pengajuan </a>
                    </li>

                </ul> 
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <div class="panel panel-inverse">
                            <hr class="dotted">
                            <form class="validator-form form-horizontal" id="fm_datasave" enctype="multipart/form-data" method="POST">
                                <div class="validator-form form-horizontal">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Tanggal Pengajuan</label>
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
                                        <label class="control-label col-sm-3">Nama PIC</label>
                                        <div class="col-sm-7">
                                            <input type='text' name='jangka_waktu' id='jangka_waktu' class='form-control' >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Harga Perkiraan</label>
                                        <div class="col-sm-7">
                                            <input type='text' name='jangka_waktu' id='jangka_waktu' class='form-control' >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Jumlah Item</label>
                                        <div class="col-sm-7">
                                            <input type='text' name='jangka_waktu' id='jangka_waktu' class='form-control' >
                                        </div>
                                    </div>
                                    <hr class="dotted">
                                    <!--LOAD SEL OPTION RKT-->
                                    <div class="form-group" id="hdrAddBtn">
                                        <div class="col-md-3"><button id="addbutton" class="btn btn-primary" type="button">Add Item</button></div>
                                        <div class="col-md-7">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12" align="center">
                                            <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridItemProcess">
                                                <thead>
                                                    <tr>
                                                        <th>Zona</th>     
                                                        <th>Branch (Divisi)</th>
                                                        <th>Unit</th>
                                                        <th>Nama Asset</th>
                                                        <th>Fix Asset ID</th>
                                                        <th>Kondisi Asset</th>
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
                                        <div class="col-sm-3"><button type="submit" class="btn btn-primary" id="reqsave" name="reqsave" value="Submit" >Ajukan</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <!--end--> 
                <div class="tab-pane fade" id="tab_2_2">
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-3">
                                    <label>Mulai</label>
                                    <input type="text" required="" name="mulai" id="mulai" onchange="ddMulai(this.value)" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Sampai</label>
                                    <input type="text" required="" name="sampai" id="sampai" onchange="ddSampai(this.value)" class="form-control input-sm date-picker" data-date-format="dd/mm/yyyy">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn blue" onclick="onLihat()">Lihat</button>
                            </div>

                            <div id="divBudget">
                                <div class="col-md-12" >
                                    <br>
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="tabel">
                                        <thead>
                                            <tr>
                                                <th>Tanggal Pengajuan</th>     
                                                <th>ID Pengajuan</th>
                                                <th>Nama PIC</th>
                                                <th>Jumlah Item</th>
                                                <th>Wilayah Balai Lelang</th>
                                                <th>Harga Perkiraan</th>
                                                <th>Status</th>
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
</script>

