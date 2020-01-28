<?php

require_once '_app/helpers.php';
session_start();
if (isset($_SESSION['user_id'])) {

  header('location: ./');
  exit;
}
$page_title = 'Sign up page';

$errors = [
  'firstName' => '',
  'lastName' => '',
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
    $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $firstName = mysqli_real_escape_string($link, $firstName);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $lastName = mysqli_real_escape_string($link, $lastName);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $email = mysqli_real_escape_string($link, $email);
    $password  = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $password = mysqli_real_escape_string($link, $password);
    $form_valid = true;
    $profile_image = 'defult_profile.png';
    define('MAX_FILE_SIZE', 1024 * 1024 * 5);

    if (!$firstName  || mb_strlen($firstName) < 2 || mb_strlen($firstName) > 70) {
      $errors['firstName'] = '* First Name is required min 2 chars and max 70';
      $form_valid = false;
    }
    if (!$lastName || mb_strlen($lastName) < 2 || mb_strlen($lastName) > 70) {
      $errors['lastName'] = '*Last Name is required min 2 chars and max 70';
      $form_valid = false;
    }
    if (!$email) {
      $errors['email'] = '*A valid  is email';
      $form_valid = false;
    } elseif (email_exist($link, $email)) {
      $errors['email'] = '*Email is taken';
      $form_valid = false;
    }
    if (!$password || strlen($password) < 6 || strlen($password) > 20) {
      $errors['password'] = '* password is required for min 6 chars and max 20';
      $form_valid = false;
    }
    //בדיקה האם הוא העלה קובץ
    if (isset($_FILES['image']['error']) && $_FILES['image']['error'] == 0) {
      //משהוא עלה לא גדול מהערך שהגדרנו לו
      if (isset($_FILES['image']['size']) && $_FILES['image']['size'] <= MAX_FILE_SIZE) {

        if (isset($_FILES['image']['name'])) {

          $allowed_ex = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
          $details = pathinfo($_FILES['image']['name']);

          //האם האסטישן מופיע במערך שאני השארתי לו לעלות ובנוסף הוספנו את הפונקציה שהופכת את האותיות לאותיות קטנות  
          if (in_array(strtolower($details['extension']), $allowed_ex)) {

            if (isset($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {

              $profile_image = date('Y.m.d.H.i.s') . '-' . $_FILES['image']['name'];
              move_uploaded_file($_FILES['image']['tmp_name'], '_images/' . $profile_image);
            }
          }
        }
      }
    }
    if ($form_valid) {
      $password = password_hash($password, PASSWORD_BCRYPT);
      $sql = "INSERT INTO users VALUES(null,'$firstName','$lastName','$email','$password')";
      $result = mysqli_query($link, $sql);


      if ($result && mysqli_affected_rows($link) > 0) {
        //מחזיר את המזהה האוטומטי של היידי האחרון ברשימה
        $new_user_id = mysqli_insert_id($link);
        $sql = "INSERT INTO users_profile VALUES(null,'$new_user_id','$profile_image')";
        $result = mysqli_query($link, $sql);


        if ($result && mysqli_affected_rows($link) > 0) {

          $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
          $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
          $_SESSION['user_id'] = $new_user_id;
          $_SESSION['user_name'] = $firstName;
          $_SESSION['user_image'] = $profile_image;
          $_SESSION['blog_action'] = 'FIRST_SIGNUP_INDICATOR';
          header('location: blog.php');
          exit;
        }
      }
    }
  }
  $token = csrf();
} else {

  $token = csrf();
}
?>


<?php include '_tpl/header.php' ?>
<main class="min-h750" style="background-image:url(_images/startup.jpg);background-size:cover;">
  <div class="container">
    <section id="main-top-content">
      <div class="row">
        <div class="col mt-5">
          <h1 class="display-3 text-info">Sign up for new account</h1>
        </div>
      </div>
    </section>
    <section id="signin-form-content">
      <div class="row">
        <div class="col-lg-6 mt-3">
          <!-- enctype  אומר לדפדפן שתשלח את הטופס כפרום דאתה כי אם אלא ל=הוא לא יעביר אותו כי הוא לא יכול להעביר קובץ אלה הוא ממיר אותו לפרום דאתה  -->
          <form action="" method="POST" autocomplete="off" novalidate="novalidate" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= $token; ?>">
            <div class="form-group">
              <label for="name" class="text-white">* First Name: </label>
              <input type="firstName" name="firstName" id="firstName" class="form-control" value="<?= old('firstName'); ?>">
              <span class="text-danger"><?= $errors['firstName']; ?></span>
            </div>
            <div class="form-group">
              <label for="lastName" class="text-white">* Last Name:</label>
              <input type="lastName" name="lastName" id="lastName" class="form-control" value="<?= old('lastName'); ?>">
              <span class="text-danger"><?= $errors['lastName']; ?></span>
            </div>
            <div class="form-group">
              <label for="email" class="text-v text-white">* Email:</label>
              <!-- type מציג במקלדת את הסימן שטרודל -->
              <input type="email" name="email" id="email" class="form-control" value="<?= old('email') ?>">
              <span class="text-danger"><?= $errors['email']; ?></span>
            </div>
            <div class="form-group">
              <!-- type  מציג את הסיסמה נסתרת -->
              <label for="password" class="text-v text-white">* Password:</label>
              <input type="password" name="password" id="password" class="form-control">
              <span class="text-danger"><?= $errors['password']; ?></span>
            </div>
            <div class="form-group text-white">
              <label for="image">Profile Image: </label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                  <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
              </div>

            </div>
            <input type="submit" name="submit" value="Signin" class="btn color-nav text-white">
          </form>
        </div>
      </div>
    </section>
  </div>
</main>
<?php include '_tpl/footer.php' ?>