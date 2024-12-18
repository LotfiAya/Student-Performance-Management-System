<?php 
session_start();
if (isset($_SESSION['teacher_id']) && 
    isset($_SESSION['role'])) {
    // Inclusion du fichier de connexion à la base de données
    if ($_SESSION['role'] == 'Teacher') {
       include "../DB_connection.php";
       include "data/class.php";
       include "data/grade.php";
       include "data/section.php";
       include "data/teacher.php";
       
       $teacher_id = $_SESSION['teacher_id'];
       $teacher = getTeacherById($teacher_id, $conn);
       $classes = getAllClasses($conn);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers - Classes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../lg.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php 
        include "inc/navbar.php";
        if ($classes != 0) {
     ?>
     <!--margin 5-->
     <!--container fournir une structure et une disposition cohérentes pour les éléments sur une page Web-->
     <div class="container mt-5">
           <div class="table-responsive">
            <!--table-bordered mt-3//cadre du tableau -->
              <table class="table table-bordered mt-3 n-table">
                <thead>
                  <tr>
                    <th scope="col">N</th>
                    <th scope="col">Class</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($classes as $class ) { 
                      ?>
                  

                      <?php 
                      /*Cette ligne prend la chaîne de caractères représentant les classes de l'enseignant,
                       la supprime de tout espace inutile à la fin et au début,
                       puis la divise en un tableau de caractères.
                       */
                          $classesx = str_split(trim($teacher['class']));
                          //obtenir les détails de la classe (grade) à partir 
                          //de l'identifiant de grade stocké dans la classe actuelle.
                          $grade  = getGradeById($class['grade'], $conn);
                          //obtenir les détails de la section à partir de l'identifiant de section.
                          $section = getSectioById($class['section'], $conn);
                          //reprent chaine de caracter qui vas etre dans le cadre class 
                          $c = $grade['grade_code'].'-'.$grade['grade'].'/'.$section['section'];
                          foreach ($classesx as $class_id) {
                               if ($class_id == $class['class_id']) {  $i++; ?>
                            <tr>
                                <th scope="row"><?=$i?></th>
                                <td>

                                      <?php echo $c; ?>
                                      
                            </td>
                          </tr>

                            <?php         
                            }
                          }
                          
                          
                       ?>
                       
                <?php } ?>
                </tbody>
              </table>
           </div>
         <?php }else{ ?>
             <div class="alert alert-info .w-450 m-5" 
                  role="alert">
                Empty!
              </div>
         <?php } ?>
     </div>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>    
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(2) a").addClass('active');
        });
    </script>

</body>
</html>
<?php 

  }else {
    header("Location: ../login.php");
    exit;
  } 
}else {
    header("Location: ../login.php");
    exit;
} 

?>