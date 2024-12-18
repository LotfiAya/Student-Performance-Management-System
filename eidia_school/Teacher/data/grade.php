<?php 
// fetch all the grade from the data base
function getAllGrades($conn){
   $sql = "SELECT * FROM grades";
   $stmt = $conn->prepare($sql);
   $stmt->execute();
// if there's one or more row display all the class
   if ($stmt->rowCount() >= 1) {
     $grades = $stmt->fetchAll();
     return $grades;
   }else {
    return 0;
   }
}

// Get Grade by ID 
function getGradeById($grade_id, $conn){
   $sql = "SELECT * FROM grades
           WHERE grade_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$grade_id]);
//if the query is just one fetch and display the details of that grade
   if ($stmt->rowCount() == 1) {
     $grade = $stmt->fetch();
     return $grade;
   }else {
    return 0;
   }
}

// DELETE
function removeGrade($id, $conn){
   $sql  = "DELETE FROM grades
           WHERE grade_id=?";
   $stmt = $conn->prepare($sql);
   $re   = $stmt->execute([$id]);
   //if the grade deleted succefuly return 1 otherw return 0
   if ($re) {
     return 1;
   }else {
    return 0;
   }
}