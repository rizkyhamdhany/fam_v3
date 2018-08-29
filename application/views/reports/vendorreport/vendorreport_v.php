<!-- BEGIN PAGE BREADCRUMB --> 

<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
<style>
    .lunas
    {
        background-color: #66ff99 !important;
    }    
</style>
<?php
$div = $this->session->userdata('DivisionID');
$branch = $this->session->userdata('BranchID');
$usergroup = $this->session->userdata('groupid');
?>
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
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <div class="scroller" style="height:400px; ">
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="id_Reload" style="display: none;"></button>
                                </div>
                            </div>
                            <div class="row">
                                <form id="fm_param">
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <!--<label>Tanggal</label>-->
                                            <div class="input-group input-medium date-picker input-daterange" data-date="" data-date-format="dd-mm-yyyy">
                                                <input type="text" class="form-control" name="from" id="from" required>
                                                <span class="input-group-addon"> to </span>
                                                <input type="text" class="form-control" name="to" id="to" required> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!--<label>Div</label>-->
                                            <?php
                                            $data = array();
                                            $data[''] = '';
                                            foreach ($cabang as $key) :
                                                if ((int) $key->BranchCode == 00000) {
                                                    $ival = trim($key->BranchCode) . '-' . $key->BranchID . '-' . $key->DivisionID;
                                                } else {
                                                    $ival = trim($key->BranchCode) . '-' . $key->BranchID . '- 0';
                                                }
                                                if ((int) $key->BranchCode == 00000) {
                                                    $itext = $key->BranchName . '-' . $key->DivisionName;
                                                } else {
                                                    $itext = $key->BranchName;
                                                }
                                                $data[$ival] = $itext;
                                            endforeach;
                                            echo form_dropdown('branch', $data, '', 'required id="id_branch" class="form-control input-sm select2me "');
                                            ?>
                                        </div>
                                        <div class="col-md-3">
                                            <!--<label>Div</label>-->
                                            <?php
                                            $data = array();
                                            $data[''] = '';
                                            foreach ($vendor as $key) :
                                                $data[$key->VendorID] = $key->VendorName;
                                            endforeach;
                                            echo form_dropdown('vendor', $data, '', 'required id="id_vendor" class="form-control input-sm select2me "');
                                            ?>
                                        </div>
                                        <div class="col-sm-2">
                                            <select class="form-control" name="status" id="status" >
                                                <option value="10">--Status--</option> 
                                                <option value="1">Paid</option> 
                                                <option value="0">Not Paid</option> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <br>
                                        <button type="submit" class="btn blue" ><i class="fa fa-search"></i> Search</button>
                                        <a class="btn yellow" style="display: none" id="id_downlod" href="" ><i class="fa fa-download"></i> Download as Excel</a>
                                    </div>
                                </form>
                                <div class="col-md-12">
                                    <br>
                                    <div id="divGrid" hidden>
                                        <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridVendor">
                                            <thead>
                                                <tr>
                                                    <th></th>     
                                                    <th><input onkeyup="sch(this)" type="text" id="src_zone" name="ias" class="form-control" placeholder="Search"></th>
                                                    <th><input onkeyup="sch(this)" type="text" id="src_branch" name="deskripsi" class="form-control" placeholder="Search"></th>
                                                    <th><input onkeyup="sch(this)" type="text" id="src_unit" name="vendor" class="form-control" placeholder="Search"></th>
                                                    <th><input onkeyup="sch(this)" type="text" id="src_faID" name="kwi" class="form-control" placeholder="Search"></th>
                                                    <th><input onkeyup="sch(this)" type="text" id="src_faIDL" name="Fpur" class="form-control" placeholder="Search"></th>
                                                    <th><input onkeyup="sch(this)" type="text" id="src_asset" name="Nomor" class="form-control" placeholder="Search"></th>
                                                    <th><input onkeyup="sch(this)" type="text" id="src_asset" name="nominal" class="form-control" placeholder="Search"></th>
                                                    <th><input onkeyup="sch(this)" type="text" id="src_asset" name="tgl_upload_doc" class="form-control" placeholder="Search"></th>
                                                    <th><input onkeyup="sch(this)" type="text" id="src_asset" name="tgl_dibayar" class="form-control" placeholder="Search"></th>
                                                    <th><input onkeyup="sch(this)" type="text" id="src_asset" name="status_doc" class="form-control" placeholder="Search"></th>
                                                    <th><input onkeyup="sch(this)" type="text" id="src_asset" name="status_pembayaran" class="form-control" placeholder="Search"></th>
                                                </tr>
                                                <tr>
                                                    <th>NO</th>     
                                                    <th>NO IAS</th>
                                                    <th>Deskripsi PR</th>
                                                    <th>Nama Vendor</th>
                                                    <th>NO KWITANSI</th>
                                                    <th>NO FPUR & FPUM</th>
                                                    <th>NO Tagihan</th>
                                                    <th>Nominal</th>
                                                    <th>Tgl. Upload Dokumen</th>                
                                                    <th>Tgl. Dibayarkan</th>
                                                    <th>Status Dokumen</th> 
                                                    <th>Status Pembayaran</th>
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
<?php $this->load->view('reports/vendorreport/vendorreport.js.php'); ?>

