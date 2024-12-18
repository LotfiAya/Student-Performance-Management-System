<!--navbar sera présente ds toute les page de ce type de cette user pour cela on va créer ce fichier est l'importrer dans toutes les autres pages -->

<!--
  pour le student il a le droit de changer le passworld est voire c notes donc
  le navbar doit être personaliser pour lui 
  -Dashboad : home ou il sera afficher tout les information de l'etudiant
  -Grade Summary : les notes de etudiant 
  -Change Passworld  : the student can change his password 
  -Logout : fermer sa session 
  
-->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="../lg.png" width="40">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="navLinks">

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">
            Dashboard
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="grade.php">
            Grade Summary
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="pass.php">
            Change Password
          </a>
        </li>

      </ul>

      <ul class="navbar-nav me-right mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="../logout.php">
            Logout
          </a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>