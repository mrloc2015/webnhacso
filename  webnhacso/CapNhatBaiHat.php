<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php session_start();?>
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/TrangChu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fantasy Music</title>
<link href="css/giaodien.css" rel="stylesheet" type="text/css">
<script src="script/ThemBaiHat.js"></script>
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
   	      	<div class="left-header" id="idLeftMenu" align="center">
                 <span>Danh mục bài hát</span>
            </div>  
            <div class="left-header" id="idLeftMenu" align="center">
                 <span>Clip</span>
            </div>
            <div class="left-header" id="idLeftMenu" align="center">
                <span>Playlist HOT</span>
            </div>
            <div class="left-header" id="idLeftMenu" align="center">
                <span>Ca sĩ</span>
            </div>
            <td width="67%" valign="top" class="mid-col">
                <div id="idMainContent" class="main-content" align="center">                   
  					<!-- InstanceBeginEditable name="mainConten" -->
<?php
	include_once("DataProvider.php");
	if(isset($_REQUEST["MaBaiHat"]) == true)
	{
		$temp = DataProvider::ExecuteQuery("Select * From song Where ID = ".$_REQUEST["MaBaiHat"]);
		if($temp != false)
		{
			while($row = mysql_fetch_array($temp))
			{
				$song_id = $row["ID"];
				$song_name = $row["SongName"];
				$style_id = $row["StyleID"];
				//$owner_id = $row["OwnerID"];
				$singer_id = $row["SingerID"];		
				$writter = $row["Writter"];
				//$date_up = "\"".date("Y")."-".date("m")."-".date("d")."\"";
				//$listen_count = 0;
				//$download_count = 0;
				$bit_rate_id = $row["BitRateID"];
				$rate = $row["Rate"];				
				
				$source = "Du_Lieu/$song_id/".$row["Source"];

				?>
                
				<form action="xulyCapNhatBaiHat.php" method="post" enctype="multipart/form-data">
<div style="margin-left:100px; margin-top:50px">
	<div class="worms_field">
		<div class="worms_left"><label>Song Name:</label></div>       
       	<input name="song_id" type="hidden" value="<?php echo("$song_id"); ?>" />
        <input name="Th_SongName" type="text" style="width:145px" value="<?php echo("$song_name") ?>"/>
    </div>
    <div class="worms_field">
    	<div class="worms_left"><label>Style ID:</label></div> 
        <select name="Th_Style" style="width:145px">
			<?php
                $bang_Style = DataProvider::ExecuteQuery("Select * From song_style");            
                if($bang_Style != false)
                {
                    while($row = mysql_fetch_array($bang_Style))
                    {
                        $style_name = $row["StyleName"];
						$id = $row["ID"];
						if($style_id == $id)
	                        echo("<option value=".$row["ID"]." selected=\"selected\">$style_name</option>");
						else
	                        echo("<option value=".$row["ID"]." >$style_name</option>");							
                    }                
                }
            ?>
        </select>
    </div>
<!--<div class="worms_field">
		<div class="worms_left"><label>Owner ID:</label></div>    	
        <select name="Th_Owner" style="width:145px">
			<?php
                /*$bang_Owner = DataProvider::ExecuteQuery("Select * From user, user_info Where user.ID = user_info.UserID");            
                if($bang_Owner != false)
                {
                    while($row = mysql_fetch_array($bang_Owner))
                    {
                        $full_name = $row["UserName"]; 
                        echo("<option value=".$row["ID"].">$full_name</option>");
                    }                
                }*/
            ?>
        </select>
    </div>-->
    <div class="worms_field">
		<div class="worms_left"><label>Singer:</label></div>
        <?php
			$temp = DataProvider::ExecuteQuery("Select * From song, singer Where song.SingerID = singer.ID and song.ID = $song_id");
			if($temp != false)
			{
				while($row = mysql_fetch_array($temp))
				{
					$singer_id = $row["SingerName"];
				}
			}
		?>
        <input type="text" name="Th_Singer" style="width:145px" value="<?php echo("$singer_id") ?>"/>
    </div>
    <div class="worms_field">
        <div class="worms_left"><label>Writter:</label></div>
        <input name="Th_Writter" type="text" style="width:145px" value="<?php echo("$writter") ?>"/>
    </div>
<!--<div class="worms_field">
        <div class="worms_left"><label>Date Up:</label></div>
        <input name="Th_DateUp" type="text" width="150px" />
    </div>-->
<!--<div class="worms_field">
       	<div class="worms_left"><label>Listen Count:</label></div>
        <input name="Th_ListenCount" type="text" width="150px"/>
	</div>
	<div class="worms_field">
        <div class="worms_left"><label>Download Count:</label></div>
        <input name="Th_DownloadCount" type="text" width="150px"/>
    </div>	-->
    <div class="worms_field">
        <div class="worms_left"><label>Bit Rate ID:</label></div>
        <select name="Th_BitRate" style="width:145px">
            <?php
                $bang_BitRate = DataProvider::ExecuteQuery("Select * From bit_rate"); 
                if($bang_BitRate != false)
                {
                    while($row = mysql_fetch_array($bang_BitRate))
                    {
                        $bit_rate = $row["BitRate"];
						$id = $row["ID"];
						if($bit_rate_id == $id)
	                        echo("<option value=".$row["ID"]." selected=\"selected\">$bit_rate</option>");
						else
	                        echo("<option value=".$row["ID"].">$bit_rate</option>");	                        
                    }                
                }
            ?>
        </select> 
	</div> 
<!--<div class="worms_field">
        <div class="worms_left"><label>Rate:</label></div>
        <input name="Th_Rate" type="text" width="150px"/><br />
	</div>-->
    <div class="worms_field">
		<div class="worms_left"><label>Source:</label></div>
        <!-- <input name="Th_Source" type="text" width="150px"/> -->
		<input type="file" name="Th_Source"/>
    </div>
    <br />
	<br />
	<br />
    <div> 
        <object codebase="http://www.apple.com/qtactivex/qtplugin.cab"
            classid="clsid:6BF52A52-394A-11D3-B153-00C04F79FAA6" 
            type="application/x-oleobject"> 
            <param name="url" value="<?php echo("$source"); ?>"> 
            <embed src="<?php echo("$source"); ?>" autostart="false"
                type="application/x-mplayer2" 
                pluginspage="http://www.microsoft.com/Windows/MediaPlayer/"></embed> 
        </object>
    </div>
    <br />
	<br />
	<br />
	<div><input type="submit" value="Cập Nhật" /></div>
</div>   	
</form>  

				<?php
			}
		}		
	}
    else
    {
    	echo("<h1>Bạn Chưa Chọn Bài Hát Để Cập Nhật</h1>");
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
                        	<table width="100%" height="200px" border="0" cellspacing="0" bgcolor="#CCCCFF">
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
                                      <input type="text" name="txtMatKhau" id="txtMatKhau" width="200" />
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
                                    <td>Quên mật khẩu</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>Đăng ký tài khoản</td>
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
                        	<table width="100%" height="120px" border="0" cellspacing="0" bgcolor="#CCCCFF">
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