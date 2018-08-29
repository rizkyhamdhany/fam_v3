
          <div class="form-group">
        <label class="control-label col-sm-3">Request:</label>
            <div class="col-sm-7">
             <input type="hidden" class="form-control" id='action' name="action" value="update"/>
             <p class="form-control-static"><?php echo $listdata->ReqTypeName.'->'.$listdata->ReqCategoryName.' <br> '.$listdata->RktName;?></p>
            </div>
        </div>
         <div class="form-group">
        <label class="control-label col-sm-3">Eksekutor:</label>
            <div class="col-sm-7">
                <p class="form-control-static"> <?php echo $listdata->BranchName?></p>
            </div>
        </div>
        <hr class="dotted">
        <div class="form-group">
            <label class="control-label col-sm-3">Vendor:</label>
            <div class="col-sm-7">
                <p class="form-control-static"><?php echo $listdata->VendorName; ?></p>
             <input type="hidden" class="form-control" id='VendorID' name="VendorID" value="<?php echo $listdata->VendorID; ?>"/>
              <input type="hidden" class="form-control" id='VendorName' name="VendorName" value="<?php echo $listdata->VendorName; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Vendor Address:</label>
            <div class="col-sm-7">
                <p class="form-control-static"> <?php echo $listdata->VendorAddress; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Price Vendor:</label>
            <div class="col-sm-7">
                <p class="form-control-static"><?php echo 'Rp '.number_format((float)$listdata->PriceVendor); ?></p>
             <input type="hidden" class="form-control" id="RequestID" name="RequestID" value="<?php echo $RequestID; ?>"/>
                <input type="hidden" class="form-control" id='PriceVendor' name="PriceVendor" value="<?php echo $listdata->PriceVendor; ?>"/>
            </div>
        </div>
        <hr class="dotted">
        <div class="form-group">
            <label class="control-label col-sm-3">Work Runing Date:</label>
            <div class="col-sm-7">
                <p class="form-control-static">
                    <?php 
           $format = 'Y-m-d';
            $date = DateTime::createFromFormat($format, $listdata->StartDate);
            $dateend = DateTime::createFromFormat($format, $listdata->EndDate);
            echo $date->format('d-m-Y').' s/d '. $dateend->format('d-m-Y'); ?>
                    </p>
            </div>
        </div>
       <hr class="dotted">
        <div class="form-group">
            <div class="col-sm-12" align="center">
                <!--<input type="text" class="form-control" name="ItemID"  requered/>-->
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="skor">
              <thead>
                <tr>
                    <th width="25%">Target Progress</a></th>
                    <th>Value</a></th>
                    <th width="25%">Date Payment</a></th>
                    <th width="10%"><a class="btn btn-primary" title="Klik disini untuk menambahkan data baru" onclick="addupd(<?php echo count($termin); ?>)">Add</a></th>
                </tr>
                <?php $total = 0;
                $i=1; foreach($termin as $row){ 
                $total+=$row->WorkPayment;
                ?>
                <tr>
            
                    <td><select class="form-control" id="progress<?php echo $i; ?>" name="progress<?php echo $i; ?>" onchange="onWorkPayment_upd(<?php echo $i; ?>,1)">
                     <?php if($row->StatusPayment!=1){ ?>
                            <option selected="" disabled="" value="">-Select-</option>
                            <option value="10" <?php if($row->WorkProgress==10){ echo "selected"; } ?>>10%</option>
                            <option value="20" <?php if($row->WorkProgress==20){ echo "selected"; } ?>>20%</option>
                            <option value="30" <?php if($row->WorkProgress==30){ echo "selected"; } ?>>30%</option>
                            <option value="40" <?php if($row->WorkProgress==40){ echo "selected"; } ?>>40%</option>
                            <option value="50" <?php if($row->WorkProgress==50){ echo "selected"; } ?>>50%</option>
                            <option value="60" <?php if($row->WorkProgress==60){ echo "selected"; } ?>>60%</option>
                            <option value="70" <?php if($row->WorkProgress==70){ echo "selected"; } ?>>70%</option>
                            <option value="80" <?php if($row->WorkProgress==80){ echo "selected"; } ?>>80%</option>
                            <option value="90" <?php if($row->WorkProgress==90){ echo "selected"; } ?>>90%</option>
                            <option value="100" <?php if($row->WorkProgress==100){ echo "selected"; } ?>>100%</option>
                     <?php }else{ ?>
                            <option value="<?php echo $row->WorkProgress; ?>"><?php echo $row->WorkProgress.' %'; ?></option>
                     <?php } ?>
                        </select>
                    </td>
                    <td><div id="val<?php echo $i; ?>"><?php echo ' Rp '.number_format((float)$row->WorkPayment); ?></div>
                        <div id='divpayment<?php echo $i; ?>'></div>
                        <input class="form-control" id="terminID<?php echo $i; ?>" name="terminID<?php echo $i; ?>" value="<?php echo $row->TerminID; ?>" size="10" placeholder="YYYY-mm-dd" required="" type="hidden">
                        <input class="form-control" id="payment<?php echo $i; ?>" name="payment<?php echo $i; ?>" value="<?php echo $row->WorkPayment; ?>" size="10" placeholder="YYYY-mm-dd" required="" type="hidden">
                    </td>
                    <td><input class="form-control" id="DatePayment<?php echo $i; ?>" name="DatePayment<?php echo $i; ?>" value="<?php echo $row->DatePayment; ?>" size="10" placeholder="YYYY-mm-dd" required="" type="text" onclick="ondatepacker(<?php echo $i; ?>)"></td>
                    <td></td>
<!--                    <td><?php if($row->StatusPayment==1){ ?><img src="http://localhost:8081/TRAM/pnmsystem/assets/img/lunas.png" width="40px" height="15px"><?php }else{ echo '<a onclick="deltermin('.$i.','.$row->WorkPayment.','.$row->TerminID.')"><i class="fa fa-times"></i></a>';} ?></td>-->
                </tr>
                <?php $i++;} ?>
              </thead>
                  <tbody class="sorter" id="sorter">
                  <input type="hidden" class="form-control" id='totalrowtambah' name="totalrowtambah" value="<?php echo count($termin)+1; ?>"/>
                  <input type="hidden" class="form-control" id='totalrow' name="totalrow" value="<?php echo count($termin); ?>"/>
                  <input type="hidden" class="form-control" id='TotalPersen' name="TotalPersen" value="<?php echo $total; ?>"/></tbody>
            </table> 
           
            </div>
        </div>
    </div>
</div>
  

   