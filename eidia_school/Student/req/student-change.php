<?php 

  session_start();

  if (isset($_SESSION['student_id']) && isset($_SESSION['role'])) {
    
    if ($_SESSION['role'] == 'Student') {
        
      if (isset($_POST['old_pass']) && isset($_POST['new_pass']) && isset($_POST['c_new_pass']) ) {

        //inclusion de la bd et le fichier ../data/student.php ou il y les fct qui parcour data from bd en relatio n avec student 
        include '../../DB_connection.php';
        include "../data/student.php";
        
        //on stocke les données entrer par l'utilisateur ds des variable 
        $old_pass = $_POST['old_pass'];
        $new_pass = $_POST['new_pass'];
        $c_new_pass = $_POST['c_new_pass'];

        $student_id = $_SESSION['student_id'];
        
        //on affiche un msg d'zreeur si student à laisser un chmaps vide 
        if (empty($old_pass)) {
          $em  = "Old password is required";
          header("Location: ../pass.php?perror=$em");
          exit;
        }else if (empty($new_pass)) {
          $em  = "New password is required";
          header("Location: ../pass.php?perror=$em");
          exit;
        }else if (empty($c_new_pass)) {
          $em  = "Confirmation password is required";
          header("Location: ../pass.php?perror=$em");
          exit;
        }else if ($new_pass !== $c_new_pass) { //msg d'erreur si les nouveus paswolr entré ne sont pas identique 
          $em  = "New password and confirm password does not match";
          header("Location: ../pass.php?perror=$em");
          exit;
        }else if (!studentPasswordVerify($old_pass, $conn, $student_id)) { // msg d'erreur l'ancient passworld et le passworld enregistrer dans la base donné 
          $em  = "Incorrect old password";
          header("Location: ../pass.php?perror=$em");
          exit;
        }else {
          // en convertit le passworld haché et en le stocke ds la ase données pour plus de sécurisation 
          $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);

          $sql = "UPDATE students SET
                    password = ?
                    WHERE student_id=?";

          $stmt = $conn->prepare($sql);
          $stmt->execute([$new_pass, $student_id]);
          $sm = "The password has been changed successfully!";
          header("Location: ../pass.php?psuccess=$sm");
          exit;
        }
      
      }else {
        $em = "An error occurred";
        header("Location: ../pass.php?error=$em");
        exit;
      }

    }else {
      header("Location: ../../logout.php");
      exit;
    }

  }else {
    header("Location: ../../logout.php");
    exit;
  } 
