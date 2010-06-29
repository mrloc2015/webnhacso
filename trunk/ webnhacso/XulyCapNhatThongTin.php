<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	session_start();	
	$username=$_SESSION["UserName"];
	include_once("DataProvider.php");
	
	//lấy user_info.UserID và email của username đang đang nhập
	$user=DataProvider::ExecuteQuery("SELECT user_info.ID as ID,user_info.Email as Email from user,user_info WHERE user_info.UserID = user.ID and user.UserName='$username'");		
	$row=mysql_fetch_array($user);
	$user_infoID=$row["ID"];
	$old_email=$row["Email"];
	
	if(isset($_REQUEST["CapNhat"]))
	{						
		$new_email = $_REQUEST["txtemail"];		
		$hovaten=$_REQUEST["txthovaten"];
		$ngaysinh=$_REQUEST["txtnam"]."/".$_REQUEST["cmbthang"]."/".$_REQUEST["cmbngay"];
		$location=$_REQUEST["cmblocation"];		
		$txtmaxacnhan=$_REQUEST["txtmaxacnhan"];		
		//Kiểm tra mã xác nhận
		if($txtmaxacnhan!=$_SESSION['code'])
		{
			echo "Mã xác nhận không dúng!<br/><a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";	
			exit;
		}
		//Kiểm tra email
		if(strtolower($old_email)!=strtolower($new_email))
		{
			$list_email=DataProvider::ExecuteQuery("SELECT Email, count( ID ) FROM user_info WHERE Email = '$new_email' group by Email");
			if($list_email!=false)
			{
				$row=mysql_fetch_array($list_email);
				if($row["count( ID )"]>=1)
				{
					echo "Địa chỉ email đã được sử dụng!<br/><a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";	
				exit;
				}
			}
		}					
		//Tiến hành cập nhật thong tin
		$sql="update user_info set FullName = '$hovaten', Birthday = '$ngaysinh' , Email='$new_email' ,LocationID ='$location' where user_info.ID='$user_infoID'";
		DataProvider::ExecuteQuery($sql);
		echo("<blink>Cập nhật thông tin thành công!</blink><br/>Click <a href='TrangChu.php'>vào đây</a> để trở lại trang chủ!");
	}
	else
	{
		echo"Cập nhật thông tin thất bại!";
	}
?>