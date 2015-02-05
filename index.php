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

</head>

<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<?php 
    require_once('class/connexion.class.php');
    require_once('class/actualites.class.php');
    require_once('class/evenements.class.php');

    $connexion = new Connexion();
    $actualites = new Actualites($connexion->getConnexion());
    $evenements = new Evenements($connexion->getConnexion());

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
                <a class="navbar-brand page-scroll" href="#page-top"><div id="mini-logo"><img src="img/asso-mini.png" alt="CommItechSup"/></div></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a class="page-scroll" href="#section-1"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#section-2">Actualités</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#section-3">Evénements</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#section-4">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Intro Section -->
    <section id="section-1" class="intro-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 id="logo"><img src="img/asso.png" alt="CommItechSup"/></h1>
                </div>
            </div>          
        </div>
    </section>
    <!--Section Evenements -->
    <section id="section-2" class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Actualités</h1>
                    <?php 
                    foreach ($actualites->getActualites() as $key => $value) {
                        echo '<div class="col-lg-3 info"><div class="panel panel-primary COM-'.$value['post_id'].'">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">'.utf8_encode($value['post_subject']).'</h3>
                                    </div>
                                    <div class="panel-body">'.utf8_encode($actualites->resum($value['post_text'],280)).'</div>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg_'.$value['post_id'].'">+</button>
                                </div></div>';
                        echo '<div class="modal fade bs-example-modal-lg_'.$value['post_id'].'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <h3 class="modal-title">' . utf8_encode($value['post_subject']) . ' </h3>
                                            <p class="modal-text">'.utf8_encode($value['post_text']).'</p>
                                        </div>
                                    </div>
                                </div>';
                    }
                ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Section  Actu -->
    <section id="section-3" class="services-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Evénements</h1>
                    <?php 
                    foreach ($evenements->getEvenements() as $key => $value) {
                        echo '<div class="col-lg-3 info"><div class="panel panel-primary COM-'.$value['post_id'].'">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">'.utf8_encode($value['post_subject']).'</h3>
                                    </div>
                                    <div class="panel-body">'.utf8_encode($evenements->resum($value['post_text'],280)).'</div>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg_'.$value['post_id'].'">+</button>
                                </div></div>';
                        echo '<div class="modal fade bs-example-modal-lg_'.$value['post_id'].'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <h3 class="modal-title">' . utf8_encode($value['post_subject']) . ' </h3>
                                            <p class="modal-text">'.utf8_encode($value['post_text']).'</p>
                                        </div>
                                    </div>
                                </div>';
                    }
                ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section -->
    <section id="section-4" class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Contact</h1>
                    <br /><br />
                    <div class="row">   
                         <!-- Alignment -->
                        <div class="col-sm-offset-3 col-sm-6">
                           <!-- Form itself -->
                              <form name="sentMessage" id="contactForm"  method="POST" novalidate>                           
                                <legend>Vous avez des questions, des remarques ou des propositions? N'hésitez pas!</legend>
                                  <br />
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="text" class="form-control" 
                                       placeholder="Nom" id="name" required
                                           data-validation-required-message="S'il vous plaît, entrer votre nom" maxlength="100" /> 
                                        <p class="help-block"></p>
                                    </div>
                                </div>  
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="email" class="form-control" placeholder="Email" 
                                                id="email" required
                                           data-validation-required-message="S'il vous plaît, entrer votre adresse mail" />
                                        <p class="help-block align-right"></p>
                                    </div>
                                </div>  

                                <div class="control-group">
                                    <div class="controls">
                                        <textarea rows="10" cols="100" class="form-control" 
                                           placeholder="Message" id="message" required
                                   data-validation-required-message="S'il vous plaît, entrer un sujet pour votre message" minlength="5" 
                                           data-validation-minlength-message="Minimum 5 caractères" 
                                            maxlength="999" style="resize:none"></textarea>
                                    </div>
                                </div>  
                                
                                <div id="success"> </div> <!-- For success/fail messages -->
                                <br />
                                
                                <button type="submit" value="submit" class="btn btn-primary pull-right">Envoyer</button><br />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    


    <!-- jQuery -->
    <script src="bootstrap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- Scrolling Nav JavaScript -->
    <script src="bootstrap/js/jquery.easing.min.js"></script>
    <script src="bootstrap/js/scrolling-nav.js"></script>

    <!-- Form -->
    <script src="bootstrap/js/jqBootstrapValidation.js"></script>
    <script src="bootstrap/js/contact_me.js"></script>
    
    <!--Modal-->
    <script src="bootstrap/js/modalEffects.js"></script>
    <script src="bootstrap/js/classie.js"></script>
    
    <!--ReCaptcha-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


</body>

</html>