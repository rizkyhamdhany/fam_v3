<?php

class pdf_mc_table_helper extends FPDF{
	var $widths;
	var $aligns;
	var $headlap;
	var $headlap2;
	var $headlap3;
	
	function __construct($init_parameter) {
		
		$this->headlap = $init_parameter['title1'];
		$this->headlap2 = $init_parameter['title2'];
		$this->headlap3 = $init_parameter['title3'];
		$this->SetMargins(10, 10, 100000);
    }
	
	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}

	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}

	function Row($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=5*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			//Print the text
			$this->MultiCell($w,5,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
	
	function Header(){
		// Logo
		
		//$this->Image('images/perumnas_logo.png',10,10,50);
		// Arial bold 15
		$this->SetFont('Arial','',13);
		// Move to the right
		// $this->Cell(130);
		// Title
		
		$this->Cell(0,10,$this->headlap,0,0,'C');
		$this->Ln(5);
		$this->SetFont('Arial','',11);
		$this->Cell(0,10,$this->headlap2,0,0,'C');
		$this->Ln(5);
		$this->Cell(0,10,$this->headlap3,0,0,'C');
		$this->Line(10, 33, $this->getX(), 33);
		$this->Ln(20);
		// Line break
	}
	
	// Page footer
	function Footer(){
		$this->AliasNbPages('{nb}');
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Page number
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	
	function _putpages(){
		$nb = $this->page;
		if(!empty($this->AliasNbPages))
		{
			// Replace number of pages
			for($n=1;$n<=$nb;$n++)
			{
				if($this->compress)
					$this->pages[$n] = gzcompress(str_replace($this->AliasNbPages,$nb,gzuncompress($this->pages[$n])));
				else
					$this->pages[$n] = str_replace($this->AliasNbPages,$nb,$this->pages[$n]);
			}
		}
		if($this->DefOrientation=='P')
		{
			$wPt = $this->DefPageSize[0]*$this->k;
			$hPt = $this->DefPageSize[1]*$this->k;
		}
		else
		{
			$wPt = $this->DefPageSize[1]*$this->k;
			$hPt = $this->DefPageSize[0]*$this->k;
		}
		$filter = ($this->compress) ? '/Filter /FlateDecode ' : '';
		for($n=1;$n<=$nb;$n++)
		{
			// Page
			$this->_newobj();
			$this->_out('<</Type /Page');
			$this->_out('/Parent 1 0 R');
			if(isset($this->PageSizes[$n]))
				$this->_out(sprintf('/MediaBox [0 0 %.2F %.2F]',$this->PageSizes[$n][0],$this->PageSizes[$n][1]));
			$this->_out('/Resources 2 0 R');
			if(isset($this->PageLinks[$n]))
			{
				// Links
				$annots = '/Annots [';
				foreach($this->PageLinks[$n] as $pl)
				{
					$rect = sprintf('%.2F %.2F %.2F %.2F',$pl[0],$pl[1],$pl[0]+$pl[2],$pl[1]-$pl[3]);
					$annots .= '<</Type /Annot /Subtype /Link /Rect ['.$rect.'] /Border [0 0 0] ';
					if(is_string($pl[4]))
						$annots .= '/A <</S /URI /URI '.$this->_textstring($pl[4]).'>>>>';
					else
					{
						$l = $this->links[$pl[4]];
						$h = isset($this->PageSizes[$l[0]]) ? $this->PageSizes[$l[0]][1] : $hPt;
						$annots .= sprintf('/Dest [%d 0 R /XYZ 0 %.2F null]>>',1+2*$l[0],$h-$l[1]*$this->k);
					}
				}
				$this->_out($annots.']');
			}
			if($this->PDFVersion>'1.3')
				$this->_out('/Group <</Type /Group /S /Transparency /CS /DeviceRGB>>');
			$this->_out('/Contents '.($this->n+1).' 0 R>>');
			$this->_out('endobj');
			// Page content
			$p = $this->pages[$n];
			$this->_newobj();
			$this->_out('<<'.$filter.'/Length '.strlen($p).'>>');
			$this->_putstream($p);
			$this->_out('endobj');
		}
		// Pages root
		$this->offsets[1] = strlen($this->buffer);
		$this->_out('1 0 obj');
		$this->_out('<</Type /Pages');
		$kids = '/Kids [';
		for($i=0;$i<$nb;$i++)
			$kids .= (3+2*$i).' 0 R ';
		$this->_out($kids.']');
		$this->_out('/Count '.$nb);
		$this->_out(sprintf('/MediaBox [0 0 %.2F %.2F]',$wPt,$hPt));
		$this->_out('>>');
		$this->_out('endobj');
	}

	function _endpage(){
		parent::_endpage();
		if($this->compress)
			$this->pages[$this->page] = gzcompress($this->pages[$this->page]);
	}
}
?>
