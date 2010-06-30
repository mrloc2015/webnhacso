<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/TrangChu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fantasy Music</title>
<link href="css/giaodien.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="js/jquery.media.js"></script>
<script type="text/javascript" src="js/jquery.timers.js"></script>
<script type="text/javascript" src="script/ThemBaiHat.js"></script>
<script type="text/javascript" src="script/Ajax_FantasyMusic.js"></script>
<script type="text/javascript" language="javascript">
		$("document").ready(TaoDangNhap());
</script>
</head>

<body>

  <div class="banner" id="idBanner" align="center">
    	<img src="images/digital music-banner.jpg" width="1000" height="120">
    </div>
  	<div class="main" id="idmain">
            <div class="left-col">
            	 <div class="left-header" id="idLeftMenu" align="center">
                    <span>Menu</span>
            	 </div>
             	 <div class="left-menu" id="idFirstLeftMenu">
                     <ul class="pointer">
                        <li>
                          <a href="TrangChu.php" title="Trang chủ">Trang chủ</a>
                       </li>
                        <li>
                          <a href="ThemBaiHat.php" title="Đăng/upload Bài Hát">Đăng/upload Bài Hát</a>
                        </li>
                        <li class="last">
                          <a href="DangKi.php" title="Đăng ký tài khoản mới">Đăng ký tài khoản mới</a>
                        </li>
                     </ul>
           		</div>
                <div class="left-header" id="idDanhMucBaiHat" align="center" onclick="HienRa('idDanhMuc')">
                     <span>Danh mục bài hát</span>
                </div>  
                 <div class="left-DanhMuc" id="idDanhMuc">
                    <dl>                
                        <?php
                            include_once("DataProvider.php");
                            $sql = "select * from song_style";
                            $result = DataProvider::ExecuteQuery($sql);
                            while($row = mysql_fetch_array($result))
                            {
                                $idStyle = $row["ID"];
                                $nameStyle = $row["StyleName"];
                                $duongDan = "TimKiem.php?TimKiem=true&Th_TheLoai=$idStyle";
                                echo(" <li><a href='$duongDan'>$nameStyle</a></li>");
                            } 
                        ?>
                    </dl>
                    
                 </div>
                <div class="left-header" id="idClip" align="center">
                     <span><a href="TimKiem.php?TimKiem=true&Clip=1">Clip</a></span>
                </div>
                <div class="left-header" align="center" onclick="HienRa('idPlayList')">
                    <span>Playlist HOT</span>
                </div>
                 <div class="left-PlayList" id="idPlayList">
                     <dl>                
                        <?php
                            include_once("DataProvider.php");
                            $sql = "select u.ID, u.UserName, u.PlayListID from playlist pl, user u where pl.ID = u.PlaylistID order by pl.ListenCount DESC limit 10";
                            $result = DataProvider::ExecuteQuery($sql);
                            while($row = mysql_fetch_array($result))
                            {
                                $userName = $row["UserName"];
								$playListID = $row["PlayListID"];
                                $duongDan = "Nghe.php?PlayList=$playListID";
                                echo(" <li><a href='$duongDan'>$userName</a></li>");
                            } 
                        ?>
                    </dl>
                  </div>
                <div class="left-header" id="idLeftMenu" align="center" onclick="HienRa('idCaSiVN')">
                    <span>Ca sĩ Việt Nam</span>
                </div>
                <div class="left-CaSi" id="idCaSiVN">
                     <dl>                
                        <?php
                            include_once("DataProvider.php");
                            $sql = "select si.SingerName,si.ID from singer si, song so, zone z where z.ID = 1 and si.ZoneID = z.ID and so.SingerID = si.ID group by si.ID, si.SingerName order by sum(so.ListenCount) DESC limit 0,10";
                            $result = DataProvider::ExecuteQuery($sql);
                            while($row = mysql_fetch_array($result))
                            {
                                $singerName = $row["SingerName"];
                                $duongDan = "TimKiem.php?TimKiem=true&Th_CaSi=$singerName";
                                echo(" <li><a href='$duongDan'>$singerName</a></li>");
                            } 
                        ?>
                    </dl>
              </div>
               <div class="left-header" id="idLeftMenu" align="center" onclick="HienRa('idCaSiA')">
                    <span>Ca sĩ Châu Á</span>
                </div>
               <div class="left-CaSi" id="idCaSiA">
                     <dl>                
                        <?php
                            include_once("DataProvider.php");
                            $sql = "select si.SingerName,si.ID from singer si, song so, zone z where z.ID = 2 and si.ZoneID = z.ID and so.SingerID = si.ID group by si.ID, si.SingerName order by sum(so.ListenCount) DESC limit 0,10";
                            $result = DataProvider::ExecuteQuery($sql);
                            while($row = mysql_fetch_array($result))
                            {
                                $singerName = $row["SingerName"];
                                $duongDan = "TimKiem.php?TimKiem=true&Th_CaSi=$singerName";
                                echo(" <li><a href='$duongDan'>$singerName</a></li>");
                            } 
                        ?>
                    </dl>
              </div>
               <div class="left-header" id="idLeftMenu" align="center" onclick="HienRa('idCaSiAM')">
                    <span>Ca sĩ Âu Mỹ</span>
                </div>
               <div class="left-CaSi" id="idCaSiAM">
                     <dl>                
                        <?php
                            include_once("DataProvider.php");
                            $sql = "select si.SingerName,si.ID from singer si, song so, zone z where z.ID = 3 and si.ZoneID = z.ID and so.SingerID = si.ID group by si.ID, si.SingerName order by sum(so.ListenCount) DESC limit 0,10";
                            $result = DataProvider::ExecuteQuery($sql);
                            while($row = mysql_fetch_array($result))
                            {
                                $singerName = $row["SingerName"];
                                $duongDan = "TimKiem.php?TimKiem=true&Th_CaSi=$singerName";
                                echo(" <li><a href='$duongDan'>$singerName</a></li>");
                            } 
                        ?>
                    </dl>
              </div>
            </div>
            <div class="right-mid">
                  <div class="mid-col">
                        <div id="idMainContent" class="main-content" align="center">                   
                            <!-- InstanceBeginEditable name="mainConten" -->         
<?php
	include_once("DataProvider.php");
	$tong_so_trang = 0;
	$so_bai = 0;
	$tu_bai = 0;	
	$temp = DataProvider::ExecuteQuery("Select * From myweb");
	if($temp != false)
	{
		$row = mysql_fetch_array($temp);
		$so_bai = $row["NumberInPage"];
	}
	if(isset($_REQUEST["Trang"]) == true)
		$tu_bai = ($so_bai * $_REQUEST["Trang"]) - $so_bai;
	//echo($so_bai);
	//echo($tu_bai);
	$noi_dung = "";
	
	$ten_bai_hat = "";
	$ca_si = "";
	$nguoi_dang = "";
	$the_loai = 0;
	$chat_luong = 0;
	$clip = 0;
	
	if(isset($_REQUEST["Th_TenBaiHat"]) == true)
		if($_REQUEST["Th_TenBaiHat"] != "")
			$ten_bai_hat = $_REQUEST["Th_TenBaiHat"];	
	if(isset($_REQUEST["Th_CaSi"]) == true)
		if($_REQUEST["Th_CaSi"] != "")
			$ca_si = $_REQUEST["Th_CaSi"];	
	if(isset($_REQUEST["Th_NguoiDang"]) == true)
		if($_REQUEST["Th_NguoiDang"] != "")
			$nguoi_dang = $_REQUEST["Th_NguoiDang"];
	if(isset($_REQUEST["Th_TheLoai"]) == true)
		$the_loai = $_REQUEST["Th_TheLoai"];
	if(isset($_REQUEST["Th_ChatLuong"]) == true)
		$chat_luong = $_REQUEST["Th_ChatLuong"];
	if(isset($_REQUEST["Clip"]) == true)
		$clip = $_REQUEST["Clip"];
		
	if(isset($_REQUEST["TimKiem"]) == true)
	{
		$sql = "Select count(s.ID) From song s, song_style ss, user u, singer sin, bit_rate br Where s.StyleID = ss.ID and s.OwnerID = u.ID and s.SingerID = sin.ID and s.BitRateID = br.ID";						
						
		if(trim($ten_bai_hat) != "")
			$sql .= " and s.SongName like '%" . $ten_bai_hat . "%'";
		if(trim($ca_si) != "")
			$sql .= " and sin.SingerName like '%" . $ca_si . "%'";
		if(trim($nguoi_dang) != "")
			$sql .= " and u.UserName like '%" . $nguoi_dang . "%'";
		if($the_loai != 0)
			$sql .=  " and s.StyleID=" . $the_loai;
		if($chat_luong != 0)
			$sql .= " and s.BitRateID=" . $chat_luong;
		if($clip != 0)
			$sql .= " and s.Clip=" . $clip;
		
		$sql.=" order by s.ListenCount DESC";
		$temp = DataProvider::ExecuteQuery($sql);
		if($temp != false)
		{
			$row = mysql_fetch_array($temp);
			if(($row["count(s.ID)"] / $so_bai) > (int)($row["count(s.ID)"] / $so_bai))
				$tong_so_trang = (int)($row["count(s.ID)"] / $so_bai) + 1;
			else
				$tong_so_trang = (int)($row["count(s.ID)"] / $so_bai);
			//echo($tong_so_trang);
		}
		
		$sql = str_replace("count(s.ID)","s.*, ss.StyleName, u.UserName, sin.SingerName, br.BitRate",$sql);
		//Phân trang
		$sql .= " LIMIT $tu_bai , $so_bai";
		//echo($sql);
		$temp = DataProvider::ExecuteQuery($sql);
		if($temp != false)
		{			
			while($row = mysql_fetch_array($temp))
			{
				$duongDanBaiHat = "Nghe.php?BaiHat=".$row["ID"];
				$duongDanTheLoai = "TimKiem.php?Th_TheLoai=".$row["StyleID"];
				$duongDanNguoiDung = "TimKiem.php?Th_NguoiDang=".$row["OwnerID"];
				$duongDanCaSi = "TimKiem.php?Th_CaSi=".$row["SingerID"];
								
				$songName = $row["SongName"];
				$singerName = $row["SingerName"];
				$userName = $row["UserName"];
				$nameStyle = $row["StyleName"];
				$listenCount = $row["ListenCount"];
				$bitRate = $row["BitRate"];

				$noi_dung .= "<div class='song-info' align='left'>";
				$noi_dung .= "<div class='song-icon'><img alt='Music Icon' src='images/MP3.gif'></div>";
				$noi_dung .= "<h2><a href='$duongDanBaiHat'>$songName</a></h2>";
				$noi_dung .= "<p>
								<label>Trình bày</label>: <a title='Tìm các bài hát do $singerName' href='$duongDanCaSi'>$singerName</a>
							  </p>";
				$noi_dung .= "<p>
								<label>Đăng bởi</label>: 
								<span><a title='Nghe list bài hát của bạn $userName' href='$duongDanNguoiDung'>$userName</a></span>
								<span>";
				$noi_dung .= "|";
				$noi_dung .= "$bitRate kb/s";
				$noi_dung .= "|";
				$noi_dung .= "<label>Lượt nghe</label>: $listenCount";
				$noi_dung .= "|";
				$noi_dung .= "</span>";
				$noi_dung .= "<span><a title='Tìm các bài hát có thể loại: $nameStyle' href='$duongDanTheLoai'>$nameStyle</a></span></p>";
				$noi_dung .= "</div>";
			}						
		}		
	}
?>                            
<form action="TimKiem.php" method="post">
<div style="height:30px; margin-top:50px" align="left">
    <div style="width:80px;float:left; margin-left:50px"><label>Tên bài hát:</label></div>       
    <input name="Th_TenBaiHat" value="<?php echo($ten_bai_hat); ?>" type="text" style="width:360px;" />
</div>   
<div style="height:30px;" align="left">
    <div style="width:80px;float:left; margin-left:50px"><label>Ca sĩ:</label></div>       
    <input style="margin-right:10px" name="Th_CaSi" value="<?php echo($ca_si); ?>" type="text" />
    <label style="margin-right:5px">Người đăng:</label>
    <input name="Th_NguoiDang" value="<?php echo($nguoi_dang); ?>" type="text" style="width:120px;" />
</div>
<div style="height:30px;" align="left">
    <div style="width:80px;float:left; margin-left:50px"><label>Thể loại:</label></div>       
    <select style="margin-right:10px; width:140px;" name="Th_TheLoai" id="Th_TheLoai">
    			<option selected="selected" value="0">--------</option>
	<?php
		$temp = DataProvider::ExecuteQuery("Select * From song_style");        
		if($temp != flase)
		{
			while($row = mysql_fetch_array($temp))
			{
				if($row["ID"] == $the_loai)
					echo("<option selected='selected' value='".$row["ID"]."'>".$row["StyleName"]."</option>");
				else
					echo("<option value='".$row["ID"]."'>".$row["StyleName"]."</option>");
			}
		}
    ?>
    </select>
    <label style="margin-right:5px">Chất lượng:</label>
    <select style="margin-right:30px; width:125px;" name="Th_ChatLuong" id="Th_ChatLuong">
    			<option selected="selected" value="0">--------</option>
	<?php
		$temp = DataProvider::ExecuteQuery("Select * From bit_rate");        
		if($temp != flase)
		{
			while($row = mysql_fetch_array($temp))
			{
				if($row["ID"] == $chat_luong)
					echo("<option selected='selected' value='".$row["ID"]."'>".$row["BitRate"]."</option>");
				else
					echo("<option value='".$row["ID"]."'>".$row["BitRate"]."</option>");	
			}
		}
    ?>
    </select>
</div>
<div align="center">
	<input id="TimKiem" name="TimKiem" type="submit" value="Tìm Kiếm" />
</div>
<input id="Trang" name="Trang" type="hidden" value="1" />
</form>
<div style="height:30px">
</div>
<div id="TheHien" align="center" class="main-content">
	<?php echo($noi_dung); ?>
</div>
<div align="right" style="margin-right:30px">

<script type="text/javascript" language="javascript">
	function abc(t)
	{
		//alert("SDFDS");
		$("#Trang").attr("value",t);
		$("#TimKiem").click();
	}
</script>
                
	<?php
	$i = 1;
	while($i <= $tong_so_trang)
	{
		if(isset($_REQUEST["Trang"]) == true)
			if($_REQUEST["Trang"] == $i)
				echo("[<a href='javascript:abc($i);'>$i</a>]");	
			else
				echo(" <a href='javascript:abc($i);'>$i</a> ");	
		$i++;
	}
	?>
</div>

					<!-- InstanceEndEditable --></div>
                  </div> 
            <div class="right-col">
            	<div id="idLoginBox">
                	
              	</div>
              <div align="center" style="background:url(images/title-search-box-bg.jpg);height:33px;width:264px;">
              </div>
              <script type="text/javascript" language="javascript">
              	function XuLyGoiDi()
				{
					var dia_chi = "TimKiem.php?TimKiem=true";
					var v = $("#cmbTheo").attr("value");

					if(v == "0")
						dia_chi += "&Th_TenBaiHat=" + $("#txtTuKhoa").attr("value");
					if(v == "1")
						dia_chi += "&Th_CaSi=" + $("#txtTuKhoa").attr("value");
					if(v == "2")
						dia_chi += "&Th_NguoiDang=" + $("#txtTuKhoa").attr("value");
					//alert(v + 2);
					//alert(document.getElementById("txtTuKhoa").value);
					//alert(dia_chi);
					$("#frmTimKiem").attr("action",dia_chi);
					
					return true;	
				}
				TaoHieuUng();
              </script>
              <div class="right-search" align="left">
                   <form id="frmTimKiem" name="TimKiem" method="post" action="TimKiem.php" onsubmit="XuLyGoiDi()">
                            <label for="txtTuKhoa">Từ khóa</label><br>
                          <input type="text" name="txtTuKhoa" id="txtTuKhoa" style="width:200px;"/><br>
                            <label for="cmbTheo">Theo</label><br>
                          <select name="cmbTheo" id="cmbTheo" style="width:200px">                       	
                            <option selected="selected" value="0">Tên bài hát / Chủ đề</option>
                            <option value="1">Ca sĩ</option>
                            <option value="2">Người đăng</option>
                          </select>
                          <p style="margin-top:10px;">
                                <input type="submit" name="btnTimKiem" id="btnTimKiem" value="Tìm Nhạc"/>
                          </p>
                        </form>
              </div>
                <div class="right-content" id="idRightContent" align="center">
                    <!-- InstanceBeginEditable name="RightContent" -->RightContent<!-- InstanceEndEditable -->   
                </div>
            </div>  
        </div>     
   </div>
</body>
<!-- InstanceEnd --></html>
