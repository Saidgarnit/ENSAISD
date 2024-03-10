<?php
// Database connection details
include 'config.php';
$userID = $_SESSION['user_id'];

// Fetch only username and email columns
$queryUser = $db->prepare("SELECT prenom,nom, email FROM students WHERE id = :userID");
$queryUser->bindParam(':userID', $userID, PDO::PARAM_INT);

$queryUser->execute();
$user = $queryUser->fetch(PDO::FETCH_ASSOC);


?>


<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="index.html">
            <img src="images/logo.png"   style="width: auto; height: auto" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="index.html">
            <img src="images/logo-mini.svg" alt="logo" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
      <ul class="navbar-nav">
    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
        <?php
        // Output the welcome message with fetched username
        echo '<h1 class="welcome-text">Good Morning, <span class="text-black fw-bold">' . htmlspecialchars($user['nom']) . '  ' . htmlspecialchars($user['prenom']) . '</span></h1>';
        
        // Output the email
        echo '<h3 class="welcome-sub-text">'.$user['email'].'</h3>';
      
        ?>
    </li>
</ul>
        <ul class="navbar-nav ms-auto">
         
          <li class="nav-item d-none d-lg-block">
            <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
              <span class="input-group-addon input-group-prepend border-right">
                <span class="icon-calendar input-group-text calendar-icon"></span>
              </span>
              <input type="text" class="form-control">
            </div>
          </li>
          <li class="nav-item">
            <form class="search-form" action="#">
              <i class="icon-search"></i>
              <input type="search" class="form-control" placeholder="Search Here" title="Search here">
            </form>
          </li>
         
          
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>