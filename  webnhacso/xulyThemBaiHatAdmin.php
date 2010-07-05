<?php
	session_start();
	include_once("DataProvider.php");
	
	if(isset($_REQUEST["ID"]) == false)
		return;
	
	$temp = $_REQUEST["ID"];
	$mang_id = explode("_",$temp);
		
	for($i=1;$i<count($mang_id);$i++)
	{
		//echo($mang_id[$i]);
		$temp = DataProvider::ExecuteQuery("Select * From waiting_song Where SongID = " . $mang_id[$i]);
		//echo("Select * From waiting_song Where SongID = " . $mang_id[$i]);
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
			$source = $row["Source"];
			//chuyển waiting_song qua song
			$sql = "Update song";
			$sql .= " Set SongName = '$song_name' and  StyleID = $style_id and OwnerID = $owner_id and SingerID = $singer_id and Writter = '$writter' and DateUp = '$date_up' and BitRateID = $bit_rate_id and Source = '$source'";
			$sql .= " Where ID = $song_id";			
			echo($sql);
			//xóa waiting_song
			DataProvider::ExecuteQuery("DELETE FROM waiting_song WHERE SongID = $song_id"); 
			
			//chuyển thư mục chứa dữ liệu từ Waiting_Song qua BAI_HAT
			mkdir("Du_Lieu/BAI_HAT/$song_id",1);
			$temp1 = explode("/",$source);

			copy ("Du_Lieu/BAI_HAT/Waiting_Song/$song_id/".$temp1[3], $source);
			
			unlink ("Du_Lieu/BAI_HAT/Waiting_Song/$song_id/".$temp1[3]);
			rmdir ("Du_Lieu/BAI_HAT/Waiting_Song/$song_id");
		}		
	}

	echo("Đã đăng bài hát mới");
?>