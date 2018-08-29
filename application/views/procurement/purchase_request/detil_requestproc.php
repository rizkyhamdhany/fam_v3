<?php $format = 'Y-m-d H:i:s.u';
$date = DateTime::createFromFormat($format, $listdata->CreateDate);
?>
<div class="panel panel-inverse">
    <hr class="dotted">
    <div class="validator-form form-horizontal">
        <div class="form-group">
            <label class="control-label col-sm-3">Request Type</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="ProjectID" value="<?php echo $listdata->ReqTypeName; ?>"  disabled/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Request Category</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="EmployeeID" value="<?php echo $listdata->ReqCategoryName; ?>"  disabled/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Employee</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="TrxDate" value="<?php echo $listdata->EmployeeName; ?>"  disabled/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Branch</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="ItemID" value="<?php echo $listdata->BranchName; ?>"  disabled/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Date Request</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="ItemID" value="<?php echo $date->format('d-m-Y  H:i:s'); ?>"  disabled/>
            </div>
        </div>
        <?php
        if (empty($listdata->file_vendor)) {
            
        } else {
            ?>
            <div class="form-group">
                <div class="col-sm-12">
                    <center>
                        <a href="<?php echo base_url(); ?>uploads/purchase_request/<?php echo $listdata->file_vendor; ?>" class="mb-sm btn btn-success"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span>Download File Vendor</a>
                    </center>
    <!--<input type="text" class="form-control" name="ItemID" value="<?php echo $date->format('d-m-Y  H:i:s'); ?>"  disabled/>-->
                </div>
            </div>
            <?php
        }
        ?>
        <?php
        if ($listdata->Is_trash == 1) {
            $dates = DateTime::createFromFormat($format, $listdata->DeleteDate);
            ?>
            <div class="form-group">
                <label class="control-label col-sm-3">Date Hapus</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="date_del" value="<?php echo $dates->format('d-m-Y  H:i:s'); ?>"  disabled/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Keterangan Hapus</label>
                <div class="col-sm-7">
                    <textarea class="form-control" name="ItemID"  disabled/>
                    <?php echo $listdata->Keterangan_hapus; ?></textarea>
                </div>
            </div>

            <?php
        }
        ?>
        <?php if ($listdata->ReqTypeID == 3) { ?>
            <div class="form-group">
                <label class="control-label col-sm-3">Priode</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="priode" value="<?php echo $listdata->PriodSewa; ?>"  disabled/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Termin</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="Termin_sewa" value="<?php echo $listdata->Termin_sewa; ?>"  disabled/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Notifikasi Jatuh Tempo Sewa</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="Jtempo_sewa" value="<?php echo $listdata->Jtempo_sewa; ?>"  disabled/>
                </div>
            </div>
        <?php } ?>
        <hr class="dotted">
        <div class="form-group">
            <label class="control-label col-sm-3">Request Item</label>
            <div class="col-sm-12" align="center">
                <!--<input type="text" class="form-control" name="ItemID"  requered/>-->
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="skor">
                    <thead>
                        <tr>
                            <th></a></th>
                            <th>Items</a></th>
                            <th>Qty</a></th>
                            <th>Asset Type</a></th>
                            <th>Price</a></th>
                            <th>Total</a></th>
                        </tr>
                        <?php
                        // EDITED BY WILLY 11 AGUSTUS 2017  
                        $jenisperiode = $listdata->Jenis_periode_sewa;
                        if ($jenisperiode == '1') {
                            $jenisperiode_ket = "[ Harian ]";
                            $add_ket = "Hari";
                        } elseif ($jenisperiode == '2') {
                            $jenisperiode_ket = "[ Bulanan ]";
                            $add_ket = "Bulan";
                        } elseif ($jenisperiode == '3') {
                            $jenisperiode_ket = "[ Tahunan ]";
                            $add_ket = "Tahun";
                        } else {
                            $jenisperiode_ket = "";
                            $add_ket = "Month";
                        }
                        $jangkawaktu = $listdata->Jangka_waktu;
                        $terminsewa = $listdata->Termin_sewa;
                        // echo"<pre>";
                        // print_r($listdata);
                        // echo"</pre>";
                        $tot = array();
                        $qtyitem = array();
                        $i = 0;
                        foreach ($reqitem as $row) {
                            $tot[$i] = $row->Price * $row->QTY;
                            $qtyitem[$i] = $row->QTY;
                            ?>
                            <tr>
                                <td><img src='<?php echo base_url(); ?>uploads/Item_Images/<?php echo $row->Image; ?>' width='45' height='45'></td>
                                <td><?php echo $row->ItemName; ?></td>
                                <td><?php echo $row->QTY; ?></td>
                                <td><?php echo $row->AssetType; ?></td>
                                <td><?php echo 'Rp ' . number_format((float) $row->Price); ?></td>
                                <td><?php echo 'Rp ' . number_format((float) $row->Price * $row->QTY); ?></td>
                            </tr>
                            <?php
                            $i++;
                        }
                        if ($listdata->ReqTypeID != 3) {
                            $subtotal = array_sum($tot);
                            $st = "Total Payment";
                        } else {
                            $subtotal = array_sum($tot) * $listdata->PriodSewa;
                            $st = "Total Payment (" . $listdata->PriodSewa . "" . $add_ket . " )";
                        }
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php echo $st; ?></td>
                            <th><?php echo 'Rp ' . number_format((float) $subtotal); ?> </th>
                        </tr>
                    </thead>
                    <tbody class="sorter" id="sorter"></tbody>
                </table> 

                <hr class="dotted">

                <div class="widget-body">
                    <div class="widget-body  no-padding">

                        <div class="tickets-container">
                            <ul class="tickets-list">
                                <li class="ticket-item">
                                    <div class="row"><h6 class="modal-title"><b> .: APPROVAL INFORMATION :.</b></h6></div>
                                </li>
                                <?php
                                foreach ($infoaprove as $row) {
                                    // if($row->AppvStatus==1){
                                    ?>
                                    <li class="ticket-item">
                                        <div class="row">
                                            <div class="ticket-user col-lg-2 col-sm-2">
                                                <?php
                                                if ($row->image != "") {
                                                    $foto = $row->image;
                                                } else {
                                                    $foto = base_url() . 'metronic/img/noPhoto.jpg';
                                                }
                                                ?>
                                                <img class="user-avatar" src="<?php echo $foto; ?>" width="30">
                                            </div>
                                            <div class="ticket-user col-lg-6 col-sm-12">
                                                <span class="user-name"><?php echo $row->EmployeeName; ?></span>
                                                <span class="user-at">at</span>
                                                <span class="user-company"><?php echo $row->PositionName ?></span>
                                                <br>
                                                <span class="user-name"><?php ?>
                                                </span>
                                            </div>
                                            <div class="ticket-user col-lg-2 col-sm-12 hidden">

                                                <span class="user-at"><?php echo $row->Vendor_win ?></span>
                                            </div>
                                            <div class="ticket-time  col-lg-4 col-sm-6 col-xs-12">
                                                <div class="divider hidden-md hidden-sm hidden-xs"></div>
                                                <i class="fa fa-clock-o"></i>
                                                <span class="time"><?php if ($row->AppvStatus == 1) {
                                                    echo $row->AppvDate;
                                                } ?></span>
                                            </div>
                                            <div class="ticket-state bg-blue">
                                                <?php if ($row->AppvStatus == 0) { ?>

                                                    <i class="fa fa-info " title="Process"></i>

                                    <?php } else if ($row->AppvStatus == 1) { ?>
                                                    <i class="fa fa-check"></i>
    <?php } ?>
                                            </div>
                                        </div>
                                    </li>
<?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>





