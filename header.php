<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Trang chủ</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link active" href="/">Home</a>
      </li>
      <!-- Nếu tồn tại $_SESSION['idUser'] (Người dùng đã đăng nhập)
        thì hiện ra Menu-->
      <?php if(isset($_SESSION['idUser'])): ?> 
        <li class="nav-item">
          <a class="nav-link" href="post.php">Cập nhật cảm nghĩ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">Trang cá nhân</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="search.php">Tìm kiếm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="change-password.php">Đổi mật khẩu</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Đăng xuất</a>
          </li>
          <!-- Ngược lại nếu người dùng chưa đăng nhập 
            thì hiện ra Menu chỉ có đăng nhập và đăng kí -->
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Đăng kí</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Đăng nhập</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="forgot-password.php">Quên mật khẩu</a>
          </li>
          
        <?php endif ?>

      </ul>
