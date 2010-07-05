<?php
	session_start();
	include_once("DataProvider.php");
	
	if(isset($_REQUEST["cho_phep"]) == false || isset($_REQUEST["ko_cho_phep"]) == false)
		return;
	
	$flag = 0;
	
	//--------------------CHO PHÉP---------------------------
	$temp = $_REQUEST["cho_phep"];
	$mang_cho_phep = explode("_",$temp);
			
	for($i=1;$i<count($mang_cho_phep);$i++)
	{
		//echo($mang_cho_phep[$i]);
		$temp = DataProvider::ExecuteQuery("Select * From waiting_song Where SongID = " . $mang_cho_phep[$i]);
		//echo("Select * From waiting_song Where SongID = " . $mang_cho_phep[$i]);
		if($temp != false)
		{
			$row = mysql_fetch_array($temp);
			
			$song_id = $row["SongID"];
			$song_name = $row["SongName"];							
			$style_id = $row["StyleID"];
			$owner_id = $row["OwnerID"];
			$singer_id = $row["SingerID"];
			$writter = $row["Writter"];
			$date_up = $row["DateUp"];
			$bit_rate_id = $row["BitRateID"];
			$rate = $row["Rate"];			
			$source = $row["Source"];
			//chuyển waiting_song qua song
			$sql = "Update song";
			$sql .= " Set SongName = '$song_name', StyleID = $style_id, OwnerID = $owner_id, SingerID = $singer_id, Writter = '$writter', DateUp = '$date_up', ListenCount = 0, DownloadCount = 0, BitRateID = $bit_rate_id, Rate = $rate, Source = '$source'";
			$sql .= " Where ID = $song_id";			
			//echo($sql);
			DataProvider::ExecuteQuery($sql);
			//xóa waiting_song
			DataProvider::ExecuteQuery("DELETE FROM waiting_song WHERE SongID = $song_id"); 
			
			//chuyển thư mục chứa dữ liệu từ Waiting_Song qua BAI_HAT
			mkdir("Du_Lieu/BAI_HAT/$song_id",1);
			$temp1 = explode("/",$source);

			copy ("Du_Lieu/BAI_HAT/Waiting_Song/$song_id/".$temp1[3], $source);
			
			unlink ("Du_Lieu/BAI_HAT/Waiting_Song/$song_id/".$temp1[3]);
			rmdir ("Du_Lieu/BAI_HAT/Waiting_Song/$song_id");
			
			$flag = 1;
		}						
	}	
	
	//--------------------KO CHO PHÉP---------------------------
	$temp = $_REQUEST["ko_cho_phep"];
	$mang_ko_cho_phep = explode("_",$temp);
	
	for($i=1;$i<count($mang_ko_cho_phep);$i++)
	{
		//echo($mang_ko_cho_phep[$i]);
		$temp = DataProvider::ExecuteQuery("Select * From waiting_song Where SongID = " . $mang_ko_cho_phep[$i]);
		//echo("Select * From waiting_song Where SongID = " . $mang_ko_cho_phep[$i]);
		if($temp != false)
		{
			$row = mysql_fetch_array($temp);
			
			$song_id = $row["SongID"];
			$source = $row["Source"];			
			
			//xóa waiting_song
			DataProvider::ExecuteQuery("DELETE FROM waiting_song WHERE SongID = $song_id"); 
			//xóa song
			DataProvider::ExecuteQuery("DELETE FROM song WHERE ID = $song_id"); 
			
			$temp1 = explode("/",$source);
			//xóa thư mục chứa dữ liệu ở Waiting_Song
			unlink ("Du_Lieu/BAI_HAT/Waiting_Song/$song_id/".$temp1[3]);
			rmdir ("Du_Lieu/BAI_HAT/Waiting_Song/$song_id");
			
			$flag = 2;
		}						
	}	
	
	if($flag == 0)
		echo("Không có bài hát để xử lý");
	else
		echo("Đã xử lý các bài hát");			
?>