<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Xử Lý Thêm Bài Hát</title>
</head>

<body>
<?php
	session_start();
	include_once("DataProvider.php");
	
	if(isset($_SESSION["UserID"]) == false || $_SESSION["UserID"] < 0)
	{
		echo("Chỉ có user mới upload nhạc được</body>");
		return;
	}
	
	$song_id = 0;
	//----------------
	if(isset($_FILES['Th_Source']) == true)
	{	
		$temp = DataProvider::ExecuteQuery("Select MAX(ID) From song");
		while($row = mysql_fetch_array($temp))
			$song_id = $row["MAX(ID)"];			
			
		mkdir("Du_Lieu/BAI_HAT/Waiting_Song/$song_id",1);
		if(($_FILES["Th_Source"]["size"]/1024/1024) <= 10) //đơn vị là bytes
		{
			move_uploaded_file($_FILES["Th_Source"]["tmp_name"], "Du_Lieu/BAI_HAT/Waiting_Song/$song_id/". $_FILES["Th_Source"]["name"]);		
		}
		echo("Upload thành công, bài hát của bạn sẽ sớm được duyệt");
		return;
	}
	//----------------
	
	if(trim($_REQUEST['Source']) == "")
	{
		echo("Chưa chọn bài hát để upload</body>");
		return;
	}
	
	if(trim($_REQUEST["Th_SongName"]) == "")
	{
		echo("Bài hát phải được đặt tên, vui lòng xem lại</body>");
		return;
	}
	
	$song_name = ", \"" . $_REQUEST["Th_SongName"]."\"";
	$style_id = ", " . $_REQUEST["Th_Style"];		
	$owner_id = ", " . $_SESSION["UserID"];
	$singer_id = "-1";
	$temp = DataProvider::ExecuteQuery("Select * From singer Where SingerName = \"".$_REQUEST["Th_Singer"]."\"");
	if($temp != false)
	{				
		if($row = mysql_fetch_array($temp))
			$singer_id = "," . $row["ID"];
		else
		{				
			DataProvider::ExecuteQuery("Insert into singer (SingerName, ZoneID) values (\"".$_REQUEST["Th_Singer"]."\", 4)");
			$temp1 = DataProvider::ExecuteQuery("Select MAX(ID) From singer");
			if($temp1 != false)
			{	
				while($row1 = mysql_fetch_array($temp1))		
					$singer_id = "," . $row1["MAX(ID)"];
			}
		}
		
		$writter = ", \"".$_REQUEST["Th_Writter"]."\"";
		$date_up = ", \"".date("Y")."-".date("m")."-".date("d")."\"";
		$bit_rate_id = ", " . $_REQUEST["Th_BitRate"];
		$rate = ", " . $_REQUEST["Th_Rate"];				
	
		$sql = "Insert into song (SongName) values ('')";				
		//echo($sql);			
		DataProvider::ExecuteQuery($sql);
		
		$temp = DataProvider::ExecuteQuery("Select MAX(ID) From song");
		while($row = mysql_fetch_array($temp))
			$song_id = $row["MAX(ID)"];
			
		$source = ", \"Du_Lieu/BAI_HAT/$song_id/".$_REQUEST['Source']."\"";

		$sql = "Insert into waiting_song (SongID, SongName, StyleID, OwnerID, SingerID, Writter, DateUp, BitRateID, Source) values ($song_id $song_name $style_id $owner_id $singer_id $writter $date_up $bit_rate_id $source)";				
		//echo($sql);			
		DataProvider::ExecuteQuery($sql);		
		
		//echo("Thành công");
	}
?>
</body>
</html>