<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/global.css" rel="stylesheet" type="text/css">
</head>
<body>
<br>
<br>
<br>
<table width="500" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr> 
    <td align="center">대호보조기상사</td>
  </tr>
  <tr> 
    <td height="100" align="center"><img src="img/main.gif" width="137" height="142"></td>
  </tr>
  <tr> 
    <td align="center">안녕하세요<br> <br>
 <?php
include_once("lib/dbcon.php");

$url= $_SERVER['PHP_SELF'];
$sql = "select count(*) from counter where url='$url'";
$res = mysql_query($sql);
if ($res) {
	$rs = mysql_fetch_array($res);
	if($rs[0]>0) {
		$sql = "update counter set visited = visited + 1, last_date=now() where url='$url'";
		mysql_query($sql);
	} 
} else {
		$sql = "insert into counter (url,visited, last_date) values('$url',1,now())";
		mysql_query($sql);
}

$sql = "select * from counter where url='$url'";
$res = mysql_query($sql);
if ($res) {
	$rs = mysql_fetch_array($res);
	$visited = $rs['visited'];
	for ($i=0;$i<(8-strlen(strval($visited)));$i++) echo "0"; #8-strlen(strval($visited))
	echo $visited;
} else {
	echo 1;
}
?>
      </b>번째 방문하셨습니다. </td>
  </tr>
</table>
</body>
</html>
