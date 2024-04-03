<?php
// Include common configurations
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header('Location: login.php');
    exit();
}

// Check if the event ID is set in the URL
if (!isset($_GET['id'])) {
    // Redirect or show an error message if the ID is not provided
    // You can handle this based on your application's logic
    echo "Event ID is not provided!";
    exit();
}

// Retrieve the event ID from the URL
$eventID = $_GET['id'];

// Fetch event information from the database based on the ID
$queryEvent = $db->prepare("SELECT * FROM events WHERE id = :eventID");
$queryEvent->bindParam(':eventID', $eventID, PDO::PARAM_INT);
$queryEvent->execute();
$eventData = $queryEvent->fetch(PDO::FETCH_ASSOC);

// Check if the event data is fetched successfully
if (!$eventData) {
    echo "Event data not found!";
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the data for each input field
    $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
    $lieu = filter_input(INPUT_POST, 'lieu', FILTER_SANITIZE_SPECIAL_CHARS);
    /*$heure_debut = filter_input(INPUT_POST, 'heure_debut', FILTER_SANITIZE_SPECIAL_CHARS);
    $heure_fin = filter_input(INPUT_POST, 'heure_fin', FILTER_SANITIZE_SPECIAL_CHARS);*/
    $heure_debut = $_POST['heure_debut']; // Vous pouvez ajouter une validation d'heure si nécessaire
    $heure_fin = $_POST['heure_fin']; // Vous pouvez ajouter une validation d'heure si nécessaire
    $eve_date = $_POST['eve_date']; // Vous pouvez ajouter une validation de date si nécessaire
    $organisateur = filter_input(INPUT_POST, 'organisateur', FILTER_SANITIZE_SPECIAL_CHARS);
    $email_organisateur = filter_input(INPUT_POST, 'email_organisateur', FILTER_VALIDATE_EMAIL);
    $lien = filter_input(INPUT_POST, 'lien', FILTER_SANITIZE_URL);
    $article = filter_input(INPUT_POST, 'article', FILTER_SANITIZE_SPECIAL_CHARS);

    // Check if any input field is empty or not provided
    $requiredFields = array($titre, $description, $lieu, $heure_debut, $heure_fin, $organisateur, $email_organisateur, $lien, $article);
    foreach ($requiredFields as $field) {
        if (empty($field)) {
            echo "Field description is empty!";
            exit();
        }
    }

    // Handle image upload
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageName = $_FILES['image']['name'];
    $imagePath = 'uploads/' . $imageName;

    // Check if the directory exists, if not, create it
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true); // Create directory recursively with full permissions
    }

    // Move the uploaded file to the desired location
    if (move_uploaded_file($imageTmpName, $imagePath)) {
        // Update image path in the database only if move_uploaded_file succeeds
        $updateImageQuery = $db->prepare("UPDATE events SET image_data = :imagePath WHERE id = :eventID");
        $updateImageQuery->bindParam(':imagePath', $imagePath, PDO::PARAM_STR);
        $updateImageQuery->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $updateImageQuery->execute();
    } else {
        // Handle file upload error
        echo "Failed to move the uploaded file!";
        exit();
    }
}

    // Update event information in the database
    $updateQuery = $db->prepare("UPDATE events SET titre = :titre, eve_date = :eve_date,description = :description, lieu = :lieu, heure_debut = :heure_debut, heure_fin = :heure_fin, organisateur = :organisateur, email_organisateur = :email_organisateur, lien = :lien, article = :article WHERE id = :eventID");
    $updateQuery->bindParam(':titre', $titre, PDO::PARAM_STR);
    $updateQuery->bindParam(':description', $description, PDO::PARAM_STR);
    $updateQuery->bindParam(':lieu', $lieu, PDO::PARAM_STR);
    $updateQuery->bindParam(':heure_debut', $heure_debut, PDO::PARAM_STR);
    $updateQuery->bindParam(':heure_fin', $heure_fin, PDO::PARAM_STR);
    $updateQuery->bindParam(':eve_date', $eve_date, PDO::PARAM_STR);
    $updateQuery->bindParam(':organisateur', $organisateur, PDO::PARAM_STR);
    $updateQuery->bindParam(':email_organisateur', $email_organisateur, PDO::PARAM_STR);
    $updateQuery->bindParam(':lien', $lien, PDO::PARAM_STR);
    $updateQuery->bindParam(':article', $article, PDO::PARAM_STR);
    $updateQuery->bindParam(':eventID', $eventID, PDO::PARAM_INT);
    $updateQuery->execute();

    // Redirect to the event list page or show a success message
    header('Location: event.php');
    exit();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Modifier Evenement</title>
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
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Modifier Evenement</h4>
                  <form class="form-sample" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName1">Titre</label>
                      <input type="text" name="titre" class="form-control" id="exampleInputName1" placeholder="Titre" value="<?= isset($eventData['titre']) ? htmlspecialchars($eventData['titre'], ENT_QUOTES | ENT_HTML5, 'UTF-8') : '' ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputDescription">Description</label>
                      <textarea class="form-control" name="description" id="exampleInputDescription" rows="4"><?= isset($eventData['description']) ? htmlspecialchars($eventData['description'], ENT_QUOTES | ENT_HTML5, 'UTF-8') : '' ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputImage">Image</label>
                      <input type="file" name="image" class="form-control-file" id="exampleInputImage">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputDate">Date de l'événement</label>
                      <input type="date" name="eve_date" class="form-control" id="exampleInputDate" placeholder="Date" value="<?= isset($eventData['eve_date']) ? htmlspecialchars($eventData['eve_date'], ENT_QUOTES | ENT_HTML5, 'UTF-8') : '' ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Heure de début</label>
                      <input type="time" name="heure_debut" class="form-control" id="exampleInputHeureDebut" placeholder="Heure de début" value="<?= isset($eventData['heure_debut']) ? htmlspecialchars($eventData['heure_debut'], ENT_QUOTES | ENT_HTML5, 'UTF-8') : '' ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Heure de fin</label>
                      <input type="time" name="heure_fin" class="form-control" id="exampleInputHeureFin" placeholder="Heure de fin" value="<?= isset($eventData['heure_fin']) ? htmlspecialchars($eventData['heure_fin'], ENT_QUOTES | ENT_HTML5, 'UTF-8') : '' ?>">
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputName1">Lieu</label>
                      <input type="text" name="lieu" class="form-control" id="exampleInputLieu" placeholder="Lieu" value="<?= isset($eventData['lieu']) ? htmlspecialchars($eventData['lieu'], ENT_QUOTES | ENT_HTML5, 'UTF-8') : '' ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Organisateur</label>
                      <input type="text" name="organisateur" class="form-control" id="exampleInputOrganisateur" placeholder="Organisateur" value="<?= isset($eventData['organisateur']) ? htmlspecialchars($eventData['organisateur'], ENT_QUOTES | ENT_HTML5, 'UTF-8') : '' ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail">Adresse Email de l'organisateur</label>
                      <input type="email" name="email_organisateur" class="form-control" id="exampleInputEmail" placeholder="Adresse Email de l'organisateur" value="<?= isset($eventData['email_organisateur']) ? htmlspecialchars($eventData['email_organisateur'], ENT_QUOTES | ENT_HTML5, 'UTF-8') : '' ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputLien">Lien</label>
                      <input type="text" name="lien" class="form-control" id="exampleInputLien" placeholder="Lien" value="<?= isset($eventData['lien']) ? htmlspecialchars($eventData['lien'], ENT_QUOTES | ENT_HTML5, 'UTF-8') : '' ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputArticle">Article</label>
                      <textarea class="form-control" name="article" id="exampleInputArticle" rows="4"><?= isset($eventData['article']) ? htmlspecialchars($eventData['article'], ENT_QUOTES | ENT_HTML5, 'UTF-8') : '' ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputArticleFile">Article File</label>
                      <input type="file" name="article_file" class="form-control-file" id="exampleInputArticleFile">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Modifier</button>
                  </form>
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
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/data-table.js"></script>
  <script src="js/jquery.dataTables.js"></script>
  <script src="js/select.js"></script>
  <!-- End custom js for this page-->
</body>
</html>
