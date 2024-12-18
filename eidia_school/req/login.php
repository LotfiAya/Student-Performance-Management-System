<?php 
session_start();

if (isset($_POST['uname']) && isset($_POST['pass']) && isset($_POST['role'])) {

	include "../DB_connection.php"; // inclusion de fichier qui permet la cnx avec la base de donné
	
	//on stock les données entrer par user dans des  variables 
	$uname = $_POST['uname'];
	$pass = $_POST['pass'];
	$role = $_POST['role'];

	/*
	l'user doit remplir tous les champs : useranme & password ainsi que son role 
	si il n'a pas entré une de ses 3, l'error $em est une parametre Get 
	
	si tous les champs sont remplis on passe à vérifier les coordonées entrer: le username et le passworld 
	ds la table du type d'utilisateur entré 
	
	*/
	if (empty($uname)) {
		$em  = "Username is required";
		header("Location: ../login.php?error=$em");
		exit;
	}else if (empty($pass)) {
		$em  = "Password is required";
		header("Location: ../login.php?error=$em");
		exit;
	}else if (empty($role)) {
		$em  = "An error Occurred";
		header("Location: ../login.php?error=$em");
		exit;
	}else {
        //on fait l'equivalence de chaque role avec its appropriate table 

		// les condition suivantes permet de spécifier la requetes adéquates pour chaque role 
		// chaque requete permet de chercher username ds sa tale 
        if($role == '1'){
        	$sql = "SELECT * FROM admin 
        	        WHERE username = ?";
        	$role = "Admin";
        }else if($role == '2'){
        	$sql = "SELECT * FROM teachers 
        	        WHERE username = ?";
        	$role = "Teacher";
        }else if($role == '3'){
        	$sql = "SELECT * FROM students 
        	        WHERE username = ?";
        	$role = "Student";
        }else if($role == '4'){
        	$sql = "SELECT * FROM registrar_office 
        	        WHERE username = ?";
        	$role = "Registrar Office";
        }

		//on prépare et on execute la requetes en utlisant le username entré 
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname]);


        if ($stmt->rowCount() == 1) { //si le resultat de la requettes retourne une seul ligne 
        	$user = $stmt->fetch(); //on récupere et on stock le résultat de la requetes exécuter ds la variable user 
        	$username = $user['username']; //on stock username de bd ds la variable username 
        	$password = $user['password'];// et passworld de bd ds la variable passwors 
        	

            if ($username === $uname) {
				// si le uname entrer est adéquates avec le username de bd on passe à la verification de psw
				
            	if (password_verify($pass, $password)) { //on compare le pass entrer par le password haché stocké ds la bd 
            		$_SESSION['role'] = $role; 
					// apres la verification de pass chaque utilisateur entre dans une page dédié pour lui selon son role  
            		if ($role == 'Admin') {
                        $id = $user['admin_id'];
                        $_SESSION['admin_id'] = $id;
                        header("Location: ../admin/index.php");
                        exit;
                    }else if ($role == 'Student') {
                        $id = $user['student_id'];
                        $_SESSION['student_id'] = $id;
                        header("Location: ../Student/index.php");
                        exit;
                    }else if ($role == 'Registrar Office') {
                        $id = $user['r_user_id'];
                        $_SESSION['r_user_id'] = $id;
                        header("Location: ../RegistrarOffice/index.php");
                        exit;
                    }else if($role == 'Teacher'){
                    	$id = $user['teacher_id'];
                        $_SESSION['teacher_id'] = $id;
                        header("Location: ../Teacher/index.php");
                        exit;
                    }else { //if role is something else 
                    	$em  = "Incorrect Username or Password";
				        header("Location: ../login.php?error=$em");
				        exit;
                    }
				    
            	}else { //passworld n'est pas correcte on affiche un msg d'error $em
		        	$em  = "Incorrect Username or Password";
				    header("Location: ../login.php?error=$em");
				    exit;
		        }
            }else { // username n'est pas corecte on affiche un msg d'error $em
	        	$em  = "Incorrect Username or Password";
			    header("Location: ../login.php?error=$em");
			    exit;
	        }
        }else { //si le resultat de la resqutes n'as aucun de resulzet on affiche un msg d'error $em
        	$em  = "Incorrect Username or Password";
		    header("Location: ../login.php?error=$em");
		    exit;
        }
	}


}else{
	header("Location: ../login.php");
	exit;
}