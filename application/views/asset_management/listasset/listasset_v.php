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
                                <!--                                <div class="col-md-8">
                                                                    <a class="btn btn-sm btn-primary" href="#" id="btnAdd" data-toggle="modal" data-target="#myadd">Upload Budget</a>
                                                                    <a class="btn btn-sm btn-success" href="<?php echo base_url("/procurement/budget_capex/downloadWord"); ?>" download>Download Template Budget</a>
                                                                     <button class="btn btn-sm btn-default">Add Item Category</button> 
                                                                </div>-->
                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridMutation">
                                        <thead>
                                            <tr>
                                                <th></th>     
                                                <th><input onkeyup="sch(this)" type="text" id="src_zone" name="ZoneName" class="form-control" placeholder="Search"></th>
                                                <th><input onkeyup="sch(this)" type="text" id="src_branch" name="DivisionName" class="form-control" placeholder="Search"></th>
                                                <th><input onkeyup="sch(this)" type="text" id="src_unit" name="BisUnitName" class="form-control" placeholder="Search"></th>
                                                <th><input onkeyup="sch(this)" type="text" id="src_faID" name="FAID" class="form-control" placeholder="Search"></th>
                                                <th><input onkeyup="sch(this)" type="text" id="src_faIDL" name="FAID_lama" class="form-control" placeholder="Search"></th>
                                                <th><input onkeyup="sch(this)" type="text" id="src_asset" name="ItemName" class="form-control" placeholder="Search"></th>
                                                <th colspan="5"></th>
                                            </tr>
                                            <tr>
                                                <th>NO</th>     
                                                <th>Zone</th>
                                                <th>Branch [Division]</th>
                                                <th>Unit</th>
                                                <th>Fix Asset ID</th>
                                                <th>Fix Asset ID Lama</th>
                                                <th>Asset Name</th>
                                                <th>QTY</th>
                                                <th>Image</th>
                                                <th>QR Code</th>
                                                <th>Condition</th>
                                                <th>
                                                    <?php
                                                    if ($div == 8 && $branch == 1 && $usergroup <> 3) {
                                                        ?>
                                                        <a href="<?php echo base_url(); ?>asset_management/listasset/formdisposal" id="idWord" class="btn btn-primary btn-xs" target="_blank"><i class="fa fa-download"></i> disposal</a>                                                    
                                                        <a data-toggle="modal" data-target="#myModal" class="btn btn-warning btn-xs text-right" onclick="uploaddisposal()"><i class="fa fa-upload" /> Disposal</a> 
                                                    <?php } else { ?>
                                                        <a href="<?php echo base_url(); ?>asset_management/listasset/formdisposal" id="idWord" class="btn btn-primary btn-xs" target="_blank"><i class="fa fa-download"></i> disposal</a>                                                    
                                                        <a data-toggle="modal" data-target="#myModal" class="btn btn-warning btn-xs text-right" onclick="uploaddisposal()" style="display:none;"><i class="fa fa-upload"></i> Disposal</a> 
                                                    <?php } ?>
                                                        <a href="<?php echo base_url(); ?>asset_management/listasset/downloadPDF" id="idPDF" class="btn btn-success btn-xs" target="_blank">QR Code</a>                                                    
                                                </th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                        <tfoot>


                                        </tfoot>
                                    </table>
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

<!--Modal Termin-->
<div id="myModal" class="modal fade" >
    <form class="validator-form form-horizontal" id="mutations" action="" method="POST">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Set Termin</h4>
                </div>
                <div class="modal-body" >

                    <div id="bodyDetail" ></div>

                </div>
                <div id="prosessloading"/>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="signup" value="Submit" id="submitmutasi">Mutation</button>
                    <button type="button" class="btn btn-primary" id="updis" name="signup" value="Submit" hidden>Save</button>
                     <!--<button type="submit" class="btn btn-primary" id="submitterm" name="submitterm" value="Submit">Save</button>-->
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_close" >Close</button>
                </div>
            </div>
        </div>
    </form>
</div>




<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('asset_management/listasset/listasset.js.php'); ?>

