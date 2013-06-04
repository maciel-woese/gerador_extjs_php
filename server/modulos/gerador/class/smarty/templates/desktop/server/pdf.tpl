<?php
{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}
if($_GET){
	try {
		require('../../autoLoad.php');
		require('../../lib/pdf/pdf.php');
		$buscar = new Buscar();
		$tabela = '{$TABELA}';
		
		$sort = '{$CHAVE}';
		$order = 'ASC';
		
		if(isset($_GET['action']) AND $_GET['action'] == 'FILTER'){
{foreach from=$campos item=field name=foo3}
{if $field.tipo=='number'}
				$buscar->setBusca(array('{$field.nome}', '{$field.tabela}.{$field.nome}'), $_GET['{$field.nome}']);
{/if}
{if $field.tipo=='text'}
				$buscar->setBusca(array('{$field.nome}', '{$field.tabela}.{$field.nome}'), $_GET['{$field.nome}'], 'like');
{/if}
{if $field.tipo=='combo'}
				$buscar->setBusca(array('{$field.nome}', '{$field.tabela}.{$field.nome}'), $_GET['{$field.nome}']);
{/if}
{if $field.tipo=='date'}
{if $field.format=='datetime'}
				$buscar->setBusca(array('{$field.nome}', '{$field.tabela}.{$field.nome}'), implode('-', array_reverse(explode('/', $_GET['{$field.nome}_date'])))." ".$_GET['{$field.nome}_time'], 'like');
{/if}
{if $field.format=='date'}
				$buscar->setBusca(array('{$field.nome}', '{$field.tabela}.{$field.nome}'), implode('-', array_reverse(explode('/', $_GET['{$field.nome}']))), 'like');
{/if}
{if $field.format=='time'}
				$buscar->setBusca(array('{$field.nome}', '{$field.tabela}.{$field.nome}'), $_GET['{$field.nome}'], 'like');
{/if}
{/if}
{/foreach}
		}
		
		if (isset($_GET['sort'])){
			$sortJson = json_decode( $_GET['sort'] );
			$sort = trim(rtrim(addslashes($sortJson[0]->property )));
			$order = trim(rtrim(addslashes( $sortJson[0]->direction )));
		}
		
		$filtro = $buscar->getSql();
		
		$pdo = $connection->prepare("
			SELECT {$select_fields} 
			FROM {$select_from} 
			{$filtro} 
			ORDER BY {$sort} {$order};
		");
		$pdo->execute( $buscar->getArrayExecute() );
		
		$query = $pdo->fetchAll(PDO::FETCH_OBJ);
		
		class pdf extends FPDF_EXTENDED {
			public $width = {$width};
			public $total = {$total};
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
				$this->Cell($this->total,6,"{$title_relatorio} {$TABELA|capitalize}",0,1,'C');
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
{foreach from=$columns item=field name=columns}
{if $field.hidden != true}
{if $field.mask == 'cpf'}
					$this->getCampo(@mascara('###.###.###-##', $_GET['{$field.dataIndexPDF}']), utf8_decode("{$field.title}"));
{/if}
{if $field.mask == 'cep'}
					$this->getCampo(@mascara('##.###-###', $_GET['{$field.dataIndexPDF}']), utf8_decode("{$field.title}"));
{/if}
{if $field.mask == 'fone'}
					$this->getCampo(@mascara('(##) ####-####', $_GET['{$field.dataIndexPDF}']), utf8_decode("{$field.title}"));
{/if}
{if $field.mask == 'cnpj'}
					$this->getCampo(@mascara('##.###.###/####-##', $_GET['{$field.dataIndexPDF}']), utf8_decode("{$field.title}"));
{/if}
{if $field.mask == 'money'}
					$this->getCampo(@number_format($_GET['{$field.dataIndexPDF}'],2,',','.'), utf8_decode("{$field.title}"));
{/if}
{if $field.mask == ''}
{if $field.dataIndexPDF != $field.dataIndex}
					$this->getCampo($_GET['{$field.dataIndexPDF}_nome'], utf8_decode("{$field.title}"));
{/if}
{if $field.dataIndexPDF == $field.dataIndex}
{if $field.formatNome=='datetime'}
					$this->getCampo($_GET['{$field.dataIndexPDF}_date']." ".$_GET['{$field.dataIndexPDF}_time'], "{$field.title}");
{else if $field.formatNome=='timestamp'}
					$this->getCampo($_GET['{$field.dataIndexPDF}_date']." ".$_GET['{$field.dataIndexPDF}_time'], "{$field.title}");
{else if $field.formatNome=='date'}
					$this->getCampo($_GET['{$field.dataIndexPDF}'], "{$field.title}");
{else if $field.formatNome=='time'}
					$this->getCampo($_GET['{$field.dataIndexPDF}'], "{$field.title}");
{else}
					$this->getCampo($_GET['{$field.dataIndexPDF}'], utf8_decode("{$field.title}"));
{/if}
{/if}
{/if}
{/if}
{/foreach}
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
	
		$pdf = new pdf('{$orientation}');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',8);
		$pdf->Ln(7);
		
		//cabeçalho..
		$col = array();
{foreach from=$columns item=field name=columns}
{if $field.hidden != true}
		$col[] = array('text' => utf8_decode('{$field.title}'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
{/if}
{/foreach} 		
		$pdf->columns[] = $col;
		
		foreach($query as $row){
			$col = array();
{foreach from=$columns item=field name=columns}
{if $field.hidden != true}
{if $field.xtype=='date'}
{if $field.formatNome=='datetime'}
			$col[] = array('text' => @implode('/', array_reverse(explode('-', $row->{$field.dataIndex}_date)))." ".$row->{$field.dataIndex}_time, 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
{/if}
{if $field.formatNome=='timestamp'}
			$col[] = array('text' => @implode('/', array_reverse(explode('-', $row->{$field.dataIndex}_date)))." ".$row->{$field.dataIndex}_time, 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
{/if}
{if $field.formatNome=='date'}
			$col[] = array('text' => @implode('/', array_reverse(explode('-', $row->{$field.dataIndex}))), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
{/if}
{if $field.formatNome=='time'}
			$col[] = array('text' => $row->{$field.dataIndex}, 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
{/if}
{/if}
{if $field.mask == 'cpf'}
			$col[] = array('text' => @mascara('###.###.###-##', $row->{$field.dataIndex}), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
{/if}
{if $field.mask == 'cep'}
			$col[] = array('text' => @mascara('##.###-###', $row->{$field.dataIndex}), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
{/if}
{if $field.mask == 'fone'}
			$col[] = array('text' => @mascara('(##) ####-####', $row->{$field.dataIndex}), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
{/if}
{if $field.mask == 'cnpj'}
			$col[] = array('text' => @mascara('##.###.###/####-##', $row->{$field.dataIndex}), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
{/if}
{if $field.mask == 'money'}
			$col[] = array('text' => @number_format($row->{$field.dataIndex},2,',','.'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
{/if}
{if $field.mask == '' and $field.xtype != 'date'}
{if $field.renderer != 'false'}
			switch($row->{$field.dataIndex}){
{foreach from=$field.renderer item=f name=col}
				case '{$f.id}':
				$row->{$field.dataIndex} = '{$f.descricao}';
				break;
{/foreach} 					
			}
{/if}
			$col[] = array('text' => utf8_decode($row->{$field.dataIndex}), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
{/if}
{/if}
{/foreach}
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