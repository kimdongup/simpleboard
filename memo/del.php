﻿<?php
include_once("../lib/dbcon.php");

$rowid = $_REQUEST['rowid'];
$password = $_REQUEST['password'];

$sql = "select * from memo where rowid='$rowid'";
$res = mysql_query($sql);
if ($res) $rs = mysql_fetch_array($res);

//글암호를 확인하여 인증을 부여합니다.
if ($password!="" && $rs['password']==md5($password)) {
} else {
	echo "
	<script>
	alert('암호가 올바르지 않습니다.');
	history.back();
	</script>
	";
	die;
}

//데이터베이스에서 삭제합니다.
$sql = "delete from memo where rowid='$rowid' ";
$res = mysql_query($sql);
$affected_rows = mysql_affected_rows();
if ($affected_rows>0) {
	echo "
	<script>
	alert('[삭제완료!!]');
	location.replace('list.php');
	</script>
	";
} else {
	echo "
	<script>
	alert('변경된 사항이 없습니다.');
	location.replace('list.php');
	</script>
	";
}
?>