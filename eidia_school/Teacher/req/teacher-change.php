<?php 
  session_start();
  // Check if teacher is logged in
  if (isset($_SESSION['teacher_id']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Teacher') {
    	

      if (isset($_POST['old_pass']) &&isset($_POST['new_pass'])   &&isset($_POST['c_new_pass']) ) {
        // Include necessary files
        include '../../DB_connection.php';
        include "../data/teacher.php";
        // Récupère les valeurs du formulaire
        $old_pass = $_POST['old_pass'];
        $new_pass = $_POST['new_pass'];
        $c_new_pass = $_POST['c_new_pass'];

        $teacher_id = $_SESSION['teacher_id'];
        // Vérifie si les champs obligatoires sont vides
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
        }else if ($new_pass !== $c_new_pass) {
          $em  = "New password and confirm password does not match";
          header("Location: ../pass.php?perror=$em");
          exit;
        }else if (!teacherPasswordVerify($old_pass, $conn, $teacher_id)) {
          $em  = "Incorrect old password";
          header("Location: ../pass.php?perror=$em");
          exit;
        }else {
          // hashing the password
          $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);

          $sql = "UPDATE teachers SET
                    password = ?
                    WHERE teacher_id=?";

          $stmt = $conn->prepare($sql);
          $stmt->execute([$new_pass, $teacher_id]);
          // Redirige avec un message de succès
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
