
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
	session_start();
	include_once("DataProvider.php");
	
	if($_SESSION["IsAdmin"] == true)
	{
		if(isset($_REQUEST["btnGioiThieu"]))
		{
			$intro = $_REQUEST["txtIntro"];
			$sql = "Update myweb set Intro = '$intro' where ID = 1";
			DataProvider::ExecuteQuery($sql);
			echo("<script>alert('Đã cập nhật lời giới thiệu!');</script>");
		}
	}
	else
	{
		echo("Hãy đăng nhập với quyền Admin.");
	}
	
?>