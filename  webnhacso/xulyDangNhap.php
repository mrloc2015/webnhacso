<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php	
	session_start();		
	include_once("DataProvider.php");
	$playListID="";
	if(isset($_REQUEST["btnDangNhap"])) 					   
	{		
		$UserName=$_REQUEST["txtTenDangNhap"];
		$PassWord=$_REQUEST["txtMatKhau"];		
		if(trim($UserName)=="")
		{
			echo("<script>alert('Chưa nhập user name.')</script>");
		}
		else
		{
			if(trim($PassWord)=="")
			{
				echo("<script>alert('Chưa nhập password.')</script>");
			}
			else
			{
				$PassWord=md5($_REQUEST["txtMatKhau"]);
				$User=DataProvider::ExecuteQuery("Select * from user where UserName='$UserName' ");
				$Row = mysql_fetch_array($User);
				if($Row!=null)
				{
					if($PassWord!=$Row["Pass"])
					{
						echo("<script>alert('Password không đúng.')</script>");
					}
					else
					{
						$_SESSION['UserID']=$Row["ID"];
						$_SESSION['UserName']=$Row["UserName"];
						$_SESSION["Pass"]=$Row["Pass"];
						$_SESSION["UserType"]=$Row["UserStyleID"];
						$_SESSION["IsLogin"]=true;
						$_SESSION["PlayListID"]=$Row["PlayListID"];
						
					}
				}				
				else
				{
						echo("<script>alert('User name và password không tồn tại.')</script>");					
				}
			}
		}				
	}
	if(isset($_SESSION["IsLogin"])==true)
	{
		if($_SESSION["IsLogin"] == false && isset($_SESSION['UserName']) == false)
		{
			echo("<div align='center' style='background:url(images/title-login-box-bg.jpg);height:33px;width:275px;'>
			  </div>
			  <div class='right-login'>
				<form id='frmDangNhap' name='frmDangNhap' method='post' action='xulyDangNhap.php' onsubmit='DangNhap(this); return false'>		
						<label for='txtTenDangNhap'>Tên đăng nhập</label>
						<p><input type='text' maxlength='30' name='txtTenDangNhap' id='txtTenDangNhap' tabindex='1' style='width:200px;'></p>
						<label for='txtMatKhau'>Mật khẩu</label>
						<p><input type='password' maxlength='30' name='txtMatKhau' id='txtMatKhau' tabindex='2' style='width:200px;'></p>
						<label><input type='Submit' id='btnDangNhap' name='btnDangNhap' value='Ðăng nhập'></label><br>
						<label for='chkLuuTaiKhoan'><input type='checkbox' name='chkLuuTaiKhoan'> Nhớ tài khoản </label>			
				</form> 	  
			  </div>");
		}
		else
		{  	  
			  $playListID = $_SESSION["PlayListID"];
			  $userName = $_SESSION['UserName'];
			  if($_SESSION["UserType"] == 2)
			  {
				  echo("<script language='javascript' type='text/javascript'>
							$('#user_id').attr('value',\"".$_SESSION["UserID"]."\");
							$('#UserID1').attr('value',\"".$_SESSION["UserID"]."\");
							$('#UserID2').attr('value',\"".$_SESSION["UserID"]."\");
						</script>
							<div class='right-username'>
								Thành viên chính thức
							</div>
							<div class='right-userinfo'>
							  <div>
								<div>
									<b>Xin chào: </b><span style='color:#33F;font-size:16px;font-weight:bold;'>$userName</span>
								</div>
								<ul>
									<li>
										<a href='QuanLyTaiKhoan.php' title='Quản lý tài khoản'>Quản lý tài khoản</a>
									</li>
									<li>
										<a href='Nghe.php?PlayList=$playListID' title='Nghe playlist'>Nghe Playlist</a>
									</li>
									<li>
										<a href='javascript:DangXuat()' title='Thoát'>Thoát</a>
									</li>
								</ul>
							</div>
						  </div>");
			  }
			  else if($_SESSION["UserType"] == 1)
			  {
					echo("<script language='javascript' type='text/javascript'>
							$('#user_id').attr('value',\"".$_SESSION["UserID"]."\");
							$('#UserID1').attr('value',\"".$_SESSION["UserID"]."\");
							$('#UserID2').attr('value',\"".$_SESSION["UserID"]."\");
						  </script>	
						  <div class='right-username'>
								Thành viên quản trị
							</div>
							<div class='right-admininfo'> 
								<div>
									<b style='color:#F00;'>Xin chào Admin:</b><span style='color:#0C0;font-size:16px;font-weight:bold;'>$userName</span>
								</div>
								<ul>
									<li>
										<a href='QuanLyTaiKhoan.php' title='Quản lý tài khoản'>Quản lý tài khoản</a>
									</li>
									<li>
										<a href='QuanLyThanhVien.php' title='Quản lý thành viên'>Quản lý thành viên</a>
									</li>
									<li>
										<a href='QuanLyBaiHat.php' title='Quản lý bài hát'>Quản lý bài hát</a>
									</li>
									<li>
										<a href='QuanLyPlaylist.php' title='Quản lý Playlist'>Quản lý Playlist</a>
									</li>
									<li>
										<a href='QuanLyWeb.php' title='Quản lý Website'>Quản lý Website</a>
									</li>
									<li>
										<a href='QuanLyDanhMuc.php' title='Quản lý danh mục'>Quản lý danh mục</a>
									</li>
									<li>
										<a href='javascript:DangXuat()' title='Thoát'>Thoát</a>
									</li>
								</ul>
						  </div>");
			  }
		}
	}
	else
	{
		echo("<div align='center' style='background:url(images/title-login-box-bg.jpg);height:33px;width:275px;'>
			  </div>
			  <div class='right-login'>
				<form id='frmDangNhap' name='frmDangNhap' method='post' action='xulyDangNhap.php' onsubmit='DangNhap(this); return false'>
					
						<label for='txtTenDangNhap'>Tên đăng nhập</label>
						<p><input type='text' maxlength='30' name='txtTenDangNhap' id='txtTenDangNhap' tabindex='1' style='width:200px;'></p>
						<label for='txtMatKhau'>Mật khẩu</label>
						<p><input type='password' maxlength='30' name='txtMatKhau' id='txtMatKhau' tabindex='2' style='width:200px;'></p>
						<label><input type='Submit' id='btnDangNhap' name='btnDangNhap' value='Ðăng nhập'></label><br>
						<label for='chkLuuTaiKhoan'><input type='checkbox' name='chkLuuTaiKhoan'> Nhớ tài khoản </label>
					
				</form> 	  
			  </div>");
	}
?>