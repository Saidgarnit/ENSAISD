<?php
include 'config.php';
$query = $db->prepare("
    SELECT s.*, g.GradeID, m.ModuleName, m.Year, m.Semester, g.Grade
    FROM students s
    LEFT JOIN grades g ON s.id = g.StudentID
    LEFT JOIN modules m ON g.ModuleID = m.ModuleID
    where is_admin=0
");
$query->execute();
$studentGrades = $query->fetchAll(PDO::FETCH_ASSOC);
if (isset($_POST['delete_grade_id'])) {
  // Perform deletion query
  $delete_grade_id = $_POST['delete_grade_id'];
  $deleteQuery = $db->prepare("DELETE FROM grades WHERE gradeID = :delete_grade_id");
  $deleteQuery->bindParam(':delete_grade_id', $delete_grade_id, PDO::PARAM_INT);
  $deleteQuery->execute();

  // Redirect to the same page to refresh the data
  header("Location: {$_SERVER['PHP_SELF']}");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Espace Admin</title>
  <!-- plugins:css -->
  <link rel="icon" href="../assets/img/ji.png" type="image/png">

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
  <link rel="shortcut icon" href="images/favicona.png" />
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
                      <div class="col-12 grid-margin stretch-card">
                        <div class="card card-rounded">
                          <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-start">
                              <div>
                                <h4 class="card-title card-title-dash">Tous Les Notes</h4>

                              </div>

                            </div>
                            <div class="table-responsive  mt-1">
                              <table class="table select-table">
                                <thead>
                                  <tr>
                                    <th>
                                      <div class="form-check form-check-flat mt-0">
                                        <label class="form-check-label">
                                          <input type="checkbox" class="form-check-input" aria-checked="false">
                                          <i class="input-helper"></i>
                                        </label>
                                      </div>
                                    </th>
                                    <th>Nom Etudiant</th>
                                    <th>Prenom Etudiant</th>
                                    <th>Module</th>
                                    <th>Niveau</th>
                                    <th>Semestre</th>
                                    <th>Note</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($studentGrades as $student) : ?>
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
                                            <h6><?= $student['nom']; ?></h6>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="d-flex">
                                          <div>
                                            <h6><?= $student['prenom']; ?></h6>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="d-flex">
                                          <div>
                                            <h6><?= $student['ModuleName']; ?></h6>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="d-flex">
                                          <div>
                                            <h6><?= $student['Year']; ?></h6>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="d-flex">
                                          <div>
                                            <h6><?= $student['Semester']; ?></h6>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="d-flex">
                                          <div>
                                            <h6><?= $student['Grade']; ?></h6>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="d-flex">
                                          <div class="row">

                                            <a class="btn btn-warning" href="note_edit.php?id=<?= $student['GradeID']; ?>">
                                              Modifier
                                            </a>


                                          </div>
                                        </div>
                                      </td>
                                      <<td>
                                        <div class="d-flex">
                                          <div class="row">
                                            <form class="delete-form" method="post">
                                              <input type="hidden" name="delete_grade_id" value="<?= $student['GradeID']; ?>">
                                              <button type="submit" class="btn btn-danger delete-btn">Supprimer</button>
                                            </form>
                                          </div>
                                        </div>
                                        </td>


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
                  <div class="row">
                    <div class="col-lg-8 d-flex flex-column">



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

    </div>
  </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
  <!-- <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
    </div>
  </footer> -->
  <!-- partial -->
  </div>
  <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var deleteForms = document.querySelectorAll('.delete-form');
      deleteForms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
          event.preventDefault(); // Prevent form submission
          var gradeId = form.querySelector('input[name="delete_grade_id"]').value;
          var confirmed = confirm('Are you sure you want to delete this grade?');
          if (confirmed) {
            // Send AJAX request to delete the grade
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
              if (xhr.status === 200) {
                // Reload the page to reflect changes
                window.location.reload();
              } else {
                alert('Failed to delete grade. Please try again.');
              }
            };
            xhr.send('delete_grade_id=' + gradeId);
          }
        });
      });
    });
  </script>






  <?php
  // Check if the delete ID is set in the POST data
  if (isset($_POST['delete_id'])) {
    // Perform deletion query
    $delete_id = $_POST['delete_id'];
    $deleteQuery = $db->prepare("DELETE FROM students WHERE id = :delete_id");
    $deleteQuery->bindParam(':delete_id', $delete_id, PDO::PARAM_INT);
    $deleteQuery->execute();
  }
  ?>
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