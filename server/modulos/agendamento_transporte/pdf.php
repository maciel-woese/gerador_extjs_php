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
		$tabela = 'agendamento_transporte';
		
		$sort = 'id';
		$order = 'ASC';

		$buscar->setBusca(array('id', 'entrada_medicamento.id'), $_GET['id']);
		$filtro = $buscar->getSql();
		
		$pdo = $connection->prepare("
			SELECT agendamento_transporte.*, usuarios.nome, veiculos.veiculo,
			DATE_FORMAT(agendamento_transporte.data, '%d/%m/%Y') as data, 
			'' as pacientes
			FROM agendamento_transporte 
			INNER JOIN usuarios ON (agendamento_transporte.usuario_id=usuarios.id) 
			INNER JOIN veiculos ON (agendamento_transporte.veiculo_id=veiculos.id) 
			{$filtro}
		");
		
		$pdo->execute($buscar->getArrayExecute());
		
		$itens = array();
		if($pdo->rowCount()>0){
			$pdo2 = $connection->prepare("
				SELECT pacientes_transporte.*, pacientes.paciente 
				FROM pacientes_transporte 
				INNER JOIN agendamento_transporte ON (pacientes_transporte.agendamento_transporte_id=agendamento_transporte.id) 
				INNER JOIN pacientes ON	(pacientes_transporte.paciente_id=pacientes.id) 
				{$filtro}
			");
			
			$pdo2->execute($buscar->getArrayExecute());
			$itens = $pdo2->fetchAll(PDO::FETCH_OBJ);
		}
		
		$query = $pdo->fetch(PDO::FETCH_OBJ);
		$query->pacientes = $itens;
		
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
			public $user = array();
			
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
				$this->Cell($this->total,6,"Relatório de Agendamento Transporte",0,1,'C');
				$this->Ln(7);
				$this->SetFont('Arial','B',9);
				$this->Cell($this->total,6,$this->user->filial_nome,0,1,'C');
				$this->Ln(11);
				
				$this->SetFont('Arial','B',9);
				//$this->getFilter();
				
				$this->Ln(7);
				$this->SetFont('Arial','B',8);
				
				$this->Cell(95,6, "Data Saida: {$this->dados->data} {$this->dados->hora_saida}",0,0,'L');
				$this->Cell(95,6, "Usuário: {$this->dados->nome}",0,0,'L');
				$this->Ln(7);
				$this->Cell(95,6, "Veiculo: {$this->dados->veiculo}",0,0,'L');
				$this->Cell(95,6, "Nota: {$this->dados->destino}",0,0,'L');
				$this->Ln(7);
				$this->MultiCell(190,5,"Obs.: {$this->dados->destino}");
				$this->Ln(1);
				
			}
			
			function getFilter(){
				if(isset($_GET['action']) AND $_GET['action'] == 'FILTER'){
					$this->Cell($this->total,6, "Filtros Ultilizados:",'B',1,'C');
					$this->Ln(4);
					$this->getCampo($_GET['data'], "Data");
					$this->getCampo($_GET['hora_saida'], "Hora Saida");
					$this->getCampo($_GET['usuario_id_nome'], utf8_decode("Usuario"));
					$this->getCampo($_GET['veiculo_id_nome'], utf8_decode("Veiculo"));
					$this->getCampo($_GET['destino'], utf8_decode("Destino"));
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