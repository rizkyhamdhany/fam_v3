<?php error_reporting(0); ?>   
<table class="table table-striped table-bordered table-hover">
        <thead class="flip-content bordered-palegreen">
            <tr>
                <th>Item Name</th>
                <th>Date</th>
                <th>Asset Value</th>                
                
            </tr>
        <tbody>
            <?php             
                if(!empty($listdata)){                       
                $zona = '';
                
                $array = json_decode(json_encode($listdata), true);
                $out = array();
               //print_r($out);die();
                foreach ($array as $key => $value){
//                    print_r($value);die();
                    foreach ($value as $key2 => $value2){
                        $index = $value2;
//                        print_r($value);die();
                        if (array_key_exists($index, $out)){
                            $out[$index]++;
                        } else {
                            $out[$index] = 1;
                        }
                    }
                }
                $flag = ''; 
                foreach ($listdata as $key) {      
                ?>
                <tr>
                <?php if($flag != $key->ItemName) { $flag = $key->ItemName; ?>
                    <td rowspan="<?php  echo $out[$flag] ?>" style="vertical-align: middle !important;"><?php echo $key->ItemName; ?></td>
                <?php } ?>
                    <td><?php echo date('d-m-Y',strtotime($key->Date)); ?></td>                    
                    <td><?php echo "Rp ".number_format($key->Value).".00"; ?></td>
                                      
                </tr>
            <?php } } ?>
        </tbody>
      </thead>
    </table>   
             

   