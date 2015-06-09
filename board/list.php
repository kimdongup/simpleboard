<?php
include_once ("../lib/dbcon.php");
include_once ("../lib/function.php");

$rowid = ""; 
$rs ="";
$page=0;
$startpage=0;
$keyword="";
$keyfield="";
$total_sql="";
$list_sql="";
$sql_where="";

if(isset($_REQUEST['rowid']))$rowid = $_REQUEST['rowid'];
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/global.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<br>
<br>
<table width="650" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#EBE8D8" style="border:0px #333333 solid;border-top-width:3px;">
  <tr> 
    <td><b>게시판</b></td>
    <td align="right">[<a href="add_form.php">등록</a>]</td>
  </tr>
</table>
<?php
////////상세보기 출력시작/////////////////////
if (strval($rowid)!="") {
	//조회수 올리기
	$sql = "update board set access = access + 1 where rowid = '$rowid' ";
	mysql_query($sql);
	
	//글의 상세정보 가져오기
	$sql = "select * from board where rowid='$rowid' ";
	$res = mysql_query($sql);
<<<<<<< HEAD
	if ($res) {
        $rs = mysql_fetch_array($res);
    }
=======
	if ($res) $rs = mysql_fetch_array($res);
>>>>>>> f3b8961dc3a85cce08144c60b90b5f9093cc53b6
}

if (!empty($rs['rowid'])) {//상세내용이 있으면 출력합니다.
?>
<br>
<table width="650" height="30" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#EBE8D8" style="border:0px #DCD3AF solid;border-top-width:1px;">
  <tr> 
    <td style="font-size:13px;font-weight:bold;"><?php echo $rs['rowid'];?>. <?php echo $rs['subject'];?>
	</td>
  </tr>
</table>
<table width="650" border="0" align="center" cellpadding="5" cellspacing="1">
  <tr> 
    <td width="50" align="center" bgcolor="#EBE8D8">이름</td>
    <td width="80" bgcolor="e8e8e8"><?php echo $rs['name'];?></td>
    <td width="50" align="center" bgcolor="#EBE8D8">아이디</td>
    <td width="150" bgcolor="e8e8e8"><?php echo $rs['userid'];?></td>
    <td width="50" align="center" bgcolor="#EBE8D8">등록일</td>
    <td bgcolor="e8e8e8"><?php echo substr($rs['input_date'],0,10);?> from <?php echo $rs['hostinfo'];?></td>
  </tr>
  <tr> 
    <td width="50" align="center" bgcolor="#EBE8D8">조회수</td>
    <td bgcolor="e8e8e8"><?php echo number_format($rs['access']);?></td>
    <td width="50" align="center" bgcolor="#EBE8D8">이메일</td>
    <td bgcolor="e8e8e8"><a href="mailto:<?php echo $rs['email'];?>"><?php echo $rs['email'];?></a></td>
    <td width="50" align="center" bgcolor="#EBE8D8">첨부</td>
    <td bgcolor="e8e8e8"> 
      <?php if ($rs['filename']=="") {?>
      &nbsp; 
      <?php } else {?>
      <a href="javascript:var winDown=window.open('files/<?php echo $rs['filename'];?>','','width=640,height=480,scrollbars=yes,resizable=yes,status=yes'); winDown.focus();"><?php echo $rs['filename'];?></a> 
      <?php }//if ?>
    </td>
  </tr>
  <tr valign="top" bgcolor="e8e8e8"> 
    <td height="100" colspan="6"> 
      <?php
	 if ($rs['content_type']=="text") echo nl2br($rs['content']);
	 else echo $rs['content'];
	 ?>
    </td>
  </tr>
</table>
<table width="650" height="30" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#EBE8D8" style="border:0px #DCD3AF solid;border-bottom-width:1px;">
  <tr> 
    <td align="right">[<a href="add_form.php?mode=reply&rowid=<?php echo $rs['rowid'];?>">답글</a>][<a href="auth_form.php?mode=edit&rowid=<?php echo $rs['rowid'];?>">수정</a>][<a href="auth_form.php?mode=del&rowid=<?php echo $rs['rowid'];?>">삭제</a>] 
    </td>
  </tr>
</table>
<br>
<?php
}//if
////////상세보기 출력끝/////////////////////
?>
<?php
///////////목록출력시작//////////////////////////
//변수초기화
$ipp=10;
$ten=5;
if ($page<=0) $page = 1;
if ($startpage<=0) $startpage = 1;

//현재페이지의 시작레코드를 찾습니다.
$startrow = ($page - 1) * $ipp;

//검색어 정의
if ($keyword!="") {
	$sql_where = " where $keyfield like '%$keyword%' ";
}//if

//전체 글수 계산
$total_sql = "select count(*) from board ";
$total_sql .= $sql_where;//검색조건
$res = mysql_query($total_sql);
if ($res) $rs = mysql_fetch_row($res);
$total_count = $rs[0];//검색된 글수

$totpage = ceil($total_count/$ipp);//총 페이지수 연산

//현재 페이지에 출력할 레코드 선택질의
$list_sql = "select * from board ";
$list_sql .=  $sql_where;//검색조건
$list_sql .= " order by groupnum desc, stepnum asc ";//정렬조건
$list_sql .= " limit $startrow, $ipp ";//한 페이지에 출력할 글수 제한
$res = mysql_query($list_sql);
?>
<table width="650" height="24" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td align="right">Total <?php echo number_format($totpage);?> pages / <?php echo number_format($total_count);?> 
      items</td>
  </tr>
</table>

<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr align="center" bgcolor="#EBE8D8"> 
    <td width="50" height="24">번호</td>
    <td width="30" bgcolor="#EBE8D8">첨부</td>
    <td>제목</td>
    <td width="50" bgcolor="#EBE8D8">작성자</td>
    <td width="80">등록일</td>
    <td width="50">조회</td>
  </tr>
  <?php
if ($res) {
	$i=0;
	while ($rs = mysql_fetch_array($res)) {
		$i++;
?>
  <tr bgcolor="<?php
  	if ($rowid==$rs['rowid']) {
  		echo "#e0e0e0";
	} else {
  		if ($i%2==0) echo "#f0f0f0"; 
		else	echo "#eaeaea";
	}
  ?>"> 
    <td height="24" align="center"><?php echo $rs['rowid'];?></td>
    <td align="center"> 
      <?php if ($rs['filename']=="") {?>
      &nbsp; 
      <?php } else {?>
      <a href="javascript:var winDown=window.open('files/<?php echo $rs['filename'];?>','','width=640,height=480,scrollbars=yes,resizable=yes,status=yes'); winDown.focus();"><img src="img/icon_clip.gif" border="0" alt="<?php 
	  echo "파일명:".$rs['filename'];
	  echo " / ";
	  echo "크기:".number_format(filesize("files/$rs[filename]"));
	  ?>"></a> 
      <?php }//if ?>
    </td>
    <td style="cursor:hand;" onClick="self.location='list.php?rowid=<?php echo $rs['rowid'];?>';"> 
      <?php
	for ($d=0;$d<$rs['depth'];$d++) echo "&nbsp;&nbsp;";
	if ($rs['stepnum']>0) echo '<img src="img/icon_sub.gif" align="absmiddle">'; 
	?>
    <?php echo str_limit($rs['subject'],50,"...");?></td>
    <td align="center"><?php echo str_limit($rs['name'],8,"");?></td>
    <td align="center"><?php echo substr($rs['input_date'],0,10);?></td>
    <td align="center"><?php echo number_format($rs['access']);?></td>
  </tr>
  <?php
	}//while
}//if
?>
</table>
<table width="650" height="40" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#EBE8D8" style="border:0px #333333 solid;border-bottom-width:3px;">
  <tr> 
    <td>
        <table border="0" cellpadding="0" cellspacing="0">
          <tr valign="bottom"> 
<<<<<<< HEAD
            <span style="font-weight:bold;">Go 
=======
            <td style="color:#333333;font-size:12px;"><span style="font-weight:bold;">Go 
>>>>>>> f3b8961dc3a85cce08144c60b90b5f9093cc53b6
              to Page:</span> &nbsp; 
              <?php if ($startpage>1) { ?>
              <a style="cursor:hand;color:#333333;font-weight:;font-size:12px;" onClick="search_form.startpage.value='1'; search_form.page.value='1';search_form.submit();">◀</a> 
              <a style="cursor:hand;color:#333333;font-weight:;font-size:12px;" onClick="search_form.startpage.value='<?php echo $startpage-$ten;?>'; search_form.page.value='<?php echo $startpage-$ten;?>';search_form.submit();">Prev</a> 
              <?php }//if ?>
              <?php
				$endpage = $startpage + $ten - 1;
				if ($endpage>$totpage) $endpage = $totpage;
				
				for ($i=$startpage;$i<=$endpage;$i++) {
					
					if ($page==$i) {
						echo "<b>[$i]</b>";
					} else {
						echo '<a href="javascript:search_form.page.value=\'$i\';search_form.submit();">';
						echo '[$i]';
						echo '</a>';
					} 
				}//for 
				?>
              <?php if ($endpage<$totpage) { ?>
              <a style="cursor:hand;color:#333333;font-weight:;font-size:12px;" onClick="search_form.startpage.value='<?php echo $startpage+$ten;?>'; search_form.page.value='<?php echo $startpage+$ten;?>';search_form.submit();">Next</a> 
              <a style="cursor:hand;color:#333333;font-weight:;font-size:12px;" onClick="search_form.startpage.value='<?php echo $totpage;?>'; search_form.page.value='<?php echo $totpage;?>';search_form.submit();">▶</a> 
              <?php }//if ?>
<<<<<<< HEAD
              &nbsp;
=======
              &nbsp;</td>
>>>>>>> f3b8961dc3a85cce08144c60b90b5f9093cc53b6
          </tr>
        </table>
    </td>
    <td align="right">
<form action="<?php echo $PHP_SELF;?>" method="get" name="search_form" id="search_form" style="margin:0px;">
        <table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td> <input name="page" type="hidden" id="page" value="1"> 
              <input name="startpage" type="hidden" id="startpage" value="1">
              <select name="keyfield" id="keyfield">
                <option value="subject" <?php if($keyfield=="subject") echo "selected";?>>제목</option>
                <option value="content" <?php if($keyfield=="content") echo "selected";?>>내용</option>
				<option value="name" <?php if($keyfield=="name") echo "selected";?>>이름</option>
                <option value="email" <?php if($keyfield=="email") echo "selected";?>>이메일</option>
              </select></td>
            <td><input name="keyword" type="text" id="keyword" value="<?php echo $keyword;?>" size="12">
            </td>
            <td>
<input type="submit" name="Submit" value="Search"></td>
          </tr>
        </table>
        </form></td>
  </tr>
</table>

<script>
function form2form(name,from,to) {
	var fromObj, toObj;
	fromObj = eval("document."+from+"."+name);
	toObj = eval("document."+to + "."+name);
	toObj.value = fromObj.value;
}
</script>
</body>
</html>
