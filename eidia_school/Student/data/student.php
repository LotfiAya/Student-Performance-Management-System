<?php 

//cette fct permet de retourner tous les stidents enregistrer dans la bd 
function getAllStudents($conn){
   $sql = "SELECT * FROM students";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $students = $stmt->fetchAll();
     return $students;
   }else {
   	return 0;
   }
}



// cette fct permet de retourner un student avec un id entrer dans les paramètres 
function getStudentById($id, $conn){
   $sql = "SELECT * FROM students
           WHERE student_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   if ($stmt->rowCount() == 1) {
     $student = $stmt->fetch();
     return $student;
   }else {
    return 0;
   }
}


/* 
this function help to verify if the username is unique or not 
*/
function unameIsUnique($uname, $conn, $student_id=0){
   $sql = "SELECT username, student_id FROM students
           WHERE username=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$uname]);
   
   if ($student_id == 0) {
     if ($stmt->rowCount() >= 1) {
       return 0;
     }else {
      return 1;
     }
   }else {
    if ($stmt->rowCount() >= 1) {
       $student = $stmt->fetch();
       if ($student['student_id'] == $student_id) {
         return 1;
       }else {
        return 0;
      }
     }else {
      return 1;
     }
   }
   
}

// cette fct permet d everifier le passworld enregistrer ds la base données et le passworld entré ds le paramàtres d"un student spécifique 
function studentPasswordVerify($student_pass, $conn, $student_id){
  $sql = "SELECT * FROM students
           WHERE student_id=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$student_id]);

  if ($stmt->rowCount() == 1) {
    $student = $stmt->fetch();
    $pass  = $student['password'];

    if (password_verify($student_pass, $pass)) {
      return 1;
    }else {
      return 0;
    }
  }else {
    return 0;
  }
}