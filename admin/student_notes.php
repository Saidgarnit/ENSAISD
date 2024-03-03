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

// Fetch grades and modules information
$queryGrades = $db->prepare("
    SELECT m.ModuleName, m.Year, m.Semester, g.Grade
    FROM grades g
    INNER JOIN modules m ON g.ModuleID = m.ModuleID
    WHERE g.StudentID = :studentID
");
$queryGrades->bindParam(':studentID', $userID, PDO::PARAM_INT);
$queryGrades->execute();
$grades = $queryGrades->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin2 </title>
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
            <div class="col-sm-12">
              <div class="home-tab">

                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">

                    <div class="row">
                      
                        <div class="row flex-grow">

                          <div class="table-responsive  mt-1">
                            <table class="table select-table">
                              <thead>
                                <tr>
                                  <th>
                                    <div class="form-check form-check-flat mt-0">
                                      <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" aria-checked="false"><i
                                          class="input-helper"></i></label>
                                    </div>
                                  </th>
                                  <th>Nom Module</th>
                                  <th>Niveau</th>
                                  <th>Semestre</th>
                                  <th>Note</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php foreach ($grades as $grade): ?>
                <tr>
                    <td>
                        <div class="form-check form-check-flat mt-0">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" aria-checked="false">
                                <i class="input-helper"></i>
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <div>
                                <h6><?=$grade['ModuleName']; ?></h6>
                                
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <div>
                                <h6><?= $grade['Year']; ?></h6>
                               
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <div>
                                <h6><?= $grade['Semester']; ?></h6>
                               
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <div>
                                <h6><?= $grade['Grade']; ?></h6>
                               
                            </div>
                        </div>
                    </td>
                    <!-- ... (other table cells) ... -->
                </tr>
            <?php endforeach; ?>

                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
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
