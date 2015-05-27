<?php
include_once("../lib/session.php");
include_once("../lib/dbcon.php");

$name=$_REQUEST['name'];
$email=$_REQUEST['email'];
$subject=$_REQUEST['subject'];
$content=$_REQUEST['content'];
$email=$_REQUEST['email'];
$email=$_REQUEST['email'];

$session_auth=$_SESSION['session_auth'];
$REMOTE_ADDR =$_SERVER['REMOTE_ADDR'];

if (!isset($_SESSION['userid'])) {
	echo "
	<script>
	alert('[인증실패] 수정권한이 없습니다.');
	history.back();
	</script>
	";
	die;
}

//필수입력항목을 모두 입력했는지 검사합니다.
if ($name=="" || $email=="" || $subject=="" ) {
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
	update board set 
	name='$name',email='$email',subject='$subject',content='".str_replace("'","&acute;",$content)."'
	,edit_date=now(),hostinfo='$REMOTE_ADDR'
	where rowid='$session_auth'
	";
$res = mysql_query($sql);
$affected_rows = mysql_affected_rows();
if ($affected_rows>0) {
	echo "
	<script>
	alert('[수정성공] 수정했습니다.');
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
$session_auth="";
?>