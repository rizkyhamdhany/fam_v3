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
                <!--  <ul class="nav nav-pills">
                     <li class="linav active" id="linav1">
                         <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                             Data Item Category </a>
                     </li>
                     <li class="linav" id="linav2">
                         <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                             Form Data Item Category</a>
                     </li>
 
                 </ul> -->
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <div class="scroller" style="height:400px; ">
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="id_Reload" style="display: none;"></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="btn btn-sm btn-primary" href="#" id="btnAdd" data-toggle="modal" data-target="#myadd" onclick="dd_Zone('B')">Upload HPS</a>
                                    <a class="btn btn-sm btn-success" href="<?php echo base_url("/procurement/hps/downloadWord"); ?>" download>Download Template HPS</a>
                                    <!-- <button class="btn btn-sm btn-default">Add Item Category</button> -->
                                </div>
                                <div class="col-md-12">&nbsp;</div>
<!--                                <div class="col-sm-4">
                                    <div class="form-group" id="displaydivisi">
                                        <label class="control-label col-sm-4">Zone Name</label>
                                        <div class="col-sm-7">
                                            <div id="ddZone3"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">Search Param :</div>
                                <div class="col-md-2">
                                    <select id="cat_itemclass" name="cat_itemclass" onchange="search(this.value)" class="form-control">
                                        <option value="ItemName">Item Name</option>
                                        <option value="ZoneName">Zone</option>
                                    </select>
                                </div>-->

                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan" id="table_gridHPS">
                                        <thead>
                                            <tr>
                                                <th>NO</th>     
                                                <th>Zone</th>
                                                <th>Item Name</th>
                                                <th>Price</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Action</th>
                                                <th>HpsID</th>
                                                <th>ZoneID</th>

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

<!--Modal Add-->
<div id="myadd" class="modal fade" >
    <form class="validator-form form-horizontal" id="fmsaveUpload" action="" enctype="multipart/form-data" method="POST">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload HPS</h4>
                </div>
                <div class="modal-body" >
                    <div class="form-group">
                        <label class="control-label col-sm-3">Zone Name</label>
                        <div class="col-sm-7">
                            <div id="ddZone2"></div>                
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="control-label col-sm-3">Upload File (.xlsx/.xls)</label>
                        <div class="col-sm-7">
                            <input type="file" class="form-control" name="namafile" id="namafile" required>                
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="Submit" value="Submit" id="simandata">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeupload">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal UPDATE-->
<div class="modal fade draggable-modal" id="mdl_Update" tabindex="-1" role="basic" aria-hidden="true">
    <form class="validator-form form-horizontal" id="fmUpdateHPS" action="" enctype="multipart/form-data" method="POST">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">                
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="HpsID" name="HpsID">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Item Name</label>
                        <div class="col-sm-7">
                            <input type="text" requered="" name="ItemName" class="form-control" id="ItemName" readonly>
                        </div>
                    </div>        
                    <div class="form-group" id="displaydivisi">
                        <label class="control-label col-sm-3">Zone Name</label>
                        <div class="col-sm-7">
                            <div id="ddZone"></div>
                        </div>
                    </div>        
                    <div class="form-group">
                        <label class="control-label col-sm-3">Start - End Date</label>
                        <div class="col-sm-7">
                            <div class="input-group input-large date-picker input-daterange" data-date="" data-date-format="dd-mm-yyyy">
                                <input type="text" class="form-control" name="StartDate" id="StartDate">
                                <span class="input-group-addon"> To </span>
                                <input type="text" class="form-control" name="EndDate" id="EndDate"> 
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Price</label>
                        <div class="col-sm-7">
                            <input type="text" requered="" name="price" class="form-control nomor" id="price">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="btnSC">
                            <!--<button type="button" class="btn btn-success save" onclick="clickUpdate()">Save</button>-->
                            <button type="submit" class="btn btn-success update" id="btnUpdateHPS">Update</button>
                            <button type="button" class="btn btn-warning close_" data-dismiss="modal" id="btnCloseHPS">Close</button>                
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </form>
</div>



<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('procurement/hps/hps.js.php'); ?>

