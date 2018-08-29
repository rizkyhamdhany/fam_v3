<!DOCTYPE html>
<?php
error_reporting(0);
?>
<html>
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
        </style>
    </head>
    <body class="tabel">
        <label>&nbsp;</label>
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="col-md-12">
                <table width="100%">
                    <tr>
                        <td  width="70%">
                        </td>
                        <td></td>
                        <td></td>
                        <td colspan="2">
                            <table>
                                <tr>
                                    <td width="15%" style="font-weight: bold;">Non Stationary </td>
                                </tr>  
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td  colspan="5">
                            <div class="col-md-12">
                                <h1>
                                    <label>
                                        <center>PT. Permodalan Nasional Madani (Persero)</center>
                                    </label>
                                </h1>
                            </div> 
                        </td>
                    </tr>
                    <?php
                    foreach ($listdata as $row) {
                        $tgl = $row->CreateDate;
                        $employee = $row->EmployeeName;
                        $DivisionName = $row->DivisionName;
                    }
                    ?>
                    <tr>
                        <td  width="70%">
                        </td>
                        <td colspan="3">
                            <table>
                                <tr>
                                    <td>Nomor</td><td>:</td><td><?php
                                        $request = sprintf('%03u', $row->RequestID);
                                        echo "PR-" . $row->code_middel . "-" . $request;
                                        ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td><td>:</td><td><?php echo date('d/m/Y', strtotime($tgl)); ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td  colspan="5">
                            <h1>
                                <label>
                                    <center>Purchase Request</center>
                                </label>
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td  colspan="5">
                            <label>
                                <center>PNM/DIT.KA/GA-01/PM/01FORM01</center>
                            </label>
                        </td>
                    </tr>
                </table>                
            </div>               
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="tableizer-table2" style="width:100%;">
                    <thead>
                        <tr>
                            <th style="font-size:12px;width:15%;">
                                No.
                            </th>
                            <th style="font-size:12px;width:35%">
                                Jenis Barang
                            </th>
                            <th style="font-size:12px;width:25%">
                                Jumlah
                            </th>
                            <th style="font-size:12px;width:25%">
                                Keterangan
                            </th>
                        </tr>
                    </thead>
                </table> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">                
                <table style="width:100%;height:400px;border: 1px solid #000;margin-right: 3px" >
                    <tr>
                        <td valign="top">
                            <table border="0" style="width:100%;page-break-inside:avoid">
                                <?php
                                $i = 1;
                                foreach ($reqitem as $rowII) {

                                    $tgl = $row->CreateDate;
                                    ?>	
                                    <tr>
                                        <td style="font-size:12px;width:15%"><center><?php echo $i; ?></center></td>
                                        <td style="font-size:12px;width:35%">&nbsp;<?php echo $rowII->ItemName; ?></td>
                                        <td style="font-size:12px;width:25%"><center><?php echo $rowII->QTY; ?></center></td>
                                        <td style="font-size:12px;width:25%"><center><?php echo $rowII->Keterangan; ?></center></td>
                                        <td style="font-size:12px;width:25%"></td>   
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="page-break-inside:avoid;">
            <div class="col-md-12">
                <table border="0" style="width:100%;">
                    <tr>
                        <td colspan="3">
                            <table class="tableizer-table2" style="width:100%;page-break-inside:avoid">
                                <tr>
                                    <td rowspan="2"><center>Tanda Tangan</center></td>
                                    <td width="40%" colspan="3"><center>Pemohon</center></td>
                                    <td><center>Diproses</center></td>
                                    <td><center>Menyetujui</center></td>
                                </tr>
                                <tr height="60px">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr> 
                                <tr>
                                    <td>Nama</td>
                                    <td style="width:50px;"><?php echo $employee; ?></td>
                                    <td style="width:50px;">&nbsp;</td>
                                    <td style="width:50px;">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr> 
                                <tr>
                                    <td>Divisi</td>
                                    <td style="width:50px;"><?php echo $DivisionName; ?></td>
                                    <td style="width:50px;">&nbsp;</td>
                                    <td style="width:50px;">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td style="width:50px;"><?php echo $tgl; ?></td>
                                    <td style="width:50px;">&nbsp;</td>
                                    <td style="width:50px;">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:12px;">Putih</td>
                        <td style="font-size:12px;">:</td>
                        <td style="font-size:12px;"> Seksi Procurment</td>   
                    </tr>
                    <tr>
                        <td style="font-size:12px;">Hijau</td>
                        <td style="font-size:12px;">:</td>
                        <td style="font-size:12px;"> Bagian Akutansi</td>   
                    </tr>
                    <tr>
                        <td style="font-size:12px;">Merah</td>
                        <td style="font-size:12px;">:</td>
                        <td style="font-size:12px;"> Seksi Expense Analyse</td>   
                    </tr>
                </table>  
            </div>
        </div>
    </body>
</html>
<script>
    window.print();
</script>
