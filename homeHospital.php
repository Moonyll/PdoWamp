<!DOCTYPE html>
<html>
<head>
<!-- Bootsrap CDN -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
  <!-- Jquery CDN -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

  <!-- Style CSS -->
  <link rel="stylesheet" type="text/css" href="style.css">
  
  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="search.js"></script>
  
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">

<title>PDO</title>
</head>
<body>
<header class ="d-flex bg-transparent align-items-center justify-content-center text-light">
    <h1 class="m-2 p-2"><i class="fas fa-hospital text-danger"></i>  Bienvenue au Count Haunted Hospital <i class="fas fa-spider text-warning"></i></h1>    
</header>
<nav class="navbar navbar-expand navbar-dark bg-transparent">
    <a class="navbar-brand" href="#">
        <img src="Images/skeleton.png" width="90" height="90" class="d-block img-thumbnail border border-light" alt="logo">
    </a>
   <ul class="navbar-nav flex-row">
        <li class="nav-item"><a href="viewListPatients.php" class="nav-link btn bg-primary border border-light text-light"><i class="fas fa-skull-crossbones"></i> Liste des patients</a></li>
        <li class="nav-item"><a href="viewAddPatient.php" class="nav-link btn bg-info border border-light text-light"><i class="fas fa-skull"></i> Ajouter un patient</a></li>
        <li class="nav-item"><a href="viewListRdv.php" class="nav-link btn bg-success border border-light text-light"><i class="fas fa-snowman"></i> Liste des rendez-vous</a></li>
        <li class="nav-item"><a href="viewAddRdv.php" class="nav-link btn bg-secondary border border-light text-light"><i class="fas fa-ghost"></i> Nouveau rendez-vous</a></li>
        <li class="nav-item"><a href="viewListPatientsWithPagination.php" class="nav-link btn bg-warning border border-light text-light"><i class="fas fa-layer-group"></i> Pagination</a></li>
    </ul>
</nav>
<main class="align-items-center justify-content-center"><img src="Images/man.jpg" class="d-block mx-auto img-thumbnail border border-light" alt="man"></main>
</body>
</html>

