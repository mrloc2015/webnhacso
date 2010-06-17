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
							$duongDan = "TimKiem.php?Th_TheLoai=$idStyle";
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
                            $userName = $row["UserName"];
							$duongDan = "TimKiem.php?Th_NguoiDang=$userName";
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
                            $singerName = $row["SingerName"];
							$duongDan = "TimKiem.php?Th_CaSi=$singerName";
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
	include_once("DataProvider.php");	
?>
<form action="xulyThemBaiHat.php" method="post" enctype="multipart/form-data">
<div style="margin-left:100px; margin-top:50px">
	<div class="worms_field">
		<div class="worms_left"><label>Song Name:</label></div>       
       	<input name="Th_SongName" type="text" style="width:145px" />
    </div>
    <div class="worms_field">
    	<div class="worms_left"><label>Style ID:</label></div> 
        <select name="Th_Style" style="width:145px">
			<option value="15">Không Biết</option>
			<?php
                $bang_Style = DataProvider::ExecuteQuery("Select * From song_style");            
                if($bang_Style != false)
                {
                    while($row = mysql_fetch_array($bang_Style))
                    {
                        $style_name = $row["StyleName"]; 
                        echo("<option value=".$row["ID"].">$style_name</option>");
                    }                
                }
            ?>
        </select>
    </div>
    <div class="worms_field">
		<div class="worms_left"><label>Owner ID:</label></div>    	
        <select name="Th_Owner" style="width:145px">
			<?php
                $bang_Owner = DataProvider::ExecuteQuery("Select * From user, user_info Where user.ID = user_info.UserID");            
                if($bang_Owner != false)
                {
                    while($row = mysql_fetch_array($bang_Owner))
                    {
                        $full_name = $row["UserName"]; 
                        echo("<option value=".$row["ID"].">$full_name</option>");
                    }                
                }
            ?>
        </select>
    </div>
    <div class="worms_field">
		<div class="worms_left"><label>Singer:</label></div>
        <input type="text" name="Th_Singer" style="width:145px" value="Không Biết"/>
    </div>
    <div class="worms_field">
        <div class="worms_left"><label>Writter:</label></div>
        <input name="Th_Writter" id="Th_Writter" type="text" style="width:145px" value="Không Biết"/>
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
                        echo("<option value=".$row["ID"].">$bit_rate</option>");
                    }                
                }
            ?>
        </select> 
	</div> 
    <div class="worms_field">
        <div class="worms_left" style="margin-top:5px"><label>Rate:</label></div>
		<input name="Th_Rate" id="Th_Rate" type="hidden" style="width:145px" value="0"/>        
         
        <div style="float:right; margin-right:180px; height:45px">        
            <img onmouseover="rate_over(1)" onmouseout="rate_out(1)" onclick="rate_click(1)" id="1" style="border:none;outline:none;text-decoration:none;" src="images/sao1.jpg" width="25" height="25"/>
            <img onmouseover="rate_over(2)" onmouseout="rate_out(2)" onclick="rate_click(2)" id="2" style="border:none;outline:none;text-decoration:none;" src="images/sao1.jpg" width="25" height="25"/>
            <img onmouseover="rate_over(3)" onmouseout="rate_out(3)" onclick="rate_click(3)" id="3" style="border:none;outline:none;text-decoration:none;" src="images/sao1.jpg" width="25" height="25"/>
           	<img onmouseover="rate_over(4)" onmouseout="rate_out(4)" onclick="rate_click(4)" id="4" style="border:none;outline:none;text-decoration:none;" src="images/sao1.jpg" width="25" height="25"/>
            <img onmouseover="rate_over(5)" onmouseout="rate_out(5)" onclick="rate_click(5)" id="5" style="border:none;outline:none;text-decoration:none;" src="images/sao1.jpg" width="25" height="25"/>
            <script type="text/javascript" language="javascript">
        		document.getElementById("Th_Rate").value = 0;
			</script>
        </div><br />
	</div>
    <div class="worms_field">
		<div class="worms_left" style="margin-top:18px"><label>Source:</label></div>
        <!-- <input name="Th_Source" type="text" width="150px"/> -->
		<input type="file" name="Th_Source"/>
    </div>
    
	<div style="margin-top:30px; margin-right:100px"><input type="submit" value="Thêm" /></div>
</div>    
</form>
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
