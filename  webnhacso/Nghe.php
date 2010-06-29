<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php session_start();?>
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
<script type="text/javascript" src="script/Ajax_DangNhap.js"></script>
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
                <div class="left-header" id="idDanhMucBaiHat" align="center">
                     <span>Danh mục bài hát</span>
                </div>  
                 <div class="left-DanhMuc">
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
                <div class="left-header" id="idPlayList" align="center">
                    <span>Playlist HOT</span>
                </div>
                 <div class="left-PlayList">
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
                <div class="left-header" id="idLeftMenu" align="center">
                    <span>Ca sĩ Việt Nam</span>
                </div>
                <div class="left-CaSi">
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
               <div class="left-header" id="idLeftMenu" align="center">
                    <span>Ca sĩ Châu Á</span>
                </div>
               <div class="left-CaSi">
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
               <div class="left-header" id="idLeftMenu" align="center">
                    <span>Ca sĩ Âu Mỹ</span>
                </div>
               <div class="left-CaSi">
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
	//giả dụ user sau_con_89 mã là 2 đã đăng nhập được
	if(isset($_SESSION["UserID"]))
		$user_id = $_SESSION["UserID"]; //lấy session
	$id = "";
	include_once("DataProvider.php");
	if(isset($_REQUEST["BaiHat"]) == true)		//Bài hát	
	{		
		$source = "";
		$sql = "Select * From song so, singer si, bit_rate br, user u, song_style st Where so.SingerID = si.ID and so.BitRateID = br.ID and so.OwnerID = u.ID and so.StyleID = st.ID and so.ID = " . $_REQUEST["BaiHat"];
		//echo($sql);
		$temp = DataProvider::ExecuteQuery($sql);
		if($temp != false)
		{
			$row = mysql_fetch_array($temp);
			$id = $_REQUEST["BaiHat"];// $row["song.ID"];
			//echo($id);
			$source = $row["Source"];
			$songName = $row["SongName"];
			$style = $row["StyleName"];
			$userName = $row["UserName"];
			$bitRate = $row["BitRate"];
			$singerName = $row["SingerName"];
			$listenCount = $row["ListenCount"];
			$listenCount = $listenCount + 1;
			//echo ($listenCount);
			$duongDanCaSi = "TimKiem.php?Th_CaSi=" . $row["SingerID"];
			$duongDanTheLoai = "TimKiem.php?Th_TheLoai=" . $row["StyleID"];
			$duongDanNguoiDang = "TimKiem.php?Th_NguoiDang=" . $row["OwnerID"];
		}
		//$source = "Du_Lieu/BAI_HAT/$id/$source";
		//echo($source);
				
		$sql = "Update song Set ListenCount = $listenCount Where ID = $id";
		//echo($sql);
		DataProvider::ExecuteQuery($sql)
		
		?>
        	
        	<div class="song-info">
            	<div class="song-title" align="left">
            		<?php echo("$songName");?>
            	</div>
                <div class="song-info">
                	<?php echo("Trình bày:<a href='$duongDanCaSi'>$singerName</a>");?>
                </div>
                <div class="song-info">
                	<?php echo("Người đăng:<a href='$duongDanNguoiDang'>$userName</a> | Lượt nghe:$listenCount | Bit rate:$bitRate kb/s | <a href='$duongDanTheLoai'>$style</a>");?>
                </div>
            </div>
			<div align="center" style="margin-top:50px"> 
				<object codebase="http://www.apple.com/qtactivex/qtplugin.cab"
				classid="clsid:6BF52A52-394A-11D3-B153-00C04F79FAA6" 
				type="application/x-oleobject">        			
					<param name="url" value="<?php echo("$source"); ?>"> 
					<embed src="<?php echo("$source"); ?>"
                    autostart="true"
                    autorewind = "true"
					type="application/x-mplayer2" 
					pluginspage="http://www.microsoft.com/Windows/MediaPlayer/"></embed> 
				</object>
			</div><br />
            <?php
				$time = 1;
				
				$temp = DataProvider::ExecuteQuery("Select * From myweb");
				if($temp != false)
				{
					while($row = mysql_fetch_array($temp))
						$time = $row["DownloadWaitTime"];
				}
			?>
             <script type="text/javascript" language="javascript">
			 	var i = <?php echo($time); ?>;
				var w = 1;
				var temp;
				
				function Dem(url)
				{			
					$("#TaiVe").attr("value",i);
					$("#ngang").attr("width",w*2+"px");
					if(i < 1)
					{
						$("#TaiVe").attr("value",i);
						i = <?php echo($time); ?>;
						$("#ThongBao").attr("innerHTML","Chỉ có người có IQ cao mới down bài này - Bạn là 1 trong số đó");
						window.location = url;
						temp = clearInterval(temp);
						return;
					}
					
					w++;
					i--;				
				}

				function TaiVe(url)
				{		
					temp = setInterval("Dem('" + url + "')",1000);
				} 
				
				function USER_ID()
				{
					alert($("#user_id").attr("value"));
					//if(<?php echo($_SESSION["UserID"]); ?> > 0)
						//$("#user_id").attr("value",<?php echo($_SESSION["UserID"]); ?>);
				}
			</script>
            
            <div class="main-content">
            	<div style="float:left;margin-left:30px;margin-right:10px"><input id="TaiVe" onclick="TaiVe('<?php echo("$source"); ?>')" type="button" value="Tải Về" /></div>
				<div id="ThongBao"style="float:left" align="left"><hr id="ngang" width="0px" /></div>                
           		<form name="ThemVaoPlayList" action="xulyThemVaoPlayList.php" method="post">
                <input name="song_id" id="song_id" value="<?php echo($id); ?>" type="hidden"/>
                <input name="source" type="hidden" value="<?php echo($source); ?>" />
                <input name="user_id" id="user_id" type="hidden" value="<?php if(isset($user_id)) echo($user_id); ?>" />
                <div align="left"><input name="submit" type="submit" value="Thêm Vào Playlist" onclick="USER_ID()"/></div>               
            	</form>
            </div>
            
            <div class="main-content">
            	<?php
					include_once("DataProvider.php");
					$sql = "select so.*,SingerName,UserName,StyleName,BitRate,PlayListID from song so,singer si,user u,song_style st,bit_rate br where so.SingerID = si.ID and so.OwnerID = u.ID and so.StyleID = st.ID and br.ID = so.BitRateID and so.SingerID in(select si1.ID from singer si1, song so1 where si1.ID = so1.SingerID and so1.ID = " . $_REQUEST["BaiHat"] . ") limit 10";
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
						$playList = $row["PlayListID"];
						$duongDanBaiHat = "Nghe.php?BaiHat=$idSong";
						$duongDanTheLoai = "TimKiem.php?Th_TheLoai=$idStyle";
						$duongDanNguoiDung = "Nghe.php?PlayList=$playList";
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
            <div align="left" style="vertical-align:middle;margin-left:100px;margin-top:20px;margin-bottom:20px;margin-right:100px">
            	<h2>Bình Luận</h2>
                <hr />
            </div>      
            <?php
			$sql = "Select * From comment c, comment_detail cd, user u Where c.ID = cd.CommentID and c.UserID = u.ID and c.SongID = $id";
            $temp = DataProvider::ExecuteQuery($sql);
            if($temp != false)
            {
                while($row = mysql_fetch_array($temp))
                {
                    echo("<div class='main-content' align='left'>");
					echo("<a>".$row["UserName"]."</a>&nbsp;");
					echo("<font color='#999999'>".$row["CreateDate"]."</font>");
                    echo("<br>".$row["Content"]);
                    echo("</div>");
                }
            }
			?>
            <div class="main-content">
                <!--<?php echo($user_id); ?> <?php echo($id); ?> -->
                <form id="form1" name="form1" method="post" action="xulyBinhLuan.php">
                    <input name="UserID" id="UserID" type="hidden" value="<?php echo($user_id); ?>" />
                    <input name="SongID" id="SongID" type="hidden" value="<?php echo($id); ?>" />
                    Xin vui lòng viết bình luận cho bài hát	<br /><br />
                    <textarea name="NoiDung" id="NoiDung" style="display:block" cols="30" rows="3"></textarea> 
                    <input type="submit" value="IQ Cao" title="Bạn có chỉ số IQ cao không?" /><br /><br />
                    p/s: chỉ có người có chỉ số IQ cao mới để lại bình luận
                </form>
            </div>
            <?php
	}
	else	
	{
		if(isset($_REQUEST["PlayList"]) == true)	//ngựơc lại là playlist
		{
			$playlist_id = $_REQUEST["PlayList"];
			$temp = DataProvider::ExecuteQuery("Select * From user Where PlayListID = $playlist_id");
			if($temp != false)
			{
				$row = mysql_fetch_array($temp);
				$user_name = $row["UserName"];
			}
			$source = "Du_Lieu/USER/$user_name/$playlist_id.wpl";
			//echo("$source<br />");
			if(file_exists($source) == true)
			{
				$path = getcwd ();
				$source = $path . "/" . $source;
				//echo($source);
				$duongDanNguoiDang = "TimKiem.php?Th_NguoiDang='$user_name'";				
				//echo("Đường dẫn theo từng máy <br>" . $source . "<br />");
		
				$listenCount = 0;
				$temp = DataProvider::ExecuteQuery("Select * From playlist Where ID = $playlist_id");
				if($temp != false)
				{
					$row = mysql_fetch_array($temp);
					$listenCount = $row["ListenCount"] + 1;
					//echo($listenCount);
				}
				$sql = "Update playlist Set ListenCount = $listenCount Where ID = $playlist_id";
				//echo($sql);
				DataProvider::ExecuteQuery($sql)
		
				?>
                <div class="song-info">
            	<div class="song-title" align="left">
            		<?php echo("$user_name");?>
            	</div>
                <div class="song-info">
                	<?php echo("Người đăng:<a href='$duongDanNguoiDang'>$user_name</a>"); ?>
                    <?php echo(" | Lượt nghe: $listenCount"); ?>
                </div>
            </div>
				<div id="playerObj" style="margin-top:50px"> 
					<object codebase="http://www.apple.com/qtactivex/qtplugin.cab"
					classid="clsid:6BF52A52-394A-11D3-B153-00C04F79FAA6" 
					type="application/x-oleobject"> 
<!--						<param name="url" value="<?php echo("$source"); ?>"> 	-->
						<embed id="playerEm" src="<?php echo("$source"); ?>"
                        autostart="true"
						type="application/x-mplayer2" 
						pluginspage="http://www.microsoft.com/Windows/MediaPlayer/"></embed> 
					</object>                    
				</div><br />
                
                <script type="text/javascript" language="javascript">
					function playMedia(song_id, source)
					{						
						//alert("Du_Lieu/BAI_HAT/" + song_id + "/" + source);
						//var s = "Du_Lieu/BAI_HAT/" + song_id + "/" + source;
						//document.getElementById('playerEm').URL = s;
						$("#playerEm").attr("URL",source);
					} 
	            </script>
                <div class="main-content">
				<?php				
				//Danh sách bài hát trong playlist
				$temp = DataProvider::ExecuteQuery("Select * From playlist_detail pd, song s, singer si, song_style ss, user u, bit_rate br Where pd.SongID = s.ID and s.SingerID = si.ID and s.StyleID = ss.ID and s.OwnerID = u.ID and s.BitRateID = br.ID and pd.PlayListID = $playlist_id");
				if($temp != false)
				{
					//echo($playlist_id);
					while($row = mysql_fetch_array($temp))
					{
						$mang = explode("/",$row["Source"]);
						$tenbai = $mang[3];
						
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
						echo("<div class='song-icon'>
							<img alt='Music Icon' src='images/MP3.gif'>
							 </div>");
						echo("<h2><a href=\"javascript: playMedia($idSong,'".$row["Source"]."')\">$tenbai</a></h2>");
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
				}	
				?>
                </div>
				<div align="left" style="vertical-align:middle;margin-left:100px;margin-top:20px;margin-bottom:20px;margin-right:100px">
            	<h2>Bình Luận</h2>
                <hr />
            </div>      
            <?php
			$sql = "Select * From comment c, comment_detail cd, user u Where c.ID = cd.CommentID and c.UserID = u.ID and c.PlayListID = $playlist_id";
            $temp = DataProvider::ExecuteQuery($sql);
            if($temp != false)
            {
                while($row = mysql_fetch_array($temp))
                {
                    echo("<div class='main-content' align='left'>");
					echo("<a>".$row["UserName"]."</a>&nbsp;");
					echo("<font color='#999999'>".$row["CreateDate"]."</font>");
                    echo("<br>".$row["Content"]);
                    echo("</div>");
                }
            }
			?>
            <div class="main-content">
                <!--<?php echo($user_id); ?> <?php echo($id); ?> -->
                <form id="form1" name="form1" method="post" action="xulyBinhLuan.php">
                    <input name="UserID" id="UserID" type="hidden" value="<?php echo($user_id); ?>" />
                    <input name="SongID" id="SongID" type="hidden" value="<?php echo($id); ?>" />
                    <input name="PlayListID" id="PlayListID" type="hidden" value="<?php echo($_REQUEST["PlayList"]); ?>" />
                    Xin vui lòng viết bình luận cho bài hát	<br /><br />
                    <textarea name="NoiDung" id="NoiDung" style="display:block" cols="30" rows="3"></textarea> 
                    <input type="submit" value="IQ Cao" title="Bạn có chỉ số IQ cao không?" /><br /><br />
                    p/s: chỉ có người có chỉ số IQ cao mới để lại bình luận
                </form>
            </div>
            <?php
			}
			else
			{
				echo("<h1>Playlist này không tồn tại!!!</h1>");		
			}
		}
		else 	//cuối cùng là chưa chọn bài
		{
			echo("<h1>Bạn Chưa Chọn Bài Hát Để Nghe!!!</h1>");			
		}
	}	

?>

					
					<!-- InstanceEndEditable --></div>
                  </div> 
            <div class="right-col">
            	<div id="idLoginBox">
                	
              	</div>
              <div align="center" style="background:url(images/title-search-box-bg.jpg);height:33px;width:240px;">
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
              </script>
              <div class="right-search">
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
