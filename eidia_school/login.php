<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login - <?=$setting['school_name']?> School</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="lg.png">
</head>

<body class="body-login">
    <div class="black-fill"><br /> <br />
    	<div class="d-flex justify-content-center align-items-center flex-column">
			<form class="login shadow" method="post" action="req/login.php">

				<div class="text-center">
					<img src="lg.png" width="150">
				</div>

				<h3>LOGIN</h3>

				<!-- affichage des msg d'erreur s'il exite ds les parametres Get-->

				<?php if (isset($_GET['error'])) { ?>
					<div class="alert alert-danger" role="alert">
						<?=$_GET['error']?>
					</div>
				<?php } ?>

				<div class="mb-3">
					<label class="form-label">Username</label>
					<input type="text" class="form-control" name="uname">
				</div>
			
				<div class="mb-5">
					<label class="form-label">Password</label>
					<input type="password" class="form-control" name="pass">
				</div>
				
				<div class="mb-4">
					<label class="form-label">Login As</label>

					<!--
						ici on peut choisir une parmis 
						les options présente (Admin, Teacher, Student or Regitrar office)
						une fois une est choisit on entre dans la page qui correspent l'utilisateur 
						le code correspendant cette task est présentes ds le fichier req/login.php
					-->

					<select class="form-control bg-dark text-white" name="role">
						<option value="1">Admin</option>
						<option value="2">Teacher</option>
						<option value="3">Student</option>
						<option value="4">Registrar Office</option>
					</select>

				</div>

				<!--
					une fois on click sur le btn Login on entre dans la page correspendante a notre poste 
					home permet le retoure à la page d'accueille 
				-->
				<div class="d-flex justify-content-center align-items-center flex-column">
					<button type="submit" class="btn btn-dark ">Login</button>
					<a href="index.php" class="text-decoration-none text-dark ">Home</a>
				</div>

			</form>
        
			<br /><br />
			
			<div class="text-center fixed-bottom text-light">
				Copyright &copy; 2023 EIDIA School. All rights reserved.
			</div>

    	</div>
    </div>
    
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
	
</body>
</html>