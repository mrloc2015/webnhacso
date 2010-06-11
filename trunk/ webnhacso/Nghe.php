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
							$duongDan = "../TrangChu.php?styleID=$idStyle";
							echo(" <li><a href=$duongDan>$nameStyle</a></li>");
                        } 
                    ?>
                </dl>
             </div>
            <div class="left-header" id="idClip" align="center">
                 <a href="TrangChu.php?Clip=1"><span>Clip</span></a>
            </div>
            <div class="left-header" id="idPlayList" align="center">
                <span>Playlist HOT</span>
            </div>
            <div class="left-PlayList">
            </div>
            <div class="left-header" id="idLeftMenu" align="center">
                <span>Ca sĩ & Ban nhạc</span>
            </div>
            <div class="left-CaSi">
            	 <dl>                
					<?php
                        include_once("DataProvider.php");
                        $sql = "select * from singer limit 10";
                        $result = DataProvider::ExecuteQuery($sql);
                        while($row = mysql_fetch_array($result))
                        {
                            $idStyle = $row["ID"];
                            $nameStyle = $row["SingerName"];
							$duongDan = "../TrangChu.php?singerID=$idStyle";
							echo(" <li><a href=$duongDan>$nameStyle</a></li>");
                        } 
                    ?>
                </dl>
            </div>
            </td>
            <td width="67%" valign="top" class="mid-col">
                <div id="idMainContent" class="main-content" align="center">                   
  					<!-- InstanceBeginEditable name="mainConten" -->
<?php
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
		$source = "Du_Lieu/BAI_HAT/$id/$source";
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
						$s = "<a href=\"javascript: playMedia(";
						$s .= $row["SongID"] . ",";
						$s .= "'".$row["Source"]."'";
						$s .= ")\">".$row["Source"]."</a><br>";
						echo($s);
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
                <table width="100%" border="0">                  
                  <tr>
                    <td>
						<div align="center" style="background:url(images/title-login-box-bg.jpg);height:33px">
                        </div>
                        <form id="frmDangNhap" name="DangNhap" method="post" action="xulyDangNhap.php">
                        	<table width="100%" height="200px" border="0" cellspacing="0" bgcolor="#33FF66">
                                  <tr>
                                    <td width="18%">&nbsp;</td>
                                    <td width="65%">Tên đăng nhập</td>
                                    <td width="17%">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" align="right"><label>
                                      <input type="text" name="txtTenDangNhap" id="txtTenDangNhap" width="200" />
                                    </label></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>Mật khẩu</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" align="right"><label>
                                      <input type="password" name="txtMatKhau" id="txtMatKhau" width="200" />
                                    </label></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" align="center"><label>
                                        <input type="submit" name="btnDangNhap" id="btnDangNhap" value="Đăng Nhập"/>
                                    </label></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td><a>Quên mật khẩu</a></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td><a href="DangKi.php" title="Đăng ký tài khoản mới">Đăng ký tài khoản</a></td>
                                    <td>&nbsp;</td>
                                  </tr>
                             </table>
                        </form>
                    </td>
                  </tr>
                  <tr>
                    <td>
                    	<div align="center" style="background:url(images/title-search-box-bg.jpg);height:33px;">
                        </div>
                        <form id="frmTimKiem" name="TimKiem" method="post" action="xulyTimKiem.php">
                        	<table width="100%" height="120px" border="0" cellspacing="0" bgcolor="#33FF66">
                                  <tr>
                                    <td width="18%">&nbsp;</td>
                                    <td width="65%">Từ khóa</td>
                                    <td width="17%">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" align="right"><label>
                                      <input type="text" name="txtTuKhoa" id="txtTuKhoa" width="200" />
                                    </label></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>Theo</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" align="right"><label>
                                      <select name="cmbTheo" id="cmbTheo">
                                      </select>
                                    </label></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" align="center"><label>
                                        <input type="submit" name="btnTimKiem" id="btnTimKiem" value="Tìm Nhạc"/>
                                    </label></td>
                                    <td>&nbsp;</td>
                                  </tr>
                             </table>
                        </form>
                    </td>
                  </tr>
                </table>
                <div class="right-content" id="idRightContent" align="center">
                    <!-- InstanceBeginEditable name="RightContent" -->RightContent<!-- InstanceEndEditable -->
                </div>
            </td>
          </tr>
       </table>  
   </div>

</body>
<!-- InstanceEnd --></html>
