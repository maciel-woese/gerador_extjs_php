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
		$tabela = 'pacientes';
		
		$sort = 'id';
		$order = 'ASC';
		
		if(isset($_GET['action']) AND $_GET['action'] == 'FILTER'){
				$buscar->setBusca(array('data_cadastro', 'pacientes.data_cadastro'), implode('-', array_reverse(explode('/', $_GET['data_cadastro_date']))), 'like');
				$buscar->setBusca(array('paciente', 'pacientes.paciente'), $_GET['paciente'], 'like');
				$buscar->setBusca(array('data_nascimento', 'pacientes.data_nascimento'), implode('-', array_reverse(explode('/', $_GET['data_nascimento']))), 'like');
				$buscar->setBusca(array('sexo', 'pacientes.sexo'), $_GET['sexo'], 'like');
				$buscar->setBusca(array('tipo_sanguineo', 'pacientes.tipo_sanguineo'), $_GET['tipo_sanguineo'], 'like');
				$buscar->setBusca(array('rg', 'pacientes.rg'), $_GET['rg'], 'like');
				$buscar->setBusca(array('cpf', 'pacientes.cpf'), $_GET['cpf'], 'like');
				$buscar->setBusca(array('uf_id', 'pacientes.uf_id'), $_GET['uf_id']);
				$buscar->setBusca(array('cidade_id', 'pacientes.cidade_id'), $_GET['cidade_id']);
				$buscar->setBusca(array('bairro', 'pacientes.bairro'), $_GET['bairro'], 'like');
				$buscar->setBusca(array('endereco', 'pacientes.endereco'), $_GET['endereco'], 'like');
				$buscar->setBusca(array('cep', 'pacientes.cep'), $_GET['cep'], 'like');
				$buscar->setBusca(array('trabalho', 'pacientes.trabalho'), $_GET['trabalho'], 'like');
				$buscar->setBusca(array('telefone', 'pacientes.telefone'), $_GET['telefone'], 'like');
				$buscar->setBusca(array('pai', 'pacientes.pai'), $_GET['pai'], 'like');
				$buscar->setBusca(array('mae', 'pacientes.mae'), $_GET['mae'], 'like');
				$buscar->setBusca(array('obs', 'pacientes.obs'), $_GET['obs'], 'like');
				$buscar->setBusca(array('status', 'pacientes.status'), $_GET['status'], 'like');
		}
		
		if (isset($_GET['sort'])){
			$sortJson = json_decode( $_GET['sort'] );
			$sort = trim(rtrim(addslashes($sortJson[0]->property )));
			$order = trim(rtrim(addslashes( $sortJson[0]->direction )));
		}
		
		$filtro = $buscar->getSql();
		
		$pdo = $connection->prepare("
			SELECT pacientes.*, 
					DATE_FORMAT(pacientes.data_cadastro, '%H:%i:%s') as data_cadastro_time, 
					DATE_FORMAT(pacientes.data_cadastro, '%Y-%m-%d') as data_cadastro_date, estados.descricao, cidades.cidade 
			FROM pacientes INNER JOIN estados ON
					(pacientes.uf_id=estados.id) INNER JOIN cidades ON
					(pacientes.cidade_id=cidades.id) 
			{$filtro} 
			ORDER BY {$sort} {$order};
		");
		$pdo->execute( $buscar->getArrayExecute() );
		
		$query = $pdo->fetchAll(PDO::FETCH_OBJ);
		
		class pdf extends FPDF_EXTENDED {
			public $width = 39.42;
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
				$this->Cell($this->total,6,"Relatório de Pacientes",0,1,'C');
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
					$this->getCampo($_GET['data_cadastro_date'], "Data Cadastro");
					$this->getCampo($_GET['paciente'], utf8_decode("Paciente"));
					$this->getCampo($_GET['data_nascimento'], "Data Nascimento");
					$this->getCampo($_GET['sexo'], utf8_decode("Sexo"));
					$this->getCampo($_GET['tipo_sanguineo'], utf8_decode("Tipo Sanguineo"));
					$this->getCampo($_GET['rg'], utf8_decode("Rg"));
					$this->getCampo(@mascara('###.###.###-##', $_GET['cpf']), utf8_decode("Cpf"));
					$this->getCampo($_GET['uf_id_nome'], utf8_decode("Estado"));
					$this->getCampo($_GET['cidade_id_nome'], utf8_decode("Cidade"));
					$this->getCampo($_GET['bairro'], utf8_decode("Bairro"));
					$this->getCampo($_GET['endereco'], utf8_decode("Endereco"));
					$this->getCampo(@mascara('##.###-###', $_GET['cep']), utf8_decode("Cep"));
					$this->getCampo($_GET['trabalho'], utf8_decode("Trabalho"));
					$this->getCampo(@mascara('(##) ####-####', $_GET['telefone']), utf8_decode("Telefone"));
					$this->getCampo($_GET['pai'], utf8_decode("Pai"));
					$this->getCampo($_GET['mae'], utf8_decode("Mae"));
					$this->getCampo($_GET['obs'], utf8_decode("Obs"));
					$this->getCampo($_GET['status'], utf8_decode("Status"));
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
		$col[] = array('text' => utf8_decode('Paciente'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Tipo Sanguineo'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Cpf'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Bairro'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Endereco'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Trabalho'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		$col[] = array('text' => utf8_decode('Telefone'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
		
		$pdf->columns[] = $col;
		
		foreach($query as $row){
			$col = array();
			$col[] = array('text' => utf8_decode($row->paciente), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->tipo_sanguineo), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => @mascara('###.###.###-##', $row->cpf), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->bairro), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->endereco), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => utf8_decode($row->trabalho), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			$col[] = array('text' => @mascara('(##) ####-####', $row->telefone), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
			
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