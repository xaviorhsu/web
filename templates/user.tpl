<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<{$xoImgUrl}>bootstrap/bootstrap.min.css" crossorigin="anonymous">

    <title>會員管理</title>
  </head>
  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<{$xoImgUrl}>bootstrap/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="<{$xoImgUrl}>bootstrap/popper.min.js" crossorigin="anonymous"></script>
    <script src="<{$xoImgUrl}>bootstrap/bootstrap.min.js" crossorigin="anonymous"></script>
  <body>
      <{if $smarty.session.admin}>
        <{* 管理員 *}>
        <{include file="tpl/admin.tpl"}>
      <{else}>
        <{* 訪客 *}>
        <{if $op=="login_form"}>
            <{include file="tpl/login_form.tpl"}>
        <{elseif  $op=="reg_form"}>
            <{* 註冊 *}>
            <{include file="tpl/reg_form.tpl"}>
        <{/if}>
      <{/if}>
  </body>
</html>