<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

// Retrieve the user ID from the session
$userID = $_SESSION['user_id'];

// Fetch student information
$queryStudent = $db->prepare("SELECT * FROM students WHERE id = :studentID");
$queryStudent->bindParam(':studentID', $userID, PDO::PARAM_INT);
$queryStudent->execute();
$student = $queryStudent->fetch(PDO::FETCH_ASSOC);

// Fetch data from the emplois table
$id = 1; // Assuming you have a specific ID for the data
$queryData = $db->prepare("SELECT src, description, created_at FROM emplois WHERE id = :id");
$queryData->bindParam(':id', $id, PDO::PARAM_INT);
$queryData->execute();
$data = $queryData->fetch(PDO::FETCH_ASSOC);

// Base URL of your local server
$baseURL = "http://localhost/ENSAISD"; // Change 'ENSAISD' to the name of your project directory
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Espace Numerique</title>
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
      <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Emplois de temps</h4>
              <p class="card-description">
                 <code></code>
              </p>
              <div class="image-container d-flex justify-content-center">
                <?php if (isset($data['src']) && $data['src'] != ''): ?>
                    <img src="<?php echo $baseURL . '/' . $data['src']; ?>" alt="Emploi Image">
                <?php else: ?>
                    <p>No image found.</p>
                <?php endif; ?>
              </div>
              <div class="description">
                <p>Description: <?php echo $data['description']; ?></p>
                <p>Created at: <?php echo $data['created_at']; ?></p>
              </div>
            </div>
          </div>
        </div>
    </div>  
</div>

<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<?php include 'partials/_settings-panel.html'; ?>
<!-- partial -->

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
