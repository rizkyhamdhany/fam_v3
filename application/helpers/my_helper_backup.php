<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function print_recursive_list($data){
    $str = "";
    foreach($data as $list){
		$subchild = print_recursive_list($list['child']);
		if($subchild != ''){
            $str .= '<li>';
			$str.= '<a href="'.site_url($list["link"]).'" id="id_a_menu_'.$list['id'].'">'; 
			$str.='<i class="icon-list"></i>&nbsp;'.$list['nama'].'<span class="arrow "></span></a>';//anchor($list['link'],$list['nama'])
			$str .= '<ul class="sub-menu">';
			$subchild = print_recursive_list($list['child']);
			$str .= $subchild;
			$str .= '</ul>';
        	$str .= '</li>';
		}else{
			$str .= '<li>';
			$str.= '<a href="'.site_url($list["link"]).'" id="id_a_menu_'.$list['id'].'">'; 
			$str.='<i class="icon-list"></i>&nbsp;'.$list['nama'].'</a>';//anchor($list['link'],$list['nama'])
			$subchild = print_recursive_list($list['child']);
			$str .= $subchild;
        	$str .= '</li>';
		}
		
        
        
        
    }
    return $str;
}
function print_recursive_menu($data){
    $str = "";
    foreach($data as $list){
		$subchild = print_recursive_menu($list['child']);
		if($subchild != ''){
			//$str.= '"children" :[';
			$str.='{ "text" : "'.$list['nama'].'",';//anchor($list['link'],$list['nama'])
			$str.= '"children" :[';
			$subchild = print_recursive_menu($list['child']);
			$str.='';
			//$str.= ']';
			$str .= $subchild;
			$str.= ']},';
		}else{//jika tdk punya anak lg
		//$str.= '"children" :[';
			$str.='{ "text" : "'.$list['nama'].'"},';//anchor($list['link'],$list['nama'])
			$subchild = print_recursive_menu($list['child']);
			$str .= $subchild;
		}
        
    }
    return $str;
}
function print_recursive_menu2($data){
    $str = "";
    foreach($data as $list){
		$subchild = print_recursive_menu2($list['child']);
		if($subchild != ''){
			$str.='{ "text" : "'.$list['nama'].'","id" : "'.$list['id'].'",';
			//echo '"text" : "'.$data['nama'].'","id" : "'.$data['id'].'",' ;
			$str.= '"children" :[';
			$subchild = print_recursive_menu2($list['child']);
			$str.='';
			$str .= $subchild;
			$str.= ']},';
		}else{//jika tdk punya anak lg
			$str.='{ "text" : "'.$list['nama'].'","id" : "'.$list['id'].'"},';
			//$str.='{ "text" : "'.$list['nama'].'","id" : "'.$list['id'].'",';
			$subchild = print_recursive_menu2($list['child']);
			$str .= $subchild;
		}
        
    }
    return $str;
}
function print_recursive_menu_all_li($data){
    $str = "";
    foreach($data as $list){
		$subchild = print_recursive_list($list['child']);
		if($subchild != ''){
            $str .= '<li id = "'.$list['id']."_".$list['parent'].'">';
			$str.= '<a href="" id = "a'.$list['id']."_".$list['parent'].'">'; 
			$str.='&nbsp;'.$list['nama'].'</a>';//anchor($list['link'],$list['nama'])
			$str .= '<ul>';
			$subchild = print_recursive_list($list['child']);
			$str .= $subchild;
			$str .= '</ul>';
			
        	$str .= '</li>';
		}else{
			$str .= '<li id = "'.$list['id']."_".$list['parent'].'">';
			$str.= '<a href="" id = "a'.$list['id']."_".$list['parent'].'">'; 
			$str.='&nbsp;'.$list['nama'].'</a>';//anchor($list['link'],$list['nama'])
			$subchild = print_recursive_list($list['child']);
			$str .= $subchild;
        	$str .= '</li>';
		}

    }
    return $str;
}
function print_recursive_breadcumb($data){
    $str = "";
    foreach($data as $list){
		$subchild = print_recursive_list($list['child']);
		if($subchild != ''){
            $str .= '<li>';
			$str.= '<a href="">'; 
			$str.='&nbsp;'.$list['nama'].'</a>';//anchor($list['link'],$list['nama'])
			$str .= '</li>';
			$subchild = print_recursive_list($list['child']);
			$str .= $subchild;
			
        	
		}else{
			$str .= '<li>';
			$str.= '<a href="">'; 
			$str.='&nbsp;'.$list['nama'].'</a>';//anchor($list['link'],$list['nama'])
			$str .= '</li>';
			$subchild = print_recursive_list($list['child']);
			$str .= $subchild;
        	
		}

    }
    return $str;
}
function print_recursive_neraca_aktiva($data){
	
    $str = "";
	$space2="";
	$spasi2 = "&nbsp;&nbsp;&nbsp;";
  
	foreach($data as $list){
		
		$level = $list['level'];
		
		$subchild = print_recursive_neraca_aktiva($list['child']);
		for($i=1;$i<$level;$i++){
				$space2.=$spasi2;
			}
		if($list['type']=='G'){
			$nama_perk="<strong>".$list['nama']."</strong>";
			if($list['saldo']<0){
				$saldo_perk="<strong>(".number_format(abs($list['saldo']),2).")</strong>";
			}else{
				$saldo_perk="<strong>".number_format($list['saldo'],2)."</strong>";
			}
		}else{
			$nama_perk=$list['nama'];
			if($list['saldo']<0){
				$saldo_perk="(".number_format(abs($list['saldo']),2).")";
			}else{
				$saldo_perk=number_format($list['saldo'],2);
			}
		}	
		if(($subchild != '') && (substr($list['kode_perk'],0,1)==1)){
			$str.= '<tr><td>'.$space2.$nama_perk.'</td><td align="right">'.$saldo_perk.'</td></tr>';//anchor($list['link'],$list['nama'])
			$str .= $subchild;
			
		}elseif(($subchild == '') && (substr($list['kode_perk'],0,1)==1)){
			$str.= '<tr><td>'.$space2.$nama_perk.'</td><td align="right">'.$saldo_perk.'</td></tr>';
			$subchild = print_recursive_neraca_aktiva($list['child']);
			$str .= $subchild;
		}
	$space2="";
    }//foreach
    return $str;
	
}
function print_recursive_neraca_pasiva($data){
	
    $str = "";
	$space2="";
	$spasi2 = "&nbsp;&nbsp;&nbsp;";
  
	foreach($data as $list){
		
		$level = $list['level'];
		
		$subchild = print_recursive_neraca_pasiva($list['child']);
		for($i=1;$i<$level;$i++){
				$space2.=$spasi2;
			}
		if($list['type']=='G'){
			$nama_perk="<strong>".$list['nama']."</strong>";
			if($list['saldo']<0){
				$saldo_perk="<strong>(".number_format(abs($list['saldo']),2).")</strong>";
			}else{
				$saldo_perk="<strong>".number_format($list['saldo'],2)."</strong>";
			}
		}else{
			$nama_perk=$list['nama'];
			if($list['saldo']<0){
				$saldo_perk="(".number_format(abs($list['saldo']),2).")";
			}else{
				$saldo_perk=number_format($list['saldo'],2);
			}
		}	
		if(($subchild != '') && ((substr($list['kode_perk'],0,1)==2) or (substr($list['kode_perk'],0,1)==3) )){
			$str.= '<tr><td>'.$space2.$nama_perk.'</td><td align="right">'.$saldo_perk.'</td></tr>';//anchor($list['link'],$list['nama'])
			$str .= $subchild;
			
		}elseif(($subchild == '') && ((substr($list['kode_perk'],0,1)==2) or (substr($list['kode_perk'],0,1)==3) )){
			$str.= '<tr><td>'.$space2.$nama_perk.'</td><td align="right">'.$saldo_perk.'</td></tr>';
			$subchild = print_recursive_neraca_pasiva($list['child']);
			$str .= $subchild;
		}
	$space2="";
    }//foreach
    return $str;
	
}

//LABARUGI

function print_recursive_labarugi_aktiva($data){
	
    $str = "";
	$space2="";
	$spasi2 = "&nbsp;&nbsp;&nbsp;";
  
	foreach($data as $list){
		
		$level = $list['level'];
		
		$subchild = print_recursive_labarugi_aktiva($list['child']);
		for($i=1;$i<$level;$i++){
				$space2.=$spasi2;
			}
		if($list['type']=='G'){
			$nama_perk="<strong>".$list['nama']."</strong>";
			if($list['saldo']<0){
				$saldo_perk="<strong>(".number_format(abs($list['saldo']),2).")</strong>";
			}else{
				$saldo_perk="<strong>".number_format($list['saldo'],2)."</strong>";
			}
		}else{
			$nama_perk=$list['nama'];
			if($list['saldo']<0){
				$saldo_perk="(".number_format(abs($list['saldo']),2).")";
			}else{
				$saldo_perk=number_format($list['saldo'],2);
			}
		}	
		if(($subchild != '') && (substr($list['kode_perk'],0,1)==4)){
			$str.= '<tr><td>'.$space2.$nama_perk.'</td><td align="right">'.$saldo_perk.'</td></tr>';//anchor($list['link'],$list['nama'])
			$str .= $subchild;
			
		}elseif(($subchild == '') && (substr($list['kode_perk'],0,1)==4)){
			$str.= '<tr><td>'.$space2.$nama_perk.'</td><td align="right">'.$saldo_perk.'</td></tr>';
			$subchild = print_recursive_labarugi_aktiva($list['child']);
			$str .= $subchild;
		}
	$space2="";
    }//foreach
    return $str;
	
}
function print_recursive_labarugi_pasiva($data){
	
    $str = "";
	$space2="";
	$spasi2 = "&nbsp;&nbsp;&nbsp;";
  
	foreach($data as $list){
		
		$level = $list['level'];
		
		$subchild = print_recursive_labarugi_pasiva($list['child']);
		for($i=1;$i<$level;$i++){
				$space2.=$spasi2;
			}
		if($list['type']=='G'){
			$nama_perk="<strong>".$list['nama']."</strong>";
			if($list['saldo']<0){
				$saldo_perk="<strong>(".number_format(abs($list['saldo']),2).")</strong>";
			}else{
				$saldo_perk="<strong>".number_format($list['saldo'],2)."</strong>";
			}
		}else{
			$nama_perk=$list['nama'];
			if($list['saldo']<0){
				$saldo_perk="(".number_format(abs($list['saldo']),2).")";
			}else{
				$saldo_perk=number_format($list['saldo'],2);
			}
		}	
		if(($subchild != '') && (substr($list['kode_perk'],0,1)==5) ){
			$str.= '<tr><td>'.$space2.$nama_perk.'</td><td align="right">'.$saldo_perk.'</td></tr>';//anchor($list['link'],$list['nama'])
			$str .= $subchild;
			
		}elseif(($subchild == '') && (substr($list['kode_perk'],0,1)==5) ){
			$str.= '<tr><td>'.$space2.$nama_perk.'</td><td align="right">'.$saldo_perk.'</td></tr>';
			$subchild = print_recursive_labarugi_pasiva($list['child']);
			$str .= $subchild;
		}
	$space2="";
    }//foreach
    return $str;
	
}
/*
function print_recursive_saldo_neraca($data){
    $str = "";
    foreach($data as $list){
		$subchild = print_recursive_saldo_neraca($list['child']);
		if($subchild != ''){
            $str .= '<li>';
			$str.= $list['saldo'];//anchor($list['link'],$list['nama'])
			
			$str .= $subchild;
			
        	$str .= '</li>';
		}else{
			$str .= '<li>';
			$str.= $list['saldo'];//anchor($list['link'],$list['nama'])
			$subchild = print_recursive_saldo_neraca($list['child']);
			$str .= $subchild;
        	$str .= '</li>';
		}
		
    }
    return $str;
}
*/
/*
function print_recursive_neraca($data){
    $str = "";
    foreach($data as $list){
		$subchild = print_recursive_neraca($list['child']);
		if($subchild != ''){
            $str .= '<li>';
			$str.= $list['nama'];//anchor($list['link'],$list['nama'])
			$str .= '<ul>';
			
			$str .= $subchild;
			$str .= '</ul>';
			
        	$str .= '</li>';
		}else{
			$str .= '<li>';
			$str.= $list['nama'];//anchor($list['link'],$list['nama'])
			$subchild = print_recursive_neraca($list['child']);
			$str .= $subchild;
        	$str .= '</li>';
		}
		
    }
    return $str;
}
function print_recursive_saldo_neraca($data){
    $str = "";
    foreach($data as $list){
		$subchild = print_recursive_saldo_neraca($list['child']);
		if($subchild != ''){
            $str .= '<li>';
			$str.= $list['saldo'];//anchor($list['link'],$list['nama'])
			
			$str .= $subchild;
			
        	$str .= '</li>';
		}else{
			$str .= '<li>';
			$str.= $list['saldo'];//anchor($list['link'],$list['nama'])
			$subchild = print_recursive_saldo_neraca($list['child']);
			$str .= $subchild;
        	$str .= '</li>';
		}
		
    }
    return $str;
}
backup end
function print_recursive_list($data)
{
    $str = "";
    foreach($data as $list)
    {
        $str .= '<li>';
		$str.= '<a href="'.site_url($list["link"]).'">'; 
		$str.='<i class="icon-list"></i>&nbsp;'.$list['nama'].'</a>';//anchor($list['link'],$list['nama'])
        $subchild = print_recursive_list($list['child']);
        if($subchild != '')
            $str .= $subchild;
        $str .= '</li>';
    }
    return $str;
}
*/

/*

function print_recursive_list($data)
{
    $str = "";
    foreach($data as $list)
    {
        $str .= '<li>'.anchor($list['link'],$list['nama']);
        $subchild = print_recursive_list($list['child']);
        if($subchild != '')
            $str .= $subchild;
        $str .= '<i class="icon-list"></i></li>';
    }
    return $str;
}
*/