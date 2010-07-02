<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
                            <div class="cp-title">
								Quản lý thành viên
                                <div class="add-cp" onclick="MoRongDieuKhien(this,'cpUser')"></div>
                            </div>
                            <div id="cpUser" class="main-content">
                           		
                                    <form action="xulyTimKiem.php" method="post" id="frmTimUser" onsubmit="TimKiem(this);return false">
                                        <label for="txtKeyWord">Tìm User:</label>
                                        <input type="text" alt="Nhập tên đăng nhập hoặc tên người dùng" name="txtKeyWord">
                                        <input type="submit" value="Tìm" name="btnTimKiem">
                                	</form>
                                    <br>
                                    <div align="left"> Danh Sách Thành Viên</div>
                                    <div id="idUserList" class="user-list">
                                        <div class="user-list">
                                        	<div class="main-content">
                                            	<div style="float:left;width:40%" align="left">
                                                    <p>Tên đăng nhập :</p>
                                                    <p>Họ Tên :</p>
                                                    <p>Banned :</p><br>
                                                    <p>Delete :</p>
                                                    <label onclick="HienRa('idUserInfo')" for="btnCapNhat"><input type="button" value="Cập nhật thông tin user"></label>
                                            	</div>
                                                <div style="float:right;width:60%" align="left">
                                                     <p>TakiNT</p>
                                                     <p>Lê Ngọc Tín</p>
                                                     <p>
                                                        <select>
                                                            <option>Chưa banned</option>
                                                        </select>
                                                     </p><br>
                                                     <p><input type="checkbox"></p>
                                                </div>    
                                            </div>                                 
                                            <div class="user-list" id="idUserInfo" style="display:none">
                                                <div style="text-align:left;margin-bottom:10px"><b><h3><font color="#0000FF" >Thông tin tài khoản:</font></h3></b></div>
                                                <div class="left_div">Tên đăng nhập:</div>
                                                <div class="right_div"><label>TakiNT</label></div>
                                                <div class="left_div">Ngày tham gia:</div>
                                                <div class="right_div"><label>02-07-2010</label></div>
                                                <div class="left_div">Họ Tên:</div>
                                               <div class="right_div">
                                               <input name="txthovaten" id="txthovaten" type="text" value="Lê Ngọc Tín" />
                                               </div>
                                               <div class="left_div">Ngày Sinh:</div>
                                               <div class="right_div">
                                               <select name="cmbngay" id="cmbngay">
                                                  <option value="15">15</option>      
                                                    <?php 
                                                    for($i=1;$i<=31;$i++)
                                                    {echo("<option value='$i'>$i</option>");}											         ?>                                               
                                                </select>
                                                
                                                <select name="cmbthang" id="cmbthang">
                                                    <option value="1">1</option>	                     
                                                    <?php 
                                                        for($i=1;$i<=12;$i++)
                                                        {echo("<option value='$i'>$i</option>");}                            
                                                    ?>
                                                </select >
                                                        
                                                <input name="txtnam" type="text" id="txtnam" value="1989" onfocus="cleartextfield()" style="width:65px"/>
                                               </div>
                                               <div class="left_div">Đến Từ:</div>
                                               <div class="right_div">
                                               <select name="cmblocation" id="cmbdentu" >
                                              <option value="60">Vĩnh Long</option>
                                              <?php
                                              $i=1;
                                              include_once("DataProvider.php");
                                              $location = DataProvider::ExecuteQuery("SELECT location.Local FROM location");
                                              if(location !=false)
                                              {
                                                 while($row=mysql_fetch_array($location))
                                                 {									
                                              ?>
                                                     <option value=<?php echo($i)?>> <?php echo $row["Local"] ?></option>
                                             <?php	
                                                     $i++;
                                                 }
                                              }					
                                              ?>
                                            </select>  
                                               </div>
                                               
                                               <div class="left_div">Email:</div>
                                               <div class="right_div">
                                               <input name="txtemail" type="text" id="txtEmail" value="taki_lnt@yahoo.com" />
                                               </div>	
                                           	   <div style="text-align:left;margin-bottom:10px"><b><h3><font color="#0000FF">Thay đổi tên đăng nhập và mật khẩu:</font></h3></b></div>
                                               <div class="left_div">Tên đăng nhập mới:</div>
                                               <div class="right_div"><input type="text" value="TakiNT" id="txtTenDangNhapMoi" style="width:200px" /></div>
                                               <div class="left_div">Mật khẩu mới:</div>
                                               <div class="right_div"><input type="password" id="txtMatKhauMoi"style="width:200px" /></div>                                                
                                               <div style="width:20%;height:40px;float:left;margin-top:10px"><input type="button" id="btnthaydoimatkhau" value="Cập nhất thông tin" style="height:40px" onclick="ThayDoiMatKhau();" /> 
                                             </div>
                                           </div>
                                    	</div>
                                        <div class="main-content">
                                            	<div style="float:left;width:40%" align="left">
                                                    <p>Tên đăng nhập :</p>
                                                    <p>Họ Tên :</p>
                                                    <p>Banned :</p><br>
                                                    <p>Delete :</p>
                                                    <label for="btnCapNhat"><input type="button" value="Cập nhật thông tin user"></label>
                                            	</div>
                                                <div style="float:right;width:60%" align="left">
                                                     <p>TakiNT</p>
                                                     <p>Lê Ngọc Tín</p>
                                                     <p>
                                                        <select>
                                                            <option>Chưa banned</option>
                                                        </select>
                                                     </p><br>
                                                     <p><input type="checkbox"></p>
                                                </div>    
                                          </div> 
                                    </div>
                     
                            </div>
							<script language="javascript" type="text/javascript">TaoHieuUng();</script>
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
        <div class="footer">
        	<div>
            	Footer
            </div>
        </div>
   </div>
</body>
<!-- InstanceEnd --></html>
