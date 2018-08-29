<!DOCTYPE html>
<?php
error_reporting(0);
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Purchase Order</title>
        <style type="text/css">
            tableizer-table td {
                margin: 3px;
                border: 0px solid #000;
                font-size: 10px;
            }
            table.tableizer-table {
                width: 100%;
                border: 0px solid #000; font-family: Arial, Helvetica, sans-serif;
                font-size: 8px;
            }
            .tableizer-table td {
                margin: 3px;
                border: 0px solid #000;
                font-size: 10px;
            }
            .tableizer-table th {
                color: #000;
                font-weight: bold;
                font-size: 10px;
                text-align: center;
            }
            #logo{
                text-align: Left;
                margin-bottom: 5px;
                margin-right: 5px;
                width: 140px;
                float: left;
            }

            table.tableizer-table2{
                width: 100%;
                border: 1px solid #000; font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                font-size: 8px;
            }
            .tableizer-table2 td {
                margin: 3px;
                border: 1px solid #000;
            }
            .tableizer-table2 th {
                color: #000;
                border: 1px solid #000;
                font-weight: bold;
                font-size: 10px;
                text-align: center;
            }
            table.tableizer-table3{
                width: 100%;
                border: 0px solid #000; font-family: Arial, Helvetica, sans-serif;
                font-size: 8px;	
                background-color: whitesmoke;
            }
            table.tableizer-table4{
                width: 30%;
                float: left;
                border: 1px solid #000; font-family: Arial, Helvetica, sans-serif;
                font-size: 10px;
                margin-bottom: 20px;	
            }
            table.tableizer-table5 {
                width: 30%;
                float: left;
                border: 0px solid #000; font-family: Arial, Helvetica, sans-serif;
                font-size: 10px;
                margin-bottom: 20px;	
            }
            body {
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
                background-color: #FAFAFA;
                font: 10pt;
            }
            * {
                box-sizing: border-box;
                -moz-box-sizing: border-box;
            }
            .page {
                width: 200mm;
                max-height: 145mm;
                padding: 10mm;
                margin: 10mm auto;
                border: 1px #D3D3D3 solid;
                border-radius: 3px;
                background: white;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }
            .subpage {
                padding: 5mm;
                border: 5px red solid;
                height: 145mm;
                outline: 2cm #FFEAEA solid;
            }

            @page {
                size: A4;
                margin-top: 2em;
                margin-right: 2em;
                margin-left: 2em;
                margin-bottom: 2em;
            }
            @media print {
                @page {size: portrait}
            }

        </style>
    </head>
    <body class="tabel">
        <label>&nbsp;</label>
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="col-md-12">
                <table width="100%">
                    <tr>
                        <td  width="60%">
                        </td>
                        <td colspan="3">
                            <table>
                                <tr>
                                    <td>PO No.</td><td>:</td><td><?php 
                                    echo 'PO - '.trim($lokasi).'-'.$secNumber;
                                    ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td><td>:</td><td><?php echo date('d-m-Y'); ?></td>
                                </tr>
                                 <tr>
                                    <td>Batas Pengiriman</td><td>:</td><td></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td  colspan="5">
                                <h1>
                                    <label>
                                        <center>PURCHASE ORDER</center>
                                    </label>
                                </h1>
                        </td>
                    </tr>
                </table>
                
            </div>               
        </div>
        <div class="row">&nbsp;</div>
        <div class="row">&nbsp;</div>

        <table  width="100%">
            <thead>
                <tr>
                    <td>
                        <table class="judul tableizer-table2" width="100px">
                            <tr>
                                <td height="150" style="border: 3px solid black" valign="top" width="50%">
                                    <h1>Kepada :</h1>
                                    &nbsp;
                                </td>
                                <td height="150" style="border: 3px solid black" valign="top" width="50%">
                                    <h1>Dikirim Ke :</h1>
                                    &nbsp;
                               </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </thead>
            <tbody> 
                <tr>
                    <td>
                        <table width="100%" style="height:400px;">
                            <tr>
                                <td valign="top">
                                     <table class="judul tableizer-table2" width="100px" >
                                        <tr height="20" style="background:gray;">
                                            <th style="font-size: 12px;">No.</th>
                                            <th style="font-size: 12px;">Nama Barang / Jasa</th>
                                            <th style="font-size: 12px;">Jumlah</th>
                                            <th style="font-size: 12px;">Harga Satuan</th>
                                            <th style="font-size: 12px;">Total</th>
                                        </tr>
                                        <?php
                                            $i=1;
                                            $total='';
                                            foreach ($detailitem as $key) {
                                                $total += $key->QTY * $key->PriceVendor;
                                        ?>
                                        <tr>
                                            <td style="font-size: 12px; text-align: center;"><?php echo $i;?></td>
                                            <td style="font-size: 12px;"><?php echo $key->ItemName; ?></td>
                                            <td style="font-size: 12px; text-align: center;"><?php echo $key->QTY; ?></td>
                                            <td style="font-size: 12px; text-align: right;" >Rp. <?php echo number_format($key->PriceVendor).".00"; ?></td>
                                            <td style="font-size: 12px; text-align: right;">Rp. <?php echo number_format($key->QTY * $key->PriceVendor).".00";?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                            }
                                        ?>
                                        
                                        <tr height="20" style="background:gray;">
                                            <th style="font-size: 12px;" colspan="4"> Grand Total</th>
                                            <th style="font-size: 12px; text-align: right;">Rp. <?php echo number_format($total).".00"; ?></th>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td colspan="4">
                                    Termin Pembayaran :
                                </td>
                            </tr>
                            <?php 
                                $no=1;
                                
                                foreach ($seltermin as $rowss) {
                            ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td><?php echo $no;?>.</td>
                                <td> Termin <?php echo $no; ?></td>
                                <td><?php echo number_format((float) $rowss->WorkProgress) . ' %';?> </td>
                            </tr>
                            <?php
                                $no++;
                                }
                            ?>
                            <tr>
                                <td colspan="4">
                                    PT. PERMODALAN NASIONAL MADANI (Persero)
                                </td>
                            </tr>
                             <tr>
                                <td colspan="4">
                                    Divisi / Cabang : <?php foreach ($selDivisi as $divisi) { echo $divisi->DivisionName;}?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tfoot>
        </table>
</html>
<script>
    window.print();
</script>
