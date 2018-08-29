<?php 
    // EDITED BY WILLY 11 AGUSTUS 2017  
      $jenisperiode=$listdata->Jenis_periode_sewa;
      if ($jenisperiode=='1') {
            $jenisperiode_ket="Harian";
            $add_ket="Hari";
      }elseif($jenisperiode=='2'){
            $jenisperiode_ket="Bulanan";
            $add_ket="bulan";
      }elseif($jenisperiode=='3'){
            $jenisperiode_ket="Tahunan";
            $add_ket="Tahun";
      }else{
            $jenisperiode_ket="";
            $add_ket="";
      }
      $jangkawaktu=$listdata->Jangka_waktu;
      $terminsewa=$listdata->Termin_sewa;
?> 
        <div class="form-group">
        <label class="control-label col-sm-3">Request:</label>
            <div class="col-sm-7">
            <input type="hidden" class="form-control" id='action' name="action" value="insert"/>
             <input type="hidden" class="form-control" id='ReqTypeID' name="ReqTypeID" value="<?php echo $listdata->ReqTypeID; ?>"/>
             <?php echo $listdata->ReqTypeName.'->'.$listdata->ReqCategoryName.' <br> '.$listdata->RktName;?>
            </div>
        </div>
         <div class="form-group">
        <label class="control-label col-sm-3">Eksekutor:</label>
            <div class="col-sm-7">
             <?php echo $listdata->BranchName?>
            </div>
        </div>
        <hr class="dotted">
        <div class="form-group">
            <label class="control-label col-sm-3">Vendor:</label>
            <div class="col-sm-7">
            <?php echo $listdata->VendorName; ?>
             <input type="hidden" class="form-control" id='VendorID' name="VendorID" value="<?php echo $listdata->VendorID; ?>"/>
              <input type="hidden" class="form-control" id='VendorName' name="VendorName" value="<?php echo $listdata->VendorName; ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Vendor Address:</label>
            <div class="col-sm-7">
            <?php echo $listdata->VendorAddress; ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Price Vendor:</label>
            <div class="col-sm-7">
            <?php echo 'Rp '.number_format((float)$listdata->PriceVendor); ?>
             <input type="hidden" class="form-control" name="RequestID" value="<?php echo $this->uri->segment('4'); ?>"/>
                <input type="hidden" class="form-control" id='PriceVendor' name="PriceVendor" value="<?php echo $listdata->PriceVendor; ?>"/>
            </div>
        </div>
        <hr class="dotted">
        <div class="form-group">
            <label class="control-label col-sm-3">Work Runing Date:</label>
            <div class="col-sm-7">
           <?php 
            $format = 'Y-m-d';
            $date = DateTime::createFromFormat($format, $listdata->StartDate);
            $dateend = DateTime::createFromFormat($format, $listdata->EndDate);
            echo $date->format('d-m-Y').' s/d '. $dateend->format('d-m-Y'); ?>
            </div>
        </div>

         <?php if((int)$listdata->ReqTypeID==3){ ?>
        <hr class="dotted">
        <div class="form-group">
            <label class="control-label col-sm-3">Jenis Sewa</label>
            <div class="col-sm-7">
            <?php echo $jenisperiode_ket; ?>
            </div>
        </div>
         <div class="form-group">
            <label class="control-label col-sm-3">Periode</label>
            <div class="col-sm-7">
            <?php echo $listdata->PriodSewa; ?> <?php echo $add_ket; ?>
            </div>
        </div>
                 <div class="form-group">
            <label class="control-label col-sm-3">Termin Sewa Per-</label>
            <div class="col-sm-7">
            <?php echo $terminsewa; ?> <?php echo $add_ket; ?>
            </div>
        </div>



         <?php } ?>
       <!-- <div class="form-group">
            <label class="control-label col-sm-3">Payment Method:</label>
            <div class="col-sm-7">
            <select id="PaymentMethod" name="PaymentMethod" class="form-control">
                  <option selected="" disabled="" value="">-Select-</option>
                  <option value="FPUR">FPUR</option>
                  <option value="IAS">IAS</option>
            </select>
            </div>
        </div>-->
       <hr class="dotted">
       <div class="form-group">
          <div class="col-sm-12">
            <?php if((int)$listdata->ReqTypeID==3){ ?>
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="skor">
              <thead>
                <tr>
                  <th width="30%">Payment Ke</a></th>
                  <th width="40%">Payment</a></th>
                  <th width="30%">Date Payment</a></th>
                </tr>
              </thead>
              <tbody class="sorter" id="sorter">
              <?php 
              $jenisperiode=$listdata->Jenis_periode_sewa;
              $jangkawaktu=$listdata->Jangka_waktu;
              $terminsewa=$listdata->Termin_sewa;

              if ($jenisperiode=='1') { //hari
                   $add=$terminsewa.' days';
              }elseif($jenisperiode=='2'){ //Bulan
                   $add=$terminsewa.' month';
              }elseif($jenisperiode=='3'){ //Tahun
                    $add=$terminsewa.' year';
              }else{
                    $add='1 month';
              }


              $pricesewa=$listdata->PriceVendor / $jangkawaktu;//$listdata->PriceVendor / $listdata->PriodSewa;
              $persentasi=round($pricesewa / $listdata->PriceVendor * 100,2); 
              $tglAwal = $listdata->StartDate;
              $exp=explode("-",$tglAwal);
              $thn_explode=$exp[0];
              $bln_explode=$exp[1];//-01;
              $tgl_explode=$exp[2];
              $tgAwl=$thn_explode.'-'.$bln_explode.'-'.$tgl_explode;
              $tglAkhir = $listdata->EndDate;
              $date1 = date_create($tgAwl);
              $arr1 = explode('-',$tglAwal);
              $arr2 = explode('-',$tglAkhir);
//echo "start".$tglAwal."<br>";
              $loop=$listdata->PriodSewa/$listdata->Termin_sewa;
              // foreach ($date1 as $key => $value) {
              //   $date2=substr($value,0,10);
              //   break;
              // }
              // echo $date2;
                for ($x = 1; $x <= $loop; $x++) { 
                  //$tanggal=$date->format('d');
                  $tanggal=date_format($date1,"d");
                 
                   if (date_format($date1,"F") == "January") {
                        $bulan = "01"; }
                    if (date_format($date1,"F") == "February") {
                        $bulan = "02"; }
                    if (date_format($date1,"F") == "March") {
                        $bulan = "03"; }
                    if (date_format($date1,"F") == "April") {
                        $bulan = "04"; }
                    if (date_format($date1,"F") == "May") {
                        $bulan = "05"; }
                    if (date_format($date1,"F") == "June") {
                        $bulan = "06"; }
                    if (date_format($date1,"F") == "July") {
                        $bulan = "07"; }
                    if (date_format($date1,"F") == "August") {
                        $bulan = "08"; }
                    if (date_format($date1,"F") == "September") {
                        $bulan = "09"; }
                    if (date_format($date1,"F") == "October") {
                        $bulan = "10"; }
                    if (date_format($date1,"F") == "November") {
                        $bulan = "11"; }
                    if (date_format($date1,"F") == "December") {
                        $bulan = "12"; }
                        
//                        echo date_format($date1,"d")." - ".date_format($date1,"F")."( ".$bulan.") - ".date_format($date1,"Y")."<br>";//date_interval_create_from_date_string($add)."<br>";
//                        echo date_format($date1,"Y").'-'.$bulan.'-'.$tanggal."<br>";
                 // JIKA BAYAR DIAWAL: TRUH DISINI date_add($date1, date_interval_create_from_date_string($add));
                  ?>
                <tr>
                  <td><input type="hidden" required="" size="10" name="progress<?php echo $x; ?>" id="progress<?php echo $x; ?>" class="form-control" value="<?php echo $persentasi; ?>"><?php echo $x; ?></td>
                  <td><input type="hidden" required="" size="10" name="payment<?php echo $x; ?>" id="payment<?php echo $x; ?>" class="form-control" value="<?php echo $pricesewa; ?>"><?php echo 'Rp '.number_format((float)$pricesewa); ?></td>
                  <td><input type="hidden" required="" size="10" name="DatePayment<?php echo $x; ?>" id="DatePayment<?php echo $x; ?>" class="form-control" value="<?php echo date_format($date1,"Y").'-'.$bulan.'-'.$tanggal; ?>"><?php echo $tanggal.'-'.$bulan.'-'.date_format($date1,"Y");//$tanggal.' '.date_format($date1,"F Y") ?></td>
                </tr>
              <?php 
                date_add($date1, date_interval_create_from_date_string($add));// JIKA BAYAR DIAKHIR: TRUH DISINI 
              } ?>
              <input type="hidden" class="form-control" id='TotalPersen' name="TotalPersen" value="<?php echo $listdata->PriceVendor; ?>"/>
               <input type="hidden" class="form-control" id='totitem' name="totitem" value="<?php echo $loop; ?>"/>
              </tbody>
            </table>

            <?php }else{ ?>
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="skor">
              <thead>
                <tr>
                  <th width="30%">Work progress</a></th>
                  <th width="40%">Payment</a></th>
                  <th width="30%">Date Payment</a></th>
                  <th><a class="btn btn-primary" title="Klik disini untuk menambahkan data baru" onclick="addrow()">Add</a></th>
                </tr>
              </thead>
              <tbody class="sorter" id="sorter">
              <input type="hidden" class="form-control" id='TotalPersen' name="TotalPersen"/>
               <input type="hidden" class="form-control" id='totitem' name="totitem"/>
              </tbody>
            </table> 
            <?php } ?>
          </div>
      </div>
      <script type="text/javascript">
        
      </script>
    <?php 
    /*$tglAwal = "2017-06-01";
    $tglAkhir = "2018-07-10";
    $date1 = date_create($tglAwal);
    $arr1 = explode('-',$tglAwal);
    $arr2 = explode('-',$tglAkhir);
    //echo $arr2[2];
    $numBulan = 1 + (date("Y",$arr2[0])-date("Y",$arr1[0]))*12;
    // menghitung selisih bulan
    $numBulan += date("m",$arr2[1])-date("m",$arr2[1]);
    $diff = gregoriantojd($arr2[1], $arr2[2], $arr2[0])- gregoriantojd($arr1[1], $arr1[2], $arr1[0]);
    $arr=array();
    for($k=0;$k<=$listdata->PriodSewa;$k++){    
      $arr[$k]=date_format($date1,"F Y");           
        echo date_format($date1,"F Y").'<br>';
        date_add($date1, date_interval_create_from_date_string('1 month'));
    }*/
    //print_r($arr);
    ?>




         

   
             

   