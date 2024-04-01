
<?php
// Include common configurations
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Validate and sanitize the form data
  $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
  $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
  $filiere = filter_input(INPUT_POST, 'filiere', FILTER_SANITIZE_STRING);
  $cin = filter_input(INPUT_POST, 'cin', FILTER_SANITIZE_STRING);
  $cne = filter_input(INPUT_POST, 'cne', FILTER_SANITIZE_STRING);

  // Prepare and execute the SQL query to insert the student into the database
  $insertQuery = $db->prepare("INSERT INTO students (nom, prenom, email, password, filiere, cin, cne) VALUES (:nom, :prenom, :email, :password, :filiere, :cin, :cne)");
  $insertQuery->bindParam(':nom', $nom, PDO::PARAM_STR);
  $insertQuery->bindParam(':prenom', $prenom, PDO::PARAM_STR);
  $insertQuery->bindParam(':email', $email, PDO::PARAM_STR);
  $insertQuery->bindParam(':password', $password, PDO::PARAM_STR);
  $insertQuery->bindParam(':filiere', $filiere, PDO::PARAM_STR);
  $insertQuery->bindParam(':cin', $cin, PDO::PARAM_STR);
  $insertQuery->bindParam(':cne', $cne, PDO::PARAM_STR);

  // Execute the query
  $insertQuery->execute();

  // Optionally, you can redirect the user to a different page after adding the student
  header('Location: list_etudiant.php');
  exit(); // Always exit after a header redirect
}
?>

?>
<!DOCTYPE html>
<html lang="en">
    
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Espace Admin </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>


  <div class="container-scroller">
    
    <!-- partial:partials/_navbar.html -->
    <?php include 'partials/_navbar.php'  ?>
   
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <?php include 'partials/_settings-panel.html'  ?>
      <?php include 'partials/_sidebar.html'  ?>
     
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ajouter Etudiant</h4>
                            <p class="card-description">
                            </p>
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="exampleInputName1">Nom</label>
                                    <input type="text" name="nom" class="form-control" id="exampleInputName1"
                                        placeholder="Nom" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Prenom</label>
                                    <input type="text" name="prenom" class="form-control" id="exampleInputName1"
                                        placeholder="Prenom"  required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Adresse Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail3"
                                        placeholder="Email" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword4">Mot de Passe</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword4"
                                        placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectGender">Filiere</label>
                                    <select name="filiere" class="form-control" id="exampleSelectGender">
                                        <option  >Securite IT</option>
                                        <option  >Big data IA</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCity1">CIN</label>
                                    <input type="text" name="cin" class="form-control" id="exampleInputCity1"
                                        placeholder="CIN" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCity1">CNE</label>
                                    <input type="text" name="cne" class="form-control" id="exampleInputCity1"
                                        placeholder="CNE" required >
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Ajouter</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
  <?php include 'partials/_settings-panel.html'  ?>
  <!-- partial -->
  </div>
  <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="vendors/progressbar.js/progressbar.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/jquery.cookie.js" type="text/javascript"></script>
  <script src="js/dashboard.js"></script>
  <script src=" js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>