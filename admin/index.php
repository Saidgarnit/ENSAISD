<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) {
  die("User not logged in.");
}

// Retrieve the user ID from the session
$userID = $_SESSION['user_id'];

// Fetch events
$queryEvents = $db->query("SELECT * FROM events");
$events = $queryEvents->fetchAll(PDO::FETCH_ASSOC);

// Fetch student information
$queryStudent = $db->prepare("SELECT * FROM students WHERE id = :studentID");
$queryModule = $db->prepare("SELECT count(*) FROM grades WHERE StudentID = :studentID and Grade>=12");

$queryStudent->bindParam(':studentID', $userID, PDO::PARAM_INT);
$queryModule->bindParam(':studentID', $userID, PDO::PARAM_INT);

$queryStudent->execute();
$queryModule->execute();

$student = $queryStudent->fetch(PDO::FETCH_ASSOC);
$modules = $queryModule->fetch(PDO::FETCH_ASSOC);

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
  <title>Espace Etudiant</title>
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
  <link rel="stylesheet" href="path-to/node_modules/mdi/css/materialdesignicons.min.css" />
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

      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">

                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">

                    </div>
                    <div class="row">
                      <div class="col-lg-8 d-flex flex-column">
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card card-rounded">
                            <div class="card-body">
                              <div class="d-sm-flex justify-content-between align-items-start">
                                <div>
                                  <h4 class="card-title card-title-dash">Mes Notes</h4>

                                </div>
                                <div>
                                  <a class="btn btn-primary btn-lg text-white mb-0 me-0" href="student_notes.php">
                                    <i class="mdi mdi-library-plus"></i>Voir Toutes Mes Notes
                                  </a>
                                </div>
                              </div>
                              <div class="table-responsive  mt-1">
                                <table class="table select-table">
                                  <thead>
                                    <tr>
                                      <th>
                                        <div class="form-check form-check-flat mt-0">
                                          <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                        </div>
                                      </th>
                                      <th>Nom Module</th>
                                      <th>Niveau</th>
                                      <th>Semestre</th>
                                      <th>Note</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($grades as $grade) : ?>
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
                                              <h6><?= $grade['ModuleName']; ?></h6>

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
                      <div class="col-lg-4 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                            <div class="card bg-primary card-rounded">
                              <div class="card-body pb-0">
                                <h4 class="card-title card-title-dash text-white mb-4">Modules valides</h4>
                                <div class="row">
                                  <div class="col-sm-4">
                                    
                                  <h2 class="text-info"><?php echo $modules['count(*)']; ?></h2>
                                    <p class="status-summary-ight-white mb-1">Modules</p>
                                  </div>
                                  <div class="col-sm-8">
                                    <div class="status-summary-chart-wrapper pb-4">
                                      <canvas id="status-summary"></canvas>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-12 grid-margin stretch-card">

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-8 d-flex flex-column">



                      </div>

                    </div>
                    <div class="col-lg-4 d-flex flex-column">
                      <div class="col-12 grid-margin stretch-card">
                        <div class="card card-rounded">

                          <div class="card-body">
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="row flex-grow">
                                  <h4 class="card-title card-title-dash">Recent Events</h4>

                                  <?php foreach ($events as $event) : ?>
                                    <div class="list align-items-center border-bottom py-2">
                                      <div class="wrapper w-100">
                                        <p class="mb-2 font-weight-medium">
                                          <?php echo $event['titre']; ?>
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                          <div class="d-flex align-items-center">
                                            <i class="mdi mdi-calendar text-muted me-1"></i>
                                            <p class="mb-0 text-small text-muted"><?php echo $event['eve_date']; ?></p>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  <?php endforeach; ?>

                                  <div class="list align-items-center pt-3">
                                    <div class="wrapper w-100">
                                      <p class="mb-0">
                                        <a href="#" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a>
                                      </p>
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



                  <div class="row flex-grow">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        
        <!-- partial -->
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
    </div>
  </footer>
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
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>