<?php
/* 引入檔頭，每支程都會引入 */
require_once 'head.php';
 
/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'op_form', 'string');
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');
/* 程式流程 */
switch ($op){
  case "op_form" :
    $msg = op_form();
    break;
 
  case "login" :
    $msg = login();
  break;

  case "logout" :
    logout();
  break;
 
  default:
    $op = "op_list";
    op_list();
    break;  
}
 
/*---- 將變數送至樣版----*/
$smarty->assign("WEB", $WEB);
 
/*---- 程式結尾-----*/
$smarty->display('user.tpl');
 
/*---- 函數區-----*/
function op_form(){
  global $smarty;
 
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
 
function op_list(){
  global $smarty;
}
?>