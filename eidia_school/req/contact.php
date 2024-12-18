<?php  

if (isset($_POST['email']) && isset($_POST['full_name']) && isset($_POST['message'])) {

    include "../DB_connection.php";  //inclusion de fivhiee qui permet a cnx a la bd 
	
	//on stock les données entrer dans des variable 
	$email     = $_POST['email'];
	$full_name = $_POST['full_name'];
	$message   = $_POST['message'];

	//on verifie que aucun champs n"est vide sinon on affiche in msg d'error correspendant a chaque champs vide 
	if (empty($email)) {
		$em  = "Email is required";
		header("Location: ../index.php?error=$em#contact");
		exit;
	}else if (empty($full_name)) {
		$em  = "Full name is required";
		header("Location: ../index.php?error=$em#contact");
		exit;
	}else if (empty($message)) {
		$em  = "Massage is required";
		header("Location: ../index.php?error=$em#contact");
		exit;
	}else { // si tous les chams ne somt pas vide on insere les infomation entrer dans une table spécifier pour les msg 
        $sql  = "INSERT INTO message (sender_full_name, sender_email, message) VALUES(?, ?, ?)";
        $stmt = $conn->prepare($sql); //on prepare la requete 
        $stmt->execute([$full_name, $email, $message]); //on execute la requetes tout en inserons les données entrer par user 
        $sm = "Message sent successfully"; // 
        header("Location: ../index.php?success=$sm#contact"); //after insertion of data on annoce au  user que sont msg a été envoyer 
        exit;
	}

}else{
	header("Location: ../login.php");
	exit;
}