<?php
/**
 * @author Dongup Kim <kimdongup@gmail.com>
 */
// Show warning if a PHP version below 5.X.X is used, this has to happen here
// because all major code are already using 5.X syntax.
if (version_compare(PHP_VERSION, '5.4.0') === -1) {
	echo 'This version of ownCloud requires at least PHP 5.X.X<br/>';
	echo 'You are currently running ' . PHP_VERSION . '. Please update your PHP version.';
	return;
}
?>

<html>
<head>
<title>KimDongUp</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<frameset rows="40,*" framespacing="0" frameborder="NO" border="0">
  <frame src="top.php" name="topFrame" scrolling="NO" noresize >
  <frame src="main.php" name="mainFrame">
</frameset>
<noframes><body>

</body></noframes>
</html>
