﻿<?php
include_once("../lib/session.php");
include_once("../lib/dbcon.php");

$session_userid = $_SESSION['userid'];
$sql = "select * from user where userid='$session_userid'";
$res = mysql_query($sql);
if ($res) $rs = mysql_fetch_array($res);

if ($session_userid=="" || $rs['userid']=="") {
	$session_userid=="";
	echo "
	<script>
	location.replace('login_form.php');
	</script>
	";
	die;
}
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/global.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<br>
<br>
<table width="500" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#EBDBF2" style="border:0px #333333 solid;border-top-width:3px;">
  <tr> 
    <td><b>인증완료</b></td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
<br>
<form name="login_form" id="login_form" style="margin:0px;">
  <table width="500" height="100" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr> 
      <td align="center" bgcolor="#E8E8E8"><b>&quot;<?php echo $rs['name'];?>[<?php echo $rs['userid'];?>]&quot;</b>님 
        <br>
        <br>
        환영합니다.</td>
    </tr>
  </table>
  <br>
  <table width="500" height="40" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#EBDBF2" style="border:0px #333333 solid;border-bottom-width:3px;">
    <tr>
      <td align="center"> 
        <table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><input type="button" name="Button" value="로그아웃" onClick="location.replace('logout.php');"></td>
            <td><input type="button" name="Button" value="회원정보수정" onClick="self.location='../user/edit_form.php';"></td>
            <td><input type="button" name="Button" value="암호변경" onClick="self.location='../user/change_password_form.php';"></td>
            <td><input type="button" name="Button" value="탈퇴" onClick="if (confirm('정말로 탈퇴하시겠습니까?\r\n\r\n탈퇴하시면 개인정보보호정책에 따라 회원정보가 완전히 삭제됩니다.')) location.replace('../user/resign.php');"></td>
          </tr>
        </table> </td>
    </tr>
  </table>
</form>
</body>
</html>
