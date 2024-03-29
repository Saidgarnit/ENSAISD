<?php
// Establish a connection to your database
$servername = "localhost";  // Change this to your server name
$username = "root";     // Change this to your database username
$password = "";     // Change this to your database password
$dbname = "ecole";  // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch image path, objectifs, and competences from the Securite table
$sql = "SELECT image, objectifs, competences FROM Securite";
$result = $conn->query($sql);

// Check if there are any records
if ($result->num_rows > 0) {
    // Fetch the first record
    $row = $result->fetch_assoc();
    $imagePath = $row['image'];
    $objectifs = $row['objectifs'];
    $competences = $row['competences'];
} else {
    echo "No data found";
}

// Close the database connection
$conn->close();
?>


  
<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">    
      <title>ENSIASD | Securite</title>

      <!-- Favicon -->
      <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">

      <!-- Font awesome -->
      <link href="../assets/css/font-awesome.css" rel="stylesheet">
      <!-- Bootstrap -->
      <link href="../assets/css/bootstrap.css" rel="stylesheet">   
      <!-- Slick slider -->
      <link rel="stylesheet" type="text/css" href="../assets/css/slick.css">          
      <!-- Fancybox slider -->
      <link rel="stylesheet" href="../assets/css/jquery.fancybox.css" type="text/css" media="screen" /> 
      <!-- Theme color -->
      <link id="switcher" href="../assets/css/theme-color/default-theme.css" rel="stylesheet">

      <!-- Main style sheet -->
      <link href="../assets/css/style.css" rel="stylesheet">    

    
      <!-- Google Fonts -->
      <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,700' rel='stylesheet' type='text/css'>
      

      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

    </head>
    <body>
      <a class="scrollToTop" href="#">
        <i class="fa fa-angle-up"></i>      
      </a>
    <!-- END SCROLL TOP BUTTON -->

    <!-- Start header  -->
  
    <!-- End header  -->
    <!-- Start menu -->
    <?php include 'header.php'; ?>
    <!-- End search box -->
  <!-- Page breadcrumb -->
  <section id="mu-page-breadcrumb">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-page-breadcrumb-area">
            <h2>Securite  </h2>
            <ol class="breadcrumb">
              <li><a href="#">Accueil</a></li>            
              <li class="active">Securite </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End breadcrumb -->
  <section id="mu-course-content">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-course-content-area">
            <div class="row">
              <div class="col-md-12">
                <!-- start course content container -->
                <div class="mu-course-container mu-course-details">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="mu-latest-course-single">
                        <figure class="mu-latest-course-img">
                             <a href="#"><img src="<?php echo $imagePath; ?>" alt="img"></a>
                             <figcaption class="mu-latest-course-imgcaption"></figcaption>
                        </figure>
                        <div class="mu-course-details-content">
                          <!-- Objectifs de la Formation -->
                          <div class="mu-course-details-content">
                             <h2>Objectifs de la Formation</h2>
                                 <p><?php echo $objectifs; ?></p>
                                     <h2>Compétences</h2>
                                     <ul>
                                        <?php foreach(explode(';', $competences) as $competence): ?>
                                            <li><?php echo $competence; ?></li>
                                        <?php endforeach; ?>
                                    </ul>           
                        </div>
                          
                    
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end course content container -->
                <!-- start related course item -->

                <!-- end start related course item -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




    <!-- Start footer -->
    <?php include 'footer.php'; ?>
    <!-- End footer -->





    
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
  