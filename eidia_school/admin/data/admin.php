<?php 

//cette fct permet de verif le mp enregistrer dns la base de données et le password entré ds le paraùetre d"un id specifique 
function adminPasswordVerify($admin_pass, $conn, $admin_id){
  $sql = "SELECT * FROM admin
           WHERE admin_id=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$admin_id]);

  if ($stmt->rowCount() == 1) {
    $admin = $stmt->fetch();
    $pass  = $admin['password'];

    if (password_verify($admin_pass, $pass)) {
     	return 1;
    }else {
     	return 0;
    }
  }else {
    return 0;
  }
}