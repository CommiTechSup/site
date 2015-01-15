<?php 
	$path = __DIR__;
	$path = substr($path, 0, -5);
	$path .= "config/bdd.conf.json";
	define("CONFIG", $path);
	if (file_exists($path)) {
		$array = json_decode(file_get_contents($path));
		define("DBDRIVER", $array->{'bdd'}->{'driver'});
		define("DBHOST", $array->{'bdd'}->{'host'});
		define("DBUSER", $array->{'bdd'}->{'user'});
		define("DBPASSWORD", $array->{'bdd'}->{'password'});
		define("DBNAME", $array->{'bdd'}->{'database'});
	}
	class Connexion{
		private $_connexion;
		public function __construct(){
			try
			{
				
			    @$connexion = new PDO(''.DBDRIVER.':host='.DBHOST.';dbname='.DBNAME.'', DBUSER, DBPASSWORD);
			    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    $this->_connexion = $connexion;
			}
			catch(Exception $e)
			{
				echo 'Erreur : '.$e->getMessage().'<br />';
				echo 'N° : '.$e->getCode();
				echo '<div class="alert alert-danger"><strong>Warning!</strong> Database is not configured please watch : "'.CONFIG.'"</div>';
				die();
			}
		}

		public function getConnexion(){
			return $this->_connexion;
		}
	}	