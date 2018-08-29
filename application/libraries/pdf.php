<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class pdf {
//ini_set("memory_limit", "32M");
    function pdf_create($html, $filenaming, $stream = TRUE) {
		if(!defined("DOMPDF_ENABLE_REMOTE")){
            define("DOMPDF_ENABLE_REMOTE", true);
        }
        if(!defined("DOMPDF_ENABLE_AUTOLOAD")){
            define("DOMPDF_ENABLE_AUTOLOAD", false);
        }
		ini_set('memory_limit','-1');
        require_once(APPPATH . "/dompdf/dompdf_config.inc.php");
        require_once(APPPATH . "dompdf/include/dompdf.cls.php");
        require_once(APPPATH . "dompdf/include/canvas.cls.php");
        spl_autoload_register('DOMPDF_autoload'); //Autoload Resource
        $dompdf = new DOMPDF(); //Instansiasi
        $dompdf->load_html($html); //Load HTML File untuk dirender
//      
        $dompdf->set_paper("A4", "Portrait"); //setting the paper
        $dompdf->render(); //Proses Rendering File
//        $dompdf->get_page_number();

		  $dompdf->stream("Print.pdf", array("Attachment" => false));

  	exit(0);

    }

}
?>
