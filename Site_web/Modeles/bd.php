<?php
class Bd
{
	private $host;
	private $user;
	private $passwd;
	private $bdd; 
	private $co;

	public function __construct()
	{
		$this->bdd = "projet_tutore";
		$this->host = "localhost";
		$this->user = "root";
		$this->passswd = "root";
	}

	public function connexion()
	{

		$this->co = mysqli_connect($this->host , $this->user , $this->passswd, $this->bdd) or die("erreur de connexion");
		return $this->co;
	}

	public function deconnexion()
	{
		mysqli_close($this->co);
	}
}
?>