﻿<?php
include_once("../lib/session.php");
include_once("../lib/dbcon.php");

if (isset($_SESSION['userid'])) {
	echo "
	<script>
	location.replace('../login/login_success.php');
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
    <td><b>로그인 폼</b></td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
<br>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">계정이 없으신 분은 회원으로 가입하세요.<a href="../user/add_form.php">[..회원가입]</a></td>
  </tr>
</table>
<br>
<form action="../login/login_engine.php" method="post" name="login_form" id="login_form" style="margin:0px;" onSubmit="return checkForm(this.form);">
  <table width="500" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr> 
      <td width="195" align="right" bgcolor="#EFD8F1"> &nbsp;&nbsp;<font color="#FF0000">*</font> 
        &nbsp;아이디</td>
      <td width="282" bgcolor="#E8E8E8"> <input name="userid" type="text" id="userid" size="20" style="border:1px #333333 solid;width:100px;height:20px;"> 
      </td>
    </tr>
    <tr> 
      <td align="right" bgcolor="#EFD8F1"> &nbsp;&nbsp;<font color="#FF0000">*</font> 
        &nbsp;암호</td>
      <td bgcolor="#E8E8E8"> <input name="password" type="password" id="password" size="20" style="border:1px #333333 solid;width:100px;height:20px;"> 
      </td>
    </tr>
  </table>
  <br>
  <table width="500" height="40" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#EBDBF2" style="border:0px #333333 solid;border-bottom-width:3px;">
    <tr>
      <td align="center">
<input type="submit" name="Submit" value="인증"> 
        <input type="reset" name="Reset" value="취소">
      </td>
    </tr>
  </table>
</form>
<script>
function checkForm(theForm) {
	if (theForm.userid.value=="") {
		alert("아이디를 입력하십시오.");
		theForm.userid.focus();
		return false;
	} else {
		return true;
	}
}
</script>
</body>
</html>
