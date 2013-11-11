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
		$tabela = 'clientes';
		
		$sort = 'cod_cliente';
		$order = 'ASC';
		
		if(isset($_GET['action']) AND $_GET['action'] == 'FILTER'){
				$buscar->setBusca(array('tipo_cliente', 'clientes.tipo_cliente'), $_GET['tipo_cliente'], 'like');
				$buscar->setBusca(array('nome_completo', 'clientes.nome_completo'), $_GET['nome_completo'], 'like');
				$buscar->setBusca(array('razao_social', 'clientes.razao_social'), $_GET['razao_social'], 'like');
				$buscar->setBusca(array('nome_fantasia', 'clientes.nome_fantasia'), $_GET['nome_fantasia'], 'like');
				$buscar->setBusca(array('pessoa_contato', 'clientes.pessoa_contato'), $_GET['pessoa_contato'], 'like');
				$buscar->setBusca(array('data_nascimento', 'clientes.data_nascimento'), implode('-', array_reverse(explode('/', $_GET['data_nascimento']))), 'like');
				$buscar->setBusca(array('sexo', 'clientes.sexo'), $_GET['sexo'], 'like');
				$buscar->setBusca(array('cpf', 'clientes.cpf'), $_GET['cpf'], 'like');
				$buscar->setBusca(array('cnpj', 'clientes.cnpj'), $_GET['cnpj'], 'like');
				$buscar->setBusca(array('ie', 'clientes.ie'), $_GET['ie'], 'like');
				$buscar->setBusca(array('im', 'clientes.im'), $_GET['im'], 'like');
				$buscar->setBusca(array('identidade', 'clientes.identidade'), $_GET['identidade'], 'like');
				$buscar->setBusca(array('profissao', 'clientes.profissao'), $_GET['profissao'], 'like');
				$buscar->setBusca(array('data_cadastro', 'clientes.data_cadastro'), implode('-', array_reverse(explode('/', $_GET['data_cadastro_date'])))." ".$_GET['data_cadastro_time'], 'like');
				$buscar->setBusca(array('cadastrado_por', 'clientes.cadastrado_por'), $_GET['cadastrado_por'], 'like');
				$buscar->setBusca(array('data_alteracao', 'clientes.data_alteracao'), implode('-', array_reverse(explode('/', $_GET['data_alteracao_date'])))." ".$_GET['data_alteracao_time'], 'like');
				$buscar->setBusca(array('situacao_cadastral', 'clientes.situacao_cadastral'), $_GET['situacao_cadastral'], 'like');
		}
		
		if (isset($_GET['sort'])){
			$sortJson = json_decode( $_GET['sort'] );
			$sort = trim(rtrim(addslashes($sortJson[0]->property )));
			$order = trim(rtrim(addslashes( $sortJson[0]->direction )));
		}
		
		$filtro = $buscar->getSql();
		
		$pdo = $connection->prepare("
			SELECT clientes.*, 
					DATE_FORMAT(clientes.data_cadastro, '%H:%i:%s') as data_cadastro_time, 
					DATE_FORMAT(clientes.data_cadastro, '%Y-%m-%d') as data_cadastro_date, 
					DATE_FORMAT(clientes.data_alteracao, '%H:%i:%s') as data_alteracao_time, 
					DATE_FORMAT(clientes.data_alteracao, '%Y-%m-%d') as data_alteracao_date 
			FROM clientes 
			{$filtro} 
			ORDER BY {$sort} {$order};
		");
		$pdo->execute( $buscar->getArrayExecute() );
		
		$query = $pdo->fetchAll(PDO::FETCH_OBJ);
		
		class pdf extends FPDF_EXTENDED {
			public $width = 16.235294117647;
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
    0.0209    2656632   2. ExtMVC->init() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/list.php:57
    1.4976    6255028   3. Server->gerarServer() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/gerarCrud.php:95
    1.8715    6481172   4. Server->initPDF() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/modelos/desktop/Server.php:35
    1.8717    6480584   5. Smarty_Internal_TemplateBase->fetch() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/modelos/desktop/Server.php:182
    2.2666    6709996   6. content_52457e128e5e07_63462442() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/sysplugins/smarty_internal_templatebase.php:180


Notice: Trying to get property of non-object in /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/templates_c/715f331b1185c8b18d3b80df428ad55cd2d59eeb.file.pdf.tpl.php on line 161

Call Stack:
    0.0005     475384   1. {main}() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/list.php:0
    0.0209    2656632   2. ExtMVC->init() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/list.php:57
    1.4976    6255028   3. Server->gerarServer() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/gerarCrud.php:95
    1.8715    6481172   4. Server->initPDF() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/modelos/desktop/Server.php:35
    1.8717    6480584   5. Smarty_Internal_TemplateBase->fetch() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/modelos/desktop/Server.php:182
    2.2666    6709996   6. content_52457e128e5e07_63462442() /home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/sysplugins/smarty_internal_templatebase.php:180

 Clientes",0,1,'C');
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
					$this->getCampo($_GET['tipo_cliente'], utf8_decode("Tipo Cliente"));
					$this->getCampo($_GET['nome_completo'], utf8_decode("Nome Completo"));
					$this->getCampo($_GET['razao_social'], utf8_decode("Razão Social"));
					$this->getCampo($_GET['nome_fantasia'], utf8_decode("Nome Fantasia"));
					$this->getCampo($_GET['pessoa_contato'], utf8_decode("Pessoa Contato"));
					$this->getCampo($_GET['data_nascimento'], "Data Nascimento");
					$this->getCampo($_GET['sexo'], utf8_decode("Sexo"));
					$this->getCampo(@mascara('###.###.###-##', $_GET['cpf']), utf8_decode("Cpf"));
					$this->getCampo(@mascara('##.###.###/####-##', $_GET['cnpj']), utf8_decode("Cnpj"));
					$this->getCampo($_GET['ie'], utf8_decode("Ie"));
					$this->getCampo($_GET['im'], utf8_decode("Im"));
					$this->getCampo($_GET['identidade'], utf8_decode("Identidade"));
					$this->getCampo($_GET['profissao'], utf8_decode("Profissão"));
					$this->getCampo($_GET['data_cadastro_date']." ".$_GET['data_cadastro_time'], "Data Cadastro");
					$this->getCampo($_GET['cadastrado_por'], utf8_decode("Cadastrado Por"));
					$this->getCampo($_GET['data_alteracao_date']." ".$_GET['data_alteracao_time'], "Data Alteração");
					$this->getCampo($_GET['situacao_cadastral'], utf8_decode("Situação Cadastral"));
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
	
		$pdf = new pdf('L');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',8);
		$pdf->Ln(7);
		
		//cabe�alho..
		$col = array();
		$col[] = array('text' => utf8_decode('Tipo Cliente'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Nome Completo'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Razão Social'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Nome Fantasia'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Pessoa Contato'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Data Nascimento'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Sexo'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Cpf'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Cnpj'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Ie'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Im'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Identidade'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Profissão'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Data Cadastro'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Cadastrado Por'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Data Alteração'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Situação Cadastral'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
 		
		$pdf->columns[] = $col;
		
		foreach($query as $row){
			$col = array();
			switch($row->tipo_cliente){
				case 'F':
				$row->tipo_cliente = 'Fisica';
				break;
				case 'J':
				$row->tipo_cliente = 'Juridica';
				break;
 					
			}
			$col[] = array('text' => utf8_decode($row->tipo_cliente), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->nome_completo), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->razao_social), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->nome_fantasia), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->pessoa_contato), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => @implode('/', array_reverse(explode('-', $row->data_nascimento))), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			switch($row->sexo){
				case 'M':
				$row->sexo = 'Masculino';
				break;
				case 'F':
				$row->sexo = 'Feminino';
				break;
 					
			}
			$col[] = array('text' => utf8_decode($row->sexo), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => @mascara('###.###.###-##', $row->cpf), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => @mascara('##.###.###/####-##', $row->cnpj), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->ie), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->im), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->identidade), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->profissao), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => @implode('/', array_reverse(explode('-', $row->data_cadastro_date)))." ".$row->data_cadastro_time, 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->cadastrado_por), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => @implode('/', array_reverse(explode('-', $row->data_alteracao_date)))." ".$row->data_alteracao_time, 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->situacao_cadastral), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
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