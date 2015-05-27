<?php
include_once("../lib/dbcon.php");

$userid = $_REQUEST['userid'];

$sql = "select count(*) from user where userid='$userid'";
$res = mysql_query($sql);
$rs = mysql_fetch_array($res);
$exist_num = $rs[0];
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/global.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<br>
<table width="280" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#EBDBF2" style="border:0px #333333 solid;border-top-width:3px;">
  <tr> 
    <td><b>중복확인</b></td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
<form method="post" name="checkid_form" id="checkid_form" style="margin:0px;">
  <table width="280" height="100" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr> 
      <td align="center" bgcolor="#E8E8E8"> 
        <?php if ($exist_num>0) { ?>
        "<?php echo $userid;?>"는 이미 사용중입니다. <br> <br>
        다른 아이디를 사용하십시오. 
        <?php } else {?>
        "<?php echo $userid;?>"를 사용해도 좋습니다. 
        <?php }//if?>
      </td>
    </tr>
  </table>
  <table width="280" height="40" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#EBDBF2" style="border:0px #333333 solid;border-bottom-width:3px;">
    <tr> 
      <td align="center"><input type="button" name="Button" value="닫기" onClick="self.close();"> 
      </td>
    </tr>
  </table>
</form>
</body>
</html>
