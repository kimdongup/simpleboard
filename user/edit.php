<?php
include_once("../lib/session.php");
include_once("../lib/dbcon.php");

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$tel = $_REQUEST['tel'];
$zip = $_REQUEST['zip'];
$address = $_REQUEST['address'];

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
//필수입력항목을 모두 입력했는지 검사합니다.
if ($name=="" || $email=="" || $tel=="") {
	echo "
	<script>
	alert('[데이터 누락] 필수입력란을 정확히 입력하십시오.');
	history.back();
	</script>
	";
	die;
}

//데이터베이스에 등록합니다.
$sql = "
	update user set 
	name='$name',email='$email',tel='$tel',zip='$zip',address='$address'
	where userid='$session_userid'
	";
$res = mysql_query($sql);
$affected_rows = mysql_affected_rows();
if ($affected_rows>0) {
	echo "
	<script>
	alert('[수정성공] 수정했습니다.');
	location.replace('edit_form.php');
	</script>
	";
} else {
	echo "
	<script>
	alert('변경된 사항이 없습니다.');
	location.replace('edit_form.php');
	</script>
	";
}
?>