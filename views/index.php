<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>ENSIASD | Home</title>

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
  <?php include 'header.php'; ?>

  <!-- Start Slider -->
  <section id="mu-slider">
    <!-- Start single slider item -->
    <div class="mu-slider-single">
      <div class="mu-slider-img">
        <figure>
          <img src="../assets/img/slider/1.jpg" alt="img">
        </figure>
      </div>
      <div class="mu-slider-content">
        <h4>Bienvenu á l'ENSIASD</h4>
        <span></span>
        <h2>ECOLE SUPERIEURE DE L'INTELIGENCE ARTIFICIELLE ET SCIENCES DE DONNEES</h2>
      </div>
    </div>
    <!-- Start single slider item -->
    <!-- Start single slider item -->
    <div class="mu-slider-single">
      <div class="mu-slider-img">
        <figure>
          <img src="../assets/img/slider/2.jpg" alt="img">
        </figure>
      </div>
      <div class="mu-slider-content">
        <h4>Bienvenu á l'ENSIASD</h4>
        <span></span>
        <h2>École d'ingénieurs de haut niveau</h2>
      </div>
    </div>
    <!-- Start single slider item -->
    <!-- Start single slider item -->
    <div class="mu-slider-single">
      <div class="mu-slider-img">
        <figure>
          <img src="../assets/img/slider/3.jpg" alt="img">
        </figure>
      </div>
      <div class="mu-slider-content">
        <h4>Bienvenu á l'ENSIASD</h4>
        <span></span>
        <h2>Deux filiéres d'ingénieurs en domaine informatique</h2>
      </div>
    </div>
    <!-- Start single slider item -->    
  </section>
  <!-- End Slider -->
  <!-- Start service  -->

  <!-- End service  -->

  <!-- Start about us -->
  <section id="mu-about-us">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-about-us-area">           
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <div class="mu-about-us-left">
                  <!-- Start Title -->
                  <div class="mu-title">
                    <h2>Mot de directeur</h2>              
                  </div>
                  <!-- End Title -->
                  <p>se distingue par son engagement envers l'excellence éducative, offrant une plateforme dynamique dédiée à l'avancement
                     des connaissances en Intelligence Artificielle (IA) et en Science des Données. Sa mission consiste à former
                      des professionnels et chercheurs qualifiés, favorisant un environnement propice à l'innovation et à la pensée critique.
                       Grâce à l'intégration de technologies de pointe, l'école vise à façonner les futurs leaders en IA et en Science des Données,
                        contribuant ainsi à des avancées transformantes dans la technologie, la recherche et les applications industrielles .
                        se distingue par son engagement envers l'excellence éducative, offrant une plateforme dynamique dédiée à l'avancement
                        des connaissances en Intelligence Artificielle (IA) et en Science des Données. Sa mission consiste à former
                         des professionnels et chercheurs qualifiés</p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="mu-about-us-right">                            
               
                  <img src="../assets/img/about-us.jpg" alt="img" height="350" width="555">
                              
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End about us -->



  <section id="mu-from-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-from-blog-area">
            <!-- start title -->
            <div class="mu-title">
              <h2>ANNONCES
              </h2>
              
            </div>     
            <?php
// Connexion à la base de données
$servername = "localhost"; // Adresse du serveur MySQL
$username = "root"; // Nom d'utilisateur MySQL
$password = ""; // Mot de passe MySQL
$database = "ecole"; // Nom de la base de données

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête SQL pour sélectionner les annonces
$sql = "SELECT * FROM annonces";
$result = $conn->query($sql);

// Affichage des annonces
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h2>" . $row["tittle"] . "</h2>";
        echo "<p>" . $row["description"] . "</p>";
        echo "<a href='Login.html' style='float:right;'>Voire Détails</a>";

        // Ajoutez d'autres champs de votre table d'annonces ici...
        echo "</div>";
    }
} else {
    echo "Aucune annonce trouvée.";
}

// Fermer la connexion
$conn->close();
?>

          </div>
        </div>
      </div>
    </div>
  </section>




  <section id="mu-from-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-from-blog-area">
            <!-- start title -->
            <div class="mu-title">
              <h2>ENSIASDT en chiffres
              </h2>
            
            </div>     
            <!-- end from blog content   -->   
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- Start about us counter -->
  <section id="mu-abtus-counter">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-abtus-counter-area">
            <div class="row">
              <!-- Start counter item -->
              <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="mu-abtus-counter-single">
                  <span class="fa fa-book"></span>
                  <h4 class="counter">2</h4>
                  <p>filiéres</p>
                </div>
              </div>
              <!-- End counter item -->
              <!-- Start counter item -->
              <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="mu-abtus-counter-single">
                  <span class="fa fa-users"></span>
                  <h4 class="counter">60</h4>
                  <p>Éléves</p>
                </div>
              </div>
              <!-- End counter item -->
              <!-- Start counter item -->
              <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="mu-abtus-counter-single">
                  <span class="fa fa-flask"></span>
                  <h4 class="counter">20</h4>
                  <p>Classes</p>
                </div>
              </div>
              <!-- End counter item -->
              <!-- Start counter item -->
              <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="mu-abtus-counter-single no-border">
                  <span class="fa fa-user-secret"></span>
                  <h4 class="counter">16</h4>
                  <p>Professeurs</p>
                </div>
              </div>
              <!-- End counter item -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End about us counter -->

  <!-- Start features section -->
 
  <!-- End features section -->

  <!-- Start latest course section -->

  <section id="mu-from-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-from-blog-area">
            <!-- start title -->
            <div class="mu-title">
              <h2>Events Récents
              </h2>
            
            </div>     
            <!-- end from blog content   -->   
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="mu-latest-courses">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="mu-latest-courses-area">
            <!-- Start Title -->
            <div class="mu-title">
         
            </div>
            <!-- End Title -->
            <!-- Start latest course content -->
            <div id="mu-latest-course-slide" class="mu-latest-courses-content">
              <div class="col-lg-4 col-md-4 col-xs-12">
                
              </div>
            </div>
            <!-- End latest course content -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End latest course section -->

  <!-- Start our teacher -->
  <section id="mu-our-teacher">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-our-teacher-area">
            <!-- begain title -->
            <div class="mu-title">
              <h2>Qu'est ce que les autres pense sur l'ENSIASDT ?
              </h2>
            <!-- End our teacher content -->           
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- End our teacher -->









  

  <!-- Start testimonial -->
  <section id="mu-testimonial">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-testimonial-area">
            <div id="mu-testimonial-slide" class="mu-testimonial-content">
              <!-- start testimonial single item -->
              <div class="mu-testimonial-item">
                <div class="mu-testimonial-quote">
                  <blockquote>
                    <p>L'une des milleures écoles d'ingénieurs au maroc, icroyable.</p>
                  </blockquote>
                </div>
                <div class="mu-testimonial-img">
                  <img src="../assets/img/images.jpg" alt="img">
                </div>
                <div class="mu-testimonial-info">
                  <h4>Ahmed Assimi</h4>
                  <span>Etudiant á FS Agadir</span>
                </div>
              </div>
              <!-- end testimonial single item -->
              <!-- start testimonial single item -->
              <div class="mu-testimonial-item">
                <div class="mu-testimonial-quote">
                  <blockquote>
                    <p>C'es une école innovante avec leure directeurs et des professeurs compétents, Bon courage pour les étudiants.</p>
                  </blockquote>
                </div>
                <div class="mu-testimonial-img">
                  <img src="../assets/img/images.jpg" alt="img">
                </div>
                <div class="mu-testimonial-info">
                  <h4>Malika Harba</h4>
                  <span>Doctorant</span>
                </div>
              </div>
              <!-- end testimonial single item -->
              <!-- start testimonial single item -->
              <div class="mu-testimonial-item">
                <div class="mu-testimonial-quote">
                  <blockquote>
                    <p>Une formation forte, c'est l'un des poit de force de cette école, J'aime l'ambiance d'apprentissage, c'est magnifique.</p>
                  </blockquote>
                </div>
                <div class="mu-testimonial-img">
                  <img src="../assets/img/images.jpg" alt="img">
                </div>
                <div class="mu-testimonial-info">
                  <h4>Rachid Raslmida</h4>
                  <span>étudiant á EST Fes</span>
                </div>
              </div>
              <!-- end testimonial single item -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End testimonial -->

  <!-- Start from blog -->
  <section id="mu-from-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-from-blog-area">
            <!-- start title -->
            <div class="mu-title">
              <h2>Visiter ENSIASDT
              </h2>
            
            </div>     
            <!-- end from blog content   -->   
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End from blog -->
  <section class="google-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1539.844346642147!2d-8.866205775339228!3d30.493363771595163!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdb173001472dcc1%3A0x3f2507f09223083!2sEcole%20Nationale%20Sup%C3%A9rieure%20de%20l&#39;Intelligence%20Artificielle%20et%20Sciences%20des%20Donn%C3%A9es!5e0!3m2!1sar!2sma!4v1706800151346!5m2!1sar!2sma"
        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>


  <!-- End footer -->
  <script src="eventScript.js"></script>
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

  <?php include 'footer.php'; ?>

  </body>
</html>