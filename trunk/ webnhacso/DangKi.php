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
						//Kiểm tra tên đăng nhập
						var tendangnhap=$("#txttendangnhap");
						var input = tendangnhap.attr("value");
						if(remove_space(input)=="")
						{
							alert("Xin vui lòng điền tên đăng nhập!");
							tendangnhap.focus();
							return false;
						}						
						//Kiểm tra password
						var matkhau=$("#txtmatkhau");
						var input = matkhau.attr("value");
						if(remove_space(input)=="")
						{
							alert("Xin vui lòng điền mật khẩu!");
							matkhau.focus();
							return false;
						}						
						//kiểm tra lặp lại password	
						var laplaimatkhau=$("#txtlaplaimatkhau");
						var input = laplaimatkhau.attr("value");
						if(remove_space(input)=="")
						{
							alert("Xin vui lòng lặp lại mật khẩu!");
							laplaimatkhau.focus();
							return false;
						}
						//Kiểm tra sự trùng khớp của 2 password
						if(matkhau.attr("value")!=laplaimatkhau.attr("value"))
						{
							alert("Mật khẩu không trùng khớp!Vui lòng nhập lại");
							matkhau.attr("value","");
							laplaimatkhau.attr("value","");
							matkhau.focus();
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
						//Kiểm tra lặp lại email
						var laplaiemail=$("#txtlaplaiemail");
						var input = laplaiemail.attr("value");
						if(remove_space(input)=="")
						{
							alert("Xin vui lòng nhập lại email!");
							laplaiemail.focus();
							return false;
						}
						//Kiểm tra sự trùng khớp của 2 email
						if(email.attr("value")!=laplaiemail.attr("value"))
						{
							alert("Email không trùng khớp!Vui lòng nhập lại");
							email.attr("value","");
							laplaiemail.attr("value","");
							email.focus();
							return false;
						}						
						//Kiểm tra họ và tên
						var hovaten=$("#txthovaten");
						var input = hovaten.attr("value");
						if(remove_space(input)=="")
						{
							alert("Xin vui lòng nhập họ tên dầy đủ của bạn!");
							hovaten.focus();
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
						//Kiểm tra nơi ở
						var local=$("#cmblocal");
						var input=local.attr("value");							
						if(input==0)						
						{
							alert("Vui lòng nhập nơi ở của bạn!");
							local.focus();
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
				  <div style="width:600px" align="center">
				    <form id="form1" name="frmdangki"  method="post" action="xulyThemUser.php?DangKi=1">
				      <h1>&nbsp;</h1>
				      <h1><strong><font color="#0000FF">Đăng kí thành viên</font></strong></h1>
				      <p>&nbsp;</p>
				      <table width="400" border="0">
				        <tr>
				          <td width="136"><p>Tên đăng nhập:</p>
				            <p>&nbsp;</p></td>
				          <td width="259"><p>
				            <input type="text" name="txttendangnhap" id="txttendangnhap" style="width:250px"  />
				            </p>
				            <p>&nbsp; </p></td>
			            </tr>
				        <tr>
				          <td><p>Mật khẩu:</p>
				            <p>&nbsp;</p></td>
				          <td><p>
				            <input type="password" name="txtmatkhau" id="txtmatkhau" style="width:250px"  />
				            </p>
				            <p>&nbsp; </p></td>
			            </tr>
				        <tr>
				          <td><p>Nhập lại mật khẩu:</p>
				            <p>&nbsp;</p></td>
				          <td><p>
				            <input type="password" name="txtlaplaimatkhau"  id="txtlaplaimatkhau" style="width:250px" />
				            </p>
				            <p>&nbsp; </p></td>
			            </tr>
				        <tr>
				          <td><p>Email:</p>
				            <p>&nbsp;</p></td>
				          <td><p>
				            <input type="text" name="txtemail" id="txtemail" style="width:250px" />
				            </p>
				            <p>&nbsp; </p></td>
			            </tr>
				        <tr>
				          <td><p>Nhập lại Email:</p>
				            <p>&nbsp;</p></td>
				          <td><p>
				            <input type="text" name="txtlaplaiemail" id="txtlaplaiemail" style="width:250px"/>
				            </p>
				            <p>&nbsp; </p></td>
			            </tr>
				        <tr>
				          <td><p>Họ và tên:</p>
				            <p>&nbsp;</p></td>
				          <td><p>
				            <input type="text" name="txthovaten" id="txthovaten" style="width:250px" />
				            </p>
				            <p>&nbsp; </p></td>
			            </tr>
				        <tr>
				          <td height="16"><p>Ngày sinh:</p>
				            <p>&nbsp;</p></td>
				          <td><div>
				            <table width="260" border="0">
				              <tr>
				                <td width="74"><select name="cmbngay" id="cmbngaysinh">
				                  <option value="0">[Ngày]</option>
				                  <option>
				                    <?php 
									for($i=1;$i<=31;$i++)
									{ 												                      
				                  		echo("<option value='$i'>$i</option>");
				                  
                    				}
                  					?>
				                  </select></td>
				                <td width="82"><select name="cmbthang" id="cmbthang">
				                  <option value="0">[Tháng]</option>
				                  <option>
				                    <?php 
					  					for($i=1;$i<=12;$i++)
					  					{
                  							echo("<option value='$i'>$i</option>");
                  	  					}
                  					?>
				                  </select ></td>
				                <td width="83">&nbsp;&nbsp;
				                  <input name="txtnam" type="text" id="txtnam" style="width:60px" value="[Năm]" onfocus="cleartextfield()" /></td>
			                  </tr>
			                </table>
				            <p>&nbsp;</p>
				            </div></td>
			            </tr>
				        <tr>
				          <td height="7"><p>Đến từ:</p>
				            <p>&nbsp;</p></td>
				          <td><p>
				            <select name="cmblocation" id="cmblocal">
				              <option value="0">[ Tỉnh-Thành Phố ]</option>
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
				            </p>
				            <p>&nbsp; </p></td>
			            </tr>
				        <tr>
				          <td height="46" colspan="2" align="center">
                       	    <p id=><img src="captcha/captcha.php" id="imgmaxacnhan" title="Click để tạo mã xác nhận mới"/></p>
                       	    <p>
                       	      <input type="text" name="txtmaxacnhan" id="txtmaxacnhan" style=" width:60px" />                       	  
                       	      <br/>
               	          </p></td>
			            </tr>
				        <tr>
				          <td height="46" colspan="2"><div align="center" style="width:400px">
				            <input type="submit" name="btndangki" id="button" value="Đăng kí" onclick="return CheckInput()"  />
				            <input type="reset" name="btnlamlai" id="button2" value="Làm lại" />
			              </div></td>
			            </tr>
			          </table>
				      <label>
				        </p>
				        <br />
				        <br />
			          </label>
			        </form>
			      </div>
    
                  
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
