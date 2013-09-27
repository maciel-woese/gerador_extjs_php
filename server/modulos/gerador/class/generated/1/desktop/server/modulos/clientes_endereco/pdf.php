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
		$tabela = 'clientes_endereco';
		
		$sort = 'controle';
		$order = 'ASC';
		
		if(isset($_GET['action']) AND $_GET['action'] == 'FILTER'){
				$buscar->setBusca(array('cod_cliente', 'clientes_endereco.cod_cliente'), $_GET['cod_cliente']);
				$buscar->setBusca(array('estado', 'clientes_endereco.estado'), $_GET['estado']);
				$buscar->setBusca(array('cidade', 'clientes_endereco.cidade'), $_GET['cidade']);
				$buscar->setBusca(array('bairro', 'clientes_endereco.bairro'), $_GET['bairro']);
				$buscar->setBusca(array('logradouro', 'clientes_endereco.logradouro'), $_GET['logradouro'], 'like');
				$buscar->setBusca(array('num_end', 'clientes_endereco.num_end'), $_GET['num_end'], 'like');
				$buscar->setBusca(array('complemento', 'clientes_endereco.complemento'), $_GET['complemento'], 'like');
				$buscar->setBusca(array('cep', 'clientes_endereco.cep'), $_GET['cep'], 'like');
				$buscar->setBusca(array('cx_postal', 'clientes_endereco.cx_postal'), $_GET['cx_postal'], 'like');
		}
		
		if (isset($_GET['sort'])){
			$sortJson = json_decode( $_GET['sort'] );
			$sort = trim(rtrim(addslashes($sortJson[0]->property )));
			$order = trim(rtrim(addslashes( $sortJson[0]->direction )));
		}
		
		$filtro = $buscar->getSql();
		
		$pdo = $connection->prepare("
			SELECT clientes_endereco.*, clientes.nome_completo, correios_estados.descricao, correios_cidades.loc_nome, correios_bairros.bairro_nome 
			FROM clientes_endereco INNER JOIN clientes ON
					(clientes_endereco.cod_cliente=clientes.cod_cliente) INNER JOIN correios_estados ON
					(clientes_endereco.estado=correios_estados.id) INNER JOIN correios_cidades ON
					(clientes_endereco.cidade=correios_cidades.id) INNER JOIN correios_bairros ON
					(clientes_endereco.bairro=correios_bairros.id) 
			{$filtro} 
			ORDER BY {$sort} {$order};
		");
		$pdo->execute( $buscar->getArrayExecute() );
		
		$query = $pdo->fetchAll(PDO::FETCH_OBJ);
		
		class pdf extends FPDF_EXTENDED {
			public $width = 30.666666666667;
			public $total = 276;
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
    2.8420    6822452   2. ExtMVC->init() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/list.php:57
    2.8529    6860744   3. Server->gerarServer() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/gerarCrud.php:95
    2.8554    6865644   4. Server->initPDF() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/modelos/desktop/Server.php:35
    2.8555    6863980   5. Smarty_Internal_TemplateBase->fetch() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/modelos/desktop/Server.php:182
    2.8556    6921944   6. content_52457e128e5e07_63462442() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/sysplugins/smarty_internal_templatebase.php:180


Notice: Trying to get property of non-object in /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/templates_c/715f331b1185c8b18d3b80df428ad55cd2d59eeb.file.pdf.tpl.php on line 161

Call Stack:
    0.0005     475384   1. {main}() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/list.php:0
    2.8420    6822452   2. ExtMVC->init() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/list.php:57
    2.8529    6860744   3. Server->gerarServer() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/gerarCrud.php:95
    2.8554    6865644   4. Server->initPDF() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/modelos/desktop/Server.php:35
    2.8555    6863980   5. Smarty_Internal_TemplateBase->fetch() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/modelos/desktop/Server.php:182
    2.8556    6921944   6. content_52457e128e5e07_63462442() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/sysplugins/smarty_internal_templatebase.php:180

 Clientes_Endereco",0,1,'C');
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
					$this->getCampo($_GET['estado_nome'], utf8_decode("Estado"));
					$this->getCampo($_GET['cidade_nome'], utf8_decode("Cidade"));
					$this->getCampo($_GET['bairro_nome'], utf8_decode("Bairro"));
					$this->getCampo($_GET['logradouro'], utf8_decode("Logradouro"));
					$this->getCampo($_GET['num_end'], utf8_decode("Num End"));
					$this->getCampo($_GET['complemento'], utf8_decode("Complemento"));
					$this->getCampo(@mascara('##.###-###', $_GET['cep']), utf8_decode("Cep"));
					$this->getCampo($_GET['cx_postal'], utf8_decode("Cx Postal"));
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
	
		$pdf = new pdf('L');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',8);
		$pdf->Ln(7);
		
		//cabeçalho..
		$col = array();
		$col[] = array('text' => utf8_decode('Cliente'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Estado'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Cidade'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Bairro'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Logradouro'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Num End'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Complemento'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Cep'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Cx Postal'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
 		
		$pdf->columns[] = $col;
		
		foreach($query as $row){
			$col = array();
			$col[] = array('text' => utf8_decode($row->nome_completo), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->descricao), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->loc_nome), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->bairro_nome), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->logradouro), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->num_end), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->complemento), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => @mascara('##.###-###', $row->cep), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->cx_postal), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
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