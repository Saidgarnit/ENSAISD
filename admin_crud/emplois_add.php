<?php
// Inclure les configurations communes
include 'config.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si non connecté
    header('Location: login.php');
    exit();
}

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valider et nettoyer les données pour chaque champ d'entrée
    $src = filter_input(INPUT_POST, 'src', FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

    // Vérifier si tous les champs d'entrée sont vides ou non fournis
    $requiredFields = array($src, $description);
    foreach ($requiredFields as $field) {
        if (empty($field)) {
            echo "Le champ description est vide !";
            exit();
        }
    }

    // Insérer les informations de l'emploi dans la base de données
    $insertQuery = $db->prepare("INSERT INTO emplois (src, description) VALUES (:src, :description)");
    $insertQuery->bindParam(':src', $src, PDO::PARAM_STR);
    $insertQuery->bindParam(':description', $description, PDO::PARAM_STR);
    $insertQuery->execute();

    // Rediriger vers la page de liste des emplois ou afficher un message de succès
    header('Location: list_emplois.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Meta tags requis -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Ajouter un emploi</title>
  <link rel="icon" href="../assets/img/ji.png" type="image/png">

  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css pour cette page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="js/select.dataTables.min.css">
  <!-- End plugin css pour cette page -->
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
                  <h4 class="card-title">Ajouter un emploi</h4>
                  <form class="form-sample" method="post">
                    <div class="form-group">
                      <label for="exampleInputSrc">Src</label>
                      <input type="text" name="src" class="form-control" id="exampleInputSrc" placeholder="Src">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputDescription">Description</label>
                      <textarea class="form-control" name="description" id="exampleInputDescription" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Ajouter</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
</body>
</html>
