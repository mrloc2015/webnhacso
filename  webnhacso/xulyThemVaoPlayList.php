<?php
	include_once("DataProvider.php");
	if(isset($_REQUEST["submit"]) == true)		
	{		
		if($_REQUEST["user_id"] >= 0)
		{
			$song_id = $_REQUEST["song_id"];
			$source = $_REQUEST["source"];
			$user_id = $_REQUEST["user_id"];
			$playlist_id = -1;
			$user_name = "";
			//echo("$song_id, $source, $user_id<br>");	
			
			$temp = DataProvider::ExecuteQuery("Select * From user Where ID = $user_id");
			if($temp != false)
			{
				$row = mysql_fetch_array($temp);
				$playlist_id = $row["PlayListID"];
				$user_name = $row["UserName"];
			}							
			
			$noi_dung = "";
			
			$temp = DataProvider::ExecuteQuery("Select s.ID, s.Source From playlist_detail pd, song s Where pd.PlayListID = $playlist_id and pd.SongID = s.ID");
			if($temp != false)
			{
				while($row = mysql_fetch_array($temp))
				{
					$noi_dung .= "\t\t\t<media src=\"../../../".$row["Source"]."\"/>\n";
					//echo("$noi_dung");
				}
				//echo("$noi_dung");
			}
			
			$source = str_replace("'","",$source);
			$noi_dung .= "\t\t\t<media src=\"../../../$source\"/>\n";
			
			
			$sql = "Insert Into playlist_detail(PlayListID, SongID) values ($playlist_id, $song_id)";
			DataProvider::ExecuteQuery($sql);
			
			$header = "<?wpl version=\"1.0\"?>\n";
			$header .= "<smil>\n";
			$header .= "\t<head>\n";
			$header .= "\t\t<meta name=\"Generator\" content=\"Microsoft Windows Media Player -- 12.0.7600.16385\"/>\n";
			$header .= "\t\t<title>$playlist_id</title>\n";
			$header .= "\t</head>\n";
			$header .= "\t<body>\n";
			$header .= "\t\t<seq>\n";
			
			$footer = "\t\t</seq>\n";
			$footer .= "\t</body>\n";
			$footer .= "</smil>";
			
			$file = "Du_Lieu/USER/$user_name/$playlist_id.wpl";
			//echo($file);
			if(file_exists($file) == true)
			{
				$f = fopen($file,"w");
				//echo($header.$noi_dung.$footer);
				fwrite($f,"$header$noi_dung$footer");
				fclose($f);	
				
				echo("Đã thêm vào playlist");
			}
			else
				//echo("File Này Ko Tồn Tại");
				echo("Chỉ có user mới dùng được chức năng này");
		}
		else
			echo("Chỉ có user mới dùng được chức năng này");
	}
	else
		echo("Chưa Chọn Bài Hát Để Thêm Vào PlayList");	
?>