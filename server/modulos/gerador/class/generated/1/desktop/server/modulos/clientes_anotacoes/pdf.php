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
		$tabela = 'clientes_anotacoes';
		
		$sort = 'controle';
		$order = 'ASC';
		
		if(isset($_GET['action']) AND $_GET['action'] == 'FILTER'){
				$buscar->setBusca(array('cod_cliente', 'clientes_anotacoes.cod_cliente'), $_GET['cod_cliente']);
				$buscar->setBusca(array('anotacao', 'clientes_anotacoes.anotacao'), $_GET['anotacao'], 'like');
				$buscar->setBusca(array('cadastrado_por', 'clientes_anotacoes.cadastrado_por'), $_GET['cadastrado_por']);
				$buscar->setBusca(array('data_cadastro', 'clientes_anotacoes.data_cadastro'), implode('-', array_reverse(explode('/', $_GET['data_cadastro_date'])))." ".$_GET['data_cadastro_time'], 'like');
				$buscar->setBusca(array('ativo', 'clientes_anotacoes.ativo'), $_GET['ativo'], 'like');
		}
		
		if (isset($_GET['sort'])){
			$sortJson = json_decode( $_GET['sort'] );
			$sort = trim(rtrim(addslashes($sortJson[0]->property )));
			$order = trim(rtrim(addslashes( $sortJson[0]->direction )));
		}
		
		$filtro = $buscar->getSql();
		
		$pdo = $connection->prepare("
			SELECT clientes_anotacoes.*, 
					DATE_FORMAT(clientes_anotacoes.data_cadastro, '%H:%i:%s') as data_cadastro_time, 
					DATE_FORMAT(clientes_anotacoes.data_cadastro, '%Y-%m-%d') as data_cadastro_date, clientes.nome_completo 
			FROM clientes_anotacoes INNER JOIN clientes ON
					(clientes_anotacoes.cod_cliente=clientes.cod_cliente) 
			{$filtro} 
			ORDER BY {$sort} {$order};
		");
		$pdo->execute( $buscar->getArrayExecute() );
		
		$query = $pdo->fetchAll(PDO::FETCH_OBJ);
		
		class pdf extends FPDF_EXTENDED {
			public $width = 38;
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
    2.2681    6641972   2. ExtMVC->init() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/list.php:57
    2.8276    6833272   3. Server->gerarServer() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/gerarCrud.php:95
    2.8296    6833148   4. Server->initPDF() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/modelos/desktop/Server.php:35
    2.8298    6833308   5. Smarty_Internal_TemplateBase->fetch() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/modelos/desktop/Server.php:182
    2.8299    6891600   6. content_52457e128e5e07_63462442() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/sysplugins/smarty_internal_templatebase.php:180


Notice: Trying to get property of non-object in /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/templates_c/715f331b1185c8b18d3b80df428ad55cd2d59eeb.file.pdf.tpl.php on line 161

Call Stack:
    0.0005     475384   1. {main}() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/list.php:0
    2.2681    6641972   2. ExtMVC->init() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/list.php:57
    2.8276    6833272   3. Server->gerarServer() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/gerarCrud.php:95
    2.8296    6833148   4. Server->initPDF() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/modelos/desktop/Server.php:35
    2.8298    6833308   5. Smarty_Internal_TemplateBase->fetch() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/modelos/desktop/Server.php:182
    2.8299    6891600   6. content_52457e128e5e07_63462442() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/sysplugins/smarty_internal_templatebase.php:180

 Clientes_Anotacoes",0,1,'C');
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
					$this->getCampo($_GET['anotacao'], utf8_decode("Anotação"));
					$this->getCampo($_GET['cadastrado_por'], utf8_decode("Cadastrado Por"));
					$this->getCampo($_GET['data_cadastro_date']." ".$_GET['data_cadastro_time'], "Data Cadastro");
					$this->getCampo($_GET['ativo'], utf8_decode("Ativo"));
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
		$col[] = array('text' => utf8_decode('Anotação'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Cadastrado Por'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Data Cadastro'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Ativo'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
 		
		$pdf->columns[] = $col;
		
		foreach($query as $row){
			$col = array();
			$col[] = array('text' => utf8_decode($row->nome_completo), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->anotacao), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->cadastrado_por), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => @implode('/', array_reverse(explode('-', $row->data_cadastro_date)))." ".$row->data_cadastro_time, 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->ativo), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
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