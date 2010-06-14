<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

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
							$duongDan = "../TrangChu.php?userID=$idUser";
							echo(" <li><a href=$duongDan>$userName</a></li>");
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
							$duongDan = "../TrangChu.php?singerID=$idSinger";
							echo(" <li><a href=$duongDan>$singerName</a></li>");
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
	$noi_dung = "";
	if(isset($_REQUEST["TimKiem"]) == true)
	{
		$ten_bai_hat = " and SongName like '%" . $_REQUEST["Th_TenBaiHat"] . "%'";
		$ca_si = " and SingerID=" . $_REQUEST["Th_CaSi"];
		$nguoi_dang = " and OwnerID=" . $_REQUEST["Th_NguoiDang"];
		$the_loai = " and StyleID=" . $_REQUEST["Th_TheLoai"];
		$chat_luong = " and BitRateID=" . $_REQUEST["Th_ChatLuong"];
		
		$sql = "Select * From song Where 1=1";
		if(trim($_REQUEST["Th_TenBaiHat"]) != "")
			$sql .= $ten_bai_hat;
		if($_REQUEST["Th_CaSi"] != 0)
			$sql .= $ca_si;
		if($_REQUEST["Th_NguoiDang"] != 0)
			$sql .= $nguoi_dang;
		if($_REQUEST["Th_TheLoai"] != 0)
			$sql .= $the_loai;
		if($_REQUEST["Th_ChatLuong"] != 0)
			$sql .= $chat_luong;
		echo($sql);
		$temp = DataProvider::ExecuteQuery($sql);
		if($temp != false)
		{			
			while($row = mysql_fetch_array($temp))
			{
				$noi_dung .= "<br>";
            	$noi_dung .= $row["ID"].",";
				$noi_dung .= $row["SongName"].",";
				$noi_dung .= $row["StyleID"].",";
				$noi_dung .= $row["OwnerID"].",";
				$noi_dung .= $row["SingerID"].",";
				$noi_dung .= $row["Writter"].",";
				$noi_dung .= $row["DateUp"].",";
				$noi_dung .= $row["ListenCount"].",";
				$noi_dung .= $row["DownloadCount"].",";
				$noi_dung .= $row["BitRateID"].",";
				$noi_dung .= $row["Rate"].",";
				$noi_dung .= $row["Source"].",";
				$noi_dung .= $row["Clip"].",";
				$noi_dung .= "<br>";
			}			
			//$row["ID"] 	$row["SongName"] 	$row["StyleID"] 	$row["OwnerID"] 	$row["SingerID"] 	$row["Writter"] 	$row["DateUp"] 	$row["ListenCount"] 	$row["DownloadCount"] 	$row["BitRateID"] 	$row["Rate"] 	$row["Source"] 	$row["Clip"]	
		}		
	}
?>                            
<form action="TimKiem.php" method="post">
<div style="height:30px; margin-top:50px" align="left">
    <div style="width:80px;float:left; margin-left:50px"><label>Tên bài hát:</label></div>       
    <input name="Th_TenBaiHat" type="text" style="width:360px;" />
</div>   
<div style="height:30px;" align="left">
    <div style="width:80px;float:left; margin-left:50px"><label>Ca sĩ:</label></div>       
    <input style="margin-right:10px" name="Th_CaSi" type="text" />
    <label style="margin-right:5px">Người đăng:</label>
    <input name="Th_NguoiDang" type="text" style="width:120px;" />
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
			?>
				<option value="<?php echo($row["ID"]); ?>"><?php echo($row["StyleName"]); ?></option>
			<?php	
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
			?>
				<option value="<?php echo($row["ID"]); ?>"><?php echo($row["BitRate"]); ?></option>
			<?php	
			}
		}
    ?>
    </select>
</div>
<div align="center">
	<input name="TimKiem" type="submit" value="Tìm Kiếm" />
</div>
</form>
<div style="height:30px">
</div>
<div id="TheHien" align="left" style="margin-left:30px">
	<?php echo($noi_dung); ?>
</div>

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
              <div class="right-search">
                    <form id="frmTimKiem" name="TimKiem" method="post" action="xulyTimKiem.php">
                        <label for="txtTuKhoa">Từ khóa</label><br>
                      <input type="text" name="txtTuKhoa" id="txtTuKhoa" style="width:200px;"/><br>
                        <label for="cmbTheo">Theo</label><br>
                      <select name="cmbTheo" id="cmbTheo" style="width:200px">
                       	<option>&nbsp;</option>
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
