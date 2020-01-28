<?php include_once '_app/helpers.php'; ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="_css/style.css">
  <link rel="icon" type="image/png" sizes="36x36" href="_images/first-aid-icon.png">
  <title>PHARM |<?= $page_title; ?></title>
</head>

<body class="color-white">
  <header>
    <nav class="navbar navbar-expand-lg navbar-light color-nav">
      <div class="container">
        <a class="navbar-brand text-white" href="./">Pharmacy <i class="fas fa-briefcase-medical"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link text-white" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="blog.php">Blog</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <?php if (!user_auth()) : ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="signin.php"><i class="fas fa-sign-in-alt"></i> Signin</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="signup.php"><i class="fas fa-user-plus"></i> Signup</a>
              </li>

            <?php else : ?>

              <li class="nav-item">
                <a class="nav-link text-white" href="profile.php"><img width="30px" class="rounded-circle" src="_images/<?= $_SESSION['user_image']; ?>" alt="" srcset=""> <?= htmlentities($_SESSION['user_name']); ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>