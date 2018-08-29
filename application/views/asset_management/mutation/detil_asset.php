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
                $flag = ''; 
                foreach ($listdata as $key) {      
                ?>
                <tr>
                <?php if($flag != $key->ItemName) { $flag = $key->ItemName; ?>
                    <td rowspan="<?php  echo $icount ?>" style="vertical-align: middle !important;"><?php echo $key->ItemName; ?></td>
                <?php } ?>
                    <td><?php echo date('d-m-Y',strtotime($key->Date)); ?></td>                    
                    <td><?php echo "Rp ".number_format($key->Value).".00"; ?></td>
                                      
                </tr>
            <?php } } ?>
        </tbody>
      </thead>
    </table>   
             

   