<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/TrangChu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<link rel="icon" href="images/icon.jpg" type="image/x-icon" />
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
<script type="text/javascript" src="script/vuongtoan.js"></script> 
<script type="text/javascript" src="js/ajaxupload.js"></script>
<script type="text/javascript" language="javascript">
		//$("document").ready(TaoDangNhap());
		var t;
		$("document").ready(function(){
								TaoDangNhap();		
								t = new AjaxUpload('#upload', {
													action: 'xulyThemBaiHatUser.php',
													name: 'Th_Source',
													autoSubmit: false,
													onChange: function(file, extension){														
														$("#a").attr("value",file);
												   // Sau khi file được lựa chọn
												   // Nếu có sự thay đổi lựa chọn file thì viết tiếp code
												   //ở đây. điều kiện autoSubmit = false.
												   // @param file basename: Tên file upload
												   // @param extension: Phần mở rộng của file upload
													},

													onComplete : function(file, response){
																						//alert(file);
																						alert(response);																						
																					}	
													});	
							});		
		function Them()
		{
			//alert("SDF");	//upload.setData({'example_key': 'value'});
			
			para = 'Source=' + $("#a").attr("value");;
			para += '&Th_SongName=' + $("#Th_SongName").attr("value");
			para += '&Th_Style=' + $("#Th_Style").attr("value");
			para += '&Th_Singer=' + $("#Th_Singer").attr("value");
			para += '&Th_Writter=' + $("#Th_Writter").attr("value");	
			para += '&Th_BitRate=' + $("#Th_BitRate").attr("value");
			para += '&Th_Rate=' + $("#Th_Rate").attr("value");
			//alert(para);
			$.ajax({url: 'xulyThemBaiHatUser.php',
				   data:""+para,
				   success:function(kq){
					   					vt1 = kq.search("<body>") + 6;
										vt2 = kq.search("</body>");
										kq = kq.substring(vt1, vt2);
										kq = kq.replace(/^s+|s+$/g,""); //giống trim() php
										kq1 = kq + (-1);
										if(isNaN(kq1) == false) // => là số
										{
						   					t.submit();
											$("#Th_SongName").attr("value","");
											$("#Th_Style").attr("value","Không biết");
											$("#Th_Singer").attr("value","Không biết");
											$("#Th_Writter").attr("value","Không biết");
											$("#Th_BitRate").attr("value","32");
											$("#Th_Rate").attr("value","0");
											$("#a").attr("value","");
				   						}				
										else
											alert(kq);
										}
				   });			
		}
</script>

</head>

<body>

  <div class="banner" id="idBanner" align="center">
  		<img src="images/digital music-banner.jpg" height="150" width="990">
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
                          <a href="ThemBaiHatUser.php" title="Đăng/upload Bài Hát">Đăng/upload Bài Hát</a>
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
                                            
                                                       
<div style="width:600px" align="center">
<form id="form1" method="post" action="xulyThemUser.php?DangKi=1">
  <h1>&nbsp;</h1>
  <h1><strong><font color="#0000FF">Đăng kí thành viên</font></strong></h1>
  <p>&nbsp;</p>
  <table width="482" border="0">
    <tr>
      <td width="133"><p>Tên đăng nhập:</p></td>			            
      <td width="339"><p><input type="text" name="txttendangnhap" id="txttendangnhap" style="width:250px"  onkeyup="KtUser('txttendangnhap','ktuser');" /></p>
      </td>
      <p>&nbsp;</p>
    </tr>
    <tr>
      <td colspan="2"><span id="ktuser" ><p>&nbsp;</p></span ></td>
    </tr>
    <tr>
      <td><p>Mật khẩu:</p></td>				            
      <td><p><input type="password" name="txtmatkhau" id="txtmatkhau" style="width:250px"  /></p></td>                        
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><p>Nhập lại mật khẩu:</p></td>
      <td><p><input type="password" name="txtlaplaimatkhau"  id="txtlaplaimatkhau" style="width:250px" /></p></td                      
    ></tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><p>Email:</p></td>      
      <td><p><input type="text" name="txtemail" id="txtemail" style="width:250px"  onblur="KtEmail();" /></p></td>    </tr>
    <tr>
      <td colspan="2"><span id="ktemail" ><p>&nbsp;</p></span ></td>
    </tr>
    <tr>
      <td><p>Nhập lại Email:</p></td>        
      <td><p><input type="text" name="txtlaplaiemail" id="txtlaplaiemail" style="width:250px"/> </p></td>                       
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td><p>Họ và tên:</p></td>        
      <td><p><input type="text" name="txthovaten" id="txthovaten" style="width:250px" /></p></td>                        
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="7"><p>Ngày sinh:</p></td>        
      <td rowspan="2">
      <div>
        <table width="260" border="0">
          <tr>
            <td width="74"><select name="cmbngay" id="cmbngay">
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
      </div>
      </td>
    </tr>
    <tr>
      <td height="7">&nbsp;</td>
    </tr>
    <tr>
      <td height="2"><p>Đến từ:</p>  </td>
      
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
        </td>
    </tr>
    <tr>
      <td height="3">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td  colspan="2" align="center">
        <p><img src="captcha/captcha.php" id="imgmaxacnhan" title="Click để tạo mã xác nhận mới"/></p>
        <p><br/>
      </p></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><p>
        <input type="text" name="txtmaxacnhan" id="txtmaxacnhan" style=" width:60px"  onblur="KtMaXacNhan();"/>
      </p>
      <p>&nbsp; </p></td>
    </tr>
    <tr>
      <td height="10" colspan="2" align="center"><span id="ktmaxacnhan" ><p>&nbsp;</p></span ></td>
    </tr>
    <tr>
      <td height="46" colspan="2"><div align="center" style="width:100%">
        <input type="submit" name="btndangki" id="button" value="Đăng kí" onclick="return CheckInput();"  />
        <input type="reset" name="btnlamlai" id="button2" value="Làm lại"  onclick="CheckInput();"/>
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
                    <div id="idAdv1" class="adv">
						<!-- InstanceBeginEditable name="Quảng Cáo 1" -->
                        	<object data="images/adv.swf" width="100%" height="100%"></object>
						<!-- InstanceEndEditable -->	
                    </div>
                  	<div id="idAdv2" class="adv">
						<!-- InstanceBeginEditable name="Quảng Cáo 2" -->
                        	<object data="images/adv.swf" width="100%" height="100%"></object>
						<!-- InstanceEndEditable -->
                    </div> 
                  	<div id="idAdv3" class="adv">
						<!-- InstanceBeginEditable name="Quảng Cáo 3" -->
                        	<object data="images/adv.swf" width="100%" height="100%"></object>
						<!-- InstanceEndEditable -->
                    </div> 
               	  	<div id="idAdv4" class="adv">
						<!-- InstanceBeginEditable name="Quảng Cáo 4" -->
                        	<object data="images/adv.swf" width="100%" height="100%"></object>
						<!-- InstanceEndEditable -->
                    </div>  
                </div>
            </div>
        </div>
        <div class="footer" align="center">
        	<div>
            	Bản quyền thuộc về Camellia Team
            </div>
        </div>
   </div>
</body>
<!-- InstanceEnd --></html>
