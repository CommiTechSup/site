<?php 

class News{

	private $_connexion;

	public function __construct($connexion){
		$this->_connexion = $connexion;
	}


	public function persist($type, $title, $content){
		$int = $this->type($type);
		$date = date('d/m/Y');
		$sql = $this->_connexion->prepare("INSERT INTO articles (date, type, title, content) 
			VALUES (:date, :type, :title, :content)");
		$sql-> bindParam('type', $int, PDO::PARAM_INT);
		$sql-> bindParam('date', $date, PDO::PARAM_STR);
		$sql-> bindParam('title', $title, PDO::PARAM_STR);
		$sql-> bindParam('content', $content, PDO::PARAM_STR);
		$sql-> execute();
		header('location: news.php');
	}

	public function type($type){
		$ret = "";
		if($type == "Actualité"){
			$ret = 0;
		}else{
			$ret = 1;
		}
		return $ret;
	}

	public function getLastActu(){
		$sql = $this->_connexion->prepare("SELECT * FROM articles WHERE type = 0");
		$sql-> execute();
		$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
		return array_reverse($rows);
	}

	public function getLastEvent(){
		$sql = $this->_connexion->prepare("SELECT * FROM articles WHERE type = 1");
		$sql-> execute();
		$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
		return array_reverse($rows);
	}

	public function getAllNews(){
		$sql = $this->_connexion->prepare("SELECT * FROM articles");
		$sql-> execute();
		$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
		return array_reverse($rows);
	}

	public function getNewsById($id){
		$sql = $this->_connexion->prepare("SELECT * FROM articles WHERE id_article = :id");
		$sql-> bindParam('id', $id, PDO::PARAM_INT);
		$sql-> execute();
		$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}

	public function updateNews($id, $type, $title, $content){
		$int = $this->type($type);
		$sql = $this->_connexion->prepare("UPDATE articles 
			SET type = :type, title = :title, content = :content 
			WHERE id_article = :id");
		$sql-> bindParam('type', $int, PDO::PARAM_INT);
		$sql-> bindParam('id', $id, PDO::PARAM_INT);
		$sql-> bindParam('title', $title, PDO::PARAM_STR);
		$sql-> bindParam('content', $content, PDO::PARAM_STR);
		$sql-> execute();
		echo '
			<script type="text/javascript">
                window.location.href="./";
			</script>
		 ';
	}

	public function deleteNews($id){
		$sql = $this->_connexion->prepare("DELETE FROM articles WHERE id_article = :id");
		$sql-> bindParam('id', $id, PDO::PARAM_INT);
		$sql-> execute();
	}

}