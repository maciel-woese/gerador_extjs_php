<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/server/Connection.class.tpl" */ ?>
<?php /*%%SmartyHeaderCode:138661466951d18a180aac13-53752381%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '22bd75a3c0e7b9d027743b2c2428ab226430025b' => 
    array (
      0 => 'class/smarty/templates/padrao/server/Connection.class.tpl',
      1 => 1352422465,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '138661466951d18a180aac13-53752381',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'tipo_banco' => 0,
    'banco' => 0,
    'host' => 0,
    'user' => 0,
    'senha' => 0,
    'schema' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a180d1c90_33254228',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a180d1c90_33254228')) {function content_51d18a180d1c90_33254228($_smarty_tpl) {?><<?php ?>?php
<?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>
class Connection extends PDO
{
	private $dsn = '<?php echo $_smarty_tpl->tpl_vars['tipo_banco']->value;?>
:dbname=<?php echo $_smarty_tpl->tpl_vars['banco']->value;?>
;host=<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
';
	private $user = '<?php echo $_smarty_tpl->tpl_vars['user']->value;?>
';
	private $password = '<?php echo $_smarty_tpl->tpl_vars['senha']->value;?>
';

	public static $handle = null;

	function __construct()
	{
		try
		{
			if (self::$handle == null)
			{
				$dbh = parent::__construct($this->dsn, $this->user, $this->password);

				parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
<?php if ($_smarty_tpl->tpl_vars['tipo_banco']->value=='pgsql'){?>
				parent::exec("set search_path to <?php echo $_smarty_tpl->tpl_vars['schema']->value;?>
");
<?php }?>
				self::$handle = $dbh;

				return self::$handle;
			}
		}
		catch(PDOException $e)
		{
			echo '{ success: false, msg: '.$e->getMessage().' }';
			return false;
		}
	}

	function __destruct()
	{
		self::$handle = NULL;
	}

}
?<?php ?>>
<?php }} ?>