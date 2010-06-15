<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php session_start();?>
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/TrangChu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fantasy Music</title>
<link href="css/giaodien.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="js/jquery.media.js"></script>
<script type="text/javascript" src="js/jquery.timers.js"></script>
<script type="text/javascript" src="script/ThemBaiHat.js"></script>
</head>

<body>
  <div class="banner" id="idBanner" align="center">
    	<img src="images/header-02.jpg" width="1000" height="120">
    </div>
  	<div class="main" id="idmain">
        <table width="100%" border="0" cellspacing="0">
          <tr>
            <td width="18%" class="left-col" valign="top">
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
                 <span><a href="TrangChu.php?Clip=1">Clip</a></span>
            </div>
            <div class="left-header" id="idPlayList" align="center">
                <span>Playlist HOT</span>
            </div>
            <div class="left-PlayList">
            	 <dl>                
					<?php
                        include_once("DataProvider.php");
                        $sql = "select u.ID, u.UserName from playlist pl, user u where pl.ID = u.PlaylistID and pl.ListenCount >= 0";
                        $result = DataProvider::ExecuteQuery($sql);
                        while($row = mysql_fetch_array($result))
                        {
                            $idUser = $row["ID"];
                            $userName = $row["UserName"];
							$duongDan = "TimKiem.php?TimKiem=true&Th_NguoiDang=$userName";
							echo(" <li><a href='$duongDan'>$userName</a></li>");
                        } 
                    ?>
                </dl>
            </div>
            <div class="left-header" id="idLeftMenu" align="center">
                <span>Ca sĩ & Ban nhạc</span>
            </div>
            <div class="left-CaSi">
            	 <dl>                
					<?php
                        include_once("DataProvider.php");
                        $sql = "select si.SingerName,si.ID from singer si, song so where so.SingerID = si.ID group by si.ID, si.SingerName having sum(so.ListenCount) >=0 limit 10";
                        $result = DataProvider::ExecuteQuery($sql);
                        while($row = mysql_fetch_array($result))
                        {
                            $idSinger = $row["ID"];
                            $singerName = $row["SingerName"];
							$duongDan = "TimKiem.php?TimKiem=true&Th_CaSi=$singerName";
							echo(" <li><a href='$duongDan'>$singerName</a></li>");
                        } 
                    ?>
                </dl>
            </div>
            </td>
            <td width="67%" valign="top" class="mid-col">
                <div id="idMainContent" class="main-content" align="center">                   
  					<!-- InstanceBeginEditable name="mainConten" -->
<?php
	//giả dụ user sau_con_89 mã là 2 đã đăng nhập được
	$user_id = 2; //lấy session
	include_once("DataProvider.php");
	if(isset($_REQUEST["BaiHat"]) == true)		//Bài hát	
	{
		$id = "";
		$source = "";
		$temp = DataProvider::ExecuteQuery("Select * From song Where ID = " . $_REQUEST["BaiHat"]);
		if($temp != false)
		{
			$row = mysql_fetch_array($temp);
			$id = $row["ID"];
			$source = $row["Source"];
		}
		//$source = "Du_Lieu/BAI_HAT/$id/$source";
		?>
			<div style="margin-top:50px"> 
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
			</div>
             <script type="text/javascript" language="javascript">
				function TaiVe(url)
				{					
					window.location = url;
				} 
			</script>
            <input id="TaiVe" onclick="TaiVe('<?php echo("$source"); ?>')" type="button" value="Tải Về" />
            <form name="ThemVaoPlayList" action="xulyThemVaoPlayList.php" method="post">
                <input name="song_id" type="hidden" value="<?php echo($id); ?>" />
                <input name="source" type="hidden" value="<?php echo($source); ?>" />
                <input name="user_id" type="hidden" value="<?php echo($user_id); ?>" />
                <input style="float:right; margin-right:50px" name="submit" type="submit" value="Thêm Vào Playlist"/>
            </form>
            <?php
	}
	else	
	{
		if(isset($_REQUEST["PlayList"]) == true)	//ngựơc lại là playlist
		{
			$playlist_id = $_REQUEST["PlayList"];
			$user_name = ""; //lấy session
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
				echo("Đường dẫn theo từng máy <br>" . $source . "<br />");
				?>
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
				</div>
                
                <script type="text/javascript" language="javascript">
					function playMedia(song_id, source)
					{						
						//alert("Du_Lieu/BAI_HAT/" + song_id + "/" + source);
						var s = "Du_Lieu/BAI_HAT/" + song_id + "/" + source;
						//document.getElementById('playerEm').URL = s;
						$("#playerEm").attr("URL",s);
					} 
	            </script>
				<?php
				//Danh sách bài hát trong playlist
				$temp = DataProvider::ExecuteQuery("Select SongID, Source From playlist_detail pd, song s Where pd.PlayListID = $playlist_id and pd.SongID = s.ID");
				if($temp != false)
				{
					while($row = mysql_fetch_array($temp))
					{
					?>
					<div style="height:20px; margin-top:20px; margin-left:120px" align="left">						
						<a href="javascript: playMedia(<?php echo($row["SongID"]); ?>,'<?php echo($row["Source"]); ?>')"><?php echo($row["Source"]); ?></a>                        					
					</div>
                    <?php
					}
				}				
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
					<!-- InstanceEndEditable -->
                </div>
            </td>
            <td width="20%" valign="top" class="right-col">
                <div align="center" style="background:url(images/title-login-box-bg.jpg);height:33px;width:240px">
                </div>
                <div class="right-login">
                    <form id="frmDangNhap" action="xulyDangNhap.php" name="frmDangNhap" method="get">
                        <label for="txtTenDangNhap">Tên đăng nhập</label>
                        <input type="text" maxlength="30" name="txtTenDangNhap" id="txtTenDangNhap" tabindex="1"><br>
                        <label for="txtMatKhau">Mật khẩu</label><br>
                        <input type="password" maxlength="30" name="txtMatKhau" id="txtMatKhau" tabindex="2">
                        <input type="submit" id="btnDangNhap" name="btnDangNhap" value="Đăng nhập">        
                    </form> 
                    <ul>
                        <li><a>Quên mật khẩu</a></li>
                        <li><a>Đăng ký thành viên</a></li>
                    </ul>  
                </div>
                <div class="right-username">
                    Thành viên chính thức
                </div>
                <div class="right-userinfo">
                  <div>
                    <div>
                        <b>Xin chào:</b><span style="color:#09F;font-weight:bold;">Taki Squall</span>
                    </div>
                    <ul>
                        <li>
                            <a href="quanlytaikhoan" title="Quản lý tài khoản">Quản lý tài khoản</a>
                        </li>
                        <li>
                            <a href="ngheplaylist" title="Nghe playlist">Nghe Playlist</a>
                        </li>
                        <li>
                            <a href="xulyThoat" title="Thoát">Thoát</a>
                        </li>
                    </ul>
                </div>
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
            </td>
          </tr>
       </table>  
   </div>

</body>
<!-- InstanceEnd --></html>
