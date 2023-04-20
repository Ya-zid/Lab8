<?php


if (!isset($_COOKIE['is-admin'])) {
  // User is not an admin, redirect them to the login page
  
  // header('Location: ../../index.php');
  echo "you r not an admin <br> <a href='../../index.php'>return to home page?</a>";

  exit;
}

include 'admin.header.php';



include 'admin.main.php';
include 'admin.footer.php';
?> 