<!-- BEGIN PAGE BREADCRUMB --> 

<style type="text/css">
    


    table#table_gridCategory th:nth-child(2){
        display: none;
    } 
    table#table_gridCategory td:nth-child(2){
        display: none;
    }

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>
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
                    <span class="caption-subject font-red sbold uppercase">Upload Dokumen</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <form role="form"  method="post" enctype="multipart/form-data" action="<?php echo base_url('procurement/po/uploaddok'); ?>">
                <?php foreach ($detail_po as $detail) {?>
                <div class="form-group m-form__group m--margin-top-10">
                    <h5 class="m-portlet__head-text"><strong>Dokumen PO DETAIL <?php echo $detail->ID_PO_DETAIL; ?></strong></h5>
                </div>
                <div class="m-portlet__body col-md-12">
                    <?php foreach ($dokumen as $dok) { ?>
                        <?php if ($detail->ID_PO_DETAIL == $dok->ID_PO_DETAIL): ?>
                            <div class="form-group col-md-12">
                                <a href="<?php echo base_url('procurement/po/dl_dok').'/'.$dok->NO_DOC ?>" target="_blank" class="btn blue">Download Dokumen <?php echo $dok->NO_DOC; ?></a>
                            </div>
                        <?php endif ?>
                    <?php } ?>
                </div>
                <?php } ?>
                <?php foreach ($detail_po as $detail) {?>
                <div class="form-group m-form__group m--margin-top-10">
                    <h5 class="m-portlet__head-text"><strong>Upload Dokumen PO DETAIL <?php echo $detail->ID_PO_DETAIL; ?></strong></h5>
                </div>
                <div class="m-portlet__body">
                  <?php foreach ($dokumen as $dok) { ?>
                    <?php if ($detail->ID_PO_DETAIL == $dok->ID_PO_DETAIL): ?>
                  <div class="form-group m-form__group col-md-12">
                      <label for="example-text-input" class="col-sm-4 col-form-label">Upload <?php echo $dok->NO_DOC; ?></label>
                      <div class="col-sm-8">
                          <input type="file" class="form-control m-input" name="<?php echo $dok->ID; ?>" aria-describedby="textHelp">
                      </div>
                  </div>
                    <?php endif ?>
                  <?php } ?>
                </div>
                <?php } ?>
                <!-- <div style="overflow:auto;"> -->
                    <!-- <div style="float:right;"> -->
                            <button type="submit" name="simpan" value="Simpan" class="btn blue">Simpan</button>
                    <!-- </div> -->
                <!-- </div> -->
                </form>

                </div>

            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>



<?php $this->load->view('app.min.inc.php'); ?>


<!-- END JAVASCRIPTS