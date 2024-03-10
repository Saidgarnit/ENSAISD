<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>ENSIASD | Contact</title>

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

<!--START SCROLL TOP BUTTON -->
<a class="scrollToTop" href="#">
    <i class="fa fa-angle-up"></i>      
</a>
<!-- END SCROLL TOP BUTTON -->

<?php include 'header.php'; ?>
<!-- Page breadcrumb -->
<section id="mu-page-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mu-page-breadcrumb-area">
                    <h2>Contact</h2>
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>            
                        <li class="active">Contact</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumb -->

<!-- Start contact  -->
<section id="mu-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mu-contact-area">
                    <!-- start title -->
                    <div class="mu-title">
                        <h2>Prenez contact</h2>
                    </div>
                    <!-- end title -->
                    <!-- start contact content -->
                    <div class="mu-contact-content">           
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mu-contact-left">
                                    <form class="contactform" method="post" action="insert_contact.php">
                                        <p class="comment-form-author">
                                            <label for="author">Nom <span class="required">*</span></label>
                                            <input type="text" required="required" size="30" value="" name="name" id="name">
                                        </p>
                                        <p class="comment-form-email">
                                            <label for="email">Email <span class="required">*</span></label>
                                            <input type="email" required="required" aria-required="true" value="" name="email" id="email">
                                        </p>
                                        <p class="comment-form-url">
                                            <label for="subject">Sujet</label>
                                            <input type="text" name="subject" id="subject">  
                                        </p>
                                        <p class="comment-form-comment">
                                            <label for="comment">Message</label>
                                            <textarea required="required" aria-required="true" rows="8" cols="45" name="message" id="message"></textarea>
                                        </p>                
                                        <p class="form-submit">
                                            <input type="submit" value="Envoyer le message" class="mu-post-btn" name="submit">
                                        </p>        
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mu-contact-right">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1539.844346642147!2d-8.866205775339228!3d30.493363771595163!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdb173001472dcc1%3A0x3f2507f09223083!2sEcole%20Nationale%20Sup%C3%A9rieure%20de%20l&#39;Intelligence%20Artificielle%20et%20Sciences%20des%20Donn%C3%A9es!5e0!3m2!1sar!2sma!4v1706800151346!5m2!1sar!2sma" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end contact content -->
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Préparer et exécuter la requête SQL pour insérer les données
    $sql = "INSERT INTO contactus (nom, email, sujet, message) VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message envoyé avec succès.";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }

    // Fermer la connexion
    $conn->close();
}
?>

<!-- End contact  -->

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
