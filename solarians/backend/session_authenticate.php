

<?php
	
//set session
if(!isset($_SESSION['uid_s']) || (trim($_SESSION['uid_s']) == '')) {
//$uid=strip_tags($_GET['uid']);
		header("location: index.php");
		exit();
	}


?>