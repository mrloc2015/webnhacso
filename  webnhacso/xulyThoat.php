<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php	
	session_start();
	unset($_SESSION['UserName']);
	unset($_SESSION['Pass']);
	unset($_SESSION['UserType']);
	$_SESSION["IsLogin"]=false;
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
?>