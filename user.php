<?php
/* 引入檔頭，每支程都會引入 */
require_once 'head.php';
 
/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'login_form', 'string');
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');
/* 程式流程 */
switch ($op){
  case "reg" :
    $msg = reg();
    header('Location: index.php'); exit; 
    break;

  case "reg_form" :
    $msg = reg_form();      
  break;
 
  case "login" :
    $msg = login();
  break;

  case "logout" :
    logout();
    header('Location: index.php'); exit;
  break;
 
  default:
    $op = "login_form";
    login_form();
    break;  
}
 
/*---- 將變數送至樣版----*/
$smarty->assign("WEB", $WEB);
$smarty->assign("op", $op);
 
/*---- 程式結尾-----*/
$smarty->display('user.tpl');
 
/*---- 函數區-----*/
/*=======================
註冊函式(寫入資料庫)
=======================*/
function reg_form(){
  global $smarty;
}
function reg(){
  global $db;
  #過濾變數
  $_POST['uname'] = $db->real_escape_string($_POST['uname']);
  $_POST['pass'] = $db->real_escape_string($_POST['pass']);
  $_POST['chk_pass'] = $db->real_escape_string($_POST['chk_pass']);
  $_POST['name'] = $db->real_escape_string($_POST['name']);
  $_POST['tel'] = $db->real_escape_string($_POST['tel']);
  $_POST['email'] = $db->real_escape_string($_POST['email']);
  #加密處理
  IF ($_POST['pass'] != $_POST['chk_pass']) {
    header('Location: user.php?op=reg_form'); exit; die("password not the same");
  }
  $_POST['pass'] = password_hash($_POST['pass'], PASSWORD_DEFAULT);
  #寫入語法
  $sql="INSERT INTO `users` (`uname`,`pass`,`name`,`tel`,`email`)  
        VALUES  ('{$_POST['uname']}','{$_POST['pass']}','{$_POST['name']}','{$_POST['tel']}','{$_POST['email']}');";
  #寫入資料庫
  $db->query($sql) or die($db->error. $sql);
  $uid = $db->insert_id;
  return $uid;
 
}
function login(){
  global $smarty;
  $name = "admin"; 
  $pass = "111111";
  $token = "xxxxxx";

  if($name == $_REQUEST['name'] && $pass == $_REQUEST['pass']) {
      $_SESSION['admin'] = true;
      $_POST['remember'] = isset($_POST['remember']) ? $_POST['remember'] : "";
      if ($_POST['remember']) {
        setcookie("name",$name,time() + 360 * 24 * 365);
        setcookie("token",$token,time() + 360 * 24 * 365);
      }
  } else  { header('Location: user.php'); exit; }
  return;
}
function logout(){
  global $smarty;
  $_SESSION['admin'] = false;
  setcookie("name","",time() - 360 * 24 * 365);
  setcookie("token","",time() - 360 * 24 * 365);
  return;
}
 
function login_form(){
  global $smarty;
}
?>