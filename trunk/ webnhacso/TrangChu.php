<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	$_SESSION["IsLogin"] = false;
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
                    <div class="main-info" align="center">
                    	<div class="header">
                        	<span>Thông tin</span>
                        </div>
                        <div class="header-content" align="justify">
                        	Để dễ dàng hơn cho việc theo dõi các sự kiện mới và các chương trình của Fantasy Music Mời các bạn hãy trở 			thành Fan của Fantasy Music trên Facebook. Từ này về sau, các sự kiện, thông báo, chương trình khuyến mãi tặng quà…. của Fantasy Music sẽ được chính thức thông báo trên blog và Facebook. Trân trọng.
                        </div>
                    </div>
                    <div class="header-list">Top Nhạc MỚI !!</div>
                    <div class="main-content">
                    	<?php
							include_once("DataProvider.php");
                        	$sql = "select so.*,SingerName,UserName,StyleName,BitRate from song so,singer si,user u,song_style st,bit_rate br where so.SingerID = si.ID and so.OwnerID = u.ID and so.StyleID = st.ID and br.ID = so.BitRateID order by so.DateUp DESC limit 0,10";
							$result = DataProvider::ExecuteQuery($sql);
							while($row = mysql_fetch_array($result))
							{
								$songName = $row["SongName"];
								$singerName = $row["SingerName"];
								$userName = $row["UserName"];
								$nameStyle = $row["StyleName"];
								$listenCount = $row["ListenCount"];
								$bitRate = $row["BitRate"];
								$idSong = $row["ID"];
								$idStyle = $row["StyleID"];
								$idUser = $row["OwnerID"];
								$idSinger = $row["SingerID"];
								$duongDanBaiHat = "Nghe.php?BaiHat=$idSong";
								$duongDanTheLoai = "TimKiem.php?Th_TheLoai=$idStyle";
								$duongDanNguoiDung = "TimKiem.php?Th_NguoiDang=$idUser";
								$duongDanCaSi = "TimKiem.php?Th_CaSi=$idSinger";
								
								echo("<div class='song-info' align='left'>");
								echo("<div class='song-icon'><img alt='Music Icon' src='images/MP3.gif'></div>");
								echo("<h2><a href='$duongDanBaiHat'>$songName</a></h2>");
								echo(
									 "<p>
										<label>Trình bày</label>: <a title='Tìm các bài hát do $singerName' href='$duongDanCaSi'>$singerName</a>
									</p>"); 
								echo(
									 "<p>
										<label>Đăng bởi</label>: 
										<span><a title='Nghe list bài hát của bạn $userName' href='$duongDanNguoiDung'>$userName</a></span>
										<span>"); 
								echo( "|"); 
								echo ("$bitRate kb/s"); 
								echo( "|"); 
								echo("<label>Lượt nghe</label>: $listenCount"); 
								echo( "|"); 
								echo("</span>");
								echo("<span><a title='Tìm các bài hát có thể loại: $nameStyle' href='$duongDanTheLoai'>$nameStyle</a></span></p>");
								echo("</div>");
								
							} 
                        ?>
                    </div>
                    <div class="header-list" onclick="HienRa('idNhacHot')">Top Nhạc HOT !!</div>
                    <div class="main-content" id="idNhacHot">
                    	<?php
							include_once("DataProvider.php");
                        	$sql = "select so.*,SingerName,UserName,StyleName,BitRate from song so,singer si,user u,song_style st,bit_rate br where so.SingerID = si.ID and so.OwnerID = u.ID and so.StyleID = st.ID and br.ID = so.BitRateID order by so.Rate DESC limit 0,10";
							$result = DataProvider::ExecuteQuery($sql);
							while($row = mysql_fetch_array($result))
							{
								$songName = $row["SongName"];
								$singerName = $row["SingerName"];
								$userName = $row["UserName"];
								$nameStyle = $row["StyleName"];
								$listenCount = $row["ListenCount"];
								$bitRate = $row["BitRate"];
								$idSong = $row["ID"];
								$idStyle = $row["StyleID"];
								$idUser = $row["OwnerID"];
								$idSinger = $row["SingerID"];
								$duongDanBaiHat = "Nghe.php?BaiHat=$idSong";
								$duongDanTheLoai = "TimKiem.php?Th_TheLoai=$idStyle";
								$duongDanNguoiDung = "TimKiem.php?Th_NguoiDang=$idUser";
								$duongDanCaSi = "TimKiem.php?Th_CaSi=$idSinger";
								
								echo("<div class='song-info' align='left'>");
								echo("<div class='song-icon'><img alt='Music Icon' src='images/MP3.gif'></div>");
								echo("<h2><a href='$duongDanBaiHat'>$songName</a></h2>");
								echo(
									 "<p>
										<label>Trình bày</label>: <a title='Tìm các bài hát do $singerName' href='$duongDanCaSi'>$singerName</a>
									</p>"); 
								echo(
									 "<p>
										<label>Đăng bởi</label>: 
										<span><a title='Nghe list bài hát của bạn $userName' href='$duongDanNguoiDung'>$userName</a></span>
										<span>"); 
								echo( "|"); 
								echo ("$bitRate kb/s"); 
								echo( "|"); 
								echo("<label>Lượt nghe</label>: $listenCount"); 
								echo( "|"); 
								echo("</span>");
								echo("<span><a title='Tìm các bài hát có thể loại: $nameStyle' href='$duongDanTheLoai'>$nameStyle</a></span></p>");
								echo("</div>");
								
							} 
                        ?>
                    </div>
                    <div class="header-list" onclick="HienRa('idTheLoaiHot')">HOT!!</div>
                    <div class="main-content" id="idTheLoaiHot">
                    	<?php
							include_once("DataProvider.php");
                        	$sql = "select so.*,SingerName,UserName,StyleName,BitRate from song so,singer si,user u,song_style st,bit_rate br where so.SingerID = si.ID and so.OwnerID = u.ID and so.StyleID = st.ID and br.ID = so.BitRateID order by so.ListenCount DESC limit 0,28";
							$result = DataProvider::ExecuteQuery($sql);
							while($row = mysql_fetch_array($result))
							{
								$songName = $row["SongName"];
								$singerName = $row["SingerName"];
								$userName = $row["UserName"];
								$nameStyle = $row["StyleName"];
								$listenCount = $row["ListenCount"];
								$bitRate = $row["BitRate"];
								$idSong = $row["ID"];
								$idStyle = $row["StyleID"];
								$idUser = $row["OwnerID"];
								$idSinger = $row["SingerID"];
								$duongDanBaiHat = "Nghe.php?BaiHat=$idSong";
								$duongDanTheLoai = "TimKiem.php?Th_TheLoai=$idStyle";
								$duongDanNguoiDung = "TimKiem.php?Th_NguoiDang=$idUser";
								$duongDanCaSi = "TimKiem.php?Th_CaSi=$idSinger";
								
								echo("<div class='song-info' align='left'>");
								echo("<div class='song-icon'><img alt='Music Icon' src='images/MP3.gif'></div>");
								echo("<h2><a href='$duongDanBaiHat'>$songName</a></h2>");
								echo(
									 "<p>
										<label>Trình bày</label>: <a title='Tìm các bài hát do $singerName' href='$duongDanCaSi'>$singerName</a>
									</p>"); 
								echo(
									 "<p>
										<label>Đăng bởi</label>: 
										<span><a title='Nghe list bài hát của bạn $userName' href='$duongDanNguoiDung'>$userName</a></span>
										<span>"); 
								echo( "|"); 
								echo ("$bitRate kb/s"); 
								echo( "|"); 
								echo("<label>Lượt nghe</label>: $listenCount"); 
								echo( "|"); 
								echo("</span>");
								echo("<span><a title='Tìm các bài hát có thể loại: $nameStyle' href='$duongDanTheLoai'>$nameStyle</a></span></p>");
								echo("</div>");
								
							} 
                        ?>
                    </div>
				  <!-- InstanceEndEditable --></div>
                  </div> 
            <div class="right-col">
            	<div id="idLoginBox">
                	
              	</div>
              <div align="center" style="background:url(images/title-search-box-bg.jpg);height:33px;width:275px;">
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
