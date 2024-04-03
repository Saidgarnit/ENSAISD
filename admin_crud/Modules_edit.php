<?php
// Include common configurations
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header('Location: login.php');
    exit();
}

// Check if the module ID is set in the URL
if (!isset($_GET['id'])) {
    // Redirect or show an error message if the ID is not provided
    echo "Module ID is not provided!";
    exit();
}

// Retrieve the module ID from the URL
$moduleID = $_GET['id'];

// Fetch module information from the database based on the ID
$queryModule = $db->prepare("SELECT ModuleName, Year, Semester FROM modules WHERE ModuleID = :moduleID");
$queryModule->bindParam(':moduleID', $moduleID, PDO::PARAM_INT);
$queryModule->execute();
$moduleData = $queryModule->fetch(PDO::FETCH_ASSOC);

// Check if the module data is fetched successfully
if (!$moduleData) {
    echo "Module data not found!";
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the data (you can enhance this part)
    $moduleName = filter_input(INPUT_POST, 'moduleName', FILTER_SANITIZE_STRING);
    $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_STRING);
    $semester = filter_input(INPUT_POST, 'semester', FILTER_SANITIZE_STRING);

    // Update module information in the database
    $updateQuery = $db->prepare("UPDATE modules SET ModuleName = :moduleName, Year = :year, Semester = :semester WHERE ModuleID = :moduleID");
    $updateQuery->bindParam(':moduleName', $moduleName, PDO::PARAM_STR);
    $updateQuery->bindParam(':year', $year, PDO::PARAM_STR);
    $updateQuery->bindParam(':semester', $semester, PDO::PARAM_STR);
    $updateQuery->bindParam(':moduleID', $moduleID, PDO::PARAM_INT);

    // Execute the query
    $updateQuery->execute();

    // Redirect to the module list page or show a success message
    header('Location: Modules.php');
    exit();
}
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
    <?php include 'partials/_navbar.php'; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <?php include 'partials/_settings-panel.html'; ?>
      <?php include 'partials/_sidebar.html'; ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Modifier Module</h4>
                  <form method="post" action="">
                    <div class="form-group">
                      <label for="exampleInputName1">Nom du Module</label>
                      <input type="text" name="moduleName" class="form-control" id="exampleInputName1" placeholder="Nom du Module" value="<?= htmlspecialchars($moduleData['ModuleName']); ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Année</label>
                      <input type="text" name="year" class="form-control" id="exampleInputName1" placeholder="Année" value="<?= htmlspecialchars($moduleData['Year']); ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Semestre</label>
                      <input type="text" name="semester" class="form-control" id="exampleInputEmail3" placeholder="Semestre" value="<?= htmlspecialchars($moduleData['Semester']); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Modifier</button>
                    <button type="button" class="btn btn-light" onclick="window.location.href='Modules.php'">Annuler</button>                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
  <?php include 'partials/_footer.html'; ?>
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
<script src="js/Chart.roundedBarCharts.js"></script>
<!-- End custom js for this page-->
</body>
</html>
