<!-- BEGIN PAGE BREADCRUMB --> 

<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
<input type="hidden" id="id_userName" value="<?php echo $this->session->userdata('user_name'); ?>">
<input type="hidden" id="id_posisi" value="<?php echo $this->session->userdata('posisi_desc'); ?>">
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
                            Upload IAS </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Payment </a>
                    </li>

                </ul> 
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <!--<div class="scroller" style="height:400px; ">-->
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
                                    <table class="table table-striped table-bordered text_kanan" id="table_gridBudget">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" valign="bottom">NO PR</th>
                                                <th rowspan="2" valign="bottom">NO PO DETAIL</th>
                                                <th rowspan="2" valign="bottom">JML TERMIN</th>
                                                <th rowspan="2" valign="bottom">ACT TERMIN</th>
                                                <th colspan="3">PEMBAYARAN</th>
                                                <th rowspan="2" valign="bottom">Aksi</th>
                                            </tr>
                                            <tr>
                                                <th>PROCESS</th>
                                                <th>DONE</th>
                                                <th>REJECT</th>
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
                        <!--</div>-->
                    </div>
                    <div class="tab-pane fade" id="tab_2_2">
                        <br>&nbsp;
                        <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridSetting">
                            <thead>
                                <tr>
                                    <th>NO PR</th>     
                                    <th>Tanggal Request</th>
                                    <th>Request Name</th>
                                    <th>Project Name</th>
                                    <th>Branch</th>
                                    <th>Status Akhir</th>
                                    <th>Status Cek</th>
                                    <th>No PO</th>
                                    <th>Status Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>
                </div>    
            </div>

        </div>
    </div>
    <!-- END VALIDATION STATES-->
</div>
</div>


<!-- END PAGE CONTENT-->

<!--Modal Add-->
<div id="myModal" class="modal fade" >
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">History</h4>
            </div>
            <div class="modal-body" >
                <form action="#" id="formsn" class="form-horizontal">
                    <table class="table table-bordered" id="table_sn">
                        <thead>
                            <th>ID PO</th>
                            <th>ID TB</th>
                            <th>ITEM ID</th>
                            <th>QTY</th>
                            <th>Serial Number</th>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </form>
            </div>
            <div id="prosessloading"/>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Save</button> -->
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_close" >Close</button>
            </div>
        </div>
    </div>
</div>



<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('procurement/ias/ias.js.php'); ?>

