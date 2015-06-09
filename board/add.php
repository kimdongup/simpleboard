<?php
include_once ("../lib/session.php");
include_once ("../lib/dbcon.php");

$rowid=$_REQUEST['rowid'];
$name=$_REQUEST['name'];
$email=$_REQUEST['email'];
$subject =$_REQUEST['subject'];
$content_type=$_REQUEST['content_type'];
$content=$_REQUEST['content'];
$password =$_REQUEST['password'];

$new_file_name=$_REQUEST['new_file_name'];
$groupnum=$_REQUEST['groupnum'];
$stepnum=$_REQUEST['stepnum'];
$depth=$_REQUEST['depth'];

$session_userid=$_SESSION['userid'];
$REMOTE_ADDR=$_SERVER['REMOTE_ADDR'];

$file_name =$_FILES["file"]["name"];
	
//필수입력항목을 모두 입력했는지 검사합니다.
if ($name=="" || $email=="" || $subject=="") {
	echo "
	<script>
	alert('[데이터 누락] 필수입력란을 정확히 입력하십시오.');
	history.back();
	</script>
	";
	die;
}

//글번호와 출력순위, 글의 단계값을 정의합니다.
if (strval($rowid)!="") {
	$sql = "select * from board where rowid='$rowid'";
	$res = mysql_query($sql);
	if ($res) $rs = mysql_fetch_array($res);
	
	$groupnum = $rs['groupnum'];
	$stepnum = $rs['stepnum']+1;
	$depth = $rs['depth']+1;
	
	$sql = "update board set stepnum=stepnum+1 where groupnum=$rs[groupnum] and stepnum>=$stepnum ";
	mysql_query($sql);
} else {
	$sql = "select groupnum from board order by groupnum desc limit 1";
	$res = mysql_query($sql);
	if ($res) $rs = mysql_fetch_array($res);
	
	$groupnum = $rs['groupnum']+1;
	if ($groupnum=="") $groupnum=1;
	$stepnum = 0;
	$depth = 0;
}

//업로드할 수 있는 제한용량을 정의합니다.
ini_set("upload_max_filesize","2000000");

//파일시스템의 디텍토리 구분문자를 정의합니다.
$divider = "\\\\";

//업로드 파일을 저장할 폴더명을 정의합니다.
$upload_dirname = "files";

//업로드 파일을 저장할 물리적경로(전체경로)를 정의합니다.
//$s = str_replace('/', '\\', $_SERVER['DOCUMENT_ROOT']);
$full_upload_dirname = $upload_dirname.$divider;

//만일 업로드 파일 저장폴더가 없으면 생성합니다.
if (!is_dir($full_upload_dirname)) {
	mkdir($full_upload_dirname);
}

if ($file_name!="") {

	// 파일명을 확장자와 구분하여 분석합니다.                                       
	$file_name_only = substr($file_name,0,strrpos($file_name,"."));//파일이름
	$file_name_ext = substr($file_name,strrpos($file_name,"."));//확장자이름
	
	//중복된 파일명이 있으면 파일명에 일련번호를 덧붙입니다.
	$new_file_name = $file_name_only.$file_name_ext;
	$s=0;
	while (file_exists($full_upload_dirname.$new_file_name)) {
		$s++;
		$new_file_name = $file_name_only."_".$s.$file_name_ext;
	}
	
	//업로드 파일을 업로드 폴더에 복사합니다.
	move_uploaded_file($_FILES["file"]["tmp_name"], $full_upload_dirname.$new_file_name); 
}


//데이터베이스에 등록합니다.
$sql = "
	insert into board (
	userid,name,email
	,subject,content_type,content
	,hostinfo,input_date,password,filename
	,groupnum,stepnum,depth,access
	) values (
	'$session_userid','$name','$email'
	,'".str_replace("'","&acute;",$subject)."','$content_type','".str_replace("'","&acute;",$content)."'
	,'$REMOTE_ADDR',now(),MD5('$password'),'$new_file_name'
	,'$groupnum','$stepnum','$depth','0'
	)
		";
$res = mysql_query($sql);
$affected_rows = mysql_affected_rows();
if ($affected_rows>0) {
	echo "
	<script>
	alert('[등록성공] 등록되었습니다.$full_upload_dirname$new_file_name');
	location.replace('list.php');
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