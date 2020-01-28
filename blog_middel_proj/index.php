<?php
session_start();
$page_title = 'Home page';
require '_tpl/header.php';
$box = 0;
$link  = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
$sql = "SELECT u.firstName ,up.profile_image ,p.*, DATE_FORMAT(p.date,'%d/%m/%Y %H:%i:%s') pdate FROM posts p  
        JOIN users u ON u.id = p.user_id  
        JOIN users_profile up ON u.id = up.user_id
        ORDER BY p.date DESC
        LIMIT 4";

mysqli_query($link, 'SET NAMES utf8');
$result  = mysqli_query($link, $sql);
$users = mysqli_fetch_assoc($result);
$i = 1;//מונה להצגת תמונה בבלוג של דף הבית 
?>
<main class="min-h750 bg-white">
  <div class="container ">
    <section id="main-top-containt ">
      <div class="row ">
        <div class="col-12 mt-5">
          <h1 class="text-info text-center display-4 mr-5 ml-5">Ask your professional health care.</h1>
          <p class="text-center  ">Welcome to the pharmacy blog.</pre>
            <div class="container">
              <div class="row">
                <div class="col-12 text-center ">
                  <img class=" col-md" src="_images/bg_general.jpg" alt="">

                </div>
              </div>
            </div>
            <?php if (!user_auth()) : ?>
              <p class="text-center">
                <a href="signup.php" class="btn btn-info btn-lg active mt-3 " role="button" aria-pressed="true">Join Us</a>
              </p>
            <?php else : ?>
              <p class="text-center">
                <a href="add_post.php" class="btn btn-info btn-lg active mt-3 " role="button" aria-pressed="true">Add post</a>
              </p>
            <?php endif; ?>

        </div>
      </div>
    </section>

  </div>
  <section class="container-fluid middel-bage min-h750" style="background-image:url(_images/) ;background-size:cover;">

    <div class="container">
      <p class=" text-center  display-4 mt-5">
        News Blogs
        <span class="parag-news"></span>
      </p>
      <section class=" d-lg-flex" height="550px">
        <div class="row">
          <div class="col-12">

            <div class="card-deck">
              <!-- card 1 -->
              <?php while ($post = mysqli_fetch_assoc($result)) : ?>

                <div class=" col-lg-4 card shadow p-1 mb-5 bg-white rounded">
                  <img width="20px" height="330px" src="_images/card_<?= $i ?>.jpg" class="card-img-top" alt="...">
                  <div class="card-body  ">
                    <h5 class="card-title"><?= $post['title']; ?></h5>
                    <!-- limit  -->
                    <p class="card-text "><?= htmlentities(substr($post['article'],0,100)); ?></span></p>
                    <p class="card-text"><small class="text-muted"><?= $post['pdate'] ?></small></p>
                    <a href="blog.php">Continue reading</a>
                  </div>
                </div>
              <?php $i++;
              endwhile; ?>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>

</main>
<?php require '_tpl/footer.php' ?>

<?php if (user_auth() && isset($_SESSION['blog_action'])) : ?>
  <script>
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-center",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "3000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }


    <?php

      switch ($_SESSION['blog_action']) {
        case "FIRST_SIGNIN_INDICATOR":
          echo 'toastr["success"]("Welcome back, Login Succeeded")';
          break;
        case "FIRST_SIGNUP_INDICATOR":
          echo 'toastr["success"]("<b>Welcome to Pharmacy !<b>"," Signup Succeeded")';
          break;
      }
      unset($_SESSION['blog_action']);
      ?>
  </script>
<?php endif; ?>