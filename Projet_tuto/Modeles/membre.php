<?php
class Membre
{
	private $co;
	private $num_client;
	private $login;
	private $estAdmin;

	public function __construct($co, $num_client, $login)
	{
		$this->co = $co;
		$this->num_client = $num_client;
		$this->login = $login;
		if($this->login=="root")
		{
			$this->estAdmin = true;
		}
		else
		{
			$this->estAdmin = false;
		}
	}

	public function connexion() 
	{
		session_start();
		$_SESSION["login"] = $this->login;
		$_SESSION["estAdmin"] = $this->estAdmin;
	}

	public function deconnexion()
	{
		session_destroy();
		mysqli_close($this->co);
	}
}
?>