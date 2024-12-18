<?php  

// Get Teacher by ID
function getTeacherById($teacher_id, $conn){
   $sql = "SELECT * FROM teachers
           WHERE teacher_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$teacher_id]);

   if ($stmt->rowCount() == 1) {
     $teacher = $stmt->fetch();
     return $teacher;
   }else {
    return 0;
   }
}
//Verifies the provided password against the hashed password of a teacher.
function teacherPasswordVerify($teacher_pass, $conn, $teacher_id){
  $sql = "SELECT * FROM teachers
          WHERE teacher_id=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$teacher_id]);
//If the query returns exactly one row, fetches the teacher's hashed password.
  if ($stmt->rowCount() == 1) {
    $teacher = $stmt->fetch();
    $pass  = $teacher['password'];
    // to compare the provided password with the hashed password.
    if (password_verify($teacher_pass, $pass)) {
       return 1;
    }else {
       return 0;
    }
  }else {
   return 0;
  }
}

