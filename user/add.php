<?php
include_once ("../lib/dbcon.php");

$userid = $_REQUEST['userid'];
$password = $_REQUEST['password'];
$password_re = $_REQUEST['password_re'];
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$tel = $_REQUEST['tel'];
$zip = $_REQUEST['zip'];
$address = $_REQUEST['address'];

//이미 등록된 회원인지를 검사합니다.
$sql = "select count(*) from user where userid='$userid' ";
$res = mysql_query($sql);
$rs = mysql_fetch_row($res);
if ($rs[0]>0) {
	echo "
	<script>
	alert('[아이디 중복] 이미 등록된 아이디입니다.\\r\\n\\r\\n다른 아이디로 등록하십시오.');
	history.back();
	</script>
	";
	die;
}

//필수입력항목을 모두 입력했는지 검사합니다.
if ($userid=="" || $password=="" || $password_re=="" || $password!=$password_re || $name=="" || $email=="" || $tel=="") {
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
	insert into user (
	userid,password,name,email,tel,zip,address
	) values (
	'$userid',MD5('$password'),'$name','$email','$tel','$zip','$address'
	)
		";
$res = mysql_query($sql);
$affected_rows = mysql_affected_rows();
if ($affected_rows>0) {
	echo "
	<script>
	alert('[등록성공] 회원으로 등록되었습니다.');
	location.replace('../login/login_form.php');
	</script>
	";
} else {
	echo "
	<script>
	alert('[등록실패] 데이터베이스서버의 오류 또는 회원필드 오류로 인하여 등록실패하였습니다.');
	history.back();
	</script>
	";
}
?>