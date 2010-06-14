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
                            $idUser = $row["ID"];
                            $userName = $row["UserName"];
							$duongDan = "TimKiem.php?Th_NguoiDang=$idUser";
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
							$duongDan = "TimKiem.php?Th_CaSi=$idSinger";
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
	if(isset($_REQUEST["Th_TenBaiHat"]) == true and $_REQUEST["Th_TenBaiHat"] != "")
		$ten_bai_hat = " and s.SongName like '%" . $_REQUEST["Th_TenBaiHat"] . "%'";
	$ca_si = "";
	if(isset($_REQUEST["Th_CaSi"]) == true  and $_REQUEST["Th_CaSi"] != "")
		$ca_si = " and sin.SingerName like '%" . $_REQUEST["Th_CaSi"] . "%'";
	$nguoi_dang = "";
	if(isset($_REQUEST["Th_NguoiDang"]) == true  and $_REQUEST["Th_NguoiDang"] != "")
		$nguoi_dang = " and u.UserName like '%" . $_REQUEST["Th_NguoiDang"] . "%'";
	$the_loai = 0;
	if(isset($_REQUEST["Th_TheLoai"]) == true)
		$the_loai = " and s.StyleID=" . $_REQUEST["Th_TheLoai"];
	$chat_luong = 0;
	if(isset($_REQUEST["Th_ChatLuong"]) == true)
		$chat_luong = " and s.BitRateID=" . $_REQUEST["Th_ChatLuong"];
		
	if(isset($_REQUEST["TimKiem"]) == true)
	{
		$sql = "Select count(s.ID) From song s, song_style ss, user u, singer sin, bit_rate br Where s.StyleID = ss.ID and s.OwnerID = u.ID and s.SingerID = sin.ID and s.BitRateID = br.ID";						
						
		if(trim($_REQUEST["Th_TenBaiHat"]) != "")
		{
			$sql .= $ten_bai_hat;
			$ten_bai_hat = 	$_REQUEST["Th_TenBaiHat"];
		}
		if($_REQUEST["Th_CaSi"] != "")
		{
			$sql .= $ca_si;
			$ca_si = $_REQUEST["Th_CaSi"];
		}
		if($_REQUEST["Th_NguoiDang"] != "")
		{
			$sql .= $nguoi_dang;
			$nguoi_dang = $_REQUEST["Th_NguoiDang"];
		}
		if($_REQUEST["Th_TheLoai"] != 0)
		{
			$sql .= $the_loai;
			$the_loai = $_REQUEST["Th_TheLoai"];
		}
		if($_REQUEST["Th_ChatLuong"] != 0)
		{
			$sql .= $chat_luong;		
			$chat_luong = $_REQUEST["Th_ChatLuong"];
		}
		
		//echo($sql);
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
				$duongDanTheLoai = "TrangChu.php?styleID=".$row["StyleID"];
				$duongDanNguoiDung = "TrangChu.php?userID=".$row["OwnerID"];
				$duongDanCaSi = "TrangChu.php?singerID=".$row["SingerID"];
								
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
	<input name="TimKiem" type="submit" value="Tìm Kiếm" />
</div>
</form>
<div style="height:30px">
</div>
<div id="TheHien" align="center" class="main-content">
	<?php echo($noi_dung); ?>
</div>
<div align="right" style="margin-right:30px">
	<?php
	$i = 1;
	while($i <= $tong_so_trang)
	{
		if(isset($_REQUEST["Trang"]) == true)
		{
			if($_REQUEST["Trang"] == $i)
				echo("[<a href='/Do an - Web nhac so/TimKiem.php?Trang=$i&TimKiem=true&Th_TenBaiHat=".$_REQUEST["Th_TenBaiHat"]."&Th_CaSi=". $_REQUEST["Th_CaSi"]."&Th_NguoiDang=".$_REQUEST["Th_NguoiDang"]."&Th_TheLoai=".$_REQUEST["Th_TheLoai"]."&Th_ChatLuong=".$_REQUEST["Th_ChatLuong"]."'>$i</a>]");	
			else
				echo(" <a href='/Do an - Web nhac so/TimKiem.php?Trang=$i&TimKiem=true&Th_TenBaiHat=".$_REQUEST["Th_TenBaiHat"]."&Th_CaSi=". $_REQUEST["Th_CaSi"]."&Th_NguoiDang=".$_REQUEST["Th_NguoiDang"]."&Th_TheLoai=".$_REQUEST["Th_TheLoai"]."&Th_ChatLuong=".$_REQUEST["Th_ChatLuong"]."'>$i</a> ");	
		}
		else
		{
			if($i == 1)
				echo("[<a href='/Do an - Web nhac so/TimKiem.php?Trang=$i&TimKiem=true&Th_TenBaiHat=".$_REQUEST["Th_TenBaiHat"]."&Th_CaSi=". $_REQUEST["Th_CaSi"]."&Th_NguoiDang=".$_REQUEST["Th_NguoiDang"]."&Th_TheLoai=".$_REQUEST["Th_TheLoai"]."&Th_ChatLuong=".$_REQUEST["Th_ChatLuong"]."'>$i</a>]");	
			else
				echo(" <a href='/Do an - Web nhac so/TimKiem.php?Trang=$i&TimKiem=true&Th_TenBaiHat=".$_REQUEST["Th_TenBaiHat"]."&Th_CaSi=". $_REQUEST["Th_CaSi"]."&Th_NguoiDang=".$_REQUEST["Th_NguoiDang"]."&Th_TheLoai=".$_REQUEST["Th_TheLoai"]."&Th_ChatLuong=".$_REQUEST["Th_ChatLuong"]."'>$i</a> ");	
		}
		$i++;
	}
	?>
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
              <script type="text/javascript" language="javascript">
              	function XuLyGoiDi()
				{
					var dia_chi = "../TimKiem.php?TimKiem=true";
					dia_chi += "&Th_TenBaiHat=";
					var v = $("#cmbTheo").attr("value");
					if(v == "0")
						dia_chi += $("#txtTuKhoa").attr("value");
					dia_chi += "&Th_CaSi=";
					if(v == "1")
						dia_chi += $("#txtTuKhoa").attr("value");
					dia_chi += "&Th_NguoiDang=";
					if(v == "2")
						dia_chi += $("#txtTuKhoa").attr("value");
					dia_chi += "&Th_TheLoai=0&Th_ChatLuong=0";/**/
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
