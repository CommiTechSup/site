<!DOCTYPE html>
<html lang="fr">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>CommItechSup</title>

	<!-- Custom CSS -->
	<link href="bootstrap/css/scrolling-nav.css" rel="stylesheet">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
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

				//Connexion BDD
				try
				{
					$bdd = new PDO('mysql:host=localhost;dbname=commitecdvad', 'root', '');
				}
				catch(Exception $e)
				{
					die('Erreur : '.$e->getMessage());
				}

				//Fonction qui raccourcit une chaine de caractère en fonction d'une taille max, sans tronquer un mot.
				function resum($chaine, $tailleMax)
				{
					$positionDernierEspace = 0;
					if( strlen($chaine) >= $tailleMax )
					{
						$chaine = substr($chaine,0,$tailleMax);
						$positionDernierEspace = strrpos($chaine,' ');
						$chaine = substr($chaine,0,$positionDernierEspace).'(...)';
					}
					return $chaine;
				}

				//Parser du BBcode au HTML
				function showBBcodes($text) {

					// BBcode
					$find = array(
						'~\[b\](.*?)\[/b\]~s',
						'~\[i\](.*?)\[/i\]~s',
						'~\[u\](.*?)\[/u\]~s',
						'~\[quote\](.*?)\[/quote\]~s',
						'~\[size=(.*?)\](.*?)\[/size\]~s',
						'~\[color=(.*?)\](.*?)\[/color\]~s',
						'~\[url\]((?:ftp|https?)://.*?)\[/url\]~s',
						'~\[img\](https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~s'
					);

					// Tags HTML pour remplacer le BBcode
					$replace = array(
						'<b>$1</b>',
						'<i>$1</i>',
						'<span style="text-decoration:underline;">$1</span>',
						'<pre>$1</'.'pre>',
						'<span style="font-size:$1px;">$2</span>',
						'<span style="color:$1;">$2</span>',
						'<a href="$1">$1</a>',
						'<img src="$1" alt="" />'
					);

					// Replacing the BBcodes with corresponding HTML tags
					return preg_replace($find,$replace,$text);
				}



				//On récupère le contenu des posts du forum.
				$req = $bdd->query('SELECT post_subject, post_text FROM phpbb_posts natural join phpbb_forums WHERE forum_name LIKE \'Actual%\'');
				$i=1;

				//Gestion et affichage des panels
				while ($donnees = $req->fetch())
				{
					$i++;
					echo '<div class="panel panel-primary col-lg-3 COM-'.$i.'">
									<div class="panel-heading">
										<h3 class="panel-title">' . utf8_encode($donnees['post_subject']) . '</h3>
									</div>
									<div class="panel-body">' . resum(utf8_encode($donnees['post_text']),280) . ' </div>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg_'.$i.'">+</button>
								</div>';
				}
				//On clot la session
				$req->closeCursor();

				$req = $bdd->query('SELECT post_subject, post_text FROM phpbb_posts natural join phpbb_forums WHERE forum_name LIKE \'Actual%\'');
				$j=1;

				//Gesion et affichage des modals
				while ($donnees = $req->fetch())
				{
					$j++;
					echo '<div class="modal fade bs-example-modal-lg_'.$j.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<h3 class="modal-title">' . utf8_encode($donnees['post_subject']) . ' </h3>
											<p class="modal-text">'.utf8_encode($donnees['post_text']).'</p>
										</div>
									</div>
								</div>';
				}
				//On clot la session
				$req->closeCursor();

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
				//On récupère le contenu des posts du forum.
				$req = $bdd->query('SELECT post_subject, post_text FROM phpbb_posts natural join phpbb_forums WHERE forum_name LIKE \'%nement%\'');
				$i=1;

				//Gestion et affichage des panels
				while ($donnees = $req->fetch())
				{
					$i++;
					echo '<div class="panel panel-primary col-lg-3 COM-'.$i.'">
									<div class="panel-heading">
										<h3 class="panel-title">' . utf8_encode($donnees['post_subject']) . '</h3>
									</div>
									<div class="panel-body">' . resum(utf8_encode($donnees['post_text']),290) . ' </div>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".eve-example-modal-lg_'.$i.'">+</button>
								</div>';
				}
				//On clot la session
				$req->closeCursor();

				$req = $bdd->query('SELECT post_subject, post_text FROM phpbb_posts natural join phpbb_forums WHERE forum_name LIKE \'%nement%\'');
				$j=1;

				//Gesion et affichage des modals
				while ($donnees = $req->fetch())
				{
					$j++;
					echo '<div class="modal fade eve-example-modal-lg_'.$j.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<h3 class="modal-title">' . utf8_encode($donnees['post_subject']) . ' </h3>
											<p class="modal-text">'.utf8_encode($donnees['post_text']).'</p>
										</div>
									</div>
								</div>';
				}
				//On clot la session
				$req->closeCursor();

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


+
<script src="bootstrap/js/classie.js"></script>

<!--ReCaptcha-->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>


</body>

</html>