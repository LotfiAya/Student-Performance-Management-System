<?php 
  /*
  fonction qui permet de récupérer les paramètres 
  depuis la table setting en utilisant la requete sql :
  SELECT * FROM setting ; 
  si le résultat de cette requêtes retourne une ligne 
  elle retrouve les paamètres sinon elle retourne 0 
  */
function getSetting($conn){
   $sql = "SELECT * FROM setting";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() == 1) {
     $settings = $stmt->fetch();
     return $settings;
   }else {
    return 0;
   }
}

