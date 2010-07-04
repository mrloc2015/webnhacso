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
<script language="javascript" type="text/javascript" src="script/vuongtoan.js"></script> 
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
                            <div class="cp-title">
								Quản lý bài hát
                                <div class="remove-cp" onclick="MoRongDieuKhien(this,'cpUser')"></div>
                            </div>
                            <div id="cpUser" class="main-content">
<?php
	include_once("DataProvider.php");
	
	$ten_bai_hat = "";
	$the_loai = "";
	$ca_si = "";
	$tac_gia = "";
	$ngay_up = "";
	$chat_luong = "";	
	
	$sql = "Select *";
	$sql .= " From waiting_song ws, song_style ss, user u, singer s, bit_rate br";
	$sql .= " Where ws.StyleID = ss.ID and ws.OwnerID = u.ID and ws.SingerID = s.ID and ws.BitRateID = br.ID";
	
	$temp = DataProvider::ExecuteQuery($sql);
	if($temp != false)
	{
		while($row = mysql_fetch_array($temp))
		{
			$ten_bai_hat = $row["SongName"];
			$the_loai = $row["StyleName"];
			$ca_si = $row["SingerName"];
			$tac_gia = $row["Writter"];
			$ngay_up = $row["DateUp"];
			$chat_luong = $row["BitRate"];
			
			
		}
	}
?>
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
                    <!-- InstanceBeginEditable name="Quảng Cáo" -->RightContent<!-- InstanceEndEditable -->
                    <div class="adv">
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
