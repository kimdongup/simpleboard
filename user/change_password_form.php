<?php
include_once("../lib/session.php");
include_once("../lib/dbcon.php");



if (!isset($_SESSION['userid'])) {
	echo "
	<script>
	alert('[회원전용] 로그인 후 사용하십시오.');
	location.replace('../login/login_form.php');
	</script>
	";
	die;
}
$session_userid = $_SESSION['userid'];
$sql = "select * from user where userid='$session_userid'";
$res = mysql_query($sql) or die("데이터베이스 오류!!");
$rs = mysql_fetch_array($res);
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
    <td><b>암호변경</b></td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
<br>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">변경할 암호를 정확히 입력하신 후 변경버튼을 클릭하십시오.</td>
  </tr>
</table>
<br>
<form action="change_password.php" method="post" name="user_form" id="user_form" style="margin:0px;">
  <table width="500" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr> 
      <td width="100" bgcolor="#EFD8F1"> &nbsp;&nbsp;&nbsp;아이디</td>
      <td bgcolor="#E8E8E8"> <?php echo $session_userid;?> </td>
    </tr>
    <tr> 
      <td bgcolor="#EFD8F1"><font color="#FF0000">*</font> 새 암호</td>
      <td bgcolor="#E8E8E8"> <input name="password" type="password" id="password"> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#EFD8F1"><font color="#FF0000">*</font> 새 암호 확인</td>
      <td bgcolor="#E8E8E8"> <input name="password_re" type="password" id="password_re"> 
      </td>
    </tr>
  </table>
  <br>
  <table width="500" height="40" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#EBDBF2" style="border:0px #333333 solid;border-bottom-width:3px;">
    <tr>
      <td align="center">
<input type="button" name="Button" value="변경" onClick="checkForm(this.form);"> 
        <input type="reset" name="Reset" value="취소">
      </td>
    </tr>
  </table>
</form>
<script>
function checkForm(theForm) {
	if (theForm.password.value!=theForm.password_re.value) {
		alert("새암호를 잘못 입력하셨습니다.");
		theForm.password.value="";
		theForm.password_re.value="";
		theForm.password.focus();
	} else {
		theForm.submit();
	}
}
</script>
</body>
</html>
