
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	session_start();
	
	if(isset($_REQUEST["txtKeyWord"]) && isset($_SESSION["IsAdmin"]))
	{
		if($_SESSION["IsAdmin"] == true)
		{
			$KeyWord = $_REQUEST["txtKeyWord"];
			include_once("DataProvider.php");
			$sql="select * from user u, user_info ui where u.UserName like '%$KeyWord%' and ui.UserID = u.ID";
			$index = 1;
			$result = DataProvider::ExecuteQuery($sql);
			while($row = mysql_fetch_array($result))
			{
				$userID = $row["ID"];
				$userName = $row["UserName"];
				$fullName = $row["FullName"];
				$joinDay = $row["JoinDay"];
				$IsDelete = $row["IsDelete"];
				$IsBanned = $row["IsBanned"];
				
				$email = $row["Email"];
				$localUser = $row["LocationID"];
					
				$ngaySinh = ($row["Birthday"]);																		
				$ngay = substr($ngaySinh,8,2);
				$thang = substr($ngaySinh,5,2);
				$nam = substr($ngaySinh,0,4);
				
				$idContent = "idUserInfo$index";
				?>
                	<div class="main-content">           
                		<div style="float:left;width:40%" align="left">
                            <p>Tên đăng nhập :</p>
                            <p>Họ Tên :</p>
                            <p>Banned :</p><br>
                            <?php
								if($IsDelete == true)
								{
							?>
                            		<label for='btnBoXoaUser'><input name='btnBoXoaUser' type='button' value='Bỏ xóa User' onclick="XoaUser('xulyXoaVaBannedUser.php?undeleteID=<?php echo($userID);?>','idTemp')"></label>
                            <?php
								}
								else
								{
							?>
                            		<label for='btnXoaUser'><input name='btnXoaUser' type='button' value='Xóa User' onclick="XoaUser('xulyXoaVaBannedUser.php?deleteID=<?php echo($userID);?>','idTemp')"></label>
                            <?php
								}
                            ?>
                            
                            <br><label onclick="HienRa('<?php echo($idContent);?>')" for="btnCapNhat"><input type='button' value='Cập nhật thông tin user'></label>
                        </div>
                        <div style="float:right;width:60%" align="left">
                             <p><b><?php echo($userName);?></b></p>
                             <p><?php echo($fullName);?></p>
                             <form name="frmBannedDel" id="frmBannedDel" action="xulyXoaVaBannedUser.php" method="post" onsubmit="Post(this,'idTemp'); return false">
                                 <p>
                                    <select name="cmbBanned">
                                    <?php
										if($IsBanned == true)
										{
											$banned = DataProvider::ExecuteQuery("SELECT * FROM banned where UserID = $userID");
											$row=mysql_fetch_array($banned);
											$dayUnbanned = $row["DateUnbanned"];
											echo("<option value=''>Bị Banned đến $dayUnbanned</option>");
										}
                                        echo("<option value='0'>Không Banned</option>");
										$date = getdate();
									  	include_once("DataProvider.php");
									  	$banned = DataProvider::ExecuteQuery("SELECT * FROM banned_rule");
									  	if($banned !=false)
									  	{
										 	while($row=mysql_fetch_array($banned))
										 	{
												$days = $row["Days"];
												$dayUnBanned = mktime(0,0,0,date("m"),date("d")+$days,date("Y"));
												$value = date('d/m/Y', $dayUnBanned);
												if($days == -1)
												{
													echo("<option value='$days'>Forever (Banned vĩnh viễn)</option>");
												}
												else
												{
											 		echo("<option value='$days'>$days ngày ($value)</option>");
												}
										 	}
									  	}		
                                    ?>                          
                                    </select>
                                    <input type="hidden" value="<?php echo($userID)?>" name="txtUserID">
                                    <input type="hidden" value="<?php echo($IsBanned)?>" name="txtIsBanned">
                                 </p><br>
                                 <p><label for="btnBannedDel"><input type='submit' name="btnBannedDel" value='Đồng ý'></label></p>
                             </form>
                        </div>   
                	</div>
                    <div class="user-list" id="<?php echo($idContent);?>" style="display:none">
                    	<div style="text-align:left;margin-bottom:10px"><b><h3><font color="#0000FF" >Thông tin tài khoản:</font></h3></b></div>
                        <form name="frmThongTinUser" method="post" action="xulyCapNhatUser.php" onsubmit="Post(this,'idTemp'); return false">
                            <div class="left_div">Tên đăng nhập:</div>
                            <div class="right_div"><label><?php echo($userName);?></label></div>
                            <div class="left_div">Ngày tham gia:</div>
                            <div class="right_div"><label><?php echo($joinDay);?></label></div>
                            <div class="left_div">Họ Tên:</div>
                            <div class="right_div">
                                <?php echo("<input name='txthovaten' id='txthovaten' type='text' value='$fullName'/>");?>
                            </div>
                            <div class="left_div">Ngày Sinh:</div>
                            <div class="right_div">
                               <select name="cmbngay" id="cmbngay">      
                                    <?php 
                                        echo("<option value='$ngay'>$ngay</option>");
                                        for($i=1;$i<=31;$i++)
                                        {
                                            echo("<option value='$i'>$i</option>");
                                        }
                                    ?>                                               
                                </select>
                                
                                <select name="cmbthang" id="cmbthang">	                     
                                    <?php 
                                        echo("<option value='$thang'>$thang</option>");
                                        for($i=1;$i<=12;$i++)
                                        {
                                            echo("<option value='$i'>$i</option>");
                                        }                            
                                    ?>
                                </select >
                                        
                                <input name="txtnam" type="text" id="txtnam" value="<?php echo($nam);?>" onfocus="cleartextfield()" style="width:65px"/>
                            </div>
                            <div class="left_div">Đến Từ:</div>
                            <div class="right_div">
                                 <select name="cmblocation" id="cmblocation" >
                                      <?php
                                          include_once("DataProvider.php");
                                          $location = DataProvider::ExecuteQuery("SELECT * FROM location");
										  echo("<option value='0'></option>");
                                          if($location !=false)
                                          {
                                             while($row=mysql_fetch_array($location))
                                             {					
											 	 $local = $row["Local"];
												 $localID = $row["ID"];                         
												 if($localID == $localUser)
												 {
													 echo("<option value='$localID' selected='selected'>$local</option>");
												 }
												 else
												 {
													  echo("<option value='$localID'>$local</option>");
												 }
                                             }
                                          }
										  
                                      ?>
                                 </select>  
                            </div>
                            <div class="left_div">Email:</div>
                            <?php
								$ktusername = "ktuser_$index";
								$ktmail = "ktemail_$index";
								$tendangnhap = "txttendangnhap_$index";
                            ?>
                            <div class="right_div">
                                <input name="txtemail" type="text" id="txtemail" value="<?php echo($email);?>"/>
                            </div>
                            <div style="text-align:left;margin-bottom:10px"><b><h3><font color="#0000FF">Thay đổi tên đăng nhập và mật khẩu:</font></h3></b></div>
                             <div class="left_div">Tên đăng nhập mới:</div>
                             <div class="right_div"><input type="text" value="<?php echo($userName);?>" id="<?php echo($tendangnhap);?>" style="width:200px" onkeyup="KtUser('txttendangnhap','<?php echo($ktusername);?>');" name="txttendangnhap" /></div>
                             <span id="<?php echo($ktusername);?>" ><p>&nbsp;</p></span >
                             <br><div class="left_div">Mật khẩu mới:</div>
                             <div class="right_div"><input type="password" name="txtMatKhauMoi" id="txtMatKhauMoi"style="width:200px" /></div>
                             <input type="hidden" value="<?php echo($userID)?>" name="txtUserID">
                             <div style="width:20%;height:40px;float:left;margin-top:10px">
                                <input type="submit" id="btnCapNhatThongTin" name="btnCapNhatThongTin" value="Cập nhất thông tin" style="height:40px" onclick="return CheckInput();" /> 
                             </div>
                        </form>
                    </div>               	
                <?php
				$index++;
			}
			
		}
		else
		{
			echo("Bạn không phải là Admin!!");
		}
	}
	else
	{
		echo("Hãy đăng nhập với quyền Admin.");
	}
?>