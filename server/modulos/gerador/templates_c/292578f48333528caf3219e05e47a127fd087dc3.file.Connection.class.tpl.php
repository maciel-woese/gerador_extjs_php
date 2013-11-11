<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:11
         compiled from "class/smarty/templates/desktop/server/Connection.class.tpl" */ ?>
<?php /*%%SmartyHeaderCode:91804133152457e13734106-83594213%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '292578f48333528caf3219e05e47a127fd087dc3' => 
    array (
      0 => 'class/smarty/templates/desktop/server/Connection.class.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '91804133152457e13734106-83594213',
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
  'unifunc' => 'content_52457e1379e191_26407124',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e1379e191_26407124')) {function content_52457e1379e191_26407124($_smarty_tpl) {?><<?php ?>?php
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