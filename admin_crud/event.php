<?php

include 'config.php';

if (!isset($_SESSION['user_id'])) {
  die("User not logged in.");
}

$query = $db->query("SELECT id, titre, eve_date, lieu, heure_debut as heure, heure_fin as heure1, organisateur, email_organisateur, lien FROM events");

// Store the event ID in a session variable
// Fetch all rows as an associative array
$event = $query->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Espace Admin</title>
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
                                  <h4 class="card-title card-title-dash">Tous Les Evenements</h4>

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
            <th>titre</th>
            <th>date</th>
            <th>lieu</th>
            <th>heure debut</th>
            <th>heure fin</th>
            <th>organisateur</th>
            <th>email organisateur</th>
            <th>lien</th>
            <th>modifier</th>
            <th>supprimer</th>
            <!--
            <th>lien</th>
            <th>lien</th>
            <th>image</th>
            -->

        </tr>
    </thead>
    <tbody>
        <?php foreach ($event as $event): ?>
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
                                <h6><?= $event['titre']; ?></h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <div>
                                <h6><?= $event['eve_date']; ?></h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <div>
                                <h6><?= $event['lieu']; ?></h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <div>
                                <h6><?= $event['heure']; ?></h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <div>
                                <h6><?= $event['heure1']; ?></h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <div>
                                <h6><?= $event['organisateur']; ?></h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <div>
                                <h6><?= $event['email_organisateur']; ?></h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <div>
                                <h6><?= $event['lien']; ?></h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                        <div class="row">
                           
                        <a class="btn btn-warning" href="event_edit.php?id=<?= $event['id']; ?>">
      Modifier
</a>


                        </div>
                        </div>
                    </td>
                    <td>
    <div class="d-flex">
        <div class="row">
            <button type="button" class="btn btn-danger delete-btn" data-event-id="<?= $event['id']; ?>">Supprimer</button>
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
    document.addEventListener('DOMContentLoaded', function () {
        var deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var eventId = button.getAttribute('data-event-id');
                var confirmed = confirm('Are you sure you want to delete this event?');
                if (confirmed) {
                    // Send AJAX request to delete the event
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '');
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            // Reload the page to reflect changes
                            window.location.reload();
                        } else {
                            alert('Failed to delete event. Please try again.');
                        }
                    };
                    xhr.send('delete_id=' + eventId);
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
    $deleteQuery = $db->prepare("DELETE FROM events WHERE id = :delete_id");
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