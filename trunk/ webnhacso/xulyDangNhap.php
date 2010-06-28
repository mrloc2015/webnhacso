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
						$playListID=$Row["PlayListID"];
						
					}
				}				
				else
				{
						echo("<script>alert('User name và password không tồn tại.')</script>");					
				}
			}
		}				
	}
	
	if($_SESSION["IsLogin"] == false && isset($_SESSION['UserName']) == false)
	{
		echo("<div align='center' style='background:url(images/title-login-box-bg.jpg);height:33px;width:240px'>
		  </div>
		  <div class='right-login'>
			<form id='frmDangNhap' name='frmDangNhap' method='post' action='xulyDangNhap.php' onsubmit='Post(this); return false'>
				<label for='txtTenDangNhap'>Tên đăng nhập</label>
				<input type='text' maxlength='30' name='txtTenDangNhap' id='txtTenDangNhap' tabindex='1'><br>
				<label for='txtMatKhau'>Mật khẩu</label><br>
				<input type='password' maxlength='30' name='txtMatKhau' id='txtMatKhau' tabindex='2'>
				<input type='Submit' id='btnDangNhap' name='btnDangNhap' value='Ðăng nhập'>        
			</form> 
			<ul>
				<li><a href='DangKy.php'>Ðăng ký thành viên</a></li>
			</ul>  
		  </div>");
	}
	else
	{  	  
		  $userName = $_SESSION['UserName'];
		  $_SESSION["DaDangNhap"] = true;
		  echo("<div class='right-username'>
						Thành viên chính thức
					</div>
					<div class='right-userinfo'>
					  <div>
						<div>
							<b>Xin chào:</b><span style='color:#33F;font-size:16px;font-weight:bold;'>$userName</span>
						</div>
						<ul>
							<li>
								<a href='quanlytaikhoan' title='Quản lý tài khoản'>Quản lý tài khoản</a>
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
					
?>