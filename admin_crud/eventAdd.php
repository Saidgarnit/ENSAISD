<?php
// Include common configurations
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the form data
    $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_SPECIAL_CHARS);
    $eve_date = $_POST['eve_date']; // Vous pouvez ajouter une validation de date si nécessaire
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
    $lieu = filter_input(INPUT_POST, 'lieu', FILTER_SANITIZE_SPECIAL_CHARS);
    $heure_debut = $_POST['heure_debut']; // Vous pouvez ajouter une validation d'heure si nécessaire
    $heure_fin = $_POST['heure_fin']; // Vous pouvez ajouter une validation d'heure si nécessaire
    $organisateur = filter_input(INPUT_POST, 'organisateur', FILTER_SANITIZE_SPECIAL_CHARS);
    $email_organisateur = filter_input(INPUT_POST, 'email_organisateur', FILTER_SANITIZE_EMAIL);
    $lien = filter_input(INPUT_POST, 'lien', FILTER_SANITIZE_URL);
    // Pour l'image, vous pouvez utiliser des techniques de téléchargement de fichiers
    // Assurez-vous de traiter correctement les données téléchargées pour des raisons de sécurité
    $image_data = null; // Remplissez cette variable avec les données de l'image
    $image_type = null; // Remplissez cette variable avec le type de l'image
    $article = filter_input(INPUT_POST, 'article', FILTER_SANITIZE_SPECIAL_CHARS);

    // Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    // Vérifier si aucune erreur lors du téléchargement
    if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        // Vérifier si le fichier est une image
        $image_info = getimagesize($_FILES["image"]["tmp_name"]);
        if ($image_info !== false) {
            // Stocker les données de l'image téléchargée
            $image_data = file_get_contents($_FILES["image"]["tmp_name"]);
            $image_type = $image_info["mime"];

            // Traitez les données de l'image comme vous le souhaitez
            // Par exemple, vous pouvez les stocker dans une base de données ou les manipuler directement

            // Afficher un message de succès
            echo "L'image a été téléchargée avec succès.";
        } else {
            echo "Le fichier téléchargé n'est pas une image valide.";
        }
    } else {
        echo "Une erreur est survenue lors du téléchargement de l'image.";
    }
}

    // Prepare and execute the SQL query to insert the event into the database
    $insertQuery = $db->prepare("INSERT INTO events (titre, eve_date, description, lieu, heure_debut, heure_fin, organisateur, email_organisateur, lien, image_data, image_type, article) VALUES (:titre, :eve_date, :description, :lieu, :heure_debut, :heure_fin, :organisateur, :email_organisateur, :lien, :image_data, :image_type, :article)");
    $insertQuery->bindParam(':titre', $titre, PDO::PARAM_STR);
    $insertQuery->bindParam(':eve_date', $eve_date, PDO::PARAM_STR);
    $insertQuery->bindParam(':description', $description, PDO::PARAM_STR);
    $insertQuery->bindParam(':lieu', $lieu, PDO::PARAM_STR);
    $insertQuery->bindParam(':heure_debut', $heure_debut, PDO::PARAM_STR);
    $insertQuery->bindParam(':heure_fin', $heure_fin, PDO::PARAM_STR);
    $insertQuery->bindParam(':organisateur', $organisateur, PDO::PARAM_STR);
    $insertQuery->bindParam(':email_organisateur', $email_organisateur, PDO::PARAM_STR);
    $insertQuery->bindParam(':lien', $lien, PDO::PARAM_STR);
    $insertQuery->bindParam(':image_data', $image_data, PDO::PARAM_LOB); // Utilisez PDO::PARAM_LOB pour les données binaires
    $insertQuery->bindParam(':image_type', $image_type, PDO::PARAM_STR);
    $insertQuery->bindParam(':article', $article, PDO::PARAM_STR);

    // Execute the query
    $insertQuery->execute();

    // Optionally, you can redirect the user to a different page after adding the event
    header('Location: event.php');
    exit(); // Always exit after a header redirect
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Espace Admin</title>
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
    <?php include 'partials/_navbar.php'  ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <?php include 'partials/_settings-panel.html'  ?>
      <?php include 'partials/_sidebar.html'  ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ajouter Événement</h4>
                  <form method="post" action="">
                    <div class="form-group">
                      <label for="exampleInputName1">Titre</label>
                      <input type="text" name="titre" class="form-control" id="exampleInputName1" placeholder="Titre" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputDate">Date de l'événement</label>
                      <input type="date" name="eve_date" class="form-control" id="exampleInputDate" placeholder="Date" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputDescription">Description</label>
                      <textarea class="form-control" name="description" id="exampleInputDescription" rows="4" placeholder="Description" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputLieu">Lieu</label>
                      <input type="text" name="lieu" class="form-control" id="exampleInputLieu" placeholder="Lieu" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputHeureDebut">Heure de début</label>
                      <input type="time" name="heure_debut" class="form-control" id="exampleInputHeureDebut" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputHeureFin">Heure de fin</label>
                      <input type="time" name="heure_fin" class="form-control" id="exampleInputHeureFin" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputOrganisateur">Organisateur</label>
                      <input type="text" name="organisateur" class="form-control" id="exampleInputOrganisateur" placeholder="Organisateur" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail">Adresse Email de l'organisateur</label>
                      <input type="email" name="email_organisateur" class="form-control" id="exampleInputEmail" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputLien">Lien</label>
                      <input type="url" name="lien" class="form-control" id="exampleInputLien" placeholder="Lien">
                    </div>
                    <!-- Zone pour télécharger l'image -->
                   
                    <div class="form-group">
                      <label for="exampleInputImage">Image</label>
                      <input type="file" name="image" class="form-control-file" id="exampleInputImage">
                    </div>
                   
                    <div class="form-group">
                      <label for="exampleInputArticle">Article</label>
                      <textarea class="form-control" name="article" id="exampleInputArticle" rows="4" placeholder="Article"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Ajouter</button>
                    <button class="btn btn-light">Annuler</button>
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
  <?php include 'partials/_footer.html' ?>
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
