<?php
include_once '_app/helpers.php';

session_start();

if (!user_auth()) {
  header('location: signin.php');
  exit;
}

if (isset($_GET['pid']) && is_numeric($_GET['pid'])) {


  $pid = filter_input(INPUT_GET, 'pid', FILTER_SANITIZE_STRING);

  if ($pid) {
    $uid = $_SESSION['user_id'];

    $link  = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
    mysqli_query($link, 'SET NAMES utf8');
    $pid = mysqli_real_escape_string($link, $pid);
    $sql = "SELECT * FROM posts WHERE id = $pid AND user_id = $uid";
    $result = mysqli_query($link, $sql);

    if ($result && mysqli_num_rows($result) == 1) {

      $post = mysqli_fetch_assoc($result);
    } else {

      header('location: blog.php');
      exit;
    }
  } else {

    header('location: blog.php');
    exit;
  }
} else {

  header('location: blog.php');
  exit;
}
$page_title = 'Edit Posts page';

$errors = [
  'title' => '',
  'article' => '',
];

if (isset($_POST['submit'])) {
  // uses in filter_input הפונקציה מנקה את כל התוים שיכולים להיות זדונים ולמנוע פריצה דרך השדות
  $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  $article = filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING);
  $form_valid = true;

  if (!$title || mb_strlen($title) < 2) {
    $form_valid = false;
    $errors['title'] = '* Title is requaird for min 2 chars';
  }
  if (!$article || mb_strlen($article) < 2) {
    $form_valid = false;
    $errors['article'] = '* Article is requaird for min 2 chars';
  }

  if ($form_valid) {
    // מנקה מאיס קיו אל יינג׳קשן'
    $title  = mysqli_real_escape_string($link, $title);
    $article  = mysqli_real_escape_string($link, $article);
   //מעדכן את הפוסט אחרי שהוא לחץ על עידון ומעדכן את הפוסט מחדש
    $sql = "UPDATE posts SET title = '$title',article = '$article' WHERE id = $pid ";
    //גם אם הוא מעדן או שלא מעדן זה יעביר אותו לדף הבלוג בעט לחיצה על הלחצן
    $result = mysqli_query($link, $sql);
    header('location: blog.php');
    exit;
  }
}
?>
<?php
include_once '_tpl/header.php';
?>

<main class="min-h750 img-font" style="background-image:url(_images/add_post.jpg) ;background-size:cover;">
  <div class="container">
    <section id="main-add-post-content">
      <div class="row">
        <div class="col mt-5">
          <h1 class="display-3 text-info">
            Add Your new post
          </h1>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <form action="" method="POST" novalidate="novalidate" autocomplete="off">
            <div class="form-group">
              <label for="title">* Title</label>
              <input value="<?= $post['title']; ?>" type="text" name="title" id="title" class="form-control">
              <span class="text-danger"><?= $errors['title']; ?></span>
            </div>
            <div class="form-group">
              <label for="article">* Article</label>
              <textarea class="form-control" name="article" id="article" cols="30" rows="10"><?= $post['article']; ?></textarea>
              <span class="text-danger"><?= $errors['article']; ?></span>
            </div>
            <input type="submit" value="Update Post" name="submit" class="btn btn-info">
            <a href="blog.php" class="btn btn-secondary">Cancel</a>
          </form>
        </div>
      </div>
    </section>
  </div>
</main>
<?php include_once '_tpl/footer.php' ?>