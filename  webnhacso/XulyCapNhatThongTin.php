<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
session_start();
include_once("DataProvider.php");
$username=$_SESSION["UserName"];

if(isset($_REQUEST["thongtincanhan"]))
{
	$dulieu=$_REQUEST["thongtincanhan"];
	$array_thongtin=explode(",",$dulieu);	
	$hovaten=$array_thongtin[0];
	$ngaysinh=$array_thongtin[1];
	$email=$array_thongtin[2];
	$dentu=$array_thongtin[3];
			
	//lấy user_info.UserID và email của username đang đang nhập
	$user=DataProvider::ExecuteQuery("SELECT user_info.ID as ID,user_info.Email as Email from user,user_info WHERE user_info.UserID = user.ID and user.UserName='$username'");		
	$row=mysql_fetch_array($user);
	$user_infoID=$row["ID"];
	$old_email=$row["Email"];	
	
	//Kiểm tra email
	if(strtolower($old_email)!=strtolower($email))
	{
		$list_email=DataProvider::ExecuteQuery("SELECT Email, count( ID ) FROM user_info WHERE Email = '$email' group by Email");
		if($list_email!=false)
		{
			$row=mysql_fetch_array($list_email);
			if($row["count( ID )"]>=1)
			{
				echo "<img src='images/unsafe.gif'/>Địa chỉ email đã được sử dụng";	
			exit;
			}
		}
	}					
	//Tiến hành cập nhật thong tin
	$sql="update user_info set FullName = '$hovaten', Birthday = '$ngaysinh' , Email='$email' ,LocationID ='$dentu' where user_info.ID='$user_infoID'";
		DataProvider::ExecuteQuery($sql);
		echo("<img src='images/safe.gif'/>Cập nhật thông tin thành công");	
}
if(isset($_REQUEST["thongtinmatkhau"]))
{
	$dulieu=$_REQUEST["thongtinmatkhau"];
	$arr=explode(",",$dulieu);
	$matkhaucu=$arr[0];
	$matkhaumoi=$arr[1];
	
	$user=DataProvider::ExecuteQuery("SELECT Pass from user WHERE user.UserName='$username'");
	$row=mysql_fetch_array($user);
	$matkhau=$row["Pass"];
	if(md5($matkhaucu)==$matkhau)
	{
		$matkhaumoi=md5($matkhaumoi);
		$sql="update user set Pass ='$matkhaumoi' where user.UserName='$username'";
		DataProvider::ExecuteQuery($sql);
		echo("<img src='images/safe.gif'/>Mật Khẩu của bạn đã được thay đổi!");
	}
	else
	{
		echo("<img src='images/unsafe.gif'/>Mật Khẩu không đúng!");
	}
}

?>