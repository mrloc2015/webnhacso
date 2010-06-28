<?php
	session_start();
	include_once("DataProvider.php");
	if(isset($_REQUEST["username"]) and trim($_REQUEST["username"])!="")
	{
		$tendangnhap=$_REQUEST["username"];
	
	$list_user=DataProvider::ExecuteQuery("SELECT username, count( ID ) FROM user WHERE username = '$tendangnhap' group by username");
		if($list_user!=false)
		{
			$row=mysql_fetch_array($list_user);
			if($row["count( ID )"]>=1)
			{
				echo ("<img src='images/unsafe.gif'/><b>Tên này đã được sử dụng</b>");						
			}
			else
			{
				echo("<img src='images/safe.gif'/><b>Tên đăng nhập này bạn có thể sử dụng</b>");
			}
		}
	}
	else
	{
		echo("&nbsp;");
	}
	
	
	if(isset($_REQUEST["email"]))
	{
		$email=$_REQUEST["email"];
	
	$list_email=DataProvider::ExecuteQuery("SELECT Email, count( ID ) FROM user_info WHERE Email = '$email' group by email");
		if($list_email!=false)
		{
			$row=mysql_fetch_array($list_email);
			if($row["count( ID )"]>=1)
			{
				echo ("<img src='images/unsafe.gif'/><b>Địa chỉ Email này đã được sử dụng,vui lòng chọn dịa chỉ email khác</b>");						
			}
			else
			{
				echo("<img src='images/safe.gif'/><b>Bạn có thể sử dụng địa chỉ Email này!</b>");
				echo $row["count( ID )"];
			}
		}
	}
	if(isset($_REQUEST["maxacnhan"]))
	{
		if($_REQUEST["maxacnhan"]!=$_SESSION["code"])
		{
			echo("<img src='images/unsafe.gif'/><b>Sai mã xác nhận!</b>");			
		}
		else
		{
			echo("<img src='images/safe.gif'/>");			
		}
	}
	
					
?>