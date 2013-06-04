<?php

class Connection extends PDO
{
	private $dsn = 'mysql:dbname=framework;host=127.0.0.1';
	private $user = 'root';
	private $password = '';

	public static $handle = null;

	function __construct()
	{
		try
		{
			if (self::$handle == null)
			{
				$dbh = parent::__construct($this->dsn, $this->user, $this->password);

				parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				//parent::exec("set search_path to trunk");

				self::$handle = $dbh;

				return self::$handle;
			}
		}
		catch(PDOException $e)
		{
			echo '{success: false, msg: "Falha na conexão"}';
			return false;
		}
	}

	function __destruct()
	{
		self::$handle = NULL;
	}

	function pgsqlLastInsertId($connection, $query)
	{
		if(preg_match("/^INSERT[\t\n ]+INTO[\t\n ]+([a-z0-9\_\-]+)/is", $query->queryString, $tabela))
		{
			$query = $connection->prepare("SELECT currval('{$tabela[1]}_id_seq') AS last_value");
			$query->execute();

			if($query)
			{
				$result = $query->fetch(PDO::FETCH_ASSOC);
				return ($result) ? $result['last_value'] : false;
			}
		}

		return false;
	}
}

function getIp()
{

	if (!empty($_SERVER['HTTP_CLIENT_IP']))
	{

		$ip = $_SERVER['HTTP_CLIENT_IP'];

	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	{

		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

	}
	else{

		$ip = $_SERVER['REMOTE_ADDR'];

	}

	return $ip;

}

?>
