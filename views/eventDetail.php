<?php
include 'config.php';

// Function to fetch a single event by ID from the database
function fetchEventById($conn, $eventId)
{
  try {
    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->bind_param('i', $eventId);
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Fetch the event as an associative array
    $event = $result->fetch_assoc();

    // Free result
    $result->free();

    return $event;
  } catch (mysqli_sql_exception $e) {
    // Handle database errors
    die("Error fetching event: " . $e->getMessage());
  }
}

// Check if the event ID is passed through the URL
if (isset($_GET['id'])) {
  $eventId = $_GET['id'];
  // Fetch event by ID
  $event = fetchEventById($conn, $eventId);
} else {
  // Error handling if event ID is not provided
  echo "Error: Event ID not provided.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ENSIASD | Event details</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon" />
  <link rel="icon" href="../assets/img/ji.png" type="image/png">

  <!-- Font awesome -->
  <link href="../assets/css/font-awesome.css" rel="stylesheet" />
  <!-- Bootstrap -->
  <link href="../assets/css/bootstrap.css" rel="stylesheet" />
  <!-- Slick slider -->
  <link rel="stylesheet" type="text/css" href="../assets/css/slick.css" />
  <!--<link rel="stylesheet" href="Event details.css">-->

  <!-- Fancybox slider -->
  <link rel="stylesheet" href="../assets/css/jquery.fancybox.css" type="text/css" media="screen" />
  <!-- Theme color -->
  <link id="switcher" href="../assets/css/theme-color/default-theme.css" rel="stylesheet" />

  <!-- Main style sheet -->
  <link href="../assets/css/style.css" rel="stylesheet" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,700" rel="stylesheet" type="text/css" />

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <!--START SCROLL TOP BUTTON -->
  <a class="scrollToTop" href="#">
    <i class="fa fa-angle-up"></i>
  </a>
  <!-- END SCROLL TOP BUTTON -->

  <!-- Start header  -->
  <?php include 'header.php'; ?>
  <!-- End header  -->
  <!-- Start menu -->
  <!-- End menu -->
  <!-- Start search box -->
  <div id="mu-search">
    <div class="mu-search-area">
      <button class="mu-search-close">
        <span class="fa fa-close"></span>
      </button>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <form class="mu-search-form">
              <input type="search" placeholder="Type Your Keyword(s) & Hit Enter" />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End search box -->
  <!-- Page breadcrumb -->
  <section id="mu-page-breadcrumb">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-page-breadcrumb-area">
            <?php
            if (isset($event)) {
            ?>
              <h1 style="color: aliceblue"><?php echo $event['titre']; ?></h1>
              <p style="color: aliceblue">
                <?php echo $event['description']; ?>
              </p>
            <?php
            } else {
              // Si aucun événement n'est trouvé
              echo "<p>Aucun événement trouvé.</p>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End breadcrumb -->
  <!--
  --------------
-->
  <section class="py-5 text-center container"></section>
  <!-- start fetching-->

  <!-- end fetching-->

  <!-- Start error section  -->
  <section id="mu-error">
  <div class="container">
    <?php
    if (isset($event)) {
    ?>
      <div class="row">
        <div class="col-md-6">
          <article class="event-article">
            <?php
            // Split the article text into paragraphs
            $paragraphs = explode("\n", $event['article']);

            foreach ($paragraphs as $paragraph) {
              // Check if paragraph is not empty
              if (!empty(trim($paragraph))) {
                // Extract the first character
                $first_character = substr($paragraph, 0, 1);
                // Remove the first character from the paragraph
                $paragraph_content = substr($paragraph, 1);
                ?>
                <p><span class="first-char"><?php echo $first_character; ?></span><?php echo $paragraph_content; ?></p>
                <?php
              }
            }
            ?>
            <!-- Vous pouvez ajouter d'autres détails de l'événement ici -->
            <p>Date: <?php echo $event['eve_date']; ?></p>
            <p>Location: <?php echo $event['lieu']; ?></p>
            <p>Lien: <?php echo $event['lien']; ?></p>
          </article>
        </div>
        <div class="col-md-6">
          <?php if (isset($event['image_data'])) { ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($event['image_data']); ?>" alt="Event Image" class="img-fluid">
          <?php } ?>
        </div>
      </div>
    <?php
    } else {
      // Si aucun événement n'est trouvé
      echo "<p>Aucun événement trouvé.</p>";
    }
    ?>
    <style>
      .first-char {
        font-weight: bold;
      }
    </style>
  </div>
</section>


  <!-- End error section  -->
  <!-- Start footer -->
  <?php include 'footer.php'; ?>

  <!-- End footer -->
  <script src="eventDetails.js"></script>

  <!-- jQuery library -->
  <script src="../assets/js/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="../assets/js/bootstrap.js"></script>
  <!-- Slick slider -->
  <script type="text/javascript" src="../assets/js/slick.js"></script>
  <!-- Counter -->
  <script type="text/javascript" src="../assets/js/waypoints.js"></script>
  <script type="text/javascript" src="../assets/js/jquery.counterup.js"></script>
  <!-- Mixit slider -->
  <script type="text/javascript" src="../assets/js/jquery.mixitup.js"></script>
  <!-- Add fancyBox -->
  <script type="text/javascript" src="../assets/js/jquery.fancybox.pack.js"></script>

  <!-- Custom js -->
  <script src="../assets/js/custom.js"></script>
</body>

</html>