<?php  

// cette fct retourne all the sections 
function getAllSections($conn){
   $sql = "SELECT * FROM section";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $sections = $stmt->fetchAll();
     return $sections;
   }else {
    return 0;
   }
}

// fct permet de retourner just one section specifié par son id 
function getSectioById($section_id, $conn){
   $sql = "SELECT * FROM section
           WHERE section_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$section_id]);

   if ($stmt->rowCount() == 1) {
     $section = $stmt->fetch();
     return $section;
   }else {
    return 0;
   }
}

// cette fct permet de supprimer une section par son id 
function removeSection($id, $conn){
   $sql  = "DELETE FROM section
           WHERE section_id=?";
   $stmt = $conn->prepare($sql);
   $re   = $stmt->execute([$id]);
   if ($re) {
     return 1;
   }else {
    return 0;
   }
}