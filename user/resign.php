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
//데이터베이스에 등록합니다.
$sql = "delete from user where userid='$session_userid'";
$res = mysql_query($sql);
$affected_rows = mysql_affected_rows();
if ($affected_rows>0) {
	$session_userid="";
	echo "
	<script>
	alert('[탈퇴성공] 정상적으로 회원에서 탈퇴하셨습니다.');
	location.replace('../login/login_form.php');
	</script>
	";
} else {
	echo "
	<script>
	alert('[탈퇴실패] 데이터베이스서버의 오류 또는 회원필드 오류로 인하여 탈퇴실패하였습니다.');
	location.back();
	</script>
	";
}
?>