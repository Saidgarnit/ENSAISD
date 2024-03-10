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

// Base URL of your local server
$baseURL = "http://localhost/ENSAISD"; // Change 'ENSAISD' to the name of your project directory

// Fetch events
$queryEvents = $db->query("SELECT * FROM events");
$events = $queryEvents->fetchAll(PDO::FETCH_ASSOC);
// Function to convert BLOB data to base64 encoded string
function blobToBase64($blobData)
{
  return base64_encode($blobData);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="viewport" content="width=device-width, initial-scale=1">

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
  <link rel="stylesheet" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
  <link rel="stylesheet" href="/admin/css/vertical-layout-light/style.css">
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
            <h4 class="card-title">Evenement</h4>
            <p class="card-description">
            </p>
            <div class="image-container d-flex justify-content-center responsive-div">
              <div class="image-container d-flex justify-content-center">
                <div class="container-scroller">
                  <!-- Your HTML content -->
                  <!-- Example: -->
                  <!-- Event List Container -->
                  <div class="row">
                    <!-- Event section -->
                    <div class="col-lg-9 col-md-8">
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <?php foreach ($events as $event) : ?>
                              <div class="col-md-4 mb-3">
                                <div class="card"><?php
                                                  // Fetch image data from the event
                                                  $imageData = $event['image_data'];
                                                  // Convert BLOB data to base64 encoded string
                                                  $imageBase64 = blobToBase64($imageData);
                                                  ?>
                                  <img src="data:image/jpeg;base64,<?php echo $imageBase64; ?>" class="card-img-top" alt="Event Image">

                                  <div class="card-body">
                                    <h5 class="card-title"><?php echo $event['titre']; ?></h5>
                                    <p class="card-text"><?php echo $event['description']; ?></p>
                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-view-details" title="View Event Details">View Details</button>
                                    <small class="text-muted"><?php echo $event['eve_date']; ?></small>
                                  </div>
                                </div>
                              </div>
                            <?php endforeach; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="description" style="display: flex; justify-content: space-between;">



            <div class="d-flex justify-content-end align-items-center">
            </div>

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
  <script src="views/eventScript.js"></script>

</body>

</html>