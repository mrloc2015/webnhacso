<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
					   					//vt1 = kq.search("<body>") + 6;
										//vt2 = kq.search("</body>");
										//kq = kq.substring(vt1, vt2);
										//kq = kq.replace(/^s+|s+$/g,""); //giống trim() php
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
                            <div class="cp-title">
								Quản lý đăng bài hát
                                <div class="remove-cp" onclick="MoRongDieuKhien(this,'cpUser')"></div>
                            </div>
                            
                            <div id="cpUser" class="main-content">
<form>
<?php
	include_once("DataProvider.php");
	
	$i = 0;
	$k = 0;
	$l = 30;
		
	$sql = "Select *";
	$sql .= " From waiting_song ws, song_style ss, user u, singer s, bit_rate br";
	$sql .= " Where ws.StyleID = ss.ID and ws.OwnerID = u.ID and ws.SingerID = s.ID and ws.BitRateID = br.ID";
	
	$temp = DataProvider::ExecuteQuery($sql);
	if($temp != false)
	{				
		$song_id = array("","","");
		$ten_bai_hat = array("","","");
		$dinh_dang = array("","","");
		$the_loai = array("","","");
		$ca_si = array("","","");
		$tac_gia = array("","","");
		$ngay_dang = array("","","");
		$chat_luong = array("","","");
		
		$mang_dinh_dang = array("wma", "wmv", "mp3", "flv", "mpeg", "mpg", "avi");
					
		while($row = mysql_fetch_array($temp))
		{					
			$song_id[$i] = $row["SongID"];
			$ten_bai_hat[$i] = $row["SongName"];

			$temp1 = explode(".",$row["Source"]);
			$flag = 1; //khác
			for($j=0;$j<7;$j++)
			{
				$temp1[1] = strtolower($temp1[count($temp1)-1]);
				if(strcmp($mang_dinh_dang[$j], $temp1[1]) == 0)
					$flag = 0; //có hỗ trợ
			}
			if($flag == 1)
				$dinh_dang[$i] = "<font size='+1' color='#F00'><strong>$temp1[1]</strong></font>";
			else
				$dinh_dang[$i] = $temp1[1];
				
			$the_loai[$i] = $row["StyleName"];
			$ca_si[$i] = $row["SingerName"];
			$tac_gia[$i] = $row["Writter"];
			$ngay_dang[$i] = $row["DateUp"];
			$chat_luong[$i] = $row["BitRate"];			
			
			if($i%2 == 0 && $i != 0)
			{
			?>
            <hr width="400px" />
			<div align="left" style="margin-left:10px; margin-top:20px">        
                <div class="worms_trai"><strong>Tên bài hát</strong></div>
                <div class="worms_giua"><input style="width:120px" type="text" value="<?php echo($ten_bai_hat[0]); ?>" /></div>
                <div class="worms_giua"><input style="width:120px" type="text" value="<?php echo($ten_bai_hat[1]); ?>" /></div>
                <div class="worms_phai"><input style="width:120px" type="text" value="<?php echo($ten_bai_hat[2]); ?>" /></div>
                
                <div class="worms_trai"><strong>Định dạng</strong></div>
                <div class="worms_giua"><?php echo($dinh_dang[0]); ?></div>
                <div class="worms_giua"><?php echo($dinh_dang[1]); ?></div>
                <div class="worms_phai"><?php echo($dinh_dang[2]); ?></div>  
                
                <div class="worms_trai"><strong>Thể lọai</strong></div>
                <div class="worms_giua">					
					<?php echo($the_loai[0]); ?>
                </div>
                <div class="worms_giua"><?php echo($the_loai[1]); ?></div>
                <div class="worms_phai"><?php echo($the_loai[2]); ?></div>  
                 
                <div class="worms_trai"><strong>Ca sĩ</strong></div>
                <div class="worms_giua"><?php echo($ca_si[0]); ?></div>
                <div class="worms_giua"><?php echo($ca_si[1]); ?></div>
                <div class="worms_phai"><?php echo($ca_si[2]); ?></div>
                
                <div class="worms_trai"><strong>Tác giả</strong></div>                        
                <div class="worms_giua"><?php echo($tac_gia[0]); ?></div>
                <div class="worms_giua"><?php echo($tac_gia[1]); ?></div>
                <div class="worms_phai"><?php echo($tac_gia[2]); ?></div>
                
                <div class="worms_trai"><strong>Ngày đăng</strong></div>            
                <div class="worms_giua"><?php echo($ngay_dang[0]); ?></div>
                <div class="worms_giua"><?php echo($ngay_dang[1]); ?></div>
                <div class="worms_phai"><?php echo($ngay_dang[2]); ?></div>
                
                <div class="worms_trai"><strong>Chất lượng</strong></div>            
                <div class="worms_giua"><?php echo($chat_luong[0]); ?></div>
                <div class="worms_giua"><?php echo($chat_luong[1]); ?></div>
                <div class="worms_phai"><?php echo($chat_luong[2]); ?></div>
                
                <div class="worms_trai"><strong>Cho phép<br />đăng</strong></div> 
                <div class="worms_giua" align="center" style="margin-top:10px"><input id="<?php echo($k); $k++; ?>" name="<?php echo($song_id[0]); ?>" value="<?php echo($song_id[0]); ?>" type="radio" /></div>
                <div class="worms_giua" align="center" style="margin-top:10px"><input id="<?php echo($k); $k++; ?>" name="<?php echo($song_id[1]); ?>" value="<?php echo($song_id[1]); ?>" type="radio" /></div>
                <div class="worms_phai" align="center" style="margin-top:10px"><input id="<?php echo($k); $k++; ?>" name="<?php echo($song_id[2]); ?>" value="<?php echo($song_id[2]); ?>" type="radio" /></div>
                
                <div class="worms_trai" style="margin-top:5px"><strong>Không cho<br />phép đăng</strong></div> 
                <div class="worms_giua" align="center" style="margin-top:15px"><input id="<?php echo($l); $l++; ?>" name="<?php echo($song_id[0]); ?>" value="<?php echo($song_id[0]); ?>" type="radio" /></div>
                <div class="worms_giua" align="center" style="margin-top:15px"><input id="<?php echo($l); $l++; ?>" name="<?php echo($song_id[1]); ?>" value="<?php echo($song_id[1]); ?>" type="radio" /></div>
                <div class="worms_phai" align="center" style="margin-top:15px"><input id="<?php echo($l); $l++; ?>" name="<?php echo($song_id[2]); ?>" value="<?php echo($song_id[2]); ?>" type="radio" /></div>
            </div>
            <?php
				$song_id = array("","","");
				$ten_bai_hat = array("","","");
				$dinh_dang = array("","","");
				$the_loai = array("","","");
				$ca_si = array("","","");
				$tac_gia = array("","","");
				$ngay_dang = array("","","");
				$chat_luong = array("","","");
				
				$i = -1;
			}
			$i++;
		}		
		if($ten_bai_hat[0] != "" || $ten_bai_hat[1] != "" || $ten_bai_hat[2] != "")
		{
		?>
        <br />
        <hr width="400px" />
        <div align="left" style="margin-left:10px; margin-top:20px">        
            <div class="worms_trai"><strong>Tên bài hát</strong></div>
            <div class="worms_giua"><?php if($ten_bai_hat[0] != "") echo("<input id='$k' style='width:120px' type='text' value='$ten_bai_hat[0]' />"); ?></div>
            <div class="worms_giua"><?php if($ten_bai_hat[1] != ""){$a1=$k+1; echo("<input id='$a1' style='width:120px' type='text' value='$ten_bai_hat[1]' />"); } ?></div>
            <div class="worms_phai"><?php if($ten_bai_hat[2] != ""){$a2=$k+2; echo("<input id='$a2' style='width:120px' type='text' value='$ten_bai_hat[2]' />"); } ?></div>
                            
            <div class="worms_trai"><strong>Định dạng</strong></div>
            <div class="worms_giua"><?php echo($dinh_dang[0]); ?></div>
            <div class="worms_giua"><?php echo($dinh_dang[1]); ?></div>
            <div class="worms_phai"><?php echo($dinh_dang[2]); ?></div>  
                
            <div class="worms_trai"><strong>Thể lọai</strong></div>
            <div class="worms_giua"><?php if($the_loai[0] != "") echo($the_loai[0]); ?></div>
            <div class="worms_giua"><?php if($the_loai[1] != "") echo($the_loai[1]); ?></div>           
            <div class="worms_phai"><?php if($the_loai[2] != "") echo($the_loai[2]); ?></div>  
			 
            <div class="worms_trai"><strong>Ca sĩ</strong></div>
            <div class="worms_giua"><?php if($ca_si[0] != "") echo($ca_si[0]); ?></div>
            <div class="worms_giua"><?php if($ca_si[1] != "") echo($ca_si[1]); ?></div>
            <div class="worms_phai"><?php if($ca_si[2] != "") echo($ca_si[2]); ?></div>
            
            <div class="worms_trai"><strong>Tác giả</strong></div>                        
            <div class="worms_giua"><?php if($tac_gia[0] != "") echo($tac_gia[0]); ?></div>
            <div class="worms_giua"><?php if($tac_gia[1] != "") echo($tac_gia[1]); ?></div>
            <div class="worms_phai"><?php if($tac_gia[2] != "") echo($tac_gia[2]); ?></div>
            
            <div class="worms_trai"><strong>Ngày đăng</strong></div>            
            <div class="worms_giua"><?php if($ngay_dang[0] != "") echo($ngay_dang[0]); ?></div>
            <div class="worms_giua"><?php if($ngay_dang[1] != "") echo($ngay_dang[1]); ?></div>
            <div class="worms_phai"><?php if($ngay_dang[2] != "") echo($ngay_dang[2]); ?></div>
            
            <div class="worms_trai"><strong>Chất lượng</strong></div>            
            <div class="worms_giua"><?php if($chat_luong[0] != "") echo($chat_luong[0]); ?></div>
            <div class="worms_giua"><?php if($chat_luong[1] != "") echo($chat_luong[1]); ?></div>
            <div class="worms_phai"><?php if($chat_luong[2] != "") echo($chat_luong[2]); ?></div>
            
            <div class="worms_trai"><strong>Cho phép<br />đăng</strong></div>
            <?php if($ten_bai_hat[0] != "" && $ten_bai_hat[1] != "") {
            		echo("<div class='worms_giua' align='center' style='margin-top:10px'><input id='$k' name='$song_id[0]' value='$song_id[0]' type='radio' /></div>"); $k++;}
				  else{
				    echo("<div align='center' style='height:25px; width:130px; margin-top:10px'><input  id='$k' name='$song_id[0]' value='$song_id[0]' type='radio' /></div>"); $k++;}
				  ?>
            <?php if($ten_bai_hat[1] != "")
				  	if($ten_bai_hat[2] != ""){
            			echo("<div class='worms_giua' align='center' style='margin-top:10px'><input id='$k' name='$song_id[1]' value='$song_id[1]' type='radio' /></div>"); $k++;}
				  	else{
				  		echo("<div align='center' style='height:25px; margin-right:138px; margin-top:10px'><input  id='$k' name='$song_id[1]' value='$song_id[1]' type='radio' /></div>"); $k++; }
					?>
            <?php if($ten_bai_hat[2] != ""){
           			echo("<div class='worms_phai' align='center' style='margin-top:10px'><input  id='$k' name='$song_id[2]' value='$song_id[2]' type='radio' /></div>"); $k++;} ?>             
                <!------------------------------------>                         
            <div class="worms_trai" style="margin-top:5px"><strong>Không cho<br />phép đăng</strong></div> 
            <?php if($ten_bai_hat[0] != "" && $ten_bai_hat[1] != "") {
            		echo("<div class='worms_giua' align='center' style='margin-top:15px'><input id='$l' name='$song_id[0]' value='$song_id[0]' type='radio' /></div>"); $l++;}
				  else{
				    echo("<div align='center' style='height:25px; width:130px; margin-top:15px'><input  id='$l' name='$song_id[0]' value='$song_id[0]' type='radio' /></div>"); $l++;}
				  ?>
            <?php if($ten_bai_hat[1] != "")
					if($ten_bai_hat[2] != ""){
            			echo("<div class='worms_giua' align='center' style='margin-top:15px'><input id='$l' name='$song_id[1]' value='$song_id[1]' type='radio' /></div>"); $l++;}
					else{
				  		echo("<div align='center' style='height:25px; margin-right:138px; margin-top:15px'><input  id='$l' name='$song_id[1]' value='$song_id[1]' type='radio' /></div>"); $l++;}
					?>
            <?php if($ten_bai_hat[2] != ""){
           			echo("<div class='worms_phai' align='center' style='margin-top:15px'><input  id='$l' name='$song_id[2]' value='$song_id[2]' type='radio' /></div>"); $l++;}?>
        </div>
        <?php	
		}
	}
?>
							
<script language="javascript" type="text/javascript">
//	var arr = {item1: “xin chào”, item2: 100, item3: “bạn là ai thế?”, item4: 0.911};
	
	function Dang()
	{
		//alert("SDFDSF");
			
		var n = <?php echo($k); ?>;
		//alert(n);
		var cho_phep = "";
		for(i=0;i<n;i++)
		{
			if(document.getElementById(i).checked)
				cho_phep += "_" + document.getElementById(i).value;
		}
		//alert(cho_phep);
		n = <?php echo($l); ?>;
		//alert(n);		
		var ko_cho_phep = "";
		for(i=30;i<n;i++)
		{
			if(document.getElementById(i).checked)
				ko_cho_phep += "_" + document.getElementById(i).value;
		}
		//alert(ko_cho_phep);
		var para = "cho_phep=" + cho_phep;		
		para += "&ko_cho_phep=" + ko_cho_phep;		
		//alert(para);
		var t = $.ajax({url:"xulyThemBaiHatAdmin.php",
						data:""+para,
						success:function(kq)
								{								
									alert(kq);
									window.location = "QuanLyBaiHat.php";
								}
						});
	}
</script>                            

							<div>
                                <input type="button" onclick="Dang()" value="Cập nhật" style="width:80px" />
                                <input type="reset" value="Hủy" style="width:80px"/>
                            </div>                         	
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
                        	Quảng Cáo 1
						<!-- InstanceEndEditable -->	
                    </div>
                  	<div id="idAdv2" class="adv">
						<!-- InstanceBeginEditable name="Quảng Cáo 2" -->
                        	Quảng Cáo 2
						<!-- InstanceEndEditable -->
                    </div> 
                  	<div id="idAdv3" class="adv">
						<!-- InstanceBeginEditable name="Quảng Cáo 3" -->
                        	Quảng Cáo 3
						<!-- InstanceEndEditable -->
                    </div> 
               	  	<div id="idAdv4" class="adv">
						<!-- InstanceBeginEditable name="Quảng Cáo 4" -->
                        	Quảng Cáo 4
						<!-- InstanceEndEditable -->
                    </div>  
                </div>
            </div>
        </div>
        <div class="footer" align="center">
        	<div>
            	<p>Bản quyền thuộc về Fantasy Team (KHTN)</p>
                <p>Liên hệ:</p>
                	<p>Nguyễn Hải Bình (sau_con_89@yahoo.com)</p>
                	<p>Lê Ngọc Tín (taki.lnt@gmail.com)</p>
                    <p>Vương Quốc Toàn (vuongtoan_theking@gmail.com)</p>
            </div>
        </div>
   </div>
</body>
<!-- InstanceEnd --></html>