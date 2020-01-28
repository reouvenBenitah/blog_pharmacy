<?php
require_once '_app/helpers.php';
session_start();

$page_title = 'Logout';
if (!user_auth()) {
  header('location: ./');
  exit;
}
?>

<?php include '_tpl/header.php' ?>

<?php
$uid = $_SESSION['user_id'];
$link  = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
$sql_edit = "SELECT firstName fn FROM users WHERE id = $uid";
$result = mysqli_query($link, $sql_edit);
$users = mysqli_fetch_assoc($result);

?>




<!-- Main -->
<main class="min-h750">
  <div class="container shadow-lg p-3 mt-5 bg-white rounded">
    <section>

      <div class="row ">
        <div class="col-12 text-center ">
          <h1 class="display-5 mt-5 text-info "><?='<b>' . $users['fn'] .'</b>'?>  <a class="navbar-brand text-info font-weight-bold"> you're sure you want to get out of the account ? </a></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center ">
          <a href="./">
            <input type="button" name="submit" value="No ! i want to stay !" class="btn btn-warning btn-lg btn-logout-custom" style=""></a>
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center ">
          <a href="logoutco.php">
            <input type="submit" name="submit" value="Log out" class="btn btn-info btn-lg btn-custom" style="margin-top: 2em">

        </div>
      </div>
  </div>
  </section>



</main>
<?php include '_tpl/footer.php' ?>