<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/TrangChu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fantasy Music</title>
<link href="css/giaodien.css" rel="stylesheet" type="text/css"> 
</head>

<body>
	<div class="banner" id="idBanner" align="center">
    	<img src="images/header-02.jpg" width="1000">
    </div>
  	<div class="main" id="idmain">
        <table width="100%" border="0" cellspacing="0">
          <tr>
            <td width="18%" class="left-col" valign="top">
                 <div class="left-header" id="idLeftMenu" align="center">
                    Menu
                 </div>
                  <table height="90" width="180" border="0" cellspacing="0">
                  <tr>
                    <td>Trang Chủ</td>
                  </tr>
                  <tr>
                    <td>Đăng/Upload bài hát mới</td>
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
            <td width="67%" valign="top" class="mid-col">
                <div id="idMainContent" class="main-content" align="center">
                    <!-- InstanceBeginEditable name="mainConten" -->                
                  
        	<div style="width:600px" align="center">
            <form id="form1" name="frmdangki"  method="post" action="xulyThemUser.php?issubmit=true">
        	  <table width="600" border="0">
        	    <tr>
        	      <td width="125">Tên đăng nhập:</td>
        	      <td width="459"><input type="text" name="txttendangnhap"  /></td>
      	      </tr>
        	    <tr>
        	      <td>Mật khẩu:</td>
        	      <td><input type="password" name="txtmatkhau"  /></td>
      	      </tr>
        	    <tr>
        	      <td>Nhập lại mật khẩu:</td>
        	      <td><input type="password" name="txtlaplaimatkhau"  /></td>
      	      </tr>
        	    <tr>
        	      <td>Email:</td>
        	      <td><input type="text" name="txtemail"  /></td>
      	      </tr>
        	    <tr>
        	      <td>Nhập lại Email:</td>
        	      <td><input type="text" name="txtlaplaiemail"  /></td>
      	      </tr>
        	    <tr>
        	      <td>Họ và tên:</td>
        	      <td><input type="text" name="txthovaten"  /></td>
      	      </tr>
        	    <tr>
        	      <td height="16">Ngày sinh:</td>
        	      <td><div>
        	        <table width="214" border="0">
        	          <tr>
        	            <td width="48"><select name="cmbngay">
        	              <?php 
						for($i=1;$i<=31;$i++)
						{ 
                  ?>
        	              <option> <?php echo $i?> </option>
        	              <?php 
                    	}
                  ?>
      	              </select></td>
        	            <td width="48"><select name="cmbthang">
        	              <?php 
					  for($i=1;$i<=12;$i++)
					  {
                  ?>
        	              <option> <?php echo $i;?> </option>
        	              <?php
                  	  }
                  ?>
      	              </select ></td>
        	            <td width="104">&nbsp;&nbsp;
                          <input name="txtnam" type="text" value="" style="width:60px" /></td>
      	            </tr>
      	          </table>
        	      </div></td>
      	      </tr>
        	    <tr>
        	      <td height="18">Đến từ:</td>
        	      <td>
                  <select name="cmblocation">
                  <?php
				  	include_once("DataProvider.php");
				  	$location = DataProvider::ExecuteQuery("SELECT location.Local FROM location");
					if(location !=false)
					{
						while($row=mysql_fetch_array($location))
						{
					?>
                    <option> <?php echo $row["Local"] ?> </option>
                    
                    <?php		
						}
					}					
				 ?>                                                                        
                  </select>
                  </td>
      	      </tr>
      	      </table>        	 
           	  <label>
</p>
      <br />   	            
                <div align="left" style="width:300px">
                <input type="submit" name="btndangki" id="button" value="Đăng kí" />
                <input type="reset" name="btnlamlai" id="button2" value="Làm lại" />
                </div>   	            
                <br />
           	  </label>
 
        	</form>
            </div>
        	
        	<!-- InstanceEndEditable -->
                </div>
            </td>
            <td width="20%" valign="top" class="right-col">
                <table width="100%" border="0" cellspacing="10" cellpadding="10px">
                  <tr>
                    <td>
						<div align="center" style="background-color:#0CF">
                        	ĐĂNG NHẬP
                        </div>
                        <form id="frmDangNhap" name="DangNhap" method="post" action="xulyDangNhap.php">
                        	<table width="100%" height="200px" border="0" cellspacing="0" bgcolor="#CCCCCC">
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
                    	<div align="center" style="background-color:#0CF">
                        	TÌM KIẾM
                        </div>
                        <form id="frmTimKiem" name="TimKiem" method="post" action="xulyTimKiem.php">
                        	<table width="100%" height="120px" border="0" cellspacing="0" bgcolor="#CCCCCC">
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
