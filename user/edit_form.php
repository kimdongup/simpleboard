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
    <td><b>회원정보수정 폼</b></td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
<br>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">정확히 입력하신 후 등롭하세요! &quot;<font color="#FF0000">*</font>&quot;는 
      필수 입력사항입니다.</td>
  </tr>
</table>
<br>
<form action="edit.php" method="post" name="user_form" id="user_form" style="margin:0px;">
  <table width="500" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr> 
      <td width="100" bgcolor="#EFD8F1"> &nbsp;&nbsp;&nbsp;아이디</td>
      <td bgcolor="#E8E8E8"><?php echo $session_userid; ?></td>
    </tr>
    <tr> 
      <td bgcolor="#EFD8F1"><font color="#FF0000">*</font> 이름</td>
      <td bgcolor="#E8E8E8"> <input name="name" type="text" id="name" value="<?php echo $rs['name']; ?>" size="20">
        예)홍길동 </td>
    </tr>
    <tr> 
      <td bgcolor="#EFD8F1"><font color="#FF0000">*</font> 이메일</td>
      <td bgcolor="#E8E8E8"> <input name="email" type="text" id="email" value="<?php echo $rs['email']; ?>" size="30">
        예)userid@domain.com</td>
    </tr>
    <tr> 
      <td bgcolor="#EFD8F1"><font color="#FF0000">*</font> 연락처</td>
      <td bgcolor="#E8E8E8"> <input name="tel" type="text" id="tel" value="<?php echo $rs['tel']; ?>" size="20">
        예)02-000-0000</td>
    </tr>
    <tr> 
      <td bgcolor="#EFD8F1">&nbsp;&nbsp;&nbsp;우편번호</td>
      <td bgcolor="#E8E8E8"> <input name="zip" type="text" id="zip" value="<?php echo $rs['zip']; ?>" size="7">
        예)135-080 </td>
    </tr>
    <tr> 
      <td bgcolor="#EFD8F1">&nbsp;&nbsp;&nbsp;주소</td>
      <td bgcolor="#E8E8E8"> <input name="address" type="text" id="address" value="<?php echo $rs['address']; ?>" size="50"> 
      </td>
    </tr>
  </table>
  <br>
  <table width="500" height="40" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#EBDBF2" style="border:0px #333333 solid;border-bottom-width:3px;">
    <tr>
      <td align="center">
<input type="button" name="Button" value="수정합니다." onClick="checkForm(this.form);"> 
        <input type="reset" name="Reset" value="취소">
      </td>
    </tr>
  </table>
</form>
<script>
function checkForm(theForm) {
	if (theForm.name.value=="") {
		alert("이름을 입력하십시오.");
		theForm.name.focus();
	} else if (theForm.email.value=="") {
		alert("이메일을 입력하십시오.");
		theForm.email.focus();
	} else if (theForm.tel.value=="") {
		alert("연락처를 입력하십시오.");
		theForm.tel.focus();
	} else {
		theForm.submit();
	}
}
</script>
</body>
</html>
';
?>