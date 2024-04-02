<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

// Check if gradeID is provided in the URL
if (!isset($_GET['id'])) {
    die("Grade ID not provided.");
}

// Retrieve the grade ID from the URL
$gradeID = $_GET['id'];

try {
    // Fetch grade information
    $queryGrade = $db->prepare("
        SELECT s.nom, s.prenom, m.ModuleName, m.Year, m.Semester, g.Grade
        FROM students s
        INNER JOIN grades g ON s.id = g.StudentID
        INNER JOIN modules m ON g.ModuleID = m.ModuleID
        WHERE g.GradeID = :gradeID
    ");
    $queryGrade->bindParam(':gradeID', $gradeID, PDO::PARAM_INT);
    $queryGrade->execute();
    $grade = $queryGrade->fetch(PDO::FETCH_ASSOC);

    // Check if grade exists
    if (!$grade) {
        throw new Exception("Grade not found.");
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());

}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Validate and sanitize the data (you can enhance this part)
  $newGrade = filter_input(INPUT_POST, 'grade', FILTER_SANITIZE_STRING);
  $newYear = filter_input(INPUT_POST, 'niveau', FILTER_SANITIZE_STRING);
  $newModuleName = filter_input(INPUT_POST, 'ModuleName', FILTER_SANITIZE_STRING);
  $newSemester = filter_input(INPUT_POST, 'semester', FILTER_SANITIZE_STRING);
  $gradeID = $_POST['gradeID']; // Retrieve the grade ID from the form

  // Update grade and module information in the database
  $updateQuery = $db->prepare("
      UPDATE grades g
      INNER JOIN modules m ON g.ModuleID = m.ModuleID
      SET g.Grade = :newGrade, m.Year = :newYear, m.ModuleName = :newModuleName, m.Semester = :newSemester
      WHERE g.GradeID = :gradeID
  ");
  $updateQuery->bindParam(':newGrade', $newGrade, PDO::PARAM_STR);
  $updateQuery->bindParam(':newYear', $newYear, PDO::PARAM_STR);
  $updateQuery->bindParam(':newModuleName', $newModuleName, PDO::PARAM_STR);
  $updateQuery->bindParam(':newSemester', $newSemester, PDO::PARAM_STR);
  $updateQuery->bindParam(':gradeID', $gradeID, PDO::PARAM_INT);

  // Execute the query
  $updateQuery->execute();

  // Redirect to the appropriate page or show a success message
  header('Location: list_notes.php'); // Redirect to the grade list page
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
                  <h4 class="card-title">Modifier Note</h4>
                  <form method="post" action="">
                    <div class="form-group">
                      <label for="exampleInputName1">Nom</label>
                      <input type="hidden" name="gradeID" value="<?= $gradeID ?>">
                      <input type="text" name="nom" class="form-control" id="exampleInputName1" placeholder="Nom" value="<?= $grade['nom'] ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Prenom</label>
                      <input type="text" name="prenom" class="form-control" id="exampleInputName1" placeholder="Prenom" value="<?= $grade['prenom'] ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Nom Module</label>
                      <input type="text" name="ModuleName" class="form-control" id="exampleInputName1" placeholder="Prenom" value="<?= $grade['ModuleName'] ?>" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Niveau</label>
                      <input type="text" name="niveau" class="form-control" id="exampleInputEmail3" placeholder="niveau" value="<?= $grade['Year'] ?>">
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputCity1">Semestre</label>
                      <input type="text" name="semester" class="form-control" id="exampleInputCity1" placeholder="Semestre" value="<?= $grade['Semester'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Grade</label>
                      <input type="text" name="grade" class="form-control" id="exampleInputCity1" placeholder="Note" value="<?= $grade['Grade'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Modifier</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
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
