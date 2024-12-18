<?php 

// All Subjects
function getAllSubjects($conn){
   $sql = "SELECT * FROM subjects";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $subjects = $stmt->fetchAll();
     return $subjects;
   }else {
   	return 0;
   }
}

// Get Subjects by ID
function getSubjectById($subject_id, $conn){
   $sql = "SELECT * FROM subjects
           WHERE subject_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$subject_id]);

   if ($stmt->rowCount() == 1) {
     $subject = $stmt->fetch();
     return $subject;
   }else {
   	return 0;
   }
}


// Fetches all subjects for a given grade.
function getSubjectByGrade($grade, $conn){
   $sql = "SELECT * FROM subjects
           WHERE grade=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$grade]);
//If the query returns one or more rows, fetches all subjects for the given grade and returns them
   if ($stmt->rowCount() > 0) {
     $subject = $stmt->fetchAll();
     return $subject;
   }else {
    return 0;
   }
}

 ?>