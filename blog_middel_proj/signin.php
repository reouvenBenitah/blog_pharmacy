<?php
session_start();
require_once '_app/helpers.php';


if (isset($_SESSION['user_id'])) {

  header('location: ./');
  exit;
}

$page_title = 'Sign in page';
$errors = [
  'email' => '',
  'password' => '',
  'submit' => '',
];


// If Client click on submit button
if (isset($_POST['submit'])) {
  //התנאי הזה בודק אם הגולש גולש אך ורק באתר שלנו ולא מרחוק
  if (
    isset($_SESSION['csrf_token']) && isset($_POST['csrf_token']) && $_SESSION['csrf_token'] ==
    $_POST['csrf_token']
  ) {
    // Collect client data to variables 
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $user = password_hash($password, PASSWORD_BCRYPT);

    if (!$email) {
      $errors['email'] = '* A valid email is required';
    } elseif (!$password) {
      $errors['password'] = '* Please enter your password';
    } else {
      $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
      //limit 1 מחזיר מבסיס נתונים רק את האיימיל האחד
      $sql = "SELECT u.*,up.profile_image FROM users u JOIN users_profile up ON u.id = up.user_id WHERE email ='$email' LIMIT 1 ";
      $result = mysqli_query($link, $sql);

      if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        //בודק את ההתאמה בין הקוד של המשתמש כשהוא מקליד לבין הבסיס נתונים
        if (password_verify($password, $user['password'])) {
          $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
          $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
          $_SESSION['user_id'] = $user['id'];
          $_SESSION['user_name'] = $user['firstName'];
          $_SESSION['user_image'] = $user['profile_image'];
          $_SESSION['blog_action'] = 'FIRST_SIGNIN_INDICATOR';

          header('location: ./');
          exit;
        } else {
          $errors['submit'] = "* worng email or password";
        }
      } else {
        $errors['submit'] = "* worng email or password";
      }
    }
  }
  // נמצא פה כדי לשמור את תוקאן גם כשהו לחץ על כניסה
  $token = csrf();
} else {
  //נמצא  פה כדי לשמור את התוקאן לפני הכניסה לחשבון
  $token = csrf();
}

?>

<?php include '_tpl/header.php' ?>
<main class="min-h750" style="background-image:url(_images/startin.jpg);background-size:cover;">
  <div class="container">
    <section id="main-top-content">
      <div class="row">
        <div class="col mt-5">
          <h1 class="display-3 text-info ">Sign in with your account</h1>
        </div>
      </div>
    </section>
    <section id="signin-form-content">
      <div class="row">
        <div class="col-lg-6 mt-3">
          <form action="" method="POST" autocomplete="off" novalidate="novalidate">
            <!-- the input use מחזיר את הטוקאן מבלי שהלקוח רואה  -->
            <input type="hidden" name="csrf_token" value="<?= $token; ?>">
            <div class="form-group">
              <label for="email">* Email:</label>
              <input value="<?= old('email'); ?>" type="email" name="email" id="email" class="form-control">
              <span class="text-danger"><?= $errors['email']; ?></span>
            </div>
            <div class="form-group">
              <label for="password">* Password:</label>
              <input type="password" name="password" id="password" class="form-control">
              <span class="text-danger"><?= $errors['password']; ?></span>
            </div>
            <input type="submit" name="submit" value="Signin" class="btn color-nav text-white">
            <span class="text-danger"><?= $errors['submit']; ?></span>
          </form>
        </div>
      </div>
    </section>
  </div>
</main>
<?php include '_tpl/footer.php' ?>