<?php

switch ($vars['action']) {

   case "signup": {
         include("view/header.php");
         include("view/user/signup.php");
         include("view/footer.php");
         exit;
      }
      break;

   case "do_signup": {
         $ret = user_process_signup($vars);

         if ($ret['status'] == 1) {
            header("location: index.php?action=list");
         } else {
            header("location: index.php?action=signup&error_message=" . urlencode($ret['error']));
         }
         exit;
      }
      break;

   case "login": {
         include("view/header.php");
         include("view/user/login.php");
         include("view/footer.php");
         exit;
      }
      break;

   case "do_login": {
      
         // Invalid login, show an error message
         
         $ret = user_process_login($vars);
         print_r($ret);
         if ($ret['status'] == 1) {
            header("location: index.php?action=list");
         } else {
            header("location: index.php?action=login&error_message=" . urlencode($ret['error']));
         }
         exit;
       
       
      }
      break;

   case "logout": {
         setcookie("app_email", "", -1, "/");
         setcookie("app_pass", "", -1, "/");
         setcookie("is-admin", "", -1, "/");
         header("location: index.php?action=login");
         exit;
      }
      break;

   case "modify_email": {
         include("view/header.php");
         include("view/user/change_email.php");
         include("view/footer.php");
   }break;
   case "do_modify_email": {
         $ret = user_change_email($vars);
         if ($ret["status"] == 1)
            header("location: index.php?action=list&status=ok");
         else
            header("location: index.php?action=modify_email&error_message=" . urlencode($ret['error']));
         exit;
      }
      break;
}
