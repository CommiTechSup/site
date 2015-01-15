<?php 

class Evenements{
	private $_connexion;

	public function __construct($connexion){
		$this->_connexion = $connexion;
	}


	public function getEvenements(){

		$sql = $this->_connexion->prepare("SELECT * FROM phpbb_posts natural join phpbb_forums WHERE forum_name LIKE '%nement%'");
		$sql-> execute();
		$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
		return $rows;

	}

	static function resum($chaine, $tailleMax){
        $positionDernierEspace = 0;
        if( strlen($chaine) >= $tailleMax )
        {
            $chaine = substr($chaine,0,$tailleMax);
            $positionDernierEspace = strrpos($chaine,' ');
            $chaine = substr($chaine,0,$positionDernierEspace).'(...)';
        }
        return $chaine;
    }
}