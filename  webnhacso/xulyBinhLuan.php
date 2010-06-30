<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Xừ Lý Bình Luận</title>
</head>

<body>
<?php
	include_once("DataProvider.php");
	
	if(isset($_REQUEST["UserID"]) && $_REQUEST["UserID"] > 0)
	{
		$user_id = $_REQUEST["UserID"];
		$song_id = 0;
		$playlist_id = 0;
		if(isset($_REQUEST["SongID"]))
			$song_id = $_REQUEST["SongID"];
		if(isset($_REQUEST["PlayListID"]))
			$playlist_id = $_REQUEST["PlayListID"];
		//$date = getdate();		
		//$date = "$date[year]-$date[mon]-$date[mday] $date[hours]:$date[minutes]:$date[seconds]";
		$date = date("Y-m-d H:i:s");

		$comment_id = "";
		$noi_dung = $_REQUEST["NoiDung"];
		
		//echo($user_id . $song_id . $date . $noi_dung);
	
		$sql = "Insert into comment(UserID, SongID, PlayListID, CreateDate) values($user_id, $song_id, $playlist_id, '$date')";
		echo($sql);
		DataProvider::ExecuteQuery($sql);
		
		$sql = "Select Max(ID) From comment";
		$temp =	DataProvider::ExecuteQuery($sql);
		if($temp != false)
		{
			$row = mysql_fetch_array($temp);
			$comment_id = $row["Max(ID)"];
		}
		
		$sql = "Insert into comment_detail(CommentID, Content) values($comment_id, $noi_dung)";
		echo($sql);
		DataProvider::ExecuteQuery($sql);
		
		echo("Cám ơn bạn đã bình luận");
	}
	else
	{
		echo("Chỉ có user mới được bình luận");
	}
?>
</body>
</html>