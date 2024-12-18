<?php 
//inslusion de fichier 
include "DB_connection.php"; //fichier de cnx avec la bd
include "data/setting.php"; //fichier de fct getetting : importation à partie de la bd les info de l'ecole utilisant le site 
$setting = getSetting($conn); //l'appelle de la fct en stockant les info dans la variable $settings

//condition qui verifie si le résultats de la fct getSettings : vide on non 
if ($setting != 0) {
 //si non nul on va afficher la page html suivante 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome to <?=$setting['school_name']?></title> <!--le nom de la page selon la base de données cela est utile ds le cas de plusieurs ecoles utilise la meme plateform-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"> <!--pour le style j'ai préfére d'utlisé le framework bootsrapt pour sa facilité d'utilisation-->
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="lg.png"> 
</head>
<!-- body contien 3 section : home, About us , contact us  -->
<body class="body-home">
    <div class="black-fill"><br /> <br />
    	<div class="container">
			<!-- création de navbar  -->
			<nav class="navbar shadow navbar-expand-lg bg-light rounded sticky-top" id="homeNav">
				<div class="container-fluid ">
					<a class="navbar-brand" href="#">
						<img src="lg.png" width="40">
					</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav me-auto  mb-2 mb-lg-0">
							<li class="nav-item ">
							<a class="nav-link active" aria-current="page" href="#">Home</a>
							</li>
							<li class="nav-item ">
							<a class="nav-link" href="#about">About</a>
							</li>
							<li class="nav-item ">
							<a class="nav-link" href="#contact">Contact</a>
							</li>
						</ul>
						<ul class="navbar-nav me-right mb-2 mb-lg-0">
							<li class="nav-item">
								<a class="nav-link" href="login.php">Login</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
       
			<section class="welcome-text d-flex justify-content-center align-items-center flex-column">
				<img src="lg.png">
				<h4>Welcome to <?=$setting['school_name']?></h4> <!--abréviation de la fct echo en php-->
				<p class="shadow"><?=$setting['slogan']?></p>
			</section>

			<!--section about us -->
			<section id="about" class="d-flex justify-content-center align-items-center flex-column">
				<div class="card mb-3 shadow card-1">
					<div class="row align-items-center g-0">
						<div class="col-md-4 ">
							<img src="lg.png" class="img-fluid rounded-start" >
						</div>

						<div class="col-md-8">
							<div class="card-body">
								<h5 class="card-title">About Us</h5>
								<p class="card-text"><?=$setting['about']?></p>
								<p class="card-text"><small class="text-muted"> <?=$setting['school_name']?> School </small></p>
							</div>
						</div>
					</div>
				</div>
        	</section>

			<!--
				section cantact us : permet d'envoyer les msgs aux admins apres avoir cliquer sur 
				submet pour cela nous allons coder en php ds le fichier req/contact.php
			-->
        	<section id="contact" class="d-flex justify-content-center align-items-center flex-column">
				<form method="post" class="shadow" action="req/contact.php">
					<h3>Contact Us</h3>
					<!-- affichage des msg de réussite ou d'erreur if they exist ds les parametres Get-->
					<?php if (isset($_GET['error'])) { ?>
						<div class="alert alert-danger" role="alert">
							<?=$_GET['error']?>
						</div>
					<?php } ?>

					<?php if (isset($_GET['success'])){ ?>
						<div class="alert alert-success" role="alert">
							<?=$_GET['success']?>
						</div>
					<?php } ?>

					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Email address</label>
						<input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
						<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
					</div>

					<div class="mb-3">
						<label class="form-label">Full Name</label>
						<input type="text" name="full_name" class="form-control">
					</div>

					<div class="mb-3">
						<label class="form-label">Message</label>
						<textarea class="form-control" name="message" rows="4"></textarea>
					</div>
					
					<button type="submit" class="btn btn-primary">Send</button>
				</form>
        	</section>
			
			<!--Copyright-->
			<div class="text-center text-light">
				Copyright &copy; <?=$setting['current_year']?> <?=$setting['school_name']?>. All rights reserved.
			</div>

    	</div>
    </div>
    <!--inclusion de bootsrapt qui dépent de Js -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
</body>

</html>
<?php }else {
	/*
	si setting == 0 càd que la table setting est vide 
	càd aucune ecole n'as déja utilisé le site donc on aura pas la première page index 
	ms automatiquement on va ce lancer vers login.php
	*/
	header("Location: login.php");
	exit;
}  ?>