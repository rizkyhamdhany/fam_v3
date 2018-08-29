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

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridBudgetCapex">
                                        <thead>
                                            <tr>
                                                <th>NO</th>     
                                                <th>Request</th>
                                                <th>No PO</th>
                                                <th>From</th>
                                                <th>Price HPS - Price Vendor</th>
                                                <th>Termin Payment</th>

                                                <th>Action</th>


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
<div id="MyTermin" class="modal fade" >
    <form class="validator-form form-horizontal" id="datasave" action="" method="POST">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Set Termin</h4>
                </div>
                <div class="modal-body" >

                    <div id="bodyMyTermin" ></div>

                </div>
                <div id="prosessloading"/>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="submitterm" name="submitterm" value="Submit">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_close" >Close</button>
                </div>
            </div>
        </div>
    </form>
</div>



<!--Modal Add-->
<div id="MyTermin" class="modal fade" >
    <form class="validator-form form-horizontal" id="datasave" action="" enctype="multipart/form-data" method="POST">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Budget</h4>
                </div>
                <div class="modal-body" >
                    <div class="form-group">
                        <label class="control-label col-sm-3">Upload File (.xlsx/.xls)</label>
                        <div class="col-sm-7">
                            <input type="file" class="form-control" name="namafile" id="namafile" required>                
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="signup" value="Submit" id="simandata">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeupload">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal UPDATE-->
<div class="modal fade draggable-modal" id="mdl_Update" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">                
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

                <div class="panel panel-inverse">
                    <hr class="dotted">
                    <div class="validator-form form-horizontal">
                        <input type="hidden" id="BudgetID">
                        <div class="form-group">
                            <label class="control-label col-sm-3">Budget COA</label>
                            <div class="col-sm-7">
                                <input type="text" requered="" name="BudgetCOA" class="form-control" id="BudgetCOA">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Branch Name </label>
                            <div class="col-sm-7">
                                <div id="ddBranch"></div>
                            </div>
                        </div>        
                        <div class="form-group" id="displaydivisi">
                            <label class="control-label col-sm-3">Division Name</label>
                            <div class="col-sm-7">
                                <div id="ddDivisi"></div>
                            </div>
                        </div>        

                        <div class="form-group">
                            <label class="control-label col-sm-3">Budget Value</label>
                            <div class="col-sm-7">
                                <input type="text" requered="" name="BudgetValue" class="form-control nomor" id="BudgetValue">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Period</label>
                            <div class="col-sm-7">
                                <input type="text" requered="" name="period" class="form-control nomor1" id="period">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <div class="btnSC">
                        <button type="button" class="btn btn-success save" onclick="clickUpdate()">Save</button>
                        <button type="button" class="btn btn-success update" onclick="clickUpdate()">Update</button>
                        <button type="button" class="btn btn-warning close_" data-dismiss="modal">Close</button>                
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('procurement/termofpayment/termofpayment.js.php'); ?>

