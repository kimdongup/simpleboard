﻿<?php
include_once("../lib/session.php");
include_once("../lib/dbcon.php");

$userid = $_REQUEST['userid'];
$password = $_REQUEST['password'];

$sql = "select * from user where userid='$userid'";
$res = mysql_query($sql);
if ($res) $rs = mysql_fetch_array($res);

if ($rs['userid']==$userid && $userid!="") {//아이디 일치
	echo $rs['password'],"<->", md5($password);
	if ($rs['password']==md5($password)) {//암호 일치
		$session_userid = $rs['userid'];//인증완료
		$_SESSION['userid'] = $userid;
		echo "
		<script>
		location.replace('login_success.php');
		</script>
		";
	} else {//암호오류
		echo "
		<script>
		alert('[인증실패] 암호가 올바르지 않습니다.');
		location.replace('login_form.php');
		</script>
		";
	}
} else {//아이디 오류
	echo "
		<script>
		alert('[인증실패] 아이디가 올바르지 않습니다.');
		location.replace('login_form.php');
		</script>
		";
}
?>