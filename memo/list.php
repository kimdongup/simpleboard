﻿<?php
include_once ("../lib/dbcon.php");

//변수초기화
$ipp=10;
$ten=10;
$total_sql="";$list_sql="";$sql_where="";
$page = 0; $startpage = 0; $keyword="";$keyfield="";

if (isset($_REQUEST['page'])) {
	$page = $_REQUEST['page'];
}
if (isset($_REQUEST['startpage'])) {
	$startpage = $_REQUEST['startpage'];
}
if ($page<=0) $page = 1;
if ($startpage<=0) $startpage = 1;
//현재페이지의 시작레코드를 찾습니다.
$startrow = ($page - 1) * $ipp;

//검색어 정의
if (isset($_REQUEST['keyword'])) {
	$keyword = $_REQUEST['keyword'];
	$keyfield = $_REQUEST['keyfield'];
	$sql_where = " where $keyfield like '%$keyword%' ";
}//if

//전체 글수 계산
$total_sql = "select count(*) from memo ";
$total_sql .= $sql_where;//검색조건
$res = mysql_query($total_sql);
if ($res) $rs = mysql_fetch_row($res);
$total_count = $rs[0];//검색된 글수

$totpage = ceil($total_count/$ipp);//총 페이지수 연산

//현재 페이지에 출력할 레코드 선택질의
$list_sql = "select * from memo ";
$list_sql .=  $sql_where;//검색조건
$list_sql .= " order by input_date desc ";//정렬조건
$list_sql .= " limit $startrow, $ipp ";//한 페이지에 출력할 글수 제한
$res = mysql_query($list_sql);

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
<table width="650" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#CFEAEB" style="border:0px #333333 solid;border-top-width:3px;">
  <tr> 
    <td><b>메모</b></td>
    <td align="right">[<a href="add_form.php">등록</a>]</td>
  </tr>
</table>
<table width="650" height="24" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td align="right">Total <?php echo number_format($totpage);?> pages / <?php echo number_format($total_count);?> 
      items</td>
  </tr>
</table>
<?php
if ($res) {
	while ($rs = mysql_fetch_array($res)) {
?>
<table width="650" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" style="border:0px #999999 solid;border-bottom-width:1px;">
  <tr> 
    <td width="70" align="center" bgcolor="#CFEAEB">번호</td>
    <td width="150" bgcolor="#E8E8E8"><?php echo $rs['rowid'];?></td>
    <td width="70" align="center" bgcolor="#CFEAEB">등록일</td>
    <td width="200" bgcolor="#E8E8E8"><?php echo substr($rs['input_date'],0,10);?> 
      from <?php echo $rs['hostinfo'];?></td>
    <td align="center" nowrap bgcolor="#E8E8E8">[<a href="auth_form.php?mode=edit&rowid=<?php echo $rs['rowid'];?>">수정</a>][<a href="auth_form.php?mode=del&rowid=<?php echo $rs['rowid'];?>">삭제</a>]</td>
  </tr>
  <tr> 
    <td align="center" bgcolor="#CFEAEB">이름</td>
    <td bgcolor="#E8E8E8"><?php echo $rs['name'];?></td>
    <td align="center" bgcolor="#CFEAEB">이메일</td>
    <td colspan="2" bgcolor="#E8E8E8"><a href="mailto:<?php echo $rs['email'];?>"><?php echo $rs['email'];?></a></td>
  </tr>
  <tr> 
    <td align="center" bgcolor="#CFEAEB">홈페이지</td>
    <td colspan="4" bgcolor="#E8E8E8"><a href="http://<?php echo $rs['url'];?>" target="_blank">http://<?php echo $rs['url'];?></a></td>
  </tr>
  <tr valign="top" bgcolor="#E8E8E8"> 
    <td height="100" colspan="5">
	  <table width="640" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="640"><?php echo nl2br($rs['content']);?></td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<?php
	}//while
}//if
?>
<table width="650" height="40" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#CFEAEB" style="border:0px #333333 solid;border-bottom-width:3px;">
  <tr> 
    <td>
<form name="page_form" method="post" action="" style="margin:0px;">
        
        
        
        <table border="0" cellpadding="0" cellspacing="0">
          <tr valign="bottom"> 
            <td style="color:#333333;font-size:12px;"><span style="font-weight:bold;">Go 
              to Page:</span> &nbsp;&nbsp; 
              <?php if ($startpage>1) { ?>
              <a style="cursor:hand;color:#333333;font-weight:;font-size:12px;" onClick="search_form.startpage.value='<?php echo $startpage-$ten;?>'; search_form.page.value='<?php echo $startpage-$ten;?>';search_form.submit();">◀Prev</a> 
              <?php }//if ?>
              <select name="page" id="page" onChange="form2form('page',this.form.name,'search_form');search_form.submit();">
                <?php
$endpage = $startpage + $ten - 1;
if ($endpage>$totpage) $endpage = $totpage;
for ($i=$startpage;$i<=$endpage;$i++) {?>
                <option value="<?php echo $i;?>" <?php if ($page==$i) echo "selected"; ?>><?php echo $i;?></option>
                <?php }//for ?>
              </select> 
              <?php if ($endpage<$totpage) { ?>
              <a style="cursor:hand;color:#333333;font-weight:;font-size:12px;" onClick="search_form.startpage.value='<?php echo $startpage+$ten;?>'; search_form.page.value='<?php echo $startpage+$ten;?>';search_form.submit();">Next▶</a> 
              <?php }//if ?>
              &nbsp;</td>
          </tr>
        </table>
      </form>
      
      
    </td>
    <td align="right">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" name="search_form" id="search_form" style="margin:0px;">
        <table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td> <input name="page" type="hidden" id="page" value="1"> 
              <input name="startpage" type="hidden" id="startpage" value="1">
              <select name="keyfield" id="keyfield">
                <option value="name" <?php if($keyfield=="name") echo "selected";?>>이름</option>
                <option value="email" <?php if($keyfield=="email") echo "selected";?>>이메일</option>
                <option value="url" <?php if($keyfield=="url") echo "selected";?>>홈페이지</option>
                <option value="content" <?php if($keyfield=="content") echo "selected";?>>내용</option>
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
