<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php	
	session_start();
	unset($_SESSION['UserName']);
	unset($_SESSION['Pass']);
	unset($_SESSION['UserType']);
	unset($_SESSION["PlayListID"]);
	unset($_SESSION["UserID"]);
	
	$_SESSION["IsAdmin"]=false;
	$_SESSION["IsLogin"]=false;
	echo("<script language='javascript' type='text/javascript'>
			$('#user_id').attr('value',\"\");
			$('#UserID1').attr('value',\"\");
			$('#UserID2').attr('value',\"\");
		  </script>		  
		  <div align='center' style='background:url(images/title-login-box-bg.jpg);height:33px;width:275px;'>
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
?>
