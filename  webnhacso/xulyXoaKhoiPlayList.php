<?php
	session_start();
	include_once("DataProvider.php");
	
	if(isset($_REQUEST["user_name"]) == false)
	{
		echo("Chỉ có chủ Playlist mới có thể xóa"); 
		return;	
	}
	
	if(isset($_REQUEST["XoaKhoiPlayList"]) == true && $_REQUEST["XoaKhoiPlayList"] > 0)
	{
		$temp = DataProvider::ExecuteQuery("Select * From user Where UserName = '".$_REQUEST["user_name"]."'");
		if($temp != false)
		{
			$row = mysql_fetch_array($temp);
			
			if($row["PlayListID"] != $_REQUEST["XoaKhoiPlayList"])
			{
				echo("Chỉ có chủ Playlist mới có thể xóa"); 
				return;	
			}
		}
		
		if(isset($_REQUEST["id_song"]) == false && $_REQUEST["id_song"] < 0)
		{
			echo("Chưa chọn bài hát");
			return;
		}
		
		$playlist_id = $_REQUEST["XoaKhoiPlayList"];
		$user_name = $_REQUEST["user_name"];
		
		$header = "<?wpl version=\"1.0\"?>\n";
		$header .= "<smil>\n";
		$header .= "\t<head>\n";
		$header .= "\t\t<meta name=\"Generator\" content=\"Microsoft Windows Media Player -- 12.0.7600.16385\"/>\n";
		$header .= "\t\t<title>$playlist_id</title>\n";
		$header .= "\t</head>\n";
		$header .= "\t<body>\n";
		$header .= "\t\t<seq>\n";
		
		$noi_dung = "";		
		$temp = DataProvider::ExecuteQuery("Select s.ID, s.Source From playlist_detail pd, song s Where pd.PlayListID = $playlist_id and pd.SongID = s.ID");
		if($temp != false)
		{
			while($row = mysql_fetch_array($temp))
			{
				//echo($_REQUEST["id_song"]);
				//echo($row["ID"]);
				if($row["ID"] == $_REQUEST["id_song"])
				{
					DataProvider::ExecuteQuery("Delete From playlist_detail Where SongID = ".$row["ID"]);
					//echo("Delete From playlist_detail Where SongID = ".$row["ID"]);
				}
				else
					$noi_dung .= "\t\t\t<media src=\"../../../".$row["Source"]."\"/>\n";
					//echo("$noi_dung");
			}
			//echo("$noi_dung");
		}
		
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
		}
			
		echo("Đã xóa khỏi playlist");	
	}
?>