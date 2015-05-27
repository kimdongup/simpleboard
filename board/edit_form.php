<?php
include_once("../lib/session.php");
include_once("../lib/dbcon.php");

$rowid=$_REQUEST['rowid'];
$password=$_REQUEST['password'];

$sql = "select * from board where rowid='$rowid'";
$res = mysql_query($sql);
if ($res) $rs = mysql_fetch_array($res);

//글암호를 확인하여 인증을 부여합니다. 회원의 경우 자신의 글일 때만 인증을 부여합니다.
if (($password!="" && $rs['password']== md5($password))) {
	if(isset($_SESSION['userid'])) {
		if($rs['userid']==$_SESSION['userid']){
			$_SESSION['session_auth']=$rowid;
		} else {
			echo "
	<script>
	alert('본인의 글이 아닙니다.');
	//history.back();
	location.replace('list.php');
	</script>
	";		
		}
	} else { 
		echo "
	<script>
	alert('로그인이 필요합니다.');
	//history.back();
	location.replace('list.php');
	</script>
	";
	}
} else {
	$_SESSION['session_auth']="";
	echo "
	<script>
	alert('암호가 올바르지 않습니다.');
	location.replace('list.php');
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
<table  width="650" height="30" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#DCD3AF" style="border:0px #333333 solid;border-top-width:3px;">
  <tr> 
    <td><b>게시판</b></td>
    <td align="right">[<a href="list.php?rowid=">목록</a>]</td>
  </tr>
</table>
<table  width="650" height="30" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">정확히 입력하신 후 등록하세요! &quot;<font color="#FF0000">*</font>&quot;는 
      필수 입력사항입니다.</td>
  </tr>
</table>
<form action="edit.php" method="post" enctype="multipart/form-data" name="board_form" id="board_form" style="margin:0px;" onSubmit="return checkForm(this)">
  <table  width="650" border="0" align="center" cellpadding="0" cellspacing="1">
    <tr> 
      <td width="83" align="center" bgcolor="#EBE8D8"> 제목</td>
      <td colspan="3" bgcolor="#E8E8E8"> <input name="subject" type="text" id="subject" value="<?php echo str_replace('"',htmlentities('"'),$rs['subject']); ?>" size="50" maxlength="60">
        <font color="#FF0000">*</font> </td>
    </tr>
    <tr> 
      <td width="83" align="center" bgcolor="#EBE8D8"> 이름</td>
      <td width="232" bgcolor="#E8E8E8"><input name="name" type="text" id="name" value="<?php echo $rs['name'];?>" size="20">
        <font color="#FF0000">*</font> </td>
      <td width="77" align="center" bgcolor="#EBE8D8"> 아이디</td>
      <td width="253" bgcolor="#E8E8E8"><?php echo $rs['userid'];?> (회원전용)</td>
    </tr>
    <tr> 
      <td align="center" bgcolor="#EBE8D8"> 이메일</td>
      <td bgcolor="#E8E8E8"><input name="email" type="text" id="email" value="<?php echo $rs['email'];?>" size="20">
        <font color="#FF0000">*</font> </td>
      <td align="center" bgcolor="#EBE8D8">&nbsp; </td>
      <td bgcolor="#E8E8E8">&nbsp;</td>
    </tr>
    <tr> 
      <td align="center" bgcolor="#EBE8D8">문서종류</td>
      <td bgcolor="#E8E8E8"><select name="content_type" id="content_type">
          <option value="text" <?php if ($rs['content_type']=="text") echo "selected";?>>일반텍스트</option>
          <option value="html" <?php if ($rs['content_type']=="html") echo "selected";?>>웹문서(HTML)</option>
        </select></td>
      <td align="center" bgcolor="#EBE8D8">첨부</td>
      <td bgcolor="#E8E8E8">&nbsp;<?php echo $rs['filename'];?></td>
    </tr>
    <tr align="center" bgcolor="#E8E8E8"> 
      <td colspan="4"> 
        <textarea name="content" cols="80" rows="10" wrap="VIRTUAL" id="content"><?php echo $rs['content'];?></textarea> 
      </td>
    </tr>
  </table>
  <table  width="650" height="40" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#DCD3AF" style="border:0px #A79449 solid;border-bottom-width:2px;">
    <tr> 
      <td align="center"> <input name="rowid" type="hidden" id="rowid" value="<?php echo $rowid;?>"> 
        <input type="submit" name="Submit" value="수정합니다."> <input type="reset" name="Reset" value="취소"></td>
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
	} else if (theForm.subject.value=="") {
		alert("제목을 입력하십시오.");
		theForm.subject.focus();
		return false;
	} else if (theForm.password.value=="") {
		alert("암호를 입력하십시오.");
		theForm.password.focus();
		return false;
	} else {
		return true;
	}
	
}
</script>
</body>
</html>
