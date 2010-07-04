<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	session_start();
	if(isset($_SESSION["IsAdmin"]) && $_SESSION["IsAdmin"]==true)
	{
		include_once("DataProvider.php");
		//xử lý xóa user
		if(isset($_GET["deleteID"]))
		{
			$userID = $_GET["deleteID"];
			$sql = "UPDATE user SET IsDelete=1 WHERE ID = '$userID'";
			DataProvider::ExecuteQuery($sql);
			echo("<script>alert('Đã xóa user !');</script>");
		}
		
		//xử lý bỏ xóa
		if(isset($_GET["undeleteID"]))
		{
			$userID = $_GET["undeleteID"];
			$sql = "UPDATE user SET IsDelete=0 WHERE ID = '$userID'";
			DataProvider::ExecuteQuery($sql);
			echo("<script>alert('Đã phục hồi user !');</script>");
		}
		
		//xử lý banned
		if(isset($_REQUEST["btnBannedDel"]))
		{
			if($_REQUEST["txtIsBanned"] == false || $_REQUEST["cmbBanned"] == 0)
			{
				$date = getdate();
				$bannedDay=$date["year"]."-".$date["mon"]."-".$date["mday"];
				$days = $_REQUEST["cmbBanned"];
				$userID = $_REQUEST["txtUserID"];
				$dayUnBanned = mktime(0,0,0,date("m"),date("d")+$days,date("Y"));
				$value = date('Y/m/d', $dayUnBanned);
				if($days == 0)
				{
					//Bỏ banned
				
					$sql = "delete from banned WHERE UserID = '$userID'";
					DataProvider::ExecuteQuery($sql);
					
					$sql = "UPDATE user SET IsBanned=0 WHERE ID = '$userID'";
					DataProvider::ExecuteQuery($sql);
					
					echo("<script>alert('Đã bỏ Banned!');</script>");
				}
				elseif($days == -1)
				{
					//Banned vĩnh viễn
					$sql = "Insert into banned (DateBanned,DateUnbanned,UserID) values ('$bannedDay',NULL,'$userID')";
					
					DataProvider::ExecuteQuery($sql);
				
					$sql = "UPDATE user SET IsBanned=1 WHERE ID = '$userID'";
					DataProvider::ExecuteQuery($sql);
					
					echo("<script>alert('Đã Banned user vĩnh viễn!');</script>");
				}
				else
				{
					//Banned có thời hạn
					$sql = "Insert into banned (DateBanned,DateUnbanned,UserID) values ('$bannedDay','$value','$userID')";
					DataProvider::ExecuteQuery($sql);
				
					$sql = "UPDATE user SET IsBanned=1 WHERE ID = '$userID'";
					DataProvider::ExecuteQuery($sql);
					
					echo("<script>alert('Đã Banned user (đến ngày $value)!');</script>");
				}
			}
			else
			{
				echo("<script>alert('Bỏ banned trước khi muốn banned lại!');</script>");
			}
		}
		
	}
	else
	{
		echo("Hãy đăng nhập với quyền Admin.");
	}
?>