<?php
require_once 'connection.php';
session_start();

if(!isset($_SESSION['email'])){
    header("location:index.php");
}
else{
    $email = $_SESSION['email'];
    $nameQuery = "SELECT * FROM users WHERE email='$email';";
    $res1=mysqli_query($con, $nameQuery);
    $row=mysqli_fetch_array($res1);
    $_SESSION['firstName'] = $row['firstName'];
}


if(isset($_GET['content_type'])){
    $uploadTypeSelected = $_GET['content_type'];

    $cafesSql="SELECT * FROM cafes WHERE uploadType='$uploadTypeSelected' AND emailAssigned='$email';";
    $cafesResult=mysqli_query($con, $cafesSql)or die(mysqli_error($con));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Profile</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">

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
  
  <!-- =======================================================
  * Template Name: HeroBiz - v2.1.0
  * Template URL: https://bootstrapmade.com/herobiz-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    
    <div class="profileWrapper">
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top">
          <div class="container-fluid align-items-center d-flex justify-content-between">

            <div class="row">
                <div class="col">
                    <h1><a href = "index.php">CaféBook</a><span>.</span></h1>
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
                  <li><a class="nav-link" href="index.php">Coffee Shops</a></li>
                  <li><a class="active" href="profile.php?content_type=local">Profile</a></li>
              </ul>
              <i class="bi bi-list mobile-nav-toggle d-none"></i>
            </nav>
              
            <div>
              <a class="btn-getstarted" href="logout.php">Log Out</a>
            </div>
          </div>
        </header>
        <!-- End Header -->

        
        <!-- Upload - Page Cover -->
        <div id="uploadCover" onclick="hideUploadMenuLocal(), hideUploadMenuPublic()"></div>
        
        <!-- Local Cafe Upload -->
        <div id="boxLocal" class="uploadBoxWrapper">
            <div class="uploadBox d-flex justify-content-center">
                <button type="button" class="btn btn-close" onclick="hideUploadMenuLocal()" style="position: fixed; top:0; right:0;"></button>
                <form method="post" action="uploadCafe.php" enctype="multipart/form-data" class="d-flex justify-content-center flex-column">
                    <input type="hidden" name="upload_type" value="local">
                    <div class="form-group">
                        <label style="color:white;">Name</label>
                        <input class="form-control" type="text" name="cafe_name">
                    </div>
                    <div class="form-group">
                        <label style="color:white;">Location(search terms)</label>
                        <input class="form-control" type="text" name="cafe_location">
                    </div>
                    <div class="form-group">
                        <label style="color:white;">Description(max 1000 characters)</label>
                        <textarea class="form-control" name="cafe_description" rows="3" maxlength="1000" style="overflow:auto; resize: none;"></textarea>
                    </div>
                    <br/><br/>
                    <div class="form-group">
                        <label style="color:white;">Upload Photo</label>
                        <input class="form-control" type="file" name="image">
                    </div>
                    <br/>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn" style="color:white; background-color:darkgrey;">Upload</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Public Cafe Upload -->
        <div id="boxPublic" class="uploadBoxWrapper">
            <div class="uploadBox d-flex justify-content-center">
                <button type="button" class="btn btn-close" onclick="hideUploadMenuPublic()" style="position: fixed; top:0; right:0;"></button>
                <form method="post" action="uploadCafe.php" enctype="multipart/form-data" class="d-flex justify-content-center flex-column">
                    <input type="hidden" name="upload_type" value="public">
                    <div class="form-group">
                        <label style="color:white;">Name</label>
                        <input class="form-control" type="text" name="cafe_name">
                    </div>
                    <div class="form-group">
                        <label style="color:white;">Location(search terms)</label>
                        <input class="form-control" type="text" name="cafe_location">
                    </div>
                    <div class="form-group">
                        <label style="color:white;">Description(max 1000 characters)</label>
                        <textarea class="form-control" name="cafe_description" rows="3" maxlength="1000" style="overflow:auto; resize: none;"></textarea>
                    </div>
                    <br/><br/>
                    <div class="form-group">
                        <label style="color:white;">Link to an image</label><br/>
                        <input type="url" name="image">
                    </div>
                    <br/>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn" style="color:white; background-color:darkgrey;">Upload</button>
                    </div>
                </form>
            </div>
        </div>
        

        <main id="main">

          <!-- ======= Blog Section ======= -->
          <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

              <div class="row g-5">

                <div class="col-lg-12">

                    <div class="row gy-4 posts-list">
                        
                        <!-- Recommendations label -->
                        <div class="col-lg-12">
                            <article class="d-flex justify-content-center flex-column">
                                <h1 class="title">
                                Hello <?php echo $_SESSION['firstName']; ?>. You recommended the following cafés:
                                </h1>
                                <div class="d-flex justify-content align-self-end">
                                    <div class="read-more mt-auto">
                                        <button class="btn-add" onclick="showUploadMenuPublic()">Add Café Publicly</button>
                                    </div>
                                    <div>&nbsp</div>
                                    <div class="read-more mt-auto">
                                        <button class="btn-add" onclick="showUploadMenuLocal()">Add Café Locally</button>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- End recommendations label -->

                        
                        <!-- Upload Type -->
                        <form id="selectUploadType" method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <div class="d-flex justify-content">
                                <label class="align-self-center" style="color:white; margin-right:1%;">Sort:</label> 

                                <input type="radio" class="btn-check" name="uploadTypeRadio" id="option1" value="local" onclick="window.location = 'profile.php?content_type=local';" <?php if(isset($_GET['content_type'])){if($_GET['content_type']=="local"){echo 'checked';}} ?>>
                                <label class="btn btn-secondary" for="option1">Local</label>

                                <input type="radio" class="btn-check" name="uploadTypeRadio" id="option2" value="public" onclick="window.location = 'profile.php?content_type=public';" <?php if(isset($_GET['content_type'])){if($_GET['content_type']=="public"){echo 'checked';}} ?>>
                                <label class="btn btn-secondary" for="option2">Public</label>
                            </div>
                        </form>
                        <!-- End Upload Type -->
                        
                        <!-- Cafes list -->
                        <div id="cafeList" class="row gy-4 posts-list"> 
                            <?php
                            if(isset($_GET['content_type'])){
                                while($row=mysqli_fetch_array($cafesResult)){
                            ?>
                            <div class="col-lg-6">
                              <article class="d-flex flex-column">
                                  
                                <div class="row">
                                    <div class="col">
                                      <h2 class="title">
                                        <a href="cafe_details.php?name=<?php echo $row['name'];?>&email=<?php echo $_SESSION['email']?>"><?php echo $row['name']; ?></a>
                                      </h2>
                                    </div>
                                    
                                    <div class="col">
                                      <button type="button" id="<?php echo $row['id'];?>" onclick="selectDelete(this.id)" class="btn btn-danger float-end" data-toggle="modal" data-target="#exampleModalCenter">
                                        X
                                      </button>
                                    </div>
                                    
                                </div>

                                <div class="content">
                                  <p>
                                    <?php echo $row['description']; ?>
                                  </p>
                                </div>
                                  
                                <div class="read-more mt-auto align-self-end">
                                  <a href="cafe_details.php?name=<?php echo $row['name'];?>&email=<?php echo $_SESSION['email']?>">Details</a>
                                </div>

                              </article>
                            </div>
                            <?php }} ?>
                        
                        </div>
                        <!-- End Cafes list -->    
                        
                    </div>

                  </div>

                </div>

            </div>
              
            <!-- Delete Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Are you sure you want to delete this cafe?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete('profile', '<?php echo $_GET['content_type']; ?>')">Delete</button>
                  </div>
                </div>
              </div>
            </div>  
            <!-- End Delete Modal -->
            
          </section><!-- End Blog Section -->
          
            
            
        </main><!-- End #main -->

        <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <div id="preloader"></div>

        
    </div>
    
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
      <div class="footer-legal text-center">
        <div class="container d-flex justify-content-center">
            
            <div class="row">
              <div class="footer-info">
                <h3>CaféBook</h3>
                <p>
                  <strong>Author: </strong>Munteanu Teofil<br>
                  <strong>Email: </strong>andreiteofil01@gmail.com<br>
                </p>
              </div>
              <div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10848.673779342269!2d27.5722978!3d47.1741385!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x95f1e37c73c23e74!2sAlexandru%20Ioan%20Cuza%20University%20of%20Ia%C8%99i!5e0!3m2!1sen!2sro!4v1655924747803!5m2!1sen!2sro" width="300" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>
        </div>
      </div>  
    </footer>
    <!-- End Footer -->
    
    
    
    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <script src="assets/js/scripts.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>