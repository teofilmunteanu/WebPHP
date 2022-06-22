<?php
require_once 'connection.php';
$table="users";
session_start();

if(!isset($_SESSION['email'])){
    header("location:index.php");
}
else{
    $email = $_SESSION['email'];
    $nameQuery = "SELECT * FROM $table WHERE email='$email'";
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

              <h1><a href = "index.php">CaféBook</a><span>.</span></h1>

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
        <div id="uploadCover"></div>
        
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

                        
                        <!-- Recommendations list -->
                        <form id="selectUploadType" method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <div class="d-flex justify-content">
                                <label class="align-self-center" style="color:white; margin-right:1%;">Sort:</label> 

                                <input type="radio" class="btn-check" name="uploadTypeRadio" id="option1" value="local" onclick="window.location = 'profile.php?content_type=local';" <?php if(isset($_GET['content_type'])){if($_GET['content_type']=="local"){echo 'checked';}} ?>>
                                <label class="btn btn-secondary" for="option1">Local</label>

                                <input type="radio" class="btn-check" name="uploadTypeRadio" id="option2" value="public" onclick="window.location = 'profile.php?content_type=public';" <?php if(isset($_GET['content_type'])){if($_GET['content_type']=="public"){echo 'checked';}} ?>>
                                <label class="btn btn-secondary" for="option2">Public</label>
                            </div>
                        </form>
                        <!-- End Recommendations list -->
                        
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
                                        <a href="cafe_details.php"><?php echo $row['name']; ?></a>
                                      </h2>
                                    </div>
                                    
                                    <div class="col">
                                      <a class="btn btn-danger float-end" href='delete.php?id=<?php echo $row['id'];?>'>X</a>
                                    </div>
                                    
                                </div>


                                <div class="meta-top">
                                  <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i>John Doe</li>
                                  </ul>
                                </div>

                                <div class="content">
                                  <p>
                                    <?php echo $row['description']; ?>
                                  </p>
                                </div>
                                  
                                <div class="read-more mt-auto align-self-end">
                                  <a href="cafe_details.php?name=<?php echo $row['name']; ?>">Details</a>
                                </div>

                              </article>
                            </div>
                            <?php }} ?>
                        <!-- End Cafes list -->
                            
                            
                            <!--
                            <div class="col-lg-6">
                              <article class="d-flex flex-column">

                                <div class="post-img">
                                  <img src="assets/img/blog/blog-2.jpg" alt="" class="img-fluid">
                                </div>

                                <h2 class="title">
                                  <a href="blog-details.html">Nisi magni odit consequatur autem nulla dolorem</a>
                                </h2>

                                <div class="meta-top">
                                  <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">John Doe</a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2022-01-01">Jan 1, 2022</time></a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">12 Comments</a></li>
                                  </ul>
                                </div>

                                <div class="content">
                                  <p>
                                    Incidunt voluptate sit temporibus aperiam. Quia vitae aut sint ullam quis illum voluptatum et. Quo libero rerum voluptatem pariatur nam.
                                  </p>
                                </div>

                                <div class="read-more mt-auto align-self-end">
                                  <a href="blog-details.html">Read More</a>
                                </div>

                              </article>
                            </div><!-- End post list item -->
                            
                            <!--
                            <div class="col-lg-6">
                              <article class="d-flex flex-column">

                                <div class="post-img">
                                  <img src="assets/img/blog/blog-3.jpg" alt="" class="img-fluid">
                                </div>

                                <h2 class="title">
                                  <a href="blog-details.html">Possimus soluta ut id suscipit ea ut. In quo quia et soluta libero sit sint.</a>
                                </h2>

                                <div class="meta-top">
                                  <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">John Doe</a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2022-01-01">Jan 1, 2022</time></a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">12 Comments</a></li>
                                  </ul>
                                </div>

                                <div class="content">
                                  <p>
                                    Aut iste neque ut illum qui perspiciatis similique recusandae non. Fugit autem dolorem labore omnis et. Eum temporibus fugiat voluptate enim tenetur sunt omnis.
                                  </p>
                                </div>

                                <div class="read-more mt-auto align-self-end">
                                  <a href="blog-details.html">Read More</a>
                                </div>

                              </article>
                            </div><!-- End post list item -->
                            
                            
                        </div>

                    </div>

                  </div>

                </div>

            </div>
          </section><!-- End Blog Section -->

        </main><!-- End #main -->

        <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <div id="preloader"></div>

        
    </div>
    
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

</body>

</html>