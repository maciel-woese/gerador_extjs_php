<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:31
         compiled from "class/smarty/templates/padrao/server/pdf.tpl" */ ?>
<?php /*%%SmartyHeaderCode:98371598951d18a17c120b4-79843898%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '50248a88ba2a77307a6edad87ed46c321d13b936' => 
    array (
      0 => 'class/smarty/templates/padrao/server/pdf.tpl',
      1 => 1352468859,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '98371598951d18a17c120b4-79843898',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'TABELA' => 0,
    'CHAVE' => 0,
    'campos' => 0,
    'field' => 0,
    'select_fields' => 0,
    'select_from' => 0,
    'filtro' => 0,
    'sort' => 0,
    'order' => 0,
    'width' => 0,
    'total' => 0,
    'title_relatorio' => 0,
    'columns' => 0,
    'orientation' => 0,
    'f' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a17e4ca83_13039320',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a17e4ca83_13039320')) {function content_51d18a17e4ca83_13039320($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><<?php ?>?php
<?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>
if($_GET){
	try {
		require('../../autoLoad.php');
		require('../../lib/pdf/pdf.php');
		$buscar = new Buscar();
		$tabela = '<?php echo $_smarty_tpl->tpl_vars['TABELA']->value;?>
';
		
		$sort = '<?php echo $_smarty_tpl->tpl_vars['CHAVE']->value;?>
';
		$order = 'ASC';
		
		if(isset($_GET['action']) AND $_GET['action'] == 'FILTER'){
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['campos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['tipo']=='number'){?>
				$buscar->setBusca(array('<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
', '<?php echo $_smarty_tpl->tpl_vars['field']->value['tabela'];?>
.<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'), $_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
']);
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['tipo']=='text'){?>
				$buscar->setBusca(array('<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
', '<?php echo $_smarty_tpl->tpl_vars['field']->value['tabela'];?>
.<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'), $_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'], 'like');
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['tipo']=='combo'){?>
				$buscar->setBusca(array('<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
', '<?php echo $_smarty_tpl->tpl_vars['field']->value['tabela'];?>
.<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'), $_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
']);
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['tipo']=='date'){?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['format']=='datetime'){?>
				$buscar->setBusca(array('<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
', '<?php echo $_smarty_tpl->tpl_vars['field']->value['tabela'];?>
.<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'), implode('-', array_reverse(explode('/', $_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_date'])))." ".$_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
_time'], 'like');
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['format']=='date'){?>
				$buscar->setBusca(array('<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
', '<?php echo $_smarty_tpl->tpl_vars['field']->value['tabela'];?>
.<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'), implode('-', array_reverse(explode('/', $_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
']))), 'like');
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['format']=='time'){?>
				$buscar->setBusca(array('<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
', '<?php echo $_smarty_tpl->tpl_vars['field']->value['tabela'];?>
.<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'), $_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['nome'];?>
'], 'like');
<?php }?>
<?php }?>
<?php } ?>
		}
		
		if (isset($_GET['sort'])){
			$sortJson = json_decode( $_GET['sort'] );
			$sort = trim(rtrim(addslashes($sortJson[0]->property )));
			$order = trim(rtrim(addslashes( $sortJson[0]->direction )));
		}
		
		$filtro = $buscar->getSql();
		
		$pdo = $connection->prepare("
			SELECT <?php echo $_smarty_tpl->tpl_vars['select_fields']->value;?>
 
			FROM <?php echo $_smarty_tpl->tpl_vars['select_from']->value;?>
 
			<?php echo $_smarty_tpl->tpl_vars['filtro']->value;?>
 
			ORDER BY <?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['order']->value;?>
;
		");
		$pdo->execute( $buscar->getArrayExecute() );
		
		$query = $pdo->fetchAll(PDO::FETCH_OBJ);
		
		class pdf extends FPDF_EXTENDED {
			public $width = <?php echo $_smarty_tpl->tpl_vars['width']->value;?>
;
			public $total = <?php echo $_smarty_tpl->tpl_vars['total']->value;?>
;
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
				$this->Cell($this->total,6,"<?php echo $_smarty_tpl->tpl_vars['title_relatorio']->value;?>
 <?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['TABELA']->value);?>
",0,1,'C');
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
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['columns']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['hidden']!=true){?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['mask']=='cpf'){?>
					$this->getCampo(@mascara('###.###.###-##', $_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndexPDF'];?>
']), utf8_decode("<?php echo $_smarty_tpl->tpl_vars['field']->value['title'];?>
"));
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['mask']=='cep'){?>
					$this->getCampo(@mascara('##.###-###', $_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndexPDF'];?>
']), utf8_decode("<?php echo $_smarty_tpl->tpl_vars['field']->value['title'];?>
"));
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['mask']=='fone'){?>
					$this->getCampo(@mascara('(##) ####-####', $_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndexPDF'];?>
']), utf8_decode("<?php echo $_smarty_tpl->tpl_vars['field']->value['title'];?>
"));
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['mask']=='cnpj'){?>
					$this->getCampo(@mascara('##.###.###/####-##', $_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndexPDF'];?>
']), utf8_decode("<?php echo $_smarty_tpl->tpl_vars['field']->value['title'];?>
"));
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['mask']=='money'){?>
					$this->getCampo(@number_format($_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndexPDF'];?>
'],2,',','.'), utf8_decode("<?php echo $_smarty_tpl->tpl_vars['field']->value['title'];?>
"));
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['mask']==''){?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['dataIndexPDF']!=$_smarty_tpl->tpl_vars['field']->value['dataIndex']){?>
					$this->getCampo($_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndexPDF'];?>
_nome'], utf8_decode("<?php echo $_smarty_tpl->tpl_vars['field']->value['title'];?>
"));
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['dataIndexPDF']==$_smarty_tpl->tpl_vars['field']->value['dataIndex']){?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['formatNome']=='datetime'){?>
					$this->getCampo($_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndexPDF'];?>
_date']." ".$_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndexPDF'];?>
_time'], "<?php echo $_smarty_tpl->tpl_vars['field']->value['title'];?>
");
<?php }elseif($_smarty_tpl->tpl_vars['field']->value['formatNome']=='timestamp'){?>
					$this->getCampo($_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndexPDF'];?>
_date']." ".$_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndexPDF'];?>
_time'], "<?php echo $_smarty_tpl->tpl_vars['field']->value['title'];?>
");
<?php }elseif($_smarty_tpl->tpl_vars['field']->value['formatNome']=='date'){?>
					$this->getCampo($_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndexPDF'];?>
'], "<?php echo $_smarty_tpl->tpl_vars['field']->value['title'];?>
");
<?php }elseif($_smarty_tpl->tpl_vars['field']->value['formatNome']=='time'){?>
					$this->getCampo($_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndexPDF'];?>
'], "<?php echo $_smarty_tpl->tpl_vars['field']->value['title'];?>
");
<?php }else{ ?>
					$this->getCampo($_GET['<?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndexPDF'];?>
'], utf8_decode("<?php echo $_smarty_tpl->tpl_vars['field']->value['title'];?>
"));
<?php }?>
<?php }?>
<?php }?>
<?php }?>
<?php } ?>
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
	
		$pdf = new pdf('<?php echo $_smarty_tpl->tpl_vars['orientation']->value;?>
');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',8);
		$pdf->Ln(7);
		
		//cabeçalho..
		$col = array();
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['columns']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['hidden']!=true){?>
		$col[] = array('text' => utf8_decode('<?php echo $_smarty_tpl->tpl_vars['field']->value['title'];?>
'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
<?php }?>
<?php } ?> 		
		$pdf->columns[] = $col;
		
		foreach($query as $row){
			$col = array();
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['columns']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['hidden']!=true){?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['xtype']=='date'){?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['formatNome']=='datetime'){?>
			$col[] = array('text' => @implode('/', array_reverse(explode('-', $row-><?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndex'];?>
_date)))." ".$row-><?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndex'];?>
_time, 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['formatNome']=='timestamp'){?>
			$col[] = array('text' => @implode('/', array_reverse(explode('-', $row-><?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndex'];?>
_date)))." ".$row-><?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndex'];?>
_time, 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['formatNome']=='date'){?>
			$col[] = array('text' => @implode('/', array_reverse(explode('-', $row-><?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndex'];?>
))), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['formatNome']=='time'){?>
			$col[] = array('text' => $row-><?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndex'];?>
, 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
<?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['mask']=='cpf'){?>
			$col[] = array('text' => @mascara('###.###.###-##', $row-><?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndex'];?>
), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['mask']=='cep'){?>
			$col[] = array('text' => @mascara('##.###-###', $row-><?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndex'];?>
), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['mask']=='fone'){?>
			$col[] = array('text' => @mascara('(##) ####-####', $row-><?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndex'];?>
), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['mask']=='cnpj'){?>
			$col[] = array('text' => @mascara('##.###.###/####-##', $row-><?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndex'];?>
), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['mask']=='money'){?>
			$col[] = array('text' => @number_format($row-><?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndex'];?>
,2,',','.'), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['mask']==''&&$_smarty_tpl->tpl_vars['field']->value['xtype']!='date'){?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['renderer']!='false'){?>
			switch($row-><?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndex'];?>
){
<?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['field']->value['renderer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
$_smarty_tpl->tpl_vars['f']->_loop = true;
?>
				case '<?php echo $_smarty_tpl->tpl_vars['f']->value['id'];?>
':
				$row-><?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndex'];?>
 = '<?php echo $_smarty_tpl->tpl_vars['f']->value['descricao'];?>
';
				break;
<?php } ?> 					
			}
<?php }?>
			$col[] = array('text' => utf8_decode($row-><?php echo $_smarty_tpl->tpl_vars['field']->value['dataIndex'];?>
), 'width' => $pdf->width, 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => $pdf->fillCollor, 'textcolor' => $pdf->textCollor, 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
<?php }?>
<?php }?>
<?php } ?>
			$pdf->columns[] = $col; 		
		}
		
		$pdf->WriteTable($pdf->columns);
		$pdf->Output();
	} 
	catch (PDOException $e) {
		echo $e->getMessage();
	}	
}

?<?php ?>><?php }} ?>