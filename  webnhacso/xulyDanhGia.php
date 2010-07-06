<?php
	include_once("DataProvider.php");
	
	if(isset($_REQUEST["TangDown"]))
	{
		$sodown = 0;
	
		$sql = "Select * From song Where ID = " . $_REQUEST["ID"];
		$temp = DataProvider::ExecuteQuery($sql);
		if($temp != false)
		{
			$row = mysql_fetch_array($temp);
			$sodown = $row["DownloadCount"];
			$sodown = $sodown + 1;																
		}
	
		$sql = "Update song Set DownloadCount = $sodown Where ID = " . $_REQUEST["ID"];		
		//echo("alert('$time');");
		DataProvider::ExecuteQuery($sql);
		return;
	}
	
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
		
		echo("Cám ơn bạn đã cho điểm");
	}
	else
		echo("Chỉ có user mới đánh giá được");
?>