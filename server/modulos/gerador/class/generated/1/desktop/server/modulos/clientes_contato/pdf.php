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
		$tabela = 'clientes_contato';
		
		$sort = 'controle';
		$order = 'ASC';
		
		if(isset($_GET['action']) AND $_GET['action'] == 'FILTER'){
				$buscar->setBusca(array('cod_cliente', 'clientes_contato.cod_cliente'), $_GET['cod_cliente']);
				$buscar->setBusca(array('tipo_contato', 'clientes_contato.tipo_contato'), $_GET['tipo_contato'], 'like');
				$buscar->setBusca(array('descricao', 'clientes_contato.descricao'), $_GET['descricao'], 'like');
				$buscar->setBusca(array('observacao', 'clientes_contato.observacao'), $_GET['observacao'], 'like');
		}
		
		if (isset($_GET['sort'])){
			$sortJson = json_decode( $_GET['sort'] );
			$sort = trim(rtrim(addslashes($sortJson[0]->property )));
			$order = trim(rtrim(addslashes( $sortJson[0]->direction )));
		}
		
		$filtro = $buscar->getSql();
		
		$pdo = $connection->prepare("
			SELECT clientes_contato.*, clientes.nome_completo 
			FROM clientes_contato INNER JOIN clientes ON
					(clientes_contato.cod_cliente=clientes.cod_cliente) 
			{$filtro} 
			ORDER BY {$sort} {$order};
		");
		$pdo->execute( $buscar->getArrayExecute() );
		
		$query = $pdo->fetchAll(PDO::FETCH_OBJ);
		
		class pdf extends FPDF_EXTENDED {
			public $width = 47.5;
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
				$this->Cell($this->total,6,"
Notice: Undefined index: title_relatorio in /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/templates_c/715f331b1185c8b18d3b80df428ad55cd2d59eeb.file.pdf.tpl.php on line 161

Call Stack:
    0.0005     475384   1. {main}() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/list.php:0
    2.8308    6827908   2. ExtMVC->init() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/list.php:57
    2.8386    6824828   3. Server->gerarServer() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/gerarCrud.php:95
    2.8409    6827208   4. Server->initPDF() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/modelos/desktop/Server.php:35
    2.8410    6827368   5. Smarty_Internal_TemplateBase->fetch() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/modelos/desktop/Server.php:182
    2.8412    6885328   6. content_52457e128e5e07_63462442() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/sysplugins/smarty_internal_templatebase.php:180


Notice: Trying to get property of non-object in /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/templates_c/715f331b1185c8b18d3b80df428ad55cd2d59eeb.file.pdf.tpl.php on line 161

Call Stack:
    0.0005     475384   1. {main}() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/list.php:0
    2.8308    6827908   2. ExtMVC->init() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/list.php:57
    2.8386    6824828   3. Server->gerarServer() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/gerarCrud.php:95
    2.8409    6827208   4. Server->initPDF() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/modelos/desktop/Server.php:35
    2.8410    6827368   5. Smarty_Internal_TemplateBase->fetch() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/modelos/desktop/Server.php:182
    2.8412    6885328   6. content_52457e128e5e07_63462442() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/sysplugins/smarty_internal_templatebase.php:180

 Clientes_Contato",0,1,'C');
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
					$this->getCampo($_GET['cod_cliente_nome'], utf8_decode("Cliente"));
					$this->getCampo($_GET['tipo_contato'], utf8_decode("Tipo Contato"));
					$this->getCampo($_GET['descricao'], utf8_decode("Descrição"));
					$this->getCampo($_GET['observacao'], utf8_decode("Observação"));
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
				$this->Cell(0,10,'P�gina '.$this->PageNo(),"T",0,'R');
			}
		}
	
		$pdf = new pdf('P');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',8);
		$pdf->Ln(7);
		
		//cabe�alho..
		$col = array();
		$col[] = array('text' => utf8_decode('Cliente'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Tipo Contato'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Descrição'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Observação'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
 		
		$pdf->columns[] = $col;
		
		foreach($query as $row){
			$col = array();
			$col[] = array('text' => utf8_decode($row->nome_completo), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->tipo_contato), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->descricao), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->observacao), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
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