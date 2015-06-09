<?php
include_once("../lib/session.php");
include_once("../lib/dbcon.php");

$rowid=$_REQUEST['rowid'];
$password=$_REQUEST['password']; echo $password;

$sql = "select * from board where rowid='$rowid'";
$res = mysql_query($sql);
if ($res) $rs = mysql_fetch_array($res);

//글암호를 확인하여 인증을 부여합니다. 회원의 경우 자신의 글일 때만 인증을 부여합니다.
if (($password!="" && $rs['password']== md5($password))) {
	if(isset($_SESSION['userid'])) {
		if($rs['userid']==$_SESSION['userid'])$_SESSION['session_auth']=$rowid;
	} else { 
		echo "
	<script>
	alert('본인의 글이 아닙니다.');
	//history.back();
	location.replace('list.php');
	</script>
	";
	die;
	}
} else {
	echo "
	<script>
	alert('암호가 올바르지 않습니다.');
	//history.back();
	location.replace('list.php');
	</script>
	";
	die;
}

//만일 첨부파일이 있으면 삭제합니다.
// $upload_dirname = "files";
// if ($rs['filename']!="" && file_exists($upload_dirname."/".$rs['filename'])) {
	// unlink($upload_dirname."/".$rs['filename']);
// }//if

//데이터베이스에서 삭제합니다.
$sql = "delete from board where rowid='$rowid' ";
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