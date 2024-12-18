<?php 
// retourne les class 
function getAllClasses($conn){
   $sql = "SELECT * FROM class";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

  if ($stmt->rowCount() >= 1) {
    $classes = $stmt->fetchAll();
    return $classes;
  }else {
    return 0;
  }
}

// retourne la class specidier par son id 
function getClassById($class_id, $conn){
   $sql = "SELECT * FROM class
           WHERE class_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$class_id]);

   if ($stmt->rowCount() == 1) {
     $class = $stmt->fetch();
     return $class;
   }else {
    return 0;
   }
}

// supprime une classe en utilison son id 
function removeClass($id, $conn){
   $sql  = "DELETE FROM class
           WHERE class_id=?";
   $stmt = $conn->prepare($sql);
   $re   = $stmt->execute([$id]);
   if ($re) {
     return 1;
   }else {
    return 0;
   }
}