<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	include_once("DataProvider.php");
	
	if(isset($_REQUEST["user_id"]) && $_REQUEST["user_id"] > 0)
	{
		$user_id = $_REQUEST["user_id"];
		$song_id = $_REQUEST["song_id"];
		$rate = $_REQUEST["rate"];
		
		$sql = "Select * From song Where ID = $song_id";
		$temp = DataProvider::ExecuteQuery($sql);
		if($temp != false)
		{
			$row = mysql_fetch_array($temp);
			$rate = ($rate + $row["Rate"])/2;
		}
		
		$sql = "Update song Set Rate = $rate Where ID = $song_id";
		//echo($sql);
		DataProvider::ExecuteQuery($sql);
	}
	else
		echo("Chỉ có user mới đánh giá được");
?>
</body>
</html>