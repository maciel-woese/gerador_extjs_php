<?php /* Smarty version Smarty-3.1.8, created on 2013-09-13 09:33:56
         compiled from "class/smarty/templates/touch/server/Connection.class.tpl" */ ?>
<?php /*%%SmartyHeaderCode:41514787523306342d69d2-66698904%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f951b7b32c43e8d04649f1e86b0d84aeef4f52a9' => 
    array (
      0 => 'class/smarty/templates/touch/server/Connection.class.tpl',
      1 => 1352427272,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '41514787523306342d69d2-66698904',
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
  'unifunc' => 'content_5233063433edc3_42577740',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5233063433edc3_42577740')) {function content_5233063433edc3_42577740($_smarty_tpl) {?><<?php ?>?php
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