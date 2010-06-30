<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
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
<script language="javascript" type="text/javascript">
	function cleartextfield()
	{
		var nam =$("#txtnam").attr("value","")	;																	
	}
	function remove_space( str)
	{												
		var tem="";
		var arrchar = str.split(" ");
		for(i=0; i < str.length; i ++)
		{
			tem = tem + arrchar[i];
		}
		return tem;
	}
	
	//Tạo mới mã xác nhận
	$(document).ready(function()
	{
		$('#imgmaxacnhan').click(function()
		{
			var maxacnhan = $('#imgmaxacnhan');
			var maxacnhan_new_src = maxacnhan.attr('src') + '?' + Math.floor(Math.random()*11);
			maxacnhan.attr('src', maxacnhan_new_src );
			return false;
		}	);
	}	);
	function CheckInput()
	{		
		//Kiểm tra họ và tên
		var hovaten=$("#txthovaten");
		var input = hovaten.attr("value");
		if(remove_space(input)=="")
		{
			alert("Xin vui lòng nhập họ tên dầy đủ của bạn!");
			hovaten.focus();
			return false;
		}								
		//Kiểm tra email
		var email=$("#txtemail");
		var input = email.attr("value");
		var OnEmail = /^([a-zA-Z0-9_\.\-])+@(([\yahoo\gmail\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(remove_space(input)!="")
		{
			if(OnEmail.test(input) == false)
			{
				alert("Địa chỉ Email không hợp lệ. Chỉ cho phép Yahoo mail hoặc Google mail.");
				email.focus();
				return false;
			}
		}
		else
		{
			alert("Vui lòng nhập địa chỉ email!");
			email.focus();
			return false;
		}																		
		//Kiểm tra ngay sinh
		var ngaysinh=$("#cmbngaysinh");
		var input=ngaysinh.attr("value");
		if(input==0)
		{
			alert("Vui lòng nhập ngày sinh!");
			ngaysinh.focus();
			return false;
		}						
		var thangsinh=$("#cmbthang")
		var input =thangsinh.attr("value");
		if(input==0)
		{
			alert("Vui lòng nhập đầy đủ ngày sinh!");
			thangsinh.focus();
			return false;
		}
		
		var OnYear = /^([0-9]+)$/;
		var date = new Date();
		var year = date.getFullYear();
		var namsinh=$("#txtnam");
		var input = namsinh.attr("value");
		if(input=="[Năm]" || remove_space(input)=="")
		{
			alert("Vui lòng nhập năm sinh!");
			cleartextfield();
			namsinh.focus();
			return false;
		}
		if(OnYear.test(input) == false||year-input >100 || year-input < 6)
		{
			alert("Năm sinh không hợp lệ!")							
			cleartextfield();
			namsinh.focus();
			return false;
		}			
		//Kiểm tra mã xác nhận
		var maxacnhan=$("#txtmaxacnhan");
		var input = maxacnhan.attr("value");
		if(remove_space(input)=="")
		{
			alert("Xin vui lòng nhập mã xác nhận!");
			maxacnhan.focus();
			return false;
		}												
	}
	</script>
<?php
	$username=$_SESSION["UserName"];
	include_once("DataProvider.php");
	$result = DataProvider::ExecuteQuery("select user_info.FullName as FullName,user_info.Birthday as Birthday,user_info.Joinday as JoinDay ,user_info.LocationID as LocationID,location.local as Local,user_info.Email,user_info.ID as ID from user,user_info,location where user.ID=user_info.UserID and user.UserName= '$username' and location.ID=user_info.LocationID");
	if($result !=false)
	{
		$row=mysql_fetch_array($result);
		$tendaydu=$row["FullName"];
		
		$ngaysinh=($row["Birthday"]);																		
		$ngay=substr($ngaysinh,8,2);
		$thang=substr($ngaysinh,5,2);
		$nam=substr($ngaysinh,0,4);									
		
		$ngaythamgia=$row["JoinDay"];
		$ng=substr($ngaythamgia,8,2);
		$th=substr($ngaythamgia,5,2);
		$n=substr($ngaythamgia,0,4);
		$joinday=$ng."-".$th."-".$n;
				
		$email=$row["Email"];
		$dentu=$row["Local"];
		$localID=$row["LocationID"];
		$userID=$row["ID"];
	}
 ?>
 <form id="form1" name="form1" method="post" action="XulyCapNhatThongTin.php?CapNhat=1" >
 <div style="height:50px"><h1><strong><font color="#0000FF">Thông tin cá nhân</font></strong></h1></div>
<div class="worms_field">
<div class="worms_left"><label>Họ tên:</label></div>       
<input name="txthovaten" id="txthovaten" type="text" style="width:300px" value="<?php echo $tendaydu?>" />
</div>

<div class="worms_field">
<div class="worms_left"><label>Ngày sinh:</label></div>       
<select name="cmbngay" id="cmbngaysinh">
      <option value="<?php echo $ngay?>"><?php echo $ngay?></option>
      <option>
        <?php 
        for($i=1;$i<=31;$i++)
        { 												                      
            echo("<option value='$i'>$i</option>");
      
        }
        ?>
 </select>
 
 <select name="cmbthang" id="cmbthang">
      <option value="<?php echo $thang?>"><?php echo $thang?></option>				                  				  <option>              
        <?php 
            for($i=1;$i<=12;$i++)
            {
                echo("<option value='$i'>$i</option>");
            }
        ?>
      </select >
      
<input name="txtnam" type="text" id="txtnam" style="width:60px" value="<?php echo $nam?>" onfocus="cleartextfield()" />
</div>

<div class="worms_field">
<div class="worms_left">Ngày tham gia:</div>       
<?php echo $joinday?>
</div>                                                        

<div class="worms_field">
<div class="worms_left"><label>Đến từ::</label></div>       
<select name="cmblocation" id="cmblocal">
  <option value="<?php echo $localID?>"><?php echo $dentu?></option>
  <?php
  $i=1;
  include_once("DataProvider.php");
  $location = DataProvider::ExecuteQuery("SELECT location.Local FROM location");
  if(location !=false)
  {
     while($row=mysql_fetch_array($location))
     {									
  ?>
         <option value="<?php echo($i)?>"> <?php echo $row["Local"] ?></option>
 <?php	
         $i++;
     }
  }					
  ?>
</select>                            
</div>

<div class="worms_field">
<div class="worms_left"><label>Email:</label></div>       
<p>
  <input name="txtemail" type="text" id="txtemail" style="width:300px" value="<?php echo $email?>" />
</p>                            
</div>
<div>
<p id=><img src="captcha/captcha.php" id="imgmaxacnhan" title="Click để tạo mã xác nhận mới"/></p>
<p>
  <input type="text" name="txtmaxacnhan" id="txtmaxacnhan" style=" width:60px" />                       	  
  <br/>
</p>
</div>
<div align="left">
<input name="btncapnhat" type="submit" id="btncapnhat" value="Cập Nhật" onclick="return CheckInput()" />                            
</div>
<div style="text-align:left;text-decoration:underline;">
<a href="">Thay đổi mật khẩu</a>
</div>

                             
</form>
                            
                            <!-- InstanceEndEditable --></div>
                  </div> 
            <div class="right-col">
            	<div id="idLoginBox">
                	
              	</div>
              <div align="center" style="background:url(images/title-search-box-bg.jpg);height:33px;width:264px;">
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
