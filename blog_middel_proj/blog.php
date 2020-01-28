<?php
require_once '_app/helpers.php';
session_start();
$page_title = 'Blog page';
$link  = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);

$sql = "SELECT u.firstName ,up.profile_image ,p.*, DATE_FORMAT(p.date,'%H:%i:%s &nbsp;&nbsp;  %d/%m/%Y') pdate FROM posts p  
        JOIN users u ON u.id = p.user_id  
        JOIN users_profile up ON u.id = up.user_id
        ORDER BY p.date DESC";

mysqli_query($link, 'SET NAMES utf8');
$result  = mysqli_query($link, $sql);


?>
<?php include_once '_tpl/header.php'; ?>

<main class="min-h750" style="background-image:url(_images/font_blog.jpg);background-size:cover;">
  <div class="container">
    <section class="main-about-content">
      <div class="row">
        <div class="col-12 mt-5">
          <h1 class="display-3 text-info"> blog page</h1>
          <?php if (user_auth()) : ?>
            <a class="btn btn-info" href="add_post.php"><i class="fas fa-plus"></i> Add New Post</a>
          <?php else : ?>
            <a class="" href="signup.php">Create account and add posts</a>
          <?php endif; ?>
        </div>
      </div>

      <div class="row">
        <?php while ($post = mysqli_fetch_assoc($result)) : ?>
          <div class="col-12 my-3">
            <div class="card">
              <div class="card-header color-text text-white ">
                <!-- use in htmlentities כדי למנוע הזרקת קוד זדוני ממשתמש חצוני -->
                <img class="rounded-circle ml-3 mr-3" width="30px" src="_images/<?= $post['profile_image']; ?>" alt="" srcset="">
                <span><?= htmlentities($post['firstName']); ?></span>
                <span class="float-right"><?= $post['pdate']; ?></span>
              </div>
              <div class="card-body">
                <h4 class=""><?= htmlentities($post['title']); ?></h4>
                <!-- use in str_replace כדי שבדפדפן כשכותבים פוסט ויורדים שורה אז זה ירד שורה-->
                <p class="text-secondary"><?= str_replace("\n", '<br>', htmlentities($post['article']));  ?></p>

                <!-- תנאי לזה שאם הוא מחובר יוצג לו האופציה לעשות של המחיקה והשינוי בפוסט -->
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']) : ?>
                  <div class="float-right">
                    <div class="dropleft">
                      <a class="text-dark dropdown-toggle-no-arrow dropdown-toggle text-decoration-none " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="edit_post.php?pid=<?= $post['id']; ?>">
                          <i class="fas fa-edit"></i>

                          Edit</a>
                        <a class="delete-post-btn dropdown-item" href="delete_post.php?pid=<?= $post['id']; ?>">
                          <i class="fas fa-eraser"></i>

                          Delete</a>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>

    </section>
  </div>
</main>
<?php include_once '_tpl/footer.php' ?>