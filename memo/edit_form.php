﻿<?php
include_once("../lib/session.php");
include_once("../lib/dbcon.php");

$rowid = $_REQUEST['rowid'];
$password = $_REQUEST['password'];

$sql = "select * from memo where rowid='$rowid'";
$res = mysql_query($sql);
if ($res) $rs = mysql_fetch_array($res);

//글암호를 확인하여 인증을 부여합니다.
if ($password!="" && $rs['password']==md5($password)) {
	$session_auth=$rowid;
} else {
	$session_auth="";
	echo "
	<script>
	alert('암호가 올바르지 않습니다.');
	history.back();
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
<table width="500" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#CFEAEB" style="border:0px #333333 solid;border-top-width:3px;">
  <tr> 
    <td><b>메모 수정폼</b></td>
    <td align="right">[<a href="list.php">목록</a>]</td>
  </tr>
</table>
<br>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">정확히 입력하신 후 등록하세요! &quot;<font color="#FF0000">*</font>&quot;는 
      필수 입력사항입니다.</td>
  </tr>
</table>
<br>
<form action="edit.php" method="post" name="edit_form" id="edit_form" style="margin:0px;" onSubmit="return checkForm(this)">
  <table width="500" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr> 
      <td width="100" bgcolor="#CFEAEB"><font color="#FF0000">*</font> 이름</td>
      <td bgcolor="#E8E8E8"> <input name="name" type="text" id="name" value="<?php echo $rs['name'];?>" size="20">
        예)홍길동 </td>
    </tr>
    <tr> 
      <td bgcolor="#CFEAEB"><font color="#FF0000">*</font> 이메일</td>
      <td bgcolor="#E8E8E8"> <input name="email" type="text" id="email" value="<?php echo $rs['email'];?>" size="30">
        예)userid@domain.com</td>
    </tr>
    <tr> 
      <td bgcolor="#CFEAEB"> &nbsp;&nbsp;&nbsp;홈페이지</td>
      <td bgcolor="#E8E8E8"> http:// 
        <input name="url" type="text" id="url" value="<?php echo $rs['url'];?>" size="30"> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#CFEAEB">&nbsp;&nbsp;&nbsp;남기실 말</td>
      <td bgcolor="#E8E8E8"> <textarea name="content" cols="50" rows="10" wrap="VIRTUAL" id="content"><?php echo $rs['content'];?></textarea> 
      </td>
    </tr>
  </table>
  <br>
  <table width="500" height="40" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CFEAEB" style="border:0px #333333 solid;border-bottom-width:3px;">
    <tr>
      <td align="center"> 
        <input name="rowid" type="hidden" id="rowid" value="<?php echo $rowid;?>"> 
        <input type="submit" name="Submit" value="수정합니다."> 
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
		return false;
	} else if (theForm.email.value=="") {
		alert("이메일을 입력하십시오.");
		theForm.email.focus();
		return false;
	} else {
		return true;
	}
	
}
</script>
</body>
</html>
