<?php
	require("fpdf.php");
	class FPDF_EXTENDED extends FPDF {
		
		function __construct($orientation){
			parent::__construct($orientation);
		}
		
		function WriteTable($tcolums){
		  // go through all colums
		  for ($i = 0; $i < sizeof($tcolums); $i++)
		  {
			 $current_col = $tcolums[$i];
			 $height = 0;
			 
			 // get max height of current col
			 $nb=0;
			 for($b = 0; $b < sizeof($current_col); $b++)
			 {
				// set style
				$this->SetFont($current_col[$b]['font_name'], $current_col[$b]['font_style'], $current_col[$b]['font_size']);
				$color = explode(",", $current_col[$b]['fillcolor']);
				$this->SetFillColor($color[0], $color[1], $color[2]);
				$color = explode(",", $current_col[$b]['textcolor']);
				$this->SetTextColor($color[0], $color[1], $color[2]);            
				$color = explode(",", $current_col[$b]['drawcolor']);            
				$this->SetDrawColor($color[0], $color[1], $color[2]);
				$this->SetLineWidth($current_col[$b]['linewidth']);
							
				$nb = max($nb, $this->NbLines($current_col[$b]['width'], $current_col[$b]['text']));            
				$height = $current_col[$b]['height'];
			 }  
			 $h=$height*$nb;
			 
			 
			 // Issue a page break first if needed
			 $this->CheckPageBreak($h);
			 
			 // Draw the cells of the row
			 for($b = 0; $b < sizeof($current_col); $b++)
			 {
				$w = $current_col[$b]['width'];
				$a = $current_col[$b]['align'];
				
				// Save the current position
				$x=$this->GetX();
				$y=$this->GetY();
				
				// set style
				$this->SetFont($current_col[$b]['font_name'], $current_col[$b]['font_style'], $current_col[$b]['font_size']);
				$color = explode(",", $current_col[$b]['fillcolor']);
				$this->SetFillColor($color[0], $color[1], $color[2]);
				$color = explode(",", $current_col[$b]['textcolor']);
				$this->SetTextColor($color[0], $color[1], $color[2]);            
				$color = explode(",", $current_col[$b]['drawcolor']);            
				$this->SetDrawColor($color[0], $color[1], $color[2]);
				$this->SetLineWidth($current_col[$b]['linewidth']);
				
				$color = explode(",", $current_col[$b]['fillcolor']);            
				$this->SetDrawColor($color[0], $color[1], $color[2]);
				
				
				// Draw Cell Background
				$this->Rect($x, $y, $w, $h, 'FD');
				
				$color = explode(",", $current_col[$b]['drawcolor']);            
				$this->SetDrawColor($color[0], $color[1], $color[2]);
				
				// Draw Cell Border
				if (substr_count($current_col[$b]['linearea'], "T") > 0)
				{
				   $this->Line($x, $y, $x+$w, $y);
				}            
				
				if (substr_count($current_col[$b]['linearea'], "B") > 0)
				{
				   $this->Line($x, $y+$h, $x+$w, $y+$h);
				}            
				
				if (substr_count($current_col[$b]['linearea'], "L") > 0)
				{
				   $this->Line($x, $y, $x, $y+$h);
				}
							
				if (substr_count($current_col[$b]['linearea'], "R") > 0)
				{
				   $this->Line($x+$w, $y, $x+$w, $y+$h);
				}
				
				
				// Print the text
				$this->MultiCell($w, $current_col[$b]['height'], $current_col[$b]['text'], 0, $a, 0);
				
				// Put the position to the right of the cell
				$this->SetXY($x+$w, $y);         
			 }
			 
			 // Go to the next line
			 $this->Ln($h);          
		  }                  
	   }

		function CheckPageBreak($h){
		  if($this->GetY()+$h>$this->PageBreakTrigger)
			 $this->AddPage($this->CurOrientation);
		}

		function NbLines($w, $txt){
		  $cw=&$this->CurrentFont['cw'];
		  if($w==0)
			 $w=$this->w-$this->rMargin-$this->x;
		  $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		  $s=str_replace("\r", '', $txt);
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
	
	}

?>