<?php 

//this function used to call all the classes from the data base
//Fetches all classes from the database.
function getAllClasses($conn){
   $sql = "SELECT * FROM class";
   $stmt = $conn->prepare($sql);
   $stmt->execute();
  //If the query returns one or more rows
  //fetches all classes and returns them. Otherwise, returns 0.
   if ($stmt->rowCount() >= 1) {
     $classes = $stmt->fetchAll();
     return $classes;
   }else {
    return 0;
   }
}


//fetch the specific classes by its id 
function getClassById($class_id, $conn){
   $sql = "SELECT * FROM class
           WHERE class_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$class_id]);
//If the query returns exactly one row,
// fetches and returns the class details. Otherwise, returns 0.
   if ($stmt->rowCount() == 1) {
     $class = $stmt->fetch();
     return $class;
   }else {
    return 0;
   }
}

// DELETE class by ther id
function removeClass($id, $conn){
   $sql  = "DELETE FROM class
           WHERE class_id=?";
   $stmt = $conn->prepare($sql);
   $re   = $stmt->execute([$id]);
   //If the deletion is successful, returns 1. Otherwise, returns 0.
   if ($re) {
     return 1;
   }else {
    return 0;
   }
}