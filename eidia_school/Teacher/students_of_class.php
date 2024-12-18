<?php 
session_start();
//see if the the teach id equal he's role if not it redirects the user to the login page
if (isset($_SESSION['teacher_id']) && 
    isset($_SESSION['role'])) {
      //call (include) the data bases needed for the treacher
    if ($_SESSION['role'] == 'Teacher') {
       include "../DB_connection.php";
       include "data/student.php";
       include "data/grade.php";
       include "data/class.php";
       include "data/section.php";
       if (!isset($_GET['class_id'])) {
           header("Location: students.php");
           exit;
       }
       //retrieves the details of all students and a specific class based on the provided 'class_id.'
       $class_id = $_GET['class_id'];
       $students = getAllStudents($conn);

       $class = getClassById($class_id, $conn);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Teacher - Students</title>
  <!-- stylesheets (Bootstrap and custom styles)-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../lg.png">
  <!--script tags (jQuery and Bootstrap JS).-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php 
    include "inc/navbar.php";
        if ($students != 0) {
            $check = 0;
     ?>
  <!--student data display-->
  <!--this function used to check  if there are students in the specified class
    if yes it's get the students data and display it in a table -->
  <?php $i = 0; foreach ($students as $student ) { 
       $g = getGradeById($class['grade'], $conn);
       $s = getSectioById($class['section'], $conn);
       if ($g['grade_id'] == $student['grade'] && $s['section_id'] == $student['section']) { $i++; 
       if ($i == 1) { 
        $check++;
    ?>
    <!--align and containe the table that will show the info of the students in that class-->
        <div class="container mt-5">
           <div class="table-responsive">
              <table class="table table-bordered mt-3 n-table">
                <thead>
                  <tr>
                    <th scope="col">N</th>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Grade</th>
                  </tr>
                </thead>
                <tbody>  
              <?php } ?>     
              <!--that show the table that have info of the student when you click at the students -->     
                  <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$student['student_id']?></td>
                    <td>
                      <a href="student-grade.php?student_id=<?=$student['student_id']?>">
                        <?=$student['fname']?>
                      </a>
                    </td>
                    <td><?=$student['lname']?></td>
                    <td><?=$student['username']?></td>
                    <td>
                      <?php 
                           $grade = $student['grade'];
                           $g_temp = getGradeById($grade, $conn);
                           if ($g_temp != 0) {
                              echo $g_temp['grade_code'].'-'.
                                     $g_temp['grade'];
                            }
                        ?>
                    </td>
                  </tr>
                <?php } } ?>
                </tbody>
              </table>
           </div>
         <?php }else{ ?> <!-- If there are no students in the class, it displays an alert message indicating that the class is empty.-->
             <div class="alert alert-info .w-450 m-5" 
                  role="alert">
                Empty!
              </div>
         <?php } ?>
     </div>
     <!--check if the valiable  0 if yes that mean that ther's no student in the specified class-->
     <!--then it redirect the user to the student's page -->
    <?php if ($check == 0) {
        header("Location: students.php");
        exit;
    } ?>
     <!-- It includes a script to activate the Bootstrap JS features and highlight the active link in the navigation bar.-->
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