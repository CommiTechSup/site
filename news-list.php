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
            <div class="row">
                <div class="col-lg-12">
                    <h1>Liste des news</h1>
                    <?php 
                    foreach ($news->getAllNews() as $key => $value) {
                        echo '<div class="col-lg-3 info">
                                <div class="panel panel-primary COM-'.$value['id_article'].'">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">'.utf8_encode($value['title']).'</h3>
                                    </div>
                                    <div class="panel-body resum">
                                        <div class="summary">
                                        '.utf8_encode($value['content']).
                                        '</div>
                                        <div class="readmore">
                                         <a href="edit.php?article='.$value['id_article'].'" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                        </div>
                                    </div>  
                                </div>   
                            </div>';
                    }
                ?>
                </div>
            </div>
   
</div>
    <!-- jQuery -->
    <script src="bootstrap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>


    
    


</body>

</html>