<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/TrangChu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fantasy Music</title>
<link href="css/giaodien.css" rel="stylesheet" type="text/css">
<script src="js/jquery.jplayer.min.js"></script>
<script src="js/jquery.media.js"></script>
</head>

<body>
<div class="banner" id="idBanner" align="center">
<img src="images/header-02.jpg" width="1000">
</div>
<div class="main" id="idmain">
	
   <table width="100%" border="0" cellspacing="0">
  <tr>
    <td class="left-col">
    	 <div class="left-header" id="idLeftMenu" align="center">
        	Menu
      	 </div>
          <table height="90" width="180" border="0" cellspacing="0">
          <tr>
            <td><a href="TrangChu.php">Trang Chủ</a></td>
          </tr>
          <tr>
            <td><a href="ThemBaiHat.php">Đăng/Upload bài hát mới</a></td>
          </tr>
          <tr>
            <td>Đăng ký tài khoản mới</td>
          </tr>
        </table>
    	<div class="left-header" id="idLeftMenu" align="center">
  			Danh mục bài hát
  		</div>  
       	<div class="left-header" id="idLeftMenu" align="center">
        	Clip
      	</div>
       	<div class="left-header" id="idLeftMenu" align="center">
        	Playlist HOT
      	</div>
      	<div class="left-header" id="idLeftMenu" align="center">
        	Ca sĩ
      	</div>
    </td>
    <td class="mid-col" valign="top">
        <div id="idMainContent" class="main-content" align="center">
        	<!-- InstanceBeginEditable name="mainConten" -->
            <?php
	include_once("DataProvider.php");	
?>
<form action="xulyThemBaiHat.php" method="post" enctype="multipart/form-data">
<div style="margin-left:100px; margin-top:50px">
	<div class="worms_field">
		<div class="worms_left"><label>Song Name:</label></div>       
       	<input name="Th_SongName" type="text" width="150px" />
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
        <input type="text" name="Th_Singer" style="width:140px" />
    </div>
    <div class="worms_field">
        <div class="worms_left"><label>Writter:</label></div>
        <input name="Th_Writter" type="text" width="150px"/>
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
        <div class="worms_left"><label>Rate:</label></div>
        <input name="Th_Rate" type="text" width="150px"/><br />
	</div>
    <div class="worms_field">
		<div class="worms_left"><label>Source:</label></div>
        <!-- <input name="Th_Source" type="text" width="150px"/> -->
		<input type="file" name="Th_Source" />
    </div>
    
	<div><input type="submit" value="Thêm" /></div>
</div>    
</form>
			<!-- InstanceEndEditable -->
        </div>
    </td>
    <td class="right-col" valign="top">
    	<table width="100%" border="0" cellspacing="0">
          <tr>
            <td>form đăng nhập</td>
          </tr>
          <tr>
            <td>form tìm kiếm đơn giản</td>
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
