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
    <td><b>회원가입 양식</b></td>
    <td align="right">&nbsp;</td>
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
<form action="add.php" method="post" name="user_form" id="user_form" style="margin:0px;" onSubmit="return checkForm(this)">
  <table width="500" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr> 
      <td width="100" bgcolor="#EFD8F1"><font color="#FF0000">*</font> 아이디</td>
      <td bgcolor="#E8E8E8"> <input name="userid" type="text" id="userid" size="20" onblur="if (this.value!='') checkId(this.form);"> 
        <input type="button" name="Button" value="중복검사" onclick="checkId(this.form);"> 
        <script>
		function checkId(theForm) {
			if (theForm.userid.value=='') { 
				alert('아이디를 입력하십시오.'); 
				theForm.userid.focus();
			} else { 
				var checkIdWin = window.open('checkid.php?userid='+theForm.userid.value,'','width=300,height=200');
				checkIdWin.focus();
			}
		}
		</script> </td>
    </tr>
    <tr> 
      <td bgcolor="#EFD8F1"><font color="#FF0000">*</font> 암호</td>
      <td bgcolor="#E8E8E8"> <input name="password" type="password" id="password" size="20"> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#EFD8F1"><font color="#FF0000">*</font> 암호확인</td>
      <td bgcolor="#E8E8E8"> <input name="password_re" type="password" id="password_re" size="20"> 
      </td>
    </tr>
    <tr> 
      <td bgcolor="#EFD8F1"><font color="#FF0000">*</font> 이름</td>
      <td bgcolor="#E8E8E8"> <input name="name" type="text" id="name" size="20">
        예)홍길동 </td>
    </tr>
    <tr> 
      <td bgcolor="#EFD8F1"><font color="#FF0000">*</font> 이메일</td>
      <td bgcolor="#E8E8E8"> <input name="email" type="text" id="email" size="30">
        예)userid@domain.com</td>
    </tr>
    <tr> 
      <td bgcolor="#EFD8F1"><font color="#FF0000">*</font> 연락처</td>
      <td bgcolor="#E8E8E8"> <input name="tel" type="text" id="tel" size="20">
        예)02-000-0000</td>
    </tr>
    <tr> 
      <td bgcolor="#EFD8F1">&nbsp;&nbsp;&nbsp;우편번호</td>
      <td bgcolor="#E8E8E8"> <input name="zip" type="text" id="zip" size="7">
        예)135-080 </td>
    </tr>
    <tr> 
      <td bgcolor="#EFD8F1">&nbsp;&nbsp;&nbsp;주소</td>
      <td bgcolor="#E8E8E8"> <input name="address" type="text" id="address" size="50"> 
      </td>
    </tr>
  </table>
  <br>
  <table width="500" height="40" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#EBDBF2" style="border:0px #333333 solid;border-bottom-width:3px;">
    <tr> 
      <td align="center"> <input type="submit" name="Submit" value="등록합니다."> <input type="reset" name="Reset" value="취소"> 
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
	} else if (theForm.password.value=="") {
		alert("암호를 입력하십시오.");
		theForm.password.focus();
		return false;
	} else if (theForm.password_re.value=="") {
		alert("암호확인을 입력하십시오.");
		theForm.password_re.focus();
		return false;
	} else if (theForm.password.value!=theForm.password_re.value) {
		alert("암호를 잘못입력하셨습니다.\r\n\r\n다시 입력하십시오.");
		theForm.password.value="";
		theForm.password_re.value="";
		theForm.password.focus();
		return false;
	} else if (theForm.name.value=="") {
		alert("이름을 입력하십시오.");
		theForm.name.focus();
		return false;
	} else if (theForm.email.value=="") {
		alert("이메일을 입력하십시오.");
		theForm.email.focus();
		return false;
	} else if (theForm.tel.value=="") {
		alert("연락처를 입력하십시오.");
		theForm.tel.focus();
		return false;
	} else {
		return true;
	}
	
}
</script>
</body>
</html>
