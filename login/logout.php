<?php
include_once("../lib/session.php");

unset($_SESSION['userid']);//인증해제
echo "
<script>
location.replace('login_form.php');
</script>
";
?>