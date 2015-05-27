<?php
include_once("../lib/session.php");
include_once("../lib/dbcon.php");

$rowid=$_REQUEST['rowid'];
$mode=$_REQUEST['mode'];

$sql = "select * from board where rowid='$rowid'";
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
<table width="500" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#EBE8D8" style="border:0px #333333 solid;border-top-width:3px;">
  <tr> 
    <td><b> 인증</b></td>
    <td align="right">[<a href="javascript:history.back();">돌아가기</a>]</td>
  </tr>
</table>
<br>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center"> 다음 글을 등록할 때 사용한 글암호를 입력하십시오.</td>
  </tr>
</table>
<br>
<form action="" method="post" name="auth_form" id="auth_form" style="margin:0px;">
  <table width="500" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr> 
      <td bgcolor="#EBE8D8"><font color="#FF0000">*</font> 글번호</td>
      <td bgcolor="#E8E8E8"><?php echo $rowid;?></td>
    </tr>
    <tr> 
      <td width="100" bgcolor="#EBE8D8"><font color="#FF0000">*</font> 글암호</td>
      <td bgcolor="#E8E8E8"> <input name="password" type="password" id="password" size="20"> 
        <input name="mode" type="hidden" id="mode" value="<?php echo $mode;?>"> <input name="rowid" type="hidden" id="rowid" value="<?php echo $rowid;?>"> 
      </td>
    </tr>
  </table>
  <br>
  <table width="500" height="40" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#EBE8D8" style="border:0px #333333 solid;border-bottom-width:3px;">
    <tr>
      <td align="center">
		<input type="button" name="Button" value="확인" onclick="checkForm(this.form);"> 
        <input type="reset" name="Reset" value="취소">
      </td>
    </tr>
  </table>
</form>
<script>
function checkForm(theForm) {
	if (theForm.password.value=="") {
		alert("암호를 입력하십시오.");
		theForm.password.focus();
		return false;
	} else {
		modifyExe(theForm);
	}
	
}

function modifyExe(theForm) {
		if (theForm.mode.value=="edit") {
			theForm.action="edit_form.php";
			theForm.submit();
		} else if (theForm.mode.value=="del") {
			if (confirm("정말로 삭제하시겠습니까?")) {
				theForm.action="del.php";
				theForm.submit();
			} else {
			}
		}
}

</script>
</body>
</html>
