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
		$tabela = 'entrada_medicamento';
		
		$sort = 'id';
		$order = 'ASC';
		
		$buscar->setBusca(array('id', 'entrada_medicamento.id'), $_GET['id']);
		$filtro = $buscar->getSql();
		
		$pdo = $connection->prepare("
			SELECT entrada_medicamento.*, '' as medicamentos,
				DATE_FORMAT(entrada_medicamento.data_cadastro, '%d/%m/%Y %H:%i:%s') as data_cadastro, 
				usuarios.nome, fornecedor.fornecedor 
			FROM entrada_medicamento 
			INNER JOIN usuarios ON
					(entrada_medicamento.usuario_id=usuarios.id) 
			INNER JOIN fornecedor ON
					(entrada_medicamento.fornecedor_id=fornecedor.id) 
			{$filtro}
		");
		
		$pdo->execute($buscar->getArrayExecute());
		$itens = array();
		if($pdo->rowCount()>0){
			$pdo2 = $connection->prepare("
				SELECT medicamento.*, entrada_produtos.quantidade
				FROM entrada_produtos 
				INNER JOIN medicamento ON
					(entrada_produtos.medicamento_id=medicamento.id) 
				INNER JOIN entrada_medicamento ON
					(entrada_medicamento.id=entrada_produtos.entrada_id) 
				{$filtro}
			");
			
			$pdo2->execute($buscar->getArrayExecute());
			$itens = $pdo2->fetchAll(PDO::FETCH_OBJ);
		}
		
		$query = $pdo->fetch(PDO::FETCH_OBJ);
		$query->medicamentos = $itens;
		
		class pdf extends FPDF_EXTENDED {
			public $width = 63.3;
			public $user = null;
			public $total = 190;
			public $orientation = 'P';
			public $totalLine = 2;
			public $currentLine = 0;
			public $fillCollor = '255,255,255';
			public $textCollor = '0,0,0';
			public $columns = array();
			public $dados = null;
			
			function pdf($orientation, $query){
				parent::__construct($orientation);
				$this->dados = $query;
				$this->orientation = $orientation;
				if($orientation=='L'){
					$this->totalLine = 3;
				}
			}
			
			function Header(){
				$this->Image("../../../resources/images/logo.png",10,8,25,'PNG');
				$this->SetFont('Arial','B',12);
				$this->Cell($this->total,6,"Relatório de Entrada de Medicamento",0,1,'C');
				$this->Ln(7);
				$this->SetFont('Arial','B',9);
				$this->Cell($this->total,6,$this->user->filial_nome,0,1,'C');
				$this->Ln(11);
				
				$this->SetFont('Arial','B',9);
				//$this->getFilter();
				
				$this->Ln(7);
				$this->SetFont('Arial','B',8);
				
				$this->Cell(95,6, "Data Cadastro: {$this->dados->data_cadastro}",0,0,'L');
				$this->Cell(95,6, "Usuário: {$this->dados->nome}",0,0,'L');
				$this->Ln(7);
				$this->Cell(95,6, "Fornecedor: {$this->dados->fornecedor}",0,0,'L');
				$this->Cell(95,6, "Nota: {$this->dados->nota}",0,0,'L');
				$this->Ln(8);
				
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
	
		$pdf = new pdf('P', $query);
		$pdf->user = $user;
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',8);
		$pdf->Ln(7);
		
		//cabeçalho..
		$col = array();
		$col[] = array('text' => utf8_decode('Codigo'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Medicamento'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Quantidade'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
 		
		$pdf->columns[] = $col;
		
		foreach($query->medicamentos as $row){
			$col = array();
			$col[] = array('text' => $row->codigo_barras, 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->medicamento), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->quantidade), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
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