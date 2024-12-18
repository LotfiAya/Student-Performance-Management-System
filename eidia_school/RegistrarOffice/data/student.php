<?php 

// All Students 
function getAllStudents($conn){
   $sql = "SELECT * FROM students";
   $stmt = $conn->prepare($sql);
   $stmt->execute();
//if ther's 1 ot more show fetch all the student
   if ($stmt->rowCount() >= 1) {
     $students = $stmt->fetchAll();
     return $students;
   }else {
   	return 0;
   }
}



// Get Student By Id 
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


// Check if the username Unique
function unameIsUnique($uname, $conn, $student_id=0){
   $sql = "SELECT username, student_id FROM students
           WHERE username=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$uname]);
   // Check if $student_id is provided
   if ($student_id == 0) {
    // If there are rows, the username is not unique, return 0
     if ($stmt->rowCount() >= 1) {
       return 0;
     }else {
      // If no rows, the username is unique, return 1
      return 1;
     }
     //If $student_id is provided,
   }else {
    if ($stmt->rowCount() >= 1) {
       // If there are rows, fetch the first result
       $student = $stmt->fetch();
       // Check if the student_id of the fetched result matches the provided $student_id
       if ($student['student_id'] == $student_id) {
         // If the student_id matches, the username is associated with the same student 
        return 1;
       }else {
        return 0;
      }
     }else {
       // If no rows, the username is unique, return 1
      return 1;
     }
   }
   
}


// Search 
function searchStudents($key, $conn){
   $key = preg_replace('/(?<!\\\)([%_])/', '\\\$1',$key);
   // SQL query to search for students using multiple conditions
   $sql = "SELECT * FROM students
           WHERE student_id LIKE ? 
           OR fname LIKE ?
           OR address LIKE ?
           OR email_address LIKE ?
           OR parent_fname LIKE ?
           OR parent_lname LIKE ?
           OR parent_phone_number LIKE ?
           OR lname LIKE ?
           OR username LIKE ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$key, $key, $key, $key, $key, $key, $key, $key, $key]);

   if ($stmt->rowCount() == 1) {
    // If one or more rows are found, fetch and return the result
     $students = $stmt->fetchAll();
     return $students;
   }else {
    return 0;
   }
}