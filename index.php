<?php 
require_once 'head.php';

$smarty->assign("d00",'關於我們');
$smarty->assign("d01",'產品服務');
$smarty->assign("d02",'產品介紹');
$smarty->assign("d03",'聯絡我們');
 
/*---- 程式結尾-----*/
$smarty->display('theme.tpl');
 