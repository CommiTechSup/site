<!DOCTYPE html>
<html lang="fr">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>CommItechSup</title>

    <!-- Custom CSS -->
    <link href="bootstrap/css/scrolling-nav.css" rel="stylesheet">
     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">   
    <!-- CSS Perso -->
    <link href="bootstrap/css/style.css" rel="stylesheet">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="ckeditor/ckeditor.js"></script>
</head>

<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<?php 
    require_once('class/connexion.class.php');
    require_once('class/news.class.php');

    $connexion = new Connexion();
    $news = new News($connexion->getConnexion());


?>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">CommItechSup</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="./"><div id="mini-logo"><img src="img/asso-mini.png" alt="CommItechSup"/></div></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li>
                        <a href="news.php">Nouvelle news</a>
                    </li>
                    <li>
                        <a href="news-list.php">Liste des news</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<div class="container">
    <?php 
        if($_GET['article'] && $news->getNewsById($_GET['article'])){
          $article = $news->getNewsById($_GET['article']);
        }else{
          header('location: news-list.php');
        }
        // var_dump($article);
        $dir    = 'uploads';
            if (!is_dir($dir))
              mkdir($dir);

            $gallery = scandir($dir);
            $gallery_list = array();
            $cpt = 0;
            foreach ($gallery as $value) {
              if ($value != '.' && $value !='..') {
                  $gallery_list[$cpt]['image'] = 'uploads/'.$value;              
                  $gallery_list[$cpt]['thumb'] = '../../../../uploads/'.$value;    
                  $cpt++;          
              }
            }
            $json = json_encode($gallery_list);  
            $fp = fopen('images_list.json', 'w');
            fwrite($fp, $json);
            fclose($fp);
    ?>
    <section id="section-1" class="intro-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 id="logo"><img src="img/asso.png" alt="CommItechSup"/></h1>
                </div>
            </div>          
        </div>
    </section>
   <form method="post">
        <div class="container">
            <div class="col-md-8">
                <div class="form-group row">
                  <label class="control-label">Type de news</label>
                  <select  id="news-type" name="news-type" required>
                    <option></option>
                    <?php 
                      if ($article[0]['type'] == 0) {
                       echo '<option selected="selected">Actualité</option><option>Evenement</option>';
                      }else{
                        echo '<option>Actualité</option><option selected="selected">Evenement</option>';
                      }
                    ?>
                  </select>
                </div>
            </div>
        </div>
        <div class="container">
             <div class="col-md-8">
                <div class="form-group row">
                  <label class="control-label">Titre</label>
                  <input type="text" class="form-control" name="title" value="<?php echo $article[0]['title']; ?>" required>
                </div>
            </div>
        </div>
        <div class="container">
            
              <textarea name="editor1" id="editor1" rows="100" cols="80" required>
                  <?php echo $article[0]['content']; ?>
              </textarea>
              <script>

                  // Replace the <textarea id="editor1"> with a CKEditor
                  // instance, using default configuration.
                  CKEDITOR.replace( 'editor1', {
                      "extraPlugins": "imagebrowser",
                      "imageBrowser_listUrl": "../../../../images_list.json"
                  });
              </script>
              
        </div>
     
        <div class="container">
            <div class="sep"></div>
            <div class="col-md-12">
                <button class="btn btn-default btn-lg" type="submit" name="ok"><span class="glyphicon glyphicon-save"></span> Modifier</button>
                <button type="button" onclick="askBeforeDelete(this.id);" id="<?php echo $article[0]['id_article']; ?>" class="btn btn-warning btn-lg" name="delete"><span class="glyphicon glyphicon-trash"></span> Effacer</button>
            </div>
        </div>
    </form>

    <div class="container">
        
         <?php 
            if (isset($_POST['ok'])) {
                $error = false;
                if (empty($_POST['news-type'])) {
                    $error = true;
                }
                if (empty($_POST['title'])) {
                    $error = true;
                }
                if (empty($_POST['editor1'])) {
                    $error = true;
                }
                if ($error) {
                    echo "<script>alert('alerte au gogole')</script>";
                }else{
                    $news->updateNews($article[0]['id_article'] ,$_POST['news-type'], $_POST['title'], $_POST['editor1']);
                }
                
            }
            // if (isset($_POST['delete'])) {
            //   $news->deleteNews($article[0]['id_article']);
            // }
        ?>
    </div>
   
</div>

<div class="form-backa">
  <div class="del-conf">
        Supprimer la news?
        <div class="sep"></div>
        <button class="btn btn-default btn-sm" id="delButton" onclick="deleteNews()"><span class="glyphicon glyphicon-ok"></span> Oui</button>
        <button class="btn btn-default btn-sm" onclick="hideconfirmMess()"><span class="glyphicon glyphicon-remove"></span> Non</button>               
  </div>
</div>
    <!-- jQuery -->
    <script src="bootstrap/js/jquery.js"></script>
    

    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script src="bootstrap/js/index.js"></script>
</body>

</html>