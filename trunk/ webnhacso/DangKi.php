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
                        $sql = "select si.SingerName,si.ID from singer si, song so where so.SingerID = si.ID group by si.ID, si.SingerName having sum(so.ListenCount) >=0 limit 10";
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
									?>
			                      </option>
				                  <option ><?php echo $i?></option>
				                  <?php 
                    				}
                  					?>
				                  </select></td>
				                <td width="82"><select name="cmbthang" id="cmbthang">
				                  <option value="0">[Tháng]</option>
				                  <option>
				                    <?php 
					  for($i=1;$i<=12;$i++)
					  {
                  ?>
			                      </option>
				                  <option> <?php echo $i;?></option>
				                  <?php
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
				  	include_once("DataProvider.php");
				  	$location = DataProvider::ExecuteQuery("SELECT location.Local FROM location");
					if(location !=false)
					{
						while($row=mysql_fetch_array($location))
						{
					?>
				              <option> <?php echo $row["Local"] ?></option>
				              <?php		
						}
					}					
				 ?>
			                </select>
				            </p>
				            <p>&nbsp; </p></td>
			            </tr>
				        <tr>
				          <td height="46" colspan="2" align="center">
                          	<img src="Tai lieu/captcha/captcha.php" /><br/>
                            <input type="text" name="txtmaxacnhan" id="txtmaxacnhan" style=" width:60px" />
                          </td>
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
