<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Xừ Lý Thêm Vào PlayList</title>
</head>

<body>
<?php
	include_once("DataProvider.php");
	if(isset($_REQUEST["submit"]) == true)
	{		
		$song_id = $_REQUEST["song_id"];
		$source = $_REQUEST["source"];
		$user_id = $_REQUEST["user_id"];
		$playlist_id = -1;
		$user_name = "";
		echo("$song_id, $source, $user_id<br>");	
		
		$temp = DataProvider::ExecuteQuery("Select * From user Where ID = $user_id");
		if($temp != false)
		{
			$row = mysql_fetch_array($temp);
			$playlist_id = $row["PlayListID"];
			$user_name = $row["UserName"];
		}		
		
		$noi_dung = "\t\t\t<media src=\"../../../$source\"/>\n";
		
		$temp = DataProvider::ExecuteQuery("Select s.ID, s.Source From playlist_detail pd, song s Where pd.PlayListID = $playlist_id and pd.SongID = s.ID");
		if($temp != false)
		{
			while($row = mysql_fetch_array($temp))
			{
				$noi_dung .= "\t\t\t<media src=\"../../../Du_Lieu/BAI_HAT/".$row["ID"]."/".$row["Source"]."\"/>\n";
				//echo("$noi_dung");
			}
			//echo("$noi_dung");
		}
		
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
		}
		else
		{
			echo("<h1>File Này Ko Tồn Tại</h1>");	
		}	
	}
	else
	{
		echo("<h1>Chưa Chọn Bài Hát Để Thêm Vào PlayList</h1>");	
	}
?>
</body>
</html>