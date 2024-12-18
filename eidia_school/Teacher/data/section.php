<?php  

// All Sections
function getAllSections($conn){
   $sql = "SELECT * FROM section";
   $stmt = $conn->prepare($sql);
   $stmt->execute();
//if the row is equal of more that one display all the sections(group)from the data base
   if ($stmt->rowCount() >= 1) {
     $sections = $stmt->fetchAll();
     return $sections;
   }else {
    return 0;
   }
}

// Get a section by id not all of them
function getSectioById($section_id, $conn){
   $sql = "SELECT * FROM section
           WHERE section_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$section_id]);
//if the row is 1 return the section and fetch her details
   if ($stmt->rowCount() == 1) {
     $section = $stmt->fetch();
     return $section;
   }else {
    return 0;
   }
}

// DELETE
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