<?php

require_once '_app/helpers.php';
session_start();

if (!user_auth()) {
  header('location: blog.php');
  exit;
}
//הערך שהוא מכניס הוא מספרי
if (isset($_GET['pid']) && is_numeric($_GET['pid'])) {

  $uid = $_SESSION['user_id'];
  $link  = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
  $pid = filter_input(INPUT_GET, 'pid', FILTER_SANITIZE_STRING);
  $pid = mysqli_real_escape_string($link, $pid);

  if ($pid) {
    //user_id הוספה על התנאי שרק מי שמחובר יכול
    $sql  = "DELETE FROM posts WHERE id= $pid AND user_id =$uid";
    $result = mysqli_query($link, $sql);

    if ($result && mysqli_affected_rows($link) > 0) {

      header('location: blog.php');
      exit;
    }
  }
}


header('location: blog.php');
