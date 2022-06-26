<?php
require_once 'connection.php';
session_start();

if(!isset($_SESSION['email'])){
    header("location:index.php");
}
else
{
    $currentUser = $_SESSION['email'];
    $userSql="SELECT * FROM users WHERE email='$currentUser';";
    $userResult=mysqli_query($con, $userSql)or die(mysqli_error($con));
    $userType=mysqli_fetch_array($userResult)['userType'];
    
    $email = $_GET['email'];
    $cafeName = $_GET['name'];
    $cafesSql="SELECT * FROM cafes WHERE name='$cafeName' AND emailAssigned='$email';";
    $cafesResult=mysqli_query($con, $cafesSql)or die(mysqli_error($con));
    $row=mysqli_fetch_array($cafesResult);
}

?>

<html>
    <head>
        <title>Profile</title> 
        
        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
        
        <!-- Variables CSS Files. Uncomment your preferred color scheme -->
        <link href="assets/css1/variables-orange.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="assets/css1/mainstyle7.css" rel="stylesheet">
    </head>
    
    <body>
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top" data-scrollto-offset="0">
          <div class="container-fluid d-flex align-items-center justify-content-between">

            <div class="row">
                <div class="col">
                    <h1><a href = "index.php" onclick="saveAudioTime()">CaféBook</a><span>.</span></h1>
                </div>
                <div class="col">
                    <div class="row">
                        <svg width="50" height="20" >
                            <path d="M 10 1 C 7 5, 7 6, 11 9 S 13 15, 10 18" stroke="white" fill="transparent"/>
                            <path d="M 20 1 C 17 5, 17 6, 21 9 S 23 15, 20 18" stroke="white" fill="transparent"/>
                            <path d="M 30 1 C 27 5, 27 6, 31 9 S 33 15, 30 18" stroke="white" fill="transparent"/>
                        </svg>
                    </div>
                    <div class="row">
                        <svg width="50" height="20" >
                            <circle cx="20" cy="0" r="16" fill="orange"/>
                            <path d="M 29 11 C 43 11, 43 -2, 35 3" fill="none" stroke="orange" stroke-width="2"/>
                        </svg>
                    </div>
                </div>
                
            </div>

            <nav id="navbar" class="navbar">
              <ul>
                  <li><a class="nav-link" href="index.php" onclick="saveAudioTime()">Coffee Shops</a></li>
                  <li><a class="nav-link" href="profile.php?content_type=local" onclick="saveAudioTime()">Profile</a></li>
              </ul>
              <i class="bi bi-list mobile-nav-toggle d-none"></i>
            </nav>
              
            <div>
              <a class="btn-getstarted" href="logout.php">Log Out</a>
            </div>
          </div>
        </header>
        <!-- End Header -->
        
        
        <!-- Music Controller -->
        <audio id="music" autoplay loop>
            <source src="assets/audio/Ichika_Nito_Felling.mp3" type="audio/mpeg">
        </audio>
        
        <div id="musicOptions">
            <button class="btn" onclick="toggleMusicOptions()"><i class="bi bi-music-note-beamed"></i></button>
        </div>
        
        <div id="musicController">
            <input type="range" orient="vertical"  min="0" max="1" step="0.1" id="volume" onchange="setVolume(this.value);"> 
        </div>
        <!-- End Music Controller -->
        
        
        <main id="main">

          <!-- ======= Blog Section ======= -->
          <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

              <div class="row g-5">

                <div class="col-lg-12">        
                  <div class="row gy-4 posts-list"> 

                    <div class="col-lg-12">
                      <article>
                        <div class="container">
                            <div class="row">
                              <div class="col">
                                <h1 style="color:#485664">
                                    <?php echo $row['name'];?>
                                </h1>
                                <h4>Description:</h4>
                                <p>
                                  <?php echo $row['description']; ?>
                                </p>
                                
                                <div>
                                  <h4>Location:</h4>
                                  <?php echo $row['location']; ?>
                                  
                                  <!-- SOURCE: https://www.embedgooglemap.net Exemplu q=palatul%20culturii%20iasi-->
                                  <div class="mapouter">
                                      <?php 
                                      $searchItem = $row['location'];
                                      $searchItem = str_replace(" ","%20", $searchItem);
                                      ?>
                                      <div class="gmap_canvas">
                                          <iframe width="500" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=<?php echo $searchItem; ?>&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                          <style>.mapouter{position:relative;text-align:right;height:500px;width:500px;}</style>
                                          <style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:500px;}</style>
                                      </div>
                                  </div>
                                </div>
                              </div>
                                
                              <div class="col">
                                <div class="row d-flex justify-content-center">
                                  <img src ="<?php echo $row['image']; ?>" style='float:right; height: 70%; width: 70%;'>
                                </div>
                                <br/><br/>
                                
                                <?php if($currentUser == $email || $userType== "admin") {?>
                                <div class="row row d-flex justify-content-center">
                                    <div class="col-lg-2">
                                        <a class="btn-add" href="cafe_details_edit.php?name=<?php echo $row['name'];?>&email=<?php echo $row['emailAssigned'];?>&type=<?php echo $row['uploadType'];?>" style="color:white;" onclick="saveAudioTime()">Edit</a>
                                    </div> 
                                </div>
                                <?php } ?>
                              </div>
                            </div>
                        </div>
                          
                      </article>

                    </div><!-- End post list item -->

                  </div>

                </div>

              </div>

            </div>
          </section><!-- End Blog Section -->

        </main><!-- End main -->
        
        <!-- Vendor JS Files -->
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/aos/aos.js"></script>
        <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>
        
        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>
        <script src="assets/js/mediaScripts.js"></script>
    </body>
</html>
