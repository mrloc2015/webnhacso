<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Xử Lý Thêm Bài Hát</title>
</head>

<body>
<?php
	include_once("DataProvider.php");
	if(isset($_REQUEST["Th_SongName"]) == true)
	{
		$song_name = "\"" . $_REQUEST["Th_SongName"]."\"";
		$style_id = ", " . $_REQUEST["Th_Style"];
		$owner_id = ", " . $_REQUEST["Th_Owner"];
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
			$listen_count = ", 0";
			$download_count = ", 0";
			$bit_rate_id = ", " . $_REQUEST["Th_BitRate"];
			$rate = ", " . $_REQUEST["Th_Rate"];				
			$source = ", \"".$_FILES["Th_Source"]["name"]."\"";

			$sql = "Insert into waiting_song (SongName, StyleID, OwnerID, SingerID, Writter, DateUp, BitRateID, Source) values ($song_name $style_id $owner_id $singer_id $writter $date_up $bit_rate_id $source)";	
			
			echo($sql);
			
			DataProvider::ExecuteQuery($sql);
			
			$temp = DataProvider::ExecuteQuery("Select MAX(ID) From song");
			$ma_user = -1;
			while($row = mysql_fetch_array($temp))
				$song_id = $row["MAX(ID)"];			
	
			mkdir("Du_Lieu/$song_id",1);
			move_uploaded_file($_FILES["Th_Source"]["tmp_name"], "Du_Lieu/BAI_HAT/Waiting_Song/". $_FILES["Th_Source"]["name"]);		
			?>
			<script type="text/javascript" language="javascript">
				alert("Thêm thành công");
			</script>
			<?php
		}
	}
?>
</body>
</html>