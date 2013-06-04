<?php
{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}
class Connection extends PDO
{
	private $dsn = '{$tipo_banco}:dbname={$banco};host={$host}';
	private $user = '{$user}';
	private $password = '{$senha}';

	public static $handle = null;

	function __construct()
	{
		try
		{
			if (self::$handle == null)
			{
				$dbh = parent::__construct($this->dsn, $this->user, $this->password);

				parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
{if $tipo_banco=='pgsql'}
				parent::exec("set search_path to {$schema}");
{/if}
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
?>
