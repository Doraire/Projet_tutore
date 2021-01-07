<?php
class Bd
{
	private $host;
	private $user;
	private $passwd;
	private $bdd; 
	private $co;

	function __construct(){
		$this->bdd = "projet_tuto";
		$this->host = "localhost";
		$this->user = "root";
		$this->passwd = "root";	
	}

	public function connexion()
	{

		$this->co = mysqli_connect($this->host , $this->user , $this->passwd, $this->bdd) or die("erreur de connexion");
		return $this->co;
	}

	public function deconnexion()
	{
		mysqli_close($this->co);
	}
}
?>
