<?php 
session_start();
if (isset($_SESSION['teacher_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Teacher') {
       include "../DB_connection.php";
       include "data/class.php";
       include "data/grade.php";
       include "data/section.php";
       include "data/teacher.php";
       
       $teacher_id = $_SESSION['teacher_id'];
       //fetches or include the teacher details using teacher id
       $teacher = getTeacherById($teacher_id, $conn);
       //retrieves all classes
       $classes = getAllClasses($conn);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers - Students</title>
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
     <div class="container mt-5">
          <!--It ensures that horizontal scrolling is applied when needed on smaller screens.-->
           <div class="table-responsive">
            <!--table class for table styling -->
            <!--table bordered adds borders to the table cells (cadr)-->
              <table class="table  table-bordered mt-3 n-table">
                <thead>
                  <tr>
                    <th scope="col">N</th>
                    <th scope="col">Class</th>
                  </tr>
                </thead>
                <tbody>
                  <!--
                  Loops through classes, retrieves grade and section details, and displays class information in a table.-->
                  <?php $i = 0; foreach ($classes as $class ) { 
                      ?>
                  

                      <?php 
                      //the str_plit use the devide every chaine de caracter that we have
                      //the trim used for the delet the white spaces 
                          $classesx = str_split(trim($teacher['class']));
                          $grade  = getGradeById($class['grade'], $conn);
                          $section = getSectioById($class['section'], $conn);
                          $c = $grade['grade_code'].'-'.$grade['grade'].$section['section'];
                          foreach ($classesx as $class_id) {
                               if ($class_id == $class['class_id']) {  $i++; ?>
                            <tr>
                                <th scope="row"><?=$i?></th>
                                <td> <a href="students_of_class.php?class_id=<?=$class['class_id']?>">
                                          <?php echo $c; ?>
                                      </a>   
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
    <!-- Includes Bootstrap JavaScript for enhanced UI features.-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>    
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(3) a").addClass('active');
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