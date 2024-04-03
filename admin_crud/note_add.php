<?php
// Include common configurations
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  // Redirect to the login page if not logged in
  header('Location: login.php');
  exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $studentId = $_POST['student'];
  $moduleId = $_POST['module'];
  $grade = $_POST['grade'];
  $semester = $_POST['semester'];

  try {
    // Prepare the SQL statement
    $insert_query = "INSERT INTO grades (ModuleID, StudentID, Semester, Grade) VALUES (:moduleId, :studentId, :semester, :grade)";
    $statement = $db->prepare($insert_query);

    // Bind parameters
    $statement->bindParam(':moduleId', $moduleId);
    $statement->bindParam(':studentId', $studentId);
    $statement->bindParam(':semester', $semester);
    $statement->bindParam(':grade', $grade);

    // Execute the statement
    if ($statement->execute()) {
      echo "<p>Grade added successfully</p>";
      header('Location: list_notes.php');
    } else {
      echo "<p>Error: Failed to insert grade</p>";
    }
  } catch (PDOException $e) {
    // Output detailed error message
    echo "<p>Error: " . $e->getMessage() . "</p>";
    
    // Log detailed error message to a file for further investigation
    error_log($e->getMessage(), 3, "error_log.txt");
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Espace Admin </title>
  <link rel="icon" href="../assets/img/ji.png" type="image/png">

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
    <?php include 'partials/_navbar.php' ?>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <?php include 'partials/_settings-panel.html' ?>
      <?php include 'partials/_sidebar.html' ?>

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ajouter Note</h4>
                  <p class="card-description">
                  </p>
                  <form id="gradeForm" method="post" >
                    <div class="form-group">
                      <label for="exampleInputName1">Etudiant</label>
                      <select id="student" class="form-control" name="student">
                        <?php
                        // Connect to your database
                        $db = new mysqli('localhost', 'root', '', 'ecole');

                        // Check connection
                        if ($db->connect_error) {
                          die("Connection failed: " . $db->connect_error);
                        }

                        // Fetch students from database
                        $students_query = $db->query("SELECT id, nom, prenom FROM students where is_admin=0");
                        if ($students_query->num_rows > 0) {
                          while ($row = $students_query->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['prenom'] . " " . $row['nom'] . "</option>";
                          }
                        }
                        ?>
                      </select><br><br>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Module</label>
                      <select id="module" class="form-control" name="module">
                        <?php
                        // Fetch modules from database
                        $modules_query = $db->query("SELECT ModuleID, ModuleName FROM modules");
                        if ($modules_query->num_rows > 0) {
                          while ($row = $modules_query->fetch_assoc()) {
                            echo "<option value='" . $row['ModuleID'] . "'>" . $row['ModuleName'] . "</option>";
                          }
                        }
                        ?>
                      </select><br><br>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Semestre</label>
                      <input type="text" name="semester" class="form-control" id="exampleInputEmail3" placeholder="Semestre"
                        required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Note</label>
                      <input type="text" name="grade" class="form-control" id="exampleInputPassword4"
                        placeholder="Note" required>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Ajouter</button>
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
    <?php include 'partials/_settings-panel.html' ?>
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