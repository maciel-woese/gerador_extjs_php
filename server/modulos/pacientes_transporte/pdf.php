<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
if($_GET){
	try {
		require('../../autoLoad.php');
		require('../../lib/pdf/pdf.php');
		$buscar = new Buscar();
		$tabela = 'pacientes_transporte';
		
		$sort = 'id';
		$order = 'ASC';
		
		if(isset($_GET['action']) AND $_GET['action'] == 'FILTER'){
				$buscar->setBusca(array('paciente_id', 'pacientes_transporte.paciente_id'), $_GET['paciente_id']);
				$buscar->setBusca(array('acompanhado', 'pacientes_transporte.acompanhado'), $_GET['acompanhado']);
				$buscar->setBusca(array('local_consulta', 'pacientes_transporte.local_consulta'), $_GET['local_consulta'], 'like');
				$buscar->setBusca(array('hora', 'pacientes_transporte.hora'), $_GET['hora'], 'like');
				$buscar->setBusca(array('fone', 'pacientes_transporte.fone'), $_GET['fone'], 'like');
				$buscar->setBusca(array('obs', 'pacientes_transporte.obs'), $_GET['obs'], 'like');
		}
		
		if (isset($_GET['sort'])){
			$sortJson = json_decode( $_GET['sort'] );
			$sort = trim(rtrim(addslashes($sortJson[0]->property )));
			$order = trim(rtrim(addslashes( $sortJson[0]->direction )));
		}
		
		$filtro = $buscar->getSql();
		
		$pdo = $connection->prepare("
			SELECT pacientes_transporte.*, pacientes.paciente 
			FROM pacientes_transporte INNER JOIN pacientes ON
					(pacientes_transporte.paciente_id=pacientes.id) 
			{$filtro} 
			ORDER BY {$sort} {$order};
		");
		$pdo->execute( $buscar->getArrayExecute() );
		
		$query = $pdo->fetchAll(PDO::FETCH_OBJ);
		
		class pdf extends FPDF_EXTENDED {
			public $width = 31.666666666667;
			public $user = null;
			public $total = 190;
			public $orientation = 'P';
			public $totalLine = 2;
			public $currentLine = 0;
			public $fillCollor = '255,255,255';
			public $textCollor = '0,0,0';
			public $columns = array();
			
			function pdf($orientation){
				parent::__construct($orientation);
				$this->orientation = $orientation;
				if($orientation=='L'){
					$this->totalLine = 3;
				}
			}
			
			function Header(){
				$this->Image("../../../resources/images/logo.png",10,8,25,'PNG');
				$this->SetFont('Arial','B',12);
				$this->Cell($this->total,6,"Relatório de Pacientes Transporte",0,1,'C');
				$this->Ln(11);
				
				$this->SetFont('Arial','B',9);
				$this->getFilter();
				
				$this->Ln(7);
				$this->SetFont('Arial','B',6);
			}
			
			function getFilter(){
				if(isset($_GET['action']) AND $_GET['action'] == 'FILTER'){
					$this->Cell($this->total,6, "Filtros Ultilizados:",'B',1,'C');
					$this->Ln(4);
					$this->getCampo($_GET['paciente_id_nome'], utf8_decode("Paciente"));
					$this->getCampo($_GET['acompanhado'], utf8_decode("Acompanhado"));
					$this->getCampo($_GET['local_consulta'], utf8_decode("Local Consulta"));
					$this->getCampo($_GET['hora'], "Hora");
					$this->getCampo(@mascara('(##) ####-####', $_GET['fone']), utf8_decode("Fone"));
					$this->getCampo($_GET['obs'], utf8_decode("Obs"));
				}
			}
			
			function getCampo($valor, $descricao){
				if(!empty($valor)){
					if($this->currentLine==$this->totalLine){
						$this->Ln(6);
						$this->currentLine = 0;
					}
					else{
						$this->currentLine++;
					}
					$this->Cell(($this->total/3),6, "$descricao: $valor",0,0,'L');
				}
			}
			
			function Footer(){
				$this->SetY(-15);
				$this->SetFont('Arial','I',8);
				$this->Cell(10,10,"","T"); $this->Cell(30,10,date("d/m/Y - H:i:s"),"T",0,'L');
				$this->Cell(0,10,'Página '.$this->PageNo(),"T",0,'R');
			}
		}
	
		$pdf = new pdf('P');
		$pdf->user = $user;
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',8);
		$pdf->Ln(7);
		
		//cabeçalho..
		$col = array();
		$col[] = array('text' => utf8_decode('Paciente'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Acompanhado'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Local Consulta'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Hora'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Fone'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Obs'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
 		
		$pdf->columns[] = $col;
		
		foreach($query as $row){
			$col = array();
			$col[] = array('text' => utf8_decode($row->paciente), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->acompanhado), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->local_consulta), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => $row->hora, 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => @mascara('(##) ####-####', $row->fone), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->obs), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$pdf->columns[] = $col; 		
		}
		
		$pdf->WriteTable($pdf->columns);
		$pdf->Output();
	} 
	catch (PDOException $e) {
		echo $e->getMessage();
	}	
}

?>