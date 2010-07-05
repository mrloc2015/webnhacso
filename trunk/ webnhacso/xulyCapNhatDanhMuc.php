<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	session_start();
	include_once("DataProvider.php");
	if($_SESSION["IsAdmin"] == true)
	{
		//Cập nhật thể loại nhạc
		if(isset($_REQUEST["btnCapNhatDm"]))
		{
			$styleName = $_REQUEST["txtTheloai"];
			$styleID = $_REQUEST["txtStyleID"];
			$sql = "Update song_style set StyleName = '$styleName' where ID = $styleID";
			DataProvider::ExecuteQuery($sql);
			echo("<script>alert('Đã cập nhật!');</script>");
		}
		//Thêm thể loại
		if(isset($_REQUEST["btnThemMoiDm"]))
		{
			$styleName = $_REQUEST["txtTheloai"];
			$sql = "Insert into song_style (StyleName) values('$styleName')";
			DataProvider::ExecuteQuery($sql);
			echo("<script>alert('Đã thêm thể loại $styleName!');</script>");
			
		}
		//Xóa thể loại nhạc
		if(isset($_REQUEST["deleteID"]))
		{
			$styleID = $_REQUEST["deleteID"];
			$sql = "Delete from song_style where ID = $styleID";
			DataProvider::ExecuteQuery($sql);
			echo("<script>alert('Đã xóa!');</script>");
		}
		//Cập nhật ca sĩ
		if(isset($_REQUEST["btnCapNhatCs"]))
		{
			$singerName = $_REQUEST["txtCaSi"];
			$singerID = $_REQUEST["txtSingerID"];
			$zoneID = $_REQUEST["cmbZone"];
			
			$sql = "Update singer set SingerName = '$singerName',ZoneID = $zoneID where ID = $singerID";
			DataProvider::ExecuteQuery($sql);
			echo("<script>alert('Đã cập nhật!');</script>");
		}
		//Thêm Ca sĩ
		if(isset($_REQUEST["btnThemMoiCs"]))
		{
			$singerName = $_REQUEST["txtCaSi"];
			$zoneID = $_REQUEST["cmbZone"];
			$sql = "Insert into singer (SingerName,ZoneID) values ('$singerName',$zoneID)";
			DataProvider::ExecuteQuery($sql);
			echo("<script>alert('Đã thêm $singerName!');</script>");
		}
	}
?>
