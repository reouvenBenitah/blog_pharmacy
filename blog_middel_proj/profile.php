<?php
include_once '_app/helpers.php';

session_start();
$page_title = 'Profile page';

if (!user_auth()) {
  header('location: ./');
  exit;
}

$errors = [
  'firstName' => '',
  'lastName' => '',
  'email' => '',
  'password' => '',
];


$uid = $_SESSION['user_id'];
$link  = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
mysqli_query($link, 'SET NAMES utf8');
$pid = mysqli_real_escape_string($link, $uid);
$sql_edit = "SELECT firstName fn,lastName ln,email e, password ps FROM users WHERE id = $uid";
$result = mysqli_query($link, $sql_edit);
$users = mysqli_fetch_assoc($result);


if (isset($_POST['submit'])) {

  // uses in filter_input הפונקציה מנקה את כל התוים שיכולים להיות זדונים ולמנוע פריצה דרך השדות
  $new_firstname = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
  $new_lastname = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
  $new_email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
  $new_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

  $form_valid = true;

  if (!$new_firstname || mb_strlen($new_firstname) < 2) {
    $form_valid = false;
    $errors['firstName'] = '* First Name is requaird for min 2 chars';
  }
  if (!$new_firstname || mb_strlen($new_firstname) < 2) {
    $form_valid = false;
    $errors['lastName'] = '* Last Name is requaird for min 2 chars';
  }
  if (!$new_email) {
    $errors['email'] = '*A valid  is email';
    $form_valid = false;
  } elseif (email_exist($link, $new_email)) {
    $errors['email'] = '*Email is taken';
    $form_valid = false;
  }
  if (!$new_password || strlen($new_password) < 6 || strlen($new_password) > 20) {
    $errors['password'] = '* Password is required for min 6 chars and max 20';
    $form_valid = false;
  }

  $profile_image = $_SESSION['user_image'];
  define('MAX_FILE_SIZE', 1024 * 1024 * 5);

  // if there where a file upload  && the error is 0
  if (isset($_FILES['image']['error']) && $_FILES['image']['error'] == 0) {
    //משהוא עלה לא גדול מהערך שהגדרנו לו
    if (isset($_FILES['image']['size']) && $_FILES['image']['size'] <= MAX_FILE_SIZE) {

      // if its set
      if (isset($_FILES['image']['name'])) {

        // what file extensions to allaow
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
    $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
    $pid = $_SESSION['user_id'];
    // מנקה מאיס קיו אל יינג׳קשן
    $new_firstname  = mysqli_real_escape_string($link, $new_firstname);
    $new_lastname  = mysqli_real_escape_string($link, $new_lastname);
    $new_email  = mysqli_real_escape_string($link, $new_email);
    $new_password  = password_hash($new_password, PASSWORD_BCRYPT);



    //מחזיר את המזהה האוטומטי של היידי האחרון ברשימה
    $new_user_id = mysqli_insert_id($link);
    $sql = "INSERT INTO users_profile VALUES(null,'$new_user_id','$profile_image')";
    $result = mysqli_query($link, $sql);


    if ($result && mysqli_affected_rows($link) > 0) {
      //מעדכן את הפוסט אחרי שהוא לחץ על עידון ומעדכן את הפוסט מחדש
      $sql = "UPDATE users SET firstName = '$new_firstname',lastName = '$new_lastname' ,email = '$new_email' ,password = '$new_password' WHERE id = $pid ";
      //גם אם הוא מעדן או שלא מעדן זה יעביר אותו לדף הבלוג בעט לחיצה על הלחצן
      $result = mysqli_query($link, $sql);
    }

    $_SESSION['user_name'] = $new_firstname;
    $_SESSION['user_image'] = $profile_image;
    header('location: blog.php');
    exit;
  }
}
?>
<?php
include_once '_tpl/header.php';
?>

<main class="min-h750 img-font" style="background-image:url(_images/) ;background-size:cover;">
  <div class="container">
    <section id="main-top-content">
      <div class="row">
        <div class="col mt-5">
          <h1 class="display-3 text-info">Edit your profile</h1>
        </div>
      </div>
    </section>
    <section id="signin-form-content">
      <div class="row">
        <div class="col-6 mt-5">
          <!-- enctype  אומר לדפדפן שתשלח את הטופס כפרום דאתה כי אם אלא ל=הוא לא יעביר אותו כי הוא לא יכול להעביר קובץ אלה הוא ממיר אותו לפרום דאתה  -->
          <form action="" method="POST" autocomplete="off" novalidate="novalidate" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= $token; ?>">
            <div class="form-group">
              <label for="name" class="text-scundery">* First Name: </label>
              <input type="firstName" name="firstName" id="firstName" class="form-control" value="<?= $users['fn']; ?>">
              <span class="text-danger"><?= $errors['firstName']; ?></span>
            </div>
            <div class="form-group">
              <label for="lastName" class="text-scundery">* Last Name:</label>
              <input type="lastName" name="lastName" id="lastName" class="form-control" value="<?= $users['ln']; ?>">
              <span class="text-danger"><?= $errors['lastName']; ?></span>
            </div>
            <div class="form-group">
              <label for="email" class="text-v text-scundery">* Email:</label>
              <!-- type מציג במקלדת את הסימן שטרודל -->
              <input type="email" name="email" id="email" class="form-control" value="<?= $users['e']; ?>">
              <span class="text-danger"><?= $errors['email']; ?></span>
            </div>
            <div class="form-group">
              <!-- type  מציג את הסיסמה נסתרת -->
              <label for="password" class="text-v text-scundery">* Password:</label>
              <input type="password" name="password" id="password" class="form-control">
              <span class="text-danger"><?= $errors['password']; ?></span>
            </div>
            <div class="form-group text-secundery">
              <label for="image">Profile Image: </label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                  <label class="custom-file-label" for="inputGroupFile01">Choose image</label>
                </div>
              </div>

            </div>
            <div class="col-6">
              <input type="submit" name="submit" value="Update Profile" class="btn color-nav text-white">
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</main>
<?php include_once '_tpl/footer.php' ?>