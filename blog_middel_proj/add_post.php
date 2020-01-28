<?php
include_once '_app/helpers.php';

session_start();

if (!user_auth()) {
  header('location: signin.php');
  exit;
}

$page_title = 'Add Posts page';

$errors = [
  'title' => '',
  'article' => '',
];

if (isset($_POST['submit'])) {
  // uses in filter_input הפונקציה מנקה את כל התוים שיכולים להיות זדונים ולמנוע פריצה דרך השדות
  $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
  $article = filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
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
    $uid = $_SESSION['user_id'];
    $link  = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
    // מנקה מאיס קיו אל יינג׳קשן'
    $title  = mysqli_real_escape_string($link, $title);
    $article  = mysqli_real_escape_string($link, $article);
    // שומר את הפוסט בבסיס נתונים בקידוד של יו טי אף 8
    mysqli_query($link, 'SET NAMES utf8');
    // null מכוון שהגדרנו בבסיס נתונים כבר
    $sql = "INSERT INTO posts VALUES(null,$uid,'$title','$article',NOW())";
    $result = mysqli_query($link, $sql);

    if ($result && mysqli_affected_rows($link) > 0) {
      header('location: blog.php');
    }
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
              <input value="<?= old('title'); ?>" type="text" name="title" id="title" class="form-control">
              <span class="text-danger"><?= $errors['title']; ?></span>
            </div>
            <div class="form-group">
              <label for="article">* Article</label>
              <textarea class="form-control" name="article" id="article" cols="30" rows="10"><?= old('article'); ?></textarea>
              <span class="text-danger"><?= $errors['article']; ?></span>
            </div>
            <input type="submit" value="Save Post" name="submit" class="btn btn-info">
            <a href="blog.php" class="btn btn-secondary">Cancel</a>
          </form>
        </div>
      </div>
    </section>
  </div>
</main>
<?php include_once '_tpl/footer.php' ?>